<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz07.php
 */

return array (
  'title' => 'Quiz — Tri et groupement',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause trie les résultats ?',
      'options' => 
      array (
        0 => 'ORDER BY',
        1 => 'GROUP BY',
        2 => 'WHERE',
      ),
      'answer' => 0,
      'concept' => 'ORDER BY',
      'explainFr' => '<code>ORDER BY</code> trie selon une ou plusieurs colonnes.',
      'explainDarija' => '<code>ORDER BY</code> kayrteb 3la 7sab colonne wla bzaf colonnes.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'ORDER BY valeur DESC place la plus grande valeur en premier.',
      'answer' => 0,
      'concept' => 'DESC',
      'explainFr' => 'Vrai : <code>DESC</code> signifie décroissant.',
      'explainDarija' => 'S7i7 : <code>DESC</code> kat3ni décroissant.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause limite le nombre de lignes renvoyées ?',
      'options' => 
      array (
        0 => 'LIMIT',
        1 => 'WHERE',
        2 => 'HAVING',
      ),
      'answer' => 0,
      'concept' => 'LIMIT',
      'explainFr' => '<code>LIMIT 3</code> garde seulement trois lignes après le tri.',
      'explainDarija' => '<code>LIMIT 3</code> kay7fed ghir tlata lignes mora tri.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La clause qui regroupe les lignes par valeur est ________ BY.',
      'answer' => 'GROUP',
      'concept' => 'GROUP BY',
      'explainFr' => '<code>GROUP BY filiere</code> crée un groupe par filière.',
      'explainDarija' => '<code>GROUP BY filiere</code> kat5leq groupe l kol filière.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause filtre les groupes après un GROUP BY ?',
      'options' => 
      array (
        0 => 'HAVING',
        1 => 'WHERE',
        2 => 'LIMIT',
      ),
      'answer' => 0,
      'concept' => 'HAVING',
      'explainFr' => '<code>HAVING</code> s\'applique aux groupes agrégés, <code>WHERE</code> aux lignes.',
      'explainDarija' => '<code>HAVING</code> kattbeq 3la groupes agrégés, <code>WHERE</code> 3la lignes.',
    ),
  ),
);
