<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c05.json
 */

return array (
  'id' => 'php-ch5',
  'title' => 'Boucles',
  'subtitle' => 'Répéter des instructions sans dupliquer le code',
  'objectives' => 
  array (
    0 => 'Répéter du code avec while et do...while.',
    1 => 'Compter avec la boucle for.',
    2 => 'Parcourir un tableau avec foreach.',
    3 => 'Contrôler une boucle avec break et continue.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'while',
      'title' => 'La boucle while',
      'icon' => '🔁',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>while</strong> répète un bloc <em>tant que</em> sa condition est vraie. La condition est testée <strong>avant</strong> chaque tour. Il faut modifier une variable dans la boucle, sinon elle ne s\'arrête jamais : c\'est une boucle infinie.</p>',
          'darija' => '<p><strong>while</strong> kat3awed bloc <em>ma dam</em> condition vraie. Condition katttester <strong>qbel</strong> kol tour. Khas tbeddel variable dakhel boucle, sinon katwli boucle infinie.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe while',
          'code' => '$compteur = 1;

while ($compteur <= 5) {
    echo $compteur . " ";
    $compteur++;   // très important !
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Compter de 1 à 5',
          'lang' => 'php',
          'code' => '<?php
$compteur = 1;

while ($compteur <= 5) {
    echo $compteur . " ";
    $compteur++;
}
?>',
          'output' => '1 2 3 4 5',
          'explainFr' => 'À chaque tour, on affiche $compteur puis on l\'incrémente. Quand il atteint 6, la condition <code>6 &lt;= 5</code> devient fausse et la boucle s\'arrête.',
          'explainDarija' => 'Kol tour kanafficho $compteur w men ba3d kanzido. Melli ywsel 6, condition katwli fausse w boucle kat7bes.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'La boucle infinie',
          'fr' => 'Oublier <code>$compteur++</code> donne une boucle qui ne s\'arrête jamais et bloque la page. Si votre page tourne sans fin, vérifiez d\'abord l\'incrément.',
          'darija' => 'Ila nsiti <code>$compteur++</code>, boucle ma kat7besch w page katbloqui. Ila page katdour bla ma tsali, chouf l\'incrément.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'for',
      'title' => 'La boucle for',
      'icon' => '🔢',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>for</strong> regroupe les trois éléments d\'une boucle comptée sur une seule ligne : l\'<strong>initialisation</strong>, la <strong>condition</strong> et l\'<strong>incrément</strong>. C\'est la boucle idéale quand on connaît le nombre de répétitions.</p>',
          'darija' => '<p><strong>for</strong> katjem3 tlata dyal éléments f ligne wa7da : <strong>initialisation</strong>, <strong>condition</strong> w <strong>incrément</strong>. Hiya l\'boucle mzyana melli t3ref 3adad dyal répétitions.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe for',
          'code' => 'for ($i = 1; $i <= 5; $i++) {
    echo $i . " ";
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Table de multiplication de 7',
          'lang' => 'php',
          'code' => '<?php
for ($i = 1; $i <= 5; $i++) {
    echo "7 x " . $i . " = " . (7 * $i) . "<br>";
}
?>',
          'output' => '7 x 1 = 7<br>7 x 2 = 14<br>7 x 3 = 21<br>7 x 4 = 28<br>7 x 5 = 35<br>',
          'explainFr' => 'La variable $i joue deux rôles : compteur de boucle et opérande du calcul. L\'affichage se construit par concaténation avec l\'opérateur <code>.</code>.',
          'explainDarija' => '$i 3ndha jouj rôles : compteur dyal boucle w opérande f calcul. Affichage kaytbn b concaténation b l\'opérateur <code>.</code>.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'for ou while ?',
          'fr' => 'Nombre de répétitions connu → <code>for</code>. Répétition conditionnelle (lire un fichier, attendre un état) → <code>while</code>. Les deux fonctionnent, mais le bon choix rend le code plus clair.',
          'darija' => '3adad dyal répétitions ma3rouf → <code>for</code>. Répétition 3la 7sab condition (qraya fichier, ste5na 7ala) → <code>while</code>. Jouj kaykhdmo, walakin l\'ikhtiyar mzyan kaywadde7 code.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'foreach',
      'title' => 'La boucle foreach',
      'icon' => '📚',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>foreach</strong> parcourt un tableau élément par élément, sans gérer d\'indice ni de compteur. C\'est la boucle la plus utilisée en PHP pour afficher des données.</p>',
          'darija' => '<p><strong>foreach</strong> katdour 3la tableau élément b élément, bla indice w bla compteur. Hiya l\'boucle li katkhdem bzaf f PHP bach t3red données.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe foreach',
          'code' => 'foreach ($fruits as $fruit) {
    echo $fruit;
}

// Avec la clé :
foreach ($notes as $matiere => $note) {
    echo $matiere . " : " . $note;
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Afficher une liste de langages',
          'lang' => 'php',
          'code' => '<?php
$langages = ["HTML", "CSS", "PHP", "SQL"];

foreach ($langages as $langage) {
    echo "- " . $langage . "<br>";
}
?>',
          'output' => '- HTML<br>- CSS<br>- PHP<br>- SQL<br>',
          'explainFr' => 'À chaque tour, $langage reçoit la valeur suivante du tableau. On n\'a pas besoin de connaître sa taille.',
          'explainDarija' => 'Kol tour, $langage katakhod valeur li mora f tableau. Ma khasnash n3rfo 9ad ash kayn.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Parcourir un tableau associatif',
          'lang' => 'php',
          'code' => '<?php
$notes = [
    "HTML" => 16,
    "CSS" => 14,
    "PHP" => 15
];

foreach ($notes as $matiere => $note) {
    echo $matiere . " : " . $note . "/20<br>";
}
?>',
          'output' => 'HTML : 16/20<br>CSS : 14/20<br>PHP : 15/20<br>',
          'explainFr' => 'La forme <code>as $cle =&gt; $valeur</code> donne accès à la fois à la clé (la matière) et à la valeur (la note).',
          'explainDarija' => 'Forme <code>as $cle =&gt; $valeur</code> kat3tik clé (matière) w valeur (note) f nefs lwa9t.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'do-while-break',
      'title' => 'do...while, break et continue',
      'icon' => '🛑',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>do...while</strong> exécute le bloc <strong>au moins une fois</strong>, puis teste la condition. <strong>break</strong> sort immédiatement de la boucle ; <strong>continue</strong> passe au tour suivant sans exécuter la fin du bloc.</p>',
          'darija' => '<p><strong>do...while</strong> katnffed bloc <strong>marra wa7da 3la l9al</strong>, men ba3d katttester condition. <strong>break</strong> katkhrej men boucle nichan ; <strong>continue</strong> katdowez l tour li mora bla ma tkml bloc.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'break et continue en action',
          'lang' => 'php',
          'code' => '<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i == 3) {
        continue; // saute 3
    }
    if ($i == 6) {
        break; // arrête tout
    }
    echo $i . " ";
}
?>',
          'output' => '1 2 4 5',
          'explainFr' => 'Quand $i vaut 3, <code>continue</code> saute l\'affichage. Quand il vaut 6, <code>break</code> quitte la boucle : 6 et les suivants ne sont jamais affichés.',
          'explainDarija' => 'Melli $i = 3, <code>continue</code> katqbez l\'affichage. Melli = 6, <code>break</code> katkhrej men boucle : 6 w li morahom ma kaytbrach.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'do...while : au moins un tour',
          'lang' => 'php',
          'code' => '<?php
$essai = 1;

do {
    echo "Tentative " . $essai . "<br>";
    $essai++;
} while ($essai <= 3);
?>',
          'output' => 'Tentative 1<br>Tentative 2<br>Tentative 3<br>',
          'explainFr' => 'Le bloc s\'exécute d\'abord, la condition est vérifiée après. Même avec une condition fausse au départ, le bloc tournerait une fois.',
          'explainDarija' => 'Bloc kaynffed lwel, condition kattester men ba3d. 7ta ila condition kanet fausse men lbda, bloc kaydour marra.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'while ($i <= 5) { echo $i; }',
      'fix' => 'while ($i <= 5) { echo $i; $i++; }',
      'fr' => 'Sans incrément, la condition reste vraie : boucle infinie et page bloquée.',
      'darija' => 'Bla incrément, condition katbqa vraie : boucle infinie w page katbloqui.',
    ),
    1 => 
    array (
      'wrong' => 'for ($i = 1; $i <= 5; $i--)',
      'fix' => 'for ($i = 1; $i <= 5; $i++)',
      'fr' => 'Décrémenter au lieu d\'incrémenter éloigne la variable de la condition de sortie : boucle infinie.',
      'darija' => 'Ila nqesti blast ma tzid, variable katb3ed 3la condition : boucle infinie.',
    ),
    2 => 
    array (
      'wrong' => 'foreach ($fruits as $fruit) { echo $fruits; }',
      'fix' => 'foreach ($fruits as $fruit) { echo $fruit; }',
      'fr' => 'On affiche la variable de boucle au singulier ($fruit), pas le tableau entier ($fruits).',
      'darija' => 'Kanafficho variable dyal boucle ($fruit), machi tableau kamel ($fruits).',
    ),
    3 => 
    array (
      'wrong' => 'break placé à l\'extérieur d\'une boucle ou d\'un switch',
      'fix' => 'Placer break dans la boucle, avec une condition claire.',
      'fr' => '<code>break</code> ne peut sortir que d\'une boucle ou d\'un <code>switch</code>. Mal placé, il provoque une erreur de syntaxe.',
      'darija' => '<code>break</code> katkhrej ghir men boucle wla <code>switch</code>. Ila kan f blasa ghalta, kay3ti erreur.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>while</strong> répète tant qu\'une condition est vraie, <strong>for</strong> compte les répétitions (initialisation ; condition ; incrément), <strong>foreach</strong> parcourt les tableaux, et <strong>do...while</strong> exécute au moins une fois. <strong>break</strong> sort de la boucle, <strong>continue</strong> saute un tour. N\'oubliez jamais de faire évoluer la variable de condition.',
    'darija' => '<strong>while</strong> kat3awed ma dam condition vraie, <strong>for</strong> kat3ed répétitions (initialisation ; condition ; incrément), <strong>foreach</strong> katdour 3la tableaux, w <strong>do...while</strong> katnffed marra 3la l9al. <strong>break</strong> katkhrej men boucle, <strong>continue</strong> katqbez tour. Ma tensach tbeddel variable dyal condition.',
  ),
);
