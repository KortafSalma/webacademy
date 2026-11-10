<?php

declare(strict_types=1);

$file = $argv[1] ?? '';
if ($file === '' || !is_file($file)) {
    fwrite(STDERR, "Usage: php tools/balance.php <file> [-v]\n");
    exit(1);
}

$source = file_get_contents($file);
$tokens = token_get_all($source);
$depth = 0;
$line = 1;
$verbose = ($argv[2] ?? '') === '-v';

foreach ($tokens as $token) {
    $text = is_array($token) ? $token[1] : $token;

    if (!is_array($token)) {
        if ($text === '[') {
            $depth++;
            if ($verbose) {
                echo "line {$line}: [ -> depth {$depth}\n";
            }
        } elseif ($text === ']') {
            $depth--;
            if ($verbose) {
                echo "line {$line}: ] -> depth {$depth}\n";
            }
            if ($depth < 0) {
                fwrite(STDERR, "Extra ] before line {$line}\n");
                exit(1);
            }
        }
    }

    $line += substr_count($text, "\n");
}

echo "Bracket balance: {$depth}\n";
