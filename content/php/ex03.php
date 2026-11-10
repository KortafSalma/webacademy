<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-ex03.json
 */

return array (
  'id' => 'php-ex3',
  'title' => 'Opérateurs',
  'brief' => 'Manipule les opérateurs arithmétiques, de comparaison et logiques en PHP.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — arithmétique et modulo',
      'lang' => 'php',
      'instructions' => '<p>Écris un script PHP qui :</p><ul><li>définit <code>$a = 17</code> et <code>$b = 5</code> ;</li><li>affiche la somme, puis le reste de la division de <code>$a</code> par <code>$b</code>.</li></ul><p>Format attendu : une ligne <code>Somme : 22</code>, puis une ligne <code>Reste : 2</code>.</p>',
      'instructionsDarija' => '<p>Kteb script PHP li :</p><ul><li>kay3erref <code>$a = 17</code> w <code>$b = 5</code> ;</li><li>kay3red somme, men ba3d reste dyal division dyal <code>$a</code> 3la <code>$b</code>.</li></ul><p>Format : ligne <code>Somme : 22</code>, men ba3d ligne <code>Reste : 2</code>.</p>',
      'starter' => '<?php
$a = 17;
$b = 5;

// Affiche la somme puis le reste
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Somme : 22',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Reste : 2',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'addition utilise l\'opérateur +.',
        1 => 'Le reste d\'une division s\'obtient avec l\'opérateur %.',
        2 => 'Utilise echo avec une concaténation : echo "Somme : " . ($a + $b);',
      ),
      'solution' => '<?php
$a = 17;
$b = 5;

echo "Somme : " . ($a + $b) . "<br>";
echo "Reste : " . ($a % $b);
?>',
      'explainFr' => '$a + $b vaut 22. L\'opérateur <code>%</code> (modulo) renvoie le reste de la division entière : 17 = 3 × 5 + 2, donc 17 % 5 vaut 2.',
      'explainDarija' => '$a + $b = 22. Opérateur <code>%</code> (modulo) kayrje3 reste dyal division : 17 = 3 × 5 + 2, donc 17 % 5 = 2.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — comparaison',
      'lang' => 'php',
      'instructions' => '<p>Écris un script qui définit <code>$age = 20</code>, puis affiche <code>Majeur</code> si l\'âge est supérieur ou égal à 18, sinon <code>Mineur</code>.</p><p>Teste ensuite avec <code>$age = 15</code> : le script doit afficher <code>Mineur</code>.</p>',
      'instructionsDarija' => '<p>Kteb script kay3erref <code>$age = 20</code>, men ba3d kay3red <code>Majeur</code> ila age kbir wla sawi 18, sinon <code>Mineur</code>.</p><p>Jerreb b <code>$age = 15</code> : script khas y3red <code>Mineur</code>.</p>',
      'starter' => '<?php
$age = 20;

if (/* condition */) {
    echo "Majeur";
} else {
    echo "Mineur";
}
?>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Majeur',
        ),
        1 => 
        array (
          'type' => 'output_not_contains',
          'value' => 'Mineur',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'opérateur >= teste « supérieur ou égal ».',
        1 => 'La condition s\'écrit $age >= 18.',
        2 => 'N\'utilise pas = (affectation) mais >= (comparaison).',
      ),
      'solution' => '<?php
$age = 20;

if ($age >= 18) {
    echo "Majeur";
} else {
    echo "Mineur";
}
?>',
      'explainFr' => '20 ≥ 18 est vrai : le bloc <code>if</code> s\'exécute et affiche « Majeur ». Avec 15, la condition serait fausse et le bloc <code>else</code> afficherait « Mineur ».',
      'explainDarija' => '20 ≥ 18 vraie : bloc <code>if</code> kaynffed w kay3red « Majeur ». B 15, condition tkoun fausse w <code>else</code> kay3red « Mineur ».',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — logique et incrémentation',
      'lang' => 'php',
      'instructions' => '<p>Écris un script qui :</p><ul><li>définit <code>$actif = true</code> et <code>$compteur = 5</code> ;</li><li>inverse <code>$actif</code> avec l\'opérateur <code>!</code> ;</li><li>incrémente <code>$compteur</code> avec <code>++</code> ;</li><li>affiche <code>Actif : faux</code> puis <code>Compteur : 6</code>.</li></ul><p>Indice : convertis le booléen en texte lisible avec un ternaire.</p>',
      'instructionsDarija' => '<p>Kteb script li :</p><ul><li>kay3erref <code>$actif = true</code> w <code>$compteur = 5</code> ;</li><li>kayqleb <code>$actif</code> b opérateur <code>!</code> ;</li><li>kayzid <code>$compteur</code> b <code>++</code> ;</li><li>kay3red <code>Actif : faux</code> men ba3d <code>Compteur : 6</code>.</li></ul><p>Indice : 7ewwel booléen l texte b ternaire.</p>',
      'starter' => '<?php
$actif = true;
$compteur = 5;

// Inverse $actif puis incrémente $compteur
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Actif : faux',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Compteur : 6',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'opérateur ! inverse un booléen : !true donne false.',
        1 => 'L\'opérateur ++ ajoute 1 à une variable numérique.',
        2 => 'Pour l\'affichage : echo $actif ? "vrai" : "faux";',
      ),
      'solution' => '<?php
$actif = true;
$compteur = 5;

$actif = !$actif;
$compteur++;

echo "Actif : " . ($actif ? "vrai" : "faux") . "<br>";
echo "Compteur : " . $compteur;
?>',
      'explainFr' => '<code>!$actif</code> transforme <code>true</code> en <code>false</code>. <code>$compteur++</code> équivaut à <code>$compteur = $compteur + 1</code> : 5 devient 6. Le ternaire choisit le texte à afficher.',
      'explainDarija' => '<code>!$actif</code> kayqleb <code>true</code> l <code>false</code>. <code>$compteur++</code> b7al <code>$compteur = $compteur + 1</code> : 5 kaywli 6. Ternaire kaykhtar texte li kayt3red.',
    ),
  ),
);
