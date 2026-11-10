<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 2 : Structure d'un document HTML
 * Squelette d'une page : DOCTYPE, html, head, body, title, meta,
 * commentaires, indentation, validation W3C.
 * Types de blocs utilisés :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'html-ch2',
    'title'    => 'Structure d\'un document HTML',
    'subtitle' => 'Le squelette obligatoire de chaque page web : de quoi est fait un fichier HTML valide ?',

    'objectives' => [
        'Écrire le squelette complet d\'une page HTML valide de mémoire.',
        'Comprendre le rôle de DOCTYPE, html, head et body.',
        'Utiliser la balise title et savoir où elle s\'affiche.',
        'Connaître les meta essentielles : charset, viewport, description.',
        'Écrire des commentaires et indenter son code proprement.',
        'Valider une page avec le validateur W3C du consortium.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'squelette-de-base',
            'title' => 'Le squelette d\'une page HTML',
            'icon'  => '🦴',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Toute page web repose sur le <strong>même squelette</strong> : quatre balises principales, toujours dans le même ordre. Un fichier HTML est comme un document officiel : il a un <em>en-tête</em> (ce qu\'on ne voit pas) et un <em>corps</em> (ce qu\'on voit à l\'écran). Mémorisez cet ordre une fois : vous réécrirez ce squelette sur chaque page de votre carrière.</p>',
                 'darija' => '<p>Kol page web katbdel b nefs le squelette : 4 balises kbira, dima b nefs tartib. Un fichier HTML bhal un document officiel : fih raas (head = kolchi li makaybanch f la page) w jism (body = kolchi li kayban l\'utilisateur). 7fed had tartib mera we7da 7it ba3da dima nefs l7aja.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Le squelette minimal d\'une page',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
  </head>
  <body>
    <!--Tout le contenu visible ici-->
  </body>
</html>'],

                ['type' => 'table',
                 'headers' => ['Élément', 'Rôle', 'Visible dans la page ?'],
                 'rows' => [
                    ['&lt;!DOCTYPE html&gt;', 'Annonce : « ce fichier est du HTML5 »', 'Non (déclaration, pas une balise)'],
                    ['&lt;html&gt;', 'Racine du document, englobe tout', 'Non'],
                    ['&lt;head&gt;', 'Métadonnées : titre, charset, description…', 'Non'],
                    ['&lt;body&gt;', 'Tout le contenu affiché à l\'écran', 'Oui'],
                 ],
                 'fr' => 'Deux zones à retenir : <code>head</code> = informations <em>pour le navigateur</em>, <code>body</code> = contenu <em>pour le visiteur</em>.'],

                ['type' => 'example',
                 'title' => 'Une page complète et valide',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma page de présentation</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Bonjour, je commence à apprendre le HTML.</p>
</body>
</html>',
                 'output' => 'Un grand titre « Bienvenue sur mon site » suivi d\'un paragraphe ; « Ma page de présentation » apparaît dans l\'onglet du navigateur.',
                 'preview' => true,
                 'explainFr' => 'Le contenu visible (h1, p) est dans body. Le title, lui, ne s\'affiche pas dans la page mais dans l\'onglet du navigateur.',
                 'explainDarija' => 'Kolchi li kaybanch (h1, p) f body. Le title makaybanch f la page — kaybanch f loujab (onglet) dyal navigateur.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'doctype-et-html',
            'title' => 'DOCTYPE et balise html',
            'icon'  => '📜',
            'blocks' => [

                ['type' => 'definition', 'title' => 'DOCTYPE',
                 'fr'   => '<p><strong>&lt;!DOCTYPE html&gt;</strong> est la <em>première ligne</em> de tout fichier HTML. Ce n\'est pas une balise : c\'est une déclaration qui dit au navigateur « ce document est du HTML5, applique les règles modernes ». Sans elle, le navigateur passe en mode « vieil artéfact » (quirks mode) et l\'affichage devient imprévisible.</p>',
                 'darija' => '<p><strong>&lt;!DOCTYPE html&gt;</strong> hiya salle line f fichier, machi balise : hiya déclaration katgol le navigateur « had document dyal HTML5 ». Bla DOCTYPE, navigateur kaydkhol f quirks mode (mode 9dim) w affichage kaywalli ghrib. Dima ktbha f lowel.</p>'],

                ['type' => 'text',
                 'fr'   => '<p>La balise <code>&lt;html lang="fr"&gt;</code> est la <strong>racine</strong> : tout le reste du document vit entre <code>&lt;html&gt;</code> et <code>&lt;/html&gt;</code>. L\'attribut <code>lang</code> déclare la langue principale du contenu (« fr » pour français, « ar » pour arabe, « en » pour anglais).</p><p>La langue déclarée est utilisée par : les <strong>lecteurs d\'écran</strong> (choix de la prononciation), les <strong>moteurs de traduction</strong>, et le <strong>seo</strong> (moteurs de recherche).</p>',
                 'darija' => '<code>&lt;html lang="fr"&gt;</code> hiya racine (la racine dyal chajra) : kolchi binat &lt;html&gt; w &lt;/html&gt;. L\'attribut <code>lang</code> kaygol le navigateur bchi lo9a : « fr » fransa, « ar » arabe, « en » anglais. Had lang kaynfa3 les lecteurs d\'écran, la traduction, w le SEO.</p>'],

                ['type' => 'warning',
                 'title' => 'Deux erreurs de débutant',
                 'fr'   => '<p>Ne jamais confondre : <code>doctype</code> sans majuscules et sans balise fermée &mdash; il s\'écrit exactement <code>&lt;!DOCTYPE html&gt;</code>. Et une seule balise <code>&lt;html&gt;</code> par fichier : pas besoin d\'en mettre deux.</p>',
                 'darija' => '<p>Matkheltch bin les deux : <code>doctype</code> dima b nefs le style : &lt;!DOCTYPE html&gt;, ma fihach balise de fermeture. W balise &lt;html&gt; wa7da pol fichier, machi jouj.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'head-title-meta',
            'title' => 'La balise head : title et meta',
            'icon'  => '🧠',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La <code>&lt;head&gt;</code> est le <strong>cahier administratif</strong> de la page : des informations <em>à propos</em> de la page, jamais affichées dans son corps. On y place : le titre, l\'encodage, la description, les liens vers les fichiers CSS… Ici, nous étudions les trois essentielles.</p>',
                 'darija' => '<p>La <code>&lt;head&gt;</code> hiya le cahier administratif dyal la page : des infos 3al page, walakin makaybanch f la page b rasseha (fih title dyal onglet, charset, description, w les fichiers CSS…). Hna ghan9arrou fjouj essentielles.</p>'],

                ['type' => 'definition', 'title' => 'title — le nom de la page',
                 'fr'   => '<p><strong>&lt;title&gt;</strong> donne un nom à la page. Il s\'affiche dans <strong>l\'onglet</strong> du navigateur, dans <strong>l\'historique</strong>, dans les <strong>favoris</strong>, et c\'est aussi le premier texte que montrent les moteurs de recherche. Une page sans title est considérée comme non valide.</p>',
                 'darija' => '<p><strong>&lt;title&gt;</strong> kay3ti smiya l page : kaybanch f tab (loujab), f historique, w f moteurs de recherche. Page bla title mghalb. Dima donne un titre mohim w court.</p>'],

                ['type' => 'example',
                 'title' => 'Le title s\'affiche dans l\'onglet',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiche cours HTML - Chapitre 2</title>
</head>
<body>
  <h1>Chapitre 2</h1>
</body>
</html>',
                 'output' => 'L\'onglet du navigateur affiche « Fiche cours HTML - Chapitre 2 » tandis que la page elle-même affiche « Chapitre 2 ».',
                 'preview' => true,
                 'explainFr' => 'title et h1 sont deux choses différentes : title est pour l\'onglet (et Google), h1 est le titre visible dans la page.',
                 'explainDarija' => 'title w h1 7eddi_7edrin : title mach f loujab w f Google, h1 howa le titre li kaybanch f la page b rasseha.'],

                ['type' => 'text',
                 'fr'   => '<p>Une balise <strong>meta</strong> déclare une <em>métadonnée</em> : une information au sujet de la page, écrite sous forme d\'attributs. Les trois indispensables : <code>charset</code>, <code>viewport</code>, <code>description</code>.</p>',
                 'darija' => '<p>Balise <strong>meta</strong> kat3ti des informations 3al page, via des attributs. 3 meta essentielles khassek dima dctezhom : <code>charset</code>, <code>viewport</code>, <code>description</code>.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Les trois meta à connaître',
                 'code' => '<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Cours de HTML pour débutants : chapitre 2.">'],

                ['type' => 'table',
                 'headers' => ['meta', 'À quoi ça sert', 'Conséquence si absente'],
                 'rows' => [
                    ['charset="UTF-8"', 'Déclare l\'encodage : permet d\'afficher é, à, ç… et les caractères arabes', 'Accents affichés en « Ã© » ou carrés □'],
                    ['name="viewport"', 'Adapte la page à la largeur de l\'écran du téléphone', 'Sites miniatures illisibles sur mobile'],
                    ['name="description"', 'Résumé de la page affiché dans les résultats de recherche', 'Google invente un extrait de la page'],
                 ],
                 'fr' => 'Placez ces trois lignes dans <code>head</code>, sur chaque page. Encore mieux : commencez chaque fichier à partir d\'un modèle qui les contient déjà.'],

                ['type' => 'tip',
                 'title' => 'Le piège des accents « Ã© »',
                 'fr'   => '<p>Si un texte affiche <code>Ã©<\/code> au lieu de <code>é</code>, c\'est un problème d\'encodage : soit <code>meta charset</code> est absente, soit le fichier a été enregistré dans un encodage différent (ISO-8859-1). Éditeur en UTF-8 + meta charset="UTF-8" = problèmes résolus.</p>',
                 'darija' => '<p>Ila banch <code>Ã©</code> f blast &quot;é&quot;, hadi mochkil dyal encodage : imma meta charset ghariba, imma le fichier msc ISSO-8859-1. Kolchi f UTF-8 (éditeur + meta) = kolchi mzyan.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'commentaires-et-indentation',
            'title' => 'Commentaires et indentation',
            'icon'  => '✍️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un <strong>commentaire</strong> HTML commence par <code>&lt;!--</code> et se termine par <code>--&gt;</code>. Rien de ce qui est écrit dedans n\'est exécuté ni affiché : c\'est un message que vous laissez <em>à vous-même</em> ou à vos collègues, directement dans le code source.</p>',
                 'darija' => '<p><strong>Commentaire</strong> kaybdel b &lt;!-- w kayssala b --&gt;. Makaynch li kayssedch, makaybanch f la page : hiya message khass direk f code, dyalek nta w dyal les collègues dyalek.</p>'],

                ['type' => 'example',
                 'title' => 'Utiliser les commentaires',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Commentaires</title>
</head>
<body>
  <!--En-tête du site : ne pas toucher ce bloc cette semaine-->
  <h1>Boutique Al-Mousika</h1>

  <!--Le prix en promo : à mettre à jour chaque lundi-->
  <p>Nouveau prix : 120 MAD</p>

  <!--Bloc désactivé pour tests :
  <p>Ancien prix : 150 MAD</p>
  -->
</body>
</html>',
                 'output' => 'La page affiche « Boutique Al-Mousika » et « Nouveau prix : 120 MAD ». L\'ancien prix est masqué par le commentaire.',
                 'preview' => true,
                 'explainFr' => 'Le commentaire sert à la documentation… mais aussi à désactiver temporairement un bloc de code (le bloc « ancien prix » n\'apparaît pas).',
                 'explainDarija' => 'Le commentaire fih deux usages : documentation (dir comment 3lach dert had code), w zid kat3awek bach tt-activer wa7d bloc temporairement : bloc dyal ancien prix hna ma kaybanch f la page 7it dakhlo f comment.'],

                ['type' => 'text',
                 'fr'   => '<p>L\'<strong>indentation</strong> est le décalage horizontal des lignes : chaque balise incluse dans une autre est décalée vers la droite (2 espaces ou une tabulation). HTML <em>fonctionne</em> même tout à gauche, mais un code non indenté devient illisible dès 30 lignes : bon courage pour retrouver la balise non fermée.</p>',
                 'darija' => '<p>L\'<strong>indentation</strong> hiya décalage dyal les lignes : kol balise ghoula f balise okhra katnqel chrroma (2 espaces wla une tabulation). HTML kaykhdem mezyan 7ta ila kolchi chrror, walakin code bla indentation kaywalli ma ila 3endek 30 lines : sari3 bach tl9a balise ma mssadatch.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Indentation : lisible vs illisible',
                 'code' => '<!--Lisible : chaque niveau décalé de 2 espaces-->
<body>
  <div class="carte">
    <h2>Produit</h2>
    <p>Description</p>
  </div>
</body>

<!--Illisible : tout sur une ligne, imbuvable à maintenir-->
<body><div class="carte"><h2>Produit</h2><p>Description</p></div></body>'],

                ['type' => 'warning',
                 'title' => 'Un commentaire mal fermé casse la page',
                 'fr'   => '<p>Si vous oubliez <code>--&gt;</code> de fin de commentaire, <em>tout ce qui suit</em> est considéré comme du commentaire et disparaît de la page. C\'est une erreur classique quand on supprime un bloc : vérifiez toujours la fermeture.</p>',
                 'darija' => '<p>Contre-temps : tansa &lt;!-- --&gt; dyal la fermeture, kolchi li ba3dha kaydkhol f comment w kayghiyyeb mn la page. Wa7d classic dyal les erreurs mnin katms7 wa7d block : check dima ha kayn la fermeture --&gt;.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 5
        [
            'id'    => 'validation-w3c',
            'title' => 'Valider sa page avec le W3C',
            'icon'  => '✅',
            'blocks' => [

                ['type' => 'definition', 'title' => 'Le W3C',
                 'fr'   => '<p>Le <strong>W3C</strong> (World Wide Web Consortium) est l\'organisme qui écrit les standards du Web : HTML, CSS, accessibilité. Il fournit un <strong>validateur</strong> gratuit en ligne : vous donnez l\'URL de votre page (ou collez le code), il liste les erreurs de balisage.</p>',
                 'darija' => '<p>Le <strong>W3C</strong> howa l\'organisme li kata9 les standards dyal le Web : HTML, CSS, accessibilité. 3endhom validateur (outil) matloch wa7d page dyalek fih URL dyalek (wla Directory copy code) : kay9olek les erreurs dyal balisage.</p>'],

                ['type' => 'text',
                 'fr'   => '<p>Pourquoi valider ? Une page valide se <strong>comporte de façon prévisible</strong> dans tous les navigateurs, est mieux lue par les moteurs de recherche, et les erreurs déclarées cachent souvent la vraie cause d\'un bug d\'affichage. Utilisez le validateur : <em>validator.w3.org</em>. Les erreurs classiques qu\'il signale : balise jamais fermée, attribut mal orthographié, élément dans le mauvais parent, DOCTYPE manquant.</p>',
                 'darija' => '<p>3lach nvalidou ? Une page valide katkhdem b nefs tari9a f kol navigateur, katqra mzyan mn les moteurs de recherche, w souvent les erreurs d\'affichage kayn aslouhm f des balises ghalta. Khdem b validator.w3.org : kaykhrrej lik had les erreurs : balise ma mssadatch, attribut ghalta, element f parent ghalta, DOCTYPE manquant.</p>'],

                ['type' => 'example',
                 'title' => 'Trouver l\'erreur avant le validateur',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page à corriger</title>
</head>
<body>
  <h1>Recette du week-end</h1>
  <p>Préchauffez le four.
  <p>Enfournez 30 minutes.</p>
</body>
</html>',
                 'output' => 'Le premier paragraphe n\'a pas de balise fermée : &lt;p&gt;Préchauffez le four. devrait se terminer par &lt;/p&gt;.',
                 'preview' => true,
                 'explainFr' => 'Ici, l\'erreur est &lt;p&gt;Préchauffez le four. sans &lt;/p&gt;. Le W3C signalera « Ouverture de l\'élément p non terminée ». Prenez l\'habitude de relire en vérifiant chaque balise ouverte a sa fermeture.',
                 'explainDarija' => 'Hna le ghalat : Awal &lt;p&gt; ma mssadouch b &lt;/p&gt;. Le validateur kay9ol « Ouverture de l\'élément p non terminée ». 3awed karri bin les balises li 7allit w li ghal9it.'],

                ['type' => 'tip',
                 'title' => 'Méthode de travail',
                 'fr'   => '<p>Créez un fichier <code>modele.html</code> contenant le squelette complet (doctype + head avec les 3 meta + body) et copiez-le pour chaque nouvelle page : zéro oubli, création plus rapide.</p>',
                 'darija' => '<p>Dreb wa7d fichier <code>modele.html</code> fih le squelette kamel (doctype + head b 3 meta + body), w kola mera katbad page jdida kopih : jac ma mssatch, w khdma sri3.</p>'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Mettre du contenu visible dans head',
            'fix'    => 'Tout le contenu visible va dans body',
            'fr'     => '<code>head</code> est réservé aux métadonnées (title, meta…). Un titre ou un paragraphe qui s\'y trouve n\'apparaît pas correctement, et le W3C le signale comme erreur.',
            'darija' => '<code>head</code> ghir mn les infos (title, meta…). Ila ktabbti h1 wla p jdouana, makaybanch mzyan, w le W3C kaysayblik hadi ghalta.',
        ],
        [
            'wrong'  => 'Oublier meta charset="UTF-8"',
            'fix'    => 'Toujours ajouter meta charset="UTF-8" dans head',
            'fr'     => 'Sans cette meta, les accents (é, è, ç) et le texte arabe risquent de s\'afficher en caractères bizarres ou en carrés.',
            'darija' => 'Bla had meta, les accents w le texte arabe kayban 3lihom les caracteres ghribin w les carres. Dima ktbha f head.',
        ],
        [
            'wrong'  => 'Confondre title et h1',
            'fix'    => 'title = onglet du navigateur | h1 = titre visible dans la page',
            'fr'     => 'Ce sont deux éléments différents : le title vit dans head, le h1 dans body. Une page a besoin des deux.',
            'darija' => 'Homa jouj elements mokhtalefin : title kaydakhal f head (kaybanch f loujab), h1 kaydakhal f body (kaybanch f la page). Les jouj khasskoun 3endek.',
        ],
        [
            'wrong'  => 'Commentaire non fermé : <!-- blabla sans la fin',
            'fix'    => 'Fermer chaque commentaire par --&gt;',
            'fr'     => 'Un commentaire non fermé masque toute la suite de la page : le contenu disparaît sans message d\'erreur apparent.',
            'darija' => 'Commentaire ma mssadouch kay ghiyyeb kolchi li ba3do f la page, walakin HTML ma kaysiblih hta erreur. Rand check la fermeture --&gt;.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Squelette</b> : DOCTYPE → html lang → head (title + meta) → body. <b>head</b> = infos pour le navigateur et les moteurs de recherche, <b>body</b> = contenu visible. Les 3 meta à ne pas oublier : charset, viewport, description. <b>Commentaires</b> : &lt;!-- … --&gt;, pour documenter ou masquer du code. <b>Indentation</b> : un décalage par niveau de structure. Et validez sur <b>validator.w3.org</b>.',
        'darija' => 'Squelette : DOCTYPE &gt; html lang &gt; head (title + meta) &gt; body. La <b>head</b> fih les infos, la <b>body</b> fih kolchi kayban. 3 meta dima ktbhom : charset, viewport, description. <b>Commentaires</b> : &lt;!-- w --&gt;, bach to7sen code wla tkhreb bloc. <b>Indentation</b> : chaque niveau à droite (2 espaces). W validi la page f validator.w3.org.',
    ],
];
