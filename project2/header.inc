<?php
/*
  header.inc - shared <head> and the opening of <body> for every page
  COS10026 Applied Web Project Part 2 - Group Webdev67 (G03)
  Author: Le Cong Binh (106419738)

  HOW TO USE (set these variables BEFORE the include line):
    $page_title       text before " | Solstice Community Energy Careers"
    $page_description content of the meta description
    $page_author      content of the meta author (page owner)
    $body_class       class on <body>, scopes the page CSS (e.g. "page-home")
    $page_css         optional embedded CSS for that page only
  Then: include "header.inc"; include "nav.inc";

  GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Shared page template"
*/

// The ?? operator uses the value on the right when the variable was not set
$page_title       = $page_title ?? "Home";
$page_description = $page_description ?? "Careers at Solstice Community Energy, a fictional renewable energy company.";
$page_author      = $page_author ?? "Group Webdev67";
$body_class       = $body_class ?? "";
$page_css         = $page_css ?? "";
?>
<!DOCTYPE html>
<html lang="en-AU">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($page_title); ?> | Solstice Community Energy Careers</title>
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta name="author" content="<?php echo htmlspecialchars($page_author); ?>">
  <meta name="theme-color" content="#2c5e4f">
  <link rel="icon" type="image/svg+xml" href="images/logo.svg">
  <link rel="stylesheet" href="styles/style.css">
<?php if ($page_css !== "") { ?>
  <!-- Embedded CSS for this page only -->
  <style>
<?php echo $page_css . "\n"; ?>
  </style>
<?php } ?>
</head>

<body class="<?php echo htmlspecialchars($body_class); ?>">

  <!-- Skip link for keyboard and screen reader users -->
  <a class="skip-link" href="#main">Skip to main content</a>
