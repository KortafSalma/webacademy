<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 9 : Conditions : if, else et switch
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch9',
    'title'    => 'Conditions : if, else et switch',
    'subtitle' => 'Prendre des décisions dans le code.',
    'level'    => 'Débutant',
    'minutes'  => 40,
    'prerequisites' => ['Savoir utiliser les opérateurs de comparaison'],

    'objectives' => [
        'Écrire des structures conditionnelles avec if, else if et else.',
        'Utiliser switch pour les nombreuses conditions sur une même variable.',
        'Comprendre le bloc d\'exécution et les sauts.',
        'Éviter les conditions redondantes.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'conditions-if',
            'title' => 'L\'instruction if',
            'icon'  => '🔀',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>L\'instruction <code>if</code> exécute un bloc de code si la condition est vraie. La condition est placée entre parenthèses et doit retourner un booléen (true/false). Si la condition est fausse, le code est ignoré.</p>',
                 'darija' => '<p>L\'instruction <code>if</code> kay3ter bloc code b condition s7i7a. Condition b parenthèses w kay9der kay9der booléen (true/false). Ila condition fausse, code kay7et ignorer.'],

                ['type' => 'example', 'title' => 'if basique',
                 'lang'  => 'javascript',
                 'code'  => 'const age = 18;\nif (age >= 18) {\n  console.log("Vous êtes majeur.");\n}',
                 'explainFr' => 'La condition age >= 18 est vraie, donc le message s\'affiche.',
                 'explainDarija' => 'Condition age >= 18 s7i7a, message kaytkhed.'],

                ['type' => 'true_false',
                 'question' => 'Une instruction if peut contenir plusieurs conditions sans opérateur logique.',
                 'answer' => 0,
                 'concept' => 'Simple vs complexe',
                 'explainFr' => 'Pour plusieurs conditions, utilisez && (ET) ou || (OU).',
                 'explainDarija' => 'Pour plusieurs conditions, isti7mal && (ET) wla || (OU).'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'conditions-else',
            'title' => 'L\'instruction else',
            'icon'  => '➕',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le bloc <code>else</code> s\'exécute si la condition <code>if</code> est fausse :</p><pre><code>if (condition) {\n  // code si vrai\n} else {\n  // code si faux\n}</code></pre>',
                 'darija' => '<p>Block <code>else</code> kay3ter b condition if fausse :</p><pre><code>if (condition) {\n  // code si vrai\n} else {\n  // code si faux\n}</code></pre>'],

                ['type' => 'example', 'title' => 'if-else basique',
                 'lang'  => 'javascript',
                 'code'  => 'const note = 14;\nif (note >= 10) {\n  console.log("Passé.");\n} else {\n  console.log("Non passé.");\n}',
                 'explainFr' => 'Note 14 est inférieure à 10 ? Non, donc "Passé." s\'affiche.',
                 'explainDarija' => 'Note 14 b9der 10 ? Lghayr, "Passé." kaytkhed.'],

                ['type' => 'mcq',
                 'question' => 'Que fait le bloc else ?',
                 'options' => ['Toujours s\'exécuter', 'S\'exécuter si if est faux', 'S\'exécuter si if est vrai'],
                 'answer' => 1,
                 'concept' => 'else',
                 'explainFr' => 'else s\'exécute uniquement lorsque la condition if est fausse.',
                 'explainDarija' => 'else kay3ter b9der condition if fausse.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'conditions-elseif',
            'title' => 'L\'instruction else if',
            'icon'  => '➡️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La chaîne <code>else if</code> permet de tester plusieurs conditions séquentiellement. Dès qu\'une condition est vraie, son bloc s\'exécute et le reste est ignoré.</p>',
                 'darija' => '<p>Chaîne <code>else if</code> kayder tester plusieurs conditions séquentiellement. D9der condition s7i7a, kay3ter bloc kay9der kay7et ignorer.'],

                ['type' => 'example', 'title' => 'if-else if-else',
                 'lang'  => 'javascript',
                 'code'  => 'const note = 12;\nif (note >= 16) {\n  console.log("Excellent");\n} else if (note >= 10) {\n  console.log("Passé");\n} else {\n  console.log("Non passé");\n}',
                 'explainFr' => 'Note 12 est >= 10, donc "Passé" s\'affiche. Les conditions supérieures sont ignorées.',
                 'explainDarija' => 'Note 12 >= 10, donc "Passé" kaytkhed. Conditions supérieures ignorer.'],

                ['type' => 'true_false',
                 'question' => 'On peut chaîner nombre illimité de else if.',
                 'answer' => 0,
                 'concept' => 'Limite pratique',
                 'explainFr' => 'Vrai en théorie, mais au-delà de 5-6 conditions, le code devient difficile à lire. Préférez switch ou refactorisez.',
                 'explainDarija' => 'Vrai théorie, men fin Beyond 5-6 conditions, code difficile à lire. Préférez switch wla refactorisez.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'switch-statement',
            'title' => 'L\'instruction switch',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>L\'instruction <code>switch</code> teste une expression contre plusieurs valeurs de cas. Si un cas correspond, son bloc s\'exécute. Utilisez <code>break</code> pour sortir du switch, sinon le code « tombe à travers » (fall-through) vers le cas suivant.</p>',
                 'darija' => '<p>L\'instruction <code>switch</code> teste une expression contre plusieurs valeurs de cas. Si un cas correspond, son bloc s\'exécute. Utilisez <code>break</code> pour sortir du switch, sinon le code « tombe à travers » vers le cas suivant.</p>'],

                ['type' => 'example', 'title' => 'switch basique',
                 'lang'  => 'javascript',
                 'code'  => 'const jour = "lundi";\nswitch (jour) {\n  case \"lundi\":\n    console.log("Début de semaine");\n    break;\n  case \"vendredi\":\n    console.log("Presque weekend");\n    break;\n  default:\n    console.log("Autre jour");\n}',
                 'explainFr' => 'Le cas "lundi" correspond, donc "Début de semaine" s\'affiche. break évite de continuer.',
                 'explainDarija' => 'Cas "lundi" correspond, "Début de semaine" kaytkhed. break évite de continuer.'],

                ['type' => 'example', 'title' => 'Fall-through intentionnel',
                 'lang'  => 'javascript',
                 'code'  => 'const valeur = 2;\nswitch (valeur) {\n  case 1:\n    console.log("Un");\n    case 2:\n    console.log("Deux");\n    break;\n  default:\n    console.log("Autre");\n}',
                 'explainFr' => 'Pas de break après case 1, donc l\'exécution continue vers case 2. Affiche "Deux".',
                 'explainDarija' => 'Pas de break b9der case 1, execution continue vers case 2. Affiche "Deux".'],

                ['type' => 'mcq',
                 'question' => 'Que fait le mot-clé break dans un switch ?',
                 'options' => ['Quitter la boucle', 'Sortir du switch', 'Passer au cas suivant'],
                 'answer' => 1,
                 'concept' => 'break switch',
                 'explainFr' => 'break sort immédiatement du switch et saute les cas restants.',
                 'explainDarija' => 'break kay9der kay9der kay9der kay9der sort immédiatement du switch.'],

            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'test-conditions',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'fill',
                 'question' => 'Pour tester plusieurs conditions, on utilise la structure _____ else if .',
                 'answer' => 'if',
                 'concept' => 'else if',
                 'explainFr' => 'La structure if-else if teste conditions séquentiellement.',
                 'explainDarija' => 'Structure if-else if teste conditions séquentiellement.'],

                ['type' => 'mcq',
                 'question' => 'Quel sera l\'affiche de ce code ?\nconst x = 2;\nswitch (x) {\n  case 1: console.log("Un"); break;\n  case 2: console.log("Deux"); break;\n  default: console.log("Autre");\n}',
                 'options' => 'Un', 'Deux', 'Autre', 'Erreur',
                 'answer' => 1,
                 'concept' => 'switch avec break',
                 'explainFr' => 'Le cas 2 correspond, s\'affiche "Deux".',
                 'explainDarija' => 'Cas 2 correspond, s\'affiche "Deux".'],

                ['type' => 'code_contains',
                 'question' => 'Lequel de ces extraits affiche "Bonjour" ?',
                 'code_a' => 'const cond = true;\nif (cond) console.log("Bonjour");',
                 'code_b' => 'const cond = false;\nif (cond) console.log("Bonjour");',
                 'answer' => 0,
                 'concept' => 'condition vraie',
                 'explainFr' => 'La condition est vraie, s\'affiche "Bonjour".',
                 'explainDarija' => 'Condition vraie, s\'affiche "Bonjour".'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier le break dans un switch',
            'fix'    => 'Ajoutez toujours break après chaque cas, sauf si le fall-through est intentionnel.',
            'fr'     => 'Sans break, le code s\'exécute dans tous les cas suivants jusqu\'au prochain break ou la fin du switch.',
            'darija' => 'Sans break, code kay7et execute f kol cases b9der break wla fin switch.'],
        ],
        [
            'wrong'  => 'Confondre == et === dans les conditions switch',
            'fix'    => 'Utilisez des valeurs strictement typées ou incluez une conversion explicite.',
            'fr'     => 'L\'utilisation de == peut provoquer des correspondances inattendues (ex: "0" == false).',
            'darija' => 'Utilisation de == kayder correspondances inattendues.'],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> propose three structures conditionnelles : if (teste une condition), else if (teste une condition supplémentaire), et switch (teste une expression contre plusieurs cas). Utilisez break pour sortir du switch. Préférez switch lorsqu\'avoir nombreuses conditions sur la même variable.',
        'darija' => '<strong>JavaScript</strong> kay9der trois structures conditionnelles : if (teste condition), else if (teste condition supplémentaire), w switch (teste expression b plusieurs cases). Isti7mal break b9der kay9der kay9der kay9der sort switch. Préférez switch b9der nombreuses conditions f variable m3ah.'],
    ],
];