<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 19 : Variables, constantes et types de données
 * Déclaration et utilisation de variables et constantes en PL/SQL avec les types Oracle.
 */

return [
    'id'       => 'oracle-ch19',
    'title'    => 'Variables, constantes et types de données',
    'subtitle' => 'Déclaration et utilisation des variables',

    'objectives' => [
        'Déclarer des variables dans la section DECLARE d\'un bloc PL/SQL.',
        'Utiliser des types de données spécifiques (VARCHAR2, NUMBER, DATE).',
        'Utiliser les attributs %TYPE et %ROWTYPE pour tirer parti de la structure de table.',
        'Déclarer et utiliser des constantes avec le mot-clé CONSTANT.',
        'Effectuer des affectations et des opérations arithmétiques sur des variables.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'declaraction-variable',
            'title' => 'Déclaration de variables',
            'icon'  => '✏️',
            'blocks' => [

                make_definition_block(
                    'Variable',
                    '<p>Une <strong>variable</strong> en PL/SQL est un emplacement en mémoire qui stocke une valeur qui peut changer au cours de l\'exécution du programme. Elle doit être déclarée dans la section DECLARE.</p>',
                    '<p><b>Variable</b> emplacement mémoire stocke valeur qui peut changer cours exécution. Doit être déclarée section DECLARE.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'VARCHAR2', 'fr' => 'Chaîne de caractères', 'darija' => 'Chaîne caractères'],
                    ['kw' => 'NUMBER', 'fr' => 'Nombre', 'darija' => 'Nombre'],
                    ['kw' => 'DATE', 'fr' => 'Date', 'darija' => 'Date'],
                    ['kw' => 'BOOLEAN', 'fr' => 'Vrai/Faux', 'darija' => 'Vrai/Faux'],
                ]),

                make_example_block(
                    'Déclaration de plusieurs variables',
                    '<pre><code>\nDECLARE\n  v_nom      VARCHAR2(100);\n  v_prenom   VARCHAR2(50);\n  v_age      NUMBER(3);\n  v_actif    BOOLEAN := TRUE;\nBEGIN\n  v_nom := \\'Dupont\\';\n  v_prenom := \\'Jean\\';\n  v_age := 35;\n  -- Affichage\n  DBMS_OUTPUT.PUT_LINE(\\'Client :\' || v_prenom || \\' \"\' || v_nom || \\'\\' || v_age || \\' ans\\');\nEND;</code></pre>',
                    '<pre>Client : Jean "Dupont" 35 ans</pre>',
                    'Quatre variables de types différents déclarées et initialisées dans la section DECLARE.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'constantes',
            'title' => 'Constantes',
            'icon'  => '🔒',
            'blocks' => [

                make_definition_block(
                    'Constante',
                    '<p>Une <strong>constante</strong> est une variable dont la valeur ne peut pas être modifiée après sa déclaration. On utilise le mot-clé <strong>CONSTANT</strong> lors de la déclaration.</p>',
                    '<p><b>Constante</b> variable valeur peut pas modifiée après déclaration. Utilise mot-clé <b>CONSTANT</b> déclaration.</p>'
                ),

                make_example_block(
                    'Déclaration et utilisation de constantes',
                    '<pre><code>\nDECLARE\n  -- Constante du taux de TVA (20 %)\n  v_taux_tva CONSTANT NUMBER := 0.20;\n  v_prix_ht  NUMBER := 100;\n  v_prix_ttc NUMBER;\nBEGIN\n  -- Calcul using la constante\n  v_prix_ttc := v_prix_ht * (1 + v_taux_tva);\n  DBMS_OUTPUT.PUT_LINE(\\'Prix TTC :\' || v_prix_ttc);\nEND;</code></pre>',
                    '<pre>Prix TTC : 120</pre>',
                    'La constante v_taux_tva ne peut pas être modifiée dans le bloc.'
                ),

                make_tip_block(
                    'Convention de nommage',
                    '<p>Il est de bonne pratique d\'utiliser des noms de constantes en lettres majuscules avec underscores (ex: MAX_VALEUR, TAUX_TVA) pour les distinguer des variables classiques.</p>',
                    '<p>Bonne pratique noms constantes lettres majuscules underscores (ex: MAX_VALEUR, TAUX_TVA) distinguer variables classiques.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => '%TYPE-et-%ROWTYPE',
            'title' => 'Attributs %TYPE et %ROWTYPE',
            'icon'  => '🏷️',
            'blocks' => [

                make_definition_block(
                    '%TYPE',
                    '<p>L\'attribut <strong>%TYPE</strong> permet de déclarer une variable dont le type de données est le même qu\'une colonne existante d\'une table. Cela garantit la compatibilité si le type de la colonne change à l\'avenir.</p>',
                    '<p><b>%TYPE</b> déclare variable type identique colonne table existante. Garanti compatibilité si type colonne change.</p>'
                ),

                make_definition_block(
                    '%ROWTYPE',
                    '<p>L\'attribut <strong>%ROWTYPE</strong> permet de déclarer une variable qui possède la structure complète d\'une ligne de table (toutes les colonnes). Utile lorsqu\'on veut manipuler une ligne entière à la fois.</p>',
                    '<p><b>%ROWTYPE</b> déclare variable structure complète ligne table (toutes colonnes). Utile manipuler ligne entière à la fois.</p>'
                ),

                make_example_block(
                    'Utilisation de %TYPE',
                    '<pre><code>\nDECLARE\n  -- Variable ayant le même type que la colonne nom de la table clients\n  v_nom clients.nom%TYPE;\nBEGIN\n  v_nom := \\'Nouveau client\\';\n  DBMS_OUTPUT.PUT_LINE(\\'Nom saisi :\' || v_nom);\nEND;</code></pre>',
                    '<pre>Nom saisi : Nouveau client</pre>',
                    'La variable v_nom a le même type que la colonne nom de la table clients (ici VARCHAR2).'
                ),

                make_example_block(
                    'Utilisation de %ROWTYPE',
                    '<pre><code>\nDECLARE\n  -- Variable qui possède la structure complète de la ligne clients\n  v_client clients%ROWTYPE;\nBEGIN\n  -- Sélectionner une ligne entière dans v_client\n  SELECT *\n  INTO v_client\n  FROM clients\n  WHERE id = 1;\n  -- Accéder aux colonnes par nom\n  DBMS_OUTPUT.PUT_LINE(\\'Client :\' || v_client.nom || \\' \\' || v_client.email);\nEND;</code></pre>',
                    '<pre>Client : NouveauClient moh@exemple.com</pre>',
                    'La variable v_client possède toutes les colonnes de la table clients. On peut y accéder par nom (v_client.nom, v_client.email).'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le type de donnée lors de la déclaration',
            'fix'    => 'Toujours spécifier un type de données (VARCHAR2, NUMBER, DATE, etc.) ou utiliser %TYPE/%ROWTYPE pour éviter les erreurs de type.',
            'fr'     => 'Une variable PL/SQL sans type de données valide provoque une erreur à la compilation. Utilisez %TYPE ou %ROWTYPE lorsque vous vous référez à la structure d\'une table existante.',
            'darija' => 'Variable PL/SQL sans type valide erreur compilation. Utilisez %TYPE/%ROWTYPE référence structure table existante.'
        ],
        [
            'wrong'  => 'Modifier la valeur d\'une constante',
            'fix'    => 'Rappelez que la valeur d\'une constante ne peut pas être changée après sa déclaration. Si vous avez besoin d\'une valeur modifiable, utilisez une variable classique.',
            'fr'     => 'Essayer de modifier une constante après son initialisation provoque une erreur à l\'exécution (ORA-06532: assigning value to constant is not allowed). Si la valeur doit changer, utilisez une variableDECLARE au lieu de CONSTANT.',
            'darija' => 'Valeur constante modification execution erreur ORA-06532. Si valeur doit changer, utilisez variableDECLARE au lieu CONSTANT.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les variables stockent des valeurs modifiables, les constantes des valeurs fixes (% CONSTANT). Utilisez %TYPE pour typage compatible colonne table, et %ROWTYPE pour manipuler une ligne entière. Pensez au typage lors de la déclaration.',
        'darija' => 'Variables stockent valeurs modifiables, constantes valeurs fixes (% CONSTANT). Utilisez %TYPE typage compatible colonne, %ROWTYPE manipuler ligne entière. Penser typage déclaration.'
    ],
];