<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch13 — GROUP BY et HAVING.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex15',
    'title' => 'Exercices — GROUP BY et HAVING',
    'brief' => 'Regrouper des lignes par valeurs communes et filtrer les groupes.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — GROUP BY simple',
            'lang'  => 'oracle',
            'instructions' => '<p>Compter le nombre de clients par ville.</p>',
            'instructionsDarija' => '<p>Compter clients par ville.</p>',
            'starter' => 'SELECT ville, COUNT(*) FROM clients GROUP BY ville',
            'hints' => [
                'GROUP BY regroupe les lignes ayant les mêmes valeurs dans les colonnes spécifiées.',
                'Utilisez souvent avec une fonction d\'agrégat comme COUNT.',
            ],
            'solution' => 'SELECT ville, COUNT(*) FROM clients GROUP BY ville',
            'explainFr' => 'GROUP BY regroupe les lignes par ville et COUNT(*) compte chaque groupe.',
            'explainDarija' => 'GROUP BY regroupent lignes mêmes valeurs COUNT(*) compte chaque groupe.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — ORDER BY avec GROUP BY',
            'lang'  => 'oracle',
            'instructions' => '<p>Compter le nombre de commandes par client, trié par nombre de commandes décroissant.</p>',
            'instructionsDarija' => '<p>Compter commandes par client trié par nombre décroissant.</p>',
            'starter' => 'SELECT client_id, COUNT(*) AS nb_cmds FROM commandes GROUP BY client_id ORDER BY nb_cmds DESC',
            'hints' => [
                'Ajoutez ORDER BY après GROUP BY pour trier le résultat.',
                'Utilisez DESC pour décroissant, ASC pour croissant.',
            ],
            'solution' => 'SELECT client_id, COUNT(*) AS nb_cmds FROM commandes GROUP BY client_id ORDER BY nb_cmds DESC',
            'explainFr' => 'Le ORDER BY trie les groupes par le compte de commandes décroissant.',
            'explainDarija' => 'ORDER BY trie groupes par compte commandes décroissant.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — WHERE vs HAVING',
            'lang'  => 'oracle',
            'instructions' => '<p>Dans quelle clause placer une condition sur une fonction d\'agrégat : WHERE ou HAVING ?</p>',
            'instructionsDarija' => '<p>Kay clause placer condition fonction agrégat WHERE w HAVING ?</p>',
            'starter' => 'HAVING (pour les agrégats)',
            'hints' => [
                'WHERE filtre les lignes avant le GROUP BY.',
                'HAVING filtre les groupes après le GROUP BY.',
            ],
            'solution' => 'HAVING (pour filtrer les groupes après GROUP BY)',
            'explainFr' => 'WHERE filtre les lignes individuelles avant le groupement, HAVING filtre les groupes après GROUP BY.',
            'explainDarija' => 'WHERE filtre lignes avant GROUP BY, HAVING filtre groupes après GROUP BY.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — HAVING avec condition',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les clients qui ont passé plus de 3 commandes.</p>',
            'instructionsDarija' => '<p>Sélectionner clients plus de 3 commandes.</p>',
            'starter' => 'SELECT client_id, COUNT(*) AS nb_cmds FROM commandes GROUP BY client_id HAVING COUNT(*) > 3',
            'hints' => [
                'Utilisez HAVING pour filtrer les groupes.',
                'La condition porte sur une fonction d\'agrégat.',
            ],
            'solution' => 'SELECT client_id, COUNT(*) AS nb_cmds FROM commandes GROUP BY client_id HAVING COUNT(*) > 3',
            'explainFr' => 'HAVING filtre les groupes qui satisfont la condition COUNT(*) > 3.',
            'explainDarija' => 'HAVING filtre groupes satisfont condition COUNT(*) > 3.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — HAVING avec condition sur agrégat',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez les catégories dont le prix moyen est supérieur à 50.</p>',
            'instructionsDarija' => '<p>Sélectionner catégories prix moyen supérieur à 50.</p>',
            'starter' => 'SELECT categorie, AVG(prix) AS prix_moyen FROM produits GROUP BY categorie HAVING AVG(prix) > 50',
            'hints' => [
                'HAVING peut contenir n\'importe quelle condition sur les agrégats.',
                'AVG(prix) > 50 filtre les catégories au prix moyen supérieur à 50.',
            ],
            'solution' => 'SELECT categorie, AVG(prix) AS prix_moyen FROM produits GROUP BY categorie HAVING AVG(prix) > 50',
            'explainFr' => 'La clause HAVING filtre les groupes dont la moyenne des prix dépasse 50.',
            'explainDarija' => 'HAVING filtre groupes moyenne prix supérieur à 50.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];