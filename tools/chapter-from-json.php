<?php

declare(strict_types=1);

/**
 * Génère un fichier de chapitre PHP valide à partir d'un fichier JSON.
 *
 * Usage : php tools/chapter-from-json.php <source.json> <destination.php>
 *
 * Le JSON doit contenir exactement la structure attendue par l'application
 * (id, title, subtitle, objectives, lessons, mistakes, summary).
 */

$source = $argv[1] ?? '';
$destination = $argv[2] ?? '';

if ($source === '' || $destination === '') {
    fwrite(STDERR, "Usage: php tools/chapter-from-json.php <source.json> <destination.php>\n");
    exit(1);
}

if (!is_file($source)) {
    fwrite(STDERR, "Fichier source introuvable : {$source}\n");
    exit(1);
}

$json = file_get_contents($source);
$data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

if (!is_array($data)) {
    fwrite(STDERR, "Le JSON doit décrire un objet.\n");
    exit(1);
}

foreach (['id', 'title', 'subtitle', 'objectives', 'lessons', 'mistakes', 'summary'] as $key) {
    if (!array_key_exists($key, $data)) {
        fwrite(STDERR, "Clé manquante dans le JSON : {$key}\n");
        exit(1);
    }
}

if (!is_array($data['lessons']) || count($data['lessons']) < 1) {
    fwrite(STDERR, "Le chapitre doit contenir au moins une leçon.\n");
    exit(1);
}

if (count($data['mistakes']) < 2) {
    fwrite(STDERR, "Le chapitre doit contenir au moins 2 erreurs fréquentes.\n");
    exit(1);
}

$export = var_export($data, true);

$php = "<?php\n\ndeclare(strict_types=1);\n\n/**\n * Contenu généré depuis " . basename($source) . "\n */\n\nreturn " . $export . ";\n";

$directory = dirname($destination);
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

file_put_contents($destination, $php);

echo "Fichier généré : {$destination}\n";
