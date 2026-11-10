<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz03.php
 */

return array (
  'title' => 'Quiz — Requêtes préparées',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi utiliser une requête préparée ?',
      'options' => 
      array (
        0 => 'Séparer le SQL des valeurs pour éviter l\'injection',
        1 => 'Accélérer le HTML',
        2 => 'Supprimer les index',
      ),
      'answer' => 0,
      'concept' => 'Requête préparée',
      'explainFr' => 'Les valeurs sont envoyées comme données et ne peuvent pas modifier la structure de la requête.',
      'explainDarija' => 'Valeurs kaytsifto b7al données w ma y9droch ybeddlo structure requête.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un paramètre nommé commence par deux-points, par exemple :email.',
      'answer' => 0,
      'concept' => 'Paramètre nommé',
      'explainFr' => 'Vrai : le nom du placeholder commence par :',
      'explainDarija' => 'S7i7 : smiya placeholder katbda b :',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que représente le ? dans une requête préparée ?',
      'options' => 
      array (
        0 => 'Un paramètre positionnel',
        1 => 'Une colonne obligatoire',
        2 => 'Un commentaire',
      ),
      'answer' => 0,
      'concept' => 'Paramètre positionnel',
      'explainFr' => 'Chaque ? reçoit une valeur dans l\'ordre du tableau de paramètres.',
      'explainDarija' => 'Kol ? kayakhod valeur b tartib tableau paramètres.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le nom de la méthode PDO qui exécute une requête préparée est ________().',
      'answer' => 'execute',
      'concept' => 'execute',
      'explainFr' => 'prepare() prépare la requête, execute() l\'exécute avec les paramètres.',
      'explainDarija' => 'prepare() katt7der requête, execute() kattnffedha b paramètres.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Peut-on passer un nom de colonne en paramètre préparé ?',
      'options' => 
      array (
        0 => 'Non, il faut une liste blanche',
        1 => 'Oui, avec :colonne',
        2 => 'Oui, avec ?',
      ),
      'answer' => 0,
      'concept' => 'Identifiants SQL',
      'explainFr' => 'Les paramètres remplacent des valeurs, pas des identifiants ; une liste blanche contrôle le tri.',
      'explainDarija' => 'Paramètres kay3awdo valeurs, machi identifiants ; liste blanche katcontrol tri.',
    ),
  ),
);
