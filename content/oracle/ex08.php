<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch6 — Bases de données relationnelles et tables.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex8',
    'title' => 'Exercices — Modèle relationnel et types de données',
    'brief' => 'Tables, clés primaires, types de données Oracle.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Créer une table basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Créez une table \"employés\" avec id NUMERO PRIMARY KEY, nom VARCHAR2(50) et salaire NUMBER.</p>',
            'instructionsDarija' => '<p>Kreé table "employés" id NUMERO PRIMARY KEY, nom VARCHAR2(50) w salaire NUMBER.</p>',
            'starter' => 'CREATE TABLE employés (id NUMBER PRIMARY KEY, nom VARCHAR2(50), salaire NUMBER)',
            'hints' => [
                'NUMBER pour les nombres, VARCHAR2 pour le texte.',
                'PRIMARY KEY identifie chaque ligne de façon unique.',
            ],
            'solution' => 'CREATE TABLE employés (id NUMBER PRIMARY KEY, nom VARCHAR2(50), salaire NUMBER)',
            'explainFr' => 'La table employés possède trois colonnes avec des types de données Oracle appropriés.',
            'explainDarija' => 'Table employés trois colonnes avec types données Oracle appropriés.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Types de colonnes',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel type de données utilisez-vous pour une chaîne de caractères de longueur variable en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay type données chaîne longueur variable f Oracle ?</p>',
            'starter' => 'VARCHAR2',
            'hints' => [
                'Utilisez toujours VARCHAR2 en Oracle (et non VARCHAR).',
                'VARCHAR2 peut stocker jusqu\'à 4000 octets.',
            ],
            'solution' => 'VARCHAR2',
            'explainFr' => 'VARCHAR2 est le type standard pour les chaînes de caractères variables en Oracle.',
            'explainDarija' => 'VARCHAR2 standard Oracle kay chaînes caractères variables.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Clé primaire',
            'lang'  => 'oracle',
            'instructions' => '<p>Pourquoi est-il important de définir une clé primaire sur une table ?</p>',
            'instructionsDarija' => '<p>Kay important définir clé primaire table ?</p>',
            'starter' => 'Identifier uniquely chaque ligne',
            'hints' => [
                'Évite les lignes en doublon.',
                'Permet des mises à jour et suppressions ciblées.',
            ],
            'solution' => 'Pour identifier de façon unique chaque ligne de la table et éviter les doublons.',
            'explainFr' => 'La clé primaire garantit l\'unicité de chaque ligne et interdit les valeurs NULL.',
            'explainDarija' => 'Clé primaire garantit unicité chaque ligne w interdit NULL.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — NOT NULL',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel empêche l\'insertion de lignes où une colonne vaut NULL ?</p>',
            'instructionsDarija' => '<p>Kay empêche insertion lignes colonne NULL ?</p>',
            'starter' => 'NOT NULL',
            'hints' => [
                'La contrainte NOT NULL s\'applique sur une colonne lors de la création.',
                'Les valeurs NULL sont interdites sur cette colonne.',
            ],
            'solution' => 'NOT NULL',
            'explainFr' => 'NOT NULL interdit les valeurs NULL dans la colonne spécifiée.',
            'explainDarija' => 'NOT NULL interdit NULL colonne spécifiée.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — DEFAULT SYSDATE',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel mot-clé Oracle permet d\'automatiquement insérer la date courante lors de l\'ajout d\'une ligne ?</p>',
            'instructionsDarija' => '<p>Kay mot-clé Oracle automatique insérer date courante b l\'ajout ligne ?</p>',
            'starter' => 'DEFAULT SYSDATE',
            'hints' => [
                'SYSDATE retourne la date et l\'heure système actuelles.',
                'Souvent utilisé pour les colonnes date_creation.',
            ],
            'solution' => 'DEFAULT SYSDATE',
            'explainFr' => 'DEFAULT SYSDATE insère automatiquement la date et l\'heure courantes.',
            'explainDarija' => 'DEFAULT SYSDATE automatique insérer date heure courantes.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];