<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz05.php
 */

return array (
  'title' => 'Quiz — DML',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle commande ajoute une ligne ?',
      'options' => 
      array (
        0 => 'INSERT',
        1 => 'UPDATE',
        2 => 'DELETE',
      ),
      'answer' => 0,
      'concept' => 'INSERT',
      'explainFr' => '<code>INSERT INTO ... VALUES ...</code> ajoute une nouvelle ligne.',
      'explainDarija' => '<code>INSERT INTO ... VALUES ...</code> katzid ligne jdida.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un UPDATE sans WHERE modifie toutes les lignes de la table.',
      'answer' => 0,
      'concept' => 'UPDATE sans WHERE',
      'explainFr' => 'Vrai : sans filtre, la modification s\'applique à toute la table.',
      'explainDarija' => 'S7i7 : bla filtre, modification kattbeq 3la table kamla.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle commande supprime des lignes ?',
      'options' => 
      array (
        0 => 'DELETE',
        1 => 'DROP',
        2 => 'ALTER',
      ),
      'answer' => 0,
      'concept' => 'DELETE',
      'explainFr' => '<code>DELETE FROM</code> supprime des lignes ; <code>DROP</code> supprime la table entière.',
      'explainDarija' => '<code>DELETE FROM</code> kat7yed lignes ; <code>DROP</code> kat7yed table kamla.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Pour éviter un doublon sur un email unique, on peut utiliser INSERT OR ________.',
      'answer' => 'IGNORE',
      'concept' => 'INSERT OR IGNORE',
      'explainFr' => '<code>INSERT OR IGNORE</code> ignore l\'insertion si une contrainte échoue.',
      'explainDarija' => '<code>INSERT OR IGNORE</code> kaytjahl insertion ila contrainte fchlat.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause cible les lignes à modifier ?',
      'options' => 
      array (
        0 => 'WHERE',
        1 => 'ORDER BY',
        2 => 'GROUP BY',
      ),
      'answer' => 0,
      'concept' => 'WHERE',
      'explainFr' => '<code>WHERE</code> limite l\'action aux lignes qui respectent la condition.',
      'explainDarija' => '<code>WHERE</code> kay7ded action 3la lignes li kay7trmo condition.',
    ),
  ),
);
