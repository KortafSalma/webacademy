<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex08.php
 */

return array (
  'id' => 'sql-ex8',
  'title' => 'Fonctions d\'agrégation',
  'brief' => 'Compter, sommer et calculer des moyennes.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — COUNT et MAX',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nombre total de notes et la note maximale avec <code>COUNT(*)</code> et <code>MAX(valeur)</code>.</p>',
      'instructionsDarija' => '<p>3red 3adad kamel dyal notes w note maximale b <code>COUNT(*)</code> w <code>MAX(valeur)</code>.</p>',
      'starter' => '-- SELECT COUNT(*), MAX(...)
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => '10',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '18.5',
        ),
      ),
      'hints' => 
      array (
        0 => 'COUNT(*) compte les lignes.',
        1 => 'MAX(valeur) renvoie la plus grande valeur.',
        2 => 'Les deux fonctions s\'utilisent dans le même SELECT.',
      ),
      'solution' => 'SELECT COUNT(*) AS total, MAX(valeur) AS maximum
FROM note;',
      'explainFr' => 'Le jeu de données contient 10 notes, et la plus élevée vaut 18.5. Une requête d\'agrégation sans GROUP BY renvoie une seule ligne.',
      'explainDarija' => 'Jeu de données fih 10 notes, w l-foq 18.5. Requête d\'agrégation bla GROUP BY katrje3 ligne wa7da.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — AVG, MIN et MAX',
      'lang' => 'sql',
      'instructions' => '<p>Affiche la moyenne arrondie à deux décimales, la note minimale et la note maximale.</p>',
      'instructionsDarija' => '<p>3red moyenne mroundiya l jouj décimales, note minimale w note maximale.</p>',
      'starter' => '-- AVG, MIN, MAX
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => '13.83',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '9',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '18.5',
        ),
      ),
      'hints' => 
      array (
        0 => 'AVG(valeur) calcule la moyenne.',
        1 => 'MIN et MAX donnent les bornes.',
        2 => 'ROUND(..., 2) limite les décimales affichées.',
      ),
      'solution' => 'SELECT ROUND(AVG(valeur), 2) AS moyenne,
       MIN(valeur) AS minimum,
       MAX(valeur) AS maximum
FROM note;',
      'explainFr' => 'La somme des notes vaut 138.3 pour 10 notes, soit une moyenne de 13.83. La plus basse est 9.0 et la plus haute 18.5.',
      'explainDarija' => 'Somme dyal notes 138.3 3la 10 notes, ya3ni moyenne 13.83. L-sghira 9.0 w l-kbira 18.5.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — agrégation conditionnelle',
      'lang' => 'sql',
      'instructions' => '<p>Compte combien de notes sont supérieures ou égales à <code>15</code> avec <code>SUM(CASE WHEN valeur &gt;= 15 THEN 1 ELSE 0 END)</code>, et affiche l\'alias <code>admis</code>.</p>',
      'instructionsDarija' => '<p>7seb sh7al note kbira wla sawiya <code>15</code> b <code>SUM(CASE WHEN valeur &gt;= 15 THEN 1 ELSE 0 END)</code>, w 3red alias <code>admis</code>.</p>',
      'starter' => '-- SUM(CASE WHEN ...)
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => '4',
        ),
      ),
      'hints' => 
      array (
        0 => 'CASE renvoie 1 quand la condition est vraie, 0 sinon.',
        1 => 'SUM additionne ces 1 et 0.',
        2 => 'C\'est un comptage conditionnel.',
      ),
      'solution' => 'SELECT SUM(CASE WHEN valeur >= 15 THEN 1 ELSE 0 END) AS admis
FROM note;',
      'explainFr' => 'Quatre notes atteignent 15 ou plus : 16.0, 15.0, 17.0 et 18.5. La somme des indicateurs vaut donc 4.',
      'explainDarija' => 'Rba3 notes kaywselo 15 wla ktar : 16.0, 15.0, 17.0 w 18.5. Somme dyal indicateurs = 4.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
