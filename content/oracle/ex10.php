<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch8 — INSERT, UPDATE et DELETE.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex10',
    'title' => 'Exercices — Langage DML : INSERT, UPDATE, DELETE',
    'brief' => 'Manipulation des données : ajouter, modifier, supprimer des lignes.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — INSERT basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Insérez une nouvelle ligne dans la table "commandes" avec cmd_id 1001, client_id 5, montant 299.50 et statut EN_ATTENTE.</p>',
            'instructionsDarija' => '<p>Insérer ligne table "commandes" cmd_id 1001 client_id 5 montant 299.50 statut EN_ATTENTE.</p>',
            'starter' => "INSERT INTO commandes (cmd_id, client_id, montant, statut) VALUES (1001, 5, 299.50, 'EN_ATTENTE')",
            'hints' => [
                'Utilisez INSERT INTO table_name (colonnes) VALUES (valeurs).',
                'Les chaînes de caractères doivent être entourées de guillemets simples.',
            ],
            'solution' => "INSERT INTO commandes (cmd_id, client_id, montant, statut) VALUES (1001, 5, 299.50, 'EN_ATTENTE')",
            'explainFr' => 'La commande INSERT ajoute une nouvelle ligne dans la table avec les valeurs spécifiées.',
            'explainDarija' => 'INSERT kayligne nouvelle table valeurs spécifiées.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — UPDATE avec WHERE',
            'lang'  => 'oracle',
            'instructions' => '<p>Modifiez le statut de la commande 1001 en "EXPÉDIÉ".</p>',
            'instructionsDarija' => '<p>Modif statut commande 1001 en "EXPEDIÉ".</p>',
            'starter' => "UPDATE commandes SET statut = 'EXPÉDIÉ' WHERE cmd_id = 1001",
            'hints' => [
                'Utilisez UPDATE table_name SET colonne = valeur WHERE condition.',
                'La clause WHERE limite l\'effet à certaines lignes.',
            ],
            'solution' => "UPDATE commandes SET statut = 'EXPÉDIÉ' WHERE cmd_id = 1001",
            'explainFr' => 'La commande UPDATE modifie des valeurs dans des lignes existantes selon la condition WHERE.',
            'explainDarija' => 'UPDATE modifie valeurs lignes existantes condition WHERE.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — DELETE avec WHERE',
            'lang'  => 'oracle',
            'instructions' => '<p>Supprimez la ligne correspondant à cmd_id 1001 de la table "commandes".</p>',
            'instructionsDarija' => '<p>Supprimer ligne cmd_id 1001 table "commandes"></p>',
            'starter' => 'DELETE FROM commandes WHERE cmd_id = 1001',
            'hints' => [
                'Utilisez DELETE FROM table_name WHERE condition.',
                'La clause WHERE spécifie quelles lignes supprimer.',
            ],
            'solution' => 'DELETE FROM commandes WHERE cmd_id = 1001',
            'explainFr' => 'La commande DELETE supprime des lignes de la table selon la condition WHERE.',
            'explainDarija' => 'DELETE supprime lignes table condition WHERE.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — DELETE sans WHERE (danger)',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le risque de faire un DELETE FROM commandes sans clause WHERE ?</p>',
            'instructionsDarija' => '<p>Kay risk DELETE FROM commandes sans clause WHERE ?</p>',
            'starter' => 'Toutes les lignes seront supprimées',
            'hints' => [
                'Sans WHERE, toutes les lignes de la table sont supprimées.',
                'Ceci est une opération dangereuse et irréversible (sauf via ROLLBACK avant COMMIT).',
            ],
            'solution' => 'Sans clause WHERE, toutes les lignes de la table seront supprimées, ce qui peut être catastrophique.',
            'explainFr' => 'Sans clause WHERE, la commande DELETE supprime toutes les lignes de la table, ce qui est généralement involontaire et très dangereux.',
            'explainDarija' => 'Sans WHERE, DELETE supprime toutes lignes table kaycould catastrophique.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Transactions ROLLBACK',
            'lang'  => 'oracle',
            'instructions' => '<p>Si vous exécutez DELETE FROM commandes WHERE cmd_id = 1001 puis ROLLBACK, que se passe-t-il ?</p>',
            'instructionsDarija' => '<p>Kayf DELETE + ROLLBACK ?</p>',
            'starter' => 'Les lignes supprimées sont rétablies',
            'hints' => [
                'Les modifications effectuées par DELETE peuvent être annulées par ROLLBACK si COMMIT n\'a pas été exécuté.',
                'Après COMMIT, les données sont définitivement perdues.',
            ],
            'solution' => 'Les lignes supprimées sont rétablies (ROLLBACK annule la transaction avant COMMIT).',
            'explainFr' => 'En l\'absence de COMMIT, la commande ROLLBACK restaure l\'état précédent de la base de données, y compris les lignes supprimées par DELETE.',
            'explainDarija' => 'Absence COMMIT, ROLLBACK restore état précédent incluant lignes supprimées DELETE.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];