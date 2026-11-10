<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz08.php
 */

return array (
  'title' => 'Quiz — Fonctions de chaînes',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Que renvoie strlen("PHP") ?',
      'options' => 
      array (
        0 => '3',
        1 => '2',
        2 => '1',
      ),
      'answer' => 0,
      'concept' => 'strlen',
      'explainFr' => '<code>strlen()</code> compte les caractères : P, H et P font 3.',
      'explainDarija' => '<code>strlen()</code> kat7seb caractères : P, H w P = 3.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'strtoupper() modifie la variable d\'origine.',
      'answer' => 1,
      'concept' => 'Valeur de retour',
      'explainFr' => 'Faux : elle renvoie une nouvelle chaîne ; il faut réaffecter le résultat pour le conserver.',
      'explainDarija' => 'Ghalt : katrje3 chaîne jdida ; khas t3awed t3ti résultat bach ytbqa.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction supprime les espaces au début et à la fin ?',
      'options' => 
      array (
        0 => 'trim()',
        1 => 'str_replace()',
        2 => 'explode()',
      ),
      'answer' => 0,
      'concept' => 'trim',
      'explainFr' => '<code>trim()</code> nettoie les espaces parasites autour d\'une chaîne.',
      'explainDarija' => '<code>trim()</code> katnqqi espaces zaydin 3la tarafin dyal chaîne.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui découpe une chaîne en tableau selon un séparateur est ________().',
      'answer' => 'explode',
      'concept' => 'explode',
      'explainFr' => '<code>explode(\',\', $csv)</code> découpe la chaîne à chaque virgule.',
      'explainDarija' => '<code>explode(\',\', $csv)</code> katqsem chaîne 3nd kol virgule.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction recolle un tableau en chaîne ?',
      'options' => 
      array (
        0 => 'implode()',
        1 => 'explode()',
        2 => 'strlen()',
      ),
      'answer' => 0,
      'concept' => 'implode',
      'explainFr' => '<code>implode(\' - \', $t)</code> réunit les valeurs avec le séparateur donné.',
      'explainDarija' => '<code>implode(\' - \', $t)</code> katjem3 valeurs b séparateur li 3titih.',
    ),
  ),
);
