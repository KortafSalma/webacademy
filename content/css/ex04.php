<?php

declare(strict_types=1);

/**
 * Exercices du chapitre css-ch4 — Property display.
 * Schéma OBLIGATOIRE : 3 niveaux (Débutant, Intermédiaire, Avancé).
 */

return [
    'id'    => 'css-ex4',
    'title' => 'Property display',
    'brief' => 'Manipule la propriété display en CSS.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — identifie la bonne valeur de display',
            'lang'  => 'css',
            'instructions' => 'Choisis la bonne valeur de display pour cacher un élément :\n\n1. display: block\n2. display: none\n3. display: inline\n\nÉcris le numéro du bon choix (1, 2 ou 3).',
            'instructionsDarija' => 'Kmll valeur display kay9der cacher élément :\n\n1. display: block\n2. display: none\n3. display: inline\n\nKtib n9mer n correct (1, 2 ou 3).',
            'starter' => '---\n1. display: block\n2. display: none\n3. display: inline\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => '2'],
            ],
            'hints' => [
                'display: none retire complètement l\'élément du flux.',
                'display: block fait prendre toute la largeur.',
            ],
            'solution' => '2',
            'explainFr' => 'display: none cache complètement l\'élément.',
            'explainDarija' => 'display: none kay9der kay9der élément f flux. ',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — applique display: none et inline-block',
            'lang'  => 'css',
            'instructions' => 'Écrit le code CSS qui va :\n- Cacher le bouton "menu" avec display: none\n- Rendre le contenu "contenu" display: inline-block',
            'instructionsDarija' => 'Ktib code CSS kay9der :\n- Cacher bouton "menu" bach display: none\n- Rendre contenu "contenu" display: inline-block',
            'starter' => '---\n.menu { /* votre code */ }\n.contenu { /* votre code */ }\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'display: none'],
                ['type' => 'html_contains', 'value' => 'display: inline-block'],
            ],
            'hints' => [
                'Use `display: none` to hide the element.',
                'Use `display: inline-block` to make the element behave like an inline element while allowing width/height settings.',
            ],
            'solution' => '.menu { display: none; }\n.contenu { display: inline-block; }',
            'explainFr' => 'Le bouton est caché et le contenu s\'affiche en inline-block.',
            'explainDarija' => 'Bouton kay9der kay9der w contenu kay9der afficher en inline-block.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — display flex et masquer/show dynamique',
            'lang'  => 'css',
            'instructions' => 'Crée une règle CSS qui :\n- Définit un conteneur display: flex\n- Cache un enfant display: none\n- Ajoute une règle :hover pour rendre l\'élément visible',
            'instructionsDarija' => 'Ktib règle CSS kay9der :\n- Définir conteneur display: flex\n- Cache enfant display: none\n- Ajoute règle :hover bach rendre visible',
            'starter' => '---\n.conteneur { /* votre code */ }\n.enfant { /* votre code */ }\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'display: flex'],
                ['type' => 'html_contains', 'value' => 'display: none'],
                ['type' => 'html_contains', 'value' => ':hover'],
            ],
            'hints' => [
                'Use `display: flex` on the parent container.',
                'Use `display: none` to hide the child initially.',
                'Use `:hover` to show the child on mouse over.',
            ],
            'solution' => '.conteneur { display: flex; }\n.enfant { display: none; }\n.conteneur:hover .enfant { display: block; }',
            'explainFr' => 'Le conteneur est en mode flex, l\'enfant est caché au repos et s\'affiche au survol.',
            'explainDarija' => 'Conteneur en mode flex, enfant kay9der kay9der bach survol w kay9der afficher.',
        ],
    ],
];