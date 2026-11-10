<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz04.php
 */

return array (
  'title' => 'Quiz — CRUD complet',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle opération correspond à INSERT ?',
      'options' => 
      array (
        0 => 'Create',
        1 => 'Read',
        2 => 'Delete',
      ),
      'answer' => 0,
      'concept' => 'Create',
      'explainFr' => 'INSERT ajoute une nouvelle ligne.',
      'explainDarija' => 'INSERT katzid ligne jdida.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un UPDATE sans WHERE peut modifier toutes les lignes.',
      'answer' => 0,
      'concept' => 'Update',
      'explainFr' => 'Vrai : sans filtre, toutes les lignes de la table sont concernées.',
      'explainDarija' => 'S7i7 : bla filtre, kol lignes dyal table kaytbeddlo.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle opération lit les données ?',
      'options' => 
      array (
        0 => 'SELECT',
        1 => 'INSERT',
        2 => 'DELETE',
      ),
      'answer' => 0,
      'concept' => 'Read',
      'explainFr' => 'SELECT renvoie les lignes demandées.',
      'explainDarija' => 'SELECT kayrje3 lignes li tlebti.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La commande qui supprime une ligne est ________ FROM.',
      'answer' => 'DELETE',
      'concept' => 'Delete',
      'explainFr' => 'DELETE FROM table WHERE condition supprime les lignes ciblées.',
      'explainDarija' => 'DELETE FROM table WHERE condition kat7yed lignes li tciblat.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi vérifier un jeton avant une suppression ?',
      'options' => 
      array (
        0 => 'Pour éviter une action déclenchée par un tiers (CSRF)',
        1 => 'Pour accélérer la requête',
        2 => 'Pour créer un index',
      ),
      'answer' => 0,
      'concept' => 'CSRF',
      'explainFr' => 'Le jeton prouve que la demande vient bien du formulaire de l\'utilisateur.',
      'explainDarija' => 'Jeton kay2ekked demande jat men formulaire dyal utilisateur.',
    ),
  ),
);
