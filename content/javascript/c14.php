<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 14 : Fonctions anonymes et arrow functions
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch14',
    'title'    => 'Fonctions anonymes et arrow functions',
    'subtitle' => 'Des syntaxes alternatives pour les fonctions.',
    'level'    => 'Intermédiaire',
    'minutes'  => 45,
    'prerequisites' => ['Savoir déclarer une fonction classique'],

    'objectives' => [
        'Écrire une fonction arrow function.',
        'Comprendre la différence entre function classique et arrow function.',
        'Utiliser les arrow functions avec une seule expression.',
        'Ne pas utiliser d\'arrow function comme méthodes d\'objets ou avec arguments.callee.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'syntax-arrow',
            'title' => 'Syntaxe des arrow functions',
            'icon'  => '➡️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les <strong>arrow functions</strong> (functions fléchées) offrent une syntaxe plus courte pour les fonctions. La syntaxe basic est : <code>(paramètres) => expression</code>. Si il n\'y a qu\'un seul paramètre, on peut omettre les parenthèses : <code>param => expression</code>. Si le corps contient plusieurs instructions, il faut utiliser des accolades et <code>return</code> explicite.</p>',
                 'darija' => '<p>Arrow functions syntax plus courte <code>(paramètres) => expression</code>. Si un seul paramètre, omettre parenthèses : <code>param => expression</code>. Si plusieurs instructions, accolades w <code>return</code> explicite.'],

                ['type' => 'example', 'title' => 'Arrow function basique',
                 'lang'  => 'javascript',
                 'code'  => 'const addition = (a, b) => a + b;\nconsole.log(addition(3, 4)); // 7',
                 'explainFr' => 'Flèches la fonction additionne deux nombres.',
                 'explainDarija' => 'addition 3 w 4 kayder 7.'],

                ['type' => 'example', 'title' => 'Arrow function avec un paramètre',
                 'lang'  => 'javascript',
                 'code'  => 'const carre = x => x * x;\nconsole.log(carre(5)); // 25',
                 'explainFr' => 'Une seule paramètre, parenthèses omises.',
                 'explainDarija' => 'Paramètre unique, parenthèses omises.'],

                ['type' => 'example', 'title' => 'Arrow function avec corps multi-instructions',
                 'lang'  => 'javascript',
                 'code'  => 'const additionLongue = (a, b) => {\n  const somme = a + b;\n  return somme;\n};\nconsole.log(additionLongue(3, 4)); // 7',
                 'explainFr' => 'Quand le corps contient plusieurs lignes, utiliser les accolades et return explicite.',
                 'explainDarija' => 'Quand corps plusieurs lignes, accolades w return explicite.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces arrow functions est valide ?',
                 'options' => '() => {}', 'x => x + 1', '() => { return 1 }', 'Toutes les réponses ci-dessus',
                 'answer' => 3,
                 'concept' => 'syntaxe valide',
                 'explainFr' => 'Toutes les syntaxes ci-dessus sont valides selon le contexte.',
                 'explainDarija' => 'Toutes syntaxes ci-dessus valides selon contexte.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'differences',
            'title' => 'Différences avec les functions classiques',
            'icon'  => '📊',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Il y a deux différences majeures :</p><ul><li><strong>this</strong> : Dans une function classique, this dépend de l\'où la fonction est appelée. Dans une arrow function, this est hérité du contexte lexical (la portée dans laquelle la arrow function a été définie).</li><li><code>arguments</code> : Les functions classiques ont accès au objet arguments ; les arrow functions n\'en ont pas (elles utilisent plutôt les rest parameters ...).</li></ul>',
                 'darija' => '<p>Deux differences majeures :</li><li><strong>this</strong> : function classique, this dépend où appelée. Arrow function, this hérité du contexte lexical.</li><li><code>arguments</code> : functions classiques arguments ; arrow functions n\'en ont pas (utilisent plutôt rest parameters ...).</li></ul>'],

                ['type' => 'example', 'title' => 'this en function classique vs arrow',
                 'lang'  => 'javascript',
                 'code'  => 'const obj = {\n  normale: function() {\n    return this;\n  },\n  fleche: () => {\n    return this;\n  }\n};\nconsole.log(obj.normale()); // obj\nconsole.log(obj.fleche()); // window (ou undefined en strict mode)',
                 'explainFr' => 'La arrow function capte this du contexte extérieur, pas de l\'objet.',
                 'explainDarija' => 'Arrow function capte this contexte extérieur, pas objet.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle affirmation sur this est vraie ?',
                 'options' => 'this toujours identique', 'this dépend du contexte d\'appel', 'this identique dans arrow w classique',
                 'answer' => 1,
                 'concept' => 'this',
                 'explainFr' => 'Dans une fonction normale, this dépend de la manière dont elle est appelée.',
                 'explainDarija' => 'Dans function normale, this dépend façon appelée.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'rest-parameters',
            'title' => 'Rest parameters et arguments',
            'icon'  => '…',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour accepter un nombre indéfini d\'arguments, on utilise les <strong>rest parameters</strong> avec la syntaxe <code>...paramètres</code>. Cela regroupe tous les arguments restants dans un tableau.</p>',
                 'darija' => '<p>Pour nombre indéfini arguments, rest parameters b syntaxe <code>...paramètres</code>. Regroupe arguments restants dans tableau.'],

                ['type' => 'example', 'title' => 'Rest parameters',
                 'lang'  => 'javascript',
                 'code'  => 'function addition(...nombres) {\n  return nombres.reduce((total, n) => total + n, 0);\n}\nconsole.log(addition(1, 2, 3, 4, 5)); // 15\nconsole.log(addition(1)); // 1',
                 'explainFr' => 'Tous les arguments sont rassemblés dans le tableau nombres.',
                 'explainDarija' => 'Arguments rassemblés tableau nombres.'],

                ['type' => 'mcq',
                 'question' => 'Que renvoie \nfunction f(...rest) { return rest.length; }\nf(1, 2, 3) ?',
                 'options' => '1', '2', '3', 'undefined',
                 'answer' => 2,
                 'concept' => 'rest parameters',
                 'explainFr' => 'Le tableau rest contient 3 éléments.',
                 'explainDarija' => 'Tableau rest contient 3 éléments.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-arrow',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'La syntaxe d\'une arrow function simple est : (paramètres) => _____ .',
                 'answer' => 'expression',
                 'concept' => 'syntaxe arrow',
                 'explainFr' => 'La forme courte n\'a qu\'une expression à retourner implicitement.',
                 'explainDarija' => 'Forme courte une expression retour implicite.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces arrow functions renvoie "Bonjour" ?',
                 'options' => '() => \"Bonjour\"', '() => { \"Bonjour\" }', 'function() { return \"Bonjour\" }', 'A et C',
                 'answer' => 3,
                 'concept' => 'arrow function return',
                 'explainFr' => 'L\'arrow function sans accolades retourne implicitement ; avec accolades, il faut return explicite.',
                 'explainDarija' => 'Arrow function sans accolades retourne implicite ; avec accolades, return explicite requis.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel affiche "window" (ou undefined) ?',
                 'code_a' => 'const f = () => this;\nf()',
                 'code_b' => 'const f = function() { return this; };\nf()',
                 'answer' => 0,
                 'concept' => 'this arrow w classique',
                 'explainFr' => 'Arrow function capte this du contexte global (window).',
                 'explainDarija' => 'Arrow function capte this contexte global (window).'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser une arrow function comme méthode d\'objet',
            'fix'    => 'Utilisez une function classique si vous avez besoin d\'un this propre à l\'objet.',
            'fr'     => 'Dans une arrow function, this n\'est pas l\'objet qui contient la fonction.',
            'darija' => 'Arrow function, this pas objet contient function.'],
        ],
        [
            'wrong'  => 'Oublier return dans une arrow function multilignes',
            'fix'    => 'N\'oubliez pas les accolades et le return explicite pour les corps multiples.',
            'fr'     => 'Sans return explicite, une arrow function multilignes renvoie undefined.',
            'darija' => 'Sans return explicite, multilignes arrow function renvoie undefined.'],
        ],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose les arrow functions comme syntaxe courte : (param) => expression. Différences clés avec les functions classiques : this est lexical (hérité), pas d\'objets arguments. Utilisez rest parameters ... pour accepter un nombre indéfini d\'arguments.',
        'darija' => '<strong>JavaScript</strong> arrow functions syntaxe courte : (param) => expression. Différences clés : this lexical (hérité), pas d\'objets arguments. rest parameters ... b9der accepté nombre indéfini arguments.'],
    ],
];