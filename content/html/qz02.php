<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz02.php
 */

return array (
  'title' => 'Quiz — Structure d\'un document HTML',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle est la première ligne obligatoire d\'un document HTML5 ?',
      'options' => 
      array (
        0 => '<!DOCTYPE html>',
        1 => '<html>',
        2 => '<head>',
      ),
      'answer' => 0,
      'concept' => 'Doctype',
      'explainFr' => 'Le doctype HTML5 s\'écrit <code><!DOCTYPE html></code> et doit précéder la balise html.',
      'explainDarija' => 'Doctype HTML5 kaytkteb <code><!DOCTYPE html></code> w khas yji qbel balise html.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'La balise <title> se place dans le <body>.',
      'answer' => 1,
      'concept' => 'Placement de title',
      'explainFr' => 'Faux : <code>title</code> appartient au <code>head</code> ; il définit le titre de l\'onglet.',
      'explainDarija' => 'Ghalt : <code>title</code> kayn f <code>head</code> ; kay3erref titre dyal onglet.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'À quoi sert <meta charset="UTF-8"> ?',
      'options' => 
      array (
        0 => 'À déclarer l\'encodage des caractères',
        1 => 'À charger une police',
        2 => 'À créer un formulaire',
      ),
      'answer' => 0,
      'concept' => 'Encodage',
      'explainFr' => 'UTF-8 couvre les accents, l\'arabe et la plupart des écritures : sans lui, les caractères peuvent s\'afficher mal.',
      'explainDarija' => 'UTF-8 kayghatti accents, l3arabiya w bzaf dyal écritures : bla bih, caractères y9dro ybanou ghalitin.',
    ),
    3 => 
    array (
      'type' => 'mcq',
      'question' => 'Combien de <h1> faut-il idéalement par page ?',
      'options' => 
      array (
        0 => 'Un seul',
        1 => 'Deux',
        2 => 'Autant que de sections',
      ),
      'answer' => 0,
      'concept' => 'Hiérarchie des titres',
      'explainFr' => 'Un <code>h1</code> unique représente le titre principal ; les sections utilisent h2, h3…',
      'explainDarija' => '<code>h1</code> wa7ed kaymettel titre principal ; sections kaykhdmo b h2, h3…',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Où placer la balise <html> ?',
      'options' => 
      array (
        0 => 'Après le doctype, autour de head et body',
        1 => 'Dans le body',
        2 => 'Dans le head',
      ),
      'answer' => 0,
      'concept' => 'Racine du document',
      'explainFr' => '<code>html</code> est l\'élément racine : il englobe <code>head</code> et <code>body</code>.',
      'explainDarija' => '<code>html</code> howa élément racine : kayjem3 <code>head</code> w <code>body</code>.',
    ),
  ),
);
