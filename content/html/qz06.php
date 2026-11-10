<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz06.php
 */

return array (
  'title' => 'Quiz — Tableaux',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle balise crée une cellule d\'en-tête ?',
      'options' => 
      array (
        0 => '<th>',
        1 => '<td>',
        2 => '<tr>',
      ),
      'answer' => 0,
      'concept' => 'th vs td',
      'explainFr' => '<code>th</code> est une cellule d\'en-tête, <code>td</code> une cellule de données.',
      'explainDarija' => '<code>th</code> cellule d\'en-tête, <code>td</code> cellule de données.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un tableau doit avoir une légende <caption> pour être valide.',
      'answer' => 1,
      'concept' => 'caption',
      'explainFr' => 'Faux : <code>caption</code> est recommandé pour l\'accessibilité, mais pas obligatoire.',
      'explainDarija' => 'Ghalt : <code>caption</code> mstahsan l accessibilité, walakin machi darouri.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel attribut fusionne deux colonnes ?',
      'options' => 
      array (
        0 => 'colspan="2"',
        1 => 'rowspan="2"',
        2 => 'merge="2"',
      ),
      'answer' => 0,
      'concept' => 'colspan',
      'explainFr' => '<code>colspan</code> fusionne horizontalement ; <code>rowspan</code> verticalement.',
      'explainDarija' => '<code>colspan</code> kayjem3 horizontalement ; <code>rowspan</code> verticalement.',
    ),
    3 => 
    array (
      'type' => 'mcq',
      'question' => 'Où se placent les lignes de données ?',
      'options' => 
      array (
        0 => 'Dans <tbody>',
        1 => 'Dans <thead>',
        2 => 'Dans <tfoot> uniquement',
      ),
      'answer' => 0,
      'concept' => 'Sections du tableau',
      'explainFr' => '<code>tbody</code> regroupe les lignes de données, <code>thead</code> les en-têtes.',
      'explainDarija' => '<code>tbody</code> kayjem3 lignes données, <code>thead</code> en-têtes.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel élément contient les lignes d\'un tableau ?',
      'options' => 
      array (
        0 => '<tr>',
        1 => '<table>',
        2 => '<td>',
      ),
      'answer' => 0,
      'concept' => 'Structure',
      'explainFr' => 'Chaque ligne est un <code>tr</code>, qui contient des <code>th</code> ou des <code>td</code>.',
      'explainDarija' => 'Kol ligne hiya <code>tr</code>, fiha <code>th</code> wla <code>td</code>.',
    ),
  ),
);
