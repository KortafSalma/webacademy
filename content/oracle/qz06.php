<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch9 — SELECT, WHERE, ORDER BY et DISTINCT.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — SELECT, WHERE, ORDER BY et DISTINCT',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La clause WHERE permet de :',
            'options' => [' Trier les résultats', 'Filtrer les lignes', 'Grouper les lignes', 'Afficher les colonnes'],
            'answer'  => 1,
            'concept' => 'Clause WHERE',
            'explainFr' => 'WHERE filtre les lignes qui satisfont la condition spécifiée.',
            'explainDarija' => 'WHERE filtre lignes satisfont condition.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot-clé qui élimine les doublons dans le résultat s\'appelle ________.',
            'expected'=> 'DISTINCT',
            'accept'  => ['DISTINCT', 'distinct'],
            'concept' => 'Clause DISTINCT',
            'explainFr' => 'DISTINCT élimine les lignes en doublon dans le résultat de SELECT.',
            'explainDarija' => 'DISTINCT eliminate doublons résultat.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'ORDER BY trie le résultat final par défaut dans l\'ordre croissant (ASC).',
            'answer'  => 1,
            'concept' => 'Clause ORDER BY',
            'explainFr' => 'Vrai : Par défaut, ORDER BY trie par ordre croissant. Pour décroissant, ajoutez DESC.',
            'explainDarija' => 'Vrai : Par défaut ORDER BY ordre croissant ajouter DESC décroissant.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur potentielle : SELECT id, nom FROM clients WHERE nom = Mohamed',
            'options' => ['Oubli guillemets simples', 'Pas d\'erreur', 'Type de colonne incorrect', 'Alias manquant'],
            'answer'  => 0,
            'concept' => 'Syntaxe WHERE texte',
            'explainFr' => 'En Oracle, les valeurs de texte doivent être entourées de guillemets simples : WHERE nom = \'Mohamed\'.',
            'explainDarija' => 'Valeurs texte doivent guillemets simples WHERE nom = Mohamed.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la commande : SELECT DISTINCT ville FROM commandes ORDER BY ville ASC ;',
            'options' => ['Villes triées par ordre alphabétique croissant', 'Erreur de syntaxe', 'Aucun résultat', 'Doublons conservés'],
            'answer'  => 0,
            'concept' => 'DISTINCT + ORDER BY',
            'explainFr' => 'La requête affichera les villes uniques triées de A à Z.',
            'explainDarija' => 'Requête affichera villes uniques triées A à Z.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces clauses s\'exécute après GROUP BY dans l\'ordre d\'exécution SQL ?',
            'options' => ['WHERE', 'HAVING', 'SELECT', 'FROM'],
            'answer'  => 1,
            'concept' => 'Ordre exécution SQL',
            'explainFr' => 'L\'ordre d\'exécution est : FROM/JOINs → WHERE → GROUP BY → HAVING → SELECT → ORDER BY.',
            'explainDarija' => 'Ordre exécution : FROM/JOINs → WHERE → GROUP BY → HAVING → SELECT → ORDER BY.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause qui filtre les groupes après GROUP BY s\'appelle ________.',
            'expected'=> 'HAVING',
            'accept'  => ['HAVING', 'having'],
            'concept' => 'Clause HAVING',
            'explainFr' => 'HAVING filtre les groupes en se basant sur les fonctions d\'agrégat.',
            'explainDarija' => 'HAVING filtre groupes basée sur agrégats.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'WHERE peut être utilisé pour filtrer des résultats après un GROUP BY.',
            'answer'  => 0,
            'concept' => 'WHERE vs HAVING',
            'explainFr' => 'Faux : WHERE filtre les lignes avant le GROUP BY. Pour filtrer les groupes, il faut utiliser HAVING.',
            'explainDarija' => 'Faux : WHERE filtre lignes avant GROUP BY filtrer groupes faut HAVING.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces fonctions d\'agrégat compte le nombre total de lignes incluant les NULL ?',
            'options' => ['COUNT(*)', 'COUNT(colonne)', 'SUM', 'AVG'],
            'answer'  => 0,
            'concept' => 'Fonctions d\'agrégat',
            'explainFr' => 'COUNT(*) compte toutes les lignes, y compris celles où la colonne contient NULL.',
            'explainDarija' => 'COUNT(*) toutes lignes incluant NULL.',
        ],

    ],
];