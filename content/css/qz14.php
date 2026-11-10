<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz14.php
 */

return array (
  'title' => 'Quiz — Media queries',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle est la syntaxe correcte d\'une media query ?',
      'options' => 
      array (
        0 => '@media (min-width: 768px) { ... }',
        1 => 'media(min-width: 768px) { ... }',
        2 => '@media min-width = 768px { ... }',
      ),
      'answer' => 0,
      'concept' => 'Syntaxe',
      'explainFr' => 'On écrit <code>@media (condition) { règles }</code>.',
      'explainDarija' => 'Kanktbo <code>@media (condition) { règles }</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'En mobile-first, on utilise des min-width croissants.',
      'answer' => 0,
      'concept' => 'min-width',
      'explainFr' => 'Vrai : la base sert au mobile, puis les <code>min-width</code> enrichissent pour les écrans plus larges.',
      'explainDarija' => 'S7i7 : base l mobile, men ba3d <code>min-width</code> kayzido l écrans kbar.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Où choisit-on les points de rupture ?',
      'options' => 
      array (
        0 => 'Là où la mise en page commence à casser',
        1 => 'Aux dimensions exactes d\'un téléphone',
        2 => 'Toujours à 1200px',
      ),
      'answer' => 0,
      'concept' => 'Breakpoints',
      'explainFr' => 'Les breakpoints se choisissent selon le contenu, pas selon un modèle d\'appareil.',
      'explainDarija' => 'Breakpoints kaytkhtaro 3la 7sab contenu, machi 3la 7sab modèle d\'appareil.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La media query qui respecte les utilisateurs sensibles aux animations est prefers-________.',
      'answer' => 'reduced-motion',
      'concept' => 'Préférences',
      'explainFr' => '<code>prefers-reduced-motion: reduce</code> permet de réduire ou désactiver les animations.',
      'explainDarija' => '<code>prefers-reduced-motion: reduce</code> kaykhalli tnqes wla t7yed animations.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quelles media features existent ?',
      'options' => 
      array (
        0 => 'prefers-color-scheme',
        1 => 'prefers-reduced-motion',
        2 => 'orientation',
        3 => 'font-color',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Media features',
      'explainFr' => '<code>prefers-color-scheme</code>, <code>prefers-reduced-motion</code> et <code>orientation</code> sont valides ; <code>font-color</code> n\'existe pas.',
      'explainDarija' => '<code>prefers-color-scheme</code>, <code>prefers-reduced-motion</code> w <code>orientation</code> valides ; <code>font-color</code> ma kaynch.',
    ),
  ),
);
