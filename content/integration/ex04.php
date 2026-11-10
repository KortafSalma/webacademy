<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex04.php
 */

return array (
  'id' => 'integration-ex4',
  'title' => 'CRUD complet',
  'brief' => 'Créer, lire, modifier et supprimer des enregistrements.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — ajouter',
      'lang' => 'php',
      'instructions' => '<p>Écris une fonction <code>ajouter(&amp;$lignes, $nom, $filiere)</code> qui ajoute un étudiant au tableau, puis ajoute <code>Nadia</code> en <code>GI</code>. Affiche <code>Total : 3</code> et le nom ajouté.</p>',
      'instructionsDarija' => '<p>Kteb fonction <code>ajouter(&amp;$lignes, $nom, $filiere)</code> li katzid étudiant f tableau, men ba3d zid <code>Nadia</code> f <code>GI</code>. 3red <code>Total : 3</code> w smiya li tzadet.</p>',
      'starter' => '<?php
$etudiants = [
    [\'nom\' => \'Kortaf\', \'filiere\' => \'GI\'],
    [\'nom\' => \'Marzak\', \'filiere\' => \'GI\'],
];

// Fonction ajouter puis appel
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Total : 3',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Nadia',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le paramètre &$lignes est passé par référence.',
        1 => '$lignes[] = [...] ajoute une ligne.',
        2 => 'count() renvoie le nouveau total.',
      ),
      'solution' => '<?php
$etudiants = [
    [\'nom\' => \'Kortaf\', \'filiere\' => \'GI\'],
    [\'nom\' => \'Marzak\', \'filiere\' => \'GI\'],
];

function ajouter(&$lignes, $nom, $filiere) {
    $lignes[] = [\'nom\' => $nom, \'filiere\' => $filiere];
}

ajouter($etudiants, \'Nadia\', \'GI\');

echo "Total : " . count($etudiants) . "<br>";
echo $etudiants[2][\'nom\'];',
      'explainFr' => 'Le passage par référence permet à la fonction de modifier le tableau d\'origine. C\'est le même principe qu\'un <code>INSERT</code> : une nouvelle ligne s\'ajoute à la collection.',
      'explainDarija' => 'Passage par référence kaykhalli fonction tbeddel tableau d\'origine. Nefs principe dyal <code>INSERT</code> : ligne jdida katzad l collection.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — modifier',
      'lang' => 'php',
      'instructions' => '<p>Le tableau <code>$etudiants</code> est indexé par identifiant. Écris une fonction <code>changerFiliere(&amp;$lignes, $id, $filiere)</code> qui met à jour la filière, puis change l\'étudiant 1 en <code>GC</code>. Affiche <code>Amal : GC</code>.</p>',
      'instructionsDarija' => '<p>Tableau <code>$etudiants</code> mfahras b identifiant. Kteb fonction <code>changerFiliere(&amp;$lignes, $id, $filiere)</code> li katbeddel filière, men ba3d beddel étudiant 1 l <code>GC</code>. 3red <code>Amal : GC</code>.</p>',
      'starter' => '<?php
$etudiants = [
    1 => [\'nom\' => \'Amal\', \'filiere\' => \'GI\'],
    2 => [\'nom\' => \'Yassine\', \'filiere\' => \'GI\'],
];

// Fonction update puis appel
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Amal : GC',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Yassine : GI',
        ),
      ),
      'hints' => 
      array (
        0 => 'Vérifie que l\'identifiant existe avec isset.',
        1 => 'Modifie $lignes[$id][\'filiere\'].',
        2 => 'Affiche les deux étudiants pour vérifier que seul l\'un change.',
      ),
      'solution' => '<?php
$etudiants = [
    1 => [\'nom\' => \'Amal\', \'filiere\' => \'GI\'],
    2 => [\'nom\' => \'Yassine\', \'filiere\' => \'GI\'],
];

function changerFiliere(&$lignes, $id, $filiere) {
    if (isset($lignes[$id])) {
        $lignes[$id][\'filiere\'] = $filiere;
    }
}

changerFiliere($etudiants, 1, \'GC\');

echo $etudiants[1][\'nom\'] . " : " . $etudiants[1][\'filiere\'] . "<br>";
echo $etudiants[2][\'nom\'] . " : " . $etudiants[2][\'filiere\'];',
      'explainFr' => 'La mise à jour cible une clé précise, comme un <code>UPDATE ... WHERE id = ?</code>. Les autres lignes restent intactes, ce qui évite de modifier toute la table par erreur.',
      'explainDarija' => 'Mise à jour katcibli clé m7doda, b7al <code>UPDATE ... WHERE id = ?</code>. Lignes okhrin kaybqaw b7alhom, w hakka kayt7ased tbeddel table kamla b ghalat.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — supprimer avec jeton',
      'lang' => 'php',
      'instructions' => '<p>Vérifie le jeton CSRF avec <code>hash_equals($jetonSession, $jetonRecu)</code>. Si les jetons correspondent, supprime l\'étudiant 2 et affiche <code>Étudiant supprimé</code> puis <code>Total : 1</code>. Sinon affiche <code>Jeton invalide</code>.</p>',
      'instructionsDarija' => '<p>T7eqqeq jeton CSRF b <code>hash_equals($jetonSession, $jetonRecu)</code>. Ila jetons kaymatchi, 7yed étudiant 2 w 3red <code>Étudiant supprimé</code> men ba3d <code>Total : 1</code>. Sinon 3red <code>Jeton invalide</code>.</p>',
      'starter' => '<?php
$etudiants = [
    1 => [\'nom\' => \'Amal\'],
    2 => [\'nom\' => \'Yassine\'],
];
$jetonSession = \'abc123\';
$jetonRecu = \'abc123\';

// Vérifie puis supprime
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Étudiant supprimé',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Total : 1',
        ),
      ),
      'hints' => 
      array (
        0 => 'hash_equals compare deux chaînes en temps constant.',
        1 => 'unset($etudiants[2]) supprime la clé.',
        2 => 'Affiche le total après suppression.',
      ),
      'solution' => '<?php
$etudiants = [
    1 => [\'nom\' => \'Amal\'],
    2 => [\'nom\' => \'Yassine\'],
];
$jetonSession = \'abc123\';
$jetonRecu = \'abc123\';

if (hash_equals($jetonSession, $jetonRecu)) {
    unset($etudiants[2]);
    echo "Étudiant supprimé<br>";
    echo "Total : " . count($etudiants);
} else {
    echo "Jeton invalide";
}',
      'explainFr' => 'La suppression vérifie d\'abord un jeton imprévisible : une simple requête GET ne peut pas déclencher l\'action. <code>hash_equals()</code> évite en plus les fuites par temps de comparaison.',
      'explainDarija' => 'Suppression katt7eqqeq qbel jeton ma ytwwqe3ch : requête GET 3adiya ma t9derch tle3eb action. <code>hash_equals()</code> kaymna3 7ta fuites b temps comparaison.',
    ),
  ),
);
