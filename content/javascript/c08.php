<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 8 : Opérateurs et expressions
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch8',
    'title'    => 'Opérateurs et expressions',
    'subtitle' => 'Les symboles et combinaisons pour manipuler des valeurs.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['Savoir déclarer des variables et connaître les types'],

    'objectives' => [
        'Utiliser les opérateurs arithmétiques, de comparaison et logiques.',
        'Comprendre la priorité des opérateurs.',
        'Utiliser les opérateurs unaires et binaires.',
        'Créer des expressions complexes et lisibles.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'operateurs-arithmetiques',
            'title' => 'Opérateurs arithmétiques',
            'icon'  => '➕➖×÷',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs arithmétiques de base sont :</p><ul><li><code>+</code> : addition</li><li><code>-</code> : soustraction</li><li><code>*</code> : multiplication</li><li><code>/</code> :division (retourne un nombre à virgule)</li><li><code>%</code> : modulo (reste de la division)</li><li><code>++</code> : incrémentation</li><li><code>--</code> : décrémentation</li></ul>',
                 'darija' => '<p>Opérateurs arithmétiques de base :</li><li><code>+</code> : addition</li><li><code>-</code> : soustraction</li><li><code>*</code> : multiplication</li><li><code>/</code> :division (kay7et nombre b virgule)</li><li><code>%</code> : modulo (reste division)</li><li><code>++</code> : incrémentation</li><li><code>--</code> : décrémentation</li></ul>'],

                ['type' => 'example', 'title' => 'Toutes les opérations',
                 'lang'  => 'javascript',
                 'code'  => 'const a = 10;\nconst b = 3;\nconsole.log(a + b); // 13\nconsole.log(a - b); // 7\nconsole.log(a * b); // 30\nconsole.log(a / b); // 3.333...\nconsole.log(a % b); // 1 (reste)',
                 'explainFr' => 'Le modulo donne le reste de la division euclidienne.',
                 'explainDarija' => 'Modulo kayder reste division euclidienne.'],

                ['type' => 'example', 'title' => 'Incrémentation et décrémentation',
                 'lang'  => 'javascript',
                 'code'  => 'let i = 0;\nconsole.log(i++); // 0 (post-incrémentation : d'abord afficher, puis incrémenter)\nconsole.log(i);   // 1\nconsole.log(++i); // 2 (pré-incrémentation : incrémenter d'abord, puis afficher)',
                 'explainFr' => 'i++ affiche la valeur actuelle puis l\'incrémente. ++i incrémente d\'abord puis affiche la nouvelle valeur.',
                 'explainDarija' => 'i++ kay9der kay7et valeur b9der kay9der kay9der incrementer. ++i kay9der incrementer b9der kay9der afficher.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'operateurs-comparaison',
            'title' => 'Opérateurs de comparaison',
            'icon'  => '✅❌',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs de comparaison restituient un booléen (true ou false) :</p><ul><li><code>===</code> : égalité stricte (valeur et type identiques)</li><li><code!==</code> : inégalité stricte</li><li><code>==</code> : égalité lâche (convertit les types)</li><li><code><</code>, <code>></code>, <code><=</code>, <code>>=</code> : comparaisons</li></ul>',
                 'darija' => '<p>Operators comparison kay9der boolean (true w false) :</li><li><code>===</code> : égalité stricte (valeur w type identiques)</li><li><code>!==</code> : inégalité stricte</li><li><code>==</code> : égalité lâche (convertit types)</li><li><code><</code>, <code>></code>, <code><=</code>, <code>>=</code> : comparaisons</li></ul>'],

                ['type' => 'example', 'title' => 'Comparaison stricte vs lâche',
                 'lang'  => 'javascript',
                 'code'  => 'console.log(5 == "5");  // true (conversion de type)\nconsole.log(5 === "5"); // false (types différents)\nconsole.log(5 != "5");  // false\nconsole.log(5 !== "5"); // true',
                 'explainFr' => '=== est préférable pour éviter les conversions surprises.',
                 'explainDarija' => '=== kay9der pr favoriser b9der conversions surprises.'],

                ['type' => 'true_false',
                 'question' => '5 == "5" vaut vrai en JavaScript.',
                 'answer' => 0,
                 'concept' => 'Comparaison lâche',
                 'explainFr' => 'Vrai : JavaScript convertit "5" en nombre 5 pour la comparaison.',
                 'explainDarija' => 'Vrai : JavaScript convertit "5" en nombre 5.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'operateurs-logiques',
            'title' => 'Opérateurs logiques',
            'icon'  => '&&⬤||',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs logiques combinent des expressions booléennes :</p><ul><li><code>&&</code> (AND) : vrai si les deux opérandes sont vrais.</li><li><code>||</code> (OR) : vrai si au moins un opérande est vrai.</li><li><code>!</code> (NOT) : inverse la valeur booléenne.</li></ul><p>Important : JavaScript utilise le <strong>court-circuit</strong> : avec <code>&&</code>, si le premier opérande est faux, le second n\'est pas évalué ; avec <code>||</code>, si le premier est vrai, le second n\'est pas évalué.</p>',
                 'darija' => '<p>Operators logiques combinent expressions booléennes :</li><li><code>&&</code> (AND) : vrai si les deux opérandes sont vrais.</li><li><code>||</code> (OR) : vrai si au moins un opérande est vrai.</li><li><code>!</code> (NOT) : inverse la valeur.</li></ul><p>Important : JavaScript utilise le <strong>court-circuit</strong> : avec <code>&&</code>, si le premier opérande est faux, le second n\'est pas évalué ; avec <code>||</code>, si le premier est vrai, le second n\'est pas évalué.</p>',

                ['type' => 'example', 'title' => 'Court-circuit',
                 'lang'  => 'javascript',
                 'code'  => 'const utilisateur = null;\nconst message = utilisateur && utilisateur.nom || "Invité";\nconsole.log(message); // "Invité"\n\n// Autre exemple\nconst age = 20;\nif (age >= 18 || age < 0) {\n  console.log("Âge valide ou impossible");\n}',
                 'explainFr' => 'Si utilisateur est null, le second partie "Invité" est utilisé sans erreur.',
                 'explainDarija' => 'Si utilisateur null, second partie "Invité" kay9der kay9der kay9der kay9der erreur.'],

                ['type' => 'mcq',
                 'question' => 'Que vaut l\'expression suivante ?\nconst x = 5 || 3;',
                 'options' => '8', '5', '3', 'Erreur',
                 'answer' => 1,
                 'concept' => '|| (OR)',
                 'explainFr' => 'Si le premier opérande est vrai, il est retourné tel quel (court-circuit).',
                 'explainDarija' => 'Si first operand vrai, kay9der retourné kay9der court-circuit.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'priority-associativity',
            'title' => 'Priorité et associativité',
            'icon'  => '📊',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La priorité des opérateurs détermine l\'ordre d\'évaluation :</p><ul><li>Les opératoires unaires (!, -, ++, --) ont la priorité la plus haute.</li><li>Les opérateurs multiplicatifs (* / %) viennent ensuite.</li><li>Les opérateursadditifs (+ -) ont une priorité moyenne.</li><li>Les opérateurs de comparaison (===, etc.) viennent après.</li><li>Les opérateurs logiques (!&&||) ont la priorité la plus basse.</li></ul><p>L\'associativité détermine si l\'expression est évaluée de gauche à droite ou de droite à gauche (pour la plupart, c\'est de gauche à droite).</p>',
                 'darija' => '<p>Priority operators détermine ordre evaluation :</li><li>Unaires (!, -, ++, --) priorité plus haute.</li><li>Multiplicatifs (* / %) ensuite.</li><li>Additifs (+ -) priorité moyenne.</li><li>Comparaison (=== etc.) après.</li><li>Logiques (!&&||) priorité plus basse.</li></ul><p>Associativité détermine si expression évaluée gauche à droite ou droite à gauche (majoritairement gauche à droite).</p>',

                ['type' => 'example', 'title' => 'Priorité dans les expressions',
                 'lang'  => 'javascript',
                 'code'  => 'const a = 1 + 2 * 3;   // 1 + 6 = 7 (multiplication prioritaire)\nconst b = (1 + 2) * 3;   // 3 * 3 = 9 (parenthèses prioritaires)',
                 'explainFr' => 'Les multiplications s\'évaluent avant les additions sans parenthèses.',
                 'explainDarija' => 'Multiplications kayder evaluation b9der additions b9der parentheses.'],

                ['type' => 'mcq',
                 'question' => 'Quel est le résultat de 2 + 3 * 4 ?',
                 'options' => '20', '14', '11', 'Erreur',
                 'answer' => 1,
                 'concept' => 'Priorité',
                 'explainFr' => 'La multiplication s\'évalue d\'abord : 3 × 4 = 12, puis 2 + 12 = 14.',
                 'explainDarija' => 'Multiplication kayder b9der : 3 × 4 = 12, mn ba3d 2 + 12 = 14.'],

            ],
        ],

        // ------------------------------------------------ Section 5
        [
            'id'    => 'test-operateurs',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'L\'opérateur qui retourne le reste de la division s\'appelle _____ .',
                 'answer' => '%',
                 'concept' => 'Modulo',
                 'explainFr' => 'Le modulo (%) donne le reste.',
                 'explainDarija' => 'Modulo (%) kayder reste.'],

                ['type' => 'mcq',
                 'question' => 'Lequel de ces exemples utilise le court-circuit ?',
                 'options' => ['5 && 3', 'true || false', '!false', ' (5 > 3) && (2 < 4)'],
                 'answer' => 3,
                 'concept' => 'Court-circuit',
                 'explainFr' => 'L\'opérateur && court-circuite : si le premier est faux, le second n\'est pas évalué.',
                 'explainDarija' => 'Operator && court-circuit : si first falsy, second kayder évalué.'],

                ['type' => 'code_contains',
                 'question' => 'Lequel de ces extraits affiche true ?',
                 'code_a' => 'console.log(5 === "5");',
                 'code_b' => 'console.log(5 === 5);',
                 'answer' => 1,
                 'concept' === 'Strict equality',
                 'explainFr' => '5 === 5 est vrai (même valeur même type).',
                 'explainDarija' => '5 === 5 kayder true (même valeur même type).'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser == au lieu de === par habitude',
            'fix'    => 'Toujours préférer === pour éviter les conversions de type surprises.',
            'fr'     => 'L\'opérateur == effectue une conversion de type avant la comparaison, ce qui peut mener à des résultats inattendus comme "" == false ou "0" == false.',
            'darija' => 'Operator == kay9der conversion type b9der comparison inattendue.'],
        ],
        [
            'wrong'  => 'Oublier les parenthèses dans des expressions complexes',
            'fix'    => 'Utilisez toujours des parenthèses pour clarifier la priorité attendue.',
            'fr'     => 'Le code (a + b) * c est bien plus lisible et sûr que a + b * c.',
            'darija' => 'Code (a + b) * c kay9der kay9der lisible w plus sûr kay9der a + b * c.'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose les opérateurs arithmétiques (+ - * / %), de comparaison (=== !== < > <= >=) et logiques (&& || !). La priorité des opérateurs détermine l\'ordre d\'évaluation ; les parenthèses peuvent modifier cet ordre. Le court-circuit (&&, ||) évite d\'évaluer inutilement des secondes expressions.',
        'darija' => '<strong>JavaScript</strong> kay9der operators arithmétiques (+ - * / %), comparison (=== !== < > <= logique (&& || !). Priority kayder ordre evaluation ; parentheses kayder modifier ordre. Court-circuit (&&, ||) évite d\'évaluer expressions secondes.'],
    ],
];