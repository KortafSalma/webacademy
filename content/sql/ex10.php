<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex10.php
 */

return array (
  'id' => 'sql-ex10',
  'title' => 'Sous-requêtes',
  'brief' => 'Utiliser le résultat d\'une requête dans une autre.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — sous-requête scalaire',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom des étudiants qui ont au moins une note supérieure à la moyenne générale. Calcule la moyenne avec une sous-requête <code>(SELECT AVG(valeur) FROM note)</code>.</p>',
      'instructionsDarija' => '<p>3red smiya dyal étudiants li 3ndhom 3la l9al note kbira men moyenne 3amma. 7seb moyenne b sous-requête <code>(SELECT AVG(valeur) FROM note)</code>.</p>',
      'starter' => '-- WHERE valeur > (SELECT AVG...)
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
          'value' => 'Sekkat',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une sous-requête scalaire renvoie une seule valeur.',
        1 => 'Elle peut être utilisée dans un WHERE.',
        2 => 'DISTINCT évite les doublons d\'étudiants.',
      ),
      'solution' => 'SELECT DISTINCT e.nom
FROM etudiant e
JOIN note n ON n.etudiant_id = e.id
WHERE n.valeur > (SELECT AVG(valeur) FROM note);',
      'explainFr' => 'La moyenne générale vaut 13.83. Les notes supérieures appartiennent à Kortaf, Marzak et Sekkat ; <code>DISTINCT</code> évite de répéter un nom.',
      'explainDarija' => 'Moyenne 3amma 13.83. Notes l-foq dyal Kortaf, Marzak w Sekkat ; <code>DISTINCT</code> kaymna3 tkrar smiya.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — meilleure note',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom de l\'étudiant et la valeur de la meilleure note, en comparant <code>valeur</code> à <code>(SELECT MAX(valeur) FROM note)</code>.</p>',
      'instructionsDarija' => '<p>3red smiya dyal étudiant w valeur dyal 7sen note, b comparaison <code>valeur</code> m3a <code>(SELECT MAX(valeur) FROM note)</code>.</p>',
      'starter' => '-- WHERE valeur = (SELECT MAX...)
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
          'value' => 'Sekkat',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '18.5',
        ),
      ),
      'hints' => 
      array (
        0 => 'MAX renvoie 18.5 dans le jeu de données.',
        1 => 'La sous-requête évite d\'écrire 18.5 en dur.',
        2 => 'La jointure retrouve le nom de l\'étudiant.',
      ),
      'solution' => 'SELECT e.nom, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
WHERE n.valeur = (SELECT MAX(valeur) FROM note);',
      'explainFr' => 'La sous-requête calcule la note maximale, puis le filtre garde la ligne correspondante. Le résultat reste correct même si les données changent.',
      'explainDarija' => 'Sous-requête kat7seb note maximale, men ba3d filtre kay7fed ligne li tmatch. Résultat kaybqa s7i7 7ta ila données tbeddlo.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — EXISTS corrélé',
      'lang' => 'sql',
      'instructions' => '<p>Affiche le nom des étudiants qui ont une note dans la matière <code>PHP</code> (identifiant 2), avec une sous-requête <code>EXISTS</code> corrélée.</p>',
      'instructionsDarija' => '<p>3red smiya dyal étudiants li 3ndhom note f matière <code>PHP</code> (identifiant 2), b sous-requête <code>EXISTS</code> corrélée.</p>',
      'starter' => '-- WHERE EXISTS (SELECT 1 ...)
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
          'value' => 'Sekkat',
        ),
      ),
      'hints' => 
      array (
        0 => 'EXISTS est vrai dès qu\'une ligne correspond.',
        1 => 'La sous-requête référence e.id : elle est corrélée.',
        2 => 'Pas besoin de DISTINCT avec EXISTS.',
      ),
      'solution' => 'SELECT e.nom
FROM etudiant e
WHERE EXISTS (
    SELECT 1
    FROM note n
    WHERE n.etudiant_id = e.id
      AND n.matiere_id = 2
);',
      'explainFr' => '<code>EXISTS</code> s\'arrête à la première note de PHP trouvée pour chaque étudiant. Kortaf, Marzak et Sekkat sont renvoyés, sans doublon.',
      'explainDarija' => '<code>EXISTS</code> kayweqqef f awwel note dyal PHP li kaylqa l kol étudiant. Kortaf, Marzak w Sekkat kayrje3o, bla tkrar.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
