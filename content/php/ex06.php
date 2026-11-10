<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex06.php
 */

return array (
  'id' => 'php-ex6',
  'title' => 'Tableaux (arrays)',
  'brief' => 'Manipuler des tableaux indexés et associatifs.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — tableau indexé',
      'lang' => 'php',
      'instructions' => '<p>Crée un tableau <code>$notes = [12, 15, 18]</code>, puis affiche <code>Nombre : 3</code> et <code>Maximum : 18</code>.</p>',
      'instructionsDarija' => '<p>5leq tableau <code>$notes = [12, 15, 18]</code>, men ba3d 3red <code>Nombre : 3</code> w <code>Maximum : 18</code>.</p>',
      'starter' => '<?php
$notes = [12, 15, 18];

// Nombre puis maximum
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Nombre : 3',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Maximum : 18',
        ),
      ),
      'hints' => 
      array (
        0 => 'count() renvoie le nombre d\'éléments.',
        1 => 'max() renvoie la plus grande valeur.',
        2 => 'Concatène le texte et la valeur avec un point.',
      ),
      'solution' => '<?php
$notes = [12, 15, 18];

echo "Nombre : " . count($notes) . "<br>";
echo "Maximum : " . max($notes);
?>',
      'explainFr' => 'Le tableau contient trois valeurs. <code>count()</code> renvoie 3 et <code>max()</code> parcourt les valeurs pour renvoyer 18.',
      'explainDarija' => 'Tableau fih tlata valeurs. <code>count()</code> katrje3 3 w <code>max()</code> katdowez valeurs bach trje3 18.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — tableau associatif',
      'lang' => 'php',
      'instructions' => '<p>Crée un tableau associatif <code>$etudiant</code> avec <code>nom =&gt; "Amal"</code> et <code>ville =&gt; "Rabat"</code>, puis affiche <code>Amal habite à Rabat</code>.</p>',
      'instructionsDarija' => '<p>5leq tableau associatif <code>$etudiant</code> b <code>nom =&gt; "Amal"</code> w <code>ville =&gt; "Rabat"</code>, men ba3d 3red <code>Amal habite à Rabat</code>.</p>',
      'starter' => '<?php
$etudiant = [
    // clés et valeurs
];
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Amal habite à Rabat',
        ),
      ),
      'hints' => 
      array (
        0 => 'Les clés sont des chaînes : nom et ville.',
        1 => 'Accède à une valeur avec $etudiant[\'nom\'].',
        2 => 'Utilise des guillemets doubles pour insérer les variables ou concatène.',
      ),
      'solution' => '<?php
$etudiant = [
    \'nom\' => \'Amal\',
    \'ville\' => \'Rabat\',
];

echo $etudiant[\'nom\'] . " habite à " . $etudiant[\'ville\'];
?>',
      'explainFr' => 'Un tableau associatif associe une clé explicite à chaque valeur. <code>$etudiant[\'nom\']</code> vaut « Amal » et <code>$etudiant[\'ville\']</code> vaut « Rabat ».',
      'explainDarija' => 'Tableau associatif kayrbet clé wad7a l kol valeur. <code>$etudiant[\'nom\']</code> = « Amal » w <code>$etudiant[\'ville\']</code> = « Rabat ».',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — tri et implode',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>$villes = ["Zagora", "Agadir", "Rabat"]</code>, trie le tableau par ordre alphabétique avec <code>sort()</code>, puis affiche les villes séparées par <code>, </code> avec <code>implode()</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>$villes = ["Zagora", "Agadir", "Rabat"]</code>, rteb tableau b tartib alphabétique b <code>sort()</code>, men ba3d 3red villes mfreqin b <code>, </code> b <code>implode()</code>.</p>',
      'starter' => '<?php
$villes = ["Zagora", "Agadir", "Rabat"];

// tri puis affichage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Agadir, Rabat, Zagora',
        ),
      ),
      'hints' => 
      array (
        0 => 'sort() modifie le tableau sur place.',
        1 => 'implode(\', \', $villes) colle les valeurs.',
        2 => 'L\'ordre alphabétique place Agadir avant Rabat et Zagora.',
      ),
      'solution' => '<?php
$villes = ["Zagora", "Agadir", "Rabat"];

sort($villes);
echo implode(", ", $villes);
?>',
      'explainFr' => '<code>sort()</code> réordonne le tableau lui-même. <code>implode()</code> transforme ensuite le tableau en une chaîne lisible, avec le séparateur fourni.',
      'explainDarija' => '<code>sort()</code> kayrteb tableau rasso. <code>implode()</code> kaybeddel tableau l chaîne mqroua, b séparateur li 3titih.',
    ),
  ),
);
