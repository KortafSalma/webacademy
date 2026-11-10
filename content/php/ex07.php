<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex07.php
 */

return array (
  'id' => 'php-ex7',
  'title' => 'Fonctions',
  'brief' => 'Déclarer, appeler et retourner des valeurs.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — fonction simple',
      'lang' => 'php',
      'instructions' => '<p>Déclare une fonction <code>saluer($nom)</code> qui retourne <code>Bonjour</code> suivi du nom, puis affiche le résultat de <code>saluer("Amal")</code>.</p>',
      'instructionsDarija' => '<p>3len fonction <code>saluer($nom)</code> li katrje3 <code>Bonjour</code> m3a smiya, men ba3d 3red résultat dyal <code>saluer("Amal")</code>.</p>',
      'starter' => '<?php
// Déclare la fonction

// Appelle la fonction
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Bonjour Amal',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une fonction se déclare avec function nom($parametre).',
        1 => 'return renvoie la valeur sans l\'afficher.',
        2 => 'echo affiche la valeur retournée.',
      ),
      'solution' => '<?php
function saluer($nom) {
    return "Bonjour " . $nom;
}

echo saluer("Amal");
?>',
      'explainFr' => '<code>return</code> termine la fonction et renvoie la chaîne. C\'est <code>echo</code>, à l\'extérieur, qui l\'affiche.',
      'explainDarija' => '<code>return</code> kaysali fonction w kayrje3 chaîne. <code>echo</code>, bera, howa li kay3redha.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — paramètres et calcul',
      'lang' => 'php',
      'instructions' => '<p>Déclare une fonction <code>moyenne($a, $b)</code> qui retourne la moyenne des deux nombres, puis affiche <code>Moyenne : 14.5</code> pour 14 et 15.</p>',
      'instructionsDarija' => '<p>3len fonction <code>moyenne($a, $b)</code> li katrje3 moyenne dyal jouj ar9am, men ba3d 3red <code>Moyenne : 14.5</code> l 14 w 15.</p>',
      'starter' => '<?php
// Fonction moyenne

// Affichage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Moyenne : 14.5',
        ),
      ),
      'hints' => 
      array (
        0 => 'La moyenne est ($a + $b) / 2.',
        1 => 'return doit renvoyer le résultat.',
        2 => 'Concatène le libellé et l\'appel de fonction.',
      ),
      'solution' => '<?php
function moyenne($a, $b) {
    return ($a + $b) / 2;
}

echo "Moyenne : " . moyenne(14, 15);
?>',
      'explainFr' => '(14 + 15) / 2 = 14.5. La fonction isole le calcul : on peut la réutiliser avec n\'importe quels nombres.',
      'explainDarija' => '(14 + 15) / 2 = 14.5. Fonction kat3zel calcul : t9der t3awed tsta3melha b ay ar9am.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — paramètre par défaut',
      'lang' => 'php',
      'instructions' => '<p>Déclare <code>prixTTC($prix, $taux = 0.2)</code> qui retourne le prix avec taxe arrondi à deux décimales. Affiche <code>Prix TTC : 120</code> pour un prix de 100.</p>',
      'instructionsDarija' => '<p>3len <code>prixTTC($prix, $taux = 0.2)</code> li katrje3 prix m3a taxe mroundi l jouj décimales. 3red <code>Prix TTC : 120</code> l prix 100.</p>',
      'starter' => '<?php
// Fonction avec paramètre par défaut

// Affichage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Prix TTC : 120',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un paramètre par défaut est utilisé si l\'appel ne le fournit pas.',
        1 => 'round($valeur, 2) arrondit à deux décimales.',
        2 => '100 × 1.2 = 120.',
      ),
      'solution' => '<?php
function prixTTC($prix, $taux = 0.2) {
    return round($prix * (1 + $taux), 2);
}

echo "Prix TTC : " . prixTTC(100);
?>',
      'explainFr' => 'Le second argument est optionnel : <code>prixTTC(100)</code> utilise 0.2. Le calcul donne 100 × 1.2 = 120, arrondi à 120.',
      'explainDarija' => 'Argument tani ikhtiyari : <code>prixTTC(100)</code> kaysta3mel 0.2. Calcul kay3ti 100 × 1.2 = 120, mroundi l 120.',
    ),
  ),
);
