<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex07.php
 */

return array (
  'id' => 'sql-ex7',
  'title' => 'Tri et groupement',
  'brief' => 'Trier les résultats et regrouper les lignes.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — ORDER BY et LIMIT',
      'lang' => 'sql',
      'instructions' => '<p>Affiche les trois meilleures notes avec <code>etudiant_id</code> et <code>valeur</code>, de la plus haute à la plus basse.</p>',
      'instructionsDarija' => '<p>3red tlata notes l-foq b <code>etudiant_id</code> w <code>valeur</code>, men l-kbira l-sghira.</p>',
      'starter' => '-- SELECT ... ORDER BY ... LIMIT
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
        0 => 'ORDER BY valeur DESC trie de la plus grande à la plus petite.',
        1 => 'LIMIT 3 garde seulement trois lignes.',
        2 => 'Sans ORDER BY, l\'ordre n\'est pas garanti.',
      ),
      'solution' => 'SELECT etudiant_id, valeur
FROM note
ORDER BY valeur DESC
LIMIT 3;',
      'explainFr' => 'Le tri décroissant place 18.5 en tête, puis 17.0 et 16.0. <code>LIMIT 3</code> coupe après ces trois lignes.',
      'explainDarija' => 'Tri décroissant kay7et 18.5 f lwel, men ba3d 17.0 w 16.0. <code>LIMIT 3</code> kay9te3 mor had tlata lignes.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — GROUP BY',
      'lang' => 'sql',
      'instructions' => '<p>Compte le nombre d\'étudiants par filière avec <code>GROUP BY</code>. Affiche la filière et l\'alias <code>total</code>.</p>',
      'instructionsDarija' => '<p>7seb 3adad étudiants b kol filière b <code>GROUP BY</code>. 3red filière w alias <code>total</code>.</p>',
      'starter' => '-- SELECT filiere, COUNT(*)
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
          'value' => 'GI',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '3',
        ),
      ),
      'hints' => 
      array (
        0 => 'GROUP BY regroupe les lignes qui partagent la même filière.',
        1 => 'COUNT(*) compte les lignes de chaque groupe.',
        2 => 'Un alias rend la colonne lisible : AS total.',
      ),
      'solution' => 'SELECT filiere, COUNT(*) AS total
FROM etudiant
GROUP BY filiere;',
      'explainFr' => 'Chaque groupe correspond à une filière. GI contient trois étudiants, GC et 3IA en contiennent un chacun : trois lignes au total.',
      'explainDarija' => 'Kol groupe kaymatchi filière. GI fiha tlata étudiants, GC w 3IA fihom wa7ed kol wa7da : tlata lignes b kollha.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — moyenne par matière',
      'lang' => 'sql',
      'instructions' => '<p>Affiche <code>matiere_id</code> et la moyenne arrondie à deux décimales (<code>ROUND(AVG(valeur), 2)</code>) des notes, groupées par matière et triées de la moyenne la plus haute à la plus basse.</p>',
      'instructionsDarija' => '<p>3red <code>matiere_id</code> w moyenne mroundiya l jouj décimales (<code>ROUND(AVG(valeur), 2)</code>) dyal notes, mgroupées b matière w mrtbin men moyenne l-foq l ta7t.</p>',
      'starter' => '-- GROUP BY ... ORDER BY
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
          'value' => '4',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '15.67',
        ),
      ),
      'hints' => 
      array (
        0 => 'AVG() calcule la moyenne d\'un groupe.',
        1 => 'ROUND(valeur, 2) arrondit à deux décimales.',
        2 => 'ORDER BY moyenne DESC trie les groupes.',
      ),
      'solution' => 'SELECT matiere_id, ROUND(AVG(valeur), 2) AS moyenne
FROM note
GROUP BY matiere_id
ORDER BY moyenne DESC;',
      'explainFr' => 'La matière 2 (PHP) a la meilleure moyenne avec 15.67, suivie de la 3 (13.4), la 4 (13.0) et la 1 (12.88).',
      'explainDarija' => 'Matière 2 (PHP) 3ndha 7sen moyenne b 15.67, mora 3 (13.4), 4 (13.0) w 1 (12.88).',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
