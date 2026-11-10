<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 1 : Introduction au développement web
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
    'id'       => 'html-ch1',
    'title'    => 'Introduction au développement web',
    'subtitle' => 'Comment Internet fonctionne-t-il, et quel rôle joue chaque technologie ?',

    'objectives' => [
        'Comprendre ce qu\'est le Web et à quoi il sert.',
        'Distinguer le client (navigateur) du serveur.',
        'Comprendre la différence front-end / back-end.',
        'Connaître le rôle de HTML, CSS, JavaScript et PHP.',
        'Distinguer un site statique d\'un site dynamique.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'quest-ce-que-le-web',
            'title' => 'C\'est quoi le Web ?',
            'icon'  => '🌍',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le <strong>Web</strong> (World Wide Web) est un service d\'Internet constitué de millions de <strong>pages reliées par des liens</strong>. Chaque page est un fichier que le navigateur télécharge et affiche.</p><p>Quand vous tapez une adresse (par exemple <code>www.google.com</code>), deux machines communiquent :</p><ul><li>votre <strong>navigateur</strong> (Chrome, Firefox…) est le <em>client</em> : il demande une page ;</li><li>un ordinateur puissant appelé <strong>serveur web</strong> répond : il envoie la page demandée.</li></ul><p>Cette communication utilise le protocole <strong>HTTP</strong> ou sa version sécurisée <strong>HTTPS</strong>.</p>',
                 'darija' => '<p>Le Web c\'est kolchi les pages liées bin AHOM b des liens. Mnin katktb adresse f navigateur, had navigateur (callou client) kaymchi yodlob la page, w serveur web howa li kayjaweb : kayseft lik la page. La communication bin client w serveur katwalli b protocole smitou HTTP.</p>'],

                ['type' => 'definition', 'title' => 'Client / Serveur',
                 'fr'   => '<p><strong>Client :</strong> logiciel qui demande un service (le navigateur est le client HTTP).<br><strong>Serveur :</strong> machine + logiciel qui répond à la demande et envoie les fichiers (HTML, images…).</p>',
                 'darija' => '<p>Client howa li kaytalb (navigateur dyalek), Serveur howa li kayjaweb : ordinateur fiha w had la machine dyal serveur fih services kayrespondi.</p>'],

                ['type' => 'example',
                 'title' => 'La plus petite page web du monde',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma première page</title>
</head>
<body>
  <h1>Salam !</h1>
  <p>Ceci est ma première page web.</p>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Voici une page HTML complète et valable. Le navigateur lit ce fichier de haut en bas et affiche « Salam ! » en gros titre.',
                 'explainDarija' => 'Had fichier howa page HTML kamla. Le navigateur kayqraha mn fouq le te9a, w kayaffichi « Salam ! » b tier kbir (titre).'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'front-back',
            'title' => 'Front-end vs Back-end',
            'icon'  => '🎭',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Un site web a <strong>deux faces</strong> :</p><ul><li><strong>Front-end</strong> (côté client) : tout ce que l\'utilisateur voit — mise en page, couleurs, boutons. Technologies : <strong>HTML, CSS, JavaScript</strong>, exécutées <em>dans le navigateur</em>.</li><li><strong>Back-end</strong> (côté serveur) : la logique invisible — traitements, calculs, accès à la base de données. Technologies : <strong>PHP, SQL</strong>, exécutées <em>sur le serveur</em>.</li></ul>',
                 'darija' => '<p>Le site 3andou jouj wjos :<br><b>Front-end</b> : kolchi li kaychof l\'utilisateur — HTML, CSS, JS, kolchi kaykhdem f navigateur.<br><b>Back-end</b> : kolchi li mkhfi — logique, base de données. Kaykhdem f serveur : PHP, SQL.</p>'],

                ['type' => 'table',
                 'headers' => ['Technologie', 'Où ça tourne', 'Son rôle'],
                 'rows' => [
                    ['HTML', 'Navigateur', 'Structure et contenu de la page'],
                    ['CSS', 'Navigateur', 'Apparence : couleurs, tailles, mise en page'],
                    ['JavaScript', 'Navigateur', 'Interactions dans le navigateur (animations, vérifs)'],
                    ['PHP', 'Serveur', 'Traitement des données, logique, e-mails…'],
                    ['SQL', 'Serveur (SGBD)', 'Lire / écrire les données dans la base'],
                 ],
                 'fr' => '`HTML` fait la structure, `CSS` l\'apparence, `JS` l\'interactivité, `PHP` la logique serveur, `SQL` les données.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'statique-dynamique',
            'title' => 'Site statique vs site dynamique',
            'icon'  => '⚡',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p><strong>Site statique :</strong> chaque page est un fichier HTML fixe. 100 visiteurs → la même page 100 fois. Idéal pour une vitrine.</p><p><strong>Site dynamique :</strong> la page est <em>fabriquée à la demande</em> par le serveur (PHP) qui interroge une <strong>base de données</strong> (SQL). Le même fichier <code>article.php</code> affiche tous les articles du site : c\'est Facebook, YouTube, les sites e-commerce…</p>',
                 'darija' => '<p><b>Site statique</b> : les pages fixe, kol visiteur kaychof nefs la page.<br><b>Site dynamique</b> : la page katbni f waght hada (à la demande) b PHP li kayqra database. Nefs fichier kayaffichi des milliers d\'articles — hadi hiya Facebook, YouTube, les sites e-commerce…</p>'],

                ['type' => 'tip',
                 'title' => 'Pourquoi ce cours commence par HTML ?',
                 'fr'   => 'PHP est fabriqué pour créer du HTML. Impossible de bien écrire du PHP sans comprendre le HTML qu\'il produit.',
                 'darija' => 'PHP kaybni HTML, donc khassek tfhem HTML 3lach bach t3qel PHP mn bach ktb PHP mzyan.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'html = "langage de programmation"',
            'fix'    => 'html = langage de BALISAGE (markup)',
            'fr'     => 'HTML n\'a pas de logique (conditions, boucles) : ce n\'est pas un langage de programmation, c\'est un langage de <strong>balisage</strong> qui décrit la structure.',
            'darija' => 'HTML machi langage d programming : ma fiha foreach, ila if. Hia langage de balisage katrahow structure dyal la page.',
        ],
        [
            'wrong'  => 'PHP, JS s\'excute tous deux dans le navigateur',
            'fix'    => 'JS → navigateur | PHP → serveur',
            'fr'     => 'JavaScript s\'exécute dans le navigateur ; PHP s\'exécute sur le serveur. On ne voit jamais le code PHP en inspectant une page publiée.',
            'darija' => 'JS kaykhdem f navigateur w PH PAGE kaykhdem f serveur, donc ma kayn la code PHP machi visible ila inspectitvia la page f internet.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Le Web</b> relie des pages au protocole HTTP. Le <b>navigateur</b> (client) demande, le <b>serveur</b> répond. <b>HTML</b> structure, <b>CSS</b> habille, <b>JS</b> anime (front-end). <b>PHP</b> calcule et <b>SQL</b> stocke (back-end). Un site <b>dynamique</b> assemble chaque page à la demande.',
        'darija' => 'Hadi hiya les points mohimmin ! <b>HTML</b> katrahow structure dyal la page, <b>CSS</b> tbeddel apparence dyalha, <b>JS</b> kadir interactions — kolchi li kaykhdem f navigateur. <b>PHP + SQL</b> kaykhdmo f serveur : logique w data. Site statique baqi fixe, site dynamique katbni à la demande b PHP w SQL.',
    ],
];
