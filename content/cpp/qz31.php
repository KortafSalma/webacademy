<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Algorithmes STL : trier, rechercher et filtrer',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Que représente end() ?',
            'options' => [
                'La position après le dernier élément',
                'Le dernier élément',
                'Toujours nullptr'
            ],
            'answer' => 0,
            'concept' => 'Algorithmes STL : trier, rechercher et filtrer',
            'explainFr' => 'L’intervalle exclut end.',
            'explainDarija' => 'Intervalle ma kaydkhelch end.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que renvoie find si la valeur est absente ?',
            'options' => [
                'L’itérateur de fin fourni',
                'Le premier élément',
                'Toujours 0'
            ],
            'answer' => 0,
            'concept' => 'Algorithmes STL : trier, rechercher et filtrer',
            'explainFr' => 'Comparer le résultat à end avant de le déréférencer.',
            'explainDarija' => 'Qaren m3a end 9bel dereference.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel algorithme compte selon un prédicat ?',
            'options' => [
                'count_if',
                'sort',
                'erase seulement'
            ],
            'answer' => 0,
            'concept' => 'Algorithmes STL : trier, rechercher et filtrer',
            'explainFr' => 'count_if n’altère pas la collection.',
            'explainDarija' => 'count_if ma kaybeddelch collection.'
        ],
        [
            'type' => 'mcq',
            'question' => 'std::sort accepte-t-il directement les itérateurs de std::list ?',
            'options' => [
                'Non, utiliser list.sort()',
                'Oui, toujours',
                'Oui, uniquement à vide'
            ],
            'answer' => 0,
            'concept' => 'Algorithmes STL : trier, rechercher et filtrer',
            'explainFr' => 'std::sort exige des itérateurs à accès aléatoire.',
            'explainDarija' => 'sort khas accès aléatoire; list 3endha sort dyalha.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel en-tête déclare sort et count_if ?',
            'options' => [
                'algorithm',
                'iostream seulement',
                'string seulement'
            ],
            'answer' => 0,
            'concept' => 'Algorithmes STL : trier, rechercher et filtrer',
            'explainFr' => 'Ces fonctions sont déclarées dans algorithm.',
            'explainDarija' => 'Had algorithmes f algorithm.'
        ]
    ]
];
