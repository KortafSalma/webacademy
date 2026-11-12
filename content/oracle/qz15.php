<?php
declare(strict_types=1);

/**
 * Quiz du chapitre oracle-ch20 — SELECT INTO et %TYPE / %ROWTYPE.
 * 10 questions : mcq, fill, true_false, find-error, predict.
 */

return [
    'title' => 'Quiz — SELECT INTO et %TYPE / %ROWTYPE',

    'questions' => [

        [
            'type'    => 'mcq',
            'question'=> 'La commande SELECT INTO permet de :',
            'options' => 'Filtrer des lignes', 'Stocker une valeur de table dans une variable', 'Créer une table', 'Supprimer des données'],
            'answer' => 1,
            'concept' => 'SELECT INTO',
            'explainFr' => 'SELECT INTO stocke une valeur de table dans une variable PL/SQL.',
            'explainDarija' => 'SELECT INTO stocke valeur table variable PL/SQL.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'Le mot-clé obligatoire après SELECT pour stocker le résultat dans une variable s\'appelle ________.',
            'expected' => 'INTO',
            'accept' => ['INTO', 'into'],
            'concept' => 'Clause INTO SELECT',
            'explainFr' => 'La clause INTO suivie du nom de la variable permet de stocker la valeur récupérée.',
            'explainDarija' => 'Clause INTO suivie nom variable stocker valeur récupérée.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Si la requête SELECT INTO retourne zéro ligne, Oracle lève l\'exception NO_DATA_FOUND.',
            'answer' => 1,
            'concept' => 'SELECT INTO NO_DATA_FOUND',
            'explainFr' => 'Vrai : En l\'absence de ligne, Oracle lève NO_DATA_FOUND qui doit être attrapée dans un bloc EXCEPTION.',
            'explainDarija' => 'Vrai Oracle lève NO_DATA_FOUND absence ligne doit attrapé EXCEPTION.',
        ],

        [
            'type'    => 'find-error',
            'question'=> 'Identifiez l\'erreur : DECLARE v_nom clients.nom%TYPE; BEGIN SELECT nom INTO v_nom FROM clients WHERE id = 1; END ;',
            'options' => 'Oubli INTO', 'Pas d\'erreur', 'Syntaxe incorrecte', 'Type de données incompatible'],
            'answer' => 0,
            'concept' => 'Oubli clause INTO',
            'explainFr' => 'Sans le mot-clé INTO, la valeur n\'est pas stockée dans la variable. C\'est l\'erreur la plus courante avec SELECT INTO.',
            'explainDarija' => 'Sans INTO valeur stockée variable erreur la plus courante SELECT INTO.',
        ],

        [
            'type'    => 'predict',
            'question'=> 'Que se passera-t-il si l\'on exécute SELECT COUNT(*) INTO v_total FROM clients WHERE id > 999 ;',
            'options' => 'v_total vaudra 0', 'Erreur NO_DATA_FOUND', 'Erreur TOO_MANY_ROWS', 'v_total vaudra 1',
            'answer' => 0,
            'concept' => 'SELECT INTO avec agrégat',
            'explainFr' => 'Comme COUNT(*) retourne toujours une ligne (même si le compte est 0), v_total vaudra 0 et aucune erreur ne sera levée.',
            'explainDarija' => 'COUNT toujours retourne ligne v_total vaudra 0 erreur levée.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes peut être utilisée dans SELECT INTO pour stocker une valeur agrégée ?',
            'options' => 'COUNT', 'SUM', 'AVG', 'Toutes les réponses ci-dessus',
            'answer' => 3,
            'concept' => 'Agrégat SELECT INTO',
            'explainFr' => 'Toutes les fonctions d\'agrégat (COUNT, SUM, AVG, MIN, MAX) peuvent être utilisées dans SELECT INTO.',
            'explainDarija' => 'Toutes les fonctions agrégat COUNT SUM AVG MIN MAX peuvent être utilisées SELECT INTO.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La méthode permettant de tester si une variable a été initialisée par SELECT INTO (ligne trouvée) s\'appelle ________.',
            'expected' => 'SQL%ROWCOUNT',
            'accept' => ['SQL%ROWCOUNT', 'sql%rowcount'],
            'concept' => 'Attributs SQL%ROWCOUNT SQL%FOUND',
            'explainFr' => 'SQL%ROWCOUNT retourne le nombre de lignes affectées par la dernière instruction SELECT INTO.',
            'explainDarija' => 'SQL%ROWCOUNT nombre lignes affectées dernière instruction SELECT INTO.',
        ],

        [
            'type'    => 'true_false',
            'question'=> 'Si SELECT INTO retourne plusieurs lignes, Oracle lève l\'exception TOO_MANY_ROWS.',
            'answer' => 1,
            'concept' => 'SELECT INTO TOO_MANY_ROWS',
            'explainFr' => 'Vrai : Si la requête retourne plus d\'une ligne, Oracle lève TOO_MANY_ROWS qui doit être attrapée.',
            'explainDarija' => 'Vrai Oracle lève TOO_MANY_ROWS plusieurs lignes doit attrapé.',
        ],

        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des suivantes stocke le nombre total de clients dans une variable ?',
            'options' => 'SELECT nombre INTO v_total FROM clients', 'SELECT COUNT(*) INTO v_total FROM clients', 'SELECT SUM INTO v_total FROM clients', 'SELECT AVG INTO v_total FROM clients',
            'answer' => 1,
            'concept' => 'SELECT INTO COUNT',
            'explainFr' => 'SELECT COUNT(*) INTO v_total stocke le nombre total de lignes dans v_total.',
            'explainDarija' => 'SELECT COUNT* stocke nombre total lignes v_total.',
        ],

        [
            'type'    => 'fill',
            'question'=> 'La clause qui permet de stocker le résultat d\'une requête dans une variable s\'appelle ________.',
            'expected' => 'INTO',
            'accept' => ['INTO', 'into'],
            'concept' => 'Clause INTO',
            'explainFr' => 'La clause INTO suit le SELECT et reçoit la valeur récupérée dans la variable spécifiée.',
            'explainDarija' => 'Clause INTO reçoit valeur récupérée variable spécifiée.',
        ],

    ],
];