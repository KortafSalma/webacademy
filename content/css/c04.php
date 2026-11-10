<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 4 : Property display
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
    'id'       => 'css-ch4',
    'title'    => 'Property display',
    'subtitle' => 'Contrôler l\'affichage des éléments',

    'objectives' => [
        'Utiliser la propriété display pour contrôler le comportement d\'élément.',
        'Utiliser les valeurs block, inline, inline-block et none.',
        'Comprendre la différence entre display inline et block.',
        'Utiliser display none pour masquer temporairement un élément.',
        'Utiliser les valeurs flex et grid pour la mise en page.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les valeurs de base
        [
            'id'    => 'valeurs-base',
            'title' => 'Les valeurs de base de display',
            'icon'  => '📐',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>La propriété <strong>display</strong> en CSS contrôle le type de boîte générée par un élément et comment il interagit avec les autres éléments de la page. C\'est l\'une des propriétés les plus importantes pour le layout.</p>',
                 'darija' => '<p>Propriété <strong>display</strong> CSS kay9der contrôler type boîte généré par élément w comment il interagit bach autres éléments page. Hada l\'une propriétés plus importantes pour layout.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => 'display: block;\ndisplay: inline;\ndisplay: inline-block;\ndisplay: none;',

                 'title' => 'Valeurs de base'],

                ['type' => 'example',
                 'title' => 'Exemple de différents types de display',
                 'lang'  => 'css',
                 'code' => '/* Block */\nheader, nav, section, article, footer {\n    display: block;\n}\n\n/* Inline */\nspan, a, strong { display: inline; }\n\n/* Inline-block */\nnav a { display: inline-block; }\n\n/* None */\n.hidden { display: none; }',

                 'preview' => true,
                 'explainFr' => 'Les éléments display:block prennent toute la largeur, inline ne prennent que l\'espace nécessaire, inline-block permet de définir largeur/hauteur.',
                 'explainDarija' => 'Elements display:block prennent toute largeur, inline prennent espace nécessaire, inline-block permettre définir largeur/hauteur.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Display none et valeurs avancées
        [
            'id'    => 'display-none-et-plus',
            'title' => 'Display none et valeurs avancées',
            'icon'  => '👁️',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>La valeur <code>display: none</code> retire complètement l\'élément du flux du document. L\'élément ne prend aucune place à l\'écran et n\'est pas accessible via le tabindex. C\'est différent de la visibilité cachée (<code>visibility: hidden</code>) qui conserve la place de l\'élément.</p>',
                 'darija' => '<p>Valeur <code>display: none</code> retire complètement élément f flux document. Hia aucune place à écran w non accessible bach tabindex. Différent de visibilité cachée (<code>visibility: hidden</code>) conserve place élément.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => '/* Masquer un élément */\nnav .hidden { display: none; }\n\n/* Rendre visible à nouveau */\nnav .visible { display: block; }',

                 'title' => 'Masquer et rendre visible'],

                ['type' => 'example',
                 'title' => 'Exemple de masquer/show un élément',
                 'lang'  => 'css',
                 'code' => '<style>\n  .cache { display: none; }\n  .afficher { display: block; }\n</style>\n\n<button onclick="document.querySelector(\".cache\").style.display=\"block\"">Afficher</button>\n<img class="cache" src="image.jpg" alt="Image cachée">',

                 'preview' => true,
                 'explainFr' => 'Cliquer sur le bouton rend l\'image visible à nouveau.',
                 'explainDarija' => 'Cliquer bouton rend image visible à nouveau.'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser display: none pour cacher du contenu que les moteurs de recherche doivent indexer',
            'fix'    => 'Utilisez display none pour du contenu temporaire ou utilisez des méthodes SEO-friendly.',
            'fr'     => 'Les moteurs de recherche comme Google ne voient pas le contenu caché display: none, ce qui peut nuire au référencement. Utilisez visibility: hidden ou des techniques CSS plus adaptées si le contenu doit être indexed.',
            'darija' => 'Moteurs recherche comme Google kay9der vo content display: none, kay9der nuise au référencement. Utilisez visibility: hidden w techniques CSS plus adaptés si contenu kay9der indexed.',
        ],
        [
            'wrong'  => 'Confondre display: none et visibility: hidden',
            'fix'    => 'Rappelez-vous : display: none retire l\'élément du flux, visibility: hidden ne le garde que caché mais conserve sa place.',
            'fr'     => 'C\'est une erreur courante : display: none retire complètement l\'élément, alors que visibility: hidden ne le rend que invisible tout en conservant sa place dans le layout.',
            'darija' => 'Erreur courante : display: none retire complètement élément, w visibility: hidden kay9der kay9der caché conserve place f layout.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>CSS</strong> : display contrôle le type de boîte d\'un élément. display: none retire l\'élément du flux, display: block fait prendre toute la largeur, display: inline ne prend que l\'espace nécessaire. Ne pas confondre avec visibility: hidden.',
        'darija' => 'CSS : display contrôle type boîte élément. display: none retire élément f flux, display: block fait prendre largeur complète, display: inline prend espace nécessaire. Ne pas confondre w visibility: hidden.',
    ],
];