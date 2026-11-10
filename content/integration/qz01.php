<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz01.php
 */

return array (
  'title' => 'Quiz — Communication PHP / base de données',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel est l\'ordre correct du pipeline dynamique ?',
      'options' => 
      array (
        0 => 'Requête utilisateur → PHP → SQL → résultat → HTML',
        1 => 'HTML → SQL → PHP → utilisateur',
        2 => 'SQL → utilisateur → PHP → HTML',
      ),
      'answer' => 0,
      'concept' => 'Pipeline',
      'explainFr' => 'Le navigateur demande une page, PHP interroge la base, récupère les lignes et génère le HTML.',
      'explainDarija' => 'Navigateur kaytleb page, PHP kayste9se base, kayakhod lignes w kayproduit HTML.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une page PHP peut générer du HTML à partir de lignes de base de données.',
      'answer' => 0,
      'concept' => 'Page dynamique',
      'explainFr' => 'Vrai : PHP parcourt les lignes et construit le HTML correspondant.',
      'explainDarija' => 'S7i7 : PHP kaydowez lignes w kaybni HTML li kaymatch.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que reçoit le navigateur à la fin du pipeline ?',
      'options' => 
      array (
        0 => 'Du HTML généré, pas le code PHP',
        1 => 'Le code PHP source',
        2 => 'Les identifiants de la base',
      ),
      'answer' => 0,
      'concept' => 'Sortie HTTP',
      'explainFr' => 'Le serveur exécute PHP et renvoie uniquement le HTML produit.',
      'explainDarija' => 'Serveur kaynffed PHP w kayrje3 ghir HTML li tproduit.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La commande PHP qui affiche du texte est ________.',
      'answer' => 'echo',
      'concept' => 'Affichage',
      'explainFr' => 'echo envoie le texte vers la sortie HTML.',
      'explainDarija' => 'echo kaysift texte l sortie HTML.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quelles étapes font partie du pipeline ?',
      'options' => 
      array (
        0 => 'Connexion à la base',
        1 => 'Exécution de la requête',
        2 => 'Mise en forme HTML',
        3 => 'Compilation du HTML par MySQL',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Étapes du pipeline',
      'explainFr' => 'La connexion, la requête et la mise en forme sont côté PHP ; MySQL n\'exécute pas le HTML.',
      'explainDarija' => 'Connexion, requête w mise en forme f côté PHP ; MySQL ma kaynffedch HTML.',
    ),
  ),
);
