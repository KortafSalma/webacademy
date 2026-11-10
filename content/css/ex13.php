<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex13.php
 */

return array (
  'id' => 'css-ex13',
  'title' => 'Design responsive',
  'brief' => 'Rendre une page lisible du mobile au grand écran.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — viewport et image fluide',
      'lang' => 'html',
      'instructions' => '<p>Ajoute la balise <code>meta name="viewport"</code> dans le <code>head</code>, puis écris une règle <code>img</code> avec <code>max-width: 100%</code> et <code>height: auto</code>.</p>',
      'instructionsDarija' => '<p>Zid balise <code>meta name="viewport"</code> f <code>head</code>, men ba3d kteb règle <code>img</code> b <code>max-width: 100%</code> w <code>height: auto</code>.</p>',
      'starter' => '<head>
  <!-- viewport -->
  <style>
    /* image fluide */
  </style>
</head>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'name="viewport"',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'width=device-width',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'max-width: 100%',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'height: auto',
        ),
      ),
      'hints' => 
      array (
        0 => 'viewport indique au mobile d\'utiliser la largeur réelle de l\'écran.',
        1 => 'max-width: 100% empêche l\'image de dépasser son conteneur.',
        2 => 'height: auto conserve les proportions.',
      ),
      'solution' => '<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>',
      'explainFr' => 'La balise viewport est indispensable : sans elle, le mobile simule un écran de 980px. L\'image ne dépasse jamais son conteneur et garde son ratio.',
      'explainDarija' => 'Balise viewport darouriya : bla biha, mobile kayfeddo écran 980px. Image 3omrha ma tfout conteneur dyalha w kat7fed ratio.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — conteneur fluide et titre adaptatif',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.conteneur</code> avec <code>width: min(100% - 32px, 1000px)</code> et <code>margin-inline: auto</code>, puis une règle <code>h1</code> avec <code>font-size: clamp(1.5rem, 4vw + 0.5rem, 3rem)</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.conteneur</code> b <code>width: min(100% - 32px, 1000px)</code> w <code>margin-inline: auto</code>, men ba3d règle <code>h1</code> b <code>font-size: clamp(1.5rem, 4vw + 0.5rem, 3rem)</code>.</p>',
      'starter' => '.conteneur {
  /* largeur fluide */
}

h1 {
  /* taille fluide */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: min(100% - 32px, 1000px)',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'margin-inline: auto',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'clamp(1.5rem, 4vw + 0.5rem, 3rem)',
        ),
      ),
      'hints' => 
      array (
        0 => 'min() choisit la plus petite des deux valeurs.',
        1 => 'margin-inline: auto centre horizontalement.',
        2 => 'clamp(min, idéal, max) borne la taille.',
      ),
      'solution' => '.conteneur {
  width: min(100% - 32px, 1000px);
  margin-inline: auto;
}

h1 {
  font-size: clamp(1.5rem, 4vw + 0.5rem, 3rem);
}',
      'explainFr' => 'Le conteneur garde 16px de marge de chaque côté sur mobile et ne dépasse jamais 1000px. Le titre grandit avec la largeur de la fenêtre tout en restant entre 1.5rem et 3rem.',
      'explainDarija' => 'Conteneur kay7fed 16px marge kol jiht 3la mobile w 3omro ma yfout 1000px. Titre kaykber m3a 3ard dyal fenêtre w kaybqa bin 1.5rem w 3rem.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — carte responsive complète',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.carte</code> avec <code>max-width: 520px</code>, <code>margin: 0 auto</code>, un fond blanc, un <code>border-radius: 10px</code> et <code>overflow: hidden</code>. Puis une règle <code>.carte img</code> avec <code>width: 100%</code>, <code>height: auto</code> et <code>display: block</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.carte</code> b <code>max-width: 520px</code>, <code>margin: 0 auto</code>, fond byed, <code>border-radius: 10px</code> w <code>overflow: hidden</code>. Men ba3d règle <code>.carte img</code> b <code>width: 100%</code>, <code>height: auto</code> w <code>display: block</code>.</p>',
      'starter' => '.carte {
  /* carte */
}

.carte img {
  /* image */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'max-width: 520px',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'margin: 0 auto',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'overflow: hidden',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '.carte img',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: 100%',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: block',
        ),
      ),
      'hints' => 
      array (
        0 => 'overflow: hidden coupe ce qui dépasse des coins arrondis.',
        1 => 'margin: 0 auto centre la carte.',
        2 => 'display: block supprime l\'espace fantôme sous l\'image.',
      ),
      'solution' => '.carte {
  max-width: 520px;
  margin: 0 auto;
  background: #ffffff;
  border-radius: 10px;
  overflow: hidden;
}

.carte img {
  width: 100%;
  height: auto;
  display: block;
}',
      'explainFr' => 'La carte est centrée, limitée à 520px et ses coins arrondis sont respectés grâce à <code>overflow: hidden</code>. L\'image occupe toute la largeur et garde ses proportions.',
      'explainDarija' => 'Carte mcentriya, m7doda b 520px w coins arrondis kayt7fed 3lihom b <code>overflow: hidden</code>. Image katakhod 3ard kamel w kat7fed proportions.',
    ),
  ),
);
