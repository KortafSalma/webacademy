<?php

declare(strict_types=1);

$paths = $argv;
array_shift($paths);
if (!$paths) {
    $paths = glob(__DIR__ . '/src/*.json') ?: [];
}

$pattern = '/[\x{0600}-\x{06FF}\x{0750}-\x{077F}]/u';

foreach ($paths as $path) {
    if (is_dir($path)) {
        $files = glob(rtrim($path, '/\\') . '/*') ?: [];
    } else {
        $files = [$path];
    }
    foreach ($files as $file) {
        if (!is_file($file)) {
            continue;
        }
        $content = file_get_contents($file);
        if (preg_match_all($pattern, $content, $matches)) {
            foreach ($matches[0] as $m) {
                echo basename($file) . " : caractère arabe détecté : {$m}\n";
            }
        }
    }
}

echo "Vérification terminée.\n";
