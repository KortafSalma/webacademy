<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex02.php
 */

return array (
  'id' => 'integration-ex2',
  'title' => 'Connexions (PDO, MySQL, Oracle)',
  'brief' => 'Construire un DSN, configurer PDO et gérer un échec de connexion.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — construire le DSN',
      'lang' => 'php',
      'instructions' => '<p>Avec <code>$hote = \'localhost\'</code>, <code>$base = \'school\'</code> et <code>$charset = \'utf8mb4\'</code>, construis un DSN MySQL et affiche-le. La sortie doit contenir <code>mysql:host=localhost</code>, <code>dbname=school</code> et <code>charset=utf8mb4</code>.</p>',
      'instructionsDarija' => '<p>B <code>$hote = \'localhost\'</code>, <code>$base = \'school\'</code> w <code>$charset = \'utf8mb4\'</code>, bni DSN MySQL w 3redo. Sortie khas tfih <code>mysql:host=localhost</code>, <code>dbname=school</code> w <code>charset=utf8mb4</code>.</p>',
      'starter' => '<?php
$hote = \'localhost\';
$base = \'school\';
$charset = \'utf8mb4\';

// Construis le DSN
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'mysql:host=localhost',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'dbname=school',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'charset=utf8mb4',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un DSN MySQL commence par mysql:.',
        1 => 'Les parties sont séparées par des points-virgules.',
        2 => 'Concatène les variables dans le bon ordre.',
      ),
      'solution' => '<?php
$hote = \'localhost\';
$base = \'school\';
$charset = \'utf8mb4\';

$dsn = "mysql:host=" . $hote . ";dbname=" . $base . ";charset=" . $charset;
echo $dsn;',
      'explainFr' => 'Le DSN est l\'adresse complète de la base. Il indique le moteur, l\'hôte, le nom de la base et l\'encodage des échanges.',
      'explainDarija' => 'DSN howa adresse kamla dyal base. Kaybeyn moteur, hôte, smiya base w encodage dyal échanges.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — options PDO',
      'lang' => 'php',
      'instructions' => '<p>Construis un tableau <code>$options</code> avec <code>PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION</code>, <code>PDO::ATTR_DEFAULT_FETCH_MODE =&gt; PDO::FETCH_ASSOC</code> et <code>PDO::ATTR_EMULATE_PREPARES =&gt; false</code>. Affiche <code>ERRMODE_EXCEPTION</code>, <code>FETCH_ASSOC</code> et <code>EMULATE_PREPARES désactivé</code>.</p>',
      'instructionsDarija' => '<p>Bni tableau <code>$options</code> b <code>PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION</code>, <code>PDO::ATTR_DEFAULT_FETCH_MODE =&gt; PDO::FETCH_ASSOC</code> w <code>PDO::ATTR_EMULATE_PREPARES =&gt; false</code>. 3red <code>ERRMODE_EXCEPTION</code>, <code>FETCH_ASSOC</code> w <code>EMULATE_PREPARES désactivé</code>.</p>',
      'starter' => '<?php
// Options PDO
$options = [
];

// Affichage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'ERRMODE_EXCEPTION',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'FETCH_ASSOC',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'EMULATE_PREPARES',
        ),
      ),
      'hints' => 
      array (
        0 => 'Les clés du tableau sont les constantes PDO::ATTR_*.',
        1 => 'ERRMODE_EXCEPTION fait lever une exception en cas d\'erreur.',
        2 => 'EMULATE_PREPARES false utilise les vraies requêtes préparées du serveur.',
      ),
      'solution' => '<?php
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

echo "ERRMODE_EXCEPTION activé<br>";
echo "FETCH_ASSOC activé<br>";
echo "EMULATE_PREPARES désactivé";',
      'explainFr' => 'Ces options rendent PDO strict et prévisible : les erreurs deviennent des exceptions, les lignes arrivent en tableaux associatifs et les requêtes préparées sont réellement exécutées par le serveur.',
      'explainDarija' => 'Had options kay3mlo PDO strict w wad7 : erreurs kaywliw exceptions, lignes kayjiw tableaux associatifs w requêtes préparées katnffedha serveur b s7i7.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — échec de connexion maîtrisé',
      'lang' => 'php',
      'instructions' => '<p>Dans un <code>try</code>, lance une <code>PDOException</code> avec le message <code>Access denied</code>. Dans le <code>catch</code>, stocke le détail dans <code>$journal</code> sans l\'afficher, puis affiche <code>Connexion impossible. Détail journalisé.</code></p>',
      'instructionsDarija' => '<p>F <code>try</code>, 3len <code>PDOException</code> b message <code>Access denied</code>. F <code>catch</code>, khzen détail f <code>$journal</code> bla ma t3redo, men ba3d 3red <code>Connexion impossible. Détail journalisé.</code></p>',
      'starter' => '<?php
// Connexion protégée
try {
    // lance l\'exception
} catch (PDOException $e) {
    // journalise sans afficher
}
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connexion impossible',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'journalisé',
        ),
      ),
      'hints' => 
      array (
        0 => 'throw new PDOException(...) déclenche l\'erreur.',
        1 => '$e->getMessage() contient le détail technique.',
        2 => 'Le message affiché doit rester générique.',
      ),
      'solution' => '<?php
try {
    throw new PDOException("Access denied for user");
} catch (PDOException $e) {
    $journal = $e->getMessage();
    echo "Connexion impossible. Détail journalisé.";
}',
      'explainFr' => 'L\'utilisateur reçoit un message clair, tandis que le détail technique reste dans le journal serveur. Afficher « Access denied » révélerait des informations sur la base.',
      'explainDarija' => 'Utilisateur kayakhod message wad7, w détail technique kaybqa f journal serveur. Afficher « Access denied » kaychher informations 3la base.',
    ),
  ),
);
