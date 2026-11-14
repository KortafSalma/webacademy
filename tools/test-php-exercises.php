<?php

declare(strict_types=1);

/**
 * Vérifie les solutions des exercices PHP dans la vraie sandbox PhpExecutor.
 *
 * Usage : php tools/test-php-exercises.php content/integration/ex01.php ...
 */

require __DIR__ . '/../src/bootstrap.php';

use App\Execution\PhpExecutor;

$files = array_slice($argv, 1);
if ($files === []) {
    $files = array_merge(
        glob(__DIR__ . '/../content/php/ex*.php') ?: [],
        glob(__DIR__ . '/../content/integration/ex*.php') ?: []
    );
}

function norm(string $value): string
{
    $value = strtolower($value);
    $value = preg_replace('/\s+/', ' ', $value) ?? $value;
    $value = preg_replace('/\s*([(),;])\s*/', '$1', $value) ?? $value;
    return trim($value);
}

$failures = 0;
$checks = 0;

foreach ($files as $file) {
    $exercise = require $file;
    echo '== ' . basename($file) . ' — ' . ($exercise['title'] ?? '') . "\n";

    foreach ($exercise['levels'] as $level) {
        if (($level['lang'] ?? '') !== 'php') {
            echo "  Niveau {$level['level']} : ignoré (lang=" . ($level['lang'] ?? '?') . ")\n";
            continue;
        }

        $result = PhpExecutor::run((string) $level['solution']);
        $output = (string) ($result['output'] ?? '');
        $stderr = trim((string) ($result['stderr'] ?? ''));
        $labels = [];
        if (!$result['ok']) { $labels[] = 'sandbox failure'; $failures++; }

        foreach ($level['tests'] as $test) {
            $checks++;
            $type = (string) $test['type'];
            $value = (string) $test['value'];
            $pass = false;

            if ($type === 'output_contains') {
                $pass = str_contains(norm($output), norm($value));
            } elseif ($type === 'output_not_contains') {
                $pass = !str_contains(norm($output), norm($value));
            } else {
                $pass = false;
            }

            if (!$pass) {
                $labels[] = $type . ' ' . $value;
                $failures++;
            }
        }

        $status = $labels === [] ? 'OK' : 'ECHEC (' . implode(' ; ', $labels) . ')';
        echo "  Niveau {$level['level']} : {$status}";
        if (!$result['ok']) {
            echo ' — sandbox : ' . ($result['error'] ?? 'échec') . ($stderr !== '' ? ' | ' . $stderr : '');
        }
        if ($labels !== []) {
            echo ' | sortie=' . json_encode($output, JSON_UNESCAPED_UNICODE);
        }
        echo "\n";
    }
}

echo "\n{$checks} tests, {$failures} échec(s).\n";
exit($failures === 0 ? 0 : 1);
