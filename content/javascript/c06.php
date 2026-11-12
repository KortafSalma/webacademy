<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 6 : Variables : var, let et const
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch6',
    'title'    => 'Variables : var, let et const',
    'subtitle' => 'Déclarer des variables et comprendre leur portée.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['Savoir utiliser console.log'],

    'objectives' => [
        'Différencier var, let et const.',
        'Comprendre la portée de variable (function vs block).',
        'Utiliser le bon type de déclaration selon le besoin.',
        'Éviter les pièges courants de déclaration.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'var-let-const',
            'title' => 'var, let et const',
            'icon'  => '🏷️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les trois mots-clés servent à déclarer des variables, mais avec des comportements différents :</p><ul><li><code>var</code> : fonctionné partout dans la fonction, peut être redeclaré et mis à jour, et est « monté » (hoisted) au début de la fonction avec valeur <code>undefined</code>.</li><li><code>let</code> : portée de bloc (block-scoped), peut être mis à jour mais pas redeclaré dans le même bloc, n\'est pas hoisted.</li><li><code>const</code> : portée de bloc, ne peut pas être redeclaré ni mis à jour (la valeur doit être assignée au moment de la déclaration), n\'est pas hoisted.</li></ul>',
                 'darija' => '<p>L3a mots-clés kayder kay9der variables, mais b comportements différents :</li><li><code>var</code> : kay9der f function, kay9der redeclarer w kay7et, w hoisted b debut function b valeur <code>undefined</code>.</li><li><code>let</code> : portée bloc (block-scoped), kay7et mais kay9der redeclar f same bloc, kay9der hoisted.</li><li><code>const</code> : portée bloc, kay9der redeclar w kay7et (valeur kay7et b moment declaration), kay9der hoisted.</li></ul>'],

                ['type' => 'example', 'title' => 'Différences entre var, let et const',
                 'lang'  => 'javascript',
                 'code'  => '// var\nvar x = 1;\nvar x = 2; // Autorisé\nconsole.log(x); // 2\n\n// let\nlet y = 1;\n// let y = 2; // Erreur : redeclaration\ny = 2; // Autorisé\nconsole.log(y); // 2\n\n// const\nconst z = 1;\n// const z = 2; // Erreur : redeclaration\n// z = 2; // Erreur : mise à jour\nconsole.log(z); // 1',],
                 'explainFr' => 'var est plus ancien et plus souple ; let et const sont plus modernes et plus sûrs.',
                 'explainDarija' => 'var plus ancien w plus souple ; let w const plus modernes w plus sûrs.'],

                ['type' => 'true_false',
                 'question' => 'Une variable déclarée avec var peut être utilisée avant sa déclaration.',
                 'answer' => 0,
                 'concept' => 'Hoisting',
                 'explainFr' => 'Vrai : var est hoisted au début de la fonction avec valeur undefined.',
                 'explainDarija' => 'Vrai : var hoisted b debut function b valeur undefined.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'portee-variable',
            'title' => 'Portée de variable',
            'icon'  => '📦',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La portée d\'une variable détermine où elle est accessible dans le code :</p><ul><li><strong>Portée de fonction</strong> (function-scoped) : les variables déclarées avec var sont accessibles partout dans la fonction qui les contient.</li><li><strong>Portée de bloc</strong> (block-scoped) : les variables déclarées avec let et const ne sont accessibles qu\'au sein du bloc ( {}, if, for, switch) où elles sont définies.</li></ul>',
                 'darija' => '<p>Portée variable kayder kay9der kayder accessible f code :</li><li><strong>Portée fonction</strong> (function-scoped) : variables var kay9der kayder f function qui les contient.</li><li><strong>Portée bloc</strong> (block-scoped) : variables let w const kay9der kayder f b9der block ( {}, if, for, switch) bdefinis.'],

                ['type' => 'example', 'title' => 'Portée de bloc vs fonction',
                 'lang'  => 'javascript',
                 'code'  => 'function testPortée() {\n  if (true) {\n    var a = 1;\n    let b = 2;\n    const c = 3;\n  }\n  console.log(a); // 1 — accessible en dehors du bloc if\n  // console.log(b); // Erreur : b non accessible en dehors du bloc\n  // console.log(c); // Erreur : c non accessible en dehors du bloc\n}\ntestPortée();',
                 'explainFr' => 'var s\'échappe du bloc if alors que let et const restent confinés dedans.',
                 'explainDarija' => 'var kay9der kay7et b bloc if wla let w const kay9der kay7et f b9der bloc.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces variables est accessible en dehors du bloc if ?',
                 'options' => ['var a', 'let b', 'const c', ' Aucune des réponses ci-dessus'],
                 'answer' => 0,
                 'concept' => 'Portée',
                 'explainFr' => 'var est function-scoped, donc accessible en dehors du bloc if.',
                 'explainDarija' => 'var howa function-scoped, kay9der kayder f b9der bloc if.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'hoisting-detail',
            'title' => 'Hoisting détaillé',
            'icon'  => '🔼',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le <strong>hoisting</strong> est un comportement JavaScript où les déclarations (var, function) sont « remontées » au sommet de leur portée avant l\'exécution du code. Cela signifie que l\'on peut appeler une fonction ou référencer une variable var avant sa déclaration réelle dans le code source.</p><p>Important : seule la déclaration est hoistée, pas l\'initialisation. Pour let et const, le références créent une "zone morte" (temporal dead zone) avant la déclaration.</p>',
                 'darija' => '<p><strong>Hoisting</strong> howa comportement JavaScript où declarations kayder kayder "remontées" au sommet b9der portée b9der execution. Kay9der y9der y9der y9der appeler function ou référencer variable var b3d declaration réelle f code.< Important : seule declaration kayder hoistée, pas initialisation. Pour let w const, references kayder y9der y9der "zone morte" (temporal dead zone) b9der declaration.'],

                ['type' => 'example', 'title' => 'Hoisting avec var',
                 'lang'  => 'javascript',
                 'code'  => 'console.log(x); // undefined (pas d\'erreur)\nvar x = 5;',
                 'explainFr' => 'La déclaration est déplacée en haut, mais la valeur reste undefined tant que la ligne d\'initialisation n\'est pas atteinte.',
                 'explainDarija' => 'Declaration kayder y9der b9der, mais valeur kayder y9der y9der undefined tant ligne initialisation kayder y9der.'],

                ['type' => 'example', 'title' => 'Zone morte avec let',
                 'lang'  => 'javascript',
                 'code'  => 'console.log(y); // Erreur : ReferenceError\nlet y = 5;',
                 'explainFr' => 'L\'utilisation de let avant sa déclaration provoque une erreur.',
                 'explainDarija' => 'Utilisation let b9der declaration kayder error.'],

                ['type' => 'true_false',
                 'question' => 'On peut utiliser une variable let avant sa déclaration sans erreur.',
                 'answer' => 1,
                 'concept' => 'Temporal Dead Zone',
                 'explainFr' => 'Faux : ReferenceError car let n\'est pas hoisted.',
                 'explainDarija' => 'Ghalat : ReferenceError b9der kayder hoisted.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-variables',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Pour déclarer une variable dont la valeur ne changera jamais, on utilise le mot-clé _____ .',
                 'answer' => 'const',
                 'concept' => 'Constante',
                 'explainFr' => 'const déclare une liaison immuable.',
                 'explainDarija' => 'const kay3len liaison mchi kaytjib.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces déclarations est valide ?',
                 'options' => ['const x; x = 5;', 'let x = 5; var x = 5;', 'var x = 5; const x = 5;'],
                 'answer' => 1,
                 'concept' => 'Syntaxe declaration',
                 'explainFr' => 'let x = 5; var x = 5; sont tous deux valides (bien que redéclarer var soit inhabituel).',
                 'explainDarija' => 'let x = 5; var x = 5; kay9der kay9der kay9der valide.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel de ces extraits provoque une erreur ?',
                 'code_a' => 'console.log(a); var a = 1;',
                 'code_b' => 'console.log(b); let b = 1;',
                 'answer' => 1,
                 'concept' => 'Erreurs',
                 'explainFr' => 'code_b provoque ReferenceError (zone morte), code_a est valide (var est hoisté).',
                 'explainDarija' => 'code_b ReferenceError b9der zone morte, code_a kay9der valide (var hoisted).'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser var partout par habitude',
            'fix'    => 'Privilégier let pour les variables modifiables et const pour les valeurs fixes',
            'fr'     => 'let et const évitent les effets de bord non désirés liés au hoisting.',
            'darija' => 'let w const ma y9derhomch effects de bord b hoisting.'],
        ],
        [
            'wrong'  => 'Redéclarer une variable let dans le même scope',
            'fix'    => 'Utiliser des blocs {} pour isoler les variables',
            'fr'     => 'Redeclarer let dans le même bloc provoque une erreur de syntaxe.',
            'darija' => 'Redeclar let f same bloc error syntax.'],
    ],

    'summary' => [
        'fr' => '<strong>var</strong> est function-scoped et hoisté ; <strong>let</strong> et <strong>const</strong> sont block-scoped. Utilisez <code>const</code> par défaut pour les valeurs qui ne changent pas, <code>let</code> pour celles qui changent, et <code>var</code> uniquement si vous avez besoin du hoisting ou de la portée function. Toujours initialiser <code>const</code> au moment de la déclaration.',
        'darija' => '<strong>var</strong> howa function-scoped w hoisted ; <strong>let</strong> w <strong>const</strong> howa block-scoped. Isti7mal <code>const</code> b9der valeur kaytjib, <code>let</code> b9der kaytjib, w <code>var</code> b9der kay9der hoisting w function scope. Initialiser toujour <code>const</code> b moment declaration.'],
    ],
];