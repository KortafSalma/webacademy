<?php
declare(strict_types=1);

return [
    'id' => 'cpp-ch31',
    'title' => 'Algorithmes STL : trier, rechercher et filtrer',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Intervalles et recherche.',
        'Comprendre : Trier un vector.',
        'Comprendre : Compter avec un prédicat.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Intervalles et recherche',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Les algorithmes reçoivent souvent un intervalle [begin, end) : begin est inclus, end exclu. std::find renvoie un itérateur vers la valeur ou end si elle est absente. Ne déréférencez jamais end. Incluez explicitement algorithm pour utiliser les algorithmes de la bibliothèque standard.</p>',
                    'darija' => '<p>Algorithmes kayakhdo intervalle begin inclus w end exclus. Find katrje3 itérateur wla end ila ma l9atch. Ma tdirch dereference l end. Zid include algorithm.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Intervalles et recherche',
                    'lang' => 'cpp',
                    'code' => '#include <algorithm>
#include <iostream>
#include <vector>
int main() {
    std::vector<int> notes{14, 9, 18};
    auto it = std::find(notes.begin(), notes.end(), 18);
    if (it != notes.end()) std::cout << *it << "\\n";
}',
                    'output' => '18',
                    'explainFr' => 'Les algorithmes reçoivent souvent un intervalle [begin, end) : begin est inclus, end exclu. std::find renvoie un itérateur vers la valeur ou end si elle est absente. Ne déréférencez jamais end. Incluez explicitement algorithm pour utiliser les algorithmes de la bibliothèque standard.',
                    'explainDarija' => 'Algorithmes kayakhdo intervalle begin inclus w end exclus. Find katrje3 itérateur wla end ila ma l9atch. Ma tdirch dereference l end. Zid include algorithm.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Trier un vector',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>std::sort réorganise les éléments sur place. Il exige des itérateurs à accès aléatoire, comme ceux de vector ; pour list, utilisez sa méthode sort. Un comparateur doit définir un ordre cohérent : par exemple a &lt; b, jamais a &lt;= b. Le tri par défaut des entiers est croissant.</p>',
                    'darija' => '<p>Sort katbeddel ordre f nafs vector w kat7taj accès aléatoire. List 3endha méthode sort. Comparateur khas ordre coherent, a &lt; b machi a &lt;= b. Tri défaut croissant.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Trier un vector',
                    'lang' => 'cpp',
                    'code' => '#include <algorithm>
#include <iostream>
#include <vector>
int main() {
    std::vector<int> notes{14, 9, 18, 14};
    std::sort(notes.begin(), notes.end());
    for (int note : notes) std::cout << note << " ";
    std::cout << "\\n";
}',
                    'output' => '9 14 14 18',
                    'explainFr' => 'std::sort réorganise les éléments sur place. Il exige des itérateurs à accès aléatoire, comme ceux de vector ; pour list, utilisez sa méthode sort. Un comparateur doit définir un ordre cohérent : par exemple a &lt; b, jamais a &lt;= b. Le tri par défaut des entiers est croissant.',
                    'explainDarija' => 'Sort katbeddel ordre f nafs vector w kat7taj accès aléatoire. List 3endha méthode sort. Comparateur khas ordre coherent, a &lt; b machi a &lt;= b. Tri défaut croissant.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Compter avec un prédicat',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>std::count_if compte les valeurs pour lesquelles un prédicat renvoie true. Une lambda peut recevoir une note et vérifier note &gt;= 10. Le vector reste inchangé : compter n’est pas supprimer. Pour copier uniquement certaines valeurs, un autre algorithme, copy_if, est disponible.</p>',
                    'darija' => '<p>Count_if kat7seb valeurs li prédicat dyalhom true. Lambda katjرب note >= 10. Vector kayb9a kifma howa: compter machi supprimer. Ila bghiti copier ghir chi valeurs, kayn copy_if.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Compter avec un prédicat',
                    'lang' => 'cpp',
                    'code' => '#include <algorithm>
#include <iostream>
#include <vector>
int main() {
    std::vector<int> notes{14, 9, 18, 14};
    auto admis = std::count_if(notes.begin(), notes.end(),
        [](int note) { return note >= 10; });
    std::cout << admis << "\\n";
}',
                    'output' => '3',
                    'explainFr' => 'std::count_if compte les valeurs pour lesquelles un prédicat renvoie true. Une lambda peut recevoir une note et vérifier note &gt;= 10. Le vector reste inchangé : compter n’est pas supprimer. Pour copier uniquement certaines valeurs, un autre algorithme, copy_if, est disponible.',
                    'explainDarija' => 'Count_if kat7seb valeurs li prédicat dyalhom true. Lambda katjرب note >= 10. Vector kayb9a kifma howa: compter machi supprimer. Ila bghiti copier ghir chi valeurs, kayn copy_if.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Lire le résultat de find sans contrôle',
            'fix' => 'Comparer l’itérateur à end avant de lire sa valeur.',
            'fr' => 'Comparer l’itérateur à end avant de lire sa valeur.',
            'darija' => 'T2ekked it != end 9bel ma tqra valeur.'
        ]
    ],
    'summary' => [
        'fr' => 'Les algorithmes reçoivent souvent un intervalle [begin, end) : begin est inclus, end exclu. std::find renvoie un itérateur vers la valeur ou end si elle est absente. Ne déréférencez jamais end. Incluez explicitement algorithm pour utiliser les algorithmes de la bibliothèque standard. std::sort réorganise les éléments sur place. Il exige des itérateurs à accès aléatoire, comme ceux de vector ; pour list, utilisez sa méthode sort. Un comparateur doit définir un ordre cohérent : par exemple a &lt; b, jamais a &lt;= b. Le tri par défaut des entiers est croissant. std::count_if compte les valeurs pour lesquelles un prédicat renvoie true. Une lambda peut recevoir une note et vérifier note &gt;= 10. Le vector reste inchangé : compter n’est pas supprimer. Pour copier uniquement certaines valeurs, un autre algorithme, copy_if, est disponible.',
        'darija' => 'Algorithmes kayakhdo intervalle begin inclus w end exclus. Find katrje3 itérateur wla end ila ma l9atch. Ma tdirch dereference l end. Zid include algorithm. Sort katbeddel ordre f nafs vector w kat7taj accès aléatoire. List 3endha méthode sort. Comparateur khas ordre coherent, a &lt; b machi a &lt;= b. Tri défaut croissant. Count_if kat7seb valeurs li prédicat dyalhom true. Lambda katjرب note >= 10. Vector kayb9a kifma howa: compter machi supprimer. Ila bghiti copier ghir chi valeurs, kayn copy_if.'
    ]
];
