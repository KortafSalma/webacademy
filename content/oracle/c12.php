<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 12 : Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX
 * Calculer des statistiques sur des jeux de données : compter, additionner, moyennes, extremums.
 */

return [
    'id'       => 'oracle-ch12',
    'title'    => 'Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX',
    'subtitle' => 'Statistiques sur des jeux de données',

    'objectives' => [
        'Utiliser COUNT pour compter les lignes ou les valeurs non NULL.',
        'Utiliser SUM pour additionner une colonne numérique.',
        'Utiliser AVG pour calculer la moyenne arithmétique.',
        'Utiliser MIN et MAX pour trouver les valeurs extrêmes.',
        'Combiner agrégation avec DISTINCT et WHERE.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'count',
            'title' => 'COUNT : compter les lignes',
            'icon'  => '🔢',
            'blocks' => [

                make_definition_block(
                    'COUNT(*)',
                    '<p>La fonction <strong>COUNT(*)</strong> retourne le nombre total de lignes d\'une table, y compris les lignes contenant des valeurs NULL.</p>',
                    '<p><b>COUNT(*)</b> retourne nombre total lignes table, y compris lignes avec NULL.</p>'
                ),

                make_definition_block(
                    'COUNT(colonne)',
                    '<p>La fonction <strong>COUNT(colonne)</strong> retourne le nombre de lignes où la colonne spécifiée n\'est pas NULL.</p>',
                    '<p><b>COUNT(colonne)</b> retourne nombre lignes où colonne n\'est pas NULL.</p>'
                ),

                make_example_block(
                    'COUNT(*) sur toute la table',
                    '<pre><code>-- Combien y a-t-il de clients dans la table ?\nSELECT COUNT(*) AS total_clients\nFROM clients;</code></pre>',
                    '<pre>TOTAL_CLIENTS\n-------------\n        25</pre>',
                    'Compte toutes les lignes de la table clients (25 clients).'
                ),

                make_example_block(
                    'COUNT(colonne non NULL)',
                    '<pre><code>-- Combien de clients ont fourni leur email ?\nSELECT COUNT(email) AS clients_avec_email\nFROM clients;</code></pre>',
                    '<pre>CLIENTS_AVEC_EMAIL\n--------------------\n         20</pre>',
                    'Compte les lignes où email n\'est pas NULL (20 sur 25).'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'sum-and-avg',
            'title' => 'SUM et AVG : addition et moyenne',
            'icon'  => '➕➗',
            'blocks' => [

                make_definition_block(
                    'SUM',
                    '<p>La fonction <strong>SUM</strong> additionne toutes les valeurs d\'une colonne numérique.</p>',
                    '<p><b>SUM</b> additionne toutes valeurs colonne numérique.</p>'
                ),

                make_definition_block(
                    'AVG',
                    '<p>La fonction <strong>AVG</strong> calcule la moyenne arithmétique des valeurs d\'une colonne numérique.</p>',
                    '<p><b>AVG</b> calcule moyenne arithmétique valeurs colonne numérique.</p>'
                ),

                make_example_block(
                    'SUM et AVG sur les prix',
                    '<pre><code>-- Statistiques des prix des produits\nSELECT SUM(prix) AS total_prix,\n       AVG(prix) AS moyenne_prix,\n       COUNT(*) AS nombre_produits\nFROM produits;</code></pre>',
                    '<pre>TOTAL_PRIX  MOYENNE_PRIX  NOMBRE_PRODUITS\n------------  -------------  -----------------\n     1298.97         51.958          25</pre>',
                    'Somme, moyenne et compte de tous les produits.'
                ),

                make_tip_block(
                    'NULL et SUM/AVG',
                    '<p>SUM ignore les valeurs NULL (ne les compte pas dans l\'addition). AVG ignore également les NULL dans le calcul de la moyenne.</p>',
                    '<p>SUM ignore NULL (ne compte pas addition). AVG ignore NULL dans moyenne.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'min-and-max',
            'title' => 'MIN et MAX : valeurs extrêmes',
            'icon'  => '⬆️⬇️',
            'blocks' => [

                make_definition_block(
                    'MIN',
                    '<p>La fonction <strong>MIN</strong> retourne la valeur minimale d\'une colonne (pour les types de données caractères, c\'est l\'ordre alphabétique ; pour les nombres, la plus petite valeur).</p>',
                    '<p><b>MIN</b> retourne valeur minimale colonne.</p>'
                ),

                make_definition_block(
                    'MAX',
                    '<p>La fonction <strong>MAX</strong> retourne la valeur maximale d\'une colonne.</p>',
                    '<p><b>MAX</b> retourne valeur maximale colonne.</p>'
                ),

                make_example_block(
                    'MIN et MAX sur les dates',
                    '<pre><code>-- Date de première et dernière commande\nSELECT MIN(date_cmd) AS premieres_cmd,\n       MAX(date_cmd) AS dernieres_cmd\nFROM commandes;</code></pre>',
                    '<pre>PREMIERES_CMD   DERNIERES_CMD\n----------------- -----------------\n 01-MAY-2024     30-JUN-2025</pre>',
                    'Première et dernière date de commande.'
                ),

                make_example_block(
                    'MIN et MAX sur les caractères',
                    '<pre><code>-- Produit dont le nom commence par la lettre "D" (tri alphabétique)\nSELECT MIN(nom) AS nom_min, MAX(nom) AS nom_max\nFROM produits\nWHERE nom LIKE \'D%\';</code></pre>',
                    '<pre>NOM_MIN  NOM_MAX\n-------  -------\nCasque       Souris</pre>',
                    'MIN et MAX sur noms commençant par D.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier que SUM et AVG ignorent les NULL',
            'fix'    => 'Rappelez que NULL n\'est pas compté dans les calculs d\'agrégation. Si vous voulez inclure les NULL, utilisez COUNT(*) qui compte toutes les lignes.',
            'fr'     => 'Les fonctions d\'agrégation SUM et AVGignorent les valeurs NULL par défaut. Si vous devez compter les lignes avec NULL, utilisez COUNT(*) au lieu de COUNT(colonne).',
            'darija' => 'SUM et AVG ignorent NULL par défaut. Si compter lignes avec NULL, utilisez COUNT(*) au lieu COUNT(colonne).'
        ],
        [
            'wrong'  => 'Appliquer SUM/AVG sur des colonnes de type VARCHAR2',
            'fix'    => 'Utilisez SUM et AVG uniquement sur des colonnes NUMERICALES (NUMBER). Pour les textes, utilisez MIN/MAX ou des fonctions de chaîne.',
            'fr'     => 'Les fonctions SUM et AVG ne s\'appliquent qu\'aux colonnes de type NUMBER. Sur du VARCHAR2, elles provoqueront une erreur ORA-01722: invalid number. Utilisez MIN/MAX ou des fonctions de chaîne pour les textes.',
            'darija' => 'SUM et AVG s\'appliquent uniquement NUMBER. Sur VARCHAR2, erreur ORA-01722. Utilisez MIN/MAX ou fonctions chaîne pour textes.'
        ],
    ],

    'summary' => [
        'fr'     => 'COUNT(*) compte toutes les lignes, COUNT(colonne) compte les non-NULL. SUM additionne les valeurs numériques, AVG calcule la moyenne. MIN et MAX trouvent les valeurs extrêmes (dates ou caractères). Attention : NULL est ignoré par SUM/AVG.',
        'darija' => 'COUNT(*) compte toutes lignes, COUNT(colonne) compte non-NULL. SUM additionne valeurs numériques, AVG calcule moyenne. MIN et MAX trouvent valeurs extrêmes (dates ou caractères). Attention : NULL ignoré par SUM/AVG.'
    ],
];