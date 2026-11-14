<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 24 : Exceptions et gestion des erreurs
 * Gestion des exceptions en PL/SQL pour attraper et traiter les erreurs éxécutées.
 */

return [
    'id'       => 'oracle-ch24',
    'title'    => 'Exceptions et gestion des erreurs',
    'subtitle' => 'Traitement des erreurs exécution',

    'objectives' => [
        'Déclarer des exceptions nommées ou invisibles dans la section DECLARE.',
        'Utiliser la structure BEGIN...EXCEPTION...END pour attraper les erreurs.',
        'Utiliser l\'attribut SQL%ROWCOUNT et SQLCODE pour obtenir des détails sur l\'erreur.',
        'Relancer une exception après traitement (RAISE).',
        'Comprendre les exceptions prédéfinies (NO_DATA_FOUND, TOO_MANY_ROWS).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'exceptions-basees',
            'title' => 'Exceptions prédéfinies',
            'icon'  => '⚠️',
            'blocks' => [

                make_definition_block(
                    'NO_DATA_FOUND',
                    '<p>L\'exception <strong>NO_DATA_FOUND</strong> est levée automatiquement quand une instruction SELECT INTO ne retourne aucune ligne.</p>',
                    '<p><b>NO_DATA_FOUND</b> levée automatiquement SELECT INTO aucune ligne.</p>'
                ),

                make_definition_block(
                    'TOO_MANY_ROWS',
                    '<p>L\'exception <strong>TOO_MANY_ROWS</strong> est levée quand une instruction SELECT INTO en retourne plus d\'une seule.</p>',
                    '<p><b>TOO_MANY_ROWS</b> levée SELECT INTO plus d\'une ligne.</p>'
                ),

                make_example_block(
                    'Gestion de NO_DATA_FOUND',
                    '<pre><code>\nDECLARE\n  v_nom clients.nom%TYPE;\nBEGIN\n  SELECT nom\n  INTO v_nom\n  FROM clients\n  WHERE id = 999;  -- ID inexistant\n  DBMS_OUTPUT.PUT_LINE(\'Client :\' || v_nom);\nEXCEPTION\n  WHEN NO_DATA_FOUND THEN\n    DBMS_OUTPUT.PUT_LINE(\'Aucun client trouvé avec cet ID.\');\nEND;</code></pre>',
                    '<pre>Aucun client trouvé avec cet ID.</pre>',
                    'L\'exception est attrapée et un message amical s\'affiche au lieu d\'erreur Oracle.'
                ),

                make_example_block(
                    'Gestion de TOO_MANY_ROWS',
                    '<pre><code>\nDECLARE\n  v_compte NUMBER;\nBEGIN\n  SELECT COUNT(*)\n  INTO v_compte\n  FROM clients;  -- Retourne 1 ligne seulement, pas d\'erreur\n  DBMS_OUTPUT.PUT_LINE(\'Nombre clients :\' || v_compte);\nEXCEPTION\n  WHEN TOO_MANY_ROWS THEN\n    DBMS_OUTPUT.PUT_LINE(\'Erreur : trop de lignes renvoyées.\');\nEND;</code></pre>',
                    '<pre>Nombre clients : 25</pre>',
                    'Dans ce cas spécifique, COUNT(*) ne provoque pas d\'erreur car il retourne toujours une ligne.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'exception-personnalisee',
            'title' => 'Exceptions personnalisées avec RAISE',
            'icon'  => '🚨',
            'blocks' => [

                make_definition_block(
                    'RAISE',
                    '<p>La commande <strong>RAISE</strong> permet de lever manuellement une exception (prédéfinie ou déclarée sur mesure). On peut aussi lever une exception déclarée par son nom.</p>',
                    '<p><b>RAISE</b> lève manuellement exception prédéfinie ou déclarée par nom.</p>'
                ),

                make_example_block(
                    'Lever une exception personnalisée',
                    '<pre><code>\nDECLARE\n  -- Déclaration d\'une exception personnalisée\n  e_solde_négatif EXCEPTION;\n  v_solde NUMBER := -100;\nBEGIN\n  IF v_solde < 0 THEN\n    -- Lever l\'exception avec un message personnalisé\n    RAISE e_solde_négatif;\n  END IF;\nEXCEPTION\n  WHEN e_solde_négatif THEN\n    DBMS_OUTPUT.PUT_LINE(\'Erreur : Le solde ne peut pas être négatif.\');\nEND;</code></pre>',
                    '<pre>Erreur : Le solde ne peut pas être négatif.</pre>',
                    'L\'exception personnalisée est levée et attrapée avec un message clair.'
                ),

                make_example_block(
                    'RAISE avec SQLERRM',
                    '<pre><code>\nDECLARE\n  v_erreur NUMBER;\nBEGIN\n  -- Simulation d\'une erreur quelconque\n  BEGIN\n    -- Code qui peut échouer\n  END;\n  EXCEPTION\n    WHEN OTHERS THEN\n      v_erreur := SQLCODE;\n      DBMS_OUTPUT.PUT_LINE(\'Erreur n°\' || v_erreur || \' :\' || SQLERRM);\nEND;</code></pre>',
                    '<pre>Erreur n°-1 : ORA-00000: succès</pre>',
                    'SQLERRM retourne le message d\'erreur texte, SQLCODE le numéro d\'erreur.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier la clause EXCEPTION dans le bloc BEGIN...END',
            'fix'    => 'Toujours prévoir une clause EXCEPTION pour attraper les erreurs potentielles, même si vous prévoyez de simplement les laisser propager.',
            'fr'     => 'Sans clause EXCEPTION, toute erreur survenue dans la section BEGIN...END fera échouer l\'exécution entière du bloc et affichera le message d\'erreur Oracle par défaut, ce qui n\'est pas toujours convivial pour l\'utilisateur.',
            'darija' => 'Sans clause EXCEPTION, erreur bloc execution entière affichage message Oracle par défaut pas toujours convivial.'
        ],
        [
            'wrong'  => 'Utiliser WHEN OTHERS sans affichage du message d\'erreur',
            'fix'    => 'Dans le gestionnaire WHEN OTHERS, affichez toujours SQLERRM ou notez l\'erreur dans un fichier journal pour le débogage.',
            'fr'     => 'WHEN OTHERS capture toutes les exceptions non précédemment attrapées. Si vous ne faites rien à l\'intérieur, l\'erreur est simplement propagée. Pour le débogage, affichez SQLERRM qui contient le message détaillé de l\'erreur.',
            'darija' => 'WHEN OTHERS capture exceptions non attrapées. Rien faire erreur propagée. Pour débogage affichez SQLERRM message détaillé.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les exceptions prédéfinies NO_DATA_FOUND et TOO_MANY_ROWS gèrent les cas courants de SELECT INTO. Pour lever vos propres erreurs, utilisez RAISE avec une exception déclarée. Utilisez WHEN OTHERS avec SQLERRM pour capturer toute erreur inattendue et afficher son message.',
        'darija' => 'Exceptions prédéfinies NO_DATA_FOUND TOO_MANY_ROWS gestion cas courants SELECT INTO. Lever erreurs personnelles RAISE exception déclarée. WHEN OTHERS SQLERRM capturer erreur inattendue afficher message.'
    ],
];