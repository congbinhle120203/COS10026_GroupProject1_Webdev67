<?php
/*
  nav.inc - shared site header: logo, company name and main navigation
  COS10026 Applied Web Project Part 2 - Group Webdev67 (G03)
  Author: Le Cong Binh (106419738)

  The menu is built from one array, so adding a page means adding one line.
  The link of the page being viewed gets aria-current="page", which the CSS
  highlights and screen readers announce as "current page".

  GenAI acknowledgement: drafted with Claude (Anthropic, Claude Opus 5.5),
  then reviewed and tested by the author.
  Prompt: "Build the navigation from a PHP array and mark the current page
  automatically instead of hard-coding aria-current on every page."
*/

// file name => link text
$nav_items = [
    "index.php" => "Home",
    "jobs.php"  => "Jobs",
    "apply.php" => "Apply",
    "about.php" => "About",
];

// basename() keeps only the file name, e.g. "/project2/index.php" -> "index.php"
$current_page = basename($_SERVER["SCRIPT_NAME"]);
?>
  <!-- Header and navigation bar -->
  <header class="site-header">
    <div class="container header-inner">

      <!-- Logo and company name; the name is real text, so the logo needs no alt text -->
      <a class="brand" href="index.php">
        <img src="images/logo.svg" width="44" height="44" alt="">
        <span>Solstice Community Energy</span>
      </a>

      <nav class="main-nav" aria-label="Main">
        <ul>
<?php
foreach ($nav_items as $file => $label) {
    $current = ($file === $current_page) ? ' aria-current="page"' : "";
    echo "          <li><a href=\"$file\"$current>$label</a></li>\n";
}
?>
        </ul>
      </nav>

    </div>
  </header>
