<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex08.php
 */

return array (
  'id' => 'css-ex8',
  'title' => 'Le modèle de boîte',
  'brief' => 'Calculer largeur, padding, bordure et marge avec box-sizing.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — box-sizing',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.boite</code> avec <code>box-sizing: border-box;</code>, une largeur de <code>300px</code>, un padding de <code>20px</code> et une bordure de <code>5px solid #333</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.boite</code> b <code>box-sizing: border-box;</code>, 3ard <code>300px</code>, padding <code>20px</code> w bordure <code>5px solid #333</code>.</p>',
      'starter' => '.boite {
  /* vos déclarations */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'box-sizing: border-box',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: 300px',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding: 20px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'border: 5px solid',
        ),
      ),
      'hints' => 
      array (
        0 => 'box-sizing: border-box inclut padding et bordure dans la largeur.',
        1 => 'La largeur se déclare avec width.',
        2 => 'La bordure accepte trois valeurs : épaisseur, style, couleur.',
      ),
      'solution' => '.boite {
  box-sizing: border-box;
  width: 300px;
  padding: 20px;
  border: 5px solid #333;
}',
      'explainFr' => 'Avec <code>border-box</code>, la boîte mesure 300px au total : le padding et la bordure sont pris <em>à l\'intérieur</em> de cette largeur.',
      'explainDarija' => 'B <code>border-box</code>, boîte katqis 300px b kollha : padding w bordure kaytkhalso <em>f dakhel</em> had 3ard.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — marges et padding raccourcis',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.carte</code> avec une marge verticale de <code>16px</code> et horizontale <code>auto</code>, puis un padding de <code>12px</code> en haut/bas et <code>24px</code> à gauche/droite.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.carte</code> b marge verticale <code>16px</code> w horizontale <code>auto</code>, men ba3d padding <code>12px</code> fo9/ta7t w <code>24px</code> liser/limen.</p>',
      'starter' => '.carte {
  /* marges */
  /* padding */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'margin: 16px auto',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding: 12px 24px',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le raccourci margin accepte 1, 2 ou 4 valeurs.',
        1 => 'Deux valeurs signifient vertical puis horizontal.',
        2 => 'margin: auto centre horizontalement un bloc de largeur fixe.',
      ),
      'solution' => '.carte {
  margin: 16px auto;
  padding: 12px 24px;
}',
      'explainFr' => '<code>margin: 16px auto</code> = 16px en haut/bas, automatique à gauche/droite (centrage). <code>padding: 12px 24px</code> = 12px en haut/bas, 24px à gauche/droite.',
      'explainDarija' => '<code>margin: 16px auto</code> = 16px fo9/ta7t, automatique liser/limen (centrage). <code>padding: 12px 24px</code> = 12px fo9/ta7t, 24px liser/limen.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — boîte fluide bornée',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.zone</code> avec <code>box-sizing: border-box</code>, une largeur de <code>100%</code>, une largeur maximale de <code>640px</code>, un padding de <code>24px</code>, une bordure de <code>8px solid navy</code> et un centrage horizontal.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.zone</code> b <code>box-sizing: border-box</code>, 3ard <code>100%</code>, 3ard maximum <code>640px</code>, padding <code>24px</code>, bordure <code>8px solid navy</code> w centrage horizontal.</p>',
      'starter' => '.zone {
  /* boîte fluide */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'box-sizing: border-box',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: 100%',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'max-width: 640px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding: 24px',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'border: 8px solid',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'margin: 0 auto',
        ),
      ),
      'hints' => 
      array (
        0 => 'max-width limite la largeur sans bloquer le rétrécissement.',
        1 => '100% rend la boîte fluide sur mobile.',
        2 => 'Le centrage se fait avec margin: 0 auto.',
      ),
      'solution' => '.zone {
  box-sizing: border-box;
  width: 100%;
  max-width: 640px;
  padding: 24px;
  border: 8px solid navy;
  margin: 0 auto;
}',
      'explainFr' => 'La boîte occupe toute la largeur disponible mais ne dépasse jamais 640px. Grâce à <code>border-box</code>, le padding et la bordure n\'ajoutent pas de largeur supplémentaire.',
      'explainDarija' => 'Boîte katakhod 3ard kamel li kayn walakin 3omrha ma tfout 640px. B <code>border-box</code>, padding w bordure ma kayzidoch 3ard zayd.',
    ),
  ),
);
