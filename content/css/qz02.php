<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz02.php
 */

return array (
  'title' => 'Quiz — Inline, interne, externe',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Où place-t-on une feuille de style interne ?',
      'options' => 
      array (
        0 => 'Dans une balise style du head',
        1 => 'Dans le body après le contenu',
        2 => 'Dans un fichier .js',
      ),
      'answer' => 0,
      'concept' => 'Feuille interne',
      'explainFr' => 'La balise <code>style</code> se place dans le <code>head</code> pour que les styles soient connus avant l\'affichage.',
      'explainDarija' => 'Balise <code>style</code> kat7et f <code>head</code> bach styles ytkouno m3erfin qbel affichage.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'L\'attribut style s\'applique à un seul élément.',
      'answer' => 0,
      'concept' => 'Style en ligne',
      'explainFr' => 'Vrai : l\'attribut <code>style</code> est porté par un élément précis, il ne cible pas un groupe.',
      'explainDarija' => 'S7i7 : attribut <code>style</code> kay7mlo élément wa7ed, ma kayciblich groupe.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle balise lie une feuille de style externe ?',
      'options' => 
      array (
        0 => 'link rel="stylesheet" href="style.css"',
        1 => 'script src="style.css"',
        2 => 'style src="style.css"',
      ),
      'answer' => 0,
      'concept' => 'Feuille externe',
      'explainFr' => 'La balise <code>link</code> avec <code>rel="stylesheet"</code> charge le fichier CSS externe.',
      'explainDarija' => 'Balise <code>link</code> m3a <code>rel="stylesheet"</code> katchargi fichier CSS externe.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'L\'attribut HTML qui contient du CSS en ligne s\'appelle ________.',
      'answer' => 'style',
      'concept' => 'Attribut style',
      'explainFr' => '<code>style="color: red;"</code> applique du CSS directement sur l\'élément.',
      'explainDarija' => '<code>style="color: red;"</code> kaytbeq CSS nichan 3la élément.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'À spécificité égale, quel style l\'emporte ?',
      'options' => 
      array (
        0 => 'Le style en ligne',
        1 => 'La règle de la feuille externe',
        2 => 'Aucun des deux',
      ),
      'answer' => 0,
      'concept' => 'Cascade',
      'explainFr' => 'Le style en ligne est plus proche de l\'élément et gagne dans la cascade.',
      'explainDarija' => 'Style en ligne 9rib ktar l élément w kayghalleb f cascade.',
    ),
  ),
);
