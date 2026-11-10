<?php

declare(strict_types=1);

/**
 * Contenu généré depuis css-c14.json
 */

return array (
  'id' => 'css-ch14',
  'title' => 'Media queries',
  'subtitle' => 'Adapter le style selon l\'écran et les préférences',
  'objectives' => 
  array (
    0 => 'Écrire une media query avec @media.',
    1 => 'Distinguer min-width et max-width.',
    2 => 'Choisir des points de rupture utiles.',
    3 => 'Adapter une grille et une navigation.',
    4 => 'Respecter prefers-reduced-motion et prefers-color-scheme.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'syntaxe-media',
      'title' => 'Syntaxe des media queries',
      'icon' => '🎛️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>media query</strong> applique un bloc de CSS seulement si une condition est vraie : largeur d\'écran, orientation, préférence de thème… On l\'écrit <code>@media (condition) { ... }</code>.</p>',
          'darija' => '<p><strong>Media query</strong> kattbeq bloc dyal CSS ghir ila condition vraie : 3ard dyal écran, orientation, préférence dyal thème… Kanktbo <code>@media (condition) { ... }</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'css',
          'title' => 'Deux formes essentielles',
          'code' => '/* À partir de 768px (mobile-first) */
@media (min-width: 768px) {
  .conteneur { display: flex; }
}

/* Jusqu\'à 767px */
@media (max-width: 767px) {
  .menu { display: none; }
}',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'min-width ou max-width ?',
          'fr' => 'En <strong>mobile-first</strong>, on écrit le style de base pour mobile puis on ajoute des <code>min-width</code> croissants : les règles s\'empilent dans l\'ordre du fichier. <code>max-width</code> correspond à une approche desktop-first, plus fragile.',
          'darija' => 'F <strong>mobile-first</strong>, kanktbo style de base l mobile men ba3d kanzido <code>min-width</code> kbar : règles kaytt3emro b tartib dyal fichier. <code>max-width</code> katmatch approche desktop-first, li katkon ktar hchacha.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Une grille qui passe de 1 à 3 colonnes',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Media query</title>
<style>
  .grille {
    display: grid;
    gap: 12px;
    grid-template-columns: 1fr;
    font-family: sans-serif;
  }
  .case {
    padding: 22px;
    background: #fef3c7;
    border: 2px solid #d97706;
    text-align: center;
  }
  @media (min-width: 600px) {
    .grille { grid-template-columns: repeat(2, 1fr); }
  }
  @media (min-width: 900px) {
    .grille { grid-template-columns: repeat(3, 1fr); }
  }
</style>
</head>
<body>
  <div class="grille">
    <div class="case">1</div>
    <div class="case">2</div>
    <div class="case">3</div>
  </div>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'Sous 600px : une colonne. Entre 600 et 899px : deux colonnes. À partir de 900px : trois colonnes. Chaque règle suivante écrase la précédente quand sa condition est vraie.',
          'explainDarija' => 'Qbel 600px : colonne wa7da. Bin 600 w 899px : jouj colonnes. Men 900px : tlata colonnes. Kol règle li mora katghalleb li qbelha melli condition dyalha tkoun vraie.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'breakpoints',
      'title' => 'Choisir les points de rupture',
      'icon' => '📏',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Il n\'existe pas de breakpoints universels. On choisit les largeurs où <strong>la mise en page commence à casser</strong>, pas les dimensions d\'un téléphone précis. Trois paliers suffisent souvent : mobile, tablette, desktop.</p>',
          'darija' => '<p>Ma kaynch breakpoints universels. Kankhtaro 3ard fin <strong>mise en page katbda tkhesr</strong>, machi dimensions dyal téléphone mo3ayyan. Tlata paliers ghaliban kafyin : mobile, tablette, desktop.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Palier',
            1 => 'Largeur indicative',
            2 => 'Objectif',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Mobile',
              1 => 'base, < 600px',
              2 => 'une colonne, texte lisible',
            ),
            1 => 
            array (
              0 => 'Tablette',
              1 => '600px – 899px',
              2 => 'deux colonnes, marges',
            ),
            2 => 
            array (
              0 => 'Desktop',
              1 => '≥ 900px',
              2 => 'trois colonnes, menu horizontal',
            ),
            3 => 
            array (
              0 => 'Grand écran',
              1 => '≥ 1280px',
              2 => 'conteneur borné, pas étiré',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Observer avant de coder',
          'fr' => 'Réduisez la fenêtre lentement : dès qu\'un texte devient trop long ou qu\'une carte se comprime, notez la largeur. C\'est votre breakpoint réel. Inutile de copier ceux d\'un framework si votre contenu n\'en a pas besoin.',
          'darija' => 'Nqes 3ard dyal fenêtre b chwiya : melli texte kaywli twil bzzaf wla carte kattsqer, sjjl 3ard. Hada howa breakpoint 7aqiqi dyalek. Ma khassekch tcopy ceux dyal framework ila contenu dyalek ma 3ndoch 7aja.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Navigation qui passe en colonne',
          'lang' => 'css',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu responsive</title>
<style>
  .nav {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 12px;
    background: #0f172a;
    font-family: sans-serif;
  }
  .nav a {
    color: #e2e8f0;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 6px;
  }
  .nav a:hover { background: #1e293b; }
  @media (min-width: 700px) {
    .nav { flex-direction: row; align-items: center; }
  }
</style>
</head>
<body>
  <nav class="nav">
    <a href="#">Accueil</a>
    <a href="#">Cours</a>
    <a href="#">Exercices</a>
    <a href="#">Quiz</a>
  </nav>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'Sur mobile, les liens s\'empilent verticalement et restent faciles à toucher. À partir de 700px, la barre devient horizontale.',
          'explainDarija' => '3la mobile, liens kayt3emro verticalement w kaybqaw sahel l touch. Men 700px, barre katwli horizontale.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'preferences',
      'title' => 'Préférences utilisateur et impression',
      'icon' => '♿',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les media queries ne concernent pas seulement la largeur. <code>prefers-reduced-motion</code> détecte les utilisateurs qui réduisent les animations, <code>prefers-color-scheme</code> le thème clair ou sombre, et <code>print</code> l\'impression.</p>',
          'darija' => '<p>Media queries ma kayt7ekkomch ghir f 3ard. <code>prefers-reduced-motion</code> kat3ref utilisateurs li kaynqso animations, <code>prefers-color-scheme</code> thème clair wla sombre, w <code>print</code> impression.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Respecter les préférences',
          'lang' => 'css',
          'code' => '@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-color-scheme: dark) {
  body {
    background: #0f172a;
    color: #e2e8f0;
  }
}

@media print {
  nav, footer, .publicite { display: none; }
  body { color: black; background: white; }
}',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Media feature',
            1 => 'Valeurs',
            2 => 'Usage',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'prefers-reduced-motion',
              1 => 'no-preference | reduce',
              2 => 'désactiver les animations',
            ),
            1 => 
            array (
              0 => 'prefers-color-scheme',
              1 => 'light | dark',
              2 => 'thème sombre automatique',
            ),
            2 => 
            array (
              0 => 'orientation',
              1 => 'portrait | landscape',
              2 => 'mise en page selon rotation',
            ),
            3 => 
            array (
              0 => 'print',
              1 => '—',
              2 => 'version imprimable',
            ),
            4 => 
            array (
              0 => 'hover',
              1 => 'hover | none',
              2 => 'éviter les effets au survol sur tactile',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Ne pas cacher du contenu essentiel',
          'fr' => 'Une media query ne doit pas supprimer une information indispensable sur mobile. Si un menu disparaît, prévoyez un bouton pour l\'ouvrir. Le responsive réorganise, il n\'ampute pas.',
          'darija' => 'Media query ma khasch t7yed ma3loma darouriya 3la mobile. Ila menu kayghib, 7etted bouton bach yt7el. Responsive kay3awed y3adel, ma kaynqessch.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Écrire les media queries max-width dans le désordre',
      'fix' => 'Mobile-first : base mobile, puis min-width croissants dans l\'ordre.',
      'fr' => 'Des media queries mal ordonnées produisent des règles qui s\'écrasent de façon imprévisible.',
      'darija' => 'Media queries bla tartib kay3tiw règles li kaytghallbo b chkel ma m7eddch.',
    ),
    1 => 
    array (
      'wrong' => 'Un breakpoint par modèle de téléphone',
      'fix' => 'Choisir les largeurs où le contenu casse (souvent 600px et 900px).',
      'fr' => 'Les appareils changent chaque année ; votre contenu, lui, a des points de rupture stables.',
      'darija' => 'Appareils kaytbeddlo kol 3am ; contenu dyalek 3ndo points de rupture stables.',
    ),
    2 => 
    array (
      'wrong' => 'Cacher un menu sans alternative accessible',
      'fix' => 'Afficher un bouton menu et gérer l\'ouverture au clavier.',
      'fr' => 'Supprimer la navigation sur mobile rend le site inutilisable pour une partie des visiteurs.',
      'darija' => '7yed navigation 3la mobile kay3mel site ma ysta3melch l part dyal visiteurs.',
    ),
    3 => 
    array (
      'wrong' => 'Ignorer prefers-reduced-motion',
      'fix' => 'Réduire ou désactiver les animations dans cette media query.',
      'fr' => 'Les animations fortes peuvent provoquer un malaise chez certains utilisateurs.',
      'darija' => 'Animations qwiyin y9dro y3mlo malaise l chi utilisateurs.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une <strong>media query</strong> applique du CSS selon une condition. En <strong>mobile-first</strong>, on part du petit écran et on ajoute des <code>min-width</code> croissants. Les <strong>breakpoints</strong> se choisissent là où le contenu casse, pas selon un modèle de téléphone. On adapte aussi les <strong>préférences</strong> (mouvement réduit, thème sombre) et l\'<strong>impression</strong>.',
    'darija' => '<strong>Media query</strong> kattbeq CSS 3la 7sab condition. F <strong>mobile-first</strong>, kanbdaw men écran sghir w kanzido <code>min-width</code> kbar. <strong>Breakpoints</strong> kaytkhtaro fin contenu kaykhesr, machi 3la 7sab modèle dyal téléphone. Kan3adlo 7ta <strong>préférences</strong> (mouvement réduit, thème sombre) w <strong>impression</strong>.',
  ),
);
