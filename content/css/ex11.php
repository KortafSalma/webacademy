<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex11.php
 */

return array (
  'id' => 'css-ex11',
  'title' => 'Flexbox',
  'brief' => 'Aligner, répartir et faire passer des éléments flex à la ligne.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — activer et aligner',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.conteneur</code> qui active Flexbox, répartit les éléments avec <code>space-between</code>, les centre verticalement avec <code>align-items: center</code> et ajoute un <code>gap</code> de <code>16px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.conteneur</code> li katfe3el Flexbox, katqasem éléments b <code>space-between</code>, katcenterhom verticalement b <code>align-items: center</code> w katzid <code>gap</code> dyal <code>16px</code>.</p>',
      'starter' => '.conteneur {
  /* Flexbox */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: flex',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'justify-content: space-between',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'align-items: center',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'gap: 16px',
        ),
      ),
      'hints' => 
      array (
        0 => 'Flexbox s\'active sur le conteneur avec display: flex.',
        1 => 'justify-content agit sur l\'axe principal.',
        2 => 'align-items agit sur l\'axe secondaire.',
        3 => 'gap espace les enfants sans marges.',
      ),
      'solution' => '.conteneur {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}',
      'explainFr' => '<code>justify-content</code> pousse le premier et le dernier enfant aux extrémités, <code>align-items</code> les centre sur la hauteur, <code>gap</code> garantit un espace minimal entre eux.',
      'explainDarija' => '<code>justify-content</code> kaydowez awwel w akhir enfant l tarafin, <code>align-items</code> kaycenterhom f hauteur, <code>gap</code> kay7fed espace minimum binathom.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — parts égales et part double',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.col</code> qui prend une part égale de l\'espace disponible, puis une règle <code>.col.large</code> qui prend deux parts.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.col</code> li katakhod part sawiya men espace li kayn, men ba3d règle <code>.col.large</code> li katakhod jouj parts.</p>',
      'starter' => '.col {
  /* une part */
}

.col.large {
  /* deux parts */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'flex: 1',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'flex: 2',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le raccourci flex: 1 signifie grandir et rétrécir également.',
        1 => 'flex: 2 donne deux fois plus d\'espace libre.',
        2 => 'Le sélecteur .col.large cible les éléments qui ont les deux classes.',
      ),
      'solution' => '.col {
  flex: 1;
}

.col.large {
  flex: 2;
}',
      'explainFr' => 'L\'espace libre est partagé proportionnellement : la colonne large reçoit deux parts, les autres une part chacune.',
      'explainDarija' => 'Espace libre kaytqasem b nisba : colonne kbira katakhod jouj parts, lokhrin part wa7da kol wa7da.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — cartes qui passent à la ligne',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.cartes</code> en Flexbox avec <code>flex-wrap: wrap</code> et un <code>gap</code> de <code>16px</code>, puis une règle <code>.carte</code> avec <code>flex: 1 1 180px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.cartes</code> f Flexbox b <code>flex-wrap: wrap</code> w <code>gap</code> dyal <code>16px</code>, men ba3d règle <code>.carte</code> b <code>flex: 1 1 180px</code>.</p>',
      'starter' => '.cartes {
  /* conteneur */
}

.carte {
  /* enfant */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: flex',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'flex-wrap: wrap',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'gap: 16px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'flex: 1 1 180px',
        ),
      ),
      'hints' => 
      array (
        0 => 'flex-wrap: wrap autorise le passage à la ligne.',
        1 => 'flex: 1 1 180px = grow 1, shrink 1, base 180px.',
        2 => 'La base est la largeur de départ avant partage de l\'espace.',
      ),
      'solution' => '.cartes {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.carte {
  flex: 1 1 180px;
}',
      'explainFr' => 'Chaque carte démarre à 180px, peut grandir pour remplir la ligne et rétrécir si besoin. Quand la ligne est pleine, les cartes suivantes passent en dessous.',
      'explainDarija' => 'Kol carte katbda b 180px, t9der tkber bach t3emmer ligne w tsqer ila khas. Melli ligne kat3mer, cartes li mora kaydowzo l ta7t.',
    ),
  ),
);
