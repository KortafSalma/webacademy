<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 12 : Boucles : for, while, do...while
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch12',
    'title'    => 'Boucles : for, while, do...while',
    'subtitle' => 'Répéter des actions avec des structures de boucle.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['Savoir utiliser les conditions if/else'],

    'objectives' => [
        'Écrire une boucle for pour itérer un nombre connu de fois.',
        'Utiliser while et do...while pour les conditions inconnues.',
        'Comprendre les instructions break et continue.',
        'Éviter les boucles infinies.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'boucle-for',
            'title' => 'La boucle for',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La boucle <code>for</code> s\'écrit : <code>for (initialisation; condition; incrémentation)</code>. Elle répète le bloc tant que la condition est vraie. C\'est idéal quand on connaît le nombre d\'itérations à l\'avance.</p>',
                 'darija' => '<p>Boucle <code>for</code> s\'écrit : <code>for (initialisation; condition; incrémentation)</code>. Répète bloc tant que condition vraie. Idéal quand nombre d\'itérations connu à l\'avance.'],

                ['type' => 'example', 'title' => 'Boucle for classique',
                 'lang'  => 'javascript',
                 'code'  => 'for (let i = 0; i < 5; i++) {\n  console.log("Tour n°" + i);\n}\n// Affiche : Tour n°0, Tour n°1, ..., Tour n°4',
                 'explainFr' => 'i commence à 0, continue tant que i < 5, incrémente i de 1 à chaque tour.',
                 'explainDarija' => 'i commence 0, continue tant i < 5, incrémente i de 1 à chaque tour.'],

                ['type' => 'mcq',
                 'question' =>'Que va afficher cette boucle ?\nfor (let i = 0; i < 3; i++) {\n  console.log(i);\n}' ,
                 'options' => '0 1 2', '0 1 2 3', '1 2 3', 'Erreur',
                 'answer' => 0,
                 'concept' => 'for loop',
                 'explainFr' => 'i vaut 0, 1, 2 (3 fois, pas 3 car i < 3).',
                 'explainDarija' => 'i vaut 0, 1, 2 (3 fois, pas 3 car i < 3).'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'boucle-while',
            'title' => 'La boucle while',
            'icon'  => '⏳',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La boucle <code>while</code> répète tant que la condition est vraie, mais elle vérifie la condition <strong>au début</strong>. Si la condition est fausse dès le premier test, le bloc ne s\'exécutera jamais.</p>',
                 'darija' => '<p>Boucle <code>while</code> répète tant que condition vraie, mais vérifie <strong>au début</strong>. Si condition fausse d\'abord, bloc ne s\'exécutera jamais.'],

                ['type' => 'example', 'title' => 'while basique',
                 'lang'  => 'javascript',
                 'code'  => 'let i = 0;\nwhile (i < 3) {\n  console.log(i);\n  i++;\n}',
                 'explainFr' => 'Affiche 0, 1, 2. Après i++, i devient 3 et la condition échoue.',
                 'explainDarija' => 'Affiche 0, 1, 2. Après i++, i devient 3 condition échoue.'],

                ['type' => 'true_false',
                 'question' => 'Une boucle while s\'exécute au moins une fois même si la condition est fausse d\'abord.',
                 'answer' => 1,
                 'concept' => 'while vérifie au début',
                 'explainFr' => 'Faux : si la condition est fausse au début, le bloc ne s\'exécute jamais.',
                 'explainDarija' => 'Faux : si condition fausse d\'abord, bloc ne s\'exécute jamais.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'boucle-do-while',
            'title' => 'La boucle do...while',
            'icon'  => '🔁',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La boucle <code>do...while</code> est similaire à <code>while</code>, mais elle vérifie la condition <strong>à la fin</strong>. Le bloc s\'exécute donc <strong>au moins une fois</strong>, même si la condition est fausse immédiatement après.</p>',
                 'darija' => '<p>Boucle <code>do...while</code> similaire à <code>while</code>, mais vérifie condition <strong>à la fin</strong>. Bloc s\'exécute donc <strong>au moins une fois</strong>, même si condition fausse immédiatement.'],

                ['type' => 'example', 'title' => 'do...while basique',
                 'lang'  => 'javascript',
                 'code'  => 'let i = 0;\n do {\n   console.log(i);\n   i++;\n } while (i < 3);',
                 'explainFr' => 'Affiche 0, 1, 2. Après le dernier i++ (valeur 3), la condition i < 3 est fausse et la boucle s\'arrête.',
                 'explainDarija' => 'Affiche 0, 1, 2. Après i++ (valeur 3), condition i < 3 fausse boucle s\'arrête.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces boucles s\'exécute au moins une fois ?',
                 'options' => 'for (let i = 0; i < 0; i++) {}', 'while (false) {}', 'do { } while (false);',
                 'answer' => 2,
                 'concept' => 'do...while',
                 'explainFr' => 'do...while exécute le bloc une fois avant de tester la condition.',
                 'explainDarija' => 'do...while exécute bloc une fois avant tester condition.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'break-continue',
            'title' => 'break et continue',
            'icon'  => '⛔⏭️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><code>break</code> sort immédiatement de la boucle (ou du switch), quel que soit le contexte. <code>continue</code> saute l\'itération en cours et passe directement au prochain passage de la boucle.</p>',
                 'darija' => '<p><code>break</code> sort immédiatement boucle (ou switch). <code>continue</code> saute itération courante et passe au prochain passage.'],

                ['type' => 'example', 'title' => 'Utiliser continue',
                 'lang'  => 'javascript',
                 'code'  => 'for (let i = 0; i < 5; i++) {\n  if (i === 2) {\n    continue; // saute le tour où i vaut 2\n  }\n  console.log(i);\n}\n// Affiche : 0, 1, 3, 4',
                 'explainFr' => 'Quand i === 2, continue passe au prochain i sans afficher 2.',
                 'explainDarija' => 'Quand i === 2, continue passe au prochain i sans afficher 2.'],

                ['type' => 'example', 'title' => 'Utiliser break',
                 'lang'  => 'javascript',
                 'code'  => 'for (let i = 0; i < 10; i++) {\n  if (i === 5) {\n    break; // sort de la boucle entièrement\n  }\n  console.log(i);\n}\n// Affiche : 0, 1, 2, 3, 4',
                 'explainFr' => 'La boucle s\'arrête complètement quand i === 5. Affiche seulement 0 à 4.',
                 'explainDarija' => 'Boucle s\'arrête complètement i === 5. Affiche seulement 0 à 4.'],

                ['type' => 'mcq',
                 'question' => 'Que fait continue dans une boucle ?',
                 'options' => 'Sortir de la boucle', 'Sauter l\'itération courante', 'Ralentir la boucle',
                 'answer' => 1,
                 'concept' => 'continue',
                 'explainFr' => 'continue saute l\'itération en cours et passe au prochain passage.',
                 'explainDarija' => 'continue saute itération courante w passe au prochain passage.'],

            ],
        ],

        // ------------------------------------------------ Section 5
        [
            'id'    => 'test-boucles',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'La boucle qui s\'exécute au moins une fois s\'appelle _____ .',
                 'answer' => 'do...while',
                 'concept' => 'do...while',
                 'explainFr' => 'do...while teste la condition à la fin.',
                 'explainDarija' => 'do...while teste condition à la fin.'],

                ['type' => 'mcq',
                 'question' =>'Que affiche ce code ?\nfor (let i = 0; i < 3; i++) {\n  if (i === 1) continue;\n  console.log(i);\n}' ,
                 'options' => '0 1 2', '0 2', '1 2', 'Erreur',
                 'answer' => 1,
                 'concept' => 'continue',
                 'explainFr' => '1 est sauté, affiche 0 et 2.',
                 'explainDarija' => '1 sauté, affiche 0 et 2.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel affiche 0 1 2 3 4 ?',
                 'code_a' => 'for (let i = 0; i < 5; i++) { if (i === 3) break; console.log(i); }',
                 'code_b' => 'for (let i = 0; i < 5; i++) { if (i === 3) continue; console.log(i); }',
                 'answer' => 1,
                 'concept' => 'break w continue',
                 'explainFr' => 'break s\'arrête à 3 ; continue saute 3 mais continue après.',
                 'explainDarija' => 'break s\'arrête à 3 ; continue saute 3 mais continue après.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Créer une boucle infinie sans condition d\'arrêt',
            'fix'    => 'Vérifiez toujours que la condition de la boucle finira par devenir fausse.',
            'fr'     => 'Vérifiez que chaque passage de boucle modifie une variable qui entre dans la condition.',
            'darija' => 'Vérifiez kay9der variable b9der entrée condition kayder f9der fausse.'],
        ],
        [
            'wrong'  => 'Confondre break et continue',
            'fix'    => 'Rappelez-vous : break sort de la boucle, continue saute l\'itération.',
            'fr'     => 'break sort de la boucle entirely ; continue passe au prochain tour.',
            'darija' => 'break sort boucle entirely, continue passe tour prochain.'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose trois types de boucles : <code>for</code> (quand on connaît le nombre d\'itérations), <code>while</code> (tant que condition vraie, vérifie au début), et <code>do...while</code> (exécute au moins une fois, vérifie à la fin). <code>break</code> sort de la boucle, <code>continue</code> saute l\'itération courante.',
        'darija' => '<strong>JavaScript</strong> kay9der 3 types boucles : <code>for</code> (connu nombre itérations), <code>while</code> (tant que condition vraie, vérifie b9der), w <code>do...while</code> (exécute au moins une fois, vérifie fin). <code>break</code> sort boucle, <code>continue</code> saute itération courante.'],
    ],
];