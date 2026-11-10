<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 5 : Typographie
 * Exemplaire de référence pour TOUS les fichiers de chapitre :
 *   - id : "module-chN"
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : résumé FR + Darija
 * Types de blocs :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'css-ch5',
    'title'    => 'Typographie',
    'subtitle' => 'Mettre en forme le texte avec CSS',

    'objectives' => [
        'Utiliser la propriété font-family pour définir la police.',
        'Modifier la taille de police avec font-size.',
        'Modifier le style et la couleur du texte avec font-style et color.',
        'Contrôler le poids (bold) des polices avec font-weight.',
        'Utiliser les propriétés line-height et text-align pour le layout du texte.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les familles de polices
        [
            'id'    => 'familles-polices',
            'title' => 'Famille de polices',
            'icon'  => '🔤',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La propriété <strong>font-family</strong> permet de spécifier une ou plusieurs polices pour un élément. On indique d\'abord la police préférée, suivie de polices de fallback au cas où la première ne serait pas disponible sur le système de l\'utilisateur.</p>',

                 'darija' => '<p>Propriété <strong>font-family</strong> kay9der specifier polices pr élément. First preference, followed by fallback si première dispo pas. </p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => 'font-family: Arial, Helvetica, sans-serif;\nfont-family: "Times New Roman", serif;',

                 'title' => 'Syntaxe font-family'],

                ['type' => 'example',
                 'title' => 'Exemple de familles de polices',
                 'lang'  => 'css',
                 'code' => '/* Définir la police pour tout le document */\nbody {\n  font-family: "Open Sans", Arial, Helvetica, sans-serif;\n}\n\n/* Utiliser une police spécifique pour un titre */\nh1 {\n  font-family: "Georgia", serif;\n}',

                 'preview' => true,
                 'explainFr' => 'Le navigateur utilisera d\'abord "Open Sans", puis Arial comme fallback, et enfin la famille générique sans-serif si aucune des deux premières n\'est disponible.',
                 'explainDarija' => 'Navigator kayistifi "Open Sans", Arial fallback, w sinon generic sans-serif.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Taille et poids de la police
        [
            'id'    => 'taille-poids-police',
            'title' => 'Taille et poids',
            'icon'  => '📏',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La propriété <strong>font-size</strong> définit la taille du texte. Elle peut être exprimée en pixels (px), en em, en rem ou en pourcentages. La propriété <strong>font-weight</strong> définit le gras (bold) du texte : des valeurs numériques comme <code>400</code> (normal) ou <code>700</code> (bold), ou des mots-clés <code>normal</code> et <code>bold</code>.</p>',

                 'darija' => '<p>Propriété <strong>font-size</strong> definit taille texte. Unités : px, em, rem, pourcent. <strong>font-weight</strong> définit gras : valeurs 400 (normal) ou 700 (bold), w mots-clés normal w bold. </p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => 'font-size: 16px;\nfont-size: 1.2rem;\nfont-weight: bold;\nfont-weight: 400;\nfont-weight: 700;',

                 'title' => 'Syntaxe taille et poids'],

                ['type' => 'example',
                 'title' => 'Exemple de mise en forme de texte',
                 'lang'  => 'css',
                 'code' => '/* Taille et poids */\n.title {\n  font-size: 2rem;\n  font-weight: 700;\n  color: #333;\n}\n\n\\/* Texte normal */\n.text {\n  font-size: 1rem;\n  font-weight: 400;\n  line-height: 1.6;\n}',

                 'preview' => true,
                 'explainFr' => 'Le titre affichera une police de 2 fois la taille racine en gras avec une couleur grise foncée. Le texte aura une taille de 1 rem, avec un interligne de 1.6.',
                 'explainDarija' => 'Titre affichage 2rem gras w couleur gris foncé. Texte 1rem w line-height 1.6.'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Style du texte
        [
            'id'    => 'style-texte',
            'title' => 'Style et alignement du texte',
            'icon'  => '🎨',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Plusieurs propriétés permettent de modifier l\'apparence du texte :</p>',

                 'darija' => '<p>Plusieur properties kay modify apparence texte :</p>'],

                ['type' => 'definition', 'title' => 'Propriétés de style texte',
                 'fr'   => '<p><strong>font-style</strong> : définit l\'italique (<code>italic</code> ou <code>normal</code>).<br><strong>color</strong> : définit la couleur du texte (noms, HEX, RGB, RGBA).<br><strong>text-align</strong> : alignement (<code>left</code>, <code>center</code>, <code>right</code>, <code>justify</code>).<br><strong>text-decoration</strong> : soulignement, traits traversants.</p>',

                 'darija' => '<strong>font-style</strong> : italic w normal. <strong>color</strong> : couleur texte (noms, HEX, RGB, RGBA). <strong>text-align</strong> : alignment left center right justify. <strong>text-decoration</strong> : soulignement traits traversants.'],

                ['type' => 'example',
                 'title' => 'Exemple de style de texte complet',
                 'lang'  => 'css',
                 'code' => '/* Style de texte */\narticle {\n  font-style: italic;\n  color: #2c3e50;\n  text-align: center;\n  text-decoration: underline overline;\n  font-size: 1.2rem;\n  line-height: 1.8;\n}',

                 'preview' => true,
                 'explainFr' => 'L\'article s\'affichera en italique, en couleur foncée, centré, avec un soulignement et une ligne de travers, et une taille de 1.2 rem avec un bon interligne.',
                 'explainDarija' => 'Article italic w couleur foncée, centré, soulignement w trait traversant, size 1.2 rem w line-height 1.8.'],

            ],
        ],

        // ------------------------------------------------ Section 4 : Bonnes pratiques de typographie
        [
            'id'    => 'bonnes-pratiques',
            'title' => 'Bonnes pratiques',
            'icon'  => '✅',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>En typographie web, quelques règles d\'or améliorent la lisibilité :</p>',

                 'darija' => '<p>Quelques règles d\'or improve lisibilité :</p>'],

                ['type' => 'table',
                 'headers' => ['Propriété', 'Valeur recommandée', 'Raison'],
                 'rows' => [
                     ['font-size', '16px ou 1rem (base)', 'Taille de base confortable'],
                     ['line-height', '1.5 à 1.6', 'Lisibilité optimale des paragraphes'],
                     ['max-width', '600 à 800px pour le texte', 'Largeur de lecture confortable'],
                     ['font-family', '"system-ui" ou serif/sans-serif', 'Compatibilité maximale'],
                 ],
                 'fr' => 'Bonnes pratiques typographiques de base.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser des familles de polices non sécurisées sans fallback',
            'fix'    => 'Toujours fournir des polices de fallback génériques (serif, sans-serif).',
            'fr'     => 'Si la police spécifiée n\'existe pas sur l\'ordinateur de l\'utilisateur, le navigateur utilisera une police par défaut qui peut ruiner le design. Ajoutez toujours des alternatives et une famille générique.',
            'darija' => 'Si police spécifiée kay9der machi kaynjmou, navigator kayistifi default kayla kay7rib design. Always add alternatives w generic family. ',
        ],
        [
            'wrong'  => 'Définir une taille de police en pixels uniquement pour tout le site',
            'fix'    => 'Utiliser des unités relatives (rem, em ou %) pour l\'accessibilité et le responsive design.',
            'fr'     => 'Les tailles en px fixes ne s\'adaptent pas au réglage du navigateur ou à la taille de l\'écran. Utilisez rem (racine em) ou % pour respecter les préférences d\'accessibilité de l\'utilisateur.',
            'darija' => 'Taille px fixe kay9der adapt bach réglage navigateur w taille écran. Utilisez rem w % bach accessibilité utilisateur. ',
        ],
    ],

    'summary' => [
        'fr' => '<strong>Typographie</strong> : utilisez <code>font-family</code> avec des polices de fallback, contrôlez la taille avec <code>font-size</code> (px, rem, em) et le poids com <code>font-weight</code>. Améliorez la lisibilité avec <code>line-height</code> et <code>text-align</code>. Évitez les polices non sécurisées sans fallback et privilégiez les unités relatives pour l\'accessibilité.',
        'darija' => 'Typographie : utilisez <code>font-family</code> w fallback, contrôlez taille <code>font-size</code> (px, rem, em) w poids <code>font-weight</code>. Améliorez lisibilité w <code>line-height</code> w <code>text-align</code>. Mach9der polices non sécurisées sans fallback w privilégier unités relatives accessibilité.',
    ],
];