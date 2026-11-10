<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex10.php
 */

return array (
  'id' => 'css-ex10',
  'title' => 'La propriété position',
  'brief' => 'Décaler, ancrer, coller et gérer les calques.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — relative',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.decalage</code> qui conserve l\'élément dans le flux mais le décale de <code>10px</code> vers le bas et de <code>20px</code> vers la droite.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.decalage</code> li kat7fed élément f flux walakin kat7wlo <code>10px</code> l ta7t w <code>20px</code> l limen.</p>',
      'starter' => '.decalage {
  /* position */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'position: relative',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'top: 10px',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'left: 20px',
        ),
      ),
      'hints' => 
      array (
        0 => 'position: relative garde la place d\'origine dans le flux.',
        1 => 'top déplace vers le bas quand il est positif.',
        2 => 'left déplace vers la droite quand il est positif.',
      ),
      'solution' => '.decalage {
  position: relative;
  top: 10px;
  left: 20px;
}',
      'explainFr' => '<code>relative</code> décale visuellement l\'élément sans libérer sa place : les autres éléments restent à leur position initiale.',
      'explainDarija' => '<code>relative</code> kat7wel élément visuellement bla ma t7rer blaso : éléments okhrin kaybqaw f blasathom.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — absolute dans un parent relative',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.parent</code> en <code>position: relative</code>, puis une règle <code>.badge</code> en <code>position: absolute</code> placée à <code>8px</code> du haut et <code>8px</code> de la droite.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.parent</code> b <code>position: relative</code>, men ba3d règle <code>.badge</code> b <code>position: absolute</code> m7tot 3la <code>8px</code> men fo9 w <code>8px</code> men limen.</p>',
      'starter' => '.parent {
  /* repère */
}

.badge {
  /* ancrage */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'position: relative',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'position: absolute',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'top: 8px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'right: 8px',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un enfant absolute se positionne par rapport au premier ancêtre positionné.',
        1 => 'Le parent doit être relative pour servir de repère.',
        2 => 'right: 8px place le bord droit à 8px du parent.',
      ),
      'solution' => '.parent {
  position: relative;
}

.badge {
  position: absolute;
  top: 8px;
  right: 8px;
}',
      'explainFr' => 'Le badge sort du flux et se colle au coin supérieur droit du parent. Sans <code>position: relative</code> sur le parent, il se placerait par rapport à la page.',
      'explainDarija' => 'Badge kaykhrej men flux w kaylse9 f coin fo9ani limen dyal parent. Bla <code>position: relative</code> 3la parent, ghadi yt7et 3la 7sab page.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — en-tête fixe',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>header</code> avec <code>position: fixed</code>, collée en haut et à gauche, largeur <code>100%</code> et <code>z-index: 100</code>. Ajoute au <code>body</code> un padding-top de <code>70px</code> pour compenser.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>header</code> b <code>position: fixed</code>, mlsqa fo9 w liser, 3ard <code>100%</code> w <code>z-index: 100</code>. Zid l <code>body</code> padding-top <code>70px</code> bach t3awed.</p>',
      'starter' => 'header {
  /* en-tête fixe */
}

body {
  /* compensation */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'position: fixed',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'top: 0',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'left: 0',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: 100%',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'z-index: 100',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding-top: 70px',
        ),
      ),
      'hints' => 
      array (
        0 => 'fixed sort l\'élément du flux et le fixe à la fenêtre.',
        1 => 'z-index ne fonctionne que sur un élément positionné.',
        2 => 'Le contenu masqué par l\'en-tête se rattrape avec un padding.',
      ),
      'solution' => 'header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 100;
}

body {
  padding-top: 70px;
}',
      'explainFr' => 'L\'en-tête reste visible au défilement et passe au-dessus du contenu grâce à <code>z-index</code>. Le padding du body empêche le début de la page d\'être caché derrière l\'en-tête.',
      'explainDarija' => 'En-tête kaybqa yban f défilement w kaydowez fo9 contenu b <code>z-index</code>. Padding dyal body kaymna3 bdaya dyal page tkoun mkhebbya mora en-tête.',
    ),
  ),
);
