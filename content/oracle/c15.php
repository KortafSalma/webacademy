<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 15 : Sous-requêtes et requêtes imbriquées
 * Utiliser des requêtes SELECT à l'intérieur d'autres requêtes SELECT, INSERT, UPDATE ou DELETE.
 */

return [
    'id'       => 'oracle-ch15',
    'title'    => 'Sous-requêtes et requêtes imbriquées',
    'subtitle' => 'Requêtes dans des requêtes',

    'objectives' => [
        'Utiliser une sous-requête dans une clause SELECT (scalaire).',
        'Utiliser une sous-requête dans une clause WHERE.',
        'Utiliser une sous-requête dans une clause FROM (table dérivée).',
        'Comprendre la différence entre les sous-requêtes corrélées et non corrélées.',
        'Rédiger des requêtes complexes avec plusieurs niveaux d\'imbrication.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'scalar-sous-requete',
            'title' => 'Sous-requête scalaire dans SELECT',
            'icon'  => '📏',
            'blocks' => [

                make_definition_block(
                    'Sous-requête scalaire',
                    '<p>Une <strong>sous-requête scalaire</strong> retourne une seule valeur (une ligne, une colonne). Elle peut être utilisée dans la clause SELECT à côté des colonnes classiques.</p>',
                    '<p><b>Sous-requête scalaire</b> retourne valeur unique (ligne colonne). Utilisée SELECT à côté colonnes classiques.</p>'
                ),

                make_example_block(
                    'Sous-requête scalaire : prix moyen par rapport au global',
                    '<pre><code>-- Récupérer chaque client avec le prix moyen global\nSELECT nom,\n       (SELECT AVG(prix) FROM produits) AS prix_moyen_global\nFROM clients;</code></pre>',
                    '<pre>NOM          PRIX_MOYEN_GLOBAL\n-----------  -----------------\nMohamed              51.958\nFatima             51.958</pre>',
                    'La sous-requête (SELECT AVG(prix) FROM produits) s\'exécute une seule fois et est ajoutée à chaque ligne.'
                ),

                make_example_block(
                    'Sous-requête scalaire avec comparaison',
                    '<pre><code>-- Produits dont le prix est supérieur à la moyenne\nSELECT nom, prix\nFROM produits\nWHERE prix > (SELECT AVG(prix) FROM produits);</code></pre>',
                    '<pre>NOM      PRIX\n-------  -------\nOrdinateur   899.99</pre>',
                    'Filtre les produits dont le prix > prix moyen global.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'sous-requete-where',
            'title' => 'Sous-requête dans WHERE',
            'icon'  => '📍',
            'blocks' => [

                make_definition_block(
                    'Sous-requête dans WHERE',
                    '<p>Une sous-requête peut être placée dans la clause WHERE pour filtrer les résultats en fonction de valeurs issues d\'une autre requête.</p>',
                    '<p>Sous-requête peut être placée WHERE filtrer résultats basé sur valeurs autre requête.</p>'
                ),

                make_example_block(
                    'Comparaison avec = ANY (sous-requête)',
                    '<pre><code>-- Clients qui ont passé au moins une commande\nSELECT id, nom\nFROM clients\nWHERE id = ANY (SELECT client_id FROM commandes);</code></pre>',
                    '<pre>ID NOM\n-- -----------------\n 1  Mohamed\n 2  Fatima\n 3  Zakaria\n 5  Omar</pre>',
                    'Clients dont l\'id apparaît dans la liste des client_id de commandes.'
                ),

                make_example_block(
                    'Comparaison avec IN (sous-requête)',
                    '<pre><code>-- Produits jamais commandés (leur ID n\'apparaît pas dans commandes)\nSELECT nom\nFROM produits\nWHERE id NOT IN (SELECT DISTINCT produit_id FROM detal_cmds);</code></pre>',
                    '<pre>NOM\n------\nStylo\nCahier</pre>',
                    'Produits dont l\'id n\'est pas dans les produits des détails de commandes.'
                ),

                make_tip_block(
                    'Corrélées vs Non corrélées',
                    '<p>Une <strong>sous-requête non corrélée</strong> peut s\'exécuter indépendamment (elle ne fait pas référence à la requête externe). Une <strong>sous-requête corrélée</strong> référence des colonnes de la requête externe et s\'exécute une fois pour chaque ligne traitée par la requête externe.</p>',
                    '<p>Non corrélée : s\'exécute indépendamment. Corrélée : référence colonnes requête externe, s\'exécute une fois par ligne.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'sous-requete-from',
            'title' => 'Sous-requête dans FROM (table dérivée)',
            'icon'  => '📊',
            'blocks' => [

                make_definition_block(
                    'Sous-requête dans FROM',
                    '<p>Une sous-requête peut être placée dans la clause FROM et traitée comme une table virtuelle (aussi appelée table dérivée). Elle doit recevoir un alias pour pouvoir être référencée.</p>',
                    '<p>Sous-requête FROM traitée comme table virtuelle. Doit recevoir alias référencée.</p>'
                ),

                make_example_block(
                    'Sous-requête FROM : commandes par client',
                    '<pre><code>-- Compter le nombre de commandes par client en utilisant une table dérivée\nSELECT client_id, nb_cmds\nFROM (SELECT client_id, COUNT(*) AS nb_cmds FROM commandes GROUP BY client_id) WHERE nb_cmds > 2;</code></pre>',
                    '<pre>CLIENT_ID  NB_CMDS\n---------  -------\n        5          10\n        8          5</pre>',
                    'La sous-requête GROUP BY crée une table virtuelle, puis on filtre avec WHERE nb_cmds > 2.'
                ),

                make_example_block(
                    'Jointure avec table dérivée',
                    '<pre><code>-- Moyenne de prix par catégorie en utilisant FROM\nSELECT t.categorie, t.prix_moyen\nFROM (SELECT categorie, AVG(prix) AS prix_moyen FROM produits GROUP BY categorie) t;</code></pre>',
                    '<pre>CATÉGORIE  PRIX_MOYEN\n------------  ----------\nÉlectronique     120.50\nHigh-Tech        89.99</pre>',
                    'Table dérivée calculant la moyenne, ensuite sélectionnée.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser une colonne de la requête externe dans une sous-requête non corrélée sans alias',
            'fix'    => 'Assurez-vous que la sous-requête est bien corrélée si elle doit référence la requête externe, ou qu\'elle est autonome sinon.',
            'fr'     => 'Si la sous-requête référence une colonne de la requête externe (ex: WHERE client_id = client_id externe), elle est corrélée et s\'exécutera pour chaque ligne de la requête externe. Dans le cas contraire, elle doit être autonome.',
            'darija' => 'Si sous-requête référence colonne requête externe, elle est corrélée s\'exécute pour chaque ligne. Sinon doit être autonome.'
        ],
        [
            'wrong'  => 'Oublier l\'alias sur une sous-requête dans FROM',
            'fix'    => 'Toujours attribuer un alias (ex: SELECT ... FROM (SELECT ...) t) à une sous-requête placée dans la clause FROM.',
            'fr'     => 'En Oracle, une sous-requête dans la clause FROM doit toujours porter un alias (t, subq, etc.) sans quoi Oracle provoquera une erreur ORA-00923: FROM keyword where expected.',
            'darija' => 'Sous-requête FROM doit toujours porter alias (t, subq, etc.) sans quoi Oracle erreur ORA-00923.'
        ],
    ],

    'summary' => [
        'fr'     => 'Sous-requête scalaire dans SELECT (valeur unique). Sous-requête WHERE pour filtrer. Sous-requête FROM comme table dérivée avec alias. Différencier corrélée (référence externe) et non corrélée (autonome).',
        'darija' => 'Sous-requête scalaire SELECT valeur unique. WHERE filtrer. FROM table dérivée avec alias. Corrélée référence externe non corrélée autonome.'
    ],
];