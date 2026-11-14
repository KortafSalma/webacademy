<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 5 : Création d\'utilisateurs, attribution de privilèges
 * et gestion des autorisations.
 * Création de comptes utilisateurs, attribution de privilèges système et de
 * données, et gestion des profils et quotas.
 */

return [
    'id'       => 'oracle-ch5',
    'title'    => 'Création d\'utilisateurs, attribution de privilèges et gestion des autorisations',
    'subtitle' => 'Gérer les comptes et les droits d\'accès Oracle',

    'objectives' => [
        'Créer de nouveaux utilisateurs avec CREATE USER.',
        'Accorder des privilèges système avec GRANT.',
        'Accorder des privilèges de table avec GRANT sur les objets.',
        'Révoquer des privilèges avec REVOKE.',
        'Gérer les quotas de stockage avec DEFAULT TABLESPACE et QUOTA.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'create-user',
            'title' => 'Création d\'un utilisateur avec CREATE USER',
            'icon'  => '🆕',
            'blocks' => [

                make_definition_block(
                    'CREATE USER',
                    '<p>La commande <strong>CREATE USER</strong> crée un nouveau compte d\'utilisateur dans la base de données.</p>',
                    '<p><b>CREATE USER</b> kaynouvo compte utilisateur f base de données.</p>'
                ),

                make_example_block(
                    'Création basique d\'un utilisateur',
                    '<pre><code>-- Création de l\'utilisateur salam\nSQL> CREATE USER salam\n  IDENTIFIED BY password123\n  DEFAULT TABLESPACE USERS\n  TEMP TABLESPACE TEMP;</code></pre>',
                    '<pre>User created.\n\nUSERNAME\n------------------------\nSALAM</pre>',
                    'L\'utilisateur est créé avec un mot de passe. Par défaut, il ne peut rien faire d\'autre que se connecter (privilege CREATE SESSION manquant).'
                ),

                make_note_block(
                    'Mot de passe sécurisé',
                    '<p>Choisissez toujours des mots de passe forts. Évitez les mots de passe simples comme "password" ou "1234".</p>',
                    '<p>Toujours kay choix mots de passe fort. Évitez mots de passe simples comme "password" w "1234".</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'grant-system-privileges',
            'title' => 'Attribution de privilèges système avec GRANT',
            'icon'  => '⚡',
            'blocks' => [

                make_definition_block(
                    'Privilèges système',
                    '<p>Les <strong>privilèges système</strong> autorisent l\'exécution de commandes spécifiques : CREATE TABLE, CREATE VIEW, CREATE PROCEDURE, etc.</p>',
                    '<p><b>Privilèges système</b> autorisent exécution commandes spécifiques : CREATE TABLE, CREATE VIEW, CREATE PROCEDURE, etc.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'CREATE TABLE', 'fr' => 'Créer des tables', 'darija' => 'Create tables'],
                    ['kw' => 'CREATE VIEW', 'fr' => 'Créer des vues', 'darija' => 'Create vues'],
                    ['kw' => 'CREATE PROCEDURE', 'fr' => 'Créer des procédures', 'darija' => 'Create procedures'],
                    ['kw' => 'CREATE SESSION', 'fr' => 'Se connecter', 'darija' => 'Connect session'],
                ]),

                make_example_block(
                    'Accorder CREATE TABLE et CREATE SESSION',
                    '<pre><code>-- Accorder le privilège de connexion\nSQL> GRANT CREATE SESSION TO salam;\n\n-- Accorder la création de tables\nSQL> GRANT CREATE TABLE TO salam;\n\n-- Vérifier les privilèges attribués\nSQL> SELECT privilege FROM user_sys_privs WHERE grantee = \'SALAM\';</code></pre>',
                    '<pre>GRANT created.\n</pre>',
                    'L\'utilisateur salam peut maintenant créer des tables dans son propre schéma.'
                ),

                make_tip_block(
                    'Avec ADMIN OPTION',
                    '<p>Lors de l\'attribution de certains privilèges administratifs, vous pouvez ajouter <code>ADMIN OPTION</code> permettant à l\'utilisateur de transmettre le privilège à d\'autres utilisateurs.</p>',
                    '<p>B3d attribution privileges administratifs, kay ajouter <code>ADMIN OPTION</code> kaylik utilisateur transmit le privilège à d\'autres.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'grant-object-privileges',
            'title' => 'Attribution de privilèges sur les objets',
            'icon'  => '📋',
            'blocks' => [

                make_definition_block(
                    'Privilèges d\'objet',
                    '<p>Les <strong>privilèges d\'objet</strong> autorisent des opérations sur des objets spécifiques (tables, vues, séquences) : SELECT, INSERT, UPDATE, DELETE sur la table EMP de SCOTT.</p>',
                    '<p><b>Privilèges d\'objet</b> autorisent opérations sur objets spécifiques (tables, vues, séquences) : SELECT, INSERT, UPDATE, DELETE sur table EMP de SCOTT.</p>'
                ),

                make_example_block(
                    'Accorder SELECT, INSERT sur une table',
                    '<pre><code>-- Accorder SELECT et INSERT sur la table emp de l\'utilisateur SCOTT\nSQL> GRANT SELECT, INSERT ON scott.emp TO salam;\n\n-- Accorder avec option GRANT OPTION\nSQL> GRANT SELECT ON scott.emp TO salam WITH GRANT OPTION;</code></pre>',
                    '<pre>Grant succeeded.\n</pre>',
                    'L\'utilisateur salam peut lire et insérer des lignes dans la table SCOTT.EMP.'
                ),

                make_note_block(
                    'Privilèges vs rôles',
                    '<p>Il est préférable d\'utiliser des <strong>rôles</strong> pour regrouper plusieurs privilèges et les attribuer ensemble aux utilisateurs. Cela simplifie la gestion des droits.</p>',
                    '<p>Kaylik mieux utiliser <strong>rôles</strong> pour regrouper plusieurs privileges w les attribuer ensemble aux utilisateurs. Simplifie gestion droits.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'revoke-privileges',
            'title' => 'Révoquer des privilèges avec REVOKE',
            'icon'  => '🚫',
            'blocks' => [

                make_definition_block(
                    'REVOKE',
                    '<p>La commande <strong>REVOKE</strong> retire un privilège précédemment accordé à un utilisateur.</p>',
                    '<p><b>REVOKE</b> retire privilege précédemment accordé à utilisateur.</p>'
                ),

                make_example_block(
                    'Révoquer un privilège système',
                    '<pre><code>-- Retirer le privilège CREATE TABLE\nSQL> REVOKE CREATE TABLE FROM salam;\n\n-- Retirer plusieurs privilèges à la fois\nSQL> REVOKE CREATE TABLE, CREATE VIEW FROM salam;</code></pre>',
                    '<pre>Revoke succeeded.\n</pre>',
                    'L\'utilisateur salam ne peut plus créer de tables après le REVOKE.'
                ),

                make_example_block(
                    'Révoquer des privilèges d\'objet',
                    '<pre><code>-- Retirer SELECT sur scott.emp\nSQL> REVOKE SELECT ON scott.emp FROM salam;</code></pre>',
                    '<pre>Revoke succeeded.\n</pre>',
                    'L\'utilisateur perd l\'accès en lecture sur la table spécifiée.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Accorder CREATE TABLE à un utilisateur sans CREATE SESSION',
            'fix'    => 'Accordez toujours CREATE SESSION en même temps que les autres privilèges, ou assurez-vous que l\'utilisateur peut se connecter.',
            'fr'     => 'Sans le privilège CREATE SESSION, l\'utilisateur ne peut pas se connecter à la base de données, même si vous lui accordez CREATE TABLE.',
            'darija' => 'Sans CREATE SESSION, user kaylik connect base, même kaylik CREATE TABLE.'
        ],
        [
            'wrong'  => 'Oublier de révoquer les privilèges inutilisés',
            'fix'    => 'Faites un audit régulier des privilèges et révoquez ceux qui ne sont plus nécessaires (principe du moindre privilège).',
            'fr'     => 'Accorder des privilèges excessifs est une faille de sécurité. Révoquez les privilèges qui ne sont plus nécessaires selon le principe du moindre privilège.',
            'darija' => 'Accorder privileges excédentaire faille sécurité. Revoke b3d nécessaire selon principle moindre privilège.'
        ],
    ],

    'summary' => [
        'fr'     => 'La gestion des utilisateurs Oracle passe par CREATE USER pour créer les comptes, GRANT pour attribuer des privilèges (systèmes ou d\'objets), et REVOKE pour retirer les droits. Toujours appliquer le principe du moindre privilège et envisager l\'utilisation de rôles pour regrouper les privilèges.',
        'darija' => 'Gestion utilisateurs Oracle kaylà CREATE USER b Kreé accounts, GRANT bAttribuer privileges (systèmes w objets), REVOKE bRetrait droits. Toujours principle moindre privilège w rôles b regrouper privileges.'
    ],
];