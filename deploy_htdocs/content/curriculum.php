<?php

declare(strict_types=1);

/**
 * Manifeste du curriculum — SOURCE UNIQUE de la navigation.
 * Un chapitre rédigé existe lorsque content/<module>/c{NN}.php est présent.
 *
 * Les modules « cpp » et « javascript » sont des parcours complets :
 *   - parts[]      : regroupement pédagogique des chapitres (affichage cours)
 *   - course       : true → page de cours dédiée (#/course/<id>)
 *   - level, hours : informations affichées sur la page de cours
 */

return [
    'modules' => [

        ['id' => 'html', 'name' => 'HTML5', 'color' => 'orange', 'icon' => '</>', 'blurb' => 'Structure du web', 'chapters' => [
            ['n' => 1,  'title' => 'Introduction au développement web'],
            ['n' => 2,  'title' => 'Structure d\'un document HTML'],
            ['n' => 3,  'title' => 'Balises de texte et mise en valeur'],
            ['n' => 4,  'title' => 'Liens et images'],
            ['n' => 5,  'title' => 'Listes HTML'],
            ['n' => 6,  'title' => 'Tableaux'],
            ['n' => 7,  'title' => 'Formulaires'],
            ['n' => 8,  'title' => 'HTML sémantique'],
        ]],

        ['id' => 'css', 'name' => 'CSS3', 'color' => 'blue', 'icon' => '{}', 'blurb' => 'Style et mise en page', 'chapters' => [
            ['n' => 1,  'title' => 'Introduction à CSS'],
            ['n' => 2,  'title' => 'Inline, interne, externe'],
            ['n' => 3,  'title' => 'Sélecteurs'],
            ['n' => 4,  'title' => 'Couleurs et arrière-plans'],
            ['n' => 5,  'title' => 'Typographie'],
            ['n' => 6,  'title' => 'Margin et padding'],
            ['n' => 7,  'title' => 'Bordures et dimensions'],
            ['n' => 8,  'title' => 'Le modèle de boîte (box model)'],
            ['n' => 9,  'title' => 'Property display'],
            ['n' => 10, 'title' => 'Property position'],
            ['n' => 11, 'title' => 'Flexbox'],
            ['n' => 12, 'title' => 'CSS Grid'],
            ['n' => 13, 'title' => 'Design responsive'],
            ['n' => 14, 'title' => 'Media queries'],
        ]],

        ['id' => 'php', 'name' => 'PHP', 'color' => 'indigo', 'icon' => 'php', 'blurb' => 'Programmation serveur', 'chapters' => [
            ['n' => 1,  'title' => 'Introduction à PHP'],
            ['n' => 2,  'title' => 'Variables et constantes'],
            ['n' => 3,  'title' => 'Opérateurs'],
            ['n' => 4,  'title' => 'Conditions'],
            ['n' => 5,  'title' => 'Boucles'],
            ['n' => 6,  'title' => 'Tableaux (arrays)'],
            ['n' => 7,  'title' => 'Fonctions'],
            ['n' => 8,  'title' => 'Fonctions de chaînes'],
            ['n' => 9,  'title' => 'Traitement des formulaires'],
            ['n' => 10, 'title' => 'Include et require'],
            ['n' => 11, 'title' => 'Sessions et cookies'],
            ['n' => 12, 'title' => 'Manipulation de fichiers'],
            ['n' => 13, 'title' => 'Gestion des erreurs'],
            ['n' => 14, 'title' => 'POO PHP'],
            ['n' => 15, 'title' => 'Sécurité PHP'],
        ]],

        ['id' => 'sql', 'name' => 'SQL', 'color' => 'teal', 'icon' => 'SQL', 'blurb' => 'Bases de données', 'chapters' => [
            ['n' => 1,  'title' => 'Fondamentaux des bases de données'],
            ['n' => 2,  'title' => 'Types de données SQL'],
            ['n' => 3,  'title' => 'DDL'],
            ['n' => 4,  'title' => 'Contraintes'],
            ['n' => 5,  'title' => 'DML'],
            ['n' => 6,  'title' => 'Filtrage (WHERE)'],
            ['n' => 7,  'title' => 'Tri et groupement'],
            ['n' => 8,  'title' => 'Fonctions d\'agrégation'],
            ['n' => 9,  'title' => 'Joins'],
            ['n' => 10, 'title' => 'Sous-requêtes'],
            ['n' => 11, 'title' => 'Relations entre tables'],
            ['n' => 12, 'title' => 'Transactions'],
            ['n' => 13, 'title' => 'Views et indexes'],
            ['n' => 14, 'title' => 'Conception de bases'],
        ]],

        ['id' => 'integration', 'name' => 'PHP + SQL', 'color' => 'violet', 'icon' => '⇄', 'blurb' => 'Applications dynamiques', 'chapters' => [
            ['n' => 1, 'title' => 'Communication PHP ↔ base de données'],
            ['n' => 2, 'title' => 'Connexions (PDO, MySQL, Oracle)'],
            ['n' => 3, 'title' => 'Requêtes préparées'],
            ['n' => 4, 'title' => 'CRUD complet'],
            ['n' => 5, 'title' => 'Authentification'],
            ['n' => 6, 'title' => 'Sécurité applicative'],
            ['n' => 7, 'title' => 'Architecture de projet'],
        ]],

        // ==================================================================
        // PARCOURS C++ — 30 chapitres, 7 modules pédagogiques
        // ==================================================================
        [
            'id' => 'cpp',
            'name' => 'C++',
            'color' => 'rose',
            'icon' => 'C++',
            'blurb' => 'De zéro à la POO et à la STL',
            'course' => true,
            'level' => 'Débutant → intermédiaire',
            'hours' => '55–70 h',
            'standard' => 'C++17',
            'description' => 'Un parcours complet pour découvrir la programmation avec C++17 : compilation avec g++, types, conditions, boucles, fonctions, tableaux, pointeurs, classes, héritage, mémoire, exceptions et STL. Chaque notion est expliquée en français et en darija, avec du code réel et des exercices corrigés.',
            'parts' => [
                ['id' => 'cpp-part-1', 'title' => 'Module 1 — Découvrir la programmation et C++', 'chapters' => [1, 2, 3, 4, 5, 6]],
                ['id' => 'cpp-part-2', 'title' => 'Module 2 — Variables, types et entrées/sorties', 'chapters' => [7, 8, 9, 10, 11]],
                ['id' => 'cpp-part-3', 'title' => 'Module 3 — Conditions et boucles', 'chapters' => [12, 13, 14, 15, 16]],
                ['id' => 'cpp-part-4', 'title' => 'Module 4 — Fonctions et structures de données', 'chapters' => [17, 18, 19, 20, 21, 22]],
                ['id' => 'cpp-part-5', 'title' => 'Module 5 — Programmation orientée objet', 'chapters' => [23, 24, 25, 26, 27]],
                ['id' => 'cpp-part-6', 'title' => 'Module 6 — C++ avancé et STL', 'chapters' => [28, 29, 30]],
                ['id' => 'cpp-projects', 'title' => 'Module 7 — Projets pratiques', 'chapters' => []],
            ],
            'chapters' => [
                ['n' => 1,  'title' => 'Qu\'est-ce que programmer ?'],
                ['n' => 2,  'title' => 'Algorithme et pensée logique'],
                ['n' => 3,  'title' => 'Qu\'est-ce que C++ ?'],
                ['n' => 4,  'title' => 'Installer et configurer son environnement'],
                ['n' => 5,  'title' => 'Fichiers source, compilation et g++'],
                ['n' => 6,  'title' => 'Premier programme : Hello World'],
                ['n' => 7,  'title' => 'Variables, constantes et nommage'],
                ['n' => 8,  'title' => 'Types de base : int, double, char, bool, string'],
                ['n' => 9,  'title' => 'Déclaration, initialisation et affectation'],
                ['n' => 10, 'title' => 'Entrées et sorties : cin, cout et getline'],
                ['n' => 11, 'title' => 'Opérateurs, conversion et casting'],
                ['n' => 12, 'title' => 'Conditions : if, else et else if'],
                ['n' => 13, 'title' => 'Le switch'],
                ['n' => 14, 'title' => 'La boucle for'],
                ['n' => 15, 'title' => 'Les boucles while et do...while'],
                ['n' => 16, 'title' => 'break, continue et boucles imbriquées'],
                ['n' => 17, 'title' => 'Fonctions : déclarer, définir, appeler'],
                ['n' => 18, 'title' => 'Paramètres, return et surcharge'],
                ['n' => 19, 'title' => 'Passage par valeur et par référence'],
                ['n' => 20, 'title' => 'Tableaux et tableaux multidimensionnels'],
                ['n' => 21, 'title' => 'Strings et manipulation de texte'],
                ['n' => 22, 'title' => 'Pointeurs, références, struct et enum'],
                ['n' => 23, 'title' => 'Introduction à la POO : classes et objets'],
                ['n' => 24, 'title' => 'Attributs, méthodes, constructeurs et destructeurs'],
                ['n' => 25, 'title' => 'Encapsulation, getters et setters'],
                ['n' => 26, 'title' => 'Héritage et polymorphisme'],
                ['n' => 27, 'title' => 'Classes abstraites, virtual et static'],
                ['n' => 28, 'title' => 'Mémoire dynamique, pile, tas et smart pointers'],
                ['n' => 29, 'title' => 'Exceptions et fichiers'],
                ['n' => 30, 'title' => 'STL : vector, list, map, itérateurs et templates'],
            ],
        ],

        // ==================================================================
        // PARCOURS JAVASCRIPT — 30 chapitres, 6 modules pédagogiques
        // ==================================================================
        [
            'id' => 'javascript',
            'name' => 'JavaScript',
            'color' => 'yellow',
            'icon' => 'JS',
            'blurb' => 'Du premier script au DOM et aux API',
            'course' => true,
            'level' => 'Débutant → intermédiaire',
            'hours' => '50–65 h',
            'standard' => 'ES2020+',
            'description' => 'Un parcours complet pour apprendre JavaScript moderne dans le navigateur : variables, types, fonctions, tableaux, objets, DOM, événements, stockage local, classes, modules, JSON, promesses, async/await et Fetch API. Explications bilingues, exemples exécutables et projets guidés.',
            'parts' => [
                ['id' => 'js-part-1', 'title' => 'Module 1 — Découvrir JavaScript', 'chapters' => [1, 2, 3, 4, 5]],
                ['id' => 'js-part-2', 'title' => 'Module 2 — Variables, types et logique', 'chapters' => [6, 7, 8, 9, 10, 11]],
                ['id' => 'js-part-3', 'title' => 'Module 3 — Boucles, fonctions et portée', 'chapters' => [12, 13, 14, 15, 16, 17]],
                ['id' => 'js-part-4', 'title' => 'Module 4 — Objets et données', 'chapters' => [18, 19, 20, 21]],
                ['id' => 'js-part-5', 'title' => 'Module 5 — DOM et navigateur', 'chapters' => [22, 23, 24, 25, 26]],
                ['id' => 'js-part-6', 'title' => 'Module 6 — JavaScript moderne', 'chapters' => [27, 28, 29, 30]],
                ['id' => 'js-projects', 'title' => 'Module 7 — Projets pratiques', 'chapters' => []],
            ],
            'chapters' => [
                ['n' => 1,  'title' => 'Qu\'est-ce que JavaScript ?'],
                ['n' => 2,  'title' => 'HTML, CSS, JavaScript : qui fait quoi ?'],
                ['n' => 3,  'title' => 'Ce que JavaScript peut faire (et ne peut pas faire)'],
                ['n' => 4,  'title' => 'Environnement de développement et premier script'],
                ['n' => 5,  'title' => 'console.log, commentaires et structure du code'],
                ['n' => 6,  'title' => 'Variables : var, let et const'],
                ['n' => 7,  'title' => 'Types de données : string, number, boolean…'],
                ['n' => 8,  'title' => 'Opérateurs et expressions'],
                ['n' => 9,  'title' => 'Comparaisons et opérateurs logiques'],
                ['n' => 10, 'title' => 'Conversion, coercition et template literals'],
                ['n' => 11, 'title' => 'Conditions : if, else et switch'],
                ['n' => 12, 'title' => 'Boucles : for, while, do...while'],
                ['n' => 13, 'title' => 'Fonctions, paramètres et return'],
                ['n' => 14, 'title' => 'Fonctions anonymes et arrow functions'],
                ['n' => 15, 'title' => 'Portée, hoisting et contexte d\'exécution'],
                ['n' => 16, 'title' => 'Tableaux : bases et méthodes essentielles'],
                ['n' => 17, 'title' => 'map, filter, reduce, find et forEach'],
                ['n' => 18, 'title' => 'Objets, propriétés, méthodes et this'],
                ['n' => 19, 'title' => 'Destructuring'],
                ['n' => 20, 'title' => 'Spread, rest, optional chaining, nullish coalescing'],
                ['n' => 21, 'title' => 'JSON, dates et timers'],
                ['n' => 22, 'title' => 'Le DOM : comprendre la page'],
                ['n' => 23, 'title' => 'Sélectionner et modifier des éléments'],
                ['n' => 24, 'title' => 'Créer, supprimer et écouter des événements'],
                ['n' => 25, 'title' => 'Bubbling, délégation et validation de formulaires'],
                ['n' => 26, 'title' => 'localStorage et sessionStorage'],
                ['n' => 27, 'title' => 'Classes, constructeurs et héridage'],
                ['n' => 28, 'title' => 'Modules : export et import'],
                ['n' => 29, 'title' => 'Erreurs, try/catch/finally et debugging'],
                ['n' => 30, 'title' => 'Promesses, async/await et Fetch API'],
            ],
        ],

        // ==================================================================
        // ORACLE SQL & PL/SQL — 28 chapitres
        // ==================================================================
        ['id' => 'oracle', 'name' => 'Oracle SQL & PL/SQL', 'color' => 'teal', 'icon' => 'DB', 'blurb' => 'Bases de données Oracle XE', 'chapters' => [
            // Part 1 — Oracle Fundamentals (chapters 1–5)
            ['n' => 1,  'title' => 'Introduction à Oracle Database et Oracle XE'],
            ['n' => 2,  'title' => 'Installation et configuration d\'Oracle Database XE'],
            ['n' => 3,  'title' => 'Comprendre SQL*Plus et SQL Developer'],
            ['n' => 4,  'title' => 'Connexion à Oracle : SYS, SYSTEM, utilisateurs et PDB'],
            ['n' => 5,  'title' => 'Création d\'utilisateurs, attribution de privilèges et gestion des autorisations'],
            // Part 2 — Oracle SQL (chapters 6–17)
            ['n' => 6,  'title' => 'Introduction aux bases de données relationnelles et aux tables'],
            ['n' => 7,  'title' => 'CREATE, ALTER, DROP et TRUNCATE'],
            ['n' => 8,  'title' => 'INSERT, UPDATE et DELETE'],
            ['n' => 9,  'title' => 'SELECT, WHERE, ORDER BY et DISTINCT'],
            ['n' => 10, 'title' => 'Types de données Oracle et valeurs NULL'],
            ['n' => 11, 'title' => 'Opérateurs de comparaison et opérateurs logiques'],
            ['n' => 12, 'title' => 'Fonctions d\'agrégation : COUNT, SUM, AVG, MIN, MAX'],
            ['n' => 13, 'title' => 'GROUP BY et HAVING'],
            ['n' => 14, 'title' => 'Jointures : INNER JOIN, LEFT JOIN, RIGHT JOIN et FULL OUTER JOIN'],
            ['n' => 15, 'title' => 'Sous-requêtes et requêtes imbriquées'],
            ['n' => 16, 'title' => 'Contraintes : PRIMARY KEY, FOREIGN KEY, UNIQUE, CHECK et NOT NULL'],
            ['n' => 17, 'title' => 'Vues, séquences et index'],
            // Part 3 — PL/SQL (chapters 18–28)
            ['n' => 18, 'title' => 'Introduction à PL/SQL et aux blocs anonymes'],
            ['n' => 19, 'title' => 'Variables, constantes et types de données'],
            ['n' => 20, 'title' => 'SELECT INTO et %TYPE / %ROWTYPE'],
            ['n' => 21, 'title' => 'Instructions conditionnelles : IF, ELSIF et ELSE'],
            ['n' => 22, 'title' => 'Boucles : LOOP, WHILE et FOR'],
            ['n' => 23, 'title' => 'Curseurs : implicites et explicites'],
            ['n' => 24, 'title' => 'Gestion des exceptions et erreurs'],
            ['n' => 25, 'title' => 'Procédures et fonctions'],
            ['n' => 26, 'title' => 'Packages'],
            ['n' => 27, 'title' => 'Triggers'],
            ['n' => 28, 'title' => 'Enregistrements, collections et PL/SQL avancé'],
        ]],

    ],
];