<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch3 — Comprendre SQL*Plus et SQL Developer.
 * 5 niveaux progressifs en mode statique (pas d\'exécution Oracle).
 */

return [
    'id'    => 'oracle-ex3',
    'title' => 'Exercices — SQL*Plus et SQL Developer',
    'brief' => 'Différencier les outils ligne de commande et interface graphique.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Ouvrir SQL*Plus',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans quel environnement ouvrez-vous SQL*Plus ?</p>',
            'instructionsDarija' => '<p>B3d environnement kaykhol SQL*Plus ?</p>',
            'starter' => 'Terminal / Invite de commande',
            'hints' => [
                'SQL*Plus s\'ouvre dans un terminal/ligne de commande.',
                'Sous Windows, il se trouve dans le menu Démarrer.',
            ],
            'solution' => 'Terminal ou menu Démarrer Windows',
            'explainFr' => 'SQL*Plus est un outil en ligne de commande qui s\'exécute dans un terminal ou une invite de commandes.',
            'explainDarija' => 'SQL*Plus tool CLI kaywork f terminal w invite commandes.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Se connecter en SQL*Plus',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle est la commande pour se connecter en tant que SYSTEM en SQL*Plus ?</p>',
            'instructionsDarija' => '<p>Kayf commande connect f SYSTEM f SQL*Plus ?</p>',
            'starter' => 'CONNECT SYSTEM/Manager',
            'hints' => [
                'Le format est : CONNECT utilisateur/mot de passe.',
                'Mot de passe par défaut : Manager.',
            ],
            'solution' => 'CONNECT SYSTEM/Manager',
            'explainFr' => 'La commande CONNECT identifie l\'utilisateur auprès de la base de données.',
            'explainDarija' => 'Commande CONNECT identifier user b base données.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Ouvrir SQL Developer',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans SQL Developer, quel bouton ou menu permet d\'ajouter une nouvelle connexion ?</p>',
            'instructionsDarija' => '<p>SQL Developer, kayf bouton w menu kay9der ajouter nouvelle connexion ?</p>',
            'starter' => ' bouton + dans Connexions',
            'hints' => [
                'La fenêtre Connexions affiche les connexions enregistrées.',
                'Cliquez sur le signe + pour en ajouter une nouvelle.',
            ],
            'solution' => 'Le bouton "+" dans la fenêtre Connexions',
            'explainFr' => 'SQL Developer offre une interface visuelle pour gérer les connexions bases de données.',
            'explainDarija' => 'SQL Developer GUI kaymanager connections base données.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Test de connexion',
            'lang'  => 'oracle',
            'instructions' => '<p>Avant d\'exécuter des requêtes, que devez-vous faire dans SQL Developer pour vérifier la connexion ?</p>',
            'instructionsDarija' => '<p>Bach exécuter requêtes, kayf kaytester connexion f SQL Developer ?</p>',
            'starter' => 'Cliquer sur "Tester"',
            'hints' => [
                'Utilisez le bouton "Tester" dans la fenêtre d\'ajout de connexion.',
                'Cela vérifie que les identifiants sont corrects.',
            ],
            'solution' => 'Cliquer sur "Tester" dans la fenêtre de connexion',
            'explainFr' => 'Le bouton "Tester" permet de vérifier que les identifiants de connexion sont valides avant de se connecter.',
            'explainDarija' => 'Bouton "Tester" kaylik vérifier identifiants corrects b avant connexion.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Commandes SQL*Plus utiles',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande SQL*Plus permet d\'afficher la version de la base de données ?</p>',
            'instructionsDarija' => '<p>Kayf commande SQL*Plus kaylik afficher version base données ?</p>',
            'starter' => 'SELECT * FROM V$VERSION',
            'hints' => [
                'La vue V$VERSION contient les informations de version.',
                'On peut aussi utiliser la commande SHOW PARAMETER.',
            ],
            'solution' => 'SELECT * FROM V$VERSION',
            'explainFr' => 'La vue V$VERSION affiche les informations de version de la base de données Oracle.',
            'explainDarija' => 'Vue V$VERSION afficher informations version base données Oracle.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];