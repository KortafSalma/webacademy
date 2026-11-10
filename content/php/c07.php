<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c07.json
 */

return array (
  'id' => 'php-ch7',
  'title' => 'Fonctions',
  'subtitle' => 'Regrouper le code réutilisable dans des blocs nommés',
  'objectives' => 
  array (
    0 => 'Définir et appeler une fonction.',
    1 => 'Utiliser des paramètres et retourner une valeur avec return.',
    2 => 'Comprendre la portée des variables.',
    3 => 'Donner des valeurs par défaut aux paramètres.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'definition-appel',
      'title' => 'Définir et appeler une fonction',
      'icon' => '🧩',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>fonction</strong> est un bloc de code nommé que l\'on peut appeler autant de fois que nécessaire. Elle évite la duplication et rend le programme plus lisible. En PHP, on la définit avec le mot-clé <code>function</code>.</p>',
          'darija' => '<p><strong>Fonction</strong> hiya bloc dyal code 3ndo smiya, t9der t3ayet 3lih bzaf dyal merrat. Katmna3 tkrar w katwadde7 programme. F PHP kantsayboha b kelmet <code>function</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe',
          'code' => 'function saluer() {
    echo "Salam !";
}

saluer(); // appel',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Une fonction, trois appels',
          'lang' => 'php',
          'code' => '<?php
function afficherLigne() {
    echo "--------------------<br>";
}

echo "Titre<br>";
afficherLigne();
echo "Sous-titre<br>";
afficherLigne();
echo "Fin<br>";
afficherLigne();
?>',
          'output' => 'Titre<br>--------------------<br>Sous-titre<br>--------------------<br>Fin<br>--------------------<br>',
          'explainFr' => 'La fonction est définie une seule fois puis appelée trois fois. Le code de la ligne ne se répète pas : c\'est le principe DRY (Don\'t Repeat Yourself).',
          'explainDarija' => 'Fonction m3erfa marra wa7da w m3ayta 3liha 3 merrat. Code dyal ligne ma t3awedch : hada howa principe DRY.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'parametres-return',
      'title' => 'Paramètres et return',
      'icon' => '📥',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les <strong>paramètres</strong> sont les valeurs que la fonction reçoit. <strong>return</strong> renvoie un résultat à l\'appelant et <em>arrête immédiatement</em> l\'exécution de la fonction.</p>',
          'darija' => '<p><strong>Paramètres</strong> homa valeurs li katakhod fonction. <strong>return</strong> katrje3 résultat l li 3ayet 3liha w kat7bess exécution dyal fonction nichan.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe avec paramètres',
          'code' => 'function additionner($a, $b) {
    return $a + $b;
}

$total = additionner(10, 5); // 15',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Calculs réutilisables',
          'lang' => 'php',
          'code' => '<?php
function additionner($a, $b) {
    return $a + $b;
}

function moyenne($notes) {
    return array_sum($notes) / count($notes);
}

echo "10 + 5 = " . additionner(10, 5) . "<br>";
echo "Moyenne : " . moyenne([14, 16, 18]);
?>',
          'output' => '10 + 5 = 15<br>Moyenne : 16',
          'explainFr' => 'Chaque appel fournit ses propres arguments. <code>return</code> donne la valeur au code appelant, qui peut l\'afficher ou la stocker.',
          'explainDarija' => 'Kol appel kay3ti arguments dyalo. <code>return</code> kat3ti valeur l code li 3ayet, li y9der y3re dha wla ykhzenha.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'echo n\'est pas return',
          'fr' => '<code>echo</code> affiche pour l\'utilisateur ; <code>return</code> renvoie une valeur au programme. Une fonction qui fait seulement <code>echo</code> ne permet pas de réutiliser son résultat dans un calcul.',
          'darija' => '<code>echo</code> kat3red l utilisateur ; <code>return</code> katrje3 valeur l programme. Fonction li kat3mel ghir <code>echo</code> ma tqderch t3awed testa3mel résultat f calcul.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'portee-variables',
      'title' => 'Portée des variables',
      'icon' => '🔒',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une variable créée <strong>dans</strong> une fonction est <strong>locale</strong> : elle n\'existe pas à l\'extérieur. Inversement, une variable globale n\'est pas accessible dans la fonction sans le mot-clé <code>global</code> (à éviter) ou sans la passer en paramètre.</p>',
          'darija' => '<p>Variable li katkhleq <strong>dakhel</strong> fonction hiya <strong>locale</strong> : ma katkaynch bera. B l\'3aks, variable globale ma katwselch l fonction bla <code>global</code> (7sen tjennebha) wla bla ma t3addiha k paramètre.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Variable locale',
          'lang' => 'php',
          'code' => '<?php
function test() {
    $message = "Je suis locale";
    echo $message;
}

test();
echo isset($message) ? $message : "<br>La variable n\'existe pas dehors";
?>',
          'output' => 'Je suis locale<br>La variable n\'existe pas dehors',
          'explainFr' => 'La variable $message existe uniquement pendant l\'appel de <code>test()</code>. Après, elle est détruite : le code extérieur ne la voit pas.',
          'explainDarija' => '$message katkayn ghir wa9t appel dyal <code>test()</code>. Men ba3d kat7yed : code li bera ma kaychofhach.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Préférez les paramètres',
          'fr' => 'Au lieu d\'utiliser <code>global $x</code>, passez $x en paramètre et retournez le résultat. Le code devient testable et prévisible.',
          'darija' => 'Blast <code>global $x</code>, 3addi $x k paramètre w rje3 résultat. Code kaywli sahel t testih w mafhoum.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'valeurs-defaut',
      'title' => 'Valeurs par défaut et fonctions fléchées',
      'icon' => '🎛️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un paramètre peut avoir une <strong>valeur par défaut</strong>, utilisée quand l\'appelant ne fournit rien. Les fonctions <strong>fléchées</strong> (<code>fn</code>) offrent une écriture courte pour les petites opérations.</p>',
          'darija' => '<p>Paramètre y9der ykon 3ndo <strong>valeur par défaut</strong>, li katesta3mel melli l\'appelant ma kay3tich walou. Les <strong>fonctions fléchées</strong> (<code>fn</code>) kay3tiw écriture qsira l petites opérations.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Saluer avec un nom par défaut',
          'lang' => 'php',
          'code' => '<?php
function saluer($nom = "étudiant") {
    return "Salam " . $nom . " !";
}

echo saluer() . "<br>";
echo saluer("Amal");
?>',
          'output' => 'Salam étudiant !<br>Salam Amal !',
          'explainFr' => 'Sans argument, $nom vaut « étudiant ». Avec « Amal », la valeur par défaut est remplacée par l\'argument.',
          'explainDarija' => 'Bla argument, $nom katakhod « étudiant ». M3a « Amal », valeur par défaut katbeddelha b argument.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Fonction fléchée',
          'lang' => 'php',
          'code' => '<?php
$doubler = fn($n) => $n * 2;
$carres = array_map(fn($n) => $n * $n, [1, 2, 3, 4]);

echo $doubler(5) . "<br>";
echo implode(", ", $carres);
?>',
          'output' => '10<br>1, 4, 9, 16',
          'explainFr' => '<code>fn($n) =&gt; $n * 2</code> est une fonction anonyme courte. <code>array_map()</code> l\'applique à chaque élément du tableau.',
          'explainDarija' => '<code>fn($n) =&gt; $n * 2</code> hiya fonction anonyme qsira. <code>array_map()</code> katttbeqha 3la kol élément dyal tableau.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'function direBonjour { ... }',
      'fix' => 'function direBonjour() { ... }',
      'fr' => 'Les parenthèses sont obligatoires dans la déclaration, même sans paramètre.',
      'darija' => 'Parenthèses darouri f déclaration, 7ta ila ma kaynch paramètre.',
    ),
    1 => 
    array (
      'wrong' => 'echo additionner(2, 3); sans return dans la fonction',
      'fix' => 'function additionner($a, $b) { return $a + $b; }',
      'fr' => 'Sans <code>return</code>, la fonction renvoie <code>null</code> : l\'addition est perdue.',
      'darija' => 'Bla <code>return</code>, fonction katrje3 <code>null</code> : addition katdii3.',
    ),
    2 => 
    array (
      'wrong' => 'Utiliser une variable globale directement dans une fonction',
      'fix' => 'La passer en paramètre : function f($x) { ... }',
      'fr' => 'Une variable globale n\'est pas visible dans la fonction. Passez-la en paramètre plutôt que d\'utiliser <code>global</code>.',
      'darija' => 'Variable globale ma katbanch dakhel fonction. 3addiha k paramètre 7sen men <code>global</code>.',
    ),
    3 => 
    array (
      'wrong' => 'Appeler la fonction avant sa définition dans un contexte conditionnel',
      'fix' => 'Définir la fonction en haut du fichier, avant son premier appel.',
      'fr' => 'Les fonctions sont généralement hoistées, mais une définition conditionnelle peut ne pas exister au moment de l\'appel. Définissez en haut.',
      'darija' => 'Les fonctions ghaliban kayt3erfo 9bel, walakin définition conditionnelle t9der matkonch wa9t appel. 3errefha f lwel.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une <strong>fonction</strong> regroupe du code réutilisable. Elle reçoit des <strong>paramètres</strong>, exécute un bloc et renvoie un résultat avec <strong>return</strong>. Les variables internes sont <strong>locales</strong>. On peut prévoir des <strong>valeurs par défaut</strong> et écrire des fonctions <strong>fléchées</strong> avec <code>fn</code> pour les opérations courtes.',
    'darija' => '<strong>Fonction</strong> katjem3 code li kayt3awed. Katakhod <strong>paramètres</strong>, katnffed bloc w katrje3 résultat b <strong>return</strong>. Variables dakhliya <strong>locales</strong>. T9der t7et <strong>valeurs par défaut</strong> w tkteb fonctions <strong>fléchées</strong> b <code>fn</code> l opérations qsira.',
  ),
);
