<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch18 — Introduction au PL/SQL et blocs anonymes.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex18',
    'title' => 'Exercices — Introduction au PL/SQL et blocs anonymes',
    'brief' => 'Premier pas en programmation procédurale Oracle.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — Bloc anonyme basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc PL/SQL anonyme qui affiche "Bonjour Oracle !" en utilisant DBMS_OUTPUT.PUT_LINE.</p>',
            'instructionsDarija' => '<p>Écrivez bloc PL/SQL anonyme affiche "Bonjour Oracle !" DBMS_OUTPUT.PUT_LINE.</p>',
            'starter' => 'BEGIN DBMS_OUTPUT.PUT_LINE Bonjour Oracle !; END;',
            'hints' => [
                'N oubliez pas dexécuter SET SERVEROUTPUT ON avant le bloc.',
                'La structure est : DECLARE ... BEGIN ... END.; pour un bloc anonyme sans DECLARE, cest juste BEGIN ... END.;',
            ],
            'solution' => 'BEGIN DBMS_OUTPUT.PUT_LINE Bonjour Oracle !; END;',
            'explainFr' => 'Un bloc anonyme sans section DECLARE commence par BEGIN et se termine par END.; DBMS_OUTPUT.PUT_LINE affiche le message.',
            'explainDarija' => 'Bloc anonyme sans section DECLARE BEGIN END.; DBMS_OUTPUT.PUT_LINE affiche message.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — SET SERVEROUTPUT ON',
            'lang'  => 'oracle',
            'instructions' => '<p>Quelle commande SQL*Plus doit-on exécuter avant un bloc PL/SQL pour voir la sortie ?</p>',
            'instructionsDarija' => '<p>Kay commande SQL*Plus avant bloc PL/SQL voir sortie ?</p>',
            'starter' => 'SET SERVEROUTPUT ON',
            'hints' => [
                'Sans cette commande, DBMS_OUTPUT.PUT_LINE reste invisible.',
                'Elle doit être exécutée une seule fois au début du script.',
            ],
            'solution' => 'SET SERVEROUTPUT ON',
            'explainFr' => 'La commande SET SERVEROUTPUT ON active laffichage de la sortie standard en SQL*Plus.',
            'explainDarija' => 'SET SERVEROUTPUT ON active affichage sortie standard SQL*Plus.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Variables et DBMS_OUTPUT',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc qui déclare une variable v_nom et affiche "Client : " || v_nom.</p>',
            'instructionsDarija' => '<p>Écrivez bloc déclare variable v_nom affiche "Client : " || v_nom.</p>',
            'starter' => 'DECLARE v_nom VARCHAR2(50) := Mohamed; BEGIN DBMS_OUTPUT.PUT_LINE Client : || v_nom; END;',
            'hints' => [
                'Déclarez la variable dans la section DECLARE (pour les blocs avec DECLARE) ou juste avant BEGIN.',
                'Utilisez := pour initialiser la variable.',
            ],
            'solution' => 'DECLARE v_nom VARCHAR2(50) := Mohamed; BEGIN DBMS_OUTPUT.PUT_LINE Client : || v_nom; END;',
            'explainFr' => 'La variable v_nom est déclarée et initialisée, puis affichée via DBMS_OUTPUT.PUT_LINE.',
            'explainDarija' => 'Variable v_nom déclarée initialisée affichée DBMS_OUTPUT.PUT_LINE.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Calcul et affichage',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc qui calcule la somme de 10 + 20 et affiche le résultat.</p>',
            'instructionsDarija' => '<p>Écrivez bloc calcule 10 + 20 affiche résultat.</p>',
            'starter' => 'DECLARE v_somme NUMBER := 10 + 20; BEGIN DBMS_OUTPUT.PUT_LINE Somme : || v_somme; END;',
            'hints' => [
                'Vous pouvez effectuer des calculs directement dans la déclaration ou la section BEGIN.',
                'DBMS_OUTPUT.PUT_LINE affiche le résultat.',
            ],
            'solution' => 'DECLARE v_somme NUMBER := 10 + 20; BEGIN DBMS_OUTPUT.PUT_LINE Somme : || v_somme; END;',
            'explainFr' => 'Le calcul s effectue dans la section DECLARE ou BEGIN, et le résultat s affiche.',
            'explainDarija' => 'Calcul effectue section DECLARE BEGIN affichage DBMS_OUTPUT.PUT_LINE.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Structure complète',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez un bloc PL/SQL complet avec déclaration de variable, calcul et affichage.</p>',
            'instructionsDarija' => '<p>Écrivez bloc PL/SQL complet déclaration variable calcul affichage.</p>',
            'starter' => 'DECLARE v_age NUMBER := 30; BEGIN DBMS_OUTPUT.PUT_LINE Age : || v_age; END;',
            'hints' => [
                'Structure complète : DECLARE (variables), BEGIN (code exécutable), optionnellement EXCEPTION.',
                'Terminez toujours par END;',
            ],
            'solution' => 'DECLARE v_age NUMBER := 30; BEGIN DBMS_OUTPUT.PUT_LINE Age : || v_age; END;',
            'explainFr' => 'Le bloc comprend une partie déclaration avec une variable age, et une partie exécutable qui laffiche.',
            'explainDarija' => 'Structure complète déclaration variable âge affichage.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];