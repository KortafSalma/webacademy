<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 6 : Margin et padding
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
    'id'       => 'css-ch6',
    'title'    => 'Margin et padding',
    'subtitle' => 'Contrôler l\'espace autour et à l\'intérieur des éléments',

    'objectives' => [
        'Comprendre la différence entre margin (extérieur) et padding (intérieur).',
        'Utiliser les propriétés raccourcies margin et padding.',
        'Comprendre les valeurs automatiques (auto) et les pourcentages pour margin.',
        'Utiliser les propriétés individuelles (margin-top, padding-bottom, etc.).',
        'Appliquer le modèle de boîte dans la mise en page.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Introduction margin vs padding
        [
            'id'    => 'intro-margin-padding',
            'title' => 'Margin vs Padding',
            'icon'  => '📐',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le <strong>margin</strong> et le <strong>padding</strong> sont deux propriétés essentielles pour contrôler l\'espace dans le modèle de boîte CSS :</p>',

                 'darija' => '<p><strong>Margin</strong> w <strong>padding</strong> propriétés essential kay control espace modèle boîte CSS :</p>'],

                ['type' => 'definition', 'title' => 'Margin (extérieur)',
                 'fr'   => '<p>Le <strong>margin</strong> est l\'espace situé <em>à l\'extérieur</em> de la bordure d\'un élément. Il sépare l\'élément de ses voisins. La valeur <code>margin: auto</code> centre horizontalement l\'élément contenant block.</p>',

                 'darija' => '<strong>Margin</strong> howa espace bach bordure élément. Separate element w voisins. <code>margin: auto</code> centre horizontalement élément block.'],

                ['type' => 'definition', 'title' => 'Padding (intérieur)',
                 'fr'   => '<p>Le <strong>padding</strong> est l\'espace situé <em>à l\'intérieur</em> de la bordure, entre le contenu de l\'élément et sa bordure. Il agrandit la zone de l\'élément sans affecter les éléments voisins.</p>',

                 'darija' => '<strong>Padding</strong> howa espace bach bordure, entre contenu élément w bordure. Agrandir zone élément bach affecter voisins.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Propriétés raccourcies
        [
            'id'    => 'proprietes-raccourcies',
            'title' => 'Propriétés raccourcies',
            'icon'  => '⚡',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>CSS propose des propriétés raccourcies pour définir les marges ou le padding des quatre côtés à la fois :</p>',

                 'darija' => '<p>CSS propose propriétés raccourcies definir marges w padding quatre côtés à la fois :</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => '/* Quatre valeurs (dans le sens inverse des aiguilles d\'horaire) */\nmargin: 10px 15px 20px 25px;  /* top right bottom left */\n\n/* Trois valeurs */\nmargin: 10px 15px 20px;       /* top | horizontal | bottom */\n\n/* Deux valeurs */\nmargin: 10px 15px;            /* top & bottom | right & left */\n\n/* Une valeur */\nmargin: 10px;                 /* tous les quatre côtés */\n\n/* Même syntaxe pour padding */\npadding: 10px 5px;',

                 'title' => 'Syntaxe raccourcie margin/padding'],

                ['type' => 'example',
                 'title' => 'Exemple d\'application d\'espace',
                 'lang'  => 'css',
                 'code' => '/* En-tête avec marge extérieure */\nheader {\n  margin: 20px 0;\n  padding: 10px;\n  background-color: #333;\n  color: white;\n}\n\n/* Contenu avec espace intérieur */\narticle {\n  margin: 0 auto;\n  max-width: 800px;\n  padding: 20px;\n  border: 1px solid #e0e0e0;\n}',

                 'preview' => true,
                 'explainFr' => 'L\'en-tête a une marge de 20px en haut et en bas, et 0 à gauche/droite. L\'article est centré horizontalement avec <code>margin: auto</code> et possède un intérieur de 20px entre son contenu et sa bordure.',
                 'explainDarija' => 'Header margin 20px top/bottom w 0 left/right. Article centré auto w max-width 800px w padding 20px bach bordure.'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Propriétés individuelles
        [
            'id'    => 'individuelles',
            'title' => 'Propriétés individuelles',
            'icon'  => '🔧',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Il est aussi possible de cibler un seul côté à la fois en utilisant les préfixes :</p>',

                 'darija' => '<p>Possible cibler un seul côté à la fois bach préfixes :</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => '/* Margin individuel */\nmargin-top: 10px;\nmargin-right: 15px;\nmargin-bottom: 10px;\nmargin-left: 20px;\n\n/* Padding individuel */\npadding-top: 5px;\npadding-right: 10px;\npadding-bottom: 5px;\npadding-left: 10px;',

                 'title' => 'Syntaxe individuelle'],

                ['type' => 'example',
                 'title' => 'Exemple d\'espace individuel',
                 'lang'  => 'css',
                 'code' => '/* Espace asymétrique */\n.card {\n  margin-top: 0;\n  margin-right: 20px;\n  margin-bottom: 0;\n  margin-left: 20px;\n  padding: 15px;\n}\n\n/* Pour ne toucher qu\'au droit et au gauche du padding */\n.box {\n  padding-inline: 10px 20px;\n}',

                 'preview' => true,
                 'explainFr' => 'La carte a un espace de 20px uniquement à gauche, tandis que le box utilise <code>padding-inline</code> pour définir respectivement les paddings gauche et droit à 10px et 20px.',
                 'explainDarija' => 'Card margin 20px left only, box padding-inline 10px left w 20px right.'],

            ],
        ],

        // ------------------------------------------------ Section 4 : Modèle de boîte et calcul
        [
            'id'    => 'mode-boite',
            'title' => 'Modèle de boîte et calcul',
            'icon'  => '🧮',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le modèle de boîte CSS comprend : contenu, padding, border et margin. La largeur totale d\'un élément s\'adicte ainsi :</p>',

                 'darija' => '<p>Modèle boîte CSS comprend : contenu, padding, border w margin. Largeur totale élément :</p>'],

                ['type' => 'example',
                 'title' => 'Calcul de largeur totale',
                 'lang'  => 'css',
                 'code' => '/* Avec box-sizing: border-box, la largeur inclut padding et border */\n.box {\n  width: 300px;\n  padding: 20px;\n  border: 5px solid #333;\n  box-sizing: border-box; /* Inclus padding + border dans width */\n}\n\n/* Sans box-sizing : la largeur totale = 300px + 20px + 20px + 5px + 5px = 350px */\n.old-box {\n  width: 300px;\n  padding: 20px;\n  border: 5px solid #333;\n  box-sizing: content-box; /* Default : width seule, padding + border en plus */\n}',

                 'preview' => true,
                 'explainFr' => 'Avec <code>box-sizing: border-box</code>, la boîte fait exactement 300px de large, incluant le padding et la bordure. Sans cela, elle ferait 350px au total.',
                 'explainDarija' => 'Avec border-box, boîte 300px large incluant padding w border. Sans, 350px total.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier que margin collapse affecte les marges verticales',
            'fix'    => 'Soyez conscient du collapsage de marges et ajoutez du padding ou de la border pour l\'éviter.',
            'fr'     => 'Les marges verticales de deux éléments consécutifs se combinent (s\'additionnent ou prennent la valeur maximale). Cela peut entraîner un espace inattendu. Prévoyez du padding ou une bordure entre les éléments pour éviter le collapsage.',
            'darija' => 'Margins verticales deux éléments consécutifs kay combine w additionnent w prendre valeur maximale. Kay7rib espace inattendu. Prévoyez padding w border bach éviter collapsage. ',
        ],
        [
            'wrong'  => 'Utiliser des pourcentages de margin sur les axes horizontaux et verticaux de la même manière',
            'fix'    => 'Les pourcentages de margin/margin-bottom/margin-top se basent sur la largeur du parent, pas sur la hauteur.',
            'fr'     => 'Attention : une valeur de margin en pourcentage (ex: margin: 5%) correspond toujours à un pourcentage de la largeur du parent, même si vous ciblez margin-top ou margin-bottom. Pour l\'espace vertical, utilisez des unités absolues ou relatives (em, rem).',
            'darija' => 'Valeur margin pourcentage correspond toujours largeur parent, même target margin-top w margin-bottom. Pour espace vertical, utilisez unités absolues w relatives (em, rem). ',
        ],
    ],

    'summary' => [
        'fr' => '<strong>Margin et padding</strong> : le margin est l\'espace extérieur qui sépare les éléments (utilisez <code>auto</code> pour centrer), le padding est l\'espace intérieur qui agrandit l\'élément. Utilisez les propriétés raccourcies pour définir les quatre côtés à la fois, et n\'oubliez <code>box-sizing: border-box</code> pour des calculs de largeur prévisibles.',
        'darija' => 'Margin w padding : margin espace extérieur séparer éléments (auto centrer), padding espace intérieur agrandir élément. Utilisez propriétés raccourcies quatre côtés, n\'oubliez box-sizing border-box largeurs prévisibles. ',
    ],
];