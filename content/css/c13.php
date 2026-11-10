<?php

declare(strict_types=1);

/**
 * Contenu généré depuis css-c13.json
 */

return array (
  'id' => 'css-ch13',
  'title' => 'Design responsive',
  'subtitle' => 'Un site lisible sur téléphone, tablette et ordinateur',
  'objectives' => 
  array (
    0 => 'Comprendre l\'approche mobile-first.',
    1 => 'Ajouter la balise viewport indispensable.',
    2 => 'Utiliser des unités relatives et des largeurs fluides.',
    3 => 'Rendre les images et les médias adaptatifs.',
    4 => 'Construire une mise en page qui se réorganise sans casser.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'principes',
      'title' => 'Les principes du responsive',
      'icon' => '📱',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le <strong>design responsive</strong> consiste à concevoir une seule page qui s\'adapte à toutes les tailles d\'écran, plutôt que plusieurs versions séparées. Trois piliers : une <strong>grille fluide</strong>, des <strong>médias flexibles</strong> et des <strong>media queries</strong>.</p>',
          'darija' => '<p><strong>Design responsive</strong> ma3nah tseMMem page wa7da katt3adel m3a kol 7ajm dyal écran, blast bzaf versions mfre9in. Tlata pillars : <strong>grille fluide</strong>, <strong>médias flexibles</strong> w <strong>media queries</strong>.</p>',
        ),
        1 => 
        array (
          'type' => 'definition',
          'title' => 'Mobile-first',
          'fr' => '<p>On écrit d\'abord le style pour petit écran, puis on l\'enrichit avec des <code>min-width</code> pour les écrans plus larges. Cette approche force à prioriser le contenu essentiel et produit un CSS plus simple.</p>',
          'darija' => '<p>Kanktbo lwel style dyal écran sghir, men ba3d kanzido 3lih b <code>min-width</code> l écrans kbar. Had tariqa katferd t3ti priorité l contenu essential w kat3ti CSS ashel.</p>',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'html',
          'title' => 'La balise viewport (obligatoire)',
          'code' => '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Sans viewport, le mobile ment',
          'fr' => 'Sans cette balise, le téléphone affiche la page comme un écran de 980px puis dézoome : le texte devient minuscule et les media queries ne se déclenchent pas comme prévu.',
          'darija' => 'Bla had balise, téléphone kay3red page b7al écran 980px men ba3d kayzoom out : texte kaywli sghir bzzaf w media queries ma kaytf3loch kif ma kaytweqqe3.',
        ),
        4 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Unité',
            1 => 'Relatif à',
            2 => 'Usage typique',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'px',
              1 => 'pixel',
              2 => 'bordures, petites icônes',
            ),
            1 => 
            array (
              0 => '%',
              1 => 'parent',
              2 => 'largeurs fluides',
            ),
            2 => 
            array (
              0 => 'rem',
              1 => 'taille de police racine',
              2 => 'typo, espacements',
            ),
            3 => 
            array (
              0 => 'em',
              1 => 'taille de police de l\'élément',
              2 => 'composants',
            ),
            4 => 
            array (
              0 => 'vw / vh',
              1 => 'largeur / hauteur de la fenêtre',
              2 => 'sections plein écran',
            ),
            5 => 
            array (
              0 => 'clamp(min, idéal, max)',
              1 => 'calcul fluide',
              2 => 'titres qui s\'adaptent',
            ),
          ),
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'medias-flexibles',
      'title' => 'Images et médias flexibles',
      'icon' => '🖼️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une image de 2000px de large casse une mise en page mobile. La règle de base : <code>max-width: 100%</code> et <code>height: auto</code>. L\'image ne dépasse jamais son conteneur et conserve ses proportions.</p>',
          'darija' => '<p>Image b 3ard 2000px katkhesr mise en page mobile. Qa3ida asasiya : <code>max-width: 100%</code> w <code>height: auto</code>. Image 3omrha ma katfout conteneur dyalha w kat7fed proportions.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'css',
          'title' => 'Reset média universel',
          'code' => 'img,
video,
iframe {
  max-width: 100%;
  height: auto;
  display: block;
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Image fluide dans une carte',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image fluide</title>
<style>
  body { font-family: sans-serif; margin: 0; padding: 16px; background: #f8fafc; }
  .carte {
    max-width: 520px;
    margin: 0 auto;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgb(0 0 0 / 0.12);
  }
  .carte img { max-width: 100%; height: auto; display: block; }
  .carte .texte { padding: 16px; }
</style>
</head>
<body>
  <div class="carte">
    <img src="https://picsum.photos/800/400" alt="Illustration abstraite">
    <div class="texte">
      <h2>Carte responsive</h2>
      <p>L\'image s\'adapte à la largeur de la carte.</p>
    </div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'La carte est limitée à 520px et centrée. Sur mobile, elle prend la largeur disponible ; l\'image suit sans déborder.',
          'explainDarija' => 'Carte m7doda b 520px w mcentriya. 3la mobile, katakhod 3ard li kayn ; image kattbe3ha bla ma tfout.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'srcset pour des images adaptées',
          'fr' => '<code>&lt;img srcset="petite.jpg 480w, grande.jpg 1200w" sizes="(max-width: 600px) 100vw, 50vw"&gt;</code> laisse le navigateur choisir la version la plus légère adaptée à l\'écran. Gain de performance notable.',
          'darija' => '<code>&lt;img srcset="petite.jpg 480w, grande.jpg 1200w" sizes="(max-width: 600px) 100vw, 50vw"&gt;</code> katkhalli navigateur ykhtar version akhaf li tmatch écran. Gain dyal performance mzyan.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'layouts-fluides',
      'title' => 'Layouts fluides',
      'icon' => '🌊',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Plutôt que des largeurs fixes en pixels, utilisez des largeurs relatives et des limites : <code>width: 100%</code> avec <code>max-width</code>, ou <code>clamp()</code> pour une taille qui évolue entre un minimum et un maximum.</p>',
          'darija' => '<p>Blast 3ard fixe b pixels, khdem b 3ard relatif w limites : <code>width: 100%</code> m3a <code>max-width</code>, wla <code>clamp()</code> l taille li kattbeddel bin minimum w maximum.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Conteneur centré et titre fluide',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layout fluide</title>
<style>
  .conteneur {
    width: min(100% - 32px, 1000px);
    margin-inline: auto;
  }
  h1 {
    font-size: clamp(1.5rem, 4vw + 0.5rem, 3rem);
    line-height: 1.2;
  }
  p { font-size: clamp(1rem, 1.5vw, 1.15rem); }
</style>
</head>
<body>
  <div class="conteneur">
    <h1>Un titre qui s\'adapte à l\'écran</h1>
    <p>Le conteneur garde 16px de marge de chaque côté et ne dépasse jamais 1000px.</p>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>min(100% - 32px, 1000px)</code> choisit la plus petite des deux valeurs : marges garanties sur mobile, largeur maîtrisée sur grand écran. <code>clamp()</code> borne la taille du titre.',
          'explainDarija' => '<code>min(100% - 32px, 1000px)</code> katkhtar sghar valeur bin jouj : marges madmonin 3la mobile, 3ard m7ekem 3la écran kbir. <code>clamp()</code> kat7ded taille dyal titre.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Fonction',
            1 => 'Renvoie',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'min(a, b)',
              1 => 'la plus petite valeur',
              2 => 'min(100% - 32px, 1000px)',
            ),
            1 => 
            array (
              0 => 'max(a, b)',
              1 => 'la plus grande valeur',
              2 => 'max(320px, 50%)',
            ),
            2 => 
            array (
              0 => 'clamp(min, idéal, max)',
              1 => 'idéal borné',
              2 => 'clamp(1rem, 2.5vw, 1.5rem)',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Pas de hauteur fixe pour du texte',
          'fr' => 'Une <code>height</code> fixe sur un bloc de texte provoque des débordements quand la police grossit ou que le texte passe à la ligne. Préférez <code>min-height</code>.',
          'darija' => '<code>height</code> fixe 3la bloc dyal texte kay5leq débordements melli police tkber wla texte ydowez l ligne. 7sen <code>min-height</code>.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Oublier <meta name="viewport">',
      'fix' => '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
      'fr' => 'Sans elle, le mobile simule un écran large et réduit toute la page : le responsive ne fonctionne pas.',
      'darija' => 'Bla biha, mobile kayfeddo écran kbir w kayseghar page kamla : responsive ma kaykhdemch.',
    ),
    1 => 
    array (
      'wrong' => 'width: 960px sur le conteneur principal',
      'fix' => 'width: min(100% - 32px, 960px); margin-inline: auto;',
      'fr' => 'Une largeur fixe supérieure à l\'écran crée un défilement horizontal : le pire défaut mobile.',
      'darija' => '3ard fixe kbar men écran kay5leq défilement horizontal : 3ib mobile li 7ta wa7ed ma kaybghih.',
    ),
    2 => 
    array (
      'wrong' => 'Images sans max-width',
      'fix' => 'img { max-width: 100%; height: auto; }',
      'fr' => 'Une image plus large que son conteneur déborde et casse la mise en page.',
      'darija' => 'Image kbar men conteneur dyalha katfout w katkhesr mise en page.',
    ),
    3 => 
    array (
      'wrong' => 'Texte en px partout',
      'fix' => 'Utiliser rem pour la typographie et les espacements.',
      'fr' => 'Les unités relatives respectent les préférences de taille de police de l\'utilisateur.',
      'darija' => 'Unités relatives kay7trmo préférences dyal taille dyal police 3nd utilisateur.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Le <strong>responsive</strong> part du mobile et s\'enrichit vers le grand écran. La balise <strong>viewport</strong> est obligatoire, les <strong>unités relatives</strong> (%, rem, vw) remplacent les pixels fixes, les <strong>images</strong> utilisent <code>max-width: 100%</code>, et les conteneurs se bornent avec <code>min()</code>, <code>max()</code> ou <code>clamp()</code>. Les media queries finalisent l\'adaptation.',
    'darija' => '<strong>Responsive</strong> kaybda men mobile w kaytzad l écran kbir. Balise <strong>viewport</strong> darouriya, <strong>unités relatives</strong> (%, rem, vw) kay3awdo blast pixels fixes, <strong>images</strong> kaykhdmo b <code>max-width: 100%</code>, w conteneurs kayt7eddo b <code>min()</code>, <code>max()</code> wla <code>clamp()</code>. Media queries kaykmmlo adaptation.',
  ),
);
