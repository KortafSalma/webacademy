<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex11.php
 */

return array (
  'id' => 'php-ex11',
  'title' => 'Sessions et cookies',
  'brief' => 'Conserver des données entre les pages avec les sessions.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — ouvrir une session',
      'lang' => 'php',
      'instructions' => '<p>Démarre une session, stocke <code>Amal</code> dans <code>$_SESSION[\'utilisateur\']</code>, puis affiche <code>Connecté : Amal</code>.</p>',
      'instructionsDarija' => '<p>Bda session, khzen <code>Amal</code> f <code>$_SESSION[\'utilisateur\']</code>, men ba3d 3red <code>Connecté : Amal</code>.</p>',
      'starter' => '<?php
// session_start puis stockage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connecté : Amal',
        ),
      ),
      'hints' => 
      array (
        0 => 'session_start() doit être appelé avant tout affichage.',
        1 => '$_SESSION est un tableau superglobal.',
        2 => 'Lis la valeur avec $_SESSION[\'utilisateur\'].',
      ),
      'solution' => '<?php
session_start();

$_SESSION[\'utilisateur\'] = "Amal";
echo "Connecté : " . $_SESSION[\'utilisateur\'];
?>',
      'explainFr' => '<code>session_start()</code> crée ou reprend une session identifiée par un cookie. Les valeurs stockées dans <code>$_SESSION</code> restent disponibles sur les pages suivantes.',
      'explainDarija' => '<code>session_start()</code> kat5leq wla kat3awed session m3erfa b cookie. Valeurs mkheznin f <code>$_SESSION</code> kaybqaw disponibles f pages li mora.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — panier en session',
      'lang' => 'php',
      'instructions' => '<p>Démarre une session, crée <code>$_SESSION[\'panier\'] = ["PHP", "SQL"]</code>, ajoute <code>HTML</code> avec <code>$_SESSION[\'panier\'][] = "HTML"</code>, puis affiche <code>Articles : 3</code>.</p>',
      'instructionsDarija' => '<p>Bda session, 5leq <code>$_SESSION[\'panier\'] = ["PHP", "SQL"]</code>, zid <code>HTML</code> b <code>$_SESSION[\'panier\'][] = "HTML"</code>, men ba3d 3red <code>Articles : 3</code>.</p>',
      'starter' => '<?php
session_start();

// Panier
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Articles : 3',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un tableau en session se modifie comme un tableau normal.',
        1 => 'L\'ajout se fait avec [].',
        2 => 'count() renvoie le nombre d\'articles.',
      ),
      'solution' => '<?php
session_start();

$_SESSION[\'panier\'] = ["PHP", "SQL"];
$_SESSION[\'panier\'][] = "HTML";

echo "Articles : " . count($_SESSION[\'panier\']);
?>',
      'explainFr' => 'Le panier survit aux changements de page : l\'utilisateur peut ajouter des articles puis retrouver son panier plus tard. <code>count()</code> affiche 3.',
      'explainDarija' => 'Panier kaybqa 7ta melli page katbeddel : utilisateur y9der yzid articles w ylqa panier dyalo men ba3d. <code>count()</code> kay3red 3.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — vérifier puis détruire',
      'lang' => 'php',
      'instructions' => '<p>Démarre une session, stocke <code>Amal</code>, lis la valeur avec <code>??</code>, supprime-la avec <code>unset()</code>, puis affiche <code>Session active : Amal</code> et <code>Déconnecté</code> si la clé n\'existe plus.</p>',
      'instructionsDarija' => '<p>Bda session, khzen <code>Amal</code>, qra valeur b <code>??</code>, 7yedha b <code>unset()</code>, men ba3d 3red <code>Session active : Amal</code> w <code>Déconnecté</code> ila clé ma bqatch.</p>',
      'starter' => '<?php
session_start();

// Stocke, vérifie, supprime
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Session active : Amal',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Déconnecté',
        ),
      ),
      'hints' => 
      array (
        0 => 'Lis la valeur avant de la supprimer.',
        1 => 'unset($_SESSION[\'utilisateur\']) retire une clé précise.',
        2 => 'isset() vérifie si la clé existe encore.',
      ),
      'solution' => '<?php
session_start();

$_SESSION[\'utilisateur\'] = "Amal";
$utilisateur = $_SESSION[\'utilisateur\'] ?? null;
unset($_SESSION[\'utilisateur\']);

echo $utilisateur ? "Session active : " . $utilisateur : "Aucune session";
echo " | ";
echo isset($_SESSION[\'utilisateur\']) ? "Encore connecté" : "Déconnecté";
?>',
      'explainFr' => 'La valeur est lue avant sa suppression. <code>unset()</code> retire la clé de la session, puis <code>isset()</code> confirme que l\'utilisateur n\'est plus stocké.',
      'explainDarija' => 'Valeur katqra qbel suppression. <code>unset()</code> kay7yed clé men session, men ba3d <code>isset()</code> kay2ekked belli utilisateur ma bqach mkhezen.',
    ),
  ),
);
