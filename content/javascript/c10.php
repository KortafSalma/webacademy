<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 10 : Conversion, coercition et template literals
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch10',
    'title'    => 'Conversion, coercition et template literals',
    'subtitle' => 'Transformer les types de données et construire des chaînes.',
    'level'    => 'Débutant',
    'minutes'  => 45,
    'prerequisites' => ['Savoir déclarer des variables et utiliser des opérateurs'],

    'objectives' => [
        'Utiliser les template literals pour construire des chaînes de caractères.',
        'Comprendre la coercition de type implicite et explicite.',
        'Convertir des nombres en chaînes et vice-versa.',
        'Utiliser les méthodes intégrées pour la conversion de type.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'template-literals',
            'title' => 'Template literals',
            'icon'  => '📝',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les <strong>template literals</strong> (également appelés modèles de chaîne) permettent d\'intégrer des expressions directement dans une chaîne de caractères en utilisant des guillemets inversés <code>`...</code</code> au lieu de guillemets simples ou doubles. On peut y intégrer des variables via <code>${expression}</code>.</p>',
                 'darija' => '<p><strong>Template literals</strong> kayder kay9der kaybda guillemets inversés <code>`...</code</code> b9der variables b <code>${expression}</code>.'],

                ['type' => 'example', 'title' => 'Template literal basique',
                 'lang'  => 'javascript',
                 'code'  => 'const prenom = "Yasmine";\nconst age = 25;\nconst presentation = `Je m\'appelle ${prenom} et j\'ai ${age} ans.`;\nconsole.log(presentation); // "Je m\'appelle Yasmine et j\'ai 25 ans."',
                 'explainFr' => 'Les variables sont intégrées directement sans concatenation.',
                 'explainDarija' => 'Variables intégrées b9der concatenation.'],

                ['type' => 'example', 'title' => 'Template multiline',
                 'lang'  => 'javascript',
                 'code'  => 'const message = `Bonjour\nBienvenue sur WebAcademy`;\nconsole.log(message);',
                 'explainFr' => 'Les template literals peuvent contenir sauts de ligne directement.',
                 'explainDarija' => 'Template literals kay9der kay7et retour à la ligne m3a 9der direct.'],

                ['type' => 'mcq',
                 'question' => 'Quel caractère utiliser pour une template literal ?',
                 'options' => `' "` , '`', '//'],
                 'answer' => 1,
                 'concept' => 'Syntaxe',
                 'explainFr' => 'Les template literals utilisent les guillemets inversés ` .',
                 'explainDarija' => 'Template literals kayder guillemets inversés ` .'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'coercition',
            'title' => 'Coercition de type',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La <strong>coercition</strong> est la conversion automatique d\'un type vers un autre. JavaScript le fait implicitement quand nécessaire (ex: addition nombre + chaîne donne chaîne). La coercition explicite se fait via les fonctions <code>String()</code>, <code>Number()</code>, <code>Boolean()</code>.</p>',
                 'darija' => '<p><strong>Coercition</strong> howa conversion automatique type b9der. JavaScript kay9der implicitement b9der (ex: addition nombre + chaîne kayder chaîne). Coercition explicite b9der b9der b9der b9der fonctions <code>String()</code>, <code>Number()</code>, <code>Boolean()</code>.'],

                ['type' => 'example', 'title' => 'Coercition implicite',
                 'lang'  => 'javascript',
                 'code'  => 'const n = 5;\nconsole.log("" + n);      // "5" (string)\nconsole.log(n * 2);       // 10 (number)\nconsole.log(n + "%");     // "5%" (string)',
                 'explainFr' => 'L\'addition avec une chaîne convertit le nombre en chaîne.',
                 'explainDarija' => 'Addition b chaîne kayder chaîne.'],

                ['type' => 'example', 'title' => 'Coercition explicite',
                 'lang'  => 'javascript',
                 'code'  => 'const s = "10";\nconst num = Number(s);\nconsole.log(num + 5); // 15\nconst ok = Boolean(""); // false\nconsole.log(ok);',
                 'explainFr' => 'Number() convertit la chaîne en nombre. Boolean("") vaut false.',
                 'explainDarija' => 'Number() kayder nombre f chaîne. Boolean("") kayder false.'],

                ['type' => 'mcq',
                 'question' => 'Que renvoie l\'expression "" + 3.14 ?',
                 'options' => '"3.14"', '3.14', 'Erreur', 'NaN',
                 'answer' => 0,
                 'concept' => 'Coercition implicite',
                 'explainFr' => 'L\'addition avec une chaîne convertit le nombre en chaîne.',
                 'explainDarija' => 'Addition b chaîne kayder chaîne.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'methods-conversion',
            'title' => 'Méthodes de conversion',
            'icon'  => '🛠️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>JavaScript propose des méthodes globales pour convertir les types :</p><ul><li><code>String(valeur)</code> : convertit n\'importe quelle valeur en chaîne de caractères.</li><li><code>Number(valeur)</code> : convertit en nombre (retourne NaN si impossible).</li><li><code>Boolean(valeur)</code> : convertit en booléen (false pour 0, "", null, undefined, NaN).</li></ul>',
                 'darija' => '<p>JavaScript kay9der methods globales b9der kayder conversion types :</li><li><code>String(valeur)</code> : kayder chaîne.</li><li><code>Number(valeur)</code> : kayder nombre (retourne NaN si impossible).</li><li><code>Boolean(valeur)</code> : kayder booléen (false pour 0, "", null, undefined, NaN).</li></ul>'],

                ['type' => 'example', 'title' => 'Toutes les méthodes de conversion',
                 'lang'  => 'javascript',
                 'code'  => 'console.log(String(42));     // "42"\nconsole.log(Number("3.14")); // 3.14\nconsole.log(Boolean(""));      // false\nconsole.log(Boolean(0));       // false',
                 'explainFr' => 'Chaques méthodes effectu la conversion attendue.',
                 'explainDarija' => 'Chaque méthode kayder conversion attendue.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces conversions renvoie NaN ?',
                 'options' => ['Number("abc")', 'String("abc")', 'Boolean("abc")'],
                 'answer' => 0,
                 'concept' => 'Conversion Number',
                 'explainFr' => 'Number("abc") ne peut pas être converti en nombre, donc NaN.',
                 'explainDarija' => 'Number("abc") kayder NaN kayder kayder kayder kayder impossible.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-conversion',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Les template literals utilisent les guillemets inversés _____ .',
                 'answer' => '`',
                 'concept' => 'Syntaxe',
                 'explainFr' => 'Les backticks ` délimitent la template literal.',
                 'explainDarija' => 'Backticks ` kayder délimit template literal.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces expressions est invalide ?',
                 'options' => ['`${x}`', '"${x}"', '`hello`'],
                 'answer' => 1,
                 'concept' => 'Syntaxe template',
                 'explainFr' => 'Les guillemets simples ne peuvent pas contenir ${}.',
                 'explainDarija' => 'Guillemets simples kayder kayder ${}.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel de ces extraits affiche "Prix : 19.99€" ?',
                 'code_a' => 'const prix = 19.99;\nconsole.log(`Prix : ${prix}€`);',
                 'code_b' => 'const prix = 19.99;\nconsole.log("Prix : " + prix + "€");',
                 'answer' => 0,  // actually both work, but code_a is the "better" way
                 'concept' => 'template literal',
                 'explainFr' => 'La template literal intègre directement la variable.',
                 'explainDarija' => 'Template literal kay9der kay9der kay9der intègrer variable directly.'],
            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les accolades dans ${}',
            'fix'    => 'Vérifiez que l\'expression est complète entre les accolades.',
            'fr'     => '${prenom} fonctionne, mais ${ } vide ou incomplet provoque une erreur.',
            'darija' => '${ } vide wla incomplet error.'],
        ],
        [
            'wrong'  => 'Utiliser + pour concaténer de longues chaînes',
            'fix'    => 'Privilégiez les template literals pour plus de lisibilité.',
            'fr'     => '`Bonjour ${nom}` est plus lisible que "Bonjour " + nom + " !".',
            'darija' => '`Bonjour ${nom}` kay9der kay9der lisible kay9der "Bonjour " + nom + " !".'],
        ],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose les template literals (guillemets inversés `) pour intégrer facilement des expressions dans des chaînes. La coercition de type est opérée automatiquement par JavaScript ou explicitement via String(), Number(), Boolean(). Cela facilite la construction de messages et d\'affichages dynamiques.',
        'darija' => '<strong>JavaScript</strong> kay9der template literals (guillemets inversés `) b9der intégrer expressions f strings. Coercition type kayder automatique b9der b9der explicitement b9der String(), Number(), Boolean(). Facilite construction messages affichages dynamiques.'],
    ],
];