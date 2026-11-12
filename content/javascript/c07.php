<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 7 : Types de données : string, number, boolean…
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch7',
    'title'    => 'Types de données : string, number, boolean…',
    'subtitle' => 'Les catégories fondamentales de données en JavaScript.',
    'level'    => 'Débutant',
    'minutes'  => 35,
    'prerequisites' => ['Savoir déclarer des variables'],

    'objectives' => [
        'Identifier les types de données primitifs.',
        'Comprendre les opérations sur chaque type.',
        'Détecter le type d\'une variable dynamiquement.',
        'Convertir un type en un autre quand nécessaire.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'types-primitifs',
            'title' => 'Les types primitifs',
            'icon'  => '🧱',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>JavaScript dispose de sept types de données primitifs :</p><ul><li><strong>string</strong> : suite de caractères, ex: "Bonjour", "5".</li><li><strong>number</strong> : nombres entiers ou à virgule, ex: 42, 3.14.</li><li><strong>boolean</strong> : vrai ou faux, true ou false.</li><li><strong>null</strong> : valeur intentionnellement nulle.</li><li><strong>undefined</strong> : valeur non définie.</li><li><strong>symbol</strong> : identifiant unique (ES6+).</li><li><strong>bigint</strong> : entiers de précision arbitrary (ES2020+).</li></ul>',
                 'darija' => '<p>JavaScript kay7et sept types de données primitives :</li><li><strong>string</strong> : suite caractères, ex: "Bonjour", "5".</li><li><strong>number</strong> : nombres entiers ou à virgule, ex: 42, 3.14.</li><li><strong>boolean</strong> : vrai ou faux, true w false.</li><li><strong>null</strong> : valeur nulle intentionnelle.</li><li><strong>undefined</strong> : valeur non définie.</li><li><strong>symbol</strong> : identifiant unique (ES6+).</li><li><strong>bigint</strong> : entiers précision arbitrary (ES2020+).</li></ul>'],

                ['type' => 'example', 'title' => 'Déclarer différents types',
                 'lang'  => 'javascript',
                 'code'  => 'const titre = "Mon titre";       // string\nconst age = 25;               // number\nconst estActif = true;        // boolean\nconst vide = null;            // null\nconst nonDefini;              // undefined\nconst id = Symbol("id");      // symbol\nconst grosNombre = 9007199254740991n;  // bigint',
                 'explainFr' => 'Chaque type a sa syntaxe et son usage propre.',
                 'explainDarija' => 'Kay type kay syntax w usage propre.'],

                ['type' => 'mcq',
                 'question' => 'Combien y a-t-il de types de données primitifs en JavaScript ?',
                 'options' => ['5', '7', '9'],
                 'answer' => 1,
                 'concept' => 'Types primitifs',
                 'explainFr' => 'JavaScript compte 7 types de données primitifs.',
                 'explainDarija' => 'JavaScript kay7et 7 types données primitives.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'operateurs-types',
            'title' => 'Opérateurs et types',
            'icon'  => '➕➖',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Chaque type de données supporte des opérateurs spécifiques. Les nombres peuvent être additionnés, soustraits, multipliés ou divisés. Les chaînes de caractères peuvent être concatenées avec l\'opérateur <code>+</code>. Le langage est sensible aux types : additionner un nombre et une chaîne produit une chaîne.</p>',
                 'darija' => '<p>Chaque type kay9der operators spécifiques. Nombres kay9der additionnés, soustraits, multipliés w divisés. Chaînes kay9der concatenées b operator <code>+</code>. Langage sensitive l types : addition nombre w chaîne kay9der produit chaîne.'],

                ['type' => 'example', 'title' => 'Opérations sur les nombres',
                 'lang'  => 'javascript',
                 'code'  => 'const a = 10;\nconst b = 5;\nconsole.log(a + b);   // 15\nconsole.log(a - b);   // 5\nconsole.log(a * b);   // 50\nconsole.log(a / b);   // 2',
                 'explainFr' => 'Les opérateurs mathématiques fonctionnent comme attendu.',
                 'explainDarija' => 'Operators mathématiques kay9der b7et attendu.'],

                ['type' => 'example', 'title' => 'Concatenation chaîne + nombre',
                 'lang'  => 'javascript',
                 'code'  => 'const resultat = "La valeur est : " + 5;\nconsole.log(resultat); // "La valeur est : 5"',
                 'explainFr' => 'L\'opérateur + concatène si l\'un des opérandes est une chaîne.',
                 'explainDarija' => 'Operator + kaylsse9 b9der chaîne si kay one operands chaîne.'],

                ['type' => 'true_false',
                 'question' => 'En JavaScript, "5" + 3 vaut "53".',
                 'answer' => 0,
                 'concept' => 'Conversion de type',
                 'explainFr' => 'Vrai : l\'addition d\'une chaîne et d\'un nombre convertit le nombre en chaîne.',
                 'explainDarija' => 'Vrai : addition chaîne w nombre kay9der convertir nombre chaîne.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'detecter-convertir-types',
            'title' => 'Détecter et convertir les types',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour connaître le type d\'une variable, on utilise <code>typeof</code> :</p><pre><code>typeof 42          // "number"\ntypeof "texte"    // "string"\ntypeof true       // "boolean"\ntypeof null       // "object"  <!-- bug historique\ntypeof undefined  // "undefined"</code></pre>',
                 'darija' => '<p>Bach kayder type variable, kay7et <code>typeof</code> :</p><pre><code>typeof 42          // "number"\ntypeof "texte"    // "string"\ntypeof true       // "boolean"\ntypeof null       // "object"  <!-- bug historique\ntypeof undefined  // "undefined"</code></pre>',

                ['type' => 'example', 'title' => "Conversion nombre → chaîne",
                 'lang'  => 'javascript',
                 'code'  => 'const n = 42;\nconst s = String(n);\nconsole.log(s + " est une chaîne"); // "42 est une chaîne"\nconsole.log("" + n); // "42" (conversion implicite)',
                 'explainFr' => 'String() convertit un nombre en chaîne. L\'addition avec une chaîne provoque une conversion implicite.',
                 'explainDarija' => 'String() kay9der nombre f chaîne. Addition b chaîne kay9der conversion implicite.'],

                ['type' => 'example', 'title' => "Conversion chaîne → nombre",
                 'lang'  => 'javascript',
                 'code'  => 'const s = "100";\nconst n = Number(s);\nconsole.log(n + 5); // 105\nconsole.log("" + s); // "100"',
                 'explainFr' => 'Number() convertit une chaîne valide en nombre.',
                 'explainDarija' => 'Number() kay9der chaîne valide f nombre.'],

                ['type' => 'mcq',
                 'question' => 'Que renvoie typeof null ?',
                 'options' => '"null"', '"undefined"', '"object"', '"void 0"'],
                 'answer' => 2,
                 'concept' => 'typeof',
                 'explainFr' => 'C\'est un bug historique : typeof null renvoie "object".',
                 'explainDarija' => 'Bug historique : typeof null kayder "object".'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-types',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'La valeur _____ indique qu\'une variable a été déclarée mais pas encore attribuée.',
                 'answer' => 'undefined',
                 'concept' => 'Undefined',
                 'explainFr' => 'undefined signifie "non défini".',
                 'explainDarija' => 'undefined kay9der "non défini".'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces conversions est fausse ?',
                 'options' => ['Number("abc") → NaN', 'String(123) → "123"', 'Boolean("") → false'],
                 'answer' => 0,
                 'concept' => 'Conversions',
                 'explainFr' => 'Number("abc") renvoie NaN (Not-a-Number).',
                 'explainDarija' => 'Number("abc") kayder NaN.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel de ces extraits affiche "number" ?',
                 'code_a' => 'console.log(typeof 42);',
                 'code_b' => 'console.log(typeof "texte");',
                 'answer' => 0,
                 'concept' => 'typeof',
                 'explainFr' => 'typeof 42 renvoie "number".',
                 'explainDarija' => 'typeof 42 kayder "number".'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser Number() sur une chaîne non numérique',
            'fix'    => 'Vérifier avec isNaN() ou parseFloat() d\'abord',
            'fr'     => 'Number("abc") donne NaN, ce qui peut causer des bugs silencieux.',
            'darija' => 'Number("abc") kayder NaN, kay9der bugs silencieux.'],
        ],
        [
            'wrong'  => 'Confondre null et undefined',
            'fix'    => 'Utiliser null pour "vide intentionnel" et undefined pour "non initialisé"',
            'fr'     => 'Bien que==, null == undefined soit true, ce sont des valeurs différentes.',
            'darija' => 'Bien que== null == undefined b true, kay9der valeurs différentes.'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> compte 7 types de données primitifs : string, number, boolean, null, undefined, symbol, bigint. Utilisez <code>typeof</code> pour détecter un type et <code>String()</code>, <code>Number()</code>, <code>Boolean()</code> pour convertir. Faites attention au bug historique : typeof null renvoie "object".',
        'darija' => '<strong>JavaScript</strong> kay7et 7 types primitives : string, number, boolean, null, undefined, symbol, bigint. Isti7mal <code>typeof</code> b detecter type w <code>String()</code>, <code>Number()</code>, <code>Boolean()</code> b convertir. Chou l bug historique : typeof null kayder "object".',
    ],
];