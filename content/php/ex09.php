<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex09.php
 */

return array (
  'id' => 'php-ex9',
  'title' => 'Traitement des formulaires',
  'brief' => 'Lire, nettoyer et valider des données reçues.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — lire et nettoyer',
      'lang' => 'php',
      'instructions' => '<p>Le tableau <code>$_POST[\'nom\']</code> contient <code>"  Amal  "</code>. Lis-le avec l\'opérateur <code>??</code>, nettoie-le avec <code>trim()</code>, puis affiche <code>Bonjour Amal</code>.</p>',
      'instructionsDarija' => '<p>Tableau <code>$_POST[\'nom\']</code> fih <code>"  Amal  "</code>. Qraha b opérateur <code>??</code>, nqiha b <code>trim()</code>, men ba3d 3red <code>Bonjour Amal</code>.</p>',
      'starter' => '<?php
$_POST[\'nom\'] = "  Amal  ";

// Lis, nettoie, affiche
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
        0 => '$_POST[\'nom\'] ?? \'\' évite une erreur si le champ manque.',
        1 => 'trim() enlève les espaces autour.',
        2 => 'Concatène « Bonjour » et le nom nettoyé.',
      ),
      'solution' => '<?php
$_POST[\'nom\'] = "  Amal  ";

$nom = trim($_POST[\'nom\'] ?? \'\');
echo "Bonjour " . $nom;
?>',
      'explainFr' => 'L\'opérateur <code>??</code> fournit une valeur par défaut si la clé n\'existe pas. <code>trim()</code> supprime les espaces saisis par erreur, et l\'affichage devient propre.',
      'explainDarija' => 'Opérateur <code>??</code> kay3ti valeur par défaut ila clé ma kanatch. <code>trim()</code> kay7yed espaces li tketbo b ghalat, w affichage kaywli nqi.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — valider un email',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$email = "amal@site.ma"</code> et utilise <code>filter_var()</code> avec <code>FILTER_VALIDATE_EMAIL</code> pour afficher <code>Email valide</code> si le format est correct, sinon <code>Email invalide</code>.</p>',
      'instructionsDarija' => '<p>3erref <code>$email = "amal@site.ma"</code> w khdem b <code>filter_var()</code> m3a <code>FILTER_VALIDATE_EMAIL</code> bach t3red <code>Email valide</code> ila format s7i7, sinon <code>Email invalide</code>.</p>',
      'starter' => '<?php
$email = "amal@site.ma";

// Validation
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Email valide',
        ),
      ),
      'hints' => 
      array (
        0 => 'filter_var renvoie l\'email validé ou false.',
        1 => 'Compare explicitement à false avec !==.',
        2 => 'Utilise un ternaire pour choisir le message.',
      ),
      'solution' => '<?php
$email = "amal@site.ma";

$valide = filter_var($email, FILTER_VALIDATE_EMAIL);
echo $valide !== false ? "Email valide" : "Email invalide";
?>',
      'explainFr' => '<code>filter_var()</code> vérifie la structure de l\'adresse. Elle renvoie la chaîne validée ou <code>false</code> : le test <code>!== false</code> évite de confondre avec une chaîne vide.',
      'explainDarija' => '<code>filter_var()</code> katt7eqqeq structure dyal adresse. Katrje3 chaîne validée wla <code>false</code> : test <code>!== false</code> kaymna3 khelt m3a chaîne khawya.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — erreurs de formulaire',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$nom = ""</code> et <code>$email = "amal@site.ma"</code>. Construis un tableau <code>$erreurs</code> : ajoute <code>Le nom est obligatoire</code> si le nom est vide, et <code>Email invalide</code> si l\'email est invalide. Affiche <code>Erreurs : ...</code> avec <code>implode()</code>, ou <code>Formulaire valide</code> s\'il n\'y a aucune erreur.</p>',
      'instructionsDarija' => '<p>3erref <code>$nom = ""</code> w <code>$email = "amal@site.ma"</code>. Bni tableau <code>$erreurs</code> : zid <code>Le nom est obligatoire</code> ila nom khawi, w <code>Email invalide</code> ila email ghalt. 3red <code>Erreurs : ...</code> b <code>implode()</code>, wla <code>Formulaire valide</code> ila ma kanch erreur.</p>',
      'starter' => '<?php
$nom = "";
$email = "amal@site.ma";
$erreurs = [];

// Validation
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Le nom est obligatoire',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un tableau d\'erreurs se remplit avec $erreurs[].',
        1 => 'Vérifie le nom vide avec === \'\'.',
        2 => 'implode(\', \', $erreurs) affiche toutes les erreurs.',
      ),
      'solution' => '<?php
$nom = "";
$email = "amal@site.ma";
$erreurs = [];

if ($nom === \'\') {
    $erreurs[] = "Le nom est obligatoire";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "Email invalide";
}

if ($erreurs) {
    echo "Erreurs : " . implode(", ", $erreurs);
} else {
    echo "Formulaire valide";
}
?>',
      'explainFr' => 'On collecte toutes les erreurs au lieu de s\'arrêter à la première : l\'utilisateur corrige tout en une seule fois. <code>implode()</code> les affiche séparément.',
      'explainDarija' => 'Kanjem3o kol erreurs blast ma n7ebso f lawla : utilisateur kaysele7 kolchi f marra wa7da. <code>implode()</code> kay3redhom mfreqin.',
    ),
  ),
);
