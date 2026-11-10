<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex13.php
 */

return array (
  'id' => 'php-ex13',
  'title' => 'Gestion des erreurs',
  'brief' => 'Intercepter les exceptions et afficher des messages utiles.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — try / catch',
      'lang' => 'php',
      'instructions' => '<p>Lance une exception avec le message <code>Stock insuffisant</code> dans un bloc <code>try</code>, intercepte-la dans un <code>catch</code> et affiche <code>Erreur : Stock insuffisant</code>.</p>',
      'instructionsDarija' => '<p>3len exception b message <code>Stock insuffisant</code> f bloc <code>try</code>, qbda f <code>catch</code> w 3red <code>Erreur : Stock insuffisant</code>.</p>',
      'starter' => '<?php
// try / catch
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Erreur : Stock insuffisant',
        ),
      ),
      'hints' => 
      array (
        0 => 'throw new Exception("message") lance une exception.',
        1 => 'catch (Exception $e) l\'intercepte.',
        2 => '$e->getMessage() renvoie le message.',
      ),
      'solution' => '<?php
try {
    throw new Exception("Stock insuffisant");
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>',
      'explainFr' => 'Sans <code>catch</code>, l\'exception non gérée arrêterait le script. Le bloc <code>catch</code> permet de réagir proprement et d\'afficher un message compréhensible.',
      'explainDarija' => 'Bla <code>catch</code>, exception ma m7ekma katweqqef script. Bloc <code>catch</code> kaykhalli n3awdo n3mlo 7aja mzyana w n3red message mfhoum.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — DivisionByZeroError',
      'lang' => 'php',
      'instructions' => '<p>Dans un <code>try</code>, tente de calculer <code>10 / 0</code>. Intercepte <code>DivisionByZeroError</code> et affiche <code>Division impossible</code>.</p>',
      'instructionsDarija' => '<p>F <code>try</code>, 7awel t7seb <code>10 / 0</code>. Qbda <code>DivisionByZeroError</code> w 3red <code>Division impossible</code>.</p>',
      'starter' => '<?php
// Division protégée
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Division impossible',
        ),
      ),
      'hints' => 
      array (
        0 => 'PHP 8 lève DivisionByZeroError pour une division par zéro.',
        1 => 'Le catch doit viser le bon type d\'erreur.',
        2 => 'Aucun résultat ne doit s\'afficher si la division échoue.',
      ),
      'solution' => '<?php
try {
    $resultat = 10 / 0;
    echo $resultat;
} catch (DivisionByZeroError $e) {
    echo "Division impossible";
}
?>',
      'explainFr' => '<code>DivisionByZeroError</code> est une erreur native de PHP 8. L\'intercepter évite un arrêt brutal et permet d\'afficher un message adapté à l\'utilisateur.',
      'explainDarija' => '<code>DivisionByZeroError</code> erreur native f PHP 8. Interception dyalha kaymna3 weqqfa 3anifa w kaykhalli n3red message mnasb l utilisateur.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — exception personnalisée et finally',
      'lang' => 'php',
      'instructions' => '<p>Crée une classe <code>StockException</code> qui étend <code>Exception</code>. Lance-la avec <code>Rupture de stock</code>, intercepte-la et affiche <code>Alerte : Rupture de stock</code>. Ajoute un bloc <code>finally</code> qui affiche <code>Fin du traitement</code>.</p>',
      'instructionsDarija' => '<p>5leq classe <code>StockException</code> li kattmed <code>Exception</code>. 3lenha b <code>Rupture de stock</code>, qbdaha w 3red <code>Alerte : Rupture de stock</code>. Zid bloc <code>finally</code> li kay3red <code>Fin du traitement</code>.</p>',
      'starter' => '<?php
// Exception personnalisée
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Alerte : Rupture de stock',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Fin du traitement',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une exception personnalisée étend Exception.',
        1 => 'catch peut cibler la classe précise.',
        2 => 'finally s\'exécute dans tous les cas.',
      ),
      'solution' => '<?php
class StockException extends Exception {}

try {
    throw new StockException("Rupture de stock");
} catch (StockException $e) {
    echo "Alerte : " . $e->getMessage() . "<br>";
} finally {
    echo "Fin du traitement";
}
?>',
      'explainFr' => 'La classe personnalisée permet d\'identifier clairement le type de problème. <code>finally</code> s\'exécute que l\'exception soit levée ou non : idéal pour libérer une ressource.',
      'explainDarija' => 'Classe personnalisée kat3aref b wad7 type dyal mochkil. <code>finally</code> kaytnffed wach exception tle3at wla la : mzyan bach t7rer ressource.',
    ),
  ),
);
