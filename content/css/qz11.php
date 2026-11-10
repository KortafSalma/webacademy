<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz11.php
 */

return array (
  'title' => 'Quiz — Flexbox',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Sur quel élément active-t-on Flexbox ?',
      'options' => 
      array (
        0 => 'Le conteneur parent',
        1 => 'Chaque enfant',
        2 => 'La balise html uniquement',
      ),
      'answer' => 0,
      'concept' => 'Conteneur flex',
      'explainFr' => '<code>display: flex</code> se met sur le parent ; ses enfants directs deviennent des éléments flex.',
      'explainDarija' => '<code>display: flex</code> kayt7et 3la parent ; enfants nichan kaywliw éléments flex.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'justify-content agit sur l\'axe principal.',
      'answer' => 0,
      'concept' => 'Axes Flexbox',
      'explainFr' => 'Vrai : <code>justify-content</code> aligne sur l\'axe défini par <code>flex-direction</code>.',
      'explainDarija' => 'S7i7 : <code>justify-content</code> kay3adel 3la axe li kay7eddo <code>flex-direction</code>.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle propriété aligne sur l\'axe secondaire ?',
      'options' => 
      array (
        0 => 'align-items',
        1 => 'justify-content',
        2 => 'flex-wrap',
      ),
      'answer' => 0,
      'concept' => 'align-items',
      'explainFr' => '<code>align-items</code> agit sur l\'axe perpendiculaire à l\'axe principal.',
      'explainDarija' => '<code>align-items</code> kaykhdem 3la axe perpendiculaire l axe principal.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le raccourci qui combine grow, shrink et basis s\'appelle ________.',
      'answer' => 'flex',
      'concept' => 'Raccourci flex',
      'explainFr' => '<code>flex: 1 1 180px</code> signifie grow 1, shrink 1, base 180px.',
      'explainDarija' => '<code>flex: 1 1 180px</code> kat3ni grow 1, shrink 1, base 180px.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quelles valeurs de justify-content existent ?',
      'options' => 
      array (
        0 => 'space-between',
        1 => 'space-around',
        2 => 'center',
        3 => 'middle',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Valeurs de justify-content',
      'explainFr' => '<code>center</code>, <code>space-between</code> et <code>space-around</code> sont valides ; <code>middle</code> n\'existe pas en Flexbox.',
      'explainDarija' => '<code>center</code>, <code>space-between</code> w <code>space-around</code> valides ; <code>middle</code> ma kaynch f Flexbox.',
    ),
  ),
);
