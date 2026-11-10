<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz04.php
 */

return array (
  'title' => 'Quiz — Contraintes',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle contrainte identifie chaque ligne de façon unique ?',
      'options' => 
      array (
        0 => 'PRIMARY KEY',
        1 => 'NOT NULL',
        2 => 'DEFAULT',
      ),
      'answer' => 0,
      'concept' => 'PRIMARY KEY',
      'explainFr' => '<code>PRIMARY KEY</code> est unique et non nulle : elle identifie la ligne.',
      'explainDarija' => '<code>PRIMARY KEY</code> unique w machi khawya : kat3aref ligne.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'UNIQUE interdit les doublons dans une colonne.',
      'answer' => 0,
      'concept' => 'UNIQUE',
      'explainFr' => 'Vrai : deux lignes ne peuvent pas partager la même valeur dans cette colonne.',
      'explainDarija' => 'S7i7 : jouj lignes ma y9droch ycharko nefs valeur f had colonne.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle contrainte limite les valeurs acceptées ?',
      'options' => 
      array (
        0 => 'CHECK',
        1 => 'DEFAULT',
        2 => 'INDEX',
      ),
      'answer' => 0,
      'concept' => 'CHECK',
      'explainFr' => '<code>CHECK (montant >= 0)</code> refuse les valeurs qui ne respectent pas la règle.',
      'explainDarija' => '<code>CHECK (montant >= 0)</code> kayrefus valeurs li ma kay7trmoch qa3ida.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La contrainte qui relie une colonne à la clé primaire d\'une autre table est FOREIGN ________.',
      'answer' => 'KEY',
      'concept' => 'FOREIGN KEY',
      'explainFr' => '<code>FOREIGN KEY</code> garantit l\'intégrité référentielle entre deux tables.',
      'explainDarija' => '<code>FOREIGN KEY</code> kaddmen intégrité référentielle bin jouj tables.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que se passe-t-il si NOT NULL est violé ?',
      'options' => 
      array (
        0 => 'L\'insertion est refusée',
        1 => 'La valeur devient 0',
        2 => 'La colonne est supprimée',
      ),
      'answer' => 0,
      'concept' => 'NOT NULL',
      'explainFr' => 'La base rejette l\'opération qui tenterait de mettre NULL dans la colonne.',
      'explainDarija' => 'Base katrefus opération li kat7awel t7et NULL f colonne.',
    ),
  ),
);
