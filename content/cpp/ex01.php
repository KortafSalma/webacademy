<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 1 : exercices.
 * 3 niveaux débutant, 2 niveaux intermédiaire, 1 défi.
 *
 * Les tests sont STATIQUES : le code C++ n'est jamais compilé sur le serveur.
 * Ils vérifient la présence des éléments demandés ; la compilation locale avec
 * g++ reste la seule vérification réelle du comportement.
 */

return [
    'id'    => 'cpp-ex1',
    'title' => 'Premiers pas en C++',
    'brief' => 'Écrire, compiler et lire un programme C++ simple.',

    'levels' => [

        // ---------------------------------------------------------- Niveau 1
        [
            'level'  => 1,
            'title'  => 'Débutant — premier affichage',
            'lang'   => 'cpp',
            'instructions' => '<p>Écrivez un programme C++ complet qui affiche exactement <code>Salam, WebAcademy !</code> avec <code>std::cout</code>. Le programme doit contenir <code>#include &lt;iostream&gt;</code> et une fonction <code>int main()</code>.</p>',
            'instructionsDarija' => '<p>Kteb programme C++ kamel kay3red b dqiq <code>Salam, WebAcademy !</code> b <code>std::cout</code>. Khass fih <code>#include &lt;iostream&gt;</code> w fonction <code>int main()</code>.</p>',
            'starter' => '#include <iostream>

int main() {
    // Affiche le message ici

    return 0;
}
',
            'tests' => [
                ['type' => 'code_contains', 'value' => '#include <iostream>'],
                ['type' => 'code_contains', 'value' => 'int main'],
                ['type' => 'code_contains', 'value' => 'std::cout'],
                ['type' => 'code_contains', 'value' => 'Salam, WebAcademy !'],
                ['type' => 'code_contains', 'value' => 'return 0;'],
            ],
            'hints' => [
                'La bibliothèque <iostream> fournit std::cout.',
                'On envoie le texte avec l\'opérateur <<.',
                'Terminez chaque instruction par un point-virgule.',
            ],
            'solution' => '#include <iostream>

int main() {
    std::cout << "Salam, WebAcademy !" << std::endl;
    return 0;
}
',
            'explainFr' => '<code>std::cout</code> représente la sortie standard. L\'opérateur <code>&lt;&lt;</code> envoie le texte vers cette sortie, puis <code>std::endl</code> ajoute une fin de ligne.',
            'explainDarija' => '<code>std::cout</code> hiya sortie standard. Opérateur <code>&lt;&lt;</code> kaysift texte liha, w <code>std::endl</code> kayzid fin de ligne.',
        ],

        // ---------------------------------------------------------- Niveau 2
        [
            'level'  => 2,
            'title'  => 'Débutant — variables',
            'lang'   => 'cpp',
            'instructions' => '<p>Déclarez une variable <code>int age</code> valant <code>20</code>, une variable <code>double taille</code> valant <code>1.75</code>, puis affichez les deux valeurs avec <code>std::cout</code>.</p>',
            'instructionsDarija' => '<p>3len variable <code>int age</code> b valeur <code>20</code>, w variable <code>double taille</code> b valeur <code>1.75</code>, mn ba3d 3red jouj valeurs b <code>std::cout</code>.</p>',
            'starter' => '#include <iostream>

int main() {
    // Déclare age et taille

    // Affiche les deux valeurs

    return 0;
}
',
            'tests' => [
                ['type' => 'code_contains', 'value' => 'int age'],
                ['type' => 'code_contains', 'value' => '= 20'],
                ['type' => 'code_contains', 'value' => 'double taille'],
                ['type' => 'code_contains', 'value' => '= 1.75'],
                ['type' => 'code_contains', 'value' => 'std::cout'],
            ],
            'hints' => [
                'Une variable se déclare avec son type : int age = 20;',
                'Le type double stocke un nombre à virgule.',
                'On peut enchaîner les affichages : std::cout << age << " " << taille;',
            ],
            'solution' => '#include <iostream>

int main() {
    int age = 20;
    double taille = 1.75;

    std::cout << "Age : " << age << std::endl;
    std::cout << "Taille : " << taille << std::endl;

    return 0;
}
',
            'explainFr' => '<code>int</code> stocke un entier et <code>double</code> un nombre décimal. Chaque variable possède un type précis : le compilateur refuse d\'affecter un texte à un entier.',
            'explainDarija' => '<code>int</code> kaykhezen entier w <code>double</code> kaykhezen nombre b virgule. Kol variable 3andha type m7ded : compilateur ma kayqbelch t3ti texte l entier.',
        ],

        // ---------------------------------------------------------- Niveau 3
        [
            'level'  => 3,
            'title'  => 'Débutant — condition',
            'lang'   => 'cpp',
            'instructions' => '<p>Lisez un entier dans une variable <code>nombre</code>, puis affichez <code>Positif</code>, <code>Negatif</code> ou <code>Zero</code> selon sa valeur. Utilisez <code>if</code>, <code>else if</code> et <code>else</code>.</p>',
            'instructionsDarija' => '<p>Khod entier f variable <code>nombre</code>, mn ba3d 3red <code>Positif</code>, <code>Negatif</code> wla <code>Zero</code> 7sab l valeur. Khdem b <code>if</code>, <code>else if</code> w <code>else</code>.</p>',
            'starter' => '#include <iostream>

int main() {
    int nombre = 7;

    // Teste le signe de nombre

    return 0;
}
',
            'tests' => [
                ['type' => 'code_contains', 'value' => 'if'],
                ['type' => 'code_contains', 'value' => 'else if'],
                ['type' => 'code_contains', 'value' => 'else'],
                ['type' => 'code_contains', 'value' => '> 0'],
                ['type' => 'code_contains', 'value' => '< 0'],
                ['type' => 'code_contains', 'value' => 'Zero'],
            ],
            'hints' => [
                'Compare nombre à 0 avec >, < et ==.',
                'Le cas zéro se traite généralement en dernier avec else.',
                'N\'oublie pas les accolades autour de chaque bloc.',
            ],
            'solution' => '#include <iostream>

int main() {
    int nombre = 7;

    if (nombre > 0) {
        std::cout << "Positif" << std::endl;
    } else if (nombre < 0) {
        std::cout << "Negatif" << std::endl;
    } else {
        std::cout << "Zero" << std::endl;
    }

    return 0;
}
',
            'explainFr' => 'Les conditions sont évaluées dans l\'ordre : dès qu\'une est vraie, les suivantes sont ignorées. Le <code>else</code> final couvre tous les cas restants, ici zéro.',
            'explainDarija' => 'Conditions kaytqraw b tartib : awwel wa7da katkoun s7i7a, li moraha kaytjahlo. <code>else</code> l\'akhira katghatti kolchi li b9a, hna zéro.',
        ],

        // ---------------------------------------------------------- Niveau 4
        [
            'level'  => 4,
            'title'  => 'Intermédiaire — boucle et accumulation',
            'lang'   => 'cpp',
            'instructions' => '<p>Calculez la somme des entiers de <code>1</code> à <code>10</code> avec une boucle <code>for</code>, stockez-la dans une variable <code>somme</code>, puis affichez <code>Somme : 55</code>.</p>',
            'instructionsDarija' => '<p>7seb somme dyal entiers mn <code>1</code> 7tta <code>10</code> b boucle <code>for</code>, khezenha f variable <code>somme</code>, mn ba3d 3red <code>Somme : 55</code>.</p>',
            'starter' => '#include <iostream>

int main() {
    int somme = 0;

    // Boucle de 1 à 10

    std::cout << "Somme : " << somme << std::endl;
    return 0;
}
',
            'tests' => [
                ['type' => 'code_contains', 'value' => 'for'],
                ['type' => 'code_contains', 'value' => 'somme'],
                ['type' => 'code_regex', 'value' => 'for\\s*\\(\\s*int\\s+i\\s*=\\s*1\\s*;\\s*i\\s*<=\\s*10'],
                ['type' => 'code_contains', 'value' => 'somme +='],
            ],
            'hints' => [
                'La boucle for a trois parties : initialisation, condition, incrément.',
                'Ajoute i à somme à chaque tour : somme += i;',
                'Après la boucle, somme doit valoir 55.',
            ],
            'solution' => '#include <iostream>

int main() {
    int somme = 0;

    for (int i = 1; i <= 10; ++i) {
        somme += i;
    }

    std::cout << "Somme : " << somme << std::endl;
    return 0;
}
',
            'explainFr' => '<code>somme += i</code> est une écriture courte de <code>somme = somme + i</code>. L\'accumulateur doit être initialisé à 0 avant la boucle, sinon il contient une valeur indéterminée.',
            'explainDarija' => '<code>somme += i</code> hiya kteba 9sira dyal <code>somme = somme + i</code>. Accumulateur khass ybda b 0 qbel boucle, ila machi ghadi ykhezen valeur ma3rofach.',
        ],

        // ---------------------------------------------------------- Niveau 5
        [
            'level'  => 5,
            'title'  => 'Intermédiaire — fonction',
            'lang'   => 'cpp',
            'instructions' => '<p>Écrivez une fonction <code>int carre(int x)</code> qui retourne <code>x * x</code>, puis appelez-la avec <code>7</code> et affichez le résultat.</p>',
            'instructionsDarija' => '<p>Kteb fonction <code>int carre(int x)</code> li katrje3 <code>x * x</code>, mn ba3d 3ayet 3liha b <code>7</code> w 3red résultat.</p>',
            'starter' => '#include <iostream>

// Déclare la fonction carre

int main() {
    // Appelle carre(7) et affiche le résultat

    return 0;
}
',
            'tests' => [
                ['type' => 'code_regex', 'value' => 'int\\s+carre\\s*\\(\\s*int\\s+x\\s*\\)'],
                ['type' => 'code_contains', 'value' => 'return'],
                ['type' => 'code_contains', 'value' => 'x * x'],
                ['type' => 'code_regex', 'value' => 'carre\\s*\\(\\s*7\\s*\\)'],
            ],
            'hints' => [
                'Une fonction précise son type de retour avant son nom.',
                'Le paramètre x est un entier passé à la fonction.',
                'return x * x; renvoie le carré au programme appelant.',
            ],
            'solution' => '#include <iostream>

int carre(int x) {
    return x * x;
}

int main() {
    std::cout << "Carre de 7 : " << carre(7) << std::endl;
    return 0;
}
',
            'explainFr' => 'Une fonction encapsule un calcul réutilisable. <code>carre(7)</code> renvoie 49, que <code>std::cout</code> affiche directement. Le type <code>int</code> devant le nom indique le type de la valeur retournée.',
            'explainDarija' => 'Fonction katjme3 calcul li tqder t3awdo. <code>carre(7)</code> katrje3 49, w <code>std::cout</code> kay3redha direct. Type <code>int</code> qbel smiya kay3ni type dyal valeur li katrje3.',
        ],

        // ---------------------------------------------------------- Niveau 6
        [
            'level'  => 6,
            'title'  => 'Défi — moyenne avec vector et fonction',
            'lang'   => 'cpp',
            'instructions' => '<p>Écrivez un programme qui calcule la moyenne des notes <code>{12, 15, 18}</code>. Utilisez un <code>std::vector&lt;int&gt;</code>, une fonction <code>double moyenne(...)</code>, une boucle et un affichage final <code>Moyenne : 15</code>. Pensez à inclure <code>&lt;vector&gt;</code>.</p>',
            'instructionsDarija' => '<p>Kteb programme kay7seb moyenne dyal notes <code>{12, 15, 18}</code>. Khdem b <code>std::vector&lt;int&gt;</code>, fonction <code>double moyenne(...)</code>, boucle, w affichage <code>Moyenne : 15</code>. Ma tnsach <code>&lt;vector&gt;</code>.</p>',
            'starter' => '#include <iostream>
#include <vector>

// Fonction moyenne

int main() {
    std::vector<int> notes = {12, 15, 18};

    // Calcule et affiche la moyenne

    return 0;
}
',
            'tests' => [
                ['type' => 'code_contains', 'value' => '#include <vector>'],
                ['type' => 'code_contains', 'value' => 'std::vector<int>'],
                ['type' => 'code_regex', 'value' => 'double\\s+moyenne\\s*\\('],
                ['type' => 'code_contains', 'value' => 'for'],
                ['type' => 'code_contains', 'value' => 'return'],
                ['type' => 'code_contains', 'value' => 'Moyenne :'],
            ],
            'hints' => [
                'La fonction peut recevoir une référence constante : const std::vector<int>& notes.',
                'Additionne les notes dans une boucle puis divise par notes.size().',
                'Pour éviter la division entière, convertis la somme en double avec static_cast<double>.',
            ],
            'solution' => '#include <iostream>
#include <vector>

double moyenne(const std::vector<int>& notes) {
    int somme = 0;
    for (int note : notes) {
        somme += note;
    }
    return static_cast<double>(somme) / notes.size();
}

int main() {
    std::vector<int> notes = {12, 15, 18};
    std::cout << "Moyenne : " << moyenne(notes) << std::endl;
    return 0;
}
',
            'explainFr' => '<code>static_cast&lt;double&gt;(somme)</code> force un calcul décimal : sans lui, <code>45 / 3</code> resterait entier. Le passage par référence constante évite de copier le vecteur.',
            'explainDarija' => '<code>static_cast&lt;double&gt;(somme)</code> katjber calcul b virgule : bla bih, <code>45 / 3</code> kaybqa entier. Passage b référence constante kayweqef copie dyal vecteur.',
        ],
    ],
];
