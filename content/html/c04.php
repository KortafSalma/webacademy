<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 4 : Liens et images
 * Exemplaire de référence pour TOUS les fichiers de chapitre :
 *   - id : "module-chN"
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : résumé FR + Darija
 * Types de blocs :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'html-ch4',
    'title'    => 'Liens et images',
    'subtitle' => 'Créer des liens vers d’autres pages et insérer des images',

    'objectives' => [
        'Utiliser la balise <a> pour créer un lien hypertexte.',
        'Distinguer un lien absolu d’un lien relatif.',
        'Insérer une image avec la balise <img> et les attributs src, alt.',
        'Comprendre le concept d’attribut alt pour l’accessibilité.',
        'Utiliser des cibles de lien (_blank, _self).',
    ],

    'lessons' => [
        // ------------------------------------------------ Section 1 : Les liens hypertextes
        [
            'id'    => 'les-liens',
            'title' => 'Les ancres et liens',
            'icon'  => '🔗',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Un <strong>lien hypertexte</strong> permet de naviguer d\'une page web à another en cliquant sur du texte, une image ou un bouton. La balise <code><a></code> (anchor) est l\'élément fondamental du Web.</p>',
                 'darija' => '<p>Lia hyperlien kay9der navigu9der mn une page l9et l9et a another b cliquant 9la texte, image w bouton. Balise <code><a></code> (anchor) howa l\'élément fudamental dy Web.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code'  => '<a href="adresse_du_lien">Texte du lien</a>',
                 'title' => 'Syntaxe de base du lien'],

                ['type' => 'example',
                 'title' => 'Exemple de lien vers une page externe',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page d\'accueil</title>
</head>
<body>
  <p>Visitez <a href="https://www.example.com">Example.com</a> pour en savoir plus.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Le navigateur ouvrira la page https://www.example.com lorsqu\'on cliquera sur le lien.',
                 'explainDarija' => 'Navigateur kay9der https://www.example.com bach kayclick 9la liaison.'],
            ],
        ],

        // ------------------------------------------------ Section 2 : Liens relatifs et absolus
        [
            'id'    => 'relatif-absolu',
            'title' => 'Liens relatifs vs absolus',
            'icon'  => '📍',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Un <strong>lien absolu</strong> contient l\'adresse complète (protocole + domaine + chemin), par exemple <code>https://www.example.com/page.html</code>. Un <strong>lien relatif</strong> ne contient que la partie chemin, par exemple <code>pages/contact.html</code>. Le navigateur complète le lien relatif avec l\'adresse de la page courante.</p>',
                 'darija' => '<p>Lia <strong>absolue</strong> kay9der address kamla (protokol + domain + chemin), wlia <strong>relative</strong> kay9derchi chemin sans protokol w domain, hadi kay9der complété b address de page courante.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code' => '<a href="pages/contact.html">Contact</a> <!-- Lien relatif --><br><a href="https://example.com">Example</a> <!-- Lien absolu -->',
                 'title' => 'Exemples de liens relatifs et absolus'],

                ['type' => 'example',
                 'title' => 'Lien vers une page du même site',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon site</title>
</head>
<body>
  <p>Retour <a href="accueil.html">à la page d\'accueil</a>.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Le navigateur cherchera le fichier accuell.html dans le même dossier que la page actuelle.',
                 'explainDarija' => 'Navigateur kaysearch fichier accueil.html f9der mn dossier de page actuelle.'],
            ],
        ],

        // ------------------------------------------------ Section 3 : Les images
        [
            'id'    => 'les-images',
            'title' => 'Insérer des images',
            'icon'  => '🖼️',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>La balise <code><img></code> permet d\'insérer une image dans une page HTML. Elle est auto-fermante (pas de tag de fermeture). L\'attribut <code>src</code> indique l\'emplacement de l\'image, et <code>alt</code> fournit un texte alternatif pour l\'accessibilité et si l\'image ne peut pas s\'afficher.</p>',
                 'darija' => '<p>Balise <code><img></code> kay9der insérer image f page HTML. Hia auto-fermante (pas tag fermeture). Attribut <code>src</code> kay9deremplacement image, w <code>alt</code> kay9der texte alternatif pour l\'accessibilité et si l\'image ne peut pas s\'afficher.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'html',
                 'code' => '<img src="image.jpg" alt="Description de l\'image">',
                 'title' => 'Syntaxe de base de l\'image'],

                ['type' => 'example',
                 'title' => 'Exemple d\'image avec texte alternatif',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page avec image</title>
</head>
<body>
  <h1>Bienvenue</h1>
  <p>Voici une illustration :</p>
  <img src="chat.jpg" alt="Photo d\'un chat gris perché sur un mur">
  <p>Crédit photo : <a href="https://unsplash.com">Unsplash</a></p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'L\'image chat.jpg s\'affichera avec comme description texte « Photo d\'un chat gris perché sur un mur » si elle ne s\'affiche pas ou pour les lecteurs d\'écran.',
                 'explainDarija' => 'Had image howa chat.jpg kay9der s9der bach kay9der text alternatif « Photo d\'un chat gris perché sur un mur » bach ma tkounah t9der t9der bach kayest2al oral.'],

                // Image avec lien
                ['type' => 'example',
                 'title' => 'Image cliquable (lien vers une autre page)',
                 'lang'  => 'html',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Image cliquable</title>
</head>
<body>
  <p>Cliquez sur l\'image :</p>
  <a href="apropos.html">
    <img src="logo.png" alt="Logo de l\'entreprise">
  </a>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'L\'image agit comme un bouton menant à la page apropos.html.',
                 'explainDarija' => 'Image kay9der bach kayclick bach kaywwola l9 page apropos.html.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser des espaces dans le nom de fichier : <code>mon image.jpg</code>',
            'fix'    => 'Utiliser des underscores ou des tirets : <code>mon_image.jpg</code> ou <code>mon-image.jpg</code>',
            'fr'     => 'Les espaces dans les noms de fichiers causent des erreurs d\'affichage sur le Web. Préférez les underscores (_) ou les tirets (-) sans espaces.',
            'darija' => 'Spaces f names de fichiers kay9der errors d\'affichage f Web. I9der underscores (_) w tirets (-) bach spaces.',
        ],
        [
            'wrong'  => 'Oublier l\'attribut alt : <code><img src="photo.jpg"></code>',
            'fix'    => 'Toujours ajouter un attribut alt significatif : <code><img src="photo.jpg" alt="Description de l\'image"></code>',
            'fr'     => 'L\'attribut alt est indispensable pour l\'accessibilité (lecteurs d\'écran) et si l\'image ne charge pas. Il ne doit pas être vide pour une image informative.',
            'darija' => 'Attribut alt kay9der l\'accessibility w si image9der s\'charge pas. Ma kayn khali bach image informative.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>HTML</strong> : les ancres (<code><a></code>) créent les liens, avec href en absolu ou relatif. Les images (<code><img></code>) s\'insèrent avec src et alt. Interdiction d\'avoir des espaces dans les noms de fichiers et d\'oublier l\'attribut alt.',
        'darija' => 'HTML : liens kay9der b balise <code><a></code> w href absolu w relatif. Images kay9der b <code><img></code> w src w alt. Interdiction spaces f names fichiers w oubli attribut alt.',
    ],
];