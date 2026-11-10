<?php

declare(strict_types=1);

$file = $argv[1] ?? '';
$from = (int) ($argv[2] ?? 1);
$to   = (int) ($argv[3] ?? PHP_INT_MAX);

$source = file_get_contents($file);
$tokens = token_get_all($source);

$line = 1;
foreach ($tokens as $token) {
    $text = is_array($token) ? $token[1] : $token;
    $name = is_array($token) ? token_name($token[0]) : 'LITERAL';
    $short = str_replace(["\r", "\n", "\t"], ['\r', '\n', '\t'], $text);
    if (strlen($short) > 120) {
        $short = substr($short, 0, 120) . '…';
    }
    if ($line >= $from && $line <= $to) {
        echo "{$line}\t{$name}\t{$short}\n";
    }
    $line += substr_count($text, "\n");
}
