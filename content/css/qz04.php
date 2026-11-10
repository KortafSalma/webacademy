<?php

declare(strict_types=1);

/**
 * Quiz du chapitre css-ch4 — Property display.
 * 5 questions : MCQ, fill, vrai/faux, et multi.
 */

return [
    'title' => 'Quiz — Property display',
    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces valeurs de display retire complètement un élément du flux ?',
            'options' => ['display: block', 'display: none', 'display: inline'],
            'answer'  => 1,
            'concept' => 'Display none',
            'explainFr' => 'display: none retire l\'élément du flux du document.',
            'explainDarija' => 'display: none kay9der retire élément f flux document.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La valeur par défaut de la propriété display pour la plupart des éléments de bloc est ________.',
            'expected'=> 'block',
            'accept'  => ['block', 'Block', 'BLOCK'],
            'concept' => 'Display par défaut',
            'explainFr' => 'La valeur par défaut pour les éléments de type bloc (comme <div>, <p>) est block.',
            'explainDarija' => 'Valeur par défaut bach éléments de bloc (comme <div>, <p>) est block.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'display: none conserve la place de l\'élément dans le layout.',
            'answer'  => 0,
            'concept' => 'Display none',
            'explainFr' => 'Faux : display: none retire l\'élément du flux, il ne conserve pas de place.',
            'explainDarija' => 'Faux : display: none retire élément f flux, il conserve pas place.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces valeurs permet à un élément de faire à la fois block et inline ?',
            'options' => ['display: block', 'display: inline', 'display: inline-block'],
            'answer'  => 2,
            'concept' => 'Display inline-block',
            'explainFr' => 'display: inline-block permet à un élément d\'agir comme un élément inline tout en permettant de définir largeur et hauteur.',
            'explainDarija' => 'display: inline-block permettre élément agir bach inline w permettre définir largeur hauteur.',
        ],

        [
            'type'    => 'multi',
            'question'=> 'Lesquelles des valeurs suivantes sont valides pour la propriété display ?',
            'options' => ['block', 'none', 'inline', 'flex', 'all of the above'],
            'answer'  => [0, 1, 2, 3],
            'concept' => 'Valeurs display',
            'explainFr' => 'Toutes ces valeurs sont valides pour la propriété display en CSS.',
            'explainDarija' => 'Toutes ces valeurs kay9der valide bach propriété display f CSS.',
        ],
    ],
];