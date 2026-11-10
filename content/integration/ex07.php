<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex07.php
 */

return array (
  'id' => 'integration-ex7',
  'title' => 'Architecture de projet',
  'brief' => 'Séparer configuration, fonctions et vue dans une petite application.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — fichier de configuration inclus',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>config.php</code> avec <code>file_put_contents()</code> contenant les constantes <code>DB_HOST</code> et <code>DB_NAME</code>. Inclus-le avec <code>require</code>, puis affiche <code>Hôte : localhost</code> et <code>Base : school</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>config.php</code> b <code>file_put_contents()</code> fih constantes <code>DB_HOST</code> w <code>DB_NAME</code>. Dkhelo b <code>require</code>, men ba3d 3red <code>Hôte : localhost</code> w <code>Base : school</code>.</p>',
      'starter' => '<?php
// Crée config.php puis require
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Hôte : localhost',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Base : school',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le contenu du fichier inclus doit commencer par <?php.',
        1 => 'Utilise __DIR__ . \'/config.php\'.',
        2 => 'define crée une constante globale.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/config.php\', "<?php define(\'DB_HOST\', \'localhost\'); define(\'DB_NAME\', \'school\');");

require __DIR__ . \'/config.php\';

echo "Hôte : " . DB_HOST . "<br>";
echo "Base : " . DB_NAME;',
      'explainFr' => 'La configuration est isolée dans un fichier unique. Toutes les pages partagent les mêmes paramètres sans les répéter, ce qui facilite les changements d\'environnement.',
      'explainDarija' => 'Configuration m3zoula f fichier wa7ed. Kol pages kaycharko nefs paramètres bla tkrar, w hakka tbeddel environnement kaywli sahel.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — fonction réutilisable',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>helpers.php</code> avec une fonction <code>e($texte)</code> qui retourne <code>htmlspecialchars($texte, ENT_QUOTES, \'UTF-8\')</code>. Inclus le fichier deux fois avec <code>require_once</code>, puis affiche <code>&amp;lt;b&amp;gt;Alerte&amp;lt;/b&amp;gt;</code> pour l\'entrée <code>&lt;b&gt;Alerte&lt;/b&gt;</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>helpers.php</code> b fonction <code>e($texte)</code> li katrje3 <code>htmlspecialchars($texte, ENT_QUOTES, \'UTF-8\')</code>. Dkhel fichier jouj marrat b <code>require_once</code>, men ba3d 3red <code>&amp;lt;b&amp;gt;Alerte&amp;lt;/b&amp;gt;</code> l entrée <code>&lt;b&gt;Alerte&lt;/b&gt;</code>.</p>',
      'starter' => '<?php
// Crée helpers.php puis require_once deux fois
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '&lt;b&gt;Alerte&lt;/b&gt;',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Fonction chargée une seule fois',
        ),
      ),
      'hints' => 
      array (
        0 => 'require_once évite la redéclaration de e().',
        1 => 'htmlspecialchars retourne la chaîne échappée.',
        2 => 'Affiche aussi un message confirmant l\'inclusion unique.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/helpers.php\', "<?php function e(\\$texte) { return htmlspecialchars(\\$texte, ENT_QUOTES, \'UTF-8\'); }");

require_once __DIR__ . \'/helpers.php\';
require_once __DIR__ . \'/helpers.php\';

echo e(\'<b>Alerte</b>\') . "<br>";
echo "Fonction chargée une seule fois";',
      'explainFr' => 'La fonction <code>e()</code> centralise l\'échappement : toutes les vues l\'appellent de la même façon. <code>require_once</code> garantit qu\'elle n\'est définie qu\'une fois, même si plusieurs fichiers l\'incluent.',
      'explainDarija' => 'Fonction <code>e()</code> katjem3 échappement : kol vues kay3ayto 3liha b nefs tariqa. <code>require_once</code> kaddmen kat3erref ghir marra wa7da, 7ta ila bzaf fichiers dkheloha.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — modèle et vue séparés',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>modele.php</code> qui retourne un tableau de deux étudiants, puis <code>vue.php</code> qui définit une fonction <code>renderListe($lignes)</code> produisant une liste HTML. Inclus les deux avec <code>require</code> et affiche le résultat. La sortie doit contenir <code>&lt;ul&gt;</code>, <code>&lt;li&gt;Kortaf&lt;/li&gt;</code> et <code>2 étudiants</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>modele.php</code> li kayrje3 tableau dyal jouj étudiants, men ba3d <code>vue.php</code> li kay3erref fonction <code>renderListe($lignes)</code> li katproduit liste HTML. Dkhel jouj b <code>require</code> w 3red résultat. Sortie khas tfih <code>&lt;ul&gt;</code>, <code>&lt;li&gt;Kortaf&lt;/li&gt;</code> w <code>2 étudiants</code>.</p>',
      'starter' => '<?php
// Crée modele.php et vue.php puis inclus
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
          'value' => '<li>Kortaf</li>',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => '2 étudiants',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le modèle fournit les données, la vue les met en forme.',
        1 => 'Une fonction de rendu garde la vue réutilisable.',
        2 => 'Utilise require pour charger les deux fichiers.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/modele.php\', "<?php return [[\'nom\' => \'Kortaf\'], [\'nom\' => \'Marzak\']];");
file_put_contents(__DIR__ . \'/vue.php\', "<?php function renderListe(\\$lignes) { \\$html = \'<ul>\'; foreach (\\$lignes as \\$ligne) { \\$html .= \'<li>\' . htmlspecialchars(\\$ligne[\'nom\'], ENT_QUOTES, \'UTF-8\') . \'</li>\'; } return \\$html . \'</ul>\'; }");

$etudiants = require __DIR__ . \'/modele.php\';
require __DIR__ . \'/vue.php\';

echo renderListe($etudiants);
echo "<br>" . count($etudiants) . " étudiants";',
      'explainFr' => 'Le modèle ne connaît pas le HTML, et la vue ne connaît pas la source des données. Cette séparation rend chaque partie testable et réutilisable, même quand l\'application grandit.',
      'explainDarija' => 'Modèle ma kay3refch HTML, w vue ma kat3refch source dyal données. Had séparation kat3mel kol partie testable w réutilisable, 7ta ila application tkber.',
    ),
  ),
);
