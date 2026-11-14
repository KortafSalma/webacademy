<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 8 : INSERT, UPDATE et DELETE
 * Langage DML (Data Manipulation Language) pour manipuler les données dans les tables.
 */

return [
    'id'       => 'oracle-ch8',
    'title'    => 'INSERT, UPDATE et DELETE',
    'subtitle' => 'Manipulation des données : ajouter, modifier, supprimer',

    'objectives' => [
        'Insérer de nouvelles lignes dans une table avec INSERT.',
        'Modifier des lignes existantes avec UPDATE.',
        'Supprimer des lignes avec DELETE.',
        'Utiliser les clauses RETURNING INTO pour récupérer les valeurs modifiées.',
        'Comprendre l\'importance des transactions (COMMIT, ROLLBACK).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'insert-into',
            'title' => 'INSERT : insérer des lignes',
            'icon'  => '➕',
            'blocks' => [

                make_definition_block(
                    'INSERT INTO',
                    '<p>La commande <strong>INSERT INTO</strong> insère de nouvelles lignes dans une table.</p>',
                    '<p><b>INSERT INTO</b> insère nouvelles lignes table.</p>'
                ),

                make_example_block(
                    'INSERT basique avec liste de colonnes',
                    '<pre><code>-- Insérer une nouvelle commande\nINSERT INTO commandes (cmd_id, client_id, montant, statut)\nVALUES (1001, 5, 299.50, \'EN_ATTENTE\');</code></pre>',
                    '<pre>1 row created.\n</pre>',
                    'Une seule ligne est insérée avec les valeurs spécifiées.'
                ),

                make_example_block(
                    'INSERT avec SELECT',
                    '<pre><code>-- Insérer les clients français dans une nouvelle table\nINSERT INTO clients_francais (id, nom, email)\nSELECT id, nom, email\nFROM clients\nWHERE pays = \'France\';</code></pre>',
                    '<pre>Rows created: 15</pre>',
                    'Les lignes sont insérées à partir du résultat d\'une requête SELECT.'
                ),

                make_note_block(
                    'Ordres des colonnes',
                    '<p>Si vous omettez la liste des colonnes dans INSERT, vous devez fournir des valeurs pour <strong>toutes</strong> les colonnes de la table dans l\'ordre exact du schéma.</p>',
                    '<p>Si omettez liste colonnes INSERT, kaylik fournir valeurs pour <b>toutes</b> colonnes table dans ordre exact schéma.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'update',
            'title' => 'UPDATE : modifier des lignes',
            'icon'  => '✏️',
            'blocks' => [

                make_definition_block(
                    'UPDATE ... SET',
                    '<p>La commande <strong>UPDATE</strong> modifie des valeurs dans des lignes existantes.</p>',
                    '<p><b>UPDATE</b> modifie valeurs lignes existantes.</p>'
                ),

                make_example_block(
                    'UPDATE basique',
                    '<pre><code>-- Modifier le statut d\'une commande\nUPDATE commandes\nSET statut = \'EXPEDIÉ\'\nWHERE cmd_id = 1001;</code></pre>',
                    '<pre>1 row updated.\n</pre>',
                    'Le statut de la commande 1001 est passé à EXPÉDIÉ.'
                ),

                make_example_block(
                    'UPDATE avec plusieurs colonnes',
                    '<pre><code>-- Modifier le salaire et le département d\'un employé\nUPDATE employés\nSET salaire = 3500, dep_id = 5\nWHERE emp_id = 105;</code></pre>',
                    '<pre>1 row updated.\n</pre>',
                    'Deux colonnes (salaire, dep_id) sont modifiées pour l\'employé 105.'
                ),

                make_tip_block(
                    'WHERE est obligatoire (en général)',
                    '<p>Toujours inclure une clause <code>WHERE</code> dans UPDATE pour spécifier quelles lignes modifier. Sans WHERE, <strong>toutes</strong> les lignes de la table seront modifiées.</p>',
                    '<p>Toujours inclure clause <code>WHERE</code> UPDATE b spécifier quelles lignes modifier. Sans WHERE, <b>toutes</b> lignes table seront modifiées.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'delete',
            'title' => 'DELETE : supprimer des lignes',
            'icon'  => '🗑️',
            'blocks' => [

                make_definition_block(
                    'DELETE FROM',
                    '<p>La commande <strong>DELETE FROM</strong> supprime des lignes d\'une table.</p>',
                    '<p><b>DELETE FROM</b> supprime lignes table.</p>'
                ),

                make_example_block(
                    'DELETE basique',
                    '<pre><code>-- Supprimer une commande annulée\nDELETE FROM commandes\nWHERE cmd_id = 1001;</code></pre>',
                    '<pre>1 row deleted.\n</pre>',
                    'La ligne correspondant à cmd_id 1001 est supprimée.'
                ),

                make_example_block(
                    'DELETE avec sous-requête',
                    '<pre><code>-- Supprimer tous les produits qui ne sont plus en stock\nDELETE FROM produits\nWHERE quantite_stock = 0;</code></pre>',
                    '<pre>Rows deleted: 23</pre>',
                    'Toutes les lignes remplissant la condition sont supprimées.'
                ),

                make_tip_block(
                    'DELETE et transactions',
                    '<p>Les lignes supprimées par DELETE peuvent être rétablies avec ROLLBACK si la transaction n\'a pas été validée (COMMIT).</p>',
                    '<p>Lignes supprimées par DELETE kay rétablies b ROLLBACK si transaction non validée (COMMIT).</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublir la clause WHERE dans UPDATE ou DELETE',
            'fix'    => 'Toujours inclure une clause WHERE pour limiter l\'effet à certaines lignes.',
            'fr'     => 'Sans clause WHERE, toutes les lignes de la table seront modifiées ou supprimées, ce qui peut être catastrophique.',
            'darija' => 'Sans WHERE, toutes lignes table modifiera ou supprimera, kaycould catastrophique.'
        ],
        [
            'wrong'  => 'Confondre TRUNCATE et DELETE pour les transactions',
            'fix'    => 'Rappeler que TRUNCATE est auto-committable et ne peut pas être annulé.',
            'fr'     => 'Contrairement à DELETE, TRUNCATE ne peut pas être annulé par ROLLBACK. Si vous devez pouvoir restaurer les données, utilisez DELETE au lieu de TRUNCATE.',
            'darija' => 'Contrairement DELETE, TRUNCATE kaylik kayknwal annulé b ROLLBACK.'
        ],
    ],

    'summary' => [
        'fr'     => 'INSERT ajoute des lignes, UPDATE modifie des lignes existantes (toujours avec WHERE), DELETE supprime des lignes (pouvables annulées avant COMMIT). Gérer les transactions avec COMMIT (valider) et ROLLBACK (annuler).',
        'darija' => 'INSERT kayligne, UPDATE modifie lignes existantes (toujours WITH WHERE), DELETE supprime lignes (pouvables annulées avant COMMIT). Gérer transactions COMMIT (valider) w ROLLBACK (annuler).'
    ],
];