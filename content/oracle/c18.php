<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 18 : Introduction à PL/SQL et aux blocs anonymes
 * Premier pas dans la programmation procédurale Oracle : blocs Anonymous, Déclarations, Exécution.
 */

return [
    'id'       => 'oracle-ch18',
    'title'    => 'Introduction à PL/SQL et aux blocs anonymes',
    'subtitle' => 'Premier pas en programmation Oracle',

    'objectives' => [
        'Comprendre ce que est PL/SQL et ses avantages par rapport au SQL classique.',
        'Rédiger un bloc PL/SQL anonymes basique.',
        'Utiliser DBMS_OUTPUT.PUT_LINE pour afficher des résultats.',
        'Activer la sortie avec SET SERVEROUTPUT ON en SQL*Plus.',
        'Différencier les déclarations, le traitement et les exceptions dans un bloc.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'qu-est-ce-que-plsql',
            'title' => 'Qu\'est-ce que PL/SQL ?',
            'icon'  => '❓',
            'blocks' => [

                make_definition_block(
                    'PL/SQL',
                    '<p><strong>PL/SQL</strong> (Procedural Language/SQL) est le langage procédural d\'Oracle. Il étend le SQL en y ajoutant des structures de contrôle (IF, LOOP, etc.), des variables, des exceptions et de la logique métier complexe directement dans la base de données.</p>',
                    '<p><b>PL/SQL</b> langage procédural Oracle. Étend SQL avec structures contrôle (IF, LOOP), variables, exceptions logique métier directement base données.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'BLK', 'fr' => 'Bloc', 'darija' => 'Bloc'],
                    ['kw' => 'ANONYME', 'fr' => 'Anonyme', 'darija' => 'Anonyme'],
                    ['kw' => 'DBMS_OUTPUT', 'fr' => 'Sortie base', 'darija' => 'Sortie base'],
                ]),

                make_example_block(
                    'Bloc PL/SQL anonyme basique',
                    '<pre><code>\n-- Bloc anonyme : s\'exécute directement dans SQL*Plus ou SQL Developer\nDECLARE\n  -- Section déclaration (variables, curseurs, etc.)\n  v_nom VARCHAR2(50) := \'Mohamed\';\n  v_age NUMBER := 30;\nBEGIN\n  -- Section exécution (instructions SQL, PL/SQL)\n  DBMS_OUTPUT.PUT_LINE(\'Bonjour \"\' || v_nom || \' ! Age :\' || v_age);\nEND;\n/<code></pre>',
                    '<pre>Bonjour "Mohamed" ! Age : 30</pre>',
                    'Le bloc se compose d\'une partieDECLARE (variables) et d\'une partieBEGIN...END (execution).'
                ),

                make_note_block(
                    'Avant d\'exécuter : SET SERVEROUTPUT ON',
                    '<p>En SQL*Plus, la sortie de DBMS_OUTPUT.PUT_LINE() n\'apparaît pas par défaut. Il faut impérativement taper <code>SET SERVEROUTPUT ON</code> avant d\'exécuter le bloc.</p>',
                    '<p>En SQL*Plus, sortie DBMS_OUTPUT.PUT_LINE() par défaut pas apparaître. Doit taper <b>SET SERVEROUTPUT ON</b> avant exécution bloc.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'bloc-anonyme',
            'title' => 'Structure d\'un bloc anonyme',
            'icon'  => '📦',
            'blocks' => [

                make_definition_block(
                    'PARTIE DECLARE',
                    '<p>La section <strong>DECLARE</strong> est optionnelle. Elle sert à déclarer des variables, des constantes, des curseurs ou des exceptions qui seront utilisées dans la section d\'exécution.</p>',
                    '<p>Section <b>DECLARE</b> optionnelle. Déclare variables constantes curseurs exceptions utilisées section execution.</p>'
                ),

                make_definition_block(
                    'PARTIE BEGIN...END',
                    '<p>La section <strong>BEGIN...END</strong> contient le code exécutable. C\'est ici que s\'insèrent les instructions SQL, les boucles, les conditions et les appels à des procédures.</p>',
                    '<p>Section <b>BEGIN...END</b> contient code exécutable. Instructions SQL boucles conditions appels procédures.</p>'
                ),

                make_example_block(
                    'Structure complète avec les trois parties',
                    '<pre><code>\nDECLARE\n  v_salaire NUMBER := 5000;\n  v_taux    NUMBER := 0.15;\nBEGIN\n  -- Calcul de la prime\n  v_prime := v_salaire * v_taux;\n  -- Affichage de la result\n  DBMS_OUTPUT.PUT_LINE(\'Prime calculée :\' || v_prime);\nEND;</code></pre>',
                    '<pre>Prime calculée : 750</pre>',
                    'Démonstration complète avec déclaration de deux variables et calcul dans la section BEGIN.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'serveroutput',
            'title' => 'SET SERVEROUTPUT ON et DBMS_OUTPUT',
            'icon'  => '📢',
            'blocks' => [

                make_definition_block(
                    'SET SERVEROUTPUT ON',
                    '<p>La commande <strong>SET SERVEROUTPUT ON</strong> active l\'affichage de la sortie standard en SQL*Plus. Sans cette commande, les messages de DBMS_OUTPUT restent invisibles.</p>',
                    '<p><b>SET SERVEROUTPUT ON</b> active affichage sortie standard SQL*Plus. Sans, DBMS_OUTPUT invisibles.</p>'
                ),

                make_definition_block(
                    'DBMS_OUTPUT.PUT_LINE',
                    '<p>La procédure <strong>DBMS_OUTPUT.PUT_LINE</strong> écrit un texte dans la sortie standard. Elle peut être appelée depuis n\'importe où dans un bloc PL/SQL.</p>',
                    '<p><b>DBMS_OUTPUT.PUT_LINE</b> écrit texte sortie standard. Appelée n\'importe où bloc PL/SQL.</p>'
                ),

                make_example_block(
                    'Activation et utilisation',
                    '<pre><code>\n-- En SQL*Plus, à taper UNE SEULE FOIS\nSET SERVEROUTPUT ON\n\n-- Ensuite, exécuter n\'importe quel bloc PL/SQL\nBEGIN\n  DBMS_OUTPUT.PUT_LINE(\'Cette ligne s\'affiche grâce à SET SERVEROUTPUT ON\');\nEND;\n/<code></pre>',
                    '<pre>SET SERVEROUTPUT ON\n\nCette ligne s\'affiche grâce à SET SERVEROUTPUT ON</pre>',
                    'Montre le processus : d\'abord la commande SET, puis l\'exécution du bloc.'
                ),

                make_example_block(
                    'Plusieurs lignes de sortie',
                    '<pre><code>\nBEGIN\n  DBMS_OUTPUT.PUT_LINE(\'Ligne 1\');\n  DBMS_OUTPUT.PUT_LINE(\'Ligne 2\');\n  DBMS_OUTPUT.PUT_LINE(\'Ligne 3\');\nEND;\n/<code></pre>',
                    '<pre>Ligne 1\nLigne 2\nLigne 3</pre>',
                    'Plusieurs lignes s\'affichent séquentiellement.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier SET SERVEROUTPUT ON en SQL*Plus',
            'fix'    => 'Toujours commencer vos scripts SQL*Plus par SET SERVEROUTPUT ON si vous voulez voir la sortie DBMS_OUTPUT.',
            'fr'     => 'Sans SET SERVEROUTPUT ON, DBMS_OUTPUT.PUT_LINE() ne produit aucun résultat visible en SQL*Plus. C\'est une erreur très fréquente des débutants en PL/SQL.',
            'darija' => 'Sans SET SERVEROUTPUT ON, DBMS_OUTPUT.PUT_LINE() ne produit aucun résultat SQL*Plus. Erreur fréquente debutant PL/SQL.'
        ],
        [
            'wrong'  => 'Utiliser DBMS_OUTPUT sans activer la sortie',
            'fix'    => 'Rappeler que SET SERVEROUTPUT ON doit précéder tout bloc PL/SQL dont on veut voir la sortie.',
            'fr'     => 'Même si le code PL/SQL est syntactiquement correct, la sortie reste silencieuse sans la commande SET SERVEROUTPUT ON.',
            'darija' => 'Même code PL/SQL correct, sortie silencieuse sans commande SET SERVEROUTPUT ON.'
        ],
    ],

    'summary' => [
        'fr'     => 'PL/SQL étend le SQL avec de la programmation procédurale. Un bloc anonyme se compose d\'une partieDECLARE (variables), BEGIN...END (code exécutable) etoptionnellement EXCEPTION (gestion d\'erreurs). La commande SET SERVEROUTPUT ON est indispensable en SQL*Plus pour voir la sortie DBMS_OUTPUT.PUT_LINE().',
        'darija' => 'PL/SQL étend SQL avec programmation procédurale. Bloc anonyme se compose partieDECLARE (variables), BEGIN...END (code exécutable) optionnellement EXCEPTION (gestion erreurs). SET SERVEROUTPUT ON indispensable SQL*Plus b sortie DBMS_OUTPUT.PUT_LINE().'
    ],
];