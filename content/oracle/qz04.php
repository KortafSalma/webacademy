<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch7 — CREATE, ALTER, DROP et TRUNCATE.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Langage DDL : CREATE, ALTER, DROP, TRUNCATE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'Quelle commande supprime complètement une table et ses données ?',
            'options' => ['TRUNCATE TABLE', 'DROP TABLE', 'ALTER TABLE', 'DELETE TABLE'],
            'answer'  => 1,
            'concept' => 'Commandes DDL',
            'explainFr' => 'DROP TABLE supprime complètement la table, sa structure et toutes ses données de façon irréversible.',
            'explainDarija' => 'DROP TABLE supprime totalement table structure données b irréversible.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La commande qui vide une table en conservant sa structure s\'appelle ________.',
            'expected'=> 'TRUNCATE TABLE',
            'accept'  => ['TRUNCATE TABLE', 'truncate table'],
            'concept' => 'Commandes DDL',
            'explainFr' => 'TRUNCATE TABLE supprime seulement les lignes mais conserve le schéma de la table.',
            'explainDarija' => 'TRUNCATE TABLE vide lignes conserve structure table.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'TRUNCATE TABLE peut être annulé par un ROLLBACK.',
            'answer'  => 0,
            'concept' => 'TRUNCATE vs DELETE',
            'explainFr' => 'Faux : TRUNCATE TABLE effectue un COMMIT implicite. Une fois exécuté, l\'opération ne peut pas être annulée par ROLLBACK.',
            'explainDarija' => 'Faux : TRUNCATE TABLE effectue COMMIT implicite kaylik kayknwal annulé ROLLBACK.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : DROP TABLE ma_table; (oubli du point-virgule)',
            'options' => ['DROP TABLE ma_table', 'Oubli du point-virgule', 'Aucune erreur', 'Syntax correcte'],
            'answer'  => 1,
            'concept' => 'Syntaxe DDL',
            'explainFr' => 'En Oracle, les commandes doivent se terminer par un point-virgule (;). Oublier le point-virgule peut provoquer une erreur.',
            'explainDarija' => 'Oracle commandes doivent terminer par point-virgule (;). Oublier kay erreur syntax.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que se passera-t-il si l\'on exécute TRUNCATE TABLE commandes dans une transaction non validée ?',
            'options' => ['Les lignes peuvent être restaurées avec ROLLBACK', 'Les lignes sont définitivement supprimées', 'Erreur de syntaxe', 'Aucun effet'],
            'answer'  => 1,
            'concept' => 'TRUNCATE et transactions',
            'explainFr' => 'Faux : TRUNCATE est auto-committable, il ne peut pas être annulé par ROLLBACK. Utilisez DELETE si vous avez besoin d\'annulation.',
            'explainDarija' => 'Faux : TRUNCATE auto-committable kaylik kayknwal annulé ROLLBACK. Utilisez DELETE b avez besoin annulation.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quelle est la différence entre DROP et TRUNCATE ?',
            'options' => ['DROP supprime structure données, TRUNCATE vide données structure', 'DROP vide structure, TRUNCATE supprime données', 'Identique', 'Aucune des réponses ci-dessus'],
            'answer'  => 0,
            'concept' => 'DROP vs TRUNCATE',
            'explainFr' => 'DROP supprime complètement la table (structure + données), TRUNCATE ne supprime que les lignes mais conserve le schéma.',
            'explainDarija' => 'DROP supprime structure données, TRUNCATE vide données structure.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La commande qui supprime toutes les lignes d\'une table tout en conservant son schéma s\'appelle ________.',
            'expected'=> 'TRUNCATE TABLE',
            'accept'  => ['TRUNCATE TABLE', 'truncate table'],
            'concept' => 'Commandes DDL',
            'explainFr' => 'TRUNCATE TABLE supprime les lignes mais conserve la structure (schéma) de la table.',
            'explainDarija' => 'TRUNCATE TABLE vide lignes conserve structure table.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Utiliser TRUNCATE est plus rapide que DELETE pour vider une grande table.',
            'answer'  => 1,
            'concept' => 'Performance TRUNCATE',
            'explainFr' => 'Vrai : TRUNCATE est plus rapide car il utilise moins de journalisation que DELETE.',
            'explainDarija' => 'Vrai : TRUNCATE plus rapide w moins journalisation que DELETE.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Que fait ALTER TABLE ?',
            'options' => ['Modifie la structure d\'une table existante', 'Supprime une table', 'Crée une nouvelle table', 'Renomme une table'],
            'answer'  => 0,
            'concept' => 'Commande ALTER TABLE',
            'explainFr' => 'ALTER TABLE permet d\'ajouter, modifier ou supprimer des colonnes et des contraintes.',
            'explainDarija' => 'ALTER TABLE modifie structure table existante ajouter modifier supprimer colonnes contraintes.',
        ],

    ],
];