<?php
/*
  jobs.php - Solstice Community Energy Careers (fictional company)
  COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03
  Page owner: Bach Gia Huy

  Converted from Part 1 jobs.html by Le Cong Binh (RWP-140) so the whole
  site runs from index.php: the head, header/nav and footer now come from
  header.inc, nav.inc and footer.inc, and links point to .php pages.
  The page content below is unchanged from Part 1; the database features
  for this page are the page owner's Part 2 work.
  See ../jobs.html (Part 1, repository root) for the original acknowledgements.
*/
$page_title       = "Jobs";
$page_description = "Current digital roles at Solstice Community Energy, a fictional renewable energy company.";
$page_author      = "Gia Huy Bach - Group 03 (Webdev67)";
$body_class       = "page-jobs";
$page_css         = "    .page-jobs .jobs-intro {
      max-width: 55rem;
      font-size: 1.15rem;
    }";

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
          <!-- Job 1 -->
          <section class="job-card" aria-labelledby="job-1-title">
            <div class="job-card-header">
              <h2 id="job-1-title">Full-Stack Energy Data Developer</h2>
              <span class="job-ref" title="5-Character Job Reference Number">SCE01</span>
            </div>
            <ul class="job-meta">
              <li><strong>Reference:</strong> SCE01</li>
              <li><strong>Location:</strong> Melbourne, Bendigo, Vic (Hybrid)</li>
              <li><strong>Salary:</strong> A$84,000 - 106,400 + 10.5% super annually</li>
              <li><strong>Reports to:</strong> Lead Software Architect</li>
            </ul>

            <h3>Role Overview</h3>
            <p>
              Design and maintain web applications and real-time telemetry dashboards that empower local households and energy co-ops to monitor solar generation, battery state-of-charge, and wholesale tariff optimisation.
            </p>

            <h3>Key Responsibilities</h3>
            <ol>
              <li>Build responsive, <strong>WCAG-accessible customer portals</strong> for community microgrid members.</li>
              <li>Ingest <strong>smart-meter and inverter MQTT telemetry</strong> streams into cloud time-series databases.</li>
              <li>Collaborate with <strong>grid engineers</strong> to visualise community battery dispatch schedules.</li>
              <li>Maintain automated <strong>CI/CD pipelines, API documentation, and unit test coverage.</strong></li>
            </ol>

            <h3>Essential &amp; Preferable Requirements</h3>
            <ul>
              <li><strong>Essential:</strong> Bachelor's degree in Computer Science, Software Engineering, or equivalent industry experience.</li>
              <li><strong>Essential:</strong> 2+ years of experience with semantic HTML5, modern CSS, TypeScript/JavaScript, and Python or Node.js.</li>
              <li><strong>Essential:</strong> Demonstrated experience building accessible web interfaces (WCAG 2.1 AA).</li>
              <li><strong>Preferable:</strong> Familiarity with Australian National Electricity Market (NEM) data or AEMO APIs.</li>
              <li><strong>Preferable:</strong> Experience with time-series databases (InfluxDB, TimescaleDB) or Docker.</li>
            </ul>
            <div class="job-actions">
              <a href="apply.php" class="button" aria-label="Apply for Full-Stack Energy Data Developer, reference SCE01">Apply for role SCE01</a>
            </div>
          </section>

          <!-- Job 2 -->
          <section class="job-card" aria-labelledby="job-2-title">
            <div class="job-card-header">
              <h2 id="job-2-title">Grid Integration &amp; SCADA Systems Analyst</h2>
              <span class="job-ref" title="5-Character Job Reference Number">SCE02</span>
            </div>
            <ul class="job-meta">
              <li><strong>Reference:</strong> SCE02</li>
              <li><strong>Location:</strong> Melbourne, Vic (Hybrid)</li>
              <li><strong>Salary:</strong> A$92,000 - 115,000 + 10.5% super annually</li>
              <li><strong>Reports to:</strong> Head of Grid &amp; Digital Operations</li>
            </ul>

            <h3>Role Overview</h3>
            <p>
              Lead the digital integration, SCADA telemetry configuration, and cybersecurity compliance of 5MWh–20MWh community battery energy storage systems (BESS) across regional distribution networks.
            </p>

            <h3>Key Responsibilities</h3>
            <ol>
              <li>Configure and test <strong>DNP3, Modbus, and IEC 61850</strong> communications between site controllers and control room SCADA.</li>
              <li>Monitor <strong>real-time inverter and battery management system (BMS)</strong> diagnostics to maximise system uptime.</li>
              <li>Automate regulatory reporting and grid performance validation using <strong>Python scripts.</strong></li>
              <li>Coordinate secure <strong>remote-access protocols</strong> and <strong>network segmentation</strong> with the cloud infrastructure team.</li>
            </ol>

            <h3>Essential &amp; Preferable Requirements</h3>
            <ul>
              <li><strong>Essential:</strong> Degree in Information Technology, Electrical Engineering, or Mechatronics.</li>
              <li><strong>Essential:</strong> 3+ years of experience with industrial telemetry protocols, SCADA systems, or IoT edge gateways.</li>
              <li><strong>Essential:</strong> Strong proficiency in Linux networking, firewalls, and Python data scripting.</li>
              <li><strong>Preferable:</strong> Prior experience commissioning solar farms or utility/community battery storage (BESS).</li>
              <li><strong>Preferable:</strong> Working knowledge of the Australian Energy Sector Cyber Security Framework (AESCSF).</li>
            </ul>
            <div class="job-actions">
              <a href="apply.php" class="button" aria-label="Apply for Grid Integration and SCADA Systems Analyst, reference SCE02">Apply for role SCE02</a>
            </div>
          </section>

          <!-- Acknowledgment of Country -->
          <section class="country-ack" aria-labelledby="ack-heading" style="background-color: var(--surface);">
            <h2 id="ack-heading" class="country-heading">Acknowledgment of Country</h2>
            <p>
              Solstice Community Energy acknowledges the Traditional Custodians of Country throughout Australia and their continuing connection to land, sky, and waters. Because our work harnesses sunlight and renewable wind directly from the natural environment, we recognise Aboriginal and Torres Strait Islander peoples as Australia’s first engineers and enduring caretakers of Country. We deeply respect this sacred connection and are committed to developing community-led clean energy in sustainable harmony with the land, skies, and waterways. We pay our respects to Elders past and present, and warmly encourage applications from Aboriginal and Torres Strait Islander peoples.
            </p>
          </section>
        </div>
          

        <!-- Sidebar (placed second in DOM, styled to appear to the right using CSS) -->
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

<?php include "footer.inc"; ?>
