<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz14.php
 */

return array (
  'title' => 'Quiz — POO PHP',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel mot-clé crée une instance de classe ?',
      'options' => 
      array (
        0 => 'new',
        1 => 'class',
        2 => 'extends',
      ),
      'answer' => 0,
      'concept' => 'Instanciation',
      'explainFr' => '<code>new Etudiant()</code> crée un objet à partir de la classe.',
      'explainDarija' => '<code>new Etudiant()</code> kat5leq objet men classe.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une propriété private est accessible directement depuis l\'extérieur de la classe.',
      'answer' => 1,
      'concept' => 'Encapsulation',
      'explainFr' => 'Faux : <code>private</code> limite l\'accès à la classe elle-même ; on passe par des méthodes.',
      'explainDarija' => 'Ghalt : <code>private</code> kay7ded accès l classe rasha ; kandowzo b méthodes.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle méthode est appelée automatiquement à la création d\'un objet ?',
      'options' => 
      array (
        0 => '__construct()',
        1 => '__destruct()',
        2 => 'presentation()',
      ),
      'answer' => 0,
      'concept' => 'Constructeur',
      'explainFr' => 'Le constructeur <code>__construct()</code> initialise l\'objet.',
      'explainDarija' => 'Constructeur <code>__construct()</code> kaybda objet.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le mot-clé qui permet à une classe d\'hériter d\'une autre est ________.',
      'answer' => 'extends',
      'concept' => 'Héritage',
      'explainFr' => '<code>class Etudiant extends Personne</code> établit l\'héritage.',
      'explainDarija' => '<code>class Etudiant extends Personne</code> kaybni héritage.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que représente $this dans une méthode ?',
      'options' => 
      array (
        0 => 'L\'objet courant',
        1 => 'La classe parente',
        2 => 'Le nom de la méthode',
      ),
      'answer' => 0,
      'concept' => '$this',
      'explainFr' => '<code>$this</code> donne accès aux propriétés et méthodes de l\'objet courant.',
      'explainDarija' => '<code>$this</code> kay3ti accès l propriétés w méthodes dyal objet li kayn.',
    ),
  ),
);
