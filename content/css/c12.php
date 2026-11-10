<?php

declare(strict_types=1);

/**
 * Contenu généré depuis css-c12.json
 */

return array (
  'id' => 'css-ch12',
  'title' => 'CSS Grid',
  'subtitle' => 'Construire des grilles à deux dimensions',
  'objectives' => 
  array (
    0 => 'Créer une grille avec display: grid et grid-template-columns.',
    1 => 'Utiliser l\'unité fr et la fonction repeat().',
    2 => 'Placer un élément avec grid-column et grid-row.',
    3 => 'Construire une mise en page avec grid-template-areas.',
    4 => 'Rendre une grille responsive avec auto-fit et minmax().',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'grille-base',
      'title' => 'Créer une grille',
      'icon' => '🔲',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>CSS Grid</strong> gère à la fois les <strong>lignes</strong> et les <strong>colonnes</strong>. On déclare la grille sur le conteneur avec <code>display: grid</code>, puis on définit ses pistes avec <code>grid-template-columns</code> et <code>grid-template-rows</code>.</p>',
          'darija' => '<p><strong>CSS Grid</strong> kayt7ekkem f <strong>lignes</strong> w <strong>colonnes</strong> f nefs lwa9t. Kandeklariw grille 3la conteneur b <code>display: grid</code>, men ba3d kan7eddo pistes b <code>grid-template-columns</code> w <code>grid-template-rows</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'definition',
          'title' => 'L\'unité fr',
          'fr' => '<p><code>fr</code> représente une <strong>fraction de l\'espace libre</strong>. <code>1fr 1fr 1fr</code> crée trois colonnes égales ; <code>2fr 1fr</code> donne deux tiers au premier et un tiers au second.</p>',
          'darija' => '<p><code>fr</code> katmettel <strong>fraction dyal espace libre</strong>. <code>1fr 1fr 1fr</code> kat5leq tlata colonnes sawiyin ; <code>2fr 1fr</code> kat3ti jouj tlata l lwel w tlata l tani.</p>',
        ),
        2 => 
        array (
          'type' => 'syntax',
          'lang' => 'css',
          'title' => 'Grille de base',
          'code' => '.grille {
  display: grid;
  grid-template-columns: 200px 1fr 1fr;
  gap: 12px;
}',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Trois colonnes égales',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Grille simple</title>
<style>
  .grille {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    font-family: sans-serif;
  }
  .case {
    padding: 24px;
    background: #ede9fe;
    border: 2px solid #7c3aed;
    text-align: center;
    border-radius: 8px;
  }
</style>
</head>
<body>
  <div class="grille">
    <div class="case">1</div>
    <div class="case">2</div>
    <div class="case">3</div>
    <div class="case">4</div>
    <div class="case">5</div>
    <div class="case">6</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>repeat(3, 1fr)</code> est un raccourci pour <code>1fr 1fr 1fr</code>. Les six cases se placent automatiquement sur deux lignes de trois colonnes.',
          'explainDarija' => '<code>repeat(3, 1fr)</code> hiya raccourci dyal <code>1fr 1fr 1fr</code>. Sitta cases kayt7etto automatiquement 3la jouj lignes dyal tlata colonnes.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'placement',
      'title' => 'Placer les éléments',
      'icon' => '🧩',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Par défaut, chaque enfant occupe une seule cellule. <code>grid-column</code> et <code>grid-row</code> permettent de spécifier sa position : <code>grid-column: 1 / 3</code> couvre de la ligne de grille 1 à 3, soit deux colonnes.</p>',
          'darija' => '<p>B défaut, kol enfant kayakhod cellule wa7da. <code>grid-column</code> w <code>grid-row</code> kaykhalliw t7edd position dyalo : <code>grid-column: 1 / 3</code> kayghatti men ligne dyal grille 1 7ta 3, ya3ni jouj colonnes.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Écriture',
            1 => 'Signification',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'grid-column: 1 / 3',
              1 => 'de la ligne 1 à la ligne 3',
            ),
            1 => 
            array (
              0 => 'grid-column: span 2',
              1 => 'occupe 2 colonnes',
            ),
            2 => 
            array (
              0 => 'grid-row: 1 / 3',
              1 => 'occupe deux lignes',
            ),
            3 => 
            array (
              0 => 'grid-area: 1 / 2 / 3 / 4',
              1 => 'row-start / col-start / row-end / col-end',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Une carte qui couvre deux colonnes',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Grid placement</title>
<style>
  .grille {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    font-family: sans-serif;
  }
  .case {
    padding: 20px;
    background: #dcfce7;
    border: 2px solid #16a34a;
    text-align: center;
  }
  .large {
    grid-column: span 2;
    background: #fef9c3;
    border-color: #ca8a04;
  }
</style>
</head>
<body>
  <div class="grille">
    <div class="case">1</div>
    <div class="case large">2 et 3</div>
    <div class="case">4</div>
    <div class="case">5</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>span 2</code> fait occuper deux colonnes à la deuxième case. Les cases suivantes remplissent automatiquement les espaces restants.',
          'explainDarija' => '<code>span 2</code> katkhalli case tanya takhod jouj colonnes. Cases li mora kay3emro automatiquement les espaces li bqaw.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Mise en page avec grid-template-areas',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Template areas</title>
<style>
  .page {
    display: grid;
    grid-template-columns: 200px 1fr;
    grid-template-rows: auto 1fr auto;
    grid-template-areas:
      "entete entete"
      "menu   contenu"
      "pied   pied";
    gap: 8px;
    min-height: 260px;
    font-family: sans-serif;
  }
  header { grid-area: entete; background: #1e293b; color: white; padding: 12px; }
  nav    { grid-area: menu; background: #e2e8f0; padding: 12px; }
  main   { grid-area: contenu; background: #f8fafc; padding: 12px; }
  footer { grid-area: pied; background: #1e293b; color: white; padding: 12px; }
</style>
</head>
<body>
  <div class="page">
    <header>En-tête</header>
    <nav>Menu</nav>
    <main>Contenu principal</main>
    <footer>Pied de page</footer>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => '<code>grid-template-areas</code> dessine la mise en page avec du texte : chaque nom doit être repris par <code>grid-area</code> sur l\'enfant correspondant. C\'est très lisible pour les layouts de page.',
          'explainDarija' => '<code>grid-template-areas</code> katrsem mise en page b texte : kol smiya khas t3awed f <code>grid-area</code> 3la enfant li kaymatch. Had tariqa wad7a bzzaf l layouts dyal page.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'responsive-grid',
      'title' => 'Grilles responsives',
      'icon' => '📱',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>repeat(auto-fit, minmax(180px, 1fr))</code> crée autant de colonnes que possible : chaque colonne fait au moins 180px et partage l\'espace restant. Sans media query, la grille s\'adapte de l\'écran mobile au grand écran.</p>',
          'darija' => '<p><code>repeat(auto-fit, minmax(180px, 1fr))</code> kat5leq 9ad ma mumkin dyal colonnes : kol colonne 3ndha 3la l9al 180px w katqasem espace li bqa. Bla media query, grille katt3adel men mobile 7ta écran kbir.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Cartes auto-adaptatives',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>auto-fit</title>
<style>
  .grille {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
    font-family: sans-serif;
  }
  .carte {
    padding: 22px;
    background: #cffafe;
    border: 2px solid #0891b2;
    border-radius: 10px;
    text-align: center;
  }
</style>
</head>
<body>
  <div class="grille">
    <div class="carte">HTML</div>
    <div class="carte">CSS</div>
    <div class="carte">PHP</div>
    <div class="carte">SQL</div>
    <div class="carte">Git</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'Réduisez la largeur de la fenêtre : le nombre de colonnes diminue automatiquement. <code>auto-fit</code> étire les colonnes existantes ; <code>auto-fill</code> garde des colonnes vides.',
          'explainDarija' => 'Nqes 3ard dyal fenêtre : 3adad colonnes kaynqes automatiquement. <code>auto-fit</code> kaymded colonnes li kaynin ; <code>auto-fill</code> kay7fed colonnes khawyin.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Fonction',
            1 => 'Rôle',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'repeat(n, taille)',
              1 => 'répète n colonnes identiques',
            ),
            1 => 
            array (
              0 => 'minmax(min, max)',
              1 => 'taille entre un minimum et un maximum',
            ),
            2 => 
            array (
              0 => 'auto-fit',
              1 => 'crée les colonnes nécessaires et les étire',
            ),
            3 => 
            array (
              0 => 'auto-fill',
              1 => 'crée les colonnes possibles, même vides',
            ),
            4 => 
            array (
              0 => 'align-items / justify-items',
              1 => 'aligne le contenu dans chaque cellule',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Grid n\'est pas Flexbox',
          'fr' => 'N\'utilisez pas Grid pour aligner trois boutons sur une ligne : Flexbox est plus simple. Grid devient rentable dès qu\'il y a des <strong>lignes et des colonnes</strong> à gérer ensemble.',
          'darija' => 'Ma tkhdemch Grid bach t3adel tlata boutons f ligne : Flexbox ashel. Grid kaywli mzyan melli kayn <strong>lignes w colonnes</strong> khas yt7ekmo fihom m3a b3dhom.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'grid-template-columns: 1fr 1fr 1fr 1fr sur mobile sans adaptation',
      'fix' => 'repeat(auto-fit, minmax(160px, 1fr))',
      'fr' => 'Quatre colonnes fixes deviennent illisibles sur un téléphone. auto-fit adapte le nombre de colonnes.',
      'darija' => 'Rba3 colonnes fixes kaywliw ma mqrouin 3la téléphone. auto-fit kay3adel 3adad colonnes.',
    ),
    1 => 
    array (
      'wrong' => 'Placer un élément avec grid-column: 2 sans vérifier le nombre de colonnes',
      'fix' => 'Déclarer assez de colonnes, ou utiliser span.',
      'fr' => 'Un placement hors de la grille crée des pistes implicites imprévues et casse la mise en page.',
      'darija' => 'Placement bera grille kay5leq pistes implicites ma tsenach w kaykhesr mise en page.',
    ),
    2 => 
    array (
      'wrong' => 'Grid sur un seul axe pour aligner des boutons',
      'fix' => 'display: flex avec gap et align-items.',
      'fr' => 'Pour une seule dimension, Flexbox est plus direct et plus léger à écrire.',
      'darija' => 'L dimension wa7da, Flexbox aktar direct w akhaf f ktaba.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>CSS Grid</strong> organise une grille à deux dimensions : <code>grid-template-columns</code> et <code>grid-template-rows</code> définissent les pistes, <code>fr</code> répartit l\'espace, <code>gap</code> espace les cellules. On place un élément avec <code>grid-column</code>, <code>grid-row</code> ou <code>grid-area</code>, et <code>grid-template-areas</code> dessine un layout complet. <code>auto-fit</code> + <code>minmax()</code> rend la grille responsive sans media query.',
    'darija' => '<strong>CSS Grid</strong> kaynadem grille b jouj dimensions : <code>grid-template-columns</code> w <code>grid-template-rows</code> kay7eddo pistes, <code>fr</code> kayqasem espace, <code>gap</code> kayfre9 cellules. Kan7etto élément b <code>grid-column</code>, <code>grid-row</code> wla <code>grid-area</code>, w <code>grid-template-areas</code> katrsem layout kamel. <code>auto-fit</code> + <code>minmax()</code> kay3mlo grille responsive bla media query.',
  ),
);
