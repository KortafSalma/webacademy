<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch3 — Comprendre SQL*Plus et SQL Developer (fin).
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex5',
    'title' => 'Exercices — Workflows SQL Developer',
    'brief' => 'Fenêtres de travail, visualisation des objets.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Fenêtre Connexions',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans SQL Developer, où trouvez-vous la fenêtre de gestion des connexions ?</p>',
            'instructionsDarija' => '<p>SQL Developer, kayf kaywilk windows kaymanagement connections ?</p>',
            'starter' => 'Window "Connections"',
            'hints' => [
                'La fenêtre Connexions se trouve dans le panneau latéral.',
                'Elle liste toutes les connexions enregistrées.',
            ],
            'solution' => 'Dans le panneau latéral "Connections"',
            'explainFr' => 'La fenêtre Connexions dans SQL Developer permet de gérer toutes les connexions bases de données.',
            'explainDarija' => 'Window Connexions SQL Developer kaymanager connections bases données.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Se connecter SQL Developer',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelles informations devez-vous remplir pour vous connecter à Oracle XE sous SQL Developer ?</p>',
            'instructionsDarija' => '<p>Kayf informations remplit kayconnect f Oracle XE f SQL Developer ?</p>',
            'starter' => 'Nom utilisateur: system, Mot de passe: Manager',
            'hints' => [
                'L\'utilisateur par défaut est SYSTEM.',
                'Le mot de passe par défaut est Manager.',
                'Le nom de service est XE.',
            ],
            'solution' => 'Utilisateur : system, Mot de passe : Manager, Nom de service : XE',
            'explainFr' => 'Sous Oracle XE, les identifiants par défaut sont SYSTEM/Manager pour la connexion à la base XE.',
            'explainDarija' => 'Sous Oracle XE, identifiants par défaut SYSTEM/Manager b connexion base XE.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Visualiser table',
            'lang'  => 'oracle',
            'instructions' => '<p>Après vous être connecté, comment visualisez-vous la structure d\'une table dans SQL Developer ?</p>',
            'instructionsDarija' => '<p>B3d connecté, kayf visualiser structure table f SQL Developer ?</p>',
            'starter' => 'Clic droit sur table → "View Data"',
            'hints' => [
                'Développez "Connexions" → "Oracle XE" → "TABLES".',
                'Cliquez droit sur une table pour voir ses données.',
            ],
            'solution' => 'Développez Connexions → Oracle XE → TABLES, puis clic droit → "View Data"',
            'explainFr' => 'Dans SQL Developer, vous pouvez visualiser la structure et les données d\'une table via le menu contextuel.',
            'explainDarija' => 'SQL Developer visualiser structure données table menu contextuel.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Terminal SQL Developer',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment accéder au terminal SQL dans SQL Developer pour saisir des requêtes SQL ?</p>',
            'instructionsDarija' => '<p>Kaylik terminal SQL f saisir requêtes SQL f SQL Developer ?</p>',
            'starter' => 'Menu View → Terminal',
            'hints' => [
                'Le terminal combine la puissance de SQL*Plus avec l\'interface graphique.',
                'Affiché via View → Terminal.',
            ],
            'solution' => 'Via View → Terminal',
            'explainFr' => 'SQL Developer propose un terminal qui permet de saisir des requêtes SQL,alliant ainsi puissance CLI et interface graphique.',
            'explainDarija' => 'SQL Developer terminal kaylik puissance CLI w interface GUI.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Requêtes dans SQL Developer',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle est la différence principale entre SQL*Plus et SQL Developer pour l\'exécution de requêtes ?</p>',
            'instructionsDarija' => '<p>Kayf différence principale SQL*Plus w SQL Developer b execution requêtes ?</p>',
            'starter' => 'SQL*Plus: CLI, SQL Developer: GUI avec visualisation',
            'hints' => [
                'SQL*Plus est en ligne de commande, SQL Developer est graphique.',
                'SQL Developer offre visualisations, débogueur PL/SQL, éditeur couleur.',
            ],
            'solution' => 'SQL*Plus est en ligne de commande (CLI), tandis que SQL Developer est une interface graphique (GUI) avec visualisations et débogueur.',
            'explainFr' => 'SQL*Plus est l\'outil historique en ligne de commande, tandis que SQL Developer offre une interface riche avec visualisations d\'objets, un débogueur PL/SQL et un éditeur coloré.',
            'explainDarija' => 'SQL*Plus howa tool CLI historique, SQL Developer GUI riche visualisations débogueur PL/SQL éditeur couleur.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];