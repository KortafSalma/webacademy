<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch28 — Enregistrements, collections et PL/SQL avancé.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex28',
    'title' => 'Exercices — Enregistrements, collections et PL/SQL avancé',
    'brief' => 'Types de données complexes et manipulation de collections.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — TYPE RECORD basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Déclarez un type RECORD t_client_record avec les champs id, nom, email et solde.</p>',
            'instructionsDarija' => '<p>TYPE RECORD t_client_record champs id nom email solde.</p>',
            'starter' => 'TYPE t_client_record IS RECORD (id NUMBER, nom VARCHAR2(50), email VARCHAR2(100), solde NUMBER);',
            'hints' => [
                'TYPE RECORD permet de définir une structure de données composée de plusieurs champs.',
                'Les champs sont déclarés entre parenthèses séparés par des virgules.',
            ],
            'solution' => 'TYPE t_client_record IS RECORD (id NUMBER, nom VARCHAR2(50), email VARCHAR2(100), solde NUMBER)',
            'explainFr' => 'Le type RECORD t_client_record contient quatre champs de types différents.',
            'explainDarija' => 'TYPE RECORD t_client_record contient quatre champs types différents.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Utiliser un RECORD',
            'lang'  => 'oracle',
            'instructions' => '<p>Déclarez une variable v_client du type t_client_record et affichez son champ nom.</p>',
            'instructionsDarija' => '<p>Variable v_client TYPE t_client_record affiche champ nom.</p>',
            'starter' => 'DECLARE v_client t_client_record; BEGIN v_client.id := 1; v_client.nom := \\'Mohamed\\'; DBMS_OUTPUT.PUT_LINE(v_client.nom); END;',
            'hints' => [
                'On déclare une variable du type RECORD créé.',
                'On affecte des valeurs aux champs par nom (v_client.nom).',
                'DBMS_OUTPUT.PUT_LINE affiche la valeur.',
            ],
            'solution' => 'DECLARE v_client t_client_record; BEGIN v_client.id := 1; v_client.nom := \\'Mohamed\\'; DBMS_OUTPUT.PUT_LINE(v_client.nom); END;',
            'explainFr' => 'La variable v_client du type RECORD permet de stocker et d\'afficher le prénom Mohamed.',
            'explainDarija' => 'Variable v_client TYPE RECORD stocker afficher prénom Mohamed.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — TYPE TABLE OF',
            'lang'  => 'oracle',
            'instructions' => '<p>Déclarez un type TABLE OF NUMBER indexé par PLS_INTEGER nommé t_nombre_table.</p>',
            'instructionsDarija' => '<p>TYPE TABLE OF NUMBER indexé PLS_INTEGER nommé t_nombre_table.</p>',
            'starter' => 'TYPE t_nombre_table IS TABLE OF NUMBER INDEX BY PLS_INTEGER',
            'hints' => [
                'TYPE TABLE OF (ou INDEX BY TABLE OF) représente une collection unidimensionnelle indexée par une clé.',
                'Peut grandir dynamiquement.',
            ],
            'solution' => 'TYPE t_nombre_table IS TABLE OF NUMBER INDEX BY PLS_INTEGER',
            'explainFr' => 'Le type TABLE OF NUMBER INDEX BY PLS_INTEGER crée une collection de nombres indexée par des entiers.',
            'explainDarija' => 'TYPE TABLE OF NUMBER INDEX BY PLS_INTEGER collection nombres indexée entiers.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — TYPE VARRAY',
            'lang'  => 'oracle',
            'instructions' => '<p>Déclarez un type VARRAY de 7 éléments de type VARCHAR2(10) nommé t_jour_semaine.</p>',
            'instructionsDarija' => '<p>TYPE VARRAY 7 éléments VARCHAR2(10) nommé t_jour_semaine.</p>',
            'starter' => 'TYPE t_jour_semaine IS VARRAY(7) OF VARCHAR2(10)',
            'hints' => [
                'TYPE VARRAY (Table VARiable Array) est une collection indexée dont la taille maximale est définie au moment de la création.',
                'Il a une borne supérieure fixe.',
            ],
            'solution' => 'TYPE t_jour_semaine IS VARRAY(7) OF VARCHAR2(10)',
            'explainFr' => 'Le type VARRAY(7) OF VARCHAR2(10) crée un tableau variable de 7 éléments de texte de longueur 10.',
            'explainDarija' => 'TYPE VARRAY(7) OF VARCHAR2(10) tableau variable 7 éléments texte longueur 10.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Méthodes EXISTS et COUNT',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment vérifier si l\'élément à l\'index \"maths\" existe dans une collection TABLE OF, puis compter le nombre d\'éléments ?</p>',
            'instructionsDarija' => '<p>Kay vérifier élément index "maths" existe collection TABLE OF compter nombre éléments ?</p>',
            'starter' => 'IF EXISTS(v_notes\\'maths\\') THEN ... END IF; DBMS_OUTPUT.PUT_LINE(v_notes.COUNT)',
            'hints' => [
                'La méthode EXISTS(key) retourne VRAI si l\'élément à l\'index key existe dans la collection.',
                'La méthode COUNT retourne le nombre d\'éléments actuellement stockés.',
            ],
            'solution' => 'IF EXISTS(v_notes\\'maths\\') THEN ... END IF; DBMS_OUTPUT.PUT_LINE(v_notes.COUNT)',
            'explainFr' => 'La méthode EXISTS vérifie la présence d\'une clé, COUNT retourne le nombre d\'éléments stockés.',
            'explainDarija' => 'Méthodes EXISTS vérifie présence clé COUNT nombre éléments stockés.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Méthodes TRIM et LIMIT',
            'lang'  => 'oracle',
            'instructions' => '<p>Après avoir ajouté des éléments à un VARRAY, comment supprimer le dernier élément avec TRIM et quelle est la limite maximale avec LIMIT ?</p>',
            'instructionsDarija' => '<p>Après ajout éléments VARRAY supprimer dernier élément TRIM limite maximale LIMIT ?</p>',
            'starter' => 'TRIM(v_jours); DBMS_OUTPUT.PUT_LINE(v_jours.LIMIT)',
            'hints' => [
                'La méthode TRIM supprime les éléments du haut de la collection (diminue le COUNT).',
                'La méthode LIMIT retourne la limite maximale d\'éléments pour un VARRAY.',
            ],
            'solution' => 'TRIM(v_jours); DBMS_OUTPUT.PUT_LINE(v_jours.LIMIT)',
            'explainFr' => 'TRIM supprime le dernier élément ajouté, LIMIT retourne la limite maximale (ici 7) du VARRAY.',
            'explainDarija' => 'TRIM supprimer dernier élément LIMIT limite maximale ici 7 VARRAY.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];