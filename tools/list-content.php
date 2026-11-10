<?php

declare(strict_types=1);

$modules = ['html', 'css', 'php', 'sql', 'integration'];
foreach ($modules as $module) {
    echo "== {$module} ==\n";
    $files = glob(__DIR__ . '/../content/' . $module . '/*.php') ?: [];
    sort($files);
    foreach ($files as $file) {
        $data = require $file;
        $name = basename($file);
        if (str_starts_with($name, 'c')) {
            printf("%-8s %-14s %s\n", $name, $data['id'] ?? '?', $data['title'] ?? '?');
        } elseif (str_starts_with($name, 'ex')) {
            printf("%-8s %-14s %s\n", $name, $data['id'] ?? '?', $data['title'] ?? '?');
        } elseif (str_starts_with($name, 'qz')) {
            printf("%-8s %-14s %s (%d questions)\n", $name, 'quiz', $data['title'] ?? '?', count($data['questions'] ?? []));
        }
    }
}
