<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 1 : quiz (10 questions).
 * 5 QCM, 3 vrai/faux, 2 questions pratiques à saisie courte.
 */

return [
    'title' => 'Quiz — Qu\'est-ce que JavaScript ?',
    'questions' => [

        [
            'type' => 'mcq',
            'question' => 'Où le JavaScript d\'une page web s\'exécute-t-il ?',
            'options' => [
                'Dans le moteur JavaScript du navigateur',
                'Dans le processeur graphique uniquement',
                'Sur le serveur, avant l\'envoi de la page',
            ],
            'answer' => 0,
            'concept' => 'Environnement d\'exécution',
            'explainFr' => 'Le navigateur embarque un moteur JavaScript (V8, SpiderMonkey, JavaScriptCore) qui exécute le code sur la machine du visiteur.',
            'explainDarija' => 'Navigateur fih moteur JavaScript (V8, SpiderMonkey, JavaScriptCore) li kaynfed code f PC dyal visiteur.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle balise HTML permet d\'inclure du JavaScript ?',
            'options' => ['<style>', '<script>', '<javascript>'],
            'answer' => 1,
            'concept' => 'Intégration dans la page',
            'explainFr' => 'La balise <code>&lt;script&gt;</code> contient le code ou référence un fichier externe via <code>src</code>.',
            'explainDarija' => 'Balise <code>&lt;script&gt;</code> kat7et code wla kat3ayet 3la fichier externe b <code>src</code>.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel est le rôle principal de JavaScript ?',
            'options' => [
                'Décrire la structure de la page',
                'Définir l\'apparence des éléments',
                'Ajouter du comportement et de la logique',
            ],
            'answer' => 2,
            'concept' => 'Rôle du langage',
            'explainFr' => 'HTML structure, CSS met en forme, JavaScript apporte le comportement : réactions, calculs, modifications du DOM.',
            'explainDarija' => 'HTML kaybni structure, CSS kat3ti apparence, JavaScript kayjib comportement : réactions, calculs, modifications dyal DOM.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Que fait console.log("Salam") ?',
            'options' => [
                'Affiche Salam dans la console de développement',
                'Affiche Salam dans un paragraphe de la page',
                'Crée une alerte bloquante',
            ],
            'answer' => 0,
            'concept' => 'console.log',
            'explainFr' => '<code>console.log</code> écrit dans la console, pas dans la page. Pour modifier la page, on utilise le DOM.',
            'explainDarija' => '<code>console.log</code> kaykteb f console, machi f page. Bach tbedel page, kandiro b DOM.',
        ],
        [
            'type' => 'mcq',
            'question' => 'Quelle affirmation sur const et let est correcte ?',
            'options' => [
                'const interdit la réassignation, let l\'autorise',
                'const et let sont strictement identiques',
                'let interdit la réassignation, const l\'autorise',
            ],
            'answer' => 0,
            'concept' => 'Déclaration de variables',
            'explainFr' => 'Une variable <code>const</code> ne peut pas être réassignée après sa déclaration. <code>let</code> peut recevoir une nouvelle valeur.',
            'explainDarija' => 'Variable <code>const</code> ma tqderch tbedelha valeur mn ba3d déclaration. <code>let</code> katqder takhod valeur jdida.',
        ],
        [
            'type' => 'tf',
            'question' => 'JavaScript et Java sont le même langage.',
            'answer' => 1,
            'concept' => 'JavaScript ≠ Java',
            'explainFr' => 'Faux : ce sont deux langages distincts, avec des syntaxes, des usages et des écosystèmes différents.',
            'explainDarija' => 'Ghalat : jouj lougha mkhtalfin, b syntaxe, usage w écosystème mkhtalfin.',
        ],
        [
            'type' => 'tf',
            'question' => 'Le résultat de console.log est visible directement dans la page par le visiteur.',
            'answer' => 1,
            'concept' => 'Console de développement',
            'explainFr' => 'Faux : la console est un outil de développement. Le visiteur ne voit que les modifications apportées au DOM.',
            'explainDarija' => 'Ghalat : console outil dyal développement. Visiteur kaychof ghir modifications li kayt3mlo f DOM.',
        ],
        [
            'type' => 'tf',
            'question' => 'Dans un navigateur, JavaScript peut accéder au DOM de la page.',
            'answer' => 0,
            'concept' => 'DOM',
            'explainFr' => 'Vrai : le DOM est l\'arbre des éléments HTML. JavaScript le lit et le modifie via <code>document</code>.',
            'explainDarija' => 'S7i7 : DOM howa arbre dyal éléments HTML. JavaScript kayqrah w kaybedlo via <code>document</code>.',
        ],
        [
            'type' => 'fill',
            'question' => 'Pratique — Qu\'affiche <code>console.log(2 + 3 * 4);</code> ? (réponse numérique)',
            'answer' => '14',
            'concept' => 'Priorité des opérateurs',
            'explainFr' => 'La multiplication est prioritaire : 3 × 4 = 12, puis 2 + 12 = 14.',
            'explainDarija' => 'Multiplication kat9bel : 3 × 4 = 12, mn ba3d 2 + 12 = 14.',
        ],
        [
            'type' => 'fill',
            'question' => 'Pratique — Quel mot-clé déclare une constante en JavaScript ? (un seul mot)',
            'answer' => 'const',
            'concept' => 'Constante',
            'explainFr' => '<code>const</code> déclare une liaison qui ne peut plus être réassignée. La valeur elle-même peut rester mutable si c\'est un objet.',
            'explainDarija' => '<code>const</code> kat3len liaison li ma tqderch tbedelha. Valeur b rasha tqder tbqa mutable ila kanet objet.',
        ],
    ],
];
