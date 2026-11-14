<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch12 — Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La fonction COUNT(*) compte :',
            'options' => ['Toutes les lignes y compris NULL', 'Seulement les non-NULL', 'Uniquement les lignes uniques', 'Le nombre de colonnes'],
            'answer'  => 0,
            'concept' => 'COUNT(*)',
            'explainFr' => 'COUNT(*) compte toutes les lignes de la table, y compris celles qui contiennent des valeurs NULL.',
            'explainDarija' => 'COUNT(*) toutes lignes incluant NULL.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La fonction qui additionne toutes les valeurs numériques d\'une colonne s\'appelle ________.',
            'expected'=> 'SUM',
            'accept'  => ['SUM', 'sum'],
            'concept' => 'Fonction SUM',
            'explainFr' => 'SUM additionne toutes les valeurs numériques d\'une colonne.',
            'explainDarija' => 'SUM additionne valeurs numériques colonne.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'La fonction AVG ignore les valeurs NULL dans son calcul de la moyenne.',
            'answer'  => 1,
            'concept' => 'Fonction AVG',
            'explainFr' => 'Vrai : AVG ne prend en compte que les valeurs non NULL pour calculer la moyenne.',
            'explainDarija' => 'Vrai : AVG ne prend NULL compte moyenne.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : SELECT AVG(prix) FROM produits WHERE prix > 0',
            'options' => ['Oguille erreur', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Fonction incompatibles'],
            'answer'  => 2,
            'concept' => 'Syntaxe SELECT avec agrégat',
            'explainFr' => 'La syntaxe est correcte : SELECT AVG(prix) FROM produits WHERE prix > 0 est valide.',
            'explainDarija' => 'Syntaxe correcte SELECT AVG(prix) FROM produits WHERE prix > 0 valide.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que retournera SELECT MIN(prix) FROM produits ;',
            'options' => ['Le prix le plus bas', 'Le prix le plus haut', 'La moyenne des prix', 'Le nombre de produits'],
            'answer'  => 0,
            'concept' => 'Fonction MIN',
            'explainFr' => 'MIN retourne la valeur minimale de la colonne spécifiée.',
            'explainDarija' => 'MIN retourne valeur minimale colonne spécifiée.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces fonctions d\'agrégat peut être utilisée avec DISTINCT ?',
            'options' => ['COUNT(DISTINCT colonne)', 'SUM(DISTINCT colonne)', 'AVG(DISTINCT colonne)', 'Toutes les réponses ci-dessus'],
            'answer'  => 3,
            'concept' => 'Agrégat DISTINCT',
            'explainFr' => 'Certaines fonctions comme COUNT, AVG et VARIANCE prennent en option DISTINCT pour compter/calculer sur des valeurs uniques.',
            'explainDarija' => 'Certaines fonctions comme COUNT AVG VARIANCE option DISTINCT valeurs uniques.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La fonction qui retourne la valeur minimale d\'une colonne s\'appelle ________.',
            'expected'=> 'MIN',
            'accept'  => ['MIN', 'min'],
            'concept' => 'Fonction MIN',
            'explainFr' => 'MIN retourne la valeur la plus petite d\'une colonne.',
            'explainDarija' => 'MIN retourne valeur minimale colonne.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'SUM ignore les valeurs NULL (ne les compte pas dans l\'addition).',
            'answer'  => 1,
            'concept' => 'Fonction SUM',
            'explainFr' => 'Vrai : Les valeurs NULL sont ignorées par SUM dans le calcul de l\'addition.',
            'explainDarija' => 'Vrai : NULL ignorés SUM addition.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces requêtes calculera la moyenne des prix des produits ?',
            'options' => ['SELECT AVG(prix) FROM produits', 'SELECT SUM(prix) FROM produits', 'SELECT COUNT(prix) FROM produits', 'SELECT MIN(prix) FROM produits'],
            'answer'  => 0,
            'concept' => 'Fonction AVG',
            'explainFr' => 'AVG calcule la moyenne arithmétique.',
            'explainDarija' => 'AVG calcule moyenne arithmétique.',
        ],

    ],
];