<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 3 : Balises de texte et mise en valeur
 * h1-h6 (hiérarchie sémantique), p, br, hr, strong vs b, em vs i,
 * u, mark, sup, sub, del — avec accessibilité et cas d'usage.
 * Types de blocs utilisés :
 *   text | definition | syntax | example (preview) | note/tip/warning | table | keywords
 */

return [
    'id'       => 'html-ch3',
    'title'    => 'Balises de texte et mise en valeur',
    'subtitle' => 'Titres, paragraphes et balises de mise en valeur : structurer un texte lisible et accessible.',

    'objectives' => [
        'Utiliser les titres h1 à h6 dans une hiérarchie cohérente.',
        'Écrire des paragraphes avec p, br et hr aux bons endroits.',
        'Choisir entre strong/b et em/i selon le sens, pas l\'apparence.',
        'Utiliser u, mark, sup, sub et del à bon escient.',
        'Comprendre l\'impact des définitions sur l\'accessibilité.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'titres-h1-h6',
            'title' => 'Les titres : h1 à h6',
            'icon'  => '🔠',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les balises <code>h1</code> à <code>h6</code> créent des <strong>titres</strong> de niveau décroissant : <code>h1</code> est le titre principal de la page, <code>h2</code> les grandes parties, <code>h3</code> les sous-parties, et ainsi de suite jusqu\'à <code>h6</code>. Ensemble, elles forment le <strong>plan du document</strong>, comme la table des matières d\'un livre.</p>',
                 'darija' => '<p>Les balises <code>h1</code> 7ta <code>h6</code> kaydiro les titres : <code>h1</code> howa le titre principal dyal la page, <code>h2</code> les grandes parties, <code>h3</code> les sous-parties, w hakka mezyan 7ta <code>h6</code>. Bjouj kaydiro le <strong>plan du document</strong> : bhal sommaire dyal ktab.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Les six niveaux de titres',
                 'code' => '<h1>Titre principal de la page</h1>
<h2>Grande partie</h2>
<h3>Sous-partie</h3>
<h4>Sous-sous-partie</h4>
<h5>Titre cinq</h5>
<h6>Titre six</h6>'],

                ['type' => 'example',
                 'title' => 'Un article bien structuré',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Guide du réseau</title>
</head>
<body>
  <h1>Guide du réseau : bien débuter</h1>
  <h2>Ce qu\'il faut savoir avant de brancher</h2>
  <p>Un peu de vocabulaire : port, câble, étiquette.</p>
  <h2>Brancher le routeur</h2>
  <h3>Étape 1 : le câble</h3>
  <p>Brancher le câble dans le port WAN.</p>
  <h3>Étape 2 : le témoin</h3>
  <p>Vérifiez que le témoin clignote en vert.</p>
</body>
</html>',
                 'output' => 'Un titre principal h1, deux parties h2, et deux étapes h3, chacun suivi d\'un paragraphe.',
                 'preview' => true,
                 'explainFr' => 'La page suit une hiérarchie claire : h1 (page), h2 (parties), h3 (étapes). Le navigateur dessine chaque titre plus petit que le précédent, mais le sens reste le même : ce sont des titres.',
                 'explainDarija' => 'Fhad la page kayn tartib khuyan : h1 (titre dyal page), h2 (grandes parties), w h3 (les étapes). Le navigateur kayrsem kol titre sghir chwiya mn li 9blo, walakin le sens mkhalif : kolchi homa des titres, le plan dyal la page.'],

                ['type' => 'warning',
                 'title' => 'Un seul h1 et un ordre logique',
                 'fr'   => '<p>Deux règles d\'or : <strong>un seul h1 par page</strong> (c\'est le titre de toute la page, pas d\'un paragraphe), et <strong>ne sautez pas de niveau</strong> : après h2, utilisez h3 ; ne passez pas directement à h4. Sauter un niveau casse le plan du document.</p>',
                 'darija' => '<p>Jouj les regles mohimmin : <strong>wa7d h1 pol page</strong> (howa titre dyal la page kamla, machi dyal paragraphe), w <strong>matdouzch 3la les niveaux</strong> : ba3d h2, ktb h3 ; ma tkhrebch nichan l h4. Ila douzti 3la wa7d niveau, le plan dyal la page kaytksr.</p>'],

                ['type' => 'text',
                 'fr'   => '<p>Les titres ne sont pas une décoration. Pour un <strong>lecteur d\'écran</strong> (outil des personnes non voyantes), naviguer dans une page, c\'est sauter de titre en titre comme dans une table des matières. Ne choisissez jamais un <code>h2</code> parce qu\'il est « joli » : choisissez-le parce que le texte est <em>réellement</em> un titre de partie. Le style visuel se règle en CSS, jamais dans le HTML.</p>',
                 'darija' => '<p>Les titres machi decoration. Lecteur d\'écran (outil dyal les personnes ma kaychfouch) kay9ra la page b les titres : kayjebbed mn titre l titre bhal sommaire. Machi 3lach bach takhtar <code>h2</code> 7it kay9tel (be3 : kat9tab). Khtar <code>h2</code> 7it had text b rasseha titre dyal partie. Le style ka-y-vient mn CSS, machi mn HTML.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'p-br-hr',
            'title' => 'Paragraphes, sauts de ligne et filets',
            'icon'  => '¶',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La balise <code>p</code> encadre un <strong>paragraphe</strong> : un bloc de texte qui commence sur une nouvelle ligne et laisse un espace vertical au-dessus et en dessous. C\'est la balise la plus utilisée du Web pour le texte courant.</p>',
                 'darija' => '<p>La balise <code>p</code> katled wa7d <strong>paragraphe</strong> : un bloc de texte kaybdel line, w kaykhali espace vertical fou9ha w te9tha. Hia la balise li kante3mul bzaf nta f le texte.</p>'],

                ['type' => 'example',
                 'title' => 'Paragraphes, br et hr en action',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Carnet de voyage</title>
</head>
<body>
  <h2>Carnet de voyage</h2>
  <p>Nous sommes arrivés à Fès en fin de journée.</p>
  <p>L\'adresse complète est :<br>Rue Talaa Kebira, 12<br>Fès Medina</p>
  <hr>
  <p>Demain : visite de la tannerie.</p>
</body>
</html>',
                 'output' => 'Deux paragraphes séparés par un espace ; l\'adresse tient sur trois lignes grâce à br ; un filet horizontal finit la page.',
                 'preview' => true,
                 'explainFr' => 'p crée un paragraphe (espace avant/après), br passe à la ligne <em>à l\'intérieur</em> du paragraphe (idéal pour une adresse), et hr trace un filet de séparation entre deux parties.',
                 'explainDarija' => '<code>p</code> kaydem wa7d paragraphe (espace fo9 w te9t). <code>br</code> katdir ghi retour a la line jdida f daw balise, bach tkdour des liens b wahdi fimma (bhal adresse), w <code>hr</code> katdesen wa7d filet horizontal bin les parties.'],

                ['type' => 'note',
                 'title' => 'br : avec modération',
                 'fr'   => '<p><code>br</code> est destiné aux <em>vrais</em> retours à la ligne : adresse postale, vers, numéro de téléphone. Il ne sert <strong>jamais</strong> à espacer deux paragraphes : deux <code>p</code> consécutifs le font déjà naturellement.</p>',
                 'darija' => '<p><code>br</code> st3mlha ghi mn les retours dyal line li kayde3bh Jes : adresse, poème, numéro dyal télé. Ma okhe9 bach tkhreb des paragraphes : had les paragraphes kaynmelou bhad <code>p</code>.</p>'],

                ['type' => 'text',
                 'fr'   => '<p>La balise <code>hr</code> (<em>horizontal rule</em>) trace un <strong>filet de séparation</strong> thématique : fin d\'une section, changement de sujet. Elle est <em>auto-fermante</em> : pas de <code>&lt;/hr&gt;</code>.</p><p>Attention : appuyer deux fois sur Entrée dans l\'éditeur ne crée <em>rien</em> en HTML — les sauts de ligne invisibles du code deviennent un simple espace dans la page.</p>',
                 'darija' => '<p>La balise <code>hr</code> katdrew 7dra wa7d filet horizontal f la page : kayn fih fin dyal section, w changement de sujet. Hia balise auto-fermante (ghir &lt;hr&gt; wla &lt;/hr&gt;). W d3ell mettes dir : dir deux fois Entrée f l\'éditeur makaydirch walou f la page.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'strong-b-em-i',
            'title' => 'Mise en valeur : strong vs b, em vs i',
            'icon'  => '🎯',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Cette section répond aux questions du chapitre : quand utiliser <code>strong</code> plutôt que <code>b</code>, <code>em</code> plutôt que <code>i</code> ? Visuellement, elles se ressemblent. La différence est dans le <strong>sens</strong> : les balises <code>strong</code> et <code>em</code> disent <em>que</em> ce texte est important ; les balises <code>b</code> et <code>i</code> disent seulement <em>comment</em> il doit être dessiné.</p>',
                 'darija' => '<p>Hna ghanjibou les questions dyal had chapter : hin nste9mel <code>strong</code> yh f <code>b</code>, <code>em</code> yh f <code>i</code> ? Kaybano bhal bhal f affichage, walakin la difference howa le <strong>sens</strong> : <code>strong</code> w <code>em</code> kaygolo « had texte mohim », <code>b</code> w <code>i</code> kaygolo ghi « kayen texte f blou kettr ».'],

                ['type' => 'definition', 'title' => 'strong vs b',
                 'fr'   => '<p><strong>strong</strong> : ce texte est <em>important</em> — une alerte, un avertissement, une consigne critique (affiché en gras par défaut). <strong>b</strong> : mettre en gras <em>visuellement</em>, sans importance ajoutée : le nom d\'un produit dans un catalogue, par exemple.</p>',
                 'darija' => '<p><strong>strong</strong> : had le texte <em>mohim bkol 7al</em> — alerte, avartissement, consi khass tkhreb (kayban en gras par défaut). <strong>b</strong> : ghi style — kayder ktob ghi bach ybano 3la les autres des mots, bhal smit produit f catalogue, machi 7it mohim.</p>'],

                ['type' => 'definition', 'title' => 'em vs i',
                 'fr'   => '<p><strong>em</strong> (emphase) : <em>insister</em> en lisant ce texte — dans « je n\'ai dit cela à personne », on insiste sur « personne ». <strong>i</strong> : italique <em>sans insistance</em> : mot en langue étrangère, titre d\'œuvre, pensée intérieure.</p>',
                 'darija' => '<p><strong>em</strong> (emphase) : <em>insistance</em> en la lecture (9adech kat9ra had texte, kadir fok les Wejd, bhal « je n\'ai dit cela à personne », on insiste sur « personne »). <strong>i</strong> : italique ghi style : kelme en langue étrangère, titre d\'œuvre, pensée qui jdouat ’ la tête.’'],
                
                ['type' => 'example',
                 'title' => 'La bonne balise au bon endroit',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Regles de mise en valeur</title>
</head>
<body>
  <h2>Consignes de l\'examen</h2>
  <p><strong>Attention :</strong> le téléphone est strictement interdit.</p>
  <p>Le nom du produit est <b>Smart Watch X200</b>.</p>
  <p>Tout le monde doit <em>signer</em> la feuille de présence.</p>
</body>
</html>',
                 'output' => 'Une alerte en gras (strong), un nom de produit en gras sans importance (b), une insistance en italique (em).',
                 'preview' => true,
                 'explainFr' => 'Ici, strong signale une interdiction réelle, em insiste sur une consigue, et b reste un outil de style pour le nom du produit.',
                 'explainDarija' => 'Hna : strong kay9dar une interdiction (khass tbna), em kaydir une insistance f les consignes de classe, w b ghi style dyal smit produit.'],

                ['type' => 'table',
                 'headers' => ['Balise', 'Apparence', 'Sens / accessibilité', 'Quand l\'utiliser'],
                 'rows' => [
                    ['strong', 'Gras', 'Importance forte, lue avec insistance', 'Alertes, consignes critiques'],
                    ['b', 'Gras', 'Aucun sens : attire l\'œil', 'Mots-clés, noms de produits'],
                    ['em', 'Italique', 'Insistance en lecture', 'Insister sur un mot précis'],
                    ['i', 'Italique', 'Aucun sens : style penché', 'Mot étranger, titre, terme technique'],
                 ],
                 'fr' => 'Règle d\'or : <strong>strong/em</strong> quand le <em>sens</em> compte, <strong>b/i</strong> quand seul l\'<em>œil</em> compte.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'u-mark-sup-sub-del',
            'title' => 'Autres balises : u, mark, sup, sub, del',
            'icon'  => '🛠️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Cinq autres balises complètent la boîte à outils du texte :</p><ul><li><code>u</code> : souligné, pour une <em>annotation</em> (mot mal orthographié, correction) ;</li><li><code>mark</code> : surligné comme au feutre jaune — attire l\'œil sur un passage ;</li><li><code>sup</code> : exposant — 2<sup>3</sup> ;</li><li><code>sub</code> : indice — H<sub>2</sub>O ;</li><li><code>del</code> : texte supprimé (barré) — ancien prix en promo.</li></ul>',
                 'darija' => '<p>5 balises okhrin kaytmmou la boite a outill dyal le texte :</p><ul><li><code>u</code> : souligné — des annotations (kelme ghaleth, correction) ;</li><li><code>mark</code> : mtl le feutre jaune — kayjbed l\'œil sur wa7d passage ;</li><li><code>sup</code> : exposant — like 2 puissance 3 ;</li><li><code>sub</code> : indice — bhal H2O ;</li><li><code>del</code> : texte barré — old prix en solde.</li></ul>'],

                ['type' => 'example',
                 'title' => 'Fiche produit qui les utilise toutes',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiche - Clavier mecanique</title>
</head>
<body>
  <h2>Clavier mécanique RGB</h2>
  <p>Prix : <del>399 MAD</del> <strong>299 MAD</strong> <mark>-25 %</mark></p>
  <p>Surface : 100 cm<sup>2</sup></p>
  <p>Note du correcteur : <u>relire le descriptif</u></p>
</body>
</html>',
                 'output' => 'Ancien prix barré, nouveau prix en gras, mention surlignée, exposant 2, et une note soulignée.',
                 'preview' => true,
                 'explainFr' => 'Chaque balise a sa spécialité : del barre l\'ancien prix, mark attire l\'œil sur la promo, sup/sub gèrent exposants et indices, u marque une annotation.',
                 'explainDarija' => 'Kol balise 3andha wajba : del katbarré l$ancien prix, mark katbayan la promo (surlignage), sup/sub 3lach exposant w indice, w u katdir annotation dyal correcteur.'],

                ['type' => 'table',
                 'headers' => ['Balise', 'Effet visuel', 'Cas d\'usage typique'],
                 'rows' => [
                    ['u', 'Souligné', 'Annotation, faute à corriger'],
                    ['mark', 'Surligné jaune', 'Passage important dans une citation'],
                    ['sup', 'Exposant', 'Puissances, notes de bas de page'],
                    ['sub', 'Indice', 'Formules chimiques, indices'],
                    ['del', 'Barré', 'Prix barré, texte remplacé'],
                 ],
                 'fr' => 'Ces cinq balises sont utilisées ponctuellement, mais elles changent tout dans une fiche produit ou un article scientifique.'],

                ['type' => 'keywords',
                 'items' => [
                    ['kw' => 'h1…h6', 'fr' => 'Titres hiérarchiques du document', 'darija' => '6 titres : h1 kbir, h6 sghir'],
                    ['kw' => '<p>', 'fr' => 'Paragraphe, bloc de texte courant', 'darija' => 'Paragraphe dyal texte'],
                    ['kw' => '<br>', 'fr' => 'Saut de ligne, balise auto-fermante', 'darija' => 'Retour à la line, ghi bhad une balise, ma kaynach /br'],
                    ['kw' => '<hr>', 'fr' => 'Filet de séparation thématique', 'darija' => '7dra horizontale, séparation bin les parties'],
                    ['kw' => 'strong vs b', 'fr' => 'Importance (sens) vs gras (style)', 'darija' => 'strong = sens (mohim), b = style ghi'],
                    ['kw' => 'em vs i', 'fr' => 'Insistance (sens) vs italique (style)', 'darija' => 'em = sens (insister), i = style ghi'],
                    ['kw' => 'mark', 'fr' => 'Texte surligné', 'darija' => 'Surligné bhal le feutre jaune'],
                    ['kw' => 'del', 'fr' => 'Texte supprimé, barré', 'darija' => 'Barré (kayban ghouli, supprimé)'],
                 ],
                 'fr' => 'Les balises de ce chapitre en un coup d\'œil.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser h3 ou h4 juste pour rendre le texte plus petit',
            'fix'    => 'Les titres suivent la hiérarchie du document ; le style se règle en CSS',
            'fr'     => 'h1-h6 décrivent la <strong>structure</strong>, pas la taille. Un lecteur d\'écran et un moteur de recherche construisent le plan de la page avec elles.',
            'darija' => 'h1-h6 3andhom le sens dyal structure, machi la taille dyal la police. les mooteurs de recherche w les lecteurs kaydir le plan ayb les titres hiérarchiques.',
        ],
        [
            'wrong'  => 'Mettre strong partout dans le texte',
            'fix'    => 'strong réservé au contenu réellement important',
            'fr'     => 'Si tout est important, rien ne l\'est : réserver strong aux vraies alertes donne du poids à ces alertes.',
            'darija' => 'Ila kolchi mohim, walou kayn bhasil mohim. L\'impact kayjeb les a3mal 3ln chaque <strong>strong</strong>, hadi ba3da kaydibne.',
        ],
        [
            'wrong'  => 'Espacer les paragraphes avec deux br',
            'fix'    => 'Deux paragraphes successifs = deux balises &lt;p&gt;',
            'fr'     => '<code>p</code> crée déjà l\'espace entre les blocs ; enchaîner les <code>br</code> pollue le code et gâche l\'accessibilité.',
            'darija' => '<code>p</code> deja kaydibne les espaces bin les blocs. Ila katkeb les <code>br</code> mrafil, code dyalek kaywal décoré w makaykhre9 les lecteurs d\'écran.',
        ],
        [
            'wrong'  => 'Utiliser b/i pour donner de l\'importance',
            'fix'    => 'strong/em quand le sens compte, b/i pour le style seul',
            'fr'     => 'b et i ne disent rien aux lecteurs d\'écran ni aux moteurs de recherche : strong et em transmettent du sens.',
            'darija' => 'b w i makaydiroy walou f sens : des balises de style ghi. strong w em kayhssan le sens dyal l ребенок.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Titres h1-h6</b> : le plan du document, un seul h1, pas de saut de niveau. <b>p</b> pour les paragraphes, <b>br</b> pour un vrai saut de ligne, <b>hr</b> pour un filet de séparation. <b>strong/em</b> portent du sens (importance / insistance) ; <b>b/i</b> sont purement visuels. <b>mark</b> surligne, <b>u</b> souligne, <b>sup</b>/<b>sub</b> font exposants et indices, <b>del</b> barre le texte supprimé.',
        'darija' => 'Les balises dyal le texte f had chapter : <code>h1</code> 7ta <code>h6</code> ash kaysemay plan, <code>p</code> dyal les paragraphes, <code>br</code> w <code>hr</code> (le sang dyal line w filet). strong/em kayd?,m le sens (mohim / insister), b/i ghi style. mark surligné, u souligné, sup/sub exposant w indice, del barré le texte msuhashed.',
    ],
];
