<?php
/** Read-only audit of PHP syntax, content loading, and persistence contracts. */
declare(strict_types=1);
require dirname(__DIR__) . '/src/bootstrap.php';

use App\Core\Content;
use App\Core\Database;
use App\Core\Repos;

$report = ['php' => PHP_VERSION, 'syntax' => [], 'modules' => [], 'projects' => [], 'regressions' => []];
$checked = 0;
foreach (['src', 'public', 'views', 'content', 'tools'] as $directory) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(APP_ROOT . '/' . $directory));
    foreach ($files as $file) {
        if (!$file->isFile() || $file->getExtension() !== 'php') continue;
        $checked++;
        try { token_get_all(file_get_contents($file->getPathname()), TOKEN_PARSE); }
        catch (ParseError $e) {
            $report['syntax'][] = ['file' => str_replace('\\', '/', substr($file->getPathname(), strlen(APP_ROOT) + 1)), 'line' => $e->getLine(), 'error' => $e->getMessage()];
        }
    }
}
$report['phpFilesChecked'] = $checked;
foreach (Content::manifest()['modules'] as $module) {
    $stats = ['planned' => count($module['chapters']), 'loaded' => 0, 'exercises' => 0, 'quizzes' => 0, 'missing' => [], 'emptySections' => [], 'unsupportedQuizTypes' => []];
    foreach ($module['chapters'] as $chapter) {
        $n = (int) $chapter['n'];
        $lesson = Content::lesson($module['id'], $n);
        if ($lesson === null) { $stats['missing'][] = $n; continue; }
        $stats['loaded']++;
        if ($lesson['exercise'] !== null) $stats['exercises']++;
        if ($lesson['quiz'] !== null) $stats['quizzes']++;
        foreach ($lesson['chapter']['lessons'] ?? [] as $section) {
            if (empty($section['blocks'])) $stats['emptySections'][] = $n;
        }
        foreach ($lesson['quiz']['questions'] ?? [] as $question) {
            if (!in_array($question['type'] ?? '', ['true_false', 'find-error', 'predict', 'mcq', 'single', 'multi', 'fill', 'sql', 'tf'], true)) {
                $stats['unsupportedQuizTypes'][] = ['chapter' => $n, 'type' => $question['type'] ?? 'missing'];
            }
        }
    }
    $report['modules'][$module['id']] = $stats;
}
$report['projects'] = array_column(Content::projects(), 'id');
// Roll back every persistence probe so user data is preserved.
$db = Database::pdo();
$db->beginTransaction();
try {
    Repos::setSetting('__audit_null', null);
    $report['regressions']['nullSetting'] = ['expected' => null, 'actual' => Repos::setting('__audit_null', 'fallback')];
    $missingId = (int) $db->query('SELECT COALESCE(MAX(id), 0) + 100000 FROM notes')->fetchColumn();
    $returnedId = Repos::saveNote($missingId, 'audit', 'audit', null);
    $stmt = $db->prepare('SELECT COUNT(*) FROM notes WHERE id = ?');
    $stmt->execute([$returnedId]);
    $report['regressions']['nonexistentNoteUpdate'] = ['returnedId' => $returnedId, 'rowsSaved' => (int) $stmt->fetchColumn()];
} finally { $db->rollBack(); }
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE), "\n";
