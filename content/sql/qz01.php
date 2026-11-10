<?php

declare(strict_types=1);

/**
 * Quiz du chapitre sql-ch1 — Fondamentaux des bases de données.
 * 5 questions : MCQ, fill, et vrai/faux.
 */

return [
    'title' => 'Quiz — Fondamentaux des bases de données',
    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La commande CREATE sert à :',
            'options' => ['Créer une base de données', 'Créer une table', 'Insérer des données', 'Modifier une structure'],
            'answer'  => 1,
            'concept' => 'Commandes SQL',
            'explainFr' => 'La commande CREATE sert à créer une nouvelle base de données ou une nouvelle table.',
            'explainDarija' => 'Commande CREATE kay9der créer base de données w table nouvelle.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La commande qui permet de supprimer une table s\'appelle ________.',
            'expected'=> 'DROP',
            'accept'  => ['DROP', 'drop', 'DROP TABLE'],
            'concept' => 'Commandes SQL',
            'explainFr' => 'La commande DROP permet de supprimer entièrement une table ou une base de données.',
            'explainDarija' => 'Commande DROP kay9der supprimer entièrement table w base de données.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'La clause WHERE est facultative dans une commande SELECT.',
            'answer'  => 0,
            'concept' => 'Clauses SQL',
            'explainFr' => 'Faux : La clause WHERE est optionnelle, mais elle est souvent utilisée pour filtrer les résultats.',
            'explainDarija' => 'Faux : clause WHERE optionnelle bach souvent utilisée filtrer résultats.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Lequel de ces types de données stocke des chaînes de caractères de longueur variable ?',
            'options' => ['INTEGER', 'VARCHAR', 'DATE', 'BOOLEAN'],
            'answer'  => 1,
            'concept' => 'Types de données',
            'explainFr' => 'VARCHAR stocke des chaînes de caractères de longueur variable.',
            'explainDarija' => 'VARCHAR kay9der stocke chaînes caractères longueur variable.',
        ],

        [
            'type'    => 'multi',
            'question'=> 'Lesquelles des commandes suivantes sont des commandes DDL ?',
            'options' => ['SELECT', 'INSERT', 'CREATE', 'DROP'],
            'answer'  => [2, 3],
            'concept' => 'Commandes DDL',
            'explainFr' => 'CREATE et DROP sont des commandes DDL (Data Definition Language).',
            'explainDarija' => 'CREATE w DROP kay9der commandes DDL (Data Definition Language).',
        ],
    ],
];