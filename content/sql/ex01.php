<?php

declare(strict_types=1);

/**
 * Exercices du chapitre sql-ch1 — Fondamentaux des bases de données.
 * Schéma OBLIGATOIRE : 3 niveaux (Débutant, Intermédiaire, Avancé).
 */

return [
    'id'    => 'sql-ex1',
    'title' => 'Fondamentaux des bases de données',
    'brief' => 'Manipule des bases de données SQL de base.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — crée une table simple',
            'lang'  => 'sql',
            'instructions' => '<p>Crée une table <code>utilisateurs</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>nom VARCHAR(50)</code> et <code>email VARCHAR(100) UNIQUE</code>. Supprime d\'abord la table si elle existe, puis vérifie son nom dans <code>sqlite_master</code>.</p>',
            'instructionsDarija' => '<p>5leq table <code>utilisateurs</code> b <code>id INTEGER PRIMARY KEY</code>, <code>nom VARCHAR(50)</code> w <code>email VARCHAR(100) UNIQUE</code>. 7yed table lwel ila kant kayna, men ba3d t7eqqeq smiya f <code>sqlite_master</code>.</p>',
            'starter' => '-- DROP puis CREATE TABLE
',
            'tests' => [
                ['type' => 'sql_ok', 'value' => ''],
                ['type' => 'result_has', 'value' => 'utilisateurs'],
            ],
            'hints' => [
                'Utilise DROP TABLE IF EXISTS pour repartir d\'une base propre.',
                'Utilise INTEGER pour l\'identifiant et PRIMARY KEY pour en faire la clé primaire.',
                'Utilise VARCHAR pour les champs de texte et UNIQUE pour l\'email.',
            ],
            'solution' => 'DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs (
    id INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    email VARCHAR(100) UNIQUE
);

SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'utilisateurs\';',
            'explainFr' => 'La table <code>utilisateurs</code> est créée avec les colonnes demandées. <code>DROP TABLE IF EXISTS</code> rend le script rejouable sans erreur.',
            'explainDarija' => 'Table <code>utilisateurs</code> tcreat b colonnes demandées. <code>DROP TABLE IF EXISTS</code> kay5elli script yt3awed bla erreur.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — insère des données',
            'lang'  => 'sql',
            'instructions' => '<p>Insère un nouvel étudiant dans la table <code>etudiant</code> du jeu de données <code>school</code> : nom <code>Alice</code>, prénom <code>Martin</code>, filière <code>GI</code>, email <code>alice@example.com</code>. Utilise <code>INSERT OR IGNORE</code> pour rester idempotent, puis vérifie la ligne avec un <code>SELECT</code>.</p>',
            'instructionsDarija' => '<p>Dkhel etudiant jdid f table <code>etudiant</code> dyal dataset <code>school</code> : nom <code>Alice</code>, prenom <code>Martin</code>, filiere <code>GI</code>, email <code>alice@example.com</code>. Kheddem <code>INSERT OR IGNORE</code> bach ma t3awedch la ligne, men ba3d t7eqqeq b <code>SELECT</code>.</p>',
            'starter' => '-- INSERT OR IGNORE puis SELECT
',
            'tests' => [
                ['type' => 'sql_ok', 'value' => ''],
                ['type' => 'result_has', 'value' => ['Alice', 'alice@example.com']],
            ],
            'hints' => [
                'La colonne email est UNIQUE : INSERT OR IGNORE évite l\'erreur si la ligne existe déjà.',
                'Respecte l\'ordre des colonnes : nom, prenom, filiere, email.',
                'Termine par un SELECT pour vérifier la ligne insérée.',
            ],
            'solution' => 'INSERT OR IGNORE INTO etudiant (nom, prenom, filiere, email)
VALUES (\'Alice\', \'Martin\', \'GI\', \'alice@example.com\');

SELECT nom, email FROM etudiant WHERE email = \'alice@example.com\';',
            'explainFr' => '<code>INSERT OR IGNORE</code> ajoute Alice une seule fois grâce à la contrainte <code>UNIQUE</code> sur l\'email. Le <code>SELECT</code> confirme la présence de la ligne.',
            'explainDarija' => '<code>INSERT OR IGNORE</code> kayzid Alice mara wa7da b grâce l contrainte <code>UNIQUE</code> 3la email. <code>SELECT</code> kayverifi belli ligne kayna.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — requête de sélection avec filtres',
            'lang'  => 'sql',
            'instructions' => '<p>Sélectionne tous les champs de la table <code>etudiant</code> dont l\'email se termine par <code>@example.ma</code>, puis classe les résultats par nom dans l\'ordre alphabétique croissant.</p>',
            'instructionsDarija' => '<p>Seleksyoni tous champs table <code>etudiant</code> li email dyalhom kaytemm b <code>@example.ma</code>, men ba3d orderi résultats b nom f ordre alphabétique croissant.</p>',
            'starter' => 'SELECT /* votre code */
FROM etudiant
WHERE /* votre code */
ORDER BY /* votre code */;
',
            'tests' => [
                ['type' => 'sql_ok', 'value' => ''],
                ['type' => 'row_count', 'value' => 5],
                ['type' => 'result_has', 'value' => ['Boukhriss', 'Omar']],
                ['type' => 'result_has', 'value' => ['Tazi', 'Anas']],
            ],
            'hints' => [
                'Utilise SELECT * pour sélectionner tous les champs.',
                'Utilise WHERE email LIKE \'%@example.ma\' pour filtrer sur la fin de l\'email.',
                'Utilise ORDER BY nom ASC pour trier par nom de A à Z.',
            ],
            'solution' => 'SELECT *
FROM etudiant
WHERE email LIKE \'%@example.ma\'
ORDER BY nom ASC;',
            'explainFr' => 'Le <code>LIKE \'%@example.ma\'</code> garde les cinq étudiants du jeu de données, puis <code>ORDER BY nom ASC</code> les trie de Boukhriss à Tazi.',
            'explainDarija' => '<code>LIKE \'%@example.ma\'</code> kay5elli khamsa dyal etudiants, w <code>ORDER BY nom ASC</code> kayrtebbhom men Boukhriss l Tazi.',
        ],
    ],

    'dataset' => 'school',
    'dialect' => 'sqlite',
];
