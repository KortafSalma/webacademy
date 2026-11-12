<?php

declare(strict_types=1);

/**
 * MODULE ORACLE — Chapitre 21 : Instructions conditionnelles : IF, ELSIF et ELSE
 * Structures de contrôle logique en PL/SQL pour prendre des décisions.
 */

return [
    'id'       => 'oracle-ch21',
    'title'    => 'Instructions conditionnelles : IF, ELSIF et ELSE',
    'subtitle' => 'Prise de décision en PL/SQL',

    'objectives' => [
        'Rédiger une structure IF simple pour tester une condition.',
        'Utiliser ELSIF pour tester plusieurs conditions séquentielles.',
        'Utiliser ELSE pour le cas par défaut.',
        'Comprendre la priorité d\'évaluation des conditions.',
        'Utiliser des conditions complexes avec des opérateurs logiques.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'if-basique',
            'title' => 'Structure IF simple',
            'icon'  => '🔺',
            'blocks' => [

                make_definition_block(
                    'IF THEN',
                    '<p>La structure <strong>IF ... THEN</strong> exécute un bloc d\'instructions si la condition est VRAIE.</p>',
                    '<p><b>IF ... THEN</b> exécute bloc instructions condition VRAIE.</p>'
                ),

                make_example_block(
                    'IF simple : vérifier si un nombre est positif',
                    '<pre><code>\nDECLARE\n  v_note NUMBER := 15;\nBEGIN\n  IF v_note >= 10 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Félicitations ! La note est suffisante.\\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Félicitations ! La note est suffisante.</pre>',
                    'Si la note >= 10, le message s\'affiche.'
                ),

                make_example_block(
                    'IF sans condition VRAIE',
                    '<pre><code>\nDECLARE\n  v_note NUMBER := 5;\nBEGIN\n  IF v_note >= 10 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Note suffisante.\\');\n  END IF;\n  -- Rien ne s\'affiche car la condition est fausse\nEND;</code></pre>',
                    '<pre>(aucune sortie)</pre>',
                    'Si la condition est fausse, rien ne se passe (pas de ELSE).'
                ),

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'if-elsif-else',
            'title' => 'IF avec ELSIF et ELSE',
            'icon'  => '🔄',
            'blocks' => [

                make_definition_block(
                    'IF ... ELSIF ... ELSE',
                    '<p>La structure <strong>IF ... ELSIF ... ELSE</strong> permet de tester plusieurs conditions séquentiellement. La première condition VRAIE qui s\'exécute. Si aucune n\'est VRAIE, la clause ELSE s\'exécute.</p>',
                    '<p><b>IF ... ELSIF ... ELSE</b> teste conditions séquentiellement. Première VRAIE exécutée. Si aucune VRAIE, ELSE exécutée.</p>'
                ),

                make_keywords_block([
                    ['kw' => 'IF', 'fr' => 'SI', 'darija' => 'SI'],
                    ['kw' => 'ELSIF', 'fr' => 'SINON SI', 'darija' => 'SINON SI'],
                    ['kw' => 'ELSE', 'fr' => 'SINON', 'darija' => 'SINON'],
                ]),

                make_example_block(
                    'IF ELSIF ELSE : classification des notes',
                    '<pre><code>\nDECLARE\n  v_note NUMBER := 17;\nBEGIN\n  IF v_note >= 20 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Note maximale !\\');\n  ELSIF v_note >= 15 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Très bien.\\');\n  ELSIF v_note >= 10 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Passable.\\');\n  ELSE\n    DBMS_OUTPUT.PUT_LINE(\\'Insuffisant.\\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Très bien.</pre>',
                    'La note 17 déclenche la première condition VRAIE (>= 15).'
                ),

                make_tip_block(
                    'Conditions plsorielles',
                    '<p>Vous pouvez imbriquer des conditions AND/OR à l\'intérieur d\'une condition IF pour tester des situations complexes.</p>',
                    '<p>Vous pouvez imbriquer AND/OR condition IF tester situations complexes.</p>'
                ),

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'if-nested',
            'title' => 'IF imbriqués et conditions complexes',
            'icon'  => '📐',
            'blocks' => [

                make_example_block(
                    'IF imbriqué : validation d\'inscription',
                    '<pre><code>\nDECLARE\n  v_age NUMBER := 20;\n  v_ayat VARCHAR2(10) := \\'oui\\\';\nBEGIN\n  IF v_age >= 18 THEN\n    DBMS_OUTPUT.PUT_LINE(\\'Vous êtes majeur.\\');\n    IF v_ayat = \\'oui\\' THEN\n      DBMS_OUTPUT.PUT_LINE(\\'Inscription acceptée.\\');\n    ELSE\n      DBMS_OUTPUT.PUT_LINE(\\'Inscription reportée.\\');\n    END IF;\n  ELSE\n    DBMS_OUTPUT.PUT_LINE(\\'Vous êtes mineur.\\');\n  END IF;\nEND;</code></pre>',
                    '<pre>Vous êtes majeur.\nInscription acceptée.</pre>',
                    'Testage de l\'âge d\'abord, puis vérification du consentement.'
                ),

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier END IF à la fin de la structure',
            'fix'    => 'Toujours fermer la structure IF par le mot-clé END IF (ou END IF sur une nouvelle ligne).',
            'fr'     => 'L\'oubli de END IF provoque une erreur de syntaxe à la compilation. IDE et outils de développement soulignent souvent ce manque, mais il est bon de systématiquement vérifier.',
            'darija' => 'Oubli END IF erreur syntax compilation. Outils soulignent souvent mais vérifiez systématiquement.'
        ],
        [
            'wrong'  => 'Utiliser ELSIF au lieu de ELSE IF (attention à l\'orthographe)',
            'fix'    => 'En Oracle PL/SQL, le mot-clé s\'écrit ELSIF (tout en un mot), pas ELSE IF séparé.',
            'fr'     => 'La syntaxe Oracle exige le mot-clé ELSIF (un seul mot). Écrire ELSE IF (deux mots) provoquera une erreur de compilation.',
            'darija' => 'Syntaxe Oracle ELSIF (un seul mot). ELSE IF (deux mots) erreur compilation.'
        ],
    ],

    'summary' => [
        'fr'     => 'La structure IF THEN exécute si VRAIE. IF ELSIF ELSE teste plusieurs conditions séquentiellement, la première VRAIE exécutée, sinon ELSE. Attention : ELSIF s\'écrit en un seul mot en Oracle. Les conditions peuvent être complexes avec AND/OR.',
        'darija' => 'IF THEN exécute si VRAIE. IF ELSIF ELSE teste conditions séquentiellement première VRAIE exécutée sinon ELSE. Attention ELSIF un mot Oracle. Conditions complexes AND/OR.'
    ],
];