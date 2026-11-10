<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 2 : Variables, constantes et nommage
 */

return [
    'id'       => 'cpp-ch2',
    'title'    => 'Variables, constantes et nommage',
    'subtitle' => 'Comment déclarer et utiliser des variables en C++.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['cpp-ch1'],

    'objectives' => [
        'Déclarer des variables des types de base en C++.',
        'Utiliser des constantes avec const.',
        'Appliquer des conventions de nommage correctes.',
        'Éviter les erreurs courantes de déclaration.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'types-de-base',
            'title' => 'Les types de base',
            'icon'  => '📦',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>C++ propose plusieurs types de données fondamentaux pour stocker des valeurs. Les plus utilisés sont :</p>',
                 'darija' => '<p>C++ yajib kolchi b種類 données fondamentaux bach tkhouzu valeurs. Lyoum most7der :</p>'],

                ['type' => 'table',
                 'headers' => ['Type', 'Valeurs possibles', 'Exemple'],
                 'rows' => [
                     ['int', 'Entiers signés', 'int age = 25;'],
                     ['double', 'À virgule double', 'double prix = 19.99;'],
                     ['char', 'Caractère unique', 'char lettre = \'A\';'],
                     ['bool', 'Vérité (vrai/faux)', 'bool actif = true;'],
                 ],
                 'fr' => 'Chaque type occupe une taille mémoire précise et le compilateur vérifie les opérations autorisées.',],

                ['type' => 'definition', 'title' => 'Constante',
                 'fr'   => '<p><strong>const</strong> sert à déclarer une valeur qui ne pourra jamais être modifiée après son initialisation. Cela augmente la sécurité et la lisibilité du code.</p>',
                 'darija' => '<p><b>const</b> kay3ni t3ed variable li ma tbedelch valeur mn ba3d l\'initialisation. Hada kay9der b7ed l sécurité w lisibilité du code.</p>'],

                ['type' => 'example',
                 'title' => 'Déclaration de variables et constantes',
                 'lang'  => 'cpp',
                 'code'  => 'int nombre = 42;\nconst double PI = 3.14159;\nchar marque = \'C\';\nbool connecté = true;',
                 'output' => 'Déclarations acceptées par le compilateur',
                 'explainFr' => 'Chaque variable possède un type déterminé. <code>const</code> intervient avant le type et le nom. Les constantes sont idéales pour les valeurs qui ne changent jamais, comme π.',
                 'explainDarija' => 'Kol variable 3andha type m7ded. <code>const</code> ybda b type w smiya. Les constantes howa7i l valeurs li ma kaytaghiro.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'conventions-nommage',
            'title' => 'Conventions de nommage',
            'icon'  => '✍️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>En C++, le nom des variables et fonctions suit des règles non écrites mais universelles :</p>',
                 'darija' => '<p>F C++, smiya dyal variables w fonctions kayrf9 l rules non écrits mais universels :</p>'],

                ['type' => 'table',
                 'headers' => ['Système', 'Règle', 'Exemple'],
                 'rows' => [
                     ['CamelCase', 'Première lettre minuscule, chaque mot suivant commence en majuscule', 'int nombreDeClavier'],
                     ['Snake_case', 'Tout en minuscules séparés par des soulignés', 'const int MAX_TAILLE = 100;'],
                     ['PascalCase', 'Chaque mot commence en majuscule', 'int NombreMaximum;'],
                 ],
                 'fr' => 'Le style snake_case est très courant pour les constantes et les variables d\'ensemble.',],

                ['type' => 'warning',
                 'title' => 'Erreurs de nommage à éviter',
                 'fr'   => '<ul><li>Ne commencez jamais un nom par un chiffre : <code>int 2age</code> est invalide.</li><li>N\'utilisez pas de mots réservés comme noms : <code>int int</code> ne compile pas.</li><li>Soyez cohérent : choisissez un style et appliquez-le partout.</li></ul>',
                 'darija' => '<ul><li>Ma tqdem start smiya b chiffre : <code>int 2age</code> ma ykhoulch.</li><li>Ma t3awd l mots réservés comme noms : <code>int int</code> ma ykhoulch compile.</li><li>Soyez consistent : khess style w kteb 3la kol programme.</li></ul>'],

                ['type' => 'example',
                 'title' => 'Exemples de déclarations correctes et incorrectes',
                 'lang'  => 'cpp',
                 'code'  => '// Correct\nint utilisateurCount = 5;\nconst double PRIX_UNITAIRE = 9.99;\n\n// Incorrect (ne compile pas)\n// int 2count = 5;\n// const int false = true;',
                 'output' => 'Seules les déclarations correctes sont acceptées',
                 'explainFr' => 'Le compilateur rejette les noms invalides. Les commentaires « Incorrect » ne sont pas exécutés.',
                 'explainDarija' => 'Compilateur ma yqbelch l noms invalides. Commentaires "Incorrect" ma ykhdemch.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le type d\'une variable',
            'fix'    => 'Toujours spécifier un type : int, double, char ou bool',
            'fr'     => 'En C++, chaque variable doit avoir un type explicite. <code>age = 25;</code> sans type provoque une erreur de compilation.',
            'darija' => 'F C++, kol variable kay7seb type m7ded. <code>age = 25;</code> bla type kay3ti erreur de compilation.',
        ],
        [
            'wrong'  => 'Utiliser un nom réservé comme identifiant',
            'fix'    => 'Ne jamais employer <code>int</code>, <code>double</code> ou <code>return</code> comme nom de variable',
            'fr'     => 'Les mots réservés du langage ne peuvent pas être utilisés comme noms de variables ni de fonctions.',
            'darija' => 'Mots réservés du langage ma kay7smoch b names de variables wla fonctions.',
        ],
        [
            'wrong'  => 'Modifier une variable déclarée avec const',
            'fix'    => 'Supprimer le mot const ou déclarer une variable lette avec un type non constant',
            'fr'     => 'Tenter de modifier une constante provoque une erreur de compilation. Si la valeur doit changer, utilisez une variable normale.',
            'darija' => 'T9der tbedel variable const kay3ti erreur de compilation. Ila value kaybedel, use variable naturale.',
        ],
    ],

    'summary' => [
        'fr'     => 'C++ connaît des types de base : int pour les entiers, double pour les nombres à virgule, char pour un caractère et bool pour le vrai/faux. Le mot-clé <code>const</code> protège les valeurs qui ne doivent jamais changer. Les conventions de nommage (camelCase, snake_case) rendent le code lisible par une équipe. Toujours déclarer un type explicite pour chaque variable.',
        'darija' => 'C++ kay7seb types de base : int pour entiers, double pour nombres b virgule, char pour caractère w bool pour vrai/faux. Mot-clé <code>const</code> kay7ed l valeurs li ma t7abetch tbedel. Conventions de nommage (camelCase, snake_case) kay9der code lisible f team. Kay7seb type m7ded l kol variable.',
    ],
];