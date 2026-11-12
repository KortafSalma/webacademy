<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 4 : Environnement de développement et premier script
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch4',
    'title'    => 'Environnement de développement et premier script',
    'subtitle' => 'Comment écrire et exécuter votre premier code JavaScript.',
    'level'    => 'Débutant',
    'minutes'  => 30,
    'prerequisites' => ['Aucun'],

    'objectives' => [
        'Configurer un environnement de développement pour JavaScript.',
        'Écrire un script JavaScript basique dans un fichier .html.',
        'Utiliser console.log pour afficher des résultats.',
        'Comprendre la structure de base d\'une page web avec script intégré.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'environnement-dev',
            'title' => 'Configurer son environnement',
            'icon'  => '⚙️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour développer en JavaScript, vous avez besoin d\'un éditeur de code (comme VS Code, Sublime Text ou Atom) et d\'un navigateur web moderne (Chrome, Firefox, Safari, Edge). Aucun installation n\'est nécessaire : JavaScript tourne déjà dans votre navigateur. Cependant, pour travailler en local ou sur Node.js, vous pouvez installer Node.js depuis nodejs.org qui inclut npm (gestionnaire de paquets).</p>',
                 'darija' => '<p>Pour dyal development JavaScript, kay7et editor code (VS Code, Sublime Text wla Atom) w navigation web moderne (Chrome, Firefox, Safari, Edge). Kaydima installation m3ida : JavaScript kaykhdem f navigation m3ich installation. Wlkhir bach t3awmo f local wla Node.js, kay7et nodejs.org kaym3ich npm.</p>'],

                ['type' => 'example', 'title' => 'Structure de base d\'une page HTML avec JavaScript',
                 'lang'  => 'html+javascript',
                 'code'  => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Premier script</title>\n</head>\n<body>\n  <h1>Bienvenue</h1>\n  <script>\n    // Mon premier script JavaScript\n    console.log("Salam WebAcademy !");\n  </script>\n</body>\n</html>',
                 'explainFr' => 'Le code <code><script></code> peut être placé dans <code><head></code> ou <code><body></code>. Le code s\'exécute lorsque la page se charge.</p>',
                 'explainDarija' => '<code><script></code> kaybda f head wla body. Code kay7et b3d page kaylaadet.'],

                ['type' => 'tip',
                 'title' => 'Où placer le code JavaScript ?',
                 'fr'   => 'Vous pouvez placer le code <code><script></code> : <br>• Dans <code><head></code> (c\'est chargé avant l\'affichage). <br>• Dans <code><body></code> (c\'est chargé après les éléments HTML). <br>• En fichier externe via <code>src="script.js"</code>.',
                 'darija' => 'Code script kaybda : b head (ycharge b3d affichage), b body (ycharge b3la elements), wla fichier externe src="script.js".'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'premier-script',
            'title' => 'Votre premier script',
            'icon'  => '🎉',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour écrire votre premier script, ouvrez un fichier <code>.html</code> et ajoutez la balise <code><script></code>. Tout ce qui est entre <code><script></code> et <code>?></code> est du code JavaScript. La façon la plus simple de tester est d\'utiliser la console du navigateur : appuyez sur F12, allez dans l\'onglet "Console", et tapez directement du code.</p>',
                 'darija' => '<p>Bach tkteb premier script, kay7et fichier .html w bala tag script. Kol chi btw script w ? script kay9der t7ot f console navigation b3d appui F12 w onglet "Console".'],

                ['type' => 'example', 'title' => 'console.log basique',
                 'lang'  => 'javascript',
                 'code'  => 'console.log("Salam !");\nconsole.log(42);\nconsole.log(true);',
                 'explainFr' => 'Chaque instruction se termine par un point-virgule. L\'ordre d\'exécution est le même que l\'ordre d\'écriture.</p>',
                 'explainDarija' => 'Kol instruction b point-virgule. Ordre execution kay9der b3d l9der ktub.'],

                ['type' => 'example', 'title' => 'Commentaires et structure',
                 'lang'  => 'javascript',
                 'code'
                 'code'  => '// Ceci est un commentaire sur une ligne\n\n# Ceci est aussi un commentaire (même résultat)\n\n/* Ceci est un\n   commentaire sur\n   plusieurs lignes */\n\nconsole.log("Bonjour");',
                 'explainFr' => 'Les commentaires sont ignorés par le navigateur. Ils servent à documenter le code.',
                 'explainDarija' => 'Commentaires ma kaynafidhomch navigation. Kay9der kaydoc code.'],

                ['type' => 'true_false',
                 'question' => 'On peut écrire du JavaScript sans balises HTML.',
                 'answer' => 0,
                 'concept' => 'Syntaxe JavaScript',
                 'explainFr' => 'Vrai dans le sens où la console du navigateur accepte du code brut, mais pour une page web, les balises <code><script></code> sont nécessaires.',
                 'explainDarija' => 'B7al console navigation kay9der code brut, b page web, tag script breqi.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces méthodes s\'utilise pour ouvrir la console de développement ?',
                 'options' => ['F1', 'F5', 'F12'],
                 'answer' => 2,
                 'concept' => 'Outils de développement',
                 'explainFr' => 'F12 ouvre les outils de développement dans la plupart des navigateurs.',
                 'explainDarija' => 'F12 kay9der y9der tools development mla plupart navigation.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'test-developpement',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Complétez le code : const message = "Bonjour" ; console.log(______) ;',
                 'answer' => 'message',
                 'concept' => 'Affichage de variable',
                 'explainFr' => 'On peut afficher une variable directement dans console.log.',
                 'explainDarija' => 'Kay9der kayktb variable b7direct f console.log.'],

                ['type' => 'mcq',
                 'question' => 'Quel est le but de console.log() ?',
                 'options' => ['Modifier le HTML', 'Afficher dans la console', 'Créer une alerte'],
                 'answer' => 1,
                 'concept' => 'console.log',
                 'explainFr' => 'console.log écrit un message dans la console de développement, pas directement dans la page.',
                 'explainDarija' => 'console.log kaykteb message f console development, machi f page direct.'],

                ['type' => 'true_false',
                 'question' => 'JavaScript peut s\'exécuter dans n\'importe quel navigateur sans installation supplémentaire.',
                 'answer' => 0,
                 'concept' => 'Exécution navigateur',
                 'explainFr' => 'Vrai : JavaScript est intégré dans tous les navigateurs modernes. Aucune installation n\'est nécessaire pour du code basique.',
                 'explainDarija' => 'Vrai : JavaScript kaykhdem f kol navigation moderne b7ad installation.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les balises <script>',
            'fix'    => 'Toujours encadrer le code JavaScript par <?php ... ?> ou <script> ... </script>',
            'fr'     => 'Sans balises script, le navigateur traite le code comme du texte brut.',
            'darija' => 'Bla tag script, navigation ma kaykhed code kaybda b texte brut.',
        ],
        [
            'wrong'  => 'Oublier le point-virgule à la fin des instructions',
            'fix'    => 'Vérifier visuellement chaque ligne se terminant par ;',
            'fr'     => 'L\'oubli de point-virgule provoque des erreurs d\'exécution ou des résultats inattendus.',
            'darija' => 'Ila nsah 9sire point-virgule : errors execution w résultats inattendus.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> s\'écrit à l\'intérieur des balises <script> dans une page HTML. Pas d\'installation n\'est nécessaire dans le navigateur. On utilise <code>console.log()</code> pour afficher des messages en développement. Chaque instruction se termine par un point-virgule. Les commentaires (// ou /* */) documentent le code sans l\'exécuter.',
        'darija' => '<strong>JavaScript</strong> ktib f tag script f page HTML. Kay7et installation m3ich f navigation. Kay7et <code>console.log()</code> bach tf3awich messages f development. Kol instruction tam b ;. Commentaires // w /* */ kaydoc code b9der m3awdo m3a execution.'],
    ],
];