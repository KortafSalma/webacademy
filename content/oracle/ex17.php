<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch17 — Vues, s�quences et index.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex17',
    'title' => 'Exercices — Vues, s�quences et index',
    'brief' => "Premiers pas avec les objets de base de données Oracle.",
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Initieur — Création dune vue',
            'lang'  => 'oracle',
            'instructions' => '<p>Creez une vue vue_clients qui affiche id, nom et email � partir de la table clients.</p>',
            'instructionsDarija' => '<p>Vue creation vue_clients id nom email table clients.</p>',
            'starter' => 'CREATE VIEW vue_clients AS SELECT id, nom, email FROM clients;',
            'hints' => [
                'Une vue est une table virtuelle bas�e sur une requ�te SELECT.',
                'Elle ne stocke pas les donn�es elle-m�me.',
            ],
            'solution' => 'CREATE VIEW vue_clients AS SELECT id, nom, email FROM clients;',
            'explainFr' => 'La vue vue_clients affiche id, nom et email de la table clients sans stocke de donn�es.',
            'explainDarija' => 'Vue vue_clients id nom email clients sans stocker donn�es.',
        ],

        [
            'level' => 2,
            'title' => 'Interm�diaire — Création dune s�quence',
            'lang'  => 'oracle',
            'instructions' => '<p>Crez une s�quence seq_client d�marre � 1 et incr�mente de 1 � chaque utilisation.</p>',
            'instructionsDarija' => '<p>Sequence creation seq_client start 1 increment 1.</p>',
            'starter' => 'CREATE SEQUENCE seq_client START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;',
            'hints' => [
                'NOCACHE stocke pas les valeurs en m�moire tampon.',
                'NOCYCLE n�autorise pas le red�marrage apr�s la fin.',
            ],
            'solution' => 'CREATE SEQUENCE seq_client START WITH 1 INCREMENT BY 1 NOCACHE NOCYCLE;',
            'explainFr' => 'La s�quence seq_client commence � 1, incr�mente de 1 � chaque appel, et ne met pas en cache les valeurs.',
            'explainDarija' => 'Sequence seq_client kay 1 b3de, kay 1 increment b3d, cache NOCACHE, cycle pas NOCYCLE.',
        ],

        [
            'level' => 3,
            'title' => 'Interm�diaire — Utilisation de NEXT VALUE FOR',
            'lang'  => 'oracle',
            'instructions' => '<p>Inserez un nouveau client en utilisant NEXT VALUE FOR seq_client pour lidentifiant.</p>',
            'instructionsDarija' => '<p>Insert new client using NEXT VALUE FOR seq_client identifiant.</p>',
            'starter' => 'INSERT INTO clients (id, nom, email) VALUES (NEXT VALUE FOR seq_client, Mohamed, moh@exemple.com);',
            'hints' => [
                'NEXT VALUE FOR avance dans la s�quence.',
                'La colonne id doit correspondre au type de la s�quence.',
            ],
            'solution' => 'INSERT INTO clients (id, nom, email) VALUES (NEXT VALUE FOR seq_client, Mohamed, moh@exemple.com);',
            'explainFr' => 'Linsertion utilise NEXT VALUE FOR pour affecter le num�r� de s�quence � identifiant.',
            'explainDarija' => 'Insertion NEXT VALUE FOR kay sequence number assign identifiant.',
        ],

        [
            'level' => 4,
            'title' => 'Interm�diaire — Creation dun index',
            'lang'  => 'oracle',
            'instructions' => '<p>Crez un index idx_client_nom sur la colonne nom de la table clients.</p>',
            'instructionsDarija' => '<p>Index idx_client_nom creation nom colonne clients table.</p>',
            'starter' => 'CREATE INDEX idx_client_nom ON clients (nom);',
            'hints' => [
                'Les index accelerent les recherches fr�quentement effectuees.',
                'Evitez dindexer trop de colonnes.',
            ],
            'solution' => 'CREATE INDEX idx_client_nom ON clients (nom);',
            'explainFr' => 'Lindex idx_client_nom accel�re les recherches sur la colonne nom.',
            'explainDarija' => 'Index idx_client_nom kay search acceler�re sur colonne nom.',
        ],

        [
            'level' => 5,
            'title' => 'Avanc� — Vues mat�rialis�es',
            'lang'  => 'oracle',
            'instructions' => '<p>Crez une vue mat�rialis�e vm_client_total qui stocke le total des commandes par client.</p>',
            'instructionsDarija' => '<p>Materialized view vm_client_total creation total commandes par client.</p>',
            'starter' => 'CREATE MATERIALIZED VIEW vm_client_total AS SELECT client_id, COUNT(*) AS total_cmds FROM clients GROUP BY client_id;',
            'hints' => [
                'Une vue mat�rialis�e stocke les donn�es au lieu d�ex�cuter la requ�te � chaque fois.',
                'Elle doit �tre actualis�e p�riodiquement avec DBMS_MVIEW.REFRESH.',
            ],
            'solution' => 'CREATE MATERIALIZED VIEW vm_client_total AS SELECT client_id, COUNT(*) AS total_cmds FROM clients GROUP BY client_id;',
            'explainFr' => 'La vue mat�rialis�e vm_client_total stocke le r�sultat de la requ�te et doit �tre rafra�chie ensuite.',
            'explainDarija' => 'Materialized view vm_client_total donn�es stocker rafraichir DBMS_MVIEW.REFRESH.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];