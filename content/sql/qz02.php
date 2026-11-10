<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz02.php
 */

return array (
  'title' => 'Quiz — Types de données SQL',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel type stocke un nombre entier ?',
      'options' => 
      array (
        0 => 'INTEGER',
        1 => 'TEXT',
        2 => 'REAL',
      ),
      'answer' => 0,
      'concept' => 'INTEGER',
      'explainFr' => '<code>INTEGER</code> stocke des nombres entiers sans décimales.',
      'explainDarija' => '<code>INTEGER</code> kaykhzen ar9am s7a7 bla décimales.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'TEXT peut stocker une chaîne de caractères.',
      'answer' => 0,
      'concept' => 'TEXT',
      'explainFr' => 'Vrai : <code>TEXT</code> est prévu pour les chaînes de longueur variable.',
      'explainDarija' => 'S7i7 : <code>TEXT</code> mkhassas l chaînes b 3ard mokhtalef.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel type convient à un prix avec décimales ?',
      'options' => 
      array (
        0 => 'REAL ou DECIMAL',
        1 => 'INTEGER',
        2 => 'BOOLEAN',
      ),
      'answer' => 0,
      'concept' => 'Nombres décimaux',
      'explainFr' => '<code>REAL</code> ou <code>DECIMAL(10,2)</code> conservent les décimales d\'un montant.',
      'explainDarija' => '<code>REAL</code> wla <code>DECIMAL(10,2)</code> kay7fedo décimales dyal montant.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le type SQL qui stocke une date est ________.',
      'answer' => 'DATE',
      'concept' => 'DATE',
      'explainFr' => '<code>DATE</code> documente une date au format AAAA-MM-JJ (stockée comme texte en SQLite).',
      'explainDarija' => '<code>DATE</code> katwsef date b format AAAA-MM-JJ (mkhezna b7al texte f SQLite).',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quels types sont couramment utilisés en SQL ?',
      'options' => 
      array (
        0 => 'INTEGER',
        1 => 'TEXT',
        2 => 'REAL',
        3 => 'SCREEN',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Types courants',
      'explainFr' => '<code>INTEGER</code>, <code>TEXT</code> et <code>REAL</code> sont des types standard ; <code>SCREEN</code> n\'existe pas.',
      'explainDarija' => '<code>INTEGER</code>, <code>TEXT</code> w <code>REAL</code> types standard ; <code>SCREEN</code> ma kaynch.',
    ),
  ),
);
