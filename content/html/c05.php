<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 5 : Listes HTML
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
    'id'       => 'html-ch5',
    'title'    => 'Listes HTML',
    'subtitle' => 'Créer des listes organisées et non organisées',

    'objectives' => [
        'Utiliser la balise <ul> pour créer une liste non ordonnée.',
        'Utiliser la balise <ol> pour créer une liste ordonnée.',
        'Utiliser la balise <li> pour définir chaque élément de liste.',
        'Nesting des listes (liste à l\'intérieur d\'une autre liste).',
        'Associer des listes avec des ancres pour créer des menus.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les listes non ordonnées
        [
            'id'    => 'listes-non-ordinees',
            'title' => 'Listes non ordonnées (<ul>)',
            'icon'  => '📋',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>La balise <code><ul></code> (unordered list) permet de créer une liste à puces. Chaque élément de la liste est entouré par la balise <code><li></code> (list item). Les navigateurs affichent généralement ces éléments avec un marqueur circulaire.</p>',
                 'darija' => '<p>Balise <code><ul></code> (liste non ordonnée) kay9der créer liste b punctuation. Chaque élément kay9der entouré bach balise <code><li></code> (list item). Navigateurs affichent généralement bach marqueur circulaire.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code' => '<ul>\n  <li>Premier élément</li>\n  <li>Deuxième élément</li>\n  <li>Troisième élément</li>\n</ul>',
                 'title' => 'Syntaxe de base'],

                ['type' => 'example',
                 'title' => 'Exemple de liste non ordonnée',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma liste</title>
</head>
<body>
  <h1>Mes fruits préférés</h1>
  <ul>
    <li>Pomme</li>
    <li>Banane</li>
    <li>Orange</li>
  </ul>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'La page affiche une liste à puces avec trois fruits.',
                 'explainDarija' => 'Page kay9der afficher liste à punctuation b 3 fruits.'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Les listes ordonnées
        [
            'id'    => 'listes-ordonnees',
            'title' => 'Listes ordonnées (<ol>)',
            'icon'  => '🔢',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>La balise <code><ol></code> (ordered list) permet de créer une liste numérotée. Chaque élément est entouré par <code><li></code>. Les navigateurs affichent généralement ces éléments avec des numéros arabes (1, 2, 3).</p>',
                 'darija' => '<p>Balise <code><ol></code> (liste ordonnée) kay9der créer liste numérotée. Chaque élément kay9der entouré bach <code><li></code>. Navigateurs affichent généralement bach numéros arabes (1, 2, 3).</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code' => '<ol>\n  <li>Premier élément</li>\n  <li>Deuxième élément</li>\n  <li>Troisième élément</li>\n</ol>',

                 'title' => 'Syntaxe de base'],

                ['type' => 'example',
                 'title' => 'Exemple de liste ordonnée',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma liste</title>
</head>
<body>
  <h1>Recette de cuisine</h1>
  <ol>
    <li>Préchauffer le four à 180°C.</li>
    <li>Mélanger les ingrédients.</li>
    <li>Enfourner pendant 30 minutes.</li>
  </ol>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'La page affiche une liste numérotée avec les étapes de la recette.',
                 'explainDarija' => 'Page kay9der afficher liste numérotée b steps recette.'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Listes nesting et menus
        [
            'id'    => 'nesting-et-menus',
            'title' => 'Listes nesting et menus',
            'icon'  => '📚',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Il est possible de créer des listes nesting (imbriquées) en plaçant une liste <code><ul></code> ou <code><ol></code> à l\'intérieur d\'un élément <code><li></code> d\'une liste externe. Cela permet de créer des menus déroulants complexes.</p>',
                 'darija' => '<p>Kay9der créer listes nesting bach placer liste <code><ul></code> w <code><ol></code> f element <code><li></code> d\'une liste externe. Kay9der créer menus déroulants complexes.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code' => '<ul>\n  <li>Accueil\n    <ul>\n      <li><a href="#accueil">Accueil</a></li>\n      <li><a href="#propos">À propos</a></li>\n    </ul>\n  </li>\n  <li>Services\n    <ul>\n      <li><a href="#service1">Service 1</a></li>\n      <li><a href="#service2">Service 2</a></li>\n    </ul>\n  </li>\n</ul>',

                 'title' => 'Syntaxe de liste nesting'],

                ['type' => 'example',
                 'title' => 'Exemple de menu de navigation',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Site de navigation</title>
</head>
<body>
  <nav>
    <ul>
      <li><a href="/">Accueil</a></li>
      <li>
        Services
        <ul>
          <li><a href="#service1">Service 1</a></li>
          <li><a href="#service2">Service 2</a></li>
        </ul>
      </li>
      <li><a href="/contact">Contact</a></li>
    </ul>
  </nav>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Le menu de navigation comporte des sous-éléments nesting.',
                 'explainDarija' => 'Menu navigation kay9der sous-éléments nesting.'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les balises <li> à l\'intérieur d\'une liste <ul> ou <ol>',
            'fix'    => 'Chaque élément de liste doit être entouré par la balise <code><li></code>.',
            'fr'     => 'Sans balise <li>, les éléments ne s\'afficheront pas correctement en tant que liste.',
            'darija' => 'Sans balise <li>, éléments kay9der kay9der afficher correctement bach liste.',
        ],
        [
            'wrong'  => 'Utiliser des balises <h1>, <h2> etc. à l\'intérieur d\'une liste sans raison',
            'fix'    => 'Utilisez des titres en dehors de la liste ou utilisez des attributs de style CSS pour la mise en forme.',
            'fr'     => 'Les en-têtes (h1-h6) ont une sémantique différente et ne devraient pas être placés directement à l\'intérieur d\'une liste à moins d\'une raison sémantique particulière.',
            'darija' => 'En-têtes (h1-h6) kay9der sémantique différente kay9der kay9der directement f9der f liste à moins raison sémantique particulier.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>HTML</strong> : les listes non ordonnées (<code><ul></code>) utilisent des puces, les listes ordonnées (<code><ol></code>) utilisent des numéros. Chaque élément doit être entouré par <code><li></code>. Le nesting permet de créer des menus complexes.',
        'darija' => 'HTML : listes non ordonnées (<code><ul></code>) b punctuation, listes ordonnées (<code><ol></code>) b numéros. Chaque élément kay9der entouré bach <code><li></code>. Nesting kay9der créer menus complexes.',
    ],
];