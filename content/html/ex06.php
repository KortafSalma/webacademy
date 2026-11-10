<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex06.php
 */

return array (
  'id' => 'html-ex6',
  'title' => 'Tableaux',
  'brief' => 'Présenter des données tabulaires accessibles.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — tableau simple',
      'lang' => 'html',
      'instructions' => '<p>Crée un tableau avec <code>table</code>, une ligne d\'en-tête <code>tr</code> contenant deux <code>th</code>, puis une ligne de données avec deux <code>td</code>.</p>',
      'instructionsDarija' => '<p>5leq tableau b <code>table</code>, ligne d\'en-tête <code>tr</code> fiha jouj <code>th</code>, men ba3d ligne données b jouj <code>td</code>.</p>',
      'starter' => '<table>
  <!-- en-tête -->
  <!-- données -->
</table>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<table>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<th>',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<td>',
        ),
      ),
      'hints' => 
      array (
        0 => 'th sert d\'en-tête de colonne.',
        1 => 'Chaque ligne est un tr.',
      ),
      'solution' => '<table>
  <tr>
    <th>Matière</th>
    <th>Note</th>
  </tr>
  <tr>
    <td>PHP</td>
    <td>16</td>
  </tr>
</table>',
      'explainFr' => 'Le tableau contient une ligne d\'en-tête et une ligne de données. th est réservé aux en-têtes.',
      'explainDarija' => 'Tableau fih ligne d\'en-tête w ligne données. th mkhassos l en-têtes.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — caption et sections',
      'lang' => 'html',
      'instructions' => '<p>Ajoute un <code>caption</code>, un <code>thead</code> et un <code>tbody</code> au tableau, avec deux lignes de données.</p>',
      'instructionsDarija' => '<p>Zid <code>caption</code>, <code>thead</code> w <code>tbody</code> l tableau, m3a jouj lignes données.</p>',
      'starter' => '<table>
  <!-- légende -->
  <!-- en-têtes -->
  <!-- corps -->
</table>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<caption>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<thead>',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<tbody>',
        ),
      ),
      'hints' => 
      array (
        0 => 'caption doit être le premier enfant de table.',
        1 => 'tbody regroupe les lignes de données.',
      ),
      'solution' => '<table>
  <caption>Notes du semestre</caption>
  <thead>
    <tr><th>Matière</th><th>Note</th></tr>
  </thead>
  <tbody>
    <tr><td>PHP</td><td>16</td></tr>
    <tr><td>SQL</td><td>14</td></tr>
  </tbody>
</table>',
      'explainFr' => 'caption décrit le tableau, thead isole les en-têtes et tbody les données : la structure est plus claire et accessible.',
      'explainDarija' => 'caption katchra7 tableau, thead kat3zel en-têtes w tbody données : structure katwli wad7a w accessible.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — fusion de cellules',
      'lang' => 'html',
      'instructions' => '<p>Crée un tableau de planning : une cellule <code>th</code> qui couvre deux colonnes avec <code>colspan="2"</code>, puis une ligne avec deux <code>td</code>.</p>',
      'instructionsDarija' => '<p>5leq tableau dyal planning : cellule <code>th</code> katghatti jouj colonnes b <code>colspan="2"</code>, men ba3d ligne b jouj <code>td</code>.</p>',
      'starter' => '<table>
  <tr>
    <!-- titre sur deux colonnes -->
  </tr>
  <tr>
    <!-- deux cellules -->
  </tr>
</table>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'colspan="2"',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<th',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<td>',
        ),
      ),
      'hints' => 
      array (
        0 => 'colspan indique le nombre de colonnes couvertes.',
        1 => 'rowspan ferait la même chose verticalement.',
      ),
      'solution' => '<table>
  <tr>
    <th colspan="2">Journée du lundi</th>
  </tr>
  <tr>
    <td>Math</td>
    <td>PHP</td>
  </tr>
</table>',
      'explainFr' => 'colspan="2" fait occuper deux colonnes à la cellule d\'en-tête. La ligne suivante fournit les deux valeurs.',
      'explainDarija' => 'colspan="2" katkhalli cellule d\'en-tête takhod jouj colonnes. Ligne li mora kat3ti jouj valeurs.',
    ),
  ),
);
