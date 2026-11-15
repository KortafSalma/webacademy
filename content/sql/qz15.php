<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — CTE : organiser les requêtes avec WITH',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Quelle est la portée d’une CTE ?',
            'options' => [
                'Une instruction SQL',
                'Toute la base définitivement',
                'Tous les utilisateurs'
            ],
            'answer' => 0,
            'concept' => 'CTE : organiser les requêtes avec WITH',
            'explainFr' => 'La CTE appartient à une seule instruction.',
            'explainDarija' => 'CTE dyal instruction wa7da.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Comment séparer deux CTE ?',
            'options' => [
                'Avec une virgule',
                'Avec un DROP',
                'Avec deux WITH sans liaison'
            ],
            'answer' => 0,
            'concept' => 'CTE : organiser les requêtes avec WITH',
            'explainFr' => 'Un seul WITH déclare plusieurs CTE séparées par des virgules.',
            'explainDarija' => 'WITH wa7ed w virgule bin CTE.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que fait SUM(montant) GROUP BY client ?',
            'options' => [
                'Un total par client',
                'Une suppression de ventes',
                'Un total par caractère'
            ],
            'answer' => 0,
            'concept' => 'CTE : organiser les requêtes avec WITH',
            'explainFr' => 'GROUP BY rassemble les lignes de chaque client.',
            'explainDarija' => 'GROUP BY kayjme3 lignes l kol client.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Une CTE crée-t-elle une table permanente ?',
            'options' => [
                'Non',
                'Oui, toujours',
                'Seulement si son nom est court'
            ],
            'answer' => 0,
            'concept' => 'CTE : organiser les requêtes avec WITH',
            'explainFr' => 'WITH ne crée pas de table persistante.',
            'explainDarija' => 'WITH ma kaycréich table permanente.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel mot-clé introduit une CTE ?',
            'options' => [
                'WITH',
                'WHERE',
                'DROP'
            ],
            'answer' => 0,
            'concept' => 'CTE : organiser les requêtes avec WITH',
            'explainFr' => 'WITH nomme les résultats intermédiaires.',
            'explainDarija' => 'WITH kaysemmi résultats intermédiaires.'
        ]
    ]
];
