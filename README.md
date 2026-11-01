# Solstice Community Energy: Careers Website

**COS10026 Applied Web Project, Part 1 | Group Webdev67 | Industry G03: Sustainable Energy Solutions Company**

A static recruitment website for **Solstice Community Energy**, a fictional member-owned energy co-operative in Victoria, Australia. Visitors can learn about the company, read two job descriptions, and submit a job application form. The site uses **HTML5 and CSS3 only** (no JavaScript, no Bootstrap or other frameworks).

> The company, people, job listings, statistics and facilities on this site are **fictional**. They were created for a university assessment.

---

## 1. Quick links

| Item | Link |
|---|---|
| Live site (GitHub Pages) | https://congbinhle120203.github.io/COS10026_GroupProject1_Webdev67/ |
| Source code (GitHub) | https://github.com/congbinhle120203/COS10026_GroupProject1_Webdev67 |
| Project board (Jira, key `RWP`) | https://defesttosiro.atlassian.net/jira/software/projects/RWP/boards/2/backlog |

---

## 2. Pages

| Page | File | What it contains |
|---|---|---|
| Home | `index.html` | Logo, company name, slogan, description and hero image; search box with a button; statistics; facilities table with merged cells (`rowspan`, `colspan`); featured roles; hiring steps; FAQ; footer with Jira, GitHub, live site and email links. |
| Jobs | `jobs.html` | Two job descriptions (reference numbers `SCE01` and `SCE02`) with salary, reporting line, responsibilities and essential and preferable requirements; an ordered and an unordered list; a floated `<aside>`; an Acknowledgment of Country. |
| Apply | `apply.html` | Application form that posts to the unit's `formtest.php` with HTML5 validation (patterns, `required`, input types), labels on every field, a `<fieldset>` and `<legend>` for gender, and a Grid and Flexbox layout. |
| About | `about.html` | Group name and class time (nested list), member contributions and quotes (definition list), group photo in a `<figure>` with caption, and a fun facts table. |

All four pages share the same header, navigation, footer and colour theme through one stylesheet, `styles.css`.

### Aboriginal and Torres Strait Islander element

The **Acknowledgment of Country** on `jobs.html` is part of the page content, not decoration. It acknowledges the Traditional Custodians, explains why a company that harnesses sunlight and wind recognises Aboriginal and Torres Strait Islander peoples as Australia's first engineers and caretakers of Country, commits to community-led clean energy, and encourages applications from Aboriginal and Torres Strait Islander peoples. A shorter acknowledgment with a link to the full statement appears in the footer of the Home and About pages.

---

## 3. Team and contributions

| Member | Student ID | Page owned | Other responsibilities |
|---|---|---|---|
| **Le Cong Binh** (Team Leader) | 106419738 | `index.html` | Shared base of `styles.css`, Jira board, GitHub repository and GitHub Pages deployment, final check and the Canvas ZIP submission |
| **Bach Gia Huy** | 106395993 | `jobs.html` | Aboriginal and Torres Strait Islander inclusion statement, Canvas discussion questions |
| **Pham Duc Duy** | 106684662 | `apply.html` | Testing every form validation rule |
| **Vu Duc Thai An** | 106909446 | `about.html` | Collecting each member's first-language quote with its English translation |

Each member wrote the HTML and the CSS section for their own page and can explain it in the individual interview.

---

## 4. Project structure

```
COS10026_GroupProject1_Webdev67/
├── index.html        Home page
├── jobs.html         Job descriptions
├── apply.html        Application form
├── about.html        About the team
├── styles.css        One shared stylesheet (see section 5)
├── README.md         This file
└── images/
    ├── logo.svg      Company logo
    ├── hero.svg      Home page illustration
    └── group-photo.jpg   Team photo (under 300 KB)
```

---

## 5. How the CSS is organised

`styles.css` is one external stylesheet split into numbered sections, with a contents list and comments at the top.

| Section | Contents | Owner |
|---|---|---|
| 1 | Colour variables and theme ("Eucalyptus") | Binh |
| 2 | Base styles (typography, links, focus outline, placeholder colour) | Binh |
| 3 | Layout container and skip link | Binh |
| 4 | Header, navigation, buttons and footer | Binh |
| 5 | Home page rules, scoped by `.page-home` | Binh |
| 6 | Jobs page rules, scoped by `.page-jobs` | Huy |
| 7 | Apply page rules, scoped by `.page-apply` | Duy |
| 8 | About page rules, scoped by `.page-about` | An |
| 9 | Responsive media queries | Shared |
| 10 | Print styles | Binh |

How we avoided style clashes:

- Every page has a body class (`page-home`, `page-jobs`, `page-apply`, `page-about`) and every page-specific rule starts with it.
- Colours come from CSS custom properties (variables) in section 1, so the theme can change in one place.
- Each page has one small **embedded** `<style>` rule and one **inline** `style=""` example, as the brief requires. All other styling is in the external stylesheet.

---

## 6. Accessibility, responsiveness and validation

- **Semantic HTML5:** `header`, `nav`, `main`, `section`, `aside`, `figure`, `footer`, a logical heading order, and `lang` attributes (including `lang="vi"` for Vietnamese quotes).
- **Keyboard and screen readers:** a "Skip to main content" link on every page, `aria-label` and `aria-current` on the navigation, `aria-labelledby` on sections, visible focus outlines, labels on every form control, and hidden "(opens in a new tab)" text on external links.
- **Contrast:** text and interface colours were checked against WCAG 2.1 AA (4.5:1 for text). The default placeholder colour was darkened to meet this.
- **Responsive:** layouts adapt at tablet (768 px) and phone (390 px) widths using Flexbox, Grid and media queries, with no horizontal scrolling. Wide tables scroll inside their own container.
- **Motion:** animations and transitions are switched off for visitors who prefer reduced motion.
- **Print:** a print stylesheet hides navigation and buttons and prints link addresses.

Checks run on the final code:

| Check | Result |
|---|---|
| W3C Nu HTML Checker (all four pages) | 0 errors, 0 warnings |
| W3C CSS Validator (`styles.css`, CSS level 3 + SVG) | 0 errors |
| axe-core accessibility scan (WCAG 2.0/2.1 A and AA, best practice) at 1280, 768 and 390 px | 0 violations on every page |
| Horizontal overflow at 1280, 768 and 390 px | None |

---

## 7. Project management and workflow

- **Jira:** the `RWP` project holds epics, user stories and tasks across two sprints. The tutor has access to the board.
- **GitHub:** work is done on feature branches and merged into `main` by pull request. Each commit message starts with its Jira key (for example `RWP-121 Add live site link ...`) so every commit can be traced to a task.
- **Deployment:** GitHub Pages serves the site from the `main` branch.

### Run it locally

No build step is needed. Download or clone the repository and open `index.html` in a browser.

```
git clone https://github.com/congbinhle120203/COS10026_GroupProject1_Webdev67.git
```

---

## 8. Credits and generative AI statement

### Inspiration and references

The company concept and page ideas were inspired by public solar and energy company websites. No text, images or code were copied from them.

- BlueTop Solar. (n.d.). *BlueTop Solar*. https://bluetopsolar.com
- First Solar. (n.d.). *First Solar*. https://www.firstsolar.com
- SolarAccess. (n.d.). *SolarAccess*. https://solaraccess.com/en
- TSE. (n.d.). *TSE*. https://tse.energy
- Buffer. (n.d.). *About Buffer*. https://buffer.com/about (inspiration for the structure of the About page)

Technical references: W3C. (n.d.). *HTML Living Standard and CSS specifications*; Mozilla Developer Network. (n.d.). *MDN Web Docs*. https://developer.mozilla.org; Swinburne University of Technology. (2026). *COS10026 Applied Web Project guidelines* [Unit material].

Images: the logo and hero illustration (`logo.svg`, `hero.svg`) are original SVG graphics created for this project. The group photo (`group-photo.jpg`) shows the four team members with our tutor and was taken by a classmate.

### Use of generative AI

We used **Claude** (Anthropic's large language model) as an assistant on this project, and we are responsible for everything we submit. We used it for:

- planning: drafting and checking the Group Agreement roles, and generating the Jira backlog (epics, stories and tasks);
- the project skeleton, the colour theme and the structure and comments of `styles.css`;
- reviewing our pages against the assessment brief, accessibility checks (contrast, labels, headings, keyboard use), HTML and CSS validation, and responsive-layout checks.

Every member reviewed, edited and tested the AI-assisted code for their own page, and each HTML file states its author and acknowledgements in a comment at the top.