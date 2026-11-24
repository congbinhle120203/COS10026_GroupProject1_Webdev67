<?php
// i. Block direct access if not POST or required field is missing
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
}

$required_fields = [
    'job_reference', 'first_name', 'last_name', 'date_of_birth',
    'street_address', 'suburb_town', 'postcode', 'email', 'phone_numbers'
];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        header("Location: apply.php");
        exit();
    }
}

// ii. Clean every field with clean_input()
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

$job_ref        = clean_input($_POST['job_reference']);
$first_name     = clean_input($_POST['first_name']);
$last_name      = clean_input($_POST['last_name']);
$date_of_birth  = clean_input($_POST['date_of_birth']);
$gender         = isset($_POST['gender']) ? clean_input($_POST['gender']) : "";
$street_address = clean_input($_POST['street_address']);
$suburb_town    = clean_input($_POST['suburb_town']);
$state          = isset($_POST['state']) ? clean_input($_POST['state']) : "";
$postcode       = clean_input($_POST['postcode']);
$email          = clean_input($_POST['email']);
$phone          = clean_input($_POST['phone_numbers']);
$other_skills   = isset($_POST['other_skills']) ? clean_input($_POST['other_skills']) : "";

$skills_list = [];
if (isset($_POST['skills']) && is_array($_POST['skills'])) {
    foreach ($_POST['skills'] as $s) {
        $skills_list[] = clean_input($s);
    }
}
$skills = implode(", ", $skills_list);

require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// iii. Check every Part 1 rule on the server
$errors = [];

if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) {
    $errors[] = "Job Reference must be exactly 5 alphanumeric characters.";
} else {
    $stmt_job = mysqli_prepare($conn, "SELECT job_ref FROM jobs WHERE job_ref = ?");
    mysqli_stmt_bind_param($stmt_job, "s", $job_ref);
    mysqli_stmt_execute($stmt_job);
    mysqli_stmt_store_result($stmt_job);
    if (mysqli_stmt_num_rows($stmt_job) === 0) {
        $errors[] = "Job Reference does not exist in jobs.";
    }
    mysqli_stmt_close($stmt_job);
}

if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) {
    $errors[] = "First Name must be 1 to 20 alphabetical characters.";
}

if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
    $errors[] = "Last Name must be 1 to 20 alphabetical characters.";
}

if (!preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $date_of_birth, $m) || !checkdate((int)$m[2], (int)$m[1], (int)$m[3])) {
    $errors[] = "Date of Birth must be a valid date in dd/mm/yyyy format.";
} else {
    $age = (new DateTime())->diff(DateTime::createFromFormat('d/m/Y', $date_of_birth))->y;
    if ($age < 15 || $age > 80) {
        $errors[] = "Age must be between 15 and 80.";
    }
}

if (!in_array($gender, ['male', 'female', 'other'], true)) {
    $errors[] = "Gender is required.";
}

if (!preg_match("/^[A-Za-z0-9\s,\.\-\/]{1,40}$/", $street_address)) {
    $errors[] = "Street Address must be 1 to 40 valid characters.";
}

if (!preg_match("/^[A-Za-z0-9\s,\.\-\/]{1,40}$/", $suburb_town)) {
    $errors[] = "Suburb/Town must be 1 to 40 valid characters.";
}

$state_postcodes = [
    'vic' => ['3', '8'],
    'nsw' => ['1', '2'],
    'qld' => ['4', '9'],
    'nt'  => ['0'],
    'wa'  => ['6'],
    'sa'  => ['5'],
    'tas' => ['7'],
    'act' => ['0']
];

if (!isset($state_postcodes[$state])) {
    $errors[] = "State is required.";
} elseif (!preg_match("/^\d{4}$/", $postcode) || !in_array($postcode[0], $state_postcodes[$state], true)) {
    $errors[] = "Postcode must be 4 digits and match the selected state.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email address.";
}

if (!preg_match("/^\d{8,12}$/", $phone)) {
    $errors[] = "Phone Numbers must be 8 to 12 digits.";
}

