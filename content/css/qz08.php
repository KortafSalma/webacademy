<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz08.php
 */

return array (
  'title' => 'Quiz — Le modèle de boîte',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Que comprend le modèle de boîte CSS ?',
      'options' => 
      array (
        0 => 'Contenu, padding, bordure, marge',
        1 => 'Contenu et couleur uniquement',
        2 => 'Largeur et hauteur uniquement',
      ),
      'answer' => 0,
      'concept' => 'Composition',
      'explainFr' => 'Chaque élément est une boîte composée du contenu, du padding, de la bordure et de la marge.',
      'explainDarija' => 'Kol élément howa boîte mkkwna men contenu, padding, bordure w marge.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'box-sizing: border-box inclut le padding et la bordure dans la largeur déclarée.',
      'answer' => 0,
      'concept' => 'box-sizing',
      'explainFr' => 'Vrai : la largeur totale reste égale à <code>width</code>.',
      'explainDarija' => 'S7i7 : 3ard kamel kaybqa sawi m3a <code>width</code>.',
    ),
    2 => 
    array (
      'type' => 'fill',
      'question' => 'La propriété qui ajoute de l\'espace à l\'intérieur de la bordure est ________.',
      'answer' => 'padding',
      'concept' => 'Padding',
      'explainFr' => '<code>padding</code> crée l\'espace interne ; <code>margin</code> l\'espace externe.',
      'explainDarija' => '<code>padding</code> kay5leq espace dakheli ; <code>margin</code> espace kharji.',
    ),
    3 => 
    array (
      'type' => 'mcq',
      'question' => 'Avec width: 300px, padding: 20px, border: 5px et box-sizing: content-box, quelle est la largeur totale ?',
      'options' => 
      array (
        0 => '350px',
        1 => '300px',
        2 => '340px',
      ),
      'answer' => 0,
      'concept' => 'Calcul de largeur',
      'explainFr' => '300 + 20 × 2 + 5 × 2 = 350px. En content-box, le padding et la bordure s\'ajoutent.',
      'explainDarija' => '300 + 20 × 2 + 5 × 2 = 350px. F content-box, padding w bordure kaytzado.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quelles propriétés font partie du modèle de boîte ?',
      'options' => 
      array (
        0 => 'padding',
        1 => 'border',
        2 => 'margin',
        3 => 'color',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Propriétés de boîte',
      'explainFr' => '<code>padding</code>, <code>border</code> et <code>margin</code> composent la boîte ; <code>color</code> concerne le texte.',
      'explainDarija' => '<code>padding</code>, <code>border</code> w <code>margin</code> kaykkwno boîte ; <code>color</code> kat3ni texte.',
    ),
  ),
);
