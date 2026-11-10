<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex06.php
 */

return array (
  'id' => 'integration-ex6',
  'title' => 'Sécurité applicative',
  'brief' => 'Échapper les sorties, valider les entrées et vérifier les jetons.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — échapper une sortie',
      'lang' => 'php',
      'instructions' => '<p>Le commentaire contient <code>&lt;script&gt;alert(1)&lt;/script&gt;</code>. Affiche-le avec <code>htmlspecialchars()</code> pour que la balise soit visible en texte et ne s\'exécute pas.</p>',
      'instructionsDarija' => '<p>Commentaire fih <code>&lt;script&gt;alert(1)&lt;/script&gt;</code>. 3redo b <code>htmlspecialchars()</code> bach balise tban b7al texte w ma tnffedch.</p>',
      'starter' => '<?php
$commentaire = \'<script>alert(1)</script>\';

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
        0 => 'htmlspecialchars convertit < et > en entités.',
        1 => 'Passe ENT_QUOTES et UTF-8.',
        2 => 'L\'échappement se fait au moment de l\'affichage.',
      ),
      'solution' => '<?php
$commentaire = \'<script>alert(1)</script>\';

echo htmlspecialchars($commentaire, ENT_QUOTES, \'UTF-8\');',
      'explainFr' => 'Le navigateur reçoit du texte échappé, pas une balise exécutable. C\'est la protection de base contre le XSS stocké.',
      'explainDarija' => 'Navigateur kayakhod texte échappé, machi balise katnffed. Hadi protection asasiya men XSS stocké.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — valider les entrées',
      'lang' => 'php',
      'instructions' => '<p>Valide <code>$email = \'amal@site.ma\'</code> avec <code>FILTER_VALIDATE_EMAIL</code> et <code>$age = \'25\'</code> avec <code>FILTER_VALIDATE_INT</code>. Affiche <code>Email valide</code>, <code>Âge valide</code>, puis teste <code>faux-email</code> et affiche <code>Email invalide</code>.</p>',
      'instructionsDarija' => '<p>Validi <code>$email = \'amal@site.ma\'</code> b <code>FILTER_VALIDATE_EMAIL</code> w <code>$age = \'25\'</code> b <code>FILTER_VALIDATE_INT</code>. 3red <code>Email valide</code>, <code>Âge valide</code>, men ba3d jerreb <code>faux-email</code> w 3red <code>Email invalide</code>.</p>',
      'starter' => '<?php
$email = \'amal@site.ma\';
$age = \'25\';

// Validations
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
          'value' => 'Âge valide',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'Email invalide',
        ),
      ),
      'hints' => 
      array (
        0 => 'filter_var renvoie la valeur validée ou false.',
        1 => 'FILTER_VALIDATE_INT rejette les chaînes non numériques.',
        2 => 'Compare avec !== false pour éviter les faux positifs.',
      ),
      'solution' => '<?php
$email = \'amal@site.ma\';
$age = \'25\';

$emailValide = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
$ageValide = filter_var($age, FILTER_VALIDATE_INT) !== false;

echo $emailValide ? "Email valide<br>" : "Email invalide<br>";
echo $ageValide ? "Âge valide<br>" : "Âge invalide<br>";

$email = \'faux-email\';
$emailValide = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
echo $emailValide ? "Email valide" : "Email invalide";',
      'explainFr' => 'Les filtres vérifient le format avant tout traitement. Un email invalide est rejeté tôt, sans requête SQL ni écriture en base.',
      'explainDarija' => 'Filtres kayt7eqqo format qbel ay traitement. Email ghalt kayrefus b bekri, bla requête SQL wla écriture f base.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — jeton CSRF et requête préparée',
      'lang' => 'php',
      'instructions' => '<p>Génère un jeton avec <code>bin2hex(random_bytes(16))</code>, compare-le à <code>$jetonRecu</code> avec <code>hash_equals()</code>, et vérifie que <code>$sql</code> contient le placeholder <code>:email</code>. Affiche <code>Jeton CSRF valide</code> et <code>Requête préparée</code>.</p>',
      'instructionsDarija' => '<p>Generi jeton b <code>bin2hex(random_bytes(16))</code>, qaren-h m3a <code>$jetonRecu</code> b <code>hash_equals()</code>, w t7eqqeq belli <code>$sql</code> fih placeholder <code>:email</code>. 3red <code>Jeton CSRF valide</code> w <code>Requête préparée</code>.</p>',
      'starter' => '<?php
$sql = \'SELECT id FROM utilisateur WHERE email = :email\';
$jeton = bin2hex(random_bytes(16));
$jetonRecu = $jeton;

// Vérifications
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Jeton CSRF valide',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Requête préparée',
        ),
      ),
      'hints' => 
      array (
        0 => 'random_bytes produit des octets imprévisibles.',
        1 => 'hash_equals compare sans fuite de temps.',
        2 => 'str_contains vérifie la présence du placeholder.',
      ),
      'solution' => '<?php
$sql = \'SELECT id FROM utilisateur WHERE email = :email\';
$jeton = bin2hex(random_bytes(16));
$jetonRecu = $jeton;

$csrfOk = hash_equals($jeton, $jetonRecu);
$prepareOk = str_contains($sql, \':email\');

echo $csrfOk ? "Jeton CSRF valide<br>" : "Jeton CSRF invalide<br>";
echo $prepareOk ? "Requête préparée" : "Requête non préparée";',
      'explainFr' => 'Le jeton CSRF protège les actions sensibles, et la requête préparée protège les valeurs. Les deux mécanismes sont complémentaires : l\'un contrôle l\'origine de la demande, l\'autre empêche l\'injection SQL.',
      'explainDarija' => 'Jeton CSRF kay7mi actions 7assasa, w requête préparée kat7mi valeurs. Jouj mécanismes kaykmmlo b3dhom : wa7ed kaycontrol origine demande, akhor kaymna3 injection SQL.',
    ),
  ),
);
