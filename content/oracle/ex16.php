<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch16 �?" Constraints : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex16',
    'title' => 'Exercices — Constraints : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL',
    'brief' => 'Ma�trisez les contraintes dint�grit� des donn�es Oracle.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Initieur — NOT NULL et INSERT',
            'lang'  => 'oracle',
            'instructions' => '<p>Que se passe t il si lon essaie d insrer une ligne sans valeur dans une colonne NOT NULL ?</p>',
            'instructionsDarija' => '<p>Kay n9der insert ligne valeur kolonne NOT NULL ?</p>',
            'starter' => '-- Essayer : INSERT INTO utilisateurs (id, nom) VALUES (1, NULL);',
            'hints' => [
                'La contrainte NOT NULL empêche linsertion de NULL.',
                'La colonne doit toujours avoir une valeur valide.',
            ],
            'solution' => 'Linsertion echoue : erreur ORACLE 1400, colonne NULL dans contrainte NOT NULL.',
            'explainFr' => 'La contrainte NOT NULL interdit linsertion de NULL dans la colonne concern�e. Chaque ligne doit y avoir une valeur.',
            'explainDarija' => 'Contrainte NOT NULL yedik NULL insertion colonne kay concerns. B3d value valid kayna.',
        ],

        [
            'level' => 2,
            'title' => 'Interm�diaire — UNIQUE sur email',
            'lang'  => 'oracle',
            'instructions' => '<p>Ajoutez une contrainte UNIQUE sur la colonne email de la table utilisateurs existante.</p>',
            'instructionsDarija' => '<p>UNIQUE constraint add email colonne utilisateurs table.</p>',
            'starter' => 'ALTER TABLE utilisateurs ADD CONSTRAINT uk_email UNIQUE (email);',
            'hints' => [
                'La contrainte UNIQUE garantit des valeurs uniques.',
                'Les valeurs NULL sont consid�r�es comme diff�rentes les unes des autres.',
            ],
            'solution' => 'ALTER TABLE utilisateurs ADD CONSTRAINT uk_email UNIQUE (email);',
            'explainFr' => 'La contrainte UNIQUE assure que toutes les valeurs de la colonne sont diff�rentes. Deux lignes peuvent avoir NULL.',
            'explainDarija' => 'Contrainte UNIQUE garantit valeurs uniques. Multiple NULL considered different.',
        ],

        [
            'level' => 3,
            'title' => 'Interm�diaire — PRIMARY KEY sur id',
            'lang'  => 'oracle',
            'instructions' => '<p>Creez une table employ�s avec id comme PRIMARY KEY, nom en NOT NULL et salaire en NUMBER.</p>',
            'instructionsDarija' => '<p>Table employ�s creation id PRIMARY KEY, nom NOT NULL, salaire NUMBER.</p>',
            'starter' => 'CREATE TABLE employ�s (id NUMBER PRIMARY KEY, nom VARCHAR2(100) NOT NULL, salaire NUMBER);',
            'hints' => [
                'PRIMARY KEY combine NOT NULL et UNIQUE.',
                'Chaque ligne doit avoir une valeur PRIMARY KEY unique et non nulle.',
            ],
            'solution' => 'CREATE TABLE employ�s (id NUMBER PRIMARY KEY, nom VARCHAR2(100) NOT NULL, salaire NUMBER);',
            'explainFr' => 'La PRIMARY KEY identifie de fa�on unique chaque ligne. Elle interdit NULL et garantit lunicit�.',
            'explainDarija' => 'PRIMARY KEY unique chaque ligne. Hilal NULL garantir unicit�.',
        ],

        [
            'level' => 4,
            'title' => 'Interm�diaire — CHECK sur le salaire',
            'lang'  => 'oracle',
            'instructions' => '<p>Ajoutez une contrainte CHECK s assurant que le salaire est positif.</p>',
            'instructionsDarija' => '<p>CHECK constraint salaire positif add.</p>',
            'starter' => 'ALTER TABLE employ�s ADD CONSTRAINT ck_salaire_positif CHECK (salaire > 0);',
            'hints' => [
                'La contrainte CHECK impose une condition sur les valeurs.',
                'La condition doit �tre vraie pour que insertion ou mise � jour russuive.',
            ],
            'solution' => 'ALTER TABLE employ�s ADD CONSTRAINT ck_salaire_positif CHECK (salaire > 0);',
            'explainFr' => 'La contrainte CHECK v�rifie que la condition (salaire > 0) est vraie. Sinon, l operation est rejet�e.',
            'explainDarija' => 'CHECK condition v rifier vraie. Sinon operation rejet�e.',
        ],

        [
            'level' => 5,
            'title' => 'Avanc� — Supprimer une contrainte',
            'lang'  => 'oracle',
            'instructions' => '<p>Supprimez la contrainte CHECK ck_salaire_positif de la table employ�s.</p>',
            'instructionsDarija' => '<p>Contrainte CHECK ck_salaire_positif supprimer.</p>',
            'starter' => 'ALTER TABLE employ�s DROP CONSTRAINT ck_salaire_positif;',
            'hints' => [
                'Utilisez ALTER TABLE ... DROP CONSTRAINT.',
                'Le nom de la contrainte doit �tre exact.',
            ],
            'solution' => 'ALTER TABLE employ�s DROP CONSTRAINT ck_salaire_positif;',
            'explainFr' => 'La commande DROP CONSTRAINT supprime une contrainte existante de la table.',
            'explainDarija' => 'DROP CONSTRAINT supprimer constraint existante table.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];