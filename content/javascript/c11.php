<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 1 : Qu'est-ce que JavaScript ?
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch1',
    'title'    => 'Qu\'est-ce que JavaScript ?',
    'subtitle' => 'Le langage qui rend les pages vivantes : où il tourne, ce qu\'il peut faire et comment écrire son premier script.',
    'level'    => 'Débutant',
    'minutes'  => 30,
    'prerequisites' => ['Savoir lire une page HTML simple (balises, attributs)'],

    'objectives' => [
        'Expliquer le rôle de JavaScript dans une page web.',
        'Distinguer HTML, CSS et JavaScript.',
        'Comprendre où le code JavaScript s\'exécute.',
        'Écrire et exécuter un premier script avec console.log.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'langage-du-navigateur',
            'title' => 'Le langage qui rend la page vivante',
            'icon'  => '⚡',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>HTML décrit le <strong>contenu</strong>, CSS décrit l\'<strong>apparence</strong>, et <strong>JavaScript</strong> décrit le <strong>comportement</strong>. C\'est le seul des trois langages qui peut prendre des décisions, réagir à un clic, vérifier un formulaire, animer un élément ou envoyer une requête sans recharger la page.</p><p>Sans JavaScript, une page reste statique : les liens fonctionnent, mais rien ne se passe réellement dans la page. Avec JavaScript, un bouton peut changer un texte, un menu peut s\'ouvrir, un panier peut se mettre à jour instantanément.</p>',
                 'darija' => '<p>HTML kaywsef <b>contenu</b>, CSS kaywsef <b>apparence</b>, w <b>JavaScript</b> kaywsef <b>comportement</b>. Howa l\'lougha wa7ed li kayqder yakhod decisions, ytf3al m3a clic, yverifi formulaire, y7rek élément, wla yseft requête bla ma t3awed tcharji page.</p><p>Bla JavaScript, page katbqa statique : les liens kaykhdmo, walakin walou ma kayt7arek f page. M3a JavaScript, bouton kayqder ybedel texte, menu kayt7el, panier kayt3adal direct.</p>'],

                ['type' => 'table',
                 'headers' => ['Langage', 'Rôle', 'Exemple'],
                 'rows' => [
                     ['HTML', 'Structure et contenu', 'Un titre, un paragraphe, un bouton'],
                     ['CSS', 'Apparence et mise en page', 'Couleur, taille, espacement'],
                     ['JavaScript', 'Comportement et logique', 'Réagir au clic, calculer, afficher'],
                 ],
                 'fr' => 'Les trois langages collaborent : HTML fournit les éléments, CSS les habille, JavaScript les fait réagir.',
                ],

                ['type' => 'definition', 'title' => 'JavaScript (JS)',
                 'fr'   => '<p><strong>JavaScript</strong> est un langage de programmation créé en 1995 pour les navigateurs. Aujourd\'hui, il sert aussi côté serveur (Node.js), dans les applications mobiles et sur les objets connectés. Son nom contient « Java », mais c\'est un langage totalement différent de Java.</p>',
                 'darija' => '<p><b>JavaScript</b> langage de programmation tsawb f 1995 l navigateurs. Lyoum kaykhdem 7tta côté serveur (Node.js), f applications mobiles w objets connectés. Smiytou fiha « Java », walakin howa lougha mkhtalfa 3la Java.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'ou-s-execute-js',
            'title' => 'Où s\'exécute JavaScript ?',
            'icon'  => '🌐',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Dans une page web, JavaScript est exécuté par le <strong>moteur JavaScript du navigateur</strong> : V8 pour Chrome et Edge, SpiderMonkey pour Firefox, JavaScriptCore pour Safari. Le code arrive avec la page, puis le navigateur l\'exécute sur la machine du visiteur.</p><p>JavaScript peut aussi tourner <strong>hors du navigateur</strong> grâce à Node.js. Dans ce cas, il n\'y a ni page HTML ni <code>document</code> : le code lit des fichiers, lance un serveur ou manipule des données.</p>',
                 'darija' => '<p>F page web, JavaScript kaynfed b <b>moteur JavaScript dyal navigateur</b> : V8 f Chrome w Edge, SpiderMonkey f Firefox, JavaScriptCore f Safari. Code kayji m3a page, w navigateur kaynfdo f PC dyal visiteur.</p><p>JavaScript kayqder 7tta ykhdem <b>bara mn navigateur</b> b Node.js. F had l7ala, ma kaynch page HTML wla <code>document</code> : code kayqra fichiers, kayslanci serveur, wla kaykhdem 3la données.</p>'],

                ['type' => 'warning',
                 'title' => 'Côté client ne veut pas dire sans danger',
                 'fr'   => 'Le code JavaScript envoyé au navigateur est <strong>visible</strong> par l\'utilisateur et peut être modifié. On ne met donc jamais de mot de passe, de clé secrète ou de règle de sécurité uniquement en JavaScript côté client : la vérification finale doit se faire sur le serveur.',
                 'darija' => 'Code JavaScript li kayseft l navigateur <b>kayban</b> l utilisateur w kayqder ybedlo. 3lach ma kandirouch mot de passe, clé secrète wla règle de sécurité ghir f JavaScript côté client : vérification l\'akhira khass tkoun f serveur.'],

                ['type' => 'table',
                 'headers' => ['Environnement', 'Accès au HTML', 'Usage typique'],
                 'rows' => [
                     ['Navigateur', 'Oui, via le DOM', 'Interactions, formulaires, animations'],
                     ['Node.js', 'Non', 'Serveurs, scripts, outils en ligne de commande'],
                 ],
                 'fr' => 'Le même langage, deux environnements : les objets disponibles ne sont pas identiques. <code>document</code> existe dans le navigateur, pas dans Node.js.',
                ],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'premier-script',
            'title' => 'Votre premier script',
            'icon'  => '🚀',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour exécuter du JavaScript dans une page, on utilise la balise <code>&lt;script&gt;</code>. Le code peut être écrit directement entre les balises ou placé dans un fichier séparé avec l\'attribut <code>src</code>. La console du navigateur (<code>F12</code> puis onglet Console) affiche les messages et les erreurs.</p>',
                 'darija' => '<p>Bach tnfed JavaScript f page, katkhdem b balise <code>&lt;script&gt;</code>. Code yqder ykoun direct bin balises wla f fichier separé b attribut <code>src</code>. Console dyal navigateur (<code>F12</code> mn ba3d onglet Console) kat3red messages w erreurs.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Inclure un script dans une page',
                 'code' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Premier script</title>
</head>
<body>
  <h1>Ma première page interactive</h1>

  <script>
    console.log("Salam, JavaScript !");
  </script>
</body>
</html>'],

                ['type' => 'example',
                 'title' => 'Un script qui réagit à un clic',
                 'lang'  => 'javascript',
                 'code'  => 'const bouton = document.getElementById("action");
const message = document.getElementById("message");

bouton.addEventListener("click", () => {
    message.textContent = "Le bouton a été cliqué !";
    console.log("Clic détecté");
});',
                 'output' => 'Après un clic : « Le bouton a été cliqué ! » dans la page et « Clic détecté » dans la console.',
                 'explainFr' => '<code>document.getElementById</code> récupère un élément HTML. <code>addEventListener</code> enregistre une fonction exécutée plus tard, au moment du clic. <code>textContent</code> modifie le texte affiché.',
                 'explainDarija' => '<code>document.getElementById</code> kayjib élément HTML. <code>addEventListener</code> kaysejjel fonction li katkhdem mn ba3d, f wa9t clic. <code>textContent</code> kaybedel texte li kayban.'],

                ['type' => 'tip',
                 'title' => 'Toujours ouvrir la console',
                 'fr'   => 'La console est votre meilleur outil de diagnostic. Elle affiche la valeur des variables, les erreurs de syntaxe et les erreurs d\'exécution avec leur numéro de ligne. Un développeur JavaScript garde la console ouverte en permanence.',
                 'darija' => 'Console howa a7san outil dyal diagnostic. Kat3red valeur dyal variables, erreurs de syntaxe w erreurs d\'exécution m3a numéro de ligne. Développeur JavaScript kaykhelli console m7loula dima.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'console-et-commentaires',
            'title' => 'console.log, commentaires et structure',
            'icon'  => '🧰',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><code>console.log()</code> affiche une valeur dans la console. C\'est l\'instruction la plus utilisée pour comprendre ce qui se passe dans un programme. Les commentaires, eux, sont ignorés par le moteur : ils servent à expliquer le code aux humains.</p>',
                 'darija' => '<p><code>console.log()</code> kay3red valeur f console. Hiya instruction li katkhdem ktar bach tfhem chno kayt7arek f programme. Comments, moteur kaytjahalhom : kayn ghir bach tchar7 code l humains.</p>'],

                ['type' => 'example',
                 'title' => 'Variables, calcul et affichage',
                 'lang'  => 'javascript',
                 'code'  => '// Un commentaire sur une ligne
const prenom = "Amine";
let age = 20;

/* Ce commentaire
   tient sur plusieurs lignes. */
const anneeNaissance = 2026 - age;

console.log("Prenom : " + prenom);
console.log("Annee de naissance :", anneeNaissance);',
                 'output' => 'Prenom : Amine\nAnnee de naissance : 2006',
                 'explainFr' => '<code>const</code> déclare une valeur qui ne sera pas réassignée, <code>let</code> une valeur modifiable. Le signe <code>+</code> colle deux chaînes ; la virgule dans <code>console.log</code> ajoute une valeur séparée.',
                 'explainDarija' => '<code>const</code> kat3len valeur li ma ghadi tbedelch, <code>let</code> valeur li tqder tbedel. Signe <code>+</code> kaylsse9 jouj chaînes ; virgule f <code>console.log</code> katzid valeur mfreqa.'],

                ['type' => 'syntax',
                 'lang' => 'javascript',
                 'title' => 'Les deux styles de commentaires',
                 'code' => '// Commentaire sur une seule ligne

/*
   Commentaire sur plusieurs lignes.
   Utile pour expliquer un bloc complexe.
*/

console.log("Le moteur ignore les commentaires");'],

                ['type' => 'note',
                 'title' => 'Un fichier JavaScript séparé',
                 'fr'   => 'En pratique, on place le code dans un fichier <code>.js</code> et on l\'inclut avec <code>&lt;script src="script.js" defer&gt;&lt;/script&gt;</code>. L\'attribut <code>defer</code> attend que le HTML soit analysé avant d\'exécuter le script, ce qui évite les erreurs du type « élément introuvable ».',
                 'darija' => 'F pratique, code kayt7et f fichier <code>.js</code> w kaytdkhel b <code>&lt;script src="script.js" defer&gt;&lt;/script&gt;</code>. Attribut <code>defer</code> kaytsenna HTML ytqra qbel exécution, w hadchi kayweqef erreurs dyal « élément introuvable ».'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Confondre JavaScript et Java',
            'fix'    => 'Retenir que ce sont deux langages différents, sans lien technique direct',
            'fr'     => 'JavaScript et Java partagent une partie de leur nom, mais leurs syntaxes, leurs usages et leurs écosystèmes sont distincts. JavaScript est le langage du navigateur ; Java est utilisé pour d\'autres types d\'applications.',
            'darija' => 'JavaScript w Java kaytcharKo ghir f smiya, walakin syntaxe, usage w écosystème mkhtalfin. JavaScript lougha dyal navigateur ; Java kayst5dem f applications okhra.',
        ],
        [
            'wrong'  => 'Placer un script avant les éléments HTML qu\'il utilise',
            'fix'    => 'Mettre le script en fin de body ou ajouter l\'attribut defer',
            'fr'     => 'Si le script s\'exécute avant que le bouton existe, <code>getElementById</code> renvoie <code>null</code> et l\'appel suivant provoque une erreur. <code>defer</code> règle ce problème.',
            'darija' => 'Ila script khdem qbel ma ykoun bouton, <code>getElementById</code> kayrje3 <code>null</code> w appel mora kay3ti erreur. <code>defer</code> kay7el had problème.',
        ],
        [
            'wrong'  => 'Croire que console.log affiche le résultat dans la page',
            'fix'    => 'Utiliser textContent ou innerHTML pour modifier la page',
            'fr'     => '<code>console.log</code> écrit uniquement dans la console de développement. Pour changer ce que voit le visiteur, il faut modifier un élément du DOM.',
            'darija' => '<code>console.log</code> kaykteb ghir f console dyal développement. Bach tbedel chi haja li kaychofha visiteur, khassek tbedel élément f DOM.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>JavaScript</b> est le langage du comportement : il réagit aux clics, valide les formulaires, calcule et modifie la page. Il s\'exécute dans le <b>navigateur</b> (V8, SpiderMonkey, JavaScriptCore) ou avec <b>Node.js</b> côté serveur. On l\'inclut avec <code>&lt;script&gt;</code>, on affiche des valeurs avec <code>console.log</code>, et les commentaires <code>//</code> ou <code>/* … */</code> documentent le code sans être exécutés.',
        'darija' => '<b>JavaScript</b> howa lougha dyal comportement : kaytf3al m3a clics, kayverifi formulaires, kay7seb w kaybedel page. Kaykhdem f <b>navigateur</b> (V8, SpiderMonkey, JavaScriptCore) wla b <b>Node.js</b> côté serveur. Kaytdkhel b <code>&lt;script&gt;</code>, kay3red valeurs b <code>console.log</code>, w comments <code>//</code> wla <code>/* … */</code> kaychar7o code bla ma ytnfed.',
    ],
];
