<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz12.php
 */

return array (
  'title' => 'Quiz — Transactions',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle commande valide définitivement une transaction ?',
      'options' => 
      array (
        0 => 'COMMIT',
        1 => 'ROLLBACK',
        2 => 'BEGIN',
      ),
      'answer' => 0,
      'concept' => 'COMMIT',
      'explainFr' => 'COMMIT enregistre toutes les opérations de la transaction.',
      'explainDarija' => 'COMMIT kaysejjel kol opérations dyal transaction.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'ROLLBACK annule les modifications non validées.',
      'answer' => 0,
      'concept' => 'ROLLBACK',
      'explainFr' => 'Vrai : ROLLBACK défait les opérations depuis le dernier BEGIN ou SAVEPOINT.',
      'explainDarija' => 'S7i7 : ROLLBACK kayrje3 opérations men akhir BEGIN wla SAVEPOINT.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'À quoi sert SAVEPOINT ?',
      'options' => 
      array (
        0 => 'À créer un point intermédiaire dans une transaction',
        1 => 'À supprimer la base',
        2 => 'À créer un index',
      ),
      'answer' => 0,
      'concept' => 'SAVEPOINT',
      'explainFr' => 'SAVEPOINT permet d\'annuler une partie de la transaction sans perdre le reste.',
      'explainDarija' => 'SAVEPOINT kaykhalli tnqes 7aja men transaction bla ma tkhser li bqa.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La commande qui démarre une transaction en SQLite est ________.',
      'answer' => 'BEGIN',
      'concept' => 'BEGIN',
      'explainFr' => 'BEGIN ouvre une transaction qui sera validée par COMMIT ou annulée par ROLLBACK.',
      'explainDarija' => 'BEGIN kay7el transaction li ghadi tvalidi b COMMIT wla t3awed b ROLLBACK.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Après ROLLBACK TO nom_savepoint, que se passe-t-il ?',
      'options' => 
      array (
        0 => 'Les modifications après le savepoint sont annulées',
        1 => 'Toute la transaction est validée',
        2 => 'La table est supprimée',
      ),
      'answer' => 0,
      'concept' => 'ROLLBACK TO',
      'explainFr' => 'On revient au point marqué ; la transaction reste ouverte jusqu\'à COMMIT ou ROLLBACK.',
      'explainDarija' => 'Kanrje3o l point m3ellem ; transaction katbqa m7loula 7ta COMMIT wla ROLLBACK.',
    ),
  ),
);
