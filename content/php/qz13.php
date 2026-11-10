<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz13.php
 */

return array (
  'title' => 'Quiz — Gestion des erreurs',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel bloc intercepte une exception ?',
      'options' => 
      array (
        0 => 'catch',
        1 => 'try',
        2 => 'finally',
      ),
      'answer' => 0,
      'concept' => 'catch',
      'explainFr' => '<code>catch</code> reçoit l\'exception levée dans le <code>try</code>.',
      'explainDarija' => '<code>catch</code> kayakhod exception li tle3at f <code>try</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'finally s\'exécute même si une exception est levée.',
      'answer' => 0,
      'concept' => 'finally',
      'explainFr' => 'Vrai : <code>finally</code> s\'exécute dans tous les cas, pour libérer les ressources.',
      'explainDarija' => 'S7i7 : <code>finally</code> kaytnffed f kol 7ala, bach y7rer ressources.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle instruction lève une exception ?',
      'options' => 
      array (
        0 => 'throw',
        1 => 'raise',
        2 => 'catch',
      ),
      'answer' => 0,
      'concept' => 'throw',
      'explainFr' => '<code>throw new Exception("message")</code> déclenche l\'exception.',
      'explainDarija' => '<code>throw new Exception("message")</code> kaytle3 exception.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La méthode qui récupère le message d\'une exception est get________().',
      'answer' => 'Message',
      'concept' => 'getMessage',
      'explainFr' => '<code>$e->getMessage()</code> renvoie le texte fourni à la création de l\'exception.',
      'explainDarija' => '<code>$e->getMessage()</code> katrje3 texte li t3ta f création dyal exception.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Que faire des erreurs détaillées en production ?',
      'options' => 
      array (
        0 => 'Les journaliser et afficher un message générique',
        1 => 'Les afficher à tous les visiteurs',
        2 => 'Les supprimer du code',
      ),
      'answer' => 0,
      'concept' => 'Erreurs en production',
      'explainFr' => 'Les traces révèlent des chemins et des requêtes : on les journalise, on masque le détail.',
      'explainDarija' => 'Traces kaychhero chemins w requêtes : kansejjloHom w nkhebiw détail.',
    ),
  ),
);
