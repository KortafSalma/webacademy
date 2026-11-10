<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 1 : quiz (10 questions).
 * 5 QCM, 3 vrai/faux, 2 questions pratiques à saisie courte.
 */

return [
    'title' => 'Quiz — Qu\'est-ce que programmer ?',
    'questions' => [

        [
            'type' => 'mcq',
            'question' => 'Que fait un compilateur C++ ?',
            'options' => [
                'Il traduit le code source en fichier exécutable',
                'Il exécute le programme ligne par ligne',
                'Il corrige automatiquement les erreurs de logique',
            ],
            'answer' => 0,
            'concept' => 'Rôle du compilateur',
            'explainFr' => 'Le compilateur traduit le fichier <code>.cpp</code> en instructions machine et vérifie la syntaxe. Il ne devine pas la logique et n\'exécute pas le programme.',
            'explainDarija' => 'Compilateur kayterjem <code>.cpp</code> l instructions machine w kayverifi syntaxe. Ma kaykhtar3ch logique w ma kaynfedch programme.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle est la fonction de départ obligatoire d\'un programme C++ ?',
            'options' => ['start()', 'main()', 'begin()'],
            'answer' => 1,
            'concept' => 'Point d\'entrée',
            'explainFr' => 'L\'exécution commence toujours par <code>int main()</code>. Sans elle, l\'éditeur de liens ne peut pas produire d\'exécutable.',
            'explainDarija' => 'Exécution dima katbda b <code>int main()</code>. Bla biha, l\'éditeur de liens ma yqderch yproduit exécutable.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle bibliothèque faut-il inclure pour utiliser std::cout ?',
            'options' => ['<string>', '<iostream>', '<vector>'],
            'answer' => 1,
            'concept' => 'Entrées/sorties',
            'explainFr' => '<code>&lt;iostream&gt;</code> déclare <code>std::cout</code>, <code>std::cin</code> et <code>std::endl</code>.',
            'explainDarija' => '<code>&lt;iostream&gt;</code> kay3len <code>std::cout</code>, <code>std::cin</code> w <code>std::endl</code>.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Par quel caractère se termine chaque instruction C++ ?',
            'options' => ['Le point-virgule ;', 'Le point .', 'La barre oblique /'],
            'answer' => 0,
            'concept' => 'Syntaxe de base',
            'explainFr' => 'Chaque instruction se termine par <code>;</code>. L\'oubli provoque une erreur de compilation, pas une erreur à l\'exécution.',
            'explainDarija' => 'Kol instruction katsali b <code>;</code>. Ila nsiti, erreur de compilation, machi erreur f exécution.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Qu\'est-ce qu\'un algorithme ?',
            'options' => [
                'Une suite ordonnée d\'instructions pour résoudre un problème',
                'Un langage de programmation réservé aux experts',
                'Un fichier exécutable produit par le compilateur',
            ],
            'answer' => 0,
            'concept' => 'Algorithme',
            'explainFr' => 'Un algorithme décrit la méthode de résolution, indépendamment du langage. Le programme est la traduction de l\'algorithme en code.',
            'explainDarija' => 'Algorithme kaywsef tariqa dyal 7el, bla lougha. Programme howa tarjama dyal algorithme l code.',
        ],
        [
            'type' => 'tf',
            'question' => 'Un fichier C++ peut être exécuté directement sans compilation.',
            'answer' => 1,
            'concept' => 'Compilation obligatoire',
            'explainFr' => 'Faux : le processeur ne comprend pas le C++. Il faut compiler le source en binaire avant de l\'exécuter.',
            'explainDarija' => 'Ghalat : processeur ma kayfhemch C++. Khass tcompiler source l binaire qbel exécution.',
        ],
        [
            'type' => 'tf',
            'question' => 'std::cout sert à afficher des données vers la sortie standard.',
            'answer' => 0,
            'concept' => 'Sortie standard',
            'explainFr' => 'Vrai : <code>std::cout</code> est le flux de sortie. On y envoie du texte, des nombres et des variables avec <code>&lt;&lt;</code>.',
            'explainDarija' => 'S7i7 : <code>std::cout</code> howa flux de sortie. Kaysift louh texte, nombres w variables b <code>&lt;&lt;</code>.',
        ],
        [
            'type' => 'tf',
            'question' => 'return 0; dans main() signale une terminaison réussie du programme.',
            'answer' => 0,
            'concept' => 'Code de retour',
            'explainFr' => 'Vrai : la valeur 0 est conventionnellement le code de succès. Une valeur différente indique une erreur au système d\'exploitation.',
            'explainDarija' => 'S7i7 : valeur 0 hiya code de succès. Valeur mokhtalefa kat3ni erreur l système d\'exploitation.',
        ],
        [
            'type' => 'fill',
            'question' => 'Pratique — Qu\'affiche exactement <code>std::cout &lt;&lt; 2 + 3 * 4;</code> ? (réponse numérique)',
            'answer' => '14',
            'concept' => 'Priorité des opérateurs',
            'explainFr' => 'La multiplication est prioritaire : 3 × 4 = 12, puis 2 + 12 = 14. Sans parenthèses, l\'expression vaut 14.',
            'explainDarija' => 'Multiplication kat9bel : 3 × 4 = 12, mn ba3d 2 + 12 = 14. Bla parenthèses, expression kat3ti 14.',
        ],
        [
            'type' => 'fill',
            'question' => 'Pratique — Complétez la déclaration d\'un entier : <code>______ age = 20;</code> (réponse : un seul mot-clé)',
            'answer' => 'int',
            'concept' => 'Déclaration de variable',
            'explainFr' => '<code>int</code> est le type des entiers. La déclaration complète est <code>int age = 20;</code>.',
            'explainDarija' => '<code>int</code> howa type dyal entiers. Déclaration kamla : <code>int age = 20;</code>.',
        ],
    ],
];
