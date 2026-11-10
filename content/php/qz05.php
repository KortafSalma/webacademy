<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz05.php
 */

return array (
  'title' => 'Quiz — Boucles',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle boucle est la plus adaptée quand on connaît le nombre de tours ?',
      'options' => 
      array (
        0 => 'for',
        1 => 'while',
        2 => 'foreach',
      ),
      'answer' => 0,
      'concept' => 'for',
      'explainFr' => '<code>for</code> regroupe initialisation, condition et incrémentation.',
      'explainDarija' => '<code>for</code> kayjem3 initialisation, condition w incrémentation.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une boucle while peut ne jamais s\'exécuter si sa condition est fausse dès le départ.',
      'answer' => 0,
      'concept' => 'while',
      'explainFr' => 'Vrai : la condition est testée avant le premier tour.',
      'explainDarija' => 'S7i7 : condition katt7eqqeq qbel awwel tour.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle instruction quitte immédiatement une boucle ?',
      'options' => 
      array (
        0 => 'break',
        1 => 'continue',
        2 => 'return false',
      ),
      'answer' => 0,
      'concept' => 'break',
      'explainFr' => '<code>break</code> sort de la boucle ; <code>continue</code> passe seulement au tour suivant.',
      'explainDarija' => '<code>break</code> kaykhrej men boucle ; <code>continue</code> kaydowez ghir l tour li mora.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'L\'instruction qui saute le tour courant sans quitter la boucle est ________.',
      'answer' => 'continue',
      'concept' => 'continue',
      'explainFr' => '<code>continue</code> ignore le reste du tour et reprend la boucle.',
      'explainDarija' => '<code>continue</code> kaytjahl ba9i tour w kay3awed boucle.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que risque une boucle while si la variable de condition n\'est jamais modifiée ?',
      'options' => 
      array (
        0 => 'Une boucle infinie',
        1 => 'Une erreur de syntaxe',
        2 => 'Un tableau vide',
      ),
      'answer' => 0,
      'concept' => 'Boucle infinie',
      'explainFr' => 'Sans modification, la condition reste vraie et le script tourne sans fin.',
      'explainDarija' => 'Bla modification, condition katbqa vraie w script kaydowez bla nihaya.',
    ),
  ),
);
