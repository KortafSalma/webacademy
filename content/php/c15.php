<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c15.json
 */

return array (
  'id' => 'php-ch15',
  'title' => 'Sécurité PHP',
  'subtitle' => 'Protéger les données et les utilisateurs',
  'objectives' => 
  array (
    0 => 'Valider et filtrer les données entrantes.',
    1 => 'Éviter les injections SQL avec les requêtes préparées.',
    2 => 'Échapper les sorties contre le XSS.',
    3 => 'Protéger les formulaires avec un jeton CSRF.',
    4 => 'Hasher les mots de passe correctement.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'valider-entrees',
      'title' => 'Ne jamais faire confiance aux entrées',
      'icon' => '🚪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Toute donnée venant de l\'extérieur (<code>$_GET</code>, <code>$_POST</code>, <code>$_COOKIE</code>, fichiers, API) est <strong>non fiable</strong>. La règle d\'or : <strong>valider</strong> (bon format ?) puis <strong>nettoyer</strong> (bonne forme) avant utilisation.</p>',
          'darija' => '<p>Ay donnée li katji men bera (<code>$_GET</code>, <code>$_POST</code>, <code>$_COOKIE</code>, fichiers, API) <strong>ma kaynch tiqa biha</strong>. Qa3ida dhabiya : <strong>validi</strong> (format mzyan ?) men ba3d <strong>neqqi</strong> (forme mzyana) qbel ma tkhdem biha.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Filtrer un email et un âge',
          'lang' => 'php',
          'code' => '<?php
$email = filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);
$age   = filter_input(INPUT_GET, "age", FILTER_VALIDATE_INT);

echo $email ? "Email valide : " . $email : "Email invalide";
echo "<br>";
echo ($age !== false && $age !== null && $age >= 18) ? "Majeur" : "Âge invalide ou mineur";
?>',
          'explainFr' => '<code>filter_input()</code> renvoie la valeur validée ou <code>false</code>. On teste le résultat avant de l\'utiliser, au lieu de supposer que la donnée est correcte.',
          'explainDarija' => '<code>filter_input()</code> katrje3 valeur validée wla <code>false</code>. Kantestiw résultat qbel ma nkhdmo bih, blast ma nfeddo donnée s7i7a.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Filtre',
            1 => 'Usage',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'FILTER_VALIDATE_EMAIL',
              1 => 'adresse email',
            ),
            1 => 
            array (
              0 => 'FILTER_VALIDATE_INT',
              1 => 'entier (avec options min/max)',
            ),
            2 => 
            array (
              0 => 'FILTER_VALIDATE_URL',
              1 => 'URL complète',
            ),
            3 => 
            array (
              0 => 'FILTER_VALIDATE_BOOLEAN',
              1 => 'vrai/faux',
            ),
            4 => 
            array (
              0 => 'FILTER_SANITIZE_SPECIAL_CHARS',
              1 => 'échappe les caractères HTML',
            ),
          ),
          'fr' => 'Validez le format avec <code>FILTER_VALIDATE_*</code>. Pour afficher, échappez avec <code>htmlspecialchars()</code>.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'sql-injection',
      'title' => 'Injection SQL',
      'icon' => '💉',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>injection SQL</strong> se produit quand une saisie est collée directement dans une requête. Un visiteur peut alors lire, modifier ou supprimer toute la base. La solution : les <strong>requêtes préparées</strong> avec des paramètres.</p>',
          'darija' => '<p><strong>Injection SQL</strong> katwqa3 melli saisie katls9 nichan f requête. Visiteur y9der yqra, ybeddel wla ymse7 base kamla. L 7el : <strong>requêtes préparées</strong> b paramètres.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Mauvaise vs bonne pratique',
          'lang' => 'php',
          'code' => '<?php
// ❌ DANGEREUX : concaténation directe
// $sql = "SELECT * FROM users WHERE email = \'" . $_POST["email"] . "\'";

// ✅ Requête préparée
$pdo = new PDO("sqlite::memory:");
$pdo->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT)");
$pdo->exec("INSERT INTO users (email) VALUES (\'amal@site.ma\')");

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([":email" => "amal@site.ma"]);

foreach ($stmt as $row) {
    echo $row["email"];
}
?>',
          'output' => 'amal@site.ma',
          'explainFr' => 'Le paramètre <code>:email</code> est transmis séparément de la requête : la valeur ne peut jamais être interprétée comme du SQL. C\'est la protection fondamentale.',
          'explainDarija' => 'Paramètre <code>:email</code> kaytseft b wejjed 3la requête : valeur 3omrha ma t9der ttfhem b7al SQL. Hadi hiya protection asasiya.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Les guillemets ne suffisent pas',
          'fr' => 'Entourer la valeur de guillemets ou utiliser <code>addslashes()</code> ne protège pas correctement. Seules les requêtes préparées (PDO ou MySQLi) sont fiables.',
          'darija' => 'Tdowez valeur b guillemets wla <code>addslashes()</code> ma kay7mich mzyan. Ghir requêtes préparées (PDO wla MySQLi) homa li mwatheqin.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'xss-csrf',
      'title' => 'XSS et CSRF',
      'icon' => '🛡️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>XSS</strong> : injecter du JavaScript dans une page via une saisie affichée sans échappement. <strong>CSRF</strong> : forcer un utilisateur connecté à envoyer une action non voulue (suppression, virement) depuis un autre site.</p>',
          'darija' => '<p><strong>XSS</strong> : tdkhel JavaScript f page 3ber saisie kat3red bla échappement. <strong>CSRF</strong> : tforci utilisateur connecté yseft action ma bghahach (suppression, virement) men site akhor.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Échapper la sortie et vérifier le jeton CSRF',
          'lang' => 'php',
          'code' => '<?php
session_start();

// Jeton CSRF stocké en session
if (empty($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(32));
}

// Vérification à la soumission
$recu = $_POST["csrf"] ?? "";
if (!hash_equals($_SESSION["csrf"], $recu)) {
    exit("Jeton CSRF invalide");
}

$commentaire = $_POST["commentaire"] ?? "";
echo htmlspecialchars($commentaire, ENT_QUOTES, "UTF-8");
?>',
          'explainFr' => '<code>hash_equals()</code> compare les jetons en temps constant. <code>htmlspecialchars()</code> neutralise les balises avant affichage : le texte s\'affiche, le script ne s\'exécute pas.',
          'explainDarija' => '<code>hash_equals()</code> katqaren jetons b temps constant. <code>htmlspecialchars()</code> kat3etel balises qbel affichage : texte kayban, script ma kaynffedch.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Échapper à la sortie, pas à l\'entrée',
          'fr' => 'Stockez la donnée brute en base, et échappez au moment de l\'affichage HTML. Sinon vous doublez les échappements et vous abîmez les données.',
          'darija' => 'Khzen donnée brute f base, w 3mel échappement wa9t affichage HTML. Sinon ghadi t3awed échappement jouj merrat w tkhesr données.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'mots-de-passe',
      'title' => 'Mots de passe et bonnes pratiques',
      'icon' => '🔑',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un mot de passe ne se stocke <strong>jamais en clair</strong>. On utilise <code>password_hash()</code> (algorithme bcrypt/argon2) et on vérifie avec <code>password_verify()</code>. PHP gère le sel et les paramètres automatiquement.</p>',
          'darija' => '<p>Mot de passe <strong>3omrek ma tkhzno clair</strong>. Kankhdmo b <code>password_hash()</code> (bcrypt/argon2) w kant7eqqo b <code>password_verify()</code>. PHP kayt7ekkem f sel w paramètres automatiquement.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Hasher et vérifier',
          'lang' => 'php',
          'code' => '<?php
$motDePasse = "Secret123!";
$hash = password_hash($motDePasse, PASSWORD_DEFAULT);

echo "Hash stocké en base :<br>" . $hash . "<br><br>";
echo password_verify("Secret123!", $hash) ? "Mot de passe correct" : "Mot de passe incorrect";
?>',
          'explainFr' => '<code>password_hash()</code> produit une empreinte différente à chaque appel (sel aléatoire). <code>password_verify()</code> compare sans jamais déchiffrer : c\'est irréversible par conception.',
          'explainDarija' => '<code>password_hash()</code> kat3ti empreinte mokhtalfa f kol appel (sel aléatoire). <code>password_verify()</code> katqaren bla ma tfek hash : irréversible b design.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Menace',
            1 => 'Protection',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Injection SQL',
              1 => 'requêtes préparées PDO',
            ),
            1 => 
            array (
              0 => 'XSS',
              1 => 'htmlspecialchars à l\'affichage',
            ),
            2 => 
            array (
              0 => 'CSRF',
              1 => 'jeton en session + hash_equals',
            ),
            3 => 
            array (
              0 => 'Vol de mot de passe',
              1 => 'password_hash / password_verify',
            ),
            4 => 
            array (
              0 => 'Traversée de chemin',
              1 => 'basename + liste blanche',
            ),
            5 => 
            array (
              0 => 'Écoute réseau',
              1 => 'HTTPS obligatoire',
            ),
          ),
          'fr' => 'Ces six protections couvrent la grande majorité des failles des applications PHP débutantes.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => '$sql = "SELECT * FROM users WHERE id = " . $_GET["id"];',
      'fix' => '$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id"); $stmt->execute(["id" => $_GET["id"]]);',
      'fr' => 'La concaténation directe ouvre la porte à l\'injection SQL. Utilisez toujours des paramètres liés.',
      'darija' => 'Concaténation directe kat7el bab l injection SQL. Dima khdem b paramètres liés.',
    ),
    1 => 
    array (
      'wrong' => 'echo $_POST["commentaire"];',
      'fix' => 'echo htmlspecialchars($_POST["commentaire"], ENT_QUOTES, "UTF-8");',
      'fr' => 'Afficher une saisie brute permet l\'exécution de scripts (XSS). Échappez toute sortie d\'origine utilisateur.',
      'darija' => 'T3red saisie brute kaykhalli scripts ytfeddo (XSS). 3mel échappement l kol sortie men utilisateur.',
    ),
    2 => 
    array (
      'wrong' => 'Stockage du mot de passe avec md5($mdp)',
      'fix' => 'password_hash($mdp, PASSWORD_DEFAULT) puis password_verify().',
      'fr' => 'MD5 est rapide et cassable : inadapté aux mots de passe. Utilisez l\'API password_* de PHP.',
      'darija' => 'MD5 sri3 w kaytqas : ma ymkench l mots de passe. Khdem b API password_* dyal PHP.',
    ),
    3 => 
    array (
      'wrong' => 'Formulaire sans jeton CSRF',
      'fix' => 'Générer un jeton en session et le vérifier à chaque POST.',
      'fr' => 'Sans jeton, un site malveillant peut soumettre le formulaire à la place de l\'utilisateur connecté.',
      'darija' => 'Bla jeton, site khayb y9der yseft formulaire bla 3ilm dyal utilisateur connecté.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'La sécurité repose sur des réflexes simples : <strong>valider</strong> les entrées, <strong>préparer</strong> les requêtes SQL, <strong>échapper</strong> les sorties HTML, <strong>vérifier un jeton CSRF</strong>, <strong>hasher</strong> les mots de passe et servir le site en <strong>HTTPS</strong>. Ne faites jamais confiance à une donnée venue du navigateur.',
    'darija' => 'Sécurité katbna 3la réflexes sahlin : <strong>validi</strong> entrées, <strong>prépari</strong> requêtes SQL, <strong>échappi</strong> sorties HTML, <strong>t7eqqeq men jeton CSRF</strong>, <strong>hashi</strong> mots de passe w khdem site b <strong>HTTPS</strong>. 3omrek ma t3ti tiqa l donnée li jat men navigateur.',
  ),
);
