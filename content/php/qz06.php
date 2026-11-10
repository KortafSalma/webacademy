<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz06.php
 */

return array (
  'title' => 'Quiz — Tableaux (arrays)',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction renvoie le nombre d\'éléments d\'un tableau ?',
      'options' => 
      array (
        0 => 'count()',
        1 => 'max()',
        2 => 'implode()',
      ),
      'answer' => 0,
      'concept' => 'count',
      'explainFr' => '<code>count($tableau)</code> renvoie le nombre d\'éléments.',
      'explainDarija' => '<code>count($tableau)</code> katrje3 3adad éléments.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un tableau associatif utilise des clés nommées.',
      'answer' => 0,
      'concept' => 'Tableau associatif',
      'explainFr' => 'Vrai : chaque valeur est associée à une clé comme <code>\'nom\'</code> ou <code>\'ville\'</code>.',
      'explainDarija' => 'S7i7 : kol valeur mrbouta b clé b7al <code>\'nom\'</code> wla <code>\'ville\'</code>.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction transforme un tableau en chaîne ?',
      'options' => 
      array (
        0 => 'implode()',
        1 => 'explode()',
        2 => 'sort()',
      ),
      'answer' => 0,
      'concept' => 'implode',
      'explainFr' => '<code>implode(\', \', $t)</code> colle les valeurs avec un séparateur.',
      'explainDarija' => '<code>implode(\', \', $t)</code> kayls9 valeurs b séparateur.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui trie un tableau par ordre croissant est ________().',
      'answer' => 'sort',
      'concept' => 'Tri',
      'explainFr' => '<code>sort()</code> réordonne les valeurs du tableau sur place.',
      'explainDarija' => '<code>sort()</code> kayrteb valeurs dyal tableau f blaso.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment accéder à la valeur de clé nom dans $etudiant ?',
      'options' => 
      array (
        0 => '$etudiant[\'nom\']',
        1 => '$etudiant(0)',
        2 => '$etudiant->nom',
      ),
      'answer' => 0,
      'concept' => 'Accès par clé',
      'explainFr' => 'On utilise les crochets avec la clé : <code>$etudiant[\'nom\']</code>.',
      'explainDarija' => 'Kankhdmo crochets m3a clé : <code>$etudiant[\'nom\']</code>.',
    ),
  ),
);
