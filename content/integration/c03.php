<?php

declare(strict_types=1);

/**
 * Contenu généré depuis integration-c03.json
 */

return array (
  'id' => 'integration-ch3',
  'title' => 'Requêtes préparées',
  'subtitle' => 'Interroger la base sans jamais concaténer une saisie',
  'objectives' => 
  array (
    0 => 'Comprendre pourquoi la concaténation SQL est dangereuse.',
    1 => 'Préparer une requête avec PDO::prepare et l\'exécuter.',
    2 => 'Utiliser les paramètres nommés et positionnels.',
    3 => 'Lier des valeurs avec bindValue et le bon type.',
    4 => 'Gérer les erreurs et les cas dynamiques (IN, tri).',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'pourquoi-preparer',
      'title' => 'Le problème de la concaténation',
      'icon' => '💉',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Quand on colle une saisie utilisateur directement dans une requête, l\'utilisateur peut <strong>changer la structure de la requête</strong>. C\'est l\'<strong>injection SQL</strong> : lecture de données confidentielles, modification ou suppression de tables.</p>',
          'darija' => '<p>Melli kanls9o saisie dyal utilisateur nichan f requête, utilisateur y9der <strong>ybeddel structure dyal requête</strong>. Hadi hiya <strong>injection SQL</strong> : qraya dyal données confidentielles, modification wla suppression dyal tables.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Une faille classique',
          'lang' => 'php',
          'code' => '<?php
// ❌ Ne jamais faire ça
$email = $_GET[\'email\'] ?? \'\';
$sql = "SELECT * FROM utilisateur WHERE email = \'$email\'";

// Si l\'utilisateur envoie : \' OR \'1\'=\'1
// la requête devient :
// SELECT * FROM utilisateur WHERE email = \'\' OR \'1\'=\'1\'
// → toutes les lignes sont renvoyées.
?>
',
          'explainFr' => 'La valeur <code>\' OR \'1\'=\'1</code> ferme la chaîne et ajoute une condition toujours vraie. La base ne peut pas distinguer la donnée du code SQL.',
          'explainDarija' => 'Valeur <code>\' OR \'1\'=\'1</code> katsedd chaîne w katzid condition dima vraie. Base ma tqderch tfre9 bin donnée w code SQL.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Échapper ne suffit pas',
          'fr' => '<code>addslashes()</code>, <code>mysqli_real_escape_string()</code> ou des guillemets ajoutés à la main ne couvrent pas tous les cas (encodages, requêtes dynamiques). La seule protection fiable est la <strong>requête préparée</strong>.',
          'darija' => '<code>addslashes()</code>, <code>mysqli_real_escape_string()</code> wla guillemets b yed ma kayghattiwch kol cas (encodages, requêtes dynamiques). Protection mwatheqa hiya <strong>requête préparée</strong>.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'prepare-execute',
      'title' => 'prepare et execute',
      'icon' => '⚙️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Avec une requête préparée, le serveur reçoit d\'abord le <strong>modèle</strong> de la requête, puis les <strong>valeurs séparément</strong>. Une valeur ne peut donc jamais être interprétée comme du SQL, même si elle contient des guillemets.</p>',
          'darija' => '<p>B requête préparée, serveur kayakhod lwel <strong>modèle</strong> dyal requête, men ba3d <strong>valeurs b wejjed</strong>. Valeur 3omrha ma t9der ttfhem b7al SQL, 7ta ila fiha guillemets.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Paramètres nommés',
          'code' => '$stmt = $pdo->prepare(
    \'SELECT * FROM utilisateur WHERE email = :email\'
);
$stmt->execute([\':email\' => $email]);
$utilisateur = $stmt->fetch();',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Paramètres positionnels',
          'code' => '$stmt = $pdo->prepare(
    \'SELECT * FROM note WHERE etudiant_id = ? AND valeur >= ?\'
);
$stmt->execute([$etudiantId, $seuil]);
$notes = $stmt->fetchAll();',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Rechercher un étudiant par email',
          'lang' => 'php',
          'code' => '<?php
$pdo = new PDO(\'sqlite::memory:\');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec(\'CREATE TABLE utilisateur (id INTEGER PRIMARY KEY, email TEXT, nom TEXT)\');
$pdo->exec("INSERT INTO utilisateur (email, nom) VALUES (\'amal@site.ma\', \'Amal\'), (\'omar@site.ma\', \'Omar\')");

$email = \'amal@site.ma\';
$stmt = $pdo->prepare(\'SELECT id, nom FROM utilisateur WHERE email = :email\');
$stmt->execute([\':email\' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo $user ? $user[\'nom\'] : \'Introuvable\';
?>
',
          'output' => 'Amal',
          'explainFr' => 'Le paramètre <code>:email</code> est transmis à part. Même une valeur piégée comme <code>\' OR \'1\'=\'1</code> serait traitée comme un simple texte à comparer, et ne renverrait rien.',
          'explainDarija' => 'Paramètre <code>:email</code> kaytseft b wejjed. 7ta valeur piégée b7al <code>\' OR \'1\'=\'1</code> ghadi tt3amel b7al texte 3adi l comparaison, w ma ghadi trje3 walou.',
        ),
        4 => 
        array (
          'type' => 'tip',
          'title' => 'Préparer une seule fois, exécuter plusieurs fois',
          'fr' => 'Une requête préparée peut être réexécutée avec des valeurs différentes : idéal pour un import en boucle. Le serveur réutilise le plan d\'exécution.',
          'darija' => 'Requête préparée t9der tt3awed t exécuter b valeurs mokhtalfa : mzyana l import f boucle. Serveur kay3awed ysta3mel plan d\'exécution.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'bind-securite',
      'title' => 'bindValue et cas particuliers',
      'icon' => '🔒',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>bindValue()</code> associe une valeur à un paramètre en précisant son type (<code>PDO::PARAM_INT</code>, <code>PDO::PARAM_STR</code>, <code>PDO::PARAM_NULL</code>, <code>PDO::PARAM_BOOL</code>). Utile pour les limites <code>LIMIT</code> et les colonnes de tri, où certains moteurs refusent une chaîne.</p>',
          'darija' => '<p><code>bindValue()</code> katrbet valeur b paramètre w kat7edded type dyalha (<code>PDO::PARAM_INT</code>, <code>PDO::PARAM_STR</code>, <code>PDO::PARAM_NULL</code>, <code>PDO::PARAM_BOOL</code>). Mzyana l <code>LIMIT</code> w colonnes dyal tri, fin chi moteurs kayrefuso chaîne.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Pagination avec bindValue',
          'lang' => 'php',
          'code' => '<?php
$page = max(1, (int) ($_GET[\'page\'] ?? 1));
$parPage = 10;
$offset = ($page - 1) * $parPage;

$stmt = $pdo->prepare(
    \'SELECT id, nom FROM etudiant ORDER BY nom LIMIT :limit OFFSET :offset\'
);
$stmt->bindValue(\':limit\', $parPage, PDO::PARAM_INT);
$stmt->bindValue(\':offset\', $offset, PDO::PARAM_INT);
$stmt->execute();

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
',
          'explainFr' => 'Les valeurs sont converties en entiers avant d\'être liées : <code>LIMIT</code> et <code>OFFSET</code> reçoivent bien des nombres, et le cast <code>(int)</code> neutralise toute tentative d\'injection dans la pagination.',
          'explainDarija' => 'Valeurs kayt7ewlo l entiers qbel ma ytrbto : <code>LIMIT</code> w <code>OFFSET</code> kayakhdo ar9am, w cast <code>(int)</code> kay3etel ay tentative d\'injection f pagination.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'On ne prépare pas un nom de colonne',
          'fr' => 'Les paramètres remplacent des <strong>valeurs</strong>, jamais des identifiants SQL (table, colonne, direction de tri). Pour un tri dynamique, comparez la valeur reçue à une <strong>liste blanche</strong> : <code>[\'nom\', \'note\']</code>.',
          'darija' => 'Paramètres kay3awdo <strong>valeurs</strong>, 3omrek ma kay3awdo identifiants SQL (table, colonne, direction dyal tri). L tri dynamique, qaren valeur li wselt m3a <strong>liste blanche</strong> : <code>[\'nom\', \'note\']</code>.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Tri dynamique sécurisé par liste blanche',
          'lang' => 'php',
          'code' => '<?php
$colonnes = [\'nom\', \'prenom\', \'filiere\'];
$directions = [\'ASC\', \'DESC\'];

$colonne = in_array($_GET[\'tri\'] ?? \'\', $colonnes, true) ? $_GET[\'tri\'] : \'nom\';
$direction = in_array(strtoupper($_GET[\'ordre\'] ?? \'\'), $directions, true)
    ? strtoupper($_GET[\'ordre\'])
    : \'ASC\';

$sql = "SELECT nom, prenom, filiere FROM etudiant ORDER BY $colonne $direction";
$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
',
          'explainFr' => 'La valeur reçue n\'est jamais utilisée telle quelle : elle doit appartenir à une liste fermée. C\'est le seul endroit où l\'on injecte du texte dans la requête, et il est totalement contrôlé.',
          'explainDarija' => 'Valeur li wselt 3omrha ma katsta3mel kif ma jat : khas tkon f lista mghlqa. Hadi blasa wa7da fin kandekhlo texte f requête, w hiya m7ekma 100%.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => '$pdo->query("SELECT * FROM user WHERE email = \'$_POST[email]\'")',
      'fix' => '$stmt = $pdo->prepare(\'SELECT * FROM user WHERE email = :email\'); $stmt->execute([\':email\' => $_POST[\'email\']]);',
      'fr' => 'La concaténation directe ouvre la porte à l\'injection SQL. Toute valeur dynamique passe par un paramètre.',
      'darija' => 'Concaténation directe kat7el bab l injection SQL. Kol valeur dynamique khas tdowez b paramètre.',
    ),
    1 => 
    array (
      'wrong' => 'Mettre LIMIT :limit sans bindValue de type INT',
      'fix' => '$stmt->bindValue(\':limit\', $n, PDO::PARAM_INT);',
      'fr' => 'Avec ERRMODE_EXCEPTION, certains pilotes refusent un paramètre de type chaîne pour LIMIT.',
      'darija' => 'B ERRMODE_EXCEPTION, chi pilotes kayrefuso paramètre texte l LIMIT.',
    ),
    2 => 
    array (
      'wrong' => 'Utiliser un paramètre pour le nom d\'une colonne',
      'fix' => 'Valider la colonne contre une liste blanche, puis l\'insérer dans le SQL.',
      'fr' => 'Un paramètre ne peut pas remplacer un identifiant : la base doit connaître la colonne à la préparation.',
      'darija' => 'Paramètre ma y9derch y3awed identifiant : base khas t3ref colonne f wa9t préparation.',
    ),
    3 => 
    array (
      'wrong' => 'Afficher $e->getMessage() en production',
      'fix' => 'Journaliser l\'erreur et afficher un message générique.',
      'fr' => 'Le message PDO peut révéler la requête, la table ou la structure de la base.',
      'darija' => 'Message PDO y9der ychher requête, table wla structure dyal base.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une <strong>requête préparée</strong> sépare le modèle SQL des valeurs : la base ne peut pas confondre une donnée avec du code. On utilise <code>prepare()</code> puis <code>execute()</code> avec des paramètres nommés ou positionnels, et <code>bindValue()</code> pour préciser les types. Les identifiants (colonne, tri) passent par une <strong>liste blanche</strong>, jamais par un paramètre.',
    'darija' => '<strong>Requête préparée</strong> katfre9 modèle SQL men valeurs : base ma tqderch tkhelt donnée m3a code. Kankhdmo b <code>prepare()</code> men ba3d <code>execute()</code> b paramètres nommés wla positionnels, w <code>bindValue()</code> bach n7eddo types. Identifiants (colonne, tri) kaydowzo b <strong>liste blanche</strong>, 3omrek b paramètre.',
  ),
);
