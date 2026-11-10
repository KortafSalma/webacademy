<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex05.php
 */

return array (
  'id' => 'sql-ex5',
  'title' => 'DML',
  'brief' => 'Insérer, modifier et supprimer des données.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — INSERT',
      'lang' => 'sql',
      'instructions' => '<p>Insère un étudiant <code>Nadia</code>, <code>Alami</code>, filière <code>GI</code>, email <code>nadia@example.ma</code>. Utilise <code>INSERT OR IGNORE</code> pour éviter un doublon, puis vérifie avec un <code>SELECT</code>.</p>',
      'instructionsDarija' => '<p>Dkhel étudiant <code>Nadia</code>, <code>Alami</code>, filière <code>GI</code>, email <code>nadia@example.ma</code>. Khdem b <code>INSERT OR IGNORE</code> bach tmna3 doublon, men ba3d t7eqqeq b <code>SELECT</code>.</p>',
      'starter' => '-- INSERT puis SELECT
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
          'value' => 'nadia@example.ma',
        ),
      ),
      'hints' => 
      array (
        0 => 'INSERT INTO table (colonnes) VALUES (...)',
        1 => 'Les textes s\'écrivent entre guillemets simples.',
        2 => 'INSERT OR IGNORE ignore la ligne si une contrainte UNIQUE échoue.',
      ),
      'solution' => 'INSERT OR IGNORE INTO etudiant (nom, prenom, filiere, email)
VALUES (\'Nadia\', \'Alami\', \'GI\', \'nadia@example.ma\');

SELECT nom, prenom, email FROM etudiant WHERE email = \'nadia@example.ma\';',
      'explainFr' => '<code>INSERT</code> ajoute une ligne. <code>OR IGNORE</code> rend l\'opération rejouable : si l\'email existe déjà, la base ignore l\'insertion au lieu de provoquer une erreur.',
      'explainDarija' => '<code>INSERT</code> katzid ligne. <code>OR IGNORE</code> kat3mel opération t9der t3awedha : ila email kayn, base kattjahl insertion blast ma t3ti erreur.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — UPDATE',
      'lang' => 'sql',
      'instructions' => '<p>Modifie la filière de l\'étudiant dont l\'email est <code>omar@example.ma</code> pour la mettre à <code>GI</code>, puis affiche son nom et sa filière.</p>',
      'instructionsDarija' => '<p>Beddel filière dyal étudiant li email dyalo <code>omar@example.ma</code> l <code>GI</code>, men ba3d 3red smiya w filière dyalo.</p>',
      'starter' => '-- UPDATE puis SELECT
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
          'value' => 'GI',
        ),
      ),
      'hints' => 
      array (
        0 => 'UPDATE table SET colonne = valeur WHERE condition.',
        1 => 'Le WHERE limite les lignes modifiées.',
        2 => 'Sans WHERE, toutes les lignes seraient touchées.',
      ),
      'solution' => 'UPDATE etudiant
SET filiere = \'GI\'
WHERE email = \'omar@example.ma\';

SELECT nom, filiere FROM etudiant WHERE email = \'omar@example.ma\';',
      'explainFr' => 'La clause <code>WHERE</code> cible une seule ligne. L\'opération est idempotente : la relancer conserve la même filière.',
      'explainDarija' => 'Clause <code>WHERE</code> katcibli ligne wa7da. Opération idempotente : ila t3awdat, filière katbqa nefs.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — DELETE',
      'lang' => 'sql',
      'instructions' => '<p>Supprime les notes strictement inférieures à <code>10</code>, puis vérifie qu\'il n\'en reste aucune avec <code>COUNT(*)</code>.</p>',
      'instructionsDarija' => '<p>7yed notes li 9el men <code>10</code> b dqiq, men ba3d t7eqqeq belli ma bqatch walou b <code>COUNT(*)</code>.</p>',
      'starter' => '-- DELETE puis COUNT
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
          'value' => '0',
        ),
      ),
      'hints' => 
      array (
        0 => 'DELETE FROM table WHERE condition.',
        1 => 'COUNT(*) compte les lignes restantes.',
        2 => 'Une suppression sans WHERE viderait toute la table.',
      ),
      'solution' => 'DELETE FROM note
WHERE valeur < 10;

SELECT COUNT(*) AS restantes FROM note WHERE valeur < 10;',
      'explainFr' => 'Seules les notes sous 10 sont supprimées. Le second <code>SELECT</code> renvoie 0, ce qui confirme que la suppression a bien ciblé les bonnes lignes.',
      'explainDarija' => 'Ghir notes ta7t 10 li tmes7o. <code>SELECT</code> tani kayrje3 0, w hada kay2ekked suppression ciblat lignes s7i7in.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
