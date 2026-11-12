<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch11 — Opérateurs de comparaison et logiques.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Opérateurs de comparaison et logiques',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel opérateur permet de sélectionner des valeurs comprises entre deux bornes ?',
            'options' => ['IN', 'BETWEEN', 'LIKE', 'ANY'],
            'answer'  => 1,
            'concept' => 'Opérateur BETWEEN',
            'explainFr' => 'BETWEEN permet de sélectionner des valeurs comprises entre une borne inférieure et une borne supérieure.',
            'explainDarija' => 'BETWEEN sélectionner valeurs comprise entre borne inférieure supérieure.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'L\'opérateur qui teste si une valeur appartient à une liste s\'appelle ________.',
            'expected'=> 'IN',
            'accept'  => ['IN', 'in'],
            'concept' => 'Opérateur IN',
            'explainFr' => 'L\'opérateur IN permet de tester si une valeur appartient à une liste de valeursKnown.',
            'explainDarija' => 'IN tester valeur appartient liste valeursKnown.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'L\'opérateur LIKE permet de comparer une valeur à des modèles utilisant les jokers % et _.',
            'answer'  => 1,
            'concept' => 'Opérateur LIKE',
            'explainFr' => 'Vrai : LIKE utilise % pour plusieurs caractères et _ pour un seul caractère.',
            'explainDarija' => 'Vrai : LIKE utilise % plusieurs caractères _ un seul caractère.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : SELECT * FROM produits WHERE prix > 50 AND categorie = Électronique',
            'options' => ['Oubli guillemets catégorie', 'Pas d\'erreur', 'Type de données incorrect', 'Alias manquant'],
            'answer'  => 0,
            'concept' => 'Syntaxe texte dans WHERE',
            'explainFr' => 'Les valeurs texte doivent être entourées de guillemets simples en Oracle : categorie = \\'Électronique\\'.',
            'explainDarija' => 'Valeurs texte guillemets simples Oracle : catégorie = Électronique.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Quel sera le résultat de SELECT nom, prix FROM produits WHERE prix BETWEEN 20 AND 80 ;',
            'options' => 'Produits dont le prix est compris entre 20 et 80', 'Erreur de syntaxe', 'Aucun résultat', 'Tous les produits'],
            'answer'  => 0,
            'concept' => 'Opérateur BETWEEN',
            'explainFr' => 'La requête affichera les produits dont le prix est compris entre 20 et 80 inclus.',
            'explainDarija' => 'Requête affichera produits prix compris entre 20 et 80 inclus.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel opérateur permet de tester si une valeur appartient à une liste de valeurs sans écrire plusieurs OR ?',
            'options' => ['BETWEEN', 'LIKE', 'IN', 'EXISTS'],
            'answer'  => 2,
            'concept' => 'Opérateur IN',
            'explainFr' => 'L\'opérateur IN est plus concis que plusieurs conditions OR sur la même colonne.',
            'explainDarija' => 'IN plus concis que plusieurs OR colonne identique.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le joker qui représente n\'importe quel nombre de caractères s\'appelle ________.',
            'expected'=> '%',
            'accept'  => ['%', 'pourcentage'],
            'concept' => 'Jokers LIKE',
            'explainFr' => 'Le signe % représente zéro, un ou plusieurs caractères dans le motif LIKE.',
            'explainDarija' => 'Signe % représente zéro un ou plusieurs caractères motif LIKE.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'L\'opérateur NOT inverse la valeur logique d\'une condition.',
            'answer'  => 1,
            'concept' => 'Opérateur NOT',
            'explainFr' => 'Vrai : NOT permet d\'inverser VRAI en FAUX et vice-versa.',
            'explainDarija' => 'Vrai : NOT inverse VRAI en FAUX et vice-versa.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces requêtes retournera les clients de Paris, Lyon ou Marseille ?',
            'options' => 'WHERE ville = \\'Paris\\' OR \\'Lyon\\' OR \\'Marseille\\', WHERE ville IN (\\'Paris\\', \\'Lyon\\', \\'Marseille\\'), SELECT * FROM clients WHERE ville LIKE \\'%Paris%\\', Toutes les réponses ci-dessus',
            'answer'  => 1,
            'concept' => 'Opérateur IN vs OR',
            'explainFr' => 'L\'opérateur IN est la façon la plus concise de spécifier plusieurs valeurs pour la même colonne.',
            'explainDarija' => 'IN façon plus concise plusieurs valeurs colonne identique.',
        ],

    ],
];