<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch24 �?" Exceptions et gestion des erreurs.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex24',
    'title' => 'Exercices — Exceptions et gestion des erreurs',
    'brief' => 'Apprenez � attraper et traiter les erreurs en PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => 'Initieur — Attraper NO_DATA_FOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Que se passe-t-il si SELECT INTO ne trouve aucune ligne ? Écrivez un bloc BEGIN...EXCEPTION WHEN NO_DATA_FOUND THEN ... END.</p>',
            'instructionsDarija' => '<p>SELECT INTO aucune ligne kay ? Bloc BEGIN EXCEPTION WHEN NO_DATA_FOUND THEN ... END.</p>',
            'starter' => 'IF SQL%NOTFOUND THEN ... END IF',
            'hints' => [
                'SQL%NOTFOUND est VRAI si la derni�re instruction n�a affect� aucune ligne.',
                'Utilisez-le pour tester le r�sultat de SELECT INTO.',
            ],
            'solution' => 'IF SQL%NOTFOUND THEN ... END IF',
            'explainFr' => 'SQL%NOTFOUND est VRAI si la derni�re instruction (SELECT INTO par exemple) n�a affect� aucune ligne.',
            'explainDarija' => 'SQL%NOTFOUND VRAI derni�re instruction affect� aucune ligne.',
        ],

        [
            'level' => 2,
            'title' => 'Initieur — Gestion de TOO_MANY_ROWS',
            'lang'  => 'oracle',
            'instructions' => '<p>Que se passe-t-il si SELECT INTO retourne plus dune ligne ? Utilisez l\'exception TOO_MANY_ROWS.</p>',
            'instructionsDarija' => '<p>SELECT INTO plus dune ligne kay ? exception TOO_MANY_ROWS.</p>',
            'starter' => 'WHEN TOO_MANY_ROWS THEN ... END',
            'hints' => [
                'TOO_MANY_ROWS � lev� quand une SELECT INTO en renvoie plus dune.',
                'Utilisez COUNT() au lieu de SELECT INTO pour �viter cette erreur.',
            ],
            'solution' => 'WHEN TOO_MANY_ROWS THEN ... END',
            'explainFr' => 'TOO_MANY_ROWS � lev� quand une SELECT INTO en renvoie plus dune seule. Utilisez COUNT() pour �viter ce cas.',
            'explainDarija' => 'TOO_MANY_ROWS kay SELECT INTO more one row return. COUNT() utiliser avoid this error.',
        ],

        [
            'level' => 3,
            'title' => 'Interm�diaire — Exception personnalis�e avec RAISE',
            'lang'  => 'oracle',
            'instructions' => '<p>D�clarez une exception personnalis�e e_solde_negatif et levez-la quand le solde est n�gatif.</p>',
            'instructionsDarija' => '<p>Exception personnalisee e_solde_negatif declaration lev� solde n�gatif.</p>',
            'starter' => 'DECLARE e_solde_negatif EXCEPTION; IF v_solde < 0 THEN RAISE e_solde_negatif; END IF; EXCEPTION WHEN e_solde_negatif THEN ... END;',
            'hints' => [
                'Les exceptions personnalis�es doivent �tre d�clar�es dans la section DECLARE.',
                'Utilisez RAISE pour les lever manuellement.',
            ],
            'solution' => 'DECLARE e_solde_negatif EXCEPTION; IF v_solde < 0 THEN RAISE e_solde_negatif; END IF; EXCEPTION WHEN e_solde_negatif THEN DBMS_OUTPUT.PUT_LINE(\'Erreur : solde n�gatif.\'); END;',
            'explainFr' => 'Lexception personnalis�e e_solde_negatif est lev�e quand le solde est n�gatif et attrap�e pour afficher un message clair.',
            'explainDarija' => 'Exception personalized e_solde_negatif kay solde negative leve message clair affiche.',
        ],

        [
            'level' => 4,
            'title' => 'Interm�diaire — Utiliser SQLERRM et SQLCODE',
            'lang'  => 'oracle',
            'instructions' => '<p>Capturez toute erreur avec WHEN OTHERS et affichez SQLERRM.</p>',
            'instructionsDarija' => '<p>WHEN OTHERS SQLERRM affichage.</p>',
            'starter' => 'WHEN OTHERS THEN DBMS_OUTPUT.PUT_LINE(SQLERRM); END',
            'hints' => [
                'WHEN OTHERS capture toutes les exceptions non pr�c�demment attrap�es.',
                'SQLERRM contient le message texte de l�erreur.',
            ],
            'solution' => 'WHEN OTHERS THEN DBMS_OUTPUT.PUT_LINE(SQLERRM); END',
            'explainFr' => 'WHEN OTHERS capture toute erreur non pr�c�dement attrap�e. SQLERRM affiche le message d�taill�.',
            'explainDarija' => 'WHEN OTHERS capture exceptions non attrap�es SQLERRM message texte erreur.',
        ],

        [
            'level' => 5,
            'title' => 'Avanc� — Requ�te dynamique avec EXECUTE IMMEDIATE et erreur',
            'lang'  => 'oracle',
            'instructions' => '<p>Utilisez EXECUTE IMMEDIATE pour une requ�te dynamique et attrapez les erreurs avec WHEN OTHERS.</p>',
            'instructionsDarija' => '<p>EXECUTE IMMEDIATE dynamique requete WHEN OTHERS erreur.</p>',
            'starter' => 'DECLARE v_sql VARCHAR2(100) := \'SELECT COUNT(*) INTO v_compte FROM clients WHERE id = 1\'; EXECUTE IMMEDIATE v_sql; EXCEPTION WHEN OTHERS THEN DBMS_OUTPUT.PUT_LINE(SQLERRM); END;',
            'hints' => [
                'EXECUTE IMMEDIATE execute une requ�te stock�e dans une cha�ne.',
                'Lorsque la requ�te dynamique �choue, WHEN OTHERS capture l�erreur.',
            ],
            'solution' => 'DECLARE v_sql VARCHAR2(100) := \'SELECT COUNT(*) FROM clients WHERE id = 1\'; BEGIN EXECUTE IMMEDIATE v_sql INTO v_compte; EXCEPTION WHEN OTHERS THEN DBMS_OUTPUT.PUT_LINE(SQLERRM); END;',
            'explainFr' => 'EXECUTE IMMEDIATE permet d�ex�cuter une requ�te dynamiq�e. WHEN OTHERS capture toute erreur non g�r�e zuvorvement.',
            'explainDarija' => 'EXECUTE IMMEDIATE dynamique requete kay WHEN OTHERS capture erreur non g�r�e zuvorvement.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];