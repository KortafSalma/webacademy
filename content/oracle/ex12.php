<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch10 — Types de données Oracle et valeurs NULL.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex12',
    'title' => 'Exercices — Types de données et NULL',
    'brief' => 'Typologie des données Oracle et gestion de la valeur NULL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Type VARCHAR2',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel type de données utilisez-vous pour une chaîne de caractères de 50 caractères en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay type données chaîne 50 caractères f Oracle ?</p>',
            'starter' => 'VARCHAR2(50)',
            'hints' => [
                'VARCHAR2 est le type de chaîne en Oracle.',
                'Spécifiez la longueur entre parenthèses.',
            ],
            'solution' => 'VARCHAR2(50)',
            'explainFr' => 'VARCHAR2(50) stocke des chaînes de jusqu\'à 50 caractères.',
            'explainDarija' => 'VARCHAR2(50) stocke chaînes jusqu\'à 50 caractères.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Type NUMBER',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel type stocke un nombre entier ou décimal en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay type stocke nombre entier décimal f Oracle ?</p>',
            'starter' => 'NUMBER',
            'hints' => [
                'NUMBER stocke les nombres entiers et décimaux.',
                'On peut préciser la précision : NUMBER(10,2).',
            ],
            'solution' => 'NUMBER',
            'explainFr' => 'NUMBER stocke les nombres entiers et décimaux.',
            'explainDarija' => 'NUMBER stocke nombres entier décimal.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Type DATE',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel type de données stocke la date et l\'heure en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay type données stocke date heure f Oracle ?</p>',
            'starter' => 'DATE',
            'hints' => [
                'DATE stocke la date et/ou l\'heure.',
                'Par défaut, utilisez SYSDATE pour la date courante.',
            ],
            'solution' => 'DATE',
            'explainFr' => 'TYPE DATE stocke la date et/ou l\'heure.',
            'explainDarija' => 'TYPE DATE stocke date heure.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Tester NULL avec IS NULL',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle clause SQL permet de tester si une valeur est NULL ?</p>',
            'instructionsDarija' => '<p>Kay clause SQL tester valeur NULL ?</p>',
            'starter' => 'WHERE email IS NULL',
            'hints' => [
                'Ne jamais utiliser = NULL.',
                'Utilisez toujours IS NULL ou IS NOT NULL.',
            ],
            'solution' => 'WHERE email IS NULL',
            'explainFr' => 'IS NULL teste l\'absence de valeur dans une colonne.',
            'explainDarija' => 'IS NULL absence valeur colonne.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Comparaison NULL',
            'lang'  => 'oracle',
            'instructions' => '<p>Que retourne l\'expression NULL = NULL en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay retourne NULL = NULL f Oracle ?</p>',
            'starter' => 'NULL (pas Vrai ni Faux)',
            'hints' => [
                'En Oracle, NULL représente une valeur inconnue.',
                'NULL = NULL ne retourne pas Vrai, mais NULL.',
            ],
            'solution' => 'NULL (le résultat n\'est pas Vrai ni Faux, mais NULL)',
            'explainFr' => 'En Oracle, NULL = NULL ne retourne pas Vrai, mais NULL car NULL représente une valeur inconnue.',
            'explainDarija' => 'En Oracle, NULL = NULL retourne NULL car NULL valeur inconnue.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];