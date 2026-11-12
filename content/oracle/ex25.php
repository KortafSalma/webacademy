<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch25 — Procédures et fonctions.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex25',
    'title' => 'Exercices — Procédures et fonctions',
    'brief' => 'Création d\'objets stockés : procédures et fonctions.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE PROCEDURE basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d\'une procédure qui accepte un identifiant en entrée et affiche un message.</p>',
            'instructionsDarija' => '<p>Création procédure accepte identifiant entrée affiche message.</p>',
            'starter' => 'CREATE OR REPLACE PROCEDURE proc_test (p_id IN NUMBER) IS BEGIN DBMS_OUTPUT.PUT_LINE(\\'Procédure appelée avec l\\'identifiant : \\' || p_id); END;',
            'hints' => [
                'Utilisez CREATE OR REPLACE PROCEDURE pour créer une procédure.',
                'Les paramètres en entrée s\'écrivent IN.',
            ],
            'solution' => 'CREATE OR REPLACE PROCEDURE proc_test (p_id IN NUMBER) IS BEGIN DBMS_OUTPUT.PUT_LINE(\\'Procédure appelée avec l\\'identifiant : \\' || p_id); END;',
            'explainFr' => 'La procédure proc_test accepte un paramètre en entrée p_id et affiche un message avec sa valeur.',
            'explainDarija' => 'Procédure proc_test accepte paramètre entrée p_id affiche message sa valeur.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — Exécuter une procédure',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment exécute-t-on une procédure appelée proc_test avec l\'identifiant 5 en SQL*Plus ?</p>',
            'instructionsDarija' => '<p>Kay exécuter procédure proc_test identifiant 5 f SQL*Plus ?</p>',
            'starter' => 'EXECUTE proc_test(5)',
            'hints' => [
                'Utilisez le commande EXECUTE (ou EXEC) suivie du nom de la procédure et des paramètres.',
            ],
            'solution' => 'EXECUTE proc_test(5)',
            'explainFr' => 'La commande EXECUTE permet d\'exécuter une procédure stockée.',
            'explainDarija' => 'Commande EXECUTE exécuter procédure stockée.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — CREATE FUNCTION',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d\'une fonction qui accepte deux nombres et retourne leur produit.</p>',
            'instructionsDarija' => '<p>Création fonction accepte deux nombres retourne produit.</p>',
            'starter' => 'CREATE OR REPLACE FUNCTION func_produit (p_num1 NUMBER, p_num2 NUMBER) RETURN NUMBER IS BEGIN RETURN p_num1 * p_num2; END;',
            'hints' => [
                'Utilisez CREATE OR REPLACE FUNCTION pour créer une fonction.',
                'La clause RETURN NUMBER indique que la fonction retourne un nombre.',
                'Utilisez le mot-clé RETURN pour renvoyer la valeur de résultat.',
            ],
            'solution' => 'CREATE OR REPLACE FUNCTION func_produit (p_num1 NUMBER, p_num2 NUMBER) RETURN NUMBER IS BEGIN RETURN p_num1 * p_num2; END;',
            'explainFr' => 'La fonction func_produit accepte deux nombres et retourne leur produit.',
            'explainDarija' => 'Fonction func_produit accepte deux nombres retourne produit.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Utiliser une fonction en SQL',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment utilise-t-on la fonction func_produit dans une requête SELECT ?</p>',
            'instructionsDarija' => '<p>Kay utiliser fonction func_produit requête SELECT ?</p>',
            'starter' => 'SELECT nom, func_produit(prix, 0.15) AS remise FROM produits',
            'hints' => [
                'Une fonction stockée peut être utilisée comme une colonne calculée dans une requête SELECT.',
                'On préfixe le nom de la fonction par le nom du package si nécessaire, ou on l\'utilise directement si elle est création dans son propre schéma.',
            ],
            'solution' => 'SELECT nom, func_produit(prix, 0.15) AS remise FROM produits',
            'explainFr' => 'La fonction est appelée comme une colonne calculée : func_produit(prix, 0.15) calcule la remise à 15 %.',
            'explainDarija' => 'Fonction appelée colonne calculée func_produit(prix, 0.15) remise 15 %.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Paramètres IN OUT',
            'lang'  => 'oracle',
            'instructions' => '<p>Quel est le mode de paramètre qui permet de passer une valeur initiale et de la modifier à l\'intérieur de la procédure, en retournant la valeur modifiée ?</p>',
            'instructionsDarija' => '<p>Kay mode paramètre passer valeur initiale modifier intérieur procédure retournant valeur modifiée ?</p>',
            'starter' => 'IN OUT',
            'hints' => [
                'Le mode IN OUT passe une valeur initiale et la procédure peut la modifier.',
                'La valeur modifiée est retournée à l\'après-exécution.',
            ],
            'solution' => 'IN OUT',
            'explainFr' => 'Le mode IN OUT permet de passer une valeur initiale et de la modifier à l\'intérieur de la procédure.',
            'explainDarija' => 'Mode IN OUT passer valeur initiale modifier procédure retournant valeur modifiée.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];