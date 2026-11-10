<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c08.json
 */

return array (
  'id' => 'php-ch8',
  'title' => 'Fonctions de chaînes',
  'subtitle' => 'Transformer, découper et sécuriser du texte',
  'objectives' => 
  array (
    0 => 'Mesurer et nettoyer une chaîne avec strlen et trim.',
    1 => 'Changer la casse et remplacer du texte.',
    2 => 'Extraire une partie avec substr et chercher avec str_contains.',
    3 => 'Découper avec explode et recomposer avec implode.',
    4 => 'Échapper du HTML avec htmlspecialchars.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'longueur-nettoyage',
      'title' => 'Longueur et nettoyage',
      'icon' => '📏',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les données saisies par un utilisateur contiennent souvent des espaces inutiles. <code>trim()</code> les supprime au début et à la fin ; <code>strlen()</code> mesure la longueur en octets.</p>',
          'darija' => '<p>Données li kaydkhel utilisateur ghaliban fihom des espaces zaydin. <code>trim()</code> kat7yedhom men lbda w l\'akhir ; <code>strlen()</code> katqis toul b octets.</p>',
        ),
        1 => 
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
              0 => 'strlen($s)',
              1 => 'longueur en octets',
              2 => 'strlen("Salam") → 5',
            ),
            1 => 
            array (
              0 => 'mb_strlen($s)',
              1 => 'longueur en caractères (UTF-8)',
              2 => 'mb_strlen("é") → 1',
            ),
            2 => 
            array (
              0 => 'trim($s)',
              1 => 'supprime les espaces autour',
              2 => 'trim("  hi  ") → "hi"',
            ),
            3 => 
            array (
              0 => 'strtoupper($s)',
              1 => 'met en majuscules',
              2 => 'strtoupper("php") → "PHP"',
            ),
            4 => 
            array (
              0 => 'strtolower($s)',
              1 => 'met en minuscules',
              2 => 'strtolower("PHP") → "php"',
            ),
            5 => 
            array (
              0 => 'ucfirst($s)',
              1 => 'majuscule au premier caractère',
              2 => 'ucfirst("salam") → "Salam"',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Nettoyer un prénom',
          'lang' => 'php',
          'code' => '<?php
$saisie = "   amal   ";
$propre = ucfirst(strtolower(trim($saisie)));

echo "[" . $saisie . "]<br>";
echo "[" . $propre . "]<br>";
echo "Longueur : " . strlen($propre);
?>',
          'output' => '[   amal   ]<br>[Amal]<br>Longueur : 4',
          'explainFr' => 'Les fonctions s\'enchaînent : <code>trim()</code> enlève les espaces, <code>strtolower()</code> normalise la casse, puis <code>ucfirst()</code> remet une majuscule au début.',
          'explainDarija' => 'Fonctions kaymchiw m3a b3dhom : <code>trim()</code> kat7yed espaces, <code>strtolower()</code> katnormalisi casse, w <code>ucfirst()</code> katrje3 majuscule f lbda.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'strlen et les accents',
          'fr' => '<code>strlen()</code> compte les octets : « é » en UTF-8 occupe 2 octets, donc <code>strlen("é")</code> renvoie 2. Pour compter des caractères lisibles, utilisez <code>mb_strlen()</code>.',
          'darija' => '<code>strlen()</code> kat3ed octets : « é » f UTF-8 kayakhod 2 octets, donc <code>strlen("é")</code> katrje3 2. Bach t3ed caractères, khdem b <code>mb_strlen()</code>.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'remplacer-extraire',
      'title' => 'Remplacer, extraire, chercher',
      'icon' => '✂️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>str_replace()</code> remplace toutes les occurrences d\'un texte. <code>substr()</code> extrait une portion à partir d\'une position. <code>str_contains()</code> indique si une sous-chaîne est présente (PHP 8+).</p>',
          'darija' => '<p><code>str_replace()</code> katbeddel kol les occurrences dyal texte. <code>substr()</code> katkhrej portion men position. <code>str_contains()</code> katgol wach sous-chaîne kayna (PHP 8+).</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe',
          'code' => 'str_replace("cherche", "remplace", $texte);
substr($texte, 0, 5);
str_contains($texte, "motif");',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Générer un identifiant propre',
          'lang' => 'php',
          'code' => '<?php
$titre = "  Mon Premier Article  ";
$propre = strtolower(trim($titre));
$slug = str_replace(" ", "-", $propre);

echo $slug . "<br>";
echo substr($slug, 0, 3) . "<br>";
echo str_contains($slug, "premier") ? "Contient premier" : "Ne contient pas premier";
?>',
          'output' => 'mon-premier-article<br>mon<br>Contient premier',
          'explainFr' => '<code>trim</code> puis <code>strtolower</code> normalisent le titre ; <code>str_replace</code> transforme les espaces en tirets. <code>substr($slug, 0, 3)</code> prend trois caractères à partir de la position 0.',
          'explainDarija' => '<code>trim</code> w <code>strtolower</code> kaynormalisiw titre ; <code>str_replace</code> katbeddel espaces b tirets. <code>substr($slug, 0, 3)</code> katakhod 3 caractères men position 0.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Négatifs avec substr',
          'fr' => 'Une position négative compte depuis la fin : <code>substr("WebAcademy", -7)</code> renvoie « cademy ». Pratique pour récupérer une extension de fichier.',
          'darija' => 'Position négative kat3ed men l\'akhir : <code>substr("WebAcademy", -7)</code> katrje3 « cademy ». Mzyana bach tjib extension dyal fichier.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'decouper-joindre',
      'title' => 'Découper et rejoindre',
      'icon' => '🔗',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>explode()</strong> découpe une chaîne selon un séparateur et renvoie un tableau. <strong>implode()</strong> fait l\'inverse : elle colle les éléments d\'un tableau avec un séparateur.</p>',
          'darija' => '<p><strong>explode()</strong> katqess chaîne 3la 7sab séparateur w katrje3 tableau. <strong>implode()</strong> kat3mel l\'3aks : katls9 éléments dyal tableau b séparateur.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Découper une phrase',
          'lang' => 'php',
          'code' => '<?php
$phrase = "HTML,CSS,PHP,SQL";
$langages = explode(",", $phrase);

foreach ($langages as $langage) {
    echo "- " . $langage . "<br>";
}

echo "Total : " . count($langages) . "<br>";
echo implode(" | ", $langages);
?>',
          'output' => '- HTML<br>- CSS<br>- PHP<br>- SQL<br>Total : 4<br>HTML | CSS | PHP | SQL',
          'explainFr' => '<code>explode()</code> transforme la chaîne en tableau de 4 éléments. <code>implode()</code> reconstruit une chaîne avec un autre séparateur.',
          'explainDarija' => '<code>explode()</code> katbeddel chaîne l tableau dyal 4 éléments. <code>implode()</code> kat3awed tbni chaîne b séparateur akhor.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Sécuriser un affichage',
          'lang' => 'php',
          'code' => '<?php
$commentaire = "<script>alert(\'xss\')</script>";

echo htmlspecialchars($commentaire);
?>',
          'output' => '&lt;script&gt;alert(\'xss\')&lt;/script&gt;',
          'explainFr' => '<code>htmlspecialchars()</code> transforme <code>&lt;</code> et <code>&gt;</code> en entités HTML : le navigateur affiche le texte au lieu d\'exécuter le script.',
          'explainDarija' => '<code>htmlspecialchars()</code> katbeddel <code>&lt;</code> w <code>&gt;</code> b entités HTML : navigateur kay3red texte blast ma ynffed script.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'strlen("é") pour compter un caractère accentué',
      'fix' => 'mb_strlen("é", "UTF-8")',
      'fr' => '<code>strlen()</code> compte les octets, pas les caractères : les accents faussent le résultat.',
      'darija' => '<code>strlen()</code> kat3ed octets machi caractères : accents kayghallto résultat.',
    ),
    1 => 
    array (
      'wrong' => 'echo $texte; avec du contenu utilisateur',
      'fix' => 'echo htmlspecialchars($texte);',
      'fr' => 'Afficher directement une saisie permet l\'injection de HTML ou de JavaScript (XSS). Échappez toujours avec <code>htmlspecialchars()</code>.',
      'darija' => 'T3red saisie nichan kaykhalli injection dyal HTML wla JavaScript (XSS). Dima 3mel échappement b <code>htmlspecialchars()</code>.',
    ),
    2 => 
    array (
      'wrong' => 'explode(" ", $texte) puis echo $texte',
      'fix' => '$mots = explode(" ", $texte); echo $mots[0];',
      'fr' => '<code>explode()</code> renvoie un tableau : il faut lire ses éléments, pas afficher la chaîne d\'origine.',
      'darija' => '<code>explode()</code> katrje3 tableau : khas tqra éléments dyalo, machi t3red chaîne l\'asliya.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Les fonctions de chaînes nettoient et transforment le texte : <strong>trim</strong>, <strong>strlen/mb_strlen</strong>, <strong>strtoupper/strtolower</strong>, <strong>str_replace</strong>, <strong>substr</strong>, <strong>str_contains</strong>, <strong>explode/implode</strong>. Avant tout affichage de données utilisateur, échappez avec <strong>htmlspecialchars</strong> pour éviter les injections HTML.',
    'darija' => 'Fonctions dyal chaînes kaynaddfo w kaybeddlo texte : <strong>trim</strong>, <strong>strlen/mb_strlen</strong>, <strong>strtoupper/strtolower</strong>, <strong>str_replace</strong>, <strong>substr</strong>, <strong>str_contains</strong>, <strong>explode/implode</strong>. Qbel ma t3red données dyal utilisateur, 3mel échappement b <strong>htmlspecialchars</strong> bach tmna3 injections HTML.',
  ),
);
