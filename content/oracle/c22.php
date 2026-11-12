<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 22 : Boucles : LOOP, WHILE et FOR
 * Structures de répétition en PL/SQL pour traiter des jeux de données.
 */

return [
    'id'       => 'oracle-ch22',
    'title'    => 'Boucles : LOOP, WHILE et FOR',
    'subtitle' => 'Répétition des traitements',

    'objectives' => [
        'Utiliser la boucle LOOP pour une répétition infinie avec possibilité de sortie.',
        'Utiliser la boucle WHILE pour répéter tant qu\'une condition est VRAIE.',
        'Utiliser la boucle FOR pour itérer sur une plage de valeurs connue.',
        'Utiliser les clauses EXIT et CONTINUE pour contrôler le flux des boucles.',
        'Appliquer les boucles aux curseurs et aux jeux de résultats.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'loop-basique',
            'title' => 'Boucle LOOP avec EXIT',
            'icon'  => '⭕',
            'blocks' => [

                make_definition_block(
                    'LOOP ... EXIT',
                    '<p>La structure <strong>LOOP</strong> crée une boucle infinie. La clause <strong>EXIT</strong> en sort lorsque une condition est remplie.</p>',
                    '<p><b>LOOP</b> boucle infinie. <b>EXIT</b> sors quand condition remplie.</p>'
                ),

                make_example_block(
                    'LOOP simple avec compteur',
                    '<pre><code>\nDECLARE\n  v_compteur NUMBER := 1;\nBEGIN\n  LOOP\n    DBMS_OUTPUT.PUT_LINE(\\'Itération :\' || v_compteur);\n    v_compteur := v_compteur + 1;\n    EXIT WHEN v_compteur > 5;\n  END LOOP;\nEND;</code></pre>',
                    '<pre>Itération : 1\nItération : 2\nItération : 3\nItération : 4\nItération : 5</pre>',
                    'La boucle s\'arrête après 5 itérations grâce à EXIT WHEN.'
                ),

                make_tip_block(
                    'Précautions avec LOOP',
                    '<p>Veillez toujours à ce que la condition EXIT devienne vrai à un moment donné, sinon la boucle s\'exécutera indéfiniment (boucle infinie).</p>',
                    '<p>Toujours condition EXIT deviendra vrai sinon boucle infinie.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'while-loop',
            'title' => 'Boucle WHILE',
            'icon'  => '🔁',
            'blocks' => [

                make_definition_block(
                    'WHILE ... LOOP',
                    '<p>La structure <strong>WHILE ... LOOP</strong> exécute le bloc tant que la condition reste VRAIE. Si la condition est fausse dès le départ, le corps de la boucle ne s\'exécutera jamais.</p>',
                    '<p><b>WHILE ... LOOP</b> exécute bloc tant que condition VRAIE. Si fausse au début, corps boucle jamais exécuté.</p>'
                ),

                make_example_block(
                    'WHILE avec compteur',
                    '<pre><code>\nDECLARE\n  v_compteur NUMBER := 1;\nBEGIN\n  WHILE v_compteur <= 5 LOOP\n    DBMS_OUTPUT.PUT_LINE(\\'Compteur :\' || v_compteur);\n    v_compteur := v_compteur + 1;\n  END LOOP;\nEND;</code></pre>',
                    '<pre>Compteur : 1\nCompteur : 2\nCompteur : 3\nCompteur : 4\nCompteur : 5</pre>',
                    'La boucle s\'arrête lorsque v_compteur dépasse 5.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'for-loop',
            'title' => 'Boucle FOR',
            'icon'  => '🔢',
            'blocks' => [

                make_definition_block(
                    'FOR ... IN ... LOOP',
                    '<p>La structure <strong>FOR v IN lower..upper LOOP</strong> itère sur une plage de valeurs connue. La variable de boucle v est automatiquement créée et prend les valeurs de lower à upper.</p>',
                    '<p><b>FOR v IN lower..upper LOOP</b> itère plage valeurs connue. Variable v automatique créé valeurs lower à upper.</p>'
                ),

                make_example_block(
                    'FOR simple : afficher les nombres de 1 à 5',
                    '<pre><code>\nBEGIN\n  FOR v IN 1..5 LOOP\n    DBMS_OUTPUT.PUT_LINE(\\'Nombre :\' || v);\n  END LOOP;\nEND;</code></pre>',
                    '<pre>Nombre : 1\nNombre : 2\nNombre : 3\nNombre : 4\nNombre : 5</pre>',
                    'La variable v prend automatiquement les valeurs 1, 2, 3, 4, 5.'
                ),

                make_example_block(
                    'FOR avec agrégat : somme des nombres',
                    '<pre><code>\nDECLARE\n  v_somme NUMBER := 0;\nBEGIN\n  FOR v IN 1..10 LOOP\n    v_somme := v_somme + v;\n  END LOOP;\n  DBMS_OUTPUT.PUT_LINE(\\'Somme 1 à 10 :\' || v_somme);\nEND;</code></pre>',
                    '<pre>Somme 1 à 10 : 55</pre>',
                    'Le boucle calcule 1+2+...+10 = 55.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier la mise à jour manuelle du compteur dans LOOP',
            'fix'    => 'Rappelez que dans une boucle LOOP, vous devez mettre à jour vous-même les variables utilisées dans la condition EXIT.',
            'fr'     => 'Dans LOOP...EXIT, la variable de condition doit être modifiée à l\'intérieur du corps de la boucle, sinon EXIT ne sera jamais atteint et la boucle durera indéfiniment.',
            'darija' => 'Dans LOOP...EXIT, variable condition doit être modifiée corps boucle sinon EXIT jamais atteint boucle infinie.'
        ],
        [
            'wrong'  => 'Confondre la condition d\'arrêt dans WHILE',
            'fix'    => 'Vérifiez que la condition WHILE finira par devenir fausse, autrement vous aurez une boucle infinie.',
            'fr'     => 'Si la condition WHILE est vraie en permanence (ou devient vraie encore plus tard), la boucle ne s\'arrêtera jamais. Assurez-vous d\'avoir une variable qui évolue dans le corps de la boucle.',
            'darija' => 'Si condition WHILE vraie en permanence boucle ne s\'arrêtera jamais. Variable doit évoluer corps boucle.'
        ],
    ],

    'summary' => [
        'fr'     => 'LOOP...EXIT : boucle infinie avec sortie conditionnelle. WHILE...LOOP : répète tant que condition VRAIE. FOR...IN..LOOP : itère sur une plage connue. Utilisez EXIT/CONTINUE pour contrôler le flux.',
        'darija' => 'LOOP...EXIT boucle infinie sortie conditionnelle. WHILE...LOOP répète tant condition VRAIE. FOR...IN..LOOP itère plage connue. Utilisez EXIT/CONTINUE contrôler flux.'
    ],
];