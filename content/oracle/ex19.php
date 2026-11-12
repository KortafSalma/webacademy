<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch19 — Variables, constantes et types de données.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex19',
    'title' => 'Exercices — Variables, constantes et types de données',
    'brief' => 'Declaration et utilisation des variables PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Declaration d\'une variable',
            'lang'  => 'oracle',
            'instructions' => '<p>Declaraire une variable v_prenom de type VARCHAR2(50).</p>',
            'instructionsDarija' => '<p>Declaraire variable v_prenom TYPE VARCHAR2(50).</p>',
            'starter' => 'DECLARE v_prenom VARCHAR2(50)',
            'hints' => [
                'Utilisez le mot-cl\u00e9 DECLARE au d\u00ebut du bloc.',
                'Sp\u00e9cifiez le type de donn\u00e9es (VARCHAR2, NUMBER, DATE, etc.).',
            ],
            'solution' => 'DECLARE v_prenom VARCHAR2(50)',
            'explainFr' => 'La variable v_prenom est d\u00e9clar\u00e9e de type VARCHAR2(50) pour stocker un pr\u00e9nom.',
            'explainDarija' => 'Variable v_prenom d\u00e9clar\u00e9e TYPE VARCHAR2(50) stocker pr\u00e9nom.',
        ],

        [
            'level' => 2,
            'title' => 'Initialiser une variable',
            'lang'  => 'oracle',
            'instructions' => '<p>Declaraire et initialiser une variable v_age de valeur 30.</p>',
            'instructionsDarija' => '<p>Declaraire initialiser variable v_age valeur 30.</p>',
            'starter' => 'DECLARE v_age NUMBER := 30',
            'hints' => [
                'Utilisez := pour affecter une valeur au moment de la d\u00e9claration.',
                'Le type NUMBER stocke les nombres.',
            ],
            'solution' => 'DECLARE v_age NUMBER := 30',
            'explainFr' => 'La variable v_age est d\u00e9clar\u00e9e et initialis\u00e9e \u00e0 30.',
            'explainDarija' => 'Variable v_age d\u00e9clar\u00e9e initialis\u00e9e 30.',
        ],

        [
            'level' => 3,
            'title' => 'TYPE CONSTANT',
            'lang'  => 'oracle',
            'instructions' => '<p>Declaraire une constante v_tauxTVA de valeur 0.20 (20 %).</p>',
            'instructionsDarija' => '<p>Declaraire constante v_tauxTVA valeur 0.20 (20 %).</p>',
            'starter' => 'CONSTANT v_taux_tva NUMBER := 0.20',
            'hints' => [
                'Utilisez le mot-cl\u00e9 CONSTANT pour cr\u00e9er une valeur immuable.',
                'Les constantes doivent \u00eatre initialis\u00e9es au moment de la d\u00e9claration.',
            ],
            'solution' => 'CONSTANT v_taux_tva NUMBER := 0.20',
            'explainFr' => 'La constante v_taux_tva ne peut pas \u00eatre modifi\u00e9e apr\u00e8s sa d\u00e9claration.',
            'explainDarija' => 'Constante v_taux_tva peut pas modifi\u00e9e apr\u00e8s d\u00e9claration.',
        ],

        [
            'level' => 4,
            'title' => 'Utiliser %TYPE',
            'lang'  => 'oracle',
            'instructions' => '<p>Declaraire une variable ayant le m\u00eeme type que la colonne \"nom\" de la table \"clients\".</p>',
            'instructionsDarija' => '<p>Variable ayant m\u00eame type colonne \"nom\" table \"clients\".</p>',
            'starter' => 'v_nom clients.nom%TYPE',
            'hints' => [
                'L\'attribut %TYPE permet de typier une variable d\'apr\u00e9s une colonne existante.',
                'Cela garantit la compatibilit\u00e9 si le type de colonne change.',
            ],
            'solution' => 'v_nom clients.nom%TYPE',
            'explainFr' => 'La variable v_nom h\u00e9rite du type de la colonne clients.nom (ici VARCHAR2).',
            'explainDarija' => 'Variable v_nom h\u00e9rite type colonne clients.nom VARCHAR2.',
        ],

        [
            'level' => 5,
            'title' => 'Utiliser %ROWTYPE',
            'lang'  => 'oracle',
            'instructions' => '<p>Declaraire une variable v_client qui poss\u00e8de la structure compl\u00e8te d\'une ligne de la table \"clients\".</p>',
            'instructionsDarija' => '<p>Variable v_client structure ligne table \"clients\".</p>',
            'starter' => 'v_client clients%ROWTYPE',
            'hints' => [
                'L\'attribut %ROWTYPE permet de d\u00e9clarer une variable avec toutes les colonnes d\'une ligne de table.',
                'Utile pour manipuler une ligne enti\00e8re \u00e0 la fois.',
            ],
            'solution' => 'v_client clients%ROWTYPE',
            'explainFr' => 'La variable v_client poss\u00e8de toutes les colonnes de la table clients.',
            'explainDarija' => 'Variable v_client poss\u00e8de toutes colonnes ligne table clients.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];