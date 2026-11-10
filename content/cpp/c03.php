<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 3 : Conditions et booléens
 */

return [
    'id'       => 'cpp-ch3',
    'title'    => 'Conditions et booléens',
    'subtitle' => 'Comment prendre des décisions dans un programme C++.',
    'level'    => 'Débutant',
    'minutes'  => 45,
    'prerequisites' => ['cpp-ch1', 'cpp-ch2'],

    'objectives' => [
        'Utiliser les opérateurs de comparaison et logiques.',
        'Écrire des conditions with if, else if, else.',
        'Comprendre les opérateurs booléens &&, ||, !.',
        'Éviter les pièges des conditions always-true ou always-false.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'operateurs-comparaison',
            'title' => 'Opérateurs de comparaison',
            'icon'  => '📊',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs de comparaison permettent de tester des relations entre deux valeurs. Ils renvoient toujours un résultat de type <code>bool</code> (vrai ou faux).</p>',
                 'darija' => '<p>Les opérateurs de comparaison permettent de tester des relations entre deux valeurs. Ils renvoient toujours un résultat de type bool (vrai ou faux).</p>'],

                ['type' => 'table',
                 'headers' => ['Opérateur', 'Signification', 'Exemple'],
                 'rows' => [
                     ['==', 'Égalité (attention au type)', '5 == 5  → true'],
                     ['!=', 'Différent', '5 != 3  → true'],
                     ['<', 'Strictement inférieur', '2 < 4   → true'],
                     ['>', 'Strictement supérieur', '7 > 2   → true'],
                     ['<=', 'Inférieur ou égal', '3 <= 3  → true'],
                     ['>=', 'Supérieur ou égal', '5 >= 1  → true'],
                 ],
                 'fr' => 'Notez que <code>==</code> est l\'égalité, pas <code>=</code> qui est l\'assignation.',],

                ['type' => 'warning',
                 'title' => 'Attention à la confusion = et ==',
                 'fr'   => '<p>L\'opérateur <code>=</code> affecte une valeur, tandis que <code>==</code> teste l\'égalité. Confondre les deux est l\'erreur n°1 des débutants :</p>',
                 'darija' => '<p>L\'opérateur <code>=</code> affecte une valeur, tandis que <code>==</code> teste l\'égalité. Confondre les deux est l\'erreur n°1 des débutants :</p>'],

                ['type' => 'example',
                 'title' => 'Tester la note d\'un élève',
                 'lang'  => 'cpp',
                 'code'  => 'int note = 15;\n\nif (note >= 10) {\n    std::cout << "Passé" << std::endl;\n} else {\n    std::cout << "Échec" << std::endl;\n}',
                 'output' => 'Passé',
                 'explainFr' => 'Si la note est supérieure ou égale à 10, le programme affiche « Passed ». Sinon, il affiche « Échec ».',
                 'explainDarija' => 'Si note >= 10, programme kay3red "Passed". Ila machi, kay3red "Échec".'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'operateurs-logiques',
            'title' => 'Opérateurs booléens',
            'icon'  => '🔗',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs booléens permettent de combiner plusieurs conditions :</p>',
                 'darija' => '<p>Les opérateurs booléens permettent de combiner plusieurs conditions :</p>'],

                ['type' => 'table',
                 'headers' => ['Opérateur', 'Signification', 'Exemple'],
                 'rows' => [
                     ['&&', 'ET (AND)', 'true && true  → true ; true && false → false'],
                     ['||', 'OU (OR)',    'true || false → true ; false || false → false'],
                     ['!', 'NON (NOT)',  '!true   → false'],
                 ],
                 'fr' => 'L\'opérateur && ne renvoie vrai que si les deux côtés sont vrais.',],

                ['type' => 'example',
                 'title' => 'Vérifier qu\'un nombre est dans un intervalle',
                 'lang'  => 'cpp',
                 'code'  => 'int valeur = 7;\n\nif (valeur > 0 && valeur < 10) {\n    std::cout << "Dans l\'intervalle" << std::endl;\n}',
                 'output' => 'Dans l\'intervalle',
                 'explainFr' => 'La condition est vraie seulement si valeur est strictement positive ET strictement inférieure à 10.',
                 'explainDarija' => 'Condition s7i7a hna valeur > 0 w valeur < 10.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les accolades autour d\'un bloc if d\'une seule ligne',
            'fix'    => 'Toujours entourer le bloc de { } même s\'il n\'y a qu\'une instruction',
            'fr'     => 'Sans les accolades, seule la première instruction après if est concernée. Le reste s\'exécute toujours.',
            'darija' => 'Bla accolades, instruction l akhira kayt7et wla kayexec b7ad if.',
        ],
        [
            'wrong'  => 'Utiliser = à la place de == dans une condition',
            'fix'    => 'Vérifier toujours que vous testez l\'égalité, pas affectation',
            'fr'     => 'Le compilateur peut parfois accepter <code>if (x = 5)</code> selon le type, mais la logique sera fausse.',
            'darija' => 'Compilateur kay9derch <code>if (x = 5)</code> b7ad type, walakin logik ma t7awach.',
        ],
        [
            'wrong'  => 'Écrire une condition qui est toujours vraie ou toujours fausse',
            'fix'    => 'Vérifier que les bornes de l\'intervalle sont correctes et différentes',
            'fr'     => 'Une condition comme <code>if (5 > 10)</code> est toujours fausse, et <code>if (5 > -1)</code> peut être vraie en tout cas.',
            'darija' => 'Condition comme <code>if (5 > 10)</code> kay7et ghalat l7et wla kay7et7et l7a.',
        ],
    ],

    'summary' => [
        'fr'     => 'Les opérateurs de comparaison (==, !=, <, >, <=, >=) renvoient un bool. Les opérateurs booléens (&&, ||, !) combinent des conditions. Toujours utiliser les accolades { } autour des blocs if. Faire attention à ne pas confondre = (affectation) et == (égalité).',
        'darija' => 'Les opérateurs de comparaison (==, !=, <, >, <=, >=) kayrjo3 bool. Les opérateurs booléens (&&, ||, !) kombina9 conditions. Kay7sbl { } b kol blocs if. Make attention l ma tkonfo = (affectation) w == (égalité).',
    ],
];