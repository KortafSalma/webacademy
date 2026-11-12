<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 17 : Vues, séquences et index
 * Objets de base de données qui simplifient l'accès, génèrent des identifiants
 * ou améliorent les performances de lecture.
 */

return [
    'id'       => 'oracle-ch17',
    'title'    => 'Vues, séquences et index',
    'subtitle' => 'Objets de base de données avancés',

    'objectives' => [
        'Créer et utiliser une vue pour simplifier les requêtes.',
        'Créer et utiliser une séquence pour générer des identifiants uniques.',
        'Créer des index pour accélérer les requêtes de recherche.',
        'Comprendre la différence entre une vue matérialisée et une vue classique.',
        'Gérer les index (créer, supprimer, monitorer).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'vues',
            'title' => 'Vues : simplifier les requêtes',
            'icon'  => '👁️',
            'blocks' => [

                make_definition_block(
                    'Vue (View)',
                    '<p>Une <strong>vue</strong> est une table virtuelle basée sur le résultat d\'une requête SELECT. Elle ne stocke pas les données elle-même, mais référence les tables sous-jacentes. Les modifications apportées aux tables de base se répercutent sur la vue.</p>',
                    '<p><b>Vue</b> table virtuelle basée résultat requête SELECT. Ne stocke pas données elle-même, référence tables sous-jacentes.</p>'
                ),

                make_definition_block(
                    'Avantages des vues',
                    '<ul><li>Simplification : masquent la complexité desJointures et des filtres.</li><li>Sécurité : restreignent l\'accès à certaines colonnes ou lignes.</li><li>Réutilisabilité : la même requête peut être utilisée sous forme de vue.</li></ul>',
                    '<ul><li>Simplification : masquent complexité Jointures w filtres.</li><li>Sécurité : restreignent accès colonnes ou lignes.</li><li>Réutilisabilité : même requête vue réutilisable.</li></ul>'
                ),

                make_example_block(
                    'CREATE VIEW et utilisation',
                    '<pre><code>\n-- Création d\'une vue affichant les clients avec leur total de commandes\nCREATE VIEW vue_clients_cmds AS\nSELECT c.id, c.nom, c.email, COUNT(o.cmd_id) AS total_commandes\nFROM clients c\nLEFT JOIN commandes o ON c.id = o.client_id\nGROUP BY c.id, c.nom, c.email;\n\n-- Utilisation de la vue\nSELECT *\nFROM vue_clients_cmds\nWHERE total_commandes > 5;</code></pre>',
                    '<pre>ID NOM EMAIL TOTAL_CMD\n-- ----------------- ----------- ----------\n 1  Mohamed moh@exemple.com        8\n 2  Fatima fat@exemple.com        3</pre>',
                    'La vue masque la complexité de la jointure et du GROUP BY.'
                ),

                make_tip_block(
                    'Vue vs Table',
                    '<p>Contrairement à une table, une vue ne stocke pas les données. Si vous devez stocker des résultats intermédiaires, utilisez une <strong>vue matérialisée</strong> (MATERIALIZED VIEW) qui met à jour périodiquement les données.</p>',
                    '<p>Contrairement table, vue stocke pas données. Si stocker résultats intermédiaires, utiliser <b>vue matérialisée</b> (MATERIALIZED VIEW) qui met à jour périodiquement.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'sequences',
            'title' => 'Séquences : générer des identifiants',
            'icon'  => '🔢',
            'blocks' => [

                make_definition_block(
                    'Séquence',
                    '<p>Une <strong>séquence</strong> est un objet de base de données qui génère des nombres uniques, généralement utilisés pour les clés primaires. Chaque appel à la séquence retourne le nombre suivant dans la séquence.</p>',
                    '<p><b>Séquence</b> howa objet base données kaylik générer nombres uniques, généralement utilisés clés primaires. Chaque appel séquence retourne nombre suivant.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'CREATE SEQUENCE', 'fr' => 'Créer séquence', 'darija' => 'Kreé sequence'],
                    ['kw' => 'NEXT VALUE FOR', 'fr' => 'Valeur suivante', 'darija' => 'Valeur suivante'],
                    ['kw' => 'CYCLE', 'fr' => 'Recommencer après la fin', 'darija' => 'Recommencer fin'],
                    ['kw' => 'CACHE', 'fr' => 'Mise en mémoire tampon', 'darija' => 'Mise mémoire tampon'],
                ]),

                make_example_block(
                    'CREATE SEQUENCE et NEXT VALUE',
                    '<pre><code>\n-- Création d\'une séquence pour les IDs d\'employés\nCREATE SEQUENCE seq_emp\n  START WITH 1\n  INCREMENT BY 1\n  NOCACHE\n  NOCYCLE;\n\n-- Utilisation dans un INSERT\nINSERT INTO employés (emp_id, emp_name, dep_id)\nVALUES (NEXT VALUE FOR seq_emp, \\'Mohamed\\', 5);</code></pre>',
                    '<pre>1 row created.\n</pre>',
                    'La séquence commence à 1, incrémente de 1 à chaque utilisation.'
                ),

                make_example_block(
                    'Prochaine valeur et valeurs courantes',
                    '<pre><code>\n-- Voir la prochaine valeur de la séquence\nSELECT NEXT VALUE FOR seq_emp AS prochain_id FROM dual;</code></pre>',
                    '<prochain_id>\n------------\n            2</pre>',
                    'La prochaine valeur après 1 est 2 (la séquence a été utilisée une fois).'
                ),

                make_tip_block(
                    'Séquences vs IDENTITY',
                    '<p>Depuis Oracle 12c, on peut aussi utiliser la colonne <strong>IDENTITY</strong> sur une colonne NUMBER PRIMARY KEY, qui génère automatiquement une valeur lors de l\'INSERT. Les séquences offrent cependant plus de flexibilité (CYCLE, CACHE, démarrage personnalisé).</p>',
                    '<p>Depuis Oracle 12c, colonne <b>IDENTITY</b> NUMBER PRIMARY KEY kaylik générer automatiquement valeur b INSERT. Séquences offrent plus flexibilité (CYCLE, CACHE, démarrage personnalisé).</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'index',
            'title' => 'Index : accélérer les requêtes',
            'icon'  => '📈',
            'blocks' => [

                make_definition_block(
                    'Index',
                    '<p>Un <strong>index</strong> est un objet de base de données qui améliore la vitesse des opérations de récupération de données sur une table. Oracle utilise des structures B‑tree par défaut. L\'indexation sur des colonnes fréquemment recherchées (clés étrangères, colonnes de jointure,WHERE) améliore considérablement les performances.</p>',
                    '<p><b>Index</b> améliore vitesse récupération données table. Oracle utilise structures B‑tree par défaut. Indexation colonnes fréquemment recherchées améliore performances.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'CREATE INDEX', 'fr' => 'Créer index', 'darija' => 'Kreé index'],
                    ['kw' => 'DROP INDEX', 'fr' => 'Supprimer index', 'darija' => 'Supprimer index'],
                    ['kw' => 'UNIQUE INDEX', 'fr' => 'Index unique', 'darija' => 'Index unique'],
                ]),

                make_example_block(
                    'CREATE INDEX',
                    '<pre><code>\n-- Création d\'un index sur la colonne email de la table utilisateurs\nCREATE INDEX idx_util_email\nON utilisateurs (email);</code></pre>',
                    '<pre>Index created.\n</pre>',
                    'L'index sur email accélère les recherches par adresse email.'
                ),

                make_example_block(
                    'Utilisation de l\'index',
                    '<pre><code>\n-- La requête profite automatiquement de l\'index créé précédemment\nSELECT *\nFROM utilisateurs\nWHERE email = \\'moh@exemple.com\\\';</code></pre>',
                    '<pre>ID NOM EMAIL DATE_INSCRIPTION\n-- ----------------- ----------- -----------------\n 1  Mohamed moh@exemple.com  15-JAN-2024</pre>',
                    'Oracle utilise l\'index idx_util_email pour trouver rapidement la ligne.'
                ),

                make_tip_block(
                    'Trop d\'index ralentissent les INSERT/UPDATE',
                    '<p>Chaque index inséré ou mis à jour ralentit les opérations d\'écriture (INSERT, UPDATE, DELETE). Il faut trouver un équilibre : indexer les colonnes fréquemment recherchées, mais éviter d\'indexer trop de colonnes ou de grandes tables sans nécessité.</p>',
                    '<p>Chaque index inséré/w mis à jour ralentit opérations écriture (INSERT, UPDATE, DELETE). Trouver équilibre : indexer colonnes fréquemment recherchées, éviter indexer trop de colonnes grandes tables sans nécessité.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Créer un index sur chaque colonne de la table',
            'fix'    => 'Créez des index uniquement sur les colonnes qui sont fréquemment utilisées dans les clauses WHERE, JOIN ou ORDER BY. Trop d\'index ralentissent les opérations d\'écriture.',
            'fr'     => 'Chaque index ajouté doit avoir une justification de performance. Les index sur les colonnes peu utilisées ralentissent les INSERT et UPDATE sans apporter de bénéfice en lecture.',
            'darija' => 'Chaque indexAdded doit avoir justification performance. Index colonnes peu utilisées ralentissent INSERT w UPDATE sans bénéfice lecture.'
        ],
        [
            'wrong'  => 'Confondre séquence et identité (ignorer IDENTITY)',
            'fix'    => 'Rappelez que depuis Oracle 12c, IDENTITY sur une colonne PRIMARY KEY NUMBER offre une alternative plus simple aux séquences pour l\'auto-incrémentation.',
            'fr'     => 'Bien que les séquences soient très flexibles, la colonne IDENTITY (ex: emp_id NUMBER GENERATED AS IDENTITY PRIMARY KEY) est plus simple à mettre en place pour l\'auto-incrémentation de base. Utilisez IDENTITY pour les cas simples, les séquences pour les besoins avancés.',
            'darija' => 'Bien séquences flexibles, colonne IDENTITY (emp_id NUMBER GENERATED AS IDENTITY PRIMARY KEY) plus simple auto-incrémentation de base. Utilisez IDENTITY cas simples, séquences besoins avancés.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les vues sont des tables virtuelles qui simplifient les requêtes et peuvent apporter sécurité. Les séquences génèrent des nombres uniques pour les clés primaires (ou utilisez IDENTITY depuis Oracle 12c). Les index accélèrent les recherches sur les colonnes fréquemment consultées, mais ralentissent les écritures.',
        'darija' => 'Vues tables virtuelles simplifient requêtes w sécurité. Séquences génèrent nombres uniques clés primaires (ou IDENTITY Oracle 12c). Index accélèrent recherches colonnes fréquemment consultées, ralentissent écritures.'
    ],
];