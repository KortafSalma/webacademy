<?php
declare(strict_types=1);

/**
 * Glossaire FR + Darija des termes du cours.
 */

return [
    'terms' => [
        ['term' => 'Balise (tag)', 'module' => 'html',
         'fr' => 'Élément HTML', 'darija' => 'Balise HTML', 'exemple' => '<p>Salam</p>', 'lang' => 'html'],
        ['term' => 'Clé primaire', 'module' => 'sql',
         'fr' => 'Colonne unique', 'darija' => 'Clé primaire', 'exemple' => 'id INT PRIMARY KEY', 'lang' => 'sql'],
        ['term' => 'VARCHAR2', 'module' => 'oracle',
         'fr' => 'Chaîne longueur variable', 'darija' => 'VARCHAR2 Oracle', 'exemple' => 'VARCHAR2(50)', 'lang' => 'oracle'],
        ['term' => 'NUMBER', 'module' => 'oracle',
         'fr' => 'Nombre entiers/décimaux', 'darija' => 'NUMBER Oracle', 'exemple' => 'NUMBER(10,2)', 'lang' => 'oracle'],
        ['term' => 'COMMIT', 'module' => 'oracle',
         'fr' => 'Valide la transaction', 'darija' => 'COMMIT', 'exemple' => 'COMMIT', 'lang' => 'oracle'],
        ['term' => 'ROLLBACK', 'module' => 'oracle',
         'fr' => 'Annule la transaction', 'darija' => 'ROLLBACK', 'exemple' => 'ROLLBACK', 'lang' => 'oracle'],
    ],
];