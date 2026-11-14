<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch16 — Contraintes : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Contraintes : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La contrainte qui interdit les valeurs NULL s\'appelle :',
            'options' => ['NOT NULL', 'UNIQUE', 'PRIMARY KEY', 'CHECK'],
            'answer'  => 0,
            'concept' => 'Contrainte NOT NULL',
            'explainFr' => 'NOT NULL interdit les valeurs NULL dans la colonne spécifiée.',
            'explainDarija' => 'NOT NULL interdit NULL colonne spécifiée.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La contrainte qui garantit l\'unicité des valeurs d\'une colonne s\'appelle ________.',
            'expected' => 'UNIQUE',
            'accept' => ['UNIQUE', 'unique'],
            'concept' => 'Contrainte UNIQUE',
            'explainFr' => 'La contrainte UNIQUE garantit que toutes les valeurs d\'une colonne sont différentes.',
            'explainDarija' => 'UNIQUE garantit valeurs colonne différentes.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Deux lignes peuvent avoir NULL dans une colonne UNIQUE : NULL n\'est pas considéré comme une valeur égale.',
            'answer'  => 1,
            'concept' => 'Contrainte UNIQUE',
            'explainFr' => 'Vrai : En Oracle, NULL n\'est pas considéré comme une valeur égale. Plusieurs lignes peuvent contenir NULL dans une colonne contrainte UNIQUE.',
            'explainDarija' => 'Vrai : NULL pas considéré valeur égale.Plusieurs lignes kaylik contenir NULL colonne UNIQUE.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : CREATE TABLE t (id NUMBER PRIMARY KEY, nom VARCHAR2(50) NOT NULL UNIQUE)',
            'options' => ['PASSEPARTOUT', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Multiple PRIMARY KEY'],
            'answer' => 2,
            'concept' => 'Syntaxe CREATE TABLE',
            'explainFr' => 'La syntaxe est correcte : id NUMBER PRIMARY KEY, nom VARCHAR2(50) NOT NULL UNIQUE est valide.',
            'explainDarija' => 'Syntaxe correcte PRIMARY KEY nom VARCHAR2(50) NOT NULL UNIQUE valide.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que se passera-t-il si l\'on essaie d\'insérer une ligne avec NULL dans une colonne NOT NULL ?',
            'options' => ['L\'insertion réussira', 'L\'insertion sera rejetée avec une erreur', 'La valeur NULL sera remplacée par 0', 'Aucun effet'],
            'answer' => 1,
            'concept' => 'Contrainte NOT NULL',
            'explainFr' => 'L\'insertion sera rejetée car la colonne ne peut pas contenir de NULL.',
            'explainDarija' => 'Insertion rejetée colonne ne peut pas NULL.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'La contrainte qui crée une relation entre deux tables en referencing la clé primaire d\'une autre table s\'appelle :',
            'options' => ['NOT NULL', 'UNIQUE', 'FOREIGN KEY', 'CHECK'],
            'answer' => 2,
            'concept' => 'Contrainte FOREIGN KEY',
            'explainFr' => 'FOREIGN KEY établit une relation de référence entre deux tables.',
            'explainDarija' => 'FOREIGN KEY établit relation référence entre tables.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La contrainte qui garantit qu\'une valeur dans la colonne étrangère doit exister en tant que clé primaire dans la table référencée s\'appelle ________.',
            'expected' => 'FOREIGN KEY',
            'accept' => ['FOREIGN KEY', 'Foreign Key'],
            'concept' => 'Contrainte FOREIGN KEY',
            'explainFr' => 'FOREIGN KEY garantit l\'intégrité référentielle entre tables.',
            'explainDarija' => 'FOREIGN KEY garantit intégrité référentielle entre tables.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une clé étrangère peut contenir des valeurs NULL.',
            'answer' => 1,
            'concept' => 'Contrainte FOREIGN KEY',
            'explainFr' => 'Vrai : La colonne étrangère peut contenir des valeurs NULL ou des valeurs qui existent en tant que PRIMARY KEY dans la table référencée.',
            'explainDarija' => 'Vrai : Colonnes étrangères peuvent contenir NULL valeurs existant PRIMARY KEY table référencée.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces contraintes s\'applique lors de la création de la table avec CREATE TABLE ?',
            'options' => ['NOT NULL', 'UNIQUE', 'PRIMARY KEY', 'Toutes les réponses ci-dessus'],
            'answer' => 3,
            'concept' => 'CREATE TABLE contraintes',
            'explainFr' => 'Toutes ces contraintes peuvent être définies au sein d\'une commande CREATE TABLE.',
            'explainDarija' => 'Toutes ces contraintes peuvent être définies CREATE TABLE.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La contrainte qui impose qu\'une condition doit être respectée par les valeurs d\'une colonne s\'appelle ________.',
            'expected' => 'CHECK',
            'accept' => ['CHECK', 'check'],
            'concept' => 'Contrainte CHECK',
            'explainFr' => 'CHECK permet de spécifier une condition que les valeurs doivent respecter.',
            'explainDarija' => 'CHECK impose condition valeurs doivent respecter.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'La contrainte CHECK peut accepter plusieurs conditions dans la même colonne.',
            'answer' => 0,
            'concept' => 'Contrainte CHECK',
            'explainFr' => 'Faux : Une colonne ne peut avoir qu\'une seule contrainte CHECK. Pour plusieurs conditions, on peut les combiner avec AND/OR au sein de la même contrainte.',
            'explainDarija' => 'Faux : Une colonne une seule contrainte CHECK. Plusieurs conditions combiner AND/OR au sein meme contrainte.',
        ],

    ],
];