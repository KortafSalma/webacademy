<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz11.php
 */

return array (
  'title' => 'Quiz — Relations entre tables',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel type de relation une table de jonction modélise-t-elle ?',
      'options' => 
      array (
        0 => 'Many-to-many',
        1 => 'One-to-one uniquement',
        2 => 'Aucune relation',
      ),
      'answer' => 0,
      'concept' => 'Table de jonction',
      'explainFr' => 'Une table de jonction relie deux tables qui ont une relation many-to-many.',
      'explainDarija' => 'Table de jonction katrbet jouj tables li 3ndhom relation many-to-many.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une clé étrangère peut référencer la clé primaire d\'une autre table.',
      'answer' => 0,
      'concept' => 'Clé étrangère',
      'explainFr' => 'Vrai : la clé étrangère pointe vers une clé unique de la table référencée.',
      'explainDarija' => 'S7i7 : clé étrangère kat3ayer l clé unique f table mrbouta.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que garantit une clé primaire composite ?',
      'options' => 
      array (
        0 => 'L\'unicité de la combinaison des colonnes',
        1 => 'L\'unicité de chaque colonne séparément',
        2 => 'La suppression automatique des doublons',
      ),
      'answer' => 0,
      'concept' => 'Clé composite',
      'explainFr' => 'La combinaison doit être unique, mais chaque colonne prise seule peut se répéter.',
      'explainDarija' => 'Combinaison khas tkoun unique, walakin kol colonne b wa7edha t9der t3awed.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La contrainte qui relie une table à une autre est FOREIGN ________.',
      'answer' => 'KEY',
      'concept' => 'FOREIGN KEY',
      'explainFr' => 'FOREIGN KEY garantit que la valeur existe dans la table référencée.',
      'explainDarija' => 'FOREIGN KEY kaddmen valeur katbqa kayna f table mrbouta.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quelles affirmations sont vraies sur une relation many-to-many ?',
      'options' => 
      array (
        0 => 'Elle nécessite une table de jonction',
        1 => 'Elle stocke une paire de clés étrangères',
        2 => 'Elle interdit les doublons avec une clé composite',
        3 => 'Elle se crée avec un seul FOREIGN KEY dans la table principale',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Relation many-to-many',
      'explainFr' => 'La table de jonction porte les deux clés étrangères et une clé composite qui évite les doublons.',
      'explainDarija' => 'Table de jonction kat7mel jouj clés étrangères w clé composite li kamna3 tkrar.',
    ),
  ),
);
