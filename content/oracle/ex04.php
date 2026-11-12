<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch3 — Comprender SQL*Plus et SQL Developer (suite).
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex4',
    'title' => 'Exercices — Commandes SQL*Plus de base',
    'brief' => 'Configuration de la sortie, paramètres utiles.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Activer la sortie',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande SQL*Plus active l\'affichage de la sortie PL/SQL ?</p>',
            'instructionsDarija' => '<p>Kayf commande SQL*Plus kaylik affich output PL/SQL ?</p>',
            'starter' => 'SET SERVEROUTPUT ON',
            'hints' => [
                'Cette commande doit être exécutée avant les blocs PL/SQL.',
                'Sans elle, DBMS_OUTPUT reste invisible.',
            ],
            'solution' => 'SET SERVEROUTPUT ON',
            'explainFr' => 'La commande SET SERVEROUTPUT ON est indispensable pour voir la sortie des blocs PL/SQL dans SQL*Plus.',
            'explainDarija' => 'SET SERVEROUTPUT ON indispensable kaylik voir sortie PL/SQL f SQL*Plus.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Ligne de commande basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle invite signifie que vous êtes connecté et prêt à saisir des requêtes en SQL*Plus ?</p>',
            'instructionsDarija' => '<p>Kayf invite kaylik connecté prèt saisir requêtes f SQL*Plus ?</p>',
            'starter' => 'SQL> ',
            'hints' => [
                'L\'invite SQL> apparaît après une connexion réussie.',
                'Vous pouvez commencer à taper des requêtes SQL.',
            ],
            'solution' => 'SQL> ',
            'explainFr' => 'L\'invite SQL> indique que la connexion est établie et que SQL*Plus attend vos commandes.',
            'explainDarija' => 'Invite SQL> kaylik connection établissement w SQL*Plus kaylik commande.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Paramètres de configuration',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande définit le nombre de lignes par page en SQL*Plus ?</p>',
            'instructionsDarija' => '<p>Kayf commande définit nombre lignes par page f SQL*Plus ?</p>',
            'starter' => 'SET PAGESIZE 50',
            'hints' => [
                'Ajuste le nombre de lignes affichées par page.',
                'La valeur par défaut est souvent 14.',
            ],
            'solution' => 'SET PAGESIZE 50',
            'explainFr' => 'La commande SET PAGESIZE permet de contrôler l\'affichage des résultats sur plusieurs pages.',
            'explainDarija' => 'SET PAGESIZE kaylik contrôler affichage résultats pages.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Largeur de ligne',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande définit la largeur maximale d\'une ligne en SQL*Plus ?</p>',
            'instructionsDarija' => '<p>Kayf commande définit largeur ligne maximale f SQL*Plus ?</p>',
            'starter' => 'SET LINESIZE 100',
            'hints' => [
                'Ajuste la longueur d\'affichage d\'une ligne.',
                'Utile pour les colonnes de texte longues.',
            ],
            'solution' => 'SET LINESIZE 100',
            'explainFr' => 'La commande SET LINESIZE contrôle la largeur d\'affichage des lignes de résultat.',
            'explainDarija' => 'SET LINESIZE kaylik contrôler largeur affichage lignes résultat.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Description de table',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande SQL*Plus décrit la structure d\'une table (colonnes, types) ?</p>',
            'instructionsDarija' => '<p>Kayf commande SQL*Plus décrit structure table (colonnes, types) ?</p>',
            'starter' => 'DESCRIBE table_name',
            'hints' => [
                'L\'invoker est DESCRIBE suivi du nom de la table.',
                'Affiche les noms de colonnes, types et contraintes.',
            ],
            'solution' => 'DESCRIBE employees',
            'explainFr' => 'La commande DESCRIBE affiche la structure détaillée d\'une table (colonnes, types de données, contraintes).',
            'explainDarija' => 'DESCRIBE afficher structure détaillée table colonnes types contraintes.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];