<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex02.php
 */

return array (
  'id' => 'php-ex2',
  'title' => 'Variables et constantes',
  'brief' => 'Déclarer des variables, définir des constantes et comprendre la portée.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — déclarer et afficher',
      'lang' => 'php',
      'instructions' => '<p>Déclare une variable <code>$couleur</code> valant <code>rouge</code>, puis affiche <code>Couleur : rouge</code>.</p>',
      'instructionsDarija' => '<p>3len variable <code>$couleur</code> b valeur <code>rouge</code>, men ba3d 3red <code>Couleur : rouge</code>.</p>',
      'starter' => '<?php
$couleur = "rouge";

// Affiche la couleur
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Couleur : rouge',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une variable PHP commence par $.',
        1 => 'La valeur texte s\'écrit entre guillemets.',
        2 => 'Concatène le libellé et la variable avec un point.',
      ),
      'solution' => '<?php
$couleur = "rouge";

echo "Couleur : " . $couleur;',
      'explainFr' => 'La variable <code>$couleur</code> stocke la chaîne « rouge ». <code>echo</code> envoie le texte concaténé au navigateur.',
      'explainDarija' => 'Variable <code>$couleur</code> katkhzen chaîne « rouge ». <code>echo</code> kaysift texte m3a valeur l navigateur.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — constante et superglobale',
      'lang' => 'php',
      'instructions' => '<p>Définis une constante <code>SITE_NAME</code> valant <code>MonSite</code>, lis <code>$_POST[\'username\']</code> avec une valeur par défaut <code>Invité</code>, puis affiche <code>Bienvenue Invité sur MonSite</code>.</p>',
      'instructionsDarija' => '<p>3len constante <code>SITE_NAME</code> b valeur <code>MonSite</code>, qra <code>$_POST[\'username\']</code> b valeur par défaut <code>Invité</code>, men ba3d 3red <code>Bienvenue Invité sur MonSite</code>.</p>',
      'starter' => '<?php
define("SITE_NAME", "MonSite");

// Lis le champ puis affiche
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Bienvenue Invité sur MonSite',
        ),
      ),
      'hints' => 
      array (
        0 => 'define("SITE_NAME", "MonSite") crée la constante.',
        1 => 'L\'opérateur ?? fournit « Invité » si le champ manque.',
        2 => 'Une constante s\'utilise sans le symbole $.',
      ),
      'solution' => '<?php
define("SITE_NAME", "MonSite");

$username = $_POST[\'username\'] ?? \'Invité\';
echo "Bienvenue " . $username . " sur " . SITE_NAME;',
      'explainFr' => 'La constante <code>SITE_NAME</code> reste disponible dans tout le script. <code>$_POST</code> est vide dans cet exemple, donc <code>??</code> fournit la valeur par défaut.',
      'explainDarija' => 'Constante <code>SITE_NAME</code> katbqa disponible f script kamel. <code>$_POST</code> khawi f had exemple, donc <code>??</code> kay3ti valeur par défaut.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — portée et superglobales',
      'lang' => 'php',
      'instructions' => '<p>Définis <code>$compteur = 5</code>. Dans une fonction <code>direBonjour()</code>, utilise <code>global $compteur</code> et affiche <code>Bonjour - 5</code>. Lis ensuite <code>$_GET[\'page\']</code> avec la valeur par défaut <code>accueil</code> et affiche <code>Page : accueil</code>.</p>',
      'instructionsDarija' => '<p>3len <code>$compteur = 5</code>. F fonction <code>direBonjour()</code>, khdem b <code>global $compteur</code> w 3red <code>Bonjour - 5</code>. Men ba3d qra <code>$_GET[\'page\']</code> b valeur par défaut <code>accueil</code> w 3red <code>Page : accueil</code>.</p>',
      'starter' => '<?php
$compteur = 5;

function direBonjour() {
    // portée globale
}

// Page demandée
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Bonjour - 5',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Page : accueil',
        ),
      ),
      'hints' => 
      array (
        0 => 'global $compteur importe la variable dans la fonction.',
        1 => '$_GET[\'page\'] ?? \'accueil\' gère l\'absence de paramètre.',
        2 => 'Appelle la fonction avant d\'afficher la page.',
      ),
      'solution' => '<?php
$compteur = 5;

function direBonjour() {
    global $compteur;
    $message = "Bonjour";
    echo $message . " - " . $compteur;
}

direBonjour();

$page = $_GET[\'page\'] ?? \'accueil\';
echo " | Page : " . $page;',
      'explainFr' => 'Sans <code>global</code>, la fonction ne verrait pas <code>$compteur</code>. La superglobale <code>$_GET</code> reste accessible partout et l\'opérateur <code>??</code> évite une erreur si le paramètre manque.',
      'explainDarija' => 'Bla <code>global</code>, fonction ma katchefch <code>$compteur</code>. Superglobale <code>$_GET</code> katbqa accessible f kol blasa w <code>??</code> kaymna3 erreur ila paramètre ma kanch.',
    ),
  ),
);
