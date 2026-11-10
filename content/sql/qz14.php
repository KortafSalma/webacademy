<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz14.php
 */

return array (
  'title' => 'Quiz — Conception de bases',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel est le but principal de la normalisation ?',
      'options' => 
      array (
        0 => 'Réduire la redondance et les anomalies',
        1 => 'Augmenter le nombre de colonnes',
        2 => 'Supprimer les clés étrangères',
      ),
      'answer' => 0,
      'concept' => 'Normalisation',
      'explainFr' => 'La normalisation organise les données pour éviter les répétitions et les incohérences.',
      'explainDarija' => 'Normalisation katt3adel données bach tmna3 tkrar w tanaqod.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une table de jonction permet de représenter une relation many-to-many.',
      'answer' => 0,
      'concept' => 'Conception relationnelle',
      'explainFr' => 'Vrai : elle stocke les paires de clés des deux tables reliées.',
      'explainDarija' => 'S7i7 : katkhzen paires clés dyal jouj tables mrboutin.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle clé identifie de manière unique une ligne ?',
      'options' => 
      array (
        0 => 'La clé primaire',
        1 => 'Une clé étrangère',
        2 => 'Un index non unique',
      ),
      'answer' => 0,
      'concept' => 'Clé primaire',
      'explainFr' => 'La clé primaire est unique et non nulle.',
      'explainDarija' => 'Clé primaire unique w machi khawya.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La contrainte qui limite les valeurs avec une condition est ________.',
      'answer' => 'CHECK',
      'concept' => 'CHECK',
      'explainFr' => 'CHECK (prix > 0) refuse les valeurs qui ne respectent pas la condition.',
      'explainDarija' => 'CHECK (prix > 0) kayrefus valeurs li ma kay7trmoch condition.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi séparer client et commande en deux tables ?',
      'options' => 
      array (
        0 => 'Éviter de répéter les données du client et préserver la cohérence',
        1 => 'Pour avoir plus de tables',
        2 => 'Pour supprimer les jointures',
      ),
      'answer' => 0,
      'concept' => 'Séparation des entités',
      'explainFr' => 'Le client est stocké une fois ; les commandes le référencent par clé étrangère.',
      'explainDarija' => 'Client kaykhzen marra wa7da ; commandes kay3ayto 3lih b clé étrangère.',
    ),
  ),
);
