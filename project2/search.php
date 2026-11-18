<?php
/*
  search.php - job search results for the search bar on the home page
  COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03
  Author: Le Cong Binh (106419738)

  HOW IT WORKS
  1. The form sends the term with GET, e.g. search.php?q=developer&sort=title
     (GET because a search only reads data and the result can be bookmarked).
  2. The term is checked on the server: trimmed, slashes removed, length and
     allowed characters checked. Nothing is checked in the browser.
  3. Each word must appear in at least one column (reference, title, location,
     summary or overview). "melbourne developer" needs both words.
  4. The query is a PREPARED STATEMENT: the SQL and the user's words are sent
     to MySQL separately, so the words can never change the SQL (no SQL injection).
  5. Every value is escaped with e() when it is printed (no HTML injection).
  The jobs page search bar can send its form here too (action="search.php").

  GenAI acknowledgement: drafted with Claude (Anthropic, Claude Opus 5.5),
  then reviewed, edited and tested by the author.
  Prompt: "Build search.php for our home page search bar: validate the term on
  the server, search the jobs table with a prepared statement, show the results
  as cards, and handle empty, no-result and database-down cases."
*/

$page_title       = "Search roles";
$page_description = "Search open roles at Solstice Community Energy, a fictional renewable energy company.";
$page_author      = "Le Cong Binh";
$body_class       = "page-search";

require_once "settings.php";
require_once "functions.inc";

// ---------------------------------------------------------------------------
// 1. READ AND CHECK THE INPUT
// ---------------------------------------------------------------------------
const MIN_LENGTH = 2;
const MAX_LENGTH = 50;
const MAX_WORDS  = 5;

// Sort options: the key comes from the URL, the value is the SQL we trust.
// The user can only choose one of these keys, so ORDER BY is never built
// from their text (ORDER BY cannot use a ? placeholder).
$sort_options = [
    "ref"    => ["label" => "Reference",          "sql" => "job_ref ASC"],
    "title"  => ["label" => "Job title (A to Z)", "sql" => "title ASC"],
    "salary" => ["label" => "Highest salary",     "sql" => "salary_max DESC"],
    "newest" => ["label" => "Newest first",       "sql" => "posted_date DESC, job_ref ASC"],
];

$term   = "";      // the cleaned search term
$words  = [];      // the term split into words
$errors = [];      // validation messages
$sort   = "ref";

if (isset($_GET["sort"]) && array_key_exists($_GET["sort"], $sort_options)) {
    $sort = $_GET["sort"];
}

$searched = isset($_GET["q"]);   // false when someone opens search.php directly

if ($searched) {
    // trim() and stripslashes() now; escaping for HTML happens when printing,
    // so "Solar & Battery" is searched as typed, not as "Solar &amp; Battery".
    $term = stripslashes(trim($_GET["q"]));
    $term = preg_replace('/\s+/', " ", $term);     // many spaces -> one space

    $length = mb_strlen($term);
    if ($term === "") {
        $errors[] = "Please type a word to search for, for example developer or SCE01.";
    } elseif ($length < MIN_LENGTH) {
        $errors[] = "Your search must be at least " . MIN_LENGTH . " characters long.";
    } elseif ($length > MAX_LENGTH) {
        $errors[] = "Your search must be " . MAX_LENGTH . " characters or fewer.";
    } elseif (!preg_match("/^[\p{L}\p{N} &.,'\-]+$/u", $term)) {
        // \p{L} = any letter (also Vietnamese letters), \p{N} = any digit
        $errors[] = "Please use only letters, numbers, spaces and these symbols: & . , ' -";
    } else {
        // Keep words of 2+ characters (a lone "&" or "-" would match too much)
        $words = array_filter(explode(" ", $term), fn($w) => mb_strlen($w) >= MIN_LENGTH);
        $words = array_slice(array_values($words), 0, MAX_WORDS);
        if (empty($words)) {
            $errors[] = "Please include at least one word of " . MIN_LENGTH . " or more characters.";
        }
    }
}

// ---------------------------------------------------------------------------
// 2. SEARCH THE JOBS TABLE WITH A PREPARED STATEMENT
// ---------------------------------------------------------------------------
$results  = [];
$db_error = false;

if ($searched && empty($errors)) {
    $conn = db_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        $db_error = true;
    } else {
        // One group of "?" per word:
        // (job_ref LIKE ? OR title LIKE ? OR ...) AND (job_ref LIKE ? OR ...)
        $columns   = ["job_ref", "title", "location", "summary", "overview"];
        $one_group = "(" . implode(" LIKE ? OR ", $columns) . " LIKE ?)";
        $where     = implode(" AND ", array_fill(0, count($words), $one_group));

        $sql = "SELECT job_ref, title, location, salary_min, salary_max, super_rate, summary
                FROM jobs
                WHERE $where
                ORDER BY " . $sort_options[$sort]["sql"];

        // The values for the "?" marks, in the same order
        $params = [];
        foreach ($words as $word) {
            // % and _ are wildcards in LIKE; a backslash makes them literal
            $like = "%" . addcslashes($word, "%_\\") . "%";
            foreach ($columns as $column) {
                $params[] = $like;
            }
        }

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            $db_error = true;
        } else {
            // "s" = string; one "s" for each value. ...$params passes the
            // array items as separate arguments.
            mysqli_stmt_bind_param($stmt, str_repeat("s", count($params)), ...$params);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $results[] = $row;
                }
                mysqli_free_result($result);
            } else {
                $db_error = true;
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
}

// Wrap each search word found in $text with <mark>, escaping everything else.
// preg_split with PREG_SPLIT_DELIM_CAPTURE returns: text, match, text, match...
// so the odd positions (1, 3, 5...) are the matches.
function highlight($text, $words)
{
    if (empty($words)) {
        return e($text);
    }
    $quoted  = array_map(fn($w) => preg_quote($w, "/"), $words);
    $pattern = "/(" . implode("|", $quoted) . ")/iu";
    $parts   = preg_split($pattern, $text, -1, PREG_SPLIT_DELIM_CAPTURE);

    $html = "";
    foreach ($parts as $position => $part) {
        $html .= ($position % 2 === 1) ? "<mark>" . e($part) . "</mark>" : e($part);
    }
    return $html;
}

include "header.inc";
include "nav.inc";
?>

  <main id="main">

    <!-- Search form, filled in with the last search so it is easy to change -->
    <section class="home-search" aria-label="Search">
      <div class="container">
        <form class="search-form" action="search.php" method="get" role="search">
          <label for="site-search">Search our roles</label>
          <input type="search" id="site-search" name="q" value="<?php echo e($term); ?>" placeholder="e.g. developer, SCE01, Melbourne" autocomplete="off">
          <label for="sort">Sort by</label>
          <select id="sort" name="sort">
<?php foreach ($sort_options as $key => $option) {
          $selected = ($key === $sort) ? " selected" : ""; ?>
            <option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo e($option["label"]); ?></option>
<?php } ?>
          </select>
          <button type="submit">Search</button>
        </form>
      </div>
    </section>

    <div class="container">
      <section class="section" aria-labelledby="results-title">
        <h1 id="results-title">Search results</h1>

<?php if (!$searched) { ?>
        <!-- search.php opened directly, without a search term -->
        <p class="search-summary">Type a job title, a reference number or a place in the search box above.</p>

<?php } elseif (!empty($errors)) { ?>
        <!-- The term failed the server-side checks -->
        <div class="form-message" role="alert">
<?php   foreach ($errors as $error) { ?>
          <p><?php echo e($error); ?></p>
<?php   } ?>
        </div>

<?php } elseif ($db_error) { ?>
        <p class="db-notice" role="status">Search is not available right now. Please try again later, or <a href="jobs.php">browse all roles</a>.</p>

<?php } elseif (empty($results)) { ?>
        <p class="search-summary" role="status">No roles match <strong><?php echo e($term); ?></strong>.</p>
        <p>Search tips:</p>
        <ul class="search-tips">
          <li>Check the spelling, or try fewer words.</li>
          <li>Try a broader word such as <a href="search.php?q=developer">developer</a> or <a href="search.php?q=Melbourne">Melbourne</a>.</li>
          <li>Search by reference number, for example <a href="search.php?q=SCE02">SCE02</a>.</li>
        </ul>
        <p><a class="button" href="jobs.php">Browse all roles</a></p>

<?php } else {
        $count = count($results); ?>
        <p class="search-summary" role="status">
          <?php echo $count; ?> <?php echo ($count === 1) ? "role matches" : "roles match"; ?>
          <strong><?php echo e($term); ?></strong>, sorted by <?php echo e(strtolower($sort_options[$sort]["label"])); ?>.
        </p>

        <ul class="featured">
<?php   foreach ($results as $job) {
            $ref    = e($job["job_ref"]);
            $salary = "A$" . number_format($job["salary_min"]) . " - " . number_format($job["salary_max"])
                    . " + " . format_number($job["super_rate"]) . "% super"; ?>
          <li>
            <p class="featured-ref"><?php echo highlight($job["job_ref"], $words); ?></p>
            <h2 class="h3"><?php echo highlight($job["title"], $words); ?></h2>
            <p><?php echo highlight($job["summary"], $words); ?></p>
            <p class="featured-meta"><?php echo highlight($job["location"], $words); ?></p>
            <p class="result-salary"><?php echo e($salary); ?></p>
            <p class="result-actions">
              <a class="button" href="jobs.php#job-<?php echo $ref; ?>">View role <?php echo $ref; ?></a>
              <a class="button button-secondary" href="apply.php?ref=<?php echo urlencode($job["job_ref"]); ?>">Apply for <?php echo $ref; ?></a>
            </p>
          </li>
<?php   } ?>
        </ul>
<?php } ?>
      </section>
    </div>

  </main>

<?php include "footer.inc"; ?>
