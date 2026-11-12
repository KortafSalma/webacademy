<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch27 — Triggers.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex27',
    'title' => 'Exercices — Triggers',
    'brief' => 'Déclenchements automatiques sur les tables.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE TRIGGER BEFORE INSERT',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d\'un trigger BEFORE INSERT sur la table "commandes" qui affecte la valeur par défaut "EN_ATTENTE" au statut si NULL.</p>',
            'instructionsDarija' => '<p>Création trigger BEFORE INSERT table "commandes" affecte valeur par défaut "EN_ATTENTE" statut NULL.</p>',
            'starter' => 'CREATE OR REPLACE TRIGGER trg_valider_avant_insert BEFORE INSERT ON commandes FOR EACH ROW BEGIN IF :NEW.statut IS NULL THEN :NEW.statut := \\'EN_ATTENTE\\'; END IF; END;',
            'hints' => [
                'BEFORE s\'exécute avant l\'opération INSERT.',
                'FOR EACH ROW s\'exécute pour chaque ligne affectée.',
                ':NEW référence les nouvelles valeurs.',
            ],
            'solution' => 'CREATE OR REPLACE TRIGGER trg_valider_avant_insert BEFORE INSERT ON commandes FOR EACH ROW BEGIN IF :NEW.statut IS NULL THEN :NEW.statut := \\'EN_ATTENTE\\'; END IF; END;',
            'explainFr' => 'Le trigger s\'exécute avant chaque insertion dans la table commandes. Si le statut est NULL, il devient "EN_ATTENTE".',
            'explainDarija' => 'Trigger s\\'exécute avant chaque insertion table commandes statut NULL devient "EN_ATTENTE".',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Trigger AFTER UPDATE',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d\'un trigger AFTER UPDATE sur la table "employés" qui pourrait journaliser les modifications.</p>',
            'instructionsDarija' => '<p>Création trigger AFTER UPDATE table "employés" journaliser modifications.</p>',
            'starter' => 'CREATE OR REPLACE TRIGGER trg_journaliser_update AFTER UPDATE ON employés FOR EACH ROW BEGIN NULL; END;',
            'hints' => [
                'AFTER s\'exécute après l\'opération UPDATE.',
                'FOR EACH ROW s\'exécute pour chaque ligne affectée.',
                ':OLD et :NEW contiennent les anciennes et nouvelles valeurs.',
            ],
            'solution' => 'CREATE OR REPLACE TRIGGER trg_journaliser_update AFTER UPDATE ON employés FOR EACH ROW BEGIN NULL; END;',
            'explainFr' => 'Le trigger s\'exécute après chaque modification de la table employés. Le corps est laissé vide (NULL) pour l\'exemple, mais pourrait écrire dans une table d\'audit.',
            'explainDarija' => 'Trigger s\\'exécute après chaque modification table employés corps vide可能写入表 audit.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Contexte : NEW',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans un trigger BEFORE INSERT, que référence :NEW ?</p>',
            'instructionsDarija' => '<p>Dans trigger BEFORE INSERT référence :NEW ?</p>',
            'starter' => ':NEW référence les valeurs des nouvelles lignes',
            'hints' => [
                ':NEW contient les valeurs des nouvelles lignes en cours d\'insertion ou de mise à jour.',
                'Pour INSERT, :NEW est disponible, :OLD est NULL.',
            ],
            'solution' => ':NEW référence les valeurs des nouvelles lignes',
            'explainFr' => ':NEW référence les valeurs des nouvelles lignes (celles qui sont en train d\'être insérées ou mises à jour).',
            'explainDarija' => ':NEW référence valeurs nouvelles lignes.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Contexte : OLD',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans un trigger AFTER DELETE, que référence :OLD ?</p>',
            'instructionsDarija' => '<p>Dans trigger AFTER DELETE référence :OLD ?</p>',
            'starter' => ':OLD référence les valeurs anciennes',
            'hints' => [
                ':OLD contient les valeurs des lignes avant la suppression ou la modification.',
                'Pour DELETE, :OLD est disponible, :NEW est NULL.',
            ],
            'solution' => ':OLD référence les valeurs anciennes',
            'explainFr' => ':OLD référence les valeurs anciennes (celles avant la suppression ou la modification).',
            'explainDarija' => ':OLD référence valeurs anciennes.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Empêcher suppression de client ayant des commandes',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un trigger BEFORE DELETE sur la table "clients" qui empêche la suppression si le client a des commandes existantes.</p>',
            'instructionsDarija' => '<p>Trigger BEFORE DELETE table "clients" empêche suppression si client a commandes existantes.</p>',
            'starter' => 'CREATE OR REPLACE TRIGGER trg_proteger_suppression BEFORE DELETE ON clients FOR EACH ROW BEGIN SELECT COUNT(*) INTO v_compte FROM commandes WHERE client_id = :OLD.id; IF v_compte > 0 THEN RAISE_APPLICATION_ERROR(-20001, \\'Impossible de supprimer un client ayant des commandes existantes.\\'); END IF; END;',
            'hints' => [
                'Utilisez BEFORE DELETE pour vérifier avant la suppression.',
                ':OLD.id contient l\'identifiant ancien du client supprimé.',
                'RAISE_APPLICATION_ERROR lève une erreur personnalisée.',
            ],
            'solution' => 'CREATE OR REPLACE TRIGGER trg_proteger_suppression BEFORE DELETE ON clients FOR EACH ROW BEGIN SELECT COUNT(*) INTO v_compte FROM commandes WHERE client_id = :OLD.id; IF v_compte > 0 THEN RAISE_APPLICATION_ERROR(-20001, \\'Impossible de supprimer un client ayant des commandes existantes.\\'); END IF; END;',
            'explainFr' => 'Le trigger vérifie s\'il existe des commandes pour ce client. S\'il y en a, une erreur est levée pour empêcher la suppression.',
            'explainDarija' => 'Trigger vérifie EXISTS commandes client s\\'il y en a erreur levée empêcher suppression.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];