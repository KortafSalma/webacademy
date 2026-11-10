<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c11.json
 */

return array (
  'id' => 'php-ch11',
  'title' => 'Sessions et cookies',
  'subtitle' => 'Mémoriser des informations entre deux requêtes',
  'objectives' => 
  array (
    0 => 'Comprendre la différence entre cookie et session.',
    1 => 'Créer et lire un cookie avec setcookie et $_COOKIE.',
    2 => 'Démarrer une session et stocker des données dans $_SESSION.',
    3 => 'Détruire une session proprement à la déconnexion.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'cookies',
      'title' => 'Les cookies',
      'icon' => '🍪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>HTTP est <strong>sans mémoire</strong> : chaque requête est indépendante. Un <strong>cookie</strong> est un petit fichier texte déposé par le serveur dans le navigateur, renvoyé automatiquement à chaque visite. Il permet de retenir une préférence, une langue ou un identifiant.</p>',
          'darija' => '<p>HTTP <strong>bla mémoire</strong> : kol requête mstqla. <strong>Cookie</strong> howa fichier texte sghir kay7etto serveur f navigateur, w kayrje3 automatiquement f kol visite. Kaykhalli y3qel préférence, langue wla identifiant.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Créer et lire un cookie',
          'code' => '// Créer : nom, valeur, expiration (timestamp)
setcookie("langue", "fr", time() + 30 * 24 * 3600);

// Lire (à la requête suivante)
echo $_COOKIE["langue"] ?? "fr";

// Supprimer : date passée
setcookie("langue", "", time() - 3600);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Retenir le prénom du visiteur',
          'lang' => 'php',
          'code' => '<?php
if (isset($_GET["nom"])) {
    setcookie("nom", $_GET["nom"], time() + 3600);
    $nom = $_GET["nom"];
} else {
    $nom = $_COOKIE["nom"] ?? "inconnu";
}

echo "Salam " . htmlspecialchars($nom) . " !";
?>',
          'explainFr' => 'Le cookie est envoyé au navigateur lors de cette requête ; il ne sera lisible dans <code>$_COOKIE</code> qu\'à la <strong>requête suivante</strong>. C\'est la confusion la plus fréquente.',
          'explainDarija' => 'Cookie kaytseft l navigateur f had requête ; ghadi ytqra f <code>$_COOKIE</code> ghir f <strong>requête li mora</strong>. Hadi hiya confusion li kat3awed bzaf.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'setcookie avant tout affichage',
          'fr' => '<code>setcookie()</code> modifie les en-têtes HTTP : il doit être appelé <strong>avant</strong> le moindre caractère affiché (même un espace ou un BOM). Sinon : « headers already sent ».',
          'darija' => '<code>setcookie()</code> katbeddel en-têtes HTTP : khas t3ayet 3liha <strong>qbel</strong> ay caractère yt3red (7ta espace). Sinon : « headers already sent ».',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'sessions',
      'title' => 'Les sessions',
      'icon' => '🗄️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un cookie ne doit jamais contenir d\'information sensible : le visiteur peut le modifier. La <strong>session</strong> stocke les données <strong>sur le serveur</strong> ; le navigateur ne reçoit qu\'un identifiant de session (<code>PHPSESSID</code>).</p>',
          'darija' => '<p>Cookie ma khaso ykon fih ma3loma sensible : visiteur y9der ybeddelha. <strong>Session</strong> katkhzen données <strong>f serveur</strong> ; navigateur kayakhod ghir identifiant dyal session (<code>PHPSESSID</code>).</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Démarrer et utiliser une session',
          'code' => 'session_start();          // toujours en premier

$_SESSION["user"] = "Amal";
echo $_SESSION["user"];

// Déconnexion
session_unset();
session_destroy();',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Compteur de visites',
          'lang' => 'php',
          'code' => '<?php
session_start();

$_SESSION["visites"] = ($_SESSION["visites"] ?? 0) + 1;

echo "Visite numéro " . $_SESSION["visites"];
?>',
          'explainFr' => '<code>session_start()</code> ouvre ou reprend la session. La valeur est conservée côté serveur entre les requêtes : le compteur augmente à chaque rechargement.',
          'explainDarija' => '<code>session_start()</code> kat7el wla kat3awed session. Valeur katbqa f serveur bin requêtes : compteur kayzid f kol rechargement.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'session_start en haut de chaque page',
          'fr' => 'Toute page qui lit ou écrit <code>$_SESSION</code> doit appeler <code>session_start()</code> en premier, avant tout HTML. Un include de configuration est l\'endroit idéal.',
          'darija' => 'Kol page li katqra wla katkteb <code>$_SESSION</code> khas t3ayet <code>session_start()</code> f lwel, qbel ay HTML. Include dyal configuration howa blasa mzyana.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'session-securite',
      'title' => 'Authentification et sécurité',
      'icon' => '🔐',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Pour connecter un utilisateur : vérifier les identifiants, appeler <code>session_regenerate_id(true)</code> pour éviter la fixation de session, puis stocker l\'identifiant utilisateur dans <code>$_SESSION</code>. À la déconnexion, vider puis détruire la session.</p>',
          'darija' => '<p>Bach tconnecti utilisateur : t7eqqeq identifiants, t3ayet <code>session_regenerate_id(true)</code> bach tmna3 fixation de session, men ba3d tkhzen id dyal utilisateur f <code>$_SESSION</code>. F déconnexion, ferregh w men ba3d dammar session.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Pseudo-code de connexion',
          'lang' => 'php',
          'code' => '<?php
session_start();

// 1. Vérification (à remplacer par une requête SQL préparée)
if ($email === "amal@site.ma" && password_verify($motDePasse, $hash)) {
    session_regenerate_id(true);
    $_SESSION["user_id"] = 42;
    header("Location: dashboard.php");
    exit;
}

echo "Identifiants incorrects";
?>',
          'explainFr' => '<code>password_verify()</code> compare le mot de passe au hash stocké en base. <code>header()</code> redirige, et <code>exit</code> arrête le script pour que la redirection soit effective.',
          'explainDarija' => '<code>password_verify()</code> katqaren mot de passe m3a hash li kayn f base. <code>header()</code> katredirecti, w <code>exit</code> kat7bess script bach redirection tkhdem.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Ne jamais stocker un mot de passe en clair',
          'fr' => 'Un mot de passe se stocke avec <code>password_hash()</code> et se vérifie avec <code>password_verify()</code>. Jamais de <code>md5()</code> ni de texte brut dans la base.',
          'darija' => 'Mot de passe kaytkhzen b <code>password_hash()</code> w kayt7eqqeq b <code>password_verify()</code>. 3omrek ma tkhzen <code>md5()</code> wla texte clair f base.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'setcookie("nom", "Amal"); puis echo $_COOKIE["nom"];',
      'fix' => 'Lire le cookie à la requête suivante, ou utiliser une variable temporaire.',
      'fr' => 'Le cookie n\'est pas disponible dans <code>$_COOKIE</code> pendant la requête qui le crée.',
      'darija' => 'Cookie ma kaynch f <code>$_COOKIE</code> f nefs requête li kat5lqo.',
    ),
    1 => 
    array (
      'wrong' => 'session_start(); après du HTML',
      'fix' => 'Placer session_start(); tout en haut du fichier.',
      'fr' => 'Toute sortie avant <code>session_start()</code> provoque « headers already sent » et casse la session.',
      'darija' => 'Ay sortie qbel <code>session_start()</code> kat3ti « headers already sent » w katkhesr session.',
    ),
    2 => 
    array (
      'wrong' => '$_SESSION["panier"] = $_COOKIE["panier"];',
      'fix' => 'Stocker le panier côté serveur dans $_SESSION.',
      'fr' => 'Un cookie est modifiable par l\'utilisateur : ne lui faites pas confiance pour des données critiques (panier, droits, prix).',
      'darija' => 'Cookie kay9der ybeddlo utilisateur : ma t3ti7ch tiqa f données critiques (panier, droits, prix).',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Un <strong>cookie</strong> est stocké dans le navigateur : parfait pour une préférence, jamais pour une donnée sensible. Une <strong>session</strong> est stockée sur le serveur et identifiée par un cookie <code>PHPSESSID</code>. On l\'ouvre avec <code>session_start()</code>, on y écrit via <code>$_SESSION</code>, et on la détruit à la déconnexion. Les mots de passe passent par <code>password_hash</code> et <code>password_verify</code>.',
    'darija' => '<strong>Cookie</strong> kaytkhzen f navigateur : mzyan l préférence, 3omrek ma t7et fih donnée sensible. <strong>Session</strong> katkhzen f serveur w kat3arref b cookie <code>PHPSESSID</code>. Kat7elha b <code>session_start()</code>, katkteb f <code>$_SESSION</code>, w kathdemha f déconnexion. Mots de passe kaydowzo b <code>password_hash</code> w <code>password_verify</code>.',
  ),
);
