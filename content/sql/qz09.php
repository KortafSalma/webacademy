<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz09.php
 */

return array (
  'title' => 'Quiz — Joins',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clause indique la condition de jointure ?',
      'options' => 
      array (
        0 => 'ON',
        1 => 'WHERE',
        2 => 'ORDER BY',
      ),
      'answer' => 0,
      'concept' => 'ON',
      'explainFr' => '<code>ON e.id = n.etudiant_id</code> relie les lignes de deux tables.',
      'explainDarija' => '<code>ON e.id = n.etudiant_id</code> kayrbet lignes dyal jouj tables.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'INNER JOIN ne renvoie que les lignes qui ont une correspondance dans les deux tables.',
      'answer' => 0,
      'concept' => 'INNER JOIN',
      'explainFr' => 'Vrai : les lignes sans correspondance sont exclues.',
      'explainDarija' => 'S7i7 : lignes bla correspondance kayt7ydo.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel join conserve toutes les lignes de la table de gauche ?',
      'options' => 
      array (
        0 => 'LEFT JOIN',
        1 => 'INNER JOIN',
        2 => 'CROSS JOIN',
      ),
      'answer' => 0,
      'concept' => 'LEFT JOIN',
      'explainFr' => '<code>LEFT JOIN</code> garde les lignes de gauche, même sans correspondance à droite.',
      'explainDarija' => '<code>LEFT JOIN</code> kay7fed lignes dyal liser, 7ta bla correspondance f limen.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Un alias de table s\'écrit après le nom : FROM etudiant ________.',
      'answer' => 'e',
      'concept' => 'Alias',
      'explainFr' => '<code>FROM etudiant e</code> permet ensuite d\'écrire <code>e.nom</code>.',
      'explainDarija' => '<code>FROM etudiant e</code> kaykhalli men ba3d tkteb <code>e.nom</code>.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment détecter une absence de correspondance après LEFT JOIN ?',
      'options' => 
      array (
        0 => 'WHERE table.id IS NULL',
        1 => 'WHERE table.id = 0',
        2 => 'ORDER BY table.id',
      ),
      'answer' => 0,
      'concept' => 'IS NULL',
      'explainFr' => 'Une colonne NULL signifie qu\'aucune ligne de droite ne correspond.',
      'explainDarija' => 'Colonne NULL kat3ni 7ta ligne f limen ma kattmatch.',
    ),
  ),
);
