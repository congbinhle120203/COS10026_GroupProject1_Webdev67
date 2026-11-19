-- ==========================================================================
-- webdev67_db.sql - group database for COS10026 Project Part 2 (Webdev67)
--
-- HOW TO IMPORT: XAMPP -> start Apache and MySQL -> http://localhost/phpmyadmin
-- -> tab "Import" -> choose this file -> Go. (Or paste it into the SQL tab.)
-- Running it again resets only the tables in this file.
--
-- SECTIONS (each member adds their own tables in their section)
--   1. Database                                   (Binh)
--   2. Home page tables: company_stats, facilities, faqs   (Binh)
--   3. jobs table - core fields from the Part 1 jobs page  (Binh, owner: Huy)
--   4. eoi table          -> Duy  (process_eoi.php must also create it in code)
--   5. users table        -> manage.php / login owner
--   6. about table        -> An
--
-- Before submitting: export the whole database from phpMyAdmin and replace
-- this file, so the marker gets every table and row.
--
-- GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Home page and jobs tables"
-- ==========================================================================


-- 1. DATABASE ---------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS webdev67_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE webdev67_db;


-- 2. HOME PAGE TABLES (index.php) -------------------------------------------

-- Figures shown in the "About Our Mission" stat boxes
DROP TABLE IF EXISTS company_stats;
CREATE TABLE company_stats (
  stat_id    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  stat_value VARCHAR(20)  NOT NULL,          -- text, e.g. "2,400+" or "24.8 MW"
  stat_label VARCHAR(50)  NOT NULL,
  sort_order TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (stat_id)
) ENGINE=InnoDB;

INSERT INTO company_stats (stat_value, stat_label, sort_order) VALUES
  ('2,400+',  'Member-Owners',      1),
  ('5,900+',  'Homes Powered',      3),
  ('2035',    'Net Zero Target',    4);
-- "Installed Capacity" is not stored here: index.php works it out with
-- SUM(capacity_mw) from the facilities table, so it can never be out of date.

-- Facilities table on the home page. capacity_mw is a number so SQL can add it up.
DROP TABLE IF EXISTS facilities;
CREATE TABLE facilities (
  facility_id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  state         VARCHAR(30)  NOT NULL,
  facility_name VARCHAR(60)  NOT NULL,
  technology    VARCHAR(40)  NOT NULL,
  capacity_mw   DECIMAL(6,1) NOT NULL,       -- power, e.g. 12.5
  storage_mwh   DECIMAL(6,1) NULL,           -- energy stored, batteries only
  PRIMARY KEY (facility_id)
) ENGINE=InnoDB;

INSERT INTO facilities (state, facility_name, technology, capacity_mw, storage_mwh) VALUES
  ('Victoria',        'Riverside Solar Farm',      'Solar PV',        12.5, NULL),
  ('Victoria',        'Hilltop Community Battery', 'Battery Storage',  5.0, 10.0),
  ('New South Wales', 'Valley Rooftop Program',    'Rooftop Solar',    4.2, NULL),
  ('New South Wales', 'Coastal Microgrid',         'Solar & Battery',  3.1, NULL);

-- Frequently asked questions on the home page
DROP TABLE IF EXISTS faqs;
CREATE TABLE faqs (
  faq_id     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  question   VARCHAR(150) NOT NULL,
  answer     TEXT         NOT NULL,
  sort_order TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (faq_id)
) ENGINE=InnoDB;

INSERT INTO faqs (question, answer, sort_order) VALUES
  ('What experience do I need?',
   'Each role on the Jobs page lists essential and preferable requirements, including years of experience. If you meet the essentials, we encourage you to apply.', 1),
  ('Where will I work?',
   'Our teams are based in Hawthorn (Melbourne) and Bendigo, with hybrid options so you can split your week between the office and home.', 2),
  ('Can I apply for more than one role?',
   'You can. Submit one application form for each job reference number.', 3),
  ('What happens after I apply?',
   'You receive an EOI number straight away. Our HR team reviews every application and moves it from New to Current when you are shortlisted.', 4);


-- 3. JOBS TABLE (core fields) -----------------------------------------------
-- Used by index.php (featured roles) and search.php. Owner of jobs.php (Huy)
-- can add columns and the responsibilities / requirements tables.
DROP TABLE IF EXISTS jobs;
CREATE TABLE jobs (
  job_ref     CHAR(5)       NOT NULL,        -- 5-character reference, e.g. SCE01
  title       VARCHAR(100)  NOT NULL,
  location    VARCHAR(100)  NOT NULL,
  salary_min  INT UNSIGNED  NOT NULL,        -- yearly, AUD
  salary_max  INT UNSIGNED  NOT NULL,
  super_rate  DECIMAL(4,1)  NOT NULL DEFAULT 10.5,
  reports_to  VARCHAR(100)  NOT NULL,
  summary     VARCHAR(255)  NOT NULL,        -- one-line preview for cards
  overview    TEXT          NOT NULL,        -- "Role Overview" paragraph
  is_featured BOOLEAN       NOT NULL DEFAULT FALSE,
  posted_date DATE          NOT NULL,
  PRIMARY KEY (job_ref)
) ENGINE=InnoDB;

INSERT INTO jobs (job_ref, title, location, salary_min, salary_max, super_rate, reports_to, summary, overview, is_featured, posted_date) VALUES
  ('SCE01', 'Full-Stack Energy Data Developer', 'Melbourne, Bendigo, Vic (Hybrid)',
   84000, 106400, 10.5, 'Lead Software Architect',
   'Build accessible portals and live dashboards that help community members follow their solar power.',
   'Design and maintain web applications and real-time telemetry dashboards that empower local households and energy co-ops to monitor solar generation, battery state-of-charge, and wholesale tariff optimisation.',
   TRUE, '2026-10-20'),
  ('SCE02', 'Grid Integration & SCADA Systems Analyst', 'Melbourne, Vic (Hybrid)',
   92000, 115000, 10.5, 'Head of Grid & Digital Operations',
   'Connect and monitor community batteries so regional networks stay reliable and secure.',
   'Lead the digital integration, SCADA telemetry configuration, and cybersecurity compliance of 5MWh-20MWh community battery energy storage systems (BESS) across regional distribution networks.',
   TRUE, '2026-10-20');


-- 4. EOI TABLE      -> Duy (apply.php / process_eoi.php)
-- 5. USERS TABLE    -> manage.php and login owner (store password_hash() values, never plain text)
-- 6. ABOUT TABLE    -> An (about.php)
