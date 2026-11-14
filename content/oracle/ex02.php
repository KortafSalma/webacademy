<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch2 — Installation et configuration d\'Oracle Database XE.
 * 5 niveaux progressifs en mode statique (pas d\'exécution Oracle).
 */

return [
    'id'    => 'oracle-ex2',
    'title' => 'Exercices — Installation et configuration d\'Oracle Database XE',
    'brief' => 'Guide d\'installation pas à pas : téléchargement, configuration, vérification.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Source de téléchargement',
            'lang'  => 'oracle',
            'instructions' => '<p>Depuis quel site officiel télécharge-t-on Oracle Database XE ?</p>',
            'instructionsDarija' => '<p>Men site officiel kay9der telecharger Oracle Database XE ?</p>',
            'starter' => 'https://www.oracle.com/',
            'hints' => [
                'Rendez-vous sur la page des téléchargements Express.',
                'Le fichier fait plusieurs centaines de Mo.',
            ],
            'solution' => 'https://www.oracle.com/database/technologies/downloads-express.html',
            'explainFr' => 'Le site officiel Oracle propose le téléchargement gratuit de la version XE.',
            'explainDarija' => 'Site officiel Oracle kaylik telechargement gratuit version XE.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — Mode d\'installation',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel mode d\'installation configure automatiquement le port 1521 et le mot de passe SYSTEM = Manager ?</p>',
            'instructionsDarija' => '<p>Kayf mode installation kayconfigure automatiquement port 1521 w mot de passe SYSTEM = Manager ?</p>',
            'starter' => 'Mode Express',
            'hints' => [
                'Le mode Express configure tout automatiquement.',
                'Le mode Personnalisé permet de changer le port et le répertoire.',
            ],
            'solution' => 'Mode Express',
            'explainFr' => 'Le mode Express est recommandé pour les débuts : il configure le port 1521, le mot de passe Manager et démarre la base automatiquement.',
            'explainDarija' => 'Mode Express recommended b debuts : kayconfigure port 1521, mot de passe Manager w démarre base automatiquement.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Mémoire sous Linux',
            'lang'  => 'oracle',
            'instructions' => '<p>Par défaut, Oracle Database XE sous Linux est limité à combien de Go de mémoire ?</p>',
            'instructionsDarija' => '<p>B3d Linux, Oracle Database XE limited b combien Go mémoire par défaut ?</p>',
            'starter' => '1 Go',
            'hints' => [
                'La limite peut être augmentée lors de la configuration.',
                'Vérifiez la documentation Oracle XE.',
            ],
            'solution' => '1 Go',
            'explainFr' => 'Par défaut, XE est limité à 1 Go de mémoire de base de données. Cette limite peut être augmentée via la commande oracle-xe configure.',
            'explainDarija' => 'B3d default, XE limited 1 Go memory base données. Limit kayb3d via oracle-xe configure.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Post-installation',
            'lang'  => 'oracle',
            'instructions' => '<p>Après l\'installation, quelle information n\'est PAS notée automatiquement : nom de la base, mot de passe SYSTEM, ou répertoire utilisateur ?</p>',
            'instructionsDarija' => '<p>B3d installation, kayf information kaylik NOT noted automatiquement : nom base, mot de passe SYSTEM, w répertoire utilisateur ?</p>',
            'starter' => 'Répertoire utilisateur',
            'hints' => [
                'Le nom de la base et le mot de passe SYSTEM sont notés par l\'installateur.',
                'Le répertoire d\'installation peut être choisi en mode personnalisé.',
            ],
            'solution' => 'Répertoire utilisateur',
            'explainFr' => 'L\'installateur note le nom de la base (XE), le mot de passe SYSTEM (Manager) et le port (1521), mais pas nécessairement le répertoire utilisateur choisi.',
            'explainDarija' => 'Installateur noted nom base (XE), mot de passe SYSTEM (Manager) w port (1521), mais kaylik répertoire utilisateur.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Vérifier le service Windows',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le nom du service Windows d\'Oracle Database XE ?</p>',
            'instructionsDarija' => '<p>Kayf nom service Windows d\'Oracle Database XE ?</p>',
            'starter' => 'OracleServiceXE',
            'hints' => [
                'Ce service permet de démarrer/arrêter la base de données.',
                'Visible dans les services Windows (services.msc).',
            ],
            'solution' => 'OracleServiceXE',
            'explainFr' => 'Le service Windows OracleServiceXE permet de gérer le cycle de vie de la base de données (démarrage, arrêt).',
            'explainDarija' => 'Service Windows OracleServiceXE kaylik gérer cycle vie base données (démarrage, arrêt).',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];