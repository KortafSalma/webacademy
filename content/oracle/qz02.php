<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch2 — Installation et configuration d\'Oracle Database XE.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Installation et configuration d\'Oracle Database XE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quel mode d\'installation configure automatiquement le port 1521 et le mot de passe SYSTEM = Manager ?',
            'options' => ['Mode Personnalisé', 'Mode Express', 'Mode Avancé', 'Mode Personnalisé avancé'],
            'answer'  => 1,
            'concept' => 'Installation Oracle XE',
            'explainFr' => 'Le mode Express configure tout automatiquement : port 1521, mot de passe Manager, démarrage automatique de la base.',
            'explainDarija' => 'Mode Express automate tout : port 1521 w mot de passe Manager démarrage automatique base.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le service Windows d\'Oracle Database XE s\'appelle ________.',
            'expected'=> 'OracleServiceXE',
            'accept'  => ['OracleServiceXE', 'oracleservicexe'],
            'concept' => 'Services Windows',
            'explainFr' => 'Le service OracleServiceXE permet de gérer le cycle de vie de la base de données (démarrage, arrêt).',
            'explainDarija' => 'Service Windows OracleServiceXE kaylik gérer cycle vie base données.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Par défaut, Oracle Database XE sous Linux est limité à 1 Go de mémoire.',
            'answer'  => 1,
            'concept' => 'Limitation mémoire XE Linux',
            'explainFr' => 'C\'est vrai par défaut. Cette limite peut être augmentée via la commande oracle-xe configure.',
            'explainDarija' => 'B3d default. Limit kay b3d oracle-xe configure.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'étape manquante dans cette séquence : Téléchargement → Exécution de l\'installateur → ? → Vérification du démarrage',
            'options' => ['Configuration', 'Démarrage de la base', 'Test de connexion', 'Création d\'utilisateurs'],
            'answer'  => 0,
            'concept' => 'Étapes installation',
            'explainFr' => 'L\'étape de configuration est indispensable après l\'exécution de l\'installateur pour définir les mots de passe et les paramètres.',
            'explainDarija' => 'Kaystep configuration indispensable b3d execution installateur définir mots de passe paramètres.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la commande suivante ? Oracle Database 21c Express Edition Release 21.0.0.0.0 - Production',
            'options' => ['BANNER', 'USERNAME', 'TABLE_NAME', 'STATUS'],
            'answer'  => 0,
            'concept' => 'VERSION BDD',
            'explainFr' => 'Cette sortie correspond à la commande SHOW PARAMETER database_name ou à la vue V$VERSION.',
            'explainDarija' => 'Sortie correspond commande SHOW PARAMETER database_name w vue V$VERSION.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel est le port d\'écoute par défaut d\'Oracle Database XE ?',
            'options' => ['1433', '1521', '1158', '22'],
            'answer'  => 1,
            'concept' => 'Paramètres connexion',
            'explainFr' => 'Le port par défaut est 1521, sauf personnalisation lors de l\'installation.',
            'explainDarija' => 'Port par défaut 1521 kaylik personnalisation installation.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Après l\'installation, il faut impérativement noter le mot de passe de l\'utilisateur ________ qui est Manager par défaut.',
            'expected'=> 'SYSTEM',
            'accept'  => ['SYSTEM', 'system'],
            'concept' => 'Identifiants par défaut',
            'explainFr' => 'Le mot de passe par défaut de SYSTEM est Manager, à noter immédiatement après l\'installation.',
            'explainDarija' => 'Mot de passe par défaut SYSTEM Manager kaynoter b3d installation.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'L\'installation en mode personnalisé permet de changer le répertoire d\'installation et le port.',
            'answer'  => 1,
            'concept' => 'Installation personnalisée',
            'explainFr' => 'C\'est vrai. Le mode personnalisé offre ces options de configuration.',
            'explainDarija' => 'B3d. Mode personnalisé offre options configuration répertoire port.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel est le nom du service Windows par défaut d\'Oracle Database XE ?',
            'options' => ['OracleServiceXE', 'OracleXEService', 'XEService', 'OracleService'],
            'answer'  => 0,
            'concept' => 'Services Windows',
            'explainFr' => 'Le service par défaut s\'appelle OracleServiceXE.',
            'explainDarija' => 'Service par défaut OracleServiceXE.',
        ],

    ],
];