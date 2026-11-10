<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz07.php
 */

return array (
  'title' => 'Quiz — Architecture de projet',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi isoler la configuration dans un fichier ?',
      'options' => 
      array (
        0 => 'Pour partager les paramètres et éviter les répétitions',
        1 => 'Pour supprimer la base',
        2 => 'Pour accélérer le HTML',
      ),
      'answer' => 0,
      'concept' => 'Configuration',
      'explainFr' => 'Un fichier de config centralise les constantes utilisées par toutes les pages.',
      'explainDarija' => 'Fichier config kayjem3 constantes li kaysta3mlohom kol pages.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'require_once évite de redéclarer une fonction déjà chargée.',
      'answer' => 0,
      'concept' => 'require_once',
      'explainFr' => 'Vrai : le fichier n\'est inclus qu\'une seule fois.',
      'explainDarija' => 'S7i7 : fichier kaydkhel ghir marra wa7da.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel est le rôle d\'une vue ?',
      'options' => 
      array (
        0 => 'Mettre en forme les données pour l\'affichage',
        1 => 'Exécuter les requêtes SQL',
        2 => 'Stocker les mots de passe',
      ),
      'answer' => 0,
      'concept' => 'Vue',
      'explainFr' => 'La vue transforme les données du modèle en HTML.',
      'explainDarija' => 'Vue katbeddel données dyal modèle l HTML.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La constante qui donne le dossier du fichier courant est ________.',
      'answer' => '__DIR__',
      'concept' => '__DIR__',
      'explainFr' => '__DIR__ pointe vers le dossier du script, utile pour les inclusions.',
      'explainDarija' => '__DIR__ kay3ayer l dossier dyal script, mzyan l inclusions.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Quels éléments sépare une architecture MVC simple ?',
      'options' => 
      array (
        0 => 'Le modèle (données)',
        1 => 'La vue (affichage)',
        2 => 'Le contrôleur (traitement)',
        3 => 'La base de données et le navigateur dans un seul fichier',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'MVC',
      'explainFr' => 'Modèle, vue et contrôleur ont chacun une responsabilité distincte.',
      'explainDarija' => 'Modèle, vue w contrôleur kol wa7ed 3ndo responsabilité mfre9a.',
    ),
  ),
);
