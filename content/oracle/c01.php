<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 1 : Introduction à Oracle Database et Oracle XE
 * Voyager dans le monde des bases de données Oracle : architecture, éditions,
 * rôles utilisateurs et premiers pas dans SQL*Plus / SQL Developer.
 *
 * Exemplaire de référence pour TOUS les fichiers de chapitre Oracle :
 *   - id : "oracle-ch1"
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : résumé FR + Darija
 * Types de blocs :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'oracle-ch1',
    'title'    => 'Introduction à Oracle Database et Oracle XE',
    'subtitle' => 'Pourquoi Oracle ?, les éditions XE et l\'architecture de base',

    'objectives' => [
        'Comprendre ce qu\'est une base de relationnelle et un SGBD.',
        'Identifier les différentes éditions d\'Oracle Database.',
        'S\'installer et configurer Oracle Database Express Edition (XE).',
        'Différencier les rôles SYS, SYSTEM et les utilisateurs courants.',
        'Se connecter pour la première fois avec SQL*Plus et SQL Developer.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'architecture-oracle',
            'title' => 'Architecture d\'Oracle Database',
            'icon'  => '🏛️',
            'blocks' => [

                make_definition_block(
                    'SGBD (Système de Gestion de Base de Données)',
                    '<p>Un SGBD est un logiciel qui crée et fait gérer des bases de données. Il assure la <strong>stockage, la sécurité, la concurrence et la récupération</strong> des données. Oracle Database est un SGBD de niveau entreprise.</p>',
                    '<p>Un SGBD (Systeme de Gestion de Base de Donnees) howa software li kaymanage w kaystocke les données. Il assure la sécurité, w la concurrence, w la récupération.</p>'
                ),

                make_definition_block(
                    'Architecture client-serveur',
                    '<p>Oracle fonctionne sur un modèle <strong>client-serveur</strong> : le serveur (Oracle Database) stocke les données et traite les requêtes ; le client (SQL*Plus, SQL Developer, application) envoie les requêtes et affiche les résultats.</p>',
                    '<p>Oracle kaykhdem b model <b>client-server</b> : le serveur (Oracle Database) stocke les données w traite les requêtes ; le client (SQL*Plus, SQL Developer, application) kaymchi yodlob les requêtes w kayaffich les résultats.</p>'
                ),

                make_example_block(
                    'Exemple : structure d\'une base Oracle',
                    '<pre><code>-- Voir la vue V$PARAMETER pour les paramètres initiaux\nSHOW PARAMETER database_name\nSHOW PARAMETER compatible</code></pre>',
                    '<pre>NAME             VALUE
-------------------- ------------------------------
database_name    XE
compatible       19.0.0.0.0</pre>',
                    'Les commandes SHOW permettent de vérifier la configuration actuelle de la base de données.',
                    'Commands SHOW kaycheck la configuration actuelle de la base.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'editions-oracle',
            'title' => 'Les éditions d\'Oracle Database',
            'icon'  => '📦',
            'blocks' => [

                make_text_block(
                    '<p>Oracle Database existe en plusieurs éditions selon les besoins :</p>',
                    '<p>Oracle Database kayjib editiouns plusieurs selon les besoins :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'Enterprise Edition (EE)', 'fr' => 'Édition Entreprise', 'darija' => 'Edition entperayiz'],
                    ['kw' => 'Standard Edition (SE)', 'fr' => 'Édition Standard', 'darija' => 'Edition standard'],
                    ['kw' => 'Express Edition (XE)', 'fr' => 'Édition Express', 'darija' => 'Edition express'],
                ]),

                make_text_block(
                    '<p><strong>Oracle Database 23c XE</strong> est la version gratuite, idéale pour l\'apprentissage, le développement et les petites deployments. Elle est téléchargeable gratuitement depuis le site d\'Oracle et limite la mémoire utilisée à <strong>12 Go</strong>.</p>',
                    '<p><b>Oracle Database 23c XE</b> howa version gratuite, ideal pour l'apprentissage, le developpement w les petites deployments. Telechargeable gratuit depuis site Oracle w memory limit 12 Go.</p>'
                ),

                make_tip_block(
                    'Quand utiliser XE ?',
                    '<p>L\'édition XE convient parfaitement pour apprendre SQL et PL/SQL, développer des applications de petite à moyenne taille, et des projets scolaires ou personnels. Pour les charges de production intensives, optez pour une édition payante.</p>',
                    '<p>XE howa khayef b3d lernen SQL w PL/SQL, developpaption application petite w moyenne size, w projets scolaire w personnel. For production intensif, optez pour edition payante.</p>'
                ),

                make_example_block(
                    'Téléchargement de XE',
                    '<pre><code>-- Rendez-vous sur : https://www.oracle.com/database/technologies/downloads-express.html\n-- Exécutez le installateur Windows ou Linux selon votre OS\n-- Lors de l\'installation, le port par défaut est 1521\n-- Mot de passe par défaut de l\'utilisateur SYSTEM : Manager</code></pre>',
                    '<pre>1. Allez sur le site Oracle XE\n2. Téléchargez la version adaptée à votre système d\'exploitation\n3. Exécutez le fichier d\'installation\n4. Suivez l\'assistant : mot de passe SYSTEM = Manager, port 1521</pre>',
                    'L\'installation de XE est guidée et ne prend que quelques minutes.',
                    'Installation XE kaydem b3d steps : site, download, execute, follow wizard.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'roles-sys-system',
            'title' => 'Rôles : SYS, SYSTEM et utilisateurs',
            'icon'  => '👤',
            'blocks' => [

                make_definition_block(
                    'Rôle SYS',
                    '<p>Le rôle <strong>SYS</strong> est le super-administrateur par défaut. Il a tous les privilèges du système et contrôle la base de données de manière complète. <strong>Niveau d\'expert : n\'utilisez SYS que pour l\'administration de base.</strong></p>',
                    '<p>Rôle <b>SYS</b> howa super-adminitrator par défaut. Il kaylik tous les privileges system w control la base data b complete. Niveau expert : kaylik SYS pour l\'administration de base.</p>'
                ),

                make_definition_block(
                    'Rôle SYSTEM',
                    '<p>Le rôle <strong>SYSTEM</strong> est destiné aux administrateurs de base de données. Il dispose de privilèges étendus pour créer des utilisateurs, des tables, des vues, etc., mais ne peut pas aussi facilement altérer la structure interne de la base que SYS.</p>',
                    '<p>Rôle <b>SYSTEM</b> destin admin base de donnees. Il kaylik privileges pour create users, tables, vues, etc., mais kaylim altèrer structure interne comme SYS.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'SYS', 'fr' => 'Super-administrateur', 'darija' => 'Super-admin'],
                    ['kw' => 'SYSTEM', 'fr' => 'Administrateur de base', 'darija' => 'Admin base'],
                    ['kw' => 'CREATE USER', 'fr' => 'Créer un utilisateur', 'darija' => 'Khssew user'],
                ]),

                make_example_block(
                    'Connexion en tant que SYS',
                    '<pre><code>-- En SQL*Plus\nSQL> CONNECT SYS as SYSDBA\nEnter password: password\n\n-- En SQL Developer :\n1. Cliquez sur "Connect"\n2. Utilisez utilisateur : SYS\n3. Mot de passe : Manager\n4. Connectez-vous en tant que SYSDBA</code></pre>',
                    '<pre>SQL*Plus: Release 21.0.0.0.0 - Production on mar. 24 juin 2025 10:30:12\n\nCopyright (c) 1982, 2025, Oracle.  All rights reserved.\n\nEnter password: ********\n\nConnected to:\nOracle Database 21c Express Edition Release 21.0.0.0.0 - Production\n</pre>',
                    'La connexion SYS avec SYSDBA permet de gérer la base au niveau mondial (création de PDB, restauration, etc.).',
                    'SYS avec SYSDBA kaymanage niveau mondial (création PDB, restauration, etc.).'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Se connecter en tant que SYS pour tous les jours',
            'fix'    => 'Utiliser un utilisateur personnel pour les requêtes quotidiennes',
            'fr'     => 'Se connecter en tant que SYS pour faire des requêtes quotidiennes est une mauvaise pratique. SYS a un contrôle total sur la base ; en cas d\'erreur, vous pouvez supprimer des données critiques. Créez un utilisateur ordinaire pour vos travaux.',
            'darija' => 'Khdmet connect SYS pour requêtes quotidiennes bad practice. SYS kaylik control total base ; f erreur, kaylik supprimer données kritik. Kreé user ordinaire pour travay quotidien.'
        ],
        [
            'wrong'  => 'Utiliser SYSTEM pour ses propres schémas',
            'fix'    => 'Créer un schéma utilisateur dédié (CREATE USER ... DEFAULT TABLESPACE)',
            'fr'     => 'Bien que SYSTEM dispose de nombreux privilèges, il ne faut pas l\'utiliser pour ses propres travaux quotidiens. Préférez créer un utilisateur dédié avec CREATE USER.',
            'darija' => 'Wla kaylik SYSTEM pour travay quotidien. Kreé user dédié b CREATE USER.'
        ],
    ],

    'summary' => [
        'fr'     => '<b>Oracle Database</b> est un SGBD puissant avec plusieurs éditions. L\'édition <b>XE</b> est gratuite pour l\'apprentissage et le développement. Les rôles <b>SYS</b> et <b>SYSTEM</b> ont des niveaux de privilèges différents : SYS est le super-administrateur, SYSTEM gère les objets de base. Toujours créer un utilisateur dédié pour vos travaux.',
        'darija' => '<b>Oracle Database</b> howa SGBD kaypowerful b editiouns multiples. XE howa gratuite b lernen w development. Roles <b>SYS</b> w <b>SYSTEM</b> kaylik levels privileges différents : SYS howa super-admin, SYSTEM gère objects base. Toujours kreé user dédié pour travay.'
    ],
];