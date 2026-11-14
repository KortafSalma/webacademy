# WebAcademy local application audit

Date: 2026-11-14. Runtime: PHP 8.3.14 on Windows. Scope: active PHP application, content, persistence, browser JavaScript source, development routing, and HTTP/API behavior. Application source and existing user changes were preserved; this audit adds diagnostic tools and findings, not application fixes.

## Local execution

Running at **http://127.0.0.1:8088/**, PHP process ID **20636** at completion.

Start again from the project directory:

```powershell
php -S 127.0.0.1:8088 -t public public/router.php
```

Use the public document root. Logs from the current background process are `data/local-server.out.log` and `data/local-server.err.log`. SQLite application storage is created automatically; MySQL is optional and was unreachable during this audit. Oracle execution is explicitly unavailable in the implementation. C++ provides local compilation guidance rather than server compilation.

## Results

| Check | Result |
| --- | --- |
| PHP syntax scan | 345 files including the new audit tool; 37 parse failures in Oracle content |
| First-party JavaScript syntax | All 9 application scripts pass `node --check` |
| Homepage | HTTP 200 |
| Referenced CSS/JavaScript assets | 21 checked; no failed responses or HTML fallbacks |
| Manifest lesson API sweep | 118/146 lessons load; all 28 Oracle lessons fail with 404 |
| PHP exercise suite | 119 checks, 0 failures |
| SQL exercise suite | 123 checks, 0 failures, using fresh in-memory SQLite databases |
| Live PHP runner | `echo 6 * 7;` returns 42 |
| Live SQLite runner | `SELECT 6 * 7 AS answer` returns 42 |
| GET APIs | Bootstrap, projects, glossary, search, notes, progress, settings-load, sql-info succeed |
| Invalid requests | Unknown endpoint 404; wrong endpoint method 405; invalid lesson 422; malformed JSON 400 |
| Basic sandbox restrictions | PHP system() and SQLite ATTACH are rejected |

The HTTP lesson sweep records lesson views in application history, as normal navigation does. Persistence regression probes run in a transaction and are rolled back; existing notes/settings/progress were not reset.

## Confirmed findings

### High: Oracle course cannot load

`src/Core/Content.php:78` requires chapter files without loading `content/oracle/_helpers.php`. Chapters such as `content/oracle/c01.php:43` call undefined helper functions. Additionally, 20 Oracle chapters, 16 quizzes, and one project have PHP parse errors. These are separate causes: loading the helpers alone will not repair the syntax errors. All 28 manifest Oracle chapter requests returned 404. The loader catches exceptions, so the rest of the app remains operational while broken content becomes unavailable.

There is also an undefined `String()` call in `content/oracle/_helpers.php:13`; PHP requires a string cast. It is a latent helper defect, independent of the observed 404s.

### High: Five quiz questions have no selectable answers

`public/assets/js/quiz.js:98` generates true/false options only for type `tf`. Content uses `true_false` without an options array in HTML chapter 5, CSS chapters 3 and 4, PHP chapter 3, and SQL chapter 1. These questions fall through to single-choice rendering with zero options, blocking completion of their quizzes. Normalize the question type and confirm its answer-index convention before changing the renderer.

### High: JavaScript runner can report success before tests finish

`public/assets/js/runner.js:145` accepts `results.every(...)` even when results is empty. Its `done` handler at line 170 finishes roughly 40 ms after the settle timer, regardless of pending asynchronous tests. A runner request with one unexecuted test reproduced `{ok:true, results:[], timedOut:false}` in a Node VM harness. Completion should require the expected test results, and pending test execution should retain the real timeout. The runner also checks the message token but not `event.source`.

The parent timer cannot reliably interrupt synchronous infinite loops in an iframe sharing its event loop. Browser process isolation is not guaranteed by `sandbox=allow-scripts`. This is a design risk identified from source, not a freeze test performed on the user's browser.

### Medium: Null settings are returned as the string "null"

`src/Core/Repos.php:33` uses a decoded-null check to decide that JSON decoding failed. Valid JSON null therefore returns the original string. Verified by setting a temporary key to null and reading back the string `"null"` inside a rolled-back transaction. Check `json_last_error()` instead. This also affects clearing `lastLesson` through settings-save.

### Medium: Updating a missing note falsely succeeds

`src/Core/Repos.php:156` returns the supplied ID after UPDATE even when no row exists. A missing-ID probe returned an ID with zero saved rows. The API can report successful saving while losing the note content. Return a not-found response or implement an explicit create policy.

### Medium: Projects are undiscoverable

`src/Core/Content.php:152` scans only `content/projects/*.php`. It returns only `cpp-proj1` and `p1`. The JavaScript project under `content/javascript/js-project1.php` and three Oracle projects under `content/oracle/projects/` are not discovered. One of those Oracle projects also has a parse error.

### Medium: Existing content validator gives false failures and misses modules

`tools/validate-content.php:18` expects text directly on lesson sections, whereas the real schema nests text inside `lessons[].blocks[]`. It incorrectly labels valid HTML/PHP/SQL lesson content as placeholders. The module list excludes integration and Oracle. It also does not validate the separate exercise and quiz files through its normal module traversal. Its failing output is not reliable evidence that every chapter is broken.

The PHP exercise checker likewise treats unknown test types as passing and can exit successfully when a sandbox failure is not reflected in an output assertion. The passing totals above apply to the assertions actually executed, not every possible exercise behavior.

### Medium: Partial settings updates on validation failure

`src/Core/Api.php:202` validates and saves one setting at a time. A request with a valid theme followed by an invalid language can return 422 after already changing the theme. Validate the entire payload before writing, or use a transaction. This finding is based on direct control-flow review; no user settings were changed to demonstrate it.

### Deployment risk: Project-root Apache hosting exposes internal files

`.htaccess:21` rewrites only nonexistent files. Existing diagnostic PHP files, conversion scripts, deployment ZIP archives, and the `deploy_htdocs` directory are not all blocked by the preceding rules. For example, `debug_test.php` outputs internal class/file information, and `convert.php` writes generated files. This is a source-reviewed Apache deployment risk; Apache exposure was not exercised. The running localhost instance uses `public/` as its document root and does not expose these private files. Unmatched private-looking URLs can return the SPA shell with HTTP 200; this is not proof of file disclosure.

### Portability: Temporary path assumes Windows

`src/bootstrap.php:36` replaces forward slashes in the system temporary path with backslashes unconditionally. On Linux this creates an incorrect path. Preserve the native path or limit conversion to Windows. Current Windows execution passed.

## Content completeness

| Module | Lessons loaded/planned | Exercise files attached | Quiz files attached |
| --- | --- | --- | --- |
| HTML | 8/8 | 8 | 8 |
| CSS | 14/14 | 14 | 14 |
| PHP | 15/15 | 15 | 15 |
| SQL | 14/14 | 14 | 14 |
| Integration | 7/7 | 7 | 7 |
| C++ | 30/30 | 1 | 1 |
| JavaScript | 30/30 | 1 | 1 |
| Oracle | 0/28 | 0 loadable through lessons | 0 loadable through lessons |

Missing exercise/quiz coverage is a content gap rather than necessarily a runtime exception. Some JavaScript chapters are very sparse; for example c15.php contains brief headings as lesson text. Earlier audit documents claiming all modules work do not match these current results.

## Reproduce

```powershell
php tools/audit-app.php
node tools/audit-runner.cjs
php tools/test-php-exercises.php
php tools/test-sql-exercises.php
```

Machine-readable syntax locations, module counts, and persistence probes are saved in `data/audit-results.json`.

## Limits and repair order

First repair Oracle parsing/helper loading and the five blocked quizzes, then JavaScript test completion, persistence semantics, project discovery, and audit-tool correctness. Keep public/ as the document root.

This was a source, CLI, and HTTP/API audit. No rendered-browser accessibility/layout review or browser interaction suite was run. MySQL execution, real Oracle execution, C++ compilation, Apache hosting, and the separate static dist/deployment copies were not validated. Basic rejection probes do not establish that code-execution sandboxes are secure against hostile code. Bugs listed above remain present; no application fixes were applied.
