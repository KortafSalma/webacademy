<?php

declare(strict_types=1);

/**
 * Contenu généré depuis css-c11.json
 */

return array (
  'id' => 'css-ch11',
  'title' => 'Flexbox',
  'subtitle' => 'Aligner et répartir les éléments sur une ligne ou une colonne',
  'objectives' => 
  array (
    0 => 'Activer Flexbox avec display: flex.',
    1 => 'Comprendre l\'axe principal et l\'axe secondaire.',
    2 => 'Aligner avec justify-content et align-items.',
    3 => 'Distribuer l\'espace avec flex-grow, flex-shrink et flex-basis.',
    4 => 'Passer à la ligne avec flex-wrap et gérer l\'écart avec gap.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'conteneur-flex',
      'title' => 'Le conteneur flex',
      'icon' => '📐',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>Flexbox</strong> est un modèle de mise en page à une dimension : on aligne des éléments sur une <strong>ligne</strong> ou dans une <strong>colonne</strong>. On l\'active sur le <em>conteneur</em> avec <code>display: flex</code> ; ses enfants directs deviennent des <em>éléments flex</em>.</p>',
          'darija' => '<p><strong>Flexbox</strong> howa modèle dyal mise en page f dimension wa7da : kanrtebto éléments f <strong>ligne</strong> wla f <strong>colonne</strong>. Kanfe3lo 3la <em>conteneur</em> b <code>display: flex</code> ; les enfants nichan kaywliw <em>éléments flex</em>.</p>',
        ),
        1 => 
        array (
          'type' => 'definition',
          'title' => 'Axe principal et axe secondaire',
          'fr' => '<p>La propriété <code>flex-direction</code> définit l\'<strong>axe principal</strong> : <code>row</code> (horizontal, par défaut) ou <code>column</code> (vertical). L\'autre axe est l\'<strong>axe secondaire</strong>. <code>justify-content</code> agit sur l\'axe principal, <code>align-items</code> sur l\'axe secondaire.</p>',
          'darija' => '<p>Propriété <code>flex-direction</code> kat7added <strong>axe principal</strong> : <code>row</code> (horizontal, par défaut) wla <code>column</code> (vertical). L\'axe l\'akhor howa <strong>axe secondaire</strong>. <code>justify-content</code> katkhdem 3la axe principal, <code>align-items</code> 3la axe secondaire.</p>',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'css',
          'title' => 'Activer Flexbox',
          'code' => '.conteneur {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}',
        ),
        3 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'justify-content',
            1 => 'Effet sur l\'axe principal',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'flex-start',
              1 => 'tout au début',
            ),
            1 => 
            array (
              0 => 'center',
              1 => 'tout au centre',
            ),
            2 => 
            array (
              0 => 'flex-end',
              1 => 'tout à la fin',
            ),
            3 => 
            array (
              0 => 'space-between',
              1 => 'premier et dernier aux bords, espace égal entre',
            ),
            4 => 
            array (
              0 => 'space-around',
              1 => 'espace autour de chaque élément',
            ),
            5 => 
            array (
              0 => 'space-evenly',
              1 => 'espace strictement égal partout',
            ),
          ),
        ),
        4 => 
        array (
          'type' => 'example',
          'title' => 'Centrer sur les deux axes',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Centrer avec Flexbox</title>
<style>
  .boite {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 220px;
    background: #e0f2fe;
    border: 2px dashed #0284c7;
  }
  .badge {
    padding: 16px 28px;
    background: #0284c7;
    color: white;
    border-radius: 8px;
    font-family: sans-serif;
  }
</style>
</head>
<body>
  <div class="boite">
    <div class="badge">Je suis centré</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>justify-content: center</code> centre horizontalement (axe principal en <code>row</code>) et <code>align-items: center</code> centre verticalement (axe secondaire).',
          'explainDarija' => '<code>justify-content: center</code> katcenter horizontalement (axe principal f <code>row</code>) w <code>align-items: center</code> katcenter verticalement (axe secondaire).',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'proprietes-flexibles',
      'title' => 'Les propriétés des éléments flex',
      'icon' => '🧱',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Chaque enfant du conteneur possède trois propriétés de dimension : <code>flex-grow</code> (capacité à grandir), <code>flex-shrink</code> (capacité à rétrécir) et <code>flex-basis</code> (taille de départ). Le raccourci <code>flex</code> les combine.</p>',
          'darija' => '<p>Kol enfant dyal conteneur 3ndo tlata propriétés dyal dimension : <code>flex-grow</code> (imkaniya ykber), <code>flex-shrink</code> (imkaniya ysqer) w <code>flex-basis</code> (taille de départ). Raccourci <code>flex</code> kayjem3hom.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Propriété',
            1 => 'Rôle',
            2 => 'Raccourci',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'flex-grow: 1',
              1 => 'prend l\'espace libre',
              2 => 'flex: 1',
            ),
            1 => 
            array (
              0 => 'flex-shrink: 0',
              1 => 'refuse de rétrécir',
              2 => 'flex: 0 0 auto',
            ),
            2 => 
            array (
              0 => 'flex-basis: 200px',
              1 => 'largeur de départ',
              2 => 'flex: 1 1 200px',
            ),
            3 => 
            array (
              0 => 'flex: 1',
              1 => 'grandit et rétrécit également',
              2 => 'le plus utilisé',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Trois colonnes qui s\'adaptent',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>flex: 1</title>
<style>
  .ligne {
    display: flex;
    gap: 12px;
    font-family: sans-serif;
  }
  .col {
    flex: 1;
    padding: 20px;
    background: #dbeafe;
    border: 2px solid #2563eb;
    text-align: center;
    border-radius: 6px;
  }
  .col.large { flex: 2; }
</style>
</head>
<body>
  <div class="ligne">
    <div class="col">1</div>
    <div class="col large">2 (flex: 2)</div>
    <div class="col">3</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'L\'espace libre est partagé proportionnellement aux valeurs de <code>flex-grow</code> : la colonne centrale reçoit deux parts, les autres une part chacune.',
          'explainDarija' => 'Espace libre kaytqsem b nisba l valeurs dyal <code>flex-grow</code> : colonne lwsta katakhod jouj parts, lokhrin part wa7da kol wa7ed.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'gap remplace les marges entre éléments',
          'fr' => 'Utilisez <code>gap</code> sur le conteneur pour espacer les éléments. C\'est plus simple que des marges sur chaque enfant, qui ajoutent des espaces indésirables aux extrémités.',
          'darija' => 'Khdem b <code>gap</code> 3la conteneur bach tfre9 éléments. Ashel men marges 3la kol enfant, li kayzido espaces bla fayda f tarafin.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'flex-pratique',
      'title' => 'Cas pratiques',
      'icon' => '🛠️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>flex-wrap: wrap</code> autorise les éléments à passer à la ligne quand ils n\'ont plus de place. Combiné à <code>flex-basis</code>, il crée des grilles de cartes qui s\'adaptent à la largeur de l\'écran sans media query.</p>',
          'darija' => '<p><code>flex-wrap: wrap</code> kaykhalli éléments ydowzo l ligne jdida melli ma ybqach blasa. M3a <code>flex-basis</code>, kay5leq grilles dyal cartes li katt3adel m3a 3ard dyal écran bla media query.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Cartes responsives avec wrap',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Cartes flexibles</title>
<style>
  .cartes {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    font-family: sans-serif;
  }
  .carte {
    flex: 1 1 180px;
    padding: 18px;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
  }
</style>
</head>
<body>
  <div class="cartes">
    <div class="carte">HTML</div>
    <div class="carte">CSS</div>
    <div class="carte">PHP</div>
    <div class="carte">SQL</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>flex: 1 1 180px</code> signifie : taille de départ 180px, peut grandir et rétrécir. Quand la ligne est pleine, les cartes suivantes passent en dessous.',
          'explainDarija' => '<code>flex: 1 1 180px</code> kat3ni : taille de départ 180px, t9der tkber w tsqer. Melli ligne kat3mer, cartes li mora kaydowzo l ta7t.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Barre de navigation',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Navbar flex</title>
<style>
  .nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background: #1e293b;
    color: white;
    font-family: sans-serif;
  }
  .liens { display: flex; gap: 18px; }
  .liens a { color: #cbd5e1; text-decoration: none; }
  .liens a:hover { color: white; }
</style>
</head>
<body>
  <nav class="nav">
    <strong>WebAcademy</strong>
    <div class="liens">
      <a href="#">Cours</a>
      <a href="#">Exercices</a>
      <a href="#">Quiz</a>
    </div>
  </nav>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>justify-content: space-between</code> pousse le logo à gauche et le groupe de liens à droite. Le conteneur des liens est lui-même un flex pour les espacer régulièrement.',
          'explainDarija' => '<code>justify-content: space-between</code> kat7et logo 3la liser w groupe dyal liens 3la limen. Conteneur dyal liens howa rasso flex bach yfre9hom b tartib.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Flexbox ou Grid ?',
          'fr' => 'Flexbox excelle pour une <strong>seule dimension</strong> (une barre, une ligne de cartes, un centrage). Pour une grille à deux dimensions avec lignes et colonnes, préférez <strong>CSS Grid</strong>.',
          'darija' => 'Flexbox mzyan l <strong>dimension wa7da</strong> (barre, ligne dyal cartes, centrage). L grille b jouj dimensions (lignes w colonnes), 7sen <strong>CSS Grid</strong>.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Mettre display: flex sur les enfants au lieu du conteneur',
      'fix' => '.conteneur { display: flex; }',
      'fr' => 'Flexbox s\'active sur le parent : ce sont ses enfants directs qui sont alignés.',
      'darija' => 'Flexbox kaytfe3el 3la parent : les enfants nichan dyalo homa li kayt3adlo.',
    ),
    1 => 
    array (
      'wrong' => 'Utiliser margin: auto sur chaque élément pour tout espacer',
      'fix' => 'gap: 16px sur le conteneur',
      'fr' => 'gap gère l\'espacement sans marges parasites aux extrémités.',
      'darija' => 'gap kayt7ekkem f espacement bla marges zaydin f tarafin.',
    ),
    2 => 
    array (
      'wrong' => 'Textes qui débordent malgré flex-wrap',
      'fix' => 'Ajouter min-width: 0 sur les enfants, ou autoriser le retour à la ligne du texte.',
      'fr' => 'Un enfant flex refuse par défaut de rétrécir sous la largeur de son contenu : min-width: 0 lève ce blocage.',
      'darija' => 'Enfant flex b défaut kayrefus ysqer 9el men 3ard dyal contenu dyalo : min-width: 0 kay7el had blocage.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>Flexbox</strong> s\'active avec <code>display: flex</code> sur un conteneur. <code>flex-direction</code> choisit l\'axe principal ; <code>justify-content</code> aligne sur cet axe et <code>align-items</code> sur l\'axe secondaire. Les enfants se partagent l\'espace avec <code>flex: grow shrink basis</code>. <code>gap</code> espace, <code>flex-wrap: wrap</code> passe à la ligne : parfait pour les barres et les cartes responsives.',
    'darija' => '<strong>Flexbox</strong> kaytfe3el b <code>display: flex</code> 3la conteneur. <code>flex-direction</code> katkhtar axe principal ; <code>justify-content</code> katt3adel 3la had axe w <code>align-items</code> 3la axe secondaire. Enfants kaytqasmo espace b <code>flex: grow shrink basis</code>. <code>gap</code> kayfre9, <code>flex-wrap: wrap</code> kaydowez l ligne : mzyan l barres w cartes responsives.',
  ),
);
