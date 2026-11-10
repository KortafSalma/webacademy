<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c06.json
 */

return array (
  'id' => 'php-ch6',
  'title' => 'Tableaux (arrays)',
  'subtitle' => 'Stocker et organiser plusieurs valeurs',
  'objectives' => 
  array (
    0 => 'Créer un tableau indexé et un tableau associatif.',
    1 => 'Lire, ajouter et modifier des éléments.',
    2 => 'Compter et parcourir un tableau.',
    3 => 'Utiliser les fonctions essentielles : count, sort, in_array, array_push.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'tableau-indexe',
      'title' => 'Tableaux indexés',
      'icon' => '📦',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un <strong>tableau</strong> (array) stocke plusieurs valeurs dans une seule variable. Dans un tableau <strong>indexé</strong>, chaque valeur possède une position numérotée qui commence à <strong>0</strong>.</p>',
          'darija' => '<p><strong>Tableau</strong> kaykhzen bzaf dyal valeurs f variable wa7da. F tableau <strong>indexé</strong>, kol valeur 3ndha position mreqqma li katbda men <strong>0</strong>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Créer et lire un tableau',
          'code' => '$fruits = ["pomme", "banane", "orange"];

echo $fruits[0];   // pomme
echo $fruits[2];   // orange
echo count($fruits); // 3',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Lister et compter',
          'lang' => 'php',
          'code' => '<?php
$fruits = ["pomme", "banane", "orange"];

echo "Premier : " . $fruits[0] . "<br>";
echo "Dernier : " . $fruits[count($fruits) - 1] . "<br>";
echo "Nombre : " . count($fruits);
?>',
          'output' => 'Premier : pomme<br>Dernier : orange<br>Nombre : 3',
          'explainFr' => '$fruits[0] donne le premier élément ; <code>count($fruits) - 1</code> donne l\'indice du dernier (2). <code>count()</code> renvoie le nombre d\'éléments.',
          'explainDarija' => '$fruits[0] kay3tik l\'élément lwel ; <code>count($fruits) - 1</code> kay3tik indice dyal l\'akhir (2). <code>count()</code> katrje3 3adad dyal éléments.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Ajouter et modifier',
          'lang' => 'php',
          'code' => '<?php
$fruits = ["pomme", "banane"];

$fruits[] = "orange";      // ajoute à la fin
$fruits[0] = "kiwi";       // remplace pomme

print_r($fruits);
?>',
          'output' => 'Array ( [0] => kiwi [1] => banane [2] => orange )',
          'explainFr' => '<code>$fruits[]</code> ajoute à la fin avec le prochain indice libre. Affecter <code>$fruits[0]</code> remplace la valeur existante. <code>print_r()</code> affiche la structure complète pour le débogage.',
          'explainDarija' => '<code>$fruits[]</code> kat3awed tzid f l\'akhir b indice jdid. Ila 3tit <code>$fruits[0]</code> kattbeddel valeur li kayna. <code>print_r()</code> kat3red structure kamla l debug.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'tableau-associatif',
      'title' => 'Tableaux associatifs',
      'icon' => '🗂️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Dans un tableau <strong>associatif</strong>, chaque valeur est liée à une <strong>clé</strong> de type texte (ou nombre) au lieu d\'un simple indice. C\'est parfait pour représenter une fiche : nom, ville, note…</p>',
          'darija' => '<p>F tableau <strong>associatif</strong>, kol valeur mrbouta m3a <strong>clé</strong> (texte wla ra9m) 3iwad indice 3adi. Mzyan bach tmettel fiche : nom, ville, note…</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Créer un tableau associatif',
          'code' => '$etudiant = [
    "nom"   => "Amal",
    "ville" => "Casablanca",
    "note"  => 16
];

echo $etudiant["nom"];',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Fiche étudiant',
          'lang' => 'php',
          'code' => '<?php
$etudiant = [
    "nom"   => "Amal",
    "ville" => "Casablanca",
    "note"  => 16
];

echo $etudiant["nom"] . " habite à " . $etudiant["ville"] . ".<br>";
echo "Note : " . $etudiant["note"] . "/20";
?>',
          'output' => 'Amal habite à Casablanca.<br>Note : 16/20',
          'explainFr' => 'On accède à une valeur par sa clé entre crochets : <code>$etudiant["nom"]</code>. Les clés rendent le code lisible : pas besoin de se souvenir d\'un indice.',
          'explainDarija' => 'Kandokhlo l valeur b clé dyalha bin crochets : <code>$etudiant["nom"]</code>. Clés kaywad7o code : ma khassek t3qel 3la indice.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Un tableau dans un tableau',
          'fr' => 'Les valeurs d\'un tableau peuvent elles-mêmes être des tableaux. C\'est ainsi qu\'on modélise une liste d\'étudiants : <code>$etudiants = [ [\'nom\' => \'Amal\'], [\'nom\' => \'Yassine\'] ];</code>.',
          'darija' => 'Valeurs dyal tableau y9dro ykono homa rasshom tableaux. Hakka kanmettlo lista dyal étudiants : <code>$etudiants = [ [\'nom\' => \'Amal\'], [\'nom\' => \'Yassine\'] ];</code>.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'fonctions-tableaux',
      'title' => 'Fonctions utiles',
      'icon' => '🧰',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Fonction',
            1 => 'Rôle',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'count()',
              1 => 'nombre d\'éléments',
              2 => 'count($t) → 3',
            ),
            1 => 
            array (
              0 => 'in_array()',
              1 => 'vérifie si une valeur existe',
              2 => 'in_array("php", $t)',
            ),
            2 => 
            array (
              0 => 'array_push()',
              1 => 'ajoute un ou plusieurs éléments',
              2 => 'array_push($t, "sql")',
            ),
            3 => 
            array (
              0 => 'sort()',
              1 => 'trie par ordre croissant',
              2 => 'sort($t)',
            ),
            4 => 
            array (
              0 => 'array_sum()',
              1 => 'somme des nombres',
              2 => 'array_sum([1,2,3]) → 6',
            ),
            5 => 
            array (
              0 => 'implode()',
              1 => 'transforme en chaîne',
              2 => 'implode(", ", $t)',
            ),
          ),
          'fr' => 'Ces fonctions évitent d\'écrire des boucles inutiles.',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Rechercher, trier, additionner',
          'lang' => 'php',
          'code' => '<?php
$notes = [14, 18, 9, 16];

sort($notes);
echo implode(" - ", $notes) . "<br>";

echo "Somme : " . array_sum($notes) . "<br>";
echo "Moyenne : " . (array_sum($notes) / count($notes)) . "<br>";

echo in_array(18, $notes) ? "18 est présent" : "18 est absent";
?>',
          'output' => '9 - 14 - 16 - 18<br>Somme : 57<br>Moyenne : 14.25<br>18 est présent',
          'explainFr' => '<code>sort()</code> modifie le tableau en place. <code>implode()</code> fabrique une chaîne lisible. <code>in_array()</code> renvoie un booléen.',
          'explainDarija' => '<code>sort()</code> katrteb tableau. <code>implode()</code> kat3mel chaîne mqroua. <code>in_array()</code> katrje3 true wla false.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Les indices commencent à 0',
          'fr' => 'Un tableau de 3 éléments a les indices 0, 1 et 2. Utiliser <code>$t[3]</code> sur ce tableau déclenche un avertissement « Undefined array key » et renvoie <code>null</code>.',
          'darija' => 'Tableau dyal 3 éléments 3ndo indices 0, 1 w 2. Ila khdemti b <code>$t[3]</code> ghadi y3tik avertissement « Undefined array key » w kayrje3 <code>null</code>.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => '$fruits = ("pomme", "banane")',
      'fix' => '$fruits = ["pomme", "banane"];',
      'fr' => 'Un tableau se crée avec des crochets <code>[]</code> (ou <code>array()</code>), pas avec des parenthèses seules.',
      'darija' => 'Tableau kaytsayeb b crochets <code>[]</code> (wla <code>array()</code>), machi b parenthèses bo7dhom.',
    ),
    1 => 
    array (
      'wrong' => 'echo $fruits[3]; sur un tableau de 3 éléments',
      'fix' => 'echo $fruits[2]; // dernier indice = count - 1',
      'fr' => 'Les indices vont de 0 à count()-1. Le dernier élément d\'un tableau de 3 est à l\'indice 2.',
      'darija' => 'Indices men 0 7ta count()-1. L\'élément l\'akhir f tableau dyal 3 kayn f indice 2.',
    ),
    2 => 
    array (
      'wrong' => 'foreach ($t as $k => $v) { echo $t; }',
      'fix' => 'foreach ($t as $k => $v) { echo $v; }',
      'fr' => 'Dans la boucle, on utilise les variables <code>$k</code> et <code>$v</code>, pas le tableau entier.',
      'darija' => 'Dakhel boucle kankhdmo b <code>$k</code> w <code>$v</code>, machi tableau kamel.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Un <strong>tableau</strong> stocke plusieurs valeurs : indexé avec des positions dès 0, ou associatif avec des clés texte. On lit avec <code>$t[indice]</code> ou <code>$t["cle"]</code>, on ajoute avec <code>$t[] = ...</code>, et on parcourt avec <code>foreach</code>. Les fonctions <code>count</code>, <code>in_array</code>, <code>sort</code>, <code>array_sum</code> et <code>implode</code> couvrent la plupart des besoins.',
    'darija' => '<strong>Tableau</strong> kaykhzen bzaf valeurs : indexé b positions men 0, wla associatif b clés texte. Kanqraw b <code>$t[indice]</code> wla <code>$t["cle"]</code>, kanzido b <code>$t[] = ...</code>, w kandoro b <code>foreach</code>. Fonctions <code>count</code>, <code>in_array</code>, <code>sort</code>, <code>array_sum</code> w <code>implode</code> kayghatto l\'besoin.',
  ),
);
