<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz04.php
 */

return array (
  'title' => 'Quiz — Conditions',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle structure exécute un bloc quand une condition est fausse ?',
      'options' => 
      array (
        0 => 'else',
        1 => 'if',
        2 => 'while',
      ),
      'answer' => 0,
      'concept' => 'else',
      'explainFr' => '<code>else</code> est la branche exécutée quand le <code>if</code> est faux.',
      'explainDarija' => '<code>else</code> hiya branche li kattnffed melli <code>if</code> ghalt.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'elseif permet de tester plusieurs conditions à la suite.',
      'answer' => 0,
      'concept' => 'elseif',
      'explainFr' => 'Vrai : les conditions sont évaluées dans l\'ordre jusqu\'à la première vraie.',
      'explainDarija' => 'S7i7 : conditions kaytqaymo b tartib 7ta awwla vraie.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel opérateur teste l\'égalité stricte en PHP ?',
      'options' => 
      array (
        0 => '===',
        1 => '=',
        2 => '==',
      ),
      'answer' => 0,
      'concept' => 'Égalité stricte',
      'explainFr' => '<code>===</code> compare valeur et type ; <code>==</code> compare seulement la valeur.',
      'explainDarija' => '<code>===</code> kayqaren valeur w type ; <code>==</code> kayqaren valeur ghir.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La structure qui compare une valeur à plusieurs cas s\'appelle ________.',
      'answer' => 'switch',
      'concept' => 'switch',
      'explainFr' => '<code>switch</code> enchaîne des <code>case</code> et un <code>default</code>.',
      'explainDarija' => '<code>switch</code> kayrbet <code>case</code> w <code>default</code>.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que se passe-t-il si on oublie break dans un switch ?',
      'options' => 
      array (
        0 => 'L\'exécution continue dans le case suivant',
        1 => 'Le script s\'arrête',
        2 => 'Rien du tout',
      ),
      'answer' => 0,
      'concept' => 'break',
      'explainFr' => 'Sans <code>break</code>, PHP exécute les instructions des cases suivants (fallthrough).',
      'explainDarija' => 'Bla <code>break</code>, PHP kaynffed instructions dyal cases li mora (fallthrough).',
    ),
  ),
);
