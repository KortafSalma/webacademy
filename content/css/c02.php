<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 2 : Les trois façons d'appliquer CSS
 * Format identique à content/css/c01.php.
 *
 * Types de blocs : text | definition | syntax | example | note | tip | warning | table | keywords
 */

return [
    'id'       => 'css-ch2',
    'title'    => 'Inline, interne ou externe : où mettre le CSS ?',
    'subtitle' => 'Trois façons d\'habiller une page, une seule bonne pratique.',

    'objectives' => [
        'Appliquer du style avec l\'attribut style (CSS inline).',
        'Écrire du CSS interne dans la balise &lt;style&gt;.',
        'Lier un fichier .css externe avec &lt;link rel="stylesheet"&gt;.',
        'Choisir la bonne méthode selon la situation.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'css-inline',
            'title' => 'Le CSS inline (attribut style)',
            'icon'  => '👉',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La première façon est d\'écrire le style <strong>directement dans la balise HTML</strong>, avec l\'attribut <code>style</code>. C\'est du CSS à usage unique : il ne s\'applique qu\'à cet élément précis.</p>',
                 'darija' => '<p>La première método : tkteb le style DIMA f la balise, b attribut <code>style</code>. Had CSS kaykhdem ghir 3la had element bo7do : kolchi li 3liha les éléments 3andhom la valeur dyalhom.</p>'],

                ['type' => 'definition', 'title' => 'Attribut style',
                 'fr'   => '<p>L\'attribut <code>style</code> se place sur une balise HTML et reçoit <em>une ou plusieurs déclarations CSS</em>, séparées par <code>;</code>. Syntaxe : <code>style="propriété: valeur; propriété2: valeur2;"</code>.</p>',
                 'darija' => '<p><code>style</code> attribut katdakhl bin les guillemets dekhal : <code>propriété: valeur;</code> — kol déclaration f ; ekhttaf. Inglih kolchi kaykhdm ghir 3la had balises wa7da à la fois : it\'s running (génération dernière Déclarations).'],
            ],
        ],
    ],
];
