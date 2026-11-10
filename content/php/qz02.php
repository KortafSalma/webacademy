<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz02.php
 */

return array (
  'title' => 'Quiz — Variables et constantes',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment déclare-t-on une variable en PHP ?',
      'options' => 
      array (
        0 => 'Avec un $ suivi du nom',
        1 => 'Avec le mot-clé var uniquement',
        2 => 'Avec deux-points',
      ),
      'answer' => 0,
      'concept' => 'Déclaration',
      'explainFr' => 'Une variable PHP commence par <code>$</code>, par exemple <code>$age</code>.',
      'explainDarija' => 'Variable PHP katbda b <code>$</code>, b7al <code>$age</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une constante se déclare avec define() ou const.',
      'answer' => 0,
      'concept' => 'Constante',
      'explainFr' => 'Vrai : <code>define(\'SITE_NAME\', \'MonSite\')</code> ou <code>const SITE_NAME = \'MonSite\'</code>.',
      'explainDarija' => 'S7i7 : <code>define(\'SITE_NAME\', \'MonSite\')</code> wla <code>const SITE_NAME = \'MonSite\'</code>.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que renvoie $_POST[\'nom\'] ?? \'Inconnu\' si le champ est absent ?',
      'options' => 
      array (
        0 => 'Inconnu',
        1 => 'null',
        2 => 'Une erreur fatale',
      ),
      'answer' => 0,
      'concept' => 'Opérateur ??',
      'explainFr' => 'L\'opérateur null coalescing renvoie la valeur de droite si la clé manque ou vaut null.',
      'explainDarija' => 'Opérateur null coalescing kayrje3 valeur dyal limen ila clé ma kanatch wla kant null.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le mot-clé qui importe une variable globale dans une fonction est ________.',
      'answer' => 'global',
      'concept' => 'Portée',
      'explainFr' => '<code>global $compteur;</code> rend la variable globale accessible dans la fonction.',
      'explainDarija' => '<code>global $compteur;</code> kay3mel variable globale accessible f fonction.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle superglobale contient les paramètres de l\'URL ?',
      'options' => 
      array (
        0 => '$_GET',
        1 => '$_POST',
        2 => '$_SESSION',
      ),
      'answer' => 0,
      'concept' => 'Superglobales',
      'explainFr' => '<code>$_GET</code> contient les paramètres passés dans la query string.',
      'explainDarija' => '<code>$_GET</code> kay7mel paramètres li kaydozo f query string.',
    ),
  ),
);
