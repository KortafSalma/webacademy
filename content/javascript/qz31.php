<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Expressions régulières : rechercher et valider',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Que vérifie ^[a-z]+$ ?',
            'options' => [
                'Toute la chaîne : lettres minuscules',
                'Un chiffre quelconque',
                'Un texte quelconque'
            ],
            'answer' => 0,
            'concept' => 'Expressions régulières : rechercher et valider',
            'explainFr' => 'Les ancres imposent le motif à toute la valeur.',
            'explainDarija' => 'Ancres kayferdo motif 3la valeur kamla.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle méthode renvoie un booléen ?',
            'options' => [
                'match',
                'test',
                'replace'
            ],
            'answer' => 1,
            'concept' => 'Expressions régulières : rechercher et valider',
            'explainFr' => 'RegExp.test retourne true ou false.',
            'explainDarija' => 'test katrje3 true wla false.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que renvoie match sans correspondance ?',
            'options' => [
                'null',
                'Toujours []',
                '0'
            ],
            'answer' => 0,
            'concept' => 'Expressions régulières : rechercher et valider',
            'explainFr' => 'Prévoir null avant de traiter le résultat comme un tableau.',
            'explainDarija' => 'Khass t7seb null 9bel traitement tableau.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel drapeau recherche toutes les correspondances ?',
            'options' => [
                'g',
                'i',
                'm'
            ],
            'answer' => 0,
            'concept' => 'Expressions régulières : rechercher et valider',
            'explainFr' => 'g active la recherche globale.',
            'explainDarija' => 'g kay9elleb 3la ga3 correspondances.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Pourquoi éviter un même RegExp global pour des validations indépendantes ?',
            'options' => [
                'Son lastIndex change',
                'Il transforme la chaîne',
                'Il bloque toute recherche'
            ],
            'answer' => 0,
            'concept' => 'Expressions régulières : rechercher et valider',
            'explainFr' => 'Le moteur conserve une position de recherche dans lastIndex.',
            'explainDarija' => 'RegExp global kay7fed position f lastIndex.'
        ]
    ]
];
