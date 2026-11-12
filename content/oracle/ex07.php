<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch5 — Création d'utilisateurs, attribution de privilèges.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex7',
    'title' => 'Exercices — Création d\'utilisateurs et privilèges',
    'brief' => 'CREATE USER, GRANT, REVOKE, gestion des droits.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE USER basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle est la commande CREATE USER minimale pour créer un utilisateur ?</p>',
            'instructionsDarija' => '<p>Kay CREATE USER minimale kaynouvo user ?</p>',
            'starter' => 'CREATE USER identifiant',
            'hints' => [
                'CREATE USER suivi du nom d\'utilisateur.',
                'Un mot de passe doit être défini avec IDENTIFIED BY.',
            ],
            'solution' => 'CREATE USER identifiant IDENTIFIED BY motdepasse',
            'explainFr' => 'La commande CREATE USER crée un nouveau compte d\'utilisateur. Le mot de passe est obligatoire avec IDENTIFIED BY.',
            'explainDarija' => 'CREATE USER kaynouvo compte utilisateur mot de passe obligatoire IDENTIFIED BY.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Tablespaces par défaut',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelles clauses TABLESPACE ajouter après le mot de passe dans CREATE USER ?</p>',
            'instructionsDarija' => '<p>Kay clauses TABLESPACE ajouter b3d mot de passe f CREATE USER ?</p>',
            'starter' => 'DEFAULT TABLESPACE USERS TEMP TABLESPACE TEMP',
            'hints' => [
                'DEFAULT TABLESPACE définit l\'espace de stockage par défaut.',
                'TEMP TABLESPACE définit l\'espace temporaire.',
            ],
            'solution' => 'DEFAULT TABLESPACE USERS TEMP TABLESPACE TEMP',
            'explainFr' => 'Ces clauses définissent les espaces de stockage par défaut pour l\'utilisateur.',
            'explainDarija' => 'Clauses définissent espaces stockage par défaut user.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Accorder CREATE SESSION',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande GRANT permet à un utilisateur de se connecter à la base ?</p>',
            'instructionsDarija' => '<p>Kay GRANT kaylik kayluser kayconnect b base ?</p>',
            'starter' => 'GRANT CREATE SESSION TO identifiant',
            'hints' => [
                'CREATE SESSION est le privilège de base de connexion.',
                'Sans cela, l\'utilisateur ne peut pas se connecter.',
            ],
            'solution' => 'GRANT CREATE SESSION TO identifiant',
            'explainFr' => 'Le privilège CREATE SESSION autorise l\'utilisateur à se connecter à la base de données.',
            'explainDarija' => 'Privilège CREATE SESSION autorise user connecter b base données.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — CREATE TABLE',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande GRANT autorise la création de tables ?</p>',
            'instructionsDarija' => '<p>Kay GRANT autorise création tables ?</p>',
            'starter' => 'GRANT CREATE TABLE TO identifiant',
            'hints' => [
                'CREATE TABLE permet de créer de nouvelles tables.',
                'Doit être accordé séparément si l\'utilisateur ne l\'a pas par défaut.',
            ],
            'solution' => 'GRANT CREATE TABLE TO identifiant',
            'explainFr' => 'Le privilège CREATE TABLE autorise la création de nouvelles tables dans son schéma.',
            'explainDarija' => 'Privilège CREATE TABLE autorise création nouvelles tables f schéma.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Révoquer un privilège',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande REVOKE retire le privilège CREATE TABLE d\'un utilisateur ?</p>',
            'instructionsDarija' => '<p>Kay REVOKE retire privilège CREATE TABLE f user ?</p>',
            'starter' => 'REVOKE CREATE TABLE FROM identifiant',
            'hints' => [
                'REVOKE retire un privilège précédemment accordé.',
                'La syntaxe est : REVOKE privilège FROM utilisateur.',
            ],
            'solution' => 'REVOKE CREATE TABLE FROM identifiant',
            'explainFr' => 'La commande REVOKE retire un privilège système ou d\'objet précédemment accordé.',
            'explainDarija' => 'REVOKE retire privilege système ou objet précédemment accordé.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];