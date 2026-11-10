<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz12.php
 */

return array (
  'title' => 'Quiz — Manipulation de fichiers',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle fonction lit tout le contenu d\'un fichier en une chaîne ?',
      'options' => 
      array (
        0 => 'file_get_contents()',
        1 => 'file_put_contents()',
        2 => 'fopen()',
      ),
      'answer' => 0,
      'concept' => 'Lecture simple',
      'explainFr' => '<code>file_get_contents()</code> renvoie tout le fichier sous forme de chaîne.',
      'explainDarija' => '<code>file_get_contents()</code> katrje3 fichier kamel b7al chaîne.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'file_put_contents() écrase le fichier par défaut.',
      'answer' => 0,
      'concept' => 'Écriture',
      'explainFr' => 'Vrai : sans option d\'ajout, le contenu précédent est remplacé.',
      'explainDarija' => 'S7i7 : bla option ajout, contenu qbel kaytbeddel.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Que renvoie file() sur un fichier texte ?',
      'options' => 
      array (
        0 => 'Un tableau de lignes',
        1 => 'Une chaîne unique',
        2 => 'Un booléen',
      ),
      'answer' => 0,
      'concept' => 'file',
      'explainFr' => '<code>file()</code> renvoie un tableau où chaque élément est une ligne.',
      'explainDarija' => '<code>file()</code> katrje3 tableau fin kol élément ligne.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Le mode fopen() qui ajoute à la fin d\'un fichier est \'________\'.',
      'answer' => 'a',
      'concept' => 'Mode ajout',
      'explainFr' => 'Le mode <code>\'a\'</code> place le pointeur à la fin sans effacer le contenu.',
      'explainDarija' => 'Mode <code>\'a\'</code> kay7et pointeur f akhir bla ma ymes7 contenu.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Pourquoi ne pas construire un chemin avec $_GET[\'fichier\'] sans contrôle ?',
      'options' => 
      array (
        0 => 'Cela permet de lire des fichiers sensibles (LFI)',
        1 => 'Cela accélère le site',
        2 => 'Cela compresse les fichiers',
      ),
      'answer' => 0,
      'concept' => 'Sécurité fichiers',
      'explainFr' => 'Un paramètre non validé peut mener à une inclusion ou une lecture de fichier arbitraire.',
      'explainDarija' => 'Paramètre ma mvalidach y9der ywsel l inclusion wla qraya fichier 3achwa2i.',
    ),
  ),
);
