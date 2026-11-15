<?php
declare(strict_types=1);

return [
    'id' => 'cpp-ex31',
    'title' => 'Algorithmes STL : trier, rechercher et filtrer',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Triez {14,9,18,14} avec std::sort puis affichez le vector. Compilez localement avec g++ -std=c++17.',
            'lang' => 'cpp',
            'instructions' => '<p>Triez {14,9,18,14} avec std::sort puis affichez le vector. Compilez localement avec g++ -std=c++17.</p>',
            'instructionsDarija' => '<p>Retteb vector b std::sort w 3red notes, compili localement b g++.</p>',
            'starter' => '#include <iostream>
int main() {
    // Votre solution
}
',
            'tests' => [
                [
                    'type' => 'code_contains',
                    'value' => 'std::sort'
                ],
                [
                    'type' => 'code_contains',
                    'value' => '.begin()'
                ],
                [
                    'type' => 'code_contains',
                    'value' => '.end()'
                ]
            ],
            'hints' => [
                'std::sort réorganise les éléments sur place. Il exige des itérateurs à accès aléatoire, comme ceux de vector ; pour list, utilisez sa méthode sort. Un comparateur doit définir un ordre cohérent : par exemple a &lt; b, jamais a &lt;= b. Le tri par défaut des entiers est croissant.'
            ],
            'solution' => '#include <algorithm>
#include <iostream>
#include <vector>
int main() {
    std::vector<int> notes{14, 9, 18, 14};
    std::sort(notes.begin(), notes.end());
    for (int note : notes) std::cout << note << " ";
    std::cout << "\\n";
}',
            'explainFr' => 'Résultat attendu : 9 14 14 18. std::sort réorganise les éléments sur place. Il exige des itérateurs à accès aléatoire, comme ceux de vector ; pour list, utilisez sa méthode sort. Un comparateur doit définir un ordre cohérent : par exemple a &lt; b, jamais a &lt;= b. Le tri par défaut des entiers est croissant.',
            'explainDarija' => 'Retteb vector b std::sort w 3red notes, compili localement b g++.'
        ],
        [
            'level' => 2,
            'title' => 'Comptez les notes au moins égales à 10 dans {14,9,18,14} avec std::count_if et une lambda.',
            'lang' => 'cpp',
            'instructions' => '<p>Comptez les notes au moins égales à 10 dans {14,9,18,14} avec std::count_if et une lambda.</p>',
            'instructionsDarija' => '<p>7seb notes &gt;= 10 b count_if w lambda.</p>',
            'starter' => '#include <iostream>
int main() {
    // Votre solution
}
',
            'tests' => [
                [
                    'type' => 'code_contains',
                    'value' => 'std::count_if'
                ],
                [
                    'type' => 'code_contains',
                    'value' => '>= 10'
                ]
            ],
            'hints' => [
                'std::count_if compte les valeurs pour lesquelles un prédicat renvoie true. Une lambda peut recevoir une note et vérifier note &gt;= 10. Le vector reste inchangé : compter n’est pas supprimer. Pour copier uniquement certaines valeurs, un autre algorithme, copy_if, est disponible.'
            ],
            'solution' => '#include <algorithm>
#include <iostream>
#include <vector>
int main() {
    std::vector<int> notes{14, 9, 18, 14};
    auto admis = std::count_if(notes.begin(), notes.end(),
        [](int note) { return note >= 10; });
    std::cout << admis << "\\n";
}',
            'explainFr' => 'Résultat attendu : 3. std::count_if compte les valeurs pour lesquelles un prédicat renvoie true. Une lambda peut recevoir une note et vérifier note &gt;= 10. Le vector reste inchangé : compter n’est pas supprimer. Pour copier uniquement certaines valeurs, un autre algorithme, copy_if, est disponible.',
            'explainDarija' => '7seb notes >= 10 b count_if w lambda.'
        ]
    ]
];
