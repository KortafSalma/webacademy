<?php

declare(strict_types=1);

/**
 * Quiz du chapitre html-ch4 — Liens et images.
 * 5 questions : TF, MCQ, et fill.
 */

return [
    'title' => 'Quiz — Liens et images',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'L\'attribut alt d\'une image est obligatoire pour l\'accessibilité.',
            'answer'  => 1,
            'concept' => 'Accessibilité',
            'explainFr' => 'Vrai : L\'attribut alt est requis pour l\'accessibilité (lecteurs d\'écran) et si l\'image ne charge pas.',
            'explainDarija' => 'True : attribut alt kay9der l\'accessibility w si image9der s\'charge pas.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Lequel de ces liens s\'ouvrira dans un nouvel onglet ?',
            'options' => ['<a href="page.html">Accueil</a>', '<a href="page.html" target="_blank">Accueil</a>', '<a target="_self">Accueil</a>'],
            'answer'  => 1,
            'concept' => '_blank vs _self',
            'explainFr' => 'C\'est l\'attribut <code>target="_blank"</code> qui ouvre le lien dans un nouvel onglet ou une nouvelle fenêtre.',
            'explainDarija' => 'Attribut <code>target="_blank"</code> kay9der liaison kay9der f9der f nouvel onglet w window. ',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces balises est auto-fermante ?',
            'options' => ['<a>', '<img>', '<p>'],
            'answer'  => 1,
            'concept' => 'Balises HTML',
            'explainFr' => '<code><img></code> est auto-fermante, elle n\'a pas de tag de fermeture. <code><a></code> et <code><p></code> en ont un.',
            'explainDarija' => '<code><img></code> auto-fermante, ma fiha tag closure. <code><a></code> w <code><p></code> kaynha closure.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'L\'attribut qui fournit un texte alternatif pour l\'image s\'appelle ________.',
            'expected'=> 'alt',
            'accept'  => ['alt', 'Alt', 'ATTRIBUT ALT'],
            'concept' => 'Attribut alt',
            'explainFr' => 'L\'attribut <code>alt</code> décrit le contenu de l\'image pour l\'accessibilité et le référencement.',
            'explainDarija' => 'Attribut <code>alt</code> kay9der describes contenu image bach accessibility w référencement.',
        ],

        [
            'type'    => 'multi',
            'question'=> 'Choisissez les technologies utilisées pour créer un lien cliquable sur une image :',
            'options' => ['HTML uniquement', 'HTML + CSS', 'HTML + JavaScript', 'HTML uniquement avec attributs'],
            'answer'  => [1, 3],
            'concept' => 'Liens d\'images',
            'explainFr' => 'HTML fournit la structure du lien et de l\'image, CSS peut styliser l\'apparence (taille, bordure au survol).',
            'explainDarija' => 'HTML kayprovide structure liaison w image, CSS kaystyle apparance (size, border hover).',
        ],
    ],
];