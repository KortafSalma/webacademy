<?php

/**
 * Jeu de données "school" — gestion d'école.
 * Champs 'ddl_sqlite' et 'ddl_mysql' séparés car la syntaxe AUTO_INCREMENT
 * diffère. Les INSERT sont compatibles avec les deux moteurs.
 */

return [
    'id'     => 'school',
    'label'  => 'École (étudiants / profs / notes)',
    'tables' => ['professeur', 'etudiant', 'matiere', 'note'],

    'drop' => [
        'DROP TABLE IF EXISTS note',
        'DROP TABLE IF EXISTS matiere',
        'DROP TABLE IF EXISTS etudiant',
        'DROP TABLE IF EXISTS professeur',
    ],

    'ddl_sqlite' => [
        'CREATE TABLE professeur (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            specialite TEXT
        )',
        'CREATE TABLE etudiant (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            filiere TEXT NOT NULL DEFAULT \'GI\',
            email TEXT UNIQUE
        )',
        'CREATE TABLE matiere (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT UNIQUE,
            coefficient REAL CHECK (coefficient BETWEEN 1 AND 6)
        )',
        'CREATE TABLE note (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            etudiant_id INTEGER NOT NULL,
            matiere_id INTEGER NOT NULL,
            professeur_id INTEGER,
            valeur REAL NOT NULL CHECK (valeur >= 0 AND valeur <= 20),
            date_note TEXT,
            FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
            FOREIGN KEY (matiere_id) REFERENCES matiere(id)
        )',
        'CREATE INDEX idx_note_etudiant ON note (etudiant_id)',
    ],

    'ddl_mysql' => [
        'CREATE TABLE IF NOT EXISTS professeur (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(40) NOT NULL,
            prenom VARCHAR(40) NOT NULL,
            specialite VARCHAR(40)
        )',
        'CREATE TABLE IF NOT EXISTS etudiant (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(40) NOT NULL,
            prenom VARCHAR(40) NOT NULL,
            filiere VARCHAR(30) NOT NULL DEFAULT \'GI\',
            email VARCHAR(60) UNIQUE
        )',
        'CREATE TABLE IF NOT EXISTS matiere (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(40) UNIQUE,
            coefficient DECIMAL(3,1) CHECK (coefficient BETWEEN 1 AND 6)
        )',
        'CREATE TABLE IF NOT EXISTS note (
            id INT AUTO_INCREMENT PRIMARY KEY,
            etudiant_id INT NOT NULL,
            matiere_id INT NOT NULL,
            professeur_id INT,
            valeur DECIMAL(4,2) NOT NULL CHECK (valeur >= 0 AND valeur <= 20),
            date_note DATE,
            FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
            FOREIGN KEY (matiere_id) REFERENCES matiere(id)
        )',
        'CREATE INDEX idx_note_etudiant ON note (etudiant_id)',
    ],

    'data' => [
        'INSERT INTO professeur (nom, prenom, specialite) VALUES
            ("Abdellah", "Yassine", "Mathematique"),
            ("Bounou", "Samira", "Programmation PHP"),
            ("Lahlou", "Karim", "Bases de donnees")',
        'INSERT INTO matiere (nom, coefficient) VALUES
            ("Math", 4.0), ("PHP", 3.0), ("Base de donnees", 3.0), ("Anglais", 2.0)',
        'INSERT INTO etudiant (nom, prenom, filiere, email) VALUES
            ("Kortaf", "Salma", "GI", "salma@example.ma"),
            ("Marzak", "Hiba", "GI", "hiba@example.ma"),
            ("Boukhriss", "Omar", "GC", "omar@example.ma"),
            ("Sekkat", "Leila", "GI", "leila@example.ma"),
            ("Tazi", "Anas", "3IA", "anas@example.ma")',
        'INSERT INTO note (etudiant_id, matiere_id, professeur_id, valeur, date_note) VALUES
            (1, 1, 1, 14.5, "2026-01-12"),
            (1, 2, 2, 16.0, "2026-01-14"),
            (1, 3, 3, 15.0, "2026-01-15"),
            (2, 1, 1, 17.0, "2026-01-12"),
            (2, 2, 2, 12.5, "2026-01-14"),
            (3, 1, 1, 9.0,  "2026-01-12"),
            (3, 4, NULL, 13.0, "2026-01-13"),
            (4, 2, 2, 18.5, "2026-01-14"),
            (5, 1, 1, 11.0, "2026-01-12"),
            (5, 3, 3, 11.8, "2026-01-15")',
    ],
];

