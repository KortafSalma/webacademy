<?php
declare(strict_types=1);

return [
    'id' => 'sql-ch15',
    'title' => 'CTE : organiser les requêtes avec WITH',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Nommer un résultat intermédiaire.',
        'Comprendre : Décomposer une agrégation.',
        'Comprendre : Comprendre la portée.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Nommer un résultat intermédiaire',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p><code>WITH nom AS (...)</code> définit une expression de table commune (CTE), utilisable par l’instruction qui suit. Elle ne crée pas une table permanente. Les exemples utilisent SQLite et VALUES pour ne dépendre d’aucune donnée locale. Les colonnes nom et note sont explicitement nommées dans la déclaration.</p>',
                    'darija' => '<p>WITH kay3ti smiya l résultat intermédiaire f instruction wa7da. Ma kaycréich table permanente. Exemples SQLite b VALUES bach ma n7tajoch données locales. Colonnes nom w note msemmyin f déclaration.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Nommer un résultat intermédiaire',
                    'lang' => 'sql',
                    'code' => 'WITH notes(nom, note) AS (
  VALUES (\'Amal\', 18), (\'Yassine\', 9), (\'Salma\', 16)
)
SELECT nom, note FROM notes WHERE note >= 10 ORDER BY note DESC;',
                    'output' => 'Amal | 18
Salma | 16',
                    'explainFr' => '<code>WITH nom AS (...)</code> définit une expression de table commune (CTE), utilisable par l’instruction qui suit. Elle ne crée pas une table permanente. Les exemples utilisent SQLite et VALUES pour ne dépendre d’aucune donnée locale. Les colonnes nom et note sont explicitement nommées dans la déclaration.',
                    'explainDarija' => 'WITH kay3ti smiya l résultat intermédiaire f instruction wa7da. Ma kaycréich table permanente. Exemples SQLite b VALUES bach ma n7tajoch données locales. Colonnes nom w note msemmyin f déclaration.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Décomposer une agrégation',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Plusieurs CTE se séparent par des virgules après un seul WITH. ventes décrit les entrées et totaux regroupe les montants par client. Le SELECT final filtre le résultat agrégé. Chaque étape porte un nom qui explique son rôle ; cela aide à relire la requête sans changer son résultat.</p>',
                    'darija' => '<p>Plusieurs CTE kaytfer9o b virgule w WITH wa7ed. ventes entrées, totaux kayjme3 montant l kol client. SELECT final kayfiltri agrégat. Kol étape smitha katشرح rôle dyalha.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Décomposer une agrégation',
                    'lang' => 'sql',
                    'code' => 'WITH ventes(client, montant) AS (
  VALUES (\'Amal\', 40), (\'Amal\', 70), (\'Salma\', 30)
), totaux AS (
  SELECT client, SUM(montant) AS total FROM ventes GROUP BY client
)
SELECT client, total FROM totaux WHERE total >= 100 ORDER BY client;',
                    'output' => 'Amal | 110',
                    'explainFr' => 'Plusieurs CTE se séparent par des virgules après un seul WITH. ventes décrit les entrées et totaux regroupe les montants par client. Le SELECT final filtre le résultat agrégé. Chaque étape porte un nom qui explique son rôle ; cela aide à relire la requête sans changer son résultat.',
                    'explainDarija' => 'Plusieurs CTE kaytfer9o b virgule w WITH wa7ed. ventes entrées, totaux kayjme3 montant l kol client. SELECT final kayfiltri agrégat. Kol étape smitha katشرح rôle dyalha.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Comprendre la portée',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Une CTE cesse d’exister à la fin de l’instruction. Pour réutiliser une logique dans plusieurs requêtes, envisagez une vue. Une CTE n’accélère pas automatiquement une requête : commencez par un résultat correct, puis examinez le plan d’exécution si nécessaire. Une instruction différente doit redéclarer la CTE.</p>',
                    'darija' => '<p>CTE katsali m3a instruction. Ila bghiti logique f plusieurs requêtes chof vue. CTE ma katserre3ch automatiquement: lwel résultat s7i7, men ba3d plan exécution. Instruction jdida khas t3awed CTE.</p>'
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Réutiliser une CTE dans une instruction suivante',
            'fix' => 'Redéclarer la CTE ou créer une vue adaptée.',
            'fr' => 'Redéclarer la CTE ou créer une vue adaptée.',
            'darija' => 'CTE ma katb9ach f instruction jaya.'
        ]
    ],
    'summary' => [
        'fr' => '<code>WITH nom AS (...)</code> définit une expression de table commune (CTE), utilisable par l’instruction qui suit. Elle ne crée pas une table permanente. Les exemples utilisent SQLite et VALUES pour ne dépendre d’aucune donnée locale. Les colonnes nom et note sont explicitement nommées dans la déclaration. Plusieurs CTE se séparent par des virgules après un seul WITH. ventes décrit les entrées et totaux regroupe les montants par client. Le SELECT final filtre le résultat agrégé. Chaque étape porte un nom qui explique son rôle ; cela aide à relire la requête sans changer son résultat. Une CTE cesse d’exister à la fin de l’instruction. Pour réutiliser une logique dans plusieurs requêtes, envisagez une vue. Une CTE n’accélère pas automatiquement une requête : commencez par un résultat correct, puis examinez le plan d’exécution si nécessaire. Une instruction différente doit redéclarer la CTE.',
        'darija' => 'WITH kay3ti smiya l résultat intermédiaire f instruction wa7da. Ma kaycréich table permanente. Exemples SQLite b VALUES bach ma n7tajoch données locales. Colonnes nom w note msemmyin f déclaration. Plusieurs CTE kaytfer9o b virgule w WITH wa7ed. ventes entrées, totaux kayjme3 montant l kol client. SELECT final kayfiltri agrégat. Kol étape smitha katشرح rôle dyalha. CTE katsali m3a instruction. Ila bghiti logique f plusieurs requêtes chof vue. CTE ma katserre3ch automatiquement: lwel résultat s7i7, men ba3d plan exécution. Instruction jdida khas t3awed CTE.'
    ]
];
