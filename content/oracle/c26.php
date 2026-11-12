<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 26 : Packages
 * Regroupement de procédures et fonctions liées en un seul objet optimisable.
 */

return [
    'id'       => 'oracle-ch26',
    'title'    => 'Packages',
    'subtitle' => 'Regroupement d\'objets stockés',

    'objectives' => [
        'Créer un package avec CREATE PACKAGE et CREATE PACKAGE BODY.',
        'Comprendre la différence entre la specification (interface) et le body (implémentation).',
        'Utiliser des variables globales (package-level) partagées entre toutes les procédures du package.',
        'Exécuter une procédure ou fonction depuis un package.',
        'Supprimer un package avec DROP PACKAGE.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'creation-package',
            'title' => 'Créer un package',
            'icon'  => '📦',
            'blocks' => [

                make_definition_block(
                    'Package',
                    '<p>Un <strong>package</strong> est un objet database qui regroupe plusieurs procédures, fonctions, variables et curseurs liés entre eux. Il se compose de deux parties : la specification (interface publique) et le body (implémentation privée).</p>',
                    '<p><b>Package</b> objet database regroupe procédures fonctions variables curseurs liés. Deux parties : specification interface publique body implémentation privée.</p>'
                ),

                make_definition_block(
                    'Specification (SPécification)',
                    '<p>La <strong>specification</strong> contient l\'interface publique : la déclaration des procédures, fonctions, cursors et variables visibles par les autres objets de la base. Elle est séparée de l\'implémentation pour permettre de modifier le body sans avoir à recréer la specification.</p>',
                    '<p><b>Specification</b> interface publique procédure fonctions cursors variables visibles autres objets base. Séparée implémentation modification sans recréer specification.</p>'
                ),

                make_definition_block(
                    'Body (Implémentation)',
                    '<p>Le <strong>body</strong> contient le code réel : la mise en œuvre de chaque procédure et fonction déclarée dans la specification, ainsi que les déclarations de variables privées inaccessibles depuis l\'outside.</p>',
                    '<p><b>Body</b> code réel implémentation procédure fonction déclarées variables privées inaccessibles outside.</p>'
                ),

                make_example_block(
                    'Structure de base d\'un package',
                    '<pre><code>\n-- Partie Specification\nCREATE OR REPLACE PACKAGE pak_gestion_clients IS\n  -- Variable globale visible\n  v_compteur NUMBER := 0;\n  \n  -- Procédure publique\n  PROCEDURE ajouter_client (p_nom VARCHAR2);\n  \n  -- Fonction publique\n  FUNCTION compter_clients RETURN NUMBER;\nEND pak_gestion_clients;\n\n-- Partie Body\nCREATE OR REPLACE PACKAGE BODY pak_gestion_clients IS\n  -- Variable locale (non visible outside)\n  PROCEDURE ajouter_client (p_nom VARCHAR2) IS\n  BEGIN\n    -- Insertion réelle\n    INSERT INTO clients (nom) VALUES (p_nom);\n    -- Mise à jour du compteur global\n    v_compteur := v_compteur + 1;\n  END;\n  \n  -- Implémentation de la fonction\n  FUNCTION compter_clients RETURN NUMBER IS\n  BEGIN\n    SELECT COUNT(*) INTO v_compteur FROM clients;\n    RETURN v_compteur;\n  END;\nEND pak_gestion_clients;</code></pre>',
                    '<pre>Package created.</pre>',
                    'Démonstration complète d\'un package avec variable globale partagée entre procédure et fonction.'
                ),

                make_tip_block(
                    'Quand utiliser un package ?',
                    '<p>Regroupez les objets qui sont utilisés ensemble fréquemment. Les packages offrent de meilleures performances (le code n\'est chargé qu\'une seule fois en mémoire) et une meilleure organisation du code.</p>',
                    '<p>Objets utilisés fréquemment regroupement. Meilleurs performances code chargé une seule fois mémoire meilleure organisation.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'utilisation-package',
            'title' => 'Utiliser un package',
            'icon'  => '🛠️',
            'blocks' => [

                make_example_block(
                    'Appel de procédure depuis un package',
                    '<pre><code>\n-- Exécution de la procédure depuis le package\nEXEC pak_gestion_clients.ajouter_client(\\'Nouveau Client\\');</code></pre>',
                    '<pre>1 row created.</pre>',
                    'La procédure est qualifiée du nom du package.'
                ),

                make_example_block(
                    'Appel de fonction depuis un package',
                    '<pre><code>\n-- Utilisation de la fonction dans une requête\nSELECT pak_gestion_clients.contener_clients() FROM dual;</code></pre>',
                    '<pre>COUNT\n------\n     5</pre>',
                    'La fonction est appelée qualifiée du nom du package.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le mot-clé BODY après la specification',
            'fix'    => 'Toujours créer à la fois la specification (CREATE PACKAGE) et le body (CREATE PACKAGE BODY), ou utiliser CREATE OR REPLACE PACKAGE qui créera les deux automatiquement si le body est fourni.',
            'fr'     => 'En Oracle, il est possible de créer une specification sans body (elle sera incomplète), mais pour un package fonctionnel, vous devez impérativement créer les deux parties ou utiliser CREATE OR REPLACE PACKAGE qui les créera automatiquement.',
            'darija' => 'Package fonctionnel créer les deux parties ou CREATE OR REPLACE PACKAGE automatiquement.'
        ],
        [
            'wrong'  => 'Déclarer des variables globales dans le body seulement',
            'fix'    => 'Les variables globales (accessibles par toutes les procédures) doivent être déclarées dans la specification du package, pas uniquement dans le body.',
            'fr'     => 'Les variables déclarées dans le body ne sont accessibles que depuis le body même. Pour les rendre visibles de toutes les procédures du package, déclarez-les dans la specification (en tête de package).',
            'darija' => 'Variables déclarées body accessibles body seulement. Rendre visibles toutes procédures declaration specification tête package.'
        ],
    ],

    'summary' => [
        'fr'     => 'Un package se compose d\'une specification (interface publique avec procédures, fonctions, variables globales) et d\'un body (implémentation privée avec le code réel). Les packages offrent de meilleures performances et une meilleure organisation du code.',
        'darija' => 'Package se compose specification interface publique body implémentation privée. Packages offrent meilleures performances meilleure organisation code.'
    ],
];