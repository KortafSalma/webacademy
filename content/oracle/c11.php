<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 11 : Opérateurs de comparaison et logiques
 * Les opérateurs de comparaison (=, !=, >, <, LIKE, BETWEEN, IN) et les opérateurs logiques (AND, OR, NOT).
 */

return [
    'id'       => 'oracle-ch11',
    'title'    => 'Opérateurs de comparaison et logiques',
    'subtitle' => 'Combiner et affiner les conditions',

    'objectives' => [
        'Utiliser les opérateurs de comparaison : =, !=, >, <, >=, <=.',
        'Utiliser les opérateurs logiques : AND, OR, NOT.',
        'Employer les opérateurs spéciaux : BETWEEN, LIKE, IN.',
        'Comprendre la priorité des opérateurs (AND a preceder OR).',
        'Rédiger des conditions WHERE complexes.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'operators-comparison',
            'title' => 'Opérateurs de comparaison',
            'icon'  => '📊',
            'blocks' => [

                make_keywords_block([
                    ['kw' => '=', 'fr' => 'Égal à', 'darija' => 'Égal à'],
                    ['kw' => '!= ou <>', 'fr' => 'Différent de', 'darija' => 'Différent de'],
                    ['kw' => '>', 'fr' => 'Supérieur à', 'darija' => 'Supérieur à'],
                    ['kw' => '<', 'fr' => 'Inférieur à', 'darija' => 'Inférieur à'],
                    ['kw' => '>=', 'fr' => 'Supérieur ou égal à', 'darija' => 'Supérieur ou égal à'],
                    ['kw' => '<=', 'fr' => 'Inférieur ou égal à', 'darija' => 'Inférieur ou égal à'],
                ]),

                make_example_block(
                    'Comparaison simple',
                    '<pre><code>-- Produits dont le prix est supérieur à 50\nSELECT nom, prix\nFROM produits\nWHERE prix > 50;</code></pre>',
                    '<pre>NOM      PRIX\n-------  -------\nT-shirt      59.99\nPantalon     79.99</pre>',
                    'Affiche les produits dont le prix > 50.'
                ),

                make_example_block(
                    'Différent de',
                    '<pre><code>-- Clients qui ne sont pas de Casablanca\nSELECT id, nom, ville\nFROM clients\nWHERE ville != \'Casablanca\';</code></pre>',
                    '<pre>ID NOM VILLE\n-- ----------------- -----------\n 1  Mohamed CASABLANCA\n 2  Fatima  MARRAKECH\n 4  Omar    RABAT</pre>',
                    'Affiche tous les clients excepté ceux de Casablanca.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'logical-operators',
            'title' => 'Opérateurs logiques (AND, OR, NOT)',
            'icon'  => '🔀',
            'blocks' => [

                make_definition_block(
                    'AND',
                    '<p>L\'opérateur <strong>AND</strong> combine deux conditions. Les deux conditions doivent être VRAIES pour que le résultat soit VRAI.</p>',
                    '<p><b>AND</b> combine deux conditions. Les deux conditions doivent être VRAIES pour résultat VRAI.</p>'
                ),

                make_definition_block(
                    'OR',
                    '<p>L\'opérateur <strong>OR</strong> combine deux conditions. Au moins une des conditions doit être VRAIE pour que le résultat soit VRAI.</p>',
                    '<p><b>OR</strong> combine deux conditions. Au moins une condition doit être VRAIE pour résultat VRAI.</p>'
                ),

                make_definition_block(
                    'NOT',
                    '<p>L\'opérateur <strong>NOT</strong> inverse la valeur logique d\'une condition.</p>',
                    '<p><b>NOT</b> inverse la valeur logique condition.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'AND', 'fr' => 'ET', 'darija' => 'ET'],
                    ['kw' => 'OR', 'fr' => 'OU', 'darija' => 'OU'],
                    ['kw' => 'NOT', 'fr' => 'NON', 'darija' => 'NON'],
                ]),

                make_example_block(
                    'AND : plusieurs conditions',
                    '<pre><code>-- Produits dont le prix est supérieur à 50 ET de catégorie "Électronique"\nSELECT nom, prix, categorie\nFROM produits\nWHERE prix > 50 AND categorie = \'Électronique\';</code></pre>',
                    '<pre>NOM      PRIX CATÉGORIE\n-------  ------- -----------\nTéléphone    199.99 Électronique\nOrdinateur   899.99 Électronique</pre>',
                    'Affiche produits prix > 50 ET catégorie Électronique.'
                ),

                make_example_block(
                    'OR : l\'une ou l\'autre condition',
                    '<pre><code>-- Clients de Casablanca OU dont le nom commence par "O"\nSELECT id, nom, ville\nFROM clients\nWHERE ville = \'Casablanca\' OR nom LIKE \'O%\';</code></pre>',
                    '<pre>ID NOM VILLE\n-- ----------------- -----------\n 1  Mohamed CASABLANCA\n 3  Zakaria CASABLANCA\n 5  Omar    RABAT</pre>',
                    'Affiche clients de Casablanca OU nom commence par O.'
                ),

                make_example_block(
                    'NOT : inverser une condition',
                    '<pre><code>-- Produits qui ne sont PAS en rupture de stock\nSELECT nom, en_stock\nFROM produits\nWHERE NOT en_stock = \'OUI\';</code></pre>',
                    '<pre>NOM      EN_STOCK\n-------  ----------\nT-shirt      OUI\nPantalon     OUI</pre>',
                    'Affiche produits qui ne sont pas en rupture (en_stock ≠ OUI).'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'between-in-like',
            'title' => 'BETWEEN, IN et LIKE',
            'icon'  => '🎯',
            'blocks' => [

                make_definition_block(
                    'BETWEEN',
                    '<p>L\'opérateur <strong>BETWEEN</strong> permet de sélectionner des valeurs comprises entre une borne inférieure et une borne supérieure.</p>',
                    '<p><b>BETWEEN</b> sélectionne valeurs comprise entre borne inférieure et supérieure.</p>'
                ),

                make_definition_block(
                    'IN',
                    '<p>L\'opérateur <strong>IN</strong> permet de tester si une valeur appartient à une liste de valeurs connues. C\'est une alternative plus concise à plusieurs conditions OR.</p>',
                    '<p><b>IN</b> teste si valeur appartient à liste valeurs connues. Alternative concise à plusieurs OR.</p>'
                ),

                make_definition_block(
                    'LIKE',
                    '<p>L\'opérateur <strong>LIKE</strong> permet de comparer une valeur à des modèles (patterns) à l\'aide de caractères joker : % (multi-caractères) et _ (un seul caractère).</p>',
                    '<p><b>LIKE</b> compare valeur à modèles (patterns) avec caractères joker : % (multi) et _ (un seul).</p>'
                ),

                make_example_block(
                    'BETWEEN : prix compris entre 20 et 80',
                    '<pre><code>-- Produits dont le prix est compris entre 20 et 80\nSELECT nom, prix\nFROM produits\nWHERE prix BETWEEN 20 AND 80;</code></pre>',
                    '<pre>NOM      PRIX\n-------  -------\nT-shirt      59.99\nChaussures     75.50</pre>',
                    'Affiche produits prix entre 20 et 80 inclus.'
                ),

                make_example_block(
                    'IN : plusieurs valeurs possibles',
                    '<pre><code>-- Clients de Paris, Lyon ou Marseille\nSELECT id, nom, ville\nFROM clients\nWHERE ville IN (\'Paris\', \'Lyon\', \'Marseille\');</code></pre>',
                    '<pre>ID NOM VILLE\n-- ----------------- -----------\n 2  Fatima  LYON\n 4  Omar    RABAT\n 6  Ahmed   PARIS\n 7  Salma   MARSEILLE</pre>',
                    'Affiche clients de Paris, Lyon ou Marseille.'
                ),

                make_example_block(
                    'LIKE : recherche de modèles',
                    '<pre><code>-- Produits dont le nom commence par "Pro"\nSELECT nom\nFROM produits\nWHERE nom LIKE \'Pro%\';</code></pre>',
                    '<pre>NOM\n------\nProjecteur\nProjection\nPromo Special</pre>',
                    'Affiche produits dont le nom commence par "Pro".'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les guillemets autour des valeurs de texte dans WHERE',
            'fix'    => 'Entourez toujours les valeurs texte de guillemets simples (\') en Oracle.',
            'fr'     => 'En Oracle, les valeurs de texte doivent être entourées de guillemets simples : WHERE nom = \'Mohamed\'. Oublier les guillemets provoque une erreur de syntaxe.',
            'darija' => 'Valeurs texte toujouts guillemets simples (\'). Oublier kay erreur syntax.'
        ],
        [
            'wrong'  => 'Utiliser OR au lieu d\'IN pour une liste courte (lisibilité)',
            'fix'    => 'Utilisez IN pour une liste de valeurs plutôt que plusieurs conditions OR, c\'est plus lisible et plus performant.',
            'fr'     => 'Lorsqu\'on a plusieurs valeurs à tester sur la même colonne, préférez IN(val1, val2, ...) à plusieurs conditions OR. Cela rend la requête plus propre et parfois plus efficace.',
            'darija' => 'Plusieurs valeurs même colonne, préférez IN(val1, val2, ...) à plusieurs OR. Plus propre w parfois plus performant.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les opérateurs de base sont =, !=, >, <, >=, <=. Les logiques sont AND (tous les deux vrais), OR (au moins un vrai), NOT (inverse). Spéciaux : BETWEEN (borne1 AND borne2), IN (liste), LIKE (modèle avec % et _).',
        'darija' => 'Base =, !=, >, <, >=, <=. Logiques AND (les deux vrais), OR (au moins un vrai), NOT (inverse). Spéciaux : BETWEEN (borne1 AND borne2), IN (liste), LIKE (modèle % et _).'
    ],
];