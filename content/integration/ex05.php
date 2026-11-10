<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex05.php
 */

return array (
  'id' => 'integration-ex5',
  'title' => 'Authentification',
  'brief' => 'Hacher les mots de passe, vérifier les identifiants et gérer la session.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — hacher et vérifier',
      'lang' => 'php',
      'instructions' => '<p>Hache le mot de passe <code>secret123</code> avec <code>password_hash()</code> et <code>PASSWORD_DEFAULT</code>, puis vérifie-le avec <code>password_verify()</code>. Affiche <code>Inscription OK</code> et <code>Connexion réussie</code>.</p>',
      'instructionsDarija' => '<p>7achchi mot de passe <code>secret123</code> b <code>password_hash()</code> w <code>PASSWORD_DEFAULT</code>, men ba3d t7eqqeq mno b <code>password_verify()</code>. 3red <code>Inscription OK</code> w <code>Connexion réussie</code>.</p>',
      'starter' => '<?php
$motDePasse = \'secret123\';

// Hash puis vérification
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Inscription OK',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connexion réussie',
        ),
      ),
      'hints' => 
      array (
        0 => 'password_hash renvoie une chaîne différente à chaque appel.',
        1 => 'password_verify compare le mot de passe au hash.',
        2 => 'Ne stocke jamais le mot de passe en clair.',
      ),
      'solution' => '<?php
$motDePasse = \'secret123\';
$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

echo "Inscription OK<br>";
if (password_verify($motDePasse, $hash)) {
    echo "Connexion réussie";
} else {
    echo "Connexion refusée";
}',
      'explainFr' => 'Le hash est irréversible : même en cas de fuite de la base, le mot de passe d\'origine n\'est pas lisible. <code>password_verify()</code> refait le calcul avec le sel contenu dans le hash.',
      'explainDarija' => 'Hash ma ytqlebch : 7ta ila base tsrabat, mot de passe d\'origine ma ytqrach. <code>password_verify()</code> kay3awed calcul b sel li f hash.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — vérifier un utilisateur simulé',
      'lang' => 'php',
      'instructions' => '<p>Le tableau <code>$utilisateurs</code> contient un utilisateur avec son hash. Écris une fonction <code>connecter($email, $motDePasse, $utilisateurs)</code> qui renvoie le nom si les identifiants sont corrects, sinon <code>null</code>. Teste avec le bon mot de passe puis un mauvais, et affiche <code>Connexion réussie</code> puis <code>Identifiants invalides</code>.</p>',
      'instructionsDarija' => '<p>Tableau <code>$utilisateurs</code> fih utilisateur m3a hash dyalo. Kteb fonction <code>connecter($email, $motDePasse, $utilisateurs)</code> li katrje3 smiya ila identifiants s7a7, sinon <code>null</code>. Jerreb b mot de passe s7i7 men ba3d ghalt, w 3red <code>Connexion réussie</code> men ba3d <code>Identifiants invalides</code>.</p>',
      'starter' => '<?php
$utilisateurs = [
    [\'email\' => \'amal@example.ma\', \'nom\' => \'Amal\', \'hash\' => password_hash(\'secret123\', PASSWORD_DEFAULT)],
];

// Fonction connecter et deux essais
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connexion réussie',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Identifiants invalides',
        ),
      ),
      'hints' => 
      array (
        0 => 'Cherche l\'utilisateur par email dans la boucle.',
        1 => 'Utilise password_verify pour comparer.',
        2 => 'Le message d\'erreur reste générique : ni email ni mot de passe révélé.',
      ),
      'solution' => '<?php
$utilisateurs = [
    [\'email\' => \'amal@example.ma\', \'nom\' => \'Amal\', \'hash\' => password_hash(\'secret123\', PASSWORD_DEFAULT)],
];

function connecter($email, $motDePasse, $utilisateurs) {
    foreach ($utilisateurs as $utilisateur) {
        if ($utilisateur[\'email\'] === $email && password_verify($motDePasse, $utilisateur[\'hash\'])) {
            return $utilisateur[\'nom\'];
        }
    }
    return null;
}

$nom = connecter(\'amal@example.ma\', \'secret123\', $utilisateurs);
echo $nom !== null ? "Connexion réussie : " . $nom : "Identifiants invalides";
echo "<br>";
$nom = connecter(\'amal@example.ma\', \'mauvais\', $utilisateurs);
echo $nom !== null ? "Connexion réussie" : "Identifiants invalides";',
      'explainFr' => 'La fonction renvoie <code>null</code> dès qu\'un identifiant échoue. Le message affiché reste identique pour un email inconnu ou un mauvais mot de passe, afin de ne pas aider un attaquant.',
      'explainDarija' => 'Fonction katrje3 <code>null</code> melli identifiant yfchel. Message li kayban kaybqa nefs l email ma m3erof wla mot de passe ghalt, bach ma n3awnoch attaquant.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — session et régénération',
      'lang' => 'php',
      'instructions' => '<p>Démarre une session, stocke <code>Amal</code> dans <code>$_SESSION[\'utilisateur\']</code> et <code>admin</code> dans <code>$_SESSION[\'role\']</code>. Régénère l\'identifiant avec <code>session_regenerate_id(true)</code>, puis affiche <code>Connecté : Amal</code>, <code>Rôle : admin</code> et <code>Session régénérée</code>.</p>',
      'instructionsDarija' => '<p>Bda session, khzen <code>Amal</code> f <code>$_SESSION[\'utilisateur\']</code> w <code>admin</code> f <code>$_SESSION[\'role\']</code>. Regeneri identifiant b <code>session_regenerate_id(true)</code>, men ba3d 3red <code>Connecté : Amal</code>, <code>Rôle : admin</code> w <code>Session régénérée</code>.</p>',
      'starter' => '<?php
session_start();

// Stockage et régénération
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connecté : Amal',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Rôle : admin',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'Session régénérée',
        ),
      ),
      'hints' => 
      array (
        0 => 'session_start() doit précéder tout affichage.',
        1 => 'session_regenerate_id(true) change l\'identifiant et supprime l\'ancien.',
        2 => 'Les données de session restent disponibles après régénération.',
      ),
      'solution' => '<?php
session_start();

$_SESSION[\'utilisateur\'] = \'Amal\';
$_SESSION[\'role\'] = \'admin\';
session_regenerate_id(true);

echo "Connecté : " . $_SESSION[\'utilisateur\'] . "<br>";
echo "Rôle : " . $_SESSION[\'role\'] . "<br>";
echo "Session régénérée";',
      'explainFr' => 'Régénérer l\'identifiant après la connexion empêche la fixation de session : un identifiant préparé à l\'avance par un attaquant devient inutilisable.',
      'explainDarija' => 'Régénérer identifiant mora connexion kaymna3 fixation session : identifiant préparé qbel men attaquant kaywli ma yst3melch.',
    ),
  ),
);
