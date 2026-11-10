<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz11.php
 */

return array (
  'title' => 'Quiz — Sessions et cookies',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction démarre une session ?',
      'options' => 
      array (
        0 => 'session_start()',
        1 => 'session_open()',
        2 => 'start_session()',
      ),
      'answer' => 0,
      'concept' => 'session_start',
      'explainFr' => '<code>session_start()</code> crée ou reprend la session et doit être appelée avant tout affichage.',
      'explainDarija' => '<code>session_start()</code> kat5leq wla kat3awed session w khas t3ayet qbel ay affichage.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Les données de session sont stockées côté serveur.',
      'answer' => 0,
      'concept' => 'Stockage session',
      'explainFr' => 'Vrai : le navigateur ne garde qu\'un identifiant de session, les données restent sur le serveur.',
      'explainDarija' => 'S7i7 : navigateur kay7fed ghir identifiant dyal session, données kaybqaw f serveur.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle superglobale contient les variables de session ?',
      'options' => 
      array (
        0 => '$_SESSION',
        1 => '$_COOKIE',
        2 => '$_POST',
      ),
      'answer' => 0,
      'concept' => '$_SESSION',
      'explainFr' => 'Les valeurs de session sont lues et écrites dans <code>$_SESSION</code>.',
      'explainDarija' => 'Valeurs dyal session kaytqraw w kaytketbo f <code>$_SESSION</code>.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui détruit complètement une session est session________().',
      'answer' => 'destroy',
      'concept' => 'session_destroy',
      'explainFr' => '<code>session_destroy()</code> détruit les données de session ; il faut aussi vider <code>$_SESSION</code>.',
      'explainDarija' => '<code>session_destroy()</code> katdemmer données dyal session ; khas 7ta tferregh <code>$_SESSION</code>.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel risque évite session_regenerate_id() après connexion ?',
      'options' => 
      array (
        0 => 'La fixation de session',
        1 => 'Les erreurs SQL',
        2 => 'Les fichiers trop lourds',
      ),
      'answer' => 0,
      'concept' => 'Sécurité session',
      'explainFr' => 'Changer l\'identifiant après connexion empêche un attaquant d\'utiliser un identifiant connu à l\'avance.',
      'explainDarija' => 'Tbeddel identifiant mora connexion kaymna3 attaquant ysta3mel identifiant m3erof qbel.',
    ),
  ),
);
