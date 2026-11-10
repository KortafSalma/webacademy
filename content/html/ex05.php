<?php

declare(strict_types=1);

/**
 * Exercices du chapitre html-ch5 — Listes HTML.
 * Schéma OBLIGATOIRE : 3 niveaux (Débutant, Intermédiaire, Avancé).
 */

return [
    'id'    => 'html-ex5',
    'title' => 'Listes HTML',
    'brief' => 'Identifie et crée des listes HTML correctes.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — identifie le type de liste',
            'lang'  => 'html',
            'instructions' => 'Choisis le type de liste qui utiliser pour afficher une liste de courses à puces :\n\n1. <ul>\n2. <ol>\n3. <div>\n\nÉcris le numéro du bon type (1, 2 ou 3).',
            'instructionsDarija' => 'Kmll type de liste kay9der bach afficher liste courses b punctuation :\n\n1. <ul>\n2. <ol>\n3. <div>\n\nKtib n9mer n correct (1, 2 ou 3).',
            'starter' => '---\n1. <ul>\n2. <ol>\n3. <div>\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => '1'],
            ],
            'hints' => [
                'Les listes à puces utilisent la balise <code><ul></code>.',
                'Les listes numérotées utilisent la balise <code><ol></code>.',
            ],
            'solution' => '1',
            'explainFr' => 'La balise <code><ul></code> crée une liste non ordonnée (à puces).',
            'explainDarija' => 'Balise <code><ul></code> kay9der créer liste non ordonnée (b punctuation).',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — crée une liste ordonnée',
            'lang'  => 'html',
            'instructions' => 'Écrivez le code HTML pour créer une liste ordonnée de 3 étapes de cuisine :\n1. Préchauffer le four.\n2. Mélanger les ingrédients.\n3. Enfourner.',
            'instructionsDarija' => 'Ktib code HTML kay9der créer liste ordonnée b 3 étapes cuisine :\n1. Préchauffer four.\n2. Mélanger ingrédients.\n3. Enfourner.',
            'starter' => '---\n<ol>\n    /* votre code */\n</ol>\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<ol>'],
                ['type' => 'html_contains', 'value' => '1.'],
                ['type' => 'html_contains', 'value' => 'Préchauffer'],
            ],
            'hints' => [
                'Utilise la balise <code><ol></code> pour une liste numérotée.',
                'Chaque élément commence par <code><li>.</code>',
                'Les numéros s\'affichent automatiquement.',
            ],
            'solution' => '<ol>\n    <li>Préchauffer le four.</li>\n    <li>Mélanger les ingrédients.</li>\n    <li>Enfourner.</li>\n</ol>',
            'explainFr' => 'La liste numérote les trois étapes de la recette dans l\'ordre.',
            'explainDarija' => 'Liste numérote les 3 étapes b ordre.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — liste nesting avec menu de navigation',
            'lang'  => 'html',
            'instructions' => 'Crée une section de navigation avec une liste nesting : un élément principal "Accueil" et un sous-élément "Contact" dans une sous-liste. Chaque élément doit avoir un lien href.',
            'instructionsDarija' => 'Ktib section navigation bach liste nesting : élément principal "Accueil" w sous-élément "Contact" f9der sous-liste. Chaque élément kay9der lien href.',
            'starter' => '---\n<nav>\n    <ul>\n        <li><a href="/">Accueil</a>\n        /* votre code */\n    </ul>\n</nav>\n\nVotre réponse :',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<nav>'],
                ['type' => 'html_contains', 'value' => 'ul'],
                ['type' => 'html_contains', 'value' => 'Contact'],
                ['type' => 'html_contains', 'value' => 'href'],
            ],
            'hints' => [
                'Placez la sous-liste à l\'intérieur de l\'élément <code><li></code> "Services".',
                'Chaque élément de sous-liste doit être entouré par <code><li></code> et contenir un lien <code><a>.</code>',
            ],
            'solution' => '<nav>\n    <ul>\n        <li><a href="/">Accueil</a>\n        <li>\n            Services\n            <ul>\n                <li><a href="/contact">Contact</a></li>\n            </ul>\n        </li>\n    </ul>\n</nav>',
            'explainFr' => 'Le menu de navigation comporte un élément "Services" avec un sous-élément "Contact" en liste nesting.',
            'explainDarija' => 'Menu navigation kay9der élément "Services" w sous-élément "Contact" f9der liste nesting.',
        ],
    ],
];