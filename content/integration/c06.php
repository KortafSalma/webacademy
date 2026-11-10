<?php

declare(strict_types=1);

/**
 * Contenu généré depuis integration-c06.json
 */

return array (
  'id' => 'integration-ch6',
  'title' => 'Sécurité applicative',
  'subtitle' => 'Défendre l\'application sur tous les fronts',
  'objectives' => 
  array (
    0 => 'Valider chaque entrée avec filter_input.',
    1 => 'Échapper chaque sortie avec htmlspecialchars.',
    2 => 'Protéger les formulaires avec un jeton CSRF.',
    3 => 'Configurer les cookies et les en-têtes de sécurité.',
    4 => 'Appliquer le principe du moindre privilège.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'entrees',
      'title' => 'Valider les entrées',
      'icon' => '🚪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les données qui viennent du navigateur sont <strong>hostiles par défaut</strong>. On distingue deux actions : <strong>valider</strong> (le format est-il correct ?) et <strong>nettoyer</strong> (mettre sous une forme sûre). La validation doit se faire côté serveur, même si le formulaire a déjà des contrôles HTML.</p>',
          'darija' => '<p>Données li katji men navigateur <strong>hostiles b défaut</strong>. Kanfre9o jouj actions : <strong>valider</strong> (format s7i7 ?) w <strong>nettoyer</strong> (7et f forme amna). Validation khas tdar f serveur, 7ta ila formulaire 3ndo contrôles HTML.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Filtrer avec filter_input',
          'lang' => 'php',
          'code' => '<?php
$email = filter_input(INPUT_POST, \'email\', FILTER_VALIDATE_EMAIL);
$age = filter_input(INPUT_POST, \'age\', FILTER_VALIDATE_INT, [
    \'options\' => [\'min_range\' => 16, \'max_range\' => 99],
]);
$site = filter_input(INPUT_POST, \'site\', FILTER_VALIDATE_URL);

if ($email === false || $email === null) {
    exit(\'Email invalide\');
}
if ($age === false) {
    exit(\'Âge invalide (16 à 99)\');
}
?>
',
          'explainFr' => '<code>filter_input()</code> renvoie la valeur validée, <code>false</code> si le format est mauvais, <code>null</code> si le champ est absent. Les options <code>min_range</code> et <code>max_range</code> bornent l\'entier.',
          'explainDarija' => '<code>filter_input()</code> katrje3 valeur validée, <code>false</code> ila format ghalt, <code>null</code> ila champ ma kanch. Options <code>min_range</code> w <code>max_range</code> kay7eddo entier.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Filtre',
            1 => 'Accepte',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'FILTER_VALIDATE_EMAIL',
              1 => 'une adresse email valide',
            ),
            1 => 
            array (
              0 => 'FILTER_VALIDATE_INT',
              1 => 'un entier (avec min/max)',
            ),
            2 => 
            array (
              0 => 'FILTER_VALIDATE_FLOAT',
              1 => 'un nombre décimal',
            ),
            3 => 
            array (
              0 => 'FILTER_VALIDATE_URL',
              1 => 'une URL complète',
            ),
            4 => 
            array (
              0 => 'FILTER_VALIDATE_BOOLEAN',
              1 => 'true/false, 1/0, on/off',
            ),
            5 => 
            array (
              0 => 'FILTER_VALIDATE_REGEXP',
              1 => 'un motif personnalisé',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Ne jamais compter sur le HTML',
          'fr' => '<code>required</code>, <code>type="email"</code> et <code>maxlength</code> améliorent le confort, mais un attaquant envoie ce qu\'il veut avec curl. La seule validation qui compte est celle du serveur.',
          'darija' => '<code>required</code>, <code>type="email"</code> w <code>maxlength</code> kay7sno confort, walakin attaquant kaysift li bgha b curl. Validation li kat7seb hiya dyal serveur.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'xss-csrf',
      'title' => 'XSS et CSRF',
      'icon' => '🧱',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>XSS</strong> : du HTML ou du JavaScript injecté s\'exécute chez les visiteurs. <strong>CSRF</strong> : un site tiers fait envoyer une requête à votre application avec la session de l\'utilisateur connecté. Deux menaces différentes, deux protections différentes.</p>',
          'darija' => '<p><strong>XSS</strong> : HTML wla JavaScript mdakhel kaytnffed 3nd visiteurs. <strong>CSRF</strong> : site akhor kaykhalli requête twsel l application dyalek b session dyal utilisateur connecté. Jouj menaces mokhtalfin, jouj protections mokhtalfin.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Échapper toute sortie',
          'lang' => 'php',
          'code' => '<?php
$commentaire = $_POST[\'commentaire\'] ?? \'\';

// Stockage brut en base (la donnée reste intacte)
$stmt = $pdo->prepare(\'INSERT INTO commentaire (texte) VALUES (:texte)\');
$stmt->execute([\':texte\' => $commentaire]);

// Échappement au moment de l\'affichage
$affichage = htmlspecialchars($commentaire, ENT_QUOTES | ENT_SUBSTITUTE, \'UTF-8\');
echo \'<p>\' . $affichage . \'</p>\';
?>
',
          'explainFr' => 'On échappe à la <strong>sortie</strong>, pas à l\'entrée : la base conserve le texte réel, et le navigateur ne l\'interprète jamais comme du code. <code>ENT_QUOTES</code> couvre les guillemets simples et doubles.',
          'explainDarija' => 'Kan3mlo échappement f <strong>sortie</strong>, machi f entrée : base kat7fed texte 7aqiqi, w navigateur 3omro ma kaytfhmo b7al code. <code>ENT_QUOTES</code> kayghatti guillemets simple w double.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Jeton CSRF en trois étapes',
          'lang' => 'php',
          'code' => '<?php
session_start();

// 1. Générer le jeton une fois
if (empty($_SESSION[\'csrf\'])) {
    $_SESSION[\'csrf\'] = bin2hex(random_bytes(32));
}

// 2. L\'insérer dans chaque formulaire
// <input type="hidden" name="csrf" value="<?= $_SESSION[\'csrf\'] ?>">

// 3. Vérifier à la soumission
if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {
    $recu = $_POST[\'csrf\'] ?? \'\';
    if (!hash_equals($_SESSION[\'csrf\'], $recu)) {
        http_response_code(403);
        exit(\'Jeton CSRF invalide\');
    }
}
?>
',
          'explainFr' => '<code>random_bytes(32)</code> produit un jeton imprévisible. <code>hash_equals()</code> évite les attaques temporelles. Le jeton est propre à la session : un site tiers ne peut pas le connaître.',
          'explainDarija' => '<code>random_bytes(32)</code> kay3ti jeton ma ytweqqe3ch. <code>hash_equals()</code> kaymna3 attaques temporelles. Jeton kaykhas session : site akhor ma y9derch y3refo.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Le CSRF ne concerne pas que les formulaires',
          'fr' => 'Toute action qui modifie des données doit être protégée : suppression, changement de mot de passe, ajout au panier. Un simple lien GET sur une action sensible est une faille CSRF.',
          'darija' => 'Kol action li katbeddel données khas tkon m7miya : suppression, changement dyal mot de passe, ajout f panier. Lien GET 3adi 3la action 7assasa howa faille CSRF.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'configuration',
      'title' => 'Configuration et moindre privilège',
      'icon' => '🔐',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La sécurité se joue aussi dans la configuration : cookies <code>HttpOnly</code> et <code>Secure</code>, HTTPS, en-têtes de sécurité, erreurs masquées en production, et un utilisateur de base de données aux droits limités.</p>',
          'darija' => '<p>Sécurité katt7ekkem 7ta f configuration : cookies <code>HttpOnly</code> w <code>Secure</code>, HTTPS, en-têtes dyal sécurité, erreurs mkhebyin f production, w utilisateur dyal base b droits m7dodin.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Cookies de session sécurisés',
          'code' => 'session_set_cookie_params([
    \'lifetime\' => 0,
    \'path\' => \'/\',
    \'secure\' => true,     // HTTPS uniquement
    \'httponly\' => true,   // inaccessible en JavaScript
    \'samesite\' => \'Lax\',  // limite le CSRF
]);
session_start();',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Mesure',
            1 => 'Protège contre',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'HttpOnly',
              1 => 'vol de cookie par JavaScript (XSS)',
            ),
            1 => 
            array (
              0 => 'Secure',
              1 => 'interception du cookie en HTTP',
            ),
            2 => 
            array (
              0 => 'SameSite=Lax/Strict',
              1 => 'une partie des attaques CSRF',
            ),
            3 => 
            array (
              0 => 'Content-Security-Policy',
              1 => 'exécution de scripts injectés',
            ),
            4 => 
            array (
              0 => 'display_errors = Off',
              1 => 'fuite de chemins et de requêtes',
            ),
            5 => 
            array (
              0 => 'utilisateur SQL limité',
              1 => 'destruction de la base si compromis',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'En-têtes de sécurité',
          'lang' => 'php',
          'code' => '<?php
header(\'X-Content-Type-Options: nosniff\');
header(\'X-Frame-Options: DENY\');
header(\'Referrer-Policy: strict-origin-when-cross-origin\');
header("Content-Security-Policy: default-src \'self\'; img-src \'self\' https: data:");
?>
',
          'explainFr' => '<code>X-Frame-Options: DENY</code> empêche l\'intégration de votre site dans une iframe (clickjacking). La CSP limite les sources de scripts et d\'images autorisées.',
          'explainDarija' => '<code>X-Frame-Options: DENY</code> kaymna3 site dyalek ydkhel f iframe (clickjacking). CSP kay7ded sources dyal scripts w images li mesmou7in.',
        ),
        4 => 
        array (
          'type' => 'tip',
          'title' => 'Les secrets hors du code',
          'fr' => 'Mot de passe de base, clé API, secret de session : jamais dans un fichier versionné sur Git. Utilisez des variables d\'environnement ou un fichier <code>.env</code> ignoré, avec des droits restreints.',
          'darija' => 'Mot de passe dyal base, clé API, secret dyal session : 3omrek f fichier mversionné f Git. Khdem b variables d\'environnement wla fichier <code>.env</code> mjahl, b droits m7dodin.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'echo $_GET[\'nom\']',
      'fix' => 'echo htmlspecialchars($_GET[\'nom\'], ENT_QUOTES, \'UTF-8\')',
      'fr' => 'Afficher une entrée brute permet l\'exécution de scripts (XSS stocké ou réfléchi).',
      'darija' => 'T3red entrée brute kaykhalli scripts ytfeddo (XSS stocké wla réfléchi).',
    ),
    1 => 
    array (
      'wrong' => 'Formulaire sensible sans jeton CSRF',
      'fix' => 'Générer un jeton en session et le vérifier avec hash_equals.',
      'fr' => 'Sans jeton, un site tiers peut soumettre le formulaire à la place de l\'utilisateur connecté.',
      'darija' => 'Bla jeton, site akhor y9der yseft formulaire blast utilisateur connecté.',
    ),
    2 => 
    array (
      'wrong' => 'Afficher les erreurs PHP et SQL en production',
      'fix' => 'display_errors = Off, log_errors = On, message générique pour l\'utilisateur.',
      'fr' => 'Les traces révèlent les chemins, les requêtes et parfois des données sensibles.',
      'darija' => 'Traces kaychhero chemins, requêtes w merrat données sensibles.',
    ),
    3 => 
    array (
      'wrong' => 'Se connecter à MySQL avec root en production',
      'fix' => 'Créer un utilisateur dédié avec seulement SELECT, INSERT, UPDATE, DELETE sur la base concernée.',
      'fr' => 'Le moindre privilège limite les dégâts si l\'application est compromise.',
      'darija' => 'Moindre privilège kay7ded adrar ila application tkharkat.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'La <strong>sécurité applicative</strong> combine : validation serveur avec <code>filter_input</code>, échappement des sorties avec <code>htmlspecialchars</code>, jeton <strong>CSRF</strong> sur toute action sensible, cookies <code>HttpOnly/Secure/SameSite</code>, HTTPS, en-têtes de sécurité, erreurs masquées et un utilisateur de base aux droits minimaux. Les secrets restent hors du code versionné.',
    'darija' => '<strong>Sécurité applicative</strong> katjem3 : validation f serveur b <code>filter_input</code>, échappement dyal sorties b <code>htmlspecialchars</code>, jeton <strong>CSRF</strong> 3la kol action 7assasa, cookies <code>HttpOnly/Secure/SameSite</code>, HTTPS, en-têtes dyal sécurité, erreurs mkhebyin w utilisateur dyal base b droits minimaux. Secrets kaybqaw bera code mversionné.',
  ),
);
