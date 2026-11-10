<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz09.php
 */

return array (
  'title' => 'Quiz — Traitement des formulaires',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle superglobale reçoit les données d\'un formulaire en POST ?',
      'options' => 
      array (
        0 => '$_POST',
        1 => '$_GET',
        2 => '$_SESSION',
      ),
      'answer' => 0,
      'concept' => 'POST',
      'explainFr' => 'Un formulaire avec <code>method="post"</code> remplit <code>$_POST</code>.',
      'explainDarija' => 'Formulaire b <code>method="post"</code> kay3emmer <code>$_POST</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Les données d\'un formulaire doivent être validées côté serveur.',
      'answer' => 0,
      'concept' => 'Validation serveur',
      'explainFr' => 'Vrai : les contrôles HTML peuvent être contournés, le serveur doit revérifier.',
      'explainDarija' => 'S7i7 : contrôles HTML y9dro yt7aydo, serveur khas y3awed yt7eqqeq.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction valide un email ?',
      'options' => 
      array (
        0 => 'filter_var($email, FILTER_VALIDATE_EMAIL)',
        1 => 'trim($email)',
        2 => 'htmlspecialchars($email)',
      ),
      'answer' => 0,
      'concept' => 'Validation email',
      'explainFr' => '<code>filter_var()</code> renvoie l\'email validé ou <code>false</code>.',
      'explainDarija' => '<code>filter_var()</code> katrje3 email validé wla <code>false</code>.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'L\'opérateur qui fournit une valeur par défaut si une clé manque est ________.',
      'answer' => '??',
      'concept' => 'Opérateur null coalescing',
      'explainFr' => '<code>$_POST[\'nom\'] ?? \'\'</code> évite un avertissement si le champ est absent.',
      'explainDarija' => '<code>$_POST[\'nom\'] ?? \'\'</code> kaymna3 avertissement ila champ ma kanch.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi collecter les erreurs dans un tableau ?',
      'options' => 
      array (
        0 => 'Pour afficher toutes les erreurs en une fois',
        1 => 'Pour supprimer le formulaire',
        2 => 'Pour envoyer les erreurs par email',
      ),
      'answer' => 0,
      'concept' => 'Erreurs multiples',
      'explainFr' => 'L\'utilisateur corrige tous les champs en une seule soumission.',
      'explainDarija' => 'Utilisateur kaysele7 kol champs f soumission wa7da.',
    ),
  ),
);
