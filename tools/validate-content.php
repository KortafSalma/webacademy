<?php
/** Validate the shipped chapter, exercise and quiz schemas. Content gaps are warnings. */
declare(strict_types=1);
require dirname(__DIR__) . '/src/bootstrap.php';
require_once APP_CONTENT . '/oracle/_helpers.php';
use App\Core\Content;
$errors = 0;
$warnings = 0;
$files = 0;
function reportContent(string $file, string $message, bool $error = true): void {
    global $errors, $warnings;
    if ($error) $errors++; else $warnings++;
    echo ($error ? 'ERROR ' : 'WARN ') . $file . ': ' . $message . "\n";
}
foreach (Content::manifest()['modules'] as $module) {
    $dir = APP_CONTENT . '/' . $module['id'];
    foreach (array_merge(glob($dir . '/c[0-9]*.php') ?: [], glob($dir . '/ex[0-9]*.php') ?: [], glob($dir . '/qz[0-9]*.php') ?: []) as $file) {
        $files++;
        $name = $module['id'] . '/' . basename($file);
        try { $data = require $file; }
        catch (Throwable $e) { reportContent($name, $e->getMessage()); continue; }
        if (!is_array($data) || !is_string($data['title'] ?? null)) { reportContent($name, 'Missing title or invalid array'); continue; }
        if (preg_match('/^c\d+/', basename($file))) {
            if (empty($data['id']) || empty($data['lessons']) || !is_array($data['lessons'])) { reportContent($name, 'Missing chapter id or lessons'); continue; }
            foreach ($data['lessons'] as $section) {
                if (!is_array($section) || empty($section['blocks']) || !is_array($section['blocks'])) { reportContent($name, 'Missing lesson blocks'); continue; }
                foreach ($section['blocks'] as $block) {
                    if (!is_array($block) || empty($block['type'])) { reportContent($name, 'Invalid block'); continue; }
                    if (($block['type'] ?? '') === 'text' && (mb_strlen(strip_tags($block['fr'] ?? '')) < 25 || empty($block['darija']))) {
                        reportContent($name, 'Short text or missing Darija translation', false);
                    }
                }
            }
        } elseif (str_starts_with(basename($file), 'ex')) {
            if (empty($data['levels']) || !is_array($data['levels'])) { reportContent($name, 'Missing exercise levels'); continue; }
            foreach ($data['levels'] as $level) {
                if (!is_array($level) || !in_array($level['level'] ?? null, range(1, 6), true) || !isset($level['solution']) || (empty($data['static']) && !is_array($level['tests'] ?? null))) reportContent($name, 'Invalid exercise level');
            }
        } else {
            if (empty($data['questions']) || !is_array($data['questions'])) { reportContent($name, 'Missing quiz questions'); continue; }
            foreach ($data['questions'] as $q) {
                $type = $q['type'] ?? 'mcq';
                if (!is_array($q) || empty($q['question'])) { reportContent($name, 'Invalid question'); continue; }
                if (in_array($type, ['fill', 'sql'], true)) {
                    if (!isset($q['expected']) && !isset($q['answer']) && !isset($q['solution'])) reportContent($name, 'Missing expected answer');
                } else {
                    $options = $type === 'tf' ? ['Vrai', 'Faux'] : ($type === 'true_false' ? ['Faux', 'Vrai'] : ($q['options'] ?? []));
                    if (!is_array($options) || count($options) < 2) { reportContent($name, 'Missing selectable options'); continue; }
                    foreach (is_array($q['answer'] ?? null) ? $q['answer'] : [$q['answer'] ?? null] as $index) {
                        if (!is_int($index) || !array_key_exists($index, $options)) reportContent($name, 'Invalid answer index');
                    }
                }
            }
        }
    }
}
echo "$files files, $errors errors, $warnings warnings.\n";
exit($errors ? 1 : 0);
