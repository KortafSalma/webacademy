<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch6 — Bases de données relationnelles et tables.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Bases de données relationnelles et tables',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel type de données stocke des chaînes de caractères de longueur variable en Oracle ?',
            'options' => ['CHAR', 'VARCHAR2', 'NUMBER', 'DATE'],
            'answer'  => 1,
            'concept' => 'Types de données',
            'explainFr' => 'VARCHAR2 est le type standard pour les chaînes de caractères variables en Oracle.',
            'explainDarija' => 'VARCHAR2 standard Oracle kay chaînes caractères variables.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La contrainte qui interdit les valeurs NULL s\'appelle ________.',
            'expected'=> 'NOT NULL',
            'accept'  => ['NOT NULL', 'not null'],
            'concept' => 'Contraintes',
            'explainFr' => 'NOT NULL interdit les valeurs NULL dans la colonne spécifiée.',
            'explainDarija' => 'NOT NULL interdit NULL colonne spécifiée.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une clé primaire doit contenir des valeurs uniques et ne pas permettre de NULL.',
            'answer'  => 1,
            'concept' => 'Clé primaire',
            'explainFr' => 'Vrai : La clé primaire combine les propriétés de NOT NULL et d\'UNIQUE.',
            'explainDarija' => 'Vrai : Clé primaire combine NOT NULL + UNIQUE.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : CREATE TABLE t (id NUMBER, nom VARCHAR2(50) PRIMARY KEY)',
            'options' => ['id NUMBER', 'nom VARCHAR2(50) PRIMARY KEY', 'Il n\'y a pas d\'erreur', 'Les deux sont des erreurs'],
            'answer'  => 3,
            'concept' => 'Syntaxe CREATE TABLE',
            'explainFr' => 'La syntaxe est correcte : id NUMBER suivi de nom VARCHAR2(50) avec PRIMARY KEY sur nom.',
            'explainDarija' => 'Syntaxe correcte : id NUMBER w nom VARCHAR2(50) PRIMARY KEY sur nom.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Quel sera le résultat de CREATE TABLE t (id NUMBER PRIMARY KEY) ?',
            'options' => ['Table créée avec succès', 'Erreur de clé en double', 'Erreur de type de données', 'Requête incomplète'],
            'answer'  => 0,
            'concept' => 'Syntaxe CREATE TABLE',
            'explainFr' => 'La commande CREATE TABLE s\'exécutera avec succès et créera la table avec la clé primaire spécifiée.',
            'explainDarija' => 'Commande CREATE TABLE s\'exécutera succès kaylik créer table clé primaire spécifié.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Combien de colonnes la table CREATE TABLE emp (emp_id NUMBER PRIMARY KEY, emp_name VARCHAR2(100), salaire NUMBER) possède-t-elle ?',
            'options' => ['2', '3', '4', '5'],
            'answer'  => 1,
            'concept' => 'Syntaxe CREATE TABLE',
            'explainFr' => 'La table possède 3 colonnes : emp_id, emp_name, salaire.',
            'explainDarija' => 'Table possède 3 colonnes : emp_id emp_name salaire.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot-clé qui garantit l\'unicité des valeurs d\'une colonne s\'appelle ________.',
            'expected'=> 'UNIQUE',
            'accept'  => ['UNIQUE', 'unique'],
            'concept' => 'Contrainte UNIQUE',
            'explainFr' => 'La contrainte UNIQUE garantit que toutes les valeurs d\'une colonne sont différentes.',
            'explainDarija' => 'UNIQUE garantit valeurs colonne différentes.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Deux lignes peuvent avoir NULL dans une colonne UNIQUE : NULL n\'est pas considéré comme une valeur égale à une autre NULL.',
            'answer'  => 1,
            'concept' => 'Contrainte UNIQUE',
            'explainFr' => 'Vrai : En Oracle, NULL n\'est pas considéré comme une valeur égale. Plusieurs lignes peuvent contenir NULL dans une colonne contrainte UNIQUE.',
            'explainDarija' => 'Vrai : NULL pas considéré valeur égale.Plusieurs lignes kaylik contenir NULL colonne UNIQUE.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel type de données utiliser pour stocker un prix avec 2 décimales ?',
            'options' => ['NUMBER', 'VARCHAR2', 'DATE', 'CLOB'],
            'answer'  => 0,
            'concept' => 'Types de données',
            'explainFr' => 'NUMBER(10,2) permet de stocker un nombre avec 2 décimales de précision.',
            'explainDarija' => 'NUMBER(10,2) stocke nombre 2 décimales précision.',
        ],

    ],
];