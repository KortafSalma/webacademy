<?php
declare(strict_types=1);

return [
    'id' => 'sql-ch16',
    'title' => 'Fonctions de fenêtrage : classement et cumul',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Conserver les lignes avec OVER.',
        'Comprendre : Classer les notes et les égalités.',
        'Comprendre : Définir le cadre du cumul.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Conserver les lignes avec OVER',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>GROUP BY réduit les lignes en groupes. Une fonction de fenêtrage avec OVER ajoute un calcul à chaque ligne. PARTITION BY, si présent, sépare les groupes de calcul sans supprimer leurs lignes. La fenêtre décrit quelles lignes participent au calcul courant. Les exercices ciblent SQLite.</p>',
                    'darija' => '<p>GROUP BY kay9ellel lignes l groupes. OVER kayzid calcul l kol ligne bla ma y7yedha. PARTITION BY kay9sem groupes dyal calcul. Fenêtre katحدد lignes dyal calcul courant. Exercices b SQLite.</p>'
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Classer les notes et les égalités',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>DENSE_RANK donne le même rang aux notes égales sans trou après une égalité. ROW_NUMBER numérote chaque ligne ; un critère de tri unique est nécessaire pour rendre cette numérotation déterministe. L’ordre dans OVER ne remplace pas l’ordre final d’affichage : ajoutez le ORDER BY final voulu.</p>',
                    'darija' => '<p>DENSE_RANK kay3ti nafs rang l notes mtساويين bla trou. ROW_NUMBER kaynuméroti kol ligne; zid critère unique bach résultat yb9a ثابت. ORDER BY f OVER machi ordre affichage final.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Classer les notes et les égalités',
                    'lang' => 'sql',
                    'code' => 'WITH notes(nom, note) AS (
  VALUES (\'Amal\', 18), (\'Salma\', 18), (\'Yassine\', 14)
)
SELECT nom, note,
  DENSE_RANK() OVER (ORDER BY note DESC) AS rang
FROM notes ORDER BY note DESC, nom;',
                    'output' => 'Amal | 18 | 1
Salma | 18 | 1
Yassine | 14 | 2',
                    'explainFr' => 'DENSE_RANK donne le même rang aux notes égales sans trou après une égalité. ROW_NUMBER numérote chaque ligne ; un critère de tri unique est nécessaire pour rendre cette numérotation déterministe. L’ordre dans OVER ne remplace pas l’ordre final d’affichage : ajoutez le ORDER BY final voulu.',
                    'explainDarija' => 'DENSE_RANK kay3ti nafs rang l notes mtساويين bla trou. ROW_NUMBER kaynuméroti kol ligne; zid critère unique bach résultat yb9a ثابت. ORDER BY f OVER machi ordre affichage final.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Définir le cadre du cumul',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Le cadre ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW va du début jusqu’à la ligne courante. Utilisez un ordre unique pour un cumul reproductible. Pour filtrer sur le résultat d’une fenêtre, calculez-le dans une CTE, puis filtrez dans le SELECT extérieur : le WHERE du même niveau ne peut pas utiliser ce résultat.</p>',
                    'darija' => '<p>Cadre ROWS kay7seb men lbidaya 7ta ligne courante. Ordre unique kaykhlli cumul reproductible. Bach tfiltri résultat fenêtre, dir calcul f CTE w filtre barra, machi WHERE f nafs niveau.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Définir le cadre du cumul',
                    'lang' => 'sql',
                    'code' => 'WITH ventes(jour, montant) AS (
  VALUES (1, 10), (2, 20), (3, 5)
)
SELECT jour, montant,
  SUM(montant) OVER (ORDER BY jour
    ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cumul
FROM ventes ORDER BY jour;',
                    'output' => '1 | 10 | 10
2 | 20 | 30
3 | 5 | 35',
                    'explainFr' => 'Le cadre ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW va du début jusqu’à la ligne courante. Utilisez un ordre unique pour un cumul reproductible. Pour filtrer sur le résultat d’une fenêtre, calculez-le dans une CTE, puis filtrez dans le SELECT extérieur : le WHERE du même niveau ne peut pas utiliser ce résultat.',
                    'explainDarija' => 'Cadre ROWS kay7seb men lbidaya 7ta ligne courante. Ordre unique kaykhlli cumul reproductible. Bach tfiltri résultat fenêtre, dir calcul f CTE w filtre barra, machi WHERE f nafs niveau.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Confondre fenêtre de calcul et tri final',
            'fix' => 'Définir séparément OVER (...) et ORDER BY final.',
            'fr' => 'Définir séparément OVER (...) et ORDER BY final.',
            'darija' => 'Ordre calcul w ordre affichage jouj 7wayej mokhtalfin.'
        ]
    ],
    'summary' => [
        'fr' => 'GROUP BY réduit les lignes en groupes. Une fonction de fenêtrage avec OVER ajoute un calcul à chaque ligne. PARTITION BY, si présent, sépare les groupes de calcul sans supprimer leurs lignes. La fenêtre décrit quelles lignes participent au calcul courant. Les exercices ciblent SQLite. DENSE_RANK donne le même rang aux notes égales sans trou après une égalité. ROW_NUMBER numérote chaque ligne ; un critère de tri unique est nécessaire pour rendre cette numérotation déterministe. L’ordre dans OVER ne remplace pas l’ordre final d’affichage : ajoutez le ORDER BY final voulu. Le cadre ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW va du début jusqu’à la ligne courante. Utilisez un ordre unique pour un cumul reproductible. Pour filtrer sur le résultat d’une fenêtre, calculez-le dans une CTE, puis filtrez dans le SELECT extérieur : le WHERE du même niveau ne peut pas utiliser ce résultat.',
        'darija' => 'GROUP BY kay9ellel lignes l groupes. OVER kayzid calcul l kol ligne bla ma y7yedha. PARTITION BY kay9sem groupes dyal calcul. Fenêtre katحدد lignes dyal calcul courant. Exercices b SQLite. DENSE_RANK kay3ti nafs rang l notes mtساويين bla trou. ROW_NUMBER kaynuméroti kol ligne; zid critère unique bach résultat yb9a ثابت. ORDER BY f OVER machi ordre affichage final. Cadre ROWS kay7seb men lbidaya 7ta ligne courante. Ordre unique kaykhlli cumul reproductible. Bach tfiltri résultat fenêtre, dir calcul f CTE w filtre barra, machi WHERE f nafs niveau.'
    ]
];
