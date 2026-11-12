<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 6 : Introduction aux bases de données relationnelles et aux tables
 * Concepts fondamentaux : tables, lignes, colonnes, clés primaires, et structure d'une base Oracle.
 */

return [
    'id'       => 'oracle-ch6',
    'title'    => 'Introduction aux bases de données relationnelles et aux tables',
    'subtitle' => 'Les fondements du modèle relationnel Oracle',

    'objectives' => [
        'Comprendre le modèle relationnel (tables, lignes, colonnes).',
        'Identifier les composants d\'une table Oracle (colonnes, types de données).',
        'Différencier les clés primaires et étrangères.',
        'Créer une table basique avec CREATE TABLE.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'modele-relationnel',
            'title' => 'Le modèle relationnel',
            'icon'  => '📐',
            'blocks' => [

                make_definition_block(
                    'Base de données relationnelle',
                    '<p>Une base de données relationnelle stocke les données sous forme de <strong>tables</strong> composées de lignes (enregistrements) et de colonnes (attributs). Chaque table représente une entité (clients, produits, commandes…).</p>',
                    '<p>Base de données relationnelle stocke données sous forme de <b>tables</b> composés de lignes (enregistrements) et de colonnes (attributs). Chaque table représente une entité (clients, produits, commandes…).</p>'
                ),

                make_definition_block(
                    'Table, ligne, colonne',
                    '<ul><li><strong>Table :</strong> collection de données liées.</li><li><strong>Ligne (enregistrement) :</strong> une entrée unique dans la table.</li><li><strong>Colonne (attribut) :</strong> une propriété de l\'entité.</li></ul>',
                    '<ul><li><b>Table</b> : collection données liées.</li><li><b>Ligne (enregistrement)</b> : entrée unique f table.</li><li><b>Colonne (attribut)</b> : propriété de l\'entité.</li></ul>'
                ),

                make_keywords_block([
                    ['kw' => 'TABLE', 'fr' => 'Table', 'darija' => 'Table'],
                    ['kw' => 'ROW', 'fr' => 'Ligne', 'darija' => 'Ligne'],
                    ['kw' => 'COLUMN', 'fr' => 'Colonne', 'darija' => 'Colonne'],
                    ['kw' => 'PK', 'fr' => 'Clé primaire', 'darija' => 'Clé primaire'],
                ]),

                make_example_block(
                    'Syntaxe de création de table basique',
                    '<pre><code>-- Création d\'une table \"clients\"\nCREATE TABLE clients (\n  id         NUMBER PRIMARY KEY,\n  nom        VARCHAR2(50),\n  prenom     VARCHAR2(50),\n  email      VARCHAR2(100),\n  date_naissance DATE\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'La table clients possède 5 colonnes avec des types de données Oracle spécifiques.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'types-de données-oracle',
            'title' => 'Types de données Oracle principaux',
            'icon'  => '📊',
            'blocks' => [

                make_text_block(
                    '<p>Oracle propose des types de données riches. Les plus couramment utilisés en débutant sont :</p>',
                    '<p>Oracle kaylik rich types données. Plus couramment utilisés débutant :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'VARCHAR2', 'fr' => 'Chaîne de caractères de taille variable', 'darija' => 'Chaîne taille variable'],
                    ['kw' => 'NUMBER', 'fr' => 'Nombre entier ou décimal', 'darija' => 'Nombre entier décimal'],
                    ['kw' => 'DATE', 'fr' => 'Date et heure', 'darija' => 'Date heure'],
                    ['kw' => 'CLOB', 'fr' => 'Grand objet de caractères', 'darija' => 'Grand caractère'],
                ]),

                make_example_block(
                    'Exemple de types de colonnes',
                    '<pre><code>CREATE TABLE produits (\n  id          NUMBER PRIMARY KEY,\n  nom         VARCHAR2(100),\n  prix        NUMBER(10, 2),\n  date_ajout  DATE DEFAULT SYSDATE\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'TYPE      LONGUEUR/DÉCIMAL   EXEMPLE\nVARCHAR2  jusqu\'à 4000 octets  \"T-shirt\"\nNUMBER    10,2               29.99\nDATE               Système par défaut SYSDATE'
                ),

                make_tip_block(
                    'VARCHAR2 vs VARCHAR',
                    '<p>En Oracle, utilisez toujours <strong>VARCHAR2</strong> (et non VARCHAR, qui est réservé à des contextes spécifiques et peut entraîner des comportements différents selon la version).</p>',
                    '<p>Toujours utiliser <b>VARCHAR2</b> (et non VARCHAR) b éviter comportements différents selon version.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'cles-primaires-et-etrangeres',
            'title' => 'Clés primaires et étrangères',
            'icon'  => '🔗',
            'blocks' => [

                make_definition_block(
                    'Clé primaire (PRIMARY KEY)',
                    '<p>La <strong>clé primaire</strong> est une colonne (ou combinaison de colonnes) qui identifie de manière unique chaque ligne d\'une table. Elle ne peut contenir de valeurs <code>NULL</code> et doit être unique.</p>',
                    '<p><b>Clé primaire</b> howa colonne (ou combinaison) kaylik identifier uniquely chaque ligne table. Kaylik contenir NULL w kay unique.</p>'
                ),

                make_definition_block(
                    'Clé étrangère (FOREIGN KEY)',
                    '<p>La <strong>clé étrangère</strong> établit un lien de référence entre deux tables. Elle garantit l\'intégrité référentielle : une valeur dans la colonne étrangère doit exister en tant que clé primaire dans la table référencée.</p>',
                    '<p><b>Clé étrangère</b> kaylik lien référence entre deux tables. Kaylik intégrité référentielle : valeur dans colonne étrangère doit exister en tant que clé primaire table référencée.</p>'
                ),

                make_example_block(
                    'Table avec clé primaire et étrangère',
                    '<pre><code>-- Table des départements (référencée)\nCREATE TABLE départements (\n  dep_id   NUMBER PRIMARY KEY,\n  dep_name VARCHAR2(50)\n);\n\n-- Table des employés (référençant)\nCREATE TABLE employés (\n  emp_id    NUMBER PRIMARY KEY,\n  emp_name  VARCHAR2(50),\n  dep_id    NUMBER,\n  CONSTRAINT fk_dept FOREIGN KEY (dep_id) REFERENCES départements(dep_id)\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'Chaque employé appartient à un département existant. La contrainte assure que dep_id existe dans départements.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser VARCHAR au lieu de VARCHAR2',
            'fix'    => 'Utilisez toujours VARCHAR2 en Oracle pour les chaînes de caractères.',
            'fr'     => 'Bien que VARCHAR soit accepté dans certaines versions, VARCHAR2 est le type standard pour les chaînes de caractères variables en Oracle et évite les comportements inattendus.',
            'darija' => 'Bienke VARCHAR accepté version, VARCHAR2 standard Oracle kay chaînes caractères variables.'
        ],
        [
            'wrong'  => 'Ne pas définir de clé primaire',
            'fix'    => 'Définissez toujours une clé primaire pour garantir l\'identité unique des lignes.',
            'fr'     => 'Sans clé primaire, plusieurs lignes pourraient contenir les mêmes données, ce qui rend les mises à jour et suppressions ambiguës.',
            'darija' => 'Sans clé primaire, plusieurs lignes kaylik contenir données mêmes, w mises à jour suppressions ambiguës.'
        ],
    ],

    'summary' => [
        'fr'     => 'Une table Oracle se compose de colonnes avec des types de données (VARCHAR2, NUMBER, DATE, etc.) et de lignes uniques identifiées par une clé primaire. Les clés étrangères créent des liens d\'intégrité entre les tables. Toujours utiliser VARCHAR2 et définir une clé primaire.',
        'darija' => 'Table Oracle kaylik colonnes b types données (VARCHAR2, NUMBER, DATE, etc.) w lignes uniques identifiées par clé primaire. Clés étrangères kaylik liens intégrité entre tables. Toujours VARCHAR2 w clé primaire.'
    ],
];