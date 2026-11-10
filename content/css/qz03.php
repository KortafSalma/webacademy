<?php

declare(strict_types=1);

/**
 * Quiz du chapitre css-ch3 — Sélecteurs.
 * 5 questions : choix simple, choix multiple, vrai/faux, et fill-in.
 */

return [
    'title' => 'Quiz — Sélecteurs',
    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Lequel de ces sélecteurs ciblera tous les paragraphes ?',
            'options' => ['p', '.paragraph', '#paragraph'],
            'answer'  => 0,
            'concept' => 'Sélecteur de type',
            'explainFr' => 'Le sélecteur p cible tous les éléments de paragraphe dans le document.',
            'explainDarija' => 'Sélecteur p kay9der tous elément paragraphes f document.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Lequel de ces sélecteurs ciblera un élément ayant l\'identifiant "header" ?',
            'options' => ['.header', '#header', '.header-header'],
            'answer'  => 1,
            'concept' => 'Sélecteur par ID',
            'explainFr' => 'Le sélecteur #header cible l\'élément dont l\'attribut id vaut "header".',
            'explainDarija' => 'Sélecteur #header kay9der elmént b id "header".',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Les pseudo-classes comme :hover ne s\'appliquent qu\'aux éléments interactifs.',
            'answer'  => 1,
            'concept' => 'Pseudo-classes',
            'explainFr' => 'Vrai : Les pseudo-classes comme :hover ne s\'appliquent qu\'aux éléments capables d\'être interagis (liens, boutons, etc.).',
            'explainDarija' => 'True : pseudo-classes kay9der tk9der tk9der elmént kay9der interagissable (liens, boutons, etc.).',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La pseudo-classe qui s\'applique lorsqu\'on survole un élément s\'appelle ________.',
            'expected'=> 'hover',
            'accept'  => ['hover', 'Hover', 'HOVER'],
            'concept' => 'Pseudo-classes',
            'explainFr' => 'Le sélecteur :hover permet de styliser un élément lorsqu\'on positionne le curseur au-dessus.',
            'explainDarija' => 'Pseudo-class hover kay9der styliser elmént bach curseur positionné au-dessus.',
        ],

        [
            'type'    => 'multi',
            'question'=> 'Choisissez tous les sélecteurs valides parmi :',
            'options' => ['.classe', '#id', 'element', 'tous les above'],
            'answer'  => [0, 1, 2],
            'concept' => 'Sélecteurs valides',
            'explainFr' => 'Tous les types de sélecteurs (par classe, par ID et par type d\'élément) sont valides en CSS.',
            'explainDarija' => 'Kol types de sélecteurs (bach classe, ID w type elément) kay9der valide f CSS.',
        ],
    ],
];