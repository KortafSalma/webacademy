<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch22 — Boucles : LOOP, WHILE et FOR.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Boucles : LOOP, WHILE et FOR',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La boucle LOOP crée :',
            'options' => ['Une boucle infinie', 'Une boucle while', 'Une boucle for', 'Une fonction'],
            'answer' => 0,
            'concept' => 'Boucle LOOP',
            'explainFr' => 'LOOP crée une boucle infinie. Il faut impérativement prévoir une condition EXIT pour en sortir.',
            'explainDarija' => 'LOOP boucle infinie doit condition EXIT sortir.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause qui sort d\'une boucle LOOP s\'appelle ________.',
            'expected' => 'EXIT',
            'accept' => ['EXIT', 'exit'],
            'concept' => 'Clause EXIT',
            'explainFr' => 'EXIT sort de la boucle lorsque la condition devient VRAIE.',
            'explainDarija' => 'EXIT sors boucle condition devient VRAIE.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une boucle WHILE s\'exécute tant que la condition reste VRAIE. Si la condition est fausse au départ, le corps de la boucle ne s\'exécutera jamais.',
            'answer' => 1,
            'concept' => 'Boucle WHILE',
            'explainFr' => 'Vrai : La condition est évaluée au début de chaque itération. Si elle est fausse dès le départ, le corps n\'exécute jamais.',
            'explainDarija' => 'Vrai condition évaluée début itération faux jamais exécuté.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur potentielle : DECLARE v_compteur NUMBER := 1; BEGIN LOOP DBMS_OUTPUT.PUT_LINE(v_compteur); END LOOP; END ;',
            'options' => ['Oubli variable', 'Boucle infinie sans EXIT', 'Syntaxe incorrecte', 'Pas d\'erreur'],
            'answer' => 1,
            'concept' => 'Boucle LOOP sans EXIT',
            'explainFr' => 'Sans EXIT WHEN ou une condition d\'arrêt, la boucle s\'exécutera indéfiniment (boucle infinie).',
            'explainDarija' => 'Sans EXIT WHEN boucle infinie indefinite.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la boucle : DECLARE v_compteur NUMBER := 1; LOOP DBMS_OUTPUT.PUT_LINE(v_compteur); v_compteur := v_compteur + 1; EXIT WHEN v_compteur > 3; END LOOP; END ;',
            'options' => ['1 2 3', '1 2 3 4', '1 2', 'Aucune affichage'],
            'answer' => 0,
            'concept' => 'Boucle LOOP EXIT WHEN',
            'explainFr' => 'La boucle affichera 1, 2, 3 et s\'arrêtera grâce à EXIT WHEN v_compteur > 3.',
            'explainDarija' => 'Boucle affichera 1 2 3 EXIT WHEN v_compteur > 3.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'La boucle FOR v IN lower..upper LOOP itère sur :',
            'options' => ['Une plage de valeurs connue', 'Des valeurs aléatoires', 'Des valeurs de table', 'Des valeurs de curseur'],
            'answer' => 0,
            'concept' => 'Boucle FOR',
            'explainFr' => 'La variable v est automatiquement créée et prend les valeurs de lower à upper.',
            'explainDarija' => 'Variable v automatique valeurs lower à upper.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La boucle qui itère sur une plage de valeurs connue s\'appelle ________.',
            'expected' => 'FOR ... IN ... LOOP',
            'accept' => ['FOR ... IN ... LOOP', 'for loop'],
            'concept' => 'Boucle FOR',
            'explainFr' => 'FOR v IN lower..upper LOOP itère sur une plage de valeurs connue.',
            'explainDarija' => 'FOR IN upper boucle itère plage valeurs connue.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Dans une boucle FOR, la variable de boucle est automatiquement créée et prend les valeurs de la borne inférieure à la borne supérieure.',
            'answer' => 1,
            'concept' => 'Boucle FOR',
            'explainFr' => 'Vrai : La variable de boucle est créée par Oracle et prend les valeurs de la plage spécifiée.',
            'explainDarija' => 'Vrai variable boucle automatiquement créée borne inférieure borne supérieure.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes permet de calculer la somme de 1 à 10 ?',
            'options' => ['DECLARE v_somme NUMBER := 0; FOR v IN 1..10 LOOP v_somme := v_somme + v; END LOOP;', 'DECLARE v_compteur NUMBER := 1; LOOP EXIT WHEN v_compteur > 10; END LOOP;', 'DECLARE v_age NUMBER := 30; WHILE v_age > 0 LOOP v_age := v_age - 1; END LOOP;', 'Toutes les réponses ci-dessus'],
            'answer' => 0,
            'concept' => 'Boucle FOR somme',
            'explainFr' => 'La première option utilise une boucle FOR de 1 à 10 pour accumulator la somme.',
            'explainDarija' => 'Première option boucle FOR 1 à 10 accumulator somme.',
        ],

    ],
];