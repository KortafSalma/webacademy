<?php
declare(strict_types=1);

return [
    'id' => 'cpp-ch32',
    'title' => 'Complexité : raisonner sur le coût des algorithmes',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Une croissance, pas un chronomètre.',
        'Comprendre : Deux boucles complètes imbriquées.',
        'Comprendre : Diviser la taille restante.',
        'Comprendre : Mémoire supplémentaire.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Une croissance, pas un chronomètre',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>La notation O décrit une borne de croissance en fonction de la taille n. Une boucle qui parcourt n éléments a généralement un coût O(n) si son corps a un coût constant. O ne prédit pas un nombre exact de secondes : les constantes et le matériel influencent encore le temps réel.</p>',
                    'darija' => '<p>O katwsef kifach coût kaykber m3a taille n. Boucle 3la n éléments b corps constant hiya O(n). O ma kat3tich secondes exactes: matériel w constantes kay2etro.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Une croissance, pas un chronomètre',
                    'lang' => 'cpp',
                    'code' => '#include <iostream>
int main() {
    int operations = 0;
    for (int i = 0; i < 8; ++i) ++operations;
    std::cout << operations << "\\n";
}',
                    'output' => '8',
                    'explainFr' => 'La notation O décrit une borne de croissance en fonction de la taille n. Une boucle qui parcourt n éléments a généralement un coût O(n) si son corps a un coût constant. O ne prédit pas un nombre exact de secondes : les constantes et le matériel influencent encore le temps réel.',
                    'explainDarija' => 'O katwsef kifach coût kaykber m3a taille n. Boucle 3la n éléments b corps constant hiya O(n). O ma kat3tich secondes exactes: matériel w constantes kay2etro.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Deux boucles complètes imbriquées',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Deux boucles de n tours chacune imbriquées exécutent le corps interne n × n fois, soit O(n²), si ce corps est constant. Deux boucles successives donnent n + n, soit O(n). L’imbrication seule ne suffit pas : analysez aussi les bornes réelles et ce que fait chaque tour.</p>',
                    'darija' => '<p>Jouj boucles kamlin imbriqués, kol wa7da n tours, kay3tiw n². Jouj boucles successives kay3tiw 2n donc O(n). Chof bornes w coût dyal corps.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Deux boucles complètes imbriquées',
                    'lang' => 'cpp',
                    'code' => '#include <iostream>
int main() {
    int operations = 0;
    for (int i = 0; i < 4; ++i)
        for (int j = 0; j < 4; ++j) ++operations;
    std::cout << operations << "\\n";
}',
                    'output' => '16',
                    'explainFr' => 'Deux boucles de n tours chacune imbriquées exécutent le corps interne n × n fois, soit O(n²), si ce corps est constant. Deux boucles successives donnent n + n, soit O(n). L’imbrication seule ne suffit pas : analysez aussi les bornes réelles et ce que fait chaque tour.',
                    'explainDarija' => 'Jouj boucles kamlin imbriqués, kol wa7da n tours, kay3tiw n². Jouj boucles successives kay3tiw 2n donc O(n). Chof bornes w coût dyal corps.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Diviser la taille restante',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Diviser la taille restante par deux à chaque étape conduit à O(log n) étapes. La recherche binaire utilise cette idée sur une séquence triée avec un accès adapté. Il faut compter séparément un éventuel tri préalable. Ici, 16 devient 8, 4, 2 puis 1, soit quatre divisions.</p>',
                    'darija' => '<p>Ila kol étape kat9sem taille 3la jouj, étapes O(log n). Recherche binaire katsta3mel had fikra 3la données triées. Tri 9bel recherche 3endo coût bo7do. 16 katwlli 8,4,2,1: 4 étapes.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Diviser la taille restante',
                    'lang' => 'cpp',
                    'code' => '#include <iostream>
int main() {
    int n = 16;
    int etapes = 0;
    while (n > 1) { n /= 2; ++etapes; }
    std::cout << etapes << "\\n";
}',
                    'output' => '4',
                    'explainFr' => 'Diviser la taille restante par deux à chaque étape conduit à O(log n) étapes. La recherche binaire utilise cette idée sur une séquence triée avec un accès adapté. Il faut compter séparément un éventuel tri préalable. Ici, 16 devient 8, 4, 2 puis 1, soit quatre divisions.',
                    'explainDarija' => 'Ila kol étape kat9sem taille 3la jouj, étapes O(log n). Recherche binaire katsta3mel had fikra 3la données triées. Tri 9bel recherche 3endo coût bo7do. 16 katwlli 8,4,2,1: 4 étapes.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-4',
            'title' => 'Mémoire supplémentaire',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Une copie d’un tableau de n éléments nécessite O(n) mémoire supplémentaire. Un compteur simple utilise O(1) mémoire supplémentaire. Choisissez d’abord une solution correcte ; comparez ensuite temps et mémoire pour les tailles de données visées. La mémoire occupée par les entrées ne doit pas être confondue avec la mémoire auxiliaire.</p>',
                    'darija' => '<p>Copie tableau b n éléments kat7taj O(n) mémoire zayda. Compteur wa7ed O(1). Lwel solution s7i7a, men ba3d qaren temps w mémoire. Mémoire entrées machi mémoire auxiliaire.</p>'
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Déduire le coût seulement du nombre de boucles visibles',
            'fix' => 'Analyser les bornes, l’imbrication et le coût du corps exécuté.',
            'fr' => 'Analyser les bornes, l’imbrication et le coût du corps exécuté.',
            'darija' => 'Chof bornes, imbrication w coût corps.'
        ]
    ],
    'summary' => [
        'fr' => 'La notation O décrit une borne de croissance en fonction de la taille n. Une boucle qui parcourt n éléments a généralement un coût O(n) si son corps a un coût constant. O ne prédit pas un nombre exact de secondes : les constantes et le matériel influencent encore le temps réel. Deux boucles de n tours chacune imbriquées exécutent le corps interne n × n fois, soit O(n²), si ce corps est constant. Deux boucles successives donnent n + n, soit O(n). L’imbrication seule ne suffit pas : analysez aussi les bornes réelles et ce que fait chaque tour. Diviser la taille restante par deux à chaque étape conduit à O(log n) étapes. La recherche binaire utilise cette idée sur une séquence triée avec un accès adapté. Il faut compter séparément un éventuel tri préalable. Ici, 16 devient 8, 4, 2 puis 1, soit quatre divisions. Une copie d’un tableau de n éléments nécessite O(n) mémoire supplémentaire. Un compteur simple utilise O(1) mémoire supplémentaire. Choisissez d’abord une solution correcte ; comparez ensuite temps et mémoire pour les tailles de données visées. La mémoire occupée par les entrées ne doit pas être confondue avec la mémoire auxiliaire.',
        'darija' => 'O katwsef kifach coût kaykber m3a taille n. Boucle 3la n éléments b corps constant hiya O(n). O ma kat3tich secondes exactes: matériel w constantes kay2etro. Jouj boucles kamlin imbriqués, kol wa7da n tours, kay3tiw n². Jouj boucles successives kay3tiw 2n donc O(n). Chof bornes w coût dyal corps. Ila kol étape kat9sem taille 3la jouj, étapes O(log n). Recherche binaire katsta3mel had fikra 3la données triées. Tri 9bel recherche 3endo coût bo7do. 16 katwlli 8,4,2,1: 4 étapes. Copie tableau b n éléments kat7taj O(n) mémoire zayda. Compteur wa7ed O(1). Lwel solution s7i7a, men ba3d qaren temps w mémoire. Mémoire entrées machi mémoire auxiliaire.'
    ]
];
