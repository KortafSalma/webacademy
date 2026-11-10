<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 1 : Introduction à CSS
 * Format identique à content/html/c01.php :
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : FR + Darija
 */

return [
    'id'       => 'css-ch1',
    'title'    => 'Introduction à CSS',
    'subtitle' => 'À quoi sert CSS et comment fonctionne une règle ?',

    'objectives' => [
        'Comprendre le rôle de CSS : le style, pas la structure.',
        'Écrire une règle CSS : sélecteur, propriétés et valeurs.',
        'Comprendre la cascade : quand plusieurs règles s\'appliquent au même élément.',
        'Comprendre l\'héritage : quelles propriétés passent des parents aux enfants.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'a-quoi-sert-css',
            'title' => 'C\'est quoi CSS ?',
            'icon'  => '🎨',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><strong>CSS</strong> veut dire <em>Cascading Style Sheets</em> (feuilles de style en cascade). C\'est le langage qui décrit l\'<strong>apparence</strong> d\'une page web : couleurs, tailles, polices, espacements, disposition…</p><p>Le principe est la <strong>séparation des rôles</strong> : <code>HTML</code> dit <em>ce qui</em> est sur la page (structure, contenu), <code>CSS</code> dit <em>comment ça se présente</em>. Sans CSS, toutes les pages ressembleraient à un document noir sur blanc.</p>',
                 'darija' => '<p>CSS hiya li katbeddel l\'apparence : les couleurs, les tailles, la police, l\'espacement… HTML kaykteb le CONTENU (les éléments), w CSS kat9ol le navigateur KIFACH bach yaffichi had contenu — la couleur dyalo, la taille dyalo, fin ykoun. Bla CSS kol page tekoun noir sur blanc, b7al document Word bla mise en forme.</p>'],

                ['type' => 'definition', 'title' => 'Feuille de style (style sheet)',
                 'fr'   => '<p>Fichier contenant des <strong>règles de style</strong> qui ciblent des éléments HTML. Une même feuille peut styler des centaines de pages : on change un fichier, tout le site change. CSS est exécuté côté <strong>navigateur</strong>, comme HTML.</p>',
                 'darija' => '<p>Feuille de style = fichier fih des règles (rules). Nefs règle katweber 3li bezzaf d\'éléments : ktbddel wa7d fichier, kol site kaytbeddel. W kolchi kaykhdem f navigateur b7al HTML, machi f serveur.</p>'],

                ['type' => 'example',
                 'title' => 'Même HTML, avec et sans CSS',
                 'lang'  => 'css',
                 'code'  => '/* Sans aucune règle CSS : titres et textes tout noirs, tout moches. */
h1 {
  color: #e91e63;
  text-align: center;
}

p {
  color: #555;
  font-size: 18px;
}',
                 'preview' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
h1 { color: #e91e63; text-align: center; }
p { color: #555; font-size: 18px; }
</style>
</head>
<body>
<h1>Salam ! Je suis stylée.</h1>
<p>Grâce au CSS : titre coloré, centré, paragraphe gris en 18px.</p>
</body>
</html>',
                 'explainFr' => 'Deux règles : la première colore et centre le titre, la seconde colore les paragraphes et augmente leur taille. Remarquez la séparation : le HTML reste le même, seul le style change.',
                 'explainDarija' => 'Jouj des règles : wa7da katbeit le titre w katcentrino, lokhra katnaqes la couleur dyal paragraphe w katzedd taille. Hadak le fichier HTML 7ta wa7d caractère mattbdel fih — kolchi CSS.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'syntaxe-regle',
            'title' => 'La syntaxe d\'une règle CSS',
            'icon'  => '📐',
            'blocks' => [

                ['type' => 'definition', 'title' => 'Anatomie d\'une règle',
                 'fr'   => '<p>Une règle = un <strong>sélecteur</strong> + un <strong>bloc de déclarations</strong>. Une déclaration = une <strong>propriété</strong> + une <strong>valeur</strong>, séparées par <code>:</code> et terminées par <code>;</code>.</p>',
                 'darija' => '<p>Règle howa jouj haja : <b>sélecteur</b> li kaygol chno ELEMENT ghadi nstyliwh, + <b>bloc</b> bin les accolades <code>{ }</code> fih des déclarations. Déclaration : propriété <code>:</code> valeur <code>;</code> — kol déclaration f line bo7dha bach code ybqa mfhoum.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code'  => 'sélecteur {
  propriété: valeur;
  propriété: valeur;
}

/* Exemple réel : */
h2 {
  color: green;
  font-size: 24px;
}',
                 'title' => 'Forme générale d\'une règle'],

                ['type' => 'example',
                 'title' => 'Une règle complète, décortiquée',
                 'lang'  => 'css',
                 'code'  => '.carte {
  background-color: white;   /* le fond */
  color: #333;               /* couleur du texte */
  padding: 16px;             /* espace intérieur */
  border: 2px solid #ccc;    /* bordure épaisseur+style+couleur */
}',
                 'output' => 'Une carte blanche, texte gris foncé, interne aéré, bordure grise de 2px.',
                 'explainFr' => 'Le sélecteur <code>.carte</code> cible tout élément avec <code>class="carte"</code>. Chaque ligne du bloc est une déclaration indépendante : l\'ordre n\'a pas d\'importance ici, mais la clarté oui.',
                 'explainDarija' => '<code>.carte</code> katni kolchi li 3ando <code>class="carte"</code>. Kol line f bloc = déclaration wa7idha. Fiha des commentaires b <code>/* … */</code> bach tfixi 3lach katkhdem kol propriété.'],

                ['type' => 'warning', 'title' => 'Les erreurs de syntaxe classiques',
                 'fr'   => 'Un <code>:</code> entre propriété et valeur, un <code>;</code> entre chaque déclaration, des accolades <code>{ }</code> ouvrant et fermant le bloc. Une erreur de syntaxe casse uniquement la déclaration fautée (ou la règle si l\'accolade manque).',
                 'darija' => 'Tamsek <code>:</code> bin la propriété w la valeur, 3ad <code>;</code> kol déclaration, w les accolades <code>{ }</code> msdouda w me7loula. Ila drti ghalta f syntaxe, la déclaration li fiha l\'erreur ma katkhdemch.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'cascade',
            'title' => 'La cascade : quel style gagne ?',
            'icon'  => '🥇',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Plusieurs règles peuvent viser le même élément. La <strong>cascade</strong> est le système que le navigateur utilise pour départager : il applique <em>toutes</em> les propriétés compatibles, et en cas de <strong>conflit</strong> sur la même propriété, la dernière (ou la plus spécifique) <strong>gagne</strong>.</p><p>Règle d\'ordre simple à retenir : <strong>si la spécificité est identique, la règle écrite en dernier écrase les précédentes</strong>.</p>',
                 'darija' => '<p>Y9adder ykoun bezzaf règles 3andhom nefs sélecteur. La cascade hiya le système dyal le navigateur bach ykhtar lih : ila ykoun konflikt 3la nefs propriété, la règle li mktouba LE DERNIER, wla li plus spécifique, hiya li rab7a.</p>'],

                ['type' => 'definition', 'title' => 'Cascade',
                 'fr'   => 'Mécanisme de résolution des conflits de styles : quand deux règles donnent des valeurs différentes à la même propriété du même élément, le navigateur en choisit une (la plus spécifique, ou à spécificité égale la plus récente dans le code).',
                 'darija' => 'Cascade = bach le navigateur ysolve les conflits. Ila jouj règles 3li nefs propriété, w kolhom mokhtelifin, houwa kaykhtar la règle li plus spécifique, wla ila nifs spec, li mktouba f code mn ba3d.'],

                ['type' => 'example',
                 'title' => 'Deux déclarations qui se combattent',
                 'lang'  => 'css',
                 'code'  => 'p {
  color: blue;
  font-size: 16px;
}

/* Un peu plus bas dans le fichier… */
p {
  color: red;      /* gagne : la cascade prend la dernière */
}',
                 'preview' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
p { color: blue; font-size: 16px; }
p { color: red; }
</style>
</head>
<body>
<p>Quel est mon final color ?</p>
</body>
</html>',
                 'explainFr' => 'Le texte sera <strong>rouge</strong> : les deux règles ont la même spécificité (<code>p</code>), donc la dernière l\'emporte. Mais <code>font-size: 16px</code> est conservé : aucune règle ne la contredit.',
                 'explainDarija' => 'The texte ghadi yjou rouge : spécificité nefs niveau, donc la règle li mktouba men ba3d (red) hiya li rba7at. En revanche <code>font-size: 16px</code> sta cdéée 7it ait wa7d ma ghalet 7ta wa7d sur elle.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'heritage',
            'title' => 'L\'héritage de base',
            'icon'  => '🧬',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Certains styles <strong>descendent automatiquement</strong> de l\'élément parent vers ses enfants : c\'est l\'<strong>héritage</strong>. Les propriétés de <strong>texte</strong> (couleur, police, taille, alignement…) héritent ; celles de la <strong>boîte</strong> (marges, bordures, dimensions…) n\'héritent pas.</p><p>C\'est pour cela que mettre <code>color</code> sur <code>body</code> colore toute la page, alors qu\'il faut cibler chaque élément pour lui donner une bordure.</p>',
                 'darija' => '<p>Chi propriétés katnzel otomatiquement mn parent l les enfants dyalo — hadi hiya <b>héritage</b>. Les propriétés dyal TEXTE (couleur, police, taille) héritent : dir <code>color</code> 3la <code>body</code>, kol la page katchver. Le propriétés dyal la BOÎTE (padding, border…) ma héritinach : khassek tzidhom element ba3d element.</p>'],

                ['type' => 'table',
                 'headers' => ['Propriété', 'Hérite ?'],
                 'rows' => [
                    ['color, font-family, font-size', 'Oui'],
                    ['text-align, line-height, letter-spacing', 'Oui'],
                    ['background-color, border', 'Non'],
                    ['margin, padding, width, height', 'Non'],
                 ],
                 'fr' => 'À retenir : ce qui concerne le <em>texte</em> descend, ce qui concerne la <em>boîte</em> reste sur place.'],

                ['type' => 'example',
                 'title' => 'Héritage visible',
                 'lang'  => 'css',
                 'code'  => 'body {
  color: #7b1fa2;   /* tout le texte devient violet par héritage */
  border: 3px solid teal; /* la bordure reste sur body seulement */
}

p { font-size: 20px; }',
                 'preview' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
body { color: #7b1fa2; border: 3px solid teal; }
p { font-size: 20px; }
</style>
</head>
<body>
<h1>Titre hérité du body</h1>
<p>Paragraphe également violet, taille 20px.</p>
</body>
</html>',
                 'explainFr' => 'Aucune règle ne colore ni <code>h1</code> ni <code>p</code> en violet : la couleur descend de <code>body</code> par héritage. La bordure, elle, n\'hérite pas : elle n\'apparaît qu\'autour du body.',
                 'explainDarija' => 'ma ktbna <code>color</code> ghir 3la <code>body</code> — la couleur héritat l kol les éléments li dkhlin fiha, donc kolchi khdo la couleur. La bordure ma héritat-ch : ghir body li 3andha, les b9e les éléments ma darkhomch.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'p { color: red  }         /* point-virgule manqué */',
            'fix'    => 'p { color: red; }',
            'fr'     => 'Chaque déclaration doit se terminer par un <code>;</code>. Sans lui, la déclaration suivante est fusionnée avec la précédente et devient invalide.',
            'darija' => 'Matnsech <code>;</code> f lekher dyal kol déclaration. Bla hadak, la déclaration li moraha kadakhl m3a li 9belha w kaytfasel kolchi.',
        ],
        [
            'wrong'  => 'p ( color: red; )              /* parenthèses au lieu d\'accolades */',
            'fix'    => 'p { color: red; }',
            'fr'     => 'Le bloc de déclarations se délimite avec des accolades <code>{ }</code>, jamais des parenthèses.',
            'darija' => 'Les accolades <code>{ }</code> hiya li kat-delimiti le bloc f CSS. Les parenthèses <code>( )</code> ma katkhdemch f had blasa : ila ktebthom, règle ma tkhdemch.',
        ],
        [
            'wrong'  => 'p { color = red; }',
            'fix'    => 'p { color: red; }',
            'fr'     => 'Entre la propriété et la valeur, c\'est deux points <code>:</code> (comme en HTML pour les attributs), pas un <code>=</code>.',
            'darija' => 'Bin la propriété w la valeur : <code>:</code> — machi <code>=</code>. Hadak dyal les langages de programmation bhal PHP, f CSS dima deux-points.',
        ],
        [
            'wrong'  => 'Donner une bordure à body pour encadrer chaque élément',
            'fix'    => 'et border n\'hérite pas : cible les éléments un par un',
            'fr'     => 'L\'héritage ne concerne que les propriétés de texte (color, font…). Marges, bordures et dimensions doivent être appliquées à chaque élément.',
            'darija' => 'L\'héritage kaykhdem ghir 3la les propriétés dyal ktab (font, color…). Border, margin… ma héritinach : khassek tkteb sélecteur l kol element.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>CSS</b> habille le HTML : il décrit l\'apparence, pendant que le HTML décrit la structure. Une <b>règle</b> = sélecteur + bloc <code>{ propriété: valeur; }</code>. La <b>cascade</b> départage les conflits : à spécificité égale, la dernière règle écrite gagne. L\'<b>héritage</b> transmet automatiquement les propriétés de texte d\'un parent à ses enfants.',
        'darija' => '<b>CSS</b> hiya li katbiddel apparence dyal la page, w HTML katkteb structure. Une règle : sélecteur + <code>{propriété: valeur;}</code>. Ila ykoun konflikt bin règles, la cascade kat-departager : li mktouba MEN BA3D b nefs niveau dyal spécificité, houwa li rab7a. Héritage : les propriétés dyal le texte (color, font…) ktnzel mn parent l les enfants otomatiquement, walakin les propriétés dyal la boîte (border, margin…) la.',
    ],
];
