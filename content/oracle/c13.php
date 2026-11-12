<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 13 : GROUP BY et HAVING
 * Regrouper des lignes par valeurs communes et filtrer les groupes.
 */

return [
    'id'       => 'oracle-ch13',
    'title'    => 'GROUP BY et HAVING',
    'subtitle' => 'Regrouper et filtrer les résultats',

    'objectives' => [
        'Utiliser GROUP BY pour regrouper des lignes par valeurs communes.',
        'Appliquer des agrégats (COUNT, SUM, AVG) au sein de groupes.',
        'Filtrer les groupes avec HAVING (contrairement à WHERE qui filtre les lignes avant le groupement).',
        'Utiliser des alias de colonne dans HAVING.',
        'Comprendre l\'ordre d\'exécution : WHERE → GROUP BY → HAVING → SELECT.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'group-by',
            'title' => 'GROUP BY : regrouper des lignes',
            'icon'  => '👥',
            'blocks' => [

                make_definition_block(
                    'GROUP BY',
                    '<p>La clause <strong>GROUP BY</strong> regroupe les lignes d\'une table qui possèdent les mêmes valeurs dans des colonnes spécifiées. Elle est presque toujours utilisée avec des fonctions d\'agrégat (COUNT, SUM, AVG, MIN, MAX).</p>',
                    '<p><b>GROUP BY</b> regroupent lignes table ayant mêmes valeurs colonnes. Souvent avec fonctions agrégat.</p>'
                ),

                make_example_block(
                    'GROUP BY simple : compter les clients par ville',
                    '<pre><code>-- Compter le nombre de clients par ville\nSELECT ville, COUNT(*) AS nb_clients\nFROM clients\nGROUP BY ville\nORDER BY nb_clients DESC;</code></pre>',
                    '<pre>VILLE           NB_CLIENTS\n-------  ----------\nCasablanca           10\nRabat                8\nMarrakech          5\nFès                4</pre>',
                    'Regroupe clients par ville et compte chaque groupe.'
                ),

                make_example_block(
                    'GROUP BY avec plusieurs colonnes',
                    '<pre><code>-- Compter le nombre de commandes par client et par statut\nSELECT client_id, statut, COUNT(*) AS nb_cmds\nFROM commandes\nGROUP BY client_id, statut\nORDER BY client_id, nb_cmds;</code></pre>',
                    '<pre>CLIENT_ID  STATUT   NB_CMDS\n---------  --------  -------\n        5  EN_ATTENTE      3\n        5  EXPEDIÉ         7\n        8  EN_ATTENTE      2</pre>',
                    'Regroupe par client_id et statut, compte chaque combinaison.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'having',
            'title' => 'HAVING : filtrer les groupes',
            'icon'  => '🧹',
            'blocks' => [

                make_definition_block(
                    'HAVING',
                    '<p>La clause <strong>HAVING</strong> filtre les groupes créés par GROUP BY. Elle s\'applique aux fonctions d\'agrégat, contrairement à WHERE qui filtre les lignes individuelles avant le groupement.</p>',
                    '<p><b>HAVING</b> filtre groupes créé GROUP BY. S\'applique aux fonctions agrégat, contrairement WHERE qui filtre lignes avant groupement.</p>'
                ),

                make_example_block(
                    'HAVING vs WHERE : clients avec plus de 3 commandes',
                    '<pre><code>-- Méthode incorrecte (WHERE ne peut pas filtrer après GROUP BY)\nSELECT client_id, COUNT(*) AS nb_cmds\nFROM commandes\nWHERE COUNT(*) > 3   -- ERREUR: COUNT n\'existe pas encore au niveau WHERE\nGROUP BY client_id;\n\n-- Méthode correcte : utiliser HAVING\nSELECT client_id, COUNT(*) AS nb_cmds\nFROM commandes\nGROUP BY client_id\nHAVING COUNT(*) > 3;</code></pre>',
                    '<pre>CLIENT_ID  NB_CMDS\n---------  -------\n        5          10\n        8          5</pre>',
                    'HAVING filtre les groupes ayant plus de 3 commandes.'
                ),

                make_example_block(
                    'HAVING avec condition sur une agrégat',
                    '<pre><code>-- Produits dont le prix moyen est supérieur à 50\nSELECT categorie, AVG(prix) AS prix_moyen\nFROM produits\nGROUP BY categorie\nHAVING AVG(prix) > 50;</code></pre>',
                    '<pre>CATÉGORIE  PRIX_MOYEN\n------------  ----------\nÉlectronique     120.50\nHigh-Tech        89.99</pre>',
                    'Affiche catégories dont le prix moyen > 50.'
                ),

                make_tip_block(
                    'L\'ordre d\'exécution',
                    '<p>Rappelez-vous l\'ordre logique d\'exécution d\'une requête SELECT :\n1. FROM / JOINs (déterminer les tables)\n2. WHERE (filtrer les lignes)\n3. GROUP BY (regrouper les lignes)\n4. HAVING (filtrer les groupes)\n5. SELECT (choisir les colonnes)\n6. ORDER BY (tri final)</p>',
                    '<p>Rappel ordre exécution : FROM/JOINs → WHERE → GROUP BY → HAVING → SELECT → ORDER BY</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser WHERE au lieu de HAVING pour filtrer des groupes',
            'fix'    => 'Utilisez WHERE pour filtrer les lignes individuelles, et HAVING pour filtrer les groupes après GROUP BY.',
            'fr'     => 'L\'erreur classique consiste à écrire WHERE COUNT(*) > 5 après un GROUP BY. Cela provoque une erreur car les alias d\'agrégat n\'existent pas encore au niveau WHERE. Utilisez HAVING à la place.',
            'darija' => 'Erreur classique WHERE COUNT(*) > 5 après GROUP BY. Erreur car alias agrégat n\'existe pas niveau WHERE. Utilisez HAVING à la place.'
        ],
        [
            'wrong'  => 'Oublier GROUP BY lorsqu\'on utilise des agrégats avec des colonnes non agrégées',
            'fix'    => 'Toujours ajouter GROUP BY lors d\'utilisation de fonctions d\'agrégat avec des colonnes non incluses dans les agrégats.',
            'fr'     => 'Si vous sélectionnez une colonne non agrégée (ex: client_id) avec une fonction d\'agrégat (ex: COUNT(*)), vous devez impérativement ajouter GROUP BY client_id, autrement Oracle provoquera une erreur.',
            'darija' => 'Toujours ajouter GROUP BY l\'utilisation fonctions agrégat avec colonnes non incluses.'
        ],
    ],

    'summary' => [
        'fr'     => 'GROUP BY regroupe les lignes ayant les mêmes valeurs en colonnes spécifiées. HAVING filtre les groupes (après GROUP BY) en se basant sur les fonctions d\'agrégat. L\'ordre d\'exécution est : WHERE → GROUP BY → HAVING → SELECT → ORDER BY.',
        'darija' => 'GROUP BY regroupent lignes mêmes valeurs colonnes. HAVING filtre groupes (après GROUP BY) basée sur agrégats. Ordre exécution : WHERE → GROUP BY → HAVING → SELECT → ORDER BY.'
    ],
];