<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch20 — SELECT INTO et %TYPE / %ROWTYPE.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex20',
    'title' => 'Exercices — SELECT INTO et %TYPE / %ROWTYPE',
    'brief' => 'Récupérer des valeurs de table dans des variables PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'SELECT INTO simple',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez le nom du client ID = 1 et stockez-le dans une variable.</p>',
            'instructionsDarija' => '<p>Sélectionner nom client ID = 1 stocker variable.</p>',
            'starter' => "DECLARE v_nom clients.nom%TYPE; BEGIN SELECT nom INTO v_nom FROM clients WHERE id = 1; END;",
            'hints' => [
                'Utilisez SELECT ... INTO pour stocker une valeur de table dans une variable.',
                'La clause INTO suivie du nom de la variable.',
                'Assurez-vous que la requête ne retourne qu\'une seule ligne.',
            ],
            'solution' => "DECLARE v_nom clients.nom%TYPE; BEGIN SELECT nom INTO v_nom FROM clients WHERE id = 1; END;",
            'explainFr' => 'La valeur de la colonne nom est stockée dans la variable v_nom via SELECT ... INTO.',
            'explainDarija' => 'Valeur colonne nom stockée variable v_nom SELECT INTO.',
        ],

        [
            'level' => 2,
            'title' => 'SELECT INTO deux variables',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez le nom et l\'email du client ID = 2 et stockez-les dans deux variables.</p>',
            'instructionsDarija' => '<p>Sélectionner nom email client ID 2 deux variables.</p>',
            'starter' => "DECLARE v_nom clients.nom%TYPE; v_email clients.email%TYPE; BEGIN SELECT nom, email INTO v_nom, v_email FROM clients WHERE id = 2; END;",
            'hints' => [
                'Plusieurs variables peuvent être utilisées après INTO, séparées par des virgules.',
                'Le nombre de variables doit correspondre au nombre de colonnes sélectionnées.',
            ],
            'solution' => "DECLARE v_nom clients.nom%TYPE; v_email clients.email%TYPE; BEGIN SELECT nom, email INTO v_nom, v_email FROM clients WHERE id = 2; END;",
            'explainFr' => 'Deux valeurs sont récupérées simultanément dans deux variables distinctes.',
            'explainDarija' => 'Deux valeurs récupérées simultanément deux variables distinctes.',
        ],

        [
            'level' => 3,
            'title' => 'SELECT INTO avec agrégat',
            'lang'  => 'oracle',
            'instructions' => '<p>Sélectionnez le nombre total de clients et stockez-le dans une variable.</p>',
            'instructionsDarija' => '<p>Sélectionner nombre total clients stocker variable.</p>',
            'starter' => "DECLARE v_total NUMBER; BEGIN SELECT COUNT(*) INTO v_total FROM clients; END;",
            'hints' => [
                'Les fonctions d\'agrégat comme COUNT peuvent être utilisées dans SELECT INTO.',
                'La requête doit retourner une seule ligne (ce qui est le cas pour COUNT).',
            ],
            'solution' => "DECLARE v_total NUMBER; BEGIN SELECT COUNT(*) INTO v_total FROM clients; END;",
            'explainFr' => 'Le nombre total de clients est stocké dans la variable v_total via COUNT(*) dans SELECT INTO.',
            'explainDarija' => 'Nombre total clients stocké variable v_total COUNT* SELECT INTO.',
        ],

        [
            'level' => 4,
            'title' => 'Gérer NO_DATA_FOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Que se passe-t-il si SELECT INTO ne retourne aucune ligne ? Comment peut-on le gérer ?</p>',
            'instructionsDarija' => '<p>Kay SELECT INTO retourne aucune ligne kay gérer ?</p>',
            'starter' => "BEGIN ... EXCEPTION WHEN NO_DATA_FOUND THEN DBMS_OUTPUT.PUT_LINE('Aucun client trouvé.'); END;",
            'hints' => [
                'Si aucune ligne n\'est trouvée, Oracle lève l\'exception NO_DATA_FOUND.',
                'Elle doit être attrapée dans un bloc EXCEPTION.',
            ],
            'solution' => "BEGIN ... EXCEPTION WHEN NO_DATA_found THEN DBMS_OUTPUT.PUT_LINE('Aucun client trouvé.'); END;",
            'explainFr' => 'Le bloc EXCEPTION WHEN NO_DATA_FOUND permet de gérer le cas où la requête ne retourne aucune ligne.',
            'explainDarija' => 'Exception NO_DATA_FOUND gestion cas aucune ligne trouvée.',
        ],

        [
            'level' => 5,
            'title' => 'Gérer TOO_MANY_ROWS',
            'lang'  => 'oracle',
            'instructions' => '<p>Que se passe-t-il si SELECT INTO retourne plusieurs lignes ? Comment peut-on le gérer ?</p>',
            'instructionsDarija' => '<p>Kay SELECT INTO retourne plusieurs lignes kay gérer ?</p>',
            'starter' => "BEGIN ... EXCEPTION WHEN TOO_MANY_ROWS THEN DBMS_OUTPUT.PUT_LINE('Erreur : trop de lignes.'); END;",
            'hints' => [
                'Si la requête retourne plusieurs lignes, Oracle lève l\'exception TOO_MANY_ROWS.',
                'Elle doit être attrapée dans un bloc EXCEPTION.',
            ],
            'solution' => "BEGIN ... EXCEPTION WHEN TOO_MANY_ROWS THEN DBMS_OUTPUT.PUT_LINE('Erreur : trop de lignes.'); END;",
            'explainFr' => 'Le bloc EXCEPTION WHEN TOO_MANY_ROWS permet de gérer le cas où la requête retourne plusieurs lignes.',
            'explainDarija' => 'Exception TOO_MANY_ROWS gestion cas plusieurs lignes.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];