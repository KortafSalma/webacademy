<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 14 : Jointures : INNER JOIN, LEFT JOIN, RIGHT JOIN et FULL OUTER JOIN
 * Combiner des lignes de deux ou plusieurs tables en fonction de relations entre elles.
 */

return [
    'id'       => 'oracle-ch14',
    'title'    => 'Jointures : INNER JOIN, LEFT JOIN, RIGHT JOIN et FULL OUTER JOIN',
    'subtitle' => 'Combiner les tables',

    'objectives' => [
        'Utiliser INNER JOIN pour retourner les lignes correspondantes dans les deux tables.',
        'Utiliser LEFT JOIN pour retourner toutes les lignes de la table de gauche + correspondantes à droite.',
        'Utiliser RIGHT JOIN pour retourner toutes les lignes de la table de droite + correspondantes à gauche.',
        'Utiliser FULL OUTER JOIN pour retourner les lignes lorsqu\'il y a correspondance dans l\'une ou l\'autre table.',
        'Comprendre l\'importance des conditions d\'appariement (ON clause).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'inner-join',
            'title' => 'INNER JOIN : correspondance dans les deux tables',
            'icon'  => '↔',
            'blocks' => [

                make_definition_block(
                    'INNER JOIN',
                    '<p>L\'opérateur <strong>INNER JOIN</strong> retourne les lignes lorsqu\'il y a correspondance dans les deux tables impliquées. Les lignes sans correspondance sont exclues.</p>',
                    '<p><b>INNER JOIN</b> retourne lignes correspondance dans les deux tables. Lignes sans correspondance exclues.</p>'
                ),

                make_example_block(
                    'INNER JOIN entre clients et commandes',
                    '<pre><code>-- Récupérer les commandes avec les informations client\nSELECT c.nom, o.cmd_id, o.montant\nFROM clients c\nINNER JOIN commandes o ON c.id = o.client_id;</code></pre>',
                    '<pre>NOM      CMD_ID  MONTANT\n-------  ------  -------\nMohamed      1001    299.50\nFatima       1002    150.00</pre>',
                    'Affiche uniquement les commandes qui ont un client associé.'
                ),

                make_example_block(
                    'Tables des employés et des départements',
                    '<pre><code>-- Afficher les employés avec leur département\nSELECT e.emp_name, d.dep_name\nFROM employés e\nINNER JOIN départements d ON e.dep_id = d.dep_id;</code></pre>',
                    '<pre>EMP_NAME    DEP_NAME\n---------   -----------------\nMohamed         Informatique\nFatima          Marketing</pre>',
                    'Jointure entre employés et départements sur dep_id.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'left-join',
            'title' => 'LEFT JOIN : toutes les lignes de gauche',
            'icon'  => '↘',
            'blocks' => [

                make_definition_block(
                    'LEFT JOIN',
                    '<p>L\'opérateur <strong>LEFT JOIN (ou LEFT OUTER JOIN)</strong> retourne toutes les lignes de la table de gauche (première table), ainsi que les lignes correspondantes de la table de droite. Si aucune correspondance n\'existe, les colonnes de la table de droite contiennent NULL.</p>',
                    '<p><b>LEFT JOIN</b> retourne toutes lignes table gauche + correspondance table droite. Sans correspondance, colonnes droite = NULL.</p>'
                ),

                make_example_block(
                    'LEFT JOIN : clients et leurs commandes (même sans commande)',
                    '<pre><code>-- Afficher tous les clients avec leurs commandes (même ceux qui n\'ont pas encore commandé)\nSELECT c.nom, o.cmd_id, o.montant\nFROM clients c\nLEFT JOIN commandes o ON c.id = o.client_id;</code></pre>',
                    '<pre>NOM      CMD_ID  MONTANT\n-------  ------  -------\nMohamed      1001    299.50\nFatima               (null)  (null)\nOmar           1003    75.00</pre>',
                    'Fatima n\'a pas de commande, mais apparaît quand même avec des NULL.'
                ),

                make_tip_block(
                    'LEFT JOIN vs WHERE ancienne syntaxe',
                    '<p>La syntaxe ancienne avec des conditions dans la clause WHERE (<code>SELECT ... FROM table1, table2 WHERE condition</code>) est obsolète et produit le même résultat qu\'un INNER JOIN. Préférez toujours la syntaxe JOIN explicite.</p>',
                    '<p>Syntaxe ancienne avec condition WHERE obsolete produit même résultat INNER JOIN. Préférez toujours JOIN explicite.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'right-join',
            'title' => 'RIGHT JOIN : toutes les lignes de droite',
            'icon'  => '↖',
            'blocks' => [

                make_definition_block(
                    'RIGHT JOIN',
                    '<p>L\'opérateur <strong>RIGHT JOIN (ou RIGHT OUTER JOIN)</strong> retourne toutes les lignes de la table de droite (deuxième table), ainsi que les lignes correspondantes de la table de gauche. Si aucune correspondance n\'existe, les colonnes de la table de gauche contiennent NULL.</p>',
                    '<p><b>RIGHT JOIN</b> retourne toutes lignes table droite + correspondance table gauche. Sans correspondance, colonnes gauche = NULL.</p>'
                ),

                make_example_block(
                    'RIGHT JOIN : toutes les commandes avec infos client (même sans client)',
                    '<pre><code>-- Afficher toutes les commandes avec les infos client (même celles sans client valide)\nSELECT c.nom, o.cmd_id, o.montant\nFROM clients c\nRIGHT JOIN commandes o ON c.id = o.client_id;</code></pre>',
                    '<pre>NOM      CMD_ID  MONTANT\n-------  ------  -------\nMohamed      1001    299.50\n               1004    50.00  (commande sans client)</pre>',
                    'La commande 1004 n\'a pas de client associé, mais apparaît quand même.'
                ),

                make_example_block(
                    'Utilisation pratique du RIGHT JOIN',
                    '<pre><code>-- Inverser la jointure précédente : toutes les commandes\n-- (équivalent à ci-dessus mais lecture différente)\nSELECT c.nom, o.cmd_id\nFROM commandes o\nLEFT JOIN clients c ON c.id = o.client_id;</code></pre>',
                    '<pre>Même résultat que le RIGHT JOIN ci-dessus</pre>',
                    'Montre que LEFT JOIN sur la table commandes donne le même résultat que RIGHT JOIN.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'full-outer-join',
            'title' => 'FULL OUTER JOIN : les deux côtés complets',
            'icon'  => '↕',
            'blocks' => [

                make_definition_block(
                    'FULL OUTER JOIN',
                    '<p>L\'opérateur <strong>FULL OUTER JOIN</strong> retourne toutes les lignes lorsqu\'il y a correspondance dans l\'une ou l\'autre table. Il combine les résultats de LEFT JOIN et RIGHT JOIN. Les lignes sans correspondance d\'un côté affichent NULL de l\'autre côté.</p>',
                    '<p><b>FULL OUTER JOIN</b> retourne toutes lignes correspondance dans l\'une ou l\'autre table. Combine LEFT JOIN + RIGHT JOIN. Lignes sans correspondance affichent NULL.</p>'
                ),

                make_example_block(
                    'FULL OUTER JOIN : tous les clients et toutes les commandes',
                    '<pre><code>-- Afficher le tableau complet : tous les clients et toutes les commandes\nSELECT c.nom, o.cmd_id, o.montant\nFROM clients c\nFULL OUTER JOIN commandes o ON c.id = o.client_id;</code></pre>',
                    '<pre>NOM      CMD_ID  MONTANT\n-------  ------  -------\nMohamed      1001    299.50\nFatima               (null)  (null)\n               1004    50.00  (commande sans client)\nOmar           1003    75.00</pre>',
                    'Montre tous les clients (même sans commande) et toutes les commandes (même sans client).'
                ),

                make_tip_block(
                    'Simuler avec UNION ALL',
                    '<p>Si votre version d\'Oracle ne supporte pas FULL OUTER JOIN directement, vous pouvez simuler le résultat avec UNION ALL de LEFT JOIN et RIGHT JOIN en excluant les doublons.</p>',
                    '<p>Si version Oracle supporte pas FULL OUTER JOIN, simuler avec UNION ALL LEFT JOIN + RIGHT JOIN sans doublons.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier la clause ON dans les JOIN',
            'fix'    => 'Toujours spécifier la condition d\'appariement dans la clause ON des JOINs.',
            'fr'     => 'Sans clause ON, Oracle ne sait pas comment relier les tables et peut produire un produit cartésien (toutes les combinaisons possibles), ce qui entraîne des résultats massifs et erronés.',
            'darija' => 'Sans clause ON, Oracle sait pas comment relier tables w peut produire produit cartésien (toutes combinaisons) résultats massifs erronés.'
        ],
        [
            'wrong'  => 'Confondre l\'ordre des tables dans LEFT/RIGHT JOIN',
            'fix'    => 'La table de gauche est la première table listée, la table de droite est la deuxième. Inversez l\'ordre si vous voulez changer laquelle affiche toutes ses lignes.',
            'fr'     => 'Dans LEFT JOIN, c\'est la première table qui voit toutes ses lignes affichées. Dans RIGHT JOIN, c\'est la deuxième table. Inversez l\'ordre des tables si vous avez besoin de l\'un ou l\'autre comportement.',
            'darija' => 'LEFT JOIN: première table kaylik toutes lignes affichées. RIGHT JOIN: deuxième table kaylik. Inversez ordre tables si besoin comportement inverse.'
        ],
    ],

    'summary' => [
        'fr'     => 'INNER JOIN : correspondance des deux. LEFT JOIN : toutes gauche + correspondance droite (NULL si absent). RIGHT JOIN : tous droite + correspondance gauche (NULL si absent). FULL OUTER JOIN : les deux côtés complets, UNION de LEFT + RIGHT.',
        'darija' => 'INNER JOIN : correspondance des deux. LEFT JOIN : toutes gauche + correspondance droite (NULL si absent). RIGHT JOIN : tous droite + correspondance gauche (NULL si absent). FULL OUTER JOIN : les deux côtés complets, UNION de LEFT + RIGHT.'
    ],
];