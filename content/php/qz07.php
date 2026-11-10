<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz07.php
 */

return array (
  'title' => 'Quiz — Fonctions',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel mot-clé déclare une fonction en PHP ?',
      'options' => 
      array (
        0 => 'function',
        1 => 'def',
        2 => 'fn',
      ),
      'answer' => 0,
      'concept' => 'Déclaration',
      'explainFr' => 'Une fonction se déclare avec <code>function nom() { ... }</code>.',
      'explainDarija' => 'Fonction katt3len b <code>function nom() { ... }</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'return affiche la valeur à l\'écran.',
      'answer' => 1,
      'concept' => 'return vs echo',
      'explainFr' => 'Faux : <code>return</code> renvoie la valeur ; c\'est <code>echo</code> qui l\'affiche.',
      'explainDarija' => 'Ghalt : <code>return</code> kayrje3 valeur ; <code>echo</code> howa li kay3redha.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que se passe-t-il si une fonction n\'a pas de return ?',
      'options' => 
      array (
        0 => 'Elle renvoie null',
        1 => 'Elle provoque une erreur fatale',
        2 => 'Elle affiche automatiquement son résultat',
      ),
      'answer' => 0,
      'concept' => 'Valeur de retour',
      'explainFr' => 'Sans <code>return</code>, une fonction renvoie <code>null</code>.',
      'explainDarija' => 'Bla <code>return</code>, fonction katrje3 <code>null</code>.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Un paramètre qui a une valeur par défaut est dit ________.',
      'answer' => 'optionnel',
      'concept' => 'Paramètre par défaut',
      'explainFr' => 'Un paramètre optionnel peut être omis lors de l\'appel : <code>fx($a, $b = 2)</code>.',
      'explainDarija' => 'Paramètre optionnel y9der yt7yed f appel : <code>fx($a, $b = 2)</code>.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Une variable déclarée dans une fonction est accessible…',
      'options' => 
      array (
        0 => 'uniquement dans cette fonction',
        1 => 'partout dans le script',
        2 => 'dans le navigateur',
      ),
      'answer' => 0,
      'concept' => 'Portée',
      'explainFr' => 'Les variables locales ont une portée limitée au corps de la fonction.',
      'explainDarija' => 'Variables locales 3ndhom portée m7doda f corps dyal fonction.',
    ),
  ),
);
