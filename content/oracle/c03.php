<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 3 : Comprendre SQL*Plus et SQL Developer
 * Les deux outils principaux pour écrire et exécuter des requêtes Oracle :
 * SQL*Plus (en ligne de commande) et SQL Developer (interface graphique).
 */

return [
    'id'       => 'oracle-ch3',
    'title'    => 'Comprendre SQL*Plus et SQL Developer',
    'subtitle' => 'Les outils de travail avec Oracle Database',

    'objectives' => [
        'Différencier SQL*Plus (ligne de commande) et SQL Developer (GUI).',
        'Lancer SQL*Plus et saisir des commandes de base.',
        'Configurer SQL Developer pour se connecter à Oracle XE.',
        'Utiliser les fonctionnalités de base de chaque outil.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'sqlplus-vs-sql-dev',
            'title' => 'SQL*Plus vs SQL Developer',
            'icon'  => '🔧',
            'blocks' => [

                make_definition_block(
                    'SQL*Plus',
                    '<p><strong>SQL*Plus</strong> est l\'outil en ligne de commande historique d\'Oracle. Il fonctionne dans un terminal/ligne de commande et permet de saisir des requêtes SQL, des commandes PL/SQL, de configurer la base et de générer des rapports textuels.</p>',
                    '<p><b>SQL*Plus</b> howa tool historique CLI d\'Oracle. Kaywork f terminal/line command w kaymchi sa requêtes SQL, PL/SQL, config base w generate rapports textuels.</p>'
                ),

                make_definition_block(
                    'SQL Developer',
                    '<p><strong>SQL Developer</strong> est une interface graphique (GUI) gratuite fournie par Oracle. Elle offre une visualisation des objets de base, un débogueur PL/SQL, un éditeur de code avec coloration syntaxique, et bien plus encore. C\'est l\'outil recommandé pour la plupart des utilisateurs.</p>',
                    '<p><b>SQL Developer</b> howa GUI gratuite b Oracle. Kayvisualize objets base, debugger PL/SQL, editor code w coloration syntaxique, plus encore. Recommandé pour la plupart des utilisateurs.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'SQL*Plus', 'fr' => 'Ligne de commande', 'darija' => 'CLI'],
                    ['kw' => 'SQL Developer', 'fr' => 'Interface graphique', 'darija' => 'GUI'],
                    ['kw' => 'CLI', 'fr' => 'Interface en ligne de commande', 'darija' => 'CLI'],
                    ['kw' => 'GUI', 'fr' => 'Interface graphique', 'darija' => 'GUI'],
                ]),

                make_example_block(
                    'Ouvrir SQL*Plus',
                    '<pre><code>-- Windows : Ouvrir "SQL*Plus" dans le menu Démarrer\n-- Linux : Ouvrir un terminal et taper : sqlplus\n-- Connexion :\nSQL> CONNECT username/password@host:port/service\nSQL> CONNECT system/Manager@XE</code></pre>',
                    '<pre>C:\Users\> sqlplus\nSQL*Plus: Release 21.0.0.0.0 - Production on mar. 24 juin 2025 10:35:12\n\nCopyright (c) 1982, 2025, Oracle.  All rights reserved.\n\nEnter user-name: system\nEnter password: ********\n\nConnected to:\nOracle Database 21c Express Edition Release 21.0.0.0.0 - Production\nSQL> </pre>',
                    'L\'invite SQL> signifie que vous êtes connecté et prêt à saisir des requêtes.'
                ),

                make_example_block(
                    'Ouvrir SQL Developer',
                    '<pre><code>1. Lancez l\'application SQL Developer\n2. Dans la fenêtre "Connectiaons", cliquez sur le "+" pour ajouter une connexion\n3. Remplissez :\n   - Nom de connexion : XE\n   - Nom d\'utilisateur : system\n   - Mot de passe : Manager\n   - Nom du hôte : localhost\n   - Port : 1521\n   - Nom du service : XE\n4. Cliquez sur "Tester" puis sur "Connecter"</code></pre>',
                    '<pre>SQL Developer fenêtre de connexion...</pr>',
                    'SQL Developer offre une interface visuelle pour gérer les tables, vues, procédures et exécuter des requêtes.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'sqlplus-commands',
            'title' => 'Commandes de base en SQL*Plus',
            'icon'  => '⌨️',
            'blocks' => [

                make_definition_block(
                    'Paramètres utiles',
                    '<p>SQL*Plus dispose de nombreuses commandes de configuration :</p>',
                    '<p>SQL*Plus kaylik commandes configuration :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'SET SERVEROUTPUT ON', 'fr' => 'Afficher la sortie PL/SQL', 'darija' => 'Show PL/SQL output'],
                    ['kw' => 'SET LINESIZE', 'fr' => 'Largeur de ligne', 'darija' => 'Line size'],
                    ['kw' => 'SET PAGESIZE', 'fr' => 'Lignes par page', 'darija' => 'Pages per page'],
                    ['kw' => 'DESCRIBE', 'fr' => 'Structure d\'une table', 'darija' => 'Structure table'],
                ]),

                make_example_block(
                    'Activation de la sortie SQL*Plus',
                    '<pre><code>SQL> SET SERVEROUTPUT ON\nSQL>\nBEGIN\n  DBMS_OUTPUT.PUT_LINE(\"Bonjour Oracle !\");\nEND;\n/\nBonjour Oracle !\n</code></pre>',
                    '<pre>SQL> SET SERVEROUTPUT ON\nSQL> BEGIN\n 2    DBMS_OUTPUT.PUT_LINE(\"Bonjour Oracle !\");\n 3  END;\n 4  /\nBonjour Oracle !\nSQL> </pre>',
                    'La commande <code>SET SERVEROUTPUT ON</code> est essentielle pour voir la sortie des blocs PL/SQL dans SQL*Plus.'
                ),

                make_example_block(
                    'Vérifier la version de la base',
                    '<pre><code>SQL> SELECT * FROM V$VERSION WHERE ROWNUM = 1;</code></pre>',
                    '<pre>BANNER
--------------------------------------------------------------------------------
Oracle Database 21c Express Edition Release 21.0.0.0.0 - Production
PL/SQL Release 21.0.0.0.0 - Production</pre>',
                    'La vue V$VERSION affiche les informations de version de la base de données.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'sql-dev-workspace',
            'title' => 'Workflows dans SQL Developer',
            'icon'  => '📐',
            'blocks' => [

                make_text_block(
                    '<p>SQL Developer offre plusieurs fenêtres de travail :</p>',
                    '<p>SQL Developer kaylik plusieurs fenêtres :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'Connexions', 'fr' => 'Connecties', 'darija' => 'Connections'],
                    ['kw' => 'Requêtes', 'fr' => 'Queries', 'darija' => 'Queries'],
                    ['kw' => 'Objets de base', 'fr' => 'Objets de base', 'darija' => 'Objets base'],
                    ['kw' => 'Rapport', 'fr' => 'Rapport', 'darija' => 'Rapport'],
                ]),

                make_example_block(
                    'Structure d\'une table dans SQL Developer',
                    '<pre><code>-- 1. Développez "Connexions" → Oracle XE → TABLES\n-- 2. Cliquez sur une table (ex: EMP)\n-- 3. La vue "Details" montre les colonnes, contraintes, index\n-- 4. Clic droit → "View Data" pour voir les lignes</code></pre>',
                    '<pre>Sélectionnez une table → clic droit "View Data" → navigate rows</pre>',
                    'Visualiser la structure d\'une table avant d\'écrire des requêtes.'
                ),

                make_tip_block(
                    'Astuce SQL Developer',
                    '<p>Vous pouvez saisir des requêtes SQL directement dans la fenêtre "Terminal" de SQL Developer (affichée via View → Terminal). Cela combine la puissance de SQL*Plus avec l\'interface graphique.</p>',
                    '<p>Kaylik tool Terminal f SQL Developer kaymchi sa requêtes SQL b puissance CLI.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier d\'exécuter SET SERVEROUTPUT ON',
            'fix'    => 'Toujours commencer vos blocs PL/SQL par SET SERVEROUTPUT ON si vous voulez voir la sortie.',
            'fr'     => 'Sans SET SERVEROUTPUT ON, les commandes DBMS_OUTPUT.PUT_LINE() ne s\'affichent pas dans SQL*Plus. C\'est une erreur fréquente des débutants.',
            'darija' => 'B3d SET SERVEROUTPUT ON, DBMS_OUTPUT kaylaffich ma b SQL*Plus. Erreur fréquent debutant.'
        ],
        [
            'wrong'  => 'Utiliser SQL Developer sans configurer la connexion',
            'fix'    => 'Toujours tester la connexion (bouton "Test") avant d\'essayer d\'exécuter des requêtes.',
            'fr'     => 'Une connexion non testée peut entraîner des erreurs d\'authentification silencieuses ou la connexion à la mauvaise base de données.',
            'darija' => 'Connexion non testée kaylik erreurs authentification silencieuses w connection mauvaise base.'
        ],
    ],

    'summary' => [
        'fr'     => 'SQL*Plus est l\'outil en ligne de commande puissant pour les scripts et l\'automatisation, tandis que SQL Developer offre une interface graphique riche avec des visualisations et un débogueur. La commande <code>SET SERVEROUTPUT ON</code> est indispensable pour voir la sortie PL/SQL dans SQL*Plus.',
        'darija' => 'SQL*Plus howa tool CLI puissant b scripts w automation, SQL Developer howa GUI riche w visualisations w debugger. SET SERVEROUTPUT ON indispensable b sortie PL/SQL f SQL*Plus.'
    ],
];