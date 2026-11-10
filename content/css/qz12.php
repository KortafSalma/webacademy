<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz12.php
 */

return array (
  'title' => 'Quiz — CSS Grid',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Que fait repeat(3, 1fr) ?',
      'options' => 
      array (
        0 => 'Trois colonnes égales',
        1 => 'Trois lignes de 1px',
        2 => 'Une colonne répétée trois fois verticalement',
      ),
      'answer' => 0,
      'concept' => 'repeat et fr',
      'explainFr' => '<code>repeat(3, 1fr)</code> crée trois pistes égales qui se partagent l\'espace.',
      'explainDarija' => '<code>repeat(3, 1fr)</code> kay5leq tlata pistes sawiyin li kaytqasmo espace.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'grid-column: span 2 fait occuper deux colonnes à un élément.',
      'answer' => 0,
      'concept' => 'span',
      'explainFr' => 'Vrai : <code>span 2</code> indique que l\'élément couvre deux pistes de colonnes.',
      'explainDarija' => 'S7i7 : <code>span 2</code> kay3ni élément kayghatti jouj pistes dyal colonnes.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle propriété dessine un layout avec des noms de zones ?',
      'options' => 
      array (
        0 => 'grid-template-areas',
        1 => 'grid-gap',
        2 => 'flex-direction',
      ),
      'answer' => 0,
      'concept' => 'grid-template-areas',
      'explainFr' => '<code>grid-template-areas</code> décrit la page avec des chaînes comme "entete entete".',
      'explainDarija' => '<code>grid-template-areas</code> kaywsef page b chaînes b7al "entete entete".',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui crée des colonnes automatiques d\'au moins 180px est repeat(auto-fit, ________(180px, 1fr)).',
      'answer' => 'minmax',
      'concept' => 'minmax',
      'explainFr' => '<code>minmax(180px, 1fr)</code> fixe un minimum de 180px et un maximum d\'une fraction libre.',
      'explainDarija' => '<code>minmax(180px, 1fr)</code> kay7ded minimum 180px w maximum fraction libre.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle unité représente une fraction de l\'espace libre en Grid ?',
      'options' => 
      array (
        0 => 'fr',
        1 => 'px',
        2 => 'em',
      ),
      'answer' => 0,
      'concept' => 'Unité fr',
      'explainFr' => '<code>fr</code> distribue l\'espace restant entre les pistes.',
      'explainDarija' => '<code>fr</code> kayqasem espace li bqa bin pistes.',
    ),
  ),
);
