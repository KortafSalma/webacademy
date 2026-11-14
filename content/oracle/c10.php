<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 10 : Types de données Oracle et valeurs NULL
 * Typologie des types de données Oracle et gestion de la valeur NULL (absence de valeur).
 */

return [
    'id'       => 'oracle-ch10',
    'title'    => 'Types de données Oracle et valeurs NULL',
    'subtitle' => 'Typologie des données et gestion du vide',

    'objectives' => [
        'Identifier les principaux types de données Oracle (VARCHAR2, NUMBER, DATE, etc.).',
        'Comprendre la notion de NULL (absence de valeur) et comment elle se comporte.',
        'Utiliser NVL et COALESCE pour remplacer des valeurs NULL.',
        'Effectuer des comparaisons avec NULL (est-ce que = NULL marche ?).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'grande-vue-types',
            'title' => 'Vue d\'ensemble des types de données',
            'icon'  => '📚',
            'blocks' => [

                make_text_block(
                    '<p>Oracle classe les types de données en plusieurs grandes familles :</p>',
                    '<p>Oracle classe types données en plusieurs familles :</p>'
                ),

                make_keywords_block([
                    ['kw' => 'VARCHAR2', 'fr' => 'Chaîne de caractères variable', 'darija' => 'Chaîne taille variable'],
                    ['kw' => 'NUMBER', 'fr' => 'Nombre (entier ou décimal)', 'darija' => 'Nombre entier décimal'],
                    ['kw' => 'DATE', 'fr' => 'Date et heure', 'darija' => 'Date heure'],
                    ['kw' => 'CLOB', 'fr' => 'Grand texte (tampon de caractères)', 'darija' => 'Grand texte'],
                    ['kw' => 'BLOB', 'fr' => 'Grand objet binaire', 'darija' => 'Grand objet binaire'],
                    ['kw' => 'DATE', 'fr' => 'Date et/ou heure', 'darija' => 'Date heure'],
                ]),

                make_example_block(
                    'Exemple de déclaration de colonnes',
                    '<pre><code>CREATE TABLE info (\n  nom          VARCHAR2(100),\n  quantite     NUMBER(10, 2),\n  date_creation DATE DEFAULT SYSDATE,\n  description  CLOB\n);</code></pre>',
                    '<pre>Table created.\n</pre>',
                    'Chaque type a un usage spécifique : texte court, nombre avec précision, date, gros texte.'
                ),

                make_tip_block(
                    'VARCHAR2 vs CHAR',
                    '<p>En plus de VARCHAR2, il existe le type <strong>CHAR</strong> qui réserve un espace fixe de caractères. Utilisez CHAR pour les valeurs de longueur toujours identique (codes postaux, codes ADN).</p>',
                    '<p>En plus de VARCHAR2, existe <b>CHAR</b> qui réserve espace fixe caractères. Utilisez CHAR pour valeurs longueur toujours identique (codes postaux, codes ADN).</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'comprendre-null',
            'title' => 'Comprendre NULL',
            'icon'  => '🚫',
            'blocks' => [

                make_definition_block(
                    'La valeur NULL',
                    '<p>La valeur <strong>NULL</strong> en Oracle représente une <em>absence de valeur</em>, pas une valeur nulle (0) ni une chaîne vide (« »). C\'est un indicateur que la donnée n\'a pas été fournie ou est inconnue.</p>',
                    '<p><b>NULL</b> howa absence valeur, pas valeur nulle (0) w pas chaîne vide (« »). Indicateur donnée fournie ou inconnue.</p>'
                ),

                make_definition_block(
                    'NULL n\'est pas égal à rien',
                    '<p>Contrairement à ce que l\'on pense, <code>NULL = NULL</code> ne retourne pas <code>VRAI</code>, mais <code>NULL</code>. De même, <code>NULL != NULL</code> est aussi <code>NULL</code>, pas <code>FAUX</code>. Il faut utiliser <code>IS NULL</code> ou <code>IS NOT NULL</code>.</p>',
                    '<p><code>NULL = NULL</code> kaylik retourne <b>NULL</b>, pas <b>VRAI</b>. <code>NULL != NULL</code> kaylik <b>NULL</b>, pas <b>FAUX</b>. Utiliser <code>IS NULL</code> ou <code>IS NOT NULL</code>.</p>'
                ),

                make_example_block(
                    'Tester NULL avec IS NULL',
                    '<pre><code>-- Sélectionner les clients dont l\'email n\'est pas renseigné\nSELECT id, nom, email\nFROM clients\nWHERE email IS NULL;</code></pre>',
                    '<pre>ID NOM               EMAIL\n-- ----------------- -----------\n 3  Zakaria         (vide)\n 5  Omar            (vide)</pre>',
                    'La clause WHERE email IS NULL sélectionne les lignes où email n\'a pas de valeur.'
                ),

                make_example_block(
                    'Tester NOT NULL',
                    '<pre><code>-- Sélectionner les clients dont l\'email est renseigné\nSELECT id, nom, email\nFROM clients\nWHERE email IS NOT NULL;</code></pre>',
                    '<pre>ID NOM               EMAIL\n-- ----------------- -----------\n 1  Mohamed         moh@exemple.com\n 2  Fatima          fat@exemple.com</pre>',
                    'La clause WHERE email IS NOT NULL sélectionne les lignes où email a une valeur.'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'nvl-et-coalesce',
            'title' => 'NVL et COALESCE : remplacer NULL',
            'icon'  => '🔄',
            'blocks' => [

                make_definition_block(
                    'NVL(valeur, remplacement)',
                    '<p>La fonction <strong>NVL</strong> remplace une valeur NULL par une valeur de remplacement spécifiée.</p><pre><code>NVL(colonne, remplacement)</code></pre>',
                    '<p><b>NVL</b> remplace NULL par valeur remplacement spécifiée.</p>'
                ),

                make_example_block(
                    'NVL avec une colonne',
                    '<pre><code>-- Afficher le nom du client et remplacer l\'email manquant par \"non fourni\"\nSELECT nom, NVL(email, \'non fourni\') AS email_valide\nFROM clients;</code></pre>',
                    '<pre>NOM          EMAIL_VALIDE\n-----------  -------------------------\nMohamed      moh@exemple.com\nZakaria      non fourni</pre>',
                    'Si email est NULL, il s\'affiche "non fourni".'
                ),

                make_definition_block(
                    'COALESCE(valeur1, valeur2, ...)',
                    '<p>La fonction <strong>COALESCE</strong> retourne la première valeur non NULL parmi sa liste d\'arguments. C\'est une norme SQL plus générale que NVL.</p><pre><code>COALESCE(valeur1, valeur2, ...)</code></pre>',
                    '<p><b>COALESCE</b> retourne première valeur non NULL parmi liste arguments. Norme SQL plus générale que NVL.</p>'
                ),

                make_example_block(
                    'COALESCE avec plusieurs valeurs',
                    '<pre><code>-- Afficher le prix avec priorité : prix_remise > prix_list > 0\nSELECT nom, COALESCE(prix_remise, prix_list, 0) AS prix_final\nFROM produits;</code></pre>',
                    '<pre>NOM          PRIX_FINAL\n-----------  ----------\nT-shirt      24.99\nPantalon     39.99\nChaussettes   0</pre>',
                    'Si prix_remise est NULL, on utilise prix_list. Si les deux sont NULL, on utilise 0.'
                ),

                make_example_block(
                    'Comparaison NVL vs COALESCE',
                    '<pre><code>-- NVL ne accepte que 2 arguments\nNVL(colonne, remplacement)\n-- COALESCE accepte nombre variable d\'arguments\nCOALESCE(val1, val2, val3, ...)</code></pre>',
                    '<pre>NVL: 2 arguments max\nCOALESCE: nombre variable</pre>',
                    'COALESCE est plus flexible : peut tester plusieurs valeurs de substitution.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser NULL = NULL pour tester la valeur manquante',
            'fix'    => 'Utilisez toujours IS NULL ou IS NOT NULL pour tester la valeur NULL.',
            'fr'     => 'En Oracle, NULL représente une absence de valeur inconnue. Les comparaisons classiques (=, !=) avec NULL renvoient toujours NULL (pas Vrai ni Faux). Utilisez IS NULL.',
            'darija' => 'En Oracle, NULL absence valeur inconnue. Comparisons classiques (=, !=) avec NULL renvoient toujours NULL (pas Vrai ni Faux). Utilisez IS NULL.'
        ],
        [
            'wrong'  => 'Oublier que NVL ne fonctionne qu\'avec des paires valeur/remplacement',
            'fix'    => 'Rappelez que COALESCE peut prendre plusieurs arguments pour plus de flexibilité.',
            'fr'     => 'NVL ne prend que deux arguments (la valeur à tester et le remplacement). Si vous avez besoin de tester plusieurs valeurs de substitution, préférez COALESCE.',
            'darija' => 'NVL prend seulement deux arguments (valeur à tester remplacement). Si besoin tester plusieurs valeurs substitution, préférez COALESCE.'
        ],
    ],

    'summary' => [
        'fr'     => 'Les types Oracle principaux sont VARCHAR2 (texte), NUMBER (nombre), DATE (date/heure), CLOB (grand texte), BLOB (binaire). La valeur NULL signifie « aucune valeur ». Utilisez NVL(valeur, remplacement) pour une substitution simple, ou COALESCE(val1, valeur2, ...) pour tester plusieurs valeurs.',
        'darija' => 'Types Oracle principaux VARCHAR2 (texte), NUMBER (nombre), DATE (date/heure), CLOB (grand texte), BLOB (binaire). NULL signifie « aucune valeur ». Utilisez NVL(valeur, remplacement) substitution simple, ou COALESCE(val1, valeur2, ...) tester plusieurs valeurs.'
    ],
];