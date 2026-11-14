<?php

declare(strict_types=1);

/**
 * Helpers partagés pour les chapitres Oracle SQL & PL/SQL.
 * Contient les blocs de définition, syntaxe, exemples et notes réutilisables
 * pour réduire la répétition dans cNN.php, exNN.php et qzNN.php.
 */

if (!function_exists('oracle_v2')) {
    function oracle_v2(string $value): string {
        return (string) $value;
    }
}

/**
 * Génère un bloc de définition avec titre, explication française et darija.
 */
function make_definition_block(string $title, string $fr, string $darija): array {
    return [
        'type' => 'definition',
        'title' => $title,
        'fr' => $fr,
        'darija' => $darija,
    ];
}

/**
 * Génère un bloc de syntaxe avec code Oracle.
 */
function make_syntax_block(string $lang, string $code, string $title): array {
    return [
        'type' => 'syntax',
        'lang' => $lang,
        'code' => $code,
        'title' => $title,
    ];
}

/**
 * Génère un bloc d\'exemple Oracle avec code, sortie attendue et explications.
 */
function make_example_block(string $title, string $code, string $output = '', string $explainFr = '', string $explainDarija = '', bool $preview = false): array {
    return [
        'type' => 'example',
        'title' => $title,
        'lang' => 'oracle',
        'code' => $code,
        'output' => $output,
        'explainFr' => $explainFr,
        'explainDarija' => $explainDarija,
        'preview' => $preview,
    ];
}

/**
 * Génère un bloc de note avec titre, explication française et darija.
 */
function make_note_block(string $title, string $fr, string $darija): array {
    return [
        'type' => 'note',
        'title' => $title,
        'fr' => $fr,
        'darija' => $darija,
    ];
}

/**
 * Génère un bloc de tip (astuce).
 */
function make_tip_block(string $title, string $fr, string $darija): array {
    return [
        'type' => 'tip',
        'title' => $title,
        'fr' => $fr,
        'darija' => $darija,
    ];
}

/**
 * Génère un bloc warning (attention).
 */
function make_warning_block(string $title, string $fr, string $darija): array {
    return [
        'type' => 'warning',
        'title' => $title,
        'fr' => $fr,
        'darija' => $darija,
    ];
}

/**
 * Génère un bloc de keywords (mots-clés).
 */
function make_keywords_block(array $items): array {
    return [
        'type' => 'keywords',
        'items' => $items,
    ];
}

/**
 * Génère un bloc table avec en-têtes et lignes.
 */
function make_table_block(array $headers, array $rows): array {
    return [
        'type' => 'table',
        'headers' => $headers,
        'rows' => $rows,
    ];
}

/**
 * Génère un bloc de erreurs fréquentes (mistakes).
 */
function make_mistakes_block(array $mistakes): array {
    return [
        'type' => 'mistakes',
        'items' => $mistakes,
    ];
}

/**
 * Génère un bloc summary (résumé).
 */
function make_summary_block(string $fr, string $darija): array {
    return [
        'type' => 'summary',
        'fr' => $fr,
        'darija' => $darija,
    ];
}
function make_text_block(string $fr, string $darija = ""): array {
    return ["type" => "text", "fr" => $fr, "darija" => $darija];
}
