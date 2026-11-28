<?php
/*
- File: jobs.php
- Author: Bach Gia Huy (jobs.php owner)
- Jira Task: RWP-147, RWP-148
- COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03 Sustainable Energy Solutions
 *
- GenAI Usage Disclosure:
- Tool Used: Gemini
- Prompt Used: "Convert my jobs.html to PHP format, while making it consistent with our team requirements."
 */

$page_title = "Jobs";
$page_description = "Current digital roles at Solstice Community Energy, a fictional renewable energy company.";
$page_author = "Bach Gia Huy - Group 03 (Webdev67)";
$body_class = "page-jobs";
$page_css = ""; 

require_once "settings.php";
require_once "functions.inc";
$conn = db_connect($host, $user, $pwd, $sql_db);

include "header.inc";
include "nav.inc";
?>

<main id="main">
  <div class="container page-section">
    <header class="jobs-header">
      <h1>Open roles</h1>
      <p class="jobs-intro">
        Join our renewable energy digital team to help build community-owned solar microgrids, real-time telemetry platforms, and utility-scale battery storage across Australia.
      </p>
    </header>

    <div class="jobs-layout">
      
      <div class="jobs-main">
        <?php if (!$conn) { ?>
          <p class="db-notice">Job listings are not available right now. Please try again later.</p>
        <?php } else { 
          $job_query = "SELECT * FROM jobs ORDER BY job_ref ASC";
          $job_result = mysqli_query($conn, $job_query);

          if ($job_result && mysqli_num_rows($job_result) > 0) {
              while ($job = mysqli_fetch_assoc($job_result)) {
                  $ref = htmlspecialchars($job['job_ref']);
                  $title = htmlspecialchars($job['title']);
                  $location = htmlspecialchars($job['location']);
                  $salary_min = number_format((float)$job['salary_min']);
                  $salary_max = number_format((float)$job['salary_max']);
                  $super_rate = htmlspecialchars($job['super_rate']);
                  $reports_to = htmlspecialchars($job['reports_to']);
                  $overview = nl2br(htmlspecialchars($job['overview']));
          ?>
          <!-- Dynamic Job Card -->
          <section class="job-card" id="job-<?php echo $ref; ?>" aria-labelledby="title-<?php echo $ref; ?>">
            <div class="job-card-header">
              <h2 id="title-<?php echo $ref; ?>"><?php echo $title; ?></h2>
              <span class="job-ref" title="5-Character Job Reference Number"><?php echo $ref; ?></span>
            </div>
            <ul class="job-meta">
              <li><strong>Reference:</strong> <?php echo $ref; ?></li>
              <li><strong>Location:</strong> <?php echo $location; ?></li>
              <li><strong>Salary:</strong> A$<?php echo $salary_min; ?> - <?php echo $salary_max; ?> + <?php echo $super_rate; ?>% super annually</li>
              <li><strong>Reports to:</strong> <?php echo $reports_to; ?></li>
            </ul>

            <h3>Role Overview</h3>
            <p><?php echo $overview; ?></p>

            <h3>Key Responsibilities</h3>
            <ol>
              <?php
              $resp_stmt = mysqli_prepare($conn, "SELECT item_text FROM job_responsibilities WHERE job_ref = ? ORDER BY sort_order ASC");
              
              if ($resp_stmt) {
                  mysqli_stmt_bind_param($resp_stmt, "s", $job['job_ref']);
                  mysqli_stmt_execute($resp_stmt);
                  $resp_result = mysqli_stmt_get_result($resp_stmt);

                  while ($resp = mysqli_fetch_assoc($resp_result)) {
                      echo "<li>" . htmlspecialchars($resp['item_text']) . "</li>\n";
                  }
                  mysqli_stmt_close($resp_stmt);
              } else {
                  echo "<li><em>Responsibilities currently unavailable.</em></li>\n";
              }
              ?>
            </ol>

            <h3>Essential &amp; Preferable Requirements</h3>
            <ul>
              <?php
              $req_stmt = mysqli_prepare($conn, "SELECT req_type, item_text FROM job_requirements WHERE job_ref = ? ORDER BY req_type ASC, item_id ASC");
              
              if ($req_stmt) {
                  mysqli_stmt_bind_param($req_stmt, "s", $job['job_ref']);
                  mysqli_stmt_execute($req_stmt);
                  $req_result = mysqli_stmt_get_result($req_stmt);

                  while ($req = mysqli_fetch_assoc($req_result)) {
                      $type = htmlspecialchars($req['req_type']);
                      $text = htmlspecialchars($req['item_text']);
                      echo "<li><strong>" . $type . ":</strong> " . $text . "</li>\n";
                  }
                  mysqli_stmt_close($req_stmt);
              } else {
                  echo "<li><em>Requirements currently unavailable.</em></li>\n";
              }
              ?>
            </ul>

            <div class="job-actions">
              <a href="apply.php?ref=<?php echo urlencode($job['job_ref']); ?>" class="button" aria-label="Apply for <?php echo $title; ?>, reference <?php echo $ref; ?>">
                Apply for role <?php echo $ref; ?>
              </a>
            </div>
          </section>
          <?php
              }
          } else {
              echo "<p>There are currently no open roles available. Please check back soon.</p>";
          }
          mysqli_close($conn);
        }
        ?>

        <!-- Acknowledgment of Country -->
        <section class="country-ack" aria-labelledby="ack-heading">
          <h2 id="ack-heading" class="country-heading">Acknowledgment of Country</h2>
          <p>
            Solstice Community Energy acknowledges the Traditional Custodians of Country throughout Australia and their continuing connection to land, sky, and waters. Because our work harnesses sunlight and renewable wind directly from the natural environment, we recognise Aboriginal and Torres Strait Islander peoples as Australia’s first engineers and enduring caretakers of Country. We deeply respect this sacred connection and are committed to developing community-led clean energy in sustainable harmony with the land, skies, and waterways. We pay our respects to Elders past and present, and warmly encourage applications from Aboriginal and Torres Strait Islander peoples.
          </p>
        </section>
      </div>
        
      <!-- Sidebar -->
      <aside class="jobs-sidebar" aria-label="Application process and benefits">
        <h2>How to Apply</h2>
        <p>Follow these steps to submit your Expression of Interest:</p>
        <ol>
          <li>Note the <strong>5-character reference code</strong> of your chosen role (e.g., <code>SCE01</code>).</li>
          <li>Proceed to the <a href="apply.php">Apply</a> page.</li>
          <li>Complete the application form with your reference code and technical skills.</li>
        </ol>

        <h3>Benefits when joining Solstice</h3>
        <ul>
          <li>9-day fortnight for digital and grid engineering teams</li>
          <li>$1,500 annual clean-energy learning and certificate budget</li>
          <li>Hybrid work flexibility across Victoria</li>
          <li>Paid cultural, ceremonial, and community volunteer leave</li>
        </ul>
      </aside>
    </div>
  </div>
</main>

<?php include("footer.inc"); ?>