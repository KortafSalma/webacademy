<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz06.php
 */

return array (
  'title' => 'Quiz — Sécurité applicative',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction échappe une sortie HTML ?',
      'options' => 
      array (
        0 => 'htmlspecialchars()',
        1 => 'trim()',
        2 => 'strlen()',
      ),
      'answer' => 0,
      'concept' => 'XSS',
      'explainFr' => 'htmlspecialchars() convertit les caractères spéciaux en entités inoffensives.',
      'explainDarija' => 'htmlspecialchars() kaybeddel caractères spéciaux l entités bla khatar.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Les données d\'un formulaire doivent être validées côté serveur.',
      'answer' => 0,
      'concept' => 'Validation',
      'explainFr' => 'Vrai : les contrôles HTML peuvent être contournés ; le serveur revérifie toujours.',
      'explainDarija' => 'S7i7 : contrôles HTML y9dro yt7aydo ; serveur kay3awed yt7eqqeq dima.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction valide un email ?',
      'options' => 
      array (
        0 => 'filter_var($email, FILTER_VALIDATE_EMAIL)',
        1 => 'htmlspecialchars($email)',
        2 => 'password_hash($email)',
      ),
      'answer' => 0,
      'concept' => 'Validation email',
      'explainFr' => 'filter_var renvoie l\'email validé ou false.',
      'explainDarija' => 'filter_var katrje3 email validé wla false.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui compare deux jetons en temps constant est hash________().',
      'answer' => 'equals',
      'concept' => 'hash_equals',
      'explainFr' => 'hash_equals() évite les attaques basées sur le temps de comparaison.',
      'explainDarija' => 'hash_equals() kaymna3 attaques 3la 7sab temps comparaison.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle pratique protège d\'une injection SQL ?',
      'options' => 
      array (
        0 => 'Les requêtes préparées',
        1 => 'La concaténation des saisies',
        2 => 'Le masquage des erreurs',
      ),
      'answer' => 0,
      'concept' => 'Injection SQL',
      'explainFr' => 'Les requêtes préparées séparent la structure SQL des valeurs fournies.',
      'explainDarija' => 'Requêtes préparées kayfre9o structure SQL men valeurs m3tina.',
    ),
  ),
);
