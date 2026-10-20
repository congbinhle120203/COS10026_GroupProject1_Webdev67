# Solstice Community Energy — Careers Website

> **COS10026 Applied Web Project Part 1 | Group: Webdev67 (G03)**
> **Topic:** Sustainable Energy Solutions Company  
> **Tech Stack:** Semantic HTML5 & CSS3 Only (No JavaScript / Frameworks)

---

## 1. Quick Links
- **GitHub Repository:** [View Code](https://github.com/congbinhle120203/COS10026_GroupProject1_Webdev67.git)
- **Live Deployment:** [GitHub Pages Preview](https://congbinhle120203.github.io/COS10026_GroupProject1_Webdev67/)
- **Project Board:** [Jira Board](https://defesttosiro.atlassian.net/jira/software/projects/RWP/boards/2/backlog)

---

## 2. Team Members & Page Ownership

Each member owns one complete HTML page and their respective CSS section for the individual interview defense:

| Name | Student ID | Role | Assigned Page & CSS Section |
|---|---|---|---|
| **Lê Công Bình** (Leader) | `106419738` | Home & Shared Base | `index.html` + `styles.css` (Sections 1–5) |
| **Bạch Gia Huy** | `106395993` | Jobs Page | `jobs.html` + `styles.css` (Section 6) |
| **Phạm Đức Duy** | `106684662` | Apply Form | `apply.html` + `styles.css` (Section 7) |
| **Vũ Đức Thái Ân** | `106909446` | About Team | `about.html` + `styles.css` (Section 8) |

---

## 3. Project File Structure

COS10026_GroupProject1_Webdev67/
├── index.html       # Home page (Binh)
├── jobs.html        # Job listings & floated aside (Huy)
├── apply.html       # Application form & validation (Duy)
├── about.html       # Team profile, DL & table (An)
├── styles.css       # Single shared partitioned stylesheet
└── images/          # Logos, hero graphics, team photo

---

## 4. Team Workflow Rules
1. **CSS Scoping:** Always prefix your page-specific CSS rules with your body class (e.g., `.page-home`, `.page-jobs`, `.page-apply`, `.page-about`).
2. **Section Isolation:** Only edit inside your assigned section in `styles.css` to prevent merge conflicts.
3. **Git Branching:** Create feature branches (`feat/...`) and open Pull Requests to `main`. Never push blindly without testing.
4. **Assessment Requirements:** Every page includes at least one embedded `<style>` rule and one inline `style=""` attribute as required by the rubric.