<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 27 : Triggers
 * Déclencheurs automatiques qui s\'exécutent avant ou après des événements sur les tables.
 */

return [
    'id'       => 'oracle-ch27',
    'title'    => 'Triggers',
    'subtitle' => 'Déclenchements automatiques',

    'objectives' => [
        'Créer un trigger avec CREATE TRIGGER.',
        'Différencier les triggers BEFORE (avant) et AFTER (après) INSERT, UPDATE, DELETE.',
        'Utiliser le contexte : NEW et OLD pour accéder aux valeurs nouvelles et anciennes.',
        'Créer des triggers au niveau de la ligne (FOR EACH ROW) ou au niveau de la statement.',
        'Comprendre les cas d\'utilisation courants (audit, validation, calcul).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'trigger-base',
            'title' => 'Créer un trigger basique',
            'icon'  => '🔔',
            'blocks' => [

                make_definition_block(
                    'CREATE TRIGGER',
                    '<p>La commande <strong>CREATE TRIGGER</strong> crée un déclencheur qui s\'exécute automatiquement lorsqu\'un événement spécifié (INSERT, UPDATE, DELETE) se produit sur une table.</p>',
                    '<p><b>CREATE TRIGGER</b> déclencheur s\'exécute automatiquement événement INSERT UPDATE DELETE table.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'BEFORE', 'fr' => 'AVANT', 'darija' => 'AVANT'],
                    ['kw' => 'AFTER', 'fr' => 'APRÈS', 'darija' => 'APRÈS'],
                    ['kw' => 'INSERT', 'fr' => 'INSERT', 'darija' => 'INSERT'],
                    ['kw' => 'UPDATE', 'fr' => 'UPDATE', 'darija' => 'UPDATE'],
                    ['kw' => 'DELETE', 'fr' => 'DELETE', 'darija' => 'DELETE'],
                    ['kw' => 'FOR EACH ROW', 'fr' => 'Pour chaque ligne', 'darija' => 'Pour chaque ligne'],
                ]),

                make_example_block(
                    'Trigger BEFORE INSERT : valider un champ obligatoire',
                    '<pre><code>CREATE OR REPLACE TRIGGER trg_valider_avant_insert\nBEFORE INSERT ON commandes\nFOR EACH ROW\nBEGIN\n  IF :NEW.statut IS NULL THEN\n    :NEW.statut := \'EN_ATTENTE\';\n  END IF;\nEND;</code></pre>',
                    '<pre>Trigger created.</pre>',
                    'Avant chaque insertion dans la table commandes, si le statut est NULL, il devient "EN_ATTENTE".'
                ),

                make_example_block(
                    'Trigger AFTER UPDATE : journaliser les modifications',
                    '<pre><code>CREATE OR REPLACE TRIGGER trg_journaliser_update\nAFTER UPDATE ON employés\nFOR EACH ROW\nBEGIN\n  NULL;\nEND;</code></pre>',
                    '<pre>Trigger created.</pre>',
                    'Après chaque modification sur la table employés, ce trigger peut journaliser les changements (ici omis pour la brièveté).'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'new-old',
            'title' => 'Contexte : NEW et OLD',
            'icon'  => '🔄',
            'blocks' => [

                make_definition_block(
                    'NEW',
                    '<p>Dans un trigger <strong>BEFORE</strong>, <strong>:NEW</strong> référence les valeurs des nouvelles lignes (pour INSERT et UPDATE). Dans un trigger <strong>AFTER</strong>, :NEW contient les valeurs telles qu\'après la modification.</p>',
                    '<p><b>NEW</b> référence valeurs nouvelles lignes BEFORE INSERT UPDATE. AFTER contient valeurs après modification.</p>'
                ),

                make_definition_block(
                    'OLD',
                    '<p>Dans un trigger <strong>AFTER</strong>, <strong>:OLD</strong> référence les valeurs anciennes (pour DELETE et UPDATE). Dans un trigger <strong>BEFORE</strong>, :OLD contient les valeurs telles qu\'avant la modification.</p>',
                    '<p><b>OLD</b> référence valeurs anciennes AFTER DELETE UPDATE. BEFORE contient valeurs avant modification.</p>'
                ),

                make_example_block(
                    'Trigger avec :OLD et :NEW : empêcher la suppression des clients ayant des commandes',
                    '<pre><code>CREATE OR REPLACE TRIGGER trg_protéger_suppression_clients\nBEFORE DELETE ON clients\nFOR EACH ROW\nBEGIN\n  SELECT COUNT(*)\n  INTO v_compte\n  FROM commandes\n  WHERE client_id = :OLD.id;\n  IF v_compte > 0 THEN\n    RAISE_APPLICATION_ERROR(-20001, \'Impossible de supprimer un client ayant des commandes existantes.\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Trigger created.</pre>',
                    'Empêche la suppression d\'un client s\'il a des commandes en lien. L\'ancienne clé primaire est accessible via :OLD.id.'
                ),

                make_tip_block(
                    'Accès à :OLD et :NEW selon le type d\'événement',
                    '<p>Pour les triggers INSERT, :NEW est disponible, :OLD est NULL. Pour les triggers DELETE, :OLD est disponible, :NEW est NULL. Pour les triggers UPDATE, les deux :OLD et :NEW sont disponibles (ancienne et nouvelle valeur).</p>',
                    '<p>INSERT :NEW disponible, :OLD NULL. DELETE :OLD disponible, :NEW NULL. UPDATE :OLD et :NEW disponibles.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier FOR EACH ROW ou FOR EACH STATEMENT',
            'fix'    => 'Déterminez si le trigger doit s\'exécuter pour chaque ligne affectée (FOR EACH ROW) ou une seule fois par instruction SQL (sans FOR EACH ROW, par défaut STATEMENT).',
            'fr'     => 'Sans FOR EACH ROW, le trigger s\'exécute une seule fois par instruction SQL (état). Si vous avez une table de 1000 lignes UPDATE et que vous omettez FOR EACH ROW, le trigger ne s\'exécutera qu\'une seule fois, pas 1000 fois. Utilisez FOR EACH ROW quand vous devez accéder à :NEW ou :OLD par ligne.',
            'darija' => 'Sans FOR EACH ROW trigger s\'exécute une fois instruction SQL. Si 1000 lignes UPDATE et pas FOR EACH ROW trigger exécuté une seule fois. Utilisez FOR EACH ROW accès :NEW/:OLD par ligne.'
        ],
        [
            'wrong'  => 'Confondre :OLD et :NEW selon le type d\'événement',
            'fix'    => 'Rappelez-vous : INSERT → :NEW disponible, DELETE → :OLD disponible, UPDATE → les deux disponibles. Consultez la documentation si vous avez le moindre doute.',
            'fr'     => 'La disponibilité de :OLD et :NEW dépend du type d\'événement (INSERT, UPDATE, DELETE) et du moment (BEFORE ou AFTER). Une erreur courante est deTrying de lire :NEW dans un trigger DELETE, ce qui sera NULL.',
            'darija' => 'Disponibilité :OLD/:NEW dépend type événement BEFORE/Après. Erreur couranteTrying lire :NEW trigger DELETE donnera NULL.'
        ],
    ],

    'summary' => [
        'fr'     => 'CREATE TRIGGER crée un déclencheur automatiquement exécuté. BEFORE/AFTER indique le moment. FOR EACH ROW s\'exécute par ligne, STATEMENT une fois par instruction. :NEW = nouvelles valeurs, :OLD = anciennes valeurs. Cas d\'utilisation : validation, audit, calcul automatique.',
        'darija' => 'CREATE TRIGGER déclencheur automatiquement exécuté. BEFORE/AFTER moment. FOR EACH ROW par ligne STATEMENT une fois/:NEW nouvelles valeurs :OLD anciennes valeurs. Utilisation : validation audit calcul automatique.'
    ],
];