<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch8 — INSERT, UPDATE et DELETE.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Langage DML : INSERT, UPDATE, DELETE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La commande INSERT INTO permet de :',
            'options' => ['Modifier des lignes', 'Supprimer des lignes', 'Insérer de nouvelles lignes', 'Créer une table'],
            'answer'  => 2,
            'concept' => 'Commande INSERT',
            'explainFr' => 'INSERT INTO ajoute de nouvelles lignes dans une table.',
            'explainDarija' => 'INSERT INTO kayligne nouvelles table.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause ________ est obligatoire (en général) dans une commande UPDATE pour spécifier quelles lignes modifier.',
            'expected'=> 'WHERE',
            'accept'  => ['WHERE', 'where'],
            'concept' => 'Clause WHERE UPDATE',
            'explainFr' => 'Sans WHERE, toutes les lignes de la table seraient modifiées, ce qui est dangereux.',
            'explainDarija' => 'Sans WHERE toutes lignes tablemodifier dangereux.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Une commande UPDATE sans clause WHERE modifie toutes les lignes de la table.',
            'answer'  => 1,
            'concept' => 'Clause WHERE UPDATE',
            'explainFr' => 'Vrai : Sans WHERE, toutes les lignes sont modifiées.',
            'explainDarija' => 'Vrai : Sans WHERE toutes lignes modifiées.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur potentielle : UPDATE commandes SET statut = \'EXPEDIÉ\'',
            'options' => ['Oubli du point-virgule', 'Oubli de la clause WHERE', 'Types de données incorrects', 'Pas d\'erreur'],
            'answer'  => 1,
            'concept' => 'Clause WHERE UPDATE',
            'explainFr' => 'Sans clause WHERE, la commande mettra à jour toutes les lignes de la table, ce qui est presque certainement involontaire.',
            'explainDarija' => 'Sans clause WHERE commande met à jour toutes lignes table presque certainement involontaire.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que se passe-t-il si l\'on exécute DELETE FROM commandes WHERE cmd_id = 1001 puis ROLLBACK immédiatement ?',
            'options' => ['La ligne est supprimée définitivement', 'La ligne est rétablie', 'Erreur SQL', 'Aucun effet'],
            'answer'  => 1,
            'concept' => 'Transactions DELETE',
            'explainFr' => 'En l\'absence de COMMIT, ROLLBACK restaure l\'état précédent, y compris la ligne supprimée.',
            'explainDarija' => 'Absence COMMIT ROLLBACK restore état précédent incluant ligne supprimée DELETE.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quelle commande supprime des lignes d\'une table ?',
            'options' => ['INSERT', 'UPDATE', 'DELETE', 'CREATE'],
            'answer'  => 2,
            'concept' => 'Commande DELETE',
            'explainFr' => 'DELETE FROM supprime des lignes de la table selon la condition WHERE.',
            'explainDarija' => 'DELETE FROM supprime lignes table condition WHERE.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La commande qui supprime toutes les lignes d\'une table sans la supprimer elle-même s\'appelle ________.',
            'expected'=> 'TRUNCATE TABLE',
            'accept'  => ['TRUNCATE TABLE', 'truncate table'],
            'concept' => 'Commandes DML/TRUNCATE',
            'explainFr' => 'TRUNCATE TABLE supprime les lignes mais conserve la structure de la table.',
            'explainDarija' => 'TRUNCATE TABLE vide lignes conserve structure table.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Les lignes supprimées par DELETE peuvent être rétablies avec ROLLBACK si COMMIT n\'a pas été exécuté.',
            'answer'  => 1,
            'concept' => 'Transactions DELETE',
            'explainFr' => 'Vrai : En l\'absence de COMMIT, ROLLBACK annule la transaction.',
            'explainDarija' => 'Vrai : Absence COMMIT ROLLBACK annule transaction.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Quel est le risque de faire un DELETE FROM ma_table sans clause WHERE ?',
            'options' => ['Toutes les lignes seront supprimées', 'Aucune ligne ne sera supprimée', 'Erreur de syntaxe', 'La table sera vidée mais conservée'],
            'answer'  => 0,
            'concept' => 'Danger DELETE sans WHERE',
            'explainFr' => 'Sans WHERE, toutes les lignes de la table sont supprimées, ce qui est une opération dangereuse.',
            'explainDarija' => 'Sans WHERE toutes lignes supprimées opération dangereuse.',
        ],

    ],
];