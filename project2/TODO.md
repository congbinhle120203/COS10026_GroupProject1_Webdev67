# Project Part 2: what each member still needs to do

**Interview:** Thursday 26/11 (week 11). **Due:** Canvas, 6/12 at 23:59.

## Status (25/11)

| Part | Owner | Status |
|---|---|---|
| Shared includes, settings, functions, database script, `index.php`, `search.php` | Binh | Done |
| `jobs.php` + jobs tables | Huy | Done, fixes below |
| `apply.php` + `process_eoi.php` + `eoi` | Duy | Done, fixes below |
| `about.php` + `about` table | An | Done |
| `manage.php` + login + `users` table | **Not assigned** | **Not started (15 marks)** |
| Presentation slides | Everyone | Not started |

## Fixes found in the review (25/11)

**Huy, `jobs.php`**

- [ ] Use the shared template: set `$page_title`, `$page_description`, `$page_author`, `$body_class = "page-jobs"` and `$page_css`, then `include "header.inc"; include "nav.inc";`. Remove your own `<head>` and `<header>`: the page now has two site headers inside each other (2 validator errors).
- [ ] Connect with `db_connect()` from `functions.inc` and show a `.db-notice` if it fails. Now the page shows a PHP Fatal error with file paths when MySQL is stopped.
- [ ] Replace `RWP-xxx` in the top comment with your Jira keys.

**Duy, `apply.php` and `process_eoi.php`**

- [ ] Use `require_once "functions.inc"` and its `db_connect()` and `clean_input()` instead of your own copies (same Fatal error problem when MySQL is stopped).
- [ ] Fill the job reference from the link: `value="<?php echo htmlspecialchars($_GET['ref'] ?? ''); ?>"` (the Apply buttons on jobs and search use `apply.php?ref=SCE01`).
- [ ] Add your `CREATE TABLE IF NOT EXISTS eoi` to section 4 of `database/webdev67_db.sql`.
- [ ] Create Jira tasks for the work you did and use the keys in your next commits.

---

## For everyone

**1. Convert your page** from `../project1/<page>.html` (Part 1) to `project2/<page>.php`:

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
- **Changing the database file:** `git pull`, edit `database/webdev67_db.sql` **by hand** in your own section, import it in phpMyAdmin to test, then commit only that file. Do not export from phpMyAdmin and paste over the file: it removes other members' tables or adds test rows. The team leader exports the whole database once before submitting.

**3. Team rules (lessons from Part 1)**

- [ ] Work on your own branch (`feat/p2-<page>-<name>`) and merge with a pull request.
- [ ] Every commit message starts with its Jira key (`RWP-xxx ...`).
- [ ] If you used GenAI, write it in the top comment of the file, **with the prompt** (unit rule).
- [ ] Talk on Discord so there is evidence for the individual report.
- [ ] Be able to explain every line of your code at the interview (up to 30 marks).

---

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
