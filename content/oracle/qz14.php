<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch19 — Variables, constantes et types de données.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Variables, constantes et types de données',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel type de données stocke des nombres entiers ou décimaux ?',
            'options' => ['VARCHAR2', 'NUMBER', 'DATE', 'BOOLEAN'],
            'answer' => 1,
            'concept' => 'Type NUMBER',
            'explainFr' => 'NUMBER stocke les nombres entiers et décimaux.',
            'explainDarija' => 'NUMBER stocke nombres entier décimal.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot-clé utilisé pour déclarer une constante s\'appelle ________.',
            'expected' => 'CONSTANT',
            'accept' => ['CONSTANT', 'constant'],
            'concept' => 'Déclaration constante',
            'explainFr' => 'CONSTANT permet de déclarer une variable dont la valeur ne peut pas être modifiée après sa déclaration.',
            'explainDarija' => 'CONSTANT déclarer variable valeur immuable.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'La valeur d\'une constante peut être modifiée après sa déclaration.',
            'answer' => 0,
            'concept' => 'Contrainte constante',
            'explainFr' => 'Faux : La valeur d\'une constante ne peut pas être modifiée après sa déclaration. Toute tentative de modification provoquera une erreur.',
            'explainDarija' => 'Faux : Valeur constante peut pas modifiée après déclaration erreur modification.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : DECLARE v_taux NUMBER := 0.20; CONSTANT v_taux_tva := 0.20;',
            'options' => 'Oubli DECLARE', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Deux déclarations du même type'},
            'answer' => 3,
            'concept' => 'Syntaxe DECLARE CONSTANT',
            'explainFr' => 'L\'erreur consiste à essayer de déclarer une variable et une constante du même type dans la même section DECLARE. Chaque déclaration doit être distincte.',
            'explainDarija' => 'Erreur déclaration variable constante même type section DECLARE.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la commande : DECLARE v_prenom VARCHAR2(50) := \\'Mohamed\\'; BEGIN DBMS_OUTPUT.PUT_LINE(v_prenom); END ;',
            'options' => 'Mohamed s\'affiche', 'Erreur de type', 'Rien ne s\'affiche', 'Compilation error',
            'answer' => 0,
            'concept' => 'Variable VARCHAR2 affichage',
            'explainFr' => 'La variable v_prenom affichera Mohamed.',
            'explainDarija' => 'Variable v_prenom affich Mohamed.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'L\'attribut %TYPE permet de :',
            'options' => 'Déclarer une variable avec le type d\'une colonne existante', 'Déclarer une constante', 'Créer une table', 'Créer un trigger',
            'answer' => 0,
            'concept' => 'Attribut %TYPE',
            'explainFr' => '%TYPE permet de typiser une variable d\'après une colonne existante, garantissant la compatibilité si le type change.',
            'explainDarija' => '%TYPE typiser variable b colonne existante garanti compatibilité si type change.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'L\'attribut %ROWTYPE permet de déclarer une variable possédant la structure complète d\'une ________.',
            'expected' => 'ligne de table',
            'accept' => ['ligne de table', 'ligne de table'],
            'concept' => 'Attribut %ROWTYPE',
            'explainFr' => '%ROWTYPE permet de déclarer une variable avec toutes les colonnes d\'une ligne de table.',
            'explainDarija' => '%ROWTYPE déclarer variable structure complète ligne table.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'On peut modifier la valeur d\'une constante après sa déclaration en lui affectant une nouvelle valeur.',
            'answer' => 0,
            'concept' => 'Contrainte constante',
            'explainFr' => 'Faux : La valeur d\'une constante ne peut pas être changée après sa déclaration. Toute tentative de modification provoquera une erreur à l\'exécution (ORA-06532).',
            'explainDarija' => 'Faux : Valeur constante peut pas modifiée déclaration erreur exécution ORA-06532.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes permet de typiser une variable d\'après la colonne "nom" de la table "clients" ?',
            'options' => 'v_nom clients%ROWTYPE', 'v_nom clients.nom%TYPE', 'v_nom clients.TYPE', 'v_nom VARCHAR2(50)',
            'answer' => 1,
            'concept' => 'Attribut %TYPE',
            'explainFr' => 'v_nom clients.nom%TYPE hérite du type de la colonne clients.nom.',
            'explainDarija' => 'v_nom clients.nom%TYPE hérite type colonne clients.nom.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'L\'attribut %ROWTYPE de la table "clients" permet d\'accéder au champ "email" de la variable v_client par :',
            'expected' => 'v_client.email',
            'accept' => ['v_client.email', 'v_client.email'],
            'concept' => 'Attribut %ROWTYPE',
            'explainFr' => 'Avec %ROWTYPE, on accède aux colonnes par leur nom directement : v_client.email.',
            'explainDarija' => 'Avec %ROWTYPE accès colonne par nom v_client.email.',
        ],

    ],
];