<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 4 : Connexion à Oracle : SYS, SYSTEM, utilisateurs et PDB
 * Gestion des connexions, des rôles et des conteneurs (CDB/PDB) dans Oracle XE.
 */

return [
    'id'       => 'oracle-ch4',
    'title'    => 'Connexion à Oracle : SYS, SYSTEM, utilisateurs et PDB',
    'subtitle' => 'Comment se connecter et gérer les conteneurs Oracle',

    'objectives' => [
        'Différencier les rôles SYS, SYSTEM et les utilisateurs classiques.',
        'Se connecter avec SQL*Plus en utilisant les différents identifiants.',
        'Comprendre l\'architecture CDB (Container Database) et PDB (Pluggable Database).',
        'Basculer entre les conteneurs avec ALTER SESSION SET CONTAINER.',
        'Créer un utilisateur personnalisé avec les privilèges appropriés.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'roles-sys-system-users',
            'title' => 'Rôles SYS, SYSTEM et utilisateurs personnalisés',
            'icon'  => '👑',
            'blocks' => [

                make_definition_block(
                    'Connexion en tant que SYS',
                    '<p>L\'utilisateur <strong>SYS</strong> est le super-administrateur. Il possède tous les privilèges du système. La connexion s\'effectue généralement avec le privilège <code>SYSDBA</code>.</p>',
                    '<p><b>SYS</b> howa super-adminitrator. Kaylik tous les privileges system. Connexion avec privilège <code>SYSDBA</code>.</p>'
                ),

                make_definition_block(
                    'Connexion en tant que SYSTEM',
                    '<p>L\'utilisateur <strong>SYSTEM</strong> est destiné à l\'administration de base. Il peut créer des utilisateurs, des tables, des vues, etc. Mot de passe par défaut : <code>Manager</code>.</p>',
                    '<p><b>SYSTEM</b> destin administration base. Kaylik create users, tables, vues, etc. Mot de passe par défaut : <code>Manager</code>.</p>'
                ),

                make_definition_block(
                    'Création d\'un utilisateur classique',
                    '<p>Pour les travaux quotidiens, créez un utilisateur dédié :</p><pre><code>CREATE USER identifiant IDENTIFIED BY motdepasse\n  DEFAULT TABLESPACE USERS\n  TEMP TABLESPACE TEMP;</code></pre>',
                    '<p>B3d travaux quotidien, kreé user dédié :</p><pre><code>CREATE USER identifiant IDENTIFIED BY motdepasse\n  DEFAULT TABLESPACE USERS\n  TEMP TABLESPACE TEMP;</code></pre>'
                ),

                make_example_block(
                    'Création et connexion à un utilisateur',
                    '<pre><code>-- Création de l\'utilisateur\nSQL> CREATE USER salam IDENTIFIED BY password123\n  DEFAULT TABLESPACE USERS\n  TEMP TABLESPACE TEMP;\n\n-- Octroi de privilèges de base\nSQL> GRANT CREATE SESSION TO salam;\n\n-- Connexion au nouvel utilisateur\nSQL> CONNECT salam/password123@XE\nSQL> </pre>',
                    'L\'utilisateur salam peut maintenant se connecter et travailler sur ses propres schémas.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'cdb-pdb-architecture',
            'title' => 'Architecture CDB et PDB',
            'icon'  => '🏗️',
            'blocks' => [

                make_definition_block(
                    'CDB (Container Database)',
                    '<p>Le <strong>CDB</strong> est la base de données contenante qui contient une ou plusieurs <strong>PDB</strong>. Il contient les métadonnées système, les utilisateurs communs et les objets partagés.</p>',
                    '<p><b>CDB</b> howa base de données contenante kaylike une ou plusieurs <b>PDB</b>. Kaylik métadonnées système, utilisateurs communs w objets partagés.</p>'
                ),

                make_definition_block(
                    'PDB (Pluggable Database)',
                    '<p>La <strong>PDB</strong> est une base de données insérable qui fonctionne à l\'intérieur d\'un CDB. Chaque PDB possède ses propres schémas, tables et données, et peut être ouverte ou fermée indépendamment.</p>',
                    '<p><b>PDB</b> howa base de données insérable f kaywork f bCDB. Kaylik schémas propres, tables w données, kayferma fermermer indépendamment.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'CDB', 'fr' => 'Base contenante', 'darija' => 'Base contenante'],
                    ['kw' => 'PDB', 'fr' => 'Base insérable', 'darija' => 'Base insérable'],
                    ['kw' => 'ROOT', 'fr' => 'Conteneur racine', 'darija' => 'Conteneur racine'],
                    ['kw' => 'SEED', 'fr' => 'PDB modèle', 'darija' => 'PDB modèle'],
                ]),

                make_example_block(
                    'Vérifier si on est en CDB ou PDB',
                    '<pre><code>SQL> SELECT CON_NAME, CON_ID FROM V$CONTAINERS;</code></pre>',
                    '<pre>CON_NAME          CON_ID
----------------- ----------
CDB$ROOT              0
XEPDB1                3</pre>',
                    'La requête V$CONTAINERS montre tous les conteneurs dans le CDB.'
                ),

                make_example_block(
                    'Ouverture et fermeture d\'une PDB',
                    '<pre><code>-- Ouverture de la PDB XEPDB1\nSQL> ALTER PLUGGABLE DATABASE XEPDB1 OPEN;\n\n-- Fermeture de la PDB XEPDB1\nSQL> ALTER PLUGGABLE DATABASE XEPDB1 CLOSE;</code></pre>',
                    '<pre>Database altered.\n</pre>',
                    'Les PDB peuvent être ouvertes/fermées sans affecter les autres.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'alter-session-container',
            'title' => 'ALTER SESSION SET CONTAINER',
            'icon'  => '🔄',
            'blocks' => [

                make_definition_block(
                    'Changement de conteneur en session',
                    '<p>La commande <code>ALTER SESSION SET CONTAINER = XEPDB1</code> permet de changer le conteneur courant pour la session en cours. Toutes les requêtes suivantes s\'exécuteront dans le contexte de la PDB spécifiée.</p>',
                    '<p>Commande <code>ALTER SESSION SET CONTAINER = XEPDB1</code> kaychange conteneur courant b session. Toutes requêtes suivantes s\'exécutent dans contexte PDB spécifiée.</p>'
                ),

                make_example_block(
                    'Utiliser ALTER SESSION SET CONTAINER',
                    '<pre><code>-- Se connecter en tant que SYS au CDB\nSQL> CONNECT SYS as SYSDBA\nSQL> ALTER SESSION SET CONTAINER = XEPDB1;\n\n-- Maintenant, les requêtes touchent la PDB XEPDB1\nSQL> SELECT * FROM users;\nSQL> </pre>',
                    '<pre>Session altered.\n\n PL/SQL procedure successfully completed.\n\n old/new values\n                       --- \n                       --- \n\begin{array}{l}\n  TABLE_NAME \\n USERNAME\n ---------------- -------------------------\n \n</array>\n</pre>',
                    'Après avoir changé de conteneur, les tables et vues appartiennent à la PDB en cours.'
                ),

                make_note_block(
                    'Important : connecteur par défaut',
                    '<p>Sous Oracle XE, le conteneur par défaut après connexion est généralement XEPDB1. La commande ALTER SESSION SET CONTAINER est surtout utile lorsqu\'on travaille avec un CDB multi-PDB ou lorsqu\'on doit accéder aux métadonnées du conteneur racine.</p>',
                    '<p>B3d conteneur par défaut après connexion howa XEPDB1. ALTER SESSION SET CONTAINER kayutil b CDB multi-PDB w accès métadonnées conteneur racine.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Se connecter en tant que SYSTEM sans privilège SYSDBA pour gérer les PDB',
            'fix'    => 'Utilisez SYS avec SYSDBA pour les opérations CDB/PDB, ou créez un utilisateur avec les privilèges appropriés.',
            'fr'     => 'Les opérations sur les conteneurs (CREATE PDB, ALTER SESSION SET CONTAINER) nécessitent des privilèges étendus qui ne sont pas accordés par défaut au rôle SYSTEM. Utilisez SYS as SYSDBA ou accordez les privilèges spécifiques.',
            'darija' => 'Operations CDB/PDB kaylik privileges étendus kaylik SYSTEM b3d default. Use SYS as SYSDBA w allocated specific privileges.'
        ],
        [
            'wrong'  => 'Oublier de spécifier le conteneur dans les requêtes multi-PDB',
            'fix'    => 'Utilisez ALTER SESSION SET CONTAINER ou préfixez les objets par le nom du conteneur.',
            'fr'     => 'En l\'absence de changement de conteneur, les requêtes s\'exécutent dans le conteneur par défaut. Dans un CDB avec plusieurs PDB, pensez à changer de conteneur si vous devez accéder à des objets situés dans une PDB spécifique.',
            'darija' => 'B3d change conteneur, requêtes s\'exécutent conteneur par défaut. F multiple PDB, pensez change conteneur b access objets PDB spécifique.'
        ],
    ],

    'summary' => [
        'fr'     => 'Oracle XE utilise une architecture CDB/PDB. Le rôle SYS avec SYSDBA est nécessaire pour gérer les conteneurs. Les utilisateurs classiques se connectent sans privilèges spéciaux. La commande ALTER SESSION SET CONTAINER permet de basculer entre les conteneurs pour la session en cours.',
        'darija' => 'Oracle XE kayarchitecture CDB/PDB. Role SYS with SYSDBA kaynecessary b manage containers. Utilisateurs classiques kayconnect sans privileges spéciaux. ALTER SESSION SET CONTAINER kayswitch entre conteneurs b session.'
    ],
];