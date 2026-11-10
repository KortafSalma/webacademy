# WebAcademy 2.0 — Implementation Report

## Overview
Transformed WebAcademy into a polished, professional learning platform with distinctive UI/UX, editorial design, WCAG 2.2 AA accessibility hardening, and security hardening, while preserving all existing PHP + Vanilla JS + CSS + SQLite/MySQL functionality, content, and data.

**Project path:** `C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours`  
**App version:** 2.0.1 (bumped from 2.0.0 to invalidate cached assets)  
**Document root:** `public/` (production); compatibility shims at root level

---

## 1. Files Modified

| File | Purpose | Key Changes |
|------|---------|-------------|
| `src/bootstrap.php` | Paths, version, limits | `APP_VERSION` `2.0.0` → `2.0.1`; added `APP_PUBLIC`, `APP_ASSETS`; limits: `APP_MAX_REQUEST_BYTES` 1048576, `APP_MAX_CODE_BYTES` 32768, `APP_MAX_SQL_BYTES` 65536; disabled web error display; `APP_TMP` separator; 0700 permissions |
| `public/index.php` | Public front controller | Security headers, CSP, same-origin POST checks, JSON content-type checks, 413/405/400/500 handling, request ID, generic errors, API dispatch, devdump 404, shell rendering |
| `public/router.php` | Dev-server router | Static-file policy, 404 on private paths, favicon.svg mapping, CSP in headers |
| `router.php` | Root compatibility router | Private path blocking (`/src`, `/data`, `/content`, `/views`, `/APPLICATION_ANALYSIS_REPORT.md` → 404); `/assets/` → `public/assets/`; `/favicon.svg` → `public/favicon.svg` |
| `views/shell.php` | SPA shell markup | Fraunces/IBM Plex fonts; CodeMirror CDN; skip link; sidebar shell; route status region; toast; `favicon.svg`; new asset order including `quiz.js` |
| `public/assets/css/app.css` | Complete design system (~68 KB) | Tokens, light/dark parity, shell/sidebar/topbar, dashboard, lesson reader, labs, projects, glossary, notes, progress, search, states, dialogs/toasts, CodeMirror, responsive rules, reduced-motion/forced-colors/print |
| `public/assets/js/api.js` | Client API | `window.WA.api.get()` / `.post()` to `index.php?api=...`; AbortController + 30s timeout; JSON parsing with fallback |
| `public/assets/js/ui.js` | UI state management | Theme toggle, language switch, nav mobile, toast rendering, error state |
| `public/assets/js/editor.js` | Code editor init | CodeMirror config with custom colors, line numbers, gutter |
| `public/assets/js/app.js` | Router & page controllers | Router hashchange; `dashboardPage()`, `lessonPage()`, `labPage()`, `projectsPage()` (async API fetch), `glossaryPage()` (async API fetch), `searchPage()`, `notesPage()`, `progressPage()`, `settingsPage()`, `notFoundPage()` with `h1` |
| `public/assets/js/lesson.js` | Lesson reader | TOC, chapter navigation, exercises/quizzes read from `data.lesson.exercise`/`data.lesson.quiz` with normalized payloads; evaluation jump links |
| `public/assets/js/quiz.js` | Quiz UI/evaluation | Dataset lookup fixed (`data.lesson.exercise.dataset`); SQL quiz checks; evaluation flow |
| `public/assets/js/lab.js` | HTML/CSS/PHP/SQL labs | Mobile panes (HTML/CSS/PHP/SQL); execute sandbox; reset; dataset rows |
| `public/favicon.svg` | New favicon | 313-byte SVG WebAcademy icon; served with `image/svg+xml` content-type |
| `.htaccess` | Root-level URL rewriting | Private path blocking; `assets/` → `public/assets/`; `favicon.svg` → `public/favicon.svg`; front controller |

**Removed files** (security hardening): `test.php`, `_probe.php`, `_test_api.php`, `_test_cmd.php`, `_test_executor.php`, `_test_sql.php`, `_lesson_backup.js`, `_m.html`, `.cap2`

---

## 2. Design Improvements

### Editorial Color Palette
- **Primary:** Warm editorial orange (`#b0431f`) for accents and highlights
- **Text:** Editorial gray-black (`#14110d`) dark, `#fcfcfc` light
- **Muted/Secondary:** `#6b6153` (muted), `#7b7061` (faint), `#b3a694` (light muted)
- **Code:** `#171411` (code bg), `#f4ede2` (code ink), `#332c24` (code line)

### Technical Typography
- **Display:** Fraunces serif (`9..144, 400..700` opsz) — editorial, readable
- **Body:** IBM Plex Sans (`400, 500, 600, 700`) — technical, highly legible
- **Monospace:** IBM Plex Mono (`400, 500`) — code listings, CodeMirror

### Color Tokens (CSS `:root`)
- `--font-display`, `--font-body`, `--font-mono`
- `--sidebar-w: 288px`, `--topbar-h: 66px`, `--content-max: 1200px`, `--reading-max: 790px`
- `--radius-xs: 5px`, `--radius-sm: 8px`, `--radius: 12px`, `--radius-lg: 18px`
- `--dur-fast: 120ms`, `--dur: 180ms`, `--ease: cubic-bezier(.2, .65, .3, 1)`
- `--focus-ring: 0 0 0` (minimal, accessible)
- `--code-bg`, `--code-ink`, `--code-line`, `--code-muted`

### Responsive Breakpoints
- **≥980px:** Full sidebar (280px), wide layouts
- **≤560px:** Mobile brand hidden (`wa-mobile-brand { display: none }`), langswitch adjusted
- **≤520px:** Page title reduces to 32px; brand completely hidden
- **≤420px:** Further compact layouts

### Accessibility (WCAG 2.2 AA)
- **CodeMirror contrast:** `var(--code-muted)` for line numbers and `.cm-meta` (fixed from `#746a5c`)
- **Skip links:** `#wa-skip` to `#wa-main`
- **Focus indicators:** `var(--accent)` outline on focused elements
- **Reduced motion:** `@media (prefers-reduced-motion)` respected
- **Forced colors:** `forced-colors` media query support
- **Color scheme:** `meta name="color-scheme" content="light dark"` + `theme-color` meta
- **Dialogs:** `inert` sibling, `aria-modal`, escape-to-close
- **Live regions:** `aria-live="polite"` on status elements
- **Semantic HTML:** `header`, `main`, `section`, `button` with meaningful labels
- **Target size:** Interactive elements ≥ 44px where possible

### States & Components
- **Light/dark parity:** All color tokens defined for both themes
- **Empty states:** Icon + message + CTA buttons (dashboard, projects, glossary, notes, progress, search, 404)
- **Dialogs/toasts:** Modal with overlay, close button, auto-dismiss, `aria-live` announcements
- **CodeMirror:** Custom theme `material-darker` with editorial colors; gutter labels; matching bracket highlighting
- **Form validation:** Real-time, error state with live region announcement

---

## 3. Security Hardening

### Document Root & Private Directories
- **Public document root:** `public/` — all application directories (`src/`, `data/`, `content/`, `views/`) outside it
- **Root compatibility shims:** `router.php` and `.htaccess` block private-path traversal
- **Blocked paths:** `/src/`, `/data/`, `/content/`, `/views/`, `/APPLICATION_ANALYSIS_REPORT.md`, `/\.git/` → 404

### Security Headers (from `public/index.php`)
```
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
Referrer-Policy: strict-origin-when-cross-origin
Content-Security-Policy: default-src 'self';
  base-uri 'self';
  object-src 'none';
  frame-ancestors 'none';
  form-action 'self';
  script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com;
  style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com;
  font-src 'self' https://fonts.gstatic.com data:;
  img-src 'self' data: blob:;
  frame-src 'self' data: blob:;
  connect-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com;
  media-src 'none'; worker-src 'none'; manifest-src 'self'
```

### CSP Rationale
- `'unsafe-inline'` is required because HTML/CSS labs execute user code inside sandboxed `srcdoc` iframes; the browser applies the parent document's CSP to `srcdoc`
- `connect-src` extended to `fonts.googleapis.com`, `fonts.gstatic.com`, `cdnjs.cloudflare.com` to silence preconnect violations
- `default-src 'self'` locks down all unspecified directives

### Input Validation (`src/Core/functions.php`)
- `api_out()`: no-store, no-cache headers; JSON content-type enforcement
- `api_in()`: size limits (bytes), JSON parsing, shape validation (required/forbidden fields)

### API Security (`src/Api.php`, `Repos.php`)
- **Method allowlist:** Only whitelisted methods executable
- **Input validation:** SQL dialect, SQL statement sanitization via `SqlSplitter`
- **Status codes:** Proper error responses (400, 413, 405, 500)
- **Generic errors:** No stack traces exposed to clients

### Sandbox Security (`src/Execution/SqlExecutor.php`)
- **SQLite deny list:** `ATTACH DATABASE`, `DETACH`, `LOAD_FILE`, `OUTPUT` blocked
- **MAX_STATEMENTS: 40**, **MAX_ROWS: 200** per session
- **Oracle honesty:** Returns pedagogical "Oracle not installed" message instead of simulating
- **Dataset validation:** `/^[a-z0-9_-]{1,40}$/i` regex on dataset names

### Request Limits
- `APP_MAX_REQUEST_BYTES`: 1,048,576 (1MB)
- `APP_MAX_CODE_BYTES`: 32,768 (32KB per code lab)
- `APP_MAX_SQL_BYTES`: 65,536 (64KB SQL batch)

### Removed Debug/Probe Files
- `test.php`, `_probe.php`, `_test_api.php`, `_test_cmd.php`, `_test_executor.php`, `_test_sql.php`

### Stale Process Cleanup
- Killed PIDs 11708, 24632 holding `data/sql_sandbox.sqlite` (resolved `unable to open database file`)

---

## 4. Verified Features

### Core Functionality (all preserved)
- PHP + Vanilla JS + CSS + SQLite/MySQL stack
- HTML/CSS/PHP/SQL labs with real execution
- Quizzes with evaluation and SQL checks
- Exercises with levels and consignes (French/Darija)
- Notes create/delete/toggle
- Bookmarks
- Progress tracking (`lastLesson`, `lastQuiz`)
- Theme switching (light/dark)
- Language switching (FR/DARIJA/BILINGUE)
- Search across chapters and modules
- Projects grid (API-driven, renders project cards with steps, code blocks, and Darija notes)
- Glossary with search and filter

### HTTP Smoke Tests (port 8088)
All passed:
- `GET /` — 200, headers (CSP, security, X-Request-ID)
- `GET /assets/css/app.css` — 200, `text/css`
- `GET /assets/js/app.js` — 200, `text/javascript`
- `GET /assets/js/theme-init.js` — 200
- `GET /assets/js/api.js` — 200
- `GET /assets/js/ui.js` — 200
- `GET /assets/js/editor.js` — 200
- `GET /assets/js/lesson.js` — 200
- `GET /assets/js/quiz.js` — 200
- `GET /assets/js/lab.js` — 200
- `GET /favicon.svg` — 200, `image/svg+xml`
- `GET /index.php?api=bootstrap` — 200, JSON
- `GET /index.php?api=lesson&module=html&ch=1` — 200, lesson JSON
- `GET /index.php?api=projects` — 200, projects JSON
- `GET /index.php?api=glossary` — 200, glossary JSON
- `POST /index.php?api=sql-run` — 200, SQL execution
- `POST /index.php?api=sql-reset` — 200, reset confirmation
- `GET /index.php?api=notes` — 200
- `GET /index.php?api=progress` — 200
- `GET /index.php?api=search` — 200
- `GET /index.php?api=settings-save` — 200

### Exposure Probes (all return 404 for private paths)
- `/src/bootstrap.php` → 404
- `/data/app.sqlite` → 404
- `/content/curriculum.php` → 404
- `/views/shell.php` → 404
- `/index.php?devdump=1` → 404
- `/router.php` → 404 (root)
- `/APPLICATION_ANALYSIS_REPORT.md` → 404

### Root Compatibility Server (port 8089)
All probes pass:
- `/` → 200, shell HTML
- `/index.php` → 200
- `/assets/css/app.css` → 200, `text/css`
- `/assets/js/app.js` → 200, `text/javascript`
- `/favicon.svg` → 200, `image/svg+xml`
- `/src/bootstrap.php` → 404
- `/data/app.sqlite` → 404
- `/content/curriculum.php` → 404
- `/views/shell.php` → 404
- `/router.php` → 404
- `/APPLICATION_ANALYSIS_REPORT.md` → 404
- `/index.php?devdump=1` → 404

### PHP Lint
All modified PHP files pass: `src/bootstrap.php`, `public/index.php`, `public/router.php`

### Node JS Lint
All modified JS files pass: `public/assets/js/app.js`, `lesson.js`, `quiz.js`

### Responsive Behavior (overflow checks)
- **1440×900:** No page overflow at any route
- **1024×768:** No page overflow (CodeMirror offenders contained)
- **768×1024:** No page overflow
- **390×844:** No page overflow; CodeMirror elements outside viewport but uncontained `overflow: visible` = 0

### Mobile Topbar
- Brand hidden at ≤520px (prevents overlap with language switch)
- Verified non-overlapping at 390px and 540px width

### Accessibility (axe-core)
- **dashboard dark:** 0 violations (WCAG2A, WCAG2AA, WCAG21A, WCAG21AA, WCAG22AA)
- **dashboard light:** 0 violations
- **lesson:** 0 violations (CodeMirror contrast fixed)
- **lab:** 0 violations
- **notes:** 0 violations
- **settings:** 0 violations

### SQL Sandbox
- Creates `test_of` table on `sql-run` with `CREATE TABLE IF NOT EXISTS` + INSERT
- `sql-reset` removes `test_of` and recreates `etudiant`, `matiere`, `note`, `professeur` tables
- Dataset rows preserved through reset cycle
- Verified with 5 etudiant rows

### Theme & Language Switching
- Light/dark toggle persists via `data-theme` attribute
- Language switch (FR/DARIJA/BILINGUE) updates `data-lang` and i18n
- Mobile nav toggle opens/closes sidebar
- Brand hidden at narrow widths prevents topbar overlap

---

## 5. Tests & Audits Passed

| Test | Result |
|------|--------|
| PHP lint (all modified files) | ✅ Pass |
| node --check (all modified JS) | ✅ Pass |
| HTTP smoke tests (port 8088) | ✅ Pass |
| HTTP smoke tests (port 8089) | ✅ Pass |
| Exposure probes (private paths) | ✅ All 404 |
| Root compatibility server | ✅ All probes pass |
| SQL sandbox create/reset | ✅ Verified |
| Axe accessibility (6 surfaces) | ✅ 0 violations |
| Page overflow (4 breakpoints, 9 routes each) | ✅ 0 page overflow |
| Mobile topbar overlap | ✅ Non-overlapping |
| CodeMirror contrast | ✅ Fixed, rechecked clean |
| CSP console messages | ✅ connect-src extended |
| Favicon MIME type | ✅ image/svg+xml |
| **Full CDP audit (27 route/viewport checks)** | ✅ Re-run after content expansion — 0 console errors, 0 axe violations, 0 page overflow |
| **Root-compat browser smoke (6 routes)** | ✅ Re-run — all render, 0 console errors, 0 failed requests |

### Final CDP audit detail (re-run on 2026-11-10)
- Routes verified: dashboard, lessons (html/1, css/8, php/1, sql/8), labs (html, php, sql), projects, glossary, notes, progress, search, settings, unavailable chapter (`html/99`), 404 — at 1440×900, 1024×768, 768×1024, 390×844.
- Interactions: theme toggle (dark→light→dark), language switch (FR→DARIJA→BILINGUE), mobile nav open/Escape close, bookmark toggle + restore, exercise verdicts (2), quiz (6 questions), HTML preview, PHP execution output, SQL execution (5 rows), note creation.
- Axe surfaces: dashboard dark, dashboard light, lesson, lab, notes, settings — **0 violations** (WCAG 2.0/2.1/2.2 A+AA).
- The only network 404 is the intentional `api=lesson&module=html&ch=99` response (invalid chapter), confirmed by HTTP probe.
- Content note: the curriculum was expanded to **58 chapters across 7 disciplines** (all available) during the session; the audit was re-run against the expanded content and the design system holds.

---

## 6. Remaining Issues

1. **Cached assets:** Users with `APP_VERSION=2.0.0` cached assets will need a hard refresh; `APP_VERSION=2.0.1` already invalidates them.

2. **SQLite file permissions:** `data/app.sqlite` must be writable by the PHP process. Ensure the Web server runtime user has write access.

3. **Production CSP configuration:** The current CSP uses `'unsafe-inline'` for scripts/styles due to lab `srcdoc` iframes. For production without labs, this could be tightened to remove `'unsafe-inline'`.

4. **Oracle behavior:** Intentionally returns "Oracle not installed" pedagogical message. Ensure this is the expected behavior for your audience.

5. **Dev servers:** The PHP dev servers on ports 8088/8089 are for local validation only; use a real Web server with `public/` as DocumentRoot in production.

6. **Chrome headless on Windows:** Chrome CDP must use a profile path without spaces (e.g., `C:\wa_chrome_test`); paths containing spaces trigger "Multiple targets are not supported in headless mode".

---

## 7. Manual Configuration (Production Setup)

### Web Server Configuration
```apache
# DocumentRoot should point to .../public/
# Example for Apache:
DocumentRoot "/path/to/PHP_FrameWorks/PHP_AppCours/public"

# Or nginx:
server {
    listen 80;
    root /path/to/PHP_FrameWorks/PHP_AppCours/public;
    location / { try_files $uri $uri/ /index.php?$query_string; }
}
```

### PHP-FPM / mod_php
- Ensure the PHP process can write to `data/app.sqlite`
- Set `data/` directory permissions to 0750 or as required
- Enable `pdo_sqlite` and `pdo_mysql` extensions

### CSP for Production (if labs removed)
If HTML/CSS labs are not deployed, CSP can be tightened:
```
script-src 'self' https://cdnjs.cloudflare.com;
style-src 'self' https://fonts.googleapis.com https://cdnjs.cloudflare.com;
```

### favicon.svg
- Already placed at `public/favicon.svg`
- Mapped in both `router.php` and `.htaccess`
- Served with `image/svg+xml` content-type

### .htaccess (if DocumentRoot = project root)
```
# Already included in project .htaccess
# Ensure mod_rewrite and mod_headers are enabled
```

### Permissions Checklist
- `[r] public/` — readable by Web server
- `[rw] data/app.sqlite` — writable by PHP for SQLite sandbox
- `[rx] src/` — not directly accessible (blocked by router)
- `[rx] content/` — not directly accessible (blocked by .htaccess)
- `[rx] views/` — not directly accessible (blocked by .htaccess)

---

## Appendix: Complete File Change List

### New Files Created
- `public/favicon.svg` — 313-byte SVG favicon
- `public/index.php` — public front controller (2,264 bytes from original)
- `public/router.php` — dev router (732 bytes)
- `views/shell.php` — shell markup (updated from original)
- `.htaccess` — root compatibility (updated from original)

### Modified Files
- `src/bootstrap.php` — VERSION bump + limits + paths
- `public/assets/css/app.css` — complete redesign (from ~8KB to ~68KB)
- `public/assets/js/api.js` — rewrote with fetch + AbortController
- `public/assets/js/ui.js` — rewrote with WA.state management
- `public/assets/js/editor.js` — rewrote with CodeMirror config
- `public/assets/js/app.js` — rewrote router + all page controllers; async projects/glossary; 404 h1; mobile brand hide
- `public/assets/js/lesson.js` — read exercises/quiz from data.lesson; normalized payloads; fixed quiz.js dataset lookup
- `public/assets/js/quiz.js` — fixed dataset lookup (`data.lesson.exercise.dataset`)
- `public/assets/js/lab.js` — mobile panes; execute sandbox; reset

### Removed Files (security)
- `test.php`, `_probe.php`, `_test_api.php`, `_test_cmd.php`, `_test_executor.php`, `_test_sql.php`
- `_lesson_backup.js`, `_m.html`, `.cap2`

---