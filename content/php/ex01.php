<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex01.php
 */

return array (
  'id' => 'php-ex1',
  'title' => 'Introduction à PHP',
  'brief' => 'Écrire ses premiers scripts PHP et afficher du texte.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — premier echo',
      'lang' => 'php',
      'instructions' => '<p>Écris un script PHP qui affiche exactement <code>Bonjour WebAcademy</code>.</p>',
      'instructionsDarija' => '<p>Kteb script PHP li kay3red b dqiq <code>Bonjour WebAcademy</code>.</p>',
      'starter' => '<?php

// Affiche le message
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Bonjour WebAcademy',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un fichier PHP commence par la balise <?php.',
        1 => 'La commande d\'affichage est echo.',
        2 => 'Le point-virgule termine l\'instruction.',
      ),
      'solution' => '<?php
echo "Bonjour WebAcademy";
?>',
      'explainFr' => 'Le serveur exécute <code>echo</code> et envoie le texte au navigateur. Sans point-virgule, PHP signale une erreur de syntaxe.',
      'explainDarija' => 'Serveur kaynffed <code>echo</code> w kaysift texte l navigateur. Bla point-virgule, PHP kay3ti erreur de syntaxe.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — HTML et PHP',
      'lang' => 'php',
      'instructions' => '<p>Affiche un titre HTML <code>h1</code> contenant <code>Bienvenue</code>, puis un paragraphe contenant <code>J\'apprends PHP</code>.</p>',
      'instructionsDarija' => '<p>3red titre HTML <code>h1</code> fih <code>Bienvenue</code>, men ba3d paragraphe fih <code>J\'apprends PHP</code>.</p>',
      'starter' => '<?php
// Affiche un titre puis un paragraphe
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => '<h1>Bienvenue</h1>',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'J\'apprends PHP',
        ),
      ),
      'hints' => 
      array (
        0 => 'PHP peut générer du HTML avec echo.',
        1 => 'Échappe les apostrophes avec des guillemets doubles.',
        2 => 'Chaque echo se termine par un point-virgule.',
      ),
      'solution' => '<?php
echo "<h1>Bienvenue</h1>";
echo "<p>J\'apprends PHP</p>";
?>',
      'explainFr' => 'PHP produit du HTML que le navigateur interprète : le titre est reconnu comme un vrai <code>h1</code>, pas comme du texte brut.',
      'explainDarija' => 'PHP kayproduit HTML li navigateur kayfhem : titre kayt3ref b7al <code>h1</code> 7aqiqi, machi texte 3adi.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — plusieurs lignes et commentaires',
      'lang' => 'php',
      'instructions' => '<p>Affiche <code>Ligne 1</code> puis <code>Ligne 2</code> sur deux lignes HTML séparées par <code>&lt;br&gt;</code>. Ajoute un commentaire PHP dans le script.</p>',
      'instructionsDarija' => '<p>3red <code>Ligne 1</code> men ba3d <code>Ligne 2</code> 3la jouj lignes HTML mfreqin b <code>&lt;br&gt;</code>. Zid commentaire PHP f script.</p>',
      'starter' => '<?php
// Ton commentaire
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Ligne 1',
        ),
        1 => 
        array (
          'type' => 'output_contains',
          'value' => 'Ligne 2',
        ),
        2 => 
        array (
          'type' => 'output_contains',
          'value' => '<br>',
        ),
      ),
      'hints' => 
      array (
        0 => 'Un commentaire PHP s\'écrit // ou /* ... */.',
        1 => 'La balise <br> force un retour à la ligne dans le navigateur.',
        2 => 'Tu peux enchaîner plusieurs echo.',
      ),
      'solution' => '<?php
// Deux lignes séparées
echo "Ligne 1<br>";
echo "Ligne 2";
?>',
      'explainFr' => 'Le commentaire est ignoré à l\'exécution. Les deux <code>echo</code> envoient leur texte dans l\'ordre, et <code>&lt;br&gt;</code> crée la coupure visuelle.',
      'explainDarija' => 'Commentaire kaytjahl f exécution. Jouj <code>echo</code> kaysifto texte b tartib, w <code>&lt;br&gt;</code> kay5leq l9ta visuelle.',
    ),
  ),
);
