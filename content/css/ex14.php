<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex14.php
 */

return array (
  'id' => 'css-ex14',
  'title' => 'Media queries',
  'brief' => 'Adapter une mise en page selon la largeur et les préférences.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — première media query',
      'lang' => 'css',
      'instructions' => '<p>Écris une media query qui applique <code>display: flex;</code> à <code>.conteneur</code> à partir de <code>768px</code> de large.</p>',
      'instructionsDarija' => '<p>Kteb media query li kattbeq <code>display: flex;</code> 3la <code>.conteneur</code> men <code>768px</code> dyal 3ard.</p>',
      'starter' => '/* media query mobile-first */',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '@media (min-width: 768px)',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: flex',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une media query s\'écrit @media (condition) { ... }.',
        1 => 'min-width signifie « à partir de cette largeur ».',
        2 => 'La règle doit cibler .conteneur.',
      ),
      'solution' => '@media (min-width: 768px) {
  .conteneur {
    display: flex;
  }
}',
      'explainFr' => 'Sous 768px, le conteneur garde son style de base. À partir de 768px, il devient flex : c\'est l\'approche mobile-first.',
      'explainDarija' => 'Qbel 768px, conteneur kay7fed style de base. Men 768px, kaywli flex : hadi approche mobile-first.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — grille de 1 à 3 colonnes',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle de base <code>.grille { display: grid; grid-template-columns: 1fr; }</code>, puis deux media queries : deux colonnes à partir de <code>600px</code> et trois colonnes à partir de <code>900px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle de base <code>.grille { display: grid; grid-template-columns: 1fr; }</code>, men ba3d jouj media queries : jouj colonnes men <code>600px</code> w tlata colonnes men <code>900px</code>.</p>',
      'starter' => '.grille {
  /* base mobile */
}

/* 600px */

/* 900px */',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-template-columns: 1fr',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '@media (min-width: 600px)',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'repeat(2, 1fr)',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '@media (min-width: 900px)',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'repeat(3, 1fr)',
        ),
      ),
      'hints' => 
      array (
        0 => 'La base s\'applique à tous les écrans.',
        1 => 'Les media queries suivantes écrasent la base quand leur condition est vraie.',
        2 => 'L\'ordre mobile-first va du plus petit au plus grand.',
      ),
      'solution' => '.grille {
  display: grid;
  grid-template-columns: 1fr;
}

@media (min-width: 600px) {
  .grille {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 900px) {
  .grille {
    grid-template-columns: repeat(3, 1fr);
  }
}',
      'explainFr' => 'Sous 600px : une colonne. De 600 à 899px : deux colonnes. À partir de 900px : trois colonnes. Chaque palier enrichit le précédent.',
      'explainDarija' => 'Qbel 600px : colonne wa7da. Men 600 7ta 899px : jouj colonnes. Men 900px : tlata colonnes. Kol palier kayzid 3la li qbelo.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — mouvement réduit et thème sombre',
      'lang' => 'css',
      'instructions' => '<p>Écris une media query <code>prefers-reduced-motion: reduce</code> qui réduit <code>animation-duration</code> et <code>transition-duration</code> à <code>0.01ms</code> pour tous les éléments, puis une media query <code>prefers-color-scheme: dark</code> qui donne au <code>body</code> un fond <code>#0f172a</code> et un texte <code>#e2e8f0</code>.</p>',
      'instructionsDarija' => '<p>Kteb media query <code>prefers-reduced-motion: reduce</code> li katnqes <code>animation-duration</code> w <code>transition-duration</code> l <code>0.01ms</code> l kol éléments, men ba3d media query <code>prefers-color-scheme: dark</code> li kat3ti l <code>body</code> fond <code>#0f172a</code> w texte <code>#e2e8f0</code>.</p>',
      'starter' => '/* mouvement réduit */

/* thème sombre */',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'prefers-reduced-motion: reduce',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'animation-duration: 0.01ms',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'transition-duration: 0.01ms',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'prefers-color-scheme: dark',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'background: #0f172a',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'color: #e2e8f0',
        ),
      ),
      'hints' => 
      array (
        0 => 'Ces media queries ne dépendent pas de la largeur mais des préférences du système.',
        1 => 'Le sélecteur * cible tous les éléments.',
        2 => 'Le thème sombre améliore le confort de lecture.',
      ),
      'solution' => '@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms;
    transition-duration: 0.01ms;
  }
}

@media (prefers-color-scheme: dark) {
  body {
    background: #0f172a;
    color: #e2e8f0;
  }
}',
      'explainFr' => 'Ces deux media queries respectent les choix de l\'utilisateur : moins d\'animations pour éviter le malaise, et un thème sombre automatique si le système l\'utilise.',
      'explainDarija' => 'Had jouj media queries kay7trmo choix dyal utilisateur : animations qlil bach yt7asab malaise, w thème sombre automatique ila système kayst3mlo.',
    ),
  ),
);
