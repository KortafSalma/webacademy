<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 2 : Variables et types
 */

return [
    'id'       => 'js-ch2',
    'title'    => 'Variables et types',
    'subtitle' => 'Comment stocker et manipuler des données en JavaScript.',
    'level'    => 'Débutant',
    'minutes'  => 35,
    'prerequisites' => ['js-ch1'],

    'objectives' => [
        'Déclarer des variables avec let et const.',
        'Comprendre la différence entre les types primitifs.',
        'Utiliser les templates littéraux pour assembler des chaînes.',
        'Identifier le type d\'une variable avec typeof.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'declaraison-types',
            'title' => 'Déclarer des variables',
            'icon'  => '📝',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>JavaScript propose trois façons de déclarer une variable, chacune ayant son propre comportement :</p>',
                 'darija' => '<p>JavaScript yajib trej ways bach tkhouzu variable :</p>'],

                ['type' => 'table',
                 'headers' => ['Mot-clé', 'Portée', 'Redéclaration'],
                 'rows' => [
                     ['var', 'Fonctionnelle (ou globale)', 'Autorisée'],
                     ['let', 'Bloc (block)', 'Non autorisée en mode strict'],
                     ['const', 'Bloc en lecture seule', 'Non autorisée'],
                 ],
                 'fr' => 'Le type <code>const</code> empêche toute modification après la première affectation.',],

                ['type' => 'example',
                 'title' => 'Trois façons de déclarer',
                 'lang'  => 'javascript',
                 'code'  => '// Avec var\nvar ancien = 1;\n// Avec let\nlet moderne = 2;\n// Avec const\nconst FIXE = 3;',
                 'output' => 'Trois variables déclarées',
                 'explainFr' => 'On peut réaffecter <code>ancien</code> et <code>moderne</code>, mais pas <code>FIXE</code>.',
                 'explainDarija' => 'Kaybedel <code>ancien</code> w <code>moderne</code>, walakin ma tbedel <code>FIXE</code>.'],

                ['type' => 'tip',
                 'title' => 'Quand utiliser quel mot-clé',
                 'fr'   => '<ul><li><code>var</code> : hérité, utilisé surtout dans les anciens codes.</li><li><code>let</code> : préférable pour la plupart des variables modifiables.</li><li><code>const</code> : pour les valeurs qui ne changent jamais (constantes).</li></ul>',
                 'darija' => '<ul><li><code>var</code> : hérité, surtout dans les vieux codes.</li><li><code>let</code> : préférable pour kol variable modifiable.</li><li><code>const</code> : pour valeurs qui changent jamais.</li></ul>'],

                ['type' => 'example',
                 'title' => 'Attempting to reassign const',
                 'lang'  => 'javascript',
                 'code'  => 'const PI = 3.14;\nPI = 3.15; // Erreur en mode strict\nconsole.log(PI);',
                 'output' => '3.14 (ligne suivante provoque une erreur)',
                 'explainFr' => 'La tentative de réaffectation d\'une constante provoque une erreur à l\'exécution en mode strict.',
                 'explainDarija' => 'Tentative de réassignation constante kay3ti erreur f mode strict.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'types-primitifs',
            'title' => 'Types de données primitifs',
            'icon'  => '🧮',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les types primitifs sont les types de données les plus basiques de JavaScript. Ils sont immuables (on ne peut pas les modifier).</p>',
                 'darija' => '<p>Les types primitifs sont les types de données les plus basiques de JavaScript. Ils sont immuables (on ne peut pas les modifier).</p>'],

                ['type' => 'table',
                 'headers' => ['Type', 'Description', 'Exemple'],
                 'rows' => [
                     ['undefined', 'Non défini', 'let x; console.log(x) → undefined'],
                     ['null', 'Valeur nulle', 'let y = null;'],
                     ['boolean', 'Vrai/faux', 'let z = true;'],
                     ['string', 'Chaîne de caractères', 'let s = "Salam";'],
                     ['number', 'Nombre (entier ou décimal)', 'let n = 42; let p = 3.14;'],
                     ['symbol', 'Symbole unique (ES6)', 'let sym = Symbol();'],
                 ],
                 'fr' => 'Le type <code>typeof</code> permet de connaître le type d\'une variable à l\'exécution.',],

                ['type' => 'example',
                 'title' => 'Découvrir le type d\'une variable',
                 'lang'  => 'javascript',
                 'code'  => 'const valeur = "Bonjour";\nconsole.log(typeof valeur);\nconsole.log(typeof 42);\nconsole.log(typeof true);',
                 'output' => 'string\nnumber\nboolean',
                 'explainFr' => 'Chaque <code>typeof</code> affiche le nom du type dans la console.',
                 'explainDarija' => 'Chaque typeof kay3red name du type f console.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser var dans tout le code sans raison',
            'fix'    => 'Privilégier let pour les variables modifiables et const pour les constantes',
            'fr'     => 'Le mode strict moderne recommande d\'utiliser let et const plutôt que var afin d\'éviter les problèmes de portée inattendue.',
            'darija' => 'Mode strict moderne kay7e7 do7 l let w const b7ad var bach t9der y9der scope makhsof.',
        ],
        [
            'wrong'  => 'Modifier une variable déclarée avec const',
            'fix'    => 'Supprimer le const ou renommer la variable',
            'fr'     => 'Tenter de réaffecter une constante provoque une erreur en mode strict moderne.',
            'darija' => 'T9der tbedel variable const kay3ti erreur f mode strict moderne.',
        ],
        [
            'wrong'  => 'Confondre null et undefined',
            'fix'    => 'Utiliser null pour indiquer intentionnellement l\'absence de valeur, undefined pour une variable non initialisée',
            'fr'     => '<code>null</code> est une valeur volontaire. <code>undefined</code> signifie que la variable n\'a pas encore été affectée.',
            'darija' => '<code>null</code> howa valeur khattawill. <code>undefined</code> kaynsich variable ma kayt7etch lkher.',
        ],
    ],

    'summary' => [
        'fr'     => 'JavaScript utilise <code>var</code>, <code>let</code> et <code>const</code> pour déclarer des variables. <code>let</code> et <code>const</code> ont une portée de bloc, contrairement à <code>var</code>. Les types primitifs sont : undefined, null, boolean, string, number et symbol. Les valeurs primitives sont immuables. Utilisez <code>typeof</code> pour connaître le type à l\'exécution.',
        'darija' => 'JavaScript kayast <code>var</code>, <code>let</code> w <code>const</code> bach tkhouzu variable. <code>Let</code> w <code>const</code> kayrjo3 scope b bloc, walakin <code>var</code> kayrjo3 scope founctionnelle. Types primitifs howa: undefined, null, boolean, string, number w symbol. Valeurs primitives kaymu3t. Ist3dm b <code>typeof</code> bach t3ref type f exécution.',
    ],
];