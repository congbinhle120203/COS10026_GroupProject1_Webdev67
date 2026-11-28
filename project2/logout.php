<?php
// logout.php - Ends the staff session (Part 2)
// Author: Vu Duc Thai An
// GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Create a simple logout.php"

// open the current session to end it
session_start();          

// empty all stored session data
$_SESSION = [];   

// delete the session on the server
session_destroy();

// send the visitor back to the login page
header("Location: login.php");

// stop the php code after the redirect
exit();