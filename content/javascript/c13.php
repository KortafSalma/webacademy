<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 13 : Fonctions, paramètres et retour
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch13',
    'title'    => 'Fonctions, paramètres et retour',
    'subtitle' => 'Créer et appeler des fonctions avec des arguments.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['Savoir utiliser les variables et les types'],

    'objectives' => [
        'Déclarer une fonction avec le mot-clé function.',
        'Passer des paramètres à une fonction.',
        'Utiliser return pour renvoyer une valeur.',
        'Comprendre le portée locale des variables à l\'intérieur des fonctions.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'declaring-functions',
            'title' => 'Déclarer une fonction',
            'icon'  => '�-function:',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Une fonction est déclarée avec le mot-clé <code>function</code>, suivi du nom, d\'une liste de paramètres entre parenthèses, et d\'un bloc d\'instruction entre accolades.</p><p><code>function nomFonction(param1, param2) { ... }</code></p>',
                 'darija' => '<p>Fonction déclarée b <code>function</code>, nom, paramètres entre parenthèses, bloc instiction b accolades.</p><p><code>function nomFonction(param1, param2) { ... }</code></p>'],

                ['type' => 'example', 'title' => 'Fonction basique',
                 'lang'  => 'javascript',
                 'code'  => 'function saluer(nom) {\n  return "Bonjour " + nom + " !";\n}\nconsole.log(saluer("Yasmine")); // "Bonjour Yasmine !"',
                 'explainFr' => 'La fonction retourne "Bonjour Yasmine !" lorsqu\'on lui passe "Yasmine".',
                 'explainDarija' => 'Fonction retourne "Bonjour Yasmine !" b9der passed "Yasmine".'],

                ['type' => 'mcq',
                 'question' => 'Quel sera le résultat de \nconst f = function(x) { return x + 1; };\nf(5) ?',
                 'options' => '5', '6', 'Erreur',
                 'answer' => 1,
                 'concept' => 'appel fonction',
                 'explainFr' => '5 + 1 = 6.',
                 'explainDarija' => '5 + 1 = 6.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'parametres',
            'title' => 'Paramètres et arguments',
            'icon'  => '⚙️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les paramètres sont les variables listées dans la déclaration de la fonction. Les arguments sont les valeurs réelles passées lors de l\'appel. On peut aussi définir des paramètres par défaut :</p><pre><code>function addition(a, b = 0) { return a + b; }\naddition(5); // 5\naddition(3, 2); // 5</code></pre>',
                 'darija' => '<p>Paramètres variables déclarées f9der function. Arguments valeurs réelles b9der appel. Paramètres par défaut : <code>function addition(a, b = 0) { return a + b; }</code></p>'],

                ['type' => 'example', 'title' => 'Paramètres par défaut',
                 'lang'  => 'javascript',
                 'code'  => 'function calculer(x, y = 10) {\n  return x + y;\n}\nconsole.log(calculer(5));     // 15\nconsole.log(calculer(3, 7));  // 10',
                 'explainFr' => 'Si y n\'est pas fourni, il vaut 1 par défaut.',
                 'explainDarija' => 'Si y pas fourni, vaut 1 par défaut.'],

                ['type' => 'mcq',
                 'question' => 'Que renvoie \nfunction test(a = 5) { return a; };\ntest() ?',
                 'options' => '5', 'undefined', 'Erreur',
                 'answer' => 0,
                 'concept' => 'paramètre défaut',
                 'explainFr' => 'Le paramètre par défaut s\'applique quand aucune valeur n\'est fournie.',
                 'explainDarija' => 'Paramètre défaut s\'applique b9der aucune valeur fournie.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'return',
            'title' => 'L\'instruction return',
            'icon'  => '↩️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>L\'instruction <code>return</code> arrête l\'exécution de la fonction et renvoie une valeur à l\'endroit où la fonction a été appelée. Si aucune valeur n\'est spécifiée, la fonction renvoie <code>undefined</code>.</p>',
                 'darija' => '<p><code>return</code> arrête execution function w renvoie valeur b9der called. Si aucune valeur, function renvoie <code>undefined</code>.'],

                ['type' => 'example', 'title' => 'return avec et sans valeur',
                 'lang'  => 'javascript',
                 'code'  => 'function avecRetour() { return 42; }\nfunction sansRetour() { console.log("bonjour"); }\nconsole.log(avecRetour()); // 42\nsansRetour(); // "bonjour" (renvoie undefined)\n',
                 'explainFr' => 'avecRetour renvoie 42 ; sansRetour affiche "bonjour" et renvoie undefined.',
                 'explainDarija' => 'avecRetour renvoie 42 ; sansRetour affiche "bonjour" w renvoie undefined.'],

                ['type' => 'true_false',
                 'question' => 'Si une fonction n\'a pas de return, elle renvoie undefined.',
                 'answer' => 0,
                 'concept' => 'return',
                 'explainFr' => 'Vrai : sans return, la valeur par défaut est undefined.',
                 'explainDarija' => 'Vrai : sans return, valeur par défaut undefined.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-fonctions',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Pour qu\'une fonction renvoie une valeur, on utilise le mot-clé _____ .',
                 'answer' => 'return',
                 'concept' => 'return',
                 'explainFr' => 'L\'instruction return renvoie une valeur.',
                 'explainDarija' => 'return kayder valeur.'],

                ['type' => 'mcq',
                 'question' => 'Que vaut \nfunction test(x) { return x * 2; };\ntest(4) ?',
                 'options' => '8', '4', '2', 'undefined',
                 'answer' => 0,
                 'concept' => 'calcul dans return',
                 'explainFr' => '4 * 2 = 8.',
                 'explainDarija' => '4 * 2 = 8.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel affiche 10 ?',
                 'code_a' => 'function double(x) { return x * 2; }\ndouble(5);',
                 'code_b' => 'function double(x) { console.log(x * 2); }\ndouble(5);',
                 'answer' => 0,
                 'concept' => 'return vs console.log',
                 'explainFr' => 'return renvoie la valeur ; console.log l\'affiche mais la function renvoie undefined.',
                 'explainDarija' => 'return renvoie valeur ; console.log l\'affiche b function renvoie undefined.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublir return dans une fonction censée retourner une valeur',
            'fix'    => 'Vérifiez toujours la fin des fonctions qui doivent renvoyer un résultat.',
            'fr'     => 'Sans return, la fonction renverra undefined et le résultat sera perdu.',
            'darija' => 'Sans return, function renverra undefined w résultat perdu.'],
        ],
        [
            'wrong'  => 'Modifier les paramètres externes à l\'intérieur d\'une fonction',
            'fix'    => 'Utilisez des variables locales ou passez par valeur si nécessaire.',
            'fr'     => 'Les paramètres sont copiés ; les modifications n\'affectent pas les variables extérieures (sauf objets).',
            'darija' => 'Paramètres copiés ; modifications n\'affectent pas variables extérieures (sauf objets).'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> utilise <code>function nom(param1, param2)</code> pour déclarer une fonction. Les paramètres par défaut s\'écrivent <code>param = valeurParDefaut</code>. L\'instruction <code>return</code> arrête la fonction et renvoie une valeur ; sans return, la fonction renvoie undefined. ',
        'darija' => '<strong>JavaScript</strong> utilise <code>function nom(param1, param2)</code> b9der declarer function. Paramètres par défaut s\'écrivent <code>param = valeurParDefaut</code>. <code>return</code> arrête function w renvoie valeur ; sans return, function renvoie undefined. ',
    ],
];