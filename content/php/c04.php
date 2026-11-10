<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c04.json
 */

return array (
  'id' => 'php-ch4',
  'title' => 'Conditions',
  'subtitle' => 'Prendre des décisions dans le code',
  'objectives' => 
  array (
    0 => 'Utiliser la structure if / else simple.',
    1 => 'Comprendre elseif pour chaîner plusieurs conditions.',
    2 => 'Combiner des conditions avec les opérateurs logiques (&&, ||, !).',
    3 => 'Utiliser switch pour les choix multiples sur une même variable.',
    4 => 'Écrire des conditions courtes avec l\'opérateur ternaire.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'if-simple',
      'title' => 'if / else simple',
      'icon' => '🔀',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La structure <strong>if / else</strong> exécute du code seulement si une condition est vraie. Si elle est fausse, c\'est le bloc <code>else</code> qui s\'exécute.</p>',
          'darija' => '<p>Structure <strong>if / else</strong> katnffed code ghir ila condition vraie. Ila kanet fausse, kaynffed bloc <code>else</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe if / else',
          'code' => 'if ($age >= 18) {
    echo "Vous êtes majeur.";
} else {
    echo "Vous êtes mineur.";
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Vérifier l\'âge d\'un visiteur',
          'lang' => 'php',
          'code' => '<?php
$age = 20;

if ($age >= 18) {
    echo "Vous êtes majeur.";
} else {
    echo "Vous êtes mineur.";
}
?>',
          'preview' => true,
          'explainFr' => '$age vaut 20, donc la condition <code>$age >= 18</code> est vraie : le script affiche « Vous êtes majeur. ».',
          'explainDarija' => '$age fih 20, donc condition vraie : script kaytbra « Vous êtes majeur. ».',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Les accolades sont obligatoires ?',
          'fr' => 'Pour une seule instruction, PHP accepte <code>if ($x) echo $x;</code> sans accolades. Mais <strong>écrivez toujours les accolades</strong> : c\'est plus lisible et ça évite un bug quand vous ajoutez une deuxième ligne.',
          'darija' => 'Ila 3andek ghir instruction wa7da, PHP kayqbel bla accolades. Walakin dima kteb <code>{ }</code> : kaytqra mzyan w kaymna3 les bugs melli tzid ligne jdida.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'elseif',
      'title' => 'elseif : plusieurs cas',
      'icon' => '🪜',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>elseif</strong> permet de tester une nouvelle condition si la précédente était fausse. PHP teste les conditions <em>dans l\'ordre</em> et s\'arrête à la première qui est vraie.</p>',
          'darija' => '<p><strong>elseif</strong> kaytesti condition jdida ila li qbelha kanet fausse. PHP kaytesti b tartib w kay7bes 3la lawla li katkon vraie.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Chaîne de conditions',
          'code' => 'if ($note >= 16) {
    echo "Excellent";
} elseif ($note >= 12) {
    echo "Bien";
} elseif ($note >= 10) {
    echo "Passable";
} else {
    echo "Insuffisant";
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Attribuer une mention',
          'lang' => 'php',
          'code' => '<?php
$note = 14;

if ($note >= 16) {
    echo "Excellent";
} elseif ($note >= 12) {
    echo "Bien";
} elseif ($note >= 10) {
    echo "Passable";
} else {
    echo "Insuffisant";
}
?>',
          'preview' => true,
          'explainFr' => '14 n\'est pas ≥ 16, mais il est ≥ 12 : PHP s\'arrête là et affiche « Bien ». Les <code>elseif</code> suivants ne sont jamais testés.',
          'explainDarija' => '14 machi ≥ 16, walakin ≥ 12 : PHP kay7bes w kaytbra « Bien ». Les elseif li mora ma-ytesterch.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'conditions-logiques',
      'title' => 'Opérateurs logiques',
      'icon' => '🔗',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>On combine plusieurs conditions avec <code>&amp;&amp;</code> (et), <code>||</code> (ou) et <code>!</code> (non).</p>',
          'darija' => '<p>Kanjem3o les conditions b <code>&amp;&amp;</code> (w), <code>||</code> (wla) w <code>!</code> (machi).</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Opérateur',
            1 => 'Nom',
            2 => 'Vrai quand…',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '&&',
              1 => 'ET',
              2 => 'les deux conditions sont vraies',
            ),
            1 => 
            array (
              0 => '||',
              1 => 'OU',
              2 => 'au moins une condition est vraie',
            ),
            2 => 
            array (
              0 => '!',
              1 => 'NON',
              2 => 'la condition est fausse',
            ),
          ),
          'fr' => 'Exemple : <code>if ($age >= 18 &amp;&amp; $permis)</code> ne passe que si le visiteur est majeur <em>et</em> possède un permis.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Conduire : âge + permis',
          'lang' => 'php',
          'code' => '<?php
$age = 20;
$permis = true;

if ($age >= 18 && $permis) {
    echo "Vous pouvez conduire.";
} else {
    echo "Conduite interdite.";
}
?>',
          'preview' => true,
          'explainFr' => 'Les deux conditions sont vraies (20 ≥ 18 et permis = true) : le message autorise la conduite.',
          'explainDarija' => 'Jouj conditions vraies (20 ≥ 18 w permis = true) : message kaygol tqder tsou9.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => '= n\'est pas ==',
          'fr' => 'Dans une condition, <code>=</code> <strong>affecte</strong> une valeur et <code>==</code> / <code>===</code> <strong>comparent</strong>. <code>if ($a = 5)</code> est toujours vrai : utilisez <code>if ($a === 5)</code>.',
          'darija' => '<code>=</code> kay3ti valeur, <code>==</code> w <code>===</code> kayqarno. <code>if ($a = 5)</code> dima vraie : kteb <code>if ($a === 5)</code>.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'switch',
      'title' => 'switch : choix multiples',
      'icon' => '🎛️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>switch</strong> compare une même variable à plusieurs valeurs. Chaque <code>case</code> se termine par <code>break</code> pour arrêter l\'exécution ; <code>default</code> gère tous les autres cas.</p>',
          'darija' => '<p><strong>switch</strong> kayqaren nefs variable m3a bzaf dyal valeurs. Kol <code>case</code> khas ykml b <code>break</code>; <code>default</code> kayakhod les cas li baqyin.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe switch',
          'code' => 'switch ($jour) {
    case "lundi":
        echo "Début de semaine";
        break;
    case "vendredi":
        echo "Fin de semaine";
        break;
    default:
        echo "Autre jour";
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Afficher le type de journée',
          'lang' => 'php',
          'code' => '<?php
$jour = "samedi";

switch ($jour) {
    case "lundi":
    case "mardi":
    case "mercredi":
    case "jeudi":
    case "vendredi":
        echo "Jour de travail";
        break;
    case "samedi":
    case "dimanche":
        echo "Week-end !";
        break;
    default:
        echo "Jour inconnu";
}
?>',
          'preview' => true,
          'explainFr' => 'Plusieurs <code>case</code> peuvent partager le même bloc. Ici « samedi » tombe sur « Week-end ! ».',
          'explainDarija' => 'Bzaf dyal case y9dro ychedo nefs bloc. Hna « samedi » kaydakhl f « Week-end ! ».',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Oublier break',
          'fr' => 'Sans <code>break</code>, PHP continue dans le <code>case</code> suivant : c\'est le <em>fall-through</em>. Ça peut être volontaire, mais la plupart du temps c\'est un bug.',
          'darija' => 'Bla <code>break</code>, PHP kaykml f case li mora : smitha fall-through. Merrat kaykon 3mad, walakin ghaliban bug.',
        ),
      ),
    ),
    4 => 
    array (
      'id' => 'ternaire',
      'title' => 'Opérateur ternaire',
      'icon' => '⚡',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le ternaire <code>condition ? si_vrai : si_faux</code> est une écriture courte d\'un <code>if / else</code> qui renvoie une valeur. À réserver aux conditions simples.</p>',
          'darija' => '<p>Ternaire <code>condition ? si_vrai : si_faux</code> hiya écriture qsira dyal <code>if / else</code> li kayrje3 valeur. Khdma ghir m3a conditions sahla.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Mention courte',
          'lang' => 'php',
          'code' => '<?php
$note = 15;
$mention = ($note >= 10) ? "Admis" : "Recalé";
echo $mention;
?>',
          'preview' => true,
          'explainFr' => '$note vaut 15, la condition est vraie : $mention reçoit « Admis » et echo l\'affiche.',
          'explainDarija' => '$note fih 15, condition vraie : $mention yakhod « Admis » w echo kaytbraha.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Ne pas imbriquer trop de ternaires',
          'fr' => 'Un ternaire dans un autre ternaire devient illisible. Au-delà de deux cas, revenez à <code>if / elseif</code> ou à <code>switch</code>.',
          'darija' => 'Ternaire f dakhel ternaire kaywli s3ib lqraya. Ila 3andek ktar men jouj cas, rje3 l <code>if / elseif</code> wla <code>switch</code>.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'if ($age = 18) { ... }',
      'fix' => 'if ($age == 18) { ... } ou if ($age === 18) { ... }',
      'fr' => 'Utiliser <code>=</code> au lieu de <code>==</code> : la condition affecte 18 à $age et devient toujours vraie.',
      'darija' => 'Ila ktebti <code>=</code> blast <code>==</code> : condition kate3ti 18 l $age w katwli dima vraie.',
    ),
    1 => 
    array (
      'wrong' => 'Oublier le break dans un switch',
      'fix' => 'Ajouter break; à la fin de chaque case (sauf fall-through volontaire).',
      'fr' => 'Sans <code>break</code>, PHP exécute aussi les <code>case</code> suivants et affiche plusieurs messages.',
      'darija' => 'Bla <code>break</code>, PHP kaynffed 7ta les case li mora w kaytbra bzaf dyal messages.',
    ),
    2 => 
    array (
      'wrong' => 'if ($age >= 18 && $permis == true) sans parenthèses autour de chaque test',
      'fix' => 'if (($age >= 18) && ($permis === true))',
      'fr' => 'Les parenthèses clarifient la priorité des opérateurs et évitent les surprises avec <code>||</code> et <code>&amp;&amp;</code> mélangés.',
      'darija' => 'Les parenthèses kaywad7o l\'ordre w kaymna3o les erreurs melli tkhelt <code>||</code> m3a <code>&amp;&amp;</code>.',
    ),
    3 => 
    array (
      'wrong' => 'switch ($note) { case $note > 10: ... }',
      'fix' => 'switch compare des valeurs : utiliser if / elseif pour des comparaisons.',
      'fr' => '<code>switch</code> teste l\'égalité avec des valeurs fixes ; pour des intervalles, utilisez <code>if / elseif</code>.',
      'darija' => '<code>switch</code> kayqaren égalité m3a valeurs fixe ; l les intervalles khdem b <code>if / elseif</code>.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>if / else</strong> exécute un bloc selon une condition, <strong>elseif</strong> enchaîne plusieurs tests dans l\'ordre, les opérateurs <strong>&amp;&amp;</strong>, <strong>||</strong> et <strong>!</strong> combinent les conditions, <strong>switch</strong> choisit parmi plusieurs valeurs (avec <code>break</code> !) et le <strong>ternaire</strong> écrit une condition courte. Attention : <code>==</code> compare, <code>=</code> affecte.',
    'darija' => '<strong>if / else</strong> kaynffed bloc 3la 7sab condition, <strong>elseif</strong> kayzid tests b tartib, <strong>&amp;&amp;</strong>, <strong>||</strong> w <strong>!</strong> kayjem3o les conditions, <strong>switch</strong> kaykhtar men bzaf valeurs (m3a <code>break</code> !) w <strong>ternaire</strong> kaykteb condition qsira. 3ndak: <code>==</code> kayqaren, <code>=</code> kay3ti.',
  ),
);
