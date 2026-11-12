<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch26 — Packages.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex26',
    'title' => 'Exercices — Packages',
    'brief' => 'Regroupement d\'objets stockés en un seul objet optimisable.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — CREATE PACKAGE basique',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez la création d\'un package simple avec une procédure publique.</p>',
            'instructionsDarija' => '<p>Création package simple procédure publique.</p>',
            'starter' => 'CREATE OR REPLACE PACKAGE pak_test IS PROCEDURE proc_hello; END pak_test;',
            'hints' => [
                'Un package se compose de deux parties : la specification (interface) et le body (implémentation).',
                'La specification déclare les procédures, fonctions visibles.',
            ],
            'solution' => 'CREATE OR REPLACE PACKAGE pak_test IS PROCEDURE proc_hello; END pak_test;',
            'explainFr' => 'La specification du package pak_test déclare une procédure publique proc_hello.',
            'explainDarija' => 'Specification package pak_test declare procédure publique proc_hello.',
        ],

        [
            'level' => 2,
            'title' => 'Débutant — CREATE PACKAGE BODY',
            'lang'  => 'oracle',
            'instructions' => '<p>Écrivez le body du package pak_test qui implémente la procédure proc_hello.</p>',
            'instructionsDarija' => '<p>Body package pak_test implémente procédure proc_hello.</p>',
            'starter' => 'CREATE OR REPLACE PACKAGE BODY pak_test IS PROCEDURE proc_hello IS BEGIN DBMS_OUTPUT.PUT_LINE(\'Bonjour depuis le package !\'); END; END pak_test;',
            'hints' => [
                'Le body contient le code réel implémentant chaque procédure déclarée dans la specification.',
                'Les variables déclarées dans le body sont privées et inaccessibles depuis l\'outside.',
            ],
            'solution' => 'CREATE OR REPLACE PACKAGE BODY pak_test IS PROCEDURE proc_hello IS BEGIN DBMS_OUTPUT.PUT_LINE(\'Bonjour depuis le package !\'); END; END pak_test;',
            'explainFr' => 'Le body implémente la procédure proc_hello qui affiche un message.',
            'explainDarija' => 'Body implémente procédure proc_hello affiche message.',
        ],

        [
            'level' => 3,
            'title' => 'Intermédiaire — Variable globale',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment déclarer une variable globale accessible de toutes les procédures du package ?</p>',
            'instructionsDarija' => '<p>Kay variable globale accessible toutes procédures package ?</p>',
            'starter' => 'v_compteur NUMBER := 0; -- Dans la specification',
            'hints' => [
                'Les variables globales doivent être déclarées dans la specification du package.',
                'Elles sont accessibles de toutes les procédures et fonctions du package.',
            ],
            'solution' => 'v_compteur NUMBER := 0; -- Dans la specification (en tête de package)',
            'explainFr' => 'La variable v_compteur déclarée dans la specification est globale et partagée par toutes les procédures du package.',
            'explainDarija' => 'Variable globale déclarée specification accessible toutes procédures fonctions package.',
        ],

        [
            'level' => 4,
            'title' => 'Intermédiaire — Appeler procédure depuis package',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment appelle-t-on la procédure proc_hello depuis le package pak_test ?</p>',
            'instructionsDarija' => '<p>Kay appeler procédure proc_hello depuis package pak_test ?</p>',
            'starter' => 'EXECUTE pak_test.proc_hello',
            'hints' => [
                'On qualifie la procédure du nom du package : nom_paqued.procédure.',
                'Ou simplement EXECUTE proc_hello si on est dans le contexte du package.',
            ],
            'solution' => 'EXECUTE pak_test.proc_hello',
            'explainFr' => 'On exécute la procédure en utilisant le préfixe du package : pak_test.proc_hello.',
            'explainDarija' => 'Exécuter procédure qualifiée nom_package proc_hello.',
        ],

        [
            'level' => 5,
            'title' => 'Avancé — Fonction dans SELECT',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment utiliser une fonction publique d\'un package dans une requête SELECT ?</p>',
            'instructionsDarija' => '<p>Kay fonction publique package requête SELECT ?</p>',
            'starter' => 'SELECT pak_test.func_compte() FROM dual',
            'hints' => [
                'On qualifie la fonction du nom du package dans la requête SELECT.',
                'La fonction doit être déclarée dans la specification du package.',
            ],
            'solution' => 'SELECT pak_test.func_compte() FROM dual',
            'explainFr' => 'La fonction est appelée qualifiée du nom du package : pak_test.func_compte().',
            'explainDarija' => 'Fonction qualifiée nom_package func_compte() requête SELECT.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];