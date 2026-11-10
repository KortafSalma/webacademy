# WebAcademy — Application Analysis Report

**Project:** `C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours`  
**Analysis date:** 2026-11-07  
**Scope:** product, content, architecture, data, UI/UX, accessibility, security, and delivery risks  
**Method:** full source inspection, runtime inspection with headless Chrome at 1440×900 and 390×844 (light and dark themes), axe-core 4.10.2 audits, SQLite inspection, API probing, and PHP linting  
**Constraint:** this report is the only deliverable; no application source file was modified.

> French UI strings are quoted as they appear in the application. “Darija” refers to the Moroccan Arabic written in Latin script in the current content (Arabizi-style), not to a standardized written Arabic variant.

---

## 1. Executive Summary

WebAcademy is a self-contained, interactive learning platform for web development. It combines a French/Darija curriculum, a lesson reader, graded exercises, quizzes, real PHP and SQL labs, an HTML/CSS preview lab, notes, bookmarks, progress tracking, a glossary, practical projects, and full-text search. It is implemented as a pure PHP backend with no framework and a vanilla JavaScript single-page frontend, with SQLite for both application data and the SQL sandbox.

The engineering foundation is real, not a mockup. The following flows were verified end-to-end during this analysis:

- dashboard rendering and responsive layout;
- lesson rendering for available chapters;
- PHP lab with real PHP CLI execution;
- SQL lab with real SQLite execution;
- HTML lab with iframe preview;
- quiz scoring and persistence (a 5/6 result was verified);
- exercise verification and persistence;
- notes, progress, projects, glossary, search, and theme switching;
- 390px layout with no horizontal page overflow;
- light and dark themes.

The dominant problem is **content completeness**. The manifest describes 58 chapters, but only **15 chapters load** (25.9%). The missing 43 chapters are concentrated in PHP (13 missing), SQL (13 missing), CSS (9 missing), HTML (3 missing), and Integration (5 missing). Worse, only **one chapter** (`html` chapter 1) has both an exercise file and a quiz file. Of the 15 loadable chapters, 14 have no exercise or quiz at all. Some loadable chapters are stubs or contain unfinished text: `content/css/c02.php` has one section and two blocks, no mistakes and no summary; `content/html/ex01.php` contains `TODO` placeholders in starter code; `content/html/qz01.php` contains garbled Darija; `content/projects/project1.php` has only two steps and a visible typo (“connects projets”).

The product is therefore best described as **a strong, working vertical slice of a course platform**, not yet a complete course. Its architecture and labs are ahead of its content.

The UI is visually coherent and responsive at the two tested widths, but it has measurable quality debt:

- axe-core reports **one critical accessible-name violation** and **five color-contrast findings** on the lesson and lab pages, all around CodeMirror and unavailable navigation links;
- the glossary concatenates the “Darija” label with the text (“DarijaAttribut howa…”);
- sticky topbar anchors hide section headings because there is no `scroll-margin-top`;
- the SQL lab says “Oracle : lecture seule — pas d’exécution”, which is contradictory: Oracle is not executed at all;
- the lesson page uses **21 distinct font sizes**, **9 border radii**, and **5 box shadows**; the dashboard uses 16 font sizes and 7 radii;
- the mobile page does not overflow horizontally, but CodeMirror internals do overflow inside the editor container.

There is also a **critical deployment security issue** in the current development setup. The static router returns any existing file under the project root, and the PHP built-in server serves it. During this analysis:

- `GET /data/app.sqlite` returned HTTP 200 (53,248 bytes);
- `GET /data/sql_sandbox.sqlite` returned HTTP 200 (40,960 bytes);
- `GET /test.php`, `/src/bootstrap.php`, and `/content/curriculum.php` returned HTTP 200 and were executed as PHP;
- `GET /index.php?devdump=1` returned environment diagnostics as JSON.

There is no authentication. If this application is exposed beyond localhost, anyone can download the databases, run PHP/SQL endpoints, modify notes and progress, and read the environment dump. This must be fixed before any LAN, school-server, or internet deployment.

### Readiness scorecard

| Dimension | Score | Rationale |
|---|---:|---|
| Architecture | 7/10 | Clean separation of bootstrap, content, repositories, API, and executors; easy to extend; no framework overhead. |
| Feature breadth | 6/10 | Many features are implemented, but exercise/quiz coverage and project depth are thin. |
| Content completeness | 2/10 | 15/58 chapters; 1/15 with exercise + quiz; stubs and TODOs. |
| UI craft | 6/10 | Strong shell and visual identity; token drift and small layout bugs. |
| Accessibility | 4/10 | Dashboard is clean; editor integration and disabled navigation fail automated checks. |
| Production readiness | 2/10 | No auth, exposed data/source, no hardened server configuration, no tests/CI. |
| **Overall as a course** | **3.5/10** | Cannot be used as a complete curriculum yet. |
| **Overall as a vertical slice** | **7/10** | Convincing demonstration of the concept and the hardest technical parts. |

### Top five actions

1. **Finish and QA the content before adding features.** Complete the 15 loadable chapters to the quality of `content/html/c01.php`, then add exercise and quiz files for every chapter. Do not count a chapter as “available” until it passes a content checklist.
2. **Fix the deployment exposure.** Move the document root to a `public/` directory (or add strict web-server deny rules), block `data/`, `src/`, `content/`, `views/`, and dotfiles, remove root test/probe files, and remove or guard `?devdump=1`.
3. **Fix the accessibility blockers.** Add an accessible name to the CodeMirror editor, correct contrast for comments/line numbers and unavailable links, and add `scroll-margin-top` for anchored sections.
4. **Enforce the design system.** Collapse the type scale, radii, and shadows to tokens; fix the glossary label; standardize icons; redesign the mobile lab around tabs.
5. **Add a content QA pipeline and a review loop.** A lint script for TODO/empty blocks/ellipsis, a native Darija review step, and a “review wrong answers” feature will improve quality more than another dashboard widget.

### What not to do yet

Do not add accounts, AI tutoring, leaderboards, certificates, or payment before the content is complete and the security exposure is fixed. Those features increase surface area and cost without solving the core product risk: a learner who opens chapter 4 of HTML currently finds no lesson.

---

## 2. Application Purpose and Target Audience

### 2.1 Purpose

WebAcademy teaches web development through a structured, bilingual course and hands-on practice. The curriculum covers:

- **HTML5:** document structure, text, links, images, lists, tables, forms, semantic HTML.
- **CSS3:** syntax, inclusion methods, selectors, box model, layout, responsive design, and advanced effects.
- **PHP:** procedural PHP, syntax, variables, control flow, functions, arrays, forms, sessions, files, and object-oriented basics.
- **SQL:** relational model, `SELECT`, filtering, joins, aggregation, subqueries, DDL/DML, and MySQL/Oracle differences.
- **Integration:** connecting PHP to SQL, building CRUD flows, authentication basics, and a complete project.

The pedagogical loop intended by the content schema is:

1. chapter objectives;
2. several lesson sections with explanations, definitions, syntax, examples, tips, warnings, and tables;
3. common mistakes;
4. a summary;
5. a three-level exercise with tests, hints, and a solution;
6. a quiz with explanations;
7. a lab or project to apply the concept.

The platform also provides a real code-execution environment, which is its main differentiator versus a static course site. PHP runs in an isolated CLI process; SQL runs against a persistent SQLite sandbox; HTML/CSS runs in a browser iframe. Oracle is honestly not executed because the client is not installed.

### 2.2 Target audience

The content and language point to **francophone Moroccan learners**, likely EMSI students or self-taught beginners. The audience can be split into three practical personas:

| Persona | Context | Needs | Current support |
|---|---|---|---|
| **Yassine, 20, EMSI student** | Follows a PHP/web module, prepares exams, studies on a laptop. | French technical vocabulary, Darija explanations, exercises close to exam style, code he can run. | Strong for HTML chapter 1; weak for PHP/SQL because most chapters are missing. |
| **Salma, 24, career switcher** | Self-taught, studies evenings, sometimes on a phone. | A clear path, small wins, projects, feedback, mobile reading. | Good shell and progress model; mobile lab is cramped; content gaps break the path. |
| **Mentor / teacher** | Wants to assign chapters or review progress. | Accounts, cohort view, authoring, export. | Not supported; content is edited as PHP files. |

The application is explicitly **single-user**. `Repos.php` states: “Un seul ‘étudiant’ : la plateforme est personnelle.” There is no `users` table, no login, no session ownership, and no per-user scoping. This is a legitimate design choice for a personal learning tool, but it rules out classroom deployment without architectural work.

### 2.3 Value proposition

- **Bilingual by design:** French is the technical reference; Darija is the explanation layer. This is rare and valuable for the target audience.
- **Real execution:** learners run PHP and SQL, not only read about them.
- **Honest about limits:** Oracle is not simulated; the UI states that it is unavailable. MySQL is executed only if a local server exists.
- **Local-first:** SQLite persistence, no account, no cloud dependency for data.
- **Integrated practice:** lessons, exercises, quizzes, labs, notes, glossary, and projects live in one shell.

### 2.4 Non-goals and current scope

The current code does not attempt to be:

- a multi-tenant LMS;
- a teacher authoring platform;
- a video course;
- a certification or payment product;
- an offline-first PWA;
- a full Oracle/MySQL cloud lab.

These are reasonable non-goals, but they should be explicit in the product brief so that future work does not accidentally assume them.

---

## 3. Actual Technology Stack

This section describes what is actually present in the repository, not what the folder name or marketing copy might suggest.

### 3.1 Stack summary

| Layer | Actual technology | Evidence / notes |
|---|---|---|
| Backend language | **PHP 8.3.14**, `declare(strict_types=1)` | Runtime probe; all backend files. |
| Backend framework | **None** | No Composer, no `composer.json`, no framework bootstrap. Custom autoloader in `src/Core/Autoloader.php`. |
| Web entry point | `index.php` | Serves the SPA shell and dispatches JSON API via `?api=…`. |
| Development server | PHP built-in server + `router.php` | Command used: `php -S 127.0.0.1:8088 router.php`. |
| Production server | **Unspecified** | Likely WAMP/XAMPP/Apache, but no virtual-host or `.htaccess` configuration is included. |
| App persistence | **SQLite** via PDO, `data/app.sqlite` | WAL mode, foreign keys enabled, schema created by `Database::migrate()`. |
| SQL sandbox | **SQLite** via PDO, `data/sql_sandbox.sqlite` | Persistent, resettable from the dataset definition. |
| Optional SQL engine | **MySQL** via PDO | Execution path exists; the local MySQL/WAMP server was not reachable during analysis. |
| Unavailable SQL engine | **Oracle** | No Oracle client installed; `SqlExecutor` returns a pedagogical “not available” response instead of simulating. |
| PHP execution | **PHP CLI** (`php -n`) in a temp directory | `PhpExecutor`: 6-second timeout, 64 KB output cap, 64 MB memory limit, `disable_functions`, `open_basedir`, `proc_terminate()`. No `eval()`. |
| Frontend | **Vanilla JavaScript**, IIFE modules on `window.WA` | `api.js`, `ui.js`, `editor.js`, `lesson.js`, `lab.js`, `app.js`. No React/Vue/Svelte, no bundler. |
| Routing | **Hash-based SPA router** | `#/dashboard`, `#/lesson/{module}/{n}`, `#/lab/{module}`, etc. |
| HTTP client | **Fetch API** | `assets/js/api.js`, same-origin credentials. |
| Code editor | **CodeMirror 5.65.18** from cdnjs | HTML, CSS, JS, PHP, SQL modes; fallback `<textarea>` if CodeMirror is unavailable. |
| Fonts | **Google Fonts CDN** | Inter (400–700), Space Grotesk (500–700), JetBrains Mono (400–500). |
| Styling | **Hand-written CSS** with custom properties | `assets/css/app.css`; dark/light themes; no preprocessor. |
| Content format | **PHP arrays** | `content/<module>/cNN.php`, `exNN.php`, `qzNN.php`; manifest `content/curriculum.php`. |
| Build tooling | **None** | No npm, no Vite/Webpack, no Sass, no minification, no asset fingerprinting. |
| Tests | **None committed** | Only temporary probe scripts in the project root; no PHPUnit, no browser test suite, no CI. |
| Version | `APP_VERSION = '1.0.0'` | `src/bootstrap.php`. |
| Authentication | **None** | No users, sessions, login, roles, or authorization. |
| Telemetry | **None** | No analytics, error reporting, or structured logs. |

### 3.2 Why the stack works for this project

- **No build step** means the app can be copied to a WAMP `www` folder and opened. This is appropriate for a school project and for a single developer.
- **PHP arrays as content** make chapters easy to author without a database or CMS. A chapter is a file; availability is file existence.
- **SQLite** removes configuration. The database is created automatically, and the sandbox can be reset.
- **Real CLI execution** is more credible than a simulated interpreter and avoids the security nightmare of `eval()`.
- **Vanilla JS** keeps the frontend small and transparent; there is no framework churn.

### 3.3 Stack constraints and hidden coupling

- **CDN dependency:** CodeMirror, its modes, and Google Fonts are loaded from external origins. If the school network blocks cdnjs or Google Fonts, the editor falls back to a textarea and typography changes. There is no local vendor copy, no Subresource Integrity (SRI), and no Content Security Policy.
- **No module system:** all JS files attach to a global `WA` object and are loaded in a fixed order in `views/shell.php`. A missing or reordered script breaks the app.
- **No API versioning:** endpoints are string-matched in `Api.php`; there is no `/v1/` or schema contract.
- **No database migrations:** `CREATE TABLE IF NOT EXISTS` creates missing tables but does not alter existing ones. Adding a column requires manual work.
- **Single-user assumptions are embedded** in repositories and API validation. Multi-user support is not a small change.
- **The built-in server is not a production server.** `router.php` is a development convenience, and its static-file rule is broad (see §11).
- **The folder name `PHP_FrameWorks` does not reflect the implementation.** There is no framework; this is plain PHP.

### 3.4 Browser and platform assumptions

- Modern browser with `fetch`, `URLSearchParams`, `matchMedia`, `localStorage`, CSS custom properties, CSS grid, and `<details>`.
- JavaScript is required; the shell includes a `<noscript>` message.
- The app was tested in headless Chrome 156 on Windows. Firefox, Safari, and real mobile browsers were not tested.
- The layout was verified at 1440×900 and 390×844; widths below 390 and tablet widths between 601 and 1019 were not exhaustively checked.

## 4. Existing Features and Their Status

Status legend:

- **Implemented** — works and was verified in the running application.
- **Partial** — works, but coverage, polish, or edge cases are incomplete.
- **Placeholder** — UI or schema exists, but the real behavior/content is missing.
- **Unavailable** — intentionally not supported; the app states this.
- **Not implemented** — no code path exists.

### 4.1 Feature matrix

| Feature | Status | What actually exists | Evidence / caveats |
|---|---|---|---|
| Dashboard | **Implemented** | Greeting, “continue” action, stat tiles, module progress, recent activity, quick links. | Verified at 1440 and 390; axe reports no violations. |
| Lesson reader | **Partial** | Objectives, sections, text/definition/syntax/example/tip/warning/table blocks, common mistakes, summary, bookmark, mark-done, previous/next. | Works for 15 chapters; 43 chapters are missing. Content quality varies. |
| Exercise engine | **Partial** | Three levels, instructions in French and Darija, starter code, tests (`html_contains`, `output_contains`, `sql_ok`, etc.), hints, solution, explanations, persistence. | Engine works, but only `content/html/ex01.php` exists. Levels 1 and 3 contain `TODO` starter code. |
| Quiz engine | **Partial** | Question types `mcq`, `predict`, `find-error`, `complete`, `multi`, `tf`, `fill`, `sql`; scoring; per-question explanations; “concepts to review”; persistence. | Engine works; only `content/html/qz01.php` exists. Q1 explanation contains garbled Darija. |
| PHP lab | **Implemented** | CodeMirror editor, run button, real PHP CLI execution, stdout/stderr/exit code, timeout and output limits. | Verified with real execution. |
| SQL lab | **Partial** | SQLite execution, dataset selector, reset, schema/info panel, result table, MySQL path, honest Oracle-unavailable state. | SQLite verified. MySQL not reachable in this environment. Oracle copy is contradictory. |
| HTML lab | **Implemented** | Three files (`index.html`, `style.css`, `script.js`), iframe preview, console capture. | Verified in browser. Execution is client-side; `?api=html-run` is a no-op acknowledgment. |
| CSS lab | **Implemented** | HTML + CSS editing with live preview. | Shares the HTML lab implementation. |
| Notes | **Implemented** | Create, edit, delete, optional link to a lesson, list view, persistence. | Verified via API/UI; no autosave or export. |
| Bookmarks | **Implemented** | Toggle a lesson as favorite; dashboard and lesson integration. | Persisted in `bookmarks`. |
| Progress | **Implemented** | Per-chapter status, quiz score, exercise stats, recent history, global progress, reset with confirmation. | Uses the number of written chapters as denominator, which is the right choice while content is incomplete. |
| Glossary | **Implemented** | Terms with module, French definition, Darija explanation, example; search and module filtering; alphabetical sort. | Visual label bug: “DarijaAttribut…”. |
| Projects | **Partial** | Project list with expandable `<details>` cards, objective, steps, explanation, Darija, code, checkpoints. | Only one project, only two steps, visible typo. No “open in lab” link, no step completion. |
| Search | **Implemented** | Full-text search over content; results link to lessons; search route and sidebar input. | Ranking, fuzzy matching, empty state, and keyboard shortcut were not deeply verified. |
| Settings | **Partial** | Theme (`dark`/`light`), language mode (`bilingual` default; saved value was `darija` at inspection), last lesson, exam mode. | Theme and language controls exist; `examMode` has no verified UI behavior. |
| Theme switching | **Implemented** | Dark default, light theme, `localStorage` persistence, pre-paint theme script. | Verified in both themes at 1440 and 390. |
| FR/Darija modes | **Partial** | Bilingual content blocks with a “Darija” flag; language mode setting. | Content quality is uneven; no per-block toggle; no `lang` attributes. |
| Responsive sidebar | **Implemented** | Fixed sidebar on desktop, overlay/toggle on mobile, breadcrumb truncation. | 390px verified; no page overflow. |
| Content availability | **Implemented** | Manifest + file existence; unavailable chapters are visible but disabled; progress denominator uses available chapters. | 43 disabled links create navigation noise. |
| Empty chapter state | **Implemented** | Clear message with “next available chapter” and “last chapter of module” links. | Verified at `#/lesson/html/4`; this is a good pattern. |
| Server-unreachable state | **Implemented** | Error screen with explanation and server command. | Source inspection; not re-tested during this pass. |
| Static asset routing | **Implemented** | `router.php` serves existing files, otherwise delegates to `index.php`. | This is also the source of the data-exposure risk. |
| PHP sandbox | **Implemented** | `php -n`, temp file, `disable_functions`, `open_basedir`, 6s timeout, 64KB output, forced termination. | Reasonable for single-user; not multi-tenant hardened. |
| SQL sandbox | **Partial** | SQLite deny-list, splitter, dataset reset; MySQL optional; Oracle unavailable. | Deny-list is pattern-based, not a SQL parser. |
| Authentication | **Not implemented** | No users, login, sessions, roles, or ownership. | By design for a personal platform. |
| Multi-user / classroom | **Not implemented** | No teacher view, cohort, assignment, or per-user data. | Architecture would need a users table and scoping. |
| Export / backup | **Not implemented** | No JSON/Markdown export, no database backup UI. | Data lives only in local SQLite files. |
| Offline / PWA | **Not implemented** | No service worker, manifest, or offline cache. | CDN assets also prevent true offline use. |
| Analytics / telemetry | **Not implemented** | No events, dashboards, or error reporting. | Product decisions are currently guesswork. |
| Authoring UI | **Not implemented** | Content is edited as PHP files. | Fine for a solo author; not for a team. |
| Certificates | **Not implemented** | None. | — |
| Oracle execution | **Unavailable** | Honest “client not installed” response; no simulation. | Correct behavior; wording needs repair. |
| MySQL execution | **Partial** | Code path exists; requires a local MySQL server and credentials. | Not verified; no schema/seed guarantee. |
| Accessibility | **Partial** | Skip link, `aria-live` toast, `aria-busy` main, labels on some controls, keyboard-reachable nav. | Axe failures on lesson/lab; manual testing not done. |

### 4.2 Content coverage

The manifest is the source of truth: `content/curriculum.php` declares 58 chapters across five modules. A chapter is “loadable” when `content/<module>/cNN.php` exists.

| Module | Planned | Loadable | Loadable chapter numbers | Missing chapter numbers | Exercise + quiz |
|---|---:|---:|---|---|---|
| HTML5 | 8 | **5** | 1, 2, 3, 6, 7 | 4, 5, 8 | Only chapter 1 (`ex01`, `qz01`) |
| CSS3 | 14 | **5** | 1, 2, 8, 9, 10 | 3, 4, 5, 6, 7, 11, 12, 13, 14 | None |
| PHP | 15 | **2** | 1, 9 | 2–8, 10–15 | None |
| SQL | 14 | **1** | 8 | 1–7, 9–14 | None |
| Integration | 7 | **2** | 1, 2 | 3–7 | None |
| **Total** | **58** | **15 (25.9%)** | — | **43** | **1 chapter (6.7% of loadable, 1.7% of planned)** |

Consequences:

- A learner following the sidebar encounters gaps immediately: HTML chapter 4 is missing, CSS chapter 3 is missing, PHP jumps from 1 to 9, SQL has only chapter 8, Integration stops at 2.
- The “course” cannot be completed end-to-end. The dashboard’s progress denominator correctly uses written chapters, but the sidebar still shows the full 58-chapter plan, which makes the product feel unfinished.
- The labs are usable independently, so the app still has value as a practice sandbox even when a chapter is missing.

### 4.3 Content quality findings

All 21 PHP files under `content/` pass `php -l` (syntax is valid). Syntax validity is not content quality. The following defects were confirmed by reading the files:

| File | Finding | Impact |
|---|---|---|
| `content/html/c01.php` | Reference-quality chapter: 3 sections, 7 blocks, 5 objectives, 2 common mistakes, summary, 3-level exercise, 6-question quiz. | Use as the template for every chapter. |
| `content/html/c02.php` | 5 sections, 23 blocks, definitions, warnings, tips, examples. | Good depth; use as a second reference. |
| `content/css/c02.php` | Stub: 1 section, 2 blocks, no `mistakes`, no `summary`, contains `TODO`, and garbled Darija. | A learner can open it and receive a near-empty lesson. |
| `content/html/ex01.php` | `TODO` placeholders in the starter code for levels 1 and 3. | Learners see unfinished code in the editor. |
| `content/html/qz01.php` | Q1 explanation contains awkward/garbled Darija. | Reduces trust in the bilingual promise. |
| `content/projects/project1.php` | Only 2 steps; typo “C’est le socle des connects projets suivants.” | The “projects” section overpromises. |
| Other loadable chapters | Syntax valid; not individually proofread in this pass. | Quality unknown; likely uneven. |

The content pipeline currently has **no automated quality gate** for:

- `TODO`, `à compléter`, `placeholder`, `lorem ipsum`, or ellipsis-only code;
- empty French or Darija fields;
- empty syntax/example code blocks;
- missing objectives, mistakes, or summary;
- missing exercise/quiz files;
- broken glossary links or inconsistent terminology;
- Darija spelling/transliteration consistency.

A simple PHP lint script could catch most of these before the UI ever renders a chapter.

### 4.4 What is genuinely strong

- The **content schema** is well thought out: text, definition, syntax, example, note, tip, warning, table, keywords, mistakes, summary, exercises, quizzes.
- The **exercise test types** cover HTML, output, regex, SQL, and row counts; this is enough to build meaningful auto-grading.
- The **quiz types** go beyond multiple choice: predict, find-error, complete, multi, true/false, fill, SQL.
- The **PHP executor** uses a real process with sensible limits instead of `eval()`.
- The **SQL executor** is honest about Oracle and offers a real SQLite sandbox.
- The **availability model** (file existence) is simple and transparent.
- The **empty chapter state** is better than a blank page: it offers the next available chapter.
- The **theme system** is implemented correctly, including pre-paint application to avoid a flash.

## 5. Project Architecture

### 5.1 Directory layout

```text
PHP_AppCours/
├─ index.php                  # Single entry point: shell + JSON API + devdump
├─ router.php                 # Dev-server router: static files, else index.php
├─ src/
│  ├─ bootstrap.php           # Paths, constants, autoload, initialization
│  ├─ Core/
│  │  ├─ Autoloader.php       # PSR-4-like autoloader for App\
│  │  ├─ Database.php         # SQLite connection + schema creation
│  │  ├─ Content.php          # Manifest, lesson loading, availability, search, glossary, projects
│  │  ├─ Repos.php            # Settings, progress, notes, bookmarks, quiz/exercise results, history
│  │  ├─ Api.php              # Endpoint dispatcher and validation
│  │  └─ functions.php        # Escaping/helper functions
│  └─ Execution/
│     ├─ PhpExecutor.php      # Real isolated PHP CLI execution
│     ├─ SqlExecutor.php      # SQLite/MySQL execution, Oracle unavailable state, datasets
│     └─ SqlSplitter.php      # Splits multi-statement SQL safely
├─ views/
│  └─ shell.php               # SPA HTML shell, fonts, CodeMirror, script order
├─ assets/
│  ├─ css/app.css             # Design system, themes, layout, components, responsive rules
│  └─ js/
│     ├─ api.js               # Fetch wrapper for ?api=…
│     ├─ ui.js                # DOM helper h(), icons, toast, code block, progress bar
│     ├─ editor.js            # CodeMirror wrapper with textarea fallback
│     ├─ lesson.js            # Lesson, exercise, quiz renderers
│     ├─ lab.js               # HTML/CSS/PHP/SQL labs
│     └─ app.js               # Router, sidebar, dashboard, notes, progress, glossary, projects, search
├─ content/
│  ├─ curriculum.php          # 58-chapter manifest (source of truth for navigation)
│  ├─ CONTENT-GUIDE.md        # Authoring guide
│  ├─ html/                   # c01, c02, c03, c06, c07, ex01, qz01
│  ├─ css/                    # c01, c02, c08, c09, c10
│  ├─ php/                    # c01, c09
│  ├─ sql/                    # c08, datasets/school.php
│  ├─ integration/            # c01, c02
│  ├─ glossary/glossary.php   # Terms FR + Darija + examples
│  └─ projects/project1.php   # One project, two steps
├─ data/
│  ├─ app.sqlite              # Settings, progress, notes, quiz/exercise results, history
│  └─ sql_sandbox.sqlite      # SQL lab database
├─ test.php                   # Leftover “Hello World” test
├─ _test_*.php, _probe.php    # Leftover probe/test scripts
├─ _lesson_backup.js          # Leftover backup file
├─ _m.html                    # Leftover HTML fragment
└─ .cap2/                     # Chrome profile directory left in the project
```

### 5.2 Request flow

```text
Browser
  │
  ├─ GET /  ──────────────► router.php
  │                           ├─ existing static file? serve it
  │                           └─ otherwise index.php
  │                                ├─ ?devdump=1 → JSON diagnostics
  │                                ├─ ?api=…    → Api::handle() → JSON
  │                                └─ else      → views/shell.php
  │
  ├─ JS boot ─────────────► GET index.php?api=bootstrap
  │                           └─ manifest + availability + progress + settings
  │                                + MySQL info + datasets + version
  │
  ├─ hash route ──────────► render view
  │                           ├─ lesson  → GET ?api=lesson&module=…&ch=…
  │                           ├─ search  → GET ?api=search&q=…
  │                           ├─ notes   → GET ?api=notes
  │                           └─ etc.
  │
  ├─ run PHP ─────────────► POST ?api=php-run  → PhpExecutor::run()
  ├─ run SQL ─────────────► POST ?api=sql-run  → SqlExecutor::run()
  └─ reset SQL ───────────► POST ?api=sql-reset → SqlExecutor::reset()
```

### 5.3 Backend layers

**Bootstrap (`src/bootstrap.php`)**

- Defines `APP_ROOT`, `APP_SRC`, `APP_CONTENT`, `APP_DATA`, `APP_ASSETS`, `APP_TMP`, `APP_VERSION`.
- Sets `error_reporting(E_ALL)`.
- Loads the autoloader.
- Ensures the temp directory exists.
- This is the only configuration entry point; there is no `.env` file.

**Core**

- `Database`: singleton PDO for `data/app.sqlite`; creates tables on first connection; sets WAL and foreign keys.
- `Content`: reads the manifest, checks chapter file existence, loads chapter/exercise/quiz arrays, computes availability, searches content, loads glossary and projects.
- `Repos`: all persistence for a single student. Settings are JSON-encoded values in a key/value table. Progress, quiz results, exercise results, notes, bookmarks, history, and lab snippets are separate tables.
- `Api`: a `match` expression dispatches 22 endpoints, validates inputs, and returns arrays. `index.php` JSON-encodes the result.
- `functions.php`: escaping and shared helpers.

**Execution**

- `PhpExecutor`: writes the learner’s code to a file under `APP_TMP`, runs `php -n` with restrictions, captures stdout/stderr/exit code, enforces 6 seconds and 64 KB, and terminates the process if needed.
- `SqlExecutor`: selects SQLite or MySQL; applies SQLite deny patterns; splits statements; executes; returns columns/rows/affected count; resets datasets; reports MySQL availability; returns a clear Oracle-unavailable response.
- `SqlSplitter`: splits multi-statement SQL while respecting quotes/comments (implementation detail; behavior verified through the SQL lab).

**View**

- `views/shell.php`: the only server-rendered HTML. It includes meta tags, favicon, pre-paint theme script, Google Fonts, CodeMirror CSS/JS, the app shell, skip link, toast region, and the JS files in dependency order.

### 5.4 Frontend modules

| Module | Responsibility | Notes |
|---|---|---|
| `api.js` | Builds `index.php?api=…` URLs, GET/POST, JSON, bootstrap cache. | No retry, no abort controller, no timeout. |
| `ui.js` | `h()` DOM builder, `esc()`, icons, badges, toast, code block, progress bar, confirmation dialog. | The `h()` helper is the backbone of all views. |
| `editor.js` | CodeMirror 5 wrapper with language modes, theme sync, fallback textarea, value get/set, change events. | Accessibility debt originates here. |
| `lesson.js` | Renders blocks, exercises, quizzes, hints, solutions, feedback, scoring. | The most complex frontend module. |
| `lab.js` | Templates and UI for HTML/CSS/PHP/SQL labs; run/reset; output panes; SQL result tables. | HTML execution is an iframe; PHP/SQL call the API. |
| `app.js` | Hash router, sidebar, topbar, dashboard, projects, glossary, notes, progress, search, settings. | Monolithic but readable; ~850 lines. |

The frontend uses an IIFE pattern and a global `WA` namespace. There is no transpilation, so the code must run directly in the target browsers. The `h()` helper supports a concise selector syntax (`div.class#id`) and is used consistently.

### 5.5 Content model

A chapter (`content/<module>/cNN.php`) returns:

```php
[
  'id' => 'html-ch1',
  'title' => '…',
  'subtitle' => '…',
  'objectives' => ['…'],
  'lessons' => [
    [
      'id' => 'section-id',
      'title' => '…',
      'icon' => '…',
      'blocks' => [
        ['type' => 'text', 'fr' => '…', 'darija' => '…'],
        ['type' => 'definition', 'title' => '…', 'fr' => '…', 'darija' => '…'],
        ['type' => 'syntax', 'lang' => 'php', 'code' => '…', 'title' => '…'],
        ['type' => 'example', 'lang' => 'html', 'code' => '…', 'title' => '…'],
        ['type' => 'note' | 'tip' | 'warning', 'fr' => '…', 'darija' => '…'],
        ['type' => 'table', 'head' => [], 'rows' => []],
        ['type' => 'keywords', 'items' => []],
      ],
    ],
  ],
  'mistakes' => [
    ['wrong' => '…', 'fix' => '…', 'fr' => '…', 'darija' => '…'],
  ],
  'summary' => ['fr' => '…', 'darija' => '…'],
]
```

An exercise (`exNN.php`) returns an id, title, brief, optional SQL dataset/dialect, and three levels. Each level has instructions (FR + Darija), starter code, tests, hints, solution, and explanations. A quiz (`qzNN.php`) returns a title and questions with type, prompt, options, answer, concept, and explanations.

Datasets (`content/sql/datasets/<id>.php`) contain `drop`, `ddl_sqlite`, `ddl_mysql`, and `insert` statements. Glossary terms and projects are also PHP arrays.

### 5.6 Architectural strengths

- **Clear separation of concerns:** content loading, persistence, API, execution, and rendering are distinct.
- **No hidden magic:** a developer can read the request path from `index.php` to the executor.
- **Extensible by files:** adding a chapter or dataset does not require a database migration or admin UI.
- **Safe defaults for a demo:** prepared statements, escaped output, `php -n`, `open_basedir`, SQL deny patterns.
- **Single source of truth for navigation:** the manifest drives the sidebar and availability.
- **Progress denominator uses written chapters,** so learners are not penalized for missing content.

### 5.7 Architectural weaknesses

- **Content is code:** authors need PHP syntax; a missing comma breaks a chapter; there is no validation layer.
- **No content schema validation:** `Content::lesson()` trusts the array shape. Missing keys cause warnings or blank sections.
- **No API contract/versioning:** frontend and backend are coupled by string endpoint names and array shapes.
- **No dependency injection:** static singletons are fine at this size but make unit testing hard.
- **No routing fallback for unknown routes:** unknown hashes render the dashboard, which can mask broken links.
- **No separation between dev and prod configuration:** `devdump`, broad static serving, and the dev router are always available; error display depends on the PHP INI and is not explicitly production-hardened.
- **No `public/` document root:** source, content, and data sit next to the entry point.

### 5.8 Extension points

| To add… | Do this |
|---|---|
| A chapter | Add it to `content/curriculum.php`, create `content/<module>/cNN.php`, optionally `exNN.php` and `qzNN.php`. Availability updates automatically. |
| An exercise or quiz | Create `exNN.php` / `qzNN.php` next to the chapter; `Content::lesson()` loads them if present. |
| A SQL dataset | Add `content/sql/datasets/<id>.php`; it appears through `SqlExecutor::datasets()`. |
| A project | Add `content/projects/projectN.php`; `Content::projects()` scans the directory. |
| A glossary term | Append to `content/glossary/glossary.php`. |
| A module | Add it to `Content::MODULES`, the manifest, a content directory, and the UI color/icon map. |
| An API endpoint | Add a `match` arm in `Api.php` and a client method in `api.js` if needed. |
| A route | Add it to `ROUTES` in `app.js`, implement a view, and add a page label/title. |

## 6. Pages and Navigation

### 6.1 Routes

The frontend is a hash-router SPA. The server only serves the shell and the JSON API; all page navigation happens client-side.

| Hash route | View | Purpose | Status |
|---|---|---|---|
| `#/dashboard` (or empty hash) | Dashboard | Greeting, continue action, stats, modules, recent activity. | Implemented |
| `#/lesson/{module}/{n}` | Lesson | Chapter reader, exercises, quiz, bookmark, mark-done, previous/next. | Implemented for 15 chapters; empty state for the rest. |
| `#/lab/{module}` | Lab | HTML/CSS/PHP/SQL practice environment. | Implemented; Oracle unavailable. |
| `#/projects` | Projects | Expandable project cards with steps and code. | Implemented; one thin project. |
| `#/glossary` | Glossary | Searchable/filterable term list with FR + Darija + examples. | Implemented; visual bug. |
| `#/notes` | Notes | Personal notes list/editor, optional lesson link. | Implemented. |
| `#/progress` | Progress | Global and per-module progress, chapter status, quiz/exercise stats, reset. | Implemented. |
| `#/search/{query}` | Search | Search results linking to lessons. | Implemented. |
| Unknown hash | Dashboard | Fallback. | Implemented, but no explicit not-found state. |

Server endpoints:

- `/` → shell.
- `/?api=<endpoint>` → JSON.
- `/?devdump=1` → environment diagnostics (should not be public).
- Existing files → served directly by the dev router (this includes data and source files; see §11).

### 6.2 Application shell

**Sidebar**

- Brand block (“WebAcademy”) linking to the dashboard.
- Search input; typing at least two characters navigates to the search route.
- Five module groups (HTML5, CSS3, PHP, SQL, Integration), each with a colored code glyph (`</>`, `{}`, etc.), a chevron, and a list of chapters.
- Chapter links show completion state and are disabled when the chapter file is missing.
- Quick links: HTML lab, CSS lab, PHP lab, SQL lab, Projects, Notes, Progress, Glossary.
- The sidebar is fixed on desktop and becomes an overlay on narrow screens.

**Topbar**

- Breadcrumbs with module/chapter context.
- Language switch (FR / Darija / bilingual mode).
- Theme control.
- On screens ≤1020px, non-current breadcrumb segments are hidden; the current page remains visible.

**Main**

- `aria-busy="true"` while booting.
- Boot message: “Chargement de WebAcademy…”.
- Error state if the bootstrap API is unreachable.
- Toast region with `role="status"` and `aria-live="polite"`.
- Skip link to `#wa-main`.

### 6.3 Page-by-page description

**Dashboard**

- Time-based greeting (“Bonsoir, bienvenue”).
- Primary “Continuer” action pointing to the last/next chapter.
- Secondary “Chapitre précédent” when applicable.
- Stat tiles: chapters done, exercises passed, favorite lessons, best quiz score (the exact set is derived from progress).
- Module grid with per-module progress bars and a link to the first written chapter.
- Recent activity list from `history`.
- Empty state for a new learner with a “Ouvrir le chapitre 1 · HTML” action.
- The dashboard is the cleanest page from an accessibility standpoint: axe reports no violations at 1440 or 390.

**Lesson**

- Chapter header, subtitle, objectives.
- Sections with icons, text, definitions, syntax blocks, examples, notes, tips, warnings, tables, and keywords.
- “Erreurs fréquentes” section from `mistakes`.
- Summary (“À retenir”).
- Exercise card with level selector, instructions, editor, run/verify, hints, solution, feedback.
- Quiz card with questions, answer selection, submit, score, per-question explanations, and concepts to review.
- Bookmark toggle and “marquer comme terminé”.
- Previous/next chapter links, including the empty-state links when the next chapter is missing.
- Sticky topbar can cover section headings when navigating to anchors; see §8.

**Lab**

- Module tabs (HTML, CSS, PHP, SQL).
- Toolbar with run/reset, dialect selector (SQL), dataset selector, and status.
- Three-pane desktop layout: guide, editor, output/preview.
- HTML/CSS: file tabs, iframe preview, console.
- PHP: editor, run button, stdout/stderr/exit code, execution time.
- SQL: dialect, dataset, schema info, query editor, result table, reset.
- At ≤1120px the three-pane layout collapses to one column; the guide moves after the editor.
- Oracle shows a “read-only / no execution” message that is semantically wrong (see §8).

**Projects**

- One expandable `<details>` card per project.
- Header: project number badge, title, level, chevron.
- Objective, then steps with title, explanation, Darija, code block, and checkpoint.
- No per-step completion state, no “open in lab”, no project progress.

**Glossary**

- Search input and module filter.
- Terms sorted alphabetically.
- Each term card shows the term, module badge, French definition, Darija explanation, and example code.
- The “Darija” flag is visually concatenated with the text in the rendered card.

**Notes**

- List of notes with title, body, optional lesson link, edit/delete.
- Editor form with title/body and save.
- No autosave, no markdown preview, no tags, no export.

**Progress**

- Global progress bar based on written chapters.
- Per-module sections with chapter rows, status, quiz score, and availability.
- Exercise statistics.
- “Réinitialiser ma progression” with a confirmation dialog.
- Notes and bookmarks are preserved on reset (as stated in the UI).

**Search**

- Search input with a minimum of two characters.
- Results link to `#/lesson/{module}/{ch}`.
- Search route accepts the query in the hash.
- Ranking, grouping, empty state, and keyboard behavior were not deeply verified.

### 6.4 Navigation behavior and issues

**What works**

- Deep links to lessons work and load the correct chapter.
- Unknown or empty hashes fall back to the dashboard.
- The mobile sidebar is reachable via a labeled toggle; breadcrumbs truncate without breaking the layout.
- The empty chapter state is clear and offers a way forward.
- The active sidebar item is highlighted; the module group opens automatically.
- The dashboard’s “continue” action is a strong default.

**Issues**

1. **43 unavailable chapters are visible as disabled links.** This is honest but noisy. A learner sees a long list of dead ends. Recommendation: default to “available chapters only”, with a “Voir les chapitres à venir” toggle and a count. Alternatively, collapse unavailable chapters under a single “À venir” row per module.
2. **No explicit not-found route.** Any unknown hash renders the dashboard, which can hide broken links and makes analytics unreliable. Add a “Page introuvable” view with links to dashboard/search.
3. **Sticky topbar overlap.** Anchor navigation (quiz, exercise, sections) can put the target heading under the topbar. Add `scroll-margin-top` (see §8).
4. **Projects are not deep-linkable.** Project details live inside `<details>` on one page. A learner cannot share or bookmark a specific project or step. Add `#/projects/{id}` and `#/projects/{id}/{step}` if projects become a real feature.
5. **No command palette / global keyboard shortcut.** Search is only in the sidebar. A `Ctrl/Cmd+K` palette would fit the developer-tool positioning.
6. **Settings are scattered.** Theme and language are in the topbar; `examMode` exists in the API but has no visible page. Consider a dedicated settings view for theme, language, editor preferences, data export, and reset.
7. **No onboarding.** A first-time learner lands on a dashboard with no explanation of the path, the bilingual model, or the labs. Add a three-step welcome flow (goal, level, weekly time) and a recommended first chapter.
8. **Unavailable links and progress rows rely on color/opacity.** Combine visual state with text (“À venir”, “Disponible”) and `aria-disabled`, not just a muted color.

### 6.5 Empty, loading, and error states

| State | Current behavior | Recommendation |
|---|---|---|
| App boot | “Chargement de WebAcademy…” text. | Use a skeleton shell (sidebar, topbar, content) to reduce perceived latency and layout shift. |
| Server unreachable | Error screen with a command hint. | Keep; add a “Réessayer” button and a link to troubleshooting. |
| Chapter missing | Clear message + next/last available chapter. | Keep and reuse for all unavailable routes. |
| No search results | Not verified. | Add a clear empty state with spelling suggestions and module filters. |
| No notes | Empty state with a create action. | Keep; add a template (“Ce que j’ai appris / Ce que je dois revoir”). |
| No bookmarks | Dashboard shows zero. | Add an empty state explaining how to bookmark a lesson. |
| Quiz not started | Quiz card visible. | Add a short instruction and estimated time. |
| Exercise not passed | Feedback with hints/solution. | Keep; add a “try again” focus reset and preserve the learner’s code. |
| SQL error | Error message in the output pane. | Keep; add the failing line/statement and a link to the dataset schema. |
| Oracle selected | Contradictory “read-only” message. | Replace with an explicit unavailable state and disable Run. |

## 7. Database and API Overview

### 7.1 Application database

**File:** `data/app.sqlite`  
**Engine:** SQLite via PDO  
**Configuration:** WAL journal mode, foreign keys enabled  
**Schema creation:** `Database::migrate()` with `CREATE TABLE IF NOT EXISTS`  
**User model:** single implicit student; there is no `users` table

| Table | Columns | Purpose | Rows at inspection |
|---|---|---|---:|
| `settings` | `key` TEXT PK, `value` TEXT | JSON-encoded settings: theme, langMode, lastLesson, examMode. | **3** |
| `progress` | `lesson_key` TEXT PK, `status` TEXT default `in_progress`, `score` INTEGER default 0, `updated_at` TEXT | Per-chapter status and quiz score. | **0** |
| `quiz_results` | `id` INTEGER PK AUTOINCREMENT, `lesson_key`, `score`, `total`, `answers` TEXT default `[]`, `created_at` | Quiz attempt history. | **0** |
| `exercise_results` | `id` INTEGER PK AUTOINCREMENT, `lesson_key`, `level`, `passed` INTEGER default 0, `tries` INTEGER default 0, `created_at` | Exercise attempt history. | **0** |
| `notes` | `id` INTEGER PK AUTOINCREMENT, `lesson_key` nullable, `title`, `body`, `created_at`, `updated_at` | Personal notes, optionally linked to a lesson. | **0** |
| `bookmarks` | `lesson_key` TEXT PK, `created_at` | Favorite lessons. | **0** |
| `history` | `id` INTEGER PK AUTOINCREMENT, `lesson_key`, `viewed_at` | Lesson view history for “recent activity”. | **8** |
| `lab_snippets` | `id` INTEGER PK AUTOINCREMENT, `module`, `name`, `code`, `updated_at` | Schema for saved lab snippets. | **0** |

Observations:

- The row counts reflect the state at inspection time. `history` has 8 rows from manual testing; the other activity tables are empty.
- `settings` has 3 rows at inspection: `theme = "dark"`, `langMode = "darija"`, `lastLesson = "html-ch1"`. `examMode` is not set, so the default `false` applies.
- `progress` stores one row per lesson key, but `quiz_results` and `exercise_results` keep full attempt history. The dashboard reads the aggregate `progress.score`, not the latest quiz result.
- `lesson_key` follows the pattern `module-chN` (e.g., `html-ch1`), validated by `^[a-z]+-ch\d+$`.
- There are no foreign keys between these tables. `PRAGMA foreign_keys = ON` has no effect because no `REFERENCES` clauses exist.
- There are no indexes beyond primary keys. At this data volume this is fine.
- `lab_snippets` has no verified UI usage; it appears to be a forward-looking table.
- `history` grows without pruning; a long-lived user will accumulate rows indefinitely.

**Migration risk:** `CREATE TABLE IF NOT EXISTS` does not add columns to an existing table. If the schema evolves, existing databases will silently miss the new columns. There is no `schema_version` table and no migration runner.

### 7.2 SQL sandbox database

**File:** `data/sql_sandbox.sqlite`  
**Dataset:** `school` (`content/sql/datasets/school.php`)  
**Reset:** `SqlExecutor::reset('sqlite', 'school')` drops and recreates the dataset tables.

| Table | Rows | Meaning |
|---|---:|---|
| `professeur` | 3 | Teachers (name, specialty). |
| `etudiant` | 5 | Students (name, filière, email). |
| `matiere` | 4 | Subjects. |
| `note` | 10 | Grades linking students, subjects, and teachers. |
| `test_of` | 0 | **Leftover table not declared in the dataset.** |
| `sqlite_sequence` | 4 | SQLite internal table for AUTOINCREMENT; not part of the lesson dataset. |

The leftover `test_of` table is evidence of manual experimentation. Because the dataset’s `drop` list only includes `note`, `matiere`, `etudiant`, and `professeur`, a reset will not remove `test_of`. This is a minor data hygiene issue, but it can confuse learners who inspect the schema and see a table that is not part of the lesson.

### 7.3 API conventions

- **Base URL:** `index.php?api=<endpoint>`.
- **Read endpoints:** GET.
- **Write/execute endpoints:** POST with `Content-Type: application/json`; `api.js` sends a JSON body.
- **Success shape:** `{ "ok": true, ...payload }`.
- **Error shape:** `{ "ok": false, "error": "message in French" }`.
- **HTTP status:** `index.php` returns HTTP 200 for API results, including logical errors; the `ok` flag carries success/failure. This is simple but makes HTTP monitoring harder.
- **Validation:** endpoint-specific. Lesson keys use a regex; status is an enum; exercise level is 1–3; quiz score is bounded by total; notes require a title or body.
- **Authentication:** none.
- **CSRF:** no token; same-origin fetch only. Because there is no auth, CSRF has no privileged session to abuse, but any future auth must add CSRF protection.
- **Rate limiting:** none.
- **Caching:** none; the bootstrap response is cached in memory on the client for the session.

### 7.4 Endpoint inventory

| Endpoint | Method | Purpose | Notes |
|---|---|---|---|
| `bootstrap` | GET | Manifest, availability, progress, settings, MySQL info, datasets, version. | Called once at boot. |
| `lesson` | GET | Load a chapter + exercise + quiz; record a view; return progress/bookmarks/last quiz. | `module`, `ch`. |
| `projects` | GET | List projects. | Reads `content/projects/*.php`. |
| `project` | GET | Load one project by id. | Used if a detail view is added. |
| `glossary` | GET | All glossary terms. | Reads `content/glossary/glossary.php`. |
| `search` | GET | Full-text search over content. | `q`. |
| `settings-load` | GET | Load settings. | Theme, langMode, lastLesson, examMode. |
| `settings-save` | POST | Save settings. | Accepts any of the four fields. |
| `progress` | GET | Progress overview. | Map, bookmarks, recent, exercise stats. |
| `progress-set` | POST | Set a chapter status. | `key`, `status` (`in_progress`/`done`). |
| `progress-reset` | POST | Reset progress, quiz scores, exercise results. | Notes and bookmarks preserved. |
| `note-save` | POST | Create or update a note. | `id`, `title`, `body`, `lessonKey`. |
| `note-delete` | POST | Delete a note. | `id`. |
| `notes` | GET | List notes. | — |
| `bookmark` | POST | Toggle a bookmark. | `key`. |
| `quiz-save` | POST | Save a quiz result. | `key`, `score`, `total`, `answers`. |
| `exercise-done` | POST | Save an exercise attempt. | `key`, `level`, `passed`. |
| `php-run` | POST | Execute PHP code in the sandbox. | `code`. |
| `sql-run` | POST | Execute SQL against SQLite/MySQL. | `dialect`, `sql`, `dataset`. |
| `sql-reset` | POST | Reset a SQL dataset. | `dialect`, `dataset`. |
| `sql-info` | GET | MySQL availability + datasets. | — |
| `html-run` | POST | Acknowledge HTML execution. | No server execution; the lab uses an iframe. |

### 7.5 Data lifecycle

1. **Boot:** `bootstrap` reads settings, progress, bookmarks, recent history, exercise stats, and SQL metadata.
2. **Lesson view:** `lesson` calls `Repos::view($key)`, inserting a row into `history`; it returns the chapter, progress, bookmarks, and last quiz.
3. **Mark done:** `progress-set` upserts `progress` with `status = 'done'`.
4. **Quiz submit:** `quiz-save` inserts into `quiz_results` and updates `progress.score`.
5. **Exercise check:** `exercise-done` inserts into `exercise_results` with `passed` and `tries`.
6. **Notes/bookmarks:** immediate writes.
7. **SQL lab:** writes to `data/sql_sandbox.sqlite`, not the app database.
8. **Reset:** `progress-reset` clears progress, quiz results, and exercise results; notes and bookmarks remain.

### 7.6 API and data risks

- **No authorization:** any caller can read/write all data. This is acceptable only on a trusted local machine.
- **No CSRF protection:** not exploitable without auth, but must be added with auth.
- **No rate limiting:** the code-execution endpoints can be hammered; even with a 6-second timeout, concurrent requests can exhaust CPU.
- **No request size limit at the API layer:** large code/SQL bodies could consume memory before execution limits apply. PHP’s `post_max_size`/`memory_limit` are the only backstops.
- **No structured error codes:** clients only get a French message; programmatic handling is limited.
- **No API versioning:** a breaking change to a payload shape breaks the SPA silently.
- **`devdump` exposes environment data:** PHP version, binary path, MySQL info, datasets, modules, and written chapters. Remove it or gate it behind a local-only check.
- **SQLite files are downloadable through the dev router** (confirmed with HTTP 200). This is the most serious data risk.
- **Direct PHP file access:** `test.php`, `src/bootstrap.php`, and `content/curriculum.php` were reachable and executed. Direct access to content PHP files returns no output, but it still executes code and may expose errors/paths.
- **No backup/export:** a deleted `data/app.sqlite` loses all progress and notes.

## 8. UI/UX Audit

### 8.1 Method and evidence

The audit combined source inspection with rendered inspection:

- **Viewports:** 1440×900 desktop and 390×844 mobile, using Chrome DevTools Protocol device emulation for a true 390px layout. A 500×900 check was also performed.
- **Themes:** dark (default) and light.
- **Pages:** dashboard, lesson (`html/1`), PHP lab, SQL lab, projects, notes, progress, glossary, search, empty chapter (`html/4`).
- **Automated accessibility:** axe-core 4.10.2 with WCAG 2.0/2.1 A and AA tags.
- **Computed styles:** distinct font sizes, font families, border radii, box shadows, and colors; sampled component styles.
- **Screenshots:** stored in `C:\Users\WINDOWS 11\AppData\Local\Temp\opencode\wa_shots` during analysis.
- **Limitations:** no manual screen-reader pass, no Firefox/Safari, no widths below 390, no 200% zoom/forced-colors test, no performance trace, and no full keyboard-only walkthrough. These are listed in §13.

**Reproduction notes:** the app was served with `php -S 127.0.0.1:8088 router.php`. The CDP audit scripts are `%TEMP%\opencode\wa_audit.js` and `wa_extra.js`; database inspection scripts are `wa_inventory.php` and `wa_db_details.php`; screenshots are in `%TEMP%\opencode\wa_shots`. axe-core 4.10.2 was injected from cdnjs for the audit. The HEAD probes for the exposure findings are reproducible with `Invoke-WebRequest -Method Head` against the URLs in §11.1.

**State note:** the saved `langMode` at inspection was `darija`, so the computed-style counts and screenshots reflect that mode. Bilingual mode may render additional French text, but it does not change the underlying token system or the findings about editor accessibility, contrast, and layout.

The goal is not to list every pixel; it is to identify causes and concrete replacements. Findings are graded:

- **Critical:** blocks a core task or fails a WCAG A/AA requirement with high impact.
- **High:** significant friction, trust, or accessibility problem.
- **Medium:** noticeable quality issue with a clear fix.
- **Low:** polish or consistency issue.

### 8.2 What works well

- **Coherent shell:** sidebar + topbar + content area is immediately understandable. The dark theme is readable and the light theme is a real theme, not an afterthought.
- **Responsive page frame:** at 390px the document scroll width equals the viewport (390px); there is no page-level horizontal overflow. The sidebar becomes an overlay and the stat grid remains usable.
- **Dashboard accessibility:** axe reports zero violations at 1440 and 390. The page has a clear `h1`, readable contrast, and sensible landmarks.
- **Theme persistence:** the pre-paint script applies the stored theme before rendering, avoiding a flash.
- **Empty chapter state:** `#/lesson/html/4` explains that the chapter is not written and offers the next available chapter and the last chapter of the module. This is exactly the right pattern.
- **Breadcrumb truncation:** at mobile width, only the current segment is shown; the topbar does not wrap or overflow.
- **Lab layout:** the three-pane desktop layout (guide, editor, output) is appropriate for a coding environment; at ≤1120px it collapses to a single column.
- **Bilingual callouts:** the “Darija” annotation is visually distinct and useful; the concept is a genuine differentiator.
- **Code blocks:** syntax highlighting, filenames, and copy affordances are present.
- **Progress denominator:** using written chapters rather than the full 58 avoids punishing learners for missing content.

### 8.3 Findings summary

| ID | Severity | Area | Finding | Evidence |
|---|---|---|---|---|
| U-01 | **Critical** | Accessibility | CodeMirror textarea has no accessible name; axe reports a critical `label` violation. | Lesson and lab, desktop and mobile. |
| U-02 | **High** | Accessibility | Five color-contrast findings: unavailable sidebar links and CodeMirror comments/line numbers. | axe on lesson/lab; computed faint text on dark surfaces. |
| U-03 | **High** | Trust / content | Oracle copy says “lecture seule — pas d’exécution”, which is contradictory. | SQL lab Oracle state screenshot. |
| U-04 | **High** | Content quality | Stub chapter, TODO starter code, garbled Darija, project typo. | `css/c02`, `html/ex01`, `html/qz01`, `project1`. |
| U-05 | **Medium** | Navigation | 43 unavailable chapters are visible as disabled links. | Sidebar; 15/58 availability. |
| U-06 | **Medium** | Layout | Sticky topbar covers section headings when scrolling to anchors. | Scrolling to `.wa-quiz`; no `scroll-margin-top`. |
| U-07 | **Medium** | Visual system | 21 font sizes on the lesson page; 16 on the dashboard. | Computed styles. |
| U-08 | **Medium** | Visual system | 9 border radii and 5 shadows on the lesson page; 7 radii on the dashboard. | Computed styles. |
| U-09 | **Medium** | Mobile | CodeMirror internals overflow horizontally inside the editor at 390px. | Page scroll width 390; editor children exceed container. |
| U-10 | **Medium** | Bilingual UI | Glossary concatenates “Darija” with the term text (“DarijaAttribut howa…”). | Glossary screenshot. |
| U-11 | **Low** | Mobile | Lesson toolbar stacks buttons vertically and consumes vertical space. | Mobile lesson screenshot. |
| U-12 | **Low** | Visual system | UI mixes SVG icons with emoji and text glyphs. | `🧭 Consignes`, module glyphs, SVG icons. |
| U-13 | **Low** | Navigation | Unknown hashes silently render the dashboard. | Router fallback. |
| U-14 | **Positive** | Navigation | Empty chapter state is clear and offers next/last links. | `#/lesson/html/4`. |
| U-15 | **Positive** | Accessibility | Dashboard has zero axe violations; skip link and live toast exist. | axe, source. |

### 8.4 Detailed findings

#### U-01 — CodeMirror has no accessible name (Critical)

**Location:** `assets/js/editor.js`; editor hosts in `assets/js/lesson.js` (exercise editor) and `assets/js/lab.js` (PHP/SQL/HTML/CSS labs).

**Evidence:** axe-core reports one critical `label` violation on the lesson page and the lab pages. CodeMirror 5 creates a hidden `<textarea>` for input; that textarea has no associated `<label>`, `aria-label`, or `aria-labelledby`.

**Cause:** the editor is initialized directly on a host `<div>` with no label. The visible context (“Consignes”, “Éditeur”) is not programmatically associated.

**Why it matters:** a screen-reader user encounters an unnamed textbox and cannot tell whether it is for HTML, CSS, PHP, or SQL. This blocks the core lab/exercise task.

**Fix:**

- Add a visible label above every editor: “Éditeur de code — PHP”, “Éditeur SQL”, etc.
- After CodeMirror initializes, set `aria-label` on `cm.getInputField()` and, if useful, `aria-describedby` pointing to the exercise instructions.
- For the fallback `<textarea>`, associate the same label with `for`/`id`.
- Add a visible hint: “Appuyez sur Échap puis Tab pour sortir de l’éditeur” (CodeMirror captures Tab).
- Verify with axe (`label` should disappear) and a screen reader.

**Acceptance:** zero critical axe violations on lesson and all four labs; the editor announces its language and purpose.

#### U-02 — Contrast failures in navigation and code editor (High)

**Location:** unavailable chapter links in the sidebar; `.cm-comment` and `.CodeMirror-linenumber` in the CodeMirror theme.

**Evidence:** axe reports five color-contrast findings on the lesson and lab pages. The affected text is low-contrast gray on a dark navy surface. The exact ratios were not captured in the audit output, but the affected elements are consistent across desktop and mobile.

**Cause:** the design uses faint text and opacity to indicate “disabled” and to de-emphasize code comments/line numbers. On the dark theme, the resulting contrast is below the WCAG AA threshold for normal text.

**Fix:**

- Measure each pair with a contrast tool. Target at least **4.5:1** for normal text and **3:1** for large text/UI boundaries.
- Raise comment and line-number colors to a readable gray (for example, `#9FB0C7` on `#070C12`; verify the actual ratio).
- Do not rely on opacity for unavailable links. Use a readable `--text-muted` plus an explicit “À venir” badge or `aria-disabled="true"` with an explanation.
- If unavailable links are truly non-interactive, ensure they are still readable; WCAG exempts disabled controls, but these links carry information (“this chapter exists in the plan”).
- Add a regression check to the axe run.

**Acceptance:** zero color-contrast violations on lesson and labs at 1440 and 390.

#### U-03 — Oracle wording is contradictory (High)

**Location:** SQL lab dialect selector/status. Screenshot `sql-oracle.png`.

**Evidence:** the UI says “Oracle : lecture seule — pas d’exécution”. “Read-only” implies that reading/querying works; “no execution” says it does not. The actual behavior is **no execution at all** because the Oracle client is not installed.

**Cause:** copy was written to be reassuring but conflates two different states.

**Why it matters:** it undermines the app’s otherwise honest handling of Oracle. A learner may think a query will run in read-only mode and be confused when nothing happens.

**Fix:**

- Replace with: **“Oracle — non disponible dans cet environnement. Aucune requête n’est exécutée (client Oracle non installé).”**
- Disable the Run button when Oracle is selected and show an info callout, not an error.
- Offer a “Voir l’équivalent SQLite” action that switches dialect and keeps the query.
- Add a status badge (“Non disponible”) with an icon, not only text.

**Acceptance:** the Oracle state is unambiguous; no Run action is possible; the learner can switch to SQLite in one click.

#### U-04 — Content quality defects (High)

**Location:** `content/css/c02.php`, `content/html/ex01.php`, `content/html/qz01.php`, `content/projects/project1.php`.

**Evidence:**

- `css/c02.php`: one section, two blocks, no mistakes, no summary, contains `TODO`, garbled Darija.
- `html/ex01.php`: `TODO` placeholders in starter code for levels 1 and 3.
- `html/qz01.php`: Q1 explanation contains garbled Darija.
- `project1.php`: only two steps; typo “C’est le socle des connects projets suivants.”

**Cause:** there is no content QA gate. PHP lint catches syntax, not prose or completeness, and several defects shipped despite valid PHP.

**Fix:**

- Define a chapter acceptance checklist (see §9.10 and §10.4).
- Add a content lint script that fails on `TODO`, `à compléter`, `placeholder`, `lorem ipsum`, ellipsis-only code, empty FR/Darija fields, empty syntax/example blocks, missing objectives/mistakes/summary, and missing `exNN`/`qzNN`.
- Have a native Darija speaker review every Darija block for spelling, gender, and technical accuracy.
- Remove or hide stub chapters until they meet the checklist. A hidden stub is better than a visible empty lesson.

**Acceptance:** zero TODO/placeholder hits; every loadable chapter has objectives, at least three sections, at least two mistakes, a summary, a three-level exercise, and a quiz.

#### U-05 — 43 unavailable chapters clutter navigation (Medium)

**Location:** sidebar module lists and progress page.

**Evidence:** only 15 of 58 chapters load. The sidebar renders all 58, with unavailable chapters disabled.

**Cause:** the manifest is the navigation source and availability only changes styling/behavior; there is no filter.

**Why it matters:** a new learner sees more dead ends than lessons. The product feels unfinished before the first click.

**Fix:**

- Default the sidebar to **available chapters only**, with a per-module count (“5/8 disponibles”).
- Add a “Voir les chapitres à venir” toggle; persist the preference.
- In the progress page, group unavailable chapters under a collapsed “À venir” section.
- Keep the full manifest for the roadmap, but do not make it the primary navigation.

**Acceptance:** a new learner can scan the sidebar and see only actionable chapters; the full plan remains discoverable.

#### U-06 — Sticky topbar obscures anchors (Medium)

**Location:** `.wa-topbar` (sticky) and lesson sections/exercise/quiz anchors.

**Evidence:** scrolling to `.wa-quiz` places the heading under the topbar. There is no `scroll-margin-top` on sections.

**Cause:** sticky positioning removes the topbar from flow, but anchor scrolling does not account for its height.

**Fix:**

- Define `--topbar-h: 64px` (or the actual computed height).
- Add `[id] { scroll-margin-top: calc(var(--topbar-h) + 16px); }` or scope it to lesson sections.
- If an in-page table of contents is added, use the same offset.
- Test deep links at 1440 and 390, and with the mobile topbar height.

**Acceptance:** every anchored heading is fully visible below the topbar.

#### U-07 — Type scale sprawl (Medium)

**Location:** lesson page and dashboard.

**Evidence:** the lesson page uses **21 distinct font sizes**; the dashboard uses **16**. Values include one-off sizes such as 12.6px, 13.4px, 13.5px, and 14.5px in addition to the main scale.

**Cause:** components set local `font-size` values instead of using tokens.

**Why it matters:** the page looks slightly inconsistent, and responsive adjustments become unpredictable. It also makes the design feel “assembled” rather than designed.

**Fix:**

- Adopt a nine-step scale: 12, 13, 14, 16, 18, 22, 28, 36, 48.
- Map each component to a step (meta, label, body, lead, h3, h2, h1, display).
- Set body to 16px for reading comfort; use 14px for UI labels and 13px for code/meta.
- Use `rem` and a single base size.
- Audit with a computed-style script after the refactor.

**Acceptance:** no more than nine distinct font sizes on any page; all components reference tokens.

#### U-08 — Radius and shadow sprawl (Medium)

**Location:** lesson page and dashboard.

**Evidence:** the lesson page uses **9 border radii** and **5 box shadows**; the dashboard uses **7 radii** and 5 shadows.

**Cause:** one-off values (`7px`, `9px`, `10px`, `14px`, `18px`) and multiple shadow recipes.

**Fix:**

- Use four radii: **8px** (controls), **12px** (cards), **16px** (modals/hero), **999px** (pills).
- Use two shadows: `--shadow-1` for raised cards, `--shadow-2` for overlays; add a separate focus ring token.
- Replace decorative shadows with borders/background contrast; the dark theme needs less shadow.
- Document usage in the design-system notes.

**Acceptance:** at most four radii and two shadows in computed styles per page.

#### U-09 — CodeMirror overflows inside the mobile editor (Medium)

**Location:** lesson and lab editors at 390px.

**Evidence:** the page itself does not overflow (`document.documentElement.scrollWidth === 390`), but CodeMirror’s internal elements extend beyond the editor container. The editor is visually clipped or requires horizontal scrolling inside a container that is already narrow.

**Cause:** flex/grid children default to `min-width: auto`; CodeMirror’s scroller has a content width larger than the viewport; the host does not constrain overflow.

**Fix:**

- Add `min-width: 0` to every flex/grid child in the lab and lesson layouts.
- Constrain the host: `.editorhost, .CodeMirror { max-width: 100%; }`.
- Let the **editor body** scroll horizontally, not the page: `.CodeMirror-scroll { overflow-x: auto; }`.
- On mobile, prefer tabs (“Code / Sortie / Guide”) instead of stacking all panes.
- Reduce the editor font to 13px on mobile and add a “retour à la ligne” toggle if code wrapping is desired.
- Test at 320, 360, and 390px.

**Acceptance:** no element extends beyond the viewport; the editor remains usable with long lines.

#### U-10 — Glossary label concatenation (Medium)

**Location:** `assets/js/app.js`, `viewGlossary()` term card; `.wa-darija` and `.flag` styles.

**Evidence:** the rendered card shows “DarijaAttribut howa info zida…”. The label and the text are visually joined.

**Cause:** the “Darija” flag is an inline element followed by a block without a gap; the container does not use flex/grid spacing.

**Fix:**

- Make `.wa-darija` a column flex container with `gap: 6px`, or give `.flag` a `margin-right: 6px` and `display: inline-flex`.
- Ensure the label wraps cleanly on long terms at 390px.
- Add `lang="ar-Latn-MA"` (for Latin-script Darija) to the Darija container; do not set `dir="rtl"` for Latin script.
- Apply the same pattern to lesson and project Darija blocks for consistency.

**Acceptance:** a visible gap between the label and the text at 390 and 1440; no concatenation in any view.

#### U-11 — Mobile lesson toolbar is too tall (Low)

**Location:** lesson action bar at 390px.

**Evidence:** buttons stack vertically; the toolbar consumes significant vertical space before the content.

**Cause:** the action bar wraps to a column at narrow widths without a compact pattern.

**Fix:**

- Use a sticky bottom action bar on mobile with one primary action (“Marquer terminé” or “Continuer”) and an overflow menu for secondary actions.
- Keep touch targets at least 44×44px.
- Move bookmark and previous/next into the overflow menu or the lesson header.
- Add safe-area padding for iOS.

**Acceptance:** the first content section is visible without excessive scrolling; all actions remain reachable.

#### U-12 — Mixed icon language (Low)

**Location:** UI SVG icons in `WA.ui.icon()`; emoji in lesson headings (`🧭 Consignes`) and module glyphs (`</>`, `{}`).

**Evidence:** source inspection and screenshots.

**Cause:** different authoring moments; emoji are convenient but render differently across platforms.

**Fix:**

- Choose one icon system for UI chrome (Lucide, Phosphor, or a small custom set) and document it.
- Keep emoji only where they are pedagogical content, not interface chrome.
- If module glyphs are a brand element, keep them but standardize size, weight, and alignment.
- Ensure icons are `aria-hidden="true"` when paired with text, and have an accessible name when icon-only.

**Acceptance:** no emoji used as a control icon; icon sizes and stroke weights are consistent.

#### U-13 — Unknown routes silently render the dashboard (Low)

**Location:** `assets/js/app.js` route fallback.

**Evidence:** `ROUTES[name] || 'dashboard'`.

**Cause:** a convenience fallback for empty hashes also catches typos and broken links.

**Why it matters:** a learner who follows a stale link sees the dashboard and may not understand why; analytics cannot distinguish a real dashboard visit from a broken route.

**Fix:**

- Treat an empty hash as dashboard.
- For a non-empty unknown hash, render a “Page introuvable” view with links to dashboard, search, and the last lesson.
- Log the unknown route in development.

**Acceptance:** unknown routes have an explicit state; empty hash still opens the dashboard.

#### U-14 — Empty chapter state is a strength (Positive)

**Location:** `#/lesson/html/4`.

**Evidence:** the page explains that the chapter is not written and offers “Chapitre suivant disponible” and “Dernier chapitre du module” links.

**Recommendation:** keep this pattern and reuse it for unavailable labs, projects, and search results. It turns a dead end into a next step.

#### U-15 — Dashboard accessibility is clean (Positive)

**Location:** dashboard at 1440 and 390.

**Evidence:** axe reports zero violations; headings, landmarks, and contrast are sound.

**Recommendation:** use the dashboard as the baseline for the rest of the app. Do not regress it when adding new widgets.

### 8.5 Accessibility summary

| Page / state | axe violations | Details |
|---|---:|---|
| Dashboard, 1440 | 0 | Clean. |
| Dashboard, 390 | 0 | Clean. |
| Lesson, 1440 | 5 + 1 | 5 color-contrast findings + 1 critical `label` (CodeMirror). |
| Lesson, 390 | 5 + 1 | Same patterns; CodeMirror internal overflow. |
| PHP lab, 390 | 5 + 1 | Same patterns. |
| SQL lab, 1440 | Not separately counted; same editor/nav patterns expected. | Oracle state inspected visually. |

The automated results point to a clear conclusion: **the shell and dashboard are accessible, but the editor integration is not**. Fixing CodeMirror’s label and theme contrast would remove the majority of the automated debt.

Manual checks still required:

- keyboard-only navigation through sidebar, lesson, exercise, quiz, lab, notes, and dialogs;
- screen-reader announcements for route changes, quiz feedback, exercise results, toasts, and SQL errors;
- 200% zoom and 400% reflow;
- Windows High Contrast / forced-colors mode;
- `prefers-reduced-motion`;
- focus visibility on all interactive elements;
- target size (WCAG 2.2 SC 2.5.8) for icon buttons and chapter links.

### 8.6 Responsive summary

**Verified**

- 1440×900: full desktop layout; sidebar fixed; lesson readable; lab three-pane.
- 390×844: no page-level horizontal overflow; sidebar overlay; stat grid 2×2; topbar breadcrumb truncates; lesson readable; lab usable but editor internals overflow.
- 500×900: dashboard remains coherent.

**Breakpoints in the current CSS**

- `1120px`: lab three-pane collapses to one column.
- `1020px`: sidebar becomes overlay; topbar behavior changes; breadcrumb segments hide.
- `760px`: additional layout adjustments.
- `600px`: grids become one column; stats 2×2; main padding reduced; headline shrinks.

**Observations**

- The breakpoints are reasonable but not tokenized; they are scattered across the stylesheet.
- The lab’s 1120px collapse happens before the sidebar’s 1020px overlay, which is sensible: the lab needs width earlier.
- At 390px, the lesson toolbar stacks vertically and the editor overflows internally; these are the two main mobile issues.
- The 390px page height is 2376px on the dashboard, which is long but expected for a dashboard with modules and recent activity.

**Recommendation**

- Keep the current breakpoints if the refactor budget is limited; add a 480px breakpoint for small phones.
- If redesigning, standardize on 480 / 768 / 1024 / 1280 and use container queries for cards where useful.
- Use `clamp()` for display headings (e.g., 28px → 40px) instead of fixed sizes per breakpoint.
- Test at 320px (iPhone SE) and 360px (common Android) before claiming mobile support.

### 8.7 Content UX and bilingual presentation

**What works**

- French is the technical anchor; Darija is an explanation layer. This matches how many Moroccan learners actually study.
- The “Darija” callout is visually distinct and does not interrupt the French reading flow.
- Glossary examples include code, which makes abstract terms concrete.
- Exercise instructions exist in both languages; quiz explanations exist in both languages.

**What does not work**

- The Darija label concatenation in the glossary breaks the pattern visually.
- Some Darija is garbled or grammatically awkward (`qz01` Q1, `css/c02`), which is worse than no Darija because it reduces trust.
- There is no `lang` attribute on Darija blocks, so screen readers may pronounce Latin-script Darija with French phonetics. Use `lang="ar-Latn-MA"` for Latin-script Darija; use `lang="ar-MA"` and `dir="rtl"` only if the content is written in Arabic script.
- The language mode control exists, but the content does not consistently provide both languages for every block. A “Darija only” mode would expose gaps.
- The glossary term “Darija” label is not a term; it is a language flag. It should be styled as metadata, not as part of the definition.

**Recommendation**

- Standardize a `wa-bilingual` component with three modes: **FR**, **Darija**, **Les deux**.
- Show a small language chip with proper spacing, `lang`, and an optional audio/pronunciation hint later.
- Never machine-translate Darija; have a native speaker review it.
- Decide on a transliteration standard (e.g., “katkteb” vs “katktebb”) and document it in `CONTENT-GUIDE.md`.
- In the glossary, show FR and Darija as two labeled columns on desktop and stacked blocks on mobile, with a visible gap.

## 9. Design Recommendations

### 9.1 Visual direction

**Direction name:** “Atelier de code” — an editorial code notebook, not a generic SaaS dashboard.

The app already has the raw ingredients: a dark ink canvas, a strong mono font, a blue accent, and a warm Darija amber. The problem is not the palette; it is the lack of a governing idea and the accumulation of one-off values. The recommended direction keeps the dark-first developer feel but makes it more intentional:

- **Ink + paper + one electric accent.** Dark navy is the work surface; light mode is a soft paper blue, not pure white. Blue is for action and focus; amber is for Darija and warm annotations; green/red are reserved for success/error.
- **Code is first-class.** Code blocks and editors get the most careful spacing, contrast, and affordances. They should not look like embedded widgets; they should feel like the center of the product.
- **Editorial hierarchy.** Fewer cards, stronger headings, generous whitespace, clear section rhythm. Use borders and background steps instead of shadows for most separation.
- **Bilingual by design.** Darija is a visible, warm annotation layer, not a footnote. It gets a consistent chip, a tinted surface, and proper language metadata.
- **Honest states.** “Not available” is a designed state, not an error. Oracle, missing chapters, and MySQL-offline states should be clear, calm, and actionable.
- **One signature element.** A vertical “chapter rail” that shows progress through a module, or a code-gutter motif used in headers/empty states. Keep it subtle; do not cover the UI in zellige patterns.

**What to remove or reduce**

- The blue-to-purple gradient as a prominent accent. Keep it for the logo/brand moment only; use a flat accent color for buttons and links.
- Decorative shadows on most cards. Use one elevation for overlays and one subtle shadow for raised cards.
- Mixed emoji/SVG icons. Pick one system for chrome.
- Low-contrast “disabled” text. Replace with readable muted text plus a label.
- Equal-weight stat tiles as the dashboard’s main content. Lead with the next action and the learning path.

### 9.2 Design tokens

#### Typography

Keep the current families; they are appropriate and already loaded:

- **Body:** Inter, 400/500/600/700.
- **Display:** Space Grotesk, 500/600/700.
- **Mono:** JetBrains Mono, 400/500.

Proposed scale (9 sizes):

| Token | Size | Line height | Usage |
|---|---:|---:|---|
| `--text-xs` | 12px | 1.4 | Meta, timestamps, code labels. |
| `--text-sm` | 13px | 1.45 | UI labels, badges, table headers, code. |
| `--text-ui` | 14px | 1.5 | Buttons, inputs, navigation, secondary UI. |
| `--text-base` | 16px | 1.6 | Body copy, lesson prose. |
| `--text-lg` | 18px | 1.55 | Lead paragraphs, section intros. |
| `--text-xl` | 22px | 1.35 | H3 / card titles. |
| `--text-2xl` | 28px | 1.25 | H2 / page section titles. |
| `--text-3xl` | 36px | 1.15 | H1 on desktop. |
| `--text-4xl` | 48px | 1.05 | Hero/display only. |

Rules:

- Body copy is **16px**, not 15px. The current 15px is readable but slightly tight for long lessons.
- Code is **13px** with `line-height: 1.55`; do not go below 12px.
- Use `rem` and a 16px root.
- Limit weights to 400/500/600/700.
- Use `clamp()` for the H1: `clamp(1.75rem, 2.5vw, 2.5rem)`.
- Do not use more than three sizes in a single component.

#### Spacing

Use a 4px base scale:

| Token | Value |
|---|---:|
| `--space-1` | 4px |
| `--space-2` | 8px |
| `--space-3` | 12px |
| `--space-4` | 16px |
| `--space-5` | 20px |
| `--space-6` | 24px |
| `--space-8` | 32px |
| `--space-10` | 40px |
| `--space-12` | 48px |
| `--space-16` | 64px |

Replace one-off values such as 14px, 18px, 22px, and 26px. Card padding should be `var(--space-6)` on desktop and `var(--space-4)` on mobile. Section spacing should be `var(--space-10)` to `var(--space-12)`.

#### Radii and shadows

| Token | Value | Usage |
|---|---:|---|
| `--radius-s` | 8px | Buttons, inputs, small chips. |
| `--radius-m` | 12px | Cards, callouts, code blocks. |
| `--radius-l` | 16px | Modals, hero panels, large surfaces. |
| `--radius-pill` | 999px | Pills, avatars, segmented controls. |

| Token | Value | Usage |
|---|---|---|
| `--shadow-1` | `0 1px 2px rgba(0,0,0,.18)` | Raised card, sticky bar. |
| `--shadow-2` | `0 16px 40px rgba(0,0,0,.35)` | Modal, popover, command palette. |
| `--focus-ring` | `0 0 0 2px var(--bg), 0 0 0 4px var(--accent)` | Keyboard focus. |

In light mode, reduce shadow opacity (e.g., `rgba(15,30,60,.08)` and `.16`). Do not use shadows to compensate for weak borders.

#### Color tokens

The current palette is a good starting point. Keep it, but formalize semantic names and verify contrast. Proposed values:

**Dark theme**

| Token | HEX / value | Usage |
|---|---|---|
| `--bg` | `#0A0F16` | App background. |
| `--bg-soft` | `#0D1520` | Secondary background. |
| `--surface` | `#111B27` | Cards, panels. |
| `--surface-raised` | `#192534` | Hover, raised rows. |
| `--code-bg` | `#070C12` | Code editor/blocks. |
| `--border` | `#27374C` | Strong borders. |
| `--border-soft` | `#1C2837` | Dividers. |
| `--text` | `#E9EFF8` | Primary text. |
| `--text-muted` | `#A8B8CC` | Secondary text. |
| `--text-faint` | `#8A9CB2` | Meta text (verify 4.5:1). |
| `--accent` | `#5B8DFF` | Primary action, links. |
| `--accent-hover` | `#8CB0FF` | Hover/active. |
| `--accent-soft` | `rgba(91,141,255,.15)` | Tinted surfaces. |
| `--success` | `#34C27E` | Passed, completed. |
| `--warning` | `#E5A942` | Warning, attention. |
| `--danger` | `#F26B7D` | Error, destructive. |
| `--darija` | `#E0A05C` | Darija annotation accent. |

**Light theme**

| Token | HEX / value | Usage |
|---|---|---|
| `--bg` | `#F3F6FB` | App background. |
| `--bg-soft` | `#EAEFF7` | Secondary background. |
| `--surface` | `#FFFFFF` | Cards, panels. |
| `--surface-raised` | `#E9EFF9` | Hover, raised rows. |
| `--code-bg` | `#1B2230` | Code editor/blocks (dark code on light UI). |
| `--border` | `#D5DFED` | Strong borders. |
| `--border-soft` | `#E2E9F4` | Dividers. |
| `--text` | `#16202E` | Primary text. |
| `--text-muted` | `#47576E` | Secondary text. |
| `--text-faint` | `#63748C` | Meta text (verify 4.5:1). |
| `--accent` | `#2F6FE4` | Primary action, links. |
| `--accent-hover` | `#1B57C2` | Hover/active. |
| `--accent-soft` | `rgba(47,111,228,.10)` | Tinted surfaces. |
| `--success` | `#148050` | Passed, completed. |
| `--warning` | `#9C6A09` | Warning, attention. |
| `--danger` | `#BD3149` | Error, destructive. |
| `--darija` | `#A3611B` | Darija annotation accent. |

Rules:

- Do not use color alone to convey status. Pair it with an icon or text (“Réussi”, “À venir”, “Erreur”).
- Verify every text/background pair; do not assume the token is accessible because it looks good.
- For code comments and line numbers, define separate code-theme tokens and verify against `--code-bg`.
- Keep the dark code surface in light mode if you want code to feel consistent; alternatively, add a light CodeMirror theme and test both.

### 9.3 Layout system

| Token | Value | Usage |
|---|---|---|
| `--sidebar-w` | 280px | Desktop sidebar. |
| `--topbar-h` | 64px | Sticky topbar; used for `scroll-margin-top`. |
| `--content-max` | 1200px | Main content max width. |
| `--prose-max` | 72ch | Lesson prose measure. |
| `--lab-guide-w` | 280px | Lab guide column. |

- **App shell:** sidebar + main; main uses `max-width: var(--content-max)` with 24–32px padding.
- **Lesson:** two columns on desktop — content (max 72ch) + in-page TOC (240px). On mobile, TOC becomes a collapsible “Dans ce chapitre” panel.
- **Dashboard:** 12-column grid; hero spans 8, “next action” spans 4; module cards span 4 each; activity spans 12 or 8.
- **Lab:** full-width; three panes on desktop; tabs on mobile.
- **Use `min-width: 0`** on all grid/flex children to prevent overflow.

### 9.4 Page-level redesigns

#### Dashboard

**Current:** greeting, continue, stat tiles, module grid, recent activity.

**Recommended hierarchy:**

1. **“Reprendre” hero** — current chapter, module, progress, one primary CTA (“Continuer le chapitre 3”), secondary “Voir le parcours”. If the learner is new, show “Commencer par HTML 1” and a one-sentence explanation of the bilingual model.
2. **“Ton parcours”** — five module cards with a progress ring, available/total count, and a link to the first available chapter. Unavailable modules are visibly “À venir” but not clickable.
3. **“Cette semaine”** — a small weekly goal (e.g., 3 chapters or 45 minutes), editable, with a simple streak-free progress bar. Avoid heavy gamification.
4. **“Activité récente”** — last 3–5 lessons with timestamps and quiz scores.
5. **Stats** — move to a compact row below the fold; do not make four equal tiles the first thing a learner sees.

**Empty state:** a short welcome, a “Pourquoi FR + Darija ?” note, and a single start action. Do not show empty stat tiles.

#### Lesson

**Recommended structure:**

- Sticky chapter header with module/chapter, title, reading progress, bookmark, and “marquer terminé”.
- Objectives as a compact checklist.
- In-page TOC on desktop; collapsible on mobile.
- Sections with consistent heading levels and anchor IDs.
- Bilingual toggle (FR / Darija / Les deux) near the chapter header, persisted.
- Callouts with icon + left border; code blocks with filename, language, copy, and optional wrap.
- “Erreurs fréquentes” as a two-column table (wrong / fix) or accordion on mobile.
- “À retenir” summary in a tinted panel.
- Exercise and quiz as distinct cards with clear time estimates and progress.
- Sticky bottom navigation: previous / next / mark done; on mobile, one primary action + overflow.

**Fixes to include:** `scroll-margin-top`, editor label/contrast, mobile toolbar, and the bilingual spacing pattern.

#### Lab

**Recommended structure:**

- Toolbar: module tabs (HTML/CSS/PHP/SQL), dialect/dataset selectors (SQL), run/reset, status badge.
- Desktop: guide (collapsible) | editor | output, with a draggable divider that also supports keyboard arrows.
- Mobile: tabs “Code / Sortie / Guide”; run button sticky above the keyboard.
- Console: clear status line (“Succès · 42 ms”, “Erreur · ligne 3”), stdout/stderr separated, copy/clear actions.
- SQL: schema panel with table names and columns; result table with sticky header; query history (last 5) optional.
- Oracle: disabled state + explanation + “Essayer en SQLite”.
- HTML: file tabs with dirty indicators; preview refresh; console capture.
- PHP: show exit code and execution time; truncate long output with “afficher tout”.

#### Quiz

**Current:** all questions on one card, submit, score, explanations.

**Recommended:**

- For 6+ questions, use a stepper: one question at a time, progress “3/6”, previous/next, submit at the end.
- Allow “Vérifier” per question if the quiz is formative; otherwise keep the final submit and show explanations after.
- Review screen: score, per-question correct/incorrect, explanation, concept tag, “Revoir ce concept” link to the lesson section.
- Preserve answers on retry; shuffle options only if the content supports it.
- Add an estimated time (“≈ 5 min”) and a clear “Recommencer” action.

#### Progress

- Overall progress ring/bar with “X chapitres terminés sur Y disponibles”.
- Module sections with a progress bar and chapter rows: status chip, quiz score, exercise passed count, link.
- “Prochaine étape recommandée” card.
- Exercise stats: attempts, passed, best level.
- Reset action stays destructive and confirmed; explain what is preserved (notes, bookmarks).
- Unavailable chapters grouped under “À venir”, not mixed with available rows.

#### Glossary

- Search + module filter chips + A–Z index.
- Term cards with term, module badge, FR definition, Darija block (proper gap + `lang`), example code.
- Desktop: FR and Darija side by side; mobile: stacked.
- “Copier l’exemple” action.
- Empty state: “Aucun terme pour cette recherche” + clear filters.

#### Projects

- Project list with difficulty, estimated time, and “N étapes”.
- Detail view as a stepper: objective, steps, code, checkpoint, expected result.
- Per-step completion checkbox persisted; progress bar.
- “Ouvrir dans le labo” deep link with the step’s code prefilled.
- At least 3 projects to justify the section: a CRUD app, a form + validation app, and a small API/DB app.

#### Search

- Global search in the topbar and `Ctrl/Cmd+K` command palette.
- Results grouped by module, with chapter title, matched snippet, and module badge.
- Keyboard navigation (↑/↓/Enter), recent searches, and a clear empty state.
- Search should index glossary terms and projects, not only chapters.

#### Notes

- Autosave with a “Enregistré” indicator.
- Optional lesson link with a visible chip.
- Tags or a simple “À revoir / Compris” status.
- Search/filter; export all notes as Markdown.
- Empty state with a template.

#### Settings

- Theme (dark/light/system), language mode (FR/Darija/both), editor font size, reduced motion.
- Data: export JSON, export notes Markdown, reset progress (confirmed), delete all data (double confirmation).
- About: version, PHP/SQLite versions, Oracle/MySQL availability, credits.

### 9.5 Component specifications

A small, documented component set will do more for consistency than a full redesign. Each component should define default, hover, active, focus-visible, disabled, loading, and error states.

**Button**

- Variants: primary (accent fill), secondary (surface + border), ghost (transparent), danger (red fill/outline).
- Sizes: `sm` 32px, `md` 40px, `lg` 48px; icon-only buttons 40×40 or 44×44.
- Primary action: one per view/section. Do not render three primary buttons in a row.
- Loading: spinner + disabled + `aria-busy="true"`; keep the label width stable.
- Focus: `:focus-visible` ring, not `:focus` alone.
- Icon + label: gap 8px; icon `aria-hidden="true"`; icon-only needs `aria-label`.

**Input / search**

- Height 44px; label above; hint below; error below with `aria-describedby`.
- Search input has a visible label or an accessible name; placeholder is not a label.
- Clear button with `aria-label="Effacer la recherche"`.
- Do not use a 1px border as the only focus indicator.

**Card**

- Surface + 1px border + `--radius-m`; padding `--space-6`.
- Header (title + optional action), body, footer.
- Avoid nested cards; use dividers or tinted sections instead.
- One shadow level for raised cards; none for flat cards.

**Callout**

- Variants: info, tip, warning, danger, Darija.
- Left border 3px + tinted background + icon + title.
- Darija callout uses `--darija` and a language chip; do not use the same blue as info.

**Code block**

- Dark `--code-bg` in both themes (or a tested light theme).
- Header: filename/language + copy button; optional line numbers.
- 13px mono, line-height 1.55, horizontal scroll inside the block.
- Max height 480px with “Afficher tout” if longer.
- Copy button feedback: check icon + “Copié” for 1.2s.
- Do not wrap code by default; offer a wrap toggle.

**Tabs**

- Underline indicator, 44px height, roving tabindex, arrow-key navigation.
- `role="tablist"`, `role="tab"`, `role="tabpanel"`, `aria-selected`, `aria-controls`.
- On mobile, allow horizontal scroll rather than shrinking labels.

**Table**

- Sticky header; 1px row dividers; no zebra stripes unless needed.
- Numeric columns right-aligned; code/mono for SQL results.
- Wrap in a scroll container with `tabindex="0"` and an accessible label.
- On mobile, switch to stacked cards if the table has more than 4 columns.

**Toast**

- Bottom-right desktop, bottom-center mobile; 5s; pause on hover/focus.
- `role="status"` and `aria-live="polite"`; errors use `role="alert"` if urgent.
- Optional action (“Annuler”, “Voir”).
- Do not use a toast for information that must persist; use a callout.

**Dialog**

- Max width 480px; backdrop; focus trap; Esc closes; focus returns to the trigger.
- `role="dialog"`, `aria-modal="true"`, labelled by the title.
- Destructive confirmation uses a danger button and explains consequences.

**Empty state**

- Icon + title + one-sentence explanation + primary action.
- Use for missing chapter, no notes, no bookmarks, no search results, no projects.
- Keep the empty chapter pattern (“next available chapter”) as the model.

**Skeleton**

- Use for boot and route transitions: sidebar, topbar, content blocks.
- Prefer skeletons over a centered “Chargement…” for perceived performance.
- Respect `prefers-reduced-motion` (no shimmer).

**Progress**

- Bar/ring with text label and numeric value; `role="progressbar"`, `aria-valuenow`, `aria-valuemin`, `aria-valuemax`.
- Do not rely on color alone; add “X/Y” text.
- Use the available-chapter denominator until the curriculum is complete.

**Badge / status chip**

- Text + color + optional icon: “Disponible”, “À venir”, “Réussi”, “Échec”, “Oracle non disponible”.
- Ensure text contrast; do not use pale text on a pale tint.

### 9.6 Motion and micro-interactions

Motion should clarify state, not decorate. The current app is mostly static; adding a few purposeful transitions will make it feel more polished without becoming noisy.

**Tokens**

| Token | Value |
|---|---|
| `--dur-fast` | 120ms |
| `--dur-base` | 180ms |
| `--dur-slow` | 280ms |
| `--ease-out` | `cubic-bezier(.2,.7,.2,1)` |
| `--ease-in-out` | `cubic-bezier(.4,0,.2,1)` |

**Recommended interactions**

- **Route change:** content fades in and moves up 4px over 180ms; no full-page spinner if data is cached.
- **Sidebar:** slide-in 220ms with backdrop fade 180ms; close on route change.
- **Accordion / `<details>`:** 180ms opacity/translate for the content; avoid animating `height` if it causes layout jank (use grid rows or measure).
- **Button press:** `transform: scale(.98)` for 100ms; return on release.
- **Copy:** icon swaps to a check for 1.2s; no toast needed.
- **Progress:** bar/ring fills over 400ms on first render; do not re-animate on every route.
- **Quiz option:** selected state uses border + background, not only color; a subtle 120ms transition.
- **Toast:** slide up + fade 180ms; exit 120ms.
- **Lab run:** a small status pulse while running; stop when the result arrives.

**Rules**

- Animate `transform` and `opacity`, not `width`, `height`, `top`, or `left`.
- Respect `prefers-reduced-motion: reduce`: set durations to 0.01ms and disable transforms.
- No infinite animations except a loading spinner; no gradient animation; no bouncing.
- Do not stagger every list item; one coordinated entrance is enough.

### 9.7 Responsive recommendations

- **Breakpoints:** keep 600/760/1020/1120 for now if refactoring is expensive; add 480px. For a redesign, use 480/768/1024/1280.
- **Sidebar:** overlay below 1024px; focus trap; Esc closes; body scroll lock; close on route change. The current 1020px behavior is close.
- **Topbar:** height token; breadcrumb truncation; language/theme controls collapse into a menu below 480px.
- **Lesson:** single column below 1024px; TOC collapsible; code blocks horizontal scroll; toolbar sticky bottom.
- **Lab:** tabs below 768px (“Code / Sortie / Guide”); editor full width; output below; run button sticky.
- **Tables:** scroll container; stacked cards below 600px for wide tables.
- **Touch targets:** minimum 44×44px for primary controls; 24×24px is the WCAG 2.2 minimum, but 44px is better for learning on a phone.
- **Typography:** body 16px; H1 `clamp()`; avoid text below 12px.
- **Editor:** 13px mono on mobile; `min-width: 0`; internal horizontal scroll; optional wrap toggle.
- **Safe areas:** add `env(safe-area-inset-bottom)` to sticky bottom bars.

### 9.8 Accessibility recommendations

**Target:** WCAG 2.2 Level AA.

**Must fix now**

1. CodeMirror accessible name (U-01).
2. Contrast for comments, line numbers, and unavailable links (U-02).
3. `scroll-margin-top` for anchors under the sticky topbar (U-06).
4. Glossary label spacing (U-10).
5. Oracle state clarity (U-03) — also a cognitive accessibility issue.

**Keyboard**

- All interactive elements reachable in a logical order.
- Visible `:focus-visible` ring on every control.
- Skip link works and moves focus to `#wa-main`.
- Sidebar overlay traps focus, Esc closes, focus returns to the toggle.
- Dialogs trap focus and return focus.
- CodeMirror: provide an explicit “Sortir de l’éditeur” control or instructions for escaping the Tab trap.
- Tabs use arrow keys; menus use arrow keys/Esc.

**Screen reader**

- Route changes should announce the new page title; use a polite live region or move focus to the `h1`.
- Quiz/exercise feedback should be announced (`role="status"` / `aria-live`).
- SQL/PHP errors should be announced and associated with the output pane.
- `aria-current="page"` on the active nav item.
- `aria-expanded` and `aria-controls` on accordions/sidebar groups.
- `lang` attributes on French, Darija, and code samples where relevant.
- Icons are `aria-hidden` when decorative; icon-only buttons have labels.

**Visual**

- Contrast: 4.5:1 for normal text, 3:1 for large text and UI boundaries.
- Do not use color alone for status; add text/icons.
- Support 200% zoom and 400% reflow without horizontal page scroll.
- Support forced-colors mode: use `outline`/`border` for focus, not only `box-shadow`.
- Respect reduced motion.
- Ensure focus is not obscured by sticky chrome (SC 2.4.11).

**Forms**

- Labels are always visible; placeholders are examples, not labels.
- Errors are text + `aria-describedby`, not red border only.
- Search has an accessible name.
- Note editor has labels for title and body.

**Content**

- Use real headings in order; do not style a `<div>` as a heading.
- Provide alt text for meaningful images; decorative images use `alt=""`.
- Tables have `<th>` and captions where useful.
- Code blocks have a language label and copy button with an accessible name.

### 9.9 Bilingual content design

- **Language modes:** FR / Darija / Les deux. Default to “Les deux” for the current audience; persist the choice.
- **Darija metadata:** use `lang="ar-Latn-MA"` for Latin-script Darija. If the content is ever written in Arabic script, use `lang="ar-MA" dir="rtl"`.
- **Visual pattern:** a warm amber chip (“Darija”) + tinted surface + 6–8px gap. Do not concatenate the chip with the text.
- **Glossary:** term, FR definition, Darija definition, example. Two columns on desktop, stacked on mobile.
- **Terminology:** keep a shared glossary of technical terms (balise, attribut, requête, jointure, etc.) and use the same French term in every chapter. Darija explanations can vary, but the technical noun should be stable.
- **Transliteration:** choose a standard (e.g., “katkteb”, “l’”, “dyal”) and document it. Avoid mixing Arabic script and Latin script in the same block.
- **Review:** every Darija block should be read by a native speaker; machine translation is not acceptable for the final product.
- **Fallback:** if a Darija translation is missing, show the French text with a “Darija à venir” note rather than an empty block or a broken layout.

### 9.10 Reference points

Use these as references for patterns, not for copying visual identity:

| Reference | What to borrow |
|---|---|
| **MDN Learn** | Clear lesson structure, code examples, “try it” mindset, plain-language explanations. |
| **freeCodeCamp** | Step-by-step curriculum, immediate practice, visible progress. |
| **Scrimba** | Tight lesson/practice loop and a sense of momentum. |
| **Exercism** | Exercise levels, hints, solutions, and mentor-style feedback. |
| **Linear** | Restrained dark UI, crisp typography, command palette, keyboard-first interactions. |
| **Stripe Docs** | Editorial documentation layout, code blocks, navigation clarity. |
| **Raycast** | Command palette and fast search interaction. |
| **Duolingo** | Progress and habit loops (use sparingly; do not gamify before content is complete). |
| **WCAG 2.2 / WAI-ARIA APG** | Accessibility requirements and keyboard patterns. |
| **Inclusive Components** | Accessible accordions, tabs, tables, and dialogs. |
| **Moroccan visual culture (zellige, geometric patterns)** | A subtle signature motif in empty states/hero, at low opacity; avoid clichés and busy patterns. |

**What not to borrow:** generic SaaS dashboards with four equal KPI tiles, blue-purple gradients on every surface, glassmorphism, and confetti-driven gamification. The product’s identity should come from the code/language/learning loop, not from decoration.

## 10. New Feature Suggestions

Features are separated into **essential** (needed to make the current product credible) and **optional** (valuable after the foundation is solid). Complexity is estimated for a senior full-stack developer working with the current codebase.

### 10.1 Essential features

| # | Feature | Why it matters | Value | Complexity | Priority |
|---|---|---|---|---|---:|
| E-01 | **Content QA/lint pipeline** | Catches TODO, empty blocks, missing summaries, missing exercise/quiz, garbled placeholders before learners see them. | Very high | S | P0 |
| E-02 | **Exercise + quiz coverage for every available chapter** | Turns the reader into a course. Currently 14/15 chapters have no practice. | Very high | L | P0 |
| E-03 | **Complete the 15 available chapters to the c01 standard** | Removes stubs and broken Darija; makes the existing surface trustworthy. | Very high | L | P0 |
| E-04 | **Onboarding + goal setting** | A new learner needs a starting point, a weekly goal, and an explanation of FR/Darija. | High | M | P1 |
| E-05 | **Review mode / spaced repetition** | Reuses wrong quiz answers and failed exercises; turns practice into retention. | High | L | P1 |
| E-06 | **Quiz review with concept tags** | Learners see why they failed and which lesson section to revisit. | High | M | P1 |
| E-07 | **Granular progress** | Track sections read, exercises passed, quiz best score, and time; current progress is chapter-level only. | High | M | P1 |
| E-08 | **Mobile lab tabs** | Makes the editor usable on a phone; current stacked panes are cramped. | High | M | P1 |
| E-09 | **Content authoring guide + templates** | Makes it easy to add chapters consistently; the guide exists but needs a checklist and examples. | High | S | P1 |
| E-10 | **Search command palette** | Fits the developer-tool positioning; faster navigation than the sidebar. | Medium | M | P2 |
| E-11 | **Export / backup** | Protects notes and progress; enables moving between machines. | Medium | S | P2 |
| E-12 | **PWA / offline lessons** | Learners study on unstable networks; labs still need the server, but reading can work offline. | Medium | L | P2 |
| E-13 | **Error telemetry / structured logs** | Makes content and runtime bugs visible without asking users. | Medium | S | P2 |
| E-14 | **Accessibility regression check** | Prevents the CodeMirror/nav contrast issues from returning. | Medium | S | P1 |

### 10.2 Optional features

| # | Feature | Why it matters | Value | Complexity | Priority |
|---|---|---|---|---|---:|
| O-01 | **Accounts + cloud sync** | Multi-device progress and notes; prerequisite for classroom use. | High for scale | XL | P3 |
| O-02 | **Instructor dashboard** | Assign chapters, view cohort progress, author content. | High for schools | XL | P3 |
| O-03 | **Certificates / completion badges** | Motivation and proof of completion. | Medium | M | P3 |
| O-04 | **AI tutor / explain-this-code** | Personalized help, but cost, hallucination, privacy, and pedagogy risks. | Medium | L | P3 |
| O-05 | **Streaks / leaderboards** | Habit and cohort competition; can distract from learning. | Low–medium | M | P3 |
| O-06 | **Peer review / challenges** | Social learning and code review practice. | Medium | L | P3 |
| O-07 | **Docker-based Oracle/MySQL lab** | Real Oracle/MySQL without lying; heavy infrastructure. | Medium | L | P3 |
| O-08 | **Video/animated explanations** | Helps difficult concepts; expensive to produce and localize. | Medium | L | P3 |
| O-09 | **Arabic-script / RTL UI** | Serves learners who prefer Arabic script; requires design and content work. | Medium | L | P3 |
| O-10 | **Native mobile app** | Better mobile code editing; the PWA may be enough. | Low–medium | XL | P3 |
| O-11 | **Payment / subscriptions** | Only if the product becomes a business. | Low now | L | P3 |

### 10.3 Top three feature specifications

#### E-01 — Content QA pipeline

**Goal:** no chapter can be marked “available” unless it passes a deterministic checklist.

**Implementation sketch:**

- Add a CLI script `tools/content-lint.php` (not in the web root) that scans `content/`.
- Checks:
  - every manifest chapter has a `cNN.php` or is explicitly marked “planned”;
  - every available chapter has `objectives`, at least 3 sections, at least 2 mistakes, a summary, and no TODO/placeholder/ellipsis-only code;
  - every text/definition/note/tip/warning block has both `fr` and `darija`;
  - every syntax/example block has non-empty `code`;
  - every available chapter has `exNN.php` with 3 levels and `qzNN.php` with at least 5 questions;
  - every exercise level has instructions, starter, tests, hints, solution, and explanations;
  - every quiz question has a correct answer, explanation, and concept;
  - glossary terms have term, module, fr, darija, and example.
- Output a table of failures and exit non-zero.
- Run it in CI or a pre-commit hook.
- Add a “content status” section to the dashboard for the author (not the learner).

**Acceptance:** `php tools/content-lint.php` exits 0 for every chapter marked available; the CI job fails on regressions.

#### E-05 — Review mode / spaced repetition

**Goal:** help learners retain what they got wrong.

**Implementation sketch:**

- Derive a review queue from `quiz_results.answers` and `exercise_results` where `passed = 0`.
- Store a `review_items` table: `lesson_key`, `concept`, `source` (`quiz`/`exercise`), `last_seen`, `next_due`, `ease`, `interval`, `streak`.
- Use a simplified SM-2: “again / hard / good / easy” buttons or a binary “revu / à revoir”.
- Daily queue of 10–15 items; show the question, answer, explanation, and a link to the lesson section.
- Add a dashboard card: “À revoir aujourd’hui · 7 cartes”.
- Do not punish missed days; no streak loss.

**Acceptance:** a learner can review wrong answers in under 10 minutes; the queue shrinks when items are answered correctly.

#### E-04 — Onboarding + goal setting

**Goal:** a first-time learner knows where to start and why.

**Implementation sketch:**

- Three-step modal or route:
  1. “Ton objectif” — discover web development / pass a module / build a project / review basics.
  2. “Ton niveau” — beginner / some HTML-CSS / some PHP / comfortable.
  3. “Ton rythme” — 15 / 30 / 60 minutes per week.
- Recommend a starting chapter based on level and goal.
- Explain the bilingual model (“FR = référence, Darija = explication”).
- Persist in `settings` (`goal`, `level`, `weeklyMinutes`, `onboardingDone`).
- Show the weekly goal on the dashboard; allow editing in settings.
- Do not force onboarding for returning users; add a “Passer” link.

**Acceptance:** a new learner reaches the first lesson in under 60 seconds and can state what they will do this week.

### 10.4 Features explicitly not recommended now

- **Fake Oracle execution.** The app’s honesty is a strength. Do not simulate Oracle; keep the unavailable state and offer SQLite equivalents.
- **AI-generated lesson content without review.** The content already has quality issues; generating more will amplify them. Use AI for drafts only, with a human/native review gate.
- **Heavy gamification before content.** Streaks and leaderboards cannot compensate for missing chapters.
- **Multi-tenant auth before product-market fit.** It is a large architectural change; first decide whether the product is personal or classroom.
- **A native mobile app before a usable mobile web lab.** Fix the editor/tabs first.

### 10.5 Feature sequencing rationale

The current app has more features than content. Adding another feature increases the number of places where incomplete content is exposed. The correct sequence is:

1. make the existing 15 chapters trustworthy;
2. add practice to those chapters;
3. make the shell accessible and consistent;
4. add retention features (review, progress);
5. expand content;
6. only then consider accounts/classroom/monetization.

## 11. Technical Problems and Risks

### 11.1 Confirmed deployment exposure (Critical)

The current development setup is safe only on a trusted localhost. During this analysis, the PHP built-in server at `127.0.0.1:8088` was probed with `HEAD` requests:

| URL | Result | Impact |
|---|---|---|
| `/data/app.sqlite` | **HTTP 200**, 53,248 bytes | The entire application database (settings, notes, progress, history) can be downloaded. |
| `/data/sql_sandbox.sqlite` | **HTTP 200**, 40,960 bytes | The SQL sandbox database can be downloaded. |
| `/test.php` | **HTTP 200**, executed as PHP | A leftover test file is publicly executable. |
| `/src/bootstrap.php` | **HTTP 200**, executed as PHP | Source/bootstrap code is directly reachable. |
| `/content/curriculum.php` | **HTTP 200**, executed as PHP | Content PHP files are directly reachable. |
| `/index.php?devdump=1` | **HTTP 200**, JSON | Exposes PHP version, PHP binary path, MySQL info, datasets, modules, and written chapters. |

**Root cause:** `router.php` returns `false` for **any** existing file under the project root, so the built-in server serves it directly. There is no `public/` document root and no deny rule for `data/`, `src/`, `content/`, `views/`, or dotfiles.

**Why it is critical:** if the app is started on a school LAN, a shared machine, or a public server, anyone can download the SQLite databases, execute leftover PHP files, and read environment details. There is no authentication to slow them down.

**Mitigation (in order):**

1. **Move the document root to `public/`.** Put only `index.php`, `router.php` (dev), and `assets/` under it. Keep `src/`, `content/`, `data/`, and `views/` outside the web root.
2. If the current layout must stay, add web-server rules:
   - Apache: deny `data/`, `src/`, `content/`, `views/`, `*.sqlite`, `.*`, `_*.php`, `test.php`;
   - Nginx: `location ~ ^/(data|src|content|views)/ { deny all; }` and a similar rule for dotfiles/test files.
3. Restrict the dev router to an allowlist: `assets/` and the shell/API only. Never serve `data/` or `src/`.
4. Remove `test.php`, `_test_*.php`, `_probe.php`, `_lesson_backup.js`, `_m.html`, and `.cap2/` from the project.
5. Remove `?devdump=1` or gate it behind `PHP_SAPI === 'cli-server'` plus a localhost check and a secret.
6. Bind the dev server to `127.0.0.1`, never `0.0.0.0`, unless the exposure is fixed.
7. Add a deployment checklist and a smoke test that asserts `/data/app.sqlite` returns 403/404.

**Acceptance:** `/data/app.sqlite`, `/data/sql_sandbox.sqlite`, `/src/bootstrap.php`, `/content/curriculum.php`, `/test.php`, and `/?devdump=1` are not reachable from a browser.

### 11.2 Authentication and authorization (High)

- No login, users, roles, or ownership.
- Any caller can read/write notes, progress, bookmarks, and settings.
- Any caller can execute PHP/SQL through the API.
- There is no CSRF token, no rate limit, and no audit log.

For a personal local app, this is acceptable. For a classroom or public deployment, it is a blocker. The minimum viable auth would be:

- a `users` table and per-user scoping of every repository query;
- session cookies with `HttpOnly`, `Secure`, `SameSite=Lax`;
- CSRF tokens for POST;
- rate limits on `php-run`, `sql-run`, and `sql-reset`;
- an admin/teacher role if cohort features are added.

Do not add auth “just in case” before deciding whether the product is personal or classroom; it changes the data model and the UI.

### 11.3 Content completeness and quality (Critical product risk)

- 15/58 chapters; 43 missing.
- 1/15 loadable chapters has an exercise + quiz.
- Stub `css/c02`, TODO starter code, garbled Darija, project typo.
- No content validation or QA gate.

This is the largest product risk. A learner who follows the intended path hits missing chapters and empty practice early. The labs still work, but the course promise is not met.

**Mitigation:** see §10 E-01/E-02/E-03 and §12 Phase 1.

### 11.4 CDN and supply-chain dependency (High)

The shell loads:

- Google Fonts (Inter, Space Grotesk, JetBrains Mono);
- CodeMirror 5.65.18 CSS, theme, core JS, and seven mode files from cdnjs.

Risks:

- **Offline/school network:** if cdnjs or Google Fonts is blocked, the editor falls back to a textarea and typography changes. The app still works but looks and feels different.
- **Supply chain:** no SRI hashes, no pinned integrity check. A compromised CDN could serve malicious JS.
- **Privacy:** Google Fonts requests leak the user’s IP to Google; this may matter for a school.
- **Performance:** multiple blocking CSS requests and deferred JS requests; no preload for the editor core.
- **CSP:** a strict Content Security Policy would require `cdnjs.cloudflare.com` and `fonts.googleapis.com`/`fonts.gstatic.com`, or local hosting.

**Mitigation:**

- Vendor CodeMirror and fonts locally under `assets/vendor/` for offline use.
- If CDN is kept, add SRI hashes and `crossorigin="anonymous"`.
- Add a Content Security Policy and test it.
- Provide a clear fallback message when CodeMirror fails to load.
- Consider CodeMirror 6 or Monaco later, but only with an accessibility plan.

### 11.5 PHP sandbox limitations (High if multi-user)

The PHP executor is thoughtfully designed:

- real CLI process, no `eval()`;
- `php -n` to avoid loading user INI;
- `disable_functions` for shell/process/network functions;
- `open_basedir` restricted to the sandbox;
- 6-second timeout and 64 KB output cap;
- `proc_terminate()` for runaway scripts.

It is still not a multi-tenant security boundary:

- `php -n` may disable extensions the learner needs; the feature set is limited.
- Resource limits are PHP-level (6s, 64 KB output, 64 MB memory), not OS-level cgroups; concurrent runs can still exhaust host CPU, and each process can consume up to 64 MB.
- `open_basedir` protects files but not all side effects.
- Concurrent runs can exhaust CPU; there is no queue/rate limit.
- The sandbox is a shared temp directory; one run could potentially read another run’s files if names collide or if the code can list the directory.
- There is no per-user isolation.

**Mitigation for public/classroom use:** run each execution in a container (Docker/Firecracker/gVisor), with no network, read-only root, a per-run temp volume, memory/CPU limits, and a job queue. For a personal local app, the current design is acceptable with a localhost binding.

### 11.6 SQL sandbox limitations (High if multi-user)

- SQLite deny patterns block `ATTACH`, `DETACH`, `load_extension`, and virtual tables.
- A pattern-based deny list is not a SQL parser; bypasses or unexpected statements should be reviewed before exposure.
- MySQL execution is real if a local server is reachable; the target database/credentials and isolation are not documented.
- Oracle is not executed (correct), but the UI wording is contradictory.
- The sandbox DB is persistent and shared; a learner can drop tables or leave artifacts (`test_of`).
- There is no query timeout visible in the UI/API; a heavy query could block a request.
- There is no read-only mode; `DROP`, `DELETE`, and `UPDATE` are allowed by design for SQL practice.

**Mitigation:**

- Use a per-session/per-user SQLite file, or reset after each run.
- Add a query timeout and row limit.
- Add a “read-only practice” mode for SELECT lessons.
- Document the MySQL target and use a dedicated sandbox database/user with minimal privileges.
- Review the deny list with a SQL parser or an allowlist for the lesson’s expected statements.
- Remove the leftover `test_of` table and make reset drop all non-system tables.

### 11.7 Database migrations and data integrity (Medium)

- `CREATE TABLE IF NOT EXISTS` does not evolve existing tables.
- No `schema_version` table, no migration runner.
- No foreign keys between `progress`, `quiz_results`, `exercise_results`, `notes`, `bookmarks`, and `history`; `lesson_key` is a logical key.
- `history` grows without pruning.
- `lab_snippets` exists but has no verified UI.
- SQLite is single-writer; fine for one user, not for a classroom.

**Mitigation:**

- Add a `schema_version` table and numbered migrations.
- Add indexes on `lesson_key` and `viewed_at` if history grows.
- Prune history to the last N rows or aggregate it.
- Add a backup/export command.
- Document the single-user assumption.

### 11.8 Testing and CI (Medium)

- No PHPUnit, no browser tests, no content tests, no CI.
- The only “tests” are leftover `_test_*.php` and `_probe.php` files in the web root.
- The critical flows were verified manually during this analysis, but there is no regression safety net.

**Mitigation:**

- Add a small PHP test suite for `Content`, `Repos`, `Api` validation, `SqlSplitter`, and the content lint.
- Add a Playwright test for: boot → dashboard → lesson → exercise → quiz → lab → notes → progress.
- Add axe checks to the Playwright run.
- Add a CI job that runs PHP lint, content lint, unit tests, and the browser smoke test.
- Remove the root test/probe files from the web root; move tests to `tests/`.

### 11.9 Backup, export, and data loss (Medium)

- All progress and notes live in `data/app.sqlite`.
- There is no export, backup, or restore UI.
- Deleting the file or resetting progress loses data.
- The SQL sandbox is separate but also unbacked.

**Mitigation:**

- Add “Exporter mes données” (JSON) and “Exporter mes notes” (Markdown).
- Add an automatic daily backup of `app.sqlite` to `data/backups/` with a retention policy.
- Add an import path with validation.
- Document where the data lives.

### 11.10 Repository hygiene (Medium)

The project root contains:

- `test.php` — “Hello World”;
- `_test_api.php`, `_test_cmd.php`, `_test_executor.php`, `_test_sql.php`;
- `_probe.php`;
- `_lesson_backup.js`;
- `_m.html`;
- `.cap2/` — a Chrome profile directory;
- `data/app.sqlite`, `data/sql_sandbox.sqlite`.

These files:

- clutter the project and confuse another developer;
- are served/executed by the dev router;
- may contain credentials, test data, or debug output;
- make the git status noisy.

**Mitigation:** move tests to `tests/`, add a `.gitignore` for `data/*.sqlite`, `.cap2/`, `_*`, and temp files; remove the rest. Keep a `data/.gitkeep` and create the DB on first run.

### 11.11 Git repository scope (Medium)

The git repository root is `C:\Users\WINDOWS 11`, not the project folder. This means:

- `git status` includes unrelated files from the home directory;
- committing from the repo root can accidentally include personal files;
- the project is not self-contained as a repository.

**Mitigation:** initialize a git repository inside `PHP_AppCours` (or use a dedicated worktree) and commit only the project. Add a `.gitignore` for data, temp, and editor files.

### 11.12 Performance and scalability (Low–Medium)

- No bundling/minification; six JS files and multiple CSS/JS CDN requests.
- `Content::search()` likely scans content files on each search; at 58 chapters this is fine, at 500 it may not be.
- The bootstrap payload includes the full manifest and availability; small now, grows with content.
- CodeMirror loads seven mode files even when only one lab is used.
- No caching headers for static assets (the dev server may not set them).
- No image optimization because there are no images yet.
- No lazy loading for long lessons; all sections render at once.

**Mitigation:**

- Bundle and minify assets for production; load only the CodeMirror modes needed per lab.
- Add a content index (SQLite FTS or a generated JSON index) if search grows.
- Add cache headers/fingerprinting.
- Lazy-render long lesson sections or use `<details>` for optional blocks.
- Measure with Lighthouse before optimizing further.

### 11.13 XSS and content rendering (Low now / Medium if user HTML is added)

- Content blocks are rendered with `innerHTML` because they contain trusted HTML authored in PHP files.
- Current notes, titles, and search snippets are appended as **text nodes** through the `h()` helper, so they are not interpreted as HTML. The current implementation is safe for those fields.
- The risk would become real if notes, project descriptions, or imported content are later rendered as HTML or Markdown without sanitization.

**Mitigation:**

- Treat content PHP files as trusted; sanitize any user-authored HTML.
- Keep using `textContent` for notes, titles, and search snippets.
- If Markdown is added, use a sanitizer with an allowlist.
- Add a CSP as defense in depth.

### 11.14 Error handling and observability (Medium)

- API errors are French strings; no error codes.
- PHP warnings/notices may be displayed depending on INI; `error_reporting(E_ALL)` is set but display settings are not explicit.
- No structured logs, no request IDs, no error tracking.
- `devdump` is the only diagnostic surface.

**Mitigation:**

- Add a logger with a request ID and a log file outside the web root.
- Return `{ok:false, code, message}` with stable codes.
- Hide detailed errors in production; show a friendly message.
- Add a health endpoint that does not leak paths.

### 11.15 Risk matrix

| ID | Risk | Likelihood | Impact | Severity | Mitigation |
|---|---|---|---|---|---|
| R-01 | SQLite DB downloadable via dev router | High if exposed | Critical | **Critical** | `public/` docroot; deny rules; remove test files. |
| R-02 | Unauthenticated code/SQL execution | High if exposed | Critical | **Critical** | Localhost binding; auth; rate limits; containers. |
| R-03 | Content incomplete / stubs | Certain | High | **Critical** | Content QA + completion plan. |
| R-04 | CDN outage/block | Medium | Medium | High | Vendor assets; SRI; fallback. |
| R-05 | PHP sandbox escape/resource abuse | Low locally, medium public | High | High | Containers; cgroups; queue. |
| R-06 | SQL deny-list bypass | Medium | High | High | Parser/allowlist; read-only mode; per-user DB. |
| R-07 | No migrations | High over time | Medium | Medium | Schema version + migrations. |
| R-08 | No tests/CI | High | Medium | Medium | Unit + browser + axe CI. |
| R-09 | Data loss (no backup) | Medium | High | High | Export + backups. |
| R-10 | Repo hygiene / test files exposed | Certain | Medium | High | Remove/move; `.gitignore`. |
| R-11 | XSS via notes (if HTML) | Low–medium | Medium | Medium | `textContent`/sanitizer. |
| R-12 | No CSP/security headers | High | Medium | Medium | CSP, HSTS, nosniff, frame-ancestors. |
| R-13 | Error details leak paths | Medium | Low–medium | Medium | Hide in prod; structured logs. |
| R-14 | Search performance at scale | Low now | Low | Low | Index/FTS later. |

## 12. Prioritized Improvement Roadmap

### 12.1 Planning assumptions

- One senior full-stack developer, with content authoring support from the product owner and a native Darija reviewer.
- Part-time content work in parallel with engineering.
- Estimates are directional, not commitments.
- The application remains single-user and local-first until Phase 5; auth/classroom is a separate decision.

### 12.2 Phase overview

| Phase | Focus | Duration | Exit criteria |
|---|---|---|---|
| **0. Stop the bleeding** | Security exposure, critical accessibility, copy bugs. | 1–2 days | DB/source not reachable; zero critical axe violations; Oracle copy fixed. |
| **1. Content foundation** | Make the 15 available chapters trustworthy and add practice. | 2–4 weeks | 15/15 chapters pass content lint; each has 3-level exercise + quiz; no TODO/garbled Darija. |
| **2. Content expansion** | Complete the remaining 43 chapters in priority order. | 4–8 weeks | 58/58 chapters available, or a documented descope with a coherent path. |
| **3. Design system + UX** | Tokens, components, page redesigns, mobile lab. | 2–3 weeks | ≤9 font sizes/page; 4 radii; 2 shadows; mobile lab tabs; WCAG 2.2 AA. |
| **4. Product features** | Onboarding, review mode, progress, search, export. | 3–4 weeks | New learner reaches first lesson <60s; review queue works; export works. |
| **5. Hardening / scale** | Auth if needed, containers, CI, backups, monitoring. | 2–3 weeks | Deployable beyond localhost; tests/CI green; backups verified. |

Phases 1 and 3 can run in parallel; Phase 2 depends on Phase 1’s quality gate; Phase 4 depends on stable content and design.

### 12.3 Detailed backlog

| Priority | Item | Impact | Effort | Dependencies | Done when |
|---|---|---|---:|---|---|
| **P0** | Move to `public/` document root / add deny rules | Critical | S | None | `/data/app.sqlite` returns 403/404; `/src`, `/content`, `/views` blocked. |
| **P0** | Remove `devdump` or gate it | Critical | S | None | `/?devdump=1` returns 404 unless local + secret. |
| **P0** | Remove root test/probe files and `.cap2` | High | S | None | Project root contains only app files. |
| **P0** | CodeMirror accessible name | Critical | S | None | axe `label` violation gone on lesson/labs. |
| **P0** | Fix editor/nav contrast | High | S | Design tokens | axe color-contrast violations gone. |
| **P0** | Fix Oracle copy + disable Run | High | S | None | Oracle state is unambiguous; SQLite switch works. |
| **P0** | Fix glossary label spacing | Medium | S | None | No “DarijaAttribut…” at 390/1440. |
| **P0** | Add `scroll-margin-top` | Medium | S | `--topbar-h` | Anchored headings visible below topbar. |
| **P1** | Content lint script + checklist | Very high | S | None | `content-lint` exits 0 for available chapters. |
| **P1** | Complete `css/c02` and remove stubs/TODOs | Very high | M | Content guide | Chapter passes lint; no TODO/ellipsis. |
| **P1** | Add `exNN` + `qzNN` for all 15 available chapters | Very high | L | Content lint | 15/15 have 3-level exercise + quiz. |
| **P1** | Native Darija review of all content | High | M | Content freeze | Zero flagged Darija issues in reviewed chapters. |
| **P1** | Design tokens: type, spacing, radii, shadows | High | M | None | Tokens documented; pages use them. |
| **P1** | Mobile lab tabs + editor overflow fix | High | M | Tokens | No editor overflow at 320/360/390; tabs work. |
| **P1** | Sidebar availability filter | Medium | S | None | Default shows available; “À venir” toggle. |
| **P1** | Accessibility manual pass | High | M | P0 fixes | Keyboard/screen-reader checklist complete. |
| **P2** | Onboarding + goal setting | High | M | Settings schema | New learner starts in <60s; goal persists. |
| **P2** | Review mode / spaced repetition | High | L | Quiz/exercise data | Daily queue works; wrong answers resurface. |
| **P2** | Quiz review + concept tags | High | M | Quiz schema | Review screen links to lesson sections. |
| **P2** | Granular progress | High | M | Progress schema | Sections/exercises/quizzes tracked. |
| **P2** | Search command palette | Medium | M | Search index | Ctrl/Cmd+K works; keyboard navigation. |
| **P2** | Export/backup | Medium | S | None | JSON + Markdown export; restore tested. |
| **P2** | Error logging + health endpoint | Medium | S | None | Logs outside web root; no path leaks. |
| **P3** | Complete remaining 43 chapters | Very high | XL | Phase 1 | 58/58 available or documented descope. |
| **P3** | Accounts/cloud sync | High for scale | XL | Product decision | Per-user data; auth/CSRF/rate limits. |
| **P3** | Instructor dashboard | High for schools | XL | Accounts | Cohort/assignment views. |
| **P3** | Docker Oracle/MySQL lab | Medium | L | Infra | Real engines, isolated, documented. |
| **P3** | PWA/offline lessons | Medium | L | Asset vendoring | Lessons readable offline; labs require server. |
| **P3** | AI tutor | Medium | L | Content quality | Guardrails, cost, privacy, evaluation. |

### 12.4 Recommended first sprint (10 working days)

**Days 1–2 — Security and critical fixes**

- Move to `public/` or add strict deny rules.
- Remove test/probe files, `.cap2`, `_lesson_backup.js`, `_m.html`.
- Remove/gate `devdump`.
- Fix CodeMirror label, contrast, glossary spacing, `scroll-margin-top`.
- Fix Oracle copy and disable Run.

**Days 3–5 — Content foundation**

- Write `tools/content-lint.php` and the chapter checklist.
- Fix `css/c02`, `html/ex01` TODOs, `qz01` Darija, `project1` typo.
- Freeze the 15 available chapters for native Darija review.

**Days 6–8 — Practice coverage**

- Add exercise + quiz for the highest-priority chapters (HTML 2/3/6/7, CSS 1/8/9/10).
- Use `html/ex01` and `html/qz01` as templates.
- Run the content lint and a manual pass on each.

**Days 9–10 — Design system and mobile**

- Add type/spacing/radius/shadow tokens.
- Apply them to the lesson and lab first.
- Add mobile lab tabs and fix editor overflow.
- Re-run axe at 1440 and 390.

**Sprint exit criteria:**

- No critical/high security exposure.
- 15/15 available chapters pass lint.
- At least 5 chapters have exercise + quiz (the rest scheduled).
- Zero critical axe violations; zero page overflow at 390.
- A short demo script works end-to-end.

### 12.5 Success metrics

| Metric | Current | Target (after Phase 1–2) |
|---|---:|---:|
| Loadable chapters | 15/58 (25.9%) | 58/58 or documented descope |
| Chapters with exercise + quiz | 1/15 | 15/15 (then 58/58) |
| Content lint failures | Unknown | 0 for available chapters |
| TODO/placeholder hits | At least 3 files | 0 |
| axe critical violations | 1 | 0 |
| axe contrast findings | 5 | 0 |
| Page overflow at 390 | 0 (page), editor internals | 0 everywhere |
| Distinct font sizes on lesson | 21 | ≤9 |
| Distinct radii on lesson | 9 | ≤4 |
| Time to first lesson (new user) | Not measured | <60 seconds |
| Quiz completion rate | Not measured | Track after analytics |
| 7-day return rate | Not measured | Track after analytics |
| Backup/export | None | JSON + Markdown, tested |

### 12.6 What to defer

- Multi-user auth and classroom features until the product decision is made.
- AI tutoring until content quality and evaluation are in place.
- Native mobile app until the mobile web lab is usable.
- Heavy gamification until the core loop is complete.
- Oracle/MySQL container lab until the SQLite experience is polished.

### 12.7 Sequencing risks

- **Content and design in parallel can conflict:** freeze the chapter schema before redesigning lesson components.
- **Adding exercise/quiz files exposes engine bugs:** test the exercise/quiz engine with 3–5 chapters before authoring all 58.
- **Token refactor can regress the dashboard:** apply tokens page by page with screenshots at 1440/390.
- **Security fix can break local workflows:** document the new docroot and update the run command; add a smoke test.
- **Native Darija review is a bottleneck:** schedule it early and in batches; do not author all 58 chapters before the first review.

## 13. Questions and Unknown Information

The following questions are ordered by their impact on the next phase. They are not blockers for this report; they are decisions that would change the design or architecture.

### 13.1 Product and strategy

1. **Is WebAcademy a personal learning tool or a classroom product?** The current code is single-user. If it is meant for a school, accounts, per-user data, and a teacher view are required, which is a major architectural change.
2. **Who is the primary audience?** EMSI students, self-taught learners, or a broader francophone audience? The Darija layer suggests Morocco, but the level and scope are not explicit.
3. **What is the target outcome?** Pass a module, build a portfolio project, prepare for an exam, or learn for fun? The dashboard and onboarding should reflect this.
4. **Is there a deadline or a curriculum requirement?** The 58-chapter manifest suggests a full course; the 15 available chapters suggest a work in progress. Knowing the deadline determines whether to complete all 58 or descope to a coherent 15–20 chapter path.
5. **Is the product free, paid, or internal?** This affects auth, privacy, payment, and content licensing.
6. **Is there a brand identity beyond “WebAcademy”?** Logo, colors, tone, and whether the current blue/purple direction is intentional.

### 13.2 Content

7. **Who authors the content?** A single author, a team, or AI-assisted drafts? The answer determines whether a CMS/authoring UI is worth building.
8. **Who reviews the Darija?** A native speaker is essential. Is that person available, and how many review cycles can they handle?
9. **Is there a Darija transliteration standard?** The current content mixes spellings. Decide on a convention and document it.
10. **What is the priority order for the missing 43 chapters?** Suggested: finish HTML (4, 5, 8), then CSS (3–7, 11–14), then PHP (2–8, 10–15), then SQL (1–7, 9–14), then Integration (3–7). But the learner journey may require a different order.
11. **Should the app hide unavailable chapters by default?** This is a UX decision with product implications: hiding makes the product feel complete; showing makes the roadmap visible.
12. **How many projects should exist?** The current one has two steps. A credible “projects” section needs at least 3 complete projects.
13. **Is Oracle actually required by the curriculum?** If yes, a Docker/remote Oracle lab is needed. If not, keep the honest unavailable state and focus on SQLite/MySQL.
14. **Is MySQL required?** The code path exists but was not verified. Is WAMP/XAMPP the expected environment? Should the app detect and guide the user?
15. **What is the glossary scope?** Only terms used in written chapters, or the full 58-chapter vocabulary? The current glossary is a single PHP file; at scale it may need structure.

### 13.3 Design and UX

16. **What is the accessibility target?** WCAG 2.2 AA is the recommended baseline. Is there a legal or institutional requirement?
17. **Is dark mode the default, or should it follow the OS?** The current default is dark unless the OS prefers light.
18. **Is mobile a first-class platform or a companion?** The answer determines how much to invest in mobile code editing versus reading/review.
19. **Should the UI be French-only, or should the interface itself be translated to Darija/Arabic?** The content is bilingual; the chrome is French. This is a product choice.
20. **Is Arabic script/RTL in scope?** If yes, the design system needs logical properties, RTL testing, and a font strategy.
21. **What is the brand personality?** “Atelier de code” is the recommendation; the owner may prefer a more playful, academic, or corporate direction.
22. **Are there existing screenshots, brand assets, or a design file?** None were found in the repository.

### 13.4 Technical and deployment

23. **Where will the app run?** Localhost, a school LAN, a VPS, or shared hosting? This determines the document-root fix, PHP version, and server configuration.
24. **Is Apache/WAMP the production target?** The current `router.php` is for the PHP built-in server. Apache/Nginx rules are not included.
25. **Is HTTPS available?** Required for secure cookies/auth and for code execution in a public deployment.
26. **Will users have accounts?** If yes, the data model and API need per-user scoping.
27. **What is the backup policy?** Where should `app.sqlite` backups live, and who restores them?
28. **Is there a privacy policy?** Notes and progress are personal data; Google Fonts/CDN requests also have privacy implications.
29. **What browser support is required?** Chrome only, modern evergreen, or older school machines? This affects JS syntax and CSS features.
30. **Is a Content Security Policy required?** If yes, CDN assets must be allowlisted or vendored.
31. **Are code-execution endpoints expected to be public?** If yes, the current sandbox is not sufficient; containers and rate limits are required.
32. **What is the expected concurrency?** One learner, a class of 30, or hundreds? SQLite and the PHP sandbox behave very differently at each scale.
33. **Is there an existing test/CI environment?** None was found.
34. **Where is the canonical git repository?** The current repo root is the user’s home directory, which is not suitable for collaboration.

### 13.5 Unverified areas

The following were **not** verified and should not be assumed to work:

- widths below 390px (320/360) and tablet widths between 601 and 1019px;
- Firefox, Safari, Edge, and real iOS/Android browsers;
- keyboard-only completion of every flow;
- screen-reader announcements (NVDA, VoiceOver, TalkBack);
- 200% zoom and 400% reflow;
- Windows High Contrast / forced-colors mode;
- `prefers-reduced-motion` behavior;
- real MySQL execution (server was not reachable);
- Oracle execution (client not installed, by design);
- SQL deny-list bypass resistance;
- PHP sandbox escape/resource-exhaustion resistance under concurrent load;
- search ranking, fuzzy matching, and empty-state behavior (notes/search are currently rendered as text, not HTML);
- performance under 58+ chapters and long lessons;
- print styles;
- offline behavior;
- CSP/security headers;
- backup/restore;
- exact contrast ratios (axe reported violations, but ratios were not all captured);
- heading order and landmark structure on every page;
- whether `examMode` has any UI behavior;
- whether `lab_snippets` is used anywhere;
- whether the SQL sandbox `test_of` table affects lessons;
- whether `history` growth is bounded.

### 13.6 Assumptions made in this report

- The application is intended to remain a **single-user, local-first** learning tool in the near term.
- The 58-chapter manifest is the intended curriculum, not a placeholder.
- The French/Darija bilingual model is a core product requirement, not a temporary feature.
- The current content files are the source of truth; there is no hidden CMS or database content.
- The screenshots and runtime checks reflect the code at the analysis date; later changes may invalidate specific findings.
- The app is not currently deployed publicly; the security findings are about what would happen if it were.

### 13.7 Decisions needed before the next phase

| Decision | Options | Recommended |
|---|---|---|
| Product scope | Personal tool vs classroom | Personal first; classroom only with a funded auth/classroom phase. |
| Content strategy | Complete 58 vs descope to a coherent path | Complete the 15 available chapters + practice first; then decide 58 vs 30. |
| Deployment | Localhost vs LAN vs public | Localhost until security is fixed; then a `public/` docroot + auth. |
| Design direction | Current blue/purple vs “Atelier de code” | “Atelier de code”; keep the palette but enforce tokens. |
| Mobile priority | Reading only vs full lab | Reading + review first; mobile lab tabs next. |
| Oracle | Keep honest unavailable vs Docker lab | Keep honest unavailable; Docker only if the curriculum requires it. |
| Auth | None vs accounts | None for the personal phase; decide before classroom. |
| Content authoring | PHP files vs CMS | PHP files + lint for now; CMS only with a team. |

### 13.8 What would change the conclusions

- If the product is intended for a classroom, the security/auth findings become **P0 architecture**, not deployment polish.
- If the 58-chapter curriculum is a hard requirement with a near deadline, content completion dominates every other recommendation.
- If the target audience is beginner-only, the advanced PHP/SQL chapters can be descoped, making the product coherent sooner.
- If Oracle/MySQL are required by the institution, the SQL lab needs a real infrastructure plan, not a copy change.
- If mobile is the primary device, the lab/editor architecture needs a dedicated mobile design, not just responsive CSS.

---

*End of report. No application source files were modified during this analysis.*

