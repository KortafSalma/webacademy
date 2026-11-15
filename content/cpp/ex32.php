<?php
declare(strict_types=1);

return [
    'id' => 'cpp-ex32',
    'title' => 'Complexité : raisonner sur le coût des algorithmes',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Avec deux boucles imbriquées de quatre tours chacune, incrémentez operations dans le corps interne puis affichez le compteur.',
            'lang' => 'cpp',
            'instructions' => '<p>Avec deux boucles imbriquées de quatre tours chacune, incrémentez operations dans le corps interne puis affichez le compteur.</p>',
            'instructionsDarija' => '<p>Dir jouj boucles de 4 tours w 7seb operations dakhel boucle dakhliya.</p>',
            'starter' => '#include <iostream>
int main() {
    // Votre solution
}
',
            'tests' => [
                [
                    'type' => 'code_contains',
                    'value' => 'for'
                ],
                [
                    'type' => 'code_contains',
                    'value' => '++operations'
                ]
            ],
            'hints' => [
                'Deux boucles de n tours chacune imbriquées exécutent le corps interne n × n fois, soit O(n²), si ce corps est constant. Deux boucles successives donnent n + n, soit O(n). L’imbrication seule ne suffit pas : analysez aussi les bornes réelles et ce que fait chaque tour.'
            ],
            'solution' => '#include <iostream>
int main() {
    int operations = 0;
    for (int i = 0; i < 4; ++i)
        for (int j = 0; j < 4; ++j) ++operations;
    std::cout << operations << "\\n";
}',
            'explainFr' => 'Résultat attendu : 16. Deux boucles de n tours chacune imbriquées exécutent le corps interne n × n fois, soit O(n²), si ce corps est constant. Deux boucles successives donnent n + n, soit O(n). L’imbrication seule ne suffit pas : analysez aussi les bornes réelles et ce que fait chaque tour.',
            'explainDarija' => 'Dir jouj boucles de 4 tours w 7seb operations dakhel boucle dakhliya.'
        ],
        [
            'level' => 2,
            'title' => 'Partez de n = 16, divisez n par deux jusqu’à 1 et comptez le nombre d’étapes.',
            'lang' => 'cpp',
            'instructions' => '<p>Partez de n = 16, divisez n par deux jusqu’à 1 et comptez le nombre d’étapes.</p>',
            'instructionsDarija' => '<p>Bda b 16 w 9sem 3la jouj 7ta 1. 7seb étapes, khas 4.</p>',
            'starter' => '#include <iostream>
int main() {
    // Votre solution
}
',
            'tests' => [
                [
                    'type' => 'code_contains',
                    'value' => 'while'
                ],
                [
                    'type' => 'code_contains',
                    'value' => 'n /= 2'
                ]
            ],
            'hints' => [
                'Diviser la taille restante par deux à chaque étape conduit à O(log n) étapes. La recherche binaire utilise cette idée sur une séquence triée avec un accès adapté. Il faut compter séparément un éventuel tri préalable. Ici, 16 devient 8, 4, 2 puis 1, soit quatre divisions.'
            ],
            'solution' => '#include <iostream>
int main() {
    int n = 16;
    int etapes = 0;
    while (n > 1) { n /= 2; ++etapes; }
    std::cout << etapes << "\\n";
}',
            'explainFr' => 'Résultat attendu : 4. Diviser la taille restante par deux à chaque étape conduit à O(log n) étapes. La recherche binaire utilise cette idée sur une séquence triée avec un accès adapté. Il faut compter séparément un éventuel tri préalable. Ici, 16 devient 8, 4, 2 puis 1, soit quatre divisions.',
            'explainDarija' => 'Bda b 16 w 9sem 3la jouj 7ta 1. 7seb étapes, khas 4.'
        ]
    ]
];
