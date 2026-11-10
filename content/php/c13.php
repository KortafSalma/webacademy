<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c13.json
 */

return array (
  'id' => 'php-ch13',
  'title' => 'Gestion des erreurs',
  'subtitle' => 'Détecter, comprendre et corriger les problèmes',
  'objectives' => 
  array (
    0 => 'Distinguer les types d\'erreurs PHP.',
    1 => 'Afficher les erreurs en développement et les journaliser en production.',
    2 => 'Lever et intercepter des exceptions avec try / catch.',
    3 => 'Utiliser finally et les exceptions personnalisées.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'types-erreurs',
      'title' => 'Les types d\'erreurs',
      'icon' => '⚠️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>PHP distingue plusieurs niveaux : <strong>notice</strong> (remarque, ex. variable non définie), <strong>warning</strong> (avertissement, le script continue), <strong>fatal error</strong> (le script s\'arrête). Depuis PHP 8, beaucoup d\'erreurs sont levées sous forme d\'<code>Error</code> ou d\'<code>Exception</code>.</p>',
          'darija' => '<p>PHP kayfarre9 bin bzaf niveaux : <strong>notice</strong> (remarque, ex. variable ma m3erfach), <strong>warning</strong> (avertissement, script kaykml), <strong>fatal error</strong> (script kay7bess). Men PHP 8, bzaf erreurs kaytle3o b7al <code>Error</code> wla <code>Exception</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Niveau',
            1 => 'Le script continue ?',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Notice',
              1 => 'oui',
              2 => 'variable non définie (PHP 7)',
            ),
            1 => 
            array (
              0 => 'Warning',
              1 => 'oui',
              2 => 'fichier introuvable',
            ),
            2 => 
            array (
              0 => 'Fatal error',
              1 => 'non',
              2 => 'appel d\'une fonction inexistante',
            ),
            3 => 
            array (
              0 => 'Exception',
              1 => 'non (si non capturée)',
              2 => 'throw new Exception(...)',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Une erreur contrôlée',
          'lang' => 'php',
          'code' => '<?php
$age = "vingt";

if (!is_numeric($age)) {
    echo "Erreur : l\'âge doit être un nombre.";
} else {
    echo "Âge valide : " . $age;
}
?>',
          'output' => 'Erreur : l\'âge doit être un nombre.',
          'explainFr' => 'On vérifie la donnée avant de l\'utiliser. C\'est la première ligne de défense : éviter l\'erreur plutôt que la gérer après coup.',
          'explainDarija' => 'Kant7eqqo données qbel ma n3awdo nkhdmo biha. Hadi lawla ligne dyal défense : njenbo erreur qbel ma tq3.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Développement vs production',
          'fr' => 'En local : <code>display_errors = On</code> pour voir les erreurs. En production : <code>display_errors = Off</code> et <code>log_errors = On</code> pour ne pas révéler de détails aux visiteurs.',
          'darija' => 'F local : <code>display_errors = On</code> bach tchof erreurs. F production : <code>display_errors = Off</code> w <code>log_errors = On</code> bach ma tchherch détails l visiteurs.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'try-catch',
      'title' => 'try / catch / finally',
      'icon' => '🧯',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>exception</strong> est un objet qui signale un problème. On la <strong>lance</strong> avec <code>throw</code> et on la <strong>capture</strong> avec <code>try / catch</code>. Le bloc <code>finally</code> s\'exécute toujours, qu\'il y ait eu erreur ou non.</p>',
          'darija' => '<p><strong>Exception</strong> hiya objet kay3len 3la mochkil. Kantlqoha b <code>throw</code> w kant7ekmo fiha b <code>try / catch</code>. Bloc <code>finally</code> kaynffed dima, wach kan erreur wla la.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe',
          'code' => 'try {
    // code risqué
} catch (Exception $e) {
    // traitement de l\'erreur
} finally {
    // nettoyage, toujours exécuté
}',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Division protégée',
          'lang' => 'php',
          'code' => '<?php
function diviser($a, $b) {
    if ($b == 0) {
        throw new Exception("Division par zéro impossible");
    }
    return $a / $b;
}

try {
    echo diviser(10, 2) . "<br>";
    echo diviser(5, 0);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    echo "<br>Calcul terminé.";
}
?>',
          'output' => '5<br>Erreur : Division par zéro impossible<br>Calcul terminé.',
          'explainFr' => 'Le premier appel réussit. Le second lève une exception, capturée par <code>catch</code> : le script continue proprement au lieu de planter.',
          'explainDarija' => 'Appel lwel njah. Tani kaylqe exception, li <code>catch</code> kaychedha : script kaykml b chkel mzyan blast ma yt7et.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Ne pas avaler les exceptions',
          'fr' => 'Un <code>catch</code> vide masque le problème : le bug continue en silence. Affichez un message en développement ou journalisez avec <code>error_log($e->getMessage())</code>.',
          'darija' => '<code>catch</code> khawi kaykhbi mochkil : bug kaybqa bla ma yban. 3red message f développement wla journalisi b <code>error_log($e->getMessage())</code>.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'exceptions-personnalisees',
      'title' => 'Exceptions personnalisées',
      'icon' => '🏷️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Pour un projet réel, on crée des exceptions dédiées : <code>ValidationException</code>, <code>NotFoundException</code>… Cela permet de réagir différemment selon le type d\'erreur et de rendre le code plus expressif.</p>',
          'darija' => '<p>Projet 7aqiqi, kankhalqo exceptions khass : <code>ValidationException</code>, <code>NotFoundException</code>… Hakka kanrdo b chkel mokhtalef 3la 7sab type d\'erreur w code kaywli wad7.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Exception de validation',
          'lang' => 'php',
          'code' => '<?php
class ValidationException extends Exception {}

function verifierEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new ValidationException("Email invalide : " . $email);
    }
    return true;
}

try {
    verifierEmail("pas-un-email");
} catch (ValidationException $e) {
    echo "Formulaire refusé : " . $e->getMessage();
}
?>',
          'output' => 'Formulaire refusé : Email invalide : pas-un-email',
          'explainFr' => '<code>filter_var</code> avec <code>FILTER_VALIDATE_EMAIL</code> valide le format. L\'exception personnalisée permet d\'identifier précisément la nature du problème.',
          'explainDarija' => '<code>filter_var</code> m3a <code>FILTER_VALIDATE_EMAIL</code> katvalidi format. Exception khassa katkhalli t3ref b dqiq nature dyal mochkil.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'try { ... } catch (Exception $e) { }',
      'fix' => 'Journaliser ou afficher : error_log($e->getMessage());',
      'fr' => 'Un catch vide cache l\'erreur et rend le débogage impossible.',
      'darija' => 'Catch khawi kaykhbi erreur w kay3qel debug.',
    ),
    1 => 
    array (
      'wrong' => 'Afficher les erreurs détaillées en production',
      'fix' => 'display_errors = Off et log_errors = On en production.',
      'fr' => 'Les messages d\'erreur peuvent révéler des chemins, des requêtes SQL ou des données sensibles.',
      'darija' => 'Messages d\'erreur y9dro ychhro chemins, requêtes SQL wla données sensibles.',
    ),
    2 => 
    array (
      'wrong' => 'throw "Erreur";',
      'fix' => 'throw new Exception("Erreur");',
      'fr' => 'On ne lance que des objets qui étendent <code>Throwable</code> : une chaîne provoque une erreur fatale.',
      'darija' => 'Kantlqo ghir objets li kay extendiw <code>Throwable</code> : chaîne kat3ti erreur fatale.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'PHP signale les problèmes par des <strong>notices</strong>, <strong>warnings</strong> et <strong>fatal errors</strong>. En production, on masque les détails et on journalise. Les <strong>exceptions</strong> se lancent avec <code>throw</code> et se capturent avec <code>try / catch</code> ; <code>finally</code> s\'exécute toujours. Créez des exceptions dédiées pour un code clair.',
    'darija' => 'PHP kay3len problèmes b <strong>notices</strong>, <strong>warnings</strong> w <strong>fatal errors</strong>. F production, kankhbio détails w kandir journalisation. <strong>Exceptions</strong> kattlqaw b <code>throw</code> w katt7ekmo b <code>try / catch</code> ; <code>finally</code> kaynffed dima. Khlq exceptions khassa bach code ykon wad7.',
  ),
);
