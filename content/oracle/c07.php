<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 7 : CREATE, ALTER, DROP et TRUNCATE
 * Langage DDL (Data Definition Language) pour créer, modifier et supprimer des objets de base de données.
 */

return [
    'id'       => 'oracle-ch7',
    'title'    => 'CREATE, ALTER, DROP et TRUNCATE',
    'subtitle' => 'Langage DDL : création, modification et suppression d\'objets',

    'objectives' => [
        'Utiliser CREATE TABLE, CREATE VIEW, CREATE INDEX pour créer des objets.',
        'Modifier la structure d\'une table avec ALTER TABLE.',
        'Supprimer des objets avec DROP TABLE, DROP INDEX.',
        'Vider le contenu d\'une table avec TRUNCATE TABLE.',
        'Comprendre la différence entre DROP et TRUNCATE.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'create-table',
            'title' => 'CREATE TABLE et CREATE VIEW',
            'icon'  => '➕',
            'blocks' => [

                make_definition_block(
                    'CREATE TABLE',
                    '<p>La commande <strong>CREATE TABLE</strong> crée une nouvelle table dans la base de données.</p>',
                    '<p><b>CREATE TABLE</b> kaynouvo table b base de données.</p>'
                ),

                make_example_block(
                    'CREATE TABLE basique',
                    '<pre><code>-- Création de la table commandes\nCREATE TABLE commandes (\n  cmd_id      NUMBER PRIMARY KEY,\n  client_id   NUMBER,\n  montant     NUMBER(10, 2),\n  date_cmd    DATE DEFAULT SYSDATE,\n  statut      VARCHAR2(20) DEFAULT \'EN_ATTENTE\'\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'La table commandes avec contraintes de clé primaire, défauts de valeur et types de données.'
                ),

                make_example_block(
                    'CREATE TABLE avec contraintes',
                    '<pre><code>-- Table avec toutes les contraintes\nCREATE TABLE employés (\n  emp_id      NUMBER PRIMARY KEY,\n  emp_name    VARCHAR2(100) NOT NULL,\n  email       VARCHAR2(100) UNIQUE,\n  salaire     NUMBER(8, 2) CHECK (salaire > 0),\n  dep_id      NUMBER REFERENCES départements(dep_id)\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'Contraintes NOT NULL, UNIQUE, CHECK et FOREIGN KEY dans CREATE TABLE.'
                ),

                make_definition_block(
                    'CREATE VIEW',
                    '<p>La commande <strong>CREATE VIEW</strong> crée une vue, qui est une table virtuelle basée sur le résultat d\'une requête SELECT.</p>',
                    '<p><b>CREATE VIEW</b> kayvue virtuelle b résultat requête SELECT.</p>'
                ),

                make_example_block(
                    'CREATE VIEW simple',
                    '<pre><code>-- Création d\'une vue montrant les clients avec leur total de commandes\nCREATE VIEW vue_clients AS\nSELECT c.id, c.nom, c.email, COUNT(o.cmd_id) AS total_commandes\nFROM clients c\nLEFT JOIN commandes o ON c.id = o.client_id\nGROUP BY c.id, c.nom, c.email;</code></pre>',
                    '<pre>View created.\n</pre>',
                    'La vue vue_clients affiche le nom des clients et le nombre de leurs commandes.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'alter-table',
            'title' => 'ALTER TABLE : modifier la structure',
            'icon'  => '✏️',
            'blocks' => [

                make_definition_block(
                    'ALTER TABLE',
                    '<p>La commande <strong>ALTER TABLE</strong> modifie la structure d\'une table existante : ajouter/supprimer des colonnes, modifier les types de données, ajouter des contraintes.</p>',
                    '<p><b>ALTER TABLE</b> modifie structure table existante : ajouter/supprimer colonnes, modifier types, ajouter contraintes.</p>'
                ),

                make_example_block(
                    'Ajouter une colonne',
                    '<pre><code>-- Ajouter la colonne téléphone à la table employés\nALTER TABLE employés\nADD (telephone VARCHAR2(20));</code></pre>',
                    '<pre>Table altered.\n</pre>',
                    'La colonne téléphone est ajoutée à la fin de la table employés.'
                ),

                make_example_block(
                    'Modifier le type d\'une colonne',
                    '<pre><code>-- Modifier la longueur de la colonne nom\nALTER TABLE clients\nMODIFY (nom VARCHAR2(100));</code></pre>',
                    '<pre>Table altered.\n</pre>',
                    'La longueur de la colonne nom passe de sa valeur précédente à 100 caractères.'
                ),

                make_example_block(
                    'Supprimer une contrainte ou colonne',
                    '<pre><code>-- Supprimer la colonne téléphone\nALTER TABLE employés DROP (telephone);</code></pre>',
                    '<pre>Table altered.\n</pre>',
                    'Attention : la colonne et ses données sont définitivement supprimées.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'drop-and-truncate',
            'title' => 'DROP vs TRUNCATE',
            'icon'  => '🗑️',
            'blocks' => [

                make_definition_block(
                    'DROP TABLE',
                    '<p>La commande <strong>DROP TABLE</strong> supprime complètement la table, sa structure et toutes ses données de la base de données. L\'action est irréversible.</p>',
                    '<p><b>DROP TABLE</b> supprime table complètement structure w données b base de données. Irréversible.</p>'
                ),

                make_definition_block(
                    'TRUNCATE TABLE',
                    '<p>La commande <strong>TRUNCATE TABLE</strong> supprime toutes les lignes d\'une table, mais conserve la structure (schéma) de la table. Elle est plus rapide que DELETE et utilise moins de journalisation.</p>',
                    '<p><b>TRUNCATE TABLE</b> supprime toutes lignes table conserve structure (schéma). Plus rapide que DELETE w moins de journalisation.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'DROP', 'fr' => 'Supprimer', 'darija' => 'Supprimer'],
                    ['kw' => 'TRUNCATE', 'fr' => 'Vider', 'darija' => 'Vider'],
                    ['kw' => 'IRRÉVERSIBLE', 'fr' => 'Irréversible', 'darija' => 'Irréversible'],
                ]),

                make_example_block(
                    'DROP TABLE',
                    '<pre><code>-- Supprimer la table ancienne_cmd\nDROP TABLE ancienne_cmd;</code></pre>',
                    '<pre>Table dropped.\n</pre>',
                    'La table et toutes ses données sont supprimées. Cette action ne peut pas être annulée sans restauration depuis une sauvegarde.'
                ),

                make_example_block(
                    'TRUNCATE TABLE',
                    '<pre><code>-- Vider la table commandes sans la supprimer\nTRUNCATE TABLE commandes;</code></pre>',
                    '<pre>Table truncated.\n</pre>',
                    'Toutes les lignes sont supprimées, mais la table existe toujours avec sa structure initiale.'
                ),

                make_tip_block(
                    'Quand utiliser laquelle ?',
                    '<p>Utilisez <strong>TRUNCATE</strong> lorsque vous voulez vider une table rapidement tout en conservant sa structure (par exemple, réinitialiser des tables de temporisation). Utilisez <strong>DROP</strong> lorsque vous voulez supprimer complètement la table.</p>',
                    '<p>Utilisez <b>TRUNCATE</b> b vider table rapidement en conservant structure. Utilisez <b>DROP</b> supprimer complètement table.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser TRUNCATE dans une transaction non validée',
            'fix'    => 'TRUNCATE est auto-committable : il ne peut pas être annulé par ROLLBACK. Utilisez DELETE si vous avez besoin d\'annulation.',
            'fr'     => 'Contrairement à ce que l\'on pense, TRUNCATE TABLE effectue un COMMIT implicite. Si vous l\'exécutez dans une transaction, vous ne pourrez pas revenir en arrière avec ROLLBACK. Utilisez DELETE FROM si vous avez besoin de pouvoir annuler la suppression.',
            'darija' => 'TRUNCATE TABLE kayCOMMIT implicite. F l\'exécute b transaction, kaylik rollback b3d.'
        ],
        [
            'wrong'  => 'Oublier le point-virgule après DROP TABLE',
            'fix'    => 'Toujours terminer les commandes DDL par un point-virgule en Oracle.',
            'fr'     => 'En Oracle, comme dans la plupart des SGBD, les commandes doivent se terminer par un point-virgule (;). Oublier le point-virgule peut entraîner des erreurs ou l\'exécution partielle de la commande.',
            'darija' => 'Toujours terminer commandes DDL par point-virgule (;). Oublier kaylik erreurs w exécution partielle.'
        ],
    ],

    'summary' => [
        'fr'     => 'CREATE TABLE et CREATE VIEW créent des objets nouveaux. ALTER TABLE modifie la structure existante. DROP TABLE supprime complètement la table, tandis que TRUNCATE TABLE ne supprime que les données mais conserve le schéma. Toujours faire attention : DROP et TRUNCATE sont des opérations irréversibles (ou quasi).',
        'darija' => 'CREATE TABLE w CREATE VIEW kaynouvo objets. ALTER TABLE modifie structure existante. DROP TABLE supprime table complètement, TRUNCATE kaysupprimer données w conserve schéma. Toujours faire attention : DROP w TRUNCATE opérations quasi irréversibles.'
    ],
];