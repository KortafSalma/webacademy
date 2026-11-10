<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex12.php
 */

return array (
  'id' => 'css-ex12',
  'title' => 'CSS Grid',
  'brief' => 'Construire des grilles, placer des éléments et dessiner un layout.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — grille de trois colonnes',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.grille</code> qui active Grid, crée trois colonnes égales avec <code>repeat(3, 1fr)</code> et ajoute un <code>gap</code> de <code>12px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.grille</code> li katfe3el Grid, kat5leq tlata colonnes sawiyin b <code>repeat(3, 1fr)</code> w katzid <code>gap</code> dyal <code>12px</code>.</p>',
      'starter' => '.grille {
  /* grille */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: grid',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-template-columns: repeat(3, 1fr)',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'gap: 12px',
        ),
      ),
      'hints' => 
      array (
        0 => 'Grid s\'active avec display: grid.',
        1 => 'grid-template-columns définit les colonnes.',
        2 => '1fr représente une fraction de l\'espace libre.',
      ),
      'solution' => '.grille {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
}',
      'explainFr' => '<code>repeat(3, 1fr)</code> équivaut à <code>1fr 1fr 1fr</code> : trois colonnes de largeur identique qui se partagent l\'espace.',
      'explainDarija' => '<code>repeat(3, 1fr)</code> b7al <code>1fr 1fr 1fr</code> : tlata colonnes b 3ard sawi li kaytqasmo espace.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — placer une carte sur deux colonnes',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.large</code> qui occupe deux colonnes et deux lignes dans la grille.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.large</code> li katakhod jouj colonnes w jouj lignes f grille.</p>',
      'starter' => '.large {
  /* occupation */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-column: span 2',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-row: span 2',
        ),
      ),
      'hints' => 
      array (
        0 => 'span 2 signifie « occupe deux pistes ».',
        1 => 'grid-column gère l\'axe horizontal.',
        2 => 'grid-row gère l\'axe vertical.',
      ),
      'solution' => '.large {
  grid-column: span 2;
  grid-row: span 2;
}',
      'explainFr' => 'La carte s\'étend sur deux colonnes et deux lignes. Les autres éléments se placent automatiquement autour d\'elle.',
      'explainDarija' => 'Carte kattmed 3la jouj colonnes w jouj lignes. Éléments okhrin kayt7etto automatiquement 7daha.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — layout avec grid-template-areas',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.page</code> qui définit deux colonnes (<code>200px 1fr</code>) et trois lignes (<code>auto 1fr auto</code>), puis les zones <code>entete</code>, <code>menu</code>, <code>contenu</code> et <code>pied</code> comme dans un layout classique.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.page</code> li kat7edded jouj colonnes (<code>200px 1fr</code>) w tlata lignes (<code>auto 1fr auto</code>), men ba3d zones <code>entete</code>, <code>menu</code>, <code>contenu</code> w <code>pied</code> b7al layout 3adi.</p>',
      'starter' => '.page {
  display: grid;
  /* colonnes, lignes, zones */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-template-columns: 200px 1fr',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-template-rows: auto 1fr auto',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'grid-template-areas',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'entete entete',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'menu',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'pied pied',
        ),
      ),
      'hints' => 
      array (
        0 => 'grid-template-areas utilise des chaînes de caractères.',
        1 => 'Chaque ligne de la déclaration représente une ligne de la grille.',
        2 => 'Un nom répété fusionne les cellules.',
      ),
      'solution' => '.page {
  display: grid;
  grid-template-columns: 200px 1fr;
  grid-template-rows: auto 1fr auto;
  grid-template-areas:
    "entete entete"
    "menu contenu"
    "pied pied";
}',
      'explainFr' => 'Le dessin en texte décrit exactement la page : en-tête et pied sur toute la largeur, menu à gauche, contenu à droite. Chaque enfant devra reprendre son nom avec <code>grid-area</code>.',
      'explainDarija' => 'Rsam b texte kaywsef page b dqiq : en-tête w pied 3la 3ard kamel, menu liser, contenu limen. Kol enfant khas y3awed smiyto b <code>grid-area</code>.',
    ),
  ),
);
