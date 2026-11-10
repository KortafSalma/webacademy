<?php

declare(strict_types=1);

/**
 * Quiz du chapitre php-ch3 — Opérateurs.
 * 5 questions : MCQ, fill, true_false, et multi.
 */

return [
    'title' => 'Quiz — Opérateurs',
    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel opérateur effectue une addition en PHP ?',
            'options' => ['-', '+', '%'],
            'answer'  => 1,
            'concept' => 'Operateurs arithmétiques',
            'explainFr' => 'L\'opérateur + effectue l\'addition en PHP.',
            'explainDarija' => 'Operator + kay9der addition f PHP.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'L\'opérateur === compare les valeurs en ignorant le type des données.',
            'answer'  => 0,
            'concept' => 'Opérateurs de comparaison',
            'explainFr' => 'Faux : l\'opérateur === effectue une comparaison stricte qui prend en compte le type des données.',
            'explainDarija' => 'Faux : operator === kay9der comparaison stricte bach prendre en compte type données.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'L\'opérateur qui retourne le reste d\'une division s\'appelle ________.',
            'expected'=> '%',
            'accept'  => ['%', 'Modulo', 'modulo'],
            'concept' => 'Operateurs arithmétiques',
            'explainFr' => 'L\'opérateur modulo % retourne le reste d\'une division.',
            'explainDarija' => 'Operator modulo % kay9der retourne reste division.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Lequel de ces opérateurs inverse la valeur booléenne ?',
            'options' => ['&&', '||', '!'],
            'answer'  => 2,
            'concept' => 'Operateurs logiques',
            'explainFr' => 'L\'opérateur ! inverse la valeur booléenne.',
            'explainDarija' => 'Operator ! kay9der inverse valeur booléenne.',
        ],

        [
            'type'    => 'multi',
            'question'=> 'Choisissez les opérateurs de comparaison valides :',
            'options' => ['==', '!=', '===', 'tous les above'],
            'answer'  => [0, 1, 2],
            'concept' => 'Opérateurs de comparaison',
            'explainFr' => '==, != et === sont tous des opérateurs de comparaison valides.',
            'explainDarija' => '==, != w === kay9der tous valide opérateurs comparaison.',
        ],
    ],
];