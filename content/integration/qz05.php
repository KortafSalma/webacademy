<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz05.php
 */

return array (
  'title' => 'Quiz — Authentification',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction hache un mot de passe en PHP ?',
      'options' => 
      array (
        0 => 'password_hash()',
        1 => 'md5()',
        2 => 'base64_encode()',
      ),
      'answer' => 0,
      'concept' => 'Hachage',
      'explainFr' => 'password_hash() utilise un algorithme robuste et un sel aléatoire.',
      'explainDarija' => 'password_hash() kaysta3mel algorithme 9wi w sel aléatoire.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'password_verify() a besoin du mot de passe en clair et du hash stocké.',
      'answer' => 0,
      'concept' => 'Vérification',
      'explainFr' => 'Vrai : elle recalcule le hash avec le sel contenu dans la valeur stockée.',
      'explainDarija' => 'S7i7 : kat3awed calcul hash b sel li f valeur mkhezna.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que faire après une connexion réussie ?',
      'options' => 
      array (
        0 => 'Régénérer l\'identifiant de session',
        1 => 'Supprimer la base',
        2 => 'Afficher le hash',
      ),
      'answer' => 0,
      'concept' => 'Session',
      'explainFr' => 'session_regenerate_id(true) empêche la fixation de session.',
      'explainDarija' => 'session_regenerate_id(true) kaymna3 fixation session.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La superglobale qui stocke les données de session est ________.',
      'answer' => '$_SESSION',
      'concept' => 'Session',
      'explainFr' => 'Les données de session se lisent et s\'écrivent dans $_SESSION.',
      'explainDarija' => 'Données session kaytqraw w kaytketbo f $_SESSION.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel message afficher en cas d\'échec de connexion ?',
      'options' => 
      array (
        0 => 'Un message générique',
        1 => 'Le mot de passe attendu',
        2 => 'La requête SQL complète',
      ),
      'answer' => 0,
      'concept' => 'Message d\'erreur',
      'explainFr' => 'Un message générique évite de révéler si l\'email existe ou non.',
      'explainDarija' => 'Message 3adi kaymna3 ychher wach email kayn wla la.',
    ),
  ),
);
