<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch21 — Instructions conditionnelles : IF, ELSIF et ELSE.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex21',
    'title' => 'Exercices — Instructions conditionnelles : IF, ELSIF et ELSE',
    'brief' => 'Prise de décision en PL/SQL avec structures IF.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'IF simple',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc qui déclare une variable v_note et affiche "Félicitations" si v_note >= 10.</p>',
            'instructionsDarija' => '<p>Écrivez bloc variable v_note affiche "Félicitations" si v_note >= 10.</p>',
            'starter' => "DECLARE v_note NUMBER := 15; BEGIN IF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Félicitations !'); END IF; END;",
            'hints' => [
                'La structure IF THEN exécute le bloc si la condition est VRAIE.',
                'Utilisez END IF à la fin de la structure.',
            ],
            'solution' => "DECLARE v_note NUMBER := 15; BEGIN IF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Félicitations !'); END IF; END;",
            'explainFr' => 'Si la note est supérieure ou égale à 10, le message s\'affiche.',
            'explainDarija' => 'Si note >= 10 message s\'affiche.',
        ],

        [
            'level' => 2,
            'title' => 'IF sans condition VRAIE',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc avec une condition fausse et observez qu\'aucun message ne s\'affiche (pas de ELSE).</p>',
            'instructionsDarija' => '<p>Écrivez bloc condition fausse aucun message affiche pas ELSE.</p>',
            'starter' => "DECLARE v_note NUMBER := 5; BEGIN IF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Note suffisante.'); END IF; END;",
            'hints' => [
                'Si la condition est fausse, rien ne se passe dans un IF simple sans ELSE.',
                'C\'est normal que rien ne s\'affiche.',
            ],
            'solution' => "DECLARE v_note NUMBER := 5; BEGIN IF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Note suffisante.'); END IF; END;",
            'explainFr' => 'Comme la condition est fausse (5 < 10), aucun message n\'est affiché car il n\'y a pas de clause ELSE.',
            'explainDarija' => 'Condition fausse rien ne s\'affiche pas ELSE.',
        ],

        [
            'level' => 3,
            'title' => 'IF ELSIF ELSE',
            'lang'  => 'oracle',
            'instructions' => '<p>Classifiez une note : >= 20 "Maximale", >= 15 "Très bien", >= 10 "Passable", sinon "Insuffisant".</p>',
            'instructionsDarija' => '<p>Classer note >= 20 "Maximale" >= 15 "Très bien" >= 10 "Passable" sinon "Insuffisant".</p>',
            'starter' => "DECLARE v_note NUMBER := 17; BEGIN IF v_note >= 20 THEN DBMS_OUTPUT.PUT_LINE('Note maximale !'); ELSIF v_note >= 15 THEN DBMS_OUTPUT.PUT_LINE('Très bien.'); ELSIF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Passable.'); ELSE DBMS_OUTPUT.PUT_LINE('Insuffisant.'); END IF; END;",
            'hints' => [
                'IF ELSIF ELSE teste plusieurs conditions séquentiellement.',
                'La première condition VRAIE qui s\'exécute. Si aucune n\'est VRAIE, la clause ELSE s\'exécute.',
            ],
            'solution' => "DECLARE v_note NUMBER := 17; BEGIN IF v_note >= 20 THEN DBMS_OUTPUT.PUT_LINE('Note maximale !'); ELSIF v_note >= 15 THEN DBMS_OUTPUT.PUT_LINE('Très bien.'); ELSIF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE('Passable.'); ELSE DBMS_OUTPUT.PUT_LINE('Insuffisant.'); END IF; END;",
            'explainFr' => 'La note 17 déclenche la première condition VRAIE (>= 15 -> "Très bien").',
            'explainDarija' => 'Note 17 première condition VRAIE >= 15 "Très bien".',
        ],

        [
            'level' => 4,
            'title' => 'Conditions complexes',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc qui teste si un âge est majeur (>= 18) ET si le consentement est "oui".</p>',
            'instructionsDarija' => '<p>Écrivez bloc teste âge majeur >= 18 consentement "oui".</p>',
            'starter' => "DECLARE v_age NUMBER := 20; v_ayant VARCHAR2(10) := 'oui'; BEGIN IF v_age >= 18 THEN DBMS_OUTPUT.PUT_LINE('Vous êtes majeur.'); IF v_ayant = 'oui' THEN DBMS_OUTPUT.PUT_LINE('Inscription acceptée.'); ELSE DBMS_OUTPUT.PUT_LINE('Inscription reportée.'); END IF; ELSE DBMS_OUTPUT.PUT_LINE('Vous êtes mineur.'); END IF; END;",
            'hints' => [
                'On peut imbriger des conditions IF à l\'intérieur d\'autres conditions.',
                'Les conditions AND/OR peuvent être utilisées à l\'intérieur d\'une condition IF.',
            ],
            'solution' => "DECLARE v_age NUMBER := 20; v_ayant VARCHAR2(10) := 'oui'; BEGIN IF v_age >= 18 THEN DBMS_OUTPUT.PUT_LINE('Vous êtes majeur.'); IF v_ayant = 'oui' THEN DBMS_OUTPUT.PUT_LINE('Inscription acceptée.'); ELSE DBMS_OUTPUT.PUT_LINE('Inscription reportée.'); END IF; ELSE DBMS_OUTPUT.PUT_LINE('Vous êtes mineur.'); END IF; END;",
            'explainFr' => 'Test d\'abord de l\'âge, puis vérification du consentement. Si majeur et consentement "oui", inscription acceptée.',
            'explainDarija' => 'D\'abord âge vérification consentement. Majeur consentement "oui" inscription acceptée.',
        ],

        [
            'level' => 5,
            'title' => 'Écriture correcte ELSIF',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le mot-clé correct à utiliser après un IF pour tester plusieurs conditions en Oracle : ELSIF ou ELSE IF ?</p>',
            'instructionsDarija' => '<p>Kay mot-clé correct utiliser après IF tester plusieurs conditions Oracle : ELSIF w ELSE IF ?</p>',
            'starter' => 'ELSIF (un seul mot en Oracle)',
            'hints' => [
                'En Oracle, le mot-clé s\'écrit ELSIF (tout en un mot).',
                'Écrire ELSE IF (deux mots) provoquerait une erreur de compilation.',
            ],
            'solution' => 'ELSIF (un seul mot en Oracle)',
            'explainFr' => 'En Oracle PL/SQL, le mot-clé s\'écrit ELSIF (tout en un mot). Écrire ELSE IF (deux mots) provoquerait une erreur de compilation.',
            'explainDarija' => 'Oracle PL/SQL ELSIF un mot ELSE IF deux mots erreur compilation.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];