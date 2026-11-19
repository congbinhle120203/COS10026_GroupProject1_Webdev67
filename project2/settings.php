<?php
/*
  settings.php - database connection settings for the whole site
  COS10026 Applied Web Project Part 2 - Group Webdev67 (G03)
  Author: Le Cong Binh (106419738)

  Every page that talks to MySQL uses: require_once "settings.php";
  The brief says no database password, so $pwd stays empty (XAMPP default).
  Keep this file to connection settings only.

  GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Check settings.php"
*/
$host   = "localhost";    // MySQL runs on this machine (XAMPP)
$user   = "root";         // default XAMPP MySQL user
$pwd    = "";             // no password, as the brief requires
$sql_db = "webdev67_db";  // our group database (see database/webdev67_db.sql)
?>
