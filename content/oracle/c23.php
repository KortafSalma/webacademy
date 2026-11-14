<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 23 : Curseurs : implicites et explicites
 * Parcourir les lignes d\'une requête SELECT une à une en PL/SQL.
 */

return [
    'id'       => 'oracle-ch23',
    'title'    => 'Curseurs : implicites et explicites',
    'subtitle' => 'Parcourir les résultats de requête',

    'objectives' => [
        'Utiliser un curseur implicite lorsqu\'une instruction SQL affecte une seule ligne.',
        'Déclarer et ouvrir un curseur explicite.',
        'Fetch des lignes du curseur dans des variables.',
        'Fermer le curseur après utilisation.',
        'Comprendre les avantages et limites des curseurs vs traitement en set-based.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'curseur-implicite',
            'title' => 'Curseur implicite',
            'icon'  => '👆',
            'blocks' => [

                make_definition_block(
                    'Curseur implicite',
                    '<p>Lorsque vous exécutez une instruction SQL SELECT...INTO, INSERT...VALUES ou UPDATE qui affecte une seule ligne, Oracle crée automatiquement un curseur implicite. Vous pouvez utiliser les attributs %FOUND, %NOTFOUND, %ROWCOUNT et %ISOPEN pour vérifier le résultat.</p>',
                    '<p>Instruction SQL SELECT...INSERT...UPDATE affecte ligne unique Oracle crée curseur implicite. Attributs %FOUND %NOTFOUND %ROWCOUNT %ISOPEN vérifient résultat.</p>'
                ),

                make_keywords_block([
                    ['kw' => '%FOUND', 'fr' => 'Ligne trouvée', 'darija' => 'Ligne trouvée'],
                    ['kw' => '%NOTFOUND', 'fr' => 'Ligne non trouvée', 'darija' => 'Ligne non trouvée'],
                    ['kw' => '%ROWCOUNT', 'fr' => 'Nombre lignes', 'darija' => 'Nombre lignes'],
                    ['kw' => '%ISOPEN', 'fr' => 'Curseur ouvert', 'darija' => 'Curseur ouvert'],
                ]),

                make_example_block(
                    'Utilisation des attributs %ROWCOUNT et %FOUND',
                    '<pre><code>\nDECLARE\n  v_nom clients.nom%TYPE;\n  v_trouvé BOOLEAN := FALSE;\nBEGIN\n  -- Sélectionner une seule ligne\n  SELECT nom\n  INTO v_nom\n  FROM clients\n  WHERE id = 999;\n  \n  -- Vérifier si une ligne a été trouvée\n  IF SQL%ROWCOUNT = 1 THEN\n    v_trouvé := TRUE;\n    DBMS_OUTPUT.PUT_LINE(\'Client trouvé :\' || v_nom);\n  ELSE\n    DBMS_OUTPUT.PUT_LINE(\'Aucun client avec cet ID.\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Aucun client avec cet ID.</pre>',
                    'SQL%ROWCOUNT compte le nombre de lignes affectées. = 1 signifie succès.'
                ),

                make_example_block(
                    'Mise à jour avec attributs implicites',
                    '<pre><code>\nDECLARE\n  v_nouvel_email VARCHAR2(100) := \'nouveau@exemple.com\';\nBEGIN\n  -- Mise à jour d\'un seul client\n  UPDATE clients\n  SET email = v_nouvel_email\n  WHERE id = 5;\n  \n  -- Vérifier le résultat\n  IF SQL%ROWCOUNT = 1 THEN\n    DBMS_OUTPUT.PUT_LINE(\'Email mis à jour avec succès.\');\n  ELSE\n    DBMS_OUTPUT.PUT_LINE(\'Aucun client mis à jour (ID introuvable).\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Email mis à jour avec succès.</pre>',
                    'Après UPDATE, SQL%ROWCOUNT indique combien de lignes ont été modifiées.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'curseur-explicite',
            'title' => 'Curseur explicite',
            'icon'  => '🖱️',
            'blocks' => [

                make_definition_block(
                    'Déclaration et ouverture',
                    '<p>Un curseur explicite doit être déclaré dans la section DECLARE, ouvert avec OPEN...FETCH, et fermé avec CLOSE. Il parcourt les lignes retournées par une requête SELECT.</p>',
                    '<p>Curseur explicite déclaré section DECLARE ouvert OPEN...FETCH fermé CLOSE. Parcourt lignes SELECT.</p>'
                ),

                make_example_block(
                    'Curseur explicite : afficher tous les clients',
                    '<pre><code>\nDECLARE\n  -- Déclaration du curseur\n  CURSOR c_clients IS\n    SELECT id, nom, email FROM clients;\n  -- Variables pour recevoir les lignes\n  v_id clients.id%TYPE;\n  v_nom clients.nom%TYPE;\n  v_email clients.email%TYPE;\nBEGIN\n  -- Ouverture du curseur\n  OPEN c_clients;\n  \n  -- Boucle de lecture\n  LOOP\n    -- Récupération de la ligne suivante\n    FETCH c_clients INTO v_id, v_nom, v_email;\n    -- Sortie de la boucle quand plus de lignes\n    EXIT WHEN c_clients%NOTFOUND;\n    \n    -- Traitement de la ligne\n    DBMS_OUTPUT.PUT_LINE(\'ID :\' || v_id || \'| Nom :\' || v_nom || \'| Email :\' || v_email);\n  END LOOP;\n  \n  -- Fermeture du curseur\n  CLOSE c_clients;\nEND;</code></pre>',
                    '<pre>ID : 1| Nom : Mohamed| Email : moh@exemple.com\nID : 2| Nom : Fatima| Email : fat@exemple.com\n... (autres lignes)</pre>',
                    'Le curseur parcourt tous les clients un par un.'
                ),

                make_tip_block(
                    'Toujours fermer le curseur',
                    '<p>Il est impératif de fermer le curseur avec CLOSE après avoir terminé le traitement, afin de libérer les ressources système. Oublier CLOSE peut provoquer des fuites de curseurs et des erreurs ORA-01000 (trop de curseurs ouverts).</p>',
                    '<p>Impératif fermer curseur CLOSE après traitement. Oublier CLOSE provoque fuites ressources erreur ORA-01000 trop curseurs ouverts.</p>'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier de vérifier %NOTFOUND après FETCH',
            'fix'    => 'Vérifiez toujours %NOTFOUND (ou %ROWCOUNT) après chaqueFETCH pour savoir s\'il reste des lignes à lire.',
            'fr'     => 'Si vous oubliez de vérifier %NOTFOUND après FETCH, la boucle peut tenter de lire au‑delà du jeu de résultats, ce qui peut provoquer des résultats inattendus ou des erreurs.',
            'darija' => 'Oublier %NOTFOUND après FETCH boucle peut lire au‑delà jeu résultats erreurs inattendues.'
        ],
        [
            'wrong'  => 'Oublier CLOSE le curseur',
            'fix'    => 'Toujours terminer le traitement par CLOSE nom_du_curseur pour libérer les ressources.',
            'fr'     => 'En Oublier CLOSE peut provoquer des fuites de curseurs et l\'erreur ORA-01000 : "too many cursors open".',
            'darija' => 'Oublier CLOSE provoqué fuites ressources erreur ORA-01000 "trop curseurs ouverts".'
        ],
    ],

    'summary' => [
        'fr'     => 'Curseur implicite automatique pour SELECT...INTO/UPDATE affectant une ligne. Curseur expliciteDECLARE OPEN FETCH CLOSE pour parcourir plusieurs lignes. Attributs %FOUND %NOTFOUND %ROWCOUNT %ISOPEN pour contrôler le curseur.',
        'darija' => 'Curseur implicite automatique SELECT INTO UPDATE une ligne. Curseur expliciteDECLARE OPEN FETCH CLOSE parcourir plusieurs lignes. Attributs %FOUND %NOTFOUND %ROWCOUNT %ISOPEN contrôler curseur.'
    ],
];