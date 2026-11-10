<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex05.php
 */

return array (
  'id' => 'php-ex5',
  'title' => 'Boucles',
  'brief' => 'Répéter des instructions avec for, while et les sauts.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — for',
      'lang' => 'php',
      'instructions' => '<p>Utilise une boucle <code>for</code> pour afficher les nombres de 1 à 5, séparés par un espace.</p>',
      'instructionsDarija' => '<p>Khdem b boucle <code>for</code> bach t3red ar9am men 1 7ta 5, mfreqin b espace.</p>',
      'starter' => '<?php
// Boucle de 1 à 5
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '1 2 3 4 5',
        ),
      ),
      'hints' => 
      array (
        0 => 'for prend une initialisation, une condition et une incrémentation.',
        1 => 'La condition $i <= 5 inclut 5.',
        2 => 'Ajoute un espace après chaque nombre.',
      ),
      'solution' => '<?php
for ($i = 1; $i <= 5; $i++) {
    echo $i . " ";
}
?>',
      'explainFr' => 'La boucle démarre à 1, s\'exécute tant que <code>$i &lt;= 5</code>, et incrémente <code>$i</code> après chaque tour. La sortie est « 1 2 3 4 5 ».',
      'explainDarija' => 'Boucle katbda b 1, kattnffed ma dam <code>$i &lt;= 5</code>, w katzid <code>$i</code> mora kol tour. Sortie hiya « 1 2 3 4 5 ».',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — while et accumulation',
      'lang' => 'php',
      'instructions' => '<p>Calcule la somme des entiers de 1 à 10 avec une boucle <code>while</code> et affiche <code>Somme : 55</code>.</p>',
      'instructionsDarija' => '<p>7seb somme dyal ar9am men 1 7ta 10 b boucle <code>while</code> w 3red <code>Somme : 55</code>.</p>',
      'starter' => '<?php
$i = 1;
$somme = 0;

// Boucle while
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Somme : 55',
        ),
      ),
      'hints' => 
      array (
        0 => 'Initialise $somme à 0 avant la boucle.',
        1 => 'Ajoute $i à $somme à chaque tour.',
        2 => 'N\'oublie pas d\'incrémenter $i pour éviter une boucle infinie.',
      ),
      'solution' => '<?php
$i = 1;
$somme = 0;

while ($i <= 10) {
    $somme += $i;
    $i++;
}

echo "Somme : " . $somme;
?>',
      'explainFr' => 'L\'accumulateur <code>$somme</code> grandit à chaque tour : 1, puis 3, 6… jusqu\'à 55. Sans <code>$i++</code>, la condition resterait vraie indéfiniment.',
      'explainDarija' => 'Accumulateur <code>$somme</code> kaykber kol tour : 1, men ba3d 3, 6… 7ta 55. Bla <code>$i++</code>, condition katbqa vraie bla nihaya.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — continue',
      'lang' => 'php',
      'instructions' => '<p>Affiche uniquement les nombres pairs de 1 à 10, séparés par un espace, en utilisant une boucle et <code>continue</code> pour sauter les impairs.</p>',
      'instructionsDarija' => '<p>3red ghir ar9am pairs men 1 7ta 10, mfreqin b espace, b boucle w <code>continue</code> bach tqbez ar9am impairs.</p>',
      'starter' => '<?php
for ($i = 1; $i <= 10; $i++) {
    // saute les impairs
}
?>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '2 4 6 8 10',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le modulo % 2 vaut 0 pour un nombre pair.',
        1 => 'continue passe immédiatement au tour suivant.',
        2 => 'Affiche seulement quand $i % 2 === 0.',
      ),
      'solution' => '<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 !== 0) {
        continue;
    }
    echo $i . " ";
}
?>',
      'explainFr' => '<code>continue</code> interrompt le tour courant sans quitter la boucle. Les impairs sont sautés, seuls 2, 4, 6, 8 et 10 sont affichés.',
      'explainDarija' => '<code>continue</code> kay9te3 tour li kayn bla ma ykhrej men boucle. Impairs kaytqbezo, ghir 2, 4, 6, 8 w 10 kaybanou.',
    ),
  ),
);
