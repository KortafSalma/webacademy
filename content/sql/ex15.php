<?php
declare(strict_types=1);

return [
    'id' => 'sql-ex15',
    'title' => 'CTE : organiser les requêtes avec WITH',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Avec notes(nom,note) = Amal 18, Yassine 9 et Salma 16, affichez les admis par note décroissante.',
            'lang' => 'sql',
            'instructions' => '<p>Avec notes(nom,note) = Amal 18, Yassine 9 et Salma 16, affichez les admis par note décroissante.</p>',
            'instructionsDarija' => '<p>Dir CTE notes w 3red li jab 10 wla kter b ordre décroissant.</p>',
            'starter' => '-- Votre requête
',
            'tests' => [
                [
                    'type' => 'sql_ok',
                    'value' => ''
                ],
                [
                    'type' => 'row_count',
                    'value' => '2'
                ],
                [
                    'type' => 'result_has',
                    'value' => [
                        'Amal',
                        '18'
                    ]
                ],
                [
                    'type' => 'result_lacks',
                    'value' => 'Yassine'
                ]
            ],
            'hints' => [
                'Plusieurs CTE se séparent par des virgules après un seul WITH. ventes décrit les entrées et totaux regroupe les montants par client. Le SELECT final filtre le résultat agrégé. Chaque étape porte un nom qui explique son rôle ; cela aide à relire la requête sans changer son résultat.'
            ],
            'solution' => 'WITH notes(nom, note) AS (
  VALUES (\'Amal\', 18), (\'Yassine\', 9), (\'Salma\', 16)
)
SELECT nom, note FROM notes WHERE note >= 10 ORDER BY note DESC;',
            'explainFr' => 'Résultat attendu : Amal | 18 puis Salma | 16. Plusieurs CTE se séparent par des virgules après un seul WITH. ventes décrit les entrées et totaux regroupe les montants par client. Le SELECT final filtre le résultat agrégé. Chaque étape porte un nom qui explique son rôle ; cela aide à relire la requête sans changer son résultat.',
            'explainDarija' => 'Dir CTE notes w 3red li jab 10 wla kter b ordre décroissant.'
        ],
        [
            'level' => 2,
            'title' => 'Créez ventes puis totaux ; affichez les clients dont le total atteint 100 à partir des ventes 40 et 70 pour Amal, 30 pour Salma.',
            'lang' => 'sql',
            'instructions' => '<p>Créez ventes puis totaux ; affichez les clients dont le total atteint 100 à partir des ventes 40 et 70 pour Amal, 30 pour Salma.</p>',
            'instructionsDarija' => '<p>Sawb ventes w totaux w rje3 clients li total dyalhom 100 wla kter.</p>',
            'starter' => '-- Votre requête
',
            'tests' => [
                [
                    'type' => 'sql_ok',
                    'value' => ''
                ],
                [
                    'type' => 'row_count',
                    'value' => '1'
                ],
                [
                    'type' => 'result_has',
                    'value' => [
                        'Amal',
                        '110'
                    ]
                ]
            ],
            'hints' => [
                'Une CTE cesse d’exister à la fin de l’instruction. Pour réutiliser une logique dans plusieurs requêtes, envisagez une vue. Une CTE n’accélère pas automatiquement une requête : commencez par un résultat correct, puis examinez le plan d’exécution si nécessaire. Une instruction différente doit redéclarer la CTE.'
            ],
            'solution' => 'WITH ventes(client, montant) AS (
  VALUES (\'Amal\', 40), (\'Amal\', 70), (\'Salma\', 30)
), totaux AS (
  SELECT client, SUM(montant) AS total FROM ventes GROUP BY client
)
SELECT client, total FROM totaux WHERE total >= 100 ORDER BY client;',
            'explainFr' => 'Résultat attendu : Amal | 110. Une CTE cesse d’exister à la fin de l’instruction. Pour réutiliser une logique dans plusieurs requêtes, envisagez une vue. Une CTE n’accélère pas automatiquement une requête : commencez par un résultat correct, puis examinez le plan d’exécution si nécessaire. Une instruction différente doit redéclarer la CTE.',
            'explainDarija' => 'Sawb ventes w totaux w rje3 clients li total dyalhom 100 wla kter.'
        ]
    ]
];
