<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch13 — GROUP BY et HAVING.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — GROUP BY et HAVING',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La clause GROUP BY sert à :',
            'options' => ['Filtrer les lignes avant le groupement', 'Regrouper les lignes ayant les mêmes valeurs', ' Trier le résultat final', 'Sélectionner des colonnes'],
            'answer'  => 1,
            'concept' => 'Clause GROUP BY',
            'explainFr' => 'GROUP BY regroupe les lignes qui possèdent les mêmes valeurs dans les colonnes spécifiées.',
            'explainDarija' => 'GROUP BY regroupent lignes ayant mêmes valeurs colonnes spécifiées.',
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
            'question'=> 'HAVING peut être utilisé sans GROUP BY.',
            'answer'  => 0,
            'concept' => 'HAVING vs WHERE',
            'explainFr' => 'Faux : HAVING est conçu pour filtrer les groupes créés par GROUP BY. Sans GROUP BY, HAVING se comporte comme WHERE sur les agrégats.',
            'explainDarija' => 'Faux : HAVING conçu filtrer groupes créé GROUP BY sans GROUP BY HAVING se comporte LIKE WHERE sur agrégats.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : SELECT client_id, COUNT(*) FROM commandes GROUP BY client_id WHERE COUNT(*) > 3',
            'options' => ['WHERE placé après GROUP BY', 'HAVING manquant', 'Pas d\'erreur', 'Syntaxe correcte'],
            'answer'  => 0,
            'concept' => 'Erreur WHERE après GROUP BY',
            'explainFr' => 'L\'erreur consiste à écrire WHERE COUNT(*) > 5 après un GROUP BY. Cela provoque une erreur car les alias d\'agrégat n\'existent pas encore au niveau WHERE. Utilisez HAVING à la place.',
            'explainDarija' => 'Erreur WHERE COUNT(*) > 5 après GROUP BY. Erreur car alias agrégat n\'existe pas niveau WHERE. Utilisez HAVING à la place.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Quel sera le résultat de SELECT ville, COUNT(*) FROM clients GROUP BY ville HAVING COUNT(*) > 2 ;',
            'options' => ['Villes avec plus de 2 clients', 'Erreur de syntaxe', 'Toutes les villes', 'Aucune ville'],
            'answer'  => 0,
            'concept' => 'HAVING avec COUNT',
            'explainFr' => 'La requête affichera seulement les villes qui comptent plus de 2 clients.',
            'explainDarija' => 'Requête affichera villes plus de 2 clients.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Dans quel ordre s\'exécutent les clauses suivantes dans une requête SELECT ? WHERE → GROUP BY → HAVING → SELECT → ORDER BY',
            'options' => ['WHERE → GROUP BY → HAVING → SELECT → ORDER BY', 'HAVING → WHERE → GROUP BY → SELECT → ORDER BY', 'SELECT → FROM → WHERE → GROUP BY → HAVING', 'FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY'],
            'answer'  => 3,
            'concept' => 'Ordre d\'exécution SQL',
            'explainFr' => 'L\'ordre d\'exécution standard est : FROM/JOINs → WHERE → GROUP BY → HAVING → SELECT → ORDER BY.',
            'explainDarija' => 'Ordre exécution standard : FROM/JOINs → WHERE → GROUP BY → HAVING → SELECT → ORDER BY.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Sans GROUP BY, l\'utilisation d\'une fonction d\'agrégat avec une colonne non agrégée provoquera une erreur en Oracle.',
            'expected' => 'group by',
            'accept' => ['GROUP BY', 'group by'],
            'concept' => 'Regroupement requis',
            'explainFr' => 'Si vous sélectionnez une colonne non agrégée avec une fonction d\'agrégat, vous devez impérativement ajouter GROUP BY sur cette colonne.',
            'explainDarija' => 'Si sélectionnez colonne non agrégat fonction agrégat GROUP BY impératif colonne.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'ORDER BY s\'exécute avant SELECT dans l\'ordre d\'exécution SQL.',
            'answer'  => 0,
            'concept' => 'Ordre d\'exécution SQL',
            'explainFr' => 'Faux : L\'ordre est ... HAVING → SELECT → ORDER BY. ORDER BY s\'exécute après SELECT.',
            'explainDarija' => 'Faux : Ordre ... HAVING → SELECT → ORDER BY. ORDER BY exécute après SELECT.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces requêtes est correcte ?',
            'options' => ['SELECT nom, COUNT(*) FROM clients GROUP BY nom', 'SELECT COUNT(*) FROM clients', 'SELECT nom FROM clients GROUP BY COUNT(*)', 'SELECT COUNT(*) GROUP BY nom FROM clients'],
            'answer'  => 1,
            'concept' => 'Syntaxe GROUP BY',
            'explainFr' => 'La deuxième option est correcte : elle compte le nombre total de lignes dans la table clients.',
            'explainDarija' => 'Deuxième option correcte : compte nombre total lignes table clients.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause qui s\'exécute après GROUP BY pour filtrer les groupes en se basant sur des conditions d\'agrégat s\'appelle ________.',
            'expected' => 'HAVING',
            'accept' => ['HAVING', 'having'],
            'concept' => 'Clause HAVING',
            'explainFr' => 'HAVING filtre les groupes après GROUP BY en se basant sur les fonctions d\'agrégat.',
            'explainDarija' => 'HAVING filtre groupes après GROUP BY basée sur agrégats.',
        ],

    ],
];