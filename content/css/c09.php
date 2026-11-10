<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 9 : La propriété display
 * Format identique à content/html/c01.php :
 *   lessons[] sections avec blocks[], mistakes[], summary {fr, darija}
 */

return [
    'id'       => 'css-ch9',
    'title'    => 'display : block, inline, inline-block, none',
    'subtitle' => 'La propriété la plus importante de CSS : elle décide comment chaque élément se place sur la page.',

    'objectives' => [
        'Comprendre le rôle de display dans le placement des éléments.',
        'Comparer block, inline et inline-block (largeur, hauteur, saut de ligne).',
        'Utiliser inline-block pour styliser des liens et des boutons.',
        'Masquer un élément avec display: none.',
        'Distinguer display: none de visibility: hidden.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'les-modes',
            'title' => 'Chaque élément a un mode d\'affichage',
            'icon'  => '🧱',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Chaque balise HTML arrive dans le navigateur avec un comportement <code>display</code> par défaut. Ce comportement répond à trois questions : la boîte prend-elle toute la largeur ? accepte-t-elle <code>width</code>/<code>height</code> ? se met-elle à la ligne ?</p><ul><li><strong>block</strong> : la boîte occupe <em>toute la largeur disponible</em> et passe à la ligne. Exemples : <code>div</code>, <code>h1</code>, <code>p</code>, <code>ul</code>.</li><li><strong>inline</strong> : l\'élément coule <em>dans le texte</em>, comme un mot dans une phrase ; <code>width</code> et <code>height</code> sont ignorés. Exemples : <code>span</code>, <code>a</code>, <code>strong</code>.</li><li><strong>inline-block</strong> : le compromis — il reste dans la ligne, mais accepte <code>width</code>, <code>height</code> et <code>padding</code> vertical.</li></ul>',
                 'darija' => '<p>Kol balise HTML katji b comportement <code>display</code> par défaut. Had comportement kayjaweb 3la 3 questions : wach la boîte takhous la largeur kamla ? wach kat9bel <code>width</code>/<code>height</code> ? wach katmchi l\'ligne jdida ?</p><ul><li><strong>block</strong> : la boîte takhous la largeur kamla w katmchi (new line) la ligne jdida. Mital : <code>div</code>, <code>h1</code>, <code>p</code>…</li><li><strong>inline</strong> : katbqa f le texte, comme kelma f une phrase ; <code>width</code> w <code>height</code> walou. Mital : <code>span</code>, <code>a</code>, <code>strong</code>.</li><li><strong>inline-block</strong> : compromis — katbqa f la ligne, walakin kat9bel <code>width</code>, <code>height</code> w <code>padding</code> vertical.</li></ul>'],

                ['type' => 'definition', 'title' => 'display',
                 'fr'   => '<p><strong>display</strong> : propriété CSS qui change le mode d\'affichage d\'un élément (bloc, texte, masqué, flex, grid…). C\'est elle, plus tard, qui commande vos mises en page.</p>',
                 'darija' => '<p><code>display</code> : propriété CSS li katbeddel kifach kaybane l\'élément f la page (bloc, f le texte, mkhfi, flex, grid…). Hiya li katcommandi les mises en page dyalek.</p>'],

                ['type' => 'table',
                 'headers' => ['display', 'Saut de ligne avant/après', 'width / height', 'Largeur par défaut', 'Balises typiques'],
                 'rows' => [
                    ['block', 'oui', 'acceptées', 'toute la largeur du parent (100%)', 'div, h1–h6, p, ul, section'],
                    ['inline', 'non', 'ignorées', 'celle du contenu', 'span, a, strong, em'],
                    ['inline-block', 'non', 'acceptées', 'celle du contenu', 'lien/bouton stylé, badge, image'],
                 ],
                 'fr' => 'Un `div` et un `span` affichent le même contenu mais se comportent tout autrement : c\'est le `display` par défaut qui change. On le modifie à tout moment : `display: …`.'],

                ['type' => 'example',
                 'title' => 'block vs inline : la preuve',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>block vs inline</title>
<style>
  body { font-family: sans-serif; }
  .bloc {
    display: block;
    background: #bfdbfe;
    margin-bottom: 4px;
  }
  .enligne {
    display: inline;
    background: #fde68a;
  }
</style>
</head>
<body>
  <div class="bloc">Je suis block : je prends TOUTE la ligne.</div>
  <div class="bloc">Moi aussi, toujours une ligne pour moi tout seul.</div>
  <p>Un texte où un <span class="enligne">span inline</span> coule dans la ligne,
  comme <span class="enligne">cet autre span</span> : aucun saut, on reste dans la phrase.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Chaque div en block dispose sa propre ligne. Le span inline s\'insère dans le texte sans créer de saut, et ne dépasse jamais son contenu en largeur.',
                 'explainDarija' => 'Chouf : kol div block khoud lijne kaml. Spans inline kadeju taht le texte, makayfenwand walou le ligne ima.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'inline-block',
            'title' => 'inline-block : le compromis qui débloque tout',
            'icon'  => '🤝',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Vous voulez un lien qui ressemble à un <strong>bouton</strong> (padding, couleur, largeur) sans quitter sa ligne ? Passez-le en <code>display: inline-block</code>. C\'est la solution classique, utilisée partout avant flexbox, pour aligner des éléments entre eux.</p>',
                 'darija' => '<p>Bghiti lien chkelou bouton (padding, color, width) w ybqa f ligne ? dir <code>display: inline-block</code>. Hadi l\'méthode classique, kayst3mlouha bzf 9bel flexbox.</p>'],

                ['type' => 'example',
                 'title' => 'Des liens-boutons avec inline-block',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liens en inline-block</title>
<style>
  body { font-family: sans-serif; }
  .btn {
    display: inline-block;
    padding: 10px 18px;
    margin: 4px;
    background: #2b6cb0;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
  }
  .btn:hover { background: #1a365d; }
</style>
</head>
<body>
  <a class="btn" href="#">Accueil</a>
  <a class="btn" href="#">Cours</a>
  <a class="btn" href="#">Exercices</a>
  <a class="btn" href="#">Contact</a>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'inline-block accepte le padding vertical : les boutons ont une vraie hauteur, restent côte à côte sans casser la ligne.',
                 'explainDarija' => 'inline-block kat9bel le padding vertical : les boutons 3andhom hauteur mzyana, kayb9aw jouj à cote 3la 7ed, ma katfassech la ligne. Ila khtebt <code>display: inline</code>, le padding ma kaykhdemch mzyan.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'none-vs-visibility',
            'title' => 'Cacher un élément : none vs visibility: hidden',
            'icon'  => '🙈',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Deux façons de masquer, deux conséquences très différentes :</p><ul><li><code>display: none</code> : l\'élément <strong>disparaît complètement</strong> — il ne prend <em>aucune place</em>, comme s\'il n\'existait pas.</li><li><code>visibility: hidden</code> : l\'élément est <strong>invisible mais garde sa place</strong> : un trou vide à son emplacement.</li></ul>',
                 'darija' => '<p>Jouj dyal les masques, w kol wa7d 3andou résultat mokhtalef :</p><ul><li><code>display: none</code> : l\'élément <strong>kayghib tamamen</strong> — ma kayakhod la place walou, kaybano kayn walou.</li><li><code>visibility: hidden</code> : l\'élément <strong>invisible walakin la place dyalo katb9a</strong> : kaybqa le vide fih.</li></ul>'],

                ['type' => 'table',
                 'headers' => ['', 'display: none', 'visibility: hidden'],
                 'rows' => [
                    ['Élément visible ?', 'non, totalement disparu', 'non, invisible mais réservé'],
                    ['Place dans la page', 'libérée (les voisins montent)', 'conservée (trou vide)'],
                    ['Usage typique', 'menus qui s\'ouvrent et se ferment, onglets', 'contenu préparé à l\'avance'],
                 ],
                 'fr' => '`display: none` libère l\'espace : le reste de la page se recroqueville. `visibility: hidden` garde l\'emplacement : tout reste comme avant, seul l\'élément est invisible.'],

                ['type' => 'example',
                 'title' => 'Comparer les deux masquages',
                 'lang' => 'css',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>display:none vs visibility:hidden</title>
<style>
  body { font-family: sans-serif; }
  .carte {
    width: 200px;
    border: 2px solid #276749;
    background: #c6f6d5;
    display: inline-block;
    vertical-align: top;
    padding: 10px;
  }
  .disparu   { display: none; }
  .invisible { visibility: hidden; }
</style>
</head>
<body>
  <div class="carte">Carte A</div>
  <div class="carte invisible">Carte B (visibility: hidden)</div>
  <div class="carte">Carte C — la case vide occupe la place de B</div>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Regardez : le trou blanc à la place de la Carte B prouve que visibility: hidden garde la place. Avec display: none, la carte suivante serait venue remplir cet espace.',
                 'explainDarija' => 'Chouf : le vide li fo9 la carte B kaybano khawya — hadi <code>visibility: hidden</code> : la place b9at. Aken hadi kanet <code>display: none</code>, la carte lli mratiha gha ttella3 bach t3ammer had la place.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Donner width/height à un élément inline',
            'fix'    => 'inline ignore width et height → utiliser display: inline-block',
            'fr'     => 'Un <code>span</code> par défaut est <strong>inline</strong> : <code>width</code> et <code>height</code> n\'ont aucun effet. Passez-le en <code>display: inline-block</code> pour pouvoir le dimensionner.',
            'darija' => '<code>span</code> par défaut inline : <code>width</code> w <code>height</code> ma kayhreso walou. Dir <code>display: inline-block</code> bach tqder te dimensionner.',
        ],
        [
            'wrong'  => 'Padding vertical sur un élément inline',
            'fix'    => 'Sur inline le padding vertical déborde sans faire grandir la ligne → inline-block',
            'fr'     => 'Sur un élément inline, le padding vertical <em>déborde sans pousser la ligne</em> : il chevauche les voisins. <code>inline-block</code> règle le problème en donnant une vraie hauteur.',
            'darija' => 'F inline, le padding vertical kaykhrjj men la ligne w kayghatti les éléments li 7dah. <code>inline-block</code> kay7ell le mochkil w kay3tik hauteur mzyana.',
        ],
        [
            'wrong'  => 'Croire que display: none « efface » pour de bon',
            'fix'    => 'L\'élément reste dans le code HTML : display gère l\'AFFICHAGE, pas la sécurité',
            'fr'     => '<code>display: none</code> masque visuellement : l\'élément est toujours dans le code source, visible dans l\'inspecteur, et lisible si CSS est désactivé. Ne cachez jamais un secret avec !',
            'darija' => '<code>display: none</code> kaykhebbi ghir fl\'affichage : l\'élément b9a f code, kaybano f l\'inspecteur, w yqder ybano ila CSS tna7at. Matkhebbich biha chi secret !',
        ],
        [
            'wrong'  => 'Un espace fantôme entre des inline-block',
            'fix'    => 'Le retour à la ligne du HTML crée un mini-espace : coller les balises ou passer à flexbox',
            'fr'     => 'Entre deux <code>inline-block</code>, l\'espace (retour à la ligne) du code HTML devient un petit espace visible. Astuce : écrire les éléments côte à côte sans saut, ou utiliser flexbox (chapitre 11).',
            'darija' => 'Bin 2 inline-block, le retour à la ligne f HTML kaywli petite espace bayna. Kteb les balises me3louj binathom (bla saut), wala st3ml flexbox (chapitre 11).',
        ],
    ],

    'summary' => [
        'fr'     => '<b>display</b> dicte comment l\'élément se place : <code>block</code> prend toute la largeur et passe à la ligne, <code>inline</code> coule dans le texte sans width/height, <code>inline-block</code> combine les deux avantages. <code>display: none</code> fait disparaître l\'élément et libère sa place ; <code>visibility: hidden</code> le rend invisible tout en gardant son emplacement.',
        'darija' => '<b>display</b> kaygoul l\'élément kifach kaybane : <code>block</code> kayakhod la largeur kamla w katmchi l\'ligne jdida, <code>inline</code> katbqa f le texte w ma kat9belch width/height, <code>inline-block</code> katjma3 bin les deux. <code>display: none</code> kaykhebbi l\'élément w katgel la place dyalo ; <code>visibility: hidden</code> kaykellih invisible walakin la place dyalo b9at khawya.',
    ],
];
