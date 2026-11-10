<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex03.php
 */

return array (
  'id' => 'integration-ex3',
  'title' => 'Requêtes préparées',
  'brief' => 'Écrire des requêtes avec paramètres nommés et positionnels.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — paramètre nommé',
      'lang' => 'php',
      'instructions' => '<p>Écris une requête préparée qui recherche un étudiant par email avec le paramètre nommé <code>:email</code>. Stocke la valeur dans <code>$params[\'email\']</code> et affiche la requête puis l\'email.</p>',
      'instructionsDarija' => '<p>Kteb requête préparée li kat9elleb 3la étudiant b email b paramètre nommé <code>:email</code>. Khzen valeur f <code>$params[\'email\']</code> w 3red requête men ba3d email.</p>',
      'starter' => '<?php
$email = \'amal@example.ma\';
$sql = \'\';
$params = [];

// Requête et paramètre
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'WHERE email = :email',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'amal@example.ma',
        ),
      ),
      'hints' => 
      array (
        0 => 'La requête contient :email sans guillemets autour.',
        1 => 'Le tableau associe la clé email à la valeur.',
        2 => 'N\'insère jamais $email directement dans la chaîne SQL.',
      ),
      'solution' => '<?php
$email = \'amal@example.ma\';
$sql = "SELECT id, nom FROM etudiant WHERE email = :email";
$params = [\'email\' => $email];

echo $sql . "<br>";
echo "Paramètre : " . $params[\'email\'];',
      'explainFr' => 'Le placeholder <code>:email</code> est séparé de la valeur. PDO enverra la valeur comme donnée, jamais comme fragment de requête : c\'est la base de la protection contre l\'injection SQL.',
      'explainDarija' => 'Placeholder <code>:email</code> mfre9 men valeur. PDO kaysift valeur b7al donnée, machi fragment requête : hadi asas protection men injection SQL.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — paramètres positionnels',
      'lang' => 'php',
      'instructions' => '<p>Prépare un <code>INSERT</code> avec trois placeholders positionnels <code>?</code> pour <code>nom</code>, <code>filiere</code> et <code>email</code>. Remplis <code>$params</code> dans le bon ordre et affiche <code>3 paramètres liés</code> puis la liste des valeurs.</p>',
      'instructionsDarija' => '<p>7der <code>INSERT</code> b tlata placeholders positionnels <code>?</code> l <code>nom</code>, <code>filiere</code> w <code>email</code>. 3emmer <code>$params</code> b tartib s7i7 w 3red <code>3 paramètres liés</code> men ba3d liste valeurs.</p>',
      'starter' => '<?php
$nom = \'Nadia\';
$filiere = \'GI\';
$email = \'nadia@example.ma\';
$sql = \'\';
$params = [];

// INSERT préparé
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '3 paramètres liés',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Nadia',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'GI',
        ),
        3 => 
        array (
          'type' => 'output_contains',
          'value' => 'nadia@example.ma',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le nombre de ? doit correspondre au nombre de valeurs.',
        1 => 'L\'ordre du tableau $params suit l\'ordre des ?.',
        2 => 'Utilise implode pour afficher les valeurs.',
      ),
      'solution' => '<?php
$nom = \'Nadia\';
$filiere = \'GI\';
$email = \'nadia@example.ma\';
$sql = "INSERT INTO etudiant (nom, filiere, email) VALUES (?, ?, ?)";
$params = [$nom, $filiere, $email];

echo $sql . "<br>";
echo count($params) . " paramètres liés<br>";
echo implode(" | ", $params);',
      'explainFr' => 'Avec les paramètres positionnels, l\'ordre compte. Trois <code>?</code> appellent exactement trois valeurs, fournies dans le même ordre au moment de l\'exécution.',
      'explainDarija' => 'B paramètres positionnels, tartib mohim. Tlata <code>?</code> kaytlebo b dqiq tlata valeurs, m3tin f nefs tartib f exécution.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — tri dynamique par liste blanche',
      'lang' => 'php',
      'instructions' => '<p>La demande de tri <code>$triDemande = \'nom; DROP TABLE etudiant\'</code> est suspecte. Vérifie qu\'elle appartient à la liste blanche <code>[\'nom\', \'filiere\']</code>. Si non, utilise <code>nom</code> et affiche <code>Tri refusé</code>. Affiche ensuite <code>ORDER BY nom</code>.</p>',
      'instructionsDarija' => '<p>Demande dyal tri <code>$triDemande = \'nom; DROP TABLE etudiant\'</code> mochtobha. T7eqqeq wach kayna f liste blanche <code>[\'nom\', \'filiere\']</code>. Ila la, khdem b <code>nom</code> w 3red <code>Tri refusé</code>. Men ba3d 3red <code>ORDER BY nom</code>.</p>',
      'starter' => '<?php
$triDemande = \'nom; DROP TABLE etudiant\';
$autorises = [\'nom\', \'filiere\'];
$tri = \'nom\';

// Liste blanche
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Tri refusé',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'ORDER BY nom',
        ),
      ),
      'hints' => 
      array (
        0 => 'in_array avec true compare strictement.',
        1 => 'Un nom de colonne ne peut pas être passé en paramètre préparé.',
        2 => 'La liste blanche limite les valeurs acceptées.',
      ),
      'solution' => '<?php
$triDemande = \'nom; DROP TABLE etudiant\';
$autorises = [\'nom\', \'filiere\'];
$tri = \'nom\';

if (!in_array($triDemande, $autorises, true)) {
    echo "Tri refusé<br>";
} else {
    $tri = $triDemande;
}

$sql = "SELECT nom FROM etudiant ORDER BY " . $tri;
echo $sql;',
      'explainFr' => 'Les paramètres préparés protègent les valeurs, pas les identifiants SQL comme un nom de colonne. Pour un tri dynamique, on compare la demande à une liste blanche connue avant de l\'insérer dans la requête.',
      'explainDarija' => 'Paramètres préparés kay7miw valeurs, machi identifiants SQL b7al smiya colonne. L tri dynamique, kanqarno demande m3a liste blanche m3erfa qbel ma ndkheloha f requête.',
    ),
  ),
);
