# WebAcademy Educational Platform — Deployment Plan (LIVE)

## Phase 1 — Project Audit (COMPLETE)

### Summary of Findings
- **Project:** WebAcademy — PHP-based educational programming platform
- **Technologies:** PHP 8+, HTML5, CSS3, JavaScript, SQLite (file-based DB)
- **Architecture:** NOT static — requires PHP execution environment
- **DocumentRoot:** `public/` directory
- **Database:** SQLite at `data/app.sqlite` (auto-created, outside public)
- **Build system:** None — pure PHP deployment
- **Git status:** Local repo initialized with 305 files; remote URL needs creation
- **Sensitive files:** None exposed; `config_local.php` not in repo; `data/` excluded by .gitignore

### Key Files
- `public/index.php` — Front controller (only PHP file served by web server)
- `public/router.php` — PHP built-in server router
- `src/bootstrap.php` — Core initialization, DB config, autoloading
- `data/app.sqlite` — SQLite database (created at runtime)
- `content/` — Educational modules (html, css, php, sql, integration)
- `public/assets/` — CSS, JS, fonts, favicon
- `tools/` — Utility scripts for content generation and testing

## Phase 2 — Free Hosting Choice: **InfinityFree** ✓

### Why InfinityFree Over Others
| Constraint | Vercel | Netlify | Cloudflare Pages | **InfinityFree** |
|------------|--------|---------|------------------|------------------|
| PHP support | Experimental | Via Functions | No | **Yes (7.4/8.0)** |
| SQLite support | No | No | No | **Yes (file-based)** |
| "Free forever" | Uncertain | Uncertain | Yes | **Yes** |
| Resources | Unlimited | Unlimited | Unlimited | 500MB + 10GB/mo |
| Subdomain | yes | yes | yes | **yes** (nctu.infinityfreeapp.com) |
| Reliability for PHP | Low | Medium | N/A | **High** |

### Free-Tier Limitations (InfinityFree)
- 500MB disk space (sufficient: ~50MB for project + SQLite)
- 10GB bandwidth/month (generous for educational site)
- Subdomain only: `username.nctu.infinityfreeapp.com`
- No cron jobs on free plan
- MySQL available but NOT required (SQLite works natively)
- FTP/SFTP access included
- No guaranteed SSL (subdomain SSL may be available or self-signed acceptable)
- "Free forever" — no expiration or forced paid upgrades

### Rejected Alternatives
- **Vercel:** PHP in beta; SQLite not supported; unreliable for production PHP apps
- **Netlify:** Static-first; PHP requires Netlify Functions + external DB — too complex for 0 budget
- **Cloudflare Pages:** Static only; no PHP execution possible
- **000webhost:** Has ads and "sleep" feature after inactivity (risk for always-available platform)

## Phase 3 — GitHub Preparation (IN PROGRESS)

### 3.1 Local Git Repo ✓
- Initialized fresh git repo in project root: `C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours\.git`
- Committed 305 files with message: "Initial: WebAcademy educational platform v2.0.1"
- Files tracked: all project content, source, tools, assets, configs
- `.gitignore` properly excludes: `data/*.sqlite*`, `node_modules/`, `vendor/`, `*.tmp`, `*.bak`, `*.swp`, `/wa_shots/`, `/test-results/`, `config_local.php`, `.env`

### 3.2 GitHub Repository Creation (User Action Required)
**Create repo on GitHub.com:**
- URL: `https://github.com/new`
- Owner: `KortafSalma`
- Name: `webacademy`
- Visibility: Public
- **Do NOT** initialize with README/.gitignore/license
- After creation, run:
  ```powershell
  git remote add origin https://github.com/KortafSalma/webacademy.git
  git push -u origin main
  ```

### 3.3 Sensitive Files Excluded ✓
- `config_local.php` — NOT committed (listed in .gitignore pattern)
- `data/` directory — SQLite file, excluded by .gitignore
- No `.env` files found in project
- No API keys or passwords in source code

### 3.4 Git History Preserved ✓
- Single initial commit containing all 305 files
- No interactive rebase, reset, or --amend that would lose history
- Original file metadata preserved

## Phase 4 — Deployment to InfinityFree

### 4.1 InfinityFree Account Setup
1. Go to `https://infinityfree.com`
2. Sign up for free hosting account
   - No credit card required
   - Choose a subdomain (e.g., `webacademy01`)
3. Complete email verification

### 4.2 Connect GitHub Repository to InfinityFree
1. Log into InfinityFree dashboard
2. Click "Connect Site" or "Add Site"
3. Select "GitHub" as the connection method
4. Authorize InfinityFree to access your GitHub account (OAuth)
5. Select repository: `KortafSalma/webacademy`
6. Branch: `main`

### 4.3 InfinityFree Configuration Settings

#### Build Command
```
(Leave blank / None)
```
- Pure PHP application, no build step required
- No npm install, no composer install needed

#### Deployment Directory
```
public
```
- DocumentRoot should point to the `public/` folder
- All assets (CSS, JS, fonts, favicon) are in `public/assets/`
- `public/index.php` is the front controller
- All other PHP files are in `src/` and `content/`, outside web root

#### PHP Version
```
8.0
```
- Compatible with the app's requirements
- If issues arise, can switch to 7.4 via cPanel

#### Environment Variables
**Not needed for SQLite deployment:**
- The app auto-creates `data/app.sqlite` on first access
- `src/bootstrap.php` reads `config_local.php` (not in repo) for MySQL override
- If MySQL is preferred over SQLite, add via InfinityFree dashboard:
  - `DB_HOST`: `localhost`
  - `DB_NAME`: (name your SQLite DB, or leave for auto-creation)
  - `DB_USER`: (not needed for SQLite)
  - `DB_PASS`: (not needed for SQLite)

**If config_local.php is needed later:**
- Create file via InfinityFree "File Manager" at `public/config_local.php`
- Or upload via FTP/SFTP to `APP_ROOT/config_local.php` (outside public if possible)

#### Routing & SPA Fallback
**No SPA fallback needed** — the app uses PHP front controller pattern.
The `public/.htaccess` already handles:
- Serving static assets (CSS, JS, fonts, favicon)
- Routing all other URLs to `public/index.php`
- Denying access to hidden files, `.sqlite`, `.md`, `.log`, backups
- Security headers (X-Content-Type-Options, X-Frame-Options, etc.)

**No additional rewrite rules needed.**

### 4.4 Deploy the Application
1. In InfinityFree dashboard, click "Deploy" or "Save and Deploy"
2. InfinityFree will sync from GitHub and set up PHP environment
3. Wait 1-3 minutes for initial deployment
4. **Verify:** Visit the subdomain URL shown in the dashboard

### 4.5 Post-Deployment Initial Setup
1. Visit the production URL (e.g., `https://webacademy01.nctu.infinityfreeapp.com`)
2. The app will automatically:
   - Create `data/app.sqlite` if it doesn't exist
   - Run database migrations (create all tables: settings, progress, quiz_results, etc.)
   - Display the homepage with chapter navigation
3. **Test:** Navigate between HTML, CSS, PHP, SQL, and Integration chapters
4. **Test:** Try a code exercise (PHP execution sandbox)
5. **Test:** Check progress tracking works across page refreshes

## Phase 5 — Production Testing (TO BE COMPLETED AFTER DEPLOYMENT)

### Test Checklist
| Feature | Expected | Actual (fill after) |
|---------|----------|---------------------|
| Homepage loads | ✅/❌ | |
| Navigation between chapters | ✅/❌ | |
| HTML chapters (c01-c08) | ✅/❌ | |
| CSS chapters (c01-c14) | ✅/❌ | |
| PHP chapters (c01-c15) | ✅/❌ | |
| SQL chapters (c01-c14) | ✅/❌ | |
| Integration chapters (c01-c07) | ✅/❌ | |
| Exercises with code execution | ✅/❌ | |
| Quizzes with questions | ✅/❌ | |
| Progress tracking (SQLite) | ✅/❌ | |
| Refreshing nested routes (e.g., /php/ex01) | ✅/❌ | |
| Responsive mobile layout | ✅/❌ | |
| Browser console errors (F12) | ✅/❌ | |
| Broken links / missing assets | ✅/❌ | |
| SQLite persistence across refreshes | ✅/❌ | |
| API endpoints (`?api=...`) | ✅/❌ | |

### Success Criteria
- No 500 errors on any page
- SQLite `data/app.sqlite` created and functional
- All chapter types accessible
- Code execution sandbox operational (if accessible)
- Navigation works end-to-end
- No critical browser console errors
- Mobile layout functional

## Phase 6 — Final Report (TEMPLATE, TO BE COMPLETED AFTER DEPLOYMENT)

### 1. Hosting Provider Selected
**InfinityFree** — genuine PHP + SQLite free hosting; "free forever"; 500MB storage + 10GB bandwidth; subdomain `username.nctu.infinityfreeapp.com`; cPanel/SFTP control; PHP 7.4/8.0; no paid services activated.

### 2. GitHub Repository URL
`https://github.com/KortafSalma/webacademy` (created per Phase 3 instructions)

### 3. Public Production URL
`https://webacademy01.nctu.infinityfreeapp.com` (or chosen subdomain after InfinityFree signup)

### 4. Deployment Configuration
- **Provider:** InfinityFree
- **Build Command:** None (pure PHP)
- **Deployment Directory:** `public`
- **PHP Version:** 8.0
- **Environment Variables:** None needed for SQLite auto-creation
- **DocumentRoot:** `public/`

### 5. Build & Deployment Commands
```
N/A — pure PHP, no build step
Git deploy: git push origin main (triggers InfinityFree auto-deploy)
```

### 6. Tests Performed & Results
- [To be filled after Phase 5 testing]
- Homepage: ✅/❌
- Navigation: ✅/❌
- All chapter types: ✅/❌
- Progress tracking (SQLite): ✅/❌
- Code execution: ✅/❌
- Mobile responsiveness: ✅/❌
- Browser console: ✅/❌

### 7. Remaining Limitations
- 500MB disk space quota
- 10GB bandwidth/month
- Subdomain only (no custom domain without paid plan)
- No guaranteed SSL (subdomain may have free Let's Encrypt or self-signed acceptable)
- InfinityFree reserves right to terminate abusive free accounts
- SQLite file locking under high concurrent load (unlikely for educational use)

### 8. Instructions for Updating After Future GitHub Pushes
1. Make changes to local project files
2. `git add -A && git commit -m "Describe changes"`
3. `git push origin main`
4. InfinityFree GitHub integration auto-deploys within minutes (usually 1-3)
5. Visit production URL to verify changes
6. **Do NOT** manually FTP files — let GitHub integration handle deployment
7. Clear browser cache if changes don't appear immediately

### 9. Confirmation: No Paid Service Activated
- ✅ InfinityFree free plan only — no upgrade purchased or activated
- ✅ No custom domain purchased
- ✅ No paid plan activated at any step
- ✅ No third-party SSL service purchased (free subdomain SSL status depends on InfinityFree)
- ✅ Zero MAD spent (0 MAD budget confirmed met)

---
**Deployment started:** `date`
**Status:** Pending GitHub repo creation + InfinityFree account setup