<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 8 : Le box model (modèle de boîte)
 * Format identique à content/html/c01.php :
 *   lessons[] sections avec blocks[], mistakes[], summary {fr, darija}
 * Blocs utilisés : text, definition, syntax, example (preview possible), note/tip/warning, table.
 */

return [
    'id'       => 'css-ch8',
    'title'    => 'Le box model : content, padding, border, margin',
    'subtitle' => 'Chaque élément HTML est une boîte à quatre couches : apprends à calculer sa vraie largeur.',

    'objectives' => [
        'Identifier les 4 couches du box model : content, padding, border, margin.',
        'Comprendre comment une boîte occupe de l\'espace autour de son texte.',
        'Calculer la largeur réelle d\'une boîte (contenu + padding + border).',
        'Distinguer box-sizing: content-box et box-sizing: border-box.',
        'Appliquer le box model à des cas réels : bouton, carte, encadré.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'quatre-couches',
            'title' => 'Une boîte, quatre couches',
            'icon'  => '📦',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Tout élément HTML est dessiné comme une <strong>boîte rectangulaire</strong>. Du centre vers l\'extérieur, ces couches s\'emboîtent toujours dans le même ordre :</p><ul><li><strong>content</strong> : le contenu lui-même (texte, image…) ;</li><li><strong>padding</strong> : l\'air autour du contenu, <em>à l\'intérieur</em> de la boîte — le fond s\'applique aussi au padding ;</li><li><strong>border</strong> : le cadre, le liseré autour du padding ;</li><li><strong>margin</strong> : l\'espace <em>invisible</em> autour de la boîte, qui la décolle des voisins.</li></ul><p>Ce modèle s\'appelle le <strong>box model</strong>. Il explique 90% des décalages mystérieux dans une mise en page.</p>',
                 'darija' => '<p>Kol élément f CSS rah <strong>boîte rectangle</strong>. Men dakhel l\'bara, les couches dima kaytrattbou b had tartib :</p><ul><li><strong>content</strong> : texte wala image li katktebha ;</li><li><strong>padding</strong> : espace 7da le contenu, men dakhel la boîte — le fond kayghattih ;</li><li><strong>border</strong> : le cadre 7da padding ;</li><li><strong>margin</strong> : espace invisible men bara, kayfesse les éléments binathom.</li></ul><p>Had les 4 couches = le box model. Ila fhemtoh mzyan, 90% dyal les décalages li kaybanou ghalta kaywliou wad7in.</p>'],

                ['type' => 'definition', 'title' => 'Le box model',
                 'fr'   => '<p><strong>Box model :</strong> modèle décrivant chaque élément comme content + padding + border + margin. La taille <em>occupée</em> sur la page = largeur du contenu + padding + border (+ margin si on veut mesurer l\'espace réellement laissé autour).</p>',
                 'darija' => '<p>Box model : kol élément = content + padding + border + margin. La taille kamla li ghatkhod f la page = width dyal content + padding + border. Margin l\'bara ghir espace, makaydakhelch f largeur dyal la boîte rasha (transparent).</p>'],

                ['type' => 'table',
                 'headers' => ['Couche', 'À quoi elle sert', 'Propriétés CSS'],
                 'rows' => [
                    ['content', 'Le contenu réel : texte, image…', 'width, height'],
                    ['padding', 'Espace intérieur, entre le contenu et le cadre. Peint par le fond.', 'padding, padding-top / right / bottom / left'],
                    ['border', 'Le cadre autour du padding.', 'border, border-color, border-radius, border-style'],
                    ['margin', 'Espace extérieur, entre la boîte et ses voisines. Transparent.', 'margin, margin-top / right / bottom / left'],
                 ],
                 'fr' => '`padding` = intérieur (peint par le fond), `margin` = extérieur (transparent). Le cadre `border` s\'insère entre les deux.'],

                ['type' => 'example',
                 'title' => 'Voir les 4 couches de ses propres yeux',
                 'lang'  => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Les couches du box model</title>
<style>
  body { font-family: sans-serif; }
  .couches {
    background: #fde68a;        /* le fond peint aussi le padding */
    border: 6px solid #2b6cb0;  /* le border : le cadre bleu */
    padding: 25px;              /* air intérieur autour du content */
    margin: 20px;               /* espace invisible autour du cadre */
    max-width: 420px;
  }
  .contenu {
    background: #ffffff;        /* la zone du content, au centre */
    text-align: center;
  }
</style>
</head>
<body>
  <div class="couches">
    <div class="contenu">Moi je suis le CONTENT — au centre !</div>
  </div>
  <p>Le jaune qui déborde du blanc : c\'est le <b>padding</b>.
  Le cadre bleu : c\'est le <b>border</b>.
  Et l\'espace entre le cadre et ce paragraphe : c\'est le <b>margin</b>.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Le fond jaune s\'étend jusqu\'au border : le padding est donc peint. Le margin, invisible, crée l\'espace autour des boîtes.',
                 'explainDarija' => 'Chouf : la couleur jaune katghatti le blanc makaybanoche — hadi hiya le padding. Border hadouk le cadre bleu. W le vide bin le cadre w texte dyal te9t : hada margin, transparent, ma fih la couleur.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'largeur-reelle',
            'title' => 'Quelle largeur occupe réellement une boîte ?',
            'icon'  => '📐',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le contenu se dimensionne avec <code>width</code> et <code>height</code>, mais <strong>ce n\'est pas la boîte entière</strong>. Par défaut, <code>width</code> décide uniquement de la largeur du <strong>content</strong> ; padding et border s\'ajoutent par-dessus :</p><p><code>largeur totale = width + padding gauche + padding droit + border gauche + border droit</code></p>',
                 'darija' => '<p><code>width</code> kat3ni ghir largeur dyal le contenu. Padding w border joz2 men la boîte walakin makaydakhloch f width : kaytzidou. Donc chouf : largeur totale = width + padding dyal 2 côtés + border dyal 2 côtés.</p>'],

                ['type' => 'table',
                 'headers' => ['Réglage', 'width: 200px signifie', 'Largeur totale (padding: 20px, border: 5px)'],
                 'rows' => [
                    ['content-box (défaut)', 'largeur du contenu seulement', '200 + 20 + 20 + 5 + 5 = <b>250px</b>'],
                    ['border-box', 'largeur de la boîte entière (padding + border dedans)', '<b>200px</b> tout compris (contenu réduit à 150px)'],
                 ],
                 'fr' => 'Avec `content-box` (le défaut), `width` ne parle que du contenu : la boîte totale grossit. Avec `border-box`, `width` couvre la boîte complète : padding et border sont déduits de l\'intérieur, et le contenu rapetit pour que ça rentre.'],

                ['type' => 'example',
                 'title' => 'Calcul complet pas à pas',
                 'lang' => 'css',
                 'code' => '.carte {\n  width: 200px;           /* le content fera 200px */\n  padding: 20px;          /* 20px de chaque côté = +40px */\n  border: 3px solid #333; /* 3px de chaque côté = +6px */\n  margin: 10px;           /* extérieur : ne compte pas dans la largeur de la boîte */\n}\n/* content-box : la boîte seule = 200 + 40 + 6 = 246px\n   avec les margin de 10px de chaque côté, l\'espace laissé vwala 266px */',
                 'output' => 'Boîte de 246px de large : 200 de contenu + 40 de padding + 6 de bord.',
                 'explainFr' => 'On additionne : 200 (content) + 40 (padding des deux côtés) + 6 (bord des deux côtés) = 246px. Le margin décolle, mais n\'épaissit pas la boîte.',
                 'explainDarija' => 'Calcul : 200 (content) + 40 (padding dyal 2 côtés) + 6 (border dyal 2 côtés) = 246px. Margin kaydekolli ghir bara, makayzidch f largeur dyal la boîte.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'box-sizing',
            'title' => 'box-sizing : dompter les boîtes',
            'icon'  => '🧮',
            'blocks' => [

                ['type' => 'definition', 'title' => 'box-sizing',
                 'fr'   => '<p><strong>box-sizing</strong> choisit ce que veut dire <code>width</code> :</p><ul><li><code>content-box</code> (défaut) : width = taille du contenu seul ;</li><li><code>border-box</code> : width = taille <em>totale</em> (content + padding + border) — padding et border rentrent dans la taille annoncée.</li></ul>',
                 'darija' => '<p><code>box-sizing</code> kaybeddel l\'ma3na dyal <code>width</code> : b <code>content-box</code> width kat3ni ghir le contenu, b <code>border-box</code> width kat3ni la boîte kamla (padding w border kaydakhlou f dakhelha). Hadak 3lach les développeurs professionnels kaykhdmo dima b border-box.</p>'],

                ['type' => 'syntax', 'lang' => 'css', 'title' => 'Activer border-box partout (convention universelle)',
                 'code' => '/* Convention des pros : border-box sur tout,\n   pour annoncer des tailles de boîtes exactes. */\n*,\n*::before,\n*::after {\n  box-sizing: border-box;\n}'],

                ['type' => 'example',
                 'title' => 'content-box vs border-box — la preuve visuelle',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>box-sizing : content-box vs border-box</title>
<style>
  body { font-family: sans-serif; }
  .conteneur {
    width: 250px;                    /* la page ne fait que 250px de large */
    border: 2px dashed #666;
  }
  .test {
    width: 200px;
    padding: 20px;
    border: 5px solid #e53e3e;
    color: #fff;
    margin-bottom: 10px;
  }
  .cb { box-sizing: content-box; background: #2b6cb0; } /* 250px : déborde */
  .bb { box-sizing: border-box;    background: #38a169; } /* 200px : rentre */
</style>
</head>
<body>
  <div class="conteneur">
    <div class="test cb">content-box → 250px</div>
    <div class="test bb">border-box → 200px</div>
  </div>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Avec content-box, la première boîte mesure 250px et déborde du conteneur. Avec border-box, la seconde tient exactement dans ses 200px : padding et border sont déduits à l\'intérieur.',
                 'explainDarija' => 'Chouf : b content-box la boîte l\'oula kant 250px w khrejet men le conteneur. B border-box la boîte l\'okhra tbqa f 200px kamla : padding w border mkhasrin men dakhel, w le contenu kaysghar bach yrgaa f dakhel.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'applications',
            'title' => 'Applications réelles',
            'icon'  => '🛠️',
            'blocks' => [

                ['type' => 'tip', 'title' => 'Le padding agrandit la zone cliquable',
                 'fr'   => 'Un bouton ou un lien avec <code>padding: 10px 20px</code> se clique plus facilement : le padding devient partie du bouton, donc la zone cliquable s\'élargit.',
                 'darija' => 'Ila 7atteet padding f bouton wala lien, la zone li kayder click fiha l\'utilisateur katziyed kbira — ahssan 3la l\'utilisateur. Had technique kol les sites réels kaykhdmo biha.'],

                ['type' => 'text',
                 'fr'   => '<p>Le box model se combine dans la vraie vie :</p><ul><li><strong>Carte produit</strong> : <code>padding: 16px</code> à l\'intérieur + <code>margin-bottom: 16px</code> entre les cartes + <code>border-radius</code> pour arrondir les angles ;</li><li><strong>Encadré d\'avertissement</strong> : border + padding pour que le texte ne colle pas au cadre ;</li><li><strong>Bouton</strong> : padding horizontal et vertical (+ <code>border: none</code> pour enlever le cadre).</li></ul><p>Et retiens : quand deux <code>margin</code> verticaux se touchent, ils ne s\'additionnent pas — c\'est le plus grand qui gagne (la <strong>fusion des marges</strong>).</p>',
                 'darija' => '<p>F les cas dyal les vrais sites :<br>• <b>Carte produit</b> : padding dakhelha, margin bin les cartes, border-radius bach les coins yrellou chwiya.<br>• <b>Encadré d\'avertissement</b> : border + padding bach le texte ma yqrebch bzaf 3la le cadre.<br>• <b>Bouton</b> : padding horizontal/vertical, ila ma bghitch le cadre dir <code>border: none</code>.<br>Chi 7aja mohimma : ila margin dyal 2 éléments ytmssaw, makayzidouch 7ed 3la 7ed — l\'akbar kayrbe7.</p>'],

                ['type' => 'keywords', 'items' => [
                    ['kw' => 'padding',          'fr' => 'Espace intérieur autour du contenu (peint par le fond).', 'darija' => 'Espace dakhel la boîte, 7da le contenu : le fond kayghattih.'],
                    ['kw' => 'margin',           'fr' => 'Espace extérieur autour de la boîte (transparent).', 'darija' => 'Espace bara la boîte : transparent, kayfesse les éléments binathom.'],
                    ['kw' => 'box-sizing',       'fr' => 'Choisit si width compte aussi padding + border. border-box = le plus pratique.', 'darija' => 'Kayawti wach width kathssb 7ta padding w border. border-box assahel.'],
                    ['kw' => 'border-radius',    'fr' => 'Arrondit les angles de la boîte.', 'darija' => 'Kayqalled les angles (les coins) dyal la boîte.'],
                 ]],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Croire que width: 200px donne une boîte de 200px',
            'fix'    => 'Avec le défaut content-box, la boîte vaut width + padding + border',
            'fr'     => 'Par défaut, <strong>width désigne seulement le contenu</strong>. Avec padding: 20px et border: 5px, la boîte fera 200 + 50 = 250px. Utilisez box-sizing: border-box si vous voulez que width couvre la boîte entière.',
            'darija' => 'Par défaut width kat3ni ghir le contenu. Ila 3andek padding: 20px w border: 5px, la boîte gha tkoun 250px. Bghiti la boîte tkoun 200px w padding w border dakhel fihom? dir <code>box-sizing: border-box</code>.',
        ],
        [
            'wrong'  => 'Confondre padding et margin',
            'fix'    => 'padding = intérieur (peint) | margin = extérieur (transparent)',
            'fr'     => 'Le padding est <em>dans</em> la boîte : son fond le peint. Le margin est <em>hors</em> de la boîte : transparent, il sert à décoller les voisins.',
            'darija' => 'Padding dakhel la boîte (fond kayghattih), margin bara (transparent) kayfesse les éléments 7ed men 7ed.',
        ],
        [
            'wrong'  => 'Oublier body { margin: 0; }',
            'fix'    => 'border : la marge par défaut create un espace blanc',
            'fr'     => 'Le navigateur pose une marge par défaut sur <code>body</code>, <code>p</code>, <code>h1</code>… Cela crée un espace blanc inattendu. On remet tout à zéro avec <code>body { margin: 0; }</code>.',
            'darija' => 'Navigateur kaydir margin par défaut 3la body, p, h1… dak l\'espace blanc makaynach bha9. Dir <code>body { margin: 0; }</code> f lewel bach tna7i had l\'espace.',
        ],
        [
            'wrong'  => 'Mettre padding comme attribut HTML',
            'fix'    => 'padding et margin sont des PROPERTIES CSS',
            'fr'     => 'Padding et margin sont des <strong>propriétés CSS</strong> : ils s\'écrivent dans un sélecteur, ex. <code>p { padding: 20px; }</code>. Un attribut HTML comme <code>&lt;p padding="20"&gt;</code> ne fait rien.',
            'darija' => 'Padding w margin machi attribute f HTML. Khassek tktebhom f CSS : <code>p { padding: 20px; }</code>. Ila ktebtohom f la balise ma kaykhdmo walou.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Box model</b> : tout élément = content + padding + border + margin. Le fond peint le padding (et parfois le border, c\'est son cadre) ; le margin est transparent et décolle les voisins. Avec <code>content-box</code> (défaut), largeur totale = width + padding + border. Avec <code>box-sizing: border-box</code>, width couvre la boîte entière — convention activée partout par <code>* { box-sizing: border-box; }</code>.',
        'darija' => 'Box model : kol élément 3andou 4 couches — content (le contenu : texte wala image), padding (espace dakhel li kayghattih le fond), border (le cadre), margin (espace bara transparent). Par défaut width kat3ni ghir le contenu, donc la boîte katziyed 3lih padding + border. Dir <code>* { box-sizing: border-box; }</code> mn lewel w les calculs kaywliou sahlin.',
    ],
];
