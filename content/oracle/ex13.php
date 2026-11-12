<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch11 — Opérateurs de comparaison et logiques.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex13',
    'title' => 'Exercices — Opérateurs de comparaison et logiques',
    'brief' => 'Combiner et affiner les conditions WHERE.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Opérateur =',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les produits dont le prix est égal à 50.</p>',
            'instructionsDarija' => '<p>Sélectionner produits prix égal à 50.</p>',
            'starter' => 'SELECT nom, prix FROM produits WHERE prix = 50',
            'hints' => [
                'L\'opérateur = teste l\'égalité.',
                'Les valeurs texte doivent être entourées de guillemets simples.',
            ],
            'solution' => 'SELECT nom, prix FROM produits WHERE prix = 50',
            'explainFr' => 'L\'opérateur = permet de tester l\'égalité entre deux valeurs.',
            'explainDarija' => 'Opérateur = tester égalité deux valeurs.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Opérateur !=',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients qui ne sont pas de "Casablanca".</p>',
            'instructionsDarija' => '<p>Sélectionner clients ne sont pas "Casablanca".</p>',
            'starter' => "SELECT id, nom FROM clients WHERE ville != 'Casablanca'",
            'hints' => [
                'L\'opérateur != (ou <>) teste la différent.',
                'Entourez les valeurs texte de guillemets simples.',
            ],
            'solution' => "SELECT id, nom FROM clients WHERE ville != 'Casablanca'",
            'explainFr' => 'L\'opérateur != (ou <>) permet de tester que deux valeurs sont différentes.',
            'explainDarija' => 'Opérateur != <>) tester valeurs différentes.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — AND',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les produits dont le prix est supérieur à 50 ET de catégorie "Électronique".</p>',
            'instructionsDarija' => '<p>Sélectionner prix supérieur à 50 ET catégorie "Électronique".</p>',
            'starter' => "SELECT nom, prix, categorie FROM produits WHERE prix > 50 AND categorie = 'Électronique'",
            'hints' => [
                'AND signifie que les deux conditions doivent être VRAIES.',
                'Les deux conditions doivent être remplies.',
            ],
            'solution' => "SELECT nom, prix, categorie FROM produits WHERE prix > 50 AND categorie = 'Électronique'",
            'explainFr' => 'L\'opérateur AND combine deux conditions : les deux doivent être VRAIES pour que le résultat le soit.',
            'explainDarija' => 'AND combine deux conditions : les deux doivent être VRAIES.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — OR',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients de "Casablanca" OU dont le nom commence par "O".</p>',
            'instructionsDarija' => '<p>Sélectionner Casablanca OU nom commence par "O".</p>',
            'starter' => "SELECT id, nom, ville FROM clients WHERE ville = 'Casablanca' OR nom LIKE 'O%'",
            'hints' => [
                'OR signifie que au moins une condition doit être VRAIE.',
                'L\'un ou l\'autre condition suffit.',
            ],
            'solution' => "SELECT id, nom, ville FROM clients WHERE ville = 'Casablanca' OR nom LIKE 'O%'",
            'explainFr' => 'L\'opérateur OR combine deux conditions : au moins l\'une doit être VRAIE pour que le résultat le soit.',
            'explainDarija' => 'OR combine deux conditions : au moins une VRAIE.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — IN',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients de "Paris", "Lyon" ou "Marseille".</p>',
            'instructionsDarija' => '<p>Sélectionner Paris, Lyon ou Marseille.</p>',
            'starter' => "SELECT id, nom, ville FROM clients WHERE ville IN ('Paris', 'Lyon', 'Marseille')",
            'hints' => [
                'IN permet de tester si une valeur appartient à une liste.',
                'C\'est plus concis que plusieurs conditions OR.',
            ],
            'solution' => "SELECT id, nom, ville FROM clients WHERE ville IN ('Paris', 'Lyon', 'Marseille')",
            'explainFr' => 'L\'opérateur IN teste si la valeur appartient à une liste de valeursKnown.',
            'explainDarija' => 'IN tester valeur appartient liste valeursKnown.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];