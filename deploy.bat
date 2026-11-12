@echo off
title WebAcademy tinkerhost Deployment
echo ============================================
echo WebAcademy Deployment to tinkerhost htdocs
echo ============================================
echo.

:: Configuration
set "SOURCE_DIR=C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours\deploy_htdocs"
set "TARGET_DIR=C:\Users\WINDOWS 11\Downloads\3IIR_EMSI_S5\PHP_FrameWorks\PHP_AppCours\htdocs"

echo Step 1: Creating folder structure...
md "%TARGET_DIR%\assets\css" 2>nul
md "%TARGET_DIR%\assets\js" 2>nul
md "%TARGET_DIR%\assets\fonts" 2>nul
md "%TARGET_DIR%\src\Core" 2>nul
md "%TARGET_DIR%\content\glossary" 2>nul
md "%TARGET_DIR%\data" 2>nul
md "%TARGET_DIR%\views" 2>nul
echo Folder structure created.
echo.

:: Step 2: Copy root-level files
echo Step 2: Copying root files...
copy "%SOURCE_DIR%\index.php" "%TARGET_DIR%\index.php" /y >nul
copy "%SOURCE_DIR%\ .htaccess" "%TARGET_DIR%\ .htaccess" /y >nul
copy "%SOURCE_DIR%\assets\favicon.svg" "%TARGET_DIR%\favicon.svg" /y >nul
echo Root files copied.
echo.

:: Step 3: Copy CSS files
echo Step 3: Copying CSS files...
copy "%SOURCE_DIR%\assets\css\app.css" "%TARGET_DIR%\assets\css\app.css" /y >nul
copy "%SOURCE_DIR%\assets\css\fonts.css" "%TARGET_DIR%\assets\css\fonts.css" /y >nul
echo CSS files copied.
echo.

:: Step 4: Copy JS files
echo Step 4: Copying JS files...
copy "%SOURCE_DIR%\assets\js\api.js" "%TARGET_DIR%\assets\js\api.js" /y >nul
copy "%SOURCE_DIR%\assets\js\app.js" "%TARGET_DIR%\assets\js\app.js" /y >nul
copy "%SOURCE_DIR%\assets\js\editor.js" "%TARGET_DIR%\assets\js\editor.js" /y >nul
copy "%SOURCE_DIR%\assets\js\lab.js" "%TARGET_DIR%\assets\js\lab.js" /y >nul
copy "%SOURCE_DIR%\assets\js\lesson.js" "%TARGET_DIR%\assets\js\lesson.js" /y >nul
copy "%SOURCE_DIR%\assets\js\quiz.js" "%TARGET_DIR%\assets\js\quiz.js" /y >nul
copy "%SOURCE_DIR%\assets\js\runner.js" "%TARGET_DIR%\assets\js\runner.js" /y >nul
copy "%SOURCE_DIR%\assets\js\theme-init.js" "%TARGET_DIR%\assets\js\theme-init.js" /y >nul
copy "%SOURCE_DIR%\assets\js\ui.js" "%TARGET_DIR%\assets\js\ui.js" /y >nul
echo JS files copied.
echo.

:: Step 5: Copy font files
echo Step 5: Copying font files...
copy "%SOURCE_DIR%\assets\fonts\Fraunces-400700-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\Fraunces-400700-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\Fraunces-400700-latin.woff2" "%TARGET_DIR%\assets\fonts\Fraunces-400700-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexMono-400-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexMono-400-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexMono-400-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexMono-400-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexMono-500-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexMono-500-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexMono-500-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexMono-500-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-400-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-400-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-400-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-400-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-500-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-500-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-500-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-500-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-600-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-600-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-600-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-600-latin.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-700-latin-ext.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-700-latin-ext.woff2" /y >nul
copy "%SOURCE_DIR%\assets\fonts\IBMPlexSans-700-latin.woff2" "%TARGET_DIR%\assets\fonts\IBMPlexSans-700-latin.woff2" /y >nul
echo Font files copied (14 total).
echo.

:: Step 5.5: Copy Core files
echo Step 5.5: Copying Core files...
copy "%SOURCE_DIR%\src\Core\Api.php" "%TARGET_DIR%\src\Core\Api.php" /y >nul
copy "%SOURCE_DIR%\src\Core\Autoloader.php" "%TARGET_DIR%\src\Core\Autoloader.php" /y >nul
copy "%SOURCE_DIR%\src\Core\Database.php" "%TARGET_DIR%\src\Core\Database.php" /y >nul
copy "%SOURCE_DIR%\src\Core\functions.php" "%TARGET_DIR%\src\Core\functions.php" /y >nul
echo Core files copied.
echo.

:: Step 6: Copy bootstrap.php
echo Step 6: Copying bootstrap.php...
copy "%SOURCE_DIR%\src\bootstrap.php" "%TARGET_DIR%\src\bootstrap.php" /y >nul
echo bootstrap.php copied.
echo.

:: Step 7: Copy content files
echo Step 7: Copying content files...
copy "%SOURCE_DIR%\content\curriculum.php" "%TARGET_DIR%\content\curriculum.php" /y >nul
copy "%SOURCE_DIR%\content\glossary\glossary.php" "%TARGET_DIR%\content\glossary\glossary.php" /y >nul
echo Content files copied.
echo.

:: Step 8: Copy data .htaccess
echo Step 8: Copying data .htaccess...
copy "%SOURCE_DIR%\data\.htaccess" "%TARGET_DIR%\data\.htaccess" /y >nul
echo data .htaccess copied.
echo.

:: Step 8.5: Copy views
echo Step 8.5: Copying views...
copy "%SOURCE_DIR%\views\shell.php" "%TARGET_DIR%\views\shell.php" /y >nul
echo shell.php copied.
echo.

:: Step 9: Instructions
echo.
echo ============================================
echo DEPLOYMENT COMPLETE!
echo ============================================
echo.
echo Next steps:
echo 1. Open tinkerhost File Manager
echo 2. Navigate to your htdocs/ folder
echo 3. Verify all files are there (you should see ~50 files)
echo 4. Set data/ folder permissions to 755 or 775
echo 5. Clear browser cache (Ctrl+Shift+Delete)
echo 6. Visit: https://webacademy.thsite.top/
echo.
echo If you see "errors.tinkerhost.net/500", verify the .htaccess file
echo is at the root of htdocs/ with the correct rewrite rules.
pause