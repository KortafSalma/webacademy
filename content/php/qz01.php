<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz01.php
 */

return array (
  'title' => 'Quiz — Introduction à PHP',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Où le code PHP est-il exécuté ?',
      'options' => 
      array (
        0 => 'Sur le serveur',
        1 => 'Dans le navigateur',
        2 => 'Dans la base de données',
      ),
      'answer' => 0,
      'concept' => 'Exécution serveur',
      'explainFr' => 'PHP est un langage serveur : le navigateur ne reçoit que le HTML produit.',
      'explainDarija' => 'PHP langage serveur : navigateur kayakhod ghir HTML li tproduit.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Un fichier PHP commence généralement par la balise <?php.',
      'answer' => 0,
      'concept' => 'Balise d\'ouverture',
      'explainFr' => 'Vrai : <code>&lt;?php</code> indique au serveur que le code PHP commence.',
      'explainDarija' => 'S7i7 : <code>&lt;?php</code> kay3lem serveur belli code PHP bda.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle commande affiche du texte en PHP ?',
      'options' => 
      array (
        0 => 'echo',
        1 => 'print_r uniquement',
        2 => 'display',
      ),
      'answer' => 0,
      'concept' => 'echo',
      'explainFr' => '<code>echo</code> envoie du texte vers la sortie HTML.',
      'explainDarija' => '<code>echo</code> kaysift texte l sortie HTML.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'L\'extension habituelle d\'un fichier PHP est .________.',
      'answer' => 'php',
      'concept' => 'Extension',
      'explainFr' => 'Un fichier <code>.php</code> est interprété par le serveur avant d\'être envoyé au navigateur.',
      'explainDarija' => 'Fichier <code>.php</code> kaytfsar b serveur qbel ma ytsift l navigateur.',
    ),
    4 => 
    array (
      'type' => 'multi',
      'question' => 'Que peut contenir un fichier PHP ?',
      'options' => 
      array (
        0 => 'du HTML',
        1 => 'du code PHP',
        2 => 'des commentaires',
        3 => 'du CSS directement exécuté par PHP',
      ),
      'answer' => 
      array (
        0 => 0,
        1 => 1,
        2 => 2,
      ),
      'concept' => 'Contenu d\'un fichier PHP',
      'explainFr' => 'Un fichier PHP peut mélanger HTML, PHP et commentaires ; le CSS est du texte envoyé au navigateur, pas exécuté par PHP.',
      'explainDarija' => 'Fichier PHP y9der ykhelt HTML, PHP w commentaires ; CSS texte li kaysift l navigateur, machi exécuté b PHP.',
    ),
  ),
);
