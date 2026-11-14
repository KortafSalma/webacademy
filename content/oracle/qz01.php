<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch1 — Introduction à Oracle Database et Oracle XE.
 * 10 questions : mcq, fill, true_ford, find-error, predict.
 */

return [
    'title' => 'Quiz — Introduction à Oracle Database et Oracle XE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel est l\'édition gratuite d\'Oracle Database destinée à l\'apprentissage ?',
            'options' => ['Enterprise Edition', 'Standard Edition', 'Express Edition (XE)', 'Personal Edition'],
            'answer'  => 2,
            'concept' => 'Éditions Oracle',
            'explainFr' => 'L\'édition XE est la version gratuite d\'Oracle Database, idéale pour apprendre et développer.',
            'explainDarija' => 'Edition XE howa version gratuite Oracle Database ideal b lernen w developpez.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot de passe par défaut de l\'utilisateur SYSTEM à l\'installation de XE est ________.',
            'expected'=> 'Manager',
            'accept'  => ['Manager', 'manager'],
            'concept' => 'Installation XE',
            'explainFr' => 'Le mot de passe par défaut de SYSTEM est Manager, tel que défini par Oracle lors de l\'installation.',
            'explainDarija' => 'Mot de passe par défaut SYSTEM howa Manager b3d installation XE.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Le rôle SYS est réservé à l\'administration experte de la base de données.',
            'answer'  => 1,
            'concept' => 'Rôle SYS',
            'explainFr' => 'En effet, le rôle SYS possède tous les privilèges système et contrôle la base en totalité. Il s\'adresse aux administrateurs experts.',
            'explainDarija' => 'B3d role SYS kaylik tous les privileges system w control base b total kaylik admin expert.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur dans cette commande : CREATE USER salam IDENTIFIED BY password123 DEFAULT TABLESPACE USERS',
            'options' => ['CREATE USER', 'IDENTIFIED BY password123', 'DEFAULT TABLESPACE USERS', 'Il n\'y a pas d\'erreur'],
            'answer'  => 3,
            'concept' => 'Syntaxe CREATE USER',
            'explainFr' => 'La syntaxe est correcte. La commande CREATE USER avec IDENTIFIED BY et DEFAULT TABLESPACE est valide en Oracle.',
            'explainDarija' => 'Syntaxe correcte. CREATE USER avec IDENTIFIED BY w DEFAULT TABLESPACE kay valid f Oracle.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la commande suivante ? SET SERVEROUTPUT ON ; BEGIN DBMS_OUTPUT.PUT_LINE(\'Test\'); END ;',
            'options' => ['Test s\'affiche', 'Rien ne s\'affiche', 'Erreur Oracle', 'Commande invalide'],
            'answer'  => 0,
            'concept' => 'SET SERVEROUTPUT ON',
            'explainFr' => 'La commande SET SERVEROUTPUT ON active l\'affichage. La PL/SQL block affichera "Test".',
            'explainDarija' => 'SET SERVEROUTPUT ON active affichage. PL/SQL block kay affich "Test".',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel attribut permet de déclarer une variable ayant le même type qu\'une colonne existante d\'une table ?',
            'options' => ['%ROWTYPE', '%TYPE', '::TYPE', '@COLUMN'],
            'answer'  => 1,
            'concept' => 'Attributs %TYPE/%ROWTYPE',
            'explainFr' => 'L\'attribut %TYPE permet de typiser une variable d\'après une colonne existante, garantissant la compatibilité si le type change.',
            'explainDarija' => 'Attribut %TYPE kay typiser variable b colonne existante garanti compatibilité si type change.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La fonction NVL(valeur, remplacement) remplace une valeur NULL par la ________.',
            'expected'=> 'valeur de remplacement',
            'accept'  => ['valeur de remplacement', 'remplacement'],
            'concept' => 'NVL et COALESCE',
            'explainFr' => 'La fonction NVL remplace une valeur NULL par la valeur de remplacement spécifiée en second argument.',
            'explainDarija' => 'NVL remplace NULL par valeur remplacement spécifiée.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Deux lignes peuvent avoir NULL dans une colonne UNIQUE : NULL est considéré comme une valeur en soi.',
            'answer'  => 0,
            'concept' => 'Contrainte UNIQUE',
            'explainFr' => 'Faux : En Oracle, NULL n\'est pas considéré comme une valeur égale à une autre NULL. Deux lignes peuvent donc toutes deux contenir NULL dans une colonne contrainte UNIQUE.',
            'explainDarija' => 'Faux : NULL pas considéré valeur égale NULL. Deux lignes kaylik contenir NULL colonne UNIQUE.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel opérateur permet de tester si une valeur appartient à une liste de valeursKnown ?',
            'options' => ['BETWEEN', 'LIKE', 'IN', 'ANY'],
            'answer'  => 2,
            'concept' => 'Opérateur IN',
            'explainFr' => 'L\'opérateur IN permet de tester si une valeur appartient à une liste de valeurs connues, c\'est plus concis que plusieurs conditions OR.',
            'explainDarija' => 'IN kay tester valeur appartient liste valeursKnown kay plus concis que plusieurs OR.',
        ],

    ],
];