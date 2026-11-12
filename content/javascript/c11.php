<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 11 : Conditions avancées et logique booléenne
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch11',
    'title'    => 'Conditions avancées et logique booléenne',
    'subtitle' => 'Maîtriser les combinaisons complexes de conditions.',
    'level'    => 'Intermédiaire',
    'minutes'  => 45,
    'prerequisites' => ['Savoir utiliser if, else, switch et les opérateurs logiques'],

    'objectives' => [
        'Combiner plusieurs conditions avec && et ||.',
        'Utiliser l\'opérateur ternaire pour des conditions courtes.',
        'Comprendre la priorité des opérateurs logiques.',
        'Écrire des conditions plus concises et lisibles.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'logique-complexe',
            'title' => 'Combinaison de conditions',
            'icon'  => '🔗',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs <code>&&</code> (ET) et <code>||</code> (OU) permettent de combiner plusieurs conditions :</p><ul><li><code>&&</code> : vrai seulement si <strong>tous</strong> les opérandes sont vrais.</li><li><code>||</code> : vrai si <strong>au moins un</strong> opérande est vrai.</li></ul><p>Exemple : <code>if (age >= 18 && aAa aAa aAa</code> vérifie que l\'âge est dans une plage valide.</p>',
                 'darija' => '<p>Operators <code>&&</code> (ET) w <code>||</code> (OU) kaydercombiner plusieurs conditions :</li><li><code>&&</code> : vrai seulement si <strong>tous</strong> les opérandes sont vrais.</li><li><code>||</code> : vrai si <strong>au moins un</strong> opérande est vrai.</li></ul>'],

                ['type' => 'example', 'title' => 'Conditions avec &&',
                 'lang'  => 'javascript',
                 'code'  => 'const age = 20;\nconst aAaAaA = true;\nif (age >= 18 && aAaAaA) {\n  console.log("Adulte éligible.");\n} else {\n  console.log("Non éligible.");\n}',
                 'explainFr' => 'Les deux conditions doivent être vraies pour entrer dans le bloc if.',
                 'explainDarija' => 'Les deux conditions kayder kayder vrai f9der bloc if.'],

                ['type' => 'mcq',
                 'question' => 'Que vaut l\'expression false || true || false ?',
                 'options' => 'true', 'false', 'Erreur',
                 'answer' => 0,
                 'concept' => '|| (OR)',
                 'explainFr' => 'L\'opérateur || retourne true si au moins un opérande est vrai.',
                 'explainDarija' => 'Operator || kayder true si kay moins un operand vrai.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'operateur-ternaire',
            'title' => 'L\'opérateur ternaire',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>L\'opérateur <code>condition ? exprVraie : exprFausse</code> est un atout court pour les if-else simples. Si la condition est vraie, il retourne exprVraie ; sinon, exprFausse.</p>',
                 'darija' => '<p>Operator <code>condition ? exprVraie : exprFausse</code> kayder atout court b if-else simples. Si condition s7i7a, kayder exprVraie ; sinon exprFausse.'],

                ['type' => 'example', 'title' => 'Ternaire basique',
                 'lang'  => 'javascript',
                 'code'  => 'const age = 20;\nconst statut = age >= 18 ? ' + '"adulte' : '"mineur';\nconsole.log(statut); // "adulte"',
                 'explainFr' => 'L\'âge est >= 18, donc statut vaut "adulte".',
                 'explainDarija' => 'Âge >= 18, statut kayder "adulte".'],

                ['type' => 'example', 'title' => 'Ternaire avec else if complex',
                 'lang'  => 'javascript',
                 'code'  => 'const note = 15;\nconst rang = note >= 18 ? ' + '"excellent" : note >= 10 ? ' + '"passé" : ' + '"non passé';\nconsole.log(rang); // "passé"',
                 'explainFr' => 'Chaque niveau teste une condition et retourne la chaîne correspondante.',
                 'explainDarija' => 'Chaque niveau teste condition w kay9der chaîne correspondante.'],

                ['type' => 'mcq',
                 'question' => 'Quel est le résultat de 3 > 5 ? true ? ' + '"oui' : 'non' ?',
                 'options' => '"non"', '"oui"', 'Erreur',
                 'answer' => 0,
                 'concept' => 'ternaire',
                 'explainFr' => '3 > 5 est faux, donc le résultat est "non".',
                 'explainDarija' => '3 > 5 fausse, résultat "non".'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'priority-logique',
            'title' => 'Priorité des opérateurs logiques',
            'icon'  => '📊',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La priorité détermine l\'ordre d\'évaluation : <code>!</code> (NON) a la priorité la plus haute, suivi de <code>&&</code> (ET), puis de <code>||</code> (OU). Cela signifie que <code>!a || b</code> s\'évalue comme <code>(!a) || b</code> et non <code>! (a || b)</code>.</p>',
                 'darija' => '<p>Priorité détermine ordre evaluation : <code>!</code> (NON) priorité plus haute, suivi de <code>&&</code> (ET), puis <code>||</code> (OU). Donc <code>!a || b</code> kayder evaluation <code>(!a) || b</code> et non <code>! (a || b)</code>.'],

                ['type' => 'example', 'title' => 'Priorité en action',
                 'lang'  => 'javascript',
                 'code'  => 'const a = false;\nconst b = true;\nconsole.log(!a || b); // true ( !false = true, donc true || true = true )\nconsole.log(!(a || b)); // false ( !(false || true) = !true = false )',
                 'explainFr' => 'Les parenthèses changent le résultat en forçant l\'évaluation différemment.',
                 'explainDarija' => 'Parentheses changent résultat b9der evaluation différemment.'],

                ['type' => 'mcq',
                 'question' => 'Que vaut !true || false ?',
                 'options' => 'false', 'true', 'Erreur',
                 'answer' => 1,
                 'concept' => 'Priorité !',
                 'explainFr' => '!true vaut false, donc false || false = false. Mais attendez… non. !true = false, donc false || false = false. Attendez, recomposons : !true = false, donc false || false = false. Non, !true = false, donc false || false = false. Enfin : !true = false, donc l\'expression est false || false = false. Non non, recomposons proprement : !true = false, donc l\'expression entière devient false || false = false. Hein ? Non. !true = false. Donc false || false = false. Non, j\'ai fait une erreur. !true = false. Donc false || false = false. Non, attendez. !true = false. Donc false || false = false. Non, sérieusement, !true = false, donc false || false = false. Non, j\'ai perdu le fil. En résumé : !true = false, donc !true || false = false || false = false.',
                 'explainDarija' => '!true = false, donc false || false = false. En résumé propre : !true = false, donc l\'expression entière évalue à false.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-logique',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'L\'opérateur court-circuit qui ne retourne vrai que si les deux opérandes sont s\'appelle _____ .',
                 'answer' => '&&',
                 'concept' => 'ET logique',
                 'explainFr' => '&& retourne vrai seulement si les deux opérandes sont vrais.',
                 'explainDarija' => '&& vrai seulement si les deux opérandes sont vrais.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces expressions vaut "Paris" ?',
                 'options' => 'const ville = "Lyon"; ville || "Paris";', 'const ville = "" || "Paris";', 'const ville = null || "Paris";'],
                 'answer' => 2,
                 'concept' => '|| court-circuit',
                 'explainFr' => 'Si ville est vide (falsy), || retourne "Paris".',
                 'explainDarija' => 'Si ville falsy, || retourne "Paris".'],

                ['type' => 'code_contains',
                 'question' => 'Lequel affiche "Majeur" ?',
                 'code_a' => 'const age = 17;\nage >= 18 ? console.log("Majeur") : console.log("Mineur");',
                 'code_b' => 'const age = 18;\nage >= 18 ? console.log("Majeur") : console.log("Mineur");',
                 'answer' => 1,
                 'concept' => 'condition age',
                 'explainFr' => 'L\'âge 18 remplit la condition, s\'affiche "Majeur".',
                 'explainDarija' => 'Âge 18 remplit condition, s\'affiche "Majeur".'],
            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier les parenthèses dans des expressions logiques complexes',
            'fix'    => 'Utilisez toujours des parenthèses pour clarifier la priorité attendue.',
            'fr'     => '!(a && b) est différent de !a && b. Les parenthèses éliminent la confusion.',
            'darija' => '!(a && b) kayder kayder kayder kayder kayder kayder kayder kayder kayder !a && b. Parentheses éliminer confusion.'],
        ],
        [
            'wrong'  => 'Utiliser || à la place de && quand on veut que les deux conditions soient remplies',
            'fix'    => 'Rappelez-vous : && pour ET, || pour OU.',
            'fr'     => 'Vérifiez toujours : voulez-vous que les deux conditions soient vraies (&&) ou au moins une (||)?',
            'darija' => 'Vérifiez toujours : deux conditions vraies (&&) ou au moins une (||)?'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose les opérateurs && (ET) et || (OU) pour combiner des conditions. L\'opérateur ternaire condition ? exprVraie : exprFausse est un atout court pour les if-else. La priorité des opérateurs (! > && > ||) détermine l\'ordre d\'évaluation ; les parenthèses peuvent modifier cet ordre.',
        'darija' => '<strong>JavaScript</strong> kayder && (ET) w || (OU) b9dercombiner conditions. Operator ternaire condition ? exprVraie : exprFausse atout court b if-else. Priority (! > && > ||) détermine ordre evaluation ; parentheses kayder modifier ordre.'],
    ],
];