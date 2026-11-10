<?php

declare(strict_types=1);

/**
 * MODULE SQL — Chapitre 1 : Fondamentaux des bases de données
 * Exemplaire de référence pour TOUS les fichiers de chapitre :
 *   - id : "module-chN"
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : résumé FR + Darija
 * Types de blocs :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'sql-ch1',
    'title'    => 'Fondamentaux des bases de données',
    'subtitle' => 'Introduction aux bases de données SQL',

    'objectives' => [
        'Comprendre qu\'est qu\'une base de données.',
        'Utiliser les commandes de base de SQL (SELECT, INSERT, UPDATE, DELETE).',
        'Apprendre la structure d\'une table (colonnes, types de données).',
        'Comprendre la différence entre DDL, DML et DCL.',
        'Utiliser les clauses WHERE, ORDER BY, LIMIT.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Introduction aux bases de données
        [
            'id'    => 'intro-bdd',
            'title' => 'Qu\'est qu\'une base de données ?',
            'icon'  => '🗃️',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Une <strong>base de données</strong> est un système organisé pour stocker et récupérer des données structurées. Elle permet de stocker de grandes quantités de informations de manière efficace et de les rechercher rapidement.</p>',
                 'darija' => '<p>Base de données howa system organized bach stocker w récupérer données structurées. Kay9der stocker grande quantité info efficacement w rapidement rechercher.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'sql',
                 'code' => '-- Création d\'une base de données\nCREATE DATABASE ma_base;\n\n-- Utilisation de la base\nUSE ma_base;',

                 'title' => 'Syntaxe de base'],

                ['type' => 'example',
                 'title' => 'Exemple de création de base de données',
                 'lang'  => 'sql',
                 'code' => '-- Création de la base de données\nCREATE DATABASE school;\n\n-- Utilisation de la base\nUSE school;',

                 'preview' => true,
                 'explainFr' => 'La base de données "school" est créée et devient la base courante pour les commandes suivantes.',
                 'explainDarija' => 'Base de données "school" kay9der created w kay9der base courante bach commandes suivante.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Types de données
        [
            'id'    => 'types-donnees',
            'title' => 'Types de données SQL',
            'icon'  => '📊',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>SQL propose plusieurs types de données pour définir la nature des informations stockées. Les plus courants sont : <code>INTEGER</code> (entiers), <code>VARCHAR</code> (chaînes de caractères de longueur variable), <code>DATE</code> (dates), et <code>BOOLEAN</code> (vrai/faux).</p>',
                 'darija' => '<p>SQL kay9der plusieurs types de données bach définir nature données stockées. Plus courants : <code>INTEGER</code> (entiers), <code>VARCHAR</code> (chaînes longueur variable), <code>DATE</code> (dates), w <code>BOOLEAN</code> (vrai/faux).</p>'],

                ['type' => 'syntax',
                 'lang'  => 'sql',
                 'code' => 'CREATE TABLE etudiant (\n    id INTEGER PRIMARY KEY,\n    nom VARCHAR(100),\n    date_naissance DATE,\n    actif BOOLEAN DEFAULT TRUE\n);',

                 'title' => 'Exemple de création de table'],

                ['type' => 'example',
                 'title' => 'Exemple de table d\'étudiants',
                 'lang'  => 'sql',
                 'code' => 'CREATE TABLE etudiant (\n    id INTEGER PRIMARY KEY,\n    nom VARCHAR(100),\n    prenom VARCHAR(50),\n    date_naissance DATE,\n    moyenne DECIMAL(10,2)\n);',

                 'preview' => true,
                 'explainFr' => 'Cette table stocke les informations des étudiants avec des types de données adaptés.',
                 'explainDarija' => 'Hada table kaystocker informations étudiants bach types données adaptés.'],

            ],
        ],

        // ------------------------------------------------ Section 3 : DDL et requêtes de base
        [
            'id'    => 'ddl-base',
            'title' => 'DDL : Création et structure',
            'icon'  => '🔧',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Le <strong>DDL</strong> (Data Definition Language) concerne les commandes qui modifient la structure de la base de données. Les commandes principales sont <code>CREATE</code>, <code>ALTER</code> et <code>DROP</code>.</p>',
                 'darija' => '<p>DDL howa commandes bach modifient structure base données. Commandes principales : <code>CREATE</code>, <code>ALTER</code> w <code>DROP</code>.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'sql',
                 'code' => 'CREATE TABLE IF NOT EXISTS users (\n    id INTEGER PRIMARY KEY AUTO_INCREMENT,\n    username VARCHAR(50) UNIQUE,\n    email VARCHAR(100) UNIQUE,\n    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n);',

                 'title' => 'Syntaxe CREATE TABLE'],

                ['type' => 'example',
                 'title' => 'Exemple de création de table users',
                 'lang'  => 'sql',
                 'code' => 'CREATE TABLE users (\n    id INTEGER PRIMARY KEY AUTO_INCREMENT,\n    username VARCHAR(50) UNIQUE,\n    email VARCHAR(100) UNIQUE,\n    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n);',

                 'preview' => true,
                 'explainFr' => 'La table users sera créée avec un identifiant automatique, des noms d\'utilisateur et d\'email uniques, et une date de création par défaut.',
                 'explainDarija' => 'Table users kay9der créée b identifiant automatique, noms utilisateur w email uniques, w date création par défaut.'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier de spécifier un PRIMARY KEY lors de la création d\'une table',
            'fix'    => 'Définissez toujours une clé primaire unique pour identifier chaque ligne de manière unique.',
            'fr'     => 'Sans clé primaire, il est impossible d\'identifier de manière unique chaque ligne, ce qui peut entraîner des doublons et des problèmes d\'intégrité des données.',
            'darija' => 'Sans clé primaire, impossible identifier uniquely chaque ligne, w potential doublons w problèmes intégrité données.',
        ],
        [
            'wrong'  => 'Utiliser des types de données trop larges (ex: VARCHAR(255) pour un code postal)',
            'fix'    => 'Choisissez la taille minimale nécessaire pour gagner en espace et en performance.',
            'fr'     => 'Des types de données trop largesGaspointent de l\'espace disque inutilement et peuvent dégrader les performances des requêtes.',
            'darija' => 'Types données trop larges gaspoint disk espace inutile w dégrader performance requêtes.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>SQL</strong> : le DDL (CREATE, ALTER, DROP) modifie la structure de la base. Les types de données couramment utilisés sont INTEGER, VARCHAR, DATE. Toujours définir une PRIMARY KEY pour l\'intégrité des données.',
        'darija' => 'SQL : DDL (CREATE, ALTER, DROP) modifie structure base. Types données couramment utilisés INTEGER, VARCHAR, DATE. Toujours PRIMARY KEY bach intégrité données.',
    ],
];