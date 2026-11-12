<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 5 : console.log, commentaires et structure du code
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch5',
    'title'    => 'console.log, commentaires et structure du code',
    'subtitle' => 'Afficher des informations et organiser son code.',
    'level'    => 'Débutant',
    'minutes'  => 35,
    'prerequisites' => ['Savoir ouvrir la console du navigateur'],

    'objectives' => [
        'Utiliser console.log pour afficher différents types de valeurs.',
        'Rédiger des commentaires clairs pour documenter le code.',
        'Structurer un script JavaScript de base.',
        'Comprendre l\'ordre d\'exécution d\'un script.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'console-log-basique',
            'title' => 'console.log basique',
            'icon'  => '🖥️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La méthode <code>console.log()</code> est la plus utilisée pour afficher des messages dans la console de développement. Elle peut accepter une ou plusieurs valeurs séparées par des virgules. Ce qui s\'affiche peut être du texte (entre guillemets), des nombres, des variables, ou même des objets et des tableaux.</p>',
                 'darija' => '<p>Méthode <code>console.log()</code> kay9der kayktb messages f console development. Kay9der y9der valeur wla plus b9der séparés par virgule. Kay9der text (b guillemets), nombres, variables, wla objets w tableaux.'],

                ['type' => 'example', 'title' => 'Afficher plusieurs valeurs',
                 'lang'  => 'javascript',
                 'code'  => 'const prenom = "Yasmine";\nconst age = 25;\nconsole.log("Bonjour, je m\'appelle " + prenom + " j\'ai " + age + " ans.");\nconsole.log("Valeur de age :", age);',
                 'explainFr' => 'Les valeurs sont concatenées avec l\'opérateur +. Le second log affiche la variable age seule suivie de sa valeur.',
                 'explainDarija' => 'Valeurs kaylsse9 b operator +. Second log kay9der variable age wla valeur.'],

                ['type' => 'example', 'title' => 'Afficher des objets',
                 'lang'  => 'javascript',
                 'code'  => 'const personne = { nom: "Mohamed", age: 30, actif: true };\nconsole.log(personne);\nconsole.log("Nom : " + personne.nom);',
                 'explainFr' => 'Afficher un objet affiche toutes ses propriétés. On peut y accéder avec la notation point personne.nom.',
                 'explainDarija' => 'Afficher objet kay9der kol propriétés. Y9der y9der b notation point personne.nom.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'commentaires-structure',
            'title' => 'Commentaires et structure du code',
            'icon'  => '📝',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les commentaires sont essentiels pour rendre le code lisible et maintenable. Ils ne sont pas exécutés par le navigateur. Il existe deux types de commentaires :</p><ul><li><strong>Commentaires sur une ligne</strong> avec <code>//</code> : tout ce qui suit sur la même ligne est ignoré.</li><li><strong>Commentaires sur plusieurs lignes</strong> avec <code>/* ... */</code> : tout ce qui est entre les délimiteurs est ignoré.</li></ul><p>Il est de bonne pratique de commenter les blocs de code importants et d\'expliquer pourquoi on fait quelque chose, plutôt que ce que fait le code (le code devrait être auto-explicite).</p>',
                 'darija' => '<p>Commentaires kay9der kayl9der code lisible w maintenable. Ma kaynafidhomch navigation. Kolchi b 2 types :</p><ul><li><strong>Commentaires sur une ligne</strong> b <code>//</code> : kay9der kay7et l9der f l9der line. <li><strong>Commentaires sur plusieurs lignes</strong> b <code>/* ... */</code> : kay9der kay7et b9der délimitateurs.</li></ul><p>Bonne pratique : commenter blocs code importants w expliquer pourquoi on fait quelque chose, pas ce que fait code (code dy9der kay9der s\'explique tout seul).</p>'],

                ['type' => 'example', 'title' => 'Tous les styles de commentaires',
                 'lang'  => 'javascript',
                 'code'  => '// Commentaire sur une ligne\n\n# Commentaire équivalent (même résultat en bash)\n\n/* Commentaire\n   sur plusieurs lignes */\n\nconsole.log("Ignoré");',
                 'explainFr' => 'Chaque style de commentaire a sa syntaxe, mais ils sont tous ignorés par le moteur JavaScript.',
                 'explainDarija' => 'Kol style commentaire kay9der syntax, kay9der kay7et b9der navigation.'],

                ['type' => 'true_false',
                 'question' => 'Les commentaires affectent les performances du navigateur.',
                 'answer' => 1,
                 'concept' => 'Performance',
                 'explainFr' => 'Faux : les commentaires sont supprimés avant l\'exécution, ils n\'ont aucun impact sur les performances.',
                 'explainDarija' => 'Ghalat : commentaires supprimaient b9der execution, kay9der aucun impact performance.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'structure-script',
            'title' => 'Structure de base d\'un script',
            'icon'  => '🏗️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un script JavaScript bien structuré commence généralement par : <br>1. Les constantes et variables au sommet. <br>2. Les fonctions ensuite. <br>3. Le code d\'exécution (ou l\'appel de fonctions) en dernier. Cette organisation en "couches" facilite la lecture et la maintenance.</p>',
                 'darija' => '<p>Script JavaScript bien structuré kay9der b9der : <br>1. Variables w constantes en haut. <br>2. Functions ensuite. <br>3. Code execution ou appels functions en dernier. Had organisation b9der lisibilité w maintenabilité.'],

                ['type' => 'example', 'title' => 'Script structuré',
                 'lang'  => 'javascript',
                 'code'  => '// 1. Constantes\nconst API_URL = "https://api.example.com";\n\n// 2. Fonctions\nfunction fetchData(url) {\n  return fetch(url).then(response => response.json());\n}\n\n// 3. Exécution\nfetchData(API_URL)\n  .then(data => console.log("Données :", data))\n  .catch(error => console.error("Erreur :", error));',
                 'explainFr' => 'Placer les fonctions après les constantes et l\'exécution en bas rend le script facile à lire.',
                 'explainDarija' => 'Placer functions après constants w execution en bas kay9der script kay9der kay9der kay9der easy lire.'],

                ['type' => 'mcq',
                 'question' => 'Dans quel ordre un script JavaScript s\'exécute-t-il généralement ?',
                 'options' => ['Fonctions d\'abord, puis variables', 'Variables et constantes d\'abord, puis fonctions, puis code d\'exécution', 'Code d\'exécution d\'abord, puis variables'],
                 'answer' => 1,
                 'concept' => 'Structure de script',
                 'explainFr' => 'Les variables et constantes sont définies en premier, les fonctions viennent après, et le code d\'exécution (ou les appels) se trouve tout en bas.',
                 'explainDarija' => 'Variables w constantes defined b9der, functions kay9der, w code execution w appels tout en bas.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-code-structure',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Complétez le code : // C\'est un commentaire sur ____ ligne.',
                 'answer' => 'une',
                 'concept' => 'Commentaires',
                 'explainFr' => 'S\'écrit avec deux slashes //.',
                 'explainDarija' => 'S\'écrit b deux slashes //.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces options est un commentaire sur plusieurs lignes ?',
                 'options' => ['// texte', '/* texte */', '<!-- texte -->'],
                 'answer' => 1,
                 'concept' => 'Styles commentaires',
                 'explainFr' => 'Les /* et */ délimitent un commentaire sur plusieurs lignes.',
                 'explainDarija' => '/* w */ kay9der ydemarcate commentaire l9der.'],

                ['type' => 'true_false',
                 'question' => 'Il est inutile de commenter du code bien écrit.',
                 'answer' => 1,
                 'concept' => 'Best practices',
                 'explainFr' => 'Faux : même un code propre bénéficie de commentaires pour aider les autres (ou soi-même plus tard) à comprendre l\'intention.',
                 'explainDarija' => 'Ghalat : code propre b9der commentaires b9der a9der yfham b9der (wla soi m3a l9der).'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser trop de commentaires en excès',
            'fix'    => 'Commenter uniquement lesintentions complexes ou non évidentes',
            'fr'     => 'Le code devrait être auto-explicite ; les commentaires servent à clarifier le pourquoi, pas le quoi.',
            'darija' => 'Code kay9der kay9der s\'explique tout seul ; commentaires kay9der kay9der yclarifier pourquoi, machi quoi.'],
        ],
        [
            'wrong'  => 'Oublier de fermer les commentaires sur plusieurs lignes',
            'fix'    => 'Vérifier que chaque /* a son pair de */',
            'fr'     => 'Un commentaire non fermé peut "commenter" tout le code qui suit.',
            'darija' => 'Commentaire kay9der ma kay7et pair kay9der */ kay9der kay7et commenter code b9der.'],
    ],

    'summary' => [
        'fr' => '<strong>console.log()</strong> affiche n\'importe quelle valeur dans la console. Les commentaires (// pour une ligne, /* */ pour plusieurs lignes) ne sont pas exécutés. Structurez votre code : constantes et variables en haut, fonctions après, exécution en bas. Cela rend le code plus lisible et plus facile à maintenir.',
        'darija' => '<strong>console.log()</strong> kayktb kay value f console. Commentaries // b l9der w /* */ b9der l9der kay9der kay7et kay7et kay7et b9der execution. Structurez code : variables w constantes en haut, functions après, execution en bas. Had code kay9der kay9der lisible w maintenable.'],
    ],
];