<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex09.php
 */

return array (
  'id' => 'sql-ex9',
  'title' => 'Joins',
  'brief' => 'Combiner plusieurs tables avec INNER et LEFT JOIN.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — INNER JOIN',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom de l\'étudiant et sa note pour toutes les notes supérieures ou égales à <code>16</code>.</p>',
      'instructionsDarija' => '<p>3red smiya dyal étudiant w note dyalo l kol notes kbarin wla sawiyin <code>16</code>.</p>',
      'starter' => '-- JOIN etudiant / note
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
        0 => 'JOIN relie les lignes grâce à une condition ON.',
        1 => 'e.id = n.etudiant_id fait la correspondance.',
        2 => 'Le WHERE filtre ensuite les notes.',
      ),
      'solution' => 'SELECT e.nom, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
WHERE n.valeur >= 16;',
      'explainFr' => 'La jointure retrouve l\'étudiant de chaque note, puis le filtre garde 16.0, 17.0 et 18.5. Trois lignes sont renvoyées.',
      'explainDarija' => 'Jointure katlqa étudiant dyal kol note, men ba3d filtre kay7fed 16.0, 17.0 w 18.5. Tlata lignes kayrje3o.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — trois tables',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom de l\'étudiant, le nom de la matière et la valeur pour les notes de la matière <code>Math</code>.</p>',
      'instructionsDarija' => '<p>3red smiya dyal étudiant, smiya dyal matière w valeur l notes dyal matière <code>Math</code>.</p>',
      'starter' => '-- JOIN etudiant, matiere, note
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
          'value' => 'Marzak',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Math',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '17',
        ),
      ),
      'hints' => 
      array (
        0 => 'Chaque table apporte une information différente.',
        1 => 'On enchaîne deux JOIN.',
        2 => 'Le WHERE peut porter sur m.nom.',
      ),
      'solution' => 'SELECT e.nom, m.nom AS matiere, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
JOIN matiere m ON m.id = n.matiere_id
WHERE m.nom = \'Math\';',
      'explainFr' => 'La première jointure identifie l\'étudiant, la seconde la matière. On obtient les quatre notes de Math, dont celle de Marzak à 17.0.',
      'explainDarija' => 'Jointure lawla kat3aref étudiant, tanya matière. Kankhdmo rba3 notes dyal Math, fihom dyal Marzak b 17.0.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — LEFT JOIN et IS NULL',
      'lang' => 'sql',
      'instructions' => '<p>Affiche l\'étudiant, la matière et la valeur des notes qui n\'ont <em>aucun</em> professeur associé. Utilise <code>LEFT JOIN</code> vers <code>professeur</code> et <code>p.id IS NULL</code>.</p>',
      'instructionsDarija' => '<p>3red étudiant, matière w valeur dyal notes li <em>ma 3ndhomch</em> professeur mrbout. Khdem b <code>LEFT JOIN</code> l <code>professeur</code> w <code>p.id IS NULL</code>.</p>',
      'starter' => '-- LEFT JOIN ... IS NULL
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
          'value' => 'Boukhriss',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Anglais',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '13',
        ),
      ),
      'hints' => 
      array (
        0 => 'LEFT JOIN conserve les notes même sans professeur.',
        1 => 'p.id IS NULL détecte l\'absence de correspondance.',
        2 => 'On joint aussi etudiant et matiere pour des noms lisibles.',
      ),
      'solution' => 'SELECT e.nom, m.nom AS matiere, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
JOIN matiere m ON m.id = n.matiere_id
LEFT JOIN professeur p ON p.id = n.professeur_id
WHERE p.id IS NULL;',
      'explainFr' => 'La note d\'Anglais de Boukhriss a un <code>professeur_id</code> NULL. Le <code>LEFT JOIN</code> la conserve, et le filtre <code>IS NULL</code> isole précisément ce cas.',
      'explainDarija' => 'Note d\'Anglais dyal Boukhriss 3ndha <code>professeur_id</code> NULL. <code>LEFT JOIN</code> kay7fedha, w filtre <code>IS NULL</code> kay3zel had cas.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
