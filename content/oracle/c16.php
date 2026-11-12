<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 16 : Constraints : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL
 * Contraintes de intégrité qui s'appliquent automatiquement sur les colonnes de tables.
 */

return [
    'id'       => 'oracle-ch16',
    'title'    => 'Contraintes : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL',
    'subtitle' => 'Règles d\'intégrité des données',

    'objectives' => [
        'Comprendre le but des contraintes dans Oracle.',
        'Créer des contraintes PRIMARY KEY et FOREIGN KEY lors de la création de table.',
        'Ajouter des contraintes UNIQUE et CHECK après coup avec ALTER TABLE.',
        'Utiliser NOT NULL pour interdire les valeurs manquantes.',
        'Supprimer ou désactiver des contraintes avec ALTER TABLE ... DROP CONSTRAINT.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'not-null-unique',
            'title' => 'NOT NULL et UNIQUE',
            'icon'  => '✅',
            'blocks' => [

                make_definition_block(
                    'NOT NULL',
                    '<p>La contrainte <strong>NOT NULL</strong> interdit l\'insertion de lignes où la colonne spécifiée vaut NULL. Elle doit être systématiquement appliquée aux colonnes qui exigent une valeur.</p>',
                    '<p><b>NOT NULL</b> interdit insertion lignes colonne NULL. Doit être appliqué colonnes exigeant une valeur.</p>'
                ),

                make_definition_block(
                    'UNIQUE',
                    '<p>La contrainte <strong>UNIQUE</strong> garantit que toutes les valeurs d\'une colonne (ou combinaison de colonnes) sont différentes. Les valeurs NULL sont considérées comme différentes : deux lignes peuvent toutes deux avoir NULL dans une colonne UNIQUE.</p>',
                    '<p><b>UNIQUE</b> garantit valeurs colonne différentes. NULL considérés différents : deux lignes peuvent avoir NULL dans colonne UNIQUE.</p>'
                ),

                make_example_block(
                    'CREATE TABLE avec NOT NULL et UNIQUE',
                    '<pre><code>-- Table avec toutes les contraintes de base\nCREATE TABLE utilisateurs (\n  utilisateur_id NUMBER PRIMARY KEY,\n  nom            VARCHAR2(50) NOT NULL,\n  email          VARCHAR2(100) UNIQUE,\n  mot_de_passe   VARCHAR2(100) NOT NULL,\n  date_inscription DATE DEFAULT SYSDATE\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'L\'utilisateur_id est la clé primaire, nom et mot_de_passe ne peuvent pas être NULL, email doit être unique.'
                ),

                make_example_block(
                    'Vérifier contrainte NOT NULL',
                    '<pre><code>-- Essayer d\'insérer un utilisateur sans nom (va échouer)\nINSERT INTO utilisateurs (utilisateur_id, email)\nVALUES (1, \\'test@exemple.com\\\');\n-- Erreur : ORACLE error 1400: cannot insert INTO USER NULL INTO NOT NULL constraint</code></pre>',
                    '<pre>Erreur ORACLE 1400 : cannot insert INTO USER NULL INTO NOT NULL constraint</pre>',
                    'L\'insertion échoue car la colonne nom ne peut pas être NULL.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'primary-key-foreign-key',
            'title' => 'PRIMARY KEY et FOREIGN KEY',
            'icon'  => '🔑',
            'blocks' => [

                make_definition_block(
                    'PRIMARY KEY',
                    '<p>La contrainte <strong>PRIMARY KEY</strong> identifie de manière unique chaque ligne d\'une table. Elle combine les propriétés de NOT NULL et d\'UNIQUE : la colonne (ou les colonnes) ne peuvent pas contenir NULL et doivent être uniques.</p>',
                    '<p><b>PRIMARY KEY</b> identifie unique chaque ligne table. Combine NOT NULL + UNIQUE : pas de NULL, valeurs uniques.</p>'
                ),

                make_definition_block(
                    'FOREIGN KEY',
                    '<p>La contrainte <strong>FOREIGN KEY</strong> établit une relation de référence entre deux tables. La colonne (ou colonnes) étrangères doit contenir des valeurs qui existent en tant que PRIMARY KEY dans la table référencée, ou être NULL.</p>',
                    '<p><b>FOREIGN KEY</b> établit relation référence entre tables. Colonnes étrangères doivent contenir valeurs existant en PRIMARY KEY table référencée, ou NULL.</p>'
                ),

                make_example_block(
                    'CREATE TABLE avec PRIMARY KEY et FOREIGN KEY',
                    '<pre><code>\n-- Table des départements (référencée)\nCREATE TABLE départements (\n  dep_id   NUMBER PRIMARY KEY,\n  dep_name VARCHAR2(50)\n);\n\n-- Table des employés (référençant)\nCREATE TABLE employés (\n  emp_id    NUMBER PRIMARY KEY,\n  emp_name  VARCHAR2(100) NOT NULL,\n  dep_id    NUMBER,\n  CONSTRAINT fk_dept FOREIGN KEY (dep_id) REFERENCES départements(dep_id)\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'Chaque employé doit appartenir à un département existant (contrainte de clé étrangère).'
                ),

                make_example_block(
                    'Insertion et violation de clé étrangère',
                    '<pre><code>-- Tentative d\'insérer un employé avec un département inexistant\nINSERT INTO employés (emp_id, emp_name, dep_id)\nVALUES (100, \\'Test\\', 999);\n-- Erreur : ORACLE error 01400: cannot insert INTO ... referenced key not found</code></pre>',
                    '<pre>Erreur ORACLE 01400 : referenced key not found</pre>',
                    'Impossible d\'ajouter un employé avec un dep_id qui n\'existe pas dans la table départements.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'check-constraint',
            'title' => 'CHECK : contraintes personnalisées',
            'icon'  => '✓',
            'blocks' => [

                make_definition_block(
                    'CHECK',
                    '<p>La contrainte <strong>CHECK</strong> permet de spécifier une condition que les valeurs d\'une colonne doivent respecter. Si la condition est fausse, l\'opération d\'insertion ou de mise à jour est rejetée.</p>',
                    '<p><b>CHECK</b> condition que valeurs colonne doivent respecter. Si fausse, insertion/update rejetée.</p>'
                ),

                make_example_block(
                    'CREATE TABLE avec CHECK',
                    '<pre><code>-- Table de produits avec des contraintes CHECK\nCREATE TABLE produits (\n  prod_id   NUMBER PRIMARY KEY,\n  nom       VARCHAR2(100) NOT NULL,\n  prix      NUMBER(10, 2) CONSTRAINT prix_positif CHECK (prix > 0),\n  quantite  NUMBER DEFAULT 0 CONSTRAINT quantite_non_negatif CHECK (quantite >= 0)\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'Le prix doit être supérieur à 0 et la quantité ne peut pas être négative.'
                ),

                make_example_block(
                    'Violation de CHECK',
                    '<pre><code>-- Essayer d\'insérer un produit avec un prix négatif\nINSERT INTO produits (prod_id, nom, prix)\nVALUES (1, \\'Casse-c\\'ole\\', -10);\n-- Erreur : ORACLE error 3819: constraint (SCOTT.PRIX_POSITIF) violated</code></pre>',
                    '<pre>Erreur ORACLE 3819: constraint (SCOTT.PRIX_POSITIF) violated</pre>',
                    'L\'insertion est rejetée car le prix -10 viole la contrainte CHECK prix > 0.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Supposer que UNIQUE interdit les doublons de NULL',
            'fix'    => 'Rappeler que deux lignes peuvent avoir NULL dans une colonne UNIQUE : NULL est considéré comme inconnu, pas comme une valeur en soi.',
            'fr'     => 'En Oracle, la contrainte UNIQUE autorise plusieurs lignes à contenir NULL dans la colonne concernée, car NULL n\'est pas considéré comme une valeur égale à une autre NULL.',
            'darija' => 'En Oracle, contrainte UNIQUE autorise plusieurs lignes NULL colonne, car NULL pas considéré valeur égale NULL.'
        ],
        [
            'wrong'  => 'Oublier de nommer sa contrainte CHECK',
            'fix'    => 'Donnez toujours un nom explicite à vos contraintes CHECK avec CONSTRAINT nom_contrôle..., cela facilite leur gestion ultérieure avec ALTER TABLE.',
            'fr'     => 'Bien que Oracle puisse générer un nom automatique, il est recommandé de nommer ses contraintes (CONSTRAINT prix_positif CHECK ...) pour pouvoir les modifier ou les supprimer plus tard avec ALTER TABLE ... DROP CONSTRAINT prix_positif.',
            'darija' => 'Toujours nommer contraintes CHECK avec CONSTRAINT nom pour pouvoir les modifier/supprimer plus tard ALTER TABLE.'
        ],
    ],

    'summary' => [
        'fr'     => 'NOT NULL interdit les valeurs NULL. UNIQUE garantit des valeurs uniques (multiple NULL autorisés). PRIMARY KEY combine NOT NULL + UNIQUE et identifie chaque ligne. FOREIGN KEY créé des relations entre tables. CHECK impose des conditions personnalisées sur les valeurs.',
        'darija' => 'NOT NULL interdit NULL. UNIQUE garantit valeurs uniques (multiple NULL autorisés). PRIMARY KEY combine NOT NULL + UNIQUE identifie chaque ligne. FOREIGN KEY créé relations entre tables. CHECK impose conditions personnalisées valeurs.'
    ],
];