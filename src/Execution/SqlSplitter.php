<?php

declare(strict_types=1);

namespace App\Execution;

/**
 * Découpe un script SQL en requêtes individuelles,
 * en respectant les chaînes '...', "..." et les commentaires.
 */
final class SqlSplitter
{
    /** @return string[] */
    public static function split(string $sql): array
    {
        $out = [];
        $current = '';
        $len = strlen($sql);
        $i = 0;
        $quote = null;

        while ($i < $len) {
            $char = $sql[$i];

            // Commentaires de ligne : -- ... \n   ou   # ... \n
            if ($quote === null && (($char === '-' && ($sql[$i + 1] ?? '') === '-') || $char === '#')) {
                while ($i < $len && $sql[$i] !== "\n") {
                    $i++;
                }
                continue;
            }

            // Commentaires de bloc : /* ... */
            if ($quote === null && $char === '/' && ($sql[$i + 1] ?? '') === '*') {
                $end = strpos($sql, '*/', $i + 2);
                $i = ($end === false) ? $len : $end + 2;
                continue;
            }

            // Chaînes
            if ($quote === null && ($char === "'" || $char === '"' || $char === '`')) {
                $quote = $char;
                $current .= $char;
                $i++;
                continue;
            }

            if ($quote !== null) {
                // Échappement MySQL : \' \" \\ ...
                if ($char === '\\' && $quote !== '`' && $i + 1 < $len) {
                    $current .= $char . $sql[$i + 1];
                    $i += 2;
                    continue;
                }
                $current .= $char;
                if ($char === $quote) {
                    // '' ou "" = guillemet échappé
                    if (($sql[$i + 1] ?? '') === $quote) {
                        $current .= $quote;
                        $i++;
                    } else {
                        $quote = null;
                    }
                }
                $i++;
                continue;
            }

            // Séparateur
            if ($char === ';') {
                $trimmed = trim($current);
                if ($trimmed !== '') {
                    $out[] = $trimmed;
                }
                $current = '';
                $i++;
                continue;
            }

            $current .= $char;
            $i++;
        }

        $trimmed = trim($current);
        if ($trimmed !== '') {
            $out[] = $trimmed;
        }
        return $out;
    }
}
