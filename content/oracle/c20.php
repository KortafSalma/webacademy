<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 20 : SELECT INTO et %TYPE / %ROWTYPE
 * Récupérer des valeurs de base de données dans des variables PL/SQL.
 */

return [
    'id'       => 'oracle-ch20',
    'title'    => 'SELECT INTO et %TYPE / %ROWTYPE',
    'subtitle' => 'Récupérer des données dans des variables',

    'objectives' => [
        'Utiliser la commande SELECT INTO pour stocker une valeur de table dans une variable.',
        'Gérer le cas où la requête RETURNne plusieurs lignes (erreur à traiter).',
        'Combiner SELECT INTO avec %TYPE et %ROWTYPE pour un typage sûr.',
        'Utiliser des fonctions d\'agrégat avec SELECT INTO (COUNT, SUM, etc.).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'select-into',
            'title' => 'SELECT INTO : stocker une valeur',
            'icon'  => '↓',
            'blocks' => [

                make_definition_block(
                    'SELECT INTO',
                    '<p>La commande <strong>SELECT INTO</strong> permet de récupérer une valeur (ou plusieurs valeurs) depuis une table et de la stocker dans une ou plusieurs variables PL/SQL.</p>',
                    '<p><b>SELECT INTO</b> récupère valeur depuis table stocke variable PL/SQL.</p>'
                ),

                make_example_block(
                    'SELECT INTO simple',
                    '<pre><code>\nDECLARE\n  v_nom clients.nom%TYPE;\nBEGIN\n  -- Récupérer le nom du client ID = 1\n  SELECT nom\n  INTO v_nom\n  FROM clients\n  WHERE id = 1;\n  \n  -- Afficher la variable\n  DBMS_OUTPUT.PUT_LINE(\\'Client sélectionné :\' || v_nom);\nEND;</code></pre>',
                    '<pre>Client sélectionné : Mohamed</pre>',
                    'La valeur de la colonne nom est stockée dans la variable v_nom et affichée.'
                ),

                make_example_block(
                    'SELECT INTO avec plusieurs variables',
                    '<pre><code>\nDECLARE\n  v_nom   clients.nom%TYPE;\n  v_email clients.email%TYPE;\nBEGIN\n  SELECT nom, email\n  INTO v_nom, v_email\n  FROM clients\n  WHERE id = 2;\n  \n  DBMS_OUTPUT.PUT_LINE(\\'Nom :\' || v_nom || \\'\\\\nEmail :\' || v_email);\nEND;</code></pre>',
                    '<pre>Nom : Fatima\nEmail : fat@exemple.com</pre>',
                    'Deux valeurs sont récupérées simultanément dans deux variables distinctes.'
                ),

                make_tip_block(
                    'SELECT INTO vs SELECT ... INTO vs cursor',
                    '<p>SELECT INTO ne doit être utilisé que lorsque la requête ne retourne qu\'une seule ligne. Si la requête peut retourner plusieurs lignes, une erreur ORA-01422 (too many rows) est levée. Dans ce cas, utilisez un curseur ou une boucle.</p>',
                    '<p>SELECT INTO uniquement une ligne. Si plusieurs lignes, erreur ORA-01422. Utilisez curseur ou boucle cas multiple lignes.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'select-into-aggregate',
            'title' => 'SELECT INTO avec agrégats',
            'icon'  => '📊',
            'blocks' => [

                make_definition_block(
                    'COUNT, SUM, AVG dans SELECT INTO',
                    '<p>Les fonctions d\'agrégat peuvent être utilisées dans une requête SELECT INTO pour stocker le résultat dans une variable.</p>',
                    '<p>Fonctions agrégat COUNT SUM AVG peuvent être utilisées SELECT INTO stocker résultat variable.</p>'
                ),

                make_example_block(
                    'SELECT INTO avec COUNT',
                    '<pre><code>\nDECLARE\n  v_total_clients NUMBER;\nBEGIN\n  SELECT COUNT(*)\n  INTO v_total_clients\n  FROM clients;\n  \n  DBMS_OUTPUT.PUT_LINE(\\'Total clients :\' || v_total_clients);\nEND;</code></pre>',
                    '<pre>Total clients : 25</pre>',
                    'Le nombre total de clients est stocké dans v_total_clients.'
                ),

                make_example_block(
                    'SELECT INTO avec AVG',
                    '<pre><code>\nDECLARE\n  v_moyen_prix NUMBER;\nBEGIN\n  SELECT AVG(prix)\n  INTO v_moyen_prix\n  FROM produits;\n  \n  DBMS_OUTPUT.PUT_LINE(\\'Moyen prix :\' || v_moyen_prix);\nEND;</code></pre>',
                    '<pre>Moyen prix : 51.958</pre>',
                    'La moyenne des prix est stockée dans v_moyen_prix.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le INTO après SELECT',
            'fix'    => 'Toujours ajouter le mot-clé INTO suivi des variables destinataires après la clause SELECT.',
            'fr'     => 'Sans INTO, la requête SELECT fonctionne comme une requête classique (affichage dans SQL*Plus ou outil graphique) mais ne stocke pas la valeur dans une variable. L'oubli du INTO est l\'erreur la plus courante avec SELECT INTO.',
            'darija' => 'Sans INTO, requête SELECT fonctionne classique stockage pas variable. Oubli INTO erreur la plus courante SELECT INTO.'
        ],
        [
            'wrong'  => 'SELECT INTO sans garantie de ligne unique',
            'fix'    => 'Vérifiez toujours que la requête ne peut retourner qu\'une seule ligne, ou gérez l\'exception Too Many Rows.',
            'fr'     => 'Si la requête retourne zéro ligne, Oracle lance une exception NO_DATA_FOUND. Si elle en retourne plusieurs, elle lance Too Many Rows. Prévoyez toujours des blocs BEGIN...EXCEPTION...END pour gérer ces cas.',
            'darija' => 'Zéro ligne erreur NO_DATA_FOUND. Plusieurs lignes erreur Too Many Rows. Prévoyez blocs BEGIN...EXCEPTION...END gestion ces cas.'
        ],
    ],

    'summary' => [
        'fr'     => 'SELECT INTO stocke une valeur de table dans une variable. Attention : la requête doit retourner exactement une ligne (sinon exception). Utilisez %TYPE/%ROWTYPE pour un typage sûr. Les agrégats (COUNT, SUM, AVG) peuvent être utilisés dans SELECT INTO.',
        'darija' => 'SELECT INTO stocke valeur table variable. Attention requête doit retourner exactement une ligne (sinon exception). Utilisez %TYPE/%ROWTYPE typage sûr. Agrégats COUNT SUM AVG peuvent être utilisés SELECT INTO.'
    ],
];