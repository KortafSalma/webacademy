<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex10.php
 */

return array (
  'id' => 'php-ex10',
  'title' => 'Include et require',
  'brief' => 'Réutiliser du code avec include, require et require_once.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — require d\'un fichier de config',
      'lang' => 'php',
      'instructions' => '<p>Crée un fichier <code>config.php</code> avec <code>file_put_contents()</code> contenant <code>define(\'SITE_NAME\', \'WebAcademy\');</code>, inclus-le avec <code>require</code>, puis affiche la constante <code>SITE_NAME</code>.</p>',
      'instructionsDarija' => '<p>5leq fichier <code>config.php</code> b <code>file_put_contents()</code> fih <code>define(\'SITE_NAME\', \'WebAcademy\');</code>, dkhelo b <code>require</code>, men ba3d 3red constante <code>SITE_NAME</code>.</p>',
      'starter' => '<?php
// Crée config.php puis require
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'WebAcademy',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le contenu inclus doit commencer par <?php.',
        1 => 'Utilise __DIR__ . \'/config.php\' pour un chemin fiable.',
        2 => 'require charge le fichier et exécute son code.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/config.php\', "<?php define(\'SITE_NAME\', \'WebAcademy\');");

require __DIR__ . \'/config.php\';
echo SITE_NAME;
?>',
      'explainFr' => '<code>require</code> inclut le fichier et exécute son code dans la portée courante : la constante définie devient disponible. <code>__DIR__</code> pointe vers le dossier du script.',
      'explainDarija' => '<code>require</code> kaydkhel fichier w kaynffed code dyalo f portée li kayn : constante katwli disponible. <code>__DIR__</code> kay3ayer l dossier dyal script.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — include d\'un en-tête',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>entete.php</code> qui définit <code>$titre = \'Bienvenue\';</code>, inclus-le avec <code>include</code>, puis affiche <code>&lt;h1&gt;Bienvenue&lt;/h1&gt;</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>entete.php</code> li kay3erref <code>$titre = \'Bienvenue\';</code>, dkhelo b <code>include</code>, men ba3d 3red <code>&lt;h1&gt;Bienvenue&lt;/h1&gt;</code>.</p>',
      'starter' => '<?php
// Crée entete.php puis include
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '<h1>Bienvenue</h1>',
        ),
      ),
      'hints' => 
      array (
        0 => 'include exécute le fichier inclus.',
        1 => 'La variable définie dans le fichier inclus reste disponible après.',
        2 => 'Concatène les balises autour de $titre.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/entete.php\', "<?php \\$titre = \'Bienvenue\';");

include __DIR__ . \'/entete.php\';
echo "<h1>" . $titre . "</h1>";
?>',
      'explainFr' => '<code>include</code> partage la portée du script appelant : <code>$titre</code> est défini après l\'inclusion. Une inclusion manquante provoque un avertissement, mais le script continue.',
      'explainDarija' => '<code>include</code> kaycharek portée dyal script li kay3ayet : <code>$titre</code> kayt3erref mora inclusion. Inclusion naqsa kat3ti avertissement, walakin script kaykemmel.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — require_once',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>fonctions.php</code> contenant une fonction <code>saluer($nom)</code> qui retourne <code>Bonjour</code> suivi du nom. Inclus le fichier deux fois avec <code>require_once</code>, puis affiche <code>saluer("Amal")</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>fonctions.php</code> fih fonction <code>saluer($nom)</code> li katrje3 <code>Bonjour</code> m3a smiya. Dkhel fichier jouj marrat b <code>require_once</code>, men ba3d 3red <code>saluer("Amal")</code>.</p>',
      'starter' => '<?php
// Crée fonctions.php puis require_once deux fois
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Bonjour Amal',
        ),
      ),
      'hints' => 
      array (
        0 => 'require_once ne charge le fichier qu\'une seule fois.',
        1 => 'Sans _once, la fonction serait redéclarée et PHP provoquerait une erreur fatale.',
        2 => 'La fonction doit être définie dans le fichier inclus.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/fonctions.php\', "<?php function saluer(\\$nom) { return \'Bonjour \' . \\$nom; }");

require_once __DIR__ . \'/fonctions.php\';
require_once __DIR__ . \'/fonctions.php\';

echo saluer("Amal");
?>',
      'explainFr' => '<code>require_once</code> vérifie si le fichier a déjà été chargé. Le second appel est ignoré, ce qui évite l\'erreur « Cannot redeclare saluer() ».',
      'explainDarija' => '<code>require_once</code> kayt7eqqeq wach fichier tcharga qbel. Appel tani kaytjahl, w hakka kayt7ased erreur « Cannot redeclare saluer() ».',
    ),
  ),
);
