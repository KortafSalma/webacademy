<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz02.php
 */

return array (
  'title' => 'Quiz — Connexions (PDO, MySQL, Oracle)',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Que contient un DSN ?',
      'options' => 
      array (
        0 => 'Les informations de connexion à la base',
        1 => 'Le résultat d\'une requête',
        2 => 'Le mot de passe haché',
      ),
      'answer' => 0,
      'concept' => 'DSN',
      'explainFr' => 'Le DSN indique le moteur, l\'hôte, la base et éventuellement l\'encodage.',
      'explainDarija' => 'DSN kaybeyn moteur, hôte, base w peut-être encodage.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'PDO peut se connecter à plusieurs moteurs de base de données.',
      'answer' => 0,
      'concept' => 'PDO',
      'explainFr' => 'Vrai : PDO est une couche d\'abstraction pour MySQL, SQLite, Oracle, etc.',
      'explainDarija' => 'S7i7 : PDO couche abstraction l MySQL, SQLite, Oracle, etc.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle option PDO fait lever une exception en cas d\'erreur ?',
      'options' => 
      array (
        0 => 'PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION',
        1 => 'PDO::ATTR_EMULATE_PREPARES => false',
        2 => 'PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC',
      ),
      'answer' => 0,
      'concept' => 'Gestion des erreurs',
      'explainFr' => 'ERRMODE_EXCEPTION transforme les erreurs SQL en exceptions attrapables.',
      'explainDarija' => 'ERRMODE_EXCEPTION kaybeddel erreurs SQL l exceptions li tqbed.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'L\'option qui renvoie les lignes sous forme de tableau associatif est PDO::FETCH________.',
      'answer' => 'ASSOC',
      'concept' => 'FETCH_ASSOC',
      'explainFr' => 'PDO::FETCH_ASSOC associe chaque colonne à son nom.',
      'explainDarija' => 'PDO::FETCH_ASSOC kayrbet kol colonne m3a smiya dyalha.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que faire du message technique d\'une erreur de connexion ?',
      'options' => 
      array (
        0 => 'Le journaliser sans l\'afficher à l\'utilisateur',
        1 => 'L\'afficher tel quel',
        2 => 'Le supprimer',
      ),
      'answer' => 0,
      'concept' => 'Erreur de connexion',
      'explainFr' => 'Le détail peut révéler l\'hôte ou l\'utilisateur : on le journalise, on affiche un message générique.',
      'explainDarija' => 'Détail y9der ychher hôte wla utilisateur : kansejjlo, kan3erdo message 3adi.',
    ),
  ),
);
