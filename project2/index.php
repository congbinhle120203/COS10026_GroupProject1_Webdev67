<?php
/*
  index.php - Home page, Solstice Community Energy Careers (fictional company)
  COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03
  Author: Le Cong Binh (106419738)

  WHAT CHANGED FROM PART 1 (index.html)
  - Shared head, header/nav and footer come from header.inc, nav.inc, footer.inc.
  - These parts are now loaded from MySQL (database webdev67_db):
      statistics      -> company_stats table (+ total capacity worked out by SQL)
      facilities      -> facilities table (rowspan and total built from the data)
      featured roles  -> jobs table (only rows where is_featured is TRUE)
      FAQ             -> faqs table
  - The search box now sends the search term to search.php.
  - If MySQL is not running, the page still loads and shows a short notice
    where the live data would be.

  ACKNOWLEDGEMENTS
  - The company, people, quotes and figures on this page are fictional.
  - GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Home page from MySQL"
*/

// ---------------------------------------------------------------------------
// 1. PAGE SETTINGS used by header.inc
// ---------------------------------------------------------------------------
$page_title       = "Home";
$page_description = "Careers at Solstice Community Energy, a fictional renewable energy company.";
$page_author      = "Le Cong Binh";
$body_class       = "page-home";
$page_css         = "    .page-home .hero .lead {\n      max-width: 38em;\n    }";

// ---------------------------------------------------------------------------
// 2. READ EVERYTHING THE PAGE NEEDS FROM THE DATABASE
//    We read all data first and close the connection, then print the HTML.
//    None of these queries contain user input, so plain queries are safe.
// ---------------------------------------------------------------------------
require_once "settings.php";     // $host, $user, $pwd, $sql_db
require_once "functions.inc";    // db_connect(), db_fetch_rows(), e(), format_number()

$conn = db_connect($host, $user, $pwd, $sql_db);   // false if MySQL is down

$stats = db_fetch_rows($conn,
    "SELECT stat_value, stat_label FROM company_stats ORDER BY sort_order");

$facilities = db_fetch_rows($conn,
    "SELECT state, facility_name, technology, capacity_mw, storage_mwh
     FROM facilities ORDER BY facility_id");

// SUM() adds up the column inside MySQL; AS gives the result a name
$total_rows = db_fetch_rows($conn,
    "SELECT SUM(capacity_mw) AS total_mw FROM facilities");

$featured = db_fetch_rows($conn,
    "SELECT job_ref, title, location, summary
     FROM jobs WHERE is_featured = TRUE ORDER BY job_ref LIMIT 3");

$count_rows = db_fetch_rows($conn, "SELECT COUNT(*) AS open_roles FROM jobs");

$faqs = db_fetch_rows($conn,
    "SELECT question, answer FROM faqs ORDER BY sort_order");

if ($conn) {
    mysqli_close($conn);
}

// Values worked out from the query results
$total_mw   = ($total_rows !== null && $total_rows[0]["total_mw"] !== null)
              ? format_number($total_rows[0]["total_mw"]) : null;
$open_roles = ($count_rows !== null) ? (int) $count_rows[0]["open_roles"] : null;

// Put the calculated capacity in second place among the statistics
if ($stats !== null && $total_mw !== null) {
    array_splice($stats, 1, 0, [["stat_value" => "$total_mw MW", "stat_label" => "Installed Capacity"]]);
}

// Group facilities by state: ["Victoria" => [row, row], "New South Wales" => [...]]
// The number of rows in each group becomes the rowspan of the State cell.
$facilities_by_state = [];
if ($facilities !== null) {
    foreach ($facilities as $facility) {
        $facilities_by_state[$facility["state"]][] = $facility;
    }
}

// Message shown wherever live data could not be loaded
$db_notice = '<p class="db-notice" role="status">This information is not available right now. Please try again later.</p>';

// ---------------------------------------------------------------------------
// 3. OUTPUT THE PAGE
// ---------------------------------------------------------------------------
include "header.inc";
include "nav.inc";
?>

  <!-- Main content -->
  <main id="main">

    <!-- Search box: sends the term to search.php with GET so results can be bookmarked -->
    <section class="home-search" aria-label="Search">
      <div class="container">
        <form class="search-form" action="search.php" method="get" role="search">
          <label for="site-search">Search our roles</label>
          <input type="search" id="site-search" name="q" placeholder="e.g. developer, SCE01, Melbourne" autocomplete="off">
          <button type="submit">Search</button>
        </form>
      </div>
    </section>

    <!-- 1. Hero banner: slogan, name, description and image -->
    <section class="hero" aria-labelledby="hero-title">
      <div class="container hero-inner">

        <div class="hero-copy">
          <p class="hero-slogan">Powering communities, one career at a time</p>
          <h1 id="hero-title">Clean energy careers in Australia</h1>
          <p class="lead">
            Solstice Community Energy is a member-owned co-operative building solar farms and community batteries across regional Victoria and New South Wales. Join our digital and grid teams to keep clean power running for the communities we serve.
          </p>
<?php if ($open_roles !== null) { ?>
          <p class="open-roles">
            We are hiring for <strong><?php echo $open_roles; ?> open <?php echo ($open_roles === 1) ? "role" : "roles"; ?></strong> right now.
          </p>
<?php } ?>
          <p>
            <a class="button" href="jobs.php">View Open Positions</a>
            <a class="button button-secondary" href="apply.php">Apply Now</a>
          </p>
        </div>

        <div class="hero-media">
          <img class="hero-image" src="images/hero.svg" width="560" height="450" alt="Illustration of rows of solar panels under a rising sun">
        </div>

      </div>
    </section>

    <div class="container">

      <!-- 2. Company overview and stats (company_stats table) -->
      <section class="section" aria-labelledby="mission-title">
        <!-- Inline CSS: brand green heading -->
        <h2 id="mission-title" style="color: #2c5e4f;">About Our Mission</h2>
        <p>
          Solstice Community Energy was founded in 2016 as a member-owned co-operative in Bendigo, Victoria. We build and run community solar farms, rooftop programs and batteries with local councils, so households share in the benefits of clean power. Our digital team builds the web portals residents use to track their own solar generation.
        </p>

<?php if (!empty($stats)) { ?>
        <div class="stats-row">
<?php   foreach ($stats as $stat) { ?>
          <div class="stat-box">
            <p class="stat-number"><?php echo e($stat["stat_value"]); ?></p>
            <p class="stat-label"><?php echo e($stat["stat_label"]); ?></p>
          </div>
<?php   } ?>
        </div>
<?php } else {
        echo "        $db_notice\n";
      } ?>
        <p class="stats-note">Company, figures and facilities on this page are fictional and were created for a university project.</p>
      </section>

      <!-- 3. Facilities table (facilities table). rowspan and the total come from the data. -->
      <section class="section" aria-labelledby="facilities-title">
        <h2 id="facilities-title">Active Community Facilities</h2>
        <p>The table below summarises our active sites in Victoria and New South Wales.</p>

<?php if (!empty($facilities_by_state)) { ?>
        <div class="table-wrap" role="region" aria-label="Active facilities table (scrolls sideways on small screens)" tabindex="0">
          <table class="data-table">
            <caption>Table 1: Active Energy Facilities Summary</caption>
            <thead>
              <tr>
                <th scope="col">State</th>
                <th scope="col">Facility Name</th>
                <th scope="col">Technology Type</th>
                <th scope="col">Capacity</th>
              </tr>
            </thead>
            <tbody>
<?php
    foreach ($facilities_by_state as $state => $rows) {
        foreach ($rows as $position => $facility) {
            // Capacity text, e.g. "12.5 MW" or "5 MW / 10 MWh" for a battery
            $capacity = format_number($facility["capacity_mw"]) . " MW";
            if ($facility["storage_mwh"] !== null) {
                $capacity .= " / " . format_number($facility["storage_mwh"]) . " MWh";
            }

            echo "              <tr>\n";
            // Only the first row of each state gets the merged State cell
            if ($position === 0) {
                echo "                <th scope=\"rowgroup\" rowspan=\"" . count($rows) . "\">" . e($state) . "</th>\n";
            }
            echo "                <td>" . e($facility["facility_name"]) . "</td>\n";
            echo "                <td>" . e($facility["technology"]) . "</td>\n";
            echo "                <td>" . e($capacity) . "</td>\n";
            echo "              </tr>\n";
        }
    }
?>
            </tbody>
<?php   if ($total_mw !== null) { ?>
            <tfoot>
              <tr>
                <th scope="row" colspan="3">Total Installed Capacity</th>
                <td><?php echo $total_mw; ?> MW</td>
              </tr>
            </tfoot>
<?php   } ?>
          </table>
        </div>
<?php } else {
        echo "        $db_notice\n";
      } ?>
      </section>

      <!-- 4. Why join us -->
      <section class="section" aria-labelledby="why-title">
        <h2 id="why-title">Why Join Our Team</h2>
        <p>We offer a supportive, flexible workplace for software and grid engineers:</p>

        <ul class="benefits">
          <li><strong>Real Impact</strong> Build web applications that help local families reduce electricity bills.</li>
          <li><strong>Flexible Work</strong> Hybrid roles from Hawthorn or Bendigo, plus a 9-day fortnight for our digital and grid teams.</li>
          <li><strong>Learning</strong> A $1,500 yearly budget for clean-energy courses and certificates, and weekly code reviews with senior engineers.</li>
        </ul>
      </section>

      <!-- Featured roles (jobs table, is_featured = TRUE) -->
      <section class="section" aria-labelledby="featured-title">
        <h2 id="featured-title">Featured Roles</h2>
        <p>Some of our current openings. Open a role to read the full description.</p>

<?php if (!empty($featured)) { ?>
        <ul class="featured">
<?php   foreach ($featured as $job) {
            $ref = e($job["job_ref"]); ?>
          <li>
            <p class="featured-ref"><?php echo $ref; ?></p>
            <h3><?php echo e($job["title"]); ?></h3>
            <p><?php echo e($job["summary"]); ?></p>
            <p class="featured-meta"><?php echo e($job["location"]); ?></p>
            <a class="button" href="jobs.php#job-<?php echo $ref; ?>">View role <?php echo $ref; ?></a>
          </li>
<?php   } ?>
        </ul>
<?php } elseif ($featured === null) {
        echo "        $db_notice\n";
      } else { ?>
        <p>There are no featured roles at the moment. <a href="jobs.php">See all open roles</a>.</p>
<?php } ?>
      </section>

      <!-- 5. How hiring works: ordered list numbered with CSS counters -->
      <section class="section" aria-labelledby="steps-title">
        <h2 id="steps-title">How Hiring Works</h2>
        <p>From first look to first day, in four simple steps.</p>

        <ol class="steps">
          <li><strong>Browse the roles</strong> Read the job descriptions and pick the one that fits you.</li>
          <li><strong>Check the requirements</strong> Each role lists essential and preferable skills.</li>
          <li><strong>Send your application</strong> Complete the online form with your reference number.</li>
          <li><strong>Meet the team</strong> Shortlisted applicants are invited to an interview.</li>
        </ol>
      </section>

      <!-- 6. Team voice (fictional quote) -->
      <section class="section" aria-labelledby="voice-title">
        <h2 id="voice-title">Life at Solstice</h2>
        <figure class="voice">
          <blockquote>
            <p>I joined from a web agency and shipped my first dashboard within a month. Watching a neighbourhood read its own solar numbers is the best part of my week.</p>
          </blockquote>
          <figcaption>A Solstice web developer (fictional quote for this student project)</figcaption>
        </figure>
      </section>

      <!-- 7. FAQ (faqs table): native details and summary elements, no JavaScript needed -->
      <section class="section" aria-labelledby="faq-title">
        <h2 id="faq-title">Frequently Asked Questions</h2>

<?php if (!empty($faqs)) { ?>
        <div class="faq">
<?php   foreach ($faqs as $faq) { ?>
          <details>
            <summary><?php echo e($faq["question"]); ?></summary>
            <p><?php echo e($faq["answer"]); ?></p>
          </details>
<?php   } ?>
        </div>
<?php } else {
        echo "        $db_notice\n";
      } ?>
      </section>

      <!-- 8. Call to action -->
      <section class="cta-band" aria-labelledby="cta-title">
        <h2 id="cta-title">Ready to power your career?</h2>
        <p>Browse our open roles, then send your application in a few minutes.</p>
        <p>
          <a class="button" href="jobs.php">See open roles</a>
          <a class="button" href="apply.php">Apply now</a>
        </p>
      </section>

    </div>

  </main>

<?php include "footer.inc"; ?>
