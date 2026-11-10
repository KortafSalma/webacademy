<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 7 : Bordures et dimensions
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
    'id'       => 'css-ch7',
    'title'    => 'Bordures et dimensions',
    'subtitle' => 'Définir la taille et les contours des éléments',

    'objectives' => [
        'Utiliser la propriété border pour définir le contour d\'un élément.',
        'Comprendre les propriétés width et max-width.',
        'Utiliser height de manière appropriée.',
        'Appliquer les propriétés border-radius pour arrondir les coins.',
        'Utiliser min-height et max-height pour contrôler la hauteur.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les bordures
        [
            'id'    => 'proprietes-bordure',
            'title' => 'Propriétés des bordures',
            'icon'  => '⬛',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La propriété <strong>border</strong> est une propriété raccourcie qui définit la largeur, le style et la couleur d\'une bordure en une seule déclaration. Les trois sous-propriétés sont :</p>',

                 'darija' => '<p>Propriété <strong>border</strong> propriété raccourcie largeur style couleur bordure déclaration une seule :</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => 'border: 2px solid #333;\n/* largeur style couleur */\nborder-width: 3px;\nborder-style: dashed;\nborder-color: red;',

                 'title' => 'Syntaxe border'],

                ['type' => 'example',
                 'title' => 'Exemple de bordures variées',
                 'lang'  => 'css',
                 'code' => '/* Différentes bordures sur chaque côté */\n.box {\n  border-top: 4px red solid;\n  border-right: 2px blue dashed;\n  border-bottom: 4px green dotted;\n  border-left: 2px orange double;\n}\n\n\\/* Bordure simple */\nbutton {\n  border: 1px #e0e0e0 solid;\n  border-radius: 4px;\n}',

                 'preview' => true,
                 'explainFr' => 'La boîte affiche quatre styles de bordure différents sur chaque côté : rouge solide en haut, bleu en pointillés à droite, vert en pointillés en bas, orange double à gauche. Le bouton a une bordure grise simple avec des coins arrondis.',
                 'explainDarija' => 'Boîte quatre styles bordure différents chaque côté w red solid w blue dashed w green dotted w orange double. Button border gris simple w coins arrondis.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Largeur et hauteur
        [
            'id'    => 'largeur-hauteur',
            'title' => 'Largeur et hauteur',
            'icon'  => '📏',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les propriétés <strong>width</strong> (largeur) et <strong>height</strong> (hauteur) définissent les dimensions d\'un élément. Il est important de noter que :</p>',

                 'darija' => '<p>Propriétés <strong>width</strong> (largeur) w <strong>height</strong> (hauteur) définissent dimensions élément. Important :</p>'],

                ['type' => 'definition', 'title' => 'width et max-width',
                 'fr'   => '<p><strong>width</strong> définit la largeur initiale du contenu. <strong>max-width</strong> définit la largeur maximale : le contenu pourra être plus petit mais jamais plus grand que cette valeur. C\'est essentiel pour le responsive design.</p>',

                 'darija' => '<strong>width</strong> définit largeur initiale contenu. <strong>max-width</strong> définit largeur maximale : contenu pourra plus petit mais jamais plus grand. Essentiel responsive design.'],

                ['type' => 'example',
                 'title' => 'Exemple de dimensionnement',
                 'lang'  => 'css',
                 'code' => '/* Image responsive */\nimg {\n  max-width: 100%;\n  height: auto;\n}\n\n/* Conteneur avec largeur maximale */\n.container {\n  width: 100%;\n  max-width: 800px;\n  margin: 0 auto;\n}\n\n\\/* Avec min- et max-height */\n.box {\n  min-height: 200px;\n  max-height: 500px;\n  height: 100%;\n}',

                 'preview' => true,
                 'explainFr' => 'L\'image ne dépassera jamais la largeur de son conteneur (max-width: 100%). La hauteur s\'adapte automatiquement. Le container prend 100% de la largeur disponible mais pas plus de 800px, et est centré.',
                 'explainDarija' => 'Image jamais dépasser largeur conteneur max-width 100%. Height s\'adapter automatiquement. Container 100% largeur disponible w pas plus 800px w centré.'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Bord-radius et coins arrondis
        [
            'id'    => 'border-radius',
            'title' => 'Coins arrondis (border-radius)',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La propriété <strong>border-radius</strong> permet d\'arrondir les coins d\'une bordure. Elle accepte une ou plusieurs valeurs de longueur (px, em, rem, %) :</p>',

                 'darija' => '<p>Propriété <strong>border-radius</strong> arrondir coins bordure. Accepte valeurs longueur (px, em, rem, %) :</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => '/* Un seul arrondit tous les coins */\nborder-radius: 10px;\n\n/* Deux valeurs : premier = coins haut-gauche/haut-droit, deuxième = bas-gauche/bas-droite */\nborder-radius: 5px 10px;\n\n/* Quatre valeurs : dans l\'ordre haut-gauche, haut-droite, bas-droite, bas-gauche */\nborder-radius: 5px 10px 15px 20px;\n\n/* Coins arrondis complets (forme de pilule) */\nborder-radius: 50%;',

                 'title' => 'Syntaxe border-radius'],

                ['type' => 'example',
                 'title' => 'Exemple de coins arrondis',
                 'lang'  => 'css',
                 'code' => '/* Carte avec coins légèrement arrondis */\n.card {\n  border: 1px solid #ddd;\n  border-radius: 8px;\n  padding: 20px;\n  background: white;\n}\n\n/* Bouton forme de pilule */\n.btn {\n  border-radius: 20px;\n  padding: 10px 20px;\n  background: #3498db;\n  color: white;\n  border: none;\n}',

                 'preview' => true,
                 'explainFr' => 'La carte affichera des coins légèrement arrondis (8px), tandis que le bouton aura une forme de pilule parfaite (50% de rayon sur tous les coins).',
                 'explainDarija' => 'Card coins légèrement arrondis 8px, bouton forme de pilule 50% tous coins.'],

            ],
        ],

        // ------------------------------------------------ Section 4 : Bonnes pratiques de dimensionnement
        [
            'id'    => 'bonnes-pratiques-dim',
            'title' => 'Bonnes pratiques',
            'icon'  => '✅',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour un design web robuste, respectez ces règles :</p>',

                 'darija' => '<p>Design web robuste, respectez ces règles :</p>'],

                ['type' => 'table',
                 'headers' => ['Propriété', 'Valeur recommandée', 'Raison'],
                 'rows' => [
                     ['width', 'max-width: 100%; width: auto;', 'Responsive, ne dépasse pas le parent'],
                     ['border-radius', '8-10px pour les cartes, 50% pour les boutons', 'Aspect visuel équilibré'],
                     ['box-sizing', 'border-box', 'Calculs de largeur prévisibles'],
                 ],
                 'fr' => 'Tableau bonnes pratiques dimensionnement.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Définir width fixe sans max-width',
            'fix'    => 'Ajoutez toujours max-width: 100% pour éviter le dépassement sur les petits écrans.',
            'fr'     => 'Un width fixe en pixels (ex: width: 1000px) overflowera horizontalement sur les écrans mobiles. Ajoutez max-width: 100% pour garantir que l\'élément ne dépasse jamais la largeur de son conteneur.',
            'darija' => 'Width fixe pixels overflowera horizontalement écrans mobiles. Always add max-width: 100% garantir élément dépasse jamais largeur conteneur. ',
        ],
        [
            'wrong'  => 'Utiliser height fixe sur les contenus flexibles',
            'fix'    => 'Préférez height: auto ou min-/max-height pour laisser le contenu déterminer la hauteur.',
            'fr'     => 'Définir une hauteur fixe (ex: height: 500px) sur un élément contenant du contenu variable peut entraîner un overflow ou couper le contenu. Utilisez height: auto ou des propriétés min-/max-height à la place.',
            'darija' => 'Height fixe kay9der overflow w couper contenu. Utilisez height: auto w min-/max-height à la place. ',
        ],
    ],

    'summary' => [
        'fr' => '<strong>Bordures et dimensions</strong> : utilisez <code>border</code> pour raccourcir la définition du contour (largeur, style, couleur), préférez <code>max-width</code> à <code>width</code> fixes pour le responsive design, et utilisez <code>border-radius</code> pour arrondir les coins (8-10px pour les cartes, 50% pour les boutons). Pensez à <code>box-sizing: border-box</code> pour des calculs predictibles.',
        'darija' => 'Bordures dimensions : utilisez <code>border</code> raccourci largeur style couleur, préférez <code>max-width</code> fixes width responsive, <code>border-radius</code> arrondir coins 8-10px cartes 50% boutons. Pensez <code>box-sizing border-box</code> calculs predictibles. ',
    ],
];