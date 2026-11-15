<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Fonctions de fenêtrage : classement et cumul',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Quelle clause introduit une fenêtre ?',
            'options' => [
                'OVER',
                'DELETE',
                'VALUES seulement'
            ],
            'answer' => 0,
            'concept' => 'Fonctions de fenêtrage : classement et cumul',
            'explainFr' => 'OVER définit la fenêtre du calcul.',
            'explainDarija' => 'OVER katحدد fenêtre.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quels rangs donne DENSE_RANK pour 18,18,14 en ordre décroissant ?',
            'options' => [
                '1,1,2',
                '1,2,3',
                '1,1,3'
            ],
            'answer' => 0,
            'concept' => 'Fonctions de fenêtrage : classement et cumul',
            'explainFr' => 'Les égalités partagent le rang et le rang suivant reste contigu.',
            'explainDarija' => 'Égalités nafs rang w bla trou.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Où filtrer une valeur calculée par fenêtre ?',
            'options' => [
                'Dans un SELECT extérieur via une CTE',
                'Dans le WHERE du même SELECT',
                'Uniquement dans INSERT'
            ],
            'answer' => 0,
            'concept' => 'Fonctions de fenêtrage : classement et cumul',
            'explainFr' => 'Le calcul doit précéder le filtre extérieur.',
            'explainDarija' => 'Lwel calcul, men ba3d filtre barra.'
        ],
        [
            'type' => 'mcq',
            'question' => 'L’ordre de OVER garantit-il à lui seul l’ordre final d’affichage ?',
            'options' => [
                'Non',
                'Oui',
                'Seulement sans données'
            ],
            'answer' => 0,
            'concept' => 'Fonctions de fenêtrage : classement et cumul',
            'explainFr' => 'Il faut un ORDER BY final pour garantir l’ordre d’affichage.',
            'explainDarija' => 'Khass ORDER BY final bach tضمن affichage.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle clause sépare les groupes de calcul sans réduire les lignes ?',
            'options' => [
                'PARTITION BY',
                'DROP TABLE',
                'LIMIT'
            ],
            'answer' => 0,
            'concept' => 'Fonctions de fenêtrage : classement et cumul',
            'explainFr' => 'PARTITION BY définit les partitions de la fenêtre.',
            'explainDarija' => 'PARTITION BY kat9sem groupes dyal fenêtre.'
        ]
    ]
];
