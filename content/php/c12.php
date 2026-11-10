<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c12.json
 */

return array (
  'id' => 'php-ch12',
  'title' => 'Manipulation de fichiers',
  'subtitle' => 'Lire, écrire et organiser des données sur le serveur',
  'objectives' => 
  array (
    0 => 'Lire et écrire un fichier avec file_get_contents et file_put_contents.',
    1 => 'Ouvrir un fichier avec fopen, fwrite et fclose.',
    2 => 'Lire un fichier ligne par ligne.',
    3 => 'Éviter les failles de traversée de chemin.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'lire-ecrire',
      'title' => 'Lire et écrire simplement',
      'icon' => '📄',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Pour les petits fichiers, deux fonctions suffisent : <code>file_get_contents()</code> lit tout le contenu dans une chaîne, <code>file_put_contents()</code> écrit une chaîne dans un fichier (en le créant si besoin).</p>',
          'darija' => '<p>L fichiers sghar, jouj fonctions kafyin : <code>file_get_contents()</code> katqra kol contenu f chaîne, <code>file_put_contents()</code> katkteb chaîne f fichier (w kat5lqo ila ma kanch).</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe',
          'code' => '$contenu = file_get_contents("notes.txt");
file_put_contents("notes.txt", "Salam");
file_put_contents("journal.txt", "Nouvelle ligne\\n", FILE_APPEND);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Journal de visites',
          'lang' => 'php',
          'code' => '<?php
$fichier = __DIR__ . "/visites.txt";

if (!file_exists($fichier)) {
    file_put_contents($fichier, "0");
}

$visites = (int) file_get_contents($fichier);
$visites++;
file_put_contents($fichier, (string) $visites);

echo "Cette page a été vue " . $visites . " fois.";
?>',
          'explainFr' => '<code>__DIR__</code> garantit que le fichier est créé dans le dossier du script. On lit, on convertit en entier, on incrémente, puis on réécrit.',
          'explainDarija' => '<code>__DIR__</code> katdmen fichier kayt5leq f dossier dyal script. Kanqraw, kan7ewlo l entier, kanzido, w men ba3d kan3awdo nkteb.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Droits d\'écriture',
          'fr' => 'Le serveur web doit avoir le droit d\'écrire dans le dossier. Sur un serveur Linux, un dossier <code>storage/</code> avec les bons droits est préférable à la racine du projet.',
          'darija' => 'Serveur web khaso droit dyal écriture f dossier. F serveur Linux, dossier <code>storage/</code> b droits mzyanin 7sen men racine dyal projet.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'fopen',
      'title' => 'fopen, fwrite, fclose',
      'icon' => '🔧',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Pour un contrôle fin (gros fichiers, ajout progressif), on ouvre un <strong>pointeur</strong> avec <code>fopen()</code>. Le mode indique l\'usage : <code>r</code> lecture, <code>w</code> écriture (écrase), <code>a</code> ajout à la fin.</p>',
          'darija' => '<p>L contrôle dqiq (fichiers kbar, ajout progressif), kan7ello <strong>pointeur</strong> b <code>fopen()</code>. Mode kaybayen usage : <code>r</code> qraya, <code>w</code> écriture (katmsse7), <code>a</code> ajout f l\'akhir.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Mode',
            1 => 'Lecture',
            2 => 'Écriture',
            3 => 'Fichier absent',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'r',
              1 => 'oui',
              2 => 'non',
              3 => 'erreur',
            ),
            1 => 
            array (
              0 => 'w',
              1 => 'non',
              2 => 'oui (écrase)',
              3 => 'créé',
            ),
            2 => 
            array (
              0 => 'a',
              1 => 'non',
              2 => 'oui (ajoute)',
              3 => 'créé',
            ),
            3 => 
            array (
              0 => 'r+',
              1 => 'oui',
              2 => 'oui',
              3 => 'erreur',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Ajouter une ligne au journal',
          'lang' => 'php',
          'code' => '<?php
$fichier = __DIR__ . "/journal.log";
$ligne = date("Y-m-d H:i:s") . " - visite\\n";

$handle = fopen($fichier, "a");
if ($handle !== false) {
    fwrite($handle, $ligne);
    fclose($handle);
    echo "Ligne ajoutée.";
} else {
    echo "Impossible d\'ouvrir le fichier.";
}
?>',
          'explainFr' => '<code>fopen()</code> renvoie <code>false</code> en cas d\'échec : testez toujours le résultat. <code>fclose()</code> libère le fichier.',
          'explainDarija' => '<code>fopen()</code> katrje3 <code>false</code> ila fchel : dima tester résultat. <code>fclose()</code> kat7rer fichier.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'lignes-csv',
      'title' => 'Lire ligne par ligne et CSV',
      'icon' => '📊',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>file()</code> lit toutes les lignes dans un tableau. <code>fgetcsv()</code> lit une ligne CSV et la renvoie sous forme de tableau : idéal pour importer des données.</p>',
          'darija' => '<p><code>file()</code> katqra kol lignes f tableau. <code>fgetcsv()</code> katqra ligne CSV w katrje3ha tableau : mzyana bach timporti données.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Afficher un fichier ligne par ligne',
          'lang' => 'php',
          'code' => '<?php
$lignes = ["Amal,Casablanca,16", "Yassine,Rabat,14"];

foreach ($lignes as $ligne) {
    $champs = str_getcsv($ligne);
    echo $champs[0] . " habite à " . $champs[1] . " (note " . $champs[2] . ")<br>";
}
?>',
          'output' => 'Amal habite à Casablanca (note 16)<br>Yassine habite à Rabat (note 14)<br>',
          'explainFr' => '<code>str_getcsv()</code> découpe une chaîne CSV sans ouvrir de fichier. Pour un vrai fichier, remplacez-la par <code>fgetcsv($handle)</code> dans une boucle <code>while</code>.',
          'explainDarija' => '<code>str_getcsv()</code> katqess chaîne CSV bla ma t7el fichier. L fichier 7aqiqi, beddelha b <code>fgetcsv($handle)</code> f boucle <code>while</code>.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Traversée de chemin',
          'fr' => 'Ne construisez jamais un chemin avec <code>$_GET</code> sans contrôle : <code>../../config.php</code> permettrait de lire n\'importe quel fichier. Utilisez <code>basename()</code> et une liste blanche.',
          'darija' => '3omrek ma tbni chemin b <code>$_GET</code> bla contrôle : <code>../../config.php</code> katkhalli yqra ay fichier. Khdem b <code>basename()</code> w lista blanche.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'file_get_contents("notes.txt") sans vérifier l\'existence',
      'fix' => 'if (is_file($f)) { $contenu = file_get_contents($f); }',
      'fr' => 'Un fichier absent déclenche un avertissement et renvoie <code>false</code>. Testez avec <code>is_file()</code> ou <code>file_exists()</code>.',
      'darija' => 'Fichier makaynch kay3ti avertissement w kayrje3 <code>false</code>. Testi b <code>is_file()</code> wla <code>file_exists()</code>.',
    ),
    1 => 
    array (
      'wrong' => 'fopen($f, "w") pour ajouter une ligne',
      'fix' => 'fopen($f, "a") pour ajouter sans effacer.',
      'fr' => 'Le mode <code>w</code> vide le fichier avant d\'écrire. Pour conserver l\'existant, utilisez <code>a</code> (append) ou <code>FILE_APPEND</code>.',
      'darija' => 'Mode <code>w</code> kayferregh fichier qbel écriture. Bach t7fed li kayn, khdem b <code>a</code> wla <code>FILE_APPEND</code>.',
    ),
    2 => 
    array (
      'wrong' => '$page = $_GET["page"]; include "pages/" . $page;',
      'fix' => '$page = basename($_GET["page"]); include "pages/" . $page; // + liste blanche',
      'fr' => 'Sans filtre, un visiteur peut lire des fichiers hors du dossier prévu (path traversal / LFI).',
      'darija' => 'Bla filtre, visiteur y9der yqra fichiers bera dossier (path traversal / LFI).',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>file_get_contents</strong> et <strong>file_put_contents</strong> suffisent pour les petits fichiers ; <strong>fopen/fwrite/fclose</strong> offrent plus de contrôle. Le mode <code>a</code> ajoute sans effacer, <code>w</code> écrase. Testez toujours l\'existence et les droits, et ne construisez jamais un chemin depuis une saisie utilisateur.',
    'darija' => '<strong>file_get_contents</strong> w <strong>file_put_contents</strong> kafyin l fichiers sghar ; <strong>fopen/fwrite/fclose</strong> kay3tiw contrôle ktar. Mode <code>a</code> kayzid bla ma ymse7, <code>w</code> kaymse7. Dima testi existence w droits, w 3omrek ma tbni chemin men saisie utilisateur.',
  ),
);
