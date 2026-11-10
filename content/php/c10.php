<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c10.json
 */

return array (
  'id' => 'php-ch10',
  'title' => 'Include et require',
  'subtitle' => 'Découper un site en fichiers réutilisables',
  'objectives' => 
  array (
    0 => 'Inclure un fichier avec include et require.',
    1 => 'Comprendre la différence entre include et require.',
    2 => 'Éviter les doubles inclusions avec include_once et require_once.',
    3 => 'Construire un header et un footer partagés.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'include-require',
      'title' => 'include et require',
      'icon' => '📎',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>include</strong> et <strong>require</strong> insèrent le contenu d\'un fichier PHP dans le fichier courant. C\'est la base du découpage d\'un site : un seul header, un seul footer, réutilisés sur toutes les pages.</p>',
          'darija' => '<p><strong>include</strong> w <strong>require</strong> kaydkhelo contenu dyal fichier PHP f fichier li kayn. Hadi asas dyal tqsim site : header wa7ed, footer wa7ed, kayt3awdo f kol pages.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Instruction',
            1 => 'Fichier introuvable',
            2 => 'Usage',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'include',
              1 => 'avertissement, le script continue',
              2 => 'élément non critique (publicité, option)',
            ),
            1 => 
            array (
              0 => 'require',
              1 => 'erreur fatale, le script s\'arrête',
              2 => 'élément indispensable (config, header)',
            ),
            2 => 
            array (
              0 => 'include_once',
              1 => 'comme include, une seule fois',
              2 => 'bibliothèque pouvant être incluse plusieurs fois',
            ),
            3 => 
            array (
              0 => 'require_once',
              1 => 'comme require, une seule fois',
              2 => 'classes, configuration, fonctions',
            ),
          ),
          'fr' => 'En pratique, on utilise surtout <code>require_once</code> pour la configuration et les classes.',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe',
          'code' => 'include \'header.php\';
require \'config.php\';
require_once __DIR__ . \'/functions.php\';',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'include n\'est pas une fonction',
          'fr' => '<code>include</code> est une construction du langage : les parenthèses sont autorisées mais inutiles, et le chemin peut s\'écrire directement. Utilisez <code>__DIR__</code> pour un chemin fiable.',
          'darija' => '<code>include</code> machi fonction : parenthèses mesmou7in walakin machi darourin. Khdem b <code>__DIR__</code> bach tkon 3ndek chemin mwatheq.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'header-footer',
      'title' => 'Un header et un footer partagés',
      'icon' => '🧱',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>On place le début du HTML dans <code>header.php</code>, la fin dans <code>footer.php</code>, et chaque page inclut les deux. Pour changer le menu, une seule modification suffit.</p>',
          'darija' => '<p>Kan7etto lbda dyal HTML f <code>header.php</code>, l\'akhir f <code>footer.php</code>, w kol page katdokhel jouj. Bach tbeddel menu, beddel f blasa wa7da.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'header.php',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= $titre ?? \'Mon site\' ?></title>
</head>
<body>
  <header>
    <h1>Mon site</h1>
  </header>
  <main>',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'footer.php',
          'code' => '  </main>
  <footer>
    <p>© 2026 Mon site</p>
  </footer>
</body>
</html>',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Page qui assemble les morceaux',
          'lang' => 'php',
          'code' => '<?php
$titre = "Accueil";
require __DIR__ . \'/header.php\';
?>

<h2>Bienvenue</h2>
<p>Cette page réutilise le header et le footer.</p>

<?php
require __DIR__ . \'/footer.php\';
?>',
          'explainFr' => 'Le fichier de page ne contient que son contenu propre. Le header et le footer sont inclus au moment de l\'exécution : si le menu change, toutes les pages en profitent.',
          'explainDarija' => 'Fichier dyal page fih ghir contenu dyalo. Header w footer kaydkhelo wa9t exécution : ila menu tbeddel, kol pages kaystafdo.',
        ),
        4 => 
        array (
          'type' => 'tip',
          'title' => 'Le raccourci <?= ?>',
          'fr' => '<code>&lt;?= $titre ?&gt;</code> est un raccourci de <code>&lt;?php echo $titre; ?&gt;</code>. Très pratique dans les templates HTML, à condition que la variable soit définie.',
          'darija' => '<code>&lt;?= $titre ?&gt;</code> hiya raccourci dyal <code>&lt;?php echo $titre; ?&gt;</code>. Mzyana f templates HTML, ila kanet variable m3erfa.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'chemins-securite',
      'title' => 'Chemins et bonnes pratiques',
      'icon' => '🛡️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un chemin relatif dépend du dossier du script appelé : il peut fonctionner sur votre machine et échouer sur le serveur. Utilisez <code>__DIR__</code> (dossier du fichier courant) pour construire des chemins absolus fiables.</p>',
          'darija' => '<p>Chemin relatif kay3tamed 3la dossier dyal script : y9der ykhdem f PC dyalek w ytlef f serveur. Khdem b <code>__DIR__</code> (dossier dyal fichier li kayn) bach tbni chemins absolus mwatheqin.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Comparaison de chemins',
          'lang' => 'php',
          'code' => '<?php
// Fragile : dépend du dossier courant
echo "Relatif : " . \'includes/header.php\' . "<br>";

// Fiable : part du dossier du fichier courant
echo "Absolu : " . __DIR__ . DIRECTORY_SEPARATOR . \'includes\' . DIRECTORY_SEPARATOR . \'header.php\';
?>',
          'output' => 'Relatif : includes/header.php<br>Absolu : C:\\projet\\includes\\header.php',
          'explainFr' => 'Le chemin absolu construit avec <code>__DIR__</code> ne dépend pas de l\'endroit d\'où le script est lancé : il reste correct.',
          'explainDarija' => 'Chemin absolu li mtbni b <code>__DIR__</code> ma kay3tamedch 3la blasa men fin script kaybda : kaybqa s7i7.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Ne jamais inclure une saisie utilisateur',
          'fr' => '<code>include $_GET[\'page\'];</code> permet à un visiteur de charger n\'importe quel fichier du serveur. C\'est une faille grave (LFI). Utilisez une liste blanche de pages autorisées.',
          'darija' => '<code>include $_GET[\'page\'];</code> kat3ti l visiteur imkaniya ydkhel ay fichier f serveur. Hadi faille khayba (LFI). Khdem b lista blanche dyal pages mesmou7a.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'include \'header.php\'; dans un dossier différent',
      'fix' => 'require __DIR__ . \'/header.php\';',
      'fr' => 'Le chemin relatif est résolu depuis le script principal, pas depuis le fichier inclus : utilisez <code>__DIR__</code>.',
      'darija' => 'Chemin relatif kayt7eseb men script principal, machi men fichier inclus : khdem b <code>__DIR__</code>.',
    ),
    1 => 
    array (
      'wrong' => 'require pour un fichier qui peut être absent',
      'fix' => 'include si le fichier est optionnel, require s\'il est indispensable.',
      'fr' => '<code>require</code> arrête tout le script si le fichier manque. Pour un élément optionnel, préférez <code>include</code>.',
      'darija' => '<code>require</code> kat7bess script kamel ila fichier ma kaynch. L élément optionnel, 7sen <code>include</code>.',
    ),
    2 => 
    array (
      'wrong' => 'include \'config.php\'; deux fois',
      'fix' => 'require_once \'config.php\';',
      'fr' => 'Inclure deux fois un fichier qui déclare des fonctions ou des constantes provoque une erreur « Cannot redeclare ». Utilisez <code>*_once</code>.',
      'darija' => 'Ila dkhelti fichier jouj merrat w fih fonctions wla constantes, ghadi y3tik erreur « Cannot redeclare ». Khdem b <code>*_once</code>.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>include</strong> insère un fichier et continue si erreur ; <strong>require</strong> arrête le script si le fichier manque. Les variantes <strong>*_once</strong> évitent les doubles inclusions. Utilisez <code>__DIR__</code> pour des chemins fiables et ne construisez jamais un include à partir d\'une saisie utilisateur.',
    'darija' => '<strong>include</strong> katdkhel fichier w katkml ila kan erreur ; <strong>require</strong> kat7bess script ila fichier ma kaynch. Variantes <strong>*_once</strong> kaymna3o doubles inclusions. Khdem b <code>__DIR__</code> bach chemins ykono mwatheqin, w 3omrek ma tbni include men saisie utilisateur.',
  ),
);
