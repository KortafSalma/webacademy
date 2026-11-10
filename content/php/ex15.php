<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex15.php
 */

return array (
  'id' => 'php-ex15',
  'title' => 'Sécurité PHP',
  'brief' => 'Échapper les sorties, hacher les mots de passe et valider les entrées.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — échapper du HTML',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$commentaire = "&lt;script&gt;alert(1)&lt;/script&gt;"</code>. Affiche-le avec <code>htmlspecialchars()</code> pour que les balises soient visibles sous forme de texte. La sortie doit contenir <code>&amp;lt;script&amp;gt;</code> et ne pas contenir de balise <code>&lt;script&gt;</code> active.</p>',
      'instructionsDarija' => '<p>3erref <code>$commentaire = "&lt;script&gt;alert(1)&lt;/script&gt;"</code>. 3red b <code>htmlspecialchars()</code> bach balises ybanou b7al texte. Sortie khas tfih <code>&amp;lt;script&amp;gt;</code> w ma tfihch balise <code>&lt;script&gt;</code> active.</p>',
      'starter' => '<?php
$commentaire = "<script>alert(1)</script>";

// Affichage sécurisé
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '&lt;script&gt;',
        ),
        1 => 
        array (
          'type' => 'output_not_contains',
          'value' => '<script>',
        ),
      ),
      'hints' => 
      array (
        0 => 'htmlspecialchars convertit < en &lt; et > en &gt;.',
        1 => 'Indique l\'encodage UTF-8.',
        2 => 'On échappe à la sortie, pas à l\'entrée.',
      ),
      'solution' => '<?php
$commentaire = "<script>alert(1)</script>";

echo htmlspecialchars($commentaire, ENT_QUOTES, \'UTF-8\');
?>',
      'explainFr' => '<code>htmlspecialchars()</code> transforme les caractères spéciaux en entités HTML. Le navigateur affiche alors le code comme du texte au lieu de l\'exécuter.',
      'explainDarija' => '<code>htmlspecialchars()</code> katbeddel caractères spéciaux l entités HTML. Navigateur kay3red code b7al texte blast ma ynffdo.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — hacher et vérifier',
      'lang' => 'php',
      'instructions' => '<p>Hache le mot de passe <code>secret123</code> avec <code>password_hash()</code> et <code>PASSWORD_DEFAULT</code>, puis vérifie-le avec <code>password_verify()</code>. Affiche <code>Mot de passe correct</code> si la vérification réussit.</p>',
      'instructionsDarija' => '<p>7achchi mot de passe <code>secret123</code> b <code>password_hash()</code> w <code>PASSWORD_DEFAULT</code>, men ba3d t7eqqeq mno b <code>password_verify()</code>. 3red <code>Mot de passe correct</code> ila vérification njhat.</p>',
      'starter' => '<?php
$motDePasse = "secret123";

// hash puis verify
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Mot de passe correct',
        ),
      ),
      'hints' => 
      array (
        0 => 'password_hash() génère un hash avec sel.',
        1 => 'password_verify() compare le mot de passe au hash.',
        2 => 'Ne jamais comparer le mot de passe en clair au hash avec ==.',
      ),
      'solution' => '<?php
$motDePasse = "secret123";

$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

echo password_verify($motDePasse, $hash) ? "Mot de passe correct" : "Mot de passe incorrect";
?>',
      'explainFr' => '<code>password_hash()</code> produit un hash différent à chaque appel grâce au sel aléatoire. <code>password_verify()</code> relit le sel contenu dans le hash et refait le calcul.',
      'explainDarija' => '<code>password_hash()</code> katproduit hash mokhtalef f kol appel b sel aléatoire. <code>password_verify()</code> katqra sel li f hash w kat3awed calcul.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — validation et jeton CSRF',
      'lang' => 'php',
      'instructions' => '<p>Valide <code>amal@site.ma</code> avec <code>filter_var()</code> et <code>FILTER_VALIDATE_EMAIL</code>. Génère un jeton avec <code>bin2hex(random_bytes(16))</code>, compare-le à lui-même avec <code>hash_equals()</code>, puis affiche <code>Email valide</code> et <code>Jeton valide</code>.</p>',
      'instructionsDarija' => '<p>Validi <code>amal@site.ma</code> b <code>filter_var()</code> w <code>FILTER_VALIDATE_EMAIL</code>. Generi jeton b <code>bin2hex(random_bytes(16))</code>, qaren-h m3a rasso b <code>hash_equals()</code>, men ba3d 3red <code>Email valide</code> w <code>Jeton valide</code>.</p>',
      'starter' => '<?php
$email = "amal@site.ma";

// Validation et jeton
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Email valide',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Jeton valide',
        ),
      ),
      'hints' => 
      array (
        0 => 'filter_var renvoie false si l\'email est invalide.',
        1 => 'random_bytes génère des octets imprévisibles.',
        2 => 'hash_equals compare deux chaînes en temps constant.',
      ),
      'solution' => '<?php
$email = "amal@site.ma";
$emailValide = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

$jeton = bin2hex(random_bytes(16));
$recu = $jeton;
$csrfOk = hash_equals($jeton, $recu);

echo $emailValide ? "Email valide" : "Email invalide";
echo "<br>";
echo $csrfOk ? "Jeton valide" : "Jeton invalide";
?>',
      'explainFr' => 'La validation bloque les emails mal formés. Le jeton aléatoire rend la valeur imprévisible, et <code>hash_equals()</code> évite les comparaisons sensibles au temps d\'exécution.',
      'explainDarija' => 'Validation kat7bes emails ghalitin. Jeton aléatoire kay3mel valeur ma ttwqqe3ch, w <code>hash_equals()</code> kaymna3 comparaisons 7assasa l temps d\'exécution.',
    ),
  ),
);
