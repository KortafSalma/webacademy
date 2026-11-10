<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex12.php
 */

return array (
  'id' => 'php-ex12',
  'title' => 'Manipulation de fichiers',
  'brief' => 'Écrire, lire et parcourir des fichiers avec PHP.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — écrire et lire',
      'lang' => 'php',
      'instructions' => '<p>Écris <code>PHP\\nSQL\\nHTML</code> dans un fichier <code>notes.txt</code> avec <code>file_put_contents()</code>, puis relis le fichier avec <code>file_get_contents()</code> et affiche son contenu.</p>',
      'instructionsDarija' => '<p>Kteb <code>PHP\\nSQL\\nHTML</code> f fichier <code>notes.txt</code> b <code>file_put_contents()</code>, men ba3d 3awed qra fichier b <code>file_get_contents()</code> w 3red contenu dyalo.</p>',
      'starter' => '<?php
// Écris puis relis notes.txt
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'PHP',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'SQL',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => 'HTML',
        ),
      ),
      'hints' => 
      array (
        0 => 'file_put_contents() écrit tout le contenu d\'un coup.',
        1 => 'file_get_contents() lit le fichier entier.',
        2 => 'Utilise __DIR__ pour un chemin fiable.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/notes.txt\', "PHP\\nSQL\\nHTML");

echo file_get_contents(__DIR__ . \'/notes.txt\');
?>',
      'explainFr' => '<code>file_put_contents()</code> crée le fichier s\'il n\'existe pas et remplace son contenu. <code>file_get_contents()</code> renvoie ensuite tout le texte en une seule chaîne.',
      'explainDarija' => '<code>file_put_contents()</code> kat5leq fichier ila ma kanch w katbeddel contenu dyalo. <code>file_get_contents()</code> men ba3d katrje3 texte kamel f chaîne wa7da.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — compter les lignes',
      'lang' => 'php',
      'instructions' => '<p>Crée <code>villes.txt</code> contenant <code>Rabat\\nCasablanca\\nFès</code>. Lis-le avec <code>file()</code>, affiche <code>Lignes : 3</code> puis <code>Première : Rabat</code>.</p>',
      'instructionsDarija' => '<p>5leq <code>villes.txt</code> fih <code>Rabat\\nCasablanca\\nFès</code>. Qraha b <code>file()</code>, 3red <code>Lignes : 3</code> men ba3d <code>Première : Rabat</code>.</p>',
      'starter' => '<?php
// Crée villes.txt puis lis les lignes
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Lignes : 3',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Première : Rabat',
        ),
      ),
      'hints' => 
      array (
        0 => 'file() renvoie un tableau de lignes.',
        1 => 'FILE_IGNORE_NEW_LINES enlève les sauts de ligne.',
        2 => 'count() donne le nombre de lignes.',
      ),
      'solution' => '<?php
file_put_contents(__DIR__ . \'/villes.txt\', "Rabat\\nCasablanca\\nFès");

$lignes = file(__DIR__ . \'/villes.txt\', FILE_IGNORE_NEW_LINES);

echo "Lignes : " . count($lignes) . "<br>";
echo "Première : " . $lignes[0];
?>',
      'explainFr' => '<code>file()</code> lit le fichier ligne par ligne et renvoie un tableau. <code>FILE_IGNORE_NEW_LINES</code> évite de garder les <code>\\n</code> à la fin de chaque valeur.',
      'explainDarija' => '<code>file()</code> katqra fichier ligne b ligne w katrje3 tableau. <code>FILE_IGNORE_NEW_LINES</code> kaymna3 ytbqaw <code>\\n</code> f akhir kol valeur.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — ajouter dans un journal',
      'lang' => 'php',
      'instructions' => '<p>Ouvre <code>journal.txt</code> en mode ajout avec <code>fopen()</code>, écris <code>Connexion de Amal</code> suivi d\'un saut de ligne avec <code>fwrite()</code>, ferme avec <code>fclose()</code>, puis relis le fichier et affiche <code>Journal : 1 ligne(s)</code> et le contenu.</p>',
      'instructionsDarija' => '<p>7el <code>journal.txt</code> f mode ajout b <code>fopen()</code>, kteb <code>Connexion de Amal</code> m3a saut de ligne b <code>fwrite()</code>, sed b <code>fclose()</code>, men ba3d 3awed qra fichier w 3red <code>Journal : 1 ligne(s)</code> w contenu.</p>',
      'starter' => '<?php
// Ouvre en ajout, écris, ferme, relis
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Journal : 1 ligne(s)',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Connexion de Amal',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le mode \'a\' ajoute à la fin du fichier.',
        1 => 'fwrite() écrit dans le pointeur ouvert.',
        2 => 'fclose() libère la ressource.',
      ),
      'solution' => '<?php
$fichier = __DIR__ . \'/journal.txt\';

$pointeur = fopen($fichier, \'a\');
fwrite($pointeur, "Connexion de Amal\\n");
fclose($pointeur);

$lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

echo "Journal : " . count($lignes) . " ligne(s)<br>";
echo end($lignes);
?>',
      'explainFr' => 'Le mode <code>\'a\'</code> place le pointeur à la fin : chaque écriture s\'ajoute sans écraser l\'historique. <code>fclose()</code> est indispensable pour valider l\'écriture sur le disque.',
      'explainDarija' => 'Mode <code>\'a\'</code> kay7et pointeur f akhir : kol écriture katzad bla ma tmes7 historique. <code>fclose()</code> darouri bach écriture ttsjjel f disque.',
    ),
  ),
);
