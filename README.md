# Solstice Community Energy — Careers Website

> **COS10026 Applied Web Project Part 1 | Group name: Webdev67**
> **Topic:** G03: Sustainable Energy Solutions Company  
> **Fictional Company Name:** Solstice Community Energy
> **Tech Stack:** Semantic HTML5 & CSS3 Only *(Strictly NO JavaScript, NO Bootstrap or external frameworks)*

---

## 1. Project Overview & Quick Links

This repository contains the static recruitment website for **Solstice Community Energy**, a fictional Australian community-owned renewable energy provider. The project is created for **COS10026-Web Technology Project (Swinburne Vietnam) (Applied Web Project Part 1)**.

This repository contains the static recruitment website for **Solstice Community Energy**, a fictional Australian community-owned renewable energy provider. The project is created for **COS10026-Web Technology Project (Swinburne Vietnam) (Applied Web Project Part 1)**.

- **GitHub Repository:** [congbinhle120203/COS10026_GroupProject1_Webdev67](https://github.com/congbinhle120203/COS10026_GroupProject1_Webdev67.git)
- **Jira Project Board & Backlog:** [Jira Board RWP (Sprint 1 & 2)](https://defesttosiro.atlassian.net/jira/software/projects/RWP/boards/2/backlog)
- **Live Deployment (GitHub Pages):** [GitHub Pages Preview](https://congbinhle120203.github.io/COS10026_GroupProject1_Webdev67/)

---

## 2. Team Members & Page Ownership

Each team member owns **one HTML page from start to finish** (both HTML structure and their page-specific CSS section in `styles.css`) and is responsible for defending their code during the **Week 6 individual tutorial interview**.

| Name | Student ID | Swinburne Email | Role | Assigned Page & CSS | Class Schedule |
|---|---|---|---|---|---|
| **Lê Công Bình** | `106419738` | `106419738@student.swin.edu.au` | **Team Leader** | `index.html` + `styles.css` Shared Base & Section 5 | Thursday 07:00 AM |
| **Bạch Gia Huy** | `106395993` | `106395993@student.swin.edu.au` | Core Developer | `jobs.html` + `styles.css` Section 6 | Thursday 07:00 AM |
| **Phạm Đức Duy** | `106684662` | `106684662@student.swin.edu.au` | Core Developer | `apply.html` + `styles.css` Section 7 | Thursday 07:00 AM |
| **Vũ Đức Thái Ân** | `106909446` | `106909446@student.swin.edu.au` | Core Developer | `about.html` + `styles.css` Section 8 | Thursday 07:00 AM |

---

## 3. Directory Structure

```text
COS10026_GroupProject1_Webdev67/
├── index.html                   # Home page (Owner: Binh)
├── jobs.html                    # Job descriptions & sidebar (Owner: Huy)
├── apply.html                   # Application form & validation (Owner: Duy)
├── about.html                   # Team profile & fun facts table (Owner: An)
├── styles.css                   # Single shared stylesheet (Strictly partitioned)
├── images/
│   ├── logo.svg                 # SVG brand logo (original artwork)
│   ├── hero.svg                 # SVG hero graphic for home page
│   └── team.jpg                 # Group photo for about.html (< 300KB)
├── Webdev67_GroupAgreement.docx # Formal team agreement
└── README.md                    # Project documentation & team guidelines
```

---

## 4. Approved Design System (Eucalyptus Theme)

The team has officially selected the **Eucalyptus Theme** (Sustainable Energy / Earth Palette) to reflect clean energy, solar, and native Australian bushland colors. All text and background combinations meet or exceed **WCAG AA contrast guidelines (4.5:1 minimum)**.

| Token Name | Hex Code | Preview | Purpose / Usage |
|---|---|---|---|
| `--bg` | `#eef4ee` | `rgb(238, 244, 238)` | Global page background (Soft sage) |
| `--surface` | `#fbfdfb` | `rgb(251, 253, 251)` | Card, section, and input backgrounds |
| `--ink` | `#1b2a23` | `rgb(27, 42, 35)` | Primary text & headings (Deep forest ink) |
| `--ink-muted` | `#455a4e` | `rgb(69, 90, 78)` | Secondary text, captions, and metadata |
| `--primary` | `#2c5e4f` | `rgb(44, 94, 79)` | Brand primary (Buttons, active states, borders) |
| `--on-primary`| `#ffffff` | `rgb(255, 255, 255)` | Pure white text on primary buttons/headers |
| `--accent` | `#e0a526` | `rgb(224, 165, 38)` | Solar amber accent (Focus borders, highlights) |
| `--line` | `#c5d4c8` | `rgb(197, 212, 200)`| Borders and divider lines |
| `--link` | `#1f5a8a` | `rgb(31, 90, 138)` | Underlined hyperlinks |
| `--focus` | `#9a3412` | `rgb(154, 52, 18)` | High-contrast keyboard focus outline (WCAG 2.4.7) |

---

## 5. Collaboration Rules & Conflict Prevention

Because our entire team shares a single `styles.css` file, every member **must strictly follow these 4 rules** to avoid breaking each other's pages and prevent merge conflicts:

### Rule 1: Always Scope Your CSS to Your Page Body Class
Never style raw HTML tags (`h1`, `h2`, `p`, `table`, `form`, `input`, `aside`, `section`) directly inside your section! Always prefix your selectors with your page's body class:
- **`jobs.html` (Huy):** use `.page-jobs ...` (e.g., `.page-jobs .job-card`, `.page-jobs aside.jobs-sidebar`)
- **`apply.html` (Duy):** use `.page-apply ...` (e.g., `.page-apply .form-grid`, `.page-apply fieldset`)
- **`about.html` (Ân):** use `.page-about ...` (e.g., `.page-about .facts-table`, `.page-about .student-id`)
- **`index.html` (Bình):** uses `.page-home ...`

### Rule 2: Edit ONLY in Your Assigned Section of `styles.css`
The `styles.css` file is partitioned into 10 numbered sections with clear ASCII banners:
- **Section 1–4:** Shared design tokens, reset, layout helpers, header & footer. **(Managed by Binh; discuss on Discord before changing)**.
- **Section 5:** Page Home (`index.html`) — **Binh**
- **Section 6:** Page Jobs (`jobs.html`) — **Huy**
- **Section 7:** Page Apply (`apply.html`) — **Duy**
- **Section 8:** Page About (`about.html`) — **Ân**
- **Section 9:** Responsive Media Queries — Add responsive rules under your page's sub-heading.
- **Section 10:** User preferences (`prefers-reduced-motion` and `@media print`).

### Rule 3: Git Branching Workflow
**NEVER commit directly to the `main` branch!** Follow this routine:
```bash
# 1. Pull latest changes from main
git checkout main
git pull origin main

# 2. Create your own feature branch
git checkout -b feat/jobs-huy      # For Huy
git checkout -b feat/apply-duy     # For Duy
git checkout -b feat/about-an      # For An

# 3. Work on your HTML file and your section in styles.css
# 4. Commit and push your branch
git add .
git commit -m "feat(jobs): add job description cards and floated aside"
git push -u origin feat/jobs-huy

# 5. Open a Pull Request on GitHub for Binh to review and merge into main.
```

### Rule 4: Mandatory Assessment Styling Elements
Every member's page must contain:
1. **At least ONE embedded CSS rule** inside `<style>` in the `<head>` of their HTML page.
2. **At least ONE inline CSS rule** via `style="..."` on an element in their HTML page.
3. All other styling must reside in `styles.css`.

---

## 6. Page Requirements & Assessment Checklist

### A. `index.html` (Owner: Lê Công Bình) — [Status: Completed]
- [x] Semantic HTML5 layout (`<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`).
- [x] Consistent site navigation menu with `aria-current="page"`.
- [x] Hero banner with pure CSS solar-cell gradient background graphic (no image file needed).
- [x] Search form with accessible `<label>` and submit button.
- [x] Complex data table with merged cells (`rowspan="2"` on State and `colspan="3"` on Total).
- [x] Responsive layout (stacked hero on tablet/phone, scrollable table).
- [x] Accessible skip link and footer links (Jira, GitHub, Email).

### B. `jobs.html` (Owner: Bạch Gia Huy) — [Status: Ready for Implementation]
- [ ] At least **two realistic job descriptions** in the digital/tech department of a renewable energy firm (e.g. Front-End Web Developer, Smart Energy Data Analyst).
- [ ] Job reference numbers: **exactly 5 alphanumeric characters** (e.g. `WD204`, `EA108`).
- [ ] Headings structured with at least **2 heading levels** (`<h2>` for job titles, `<h3>` for subsections).
- [ ] Multiple `<section>` elements (one per job posting).
- [ ] At least **one ordered list (`<ol>`)** (e.g. for numbered application steps or ranked responsibilities).
- [ ] At least **one unordered list (`<ul>`)** (e.g. for essential/preferable skills).
- [ ] **Assessment requirement:** at least one `<aside>` **floated right**, **25% width**, with **margin, padding, and border** (scaffolding provided in `styles.css` Section 6: `aside.jobs-sidebar`).
- [ ] **Aboriginal and Torres Strait Islander statement:** A respectful acknowledgement of Traditional Custodians with a brief explanation of why it is included.

### C. `apply.html` (Owner: Phạm Đức Duy) — [Status: Ready for Implementation]
- [ ] Application `<form>` with `method="POST"` and `action="https://mercury.swin.edu.au/it000000/formtest.php"`.
- [ ] Form layout structured using **CSS Grid or Flexbox** (scaffolding provided in Section 7: `.form-grid`, `.choice-group`).
- [ ] Every input element must have an explicitly linked `<label for="...">`.
- [ ] All 12 required fields with strict HTML5 validation:
  1. **Job reference number:** Required, `pattern="[A-Za-z0-9]{5}"`, exactly 5 alphanumeric chars.
  2. **First name:** Required, `type="text"`, `maxlength="20"`, alpha characters only.
  3. **Last name:** Required, `type="text"`, `maxlength="20"`, alpha characters only.
  4. **Date of birth:** Required, `type="text"` with pattern `\d{2}/\d{2}/\d{4}` or standard date input.
  5. **Gender:** Required, `<fieldset>` with `<legend>` containing radio buttons (Male, Female, Non-binary, Prefer not to say).
  6. **Street address:** Required, `type="text"`, `maxlength="40"`.
  7. **Suburb/town:** Required, `type="text"`, `maxlength="40"`.
  8. **State:** Required, `<select>` dropdown with options: `VIC`, `NSW`, `QLD`, `NT`, `WA`, `SA`, `TAS`, `ACT`.
  9. **Postcode:** Required, `type="text"`, `pattern="\d{4}"`, exactly 4 digits.
  10. **Email address:** Required, `type="email"`.
  11. **Phone number:** Required, `type="tel"`, `pattern="[0-9 ]{8,12}"`, 8 to 12 digits.
  12. **Skills:** Required checkboxes (e.g. HTML5/CSS3, Git/GitHub, Responsive Design).
  13. **Other skills:** `<textarea>`, optional (the ONLY non-required field).
- [ ] Submit button (`type="submit"`) and Reset button (`type="reset"`).

### D. `about.html` (Owner: Vũ Đức Thái Ân) — [Status: Ready for Implementation]
- [ ] Group name (`Webdev67`) and class day/time (`Thursday 07:00 AM`) structured as a **nested list** (`<ul>` inside `<ul>`).
- [ ] Member contributions and quotes formatted as a **definition list (`<dl>`)**.
- [ ] A personal quote from each member in their **first language** (Vietnamese) with `lang="vi"` plus an **English translation**.
- [ ] **Group photo** (all 4 members together, NOT individual selfies), file size **under 300KB**, in `<figure>` with `<figcaption>`.
- [ ] **Assessment requirement:** figure must have a visible border (scaffolding provided in Section 8: `figure.team-figure`).
- [ ] **Assessment requirement:** styled student IDs (scaffolding provided in Section 8: `.student-id`).
- [ ] **Fun facts table** with `<caption>` (e.g. Member name, Dream Job, Coding Snack, Hometown).
- [ ] **Assessment requirement:** table styled with **HEX colours** (`#2c5e4f`, `#fbfdfb`, `#c5d4c8`, `#eef4ee`) and an interactive **hover effect** (`tbody tr:hover`).

---

## 7. Quality Assurance & Validator Checks

Before requesting a PR review or submission, each member must run their page through the following test suite:
1. **HTML5 Validation:** Check each HTML page at the [W3C Nu HTML Checker](https://www.google.com/search?q=https%3A%2F%2Fvalidator.w3.org%2Fnu%2F). Must have 0 errors!
2. **CSS3 Validation:** Check `styles.css` at the [W3C CSS Validation Service](https://www.google.com/search?q=https%3A%2F%2Fjigsaw.w3.org%2Fcss-validator%2F). Must have 0 errors!
3. **Accessibility Audit:**
   - Install the **WAVE Evaluation Tool** extension to ensure no contrast errors or missing form labels.
   - Run Google Chrome **Lighthouse** audit (Aim for 95+ in Accessibility and SEO).
4. **Form Submission Test:** Submit `apply.html` to confirm it lands successfully on Swinburne's `formtest.php` handler.

---

## 8. Credits & Acknowledgements

- **Industry Inspirations:** Visual layout ideas and renewable energy career structures were inspired by public industry websites (BlueTop Solar, TSE, SolarAccess, First Solar). No text, logos, photos, or confidential assets were copied. All SVG graphics, copy, and code implementations are original student work.
- **Academic References:** All external references, research materials, and formal declarations will be reviewed, agreed upon by the group, and finalized according to APA 7 guidelines prior to final project submission.
