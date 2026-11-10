<?php

declare(strict_types=1);

/**
 * Contenu généré depuis integration-c05.json
 */

return array (
  'id' => 'integration-ch5',
  'title' => 'Authentification',
  'subtitle' => 'Inscrire, connecter et protéger les utilisateurs',
  'objectives' => 
  array (
    0 => 'Stocker un mot de passe correctement avec password_hash.',
    1 => 'Vérifier des identifiants avec password_verify.',
    2 => 'Ouvrir une session sécurisée après connexion.',
    3 => 'Protéger les pages réservées aux utilisateurs connectés.',
    4 => 'Se déconnecter proprement.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'inscription',
      'title' => 'Inscription et stockage du mot de passe',
      'icon' => '📝',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un système d\'authentification repose sur une table <code>utilisateur</code> avec un email <strong>UNIQUE</strong> et un mot de passe <strong>haché</strong>. On ne stocke jamais le mot de passe en clair, ni avec MD5 ou SHA1 : on utilise <code>password_hash()</code>.</p>',
          'darija' => '<p>Système d\'authentification kaybna 3la table <code>utilisateur</code> fiha email <strong>UNIQUE</strong> w mot de passe <strong>haché</strong>. 3omrek ma tkhzen mot de passe clair, wla b MD5 wla SHA1 : khdem b <code>password_hash()</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Table utilisateur',
          'code' => 'CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(120) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    nom VARCHAR(80) NOT NULL,
    cree_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Inscription sécurisée',
          'lang' => 'php',
          'code' => '<?php
$email = trim($_POST[\'email\'] ?? \'\');
$motDePasse = $_POST[\'mot_de_passe\'] ?? \'\';
$nom = trim($_POST[\'nom\'] ?? \'\');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit(\'Email invalide\');
}
if (strlen($motDePasse) < 8) {
    exit(\'Le mot de passe doit faire au moins 8 caractères\');
}

$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    \'INSERT INTO utilisateur (email, mot_de_passe, nom) VALUES (:email, :hash, :nom)\'
);
$stmt->execute([\':email\' => $email, \':hash\' => $hash, \':nom\' => $nom]);
?>
',
          'explainFr' => '<code>password_hash()</code> génère un sel aléatoire et un hash lent (bcrypt par défaut). La colonne doit pouvoir stocker 255 caractères, car le hash complet est plus long que le mot de passe.',
          'explainDarija' => '<code>password_hash()</code> kaygeneri sel aléatoire w hash bti2 (bcrypt par défaut). Colonne khas tqder tkhzen 255 caractères, 7it hash kamel twel men mot de passe.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'L\'email unique protège l\'inscription',
          'fr' => 'Sans contrainte <code>UNIQUE</code>, deux comptes peuvent partager le même email. La connexion devient ambiguë et un attaquant peut créer un doublon. Gérez aussi l\'erreur de duplication avec un message clair.',
          'darija' => 'Bla contrainte <code>UNIQUE</code>, jouj comptes y9dro ycharko nefs email. Connexion katwli ambiguë w attaquant y9der y5leq doublon. 7ekkem 7ta f erreur dyal duplication b message wad7.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'connexion',
      'title' => 'Connexion',
      'icon' => '🔑',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>À la connexion, on recherche l\'utilisateur par email, puis on compare le mot de passe fourni au hash stocké avec <code>password_verify()</code>. En cas de succès, on régénère l\'identifiant de session et on stocke l\'identifiant utilisateur dans <code>$_SESSION</code>.</p>',
          'darija' => '<p>F connexion, kanqellbo 3la utilisateur b email, men ba3d kanqarno mot de passe li 3tana m3a hash mkhezen b <code>password_verify()</code>. Ila njah, kan3awdo ngeneriw identifiant dyal session w kankhzeno id dyal utilisateur f <code>$_SESSION</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Vérification des identifiants',
          'lang' => 'php',
          'code' => '<?php
session_start();

$email = trim($_POST[\'email\'] ?? \'\');
$motDePasse = $_POST[\'mot_de_passe\'] ?? \'\';

$stmt = $pdo->prepare(\'SELECT id, nom, mot_de_passe FROM utilisateur WHERE email = :email\');
$stmt->execute([\':email\' => $email]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if ($utilisateur && password_verify($motDePasse, $utilisateur[\'mot_de_passe\'])) {
    session_regenerate_id(true);
    $_SESSION[\'user_id\'] = (int) $utilisateur[\'id\'];
    $_SESSION[\'user_nom\'] = $utilisateur[\'nom\'];
    header(\'Location: dashboard.php\');
    exit;
}

// Message volontairement générique
$erreur = \'Email ou mot de passe incorrect.\';
?>
',
          'explainFr' => '<code>session_regenerate_id(true)</code> change l\'identifiant de session après connexion : il empêche la fixation de session. Le message d\'erreur ne précise pas si c\'est l\'email ou le mot de passe qui est faux.',
          'explainDarija' => '<code>session_regenerate_id(true)</code> kaybeddel identifiant dyal session men ba3d connexion : kaymna3 fixation de session. Message d\'erreur ma kaywadde7ch wach email wla mot de passe li ghalt.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Message d\'erreur trop précis',
          'fr' => '« Cet email n\'existe pas » permet à un attaquant de découvrir quels comptes existent. Affichez toujours « Email ou mot de passe incorrect ». Le confort se paie en confidentialité.',
          'darija' => '« Had email ma kaynch » kaykhalli attaquant y3ref chkoun 3ndo compte. Dima 3red « Email ou mot de passe incorrect ». Confort kaytkellef b confidentialité.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'password_needs_rehash',
          'fr' => 'Si PHP change d\'algorithme par défaut, <code>password_needs_rehash($hash, PASSWORD_DEFAULT)</code> détecte les anciens hashs. À la connexion réussie, vous pouvez les recalculer silencieusement.',
          'darija' => 'Ila PHP beddel algorithme par défaut, <code>password_needs_rehash($hash, PASSWORD_DEFAULT)</code> kaykchef hashs qdam. F connexion njha, t9der t3awed t7sebhom bla ma t3mel 7ess.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'session-protection',
      'title' => 'Protéger les pages et se déconnecter',
      'icon' => '🛡️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une page réservée commence par <code>session_start()</code> puis vérifie la présence de <code>$_SESSION[\'user_id\']</code>. Si elle manque, on redirige vers la page de connexion. Ce contrôle doit être fait <strong>avant tout affichage</strong>.</p>',
          'darija' => '<p>Page m7miya katbda b <code>session_start()</code> men ba3d kat7eqqeq wach <code>$_SESSION[\'user_id\']</code> kayn. Ila ma kanch, kandir redirect l page dyal connexion. Had contrôle khas ytdar <strong>qbel ay affichage</strong>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Garde d\'authentification',
          'code' => '<?php
session_start();

if (empty($_SESSION[\'user_id\'])) {
    header(\'Location: login.php\');
    exit;
}

// Utilisateur connecté : on peut continuer
',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Déconnexion complète',
          'lang' => 'php',
          'code' => '<?php
session_start();

$_SESSION = [];

if (ini_get(\'session.use_cookies\')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        \'\',
        time() - 42000,
        $params[\'path\'],
        $params[\'domain\'],
        $params[\'secure\'],
        $params[\'httponly\']
    );
}

session_destroy();
header(\'Location: login.php\');
exit;
?>
',
          'explainFr' => 'Vider <code>$_SESSION</code>, supprimer le cookie de session puis appeler <code>session_destroy()</code> garantit une déconnexion réelle. Un simple <code>unset($_SESSION[\'user_id\'])</code> laisse d\'autres données derrière lui.',
          'explainDarija' => 'Tferregh <code>$_SESSION</code>, tmse7 cookie dyal session men ba3d t3ayet <code>session_destroy()</code> kaydmen déconnexion 7aqiqiya. <code>unset($_SESSION[\'user_id\'])</code> bo7do kaykhalli données okhrin.',
        ),
        3 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Règle',
            1 => 'Pourquoi',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'session_start() en premier',
              1 => 'évite « headers already sent »',
            ),
            1 => 
            array (
              0 => 'session_regenerate_id après connexion',
              1 => 'empêche la fixation de session',
            ),
            2 => 
            array (
              0 => 'HTTPS en production',
              1 => 'protège le cookie de session',
            ),
            3 => 
            array (
              0 => 'cookie HttpOnly et Secure',
              1 => 'limite le vol via JavaScript',
            ),
            4 => 
            array (
              0 => 'déconnexion qui détruit la session',
              1 => 'libère réellement l\'accès',
            ),
          ),
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Stocker le mot de passe en clair ou avec md5()',
      'fix' => 'password_hash($mdp, PASSWORD_DEFAULT) et password_verify().',
      'fr' => 'MD5 et le texte clair sont cassables en quelques secondes. L\'API password_* est conçue pour cela.',
      'darija' => 'MD5 w texte clair kaytqasro f tawani. API password_* msayba l had l5edma.',
    ),
    1 => 
    array (
      'wrong' => 'Comparer $motDePasse === $hash',
      'fix' => 'password_verify($motDePasse, $hash)',
      'fr' => 'Le hash contient le sel et les paramètres : seule password_verify sait le vérifier.',
      'darija' => 'Hash fih sel w paramètres : ghir password_verify kay3ref yt7eqqeq mno.',
    ),
    2 => 
    array (
      'wrong' => 'Afficher « email inconnu » à la connexion',
      'fix' => 'Message générique : « Email ou mot de passe incorrect ».',
      'fr' => 'Un message précis révèle quels comptes existent (énumération de comptes).',
      'darija' => 'Message dqiq kaychher chkoun 3ndo compte (énumération de comptes).',
    ),
    3 => 
    array (
      'wrong' => 'Vérifier la session après avoir affiché du HTML',
      'fix' => 'session_start() et le contrôle en tout début de fichier.',
      'fr' => 'Toute sortie avant header() provoque une erreur de redirection et peut fuiter du contenu protégé.',
      'darija' => 'Ay sortie qbel header() kat3ti erreur redirect w t9der tchher contenu m7mi.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'L\'<strong>authentification</strong> stocke un email unique et un mot de passe haché avec <code>password_hash()</code>. À la connexion, <code>password_verify()</code> compare, puis <code>session_regenerate_id(true)</code> sécurise la session et <code>$_SESSION[\'user_id\']</code> identifie l\'utilisateur. Les pages protégées vérifient la session avant tout affichage, et la déconnexion détruit réellement la session et son cookie.',
    'darija' => '<strong>Authentification</strong> katkhzen email unique w mot de passe haché b <code>password_hash()</code>. F connexion, <code>password_verify()</code> kayqaren, men ba3d <code>session_regenerate_id(true)</code> kay7mi session w <code>$_SESSION[\'user_id\']</code> kay3arref utilisateur. Pages m7miyin kayt7eqqo men session qbel ay affichage, w déconnexion kathdem session w cookie dyalha b 7aq.',
  ),
);
