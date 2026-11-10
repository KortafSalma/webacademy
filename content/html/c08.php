<?php

declare(strict_types=1);

/**
 * Contenu généré depuis html-c08.json
 */

return array (
  'id' => 'html-ch8',
  'title' => 'HTML sémantique',
  'subtitle' => 'Donner du sens à la structure de la page',
  'objectives' => 
  array (
    0 => 'Comprendre la différence entre <div> et une balise sémantique.',
    1 => 'Utiliser header, nav, main, section, article, aside et footer.',
    2 => 'Structurer une page complète avec des zones imbriquées logiques.',
    3 => 'Améliorer l\'accessibilité et le référencement grâce aux bonnes balises.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'pourquoi-semantique',
      'title' => 'Pourquoi le HTML sémantique ?',
      'icon' => '🧭',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le <strong>HTML sémantique</strong> consiste à choisir une balise pour son <em>sens</em>, pas pour son apparence. Un <code>&lt;nav&gt;</code> indique une navigation, un <code>&lt;article&gt;</code> un contenu autonome. Les lecteurs d\'écran, les moteurs de recherche et les autres développeurs comprennent immédiatement la structure.</p>',
          'darija' => '<p><strong>HTML sémantique</strong> ma3nah tkhtar balise 3la 7sab <em>ma3naha</em>, machi 3la 7sab chekl dyalha. <code>&lt;nav&gt;</code> kat3ni navigation, <code>&lt;article&gt;</code> kat3ni contenu mstqel. Lecteurs d\'écran, Google w les développeurs kayfhemo structure b sor3a.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Balise',
            1 => 'Rôle',
            2 => 'Exemple d\'usage',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'header',
              1 => 'En-tête d\'une page ou d\'une section',
              2 => 'logo, titre, menu',
            ),
            1 => 
            array (
              0 => 'nav',
              1 => 'Groupe de liens de navigation',
              2 => 'menu principal',
            ),
            2 => 
            array (
              0 => 'main',
              1 => 'Contenu principal unique de la page',
              2 => 'article, formulaire',
            ),
            3 => 
            array (
              0 => 'section',
              1 => 'Groupe thématique avec un titre',
              2 => 'chapitre d\'un cours',
            ),
            4 => 
            array (
              0 => 'article',
              1 => 'Contenu autonome réutilisable',
              2 => 'blog post, produit',
            ),
            5 => 
            array (
              0 => 'aside',
              1 => 'Contenu complémentaire',
              2 => 'encadré, publicité',
            ),
            6 => 
            array (
              0 => 'footer',
              1 => 'Pied de page ou de section',
              2 => 'copyright, contact',
            ),
          ),
          'fr' => 'Ces balises remplacent avantageusement des <code>div</code> sans signification.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Sémantique ne veut pas dire apparence',
          'fr' => 'Les balises sémantiques n\'ont pas de style spécial par défaut : c\'est CSS qui décide de l\'apparence. On choisit la balise pour le sens, puis on la met en forme.',
          'darija' => 'Les balises sémantiques ma-3ndhomch style khass bihom : CSS hiya li kat3ti chekl. Kanokhtaro balise 3la 7sab ma3na, men ba3d kanzayno b CSS.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'structure-page',
      'title' => 'La structure d\'une page',
      'icon' => '🏗️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une page classique suit ce squelette : un <code>header</code> avec le logo et la navigation, un <code>main</code> qui contient le contenu principal, puis un <code>footer</code>. Il ne doit y avoir <strong>qu\'un seul <code>main</code> visible par page</strong>.</p>',
          'darija' => '<p>Page 3adiya katmchi hakka : <code>header</code> fih logo w navigation, <code>main</code> fih contenu principal, w <code>footer</code> f l\'akhir. Khas ykon <strong>ghir <code>main</code> wa7ed</strong> f kol page.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'html',
          'title' => 'Squelette sémantique',
          'code' => '<body>
  <header>
    <h1>Mon site</h1>
    <nav>
      <a href="#">Accueil</a>
      <a href="#">Cours</a>
    </nav>
  </header>

  <main>
    <article>
      <h2>Premier article</h2>
      <p>Contenu de l\'article.</p>
    </article>
  </main>

  <footer>
    <p>© 2026 Mon site</p>
  </footer>
</body>',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Page complète avec header, main et footer',
          'lang' => 'html',
          'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>WebAcademy — Accueil</title>
</head>
<body>
  <header>
    <h1>WebAcademy</h1>
    <nav aria-label="Navigation principale">
      <a href="#html">HTML</a>
      <a href="#css">CSS</a>
      <a href="#php">PHP</a>
    </nav>
  </header>

  <main>
    <h2>Apprendre le développement web</h2>
    <p>Des cours clairs, en français et en darija.</p>
  </main>

  <footer>
    <p>© 2026 WebAcademy — Tous droits réservés.</p>
  </footer>
</body>
</html>',
          'preview' => true,
          'explainFr' => 'Le <code>header</code> contient le titre et le menu, <code>main</code> le contenu principal, <code>footer</code> le pied de page. <code>aria-label</code> aide les lecteurs d\'écran à distinguer les navigations.',
          'explainDarija' => '<code>header</code> fih titre w menu, <code>main</code> fih contenu principal, <code>footer</code> f l\'akhir. <code>aria-label</code> kay3awen lecteurs d\'écran bach yfhemo navigation.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'section-article-aside',
      'title' => 'section, article et aside',
      'icon' => '🧩',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>section</strong> regroupe un thème et possède normalement un titre. <strong>article</strong> est un contenu autonome qu\'on pourrait publier seul (un billet de blog, une fiche produit). <strong>aside</strong> contient une information complémentaire, comme un encadré « à savoir ».</p>',
          'darija' => '<p><strong>section</strong> katjem3 mawdo3 wa7ed w khas ykon fiha titre. <strong>article</strong> howa contenu mstqel, b7al billet de blog wla fiche produit. <strong>aside</strong> fih ma3loma zayda, b7al encadré « à savoir ».</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Question',
            1 => 'section',
            2 => 'article',
            3 => 'div',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'A un titre ?',
              1 => 'oui, recommandé',
              2 => 'oui',
              3 => 'non',
            ),
            1 => 
            array (
              0 => 'Contenu autonome ?',
              1 => 'non',
              2 => 'oui',
              3 => 'non',
            ),
            2 => 
            array (
              0 => 'Rôle sémantique ?',
              1 => 'groupe thématique',
              2 => 'contenu indépendant',
              3 => 'aucun',
            ),
          ),
          'fr' => 'En cas de doute : si le bloc pourrait être publié seul dans un flux RSS, c\'est un <code>article</code>.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Un article avec un aside',
          'lang' => 'html',
          'code' => '<main>
  <article>
    <header>
      <h2>Réussir son premier site</h2>
      <p>Publié le <time datetime="2026-11-10">10 novembre 2026</time></p>
    </header>

    <p>Commencez par le HTML, puis le CSS, puis le PHP.</p>

    <aside>
      <h3>À retenir</h3>
      <p>Un seul <code>&lt;main&gt;</code> par page.</p>
    </aside>
  </article>
</main>',
          'preview' => true,
          'explainFr' => '<code>article</code> représente le billet complet ; son <code>header</code> interne porte le titre et la date. <code>aside</code> ajoute une note sans casser la lecture principale.',
          'explainDarija' => '<code>article</code> howa billet kamel ; <code>header</code> dakhli fih titre w date. <code>aside</code> kayzid note bla ma ykhesr lqraya principale.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'div reste utile',
          'fr' => '<code>div</code> n\'est pas interdit : c\'est un conteneur neutre, parfait quand aucune balise sémantique ne correspond. Mais évitez d\'en mettre partout par réflexe.',
          'darija' => '<code>div</code> machi mamnou3 : howa conteneur neutre, mzyan melli ma kaynch balise sémantique li katmatch. Walakin ma t3awedch t7ettha f kol blasa.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'accessibilite-semantique',
      'title' => 'Accessibilité et bonnes pratiques',
      'icon' => '♿',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les balises sémantiques sont la base de l\'accessibilité : un lecteur d\'écran peut sauter directement au <code>main</code>, lister les <code>nav</code> ou annoncer le <code>footer</code>. Trois réflexes : une hiérarchie de titres correcte (h1 puis h2…), des liens explicites, et des images avec un <code>alt</code> utile.</p>',
          'darija' => '<p>Balises sémantiques homa asas dyal accessibilité : lecteur d\'écran kayqder ymchi nichan l <code>main</code>, ylister les <code>nav</code>, w y3len <code>footer</code>. Tlata dyal réflexes : hiérarchie dyal titres mzyana (h1 men ba3d h2…), liens wad7in, w images b <code>alt</code> mzyan.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Titres et navigation accessibles',
          'lang' => 'html',
          'code' => '<header>
  <h1>Mon portfolio</h1>
  <nav aria-label="Navigation principale">
    <ul>
      <li><a href="#projets">Mes projets</a></li>
      <li><a href="#contact">Me contacter</a></li>
    </ul>
  </nav>
</header>

<main id="projets">
  <h2>Mes projets</h2>
  <img src="projet.png" alt="Aperçu du projet de gestion de bibliothèque">
</main>',
          'preview' => true,
          'explainFr' => 'Le <code>alt</code> décrit l\'image à ceux qui ne la voient pas. Les liens disent où ils mènent (« Me contacter » plutôt que « cliquez ici »).',
          'explainDarija' => '<code>alt</code> kaychra7 image l li ma kaychofhach. Liens kaygolo fin kaymchiw (« Me contacter » 7sen men « cliquez ici »).',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Sauter des niveaux de titres',
          'fr' => 'Passer de <code>h1</code> à <code>h4</code> casse la structure logique. Utilisez <code>h2</code> pour les grandes sections, <code>h3</code> pour les sous-sections, etc. Le niveau doit suivre le contenu, pas la taille du texte.',
          'darija' => 'Tdowez men <code>h1</code> l <code>h4</code> kaykhesr structure. Khdem b <code>h2</code> l sections kbar, <code>h3</code> l sous-sections… Niveau khas ytbe3 contenu, machi chekl dyal texte.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => '<div class="header">…</div>',
      'fix' => '<header>…</header>',
      'fr' => 'Utiliser des <code>div</code> avec des classes qui imitent la sémantique. La balise native donne le sens gratuitement, sans classe ni JavaScript.',
      'darija' => 'Khdem <code>div</code> b classes li kayqaldo sémantique. Balise native kat3ti ma3na blach classe wla JavaScript.',
    ),
    1 => 
    array (
      'wrong' => 'Plusieurs <main> dans la même page',
      'fix' => 'Un seul <main> par page ; les zones secondaires utilisent section ou aside.',
      'fr' => 'Le <code>main</code> est unique : il représente le contenu principal. Les autres blocs vont dans <code>section</code>, <code>article</code> ou <code>aside</code>.',
      'darija' => '<code>main</code> howa wa7ed : kaymettel contenu principal. Les blocs l okhrin kaymchiw f <code>section</code>, <code>article</code> wla <code>aside</code>.',
    ),
    2 => 
    array (
      'wrong' => '<h1>Accueil</h1> puis <h4>Nos services</h4>',
      'fix' => '<h1>Accueil</h1> puis <h2>Nos services</h2>',
      'fr' => 'La hiérarchie des titres doit être continue : h1 → h2 → h3. Sauter un niveau désoriente les lecteurs d\'écran.',
      'darija' => 'Hiérarchie dyal titres khas tkoun metselsla : h1 → h2 → h3. Ila tqbezt niveau, lecteurs d\'écran kaytlef.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Le <strong>HTML sémantique</strong> choisit les balises selon leur sens : <code>header</code>, <code>nav</code>, <code>main</code>, <code>section</code>, <code>article</code>, <code>aside</code> et <code>footer</code>. Une page a un seul <code>main</code>, des titres hiérarchisés et des liens explicites. On gagne en accessibilité, en référencement et en lisibilité du code.',
    'darija' => '<strong>HTML sémantique</strong> kaykhtar balises 3la 7sab ma3na : <code>header</code>, <code>nav</code>, <code>main</code>, <code>section</code>, <code>article</code>, <code>aside</code> w <code>footer</code>. Page khas ykon fiha <code>main</code> wa7ed, titres mrtatbin w liens wad7in. Kanrbe7o f accessibilité, SEO w qraya dyal code.',
  ),
);
