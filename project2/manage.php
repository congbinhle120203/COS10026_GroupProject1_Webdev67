<?php
/*
- File: manage.php
- Author: Bach Gia Huy & Duy (manage.php co-owners)
- Jira Task: RWP-161 (Huy), RWP-162(Duy), RWP-163(Huy)
- COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03 Sustainable Energy Solutions
 *
- GenAI Usage Disclosure:
- Tool Used: Gemini
- Prompt Used: "Give me the full code for manage.php listing EOIs with filters and allow-list sorting."
 */


session_start();
// 1. SESSION CHECK (Security)
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page_title = "Manage EOIs | Solstice Community Energy";
$body_class = "page-manage";

require_once "settings.php";
require_once "functions.inc";
$conn = db_connect($host, $user, $pwd, $sql_db);

if (!function_exists('e')) {
    function e($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

include "header.inc";
include "nav.inc";
?>

<main id="main">
  <div class="container page-section">
    <header class="jobs-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
      <div>
        <h1 style="margin-bottom: 0.5rem;">Manage Expressions of Interest</h1>
        <p class="jobs-intro" style="margin: 0;">Review, filter, and manage incoming applications.</p>
      </div>
      <a href="logout.php" class="button" style="background-color: #dc3545; color: white;">Log Out</a>
    </header>

    <!-- STEP 2: FILTER FORM WILL GO HERE -->

    <!-- STEP 3 & 4: DATABASE & TABLE WILL GO HERE -->
    
    <!-- DUY'S SECTION (RWP-162) -->
    <section class="manage-actions" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--line);">
        <h2>Manager Actions</h2>
        <p><em>(Duy - RWP-162: Your forms to delete EOIs and change EOI statuses go here)</em></p>
    </section>
  </div>
</main>

<?php 
if ($conn) mysqli_close($conn);
include "footer.inc"; 
?>
