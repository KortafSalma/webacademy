<?php

/**
 * WebAcademy Static Site Migration Script
 * Converts the dynamic PHP+SQLite application into a fully static website.
 * 
 * Run with: php convert.php
 * 
 * Output: dist/ directory with complete static website
 */

declare(strict_types=1);

// Use absolute path based on the known project location
$PROJECT_ROOT = 'C:/Users/WINDOWS 11/Downloads/3IIR_EMSI_S5/PHP_FrameWorks/PHP_AppCours';
$CONTENT_ROOT = $PROJECT_ROOT . '/content';
$PUBLIC_ROOT = $PROJECT_ROOT . '/public';
$DIST_ROOT = $PROJECT_ROOT . '/dist';

// Module IDs from curriculum
$MODULE_IDS = ['html', 'css', 'php', 'sql', 'integration', 'cpp', 'javascript', 'oracle'];

// ---------------------------------------------------------------------
// 1. Ensure dist directories exist
// ---------------------------------------------------------------------

foreach ($MODULE_IDS as $moduleId) {
    foreach (['html', 'css', 'php', 'sql', 'integration', 'cpp', 'javascript', 'oracle'] as $type) {
        $dir = $DIST_ROOT . '/courses/' . $moduleId . '/' . $type;
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
}

// Asset subdirectories
foreach (['css', 'js', 'fonts', 'images'] as $subdir) {
    $dir = $DIST_ROOT . '/assets/' . $subdir;
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// ---------------------------------------------------------------------
// 2. Copy static assets
// ---------------------------------------------------------------------

// Copy CSS files
foreach (glob($PUBLIC_ROOT . '/assets/css/*.css') as $src) {
    $basename = basename($src);
    $dst = $DIST_ROOT . '/assets/css/' . $basename;
    copy($src, $dst);
}

// Copy JS files
foreach (glob($PUBLIC_ROOT . '/assets/js/*.js') as $src) {
    $basename = basename($src);
    $dst = $DIST_ROOT . '/assets/js/' . $basename;
    copy($src, $dst);
}

// Copy fonts
foreach (glob($PUBLIC_ROOT . '/assets/fonts/*.woff2') as $src) {
    $basename = basename($src);
    $dst = $DIST_ROOT . '/assets/fonts/' . $basename;
    copy($src, $dst);
}

// Copy favicon
if (file_exists($PUBLIC_ROOT . '/favicon.svg')) {
    copy($PUBLIC_ROOT . '/favicon.svg', $DIST_ROOT . '/favicon.svg');
}

// Copy CodeMirror assets
$cmSrc = $PUBLIC_ROOT . '/assets/vendor/codemirror';
$cmDst = $DIST_ROOT . '/assets/vendor/codemirror';
if (is_dir($cmSrc)) {
    $items = scandir($cmSrc);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $srcItem = $cmSrc . '/' . $item;
        $dstItem = $cmDst . '/' . $item;
        if (is_dir($srcItem)) {
            @mkdir($dstItem, 0755, true);
            $subItems = scandir($srcItem);
            foreach ($subItems as $subItem) {
                if ($subItem === '.' || $subItem === '..') continue;
                copy($srcItem . '/' . $subItem, $dstItem . '/' . $subItem);
            }
        } else {
            copy($srcItem, $dstItem);
        }
    }
}

// ---------------------------------------------------------------------
// 3. Load curriculum manifest
// ---------------------------------------------------------------------

$curriculumFile = $CONTENT_ROOT . '/curriculum.php';
if (!file_exists($curriculumFile)) {
    die("ERREUR: Fichier introuvable: $curriculumFile\n");
}

$manifestData = require $curriculumFile;
$manifest = $manifestData['modules'];

// ---------------------------------------------------------------------
// 4. Helper functions
// ---------------------------------------------------------------------

function lesson_key(string $module, int $ch): string {
    return $module . '-ch' . $ch;
}

function renderBlocks(array $blocks): string {
    $output = '';
    foreach ($blocks as $block) {
        $type = $block['type'] ?? '';
        
        switch ($type) {
            case 'text':
                $output .= '<div class="wa-text">' . nl2br(htmlspecialchars((string)($block['fr'] ?? $block['darija'] ?? ''))) . '</div>';
                break;
                
            case 'definition':
                $title = htmlspecialchars(($block['title'] ?? ''));
                $fr = htmlspecialchars((string)($block['fr'] ?? ''));
                $darija = htmlspecialchars((string)($block['darija'] ?? ''));
                $output .= '<div class="wa-definition"><div class="hdr">' . ($title ? '<span>' . $title . '</span>' : '') . '</div><div>' . ($fr ? nl2br($fr) : '') . ($darija ? '<div class="wa-darija">' . nl2br($darija) . '</div>' : '') . '</div></div>';
                break;
                
            case 'syntax':
                $lang = htmlspecialchars(($block['lang'] ?? 'text'));
                $code = htmlspecialchars(($block['code'] ?? ''));
                $title = htmlspecialchars(($block['title'] ?? ''));
                $output .= '<pre class="wa-pre"><code class="' . $lang . '-code">' . ($title ? '<div class="bar"><span class="lang">' . $title . '</span></div>' : '') . '<code>' . $code . '</code></pre>';
                break;
                
            case 'example':
                $title = htmlspecialchars(($block['title'] ?? ''));
                $lang = htmlspecialchars(($block['lang'] ?? 'html'));
                $code = htmlspecialchars(($block['code'] ?? ''));
                $explainFr = htmlspecialchars(($block['explainFr'] ?? ''));
                $explainDarija = htmlspecialchars(($block['explainDarija'] ?? ''));
                
                $output .= '<div class="wa-example-card">';
                if ($title) {
                    $output .= '<div class="etitle"><span class="wa-ico">💡</span>' . $title . '</div>';
                }
                $output .= '<div class="wa-pre"><div class="bar"><span class="lang">' . $lang . '</span></div><code>' . $code . '</code></div>';
                if ($explainFr || $explainDarija) {
                    $output .= '<div class="explain">';
                    if ($explainFr) $output .= '<p><strong>Français :</strong> ' . $explainFr . '</p>';
                    if ($explainDarija) $output .= '<p><strong>Darija :</strong> ' . $explainDarija . '</p>';
                    $output .= '</div>';
                }
                $output .= '</div>';
                break;
                
            case 'table':
                $headers = $block['headers'] ?? [];
                $rows = $block['rows'] ?? [];
                $fr = $block['fr'] ?? '';
                
                if (!empty($headers) || !empty($rows)) {
                    $output .= '<div class="wa-tablewrap"><table class="wa-table"><thead><tr>';
                    foreach ($headers as $h) $output .= '<th>' . htmlspecialchars($h) . '</th>';
                    $output .= '</tr></thead><tbody>';
                    foreach ($rows as $row) {
                        $output .= '<tr>';
                        foreach ($row as $cell) $output .= '<td>' . htmlspecialchars($cell) . '</td>';
                        $output .= '</tr>';
                    }
                    $output .= '</tbody></table></div>';
                }
                if ($fr) {
                    $output .= '<div class="wa-text">' . nl2br($fr) . '</div>';
                }
                break;
                
            case 'note':
                $title = htmlspecialchars(($block['title'] ?? ''));
                $fr = htmlspecialchars((string)($block['fr'] ?? ''));
                $darija = htmlspecialchars((string)($block['darija'] ?? ''));
                $output .= '<div class="wa-callout tip"><div class="ttl"><span class="wa-ico">💡</span> ' . $title . '</div>' . ($fr ? '<p>' . $fr . '</p>' : '') . ($darija ? '<div class="wa-darija"><p>' . $darija . '</p></div>' : '') . '</div>';
                break;
                
            case 'tip':
                $title = htmlspecialchars(($block['title'] ?? ''));
                $fr = htmlspecialchars((string)($block['fr'] ?? ''));
                $darija = htmlspecialchars((string)($block['darija'] ?? ''));
                $output .= '<div class="wa-callout tip"><div class="ttl"><span class="wa-ico">💡</span> ' . $title . '</div>' . ($fr ? '<p>' . $fr . '</p>' : '') . ($darija ? '<div class="wa-darija"><p>' . $darija . '</p></div>' : '') . '</div>';
                break;
                
            case 'warning':
                $title = htmlspecialchars(($block['title'] ?? ''));
                $fr = htmlspecialchars((string)($block['fr'] ?? ''));
                $darija = htmlspecialchars((string)($block['darija'] ?? ''));
                $output .= '<div class="wa-callout warning"><div class="ttl"><span class="wa-ico">⚠️</span> ' . $title . '</div>' . ($fr ? '<p>' . $fr . '</p>' : '') . ($darija ? '<div class="wa-darija"><p>' . $darija . '</p></div>' : '') . '</div>';
                break;
                
            case 'keywords':
                $items = $block['items'] ?? [];
                if (!empty($items)) {
                    $output .= '<div class="wa-keywords">';
                    foreach ($items as $item) {
                        $kw = htmlspecialchars(($item['kw'] ?? ''));
                        $fr = htmlspecialchars(($item['fr'] ?? ''));
                        $darija = htmlspecialchars(($item['darija'] ?? ''));
                        $output .= '<div class="wa-kw"><b>' . $kw . '</b><span class="f">' . $fr . '</span><span class="d">' . $darija . '</span></div>';
                    }
                    $output .= '</div>';
                }
                break;
                
            case 'code':
                $lang = htmlspecialchars(($block['lang'] ?? 'html'));
                $code = htmlspecialchars(($block['code'] ?? ''));
                $output .= '<pre class="wa-pre"><code class="' . $lang . '-code">' . $code . '</code></pre>';
                break;
                
            default:
                // Skip unknown block types
                break;
        }
    }
    return $output;
}

// ---------------------------------------------------------------------
// 5. Generate chapter HTML page
// ---------------------------------------------------------------------

function generateChapterPage(string $moduleId, string $moduleName, int $chNum, string $chTitle, $chapterData, array &$generatedLessons): string {
    $key = lesson_key($moduleId, $chNum);
    
    // Build the lesson sections from the chapter data
    $lessons = [];
    if (is_array($chapterData) && isset($chapterData['lessons'])) {
        foreach ($chapterData['lessons'] ?? [] as $section) {
            $blocks = is_array($section) ? ($section['blocks'] ?? []) : [];
            $lessons[] = [
                'id' => $section['id'] ?? '',
                'title' => $section['title'] ?? '',
                'content' => renderBlocks($blocks),
            ];
        }
    }
    
    // Also collect mistakes and summary
    $mistakes = is_array($chapterData) ? ($chapterData['mistakes'] ?? []) : [];
    $summary = is_array($chapterData) ? ($chapterData['summary'] ?? ['fr' => '', 'darija' => '']) : [];
    
    // Store generated lesson data
    $generatedLessons[$key] = [
        'module' => $moduleId,
        'ch' => $chNum,
        'title' => $chTitle,
        'lessons' => $lessons,
        'mistakes' => $mistakes,
        'summary' => $summary,
    ];
    
    // Build mistakes HTML
    $mistakesHtml = '';
    foreach ($mistakes as $mistake) {
        if (!is_array($mistake)) continue;
        $wrong = htmlspecialchars($mistake['wrong'] ?? '');
        $fix = htmlspecialchars($mistake['fix'] ?? '');
        $fr = htmlspecialchars($mistake['fr'] ?? '');
        $darija = htmlspecialchars($mistake['darija'] ?? '');
        $mistHtmlPart1 = ($fr ? $fr : ($darija ? $darija : $wrong));
        $mistHtmlPart2 = ($fr ? $fix : '');
        $mistakesHtml .= '<div class="wa-mistake"><div><p>' . $mistHtmlPart1 . '</p></div><div><p>' . $mistHtmlPart2 . '</p></div></div>';
    }
    
    $summaryFr = $summary['fr'] ?? '';
    $summaryDarija = $summary['darija'] ?? '';
    
    $pageContent = '';
    
    // Add lessons
    foreach ($lessons as $lesson) {
        $pageContent .= '<section>';
        if ($lesson['title']) {
            $pageContent .= '<h2>' . $lesson['title'] . '</h2>';
        }
        $pageContent .= $lesson['content'];
        $pageContent .= '</section>';
    }
    
    // Add mistakes
    if (!empty($mistakesHtml)) {
        $pageContent .= '<div class="wa-mistake">' . $mistakesHtml . '</div>';
    }
    
    // Add summary
    if ($summaryFr || $summaryDarija) {
        $pageContent .= '<div class="wa-summary"><div class="parts"><div class="wa-card"><h4>Résumé Français</h4><p>' . nl2br($summaryFr) . '</p></div><div class="wa-card"><h4>Résumé Darija</h4><p>' . nl2br($summaryDarija) . '</p></div></div></div>';
    }
    
    // Build HTML using output buffering
    ob_start();
    ?><!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($moduleName . ' - ' . $chTitle); ?></title>
    <meta name="description" content="WebAcademy : cours de développement web">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#f6f1e7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#14110d" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="favicon.svg" type="image/svg+xml">
    <script src="assets/js/theme-init.js" defer></script>
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/codemirror.min.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/theme/material-darker.min.css">
</head>
<body>
    <a class="wa-skip" id="wa-skip" href="#wa-main">Aller au contenu principal</a>
    
    <div id="wa-app" class="wa-app">
        <aside id="wa-sidebar" class="wa-sidebar" aria-label="Navigation principale">
            <div class="wa-sidebar-scroll" id="wa-sidebar-scroll">
                <div class="wa-boot-side" aria-hidden="true">
                    <span class="wa-skeleton wa-skeleton-mark"></span>
                    <span class="wa-skeleton wa-skeleton-line"></span>
                    <span class="wa-skeleton wa-skeleton-line short"></span>
                </div>
            </div>
        </aside>

        <div id="wa-scrim" class="wa-scrim" hidden></div>

        <main id="wa-main" class="wa-main" tabindex="-1" aria-busy="true">
            <div class="wa-boot" role="status" aria-live="polite">
                <span class="wa-boot-mark" aria-hidden="true"></></span>
                <span>Chargement de WebAcademy…</span>
            </div>
        </main>
    </div>

    <div id="wa-route-status" class="wa-sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
    <div id="wa-toast" class="wa-toast" role="status" aria-live="polite" aria-atomic="true"></div>

    <noscript>
        <div class="wa-noscript">
            <h1>JavaScript est nécessaire</h1>
            <p>WebAcademy a besoin de JavaScript pour afficher les cours et exécuter les ateliers. Activez-le dans votre navigateur, puis rechargez la page.</p>
        </div>
    </noscript>

    <script src="assets/vendor/codemirror/codemirror.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/xml.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/css.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/javascript.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/htmlmixed.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/clike.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/php.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/sql.min.js" defer></script>
    <script src="assets/js/api.js" defer></script>
    <script src="assets/js/ui.js" defer></script>
    <script src="assets/js/editor.js" defer></script>
    <script src="assets/js/runner.js" defer></script>
    <script src="assets/js/quiz.js" defer></script>
    <script src="assets/js/lesson.js" defer></script>
    <script src="assets/js/lab.js" defer></script>
    <script src="assets/js/app.js" defer></script>
</body>
</html>
<?php
    $htmlStart = ob_get_clean();
    
    // Build navigation prev/next links - will be filled by caller
    $prevLink = '';
    $nextLink = '';
    
    // Build TOC - will be filled by caller
    $tocLinks = '';
    
    // Combine start HTML with content
    $finalHtml = $htmlStart;
    $finalHtml = str_replace('{content}', $pageContent, $finalHtml);
    $finalHtml = str_replace('{toc}', $tocLinks, $finalHtml);
    $finalHtml = str_replace('{prev}', $prevLink, $finalHtml);
    $finalHtml = str_replace('{next}', $nextLink, $finalHtml);
    
    // Add bottom navigation
    $bottomNav = '<div class="wa-navbottom"><div>' . $prevLink . '</div><div>' . $nextLink . '</div></div>';
    $finalHtml = str_replace('</body>', $bottomNav . '</body>', $finalHtml);
    $finalHtml = str_replace('</html>', $bottomNav . '</html>', $finalHtml);
    
    return $finalHtml;
}

// ---------------------------------------------------------------------
// 6. Generate course page (for cpp and javascript modules)
// ---------------------------------------------------------------------

function generateCoursePage(string $moduleId, string $moduleName): string {
    ob_start();
    ?><!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($moduleName . ' - WebAcademy'); ?></title>
    <meta name="description" content="Cours <?php echo htmlspecialchars($moduleName); ?> de développement web">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#f6f1e7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#14110d" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="favicon.svg" type="image/svg+xml">
    <script src="assets/js/theme-init.js" defer></script>
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/codemirror.min.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/theme/material-darker.min.css">
</head>
<body>
    <a class="wa-skip" id="wa-skip" href="#wa-main">Aller au contenu principal</a>
    
    <div id="wa-app" class="wa-app">
        <aside id="wa-sidebar" class="wa-sidebar" aria-label="Navigation principale">
            <div class="wa-sidebar-scroll" id="wa-sidebar-scroll">
                <div class="wa-boot-side" aria-hidden="true">
                    <span class="wa-skeleton wa-skeleton-mark"></span>
                    <span class="wa-skeleton wa-skeleton-line"></span>
                    <span class="wa-skeleton wa-skeleton-line short"></span>
                </div>
            </div>
        </aside>

        <div id="wa-scrim" class="wa-scrim" hidden></div>

        <main id="wa-main" class="wa-main" tabindex="-1" aria-busy="true">
            <div class="wa-boot" role="status" aria-live="polite">
                <span class="wa-boot-mark" aria-hidden="true"></></span>
                <span><?php echo htmlspecialchars($moduleName); ?> - Cours complet</span>
            </div>
        </main>
    </div>

    <script src="assets/vendor/codemirror/codemirror.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/xml.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/css.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/javascript.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/htmlmixed.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/clike.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/php.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/sql.min.js" defer></script>
    <script src="assets/js/api.js" defer></script>
    <script src="assets/js/ui.js" defer></script>
    <script src="assets/js/editor.js" defer></script>
    <script src="assets/js/runner.js" defer></script>
    <script src="assets/js/quiz.js" defer></script>
    <script src="assets/js/lesson.js" defer></script>
    <script src="assets/js/app.js" defer></script>
</body>
</html>
<?php
    return ob_get_clean();
}

// ---------------------------------------------------------------------
// 7. Generate home/index page
// ---------------------------------------------------------------------

$homeHtml = '<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAcademy - Cours de développement web</title>
    <meta name="description" content="WebAcademy : cours de développement web (HTML, CSS, PHP, SQL, C++ et JavaScript) en français et en darija">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#f6f1e7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#14110d" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="favicon.svg" type="image/svg+xml">
    <script src="assets/js/theme-init.js" defer></script>
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/codemirror.min.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/theme/material-darker.min.css">
</head>
<body>
    <a class="wa-skip" id="wa-skip" href="#wa-main">Aller au contenu principal</a>
    
    <div id="wa-app" class="wa-app">
        <aside id="wa-sidebar" class="wa-sidebar" aria-label="Navigation principale">
            <div class="wa-sidebar-scroll" id="wa-sidebar-scroll">
                <div class="wa-boot-side" aria-hidden="true">
                    <span class="wa-skeleton wa-skeleton-mark"></span>
                    <span class="wa-skeleton wa-skeleton-line"></span>
                    <span class="wa-skeleton wa-skeleton-line short"></span>
                </div>
            </div>
        </aside>

        <div id="wa-scrim" class="wa-scrim" hidden></div>

        <main id="wa-main" class="wa-main" tabindex="-1" aria-busy="true">
            <div class="wa-boot" role="status" aria-live="polite">
                <span class="wa-boot-mark" aria-hidden="true"></></span>
                <span>Bienvenue sur WebAcademy</span>
            </div>
        </main>
    </div>

    <div id="wa-route-status" class="wa-sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
    <div id="wa-toast" class="wa-toast" role="status" aria-live="polite" aria-atomic="true"></div>

    <noscript>
        <div class="wa-noscript">
            <h1>JavaScript est nécessaire</h1>
            <p>WebAcademy a besoin de JavaScript pour afficher les cours et exécuter les ateliers. Activez-le dans votre navigateur, puis rechargez la page.</p>
        </div>
    </noscript>

    <script src="assets/vendor/codemirror/codemirror.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/xml.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/css.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/javascript.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/htmlmixed.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/clike.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/php.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/sql.min.js" defer></script>
    <script src="assets/js/api.js" defer></script>
    <script src="assets/js/ui.js" defer></script>
    <script src="assets/js/editor.js" defer></script>
    <script src="assets/js/runner.js" defer></script>
    <script src="assets/js/quiz.js" defer></script>
    <script src="assets/js/lesson.js" defer></script>
    <script src="assets/js/app.js" defer></script>
</body>
</html>';

$homeFile = $DIST_ROOT . '/index.html';
file_put_contents($homeFile, $homeHtml);

// ---------------------------------------------------------------------
// 8. Generate search index
// ---------------------------------------------------------------------

$searchIndex = [
    'modules' => [],
    'lessons' => []
];

foreach ($manifest as $module) {
    $moduleId = $module['id'];
    $moduleName = $module['name'] ?? $moduleId;
    
    $searchIndex['modules'][] = [
        'id' => $moduleId,
        'name' => $moduleName,
    ];
    
    $chapters = $module['chapters'] ?? [];
    foreach ($chapters as $chapter) {
        $chNum = $chapter['n'] ?? 0;
        $chTitle = $chapter['title'] ?? '';
        
        $chFile = $CONTENT_ROOT . '/' . $moduleId . '/c' . sprintf('%02d', $chNum) . '.php';
        if (file_exists($chFile)) {
            $chapterData = @require $chFile;
            if ($chapterData && isset($chapterData['lessons'])) {
                foreach ($chapterData['lessons'] as $section) {
                    $needle = '';
                    // Collect text from title and blocks for search
                    if (isset($section['title'])) {
                        $needle .= $section['title'] . ' ';
                    }
                    if (is_array($section) && isset($section['blocks'])) {
                        foreach ($section['blocks'] ?? [] as $block) {
                            $type = $block['type'] ?? '';
                            switch ($type) {
                                case 'text':
                                    $needle .= (string)($block['fr'] ?? $block['darija'] ?? '') . ' ';
                                    break;
                                case 'syntax':
                                case 'example':
                                    $needle .= (string)($block['title'] ?? '') . ' ' . (string)($block['code'] ?? '') . ' ';
                                    break;
                            }
                        }
                    }
                    
                    if ($needle) {
                        $searchIndex['lessons'][] = [
                            'module' => $moduleId,
                            'ch' => $chNum,
                            'title' => $chTitle,
                            'keyword' => trim($needle),
                        ];
                    }
                }
            }
        }
    }
}

// Write search index
$searchFile = $DIST_ROOT . '/search/index.json';
file_put_contents($searchFile, json_encode($searchIndex, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

// ---------------------------------------------------------------------
// 9. Generate 404 page
// ---------------------------------------------------------------------

$fourOFour = '<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - WebAcademy</title>
    <meta name="description" content="Page non trouvée sur WebAcademy">
    <meta name="theme-color" content="#f6f1e7" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#14110d" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="favicon.svg" type="image/svg+xml">
    <script src="assets/js/theme-init.js" defer></script>
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/codemirror.min.css">
    <link rel="stylesheet" href="assets/vendor/codemirror/theme/material-darker.min.css">
</head>
<body>
    <a class="wa-skip" id="wa-skip" href="#wa-main">Aller au contenu principal</a>
    
    <div id="wa-app" class="wa-app">
        <aside id="wa-sidebar" class="wa-sidebar" aria-label="Navigation principale">
            <div class="wa-sidebar-scroll" id="wa-sidebar-scroll">
                <div class="wa-boot-side" aria-hidden="true">
                    <span class="wa-skeleton wa-skeleton-mark"></span>
                    <span class="wa-skeleton wa-skeleton-line"></span>
                    <span class="wa-skeleton wa-skeleton-line short"></span>
                </div>
            </div>
        </aside>

        <div id="wa-scrim" class="wa-scrim" hidden></div>

        <main id="wa-main" class="wa-main" tabindex="-1" aria-busy="true">
            <div class="wa-boot" role="status" aria-live="polite">
                <span class="wa-boot-mark" aria-hidden="true"></></span>
                <span>Page introuvable</span>
            </div>
        </main>
    </div>

    <script src="assets/vendor/codemirror/codemirror.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/xml.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/css.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/javascript.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/htmlmixed.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/clike.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/php.min.js" defer></script>
    <script src="assets/vendor/codemirror/mode/sql.min.js" defer></script>
    <script src="assets/js/api.js" defer></script>
    <script src="assets/js/ui.js" defer></script>
    <script src="assets/js/editor.js" defer></script>
    <script src="assets/js/runner.js" defer></script>
    <script src="assets/js/quiz.js" defer></script>
    <script src="assets/js/lesson.js" defer></script>
    <script src="assets/js/app.js" defer></script>
</body>
</html>';

$fourOFourFile = $DIST_ROOT . '/404.html';
file_put_contents($fourOFourFile, $fourOFour);

// ---------------------------------------------------------------------
// 10. Generate pages for each module
// ---------------------------------------------------------------------

$generatedPages = [];
$generatedLessons = [];

foreach ($manifest as $module) {
    $moduleId = $module['id'];
    $moduleName = $module['name'] ?? $moduleId;
    $moduleColor = $module['color'] ?? 'indigo';
    $moduleIcon = $module['icon'] ?? '?';
    $moduleBlurb = $module['blurb'] ?? '';
    
    $chapters = $module['chapters'] ?? [];
    
    // Get all chapters for navigation
    $allChapters = $chapters;
    
    // Process each chapter
    foreach ($chapters as $chapter) {
        $chNum = $chapter['n'] ?? 0;
        $chTitle = $chapter['title'] ?? 'Chapitre ' . $chNum;
        
        // Load chapter content file: content/<module>/c{chNum:02d}.php
        $chFile = $CONTENT_ROOT . '/' . $moduleId . '/c' . sprintf('%02d', $chNum) . '.php';
        
        if (!file_exists($chFile)) {
            // Skip if chapter file doesn't exist
            $pageKey = lesson_key($moduleId, $chNum);
            $generatedPages[$pageKey] = [
                'module' => $moduleId,
                'ch' => $chNum,
                'title' => $chTitle,
                'html' => '<p>Chapitre non encore rédigé.</p>'
            ];
            continue;
        }
        
        $chapterData = @require $chFile;
        if ($chapterData === false) {
            error_log("Impossible de charger le chapitre: $chFile");
            continue;
        }
        if (!isset($chapterData['id'], $chapterData['title'], $chapterData['lessons'])) {
            continue;
        }
        
        $key = $chapterData['id'];
        $moduleKey = lesson_key($moduleId, $chNum);
        
        // Build navigation prev/next links
        $currentIndex = array_search($chapter, $allChapters, true);
        $prevChapter = $currentIndex > 0 ? $allChapters[$currentIndex - 1] : null;
        $nextChapter = $currentIndex < count($allChapters) - 1 ? $allChapters[$currentIndex + 1] : null;
        
        $prevLink = $prevChapter ? '<a href="courses/' . $moduleId . '/html/' . sprintf('%02d', $prevChapter['n']) . '.html" class="wa-navbottom-prev">Précédent</a>' : '';
        $nextLink = $nextChapter ? '<a href="courses/' . $moduleId . '/html/' . sprintf('%02d', $nextChapter['n']) . '.html" class="wa-navbottom-next">Suivant</a>' : '';
        
        // Build TOC
        $tocLinks = '';
        foreach ($allChapters as $idx => $ch) {
            $active = ($ch['n'] == $chNum) ? 'active' : '';
            $tocLinks .= '<a href="#" class="wa-toc-link ' . $active . '"><span class="n">' . sprintf('%02d', $ch['n']) . '</span>' . htmlspecialchars($ch['title']) . '</a>';
        }
        
        // Generate the page content
        $page = generateChapterPage($moduleId, $moduleName, $chNum, $chTitle, $chapterData, $generatedLessons);
        
        // Replace placeholders with actual navigation
        $page = str_replace('{prev}', $prevLink, $page);
        $page = str_replace('{next}', $nextLink, $page);
        $page = str_replace('{toc}', $tocLinks, $page);
        
        // Write the page
        $outFile = $DIST_ROOT . '/courses/' . $moduleId . '/html/' . sprintf('%02d', $chNum) . '.html';
        file_put_contents($outFile, $page);
        
        $generatedPages[$moduleKey] = [
            'module' => $moduleId,
            'ch' => $chNum,
            'title' => $chTitle,
            'file' => $outFile
        ];
    }
    
    // Also generate a course listing page for modules with 'course => true' (cpp, javascript)
    if ($module['course'] ?? false) {
        $courseHtml = generateCoursePage($moduleId, $moduleName);
        $outFile = $DIST_ROOT . '/courses/' . $moduleId . '/html/' . $moduleId . '-course.html';
        file_put_contents($outFile, $courseHtml);
        $generatedPages[$moduleId . '-course'] = [
            'module' => $moduleId,
            'type' => 'course',
            'file' => $outFile
        ];
    }
}

// ---------------------------------------------------------------------
// 11. Output summary
// ---------------------------------------------------------------------

$pageCount = count($generatedPages);
error_log("Migration terminée : $pageCount pages générées");

echo "Migration WebAcademy terminée !\n";
echo "Modules traités : " . count($manifest) . "\n";
echo "Pages générées : $pageCount\n";
echo "Recherche : search/index.json\n";
echo "Page d'accueil : dist/index.html\n";
echo "Page 404 : dist/404.html\n";