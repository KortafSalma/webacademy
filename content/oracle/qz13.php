<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch18 — Introduction à PL/SQL et blocs anonymes.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — Introduction à PL/SQL et blocs anonymes',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'PL/SQL signifie :',
            'options' => 'Programming Language/SQL', 'Procedural Language/SQL', 'Performance Language/SQL', 'Power Language/SQL'],
            'answer' => 1,
            'concept' => 'Définition PL/SQL',
            'explainFr' => 'PL/SQL signifie Procedural Language/SQL.',
            'explainDarija' => 'PL/SQL signifie Procedural Language/SQL.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La procédure qui écrit dans la sortie standard s\'appelle ________.',
            'expected' => 'DBMS_OUTPUT.PUT_LINE',
            'accept' => ['DBMS_OUTPUT.PUT_LINE', 'dbms_output.put_line'],
            'concept' => 'DBMS_OUTPUT.PUT_LINE',
            'explainFr' => 'DBMS_OUTPUT.PUT_LINE écrit un texte dans la sortie standard.',
            'explainDarija' => 'DBMS_OUTPUT.PUT_LINE écrit texte sortie standard.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'En SQL*Plus, la sortie DBMS_OUTPUT.PUT_LINE() apparaît par défaut sans commande supplémentaire.',
            'answer' => 0,
            'concept' => 'SET SERVEROUTPUT ON',
            'explainFr' => 'Faux : La commande SET SERVEROUTPUT ON doit être exécutée avant pour voir la sortie.',
            'explainDarija' => 'Faux : SET SERVEROUTPUT ON doit être exécutée avant voir sortie.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : BEGIN DBMS_OUTPUT.PUT_LINE(\\'Test\\'); END ; (sans SET SERVEROUTPUT ON)',
            'options' => 'Erreur de syntaxe', 'Aucune erreur visible', 'La sortie n\'apparaitra pas', 'Exception levée'],
            'answer' => 2,
            'concept' => 'SET SERVEROUTPUT ON',
            'explainFr' => 'Sans SET SERVEROUTPUT ON, DBMS_OUTPUT.PUT_LINE() ne s\'affiche pas en SQL*Plus. C\'est une erreur fréquente des débutants.',
            'explainDarija' => 'Sans SET SERVEROUTPUT ON DBMS_OUTPUT.PUT_LINE() neapparaitra pas SQL*Plus erreur fréquent debutant.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que affichera la commande : SET SERVEROUTPUT ON ; BEGIN DBMS_OUTPUT.PUT_LINE(\\'Bonjour\\'); END ;',
            'options' => 'Bonjour s\'affiche', 'Rien ne s\'affiche', 'Erreur Oracle', 'Commande invalide',
            'answer' => 0,
            'concept' => 'SET SERVEROUTPUT ON + DBMS_OUTPUT',
            'explainFr' => 'La commande SET SERVEROUTPUT ON active l\'affichage. La PL/SQL block affichera "Bonjour".',
            'explainDarija' => 'SET SERVEROUTPUT ON active affichage PL/SQL block affich "Bonjour".',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'La section qui contient le code exécutable dans un bloc PL/SQL s\'appelle :',
            'options' => 'DECLARE', 'BEGIN...END', 'EXCEPTION', 'PACKAGE',
            'answer' => 1,
            'concept' => 'Structure bloc PL/SQL',
            'explainFr' => 'La section BEGIN...END contient le code exécutable.',
            'explainDarija' => 'Section BEGIN...END contient code exécutable.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La section optionnelle qui contient les déclarations de variables s\'appelle ________.',
            'expected' => 'DECLARE',
            'accept' => ['DECLARE', 'declare'],
            'concept' => 'Structure bloc PL/SQL DECLARE',
            'explainFr' => 'La section DECLARE est optionnelle et sert à déclarer des variables, constantes, curseurs ou exceptions.',
            'explainDarija' => 'Section DECLARE optionnelle déclarer variables constantes curseurs exceptions.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Un bloc PL/SQL anonyme sans section DECLARE commence par BEGIN et se termine par END.;',
            'answer' => 1,
            'concept' => 'Structure bloc PL/SQL',
            'explainFr' => 'Vrai : Dans un bloc anonyme sans DECLARE, la structure est simplement BEGIN ... END.;',
            'explainDarija' => 'Vrai : Bloc anonyme sans DECLARE structure BEGIN END.;',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes n\'est pas une partie d\'un bloc PL/SQL anonyme ?',
            'options' => 'DECLARE', 'BEGIN...END', 'EXCEPTION', 'CREATE TABLE',
            'answer' => 3,
            'concept' => 'Structure bloc PL/SQL',
            'explainFr' => 'CREATE TABLE est une commande SQL, pas une partie d\'un bloc PL/SQL anonyme.',
            'explainDarija' => 'CREATE TABLE commande SQL pas partie bloc PL/SQL anonyme.',
        ],

    ],
];