<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex02.php
 */

return array (
  'id' => 'html-ex2',
  'title' => 'Structure d\'un document HTML',
  'brief' => 'Construire un document HTML valide, du doctype au body.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — le squelette',
      'lang' => 'html',
      'instructions' => '<p>Écris un document HTML complet avec : le doctype, la balise <code>html</code> avec <code>lang="fr"</code>, un <code>head</code> contenant <code>meta charset="UTF-8"</code> et un <code>title</code>, puis un <code>body</code> avec un titre <code>h1</code>.</p>',
      'instructionsDarija' => '<p>Kteb document HTML kamel : doctype, balise <code>html</code> b <code>lang="fr"</code>, <code>head</code> fih <code>meta charset="UTF-8"</code> w <code>title</code>, men ba3d <code>body</code> fih titre <code>h1</code>.</p>',
      'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- métadonnées -->
</head>
<body>
  <!-- titre -->
</body>
</html>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<!DOCTYPE html>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'charset="UTF-8"',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<h1>',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le doctype est la première ligne du fichier.',
        1 => 'Le charset UTF-8 évite les accents cassés.',
      ),
      'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma première page</title>
</head>
<body>
  <h1>Bienvenue</h1>
</body>
</html>',
      'explainFr' => 'Le document respecte l\'ordre : doctype, html, head (métadonnées), body (contenu visible).',
      'explainDarija' => 'Document kaytbe3 tartib : doctype, html, head (métadonnées), body (contenu li kayban).',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — titres et paragraphes',
      'lang' => 'html',
      'instructions' => '<p>Dans le <code>body</code>, ajoute un <code>h1</code>, un <code>h2</code>, puis deux paragraphes <code>p</code>. Chaque paragraphe contient au moins une phrase.</p>',
      'instructionsDarija' => '<p>F <code>body</code>, zid <code>h1</code>, <code>h2</code>, men ba3d jouj paragraphes <code>p</code>. Kol paragraphe fih 3la l9al jomla.</p>',
      'starter' => '<body>
  <h1>Mon site</h1>
  <!-- sous-titre -->
  <!-- paragraphes -->
</body>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<h1>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<h2>',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<p>',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un seul h1 par page : c\'est le titre principal.',
        1 => 'h2 sert aux grandes sections.',
      ),
      'solution' => '<body>
  <h1>Mon site</h1>
  <h2>Présentation</h2>
  <p>Bienvenue sur mon site.</p>
  <p>J\'apprends le développement web.</p>
</body>',
      'explainFr' => 'La hiérarchie h1 puis h2 structure la page ; les paragraphes regroupent le texte.',
      'explainDarija' => 'Hiérarchie h1 men ba3d h2 katnadem page ; paragraphes kayjem3o texte.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — head complet et commentaires',
      'lang' => 'html',
      'instructions' => '<p>Complète le <code>head</code> avec une <code>meta name="description"</code>, une <code>meta name="viewport"</code> et un lien vers une feuille de style <code>style.css</code>. Ajoute un commentaire HTML avant le titre.</p>',
      'instructionsDarija' => '<p>Kmml <code>head</code> b <code>meta name="description"</code>, <code>meta name="viewport"</code> w lien l feuille de style <code>style.css</code>. Zid commentaire HTML qbel titre.</p>',
      'starter' => '<head>
  <meta charset="UTF-8">
  <!-- commentaire -->
</head>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'name="description"',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'name="viewport"',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'style.css',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '<!--',
        ),
      ),
      'hints' => 
      array (
        0 => 'La description aide les moteurs de recherche.',
        1 => 'viewport est indispensable pour le responsive.',
      ),
      'solution' => '<head>
  <meta charset="UTF-8">
  <!-- Feuille de style principale -->
  <meta name="description" content="Cours de développement web">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WebAcademy</title>
  <link rel="stylesheet" href="style.css">
</head>',
      'explainFr' => 'Le head contient les métadonnées : encodage, description, viewport et feuilles de style.',
      'explainDarija' => 'Head fih métadonnées : encodage, description, viewport w feuilles de style.',
    ),
  ),
);
