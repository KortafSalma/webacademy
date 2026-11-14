<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 9 : SELECT, WHERE, ORDER BY et DISTINCT
 * Le langage de base pour interroger des données : requêtes SELECT avec filtrage, tri et désignation.
 */

return [
    'id'       => 'oracle-ch9',
    'title'    => 'SELECT, WHERE, ORDER BY et DISTINCT',
    'subtitle' => 'Interroger des données avec SELECT',

    'objectives' => [
        'Rédiger une requête SELECT basique.',
        'Filtrer les lignes avec la clause WHERE et les opérateurs de comparaison.',
        'Utiliser DISTINCT pour éliminer les doublons.',
        'Trier les résultats avec ORDER BY.',
        'Utiliser les opérateurs de comparaison ET, OU, NON.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'select-basique',
            'title' => 'SELECT basique',
            'icon'  => '✅',
            'blocks' => [

                make_definition_block(
                    'SELECT',
                    '<p>La commande <strong>SELECT</strong> est la commande la plus utilisée en SQL. Elle permet de récupérer des données depuis une ou plusieurs tables.</p>',
                    '<p><b>SELECT</b> kay récupérer données depuis une ou plusieurs tables.</p>'
                ),

                make_example_block(
                    'SELECT colonnes spécifiques',
                    '<pre><code>-- Récupérer l\'id, le nom et le email des clients\nSELECT id, nom, email\nFROM clients;</code></pre>',
                    '<pre>ID NOM               EMAIL\n-- ----------------- -----------\n 1  Mohamed         moh@exemple.com\n 2  Fatima          fat@exemple.com</pre>',
                    'Les colonnes spécifiées sont affichées sous forme de tableau résultat.'
                ),

                make_example_block(
                    'SELECT * (toutes colonnes)',
                    '<pre><code>-- Récupérer toutes les colonnes de la table clients\nSELECT *\nFROM clients;</code></pre>',
                    '<pre>ID NOM EMAIL DATE_NAISSANCE\n-- ----------------- ----------- -----------\n 1  Mohamed         moh@exemple.com  1990-05-15</pre>',
                    'L\'astérisque * récupère toutes les colonnes disponibles.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'where',
            'title' => 'WHERE : filtrage des lignes',
            'icon'  => '🔍',
            'blocks' => [

                make_definition_block(
                    'WHERE',
                    '<p>La clause <strong>WHERE</strong> filtre les lignes renvoyées par une requête SELECT. Seules les lignes qui satisfont la condition sont incluses dans le résultat.</p>',
                    '<p>Clause <b>WHERE</b> filtre lignes renvoyées SELECT. Uniquement lignes satisfont condition incluses résultat.</p>'
                ),

                make_keywords_block([
                    ['kw' => '=', 'fr' => 'Égal à', 'darija' => 'Égal à'],
                    ['kw' => '<>', 'fr' => 'Différent de', 'darija' => 'Différent de'],
                    ['kw' => '>', 'fr' => 'Supérieur à', 'darija' => 'Supérieur à'],
                    ['kw' => '<', 'fr' => 'Inférieur à', 'darija' => 'Inférieur à'],
                ]),

                make_example_block(
                    'WHERE avec comparaison numérique',
                    '<pre><code>-- Clients dont l\'ID est supérieur à 5\nSELECT id, nom\nFROM clients\nWHERE id > 5;</code></pre>',
                    '<pre>ID NOM\n-- -----------------\n 6  Ahmed           ahmed@exemple.com\n 7  Salma           salma@exemple.com</pre>',
                    'Seules les lignes où id > 5 sont affichées.'
                ),

                make_example_block(
                    'WHERE avec texte (comme)',
                    '<pre><code>-- Clients dont le nom commence par "M"\nSELECT id, nom\nFROM clients\nWHERE nom LIKE \'M%\';</code></pre>',
                    '<pre>ID NOM\n-- -----------------\n 1  Mohamed         moh@exemple.com</pre>',
                    'LIKE \'M%\' cherche les noms commençant par M.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'distinct-orderby',
            'title' => 'DISTINCT et ORDER BY',
            'icon'  => '🔀',
            'blocks' => [

                make_definition_block(
                    'DISTINCT',
                    '<p>Le mot-clé <strong>DISTINCT</strong> eliminates les doublons dans le résultat. Il s\'applique à la liste des colonnes sélectionnées.</p>',
                    '<p><b>DISTINCT</b> eliminate doublons résultat. S\'applique à liste colonnes sélectionnées.</p>'
                ),

                make_definition_block(
                    'ORDER BY',
                    '<p>La clause <strong>ORDER BY</strong> trie le résultat final selon une ou plusieurs colonnes. Par défaut, le tri est croissant (ASC). On peut utiliser DESC pour un tri décroissant.</p>',
                    '<p>Clause <b>ORDER BY</b> trie résultat final selon une ou plusieurs colonnes. Par défaut tri croissant (ASC). DESC pour décroissant.</p>'
                ),

                make_example_block(
                    'SELECT DISTINCT',
                    '<pre><code>-- Récupérer les villes uniques où ont lieu des commandes\nSELECT DISTINCT ville\nFROM commandes;</code></pre>',
                    '<pre>VILLE\n------\nCasablanca\nRabat\nMarrakech\nFès</pre>',
                    'Affichage des villes uniques (pas de doublon).'
                ),

                make_example_block(
                    'ORDER BY croissant/décroissant',
                    '<pre><code>-- Trier les clients par nom décroissant\nSELECT id, nom\nFROM clients\nORDER BY nom DESC;</code></pre>',
                    '<pre>ID NOM\n-- -----------------\n 3  Zakaria         zak@exemple.com\n 2  Fatima          fat@exemple.com\n 1  Mohamed         moh@exemple.com</pre>',
                    'Les clients sont triés par nom de Z à A.'
                ),

                make_example_block(
                    'SELECT DISTINCT + ORDER BY',
                    '<pre><code>-- Villes uniques triées par ordre alphabétique\nSELECT DISTINCT ville\nFROM commandes\nORDER BY ville ASC;</code></pre>',
                    '<pre>VILLE\n------\nCasablanca\nFès\nMarrakech\nRabat</pre>',
                    'Villes uniques triées par ordre alphabétique croissant.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier DISTINCT quand on veut des lignes uniques',
            'fix'    => 'Utilisez DISTINCT pour éviter les doublons dans les colonnes de résultat.',
            'fr'     => 'Sans DISTINCT, une même valeur peut apparaître plusieurs fois dans le résultat si la requête rejoint plusieurs tables ou contient des doublons.',
            'darija' => 'Sans DISTINCT, valeur mknkourtila plusieurs fois résultat b requête joint tables w doublons.'
        ],
        [
            'wrong'  => 'Oubli ORDER BY ASC/DESC',
            'fix'    => 'Précisez toujours l\'ordre de tri ou utilisez par défaut croissant.',
            'fr'     => 'ORDER BY sans précision utilise le tri croissant par défaut. Pour un tri décroissant, ajoutez explicitement DESC.',
            'darija' => 'ORDER BY sans précision utilise tri croissant par défaut. Pour décroissant, ajoutez DESC explicite.'
        ],
    ],

    'summary' => [
        'fr'     => 'SELECT récupère des données, WHERE filtre les lignes, DISTINCT élimine les doublons, ORDER BY trie le résultat. Les opérateurs de comparaison (=, <>, >, <, LIKE) permettent des conditions variées.',
        'darija' => 'SELECT kay récupérer données, WHERE filtre lignes, DISTINCT eliminate doublons, ORDER BY trie résultat. Opérateurs comparaison (=, <>, >, <, LIKE) conditions variées.'
    ],
];