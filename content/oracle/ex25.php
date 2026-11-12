<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch25 — Procédures et fonctions.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex25',
    'title' => 'Exercices — Procédures et fonctions',
    'brief' => 'Creation dobjets stockés : procédures et fonctions.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE PROCEDURE basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Ecrivez la creation d une procédure qui accepte un identifiant en entrée et affiche un message.</p>',
            'instructionsDarija' => '<p>Creation procedure accepte identifiant entrée affiche message.</p>',
            'starter' => 'CREATE OR REPLACE PROCEDURE proc_test (p_id IN NUMBER) IS BEGIN DBMS_OUTPUT.PUT_LINE Procédure appelée avec l identifiant : || p_id; END;',
            'hints' => [
                'Utilisez CREATE OR REPLACE PROCEDURE pour créer une procédure.',
                'Les paramètres en entrée s écrivent IN.',
            ],
            'solution' => 'CREATE OR REPLACE PROCEDURE proc_test (p_id IN NUMBER) IS BEGIN DBMS_OUTPUT.PUT_LINE Procédure appelée avec l identifiant : || p_id; END;',
            'explainFr' => 'La procédure proc_test accepte un paramètre en entrée p_id et affiche un message avec sa valeur.',
            'explainDarija' => 'Procédure proc_test accepte paramètre entrée p_id affiche message sa valeur.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — CREATE FUNCTION basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d une fonction qui additionne deux nombres et retourne le résultat.</p>',
            'instructionsDarija' => '<p>Création fonction additionne deux nombres retourne résultat.</p>',
            'starter' => 'CREATE OR REPLACE FUNCTION func_add (p_num1 NUMBER, p_num2 NUMBER) RETURN NUMBER IS BEGIN RETURN p_num1 + p_num2; END;',
            'hints' => [
                'La fonction doit avoir une clause RETURN spécifiant le type de retour.',
                'La valeur de retour est la somme des deux paramètres.',
            ],
            'solution' => 'CREATE OR REPLACE FUNCTION func_add (p_num1 NUMBER, p_num2 NUMBER) RETURN NUMBER IS BEGIN RETURN p_num1 + p_num2; END;',
            'explainFr' => 'La fonction func_add additionne p_num1 et p_num2 et retourne le résultat.',
            'explainDarija' => 'Fonction func_add additionne p_num1 p_num2 retourne résultat.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Procedure avec parametres',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une procédure qui augmente le salaire d un employé et retourne le nouveau salaire.</p>',
            'instructionsDarija' => '<p>Procedure augmente salaire employé retourne nouveau salaire.</p>',
            'starter' => 'CREATE OR REPLACE PROCEDURE augmenter_salaire (p_id NUMBER, p_augmentation NUMBER) IS v_nouveau_salaire NUMBER; BEGIN SELECT salaire INTO v_nouveau_salaire FROM employes WHERE id = p_id; v_nouveau_salaire := v_nouveau_salaire + p_augmentation; DBMS_OUTPUT.PUT_LINE Nouveau salaire : || v_nouveau_salaire; END;',
            'hints' => [
                'Utilisez SELECT ... INTO pour récupérer une valeur existante.',
                'Modifiez la valeur puis affichez le résultat.',
            ],
            'solution' => 'CREATE OR REPLACE PROCEDURE augmenter_salaire (p_id NUMBER, p_augmentation NUMBER) IS v_nouveau_salaire NUMBER; BEGIN SELECT salaire INTO v_nouveau_salaire FROM employes WHERE id = p_id; v_nouveau_salaire := v_nouveau_salaire + p_augmentation; DBMS_OUTPUT.PUT_LINE Nouveau salaire : || v_nouveau_salaire; END;',
            'explainFr' => 'La procédure augmente le salaire de lémpLOYÉ identifié par p_id et affiche le nouveau montant.',
            'explainDarija' => 'Procedure augment salaire employee identifié p_id affiche nouveau montant.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Fonction avec condition',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une fonction qui retourne le statut d un employé (actif ou inactif) en fonction de sa date de fin.</p>',
            'instructionsDarija' => '<p>Fonction retourne statut employé selon date de fin.</p>',
            'starter' => 'CREATE OR REPLACE FUNCTION get_employe_statut (p_id NUMBER) RETURN VARCHAR2 IS v_date_fin DATE; BEGIN SELECT date_fin INTO v_date_fin FROM employes WHERE id = p_id; IF v_date_fin IS NULL THEN RETURN Actif; ELSE RETURN Inactif; END IF; END;',
            'hints' => [
                'Utilisez SELECT ... INTO pour récupérer la date de fin.',
                'Vérifiez si la date est NULL pour déterminer le statut.',
            ],
            'solution' => 'CREATE OR REPLACE FUNCTION get_employe_statut (p_id NUMBER) RETURN VARCHAR2 IS v_date_fin DATE; BEGIN SELECT date_fin INTO v_date_fin FROM employes WHERE id = p_id; IF v_date_fin IS NULL THEN RETURN Actif; ELSE RETURN Inactif; END IF; END;',
            'explainFr' => 'La fonction vérifie la date de fin de lémpLOYÉ et retourne Actif si NULL, Inactif sinon.',
            'explainDarija' => 'Fonction vérifie date fin employee retourne Actif si NULL Inactif sinon.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Procédure avec curseur',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez une procédure qui affiche tous les employés utilisant un curseur.</p>',
            'instructionsDarija' => '<p>Procedure affiche tous employés curseur.</p>',
            'starter' => 'CREATE OR REPLACE PROCEDURE lister_employes IS CURSOR c_employes IS SELECT nom, salaire FROM employes; v_nom employes.nom%TYPE; v_salaire employes.salaire%TYPE; BEGIN OPEN c_employes; LOOP FETCH c_employes INTO v_nom, v_salaire; EXIT WHEN c_employes%NOTFOUND; DBMS_OUTPUT.PUT_LINE v_nom || salaire : || v_salaire; END LOOP; CLOSE c_employes; END;',
            'hints' => [
                'DECLARE un curseur avec SELECT.',
                'Utilisez OPEN, FETCH, EXIT WHEN %NOTFOUND, CLOSE.',
            ],
            'solution' => 'CREATE OR REPLACE PROCEDURE lister_employes IS CURSOR c_employes IS SELECT nom, salaire FROM employes; v_nom employes.nom%TYPE; v_salaire employes.salaire%TYPE; BEGIN OPEN c_employes; LOOP FETCH c_employes INTO v_nom, v_salaire; EXIT WHEN c_employes%NOTFOUND; DBMS_OUTPUT.PUT_LINE v_nom || salaire : || v_salaire; END LOOP; CLOSE c_employes; END;',
            'explainFr' => 'La procédure utilise un curseur pour parcourir tous les employés et afficher leur nom et salaire.',
            'explainDarija' => 'Procedure utilise curseur parcourir employees afficher nom salaire.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];