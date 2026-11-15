<?php
declare(strict_types=1);

return [
    'id' => 'sql-ex16',
    'title' => 'Fonctions de fenêtrage : classement et cumul',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Classez Amal 18, Salma 18 et Yassine 14 avec DENSE_RANK ; conservez les trois lignes et les égalités.',
            'lang' => 'sql',
            'instructions' => '<p>Classez Amal 18, Salma 18 et Yassine 14 avec DENSE_RANK ; conservez les trois lignes et les égalités.</p>',
            'instructionsDarija' => '<p>Sta3mel DENSE_RANK: jouj notes 18 b rang 1, note 14 b rang 2.</p>',
            'starter' => '-- Votre requête
',
            'tests' => [
                [
                    'type' => 'sql_ok',
                    'value' => ''
                ],
                [
                    'type' => 'row_count',
                    'value' => '3'
                ],
                [
                    'type' => 'result_has',
                    'value' => [
                        'Yassine',
                        '14',
                        '2'
                    ]
                ]
            ],
            'hints' => [
                'DENSE_RANK donne le même rang aux notes égales sans trou après une égalité. ROW_NUMBER numérote chaque ligne ; un critère de tri unique est nécessaire pour rendre cette numérotation déterministe. L’ordre dans OVER ne remplace pas l’ordre final d’affichage : ajoutez le ORDER BY final voulu.'
            ],
            'solution' => 'WITH notes(nom, note) AS (
  VALUES (\'Amal\', 18), (\'Salma\', 18), (\'Yassine\', 14)
)
SELECT nom, note,
  DENSE_RANK() OVER (ORDER BY note DESC) AS rang
FROM notes ORDER BY note DESC, nom;',
            'explainFr' => 'Résultat attendu : Amal | 18 | 1 ; Salma | 18 | 1 ; Yassine | 14 | 2. DENSE_RANK donne le même rang aux notes égales sans trou après une égalité. ROW_NUMBER numérote chaque ligne ; un critère de tri unique est nécessaire pour rendre cette numérotation déterministe. L’ordre dans OVER ne remplace pas l’ordre final d’affichage : ajoutez le ORDER BY final voulu.',
            'explainDarija' => 'Sta3mel DENSE_RANK: jouj notes 18 b rang 1, note 14 b rang 2.'
        ],
        [
            'level' => 2,
            'title' => 'Calculez les cumuls de 10, 20 puis 5, ordonnés par jour, avec un cadre ROWS explicite.',
            'lang' => 'sql',
            'instructions' => '<p>Calculez les cumuls de 10, 20 puis 5, ordonnés par jour, avec un cadre ROWS explicite.</p>',
            'instructionsDarija' => '<p>7seb cumul 10, 20 w 5 b ordre jour w cadre ROWS.</p>',
            'starter' => '-- Votre requête
',
            'tests' => [
                [
                    'type' => 'sql_ok',
                    'value' => ''
                ],
                [
                    'type' => 'row_count',
                    'value' => '3'
                ],
                [
                    'type' => 'result_has',
                    'value' => [
                        '3',
                        '5',
                        '35'
                    ]
                ]
            ],
            'hints' => [
                'Le cadre ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW va du début jusqu’à la ligne courante. Utilisez un ordre unique pour un cumul reproductible. Pour filtrer sur le résultat d’une fenêtre, calculez-le dans une CTE, puis filtrez dans le SELECT extérieur : le WHERE du même niveau ne peut pas utiliser ce résultat.'
            ],
            'solution' => 'WITH ventes(jour, montant) AS (
  VALUES (1, 10), (2, 20), (3, 5)
)
SELECT jour, montant,
  SUM(montant) OVER (ORDER BY jour
    ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cumul
FROM ventes ORDER BY jour;',
            'explainFr' => 'Résultat attendu : 10 puis 30 puis 35. Le cadre ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW va du début jusqu’à la ligne courante. Utilisez un ordre unique pour un cumul reproductible. Pour filtrer sur le résultat d’une fenêtre, calculez-le dans une CTE, puis filtrez dans le SELECT extérieur : le WHERE du même niveau ne peut pas utiliser ce résultat.',
            'explainDarija' => '7seb cumul 10, 20 w 5 b ordre jour w cadre ROWS.'
        ]
    ]
];
