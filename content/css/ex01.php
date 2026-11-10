<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex01.php
 */

return array (
  'id' => 'css-ex1',
  'title' => 'Introduction à CSS',
  'brief' => 'Écrire ses premières règles CSS et comprendre la syntaxe sélecteur / propriété / valeur.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — ma première règle',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle CSS qui cible tous les titres <code>h1</code> et leur donne la couleur bleue avec <code>color: blue;</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle CSS li katcibli kol titres <code>h1</code> w kat3tihom loun zre9 b <code>color: blue;</code>.</p>',
      'starter' => '/* Votre règle CSS ici */',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'h1',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'color: blue',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le sélecteur est le nom de l\'élément ciblé : h1.',
        1 => 'Une déclaration s\'écrit propriété: valeur; entre accolades.',
        2 => 'N\'oublie pas le point-virgule après la valeur.',
      ),
      'solution' => 'h1 {
  color: blue;
}',
      'explainFr' => 'La règle se lit : « tous les éléments h1 reçoivent la couleur bleue ». Le sélecteur <code>h1</code> cible par type d\'élément.',
      'explainDarija' => 'Règle katqra : « kol éléments h1 kayakhdo loun zre9 ». Sélecteur <code>h1</code> kaycibli b type d\'élément.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — deux déclarations',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle qui cible tous les paragraphes <code>p</code> et leur donne : une couleur <code>#333333</code> et une taille de police de <code>18px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle li katcibli kol paragraphes <code>p</code> w kat3tihom : loun <code>#333333</code> w taille dyal police <code>18px</code>.</p>',
      'starter' => 'p {
  /* deux déclarations */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'p {',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'color: #333333',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'font-size: 18px',
        ),
      ),
      'hints' => 
      array (
        0 => 'Chaque déclaration se termine par un point-virgule.',
        1 => 'La propriété de taille de texte est font-size.',
        2 => 'La couleur hexadécimale commence par #.',
      ),
      'solution' => 'p {
  color: #333333;
  font-size: 18px;
}',
      'explainFr' => 'Un même sélecteur peut porter plusieurs déclarations. Elles s\'appliquent toutes aux éléments <code>p</code> de la page.',
      'explainDarija' => 'Nefs sélecteur y9der y7mel bzaf déclarations. Kollhom kaytbeqo 3la éléments <code>p</code> f page.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — groupe de sélecteurs et commentaire',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle qui cible <em>à la fois</em> <code>h1</code> et <code>h2</code> pour leur donner la couleur <code>navy</code>, puis une règle qui donne au <code>body</code> un fond <code>#f8fafc</code>. Ajoute un commentaire CSS au-dessus du groupe.</p>',
      'instructionsDarija' => '<p>Kteb règle li katcibli <em>f nefs lwa9t</em> <code>h1</code> w <code>h2</code> bach t3tihom loun <code>navy</code>, men ba3d règle li kat3ti l <code>body</code> fond <code>#f8fafc</code>. Zid commentaire CSS fo9 groupe.</p>',
      'starter' => '/* commentaire */
/* groupe de titres */

/* fond de page */',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'h1, h2',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'color: navy',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'background',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '/*',
        ),
      ),
      'hints' => 
      array (
        0 => 'On sépare les sélecteurs groupés par une virgule.',
        1 => 'Un commentaire CSS s\'écrit entre /* et */.',
        2 => 'La propriété de fond est background ou background-color.',
      ),
      'solution' => '/* Styles communs des titres */
h1, h2 {
  color: navy;
}

body {
  background: #f8fafc;
}',
      'explainFr' => 'La virgule signifie « ou » : la règle s\'applique aux <code>h1</code> et aux <code>h2</code>. Le commentaire n\'est pas exécuté, il documente l\'intention.',
      'explainDarija' => 'Virgule kat3ni « wla » : règle kattbeq 3la <code>h1</code> w <code>h2</code>. Commentaire ma kaytnffedch, kayw93i l intention.',
    ),
  ),
);
