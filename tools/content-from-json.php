<?php

declare(strict_types=1);

/**
 * Génère un fichier PHP de contenu (chapitre, exercice ou quiz) depuis un JSON.
 *
 * Usage : php tools/content-from-json.php <source.json> <destination.php>
 */

$source = $argv[1] ?? '';
$destination = $argv[2] ?? '';

if ($source === '' || $destination === '') {
    fwrite(STDERR, "Usage: php tools/content-from-json.php <source.json> <destination.php>\n");
    exit(1);
}

if (!is_file($source)) {
    fwrite(STDERR, "Fichier source introuvable : {$source}\n");
    exit(1);
}

$data = json_decode(file_get_contents($source), true, 512, JSON_THROW_ON_ERROR);

if (!is_array($data)) {
    fwrite(STDERR, "Le JSON doit décrire un objet.\n");
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
