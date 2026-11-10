<?php

declare(strict_types=1);

/**
 * Contenu généré depuis integration-c04.json
 */

return array (
  'id' => 'integration-ch4',
  'title' => 'CRUD complet',
  'subtitle' => 'Créer, lire, modifier et supprimer des données avec PDO',
  'objectives' => 
  array (
    0 => 'Construire un formulaire d\'ajout relié à INSERT.',
    1 => 'Lister et détailler des enregistrements avec SELECT.',
    2 => 'Modifier une ligne existante avec UPDATE.',
    3 => 'Supprimer avec confirmation et protection CSRF.',
    4 => 'Organiser le code en fonctions réutilisables.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'create',
      'title' => 'Create — ajouter',
      'icon' => '➕',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>CRUD</strong> signifie Create, Read, Update, Delete : les quatre opérations de base sur les données. Pour créer, on affiche un formulaire, on vérifie les données reçues, puis on exécute un <code>INSERT</code> préparé.</p>',
          'darija' => '<p><strong>CRUD</strong> ma3nah Create, Read, Update, Delete : rba3 opérations asasiyin 3la données. Bach t5leq, kat3red formulaire, kat7eqqeq données li wslat, men ba3d kattnffed <code>INSERT</code> préparé.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Formulaire et INSERT',
          'lang' => 'php',
          'code' => '<?php
$erreurs = [];

if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {
    $nom = trim($_POST[\'nom\'] ?? \'\');
    $email = trim($_POST[\'email\'] ?? \'\');

    if ($nom === \'\') {
        $erreurs[] = \'Le nom est obligatoire.\';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = \'Email invalide.\';
    }

    if (!$erreurs) {
        $stmt = $pdo->prepare(
            \'INSERT INTO etudiant (nom, email) VALUES (:nom, :email)\'
        );
        $stmt->execute([\':nom\' => $nom, \':email\' => $email]);
        header(\'Location: liste.php\');
        exit;
    }
}
?>
<form method="post">
    <input name="nom" value="<?= htmlspecialchars($_POST[\'nom\'] ?? \'\') ?>">
    <input name="email" value="<?= htmlspecialchars($_POST[\'email\'] ?? \'\') ?>">
    <button type="submit">Ajouter</button>
</form>
',
          'explainFr' => 'On valide avant d\'écrire, on prépare l\'<code>INSERT</code>, puis on redirige avec <code>header()</code> suivi de <code>exit</code> : cela évite qu\'un rechargement ne recrée la ligne.',
          'explainDarija' => 'Kanvaldiw qbel ma nkteb, kanprépriw <code>INSERT</code>, men ba3d kandir redirect b <code>header()</code> w <code>exit</code> : hakka rechargement ma kay3awedch y5leq ligne.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Récupérer l\'identifiant créé',
          'fr' => '<code>$pdo-&gt;lastInsertId()</code> renvoie l\'identifiant auto-incrémenté de la dernière insertion. Pratique pour rediriger vers la fiche créée.',
          'darija' => '<code>$pdo-&gt;lastInsertId()</code> katrje3 identifiant auto-incrémenté dyal akhir insertion. Mzyana bach tredirecti l fiche li tsaybat.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'read',
      'title' => 'Read — lire et afficher',
      'icon' => '📖',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La lecture couvre trois besoins : la <strong>liste</strong> (plusieurs lignes), le <strong>détail</strong> (une ligne par son id) et la <strong>recherche</strong> (filtre). On utilise <code>fetchAll()</code> pour une liste et <code>fetch()</code> pour une ligne unique.</p>',
          'darija' => '<p>Qraya katghatti tlata besoins : <strong>liste</strong> (bzaf lignes), <strong>détail</strong> (ligne wa7da b id dyalha) w <strong>recherche</strong> (filtre). Kankhdmo b <code>fetchAll()</code> l liste w <code>fetch()</code> l ligne wa7da.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Liste avec recherche',
          'lang' => 'php',
          'code' => '<?php
$recherche = trim($_GET[\'q\'] ?? \'\');

if ($recherche !== \'\') {
    $stmt = $pdo->prepare(
        \'SELECT id, nom, email FROM etudiant WHERE nom LIKE :q ORDER BY nom\'
    );
    $stmt->execute([\':q\' => \'%\' . $recherche . \'%\']);
} else {
    $stmt = $pdo->query(\'SELECT id, nom, email FROM etudiant ORDER BY nom\');
}

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($etudiants as $e): ?>
    <li>
        <a href="detail.php?id=<?= (int) $e[\'id\'] ?>">
            <?= htmlspecialchars($e[\'nom\']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
',
          'explainFr' => 'Le <code>%</code> est ajouté à la valeur, pas dans la requête : le paramètre reste une donnée. <code>htmlspecialchars()</code> protège l\'affichage contre le XSS.',
          'explainDarija' => '<code>%</code> kaytzad l valeur, machi f requête : paramètre kaybqa donnée. <code>htmlspecialchars()</code> kay7mi affichage men XSS.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Détail d\'une ligne',
          'lang' => 'php',
          'code' => '<?php
$id = filter_input(INPUT_GET, \'id\', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(404);
    exit(\'Étudiant introuvable\');
}

$stmt = $pdo->prepare(\'SELECT * FROM etudiant WHERE id = :id\');
$stmt->execute([\':id\' => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    http_response_code(404);
    exit(\'Étudiant introuvable\');
}

echo htmlspecialchars($etudiant[\'nom\']);
?>
',
          'explainFr' => 'L\'identifiant est validé comme entier avant la requête, et l\'absence de résultat renvoie un vrai code 404 plutôt qu\'une page vide.',
          'explainDarija' => 'Identifiant kaytvalida b7al entier qbel requête, w ila ma kanch résultat kayrje3 code 404 7aqiqi blast page khawya.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'update-delete',
      'title' => 'Update et Delete',
      'icon' => '♻️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>Update</strong> recharge la ligne, affiche le formulaire pré-rempli, puis exécute <code>UPDATE ... WHERE id = :id</code>. <strong>Delete</strong> ne doit jamais être un simple lien GET : une suppression se fait en <code>POST</code>, avec confirmation et jeton CSRF.</p>',
          'darija' => '<p><strong>Update</strong> kay3awed ychargi ligne, kay3red formulaire m3emmer, men ba3d kaynffed <code>UPDATE ... WHERE id = :id</code>. <strong>Delete</strong> 3omro ma ykon lien GET 3adi : suppression katdar b <code>POST</code>, m3a confirmation w jeton CSRF.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Modifier un étudiant',
          'lang' => 'php',
          'code' => '<?php
$id = filter_input(INPUT_GET, \'id\', FILTER_VALIDATE_INT);

if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {
    $nom = trim($_POST[\'nom\'] ?? \'\');
    $email = trim($_POST[\'email\'] ?? \'\');

    if ($nom !== \'\' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare(
            \'UPDATE etudiant SET nom = :nom, email = :email WHERE id = :id\'
        );
        $stmt->execute([\':nom\' => $nom, \':email\' => $email, \':id\' => $id]);
        header(\'Location: liste.php\');
        exit;
    }
}

$stmt = $pdo->prepare(\'SELECT * FROM etudiant WHERE id = :id\');
$stmt->execute([\':id\' => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
?>
',
          'explainFr' => 'La clause <code>WHERE id = :id</code> est indispensable : sans elle, toutes les lignes seraient modifiées. Le formulaire est pré-rempli avec les valeurs actuelles.',
          'explainDarija' => 'Clause <code>WHERE id = :id</code> darouriya : bla biha, kol lignes ghadi ytbeddlo. Formulaire kayt3emmer b valeurs li kaynin.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Supprimer avec CSRF',
          'lang' => 'php',
          'code' => '<?php
session_start();

if (empty($_SESSION[\'csrf\'])) {
    $_SESSION[\'csrf\'] = bin2hex(random_bytes(32));
}

if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {
    $jeton = $_POST[\'csrf\'] ?? \'\';
    $id = filter_input(INPUT_POST, \'id\', FILTER_VALIDATE_INT);

    if (hash_equals($_SESSION[\'csrf\'], $jeton) && $id) {
        $stmt = $pdo->prepare(\'DELETE FROM etudiant WHERE id = :id\');
        $stmt->execute([\':id\' => $id]);
    }

    header(\'Location: liste.php\');
    exit;
}
?>
<form method="post" onsubmit="return confirm(\'Supprimer cet étudiant ?\')">
    <input type="hidden" name="csrf" value="<?= $_SESSION[\'csrf\'] ?>">
    <input type="hidden" name="id" value="<?= (int) ($_GET[\'id\'] ?? 0) ?>">
    <button type="submit">Supprimer</button>
</form>
',
          'explainFr' => '<code>hash_equals()</code> compare les jetons en temps constant. La confirmation côté navigateur évite les clics accidentels, et le POST empêche un lien malveillant de déclencher la suppression.',
          'explainDarija' => '<code>hash_equals()</code> katqaren jetons b temps constant. Confirmation f navigateur katmna3 clics b ghafla, w POST kaymna3 lien khayb y3mel suppression.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Suppression logique',
          'fr' => 'Pour des données importantes, préférez une <strong>suppression logique</strong> : une colonne <code>supprime_le</code> remplie au lieu d\'un <code>DELETE</code>. Les données restent récupérables et l\'historique est conservé.',
          'darija' => 'L données mhimmin, 7sen <strong>suppression logique</strong> : colonne <code>supprime_le</code> tt3emmer blast <code>DELETE</code>. Données kaybqaw y9dro ytrj3o w historique kayt7fed.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Traiter le formulaire sans vérifier $_SERVER[\'REQUEST_METHOD\']',
      'fix' => 'if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') { ... }',
      'fr' => 'Un formulaire soumis en GET afficherait les données dans l\'URL et pourrait être rejoué par un simple lien.',
      'darija' => 'Formulaire b GET kay3red données f URL w y9der yt3awed b lien 3adi.',
    ),
    1 => 
    array (
      'wrong' => 'UPDATE sans WHERE',
      'fix' => 'UPDATE ... WHERE id = :id',
      'fr' => 'Sans WHERE, toute la table est modifiée. C\'est l\'erreur CRUD la plus destructrice.',
      'darija' => 'Bla WHERE, table kamla kattbeddel. Hadi erreur CRUD li katdemmri ktar.',
    ),
    2 => 
    array (
      'wrong' => 'Lien Supprimer en GET : <a href="delete.php?id=5">',
      'fix' => 'Formulaire POST avec jeton CSRF et confirmation.',
      'fr' => 'Un lien GET peut être déclenché par un moteur de recherche, un préchargement ou un site tiers.',
      'darija' => 'Lien GET y9der ytf3el b moteur de recherche, préchargement wla site akhor.',
    ),
    3 => 
    array (
      'wrong' => 'Afficher les valeurs du formulaire sans htmlspecialchars',
      'fix' => 'value="<?= htmlspecialchars($valeur) ?>"',
      'fr' => 'Une valeur contenant des guillemets ou du HTML casse le formulaire et permet le XSS.',
      'darija' => 'Valeur fiha guillemets wla HTML katkhesr formulaire w katfta7 bab XSS.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Un <strong>CRUD</strong> complet enchaîne : formulaire + validation + <code>INSERT</code> pour créer, <code>SELECT</code> avec <code>fetchAll</code>/<code>fetch</code> pour lire, <code>UPDATE ... WHERE id</code> pour modifier, et <code>DELETE</code> en POST avec confirmation et jeton CSRF. Toutes les valeurs passent par des requêtes préparées, toutes les sorties par <code>htmlspecialchars</code>.',
    'darija' => '<strong>CRUD</strong> kamel kayrbet : formulaire + validation + <code>INSERT</code> l création, <code>SELECT</code> b <code>fetchAll</code>/<code>fetch</code> l qraya, <code>UPDATE ... WHERE id</code> l modification, w <code>DELETE</code> b POST m3a confirmation w jeton CSRF. Kol valeurs kaydowzo b requêtes préparées, kol sorties b <code>htmlspecialchars</code>.',
  ),
);
