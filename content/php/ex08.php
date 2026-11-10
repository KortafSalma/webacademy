<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex08.php
 */

return array (
  'id' => 'php-ex8',
  'title' => 'Fonctions de chaînes',
  'brief' => 'Mesurer, nettoyer, remplacer et découper du texte.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — longueur et majuscules',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$mot = "webacademy"</code>, puis affiche <code>Longueur : 10</code> et <code>Majuscules : WEBACADEMY</code>.</p>',
      'instructionsDarija' => '<p>3erref <code>$mot = "webacademy"</code>, men ba3d 3red <code>Longueur : 10</code> w <code>Majuscules : WEBACADEMY</code>.</p>',
      'starter' => '<?php
$mot = "webacademy";

// Longueur puis majuscules
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Longueur : 10',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Majuscules : WEBACADEMY',
        ),
      ),
      'hints' => 
      array (
        0 => 'strlen() compte les caractères.',
        1 => 'strtoupper() convertit en majuscules.',
        2 => 'Concatène le libellé et le résultat de la fonction.',
      ),
      'solution' => '<?php
$mot = "webacademy";

echo "Longueur : " . strlen($mot) . "<br>";
echo "Majuscules : " . strtoupper($mot);
?>',
      'explainFr' => '<code>strlen()</code> renvoie 10 caractères et <code>strtoupper()</code> renvoie la chaîne en majuscules. Ces fonctions ne modifient pas <code>$mot</code> : elles renvoient une nouvelle chaîne.',
      'explainDarija' => '<code>strlen()</code> katrje3 10 caractères w <code>strtoupper()</code> katrje3 chaîne b majuscules. Had fonctions ma kaybeddlouch <code>$mot</code> : kayrje3o chaîne jdida.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — trim et remplacement',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$phrase = "  J\'aime le PHP  "</code>. Supprime les espaces autour avec <code>trim()</code>, remplace <code>PHP</code> par <code>SQL</code>, puis affiche le résultat.</p>',
      'instructionsDarija' => '<p>3erref <code>$phrase = "  J\'aime le PHP  "</code>. 7yed espaces li 3la tarafin b <code>trim()</code>, beddel <code>PHP</code> b <code>SQL</code>, men ba3d 3red résultat.</p>',
      'starter' => '<?php
$phrase = "  J\'aime le PHP  ";

// Nettoie puis remplace
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'J\'aime le SQL',
        ),
      ),
      'hints' => 
      array (
        0 => 'trim() enlève les espaces au début et à la fin.',
        1 => 'str_replace($ancien, $nouveau, $texte) effectue le remplacement.',
        2 => 'Affiche la chaîne transformée, pas l\'originale.',
      ),
      'solution' => '<?php
$phrase = "  J\'aime le PHP  ";

$propre = trim($phrase);
echo str_replace("PHP", "SQL", $propre);
?>',
      'explainFr' => '<code>trim()</code> supprime les espaces parasites, puis <code>str_replace()</code> remplace toutes les occurrences de « PHP » par « SQL ». Le résultat est « J\'aime le SQL ».',
      'explainDarija' => '<code>trim()</code> kat7yed espaces zaydin, men ba3d <code>str_replace()</code> kaybeddel kol occurrences dyal « PHP » b « SQL ». Résultat « J\'aime le SQL ».',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — explode et implode',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$csv = "html,css,php"</code>. Découpe la chaîne avec <code>explode()</code>, mets chaque mot en majuscule initiale avec <code>array_map(\'ucfirst\', ...)</code>, puis recolle avec <code>implode()</code> et le séparateur <code> - </code>.</p>',
      'instructionsDarija' => '<p>3erref <code>$csv = "html,css,php"</code>. Qsem chaîne b <code>explode()</code>, 7et kol kelma b majuscule lawla b <code>array_map(\'ucfirst\', ...)</code>, men ba3d ls9hom b <code>implode()</code> w séparateur <code> - </code>.</p>',
      'starter' => '<?php
$csv = "html,css,php";

// explode, ucfirst, implode
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Html - Css - Php',
        ),
      ),
      'hints' => 
      array (
        0 => 'explode(\',\', $csv) renvoie un tableau.',
        1 => 'array_map applique ucfirst à chaque élément.',
        2 => 'implode(\' - \', $tableau) recolle les valeurs.',
      ),
      'solution' => '<?php
$csv = "html,css,php";

$parties = explode(",", $csv);
$parties = array_map(\'ucfirst\', $parties);
echo implode(" - ", $parties);
?>',
      'explainFr' => '<code>explode()</code> transforme la chaîne en tableau, <code>array_map()</code> applique <code>ucfirst()</code> à chaque mot, et <code>implode()</code> reconstruit une chaîne lisible.',
      'explainDarija' => '<code>explode()</code> katbeddel chaîne l tableau, <code>array_map()</code> kattbeq <code>ucfirst()</code> 3la kol kelma, w <code>implode()</code> kat3awed tabni chaîne mqroua.',
    ),
  ),
);
