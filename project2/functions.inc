<?php
/*
  functions.inc - small helper functions shared by every page
  COS10026 Applied Web Project Part 2 - Group Webdev67 (G03)
  Author: Le Cong Binh (106419738)

  Include it near the top of a page:   require_once "functions.inc";

  GenAI acknowledgement: drafted with Claude (Anthropic, Claude Opus 5.5),
  then reviewed and tested by the author.
  Prompt: "Write shared PHP helpers for connecting to MySQL without a fatal
  error, reading rows, and sanitising user input as the Part 2 brief asks."
*/

// Open a MySQL connection. Returns the connection, or false if it fails.
// PHP 8 normally throws a fatal error when MySQL is down; turning reporting
// off lets each page check "if (!$conn)" and show a friendly message instead.
function db_connect($host, $user, $pwd, $sql_db)
{
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
    }
    return $conn;
}

// Run a SELECT that has no user input and return every row as an array.
// Returns null when there is no connection or the query fails, so the page
// can tell "database problem" apart from "no rows".
function db_fetch_rows($conn, $sql)
{
    if (!$conn) {
        return null;
    }
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return null;
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;          // add this row to the end of the array
    }
    mysqli_free_result($result);
    return $rows;
}

// Clean one value typed by a user: the three steps named in the brief.
function clean_input($data)
{
    $data = trim($data);              // remove spaces at both ends
    $data = stripslashes($data);      // remove backslashes
    $data = htmlspecialchars($data);  // turn < > & " into harmless text
    return $data;
}

// Escape text before printing it into HTML (stops HTML/JavaScript injection).
function e($text)
{
    return htmlspecialchars((string) $text, ENT_QUOTES, "UTF-8");
}

// 12.5 -> "12.5", 5.0 -> "5" (drop a trailing .0 for display)
function format_number($number)
{
    return rtrim(rtrim(number_format((float) $number, 1), "0"), ".");
}
?>
