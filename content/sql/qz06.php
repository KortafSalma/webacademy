<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz06.php
 */

return array (
  'title' => 'Quiz — Filtrage (WHERE)',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause filtre les lignes ?',
      'options' => 
      array (
        0 => 'WHERE',
        1 => 'ORDER BY',
        2 => 'LIMIT',
      ),
      'answer' => 0,
      'concept' => 'WHERE',
      'explainFr' => '<code>WHERE</code> sélectionne les lignes selon une condition.',
      'explainDarija' => '<code>WHERE</code> katkhtar lignes 3la 7sab condition.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'L\'opérateur <> signifie différent de.',
      'answer' => 0,
      'concept' => 'Opérateurs',
      'explainFr' => 'Vrai : <code><></code> et <code>!=</code> testent la différence.',
      'explainDarija' => 'S7i7 : <code><></code> w <code>!=</code> kayt7eqqo men différence.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel opérateur cherche un motif de texte ?',
      'options' => 
      array (
        0 => 'LIKE',
        1 => 'BETWEEN',
        2 => 'IS NULL',
      ),
      'answer' => 0,
      'concept' => 'LIKE',
      'explainFr' => '<code>LIKE \'A%\'</code> cherche les valeurs qui commencent par A.',
      'explainDarija' => '<code>LIKE \'A%\'</code> kat9elleb 3la valeurs li kaybdaw b A.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Pour tester l\'absence de valeur, on écrit IS ________.',
      'answer' => 'NULL',
      'concept' => 'IS NULL',
      'explainFr' => '<code>IS NULL</code> teste une valeur absente ; <code>= NULL</code> ne fonctionne pas.',
      'explainDarija' => '<code>IS NULL</code> kat7eqqeq valeur ma kaynach ; <code>= NULL</code> ma kaykhdemch.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que fait BETWEEN 10 AND 20 ?',
      'options' => 
      array (
        0 => 'Teste si la valeur est dans l\'intervalle inclus',
        1 => 'Trie les valeurs',
        2 => 'Compte les valeurs',
      ),
      'answer' => 0,
      'concept' => 'BETWEEN',
      'explainFr' => '<code>BETWEEN</code> inclut les deux bornes.',
      'explainDarija' => '<code>BETWEEN</code> kaydakhel jouj bornes.',
    ),
  ),
);
