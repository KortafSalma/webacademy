<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch22 — Boucles : LOOP, WHILE et FOR.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex22',
    'title' => 'Exercices — Boucles : LOOP, WHILE et FOR',
    'brief' => 'Structures de répétition en PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'LOOP avec EXIT',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une boucle qui affiche les itérations de 1 à 5 en utilisant LOOP et EXIT WHEN.</p>',
            'instructionsDarija' => '<p>Boucle affiche itérations 1 à 5 LOOP EXIT WHEN.</p>',
            'starter' => "DECLARE v_compteur NUMBER := 1; BEGIN LOOP DBMS_OUTPUT.PUT_LINE('Itération : ' || v_compteur); v_compteur := v_compteur + 1; EXIT WHEN v_compteur > 5; END LOOP; END;",
            'hints' => [
                'LOOP crée une boucle infinie.',
                'EXIT WHEN sort de la boucle quand la condition est vraie.',
            ],
            'solution' => "DECLARE v_compteur NUMBER := 1; BEGIN LOOP DBMS_OUTPUT.PUT_LINE('Itération : ' || v_compteur); v_compteur := v_compteur + 1; EXIT WHEN v_compteur > 5; END LOOP; END;",
            'explainFr' => 'La boucle s\'arrête après 5 itérations grâce à EXIT WHEN v_compteur > 5.',
            'explainDarija' => 'Boucle s\'arrête après 5 itérations EXIT WHEN v_compteur > 5.',
        ],

        [
            'level' => 2,
            'title' => 'WHILE',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une boucle WHILE qui affiche les nombres de 1 à 5.</p>',
            'instructionsDarija' => '<p>Boucle WHILE affiche nombres 1 à 5.</p>',
            'starter' => "DECLARE v_compteur NUMBER := 1; BEGIN WHILE v_compteur <= 5 LOOP DBMS_OUTPUT.PUT_LINE('Compteur : ' || v_compteur); v_compteur := v_compteur + 1; END LOOP; END;",
            'hints' => [
                'WHILE ... LOOP exécute le bloc tant que la condition est VRAIE.',
                'Si la condition est fausse au départ, le corps de la boucle ne s\'exécute jamais.',
            ],
            'solution' => "DECLARE v_compteur NUMBER := 1; BEGIN WHILE v_compteur <= 5 LOOP DBMS_OUTPUT.PUT_LINE('Compteur : ' || v_compteur); v_compteur := v_compteur + 1; END LOOP; END;",
            'explainFr' => 'La boucle s\'arrête lorsque v_compteur dépasse 5.',
            'explainDarija' => 'Boucle s\'arrête lorsque v_compteur dépasse 5.',
        ],

        [
            'level' => 3,
            'title' => 'FOR simple',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une boucle FOR qui affiche les nombres de 1 à 5.</p>',
            'instructionsDarija' => '<p>Boucle FOR affiche nombres 1 à 5.</p>',
            'starter' => "BEGIN FOR v IN 1..5 LOOP DBMS_OUTPUT.PUT_LINE('Nombre : ' || v); END LOOP; END;",
            'hints' => [
                'FOR v IN lower..upper LOOP itère sur une plage de valeurs connue.',
                'La variable v est automatiquement créée et prend les valeurs de lower à upper.',
            ],
            'solution' => "BEGIN FOR v IN 1..5 LOOP DBMS_OUTPUT.PUT_LINE('Nombre : ' || v); END LOOP; END;",
            'explainFr' => 'La variable v prend automatiquement les valeurs 1, 2, 3, 4, 5.',
            'explainDarija' => 'Variable v automatique valeurs 1 2 3 4 5.',
        ],

        [
            'level' => 4,
            'title' => 'Somme avec FOR',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc qui calcule la somme des nombres de 1 à 10 en utilisant une boucle FOR.</p>',
            'instructionsDarija' => '<p>Calculer somme nombres 1 à 10 boucle FOR.</p>',
            'starter' => "DECLARE v_somme NUMBER := 0; BEGIN FOR v IN 1..10 LOOP v_somme := v_somme + v; END LOOP; DBMS_OUTPUT.PUT_LINE('Somme 1 à 10 : ' || v_somme); END;",
            'hints' => [
                'Vous pouvez accumulator une somme dans la boucle.',
                'La variable v prend les valeurs de 1 à 10.',
            ],
            'solution' => "DECLARE v_somme NUMBER := 0; BEGIN FOR v IN 1..10 LOOP v_somme := v_somme + v; END LOOP; DBMS_OUTPUT.PUT_LINE('Somme 1 à 10 : ' || v_somme); END;",
            'explainFr' => 'La boucle calcule 1+2+...+10 = 55 et l\'affiche.',
            'explainDarija' => 'Boucle calcule 1+2+...+10 = 55 affichage.',
        ],

        [
            'level' => 5,
            'title' => 'Boucle contrôlée',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une boucle qui n\'exécute que les nombres pairs de 1 à 10 en utilisant LOOP, EXIT et une condition de saut.</p>',
            'instructionsDarija' => '<p>Boucle nombres pairs 1 à 10 LOOP EXIT condition saut.</p>',
            'starter' => "DECLARE v_compteur NUMBER := 0; BEGIN LOOP v_compteur := v_compteur + 1; IF MOD(v_compteur, 2) != 0 THEN ITERATE; END IF; IF v_compteur > 10 THEN EXIT; END IF; DBMS_OUTPUT.PUT_LINE(v_compteur); END LOOP; END;",
            'hints' => [
                'ITERATE passe à l\'itération suivante de la boucle.',
                'On peut combiner EXIT pour sortir et ITERATE pour sauter.',
            ],
            'solution' => "DECLARE v_compteur NUMBER := 0; BEGIN LOOP v_compteur := v_compteur + 1; IF MOD(v_compteur, 2) != 0 THEN ITERATE; END IF; IF v_compteur > 10 THEN EXIT; END IF; DBMS_OUTPUT.PUT_LINE(v_compteur); END LOOP; END;",
            'explainFr' => 'La boucle affiche uniquement les nombres pairs (2, 4, 6, 8, 10) en utilisant ITERATE pour sauter les impairs et EXIT pour s\'arrêter après 10.',
            'explainDarija' => 'Boucle affiche uniquement nombres pairs 2 4 6 8 10 ITERATE sauter impairs EXIT s\'arrêter après 10.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];