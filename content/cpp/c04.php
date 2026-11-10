<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 4 : Fonctions approfondies
 */

return [
    'id'       => 'cpp-ch4',
    'title'    => 'Fonctions approfondies',
    'subtitle' => 'Comment créer et utiliser des fonctions avancées en C++.',
    'level'    => 'Intermédiaire',
    'minutes'  => 50,
    'prerequisites' => ['cpp-ch1', 'cpp-ch2', 'cpp-ch3'],

    'objectives' => [
        'Comprendre le mécanisme d\'appel de fonction et la pile d\'exécution.',
        'Utiliser les paramètres par défaut et les paramètres optionnels.',
        'Maîtriser le passage par référence et par pointeur.',
        'Utiliser les fonctions inline et les surcharges.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'mécanisme-appel',
            'title' => 'Mécanisme d\'appel de fonction',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Lorsque vous appelez une fonction en C++, le programme suit un cycle bien défini :</p>',
                 'darija' => '<p>Bach t3awd fonction f C++, programme kayrf9 cycle bien defined :</p>'],

                ['type' => 'table',
                 'headers' => ['Étape', 'Action', 'Résultat'],
                 'rows' => [
                     ['1. Appel', 'Passer les arguments', 'Créer des frames sur la pile'],
                     ['2. Exécution', 'Traiter les instructions', 'Variables locales dans chaque frame'],
                     ['3. Retour', 'Atteindre le return', 'Destroy la frame courante'],
                 ],
                 'fr' => 'Chaque appel de fonction crée une nouvelle frame sur la pile d\'exécution, qui est détruite lorsque la fonction retourne.',],

                ['type' => 'example',
                 'title' => 'Fonction avec retour',
                 'lang'  => 'cpp',
                 'code'  => 'int max(int a, int b) {\n    return (a > b) ? a : b;\n}\n\nint main() {\n    int x = 7;\n    int y = 12;\n    int m = max(x, y);\n    std::cout << "Maximum : " << m << std::endl;\n    return 0;\n}',
                 'output' => 'Maximum : 12',
                 'explainFr' => 'La fonction max compare deux entiers et renvoie le plus grand. Dans main, la variable m reçoit la valeur 12.',
                 'explainDarija' => 'Fonction max compare deux entiers w katrje3 l plus grand. F main, variable m katkhezen 12.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'parametres-reference',
            'title' => 'Passage par référence et par pointeur',
            'icon'  => '📎',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Il existe trois façons de passer des arguments à une fonction en C++ :</p>',
                 'darija' => '<p>Kolchi 3la ways bach tkhouzu pass arguments f C++ :</p>'],

                ['type' => 'table',
                 'headers' => ['Méthode', 'Syntaxe', 'Effet'],
                 'rows' => [
                     ['Par valeur', 'void func(int x)', 'Une copie de la variable est faite.',
                        'Les modifications à l\'intérieur de la fonction n\'affectent pas la variable d\'origine.'],
                     ['Par référence', 'void func(int &x)', 'La variable d\'origine est partagée.',
                        'Toute modification à l\'intérieur de la fonction s\'applique aussi dehors.'],
                     ['Par pointeur', 'void func(int *x)', 'On passe l\'adresse mémoire.',
                        'Peut être NULL ; nécessite la dereferencing avec *.'],
                 ],
                 'fr' => 'La référence est préférée au pointeur lorsqu\'on veut simplement partager la variable sans risque de NULL.',],

                ['type' => 'example',
                 'title' => 'Échange de valeurs par référence',
                 'lang'  => 'cpp',
                 'code'  => 'void echanger(int &a, int &b) {\n    int temp = a;\n    a = b;\n    b = temp;\n}\n\nint main() {\n    int x = 5;\n    int y = 10;\n    echanger(x, y);\n    std::cout << "x = " << x << ", y = " << y << std::endl;\n    return 0;\n}',
                 'output' => 'x = 10, y = 5',
                 'explainFr' => 'La fonction echanger inverse les valeurs de x et y grâce aux références. Après l\'appel, x vaut 10 et y vaut 5.',
                 'explainDarija' => 'Fonction echanger inverse valeurs x w y b references. Mn ba3d l appel, x = 10 w y = 5.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Modifier un paramètre passé par valeur alors qu\'on pensait le modifier par référence',
            'fix'    => 'Vérifier toujours le symbole & dans la déclaration de la fonction',
            'fr'     => 'Si vous voulez modifier la variable d\'origine, le paramètre doit être déclaré avec &.',
            'darija' => 'Ila kayt7ed variable d\'origine, parameter kaylik b &.',
        ],
        [
            'wrong'  => 'Oublier de initialiser une référence',
            'fix'    => 'Toujours initialiser une référence au moment de la déclaration',
            'fr'     => 'Une référence non initialisée contient une adresse mémoire invalide et provoquera une erreur à l\'exécution.',
            'darija' => 'Reference m7na3kchar initialise kay7et error f exécution.',
        ],
        [
            'wrong'  => 'Utiliser un pointeur sans vérifier NULL',
            'fix'    => 'Toujours vérifier que le pointeur n\'est pas NULL avant de l\'utiliser',
            'fr'     => 'Déréferencer un pointeur NULL provoque un crash (segfault) du programme.',
            'darija' => 'Dereferencer pointeur NULL kay7et crash (segfault) l programme.',
        ],
    ],

    'summary' => [
        'fr'     => 'C++ offre trois méthodes de passage d\'arguments : par valeur (copie), par référence (partage direct) et par pointeur (adresse mémoire avec risque NULL). La référence est généralement préférée au pointeur pour le partage simple. Chaque méthode a des implications de performance et de sécurité qu\'il faut maîtriser.',
        'darija' => 'C++ yajib 3la 3la ways bach tkhouzu pass arguments : par valeur (copie), par référence (partage direct) w par pointeur (adresse mémoire b risk NULL). Reference Generally Preferred l pointer b partage simple. Kol method had implications de performance w security l master.'],
    ],
];