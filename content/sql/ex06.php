<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex06.php
 */

return array (
  'id' => 'sql-ex6',
  'title' => 'Filtrage (WHERE)',
  'brief' => 'Sélectionner des lignes avec des conditions précises.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — égalité',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom et le prénom des étudiants de la filière <code>GI</code>.</p>',
      'instructionsDarija' => '<p>3red smiya w prénom dyal étudiants f filière <code>GI</code>.</p>',
      'starter' => '-- SELECT ... WHERE
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
          'type' => 'row_count',
          'value' => '3',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Kortaf',
        ),
      ),
      'hints' => 
      array (
        0 => 'WHERE filiere = \'GI\' filtre les lignes.',
        1 => 'Les chaînes sont entre guillemets simples.',
        2 => 'Trois étudiants sont en GI dans le jeu de données.',
      ),
      'solution' => 'SELECT nom, prenom
FROM etudiant
WHERE filiere = \'GI\';',
      'explainFr' => 'Le filtre compare chaque ligne à <code>\'GI\'</code>. Trois étudiants correspondent : Kortaf, Marzak et Sekkat.',
      'explainDarija' => 'Filtre kayqaren kol ligne m3a <code>\'GI\'</code>. Tlata étudiants kaymatcho : Kortaf, Marzak w Sekkat.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — comparaison numérique',
      'lang' => 'sql',
      'instructions' => '<p>Affiche les notes supérieures ou égales à <code>16</code> avec l\'identifiant de l\'étudiant et la valeur.</p>',
      'instructionsDarija' => '<p>3red notes li kbarin wla sawiyin <code>16</code> m3a identifiant dyal étudiant w valeur.</p>',
      'starter' => '-- SELECT ... WHERE valeur
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
          'type' => 'row_count',
          'value' => '3',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '18.5',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'opérateur >= inclut la valeur limite.',
        1 => 'Les nombres s\'écrivent sans guillemets.',
        2 => 'Trois notes atteignent au moins 16.',
      ),
      'solution' => 'SELECT etudiant_id, valeur
FROM note
WHERE valeur >= 16;',
      'explainFr' => 'Le filtre numérique garde 16.0, 17.0 et 18.5. Les notes 14.5 et inférieures sont exclues.',
      'explainDarija' => 'Filtre numérique kay7fed 16.0, 17.0 w 18.5. Notes 14.5 w ta7t kayt7ydo.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — LIKE et OR',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom et le prénom des étudiants dont le prénom commence par <code>A</code> ou dont l\'email contient <code>omar</code>.</p>',
      'instructionsDarija' => '<p>3red smiya w prénom dyal étudiants li prénom dyalo kaybda b <code>A</code> wla email dyalo fih <code>omar</code>.</p>',
      'starter' => '-- SELECT ... WHERE ... OR ...
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
          'value' => 'Anas',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Omar',
        ),
      ),
      'hints' => 
      array (
        0 => 'LIKE \'A%\' cherche les valeurs qui commencent par A.',
        1 => '\'%omar%\' cherche la sous-chaîne omar n\'importe où.',
        2 => 'OR combine deux conditions alternatives.',
      ),
      'solution' => 'SELECT nom, prenom
FROM etudiant
WHERE prenom LIKE \'A%\'
   OR email LIKE \'%omar%\';',
      'explainFr' => '<code>LIKE \'A%\'</code> trouve Anas, et <code>LIKE \'%omar%\'</code> trouve Omar. Le <code>OR</code> renvoie les lignes qui satisfont au moins une condition.',
      'explainDarija' => '<code>LIKE \'A%\'</code> katlqa Anas, w <code>LIKE \'%omar%\'</code> katlqa Omar. <code>OR</code> kayrje3 lignes li kay7eqqo 3la l9al condition wa7da.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
