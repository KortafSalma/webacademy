<?php

declare(strict_types=1);

/**
 * Quiz du chapitre html-ch5 — Listes HTML.
 * 5 questions : MCQ, fill, et true_false.
 */

return [
    'title' => 'Quiz — Listes HTML',
    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces balises crée une liste numérotée ?',
            'options' => ['<ul>', '<ol>', '<li>'],
            'answer'  => 1,
            'concept' => 'Listes HTML',
            'explainFr' => 'La balise <code><ol></code> crée une liste ordonnée (numérotée).',
            'explainDarija' => 'Balise <code><ol></code> kay9der créer liste numérotée.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La balise qui définit un élément de liste s\'appelle ________.',
            'expected'=> 'li',
            'accept'  => ['li', 'Li', 'LI'],
            'concept' => 'Listes HTML',
            'explainFr' => 'La balise <code><li></code> définit un élément de liste.',
            'explainDarija' => 'Balise <code><li></code> kay9der définir élément liste.',
        ],

        [
            'type'    => 'true_false',
            'question'=>'Les listes nesting permettent de créer des menus déroulants.',
            'answer'  => 1,
            'concept' => 'Listes nesting',
            'explainFr' => 'Vrai : Le nesting (imbrication) de listes permet de créer des menus complexes avec des sous-éléments.',
            'explainDarija' => 'True : Nesting (imbrication) listes kay9der créer menus déroulants complexes.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel attribut doit contenir chaque élément de liste <li> ?',
            'options' => ['href', 'class', 'id', 'content'],
            'answer'  => 0,
            'concept' => 'Éléments de liste',
            'explainFr' => 'Bien que ce ne soit pas obligatoire, l\'attribut href est souvent utilisé dans les éléments de liste qui sont des liens.',
            'explainDarija' => 'Non obligatoire bach href souvent utilisé éléments liste bach liens.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel est le bon ordre d\'imbrication pour un menu de navigation avec sous-éléments ?',
            'options' => ['<ul><li><ol></ol></li></ul>', '<ol><li><ul></ul></li></ol>', '<ul><li><ul></ul></li></ul>'],
            'answer'  => 2,
            'concept' => 'Nested lists',
            'explainFr' => 'La structure correcte est <code><ul><li><ul></ul></li></ul></code> pour un menu avec sous-éléments.',
            'explainDarija' => 'Structure correcte kay9der <code><ul><li><ul></ul></li></ul></code> bach menu bach sous-éléments.',
        ],
    ],
];