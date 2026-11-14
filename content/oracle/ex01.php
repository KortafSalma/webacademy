<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch1 — Introduction à Oracle Database et Oracle XE.
 * 5 niveaux progressifs en mode statique (pas d\'exécution Oracle).
 */

return [
    'id'    => 'oracle-ex1',
    'title' => 'Exercices — Introduction à Oracle Database et Oracle XE',
    'brief' => 'Initiez-vous à Oracle XE : architecture, éditions, rôles utilisateurs.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Identifier l\'édition Oracle',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le nom de l\'édition gratuite d\'Oracle Database destinée à l\'apprentissage et au développement ?</p>',
            'instructionsDarija' => '<p>Landi édition gratuite d\'Oracle Database b lernen w development ?</p>',
            'starter' => '-- Dites-nous : quelle édition ?',
            'hints' => [
                'Vérifiez la documentation officielle Oracle.',
                'L\'édition XE est gratuite et limitée à 12 Go de mémoire.',
            ],
            'solution' => 'Oracle Database 23c Express Edition (XE)',
            'explainFr' => 'L\'édition XE est la version gratuite d\'Oracle Database, idéale pour apprendre et développer sans frais de licence.',
            'explainDarija' => 'Edition XE howa version gratuite d\'Oracle Database, ideal b lernen w developpez b licence.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — Rôles utilisateurs',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle est la différence entre les rôles SYS et SYSTEM en Oracle ?</p>',
            'instructionsDarija' => '<p>Chayf difference b role SYS w SYSTEM f Oracle ?</p>',
            'starter' => '-- Écrivez la différence ci-dessous',
            'hints' => [
                'SYS est le super-administrateur par défaut.',
                'SYSTEM est destiné à l\'administration de base de données.',
            ],
            'solution' => 'SYS possède tous les privilèges système et contrôle la base en totalité ; SYSTEM peut créer utilisateurs, tables, vues mais ne peut pas aussi facilement altérer la structure interne que SYS.',
            'explainFr' => 'Le rôle SYS est réservé à l\'administration experte de la base de données, tandis que SYSTEM est destiné aux administrateurs de base de données classiques.',
            'explainDarija' => 'Role SYS kaylik administration experte base data, SYSTEM destin admin base données classique.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Connexion SQL*Plus',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la commande SQL*Plus pour vous connecter en tant qu\'utilisateur SYSTEM avec le mot de passe par défaut.</p>',
            'instructionsDarija' => '<p>Khdmen connect f SQL*Plus b SYSTEM b mot de passe par défaut.</p>',
            'starter' => 'CONNECT SYSTEM/',
            'hints' => [
                'Le mot de passe par défaut de SYSTEM est Manager.',
                'Utilisez le format : CONNECT utilisateur/mot de passe.',
            ],
            'solution' => 'CONNECT SYSTEM/Manager',
            'explainFr' => 'La commande CONNECT permet de s\'identifier auprès de la base de données. Le mot de passe par défaut de SYSTEM est Manager.',
            'explainDarija' => 'Commande CONNECT kaylik identificar b base données. Mot de passe par défaut SYSTEM howa Manager.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Architecture client-serveur',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans le modèle client-serveur Oracle, quel composant stocke les données et lequel envoie les requêtes ?</p>',
            'instructionsDarija' => '<p>F model client-server Oracle, kay component stocke données w kay yodlob requêtes ?</p>',
            'starter' => '-- Scrib votre réponse ci-dessous',
            'hints' => [
                'Le serveur (Oracle Database) stocke les données et traite les requêtes.',
                'Le client (SQL*Plus, SQL Developer, application) envoie les requêtes et affiche les résultats.',
            ],
            'solution' => 'Le serveur stocke les données et traite les requêtes ; le client envoie les requêtes et affiche les résultats.',
            'explainFr' => 'Dans le modèle client-serveur, le serveur héberge les données tandis que l\'outil client sert d\'interface d\'interaction.',
            'explainDarija' => 'F model client-server, serveur kaylik stocke données w traiter requêtes ; client kaymchi yodlob requêtes w kayaffich résultats.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Se souvenir des informations post-installation',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelles sont les trois informations à noter immédiatement après l\'installation de Oracle Database XE ?</p>',
            'instructionsDarija' => '<p>Kayf kayinformations noter b3d installation XE ?</p>',
            'starter' => '-- Listez les trois éléments ci-dessous',
            'hints' => [
                'Nom de la base de données : XE',
                'Mot de passe SYSTEM : Manager',
                'Port d\'écoute : 1521',
            ],
            'solution' => 'Nom de la base de données : XE ; Mot de passe SYSTEM : Manager ; Port d\'écoute : 1521',
            'explainFr' => 'Ces trois informations sont essentielles pour se connecter et configurer vos outils (SQL*Plus, SQL Developer).',
            'explainDarija' => 'These three informations essential bconnecter w konfigur tools (SQL*Plus, SQL Developer).',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];