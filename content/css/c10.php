<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 10 : La propriété position
 * Format identique à content/html/c01.php :
 *   lessons[] sections avec blocks[], mistakes[], summary {fr, darija}
 */

return [
    'id'       => 'css-ch10',
    'title'    => 'position : static, relative, absolute, fixed, sticky',
    'subtitle' => 'Positionner un badge, coller une navbar, empiler des calques : le pouvoir de position et z-index.',

    'objectives' => [
        'Connaître le comportement par défaut : position: static.',
        'Décaler un élément avec position: relative (top, left…).',
        'Ancrer un élément avec position: absolute par rapport à un parent positionné.',
        'Coller une barre avec position: fixed ou sticky.',
        'Contrôler l\'ordre des calques avec z-index.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'static-relative',
            'title' => 'static (la valeur par défaut) et relative',
            'icon'  => '📍',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><strong>static</strong> : valeur par défaut. L\'élément suit le flux normal : pas de <code>top</code>/<code>left</code>, pas d\'effet au sujet du positionnement.</p><p><strong>relative</strong> : l\'élément reste <em>dans le flux</em> (il garde sa place logique) mais on peut le <strong>décaler</strong> visuellement avec <code>top</code>, <code>right</code>, <code>bottom</code>, <code>left</code>. Le décalage se mesure par rapport à <em>lui-même</em> : <code>top: 20px</code> le pousse de 20px vers le bas.</p>',
                 'darija' => '<p><strong>static</strong> : hadi l\'valeur par défaut. L\'élément kaymshi m3a le flux normal (kaytabya b9awach men ba3d li 9bli), ma9dinachhoto top/left.</p><p><strong>relative</strong> : l\'élément dyalo b9a f le flux (la place dyalo b9at), walakin tqder tdecale bel <code>top</code>, <code>right</code>, <code>bottom</code>, <code>left</code>. Le décalage kayhseb men raso : <code>top: 20px</code> katkherj l\'ta7t b 20px.</p>'],

                ['type' => 'definition', 'title' => 'position: relative',
                 'fr'   => '<p>Positionnement <strong>relatif à sa position normale</strong> : le voisinage ne se déplace pas, l\'élément glisse par-dessus (et laisse un trou à sa place d\'origine).</p>',
                 'darija' => '<p><strong>position: relative</strong> : le décollage kaydir nisba l\'la place normale dyalo. Les voisins makaytahrkou walou, w f la place dyalo dyale kaybqa vide.</p>'],

                ['type' => 'example',
                 'title' => 'Décaler une boîte avec relative',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>position: relative</title>
<style>
  body { font-family: sans-serif; }
  .boite {
    width: 160px;
    padding: 12px;
    margin-bottom: 8px;
    background: #bfdbfe;
    border: 2px solid #2b6cb0;
  }
  .decale {
    position: relative;
    top: 20px;
    left: 30px;
    background: #fbb6ce;
    border-color: #be185d;
  }
</style>
</head>
<body>
  <div class="boite">Boîte 1 (normal)</div>
  <div class="boite decale">Boîte 2 : relative + top/left</div>
  <div class="boite">Boîte 3 (normal)</div>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'La boîte rose glisse de 30px à droite et de 20px en bas, mais la boîte 3 continue de se placer comme si la boîte 2 était encore à sa place : relative laisse un trou.',
                 'explainDarija' => 'La boîte l\'hmera mkherijin 30px le droite w 20px ta7t, walakin la boîte 3 katmchi had la place comme yla b9at fiha. Hadi khueytat dyal relative.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'absolute',
            'title' => 'absolute : se positionner selon le parent',
            'icon'  => '🎯',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Avec <code>position: absolute</code>, l\'élément <strong>sort du flux</strong> : il se cale sur son <strong>parent positionné</strong> le plus proche — celui dont <code>position</code> vaut <code>relative</code>, <code>absolute</code>, <code>fixed</code> ou <code>sticky</code>. S\'il n\'en a aucun, il se cale sur toute la page.</p><p>Recette classique du badge : <code>parent position: relative</code> + <code>enfant position: absolute</code> + <code>top/left</code> (ou <code>top/right</code>) pour le coller à un coin.</p>',
                 'darija' => '<p>B <code>position: absolute</code>, l\'élément <strong>kaykhruj men le flux</strong> : kaytir 3la <strong>ajdat les positions</strong> dyal l\'position: relative, walakin ay l\'position 7ta anchors dyal la page. Mat9balch (top/left walou) → 9bel dyal la page.</p><p>As-Sour9 dyal badge : <code>parent position: relative</code> + <code>child position: absolute</code> + <code>top/left</code> bach yhrig f corner.</p>'],

                ['type' => 'definition', 'title' => 'Le parent positionné',
                 'fr'   => '<p><strong>Parent positionné :</strong> le plus proche ancêtre dont <code>position</code> est <code>relative</code>, <code>absolute</code>, <code>fixed</code> ou <code>sticky</code>. <code>static</code> (le défaut) ne compte pas. D\'où l\'habitude de mettre <code>position: relative</code> sur le conteneur.</p>',
                 'darija' => '<p><strong>Parent positionné :</strong> a9reb ancêtre 3andou <code>position</code> machi static (relative, absolute, fixed wala sticky). Sets l\'awayl : dir <code>position: relative</code> 3la le conteneur dyalek.</p>'],

                ['type' => 'example',
                 'title' => 'Un badge dans le coin d\'une carte',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Badge positionné en absolu</title>
<style>
  body { font-family: sans-serif; }
  .carte {
    position: relative;       /* le parent devient la référence */
    width: 260px;
    margin: 40px auto;
    padding: 16px;
    border: 2px solid #2b6cb0;
    border-radius: 8px;
    background: #eff6ff;
  }
  .badge {
    position: absolute;       /* positionné par rapport à .carte */
    top: -12px;
    right: -12px;
    background: #e53e3e;
    color: #fff;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
  }
</style>
</head>
<body>
  <div class="carte">
    <span class="badge">NOUVEAU</span>
    <h3>Formation CSS</h3>
    <p>14 chapitres, des exercices et des quiz.</p>
  </div>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Le badge se cale sur la carte (son parent positionné) ; les valeurs négatives de top/right le font dépasser du coin, pour un effet de vignette.',
                 'explainDarija' => 'le badge kaytir 3la la carte (parente positionné) : top/right negatifs kadirou ta9t le corner (tan3 ra9).'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'fixed-sticky',
            'title' => 'fixed et sticky : barres qui collent',
            'icon'  => '📌',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><strong>fixed</strong> : l\'élément se cale sur la <strong>fenêtre du navigateur</strong> (viewport) et y reste, même pendant le scroll. Idéal pour une navbar toujours visible. Attention : il quitte le flux, le contenu peut passer dessous → on compense avec un <code>padding-top</code> sur <code>body</code>.</p><p><strong>sticky</strong> : l\'élément se comporte comme <code>relative</code>… jusqu\'à ce qu\'on atteigne le seuil (<code>top: 0</code>) : là il <strong>colle</strong> et reste en place pendant le scroll. Très utilisé pour les en-têtes de tableau ou une barre de menu latérale.</p>',
                 'darija' => '<p><strong>fixed</strong> : l\'élément kaytir 3la <strong>fenêtre dyal navigateur</strong> (viewport) w kaybqa 3lacha men scroll. Mital : navbar dima bayna. Attention : kaykhrjj men le flux, donc le contenu yqder passi ta7to — dir <code>padding-top</code> 3la <code>body</code>.</p><p><strong>sticky</strong> : kaykhdem comme <code>relative</code>… 7ta Twassal le seuil (<code>top: 0</code>) : 3la had sanal kaycool, kaybqa f blassa. Katst3mlo bzf f header dyal tableau wala barre latérale.</p>'],

                ['type' => 'definition', 'title' => 'fixed vs sticky',
                 'fr'   => '<p><strong>fixed :</strong> toujours collé au viewport, ne bouge jamais.<br><strong>sticky :</strong> suit le flux d\'abord, puis se colle au seuil demandé quand on le dépasse.</p>',
                 'darija' => '<p><strong>fixed :</strong> kolchi pertaining le viewport, ma katgharhach.<br><strong>sticky :</strong> f lewel kaymachete (takhdem comme relative), men lew9t li kas dexegearo le seuil kayconglue.</p>'],

                ['type' => 'example',
                 'title' => 'Navbar fixed + contenu normal',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Navbar fixed</title>
<style>
  body {
    margin: 0;
    font-family: sans-serif;
    padding-top: 60px;    /* compense la hauteur de la navbar */
  }
  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: #1a365d;
    color: #fff;
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 10;
  }
</style>
</head>
<body>
  <nav class="navbar">WebAcademy</nav>
  <h1>Titre de la page</h1>
  <p>Défilez : la navbar reste collée en haut de la fenêtre.</p>
  <p style="margin-top: 800px;">Bas de la page — navbar toujours visible.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'La navbar est fixée aux trois coordonnées (top/left/right) : elle couvre toute la largeur du viewport et reste visible au scroll.',
                 'explainDarija' => 'La navbar mchita f 3 ineh (top, left, right) : ghitelle la largeur kamla dyal la fenêtre w dima bayna men le scroll.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'z-index',
            'title' => 'z-index : l\'ordre des calques',
            'icon'  => '🥞',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Quand deux éléments positionnés se chevauchent, qui est au-dessus ? Par défaut, l\'ordre du code HTML (le dernier gagne). Pour trancher : <code>z-index</code> — plus la valeur est grande, plus l\'élément est au-dessus (+ une infinité de négatif possible mais rarement utile).</p>',
                 'darija' => '<p>Mlin jouj éléments positionnés ytsghato (chevauchema), chkoun fo9 ? Par défaut, l\'ordre f li kaybda le code (l\'l’Aakhir kayrbe7). Bach tirebelha : <code>z-index</code> — la valeur kbira kat3ni au-dessus.</p>'],

                ['type' => 'definition', 'title' => 'z-index',
                 'fr'   => '<p><strong>z-index :</strong> entier qui ordonne les éléments <em>positionnés</em> quand ils se chevauchent. Ne fonctionne <strong>que</strong> sur des éléments avec <code>position</code> ≠ static (ou en flex/grid avec <code>z-index</code> accepté).</p>',
                 'darija' => '<p><strong>z-index :</strong> nombre kamel kay rate le tartib dyal les éléments <em>positionnés</em>. Ma kaykhdemch 3la élément static ! Khassek 3lih <code>position: relative</code> wala absolute…</p>'],

                ['type' => 'tip', 'title' => 'Astuce la plus courante',
                 'fr'   => 'Votre <code>z-index: 999</code> ne marche pas ? Votre élément est probablement <code>static</code>. Ajoutez d\'abord <code>position: relative</code> (ou autre) puis le z-index.',
                 'darija' => 'Ila <code>z-index</code> ma khadmach, ta9riban l\'élément static. Zid <code>position: relative</code> men 9bel, mn ba3d z-index.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'position: absolute « ne marche pas » sur mon élément',
            'fix'    => 'Il se cale sur le parent positionné le plus proche : ajoutez position: relative au parent',
            'fr'     => 'Sans aucun ancêtre positionné, un élément <code>absolute</code> se cale sur <code>body</code> (toute la page). Donnez au parent voulou <code>position: relative</code> pour l\'y ancrer.',
            'darija' => 'Ila ma kaynach ancêtre positionné, l\'élément <code>absolute</code> kaytir 3la <code>body</code>. Dir <code>position: relative</code> 3la parent li bghit.',
        ],
        [
            'wrong'  => 'position: fixed et le contenu passe dessous',
            'fix'    => 'fixed sort du flux : compensé par body { padding-top: 60px; }',
            'fr'     => 'Un élément <code>fixed</code> ne pousse pas le contenu : la navbar le recouvre. On compense en ajoutant au <code>body</code> un <code>padding-top</code> au moins égal à la hauteur de la barre.',
            'darija' => 'l\'élément <code>fixed</code> ma kadespoch le contenu : nav katghate 3lih. Zid <code>padding-top</code> 3la <code>body</code> (b7a9 hauteur la barre).',
        ],
        [
            'wrong'  => 'z-index sur un élément static',
            'fix'    => 'z-index ignoré → ajouter d\'abord position: relative (absolue, fixe…)',
            'fr'     => '<code>z-index</code> est ignoré sur les éléments <code>static</code>. L\'élément doit être positionné pour participer à l\'empilement.',
            'darija' => '<code>z-index</code> ma kaykhdemch 3la <code>static</code>. Khassek l\'élément ykon 3andou position bach ymchi l\'calques.',
        ],
        [
            'wrong'  => 'position: relative sans top/left',
            'fix'    => 'relative seul ne décale rien : il prépare juste un repère',
            'fr'     => '<code>position: relative</code> sans <code>top</code>/<code>left</code>/<code>right</code>/<code>bottom</code> ne décale rien : il sert surtout de repère pour les enfants en <code>absolute</code>.',
            'darija' => '<code>relative</code> bla <code>top</code>/<code>left</code> ma kaydécali walou ; kaydir ghir repère l les enfants li fihom <code>absolute</code>.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>position</b> — <code>static</code> (défaut, flux normal), <code>relative</code> (décalage depuis sa place, le voisinage ne bouge pas), <code>absolute</code> (se cale sur le parent positionné le plus proche, sort du flux), <code>fixed</code> (calé sur la fenêtre, immobile au scroll), <code>sticky</code> (suit le flux puis colle au seuil). <b>z-index</b> ordonne les calques, et ne fonctionne que sur des éléments positionnés.',
        'darija' => '<b>position</b> — <code>static</code> (par défaut), <code>relative</code> (décale mn raso w la place b9at), <code>absolute</code> (kaytir 3la parent positionné a9rb, khruj men flux), <code>fixed</code> (kaytir 3la la fenêtre, immobile), <code>sticky</code> (kaymchi b le flux men ba3d kaycongle f seuil). <b>z-index</b> kayrate tartib les calques, w ma khadamach bla position.',
    ],
];
