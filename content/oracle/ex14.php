<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch12 — Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex14',
    'title' => 'Exercices — Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX',
    'brief' => 'Statistiques sur des jeux de données : compter, additionner, moyennes, extremums.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — COUNT(*)',
            'lang'  => 'oracle',
            'instructions' => '<p>Combien y a-t-il de lignes dans la table "clients" ?</p>',
            'instructionsDarija' => '<p>Kay lignes table "clients" ?</p>',
            'starter' => 'SELECT COUNT(*) FROM clients',
            'hints' => [
                'COUNT(*) compte toutes les lignes, y compris les NULL.',
                'Utilisez-la pour connaître le nombre total d\'enregistrements.',
            ],
            'solution' => 'SELECT COUNT(*) FROM clients',
            'explainFr' => 'COUNT(*) retourne le nombre total de lignes de la table.',
            'explainDarija' => 'COUNT(*) retourne nombre total lignes table.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — COUNT(colonne)',
            'lang'  => 'oracle',
            'instructions' => '<p>Combien de clients ont fourni leur adresse email ?</p>',
            'instructionsDarija' => '<p>Kay clients fourni email ?</p>',
            'starter' => 'SELECT COUNT(email) FROM clients',
            'hints' => [
                'COUNT(colonne) ne compte que les lignes où la colonne n\'est pas NULL.',
                'Différenciez COUNT(*) et COUNT(colonne).',
            ],
            'solution' => 'SELECT COUNT(email) FROM clients',
            'explainFr' => 'COUNT(email) compte le nombre de lignes où email n\'est pas NULL.',
            'explainDarija' => 'COUNT(email) compte lignes où email non NULL.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — SUM',
            'lang'  => 'oracle',
            'instructions' => '<p>Calculez la somme des prix de tous les produits de la table "produits".</p>',
            'instructionsDarija' => '<p>Somme prix tous produits table "produits".</p>',
            'starter' => 'SELECT SUM(prix) FROM produits',
            'hints' => [
                'SUM additionne toutes les valeurs d\'une colonne numérique.',
                'Les valeurs NULL sont ignorées par SUM.',
            ],
            'solution' => 'SELECT SUM(prix) FROM produits',
            'explainFr' => 'SUM additionne toutes les valeurs numériques de la colonne spécifiée.',
            'explainDarija' => 'SUM additionne valeurs numériques colonne spécifiée.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — AVG',
            'lang'  => 'oracle',
            'instructions' => '<p>Calculez la moyenne des prix des produits.</p>',
            'instructionsDarija' => '<p>Moyenne prix produits.</p>',
            'starter' => 'SELECT AVG(prix) FROM produits',
            'hints' => [
                'AVG calcule la moyenne arithmétique.',
                'Les valeurs NULL sont ignorées par AVG.',
            ],
            'solution' => 'SELECT AVG(prix) FROM produits',
            'explainFr' => 'AVG calcule la moyenne arithmétique des valeurs d\'une colonne numérique.',
            'explainDarija' => 'AVG calcule moyenne arithmétique valeurs colonne.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — MIN et MAX',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelles sont les valeurs minimales et maximales de la colonne "prix" dans la table "produits" ?</p>',
            'instructionsDarija' => '<p>Kay valeurs minimales maximales colonne "prix" table "produits" ?</p>',
            'starter' => 'SELECT MIN(prix), MAX(prix) FROM produits',
            'hints' => [
                'MIN retourne la valeur minimale.',
                'MAX retourne la valeur maximale.',
                'Peut s\'utiliser sur des nombres ou des dates.',
            ],
            'solution' => 'SELECT MIN(prix), MAX(prix) FROM produits',
            'explainFr' => 'MIN et MAX retournent respectivement la valeur la plus petite et la plus grande d\'une colonne.',
            'explainDarija' => 'MIN MAX retournent respectivement valeur plus petite plus grande colonne.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];