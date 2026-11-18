# Project Part 2: what each member still needs to do

The shared base is ready on `main`: folder structure, `header.inc`, `nav.inc`, `footer.inc`, `settings.php`, `functions.inc`, `database/webdev67_db.sql`, `index.php` and `search.php`. See `README.md` for how to run it.

**Interview:** Thursday 26/11 (week 11). **Due:** Canvas, 6/12 at 23:59.

Each member converts **their own** Part 1 page to PHP and builds its database features. Until a page exists, its menu link shows "Not Found"; that is expected.

---

## For everyone

**1. Convert your page** from `../<page>.html` (Part 1, repository root) to `project2/<page>.php`:

```php
<?php
$page_title       = "Jobs";            // text before " | Solstice Community Energy Careers"
$page_description = "...";             // your meta description
$page_author      = "Your Name";
$body_class       = "page-jobs";       // keeps your CSS section working
$page_css         = "    .page-jobs .jobs-intro { max-width: 55rem; }";   // your embedded CSS, if any
include "header.inc";
include "nav.inc";
?>
  <main id="main">
    ... your Part 1 <main> content, with links changed from .html to .php ...
  </main>
<?php include "footer.inc"; ?>
```

Delete your own `<head>`, `<header>` and `<footer>`: the include files print them.

**2. Database pages** start with:

```php
require_once "settings.php";     // $host, $user, $pwd, $sql_db
require_once "functions.inc";    // db_connect(), db_fetch_rows(), clean_input(), e()
$conn = db_connect($host, $user, $pwd, $sql_db);   // false if MySQL is down
if (!$conn) { echo '<p class="db-notice">...</p>'; }
```

- Any SQL that contains user input: **prepared statement** (`mysqli_prepare`, `?`, `mysqli_stmt_bind_param`). See `search.php` for a worked example.
- Print every value from the database or the user with `e()` (`htmlspecialchars`).
- Put your `CREATE TABLE` and starting rows in your section of `database/webdev67_db.sql`.
- Messages: use the shared CSS classes `.db-notice` and `.form-message`.

**3. Team rules (lessons from Part 1)**

- [ ] Work on your own branch (`feat/p2-<page>-<name>`) and merge with a pull request.
- [ ] Every commit message starts with its Jira key (`RWP-xxx ...`).
- [ ] If you used GenAI, write it in the top comment of the file, **with the prompt** (unit rule).
- [ ] Talk on Discord so there is evidence for the individual report.
- [ ] Be able to explain every line of your code at the interview (up to 30 marks).

---

## Huy: `jobs.php` and the jobs table (12 marks)

- [ ] Convert `jobs.html` to `jobs.php` (step 1 above).
- [ ] Load **everything** on the page from MySQL. The `jobs` table already has the core fields (`job_ref`, `title`, `location`, `salary_min`, `salary_max`, `super_rate`, `reports_to`, `summary`, `overview`). Add the lists, for example:
  - `job_responsibilities (item_id PK, job_ref FK -> jobs, sort_order, item_text)`
  - `job_requirements (item_id PK, job_ref FK -> jobs, req_type ENUM('Essential','Preferable'), item_text)`
- [ ] Give each job card `id="job-SCE01"` (the home page and `search.php` link to `jobs.php#job-SCE01`).
- [ ] Add a search bar on the jobs page. Simplest: `<form action="search.php" method="get">` with an input `name="q"`.
- [ ] Apply buttons link to `apply.php?ref=SCE01`.
- [ ] Optional: add a third job in the database to show the page is dynamic.

## Duy: `apply.php`, `process_eoi.php` and the `eoi` table (8 + 12 marks)

- [ ] Convert `apply.html` to `apply.php`. Change the form to `action="process_eoi.php" method="post"`.
- [ ] **Turn off all browser validation** (brief rule): add `novalidate` to `<form>`, remove `required` and `pattern`, use `type="text"` instead of `email`/`tel`. All checks happen in PHP.
- [ ] Optional: fill the job reference from `apply.php?ref=SCE01`.
- [ ] `eoi` table: one column per form field (`job_ref`, `first_name`, `last_name`, `date_of_birth`, `gender`, `street_address`, `suburb_town`, `state`, `postcode`, `email`, `phone`, skills, `other_skills`), `EOInumber INT AUTO_INCREMENT PRIMARY KEY`, and `status ENUM('New','Current','Final') DEFAULT 'New'`.
- [ ] `process_eoi.php`:
  1. Block direct access: if the request is not POST or a required field is missing, `header("Location: apply.php"); exit();`
  2. Clean every field with `clean_input()`.
  3. Check every Part 1 rule on the server, including postcode vs state and that the job reference exists in `jobs`.
  4. `CREATE TABLE IF NOT EXISTS eoi (...)` in the code (brief rule).
  5. `INSERT` with a prepared statement.
  6. Show a confirmation with the number from `mysqli_insert_id($conn)`; on errors, list each one with a link back.

## An: `about.php` and the about table (part of 10 marks)

- [ ] Convert `about.html` to `about.php`.
- [ ] `about` table: `member_id PK, full_name, student_id, role, part1_work, part2_work, quote, quote_language, quote_translation, sort_order`.
- [ ] Load the member contributions from the table. The brief asks for what each member did in **Part 1 and Part 2**.
- [ ] Update text such as "Owns index.html" to the `.php` names.

## Not assigned yet: `manage.php` + login (15 marks, the biggest item)

- [ ] `users` table with `username` (UNIQUE) and `password_hash` (store `password_hash()` values, never plain text). Marker account: `admin` / `admin`.
- [ ] `login.php`: prepared `SELECT`, `password_verify()`, then `session_regenerate_id(true)`. Lock the account for a few minutes after 3 wrong tries (HD). `logout.php` ends the session.
- [ ] `manage.php` checks the session first and sends visitors to the login page. It must let the manager:
  - list all EOIs
  - list by job reference
  - list by first name, last name or both
  - delete all EOIs for a job reference (POST, with a confirm step)
  - change the status of an EOI
  - choose the sort field (use an allow-list, like `$sort_options` in `search.php`)
- [ ] When the login page exists, add a "Staff login" link to `footer.inc`.

---

## Before submitting (whole team)

- [ ] Export the whole database from phpMyAdmin into `database/webdev67_db.sql`.
- [ ] Zip the `project2` folder as `Webdev67_part2.zip`, unzip it into `htdocs` on another computer and check it runs from `index.php`.
- [ ] Presentation slides (week 12): your part, a live demo, what you learned.
- [ ] Peer and self evaluation on Canvas.
