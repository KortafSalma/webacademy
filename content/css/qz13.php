<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz13.php
 */

return array (
  'title' => 'Quiz — Design responsive',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle balise est indispensable au responsive sur mobile ?',
      'options' => 
      array (
        0 => 'meta name="viewport"',
        1 => 'meta charset',
        2 => 'link rel="icon"',
      ),
      'answer' => 0,
      'concept' => 'Viewport',
      'explainFr' => 'Sans la balise viewport, le mobile simule un écran large et réduit toute la page.',
      'explainDarija' => 'Bla balise viewport, mobile kayfeddo écran kbir w kayseghar page kamla.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'L\'approche mobile-first écrit d\'abord le style de base pour petit écran.',
      'answer' => 0,
      'concept' => 'Mobile-first',
      'explainFr' => 'Vrai : on part du mobile puis on ajoute des min-width pour les écrans plus larges.',
      'explainDarija' => 'S7i7 : kanbdaw men mobile men ba3d kanzido min-width l écrans kbar.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle règle empêche une image de dépasser son conteneur ?',
      'options' => 
      array (
        0 => 'max-width: 100%; height: auto;',
        1 => 'width: 2000px;',
        2 => 'position: absolute;',
      ),
      'answer' => 0,
      'concept' => 'Images fluides',
      'explainFr' => '<code>max-width: 100%</code> limite l\'image à la largeur disponible et <code>height: auto</code> garde le ratio.',
      'explainDarija' => '<code>max-width: 100%</code> kay7ded image b 3ard li kayn w <code>height: auto</code> kay7fed ratio.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction CSS qui borne une taille entre un minimum et un maximum est ________().',
      'answer' => 'clamp',
      'concept' => 'clamp',
      'explainFr' => '<code>clamp(1.5rem, 4vw, 3rem)</code> choisit une valeur idéale bornée par min et max.',
      'explainDarija' => '<code>clamp(1.5rem, 4vw, 3rem)</code> kaykhtar valeur idéale m7doda b min w max.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi éviter width: 960px sur un conteneur principal ?',
      'options' => 
      array (
        0 => 'Cela crée un défilement horizontal sur mobile',
        1 => 'Cela supprime les images',
        2 => 'Cela désactive les media queries',
      ),
      'answer' => 0,
      'concept' => 'Largeurs fixes',
      'explainFr' => 'Une largeur fixe supérieure à l\'écran provoque un débordement horizontal.',
      'explainDarija' => '3ard fixe kbar men écran kay5leq débordement horizontal.',
    ),
  ),
);
