<?php
// login.php - Staff login for manage.php (Part 2)
// Author: Vu Duc Thai An
// GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "create login.php"

session_start();

require_once "functions.inc";
require_once "settings.php";

$errors   = [];      // list of messages to show the visitor
$username = "";      // remembered so the input box isn't emptied after a mistake.
$login_ok = false;


// Each page request runs this whole file from the top and all variables reset every time.
// A GET (opening/reloading the page) just shows the empty form.
// A POST (pressing "Log in") means the form was submitted, so we check it here.
// 'If server request method == post' block checks the data sent from the form.
// Input errors are checked and if any error happens, an error message is appended to $errors[]
// and the HTML block below print it out.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // functions.inc's clean_input function is used to sanitises text typed by the user.
  // It does 3 things, in order:
  //   1. trim()              - removes spaces/newlines at both ends (like .strip() in Python)
  //   2. stripslashes()      - removes backslashes, e.g. O\'Brien -> O'Brien
  //   3. htmlspecialchars()  - converts < > & " ' into safe HTML codes
  //                            (e.g. <script> -> &lt;script&gt;), which helps
  //                            prevent XSS (cross-site scripting) attacks.
  // The password is NOT cleaned, because changing it would break password_verify().

  $username = clean_input($_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";

  if ($username == "") {
    $errors[] = "Please enter your username.";
  }

  if ($password == "") {
    $errors[] = "Please enter your password.";
  }


  if (count($errors) == 0) {

    $conn = db_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
      $errors[] = "Login is unavailable right now. Please try again later.";
    } else {

      // Use prepare statement here to prevent harmful code injection in the user's input.
      // Use "?" as the placeholder for the SQL query instead of using the user's input because
      // they might put in a harmful code that hack the database.

      $stmt = mysqli_prepare($conn, "SELECT user_id, password_hash FROM users WHERE username = ?");
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);

      if ($row && password_verify($password, $row["password_hash"])) {
        $login_ok = true;
      } else {
        $errors[] = "Incorrect username or password.";
      }

      mysqli_stmt_close($stmt);
      // close the prepared statements.

      mysqli_close($conn);
      // close the database connection.

      if ($login_ok == true) {

        // regenerate new session ID after login to avoid session hijacking.

        session_regenerate_id(true);

        // !! SESSION LOGIN VARIABLE !!
        $_SESSION["username"] = $username;

        // Redirect the browser to manage.php.
        header("Location: manage.php");

        // Stop the code from running after the redirect.
        exit(); 


      }

    }

  }

}


$page_title       = "Staff Login";
$page_description = "Staff login for the Solstice Community Energy EOI manager.";
$page_author      = "Vu Duc Thai An";
$body_class       = "page-login";
include "header.inc";
include "nav.inc";
?>



  <main id="main">


    <div class="container page-section">


      <h1>Staff Login</h1>


    
      <?php if (count($errors) > 0) { ?>
        <div class="form-message" role="alert">
          <ul>
            <!-- loop through each error messages and print them out -->
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
              <li><?php echo e($errors[$i]); ?></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>

      <form method="post" action="login.php" novalidate>
        <p>
          <label for="username">Username</label>
          <input type="text" id="username" name="username" value="<?php echo e($username); ?>">
        </p>
        <p>
          <label for="password">Password</label>
          <input type="password" id="password" name="password">
        </p>
        <p>
          <input type="submit" value="Log in">
        </p>
      </form>


    </div>


  </main>

<?php include "footer.inc"; ?>