<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch9 — SELECT, WHERE, ORDER BY et DISTINCT.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex11',
    'title' => 'Exercices — SELECT, WHERE, ORDER BY et DISTINCT',
    'brief' => 'Interroger des données avec filtrage, tri et désignation de doublons.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — SELECT colonnes',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les colonnes id, nom et email de la table "clients".</p>',
            'instructionsDarija' => '<p>Sélectionner colonnes id, nom email table "clients".</p>',
            'starter' => 'SELECT id, nom, email FROM clients',
            'hints' => [
                'Listez les colonnes après SELECT.',
                'Séparez-les par des virgules.',
            ],
            'solution' => 'SELECT id, nom, email FROM clients',
            'explainFr' => 'La commande SELECT récupère les colonnes spécifiées depuis la table.',
            'explainDarija' => 'SELECT récupère colonnes spécifiées table.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — WHERE comparaison',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients dont l\'ID est supérieur à 5.</p>',
            'instructionsDarija' => '<p>Sélectionner clients ID supérieur à 5.</p>',
            'starter' => 'SELECT id, nom FROM clients WHERE id > 5',
            'hints' => [
                'Utilisez WHERE après le FROM.',
                'Utilisez les opérateurs de comparaison >, <, =, <>.',
            ],
            'solution' => 'SELECT id, nom FROM clients WHERE id > 5',
            'explainFr' => 'La clause WHERE filtre les lignes qui satisfont la condition.',
            'explainDarija' => 'WHERE filtre lignes satisfont condition.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — LIKE',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients dont le nom commence par la lettre "M".</p>',
            'instructionsDarija' => '<p>Sélectionner noms commencent par "M".</p>',
            'starter' => "SELECT id, nom FROM clients WHERE nom LIKE 'M%'",
            'hints' => [
                'LIKE permet de rechercher des modèles.',
                'Le joker % représente n\'importe quelles caractères.',
                'M% cherche les noms commençant par M.',
            ],
            'solution' => "SELECT id, nom FROM clients WHERE nom LIKE 'M%'",
            'explainFr' => 'LIKE "M%" permet de trouver tous les noms commençant par la lettre M.',
            'explainDarija' => 'LIKE "M%" chercher noms commençant par M.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — DISTINCT',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les villes uniques où ont lieu des commandes (éliminer les doublons).</p>',
            'instructionsDarija' => '<p>Villes uniques commandes éliminer doublons.</p>',
            'starter' => 'SELECT DISTINCT ville FROM commandes',
            'hints' => [
                'DISTINCT élimine les doublons dans le résultat.',
                'S\'applique à la liste des colonnes sélectionnées.',
            ],
            'solution' => 'SELECT DISTINCT ville FROM commandes',
            'explainFr' => 'DISTINCT permet d\'éliminer les lignes en doublon dans le résultat.',
            'explainDarija' => 'DISTINCT eliminate doublons résultat.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — ORDER BY croissant/décroissant',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients triés par nom dans l\'ordre décroissant (Z à A).</p>',
            'instructionsDarija' => '<p>Clients triés par nom ordre décroissant Z à A.</p>',
            'starter' => 'SELECT id, nom FROM clients ORDER BY nom DESC',
            'hints' => [
                'ORDER BY trie le résultat final.',
                'DESC pour décroissant, ASC pour croissant (par défaut).',
            ],
            'solution' => 'SELECT id, nom FROM clients ORDER BY nom DESC',
            'explainFr' => 'ORDER BY nom trie les clients par nom. DESC indique un tri décroissant (de Z à A).',
            'explainDarija' => 'ORDER BY nom trie clients. DESC décroissant Z à A.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];