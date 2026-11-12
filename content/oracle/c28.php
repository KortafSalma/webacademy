<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 28 : Enregistrements, collections et PL/SQL avancé
 * Types de données complexes et programmation orientée objet en PL/SQL.
 */

return [
    'id'       => 'oracle-ch28',
    'title'    => 'Enregistrements, collections et PL/SQL avancé',
    'subtitle' => 'Types de données complexes',

    'objectives' => [
        'Utiliser le type RECORD pour créer des structures de données composites.',
        'Utiliser le type TABLE OF pour créer des collections indexables.',
        'Utiliser le type VARRAY pour des collections de taille fixe ou variable.',
        'Manipuler des collections avec les méthodes EXISTS, COUNT, LIMIT, TRIM.',
        'Appliquer ces concepts avancés à des scénarios réels.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'type-record',
            'title' => 'TYPE RECORD : structures composites',
            'icon'  => '📋',
            'blocks' => [

                make_definition_block(
                    'TYPE RECORD',
                    '<p>Un <strong>TYPE RECORD</strong> permet de définir une structure de données composée de plusieurs champs de types différents, semblables à une ligne de table mais sans être attachée à une table spécifique.</p>',
                    '<p><b>TYPE RECORD</b> structure données composites plusieurs champs types différentsligne table sans être attachée table spécifique.</p>'
                ),

                make_example_block(
                    'Déclaration et utilisation d\'un RECORD',
                    '<pre><code>TYPE t_client_record IS RECORD (\n  id clients.id%TYPE;\n  nom clients.nom%TYPE;\n  email clients.email%TYPE;\n  solde NUMBER DEFAULT 0\n);\n\nv_client t_client_record;\nBEGIN\n  SELECT id, nom, email, solde\n  INTO v_client\n  FROM clients\n  WHERE id = 1;\n  DBMS_OUTPUT.PUT_LINE(\\'Client :\' || v_client.id || \\' -\' || v_client.nom || \\'\\' || v_client.email);\nEND;</code></pre>',
                    '<pre>Client : 1 - Mohamed moh@exemple.com</pre>',
                    'Le record v_client contient les quatre champs sélectionnés depuis la table clients.'
                ),

                make_tip_block(
                    'TYPE RECORD vs ligne de table',
                    '<p>Contrairement à une ligne de table (%ROWTYPE), un RECORD n\'est pas automatiquement lié à une table. Vous devez déclarer explicitement chaque champ. Cela offre plus de flexibilité lorsque vous ne travaillez qu\'avec certaines colonnes.</p>',
                    '<p>Contrairementligne table (%ROWTYPE), RECORD automatiquement lié table. Vous declarez explicite chaque champ. Plus flexible lorsqu\\'utilisez certaines colonnes seulement.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'type-collection',
            'title' => 'TYPE TABLE et VARRAY : collections',
            'icon'  => '📚',
            'blocks' => [

                make_definition_block(
                    'TYPE TABLE OF (index par défaut)',
                    '<p>Un <strong>TABLE OF</strong> (ou INDEX BY TABLE OF) représente une collection unidimensionnelle indexée par une clé (généralement un nombre ou une chaîne). Elle peut grandir dynamiquement.</p>',
                    '<p><b>TABLE OF</b> collection unidimensionnelle indexée clé (nombre chaîne). Peut grandir dynamiquement.</p>'
                ),

                make_definition_block(
                    'TYPE VARRAY',
                    '<p>Un <strong>VARRAY</strong> (Table VARiable Array) est une collection indexée dont la taille maximale est définie au moment de la création. Elle a une borne supérieure fixe.</p>',
                    '<p><b>VARRAY</b> collection indexée taille maximale définie création. Taille borne fixe.</p>'
                ),

                make_example_block(
                    'TYPE TABLE OF index par PLS_INTEGER',
                    '<pre>TYPE t_nombre_table IS TABLE OF NUMBER INDEX BY PLS_INTEGER;\nv_table t_nombre_table;\nBEGIN\n  v_table(1) := 100;\n  v_table(5) := 200;\n  v_table(10) := 300;\n  FOR i IN 1..10 LOOP\n    IF EXISTS(v_table, i) THEN\n      DBMS_OUTPUT.PUT_LINE(\\'Index :\' || i || \\' Valeur :\' || v_table(i));\n    END IF;\n  END LOOP;\nEND;</pre>',
                    '<pre>Index : 1 Valeur : 100\nIndex : 5 Valeur : 200\nIndex : 10 Valeur : 300</pre>',
                    'La collection TABLE OF peut être remplie à n\'importe quelle index et parcouillée avec EXISTS pour vérifier la présence.'
                ),

                make_example_block(
                    'TYPE VARRAY de taille fixe',
                    '<pre>TYPE t_jour_semaine IS VARRAY(7) OF VARCHAR2(10);\nv_jours t_jour_semaine := t_jour_semaine(\\'Lundi\\', \\'Mardi\\', \\'Mercredi\\', \\'Jeudi\\', \\'Vendredi\\');\nBEGIN\n  v_jours.EXTEND;\n  v_jours(6) := \\'Samedi\\';\n  v_jours.EXTEND;\n  v_jours(7) := \\'Dimanche\\';\n  FOR i IN 1..v_jours.COUNT LOOP\n    DBMS_OUTPUT.PUT_LINE(v_jours(i));\n  END LOOP;\nEND;</pre>',
                    '<pre>Lundi\nMardi\nMercredi\nJeudi\nVendredi\nSamedi\nDimanche</pre>',
                    'Le VARRAY a une taille maximale (7) mais peut être étendu avec EXTEND jusqu\'à cette limite.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'methodes-collections',
            'title' => 'Méthodes des collections',
            'icon'  => '🔧',
            'blocks' => [

                make_definition_block(
                    'EXISTS(key)',
                    '<p>La méthode <strong>EXISTS(key)</strong> retourne VRAI si l\'élément à l\'index key existe dans la collection TABLE OF, sinon FAUX.</p>',
                    '<p><b>EXISTS(key)</b> retourne VRAI élément existe collection TABLE OF index key sinon FAUX.</p>'
                ),

                make_definition_block(
                    'COUNT',
                    '<p>La méthode <strong>COUNT</strong> retourne le nombre d\'éléments actuellement stockés dans la collection (pour TABLE OF) ou la cardinalité maximale (pour VARRAY).</p>',
                    '<p><b>COUNT</b> retourne nombre éléments stockés collection COUNT maximal VARRAY.</p>'
                ),

                make_definition_block(
                    'LIMIT et TRIM',
                    '<p>La méthode <strong>LIMIT</strong> retourne la limite maximale d\'éléments pour un VARRAY. La méthode <strong>TRIM</strong> supprime les éléments du haut de la collection (diminue le COUNT).</p>',
                    '<p><b>LIMIT</b> limite maximale éléments VARRAY. <b>TRIM</b> supprime éléments du haut réduction COUNT.</p>'
                ),

                make_example_block(
                    'Méthodes EXISTS, COUNT, TRIM sur TABLE OF',
                    '<pre>TYPE t_indice_table IS TABLE OF NUMBER INDEX BY VARCHAR2(20);\nv_notes t_indice_table;\n\nv_notes\\'maths\\' := 15;\nv_notes\\'fran\\'ais := 18;\nv_notes\\'physique := 12;\n\nIF EXISTS(v_notes\\'maths\\') THEN\n  DBMS_OUTPUT.PUT_LINE(\\'Matière maths présente avec la note :\' || v_notes\\'maths\\');\nEND IF;\n\nDBMS_OUTPUT.PUT_LINE(\\'Nombre matières :\' || v_notes.COUNT);\n\nTRIM(v_notes);\nDBMS_OUTPUT.PUT_LINE(\\'Après TRIM, nombre :\' || v_notes.COUNT);</pre>',
                    '<pre>Matière maths présente avec la note : 15\nNombre matières : 3\nAprès TRIM, nombre : 2</pre>',
                    'Exemple complet : on vérifie la présence d\'une clé, on compte les éléments, puis on en supprime un avec TRIM.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier que TABLE OF est indexée par défaut mais VARRAY a borne fixe',
            'fix'    => 'Rappelez que TABLE OF peut être indexée par n\'importe quelle clé (nombre, texte) et grandit dynamiquement, tandis que VARRAY a une taille maximale fixe définie au CREATE.',
            'fr'     => 'La confusion principale est de penser que TABLE OF et VARRAY fonctionnent de la même way. TABLE OF est plus flexible (taille dynamique, index libre), VARRAY est plus structuré (taille maximale fixe).',
            'darija' => 'Confusion TABLE OF VARRAY fonctionnement pareil. TABLE OF plus flexible (taille dynamique index libre) VARRAY plus structuré (taille maximale fixe).'
        ],
        [
            'wrong'  => 'Utiliser COUNT sur VARRAY pour connaître le nombre d\'éléments actuels',
            'fix'    => 'Rappelez que COUNT sur un TABLE OF retourne le nombre d\'éléments stockés (peut être inférieur à la taille maximale), tandis que pour un VARRAY, COUNT retourne la cardinalité actuelle (qui peut être inférieure à LIMIT).',
            'fr'     => 'Bien que les deux aient une méthode COUNT, leur signification diffère légèrement selon le type de collection. Vérifiez toujours le type de collection avant d\'interpréter le résultat de COUNT.',
            'darija' => 'Bien que les deux aient méthode COUNT signification diffère selon type collection. Vérifiez toujours type collection avant interpréter résultat COUNT.'
        ],
    ],

    'summary' => [
        'fr'     => 'TYPE RECORD pour structures composites sur mesure. TYPE TABLE OF pour collections indexables dynamiques. TYPE VARRAY pour collections de taille fixe. Méthodes EXISTS COUNT LIMIT TRIM pour manipuler les collections.',
        'darija' => 'TYPE RECORD structures composites sur mesure. TYPE TABLE OF collections dynamiques indexables. TYPE VARRAY collections taille fixe. Méthodes EXISTS COUNT LIMIT TRIM manipuler collections.'
    ],
];