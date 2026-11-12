<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch7 — CREATE, ALTER, DROP et TRUNCATE.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex9',
    'title' => 'Exercices — Langage DDL : CREATE, ALTER, DROP, TRUNCATE',
    'brief' => 'Création, modification et suppression d\'objets de base de données.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE TABLE',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande CREATE TABLE crée une table "produits" avec id NUMBER PRIMARY KEY et nom VARCHAR2(100) ?</p>',
            'instructionsDarija' => '<p>Kay CREATE TABLE kaynouvo table "produits" id NUMBER PRIMARY KEY nom VARCHAR2(100) ?</p>',
            'starter' => 'CREATE TABLE produits (id NUMBER PRIMARY KEY, nom VARCHAR2(100))',
            'hints' => [
                'Commencez par CREATE TABLE suivi du nom de table.',
                'Ajoutez les colonnes entre parenthèses.',
            ],
            'solution' => 'CREATE TABLE produits (id NUMBER PRIMARY KEY, nom VARCHAR2(100))',
            'explainFr' => 'La commande CREATE TABLE crée une nouvelle table avec les colonnes spécifiées.',
            'explainDarija' => 'CREATE TABLE kaynouvo table colonnes spécifiées.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — CREATE VIEW',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande CREATEVIEW crée une vue nom "vue_clients" à partir d\'une SELECT ?</p>',
            'instructionsDarija' => '<p>Kay CREATEVIEW kaynouvo vue "vue_clients" b SELECT ?</p>',
            'starter' => 'CREATE VIEW vue_clients AS SELECT id, nom FROM clients',
            'hints' => [
                'CREATE VIEW suivi du nom de vue AS SELECT.',
                'La requête SELECT définit le contenu de la vue.',
            ],
            'solution' => 'CREATE VIEW vue_clients AS SELECT id, nom FROM clients',
            'explainFr' => 'CREATE VIEW crée une table virtuelle basée sur le résultat d\'une requête SELECT.',
            'explainDarija' => 'CREATE VIEW table virtuelle b résultat requête SELECT.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — ALTER TABLE ajouter colonne',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande ALTER TABLE ajoute une colonne "email" VARCHAR2(100) à la table "clients" ?</p>',
            'instructionsDarija' => '<p>Kay ALTER TABLE kay ajoute colonne "email" VARCHAR2(100) table "clients" ?</p>',
            'starter' => 'ALTER TABLE clients ADD (email VARCHAR2(100))',
            'hints' => [
                'ALTER TABLE suivi du nom de table ADD colonne.',
                'Les nouvelles colonnes sont ajoutées à la fin.',
            ],
            'solution' => 'ALTER TABLE clients ADD (email VARCHAR2(100))',
            'explainFr' => 'ALTER TABLE modifie la structure d\'une table existante en ajoutant une colonne.',
            'explainDarija' => 'ALTER TABLE modifie structure table existante ajout colonne.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — DROP TABLE',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle est la différence principale entre DROP TABLE et TRUNCATE TABLE ?</p>',
            'instructionsDarija' => '<p>Kay difference principale DROP TABLE w TRUNCATE TABLE ?</p>',
            'starter' => 'DROP supprime structure, TRUNCATE vide données seulement',
            'hints' => [
                'DROP TABLE supprime complètement la table et ses données.',
                'TRUNCATE TABLE supprime uniquement les lignes mais conserve la structure.',
            ],
            'solution' => 'DROP TABLE supprime complètement la table (irrécupérable). TRUNCATE TABLE ne supprime que les données, conserve le schéma.',
            'explainFr' => 'DROP supprime la table et toutes ses données de façon définitive. TRUNCATE ne supprime que les lignes mais garde la structure de la table.',
            'explainDarija' => 'DROP supprime table données définitive. TRUNCATE vide données conserve structure.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — TRUNCATE vs DELETE',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans quelles circonstances utilisez-vous TRUNCATE au lieu de DELETE ?</p>',
            'instructionsDarija' => '<p>Kayf circonstances utilisez TRUNCATE au lieu DELETE ?</p>',
            'starter' => 'Vider table rapidement w conservation structure',
            'hints' => [
                'TRUNCATE est plus rapide que DELETE.',
                'TRUNCATE effectue un COMMIT implicite et ne peut pas être annulé.',
            ],
            'solution' => 'Utilisez TRUNCATE pour vider une table rapidement en conservant sa structure, mais attention : impossible d\'annuler avec ROLLBACK.',
            'explainFr' => 'TRUNCATE est plus efficace que DELETE pour vider une grande table, mais il est auto-committable et ne peut pas être annulé.',
            'explainDarija' => 'TRUNCATE plus efficace DELETE vider grande table, mais auto-committable kaylik kayknwal annulé ROLLBACK.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];