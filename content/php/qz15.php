<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz15.php
 */

return array (
  'title' => 'Quiz — Sécurité PHP',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction échappe une sortie HTML ?',
      'options' => 
      array (
        0 => 'htmlspecialchars()',
        1 => 'trim()',
        2 => 'strtoupper()',
      ),
      'answer' => 0,
      'concept' => 'Échappement HTML',
      'explainFr' => '<code>htmlspecialchars()</code> convertit les caractères spéciaux en entités sûres.',
      'explainDarija' => '<code>htmlspecialchars()</code> katbeddel caractères spéciaux l entités amnin.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'password_hash() stocke le mot de passe en clair.',
      'answer' => 1,
      'concept' => 'Hachage',
      'explainFr' => 'Faux : elle produit un hash irréversible avec un sel aléatoire.',
      'explainDarija' => 'Ghalt : katproduit hash ma ytqlebch b sel aléatoire.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction vérifie un mot de passe contre son hash ?',
      'options' => 
      array (
        0 => 'password_verify()',
        1 => 'password_hash()',
        2 => 'md5()',
      ),
      'answer' => 0,
      'concept' => 'Vérification',
      'explainFr' => '<code>password_verify()</code> compare correctement le mot de passe au hash stocké.',
      'explainDarija' => '<code>password_verify()</code> katqaren mot de passe m3a hash mkhezen b tariqa s7i7a.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui compare deux jetons en temps constant est hash________().',
      'answer' => 'equals',
      'concept' => 'hash_equals',
      'explainFr' => '<code>hash_equals()</code> évite les attaques temporelles lors de la comparaison de jetons.',
      'explainDarija' => '<code>hash_equals()</code> kaymna3 attaques temporelles f comparaison dyal jetons.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle pratique protège d\'une injection SQL ?',
      'options' => 
      array (
        0 => 'Les requêtes préparées',
        1 => 'La concaténation des saisies',
        2 => 'Le masquage des erreurs',
      ),
      'answer' => 0,
      'concept' => 'Injection SQL',
      'explainFr' => 'Les requêtes préparées séparent le SQL des valeurs : la saisie ne peut pas changer la requête.',
      'explainDarija' => 'Requêtes préparées kayfre9o SQL men valeurs : saisie ma tqderch tbeddel requête.',
    ),
  ),
);
