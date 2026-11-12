<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch4 — Connexion à Oracle : SYS, SYSTEM, utilisateurs et PDB.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex6',
    'title' => 'Exercices — Connexion et rôles',
    'brief' => 'Différencier SYS, SYSTEM, création d\'utilisateurs et connexion.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Rôle SYS',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le rôle de l\'utilisateur SYS en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay role user SYS f Oracle ?</p>',
            'starter' => 'Super-administrateur',
            'hints' => [
                'SYS possède tous les privilèges système.',
                'Il contrôle la base de données de manière complète.',
            ],
            'solution' => 'SYS est le super-administrateur par défaut possédant tous les privilèges système.',
            'explainFr' => 'Le rôle SYS accède à tous les privilèges du système et contrôle la base de données de manière experte.',
            'explainDarija' => 'Role SYS kaylik tous les privileges system w control base data complète.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Rôle SYSTEM',
            'lang'  => 'oracle',
            'instructions' => '<p>À quoi sert le rôle SYSTEM en Oracle ?</p>',
            'instructionsDarija' => '<p>Kay SYSTEM destin ?</p>',
            'starter' => 'Administration base données',
            'hints' => [
                'SYSTEM peut créer des utilisateurs et des tables.',
                'Il dispose de privilèges étendus pour l\'administration.',
            ],
            'solution' => 'SYSTEM est destiné à l\'administration de base de données : création d\'utilisateurs, tables, vues.',
            'explainFr' => 'Le rôle SYSTEM permet de gérer les objets de la base de données (utilisateurs, tables, vues).',
            'explainDarija' => 'Role SYSTEM permettre gérer objets base données (users, tables, vues).',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Créer un utilisateur',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande CREATE USER de base crée un utilisateur nommé "salaam" avec mot de passe "password123" ?</p>',
            'instructionsDarija' => '<p>Kay CREATE USER base kaynouvo user "salaam" mot de passe "password123" ?</p>',
            'starter' => 'CREATE USER salaam IDENTIFIED BY password123',
            'hints' => [
                'On utilise CREATE USER suivi du nom et de l\'identifiant.',
                'Il faut aussi spécifier les tablespaces par défaut.',
            ],
            'solution' => 'CREATE USER salaam IDENTIFIED BY password123 DEFAULT TABLESPACE USERS TEMP TABLESPACE TEMP',
            'explainFr' => 'La commande CREATE USER crée un nouveau compte d\'utilisateur avec mot de passe et tablespaces définis.',
            'explainDarija' => 'CREATE USER kaynouvo compte utilisateur b mot de passe w tablespaces définis.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Connexion utilisateur',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande CONNECT permet de se connecter en tant que nouvel utilisateur "salaam" ?</p>',
            'instructionsDarija' => '<p>Kay commande CONNECT connect f user nouvel "salaam" ?</p>',
            'starter' => 'CONNECT salaam/password123@XE',
            'hints' => [
                'Format : CONNECT utilisateur/mot de passe@service.',
                'Le service est XE pour Oracle XE.',
            ],
            'solution' => 'CONNECT salaam/password123@XE',
            'explainFr' => 'La commande CONNECT permet de se connecter au sein d\'une PDB ou du CDB en spécifiant l\'utilisateur, le mot de passe et le service.',
            'explainDarija' => 'CONNECT kaylik connecter f PDB w CDB b spécifiant user mot de passe service.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Vérifier les utilisateurs',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle requête SQL permet de lister tous les utilisateurs de la base ?</p>',
            'instructionsDarija' => '<p>Kay requête SQLister tous utilisateurs base ?</p>',
            'starter' => 'SELECT username FROM dba_users',
            'hints' => [
                'La vue DBA_USERS contient toutes les informations des utilisateurs.',
                'Nécessite généralement le rôle SYS ou SYSTEM.',
            ],
            'solution' => 'SELECT username FROM dba_users',
            'explainFr' => 'La vue dba_users répertorie tous les comptes d\'utilisateurs de la base de données.',
            'explainDarija' => 'Vue dba_users répertorie tous comptes utilisateurs base données.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];