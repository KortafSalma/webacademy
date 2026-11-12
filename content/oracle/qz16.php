<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch21 — Instructions conditionnelles : IF, ELSIF et ELSE.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Instructions conditionnelles : IF, ELSIF et ELSE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La structure IF THEN exécute le bloc si la condition est :',
            'options' => 'VRAIE', 'FAUX', 'NULL', '0'],
            'answer' => 0,
            'concept' => 'Structure IF THEN',
            'explainFr' => 'La condition est évaluée ; si elle est VRAIE, le bloc s\'exécute.',
            'explainDarija' => 'Condition évaluée si VRAIE bloc s\'exécute.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot-clé qui clôture une structure IF s\'appelle ________.',
            'expected' => 'END IF',
            'accept' => ['END IF', 'end if'],
            'concept' => 'Syntaxe IF',
            'explainFr' => 'END IF (ou END IF) clôture la structure conditionnelle.',
            'explainDarija' => 'END IF clôture structure conditionnelle.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'En Oracle, le mot-clé pour tester plusieurs conditions s\'écrit ELSIF (tout en un mot).',
            'answer' => 1,
            'concept' => 'Mot-clé ELSIF',
            'explainFr' => 'Vrai : En Oracle PL/SQL, on écrit ELSIF (un seul mot). Écrire ELSE IF (deux mots) provoquerait une erreur de compilation.',
            'explainDarija' => 'Vrai Oracle PL/SQL ELSIF un mot ELSE IF deux mots erreur compilation.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : DECLARE v_note NUMBER := 15; IF v_note >= 10 THEN DBMS_OUTPUT.PUT_LINE(\\'Passable.\\'); END IF ;',
            'options' => 'Oubli point-virgule', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Boucle infinie'],
            'answer' => 2,
            'concept' => 'Syntaxe IF',
            'explainFr' => 'La syntaxe semble correcte, mais notez le espace avant le point-virgule après END IF. Bien que ce ne soit pas une erreur stricte, il est recommandé d\'écrire END IF sans espace avant le point-virgule pour plus de clarté.',
            'explainDarija' => 'Syntaxe semble correcte espace avant point-virgule END IF recommandé clarté.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera le bloc suivant ? DECLARE v_note NUMBER := 17; BEGIN IF v_note >= 20 THEN DBMS_OUTPUT.PUT_LINE(\\'Maximale.\\'); ELSIF v_note >= 15 THEN DBMS_OUTPUT.PUT_LINE(\\'Très bien.\\'); ELSE DBMS_OUTPUT.PUT_LINE(\\'Insuffisant.\\'); END IF; END ;',
            'options' => 'Très bien.', 'Maximale.', 'Insuffisant.', 'Aucune sortie',
            'answer' => 1,
            'concept' => 'Structure IF ELSIF ELSE',
            'explainFr' => 'La note 17 déclenchera la première condition VRAIE (>= 15 -> "Très bien.").',
            'explainDarija' => 'Note 17 première condition VRAIE >= 15 "Très bien.".',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des structures suivantes permet de tester plusieurs conditions séquentiellement ?',
            'options' => 'IF THEN', 'IF ELSIF ELSE', 'LOOP...EXIT', 'WHILE...LOOP',
            'answer' => 1,
            'concept' => 'Structure IF ELSIF ELSE',
            'explainFr' => 'IF ELSIF ELSE teste plusieurs conditions séquentiellement, la première VRAIE exécutée, sinon ELSE exécutée.',
            'explainDarija' => 'IF ELSIF ELSE teste conditions séquentiellement première VRAIE exécutée sinon ELSE.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La structure qui permet de tester une condition alternative s\'appelle ________.',
            'expected' => 'ELSE',
            'accept' => ['ELSE', 'else'],
            'concept' => 'Clause ELSE',
            'explainFr' => 'La clause ELSE s\'exécute si aucune condition précédente (IF ou ELSIF) n\'a été VRAIE.',
            'explainDarija' => 'Clause ELSE exécutée si aucune condition précédente VRAIE.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'On peut imbriquer des conditions IF à l\'intérieur d\'autres conditions IF.',
            'answer' => 1,
            'concept' => 'Structure IF imbriquée',
            'explainFr' => 'Vrai : On peut placer une structure IF à l\'intérieur d\'une autre structure IF pour tester des situations complexes.',
            'explainDarija' => 'Vrai : IF imbriquée situations complexes.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes n\'est pas valide en Oracle PL/SQL ?',
            'options' => 'IF condition THEN ... END IF', 'IF condition THEN ... ELSE IF ... END IF', 'IF condition THEN ... ELSIF condition THEN ... END IF',
            'answer' => 1,
            'concept' => 'Syntaxe ELSE IF',
            'explainFr' => 'En Oracle, on n\'écrit pas ELSE IF (deux mots). On utilise ELSIF (un seul mot) après le IF initial.',
            'explainDarija' => 'Oracle ELSE IF deux mots erreur compilation.',
        ],

    ],
];