<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex09.php
 */

return array (
  'id' => 'css-ex9',
  'title' => 'La propriété display',
  'brief' => 'Passer de block à inline, inline-block ou none.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — block et inline-block',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle qui affiche les <code>span</code> comme des blocs, puis une règle qui affiche les liens <code>a</code> en <code>inline-block</code> avec un padding de <code>6px 12px</code>.</p>',
      'instructionsDarija' => '<p>Kteb règle li kat3red <code>span</code> b7al blocs, men ba3d règle li kat3red liens <code>a</code> b <code>inline-block</code> m3a padding <code>6px 12px</code>.</p>',
      'starter' => 'span {
  /* bloc */
}

a {
  /* inline-block */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: block',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: inline-block',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding: 6px 12px',
        ),
      ),
      'hints' => 
      array (
        0 => 'display: block force un élément en ligne à occuper toute la ligne.',
        1 => 'inline-block accepte width, height et les marges verticales.',
        2 => 'La propriété display s\'écrit dans le bloc de déclarations.',
      ),
      'solution' => 'span {
  display: block;
}

a {
  display: inline-block;
  padding: 6px 12px;
}',
      'explainFr' => '<code>block</code> place chaque span sur sa propre ligne. <code>inline-block</code> garde les liens côte à côte tout en leur permettant d\'avoir un padding vertical visible.',
      'explainDarija' => '<code>block</code> kat7et kol span f ligne dyalha. <code>inline-block</code> katkhalli liens 7da b3dhom w katt3tihom padding vertical li kayban.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — masquer et révéler',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.cache</code> qui retire complètement l\'élément de la page, puis une règle <code>.badge</code> qui l\'affiche en <code>inline-block</code> avec une largeur de <code>80px</code> et un alignement de texte centré.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.cache</code> li kat7yed élément kaml men page, men ba3d règle <code>.badge</code> li kat3red b <code>inline-block</code> b 3ard <code>80px</code> w alignement texte mcentri.</p>',
      'starter' => '.cache {
  /* masquer */
}

.badge {
  /* afficher */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: none',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: inline-block',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'width: 80px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'text-align: center',
        ),
      ),
      'hints' => 
      array (
        0 => 'display: none supprime l\'élément du flux.',
        1 => 'inline-block respecte width et height.',
        2 => 'text-align: center centre le texte dans la boîte.',
      ),
      'solution' => '.cache {
  display: none;
}

.badge {
  display: inline-block;
  width: 80px;
  text-align: center;
}',
      'explainFr' => '<code>display: none</code> fait comme si l\'élément n\'existait pas : il ne réserve aucun espace. <code>inline-block</code> rend le badge visible et lui donne une largeur fixe.',
      'explainDarija' => '<code>display: none</code> kay3mel b7al ila élément ma kanch : ma kay7jzch espace. <code>inline-block</code> kay3red badge w kay3tih 3ard fixe.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — barre de liens',
      'lang' => 'css',
      'instructions' => '<p>Écris une règle <code>.menu a</code> qui affiche les liens en <code>inline-block</code>, avec un padding de <code>10px 18px</code>, un fond <code>#1e293b</code>, un texte blanc, et supprime le soulignement.</p>',
      'instructionsDarija' => '<p>Kteb règle <code>.menu a</code> li kat3red liens b <code>inline-block</code>, b padding <code>10px 18px</code>, fond <code>#1e293b</code>, texte byed, w t7yed soulignement.</p>',
      'starter' => '.menu a {
  /* liens de navigation */
}',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '.menu a',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'display: inline-block',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'padding: 10px 18px',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'background: #1e293b',
        ),
        4 => 
        array (
          'type' => 'html_contains',
          'value' => 'color: white',
        ),
        5 => 
        array (
          'type' => 'html_contains',
          'value' => 'text-decoration: none',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le sélecteur descendant .menu a cible les liens dans le menu.',
        1 => 'text-decoration: none retire le soulignement.',
        2 => 'Le padding rend la zone cliquable plus grande.',
      ),
      'solution' => '.menu a {
  display: inline-block;
  padding: 10px 18px;
  background: #1e293b;
  color: white;
  text-decoration: none;
}',
      'explainFr' => 'Chaque lien devient une zone cliquable rectangulaire, alignée horizontalement avec les autres. Le padding vertical est bien appliqué car l\'élément est <code>inline-block</code>.',
      'explainDarija' => 'Kol lien kaywli zone cliquable rectangulaire, m3a l\'okhrin horizontalement. Padding vertical kaytbeq 7it élément <code>inline-block</code>.',
    ),
  ),
);
