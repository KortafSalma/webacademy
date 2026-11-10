<?php

declare(strict_types=1);

/**
 * Exercices du chapitre css-ch3 — Sélecteurs.
 * Schéma OBLIGATOIRE : 3 niveaux (Débutant, Intermédiaire, Avancé).
 */

return [
    'id'    => 'css-ex3',
    'title' => 'Sélecteurs',
    'brief' => 'Identifie les bons sélecteurs CSS et applique les styles correctement.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — identifie le sélecteur correct',
            'lang'  => 'css',
            'instructions' => 'Choisis le sélecteur CSS qui ciblera le titre h1 parmi les suivantes :\n\n1. .title\n2. h1\n3. #title\n\nÉcris le numéro du bon sélecteur (1, 2 ou 3).',
            'instructionsDarija' => 'Kmll sélecteur CSS kay9der y9der h1 bach l9der :\n\n1. .title\n2. h1\n3. #title\n\nKtib n9mer el correct (1, 2 ou 3).',
            'starter' => '---\n1. .title\n2. h1\n3. #title\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => '2'],
            ],
            'hints' => [
                'Le sélecteur h1 ciblage directement l\'élément h1.',
                'Les classes commencent par un point . et les IDs par un #.',
            ],
            'solution' => '2',
            'explainFr' => 'Le sélecteur h1 cible parfaitement l\'élément de titre principal.',
            'explainDarija' => 'Sélecteur h1 kay9der tkoun tk target l\'élément titre principal.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — applique un style à plusieurs éléments',
            'lang'  => 'css',
            'instructions' => 'Écrit le bloc CSS qui va :\n- Mettre la couleur de texte en bleu pour tous les paragraphes (p)\n- Mettre la police en italique pour tous les liens (a)\n- Donner une couleur de fond jaune aux en-têtes de niveau 2 (h2)',
            'instructionsDarija' => 'Ktib bloc CSS kay9der :\n- Couleur texte bleu bach tous les paragraphes (p)\n- Police italique bach tous les liens (a)\n- Couleur fond jaune bach en-têtes niveau 2 (h2)',
            'starter' => '---\np { color: /* votre code */ }\na { font-style: /* votre code */ }\nh2 { background: /* votre code */ }\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'color: blue'],
                ['type' => 'html_contains', 'value' => 'font-style: italic'],
                ['type' => 'html_contains', 'value' => 'background: yellow'],
            ],
            'hints' => [
                'Use `color: blue` for text color.',
                'Use `font-style: italic` for italic text.',
                'Use `background: yellow` for background color.',
            ],
            'solution' => 'p { color: blue; }\na { font-style: italic; }\nh2 { background: yellow; }',
            'explainFr' => 'Ces trois règles CSS cibleront respectivement tous les paragraphes, liens et en-têtes de niveau 2.',
            'explainDarija' => 'Hada 3 règles CSS kay9der target bach tous les paragraphes, liens w en-têtes niveau 2.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — sélecteur de contexte et pseudo-classes',
            'lang'  => 'css',
            'instructions' => 'Crée une règle CSS qui :\n- Cible les liens à l\'intérieur de la section "footer" (ciblage descendant)\n- Change leur couleur en gris quand ils sont hover\n- Ajoute une petite flèche à droite via une bordure droite simulée',
            'instructionsDarija' => 'Ktib règle CSS kay9der :\n- Cibler liens f9der section "footer" (ciblage descendant)\n- Change couleur gris bach hover\n- Ajoute petite flèche droite bach border droite simulée',
            'starter' => '---\nfooter a { color: /* votre code */ }\nfooter a:hover { color: /* votre code */ }\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'footer a'],
                ['type' => 'html_contains', 'value' => 'footer a:hover'],
                ['type' => 'html_contains', 'value' => 'border-right'],
            ],
            'hints' => [
                'Use `footer a` to target links inside the footer.',
                'Use `:hover` pseudo-class for the hover state.',
                'Use `border-right: 4px solid;` to create a simple arrow effect.',
            ],
            'solution' => 'footer a { color: #666; }\nfooter a:hover { color: #333; }\nfooter a { border-right: 4px solid #666; padding-right: 8px; }',
            'explainFr' => 'Cette règle cible les liens à l\'intérieur du footer, change leur couleur au survol et ajoute une petite flèche à droite.',
            'explainDarija' => 'Hada rule kay9der liens f9der footer, change couleur bach hover w kay9der flèche droite bach border. ',
        ],
    ],
];