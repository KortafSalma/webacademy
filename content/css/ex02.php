<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex02.php
 */

return array (
  'id' => 'css-ex2',
  'title' => 'Inline, interne, externe',
  'brief' => 'Placer du CSS dans un attribut, une balise style ou un fichier séparé.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — style en ligne',
      'lang' => 'html',
      'instructions' => '<p>Écris un paragraphe <code>p</code> dont le texte est « Bonjour » et dont la couleur est rouge, uniquement avec l\'attribut <code>style</code>.</p>',
      'instructionsDarija' => '<p>Kteb paragraphe <code>p</code> fih texte « Bonjour » w loun 7mer, ghir b attribut <code>style</code>.</p>',
      'starter' => '<p>Bonjour</p>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<p',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'style="color: red',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'Bonjour',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'attribut style contient des déclarations CSS.',
        1 => 'La syntaxe est style="propriété: valeur;".',
        2 => 'Pas besoin d\'accolades ni de sélecteur en ligne.',
      ),
      'solution' => '<p style="color: red;">Bonjour</p>',
      'explainFr' => 'Le style en ligne s\'applique au seul élément qui le porte. Il est prioritaire sur les feuilles externes, mais difficile à maintenir sur un grand site.',
      'explainDarija' => 'Style en ligne kaytbeq ghir 3la élément li 7amlo. 3ndo priorité 3la feuilles externes, walakin s3ib f maintenance f site kbir.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — feuille interne',
      'lang' => 'html',
      'instructions' => '<p>Ajoute dans le <code>head</code> une balise <code>style</code> contenant une classe <code>.important</code> qui met le texte en gras (<code>font-weight: bold;</code>), puis applique cette classe à un paragraphe.</p>',
      'instructionsDarija' => '<p>Zid f <code>head</code> balise <code>style</code> fiha classe <code>.important</code> li kat3mel texte gras (<code>font-weight: bold;</code>), men ba3d tbeq had classe 3la paragraphe.</p>',
      'starter' => '<head>
  <!-- feuille interne -->
</head>
<body>
  <p>Texte</p>
</body>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<style>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '.important',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'font-weight: bold',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'class="important"',
        ),
      ),
      'hints' => 
      array (
        0 => 'La balise style se place dans le head.',
        1 => 'Une classe CSS commence par un point.',
        2 => 'L\'attribut HTML est class, pas className.',
      ),
      'solution' => '<head>
  <style>
    .important {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <p class="important">Texte important</p>
</body>',
      'explainFr' => 'La feuille interne reste dans le document HTML. Elle centralise les styles de la page, contrairement au style en ligne répété sur chaque élément.',
      'explainDarija' => 'Feuille interne katbqa f document HTML. Katjem3 styles dyal page, 3aks style en ligne li kaytkerrer 3la kol élément.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — feuille externe et cascade',
      'lang' => 'html',
      'instructions' => '<p>Lie une feuille externe <code>style.css</code> dans le <code>head</code>, puis donne à un titre <code>h1</code> la classe <code>titre</code> et une couleur verte en ligne. Le fichier externe est censé définir <code>.titre { color: navy; }</code>.</p>',
      'instructionsDarija' => '<p>Rbet feuille externe <code>style.css</code> f <code>head</code>, men ba3d 3ti titre <code>h1</code> classe <code>titre</code> w loun khder en ligne. Fichier externe mftard kay3erref <code>.titre { color: navy; }</code>.</p>',
      'starter' => '<head>
  <!-- lien vers style.css -->
</head>
<body>
  <h1>Mon site</h1>
</body>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<link',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'rel="stylesheet"',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'href="style.css"',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'class="titre"',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'style="color: green"',
        ),
      ),
      'hints' => 
      array (
        0 => 'La balise link est auto-fermante et se place dans le head.',
        1 => 'rel="stylesheet" indique le type de ressource.',
        2 => 'Le style en ligne gagne sur la règle externe à spécificité égale.',
      ),
      'solution' => '<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="titre" style="color: green;">Mon site</h1>
</body>',
      'explainFr' => 'La feuille externe est chargée par <code>link</code>. Ici le style en ligne <code>color: green</code> l\'emporte sur la règle <code>.titre</code> du fichier externe : c\'est la cascade.',
      'explainDarija' => 'Feuille externe katchargi b <code>link</code>. Hna style en ligne <code>color: green</code> kayghalleb règle <code>.titre</code> dyal fichier externe : hadi hiya cascade.',
    ),
  ),
);
