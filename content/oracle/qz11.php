<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch15 — Sous-requêtes et requêtes imbriquées.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Sous-requêtes et requêtes imbriquées',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Une sous-requête scalaire retourne :',
            'options' => ['Plusieurs lignes et colonnes', 'Une seule valeur (ligne, colonne)', 'Une table entière', 'Une vue'],
            'answer'  => 1,
            'concept' => 'Sous-requête scalaire',
            'explainFr' => 'Une sous-requête scalaire ne retourne qu\'une seule valeur (une ligne, une colonne).',
            'explainDarija' => 'Sous-requête scalaire retourne valeur unique ligne colonne.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Une sous-requête placée dans la clause FROM est aussi appelée ________.',
            'expected'=> 'table dérivée',
            'accept'  => ['table dérivée', 'derived table'],
            'concept' => 'Sous-requête FROM',
            'explainFr' => 'Une sous-requête dans FROM est traitée comme une table virtuelle, aussi appelée table dérivée.',
            'explainDarija' => 'Sous-requête FROM traitée comme table virtuelle table dérivée.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une sous-requête dans la clause FROM doit toujours porter un alias.',
            'answer'  => 1,
            'concept' => 'Sous-requête FROM alias',
            'explainFr' => 'Vrai : En Oracle, une sous-requête dans la clause FROM doit toujours porter un alias sans quoi Oracle provoquera une erreur ORA-00923.',
            'explainDarija' => 'Vrai : Oracle ORA-00923 si pas alias.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : SELECT * FROM (SELECT client_id, COUNT(*) FROM commandes GROUP BY client_id)',
            'options' => ['Oubli alias', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Manque GROUP BY'],
            'answer'  => 0,
            'concept' => 'Sous-requête FROM alias',
            'explainFr' => 'L\'erreur consiste à oublier l\'alias sur une sous-requête dans FROM. Oracle provoquera une erreur ORA-00923 : FROM keyword where expected.',
            'explainDarija' => 'Oubli alias Oracle erreur ORA-00923 FROM keyword where expected.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que retournera SELECT nom FROM clients WHERE id = ANY (SELECT client_id FROM commandes) ;',
            'options' => ['Clients qui ont passé au moins une commande', 'Clients qui n\'ont jamaiscommandé', 'Tous les clients', 'Aucun client'],
            'answer'  => 0,
            'concept' => 'Sous-requête WHERE ANY',
            'explainFr' => 'La requête affichera les clients dont l\'id apparaît dans la liste des client_id de la table commandes.',
            'explainDarija' => 'Clients id apparaît liste client_id commandes.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces sous-requêtes corrélées référence la requête externe ?',
            'options' => ['SELECT * FROM produits p WHERE prix > (SELECT AVG(prix) FROM produits)', 'SELECT * FROM clients c WHERE EXISTS (SELECT * FROM commandes WHERE c.id = client_id)', 'SELECT nom FROM produits WHERE prix > 50', 'SELECT COUNT(*) FROM clients'],
            'answer' => 1,
            'concept' => 'Sous-requête corrélée',
            'explainFr' => 'La sous-requête EXISTS référence la colonne client_id de la requête externe (alias c.id = client_id), elle est donc corrélée.',
            'explainDarija' => 'EXISTS référence colonne requête externe corrélée.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Pour qu\'une sous-requête dans FROM fonctionne sans erreur, elle doit recevoir un ________.',
            'expected' => 'alias',
            'accept' => ['alias', 'Alias'],
            'concept' => 'Sous-requête FROM alias',
            'explainFr' => 'L\'alias est obligatoire pour référencer la sous-requête dans la clause FROM.',
            'explainDarija' => 'Alias obligatoire référencer sous-requête clause FROM.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une sous-requête non corrélée peut s\'exécuter indépendamment de la requête externe.',
            'answer'  => 1,
            'concept' => 'Sous-requête non corrélée',
            'explainFr' => 'Vrai : Une sous-requête non corrélée ne fait pas référence à la requête externe et peut s\'exécuter une seule fois.',
            'explainDarija' => 'Vrai : Non corrélée s\'exécute indépendamment une seule fois.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces requêtes utilise une sous-requête dans le WHERE ?',
            'options' => ['SELECT * FROM produits WHERE prix > (SELECT AVG(prix) FROM produits)', 'SELECT * FROM (SELECT * FROM clients)', 'SELECT COUNT(*) FROM clients', 'CREATE TABLE AS SELECT * FROM clients'],
            'answer' => 0,
            'concept' => 'Sous-requête WHERE',
            'explainFr' => 'La première option place une sous-requête dans la clause WHERE pour filtrer les résultats.',
            'explainDarija' => 'Première option sous-requête WHERE filtrer résultats.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La méthode permettant de tester si une clé existe dans une collection TABLE OF s\'appelle ________.',
            'expected' => 'EXISTS',
            'accept' => ['EXISTS', 'Exists'],
            'concept' => 'Méthode EXISTS',
            'explainFr' => 'La méthode EXISTS(key) retourne VRAI si l\'élément à l\'index key existe dans la collection, sinon FAUX.',
            'explainDarija' => 'Méthode EXISTS(key) VRAI élément existe sinon FAUX.',
        ],

    ],
];