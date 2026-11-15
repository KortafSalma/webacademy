<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Complexité : raisonner sur le coût des algorithmes',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Deux boucles de n tours successives, à corps constant, ont quel coût ?',
            'options' => [
                'O(n)',
                'O(n²)',
                'O(1)'
            ],
            'answer' => 0,
            'concept' => 'Complexité : raisonner sur le coût des algorithmes',
            'explainFr' => 'n + n = 2n donne une croissance linéaire.',
            'explainDarija' => '2n croissance linéaire.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Deux boucles complètes de n tours imbriquées exécutent le corps combien de fois ?',
            'options' => [
                'n²',
                '2n seulement',
                'Toujours n'
            ],
            'answer' => 0,
            'concept' => 'Complexité : raisonner sur le coût des algorithmes',
            'explainFr' => 'Le corps interne s’exécute n fois par tour externe.',
            'explainDarija' => 'Corps dakheli n marrat l kol tour barra.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Diviser la taille restante par deux conduit à combien d’étapes ?',
            'options' => [
                'O(log n)',
                'O(n²)',
                'O(n!)'
            ],
            'answer' => 0,
            'concept' => 'Complexité : raisonner sur le coût des algorithmes',
            'explainFr' => 'Chaque étape réduit le problème par un facteur constant.',
            'explainDarija' => 'Kol étape kat9sem taille b facteur constant.'
        ],
        [
            'type' => 'mcq',
            'question' => 'O(n) signifie-t-il exactement n secondes ?',
            'options' => [
                'Non',
                'Oui',
                'Seulement avec un vector'
            ],
            'answer' => 0,
            'concept' => 'Complexité : raisonner sur le coût des algorithmes',
            'explainFr' => 'O décrit une croissance, pas une durée absolue.',
            'explainDarija' => 'O croissance machi secondes.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle mémoire supplémentaire utilise un compteur seul ?',
            'options' => [
                'O(1)',
                'O(n)',
                'O(n²)'
            ],
            'answer' => 0,
            'concept' => 'Complexité : raisonner sur le coût des algorithmes',
            'explainFr' => 'Le nombre de variables ne dépend pas de n.',
            'explainDarija' => '3adad variables ma kaytbeddelch m3a n.'
        ]
    ]
];
