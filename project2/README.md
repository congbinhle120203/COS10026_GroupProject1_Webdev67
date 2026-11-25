# Solstice Community Energy Careers: Project Part 2

**COS10026 Applied Web Project, Part 2 (Server-Side & Dynamic Web Programming) | Group Webdev67 | Industry G03**

Part 2 turns the static Part 1 website into a dynamic PHP and MySQL website. Part 1 is kept unchanged in [`../project1/`](../project1/); Part 2 lives in this `project2/` folder, as the brief requires.

> The company, people, job listings and figures are **fictional** and were created for a university assessment.

---

## 1. Run it on your computer (XAMPP)

1. Copy the `project2` folder into `C:\xampp\htdocs\` (Windows) or `/Applications/XAMPP/htdocs/` (Mac).
2. Open the XAMPP Control Panel and **Start Apache and MySQL**.
3. Go to `http://localhost/phpmyadmin` → **Import** → choose `project2/database/webdev67_db.sql` → **Go**.
   This creates the database `webdev67_db` and its tables.
4. Open `http://localhost/project2/index.php`.

The connection details are in `settings.php` (`localhost`, user `root`, **no password**, database `webdev67_db`).

---

## 2. Folder structure

```
project2/
├── index.php        Home page: statistics, facilities, featured roles, FAQ from MySQL  (Binh)
├── search.php       Job search for the home page and jobs page search bars           (Binh)
├── jobs.php         Job descriptions from the jobs tables                             (Huy)
├── apply.php        Application form, posts to process_eoi.php                       (Duy)
├── process_eoi.php  Server-side validation, saves an EOI, shows the EOI number       (Duy)
├── about.php        Team members and contributions from the about table              (An)
├── header.inc       <head> and opening <body>, set by page variables
├── nav.inc          Logo, company name and menu (current page marked automatically)
├── footer.inc       Footer with Jira and GitHub links
├── functions.inc    Shared helpers: db_connect, db_fetch_rows, clean_input, e
├── settings.php     Database connection settings
├── .htaccess        Blocks direct access to .inc, .sql and .md files; no folder listing
├── TODO.md          Remaining Part 2 tasks
├── database/
│   └── webdev67_db.sql   Creates the database, tables and starting data
├── images/          Images used in page content
└── styles/
    ├── style.css    One shared stylesheet, split into owned sections
    └── images/      Images used by the CSS
```

Still to be added: `manage.php` and the login page. See [`TODO.md`](TODO.md).

---

## 3. How a page is built

Every page sets a few variables, then includes the shared template:

```php
<?php
$page_title = "Home";            // used in <title>
$body_class = "page-home";       // scopes the page's CSS section
include "header.inc";            // <!DOCTYPE html> ... <body>
include "nav.inc";               // site header and menu
?>
  <main id="main"> ... page content ... </main>
<?php include "footer.inc"; ?>   // footer, </body></html>
```

Pages that use the database also add:

```php
require_once "settings.php";     // $host, $user, $pwd, $sql_db
require_once "functions.inc";
$conn = db_connect($host, $user, $pwd, $sql_db);   // false if MySQL is down
```

---

## 4. Database tables

| Table | Used by | Owner |
|---|---|---|
| `company_stats` | Home page statistics | Binh |
| `facilities` | Home page facilities table (total from `SUM(capacity_mw)`) | Binh |
| `faqs` | Home page FAQ | Binh |
| `jobs` | Home page featured roles, `search.php`, `jobs.php` | core fields Binh, page Huy |
| `job_responsibilities`, `job_requirements` | `jobs.php`, `search.php` (one job has many items, `job_ref` foreign key) | Huy |
| `eoi` | `process_eoi.php` (creates it if missing), `manage.php` | Duy |
| `users` | Login for `manage.php` | manage owner |
| `about` | `about.php` member contributions | An |

To add or change a table, edit `database/webdev67_db.sql` by hand in your own section, import it to test, and commit only that file. Do not paste a phpMyAdmin export over it. Before submitting, the team leader exports the whole database once.

---

## 5. Security in Binh's pages

| Risk | What we do |
|---|---|
| SQL injection | `search.php` uses a prepared statement (`mysqli_prepare` with `?`); sort order comes from an allow-list |
| HTML/JavaScript injection | Every database value and user input is printed through `e()` (`htmlspecialchars`) |
| Bad input | The search term is checked on the server only: trimmed, slashes removed, length 2 to 50, allowed characters |
| Fatal errors showing file paths | `db_connect()` turns off mysqli exceptions so pages show a friendly message when MySQL is down |
| Template source code | `.htaccess` refuses direct requests for `.inc`, `.sql` and `.md` files and turns off folder listing (tested on Apache: 403) |
| Broken Vietnamese text | The SQL file starts with `SET NAMES utf8mb4` so it imports correctly from phpMyAdmin or the command line |

---

## 6. Team

| Member | Student ID | Part 2 work |
|---|---|---|
| **Le Cong Binh** (Team Leader) | 106419738 | Folder structure, shared includes, `settings.php`, `functions.inc`, database script, `index.php`, `search.php` |
| **Bach Gia Huy** | 106395993 | `jobs.php`, `job_responsibilities` and `job_requirements` tables |
| **Pham Duc Duy** | 106684662 | `apply.php`, `process_eoi.php` and the `eoi` table |
| **Vu Duc Thai An** | 106909446 | `about.php` and the `about` table |

Project board (Jira, key `RWP`, label `part2`): https://defesttosiro.atlassian.net/jira/software/projects/RWP/boards/2/backlog

---

## 7. Acknowledgements

- GenAI: some Part 2 code was assisted by Claude (Anthropic), then reviewed and tested by the team. Those files say so in their top comment.
- Company concept inspired by public solar and energy company websites. No text or images were copied.
