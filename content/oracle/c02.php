<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 2 : Installation et configuration d'Oracle Database XE
 * Téléchargement, installation pas à pas, configuration du système,
 * mémoires, et vérification de l'installation.
 */

return [
    'id'       => 'oracle-ch2',
    'title'    => 'Installation et configuration d\'Oracle Database XE',
    'subtitle' => 'Guide d\'installation pas à pas sur Windows et Linux',

    'objectives' => [
        'Télécharger Oracle Database XE depuis le site officiel.',
        'Exécuter l\'installateur et suivre les étapes guidées.',
        'Configurer les paramètres de mémoire, de port et de mot de passe.',
        'Vérifier que la base de données démarrée correctement.',
        'Se connecter avec SQL*Plus et SQL Developer.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'téléchargement-xe',
            'title' => 'Téléchargement de Oracle Database XE',
            'icon'  => '📥',
            'blocks' => [

                make_text_block(
                    '<p>Pour télécharger Oracle Database XE :</p>',
                    '<p>Pour telecharger Oracle Database XE :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'Site officiel', 'fr' => 'Site officiel', 'darija' => 'Site officiel'],
                    ['kw' => 'Windows x64', 'fr' => 'Windows x64', 'darija' => 'Windows x64'],
                    ['kw' => 'Linux x86-64', 'fr' => 'Linux x86-64', 'darija' => 'Linux x86-64'],
                ]),

                make_example_block(
                    'Lien de téléchargement',
                    '<pre><code>URL : https://www.oracle.com/database/technologies/downloads-express.html\n\n1. Cliquez sur "Download" pour votre système d\'exploitation\n2. Acceptez la licence Oracle\n3. Enregistrez le fichier .zip ou .exe</code></pre>',
                    '<pre>Fichier téléchargé : oracle-xe-21c-1.0-1.x86_64.rpm (Linux)\nou oracle-xe-21c_windows_x64_213000.zip (Windows)</pre>',
                    'Vérifiez la taille du fichier (plusieurs centaines de Mo).',
                    'Verify the file size after download.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'installation-windows',
            'title' => 'Installation sous Windows',
            'icon'  => '🪟',
            'blocks' => [

                make_text_block(
                    '<p>Étapes d\'installation sous Windows :</p>',
                    '<p>Étapes d\'installation sous Windows :</p>'
                ),

                make_tip_block(
                    'Mode Express vs Personnalisé',
                    '<p>Le mode <strong>Express</strong> configure tout automatiquement (port 1521, mot de passe SYSTEM = Manager). Le mode <strong>Personnalisé</strong> permet de changer le port, le répertoire d\'installation et les paramètres de mémoire.</p>',
                    '<p>Mode <b>Express</b> kayconfigure tout automatiquement (port 1521, mot de passe SYSTEM = Manager). Mode <b>Personnalisé</b> kaylik kaychange port, repertoire installation w memory settings.</p>'
                ),

                make_example_block(
                    'Installation pas à pas (mode Express)',
                    '<pre><code>1. Double-cliquez sur le fichier .exe téléchargé\n2. Cliquez sur "Next" (Suivant)\n3. Acceptez l\'accord de licence\n4. Choisissez "Express Installation"\n5. Cliquez sur "Next"\n6. La base de données se configure et démarre automatiquement\n7. Cliquez sur "Finish"\n\n-- La base Oracle XE est désormais disponible</code></pre>',
                    '<pre>Écran d\'accueil de l\'installateur Windows...\nÉtape 2 : "Next"\nÉtape 3 : License accepted\nBase de données démarrée...</pre>',
                    'L\'installation Express sous Windows prend généralement 5 à 10 minutes.'
                ),

                make_note_block(
                    'Important après installation',
                    '<p>Après l\'installation, notez les informations suivantes :</p><ul><li>Nom de la base de données : XE</li><li>Mot de passe par défaut de SYSTEM : Manager</li><li>Port d\'écoute : 1521</li><li>Nom du service Windows : OracleServiceXE</li></ul>',
                    '<p>B3d installation, notebook l\'informations suivante :</p><ul><li>Nom base de données : XE</li><li>Mot de passe SYSTEM par défaut : Manager</li><li>Port d\'écoute : 1521</li><li>Service Windows : OracleServiceXE</li></ul>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'installation-linux',
            'title' => 'Installation sous Linux (apt/yum)',
            'icon'  => '🐧',
            'blocks' => [

                make_text_block(
                    '<p>Sous Linux, Oracle Database XE peut être installé via le gestionnaire de paquets :</p>',
                    '<p>Sous Linux, Oracle Database XE kayinstal b gestionnaire de paquets :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'RHEL/CentOS', 'fr' => 'RHEL/CentOS', 'darija' => 'RHEL/CentOS'],
                    ['kw' => 'Ubuntu/Debian', 'fr' => 'Ubuntu/Debian', 'darija' => 'Ubuntu/Debian'],
                    ['kw' => 'YUM/Apt', 'fr' => 'YUM/Apt', 'darija' => 'YUM/Apt'],
                ]),

                make_example_block(
                    'Installation sur RHEL/CentOS avec YUM',
                    '<pre><code># Télécharger le package de dépôt\nwget https://download.oracle.com/otn-pub/oracle/xe/rpm/oracle-xe-21c-1.0-1.x86_64.rpm\n\n# Installer le package\nyum local-install oracle-xe-21c-1.0-1.x86_64.rpm\n\n# Configurer la base de données (répondez aux invites)\noracle-xe configure\n\n# Démarrer la base\nservice oracle-xe start\n\n# Vérifier le statut\nservice oracle-xe status</code></pre>',
                    '<pre>Downloading Oracle XE RPM...\nPreparing...:  100% [==============================] 1/1\nInstalled: oracle-xe-21c\nConfiguring...\nPlease specify a password for the SYS user:\nPlease specify a password for the SYSTEM user:\nThe following configuration will be applied:\n  Oracle Database 21c Express Edition\n  Port: 1521\n  Memory Limit: 1GB\nDo you want to continue? [y/n]: y\n\nListener established on: 1521\nDatabase opened...\n</pre>',
                    'L\'installation via YUM/RPM sur Linux prend ~15 minutes incluant la configuration.'
                ),

                make_note_block(
                    'Configuration mémoire sous Linux',
                    '<p>Par défaut, XE est limité à 1 Go de mémoire de base de données. Si vous avez plus de RAM, vous pouvez augmenter la limite lors de la configuration avec <code>oracle-xe configure</code>.</p>',
                    '<p>B3d limite par défaut, XE kaylimit 1 Go memory. If you have more RAM, kayb3d limit b oracle-xe configure.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Lancer l\'installation sans droits d\'administrateur',
            'fix'    => 'Exécutez l\'installateur en tant qu\'administrateur (Windows) ou avec sudo (Linux).',
            'fr'     => 'L\'installation de Oracle Database XE nécessite des privilèges d\'administrateur. Sans eux, l\'installateur échouera lors du configurage des ports et des services.',
            'darija' => 'Installation b rights d\'admin échouera f configurage ports w services.'
        ],
        [
            'wrong'  => 'Oublier le mot de passe SYSTEM',
            'fix'    => 'Notifiez-vous le mot de passe (par défaut : Manager) ou réinitialisez-le après installation.',
            'fr'     => 'Le mot de passe SYSTEM est requis pour les connexions administrateur. Conservez-le dans un gestionnaire de mots de passe.',
            'darija' => 'Mot de passe SYSTEM kaylik lhet, kaydrekh f reset b3d installation.'
        ],
    ],

    'summary' => [
        'fr'     => 'L\'installation de Oracle Database XE se fait en quelques étapes : téléchargement, exécution de l\'installateur (mode Express recommandé), configuration des mots de passe et vérification du démarrage. Les mots de passe par défaut sont SYSTEM = Manager. La base est prête à être utilisée.',
        'darija' => 'Installation XE kaysteps : téléchargement, installateur (mode Express recommandé), configuration mots de passe w vérification démarrage. Mots de passe par défaut SYSTEM = Manager. Base prête l\'utilisation.'
    ],
];