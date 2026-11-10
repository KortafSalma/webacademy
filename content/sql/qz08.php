<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz08.php
 */

return array (
  'title' => 'Quiz — Fonctions d\'agrégation',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction compte les lignes ?',
      'options' => 
      array (
        0 => 'COUNT(*)',
        1 => 'SUM(*)',
        2 => 'TOTAL(*)',
      ),
      'answer' => 0,
      'concept' => 'COUNT',
      'explainFr' => '<code>COUNT(*)</code> compte toutes les lignes d\'un groupe ou d\'une table.',
      'explainDarija' => '<code>COUNT(*)</code> kat7seb kol lignes dyal groupe wla table.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'AVG() ignore les valeurs NULL.',
      'answer' => 0,
      'concept' => 'AVG et NULL',
      'explainFr' => 'Vrai : les fonctions d\'agrégation ignorent généralement les NULL.',
      'explainDarija' => 'S7i7 : fonctions d\'agrégation ghaliban kaytjahlo NULL.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que renvoie MAX(valeur) ?',
      'options' => 
      array (
        0 => 'La plus grande valeur',
        1 => 'La moyenne',
        2 => 'Le nombre de valeurs',
      ),
      'answer' => 0,
      'concept' => 'MAX',
      'explainFr' => '<code>MAX()</code> renvoie la valeur maximale de la colonne.',
      'explainDarija' => '<code>MAX()</code> katrje3 valeur maximale dyal colonne.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui additionne les valeurs est ________().',
      'answer' => 'SUM',
      'concept' => 'SUM',
      'explainFr' => '<code>SUM(valeur)</code> renvoie la somme des valeurs numériques.',
      'explainDarija' => '<code>SUM(valeur)</code> katrje3 somme dyal valeurs numériques.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Une requête avec COUNT sans GROUP BY renvoie…',
      'options' => 
      array (
        0 => 'Une seule ligne',
        1 => 'Autant de lignes que la table',
        2 => 'Aucune ligne',
      ),
      'answer' => 0,
      'concept' => 'Agrégat global',
      'explainFr' => 'Sans <code>GROUP BY</code>, l\'agrégat porte sur toute la table et renvoie une ligne.',
      'explainDarija' => 'Bla <code>GROUP BY</code>, agrégat kay3ni table kamla w kayrje3 ligne wa7da.',
    ),
  ),
);
