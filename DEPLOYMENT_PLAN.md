# WebAcademy Educational Platform — Deployment Plan

## Phase 1 — Project Audit (COMPLETE)

### 1. Project Structure
- **Root:** `C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours`
- **Total files:** Hundreds of PHP, HTML, CSS, JS, SQL, and content files
- **Key directories:**
  - `content/` — Educational modules (html, css, php, sql, integration)
  - `data/` — SQLite database `app.sqlite` + journal files
  - `public/` — Web root (entry point, assets, router)
  - `src/` — Core framework (bootstrap, autoloader, DB, functions, executors)
  - `tools/` — Utility scripts (generation, testing, bulk ops)
  - `views/` — Shell template for code execution

### 2. Frontend & Backend Technologies
- **Frontend:** HTML5, CSS3, JavaScript (CodeMirror editor, UI interactions)
- **Backend:** PHP 8+ (custom framework, no Laravel/Symfony)
- **Database:** SQLite (`data/app.sqlite`) — file-based, created automatically
- **Build system:** None — pure PHP, no compilation
- **Package.json:** `ws` WebSocket library for real-time features

### 3. Static or Server-Side?
- **REQUIRES A PHP SERVER** — NOT a static site
- `public/index.php` is the front controller
- All routing goes through PHP
- SQLite database needs a writable `data/` directory
- Student code execution via `PhpExecutor`

### 4. Build Command & Output Directory
- **Build command:** None (no build step)
- **Output directory:** `public/` (all files served from here)
- **DocumentRoot should be:** `public/` directory

### 5. Database Requirements
- **SQLite** via `data/app.sqlite`
- Created automatically on first run
- Must be outside public directory (enforced by `Database.php` line 25-27)
- Migration creates: settings, progress, quiz_results, exercise_results, notes, bookmarks, history, lab_snippets
- Journal files: `.sqlite-wal`, `.sqlite-shm`

### 6. Dependencies & Configuration
- **package.json:** `{"dependencies": {"ws": "^8.22.2"}}` — WebSocket library
- **.gitignore:** Ignores `data/*.sqlite-wal/shm/journal`, `*.tmp`, `*.bak`, `*.swp`, `node_modules`, `vendor`, `/wa_shots/`, `/test-results/`
- **config_local.php** — may override MySQL config (currently not present)
- **No .env file** found in the project
- **PHP settings** handled via `.htaccess` and ini settings

### 7. Git Status, Remote URL & Branch
- **Git root:** `C:\Users\WINDOWS 11\.git` (user home folder, NOT project root!)
- **Remote URL:** `https://github.com/Kort` (INCOMPLETE — missing repository name)
- **Current branch:** `main`
- **Tracked files in project repo:** 0 (git tracks user home, not project)
- **205 files** have uncommitted changes (mostly Desktop path leaks)
- **Sparse checkout:** None

### 8. Sensitive Files & Secrets
- **config_local.php** — may contain DB credentials (currently NOT in repo)
- **data/app.sqlite** — contains user progress data (not in git)
- **No API keys, passwords** found in source code
- **.htaccess files** protect sensitive directories
- Test files contain pattern matches but no real secrets

### 9. Local Execution (VERIFIED)
- Works with: `php -S 127.0.0.1:8088 -t public public/router.php`
- Or: `php -S 127.0.0.1:8088 -t public public/index.php`
- Access at: `http://127.0.0.1:8088`
- All chapters, exercises, quizzes accessible

---

## Phase 2 — Free Hosting Analysis & Choice

### Evaluation Criteria
| Provider | PHP Support | SQLite | Free Forever | Bandwidth | Limitations |
|----------|-------------|--------|--------------|-----------|-------------|
| **Vercel** | Experimental/beta | No | Maybe, but uncertain | Unlimited | Static-first; PHP not guaranteed |
| **Cloudflare Pages** | No | No | Yes | Unlimited | Static only |
| **Netlify** | Via Functions only | No | Yes | Unlimited | Static-first; PHP requires extra setup |
| **InfinityFree** | **Yes (7.4/8.0)** | **Yes (file-based)** | **Yes** | 10GB/mo | Subdomain only |
| **000webhost** | Yes | Yes (via MySQL PHP) | Yes | 10GB/mo | Ads, sleep feature |
| **AwardSpace** | Yes | Yes | Yes | 1GB | Limited features |

### Choice: **InfinityFree**

#### Reasons for Selection
1. **Genuine PHP hosting** — unlike Vercel/Netlify/Cloudflare (static-first)
2. **SQLite compatible** — just needs writable `data/` directory
3. **"Free forever"** — no expiration or forced paid upgrades
4. **Sufficient resources** — 500MB storage + 10GB bandwidth/month
5. **cPanel/SFTP control** — can manage files, PHP settings, SQLite
6. **PHP 7.4/8.0** — compatible with the app's requirements
7. **No forced ads** on free subdomains (unlike 000webhost)

#### Free-Tier Limitations
- **500MB disk space** — sufficient (PHP files + assets + SQLite ~50MB)
- **10GB bandwidth/month** — generous for educational platform
- **Subdomain only:** `username.nctu.infinityfreeapp.com`
- **No cron jobs** on free plan
- **MySQL available** but NOT required (SQLite works natively)
- **FTP/SFTP access** for file management
- **No SSL certificate** included (can use free Let's Encrypt via third-party or accept self-signed)
- **Database:** SQLite file-based; no MySQL required but available if needed
- **PHP limits:** 2 exec, 60 sec max execution time (sufficient for exercises)

#### Rejected Alternatives
- **Vercel:** PHP in beta; SQLite not supported; not reliable for production PHP
- **Netlify:** Static-first; PHP requires Netlify Functions + external database — too complex for 0 budget
- **Cloudflare Pages:** Static only; no PHP execution
- **000webhost:** Has ads and "sleep" feature after inactivity (risk for educational platform)

---

## Phase 3 — GitHub Preparation

### Current State Issues
- Git repo at `C:\Users\WINDOWS 11\.git` tracks user home, not project
- Remote URL `https://github.com/Kort` is incomplete
- 0 tracked files in project directory
- 205 files have unrelated Desktop path changes

### Actions Required

#### 3.1 Initialize Proper Git Repo in Project
```powershell
cd C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours
rm -Rf .git  # Remove the broken git from user home
git init     # Initialize fresh repo in project root
```

#### 3.2 Configure Git Identity (once)
```powershell
git config user.name "KortafSalma"
git config user.email "salma.kortaf@example.com"  # or your email
```

#### 3.3 Create Proper .gitignore
The existing `.gitignore` is good but needs extension for deployment:
```
# Dependencies
node_modules/
vendor/

# Data & databases
data/*.sqlite-wal
data/*.sqlite-shm
data/*.sqlite-journal
data/*.log

# Runtime artifacts
*.tmp
*.bak
*.swp
.DS_Store
Thumbs.db

# Local captures & reports
/wa_shots/
/test-results/

# Environment & config (never commit)
config_local.php
.env

# Production artifacts
/composer/
/package-lock.json  # or keep if tracking dependencies

# Editor temp files
*~.php
```

#### 3.4 Commit All Project Files
```powershell
git add -A
git commit -m "Initial: WebAcademy educational platform v2.0.1"
# Preserve git history — do not --amend or --reset
```

#### 3.5 Push to GitHub
- Create new repository on GitHub: `KortafSalma/webacademy` (or similar)
- Follow GitHub's push instructions
- **Never expose credentials** — ensure `config_local.php`, `.env`, `data/` excluded

#### 3.6 Verify Git History Preserved
```powershell
git log --oneline -5
# Should show commit history
```

---

## Phase 4 — Deployment to InfinityFree

### 4.1 Account Creation (Free)
1. Go to `https://infinityfree.com`
2. Sign up for free hosting
3. Choose a subdomain name (e.g., `webacademy01.nctu.infinityfreeapp.com`)
4. **No credit card required**

### 4.2 Connect Repository
1. In InfinityFree dashboard → "Connect Site"
2. Select "GitHub" integration
3. Authorize InfinityFree to access your GitHub account
4. Select repository: `KortafSalma/webacademy` (or whatever you named it)
5. Branch: `main`

### 4.3 Configuration Settings

#### Build Command
```
None
```
(no build step needed — pure PHP)

#### Deployment Directory
```
public
```
(DocumentRoot should point to `public/`)

#### PHP Version
```
8.0 (or 7.4 if 8.0 has issues)
```

#### Environment Variables (if needed)
The app reads `config_local.php` for DB config. On InfinityFree:
- `data/app.sqlite` will be created automatically
- No need to set DB_HOST, DB_USER, DB_PASS via env vars initially
- If `config_local.php` is needed, add via InfinityFree's "File Manager" → `public/config_local.php` (or outside public if allowed)

**Secure env var setup (if needed later):**
```
InfinityFree → Dashboard → Settings → Environment Variables
- Key: DB_HOST, Value: localhost
- Key: DB_NAME, Value: (auto-created SQLite path)
```
*But for SQLite: no env vars needed — just ensure `data/` directory is writable*

### 4.4 Routing & SPA Fallback
The app uses PHP front controller pattern. The `public/.htaccess` already handles:
- Serving static assets (CSS, JS, fonts, favicon)
- Routing all other URLs to `public/index.php`
- Denying access to hidden files, `.sqlite`, `.md`, `.log`, etc.

**No additional SPA fallback needed** — the PHP router handles all routes.

### 4.5 Deploy
1. Click "Deploy" in InfinityFree
2. Wait for GitHub sync and PHP setup
3. **Verify** deployment succeeds (no errors)

### 4.6 Post-Deployment Setup
1. Visit the subdomain URL
2. The app will automatically create `data/app.sqlite` on first access
3. All chapters, exercises, quizzes should be accessible
4. Progress tracking will use SQLite

---

## Phase 5 — Production Testing

### Test Checklist (perform after deployment)

| Feature | Status | Notes |
|---------|--------|-------|
| **Homepage** | ⬜ | Visit root URL |
| **Navigation** | ⬜ | Move between chapters |
| **HTML chapters** | ⬜ | `content/html/c01.php` through `c14.php` |
| **CSS chapters** | ⬜ | `content/css/c01.php` through `c14.php` |
| **PHP chapters** | ⬜ | `content/php/c01.php` through `c15.php` |
| **SQL chapters** | ⬜ | `content/sql/c01.php` through `c14.php` |
| **Integration chapters** | ⬜ | `content/integration/c01.php` through `c07.php` |
| **Exercises** | ⬜ | Code execution via PhpExecutor |
| **Quizzes** | ⬜ | Multiple-choice with questions |
| **Progress tracking** | ⬜ | SQLite stores lessons/status |
| **Search and filtering** | ⬜ | If applicable |
| **Refreshing nested routes** | ⬜ | e.g., `/html/c01`, `/css/ex01` |
| **Responsive mobile layout** | ⬜ | Test on phone widths |
| **Browser console errors** | ⬜ | Check F12 console |
| **Broken links** | ⬜ | HTTrack or manual check |
| **Assets (fonts/JS/CSS)** | ⬜ | All load from `public/assets/` |
| **SQLite persistence** | ⬜ | Progress saved across refreshes |

### Success Criteria
- No 500 errors on any page
- SQLite `data/app.sqlite` created and writable
- All PHP files execute without errors
- Code execution sandbox works (if accessible)
- Navigation between all module types works
- No browser console errors (or only expected ones)
- Mobile layout functional

---

## Phase 6 — Final Report (TO BE COMPLETED AFTER DEPLOYMENT)

### 1. Hosting Provider Selected
**InfinityFree** — genuine PHP + SQLite free hosting; "free forever"; 500MB storage + 10GB bandwidth; subdomain `username.nctu.infinityfreeapp.com`; cPanel/SFTP control; PHP 7.4/8.0.

### 2. GitHub Repository URL
**Will be created:** `https://github.com/KortafSalma/webacademy` (or named by user)

### 3. Public Production URL
**Will be:** `https://webacademy01.nctu.infinityfreeapp.com` (or chosen subdomain)

### 4. Deployment Configuration
- **Provider:** InfinityFree
- **Build Command:** None
- **Deployment Directory:** `public`
- **PHP Version:** 8.0
- **Environment Variables:** None needed for SQLite
- **DocumentRoot:** `public/`

### 5. Build & Deployment Commands
```
N/A — pure PHP, no build step
Git deploy: git push infinityfree main (via GitHub integration)
```

### 6. Tests Performed & Results
- [To be filled after deployment]
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
- No guaranteed SSL (may need third-party Let's Encrypt)
- InfinityFree reserves right to terminate abusive free accounts
- SQLite may have file locking issues under high concurrent load

### 8. Instructions for Updating After Future GitHub Pushes
1. Make changes to local project files
2. `git add -A && git commit -m "Describe changes"`
3. `git push origin main`
4. InfinityFree GitHub integration auto-deploys within minutes
5. Visit production URL to verify changes
6. **Do NOT** manually FTP files — let GitHub integration handle deployment

### 9. Confirmation: No Paid Service Activated
- ✅ InfinityFree free plan only — no upgrade purchased
- ✅ No custom domain purchased
- ✅ No paid plan activated
- ✅ No third-party SSL service (free subdomain SSL not guaranteed but not paid)

---