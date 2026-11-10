<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz13.php
 */

return array (
  'title' => 'Quiz — Views et indexes',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Qu\'est-ce qu\'une vue SQL ?',
      'options' => 
      array (
        0 => 'Une table virtuelle basée sur une requête',
        1 => 'Une copie physique automatique des données',
        2 => 'Un fichier de sauvegarde',
      ),
      'answer' => 0,
      'concept' => 'Vue',
      'explainFr' => 'Une vue enregistre une requête et se comporte comme une table en lecture.',
      'explainDarija' => 'Vue katsejjel requête w kat3mel b7al table f qraya.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une vue stocke une copie physique des données par défaut.',
      'answer' => 1,
      'concept' => 'Stockage d\'une vue',
      'explainFr' => 'Faux : la vue exécute sa requête à chaque lecture ; elle ne duplique pas les données.',
      'explainDarija' => 'Ghalt : vue kattnffed requête dyalha f kol qraya ; ma kat3awedch données.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel objet accélère les recherches sur une colonne ?',
      'options' => 
      array (
        0 => 'Un index',
        1 => 'Une vue',
        2 => 'Un trigger',
      ),
      'answer' => 0,
      'concept' => 'Index',
      'explainFr' => 'L\'index évite de parcourir toute la table pour trouver les lignes correspondantes.',
      'explainDarija' => 'Index kaymna3 dowar 3la table kamla bach ylqa lignes.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La commande qui crée une vue est CREATE ________.',
      'answer' => 'VIEW',
      'concept' => 'CREATE VIEW',
      'explainFr' => 'CREATE VIEW nom AS requête définit la vue.',
      'explainDarija' => 'CREATE VIEW nom AS requête kat3erref vue.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quels avantages apporte un index ?',
      'options' => 
      array (
        0 => 'Accélérer les recherches',
        1 => 'Accélérer les tris sur la colonne indexée',
        2 => 'Supprimer les doublons',
        3 => 'Réduire l\'espace de stockage',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
      ),
      'concept' => 'Avantages d\'un index',
      'explainFr' => 'Un index accélère recherches et tris ; il ne supprime pas les doublons et occupe de l\'espace supplémentaire.',
      'explainDarija' => 'Index kay3ejjel recherches w tris ; ma kay7yedch tkrar w kayakhod espace zayd.',
    ),
  ),
);
