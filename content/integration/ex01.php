<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex01.php
 */

return array (
  'id' => 'integration-ex1',
  'title' => 'Communication PHP — base de données',
  'brief' => 'Transformer des lignes de base en HTML et suivre le pipeline complet.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — afficher des lignes',
      'lang' => 'php',
      'instructions' => '<p>Le tableau <code>$etudiants</code> contient deux lignes issues de la base. Affiche une liste <code>&lt;ul&gt;</code> avec un <code>&lt;li&gt;</code> par étudiant au format <code>Nom - Filière</code>.</p>',
      'instructionsDarija' => '<p>Tableau <code>$etudiants</code> fih jouj lignes men base. 3red liste <code>&lt;ul&gt;</code> b <code>&lt;li&gt;</code> l kol étudiant b format <code>Nom - Filière</code>.</p>',
      'starter' => '<?php
$etudiants = [
    [\'nom\' => \'Kortaf\', \'filiere\' => \'GI\'],
    [\'nom\' => \'Marzak\', \'filiere\' => \'GI\'],
];

// Affiche une liste
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '<ul>',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => '<li>Kortaf - GI</li>',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => '<li>Marzak - GI</li>',
        ),
      ),
      'hints' => 
      array (
        0 => 'Parcours le tableau avec foreach.',
        1 => 'Chaque ligne est un tableau associatif : $etudiant[\'nom\'].',
        2 => 'Concatène les balises et les valeurs avec un point.',
      ),
      'solution' => '<?php
$etudiants = [
    [\'nom\' => \'Kortaf\', \'filiere\' => \'GI\'],
    [\'nom\' => \'Marzak\', \'filiere\' => \'GI\'],
];

echo "<ul>";
foreach ($etudiants as $etudiant) {
    echo "<li>" . $etudiant[\'nom\'] . " - " . $etudiant[\'filiere\'] . "</li>";
}
echo "</ul>";',
      'explainFr' => 'Le PHP reçoit des lignes de la base sous forme de tableaux, puis les transforme en HTML. C\'est la dernière étape du pipeline : SQL fournit les données, PHP les met en forme.',
      'explainDarija' => 'PHP kayakhod lignes men base b7al tableaux, men ba3d kaybeddelhom l HTML. Hadi étape akhira f pipeline : SQL kay3ti données, PHP kay3redhom.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — tableau HTML',
      'lang' => 'php',
      'instructions' => '<p>À partir de <code>$lignes</code>, affiche un tableau HTML avec l\'en-tête <code>Nom</code> et une ligne <code>&lt;td&gt;</code> par étudiant. Le résultat doit contenir <code>&lt;table&gt;</code>, <code>&lt;th&gt;Nom&lt;/th&gt;</code> et <code>&lt;td&gt;Kortaf&lt;/td&gt;</code>.</p>',
      'instructionsDarija' => '<p>Men <code>$lignes</code>, 3red tableau HTML b en-tête <code>Nom</code> w ligne <code>&lt;td&gt;</code> l kol étudiant. Résultat khas ykoun fih <code>&lt;table&gt;</code>, <code>&lt;th&gt;Nom&lt;/th&gt;</code> w <code>&lt;td&gt;Kortaf&lt;/td&gt;</code>.</p>',
      'starter' => '<?php
$lignes = [
    [\'nom\' => \'Kortaf\'],
    [\'nom\' => \'Marzak\'],
];

// Tableau HTML
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '<table>',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => '<th>Nom</th>',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => '<td>Kortaf</td>',
        ),
        3 => 
        array (
          'type' => 'output_contains',
          'value' => '<td>Marzak</td>',
        ),
      ),
      'hints' => 
      array (
        0 => 'Ouvre table, thead et tbody.',
        1 => 'La boucle génère une ligne tr par enregistrement.',
        2 => 'Ferme toutes les balises dans le bon ordre.',
      ),
      'solution' => '<?php
$lignes = [
    [\'nom\' => \'Kortaf\'],
    [\'nom\' => \'Marzak\'],
];

echo "<table>";
echo "<thead><tr><th>Nom</th></tr></thead>";
echo "<tbody>";
foreach ($lignes as $ligne) {
    echo "<tr><td>" . $ligne[\'nom\'] . "</td></tr>";
}
echo "</tbody>";
echo "</table>";',
      'explainFr' => 'Une page dynamique construit son HTML à partir des données. Le tableau reste lisible même si la base renvoie beaucoup de lignes, car la boucle s\'adapte automatiquement.',
      'explainDarija' => 'Page dynamique katbni HTML dyalha men données. Tableau kaybqa mqrou ila base rje3at bzaf lignes, 7it boucle katt3adel b rasha.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — compter et afficher le pipeline',
      'lang' => 'php',
      'instructions' => '<p>Simule un pipeline : la requête <code>$requete</code> et les résultats <code>$resultats</code> sont fournis. Affiche <code>2 étudiants affichés</code>, puis la liste des noms. Termine par <code>Pipeline terminé</code>.</p>',
      'instructionsDarija' => '<p>Simuli pipeline : requête <code>$requete</code> w résultats <code>$resultats</code> m3tin. 3red <code>2 étudiants affichés</code>, men ba3d liste smiyat. Sali b <code>Pipeline terminé</code>.</p>',
      'starter' => '<?php
$requete = "SELECT nom FROM etudiant WHERE filiere = :filiere";
$resultats = [
    [\'nom\' => \'Kortaf\'],
    [\'nom\' => \'Marzak\'],
];

// Compte, liste, fin
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '2 étudiants affichés',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => '<li>Kortaf</li>',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => '<li>Marzak</li>',
        ),
        3 => 
        array (
          'type' => 'output_contains',
          'value' => 'Pipeline terminé',
        ),
      ),
      'hints' => 
      array (
        0 => 'count($resultats) donne le nombre de lignes.',
        1 => 'Affiche la requête pour tracer l\'étape SQL.',
        2 => 'La liste se génère avec foreach.',
      ),
      'solution' => '<?php
$requete = "SELECT nom FROM etudiant WHERE filiere = :filiere";
$resultats = [
    [\'nom\' => \'Kortaf\'],
    [\'nom\' => \'Marzak\'],
];

echo $requete . "<br>";
echo count($resultats) . " étudiants affichés<br>";
echo "<ul>";
foreach ($resultats as $ligne) {
    echo "<li>" . $ligne[\'nom\'] . "</li>";
}
echo "</ul>";
echo "Pipeline terminé";',
      'explainFr' => 'Le script montre les trois étapes : la requête SQL, le résultat transformé en HTML, puis la fin du traitement. En production, la requête serait exécutée par PDO au lieu d\'être simulée.',
      'explainDarija' => 'Script kaybayen tlata étapes : requête SQL, résultat mbeddel l HTML, men ba3d nihaya traitement. F production, requête katnffed b PDO blast simulation.',
    ),
  ),
);
