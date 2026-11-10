<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex04.php
 */

return array (
  'id' => 'php-ex4',
  'title' => 'Conditions',
  'brief' => 'Prendre des décisions avec if, else, elseif et switch.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — if / else',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$note = 14</code>. Si la note est supérieure ou égale à 10, affiche <code>Admis</code>, sinon affiche <code>Recalé</code>.</p>',
      'instructionsDarija' => '<p>3erref <code>$note = 14</code>. Ila note kbira wla sawiya 10, 3red <code>Admis</code>, sinon 3red <code>Recalé</code>.</p>',
      'starter' => '<?php
$note = 14;

// Condition
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Admis',
        ),
        1 => 
        array (
          'type' => 'output_not_contains',
          'value' => 'Recalé',
        ),
      ),
      'hints' => 
      array (
        0 => 'L\'opérateur >= teste « supérieur ou égal ».',
        1 => 'La condition se place entre parenthèses après if.',
        2 => 'else s\'exécute quand la condition est fausse.',
      ),
      'solution' => '<?php
$note = 14;

if ($note >= 10) {
    echo "Admis";
} else {
    echo "Recalé";
}
?>',
      'explainFr' => '14 ≥ 10 est vrai, donc le bloc <code>if</code> s\'exécute. Avec 8, le bloc <code>else</code> afficherait « Recalé ».',
      'explainDarija' => '14 ≥ 10 s7i7a, donc bloc <code>if</code> kaytnffed. B 8, bloc <code>else</code> kay3red « Recalé ».',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — elseif',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$age = 20</code>. Affiche <code>Enfant</code> si l\'âge est inférieur à 13, <code>Adolescent</code> s\'il est inférieur à 18, sinon <code>Adulte</code>.</p>',
      'instructionsDarija' => '<p>3erref <code>$age = 20</code>. 3red <code>Enfant</code> ila age 9el men 13, <code>Adolescent</code> ila 9el men 18, sinon <code>Adulte</code>.</p>',
      'starter' => '<?php
$age = 20;

// Catégories d\'âge
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Adulte',
        ),
        1 => 
        array (
          'type' => 'output_not_contains',
          'value' => 'Adolescent',
        ),
        2 => 
        array (
          'type' => 'output_not_contains',
          'value' => 'Enfant',
        ),
      ),
      'hints' => 
      array (
        0 => 'elseif permet d\'enchaîner plusieurs conditions.',
        1 => 'L\'ordre compte : la première condition vraie gagne.',
        2 => 'La dernière branche est un else sans condition.',
      ),
      'solution' => '<?php
$age = 20;

if ($age < 13) {
    echo "Enfant";
} elseif ($age < 18) {
    echo "Adolescent";
} else {
    echo "Adulte";
}
?>',
      'explainFr' => '20 n\'est ni inférieur à 13 ni inférieur à 18 : les deux premières conditions sont fausses, le <code>else</code> final affiche « Adulte ».',
      'explainDarija' => '20 machi 9el men 13 w machi 9el men 18 : jouj conditions lawla ghaltin, <code>else</code> akhir kay3red « Adulte ».',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — switch',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$jour = "lundi"</code>. Avec un <code>switch</code>, affiche <code>Début de semaine</code> pour lundi, mardi, mercredi et jeudi, <code>Week-end proche</code> pour vendredi, et <code>Week-end</code> pour samedi et dimanche.</p>',
      'instructionsDarija' => '<p>3erref <code>$jour = "lundi"</code>. B <code>switch</code>, 3red <code>Début de semaine</code> l lundi, mardi, mercredi w jeudi, <code>Week-end proche</code> l vendredi, w <code>Week-end</code> l samedi w dimanche.</p>',
      'starter' => '<?php
$jour = "lundi";

switch ($jour) {
    // tes cases
}
?>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Début de semaine',
        ),
      ),
      'hints' => 
      array (
        0 => 'switch compare la valeur à chaque case.',
        1 => 'Plusieurs case peuvent partager le même bloc.',
        2 => 'break empêche de passer au case suivant.',
      ),
      'solution' => '<?php
$jour = "lundi";

switch ($jour) {
    case "lundi":
    case "mardi":
    case "mercredi":
    case "jeudi":
        echo "Début de semaine";
        break;
    case "vendredi":
        echo "Week-end proche";
        break;
    default:
        echo "Week-end";
}
?>',
      'explainFr' => 'Les quatre premiers <code>case</code> partagent le même bloc : ils tombent les uns dans les autres jusqu\'au <code>break</code>. Sans <code>break</code>, l\'exécution continuerait dans le case suivant.',
      'explainDarija' => 'Rba3 <code>case</code> lawla kaytqasmo nefs bloc : kayt3aqbo 7ta l <code>break</code>. Bla <code>break</code>, exécution katkemmel f case li mora.',
    ),
  ),
);
