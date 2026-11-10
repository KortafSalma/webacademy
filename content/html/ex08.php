<?php

declare(strict_types=1);

/**
 * Exercices du chapitre html-ch8.
 * Schéma OBLIGATOIRE pour tous les fichiers exNN.php :
 * [
 *   'id' => 'module-exN', 'title' => ..., 'brief' => 'une ligne',
 *   'dialect' => ??? (sql uniquement),
 *   'levels' => [
 *     ['level'=>1, 'title'=>'...', 'lang'=>'html|css|php|sql',
 *      'instructions' => html FR, 'instructionsDarija' => html Darija,
 *      'starter' => code de départ,
 *      'tests' => [ ['type'=>'html_contains','value'=>'<h1>'], … ],
 *      'hints' => ['indice 1','indice 2'],
 *      'solution' => code corrigé,
 *      'explainFr' => ..., 'explainDarija' => ...],
 *     … niveaux 2 et 3
 *   ]
 * ]
 */

return [
    'id'    => 'html-ex8',
    'title' => 'Structure sémantique',
    'brief' => 'Créez une page en utilisant les balises sémantiques HTML5',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — structure de base',
            'lang'  => 'html',
            'instructions' => 'Complète le squelette HTML ci-dessous en ajoutant les balises sémantiques suivantes : <code><header></code>, <code><nav></code>, <code><main></code>, <code><section></code> et <code><footer></code>. Placez le titre <code><h1></code> à l\'intérieur de <code><header></code> et un paragraphe à l\'intérieur de <code><footer></code>.',
            'instructionsDarija' => 'Complete skeleton HTML bach add balises sémantiques : <code><header></code>, <code><nav></code>, <code><main></code>, <code><section></code> w <code><footer></code>. Place h1 f header w paragraph f footer.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page web</title>
</head>
<body>
  <!-- TODO : ajouter header, nav, main, section, footer -->
  <h1>Titre de la page</h1>
  <p>Contenu principal...</p>
  <p>Copyright 2024</p>
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<header>'],
                ['type' => 'html_contains', 'value' => '</header>'],
                ['type' => 'html_contains', 'value' => '<nav>'],
                ['type' => 'html_contains', 'value' => '</nav>'],
                ['type' => 'html_contains', 'value' => '<main>'],
                ['type' => 'html_contains', 'value' => '</main>'],
                ['type' => 'html_contains', 'value' => '<section>'],
                ['type' => 'html_contains', 'value' => '</section>'],
                ['type' => 'html_contains', 'value' => '<footer>'],
                ['type' => 'html_contains', 'value' => '</footer>'],
            ],
            'hints' => [
                'Commencez par <header> après <body>, ajoutez <nav> dedans.',
                '<main> contient le contenu principal, <footer> en fin de page.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page web</title>
</head>
<body>
  <header>
    <h1>Titre de la page</h1>
    <nav>
      <ul><li><a href="#">Accueil</a></li></ul>
    </nav>
  </header>

  <main>
    <section>
      <p>Contenu principal...</p>
    </section>
  </main>

  <footer>
    <p>Copyright 2024</p>
  </footer>
</body>
</html>',
            'explainFr' => 'Vous avez maintenant une structure HTML sémantique correcte avec header, nav, main, section et footer. Les lecteurs d\'écran peuvent naviguer directement vers les sections importantes.',
            'explainDarija' => 'L9der structure HTML sémantique mzyan bach header, nav, main, section w footer. Li7 le lecteur d\'écran kay navigue direct vers sections importantes.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — structure d\'article',
            'lang'  => 'html',
            'instructions' => 'À partir du starter ci-dessous, créez une page d\'article de blog complet. Utilisez <code><article></code> pour envelopper le contenu principal, <code><header></code> pour l\'en-tête de l\'article (avec h2 et métadonnées), <code><section></code> pour les parties thématiques, et <code><aside></code> pour une barre latérale avec des liens intéressants.',
            'instructionsDarija' => 'Bach starter ci-dessous, create page blog article complet. Utilise <code><article></code> pour contenu principal, <code><header></code> pour en-tête article (h2 w métadonnées), <code><section></code> pour parties thématiques, w <code><aside></code> pour barre latérale liens intéressants.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Article de blog</title>
</head>
<body>
  <!-- TODO : structure sémantique article -->
  <h1>Titre de la page</h1>
  <p>Introduction...</p>
  <p>Contenu de l\'article...</p>
  <aside>
    <h3>Liens utiles</h3>
    <ul><li><a href="#">Lien 1</a></li></ul>
  </aside>
  <p>Fin de page...</p>
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<article>'],
                ['type' => 'html_contains', 'value' => '</article>'],
                ['type' => 'html_contains', 'value' => '<h2>'],
                ['type' => 'html_contains', 'value' => '</h2>'],
                ['type' => 'html_contains', 'value' => '<aside>'],
                ['type' => 'html_contains', 'value' => '</aside>'],
                ['type' => 'html_contains', 'value' => '<h3>'],
                ['type' => 'html_contains', 'value' => '</h3>'],
            ],
            'hints' => [
                'Enveloppez le contenu principal dans <article>.',
                '<aside> va dans le même <main> que l\'article, pas à l\'intérieur.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Article de blog</title>
</head>
<body>
  <article>
    <header>
      <h2>Ma randonnée en montagne</h2>
      <p>Publié le 15 mars 2024</p>
    </header>
    <section>
      <p>Le départ était tôt le matin...</p>
    </section>
    <section>
      <p>L\'arrivée était magnifique...</p>
    </section>
    <aside>
      <h3>Liens utiles</h3>
      <ul>
        <li><a href="#">Cartographie</a></li>
        <li><a href="#">Météo</a></li>
      </ul>
    </aside>
  </article>
  <p>Fin de page...</p>
</body>
</html>',
            'explainFr' => 'La structure d\'article utilise correctement la balise <article> pour encadrer le contenu principal, avec un header incluant le titre et métadonnées, des sections thématiques et un aside pour les liens connexes. C\'est réutilisable et accessible.',
            'explainDarija' => 'Structure article utilise <article> bach contenu principal, header bach titre w métadonnées, sections thématiques w aside pour liens connexes. C\' réutilisable w accessible.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — page complète semantique',
            'lang'  => 'html',
            'instructions' => 'Créez une page "À propos" complète et totalement sémantique en utilisant la structure complète : <code><header></code> de page (avec <code><nav></code>), <code><main></code> avec un <code><article></code> contenant plusieurs <code><section></code> et un <code><aside></code>, et <code><footer></code> de page. Le contenu doit inclure un titre h1, deux sections thématiques dans l\'article, et au moins deux liens dans l\'aside.',
            'instructionsDarija' => 'Create page "À propos" complete w totalement sémantique bach structure complete : <code><header></code> de page (bach <code><nav></code>), <code><main></code> bach <code><article></code> contenant plusieurs <code><section></code> w <code><aside></code>, w <code><footer></code> de page. Content doit inclure h1, deux sections thématiques f article, w au moins deux liens f aside.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>À propos</title>
</head>
<body>
  <!-- TODO : structure semantique complete -->
  <h1>À propos de nous</h1>
  <p>Bienvenue sur notre site.</p>
  <aside>
    <h3>Contact</h3>
    <p>Email : info@exemple.com</p>
  </aside>
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<header>'],
                ['type' => 'html_contains', 'value' => '</header>'],
                ['type' => 'html_contains', 'value' => '<nav>'],
                ['type' => 'html_contains', 'value' => '</nav>'],
                ['type' => 'html_contains', 'value' => '<main>'],
                ['type' => 'html_contains', 'value' => '</main>'],
                ['type' => 'html_contains', 'value' => '<article>'],
                ['type' => 'html_contains', 'value' => '</article>'],
                ['type' => 'html_contains', 'value' => '<section>'],
                ['type' => 'html_contains', 'value' => '</section>'],
                ['type' => 'html_contains', 'value' => '<aside>'],
                ['type' => 'html_contains', 'value' => '</aside>'],
                ['type' => 'html_contains', 'value' => '<h1>'],
                ['type' => 'html_contains', 'value' => '</h1>'],
            ],
            'hints' => [
                'La structure complète commence par <header> avec <nav> dedans.',
                '<article> doit être f <main>, pas directement f <body>.',
                '<footer> vient après <main>.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>À propos</title>
</head>
<body>
  <header>
    <h1>WebAcademy</h1>
    <nav>
      <ul>
        <li><a href="#accueil">Accueil</a></li>
        <li><a href="#cours">Cours</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <article>
      <h2>Notre histoire</h2>
      <section>
        <p>WebAcademy a été fondée en 2020 dans le but de...</p>
      </section>
      <section>
        <p>Notre équipe est composée de passionnés...</p>
      </section>
    </article>
  </main>

  <aside>
    <h3>Réseaux sociaux</h3>
    <ul>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">LinkedIn</a></li>
    </ul>
  </aside>

  <footer>
    <p>&copy; 2024 WebAcademy – Tous droits réservés.</p>
  </footer>
</body>
</html>',
            'explainFr' => 'Vous avez créé une page "À propos" entièrement sémantique avec la structure complète HTML5. Du header avec navigation, en passant par l\'article principal avec sections, l\'aside et le footer. C\'est un excellent exemple de bonne pratique HTML sémantique.',
            'explainDarija' => 'Create page "À propos" entièrement sémantique bach structure complete HTML5. Header w navigation, article principal w sections, aside w footer. C\' excellent example bonne pratique HTML sémantique.',
        ],
    ],
];