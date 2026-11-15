<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Tester des fonctions et leurs cas limites',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Quel est un cas limite pour total(prix) ?',
            'options' => [
                'Un tableau vide',
                'Seulement [10,15]',
                'La couleur de la console'
            ],
            'answer' => 0,
            'concept' => 'Tester des fonctions et leurs cas limites',
            'explainFr' => 'Le tableau vide vérifie le comportement sans élément.',
            'explainDarija' => 'Tableau khawi kayjرب comportement bla éléments.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Pourquoi isoler le réseau d’un test unitaire de calcul ?',
            'options' => [
                'Pour un résultat reproductible',
                'Pour interdire les fonctions',
                'Pour modifier le résultat attendu'
            ],
            'answer' => 0,
            'concept' => 'Tester des fonctions et leurs cas limites',
            'explainFr' => 'Le réseau ne doit pas décider du test de calcul.',
            'explainDarija' => 'Réseau ma khasoch y7kem f test dyal calcul.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Comment comparer des décimaux calculés ?',
            'options' => [
                'Toujours ===',
                'Une tolérance adaptée',
                'Ne jamais tester'
            ],
            'answer' => 1,
            'concept' => 'Tester des fonctions et leurs cas limites',
            'explainFr' => 'Les flottants peuvent introduire un petit écart.',
            'explainDarija' => 'Flottants y9dro ydirou far9 sghir.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel bloc reçoit une exception après try ?',
            'options' => [
                'catch',
                'return',
                'switch'
            ],
            'answer' => 0,
            'concept' => 'Tester des fonctions et leurs cas limites',
            'explainFr' => 'catch permet de vérifier le type de l’exception.',
            'explainDarija' => 'catch kaychد erreur bach tverifi type.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Un exemple qui réussit prouve-t-il tous les cas ?',
            'options' => [
                'Non, il faut plusieurs cas et limites',
                'Oui, toujours',
                'Seulement si la console est vide'
            ],
            'answer' => 0,
            'concept' => 'Tester des fonctions et leurs cas limites',
            'explainFr' => 'Couvrir entrées usuelles, limites et erreurs.',
            'explainDarija' => 'Khass plusieurs cas, limites w erreurs.'
        ]
    ]
];
