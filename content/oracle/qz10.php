<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch14 — Jointures : INNER JOIN, LEFT JOIN, RIGHT JOIN, FULL OUTER JOIN.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Jointures : INNER JOIN, LEFT JOIN, RIGHT JOIN, FULL OUTER JOIN',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'INNER JOIN retourne les lignes :',
            'options' => ['Lorsque qu\'il y a correspondance dans les deux tables', 'Toutes les lignes de la table de gauche', 'Toutes les lignes de la table de droite', 'Lorsque qu\'il n\'y a correspondance dans aucune table'],
            'answer'  => 0,
            'concept' => 'INNER JOIN',
            'explainFr' => 'INNER JOIN ne garde que les lignes où il y a correspondance dans les deux tables impliquées.',
            'explainDarija' => 'INNER JOIN kaylik retourne lignes correspondance dans les deux tables impliquées.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause qui combine LEFT JOIN et RIGHT JOIN s\'appelle ________.',
            'expected'=> 'FULL OUTER JOIN',
            'accept'  => ['FULL OUTER JOIN', 'full outer join'],
            'concept' => 'FULL OUTER JOIN',
            'explainFr' => 'FULL OUTER JOIN combine les résultats de LEFT JOIN et RIGHT JOIN.',
            'explainDarija' => 'FULL OUTER JOIN combine LEFT JOIN w RIGHT JOIN.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'LEFT JOIN retourne toutes les lignes de la table de gauche plus les correspondances de la table de droite.',
            'answer'  => 1,
            'concept' => 'LEFT JOIN',
            'explainFr' => 'Vrai : LEFT JOIN (ou LEFT OUTER JOIN) affiche toutes les lignes de la table de gauche, ainsi que les lignes correspondantes de la table de droite. Sans correspondance, les colonnes de droite contiennent NULL.',
            'explainDarija' => 'Vrai : LEFT JOIN afficher toutes lignes table gauche correspondance droite NULL si absent.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur potentielle : SELECT * FROM clients c, commandes o WHERE c.id = o.client_id',
            'options' => ['Oubli de la clause ON dans JOIN explicite', 'Ancienne syntaxe JOIN implicite', 'Pas d\'erreur', 'Les deux sont des erreurs'],
            'answer'  => 1,
            'concept' => 'Syntaxe JOIN obsolète',
            'explainFr' => 'Bien que cette ancienne syntaxe (implicit join) fonctionne et produise un résultat similaire, elle est obsolète et peut entraîner desProduit cartésien involontaire. La syntaxe JOIN explicite avec ON est recommandée.',
            'explainDarija' => 'Syntaxe JOIN obsolète kaylik produireProduit cartésien involontaire. Syntaxe JOIN explicite avec ON recommandée.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera SELECT c.nom, o.cmd_id FROM clients c LEFT JOIN commandes o ON c.id = o.client_id WHERE o.cmd_id IS NULL ;',
            'options' => ['Clients sans commandes', 'Commandes sans clients', 'Seulement les correspondances', 'Erreur'],
            'answer'  => 0,
            'concept' => 'LEFT JOIN IS NULL',
            'explainFr' => 'Cette requête affichera les clients qui n\'ont pas encore passé de commande (les colonnes commande seront NULL).',
            'explainDarija' => 'Clients sans commandes colonnes commande NULL.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'RIGHT JOIN retourne toutes les lignes de :',
            'options' => ['La table de gauche', 'La table de droite', 'Les deux tables', 'Aucune des deux'],
            'answer'  => 1,
            'concept' => 'RIGHT JOIN',
            'explainFr' => 'RIGHT JOIN (ou RIGHT OUTER JOIN) retourne toutes les lignes de la table de droite, ainsi que les lignes correspondantes de la table de gauche.',
            'explainDarija' => 'RIGHT JOIN afficher toutes lignes table droite correspondance gauche.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Lajointure quiaffichetouslesclientset toutes les commandes, avec NULL là où pas de correspondance, s\'appelle ________.',
            'expected'=> 'FULL OUTER JOIN',
            'accept'  => ['FULL OUTER JOIN', 'full outer join'],
            'concept' => 'FULL OUTER JOIN',
            'explainFr' => 'FULL OUTER JOIN affiche tous les clients et toutes les commandes, avec NULL là où il n\'y a pas de correspondance.',
            'explainDarija' => 'FULL OUTER JOIN afficher tous clients commandes NULL pas correspondance.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Dans LEFT JOIN, c\'est la deuxième table qui voit toutes ses lignes affichées.',
            'answer'  => 0,
            'concept' => 'LEFT JOIN',
            'explainFr' => 'Faux : Dans LEFT JOIN, c\'est la première table (de gauche) qui voit toutes ses lignes affichées. Dans RIGHT JOIN, c\'est la deuxième table.',
            'explainDarija' => 'Faux : LEFT JOIN première table kaylik toutes lignes affichées. RIGHT JOIN: deuxième table kaylik.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces requêtes simule un FULL OUTER JOIN ?',
            'options' => ['UNION ALL de LEFT JOIN et RIGHT JOIN', 'UNION de LEFT JOIN et RIGHT JOIN', 'Intersection de LEFT JOIN et RIGHT JOIN', 'Produit cartésien de LEFT JOIN et RIGHT JOIN'],
            'answer'  => 0,
            'concept' => 'Simulation FULL OUTER JOIN',
            'explainFr' => 'On peut simuler un FULL OUTER JOIN avec UNION ALL de LEFT JOIN et RIGHT JOIN en excluant les doublons.',
            'explainDarija' => 'Simuler FULL OUTER JOIN UNION ALL LEFT JOIN RIGHT JOIN sans doublons.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause ON dans un JOIN sert à :',
            'expected' => 'Spécifier la condition d\'appariement entre les tables',
            'accept' => ['Spécifier la condition d\'appariement', 'spécifier condition appariement'],
            'concept' => 'Clause ON JOIN',
            'explainFr' => 'La clause ON définit comment les lignes des tables différentes doivent être reliées (via les clés étrangères ou primaires).',
            'explainDarija' => 'Clause ON définit comment lignes tables différentes reliées clés étrangères primaires.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'INNER JOIN peut produire un produit cartésien si la clause ON est omise.',
            'answer'  => 1,
            'concept' => 'Produit cartésien',
            'explainFr' => 'Vrai : Sans clause ON, Oracle ne sait pas comment relier les tables et peut produire un produit cartésien (toutes les combinaisons possibles), ce qui entraîne des résultats massifs et erronés.',
            'explainDarija' => 'Vrai : Sans clause ON Oracle sait pas comment relier tables kaylik produire produit cartésien résultats massifs erronés.',
        ],

    ],
];