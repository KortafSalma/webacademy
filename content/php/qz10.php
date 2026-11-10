<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz10.php
 */

return array (
  'title' => 'Quiz — Include et require',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle est la différence principale entre include et require ?',
      'options' => 
      array (
        0 => 'require provoque une erreur fatale si le fichier manque',
        1 => 'include est plus rapide',
        2 => 'require ne fonctionne qu\'avec les fichiers CSS',
      ),
      'answer' => 0,
      'concept' => 'include vs require',
      'explainFr' => '<code>require</code> arrête le script si l\'inclusion échoue ; <code>include</code> émet seulement un avertissement.',
      'explainDarija' => '<code>require</code> kayweqqef script ila inclusion fchlat ; <code>include</code> kay3ti ghir avertissement.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'require_once évite de charger deux fois le même fichier.',
      'answer' => 0,
      'concept' => 'require_once',
      'explainFr' => 'Vrai : le fichier n\'est inclus qu\'une seule fois, ce qui évite les redéclarations.',
      'explainDarija' => 'S7i7 : fichier kaydkhel ghir marra wa7da, w hakka kayt7ased redéclarations.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que contient __DIR__ ?',
      'options' => 
      array (
        0 => 'Le dossier du fichier courant',
        1 => 'Le nom du serveur',
        2 => 'Le contenu du fichier',
      ),
      'answer' => 0,
      'concept' => '__DIR__',
      'explainFr' => '<code>__DIR__</code> donne le chemin absolu du dossier du script, utile pour les inclusions fiables.',
      'explainDarija' => '<code>__DIR__</code> kay3ti chemin absolu dyal dossier dyal script, mzyan l inclusions mwatheqa.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La fonction qui écrit du contenu dans un fichier est file_put________().',
      'answer' => 'contents',
      'concept' => 'Écriture fichier',
      'explainFr' => '<code>file_put_contents()</code> écrit une chaîne dans un fichier, en le créant si besoin.',
      'explainDarija' => '<code>file_put_contents()</code> katkteb chaîne f fichier, w kat5lqo ila ma kanch.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Où placer un fichier de configuration inclus ?',
      'options' => 
      array (
        0 => 'Hors de la racine web publique',
        1 => 'Dans le dossier des images',
        2 => 'Dans le body HTML',
      ),
      'answer' => 0,
      'concept' => 'Sécurité des inclusions',
      'explainFr' => 'Un fichier de config sous la racine web pourrait être téléchargé et révéler les identifiants.',
      'explainDarija' => 'Fichier config ta7t racine web y9der ytchargi w ychher identifiants.',
    ),
  ),
);
