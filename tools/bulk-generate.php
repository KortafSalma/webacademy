<?php

declare(strict_types=1);

/**
 * Génère en lot des exercices et des quiz à partir d'un fichier JSON compact.
 *
 * Usage : php tools/bulk-generate.php tools/src/bulk-<module>.json
 *
 * Format :
 * {
 *   "exercises": {
 *     "html": {
 *       "2": {"title": "...", "brief": "...", "levels": [
 *          ["Débutant — ...", "html", "instructions FR", "instructions Darija",
 *           "starter", [["html_contains", "<!DOCTYPE html>"]],
 *           ["indice 1", "indice 2"], "solution", "explain FR", "explain Darija"]
 *       ]}
 *     }
 *   },
 *   "quizzes": {
 *     "html": {
 *       "2": {"title": "Quiz — ...", "questions": [
 *          ["mcq", "question", ["a", "b", "c"], 1, "concept", "explain FR", "explain Darija"],
 *          ["tf", "question", 1, "concept", "explain FR", "explain Darija"],
 *          ["mcq", "question", ["a", "b"], 0, "concept", "explain FR", "explain Darija", "code", "php"]
 *       ]}
 *     }
 *   }
 * }
 */

$source = $argv[1] ?? '';
if ($source === '' || !is_file($source)) {
    fwrite(STDERR, "Usage : php tools/bulk-generate.php <spec.json>\n");
    exit(1);
}

$spec = json_decode(file_get_contents($source), true, 512, JSON_THROW_ON_ERROR);

$root = dirname(__DIR__) . '/content';

function phpFile(string $path, array $data): void
{
    $directory = dirname($path);
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    $php = "<?php\n\ndeclare(strict_types=1);\n\n/**\n * Contenu généré depuis " . basename($path) . "\n */\n\nreturn " . var_export($data, true) . ";\n";
    file_put_contents($path, $php);
    echo "Généré : {$path}\n";
}

function buildTests(array $tests): array
{
    $out = [];
    foreach ($tests as $test) {
        $out[] = ['type' => $test[0], 'value' => $test[1]];
    }
    return $out;
}

foreach (($spec['exercises'] ?? []) as $module => $chapters) {
    foreach ($chapters as $n => $exercise) {
        $levels = [];
        foreach ($exercise['levels'] as $level) {
            [$title, $lang, $fr, $darija, $starter, $tests, $hints, $solution, $explainFr, $explainDarija] = $level;
            $levels[] = [
                'level' => count($levels) + 1,
                'title' => $title,
                'lang' => $lang,
                'instructions' => $fr,
                'instructionsDarija' => $darija,
                'starter' => $starter,
                'tests' => buildTests($tests),
                'hints' => $hints,
                'solution' => $solution,
                'explainFr' => $explainFr,
                'explainDarija' => $explainDarija,
            ];
        }

        $data = [
            'id' => $module . '-ex' . $n,
            'title' => $exercise['title'],
            'brief' => $exercise['brief'],
            'levels' => $levels,
        ];
        if ($module === 'sql') {
            $data['dataset'] = 'school';
            $data['dialect'] = 'sqlite';
        }

        phpFile($root . '/' . $module . '/ex' . str_pad((string) $n, 2, '0', STR_PAD_LEFT) . '.php', $data);
    }
}

foreach (($spec['quizzes'] ?? []) as $module => $chapters) {
    foreach ($chapters as $n => $quiz) {
        $questions = [];
        foreach ($quiz['questions'] as $q) {
            $type = $q[0];
            $item = [
                'type' => $type,
                'question' => $q[1],
            ];
            $index = 2;
            if (in_array($type, ['mcq', 'multi', 'complete', 'find-error', 'predict'], true)) {
                $item['options'] = $q[$index++];
            }
            $item['answer'] = $q[$index++];
            $item['concept'] = $q[$index++];
            $item['explainFr'] = $q[$index++];
            $item['explainDarija'] = $q[$index++];
            if (isset($q[$index])) {
                $item['codeText'] = $q[$index++];
            }
            if (isset($q[$index])) {
                $item['lang'] = $q[$index++];
            }
            $questions[] = $item;
        }

        phpFile($root . '/' . $module . '/qz' . str_pad((string) $n, 2, '0', STR_PAD_LEFT) . '.php', [
            'title' => $quiz['title'],
            'questions' => $questions,
        ]);
    }
}
