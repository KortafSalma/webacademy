<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 25 : Procédures et fonctions
 * Création d'objets stockés : procédures exécutables et fonctions retournant une valeur.
 */

return [
    'id'       => 'oracle-ch25',
    'title'    => 'Procédures et fonctions',
    'subtitle' => 'Objets stockés : procédures et fonctions',

    'objectives' => [
        'Créer une procédure stockée avec CREATE PROCEDURE.',
        'Créer une fonction stockée avec CREATE FUNCTION.',
        'Comprendre la différence : procédure effectue des actions, fonction retourne une valeur.',
        'Utiliser des paramètres IN, OUT et IN OUT.',
        'Exécuter une procédure ou une fonction.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'creation-procedure',
            'title' => 'Créer une procédure',
            'icon'  => '⚙️',
            'blocks' => [

                make_definition_block(
                    'PROCEDURE',
                    '<p>Une <strong>procédure</strong> est un bloc de code nommé qui effectue une série d\'actions (INSERT, UPDATE, SELECT, logique métier). Elle s\'exécute avec l\'instruction EXECUTE (ou EXEC).</p>',
                    '<p><b>Procédure</b> bloc code nommé effectue actions (INSERT UPDATE SELECT logique métier). S\'exécute EXECUTE.</p>'
                ),

                make_example_block(
                    'Création d\'une procédure simple',
                    '<pre><code>\nCREATE OR REPLACE PROCEDURE maj_statut_commande (p_cmd_id IN NUMBER, p_nouveau_statut IN VARCHAR2)\nIS\nBEGIN\n  -- Mise à jour du statut de la commande\n  UPDATE commandes\n  SET statut = p_nouveau_statut\n  WHERE cmd_id = p_cmd_id;\n  \n  -- Message de confirmation\n  DBMS_OUTPUT.PUT_LINE(\\'Commande ' || p_cmd_id || \" mise à jour avec le statut \" || p_nouveau_statut);\nEND;\n/<code></pre>',
                    '<pre>Commande 1001 mise à jour avec le statut ENVOYÉ</pre>',
                ),

                make_example_block(
                    'Exécution d\'une procédure',
                    '<pre><code>\n-- En SQL*Plus ou SQL Developer\nEXECUTE maj_statut_commande(1001, \\'EXPÉDIÉ\\');</code></pre>',
                    '<pre>Commande 1001 mise à jour avec le statut EXPÉDIÉ</pre>',
                    'La procédure est exécutée avec les paramètres fournis.'
                ),

                make_tip_block(
                    'CREATE OR REPLACE',
                    '<p>Utilisez toujours <strong>CREATE OR REPLACE PROCEDURE</strong> pour mettre à jour une procédure existante sans avoir à la supprimer d\'abord (ce qui aurait supprimé ses autorisations et dépendances).</p>',
                    '<p>Toujours CREATE OR REPLACE PROCEDURE mettre à jour procédure existante sans supprimer premièrement.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'creation-function',
            'title' => 'Créer une fonction',
            'icon'  => '🔢',
            'blocks' => [

                make_definition_block(
                    'FUNCTION',
                    '<p>Une <strong>fonction</strong> est un bloc de code nommé qui retourne une seule valeur (scalaire). Elle s\'utilise dans une requête SQL comme une colonne calculée ou peut être appelée depuis une procédure.</p>',
                    '<p><b>Fonction</b> bloc code nommé retourne valeur scalaire. S\'utilise requête SQL colonne calculée ou procédure.</p>'
                ),

                make_example_block(
                    'Création d\'une fonction qui calcule une remise',
                    '<pre><code>\nCREATE OR REPLACE FUNCTION calculer_remise (p_prix NUMBER, p_taux NUMBER)\nRETURN NUMBER\nIS\nBEGIN\n  -- Calcul de la remise\n  RETURN p_prix * p_taux;\nEND;\n/<code></pre>',
                    '<pre>Function created.</pre>',
                    'La fonction accepte deux nombres et retourne leur produit (la remise).'
                ),

                make_example_block(
                    'Utilisation d\'une fonction en SQL',
                    '<pre><code>\n-- Dans une requête SELECT\nSELECT nom, prix, calculer_remise(prix, 0.15) AS montant_remise\nFROM produits;</code></pre>',
                    '<pre>NOM      PRIX   MONTANT_REMISE\n-------  -----  -------------\nT-shirt      50        7.5\nPantalon     80       12</pre>',
                    'La fonction est appelée comme une colonne calculée dans SELECT.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'parametres-procedure',
            'title' => 'Paramètres : IN, OUT et IN OUT',
            'icon'  => '📤',
            'blocks' => [

                make_definition_block(
                    'IN (paramètre d\'entrée)',
                    '<p>Le mode <strong>IN</strong> passe une valeur à la procédure. La procédure peut lire la valeur mais ne peut pas la modifier. C\'est le mode par défaut.</p>',
                    '<p><b>IN</b> passe valeur procédure. Peut lire mais pas modifier. Mode par défaut.</p>'
                ),

                make_definition_block(
                    'OUT (paramètre de sortie)',
                    '<p>Le mode <strong>OUT</strong> retourne une valeur à l\' appelant. La procédure initialise la variable à NULL et l\'après-exécution contient la résultat.</p>',
                    '<p><b>OUT</b> retourne valeur appelant. Initialisée NULL après-exécution contient résultat.</p>'
                ),

                make_definition_block(
                    'IN OUT (paramètre entrée/sortie)',
                    '<p>Le mode <strong>IN OUT</strong> passe une valeur initiale et la procédure peut la modifier. La valeur modifiée est retournée à l\'après-exécution.</p>',
                    '<p><b>IN OUT</b> passe valeur initiale procédure peut la modifier. Valeur modifiée retournée après-exécution.</p>'
                ),

                make_example_block(
                    'Procédure avec paramètres OUT',
                    '<pre><code>\nCREATE OR REPLACE PROCEDURE obtenir_solde (p_client_id IN NUMBER, p_solde OUT NUMBER)\nIS\nBEGIN\n  -- Récupérer le solde du client\n  SELECT solde\n  INTO p_solde\n  FROM clients\n  WHERE id = p_client_id;\nEND;\n/<code></pre>',
                    '<pre>Procedure created.</pre>',
                    'La procédure sélectionne le solde et le stocke dans le paramètre OUT p_solde.'
                ),

                make_example_block(
                    'Exécution avec paramètres OUT',
                    '<pre><code>\nDECLARE\n  v_solde NUMBER;\nBEGIN\n  -- Appel de la procédure, le résultat va dans v_solde\n  obtenir_solde(5, v_solde);\n  -- Afficher le résultat\n  DBMS_OUTPUT.PUT_LINE(\\'Solde client 5 :\' || v_solde);\nEND;</code></pre>',
                    '<pre>Solde client 5 : 1250.50</pre>',
                    'Après exécution, v_solde contient la valeur récupérée par la procédure.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le mode du paramètre (IN par défaut)',
            'fix'    => 'Rappelez que si vous ne spécifiez pas de mode, par défaut le paramètre est IN. Si vous voulez retourner une valeur, utilisez OUT ou IN OUT.',
            'fr'     => 'En l'absence de mode explicite, Oracle considère le paramètre comme IN. Oublier de spécifier OUT peut entraîner des erreurs lors de l\'attente d\'une valeur de retour.',
            'darija' => 'Absence mode explicite Oracle considère paramètre IN. Oublier OUT erreurs retour valeur.'
        ],
        [
            'wrong'  => 'Essayer de modifier un paramètre IN à l\'intérieur de la procédure',
            'fix'    => 'Rappelez que les paramètres IN ne peuvent pas être modifiés. Utilisez OUT ou IN OUT si vous avez besoin de modifier la valeur.',
            'fr'     => 'Tout tentative de modification d\'un paramètre IN à l\'intérieur du corps de la procédure provoquera une erreur à l\'exécution. Utilisez OUT ou IN OUT pour les valeurs modifiables.',
            'darija' => 'Modification paramètre IN execution erreur. Utilisez OUT IN OUT valeurs modifiables.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les procédures effectuent des actions (INSERT, UPDATE, logique), les fonctions retournent une valeur scalaire. Les paramètres peuvent être IN (entrée), OUT (sortie) ou IN OUT (entrée/sortie). Utilisez CREATE OR REPLACE pour mettre à jour.',
        'darija' => 'Procedures effectuent actions INSERT UPDATE logique, fonctions retournent valeur scalaire. Paramètres IN OUT entrée/sortie. CREATE OR REPLACE mettre à jour.'
    ],
];