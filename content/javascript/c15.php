<?php
declare(strict_types=1);
/**
 * PARCOURS JAVASCRIPT — Chapitre 15 : Portée, hoisting et contexte d'exécution
 * Modèle de qualité pour les 30 chapitres du parcours.
 */
return [
    'id' => 'js-ch15',
    'title' => 'Portée, hoisting et contexte d\'exécution',
    'lessons' => [
        ['id' => 'portee-globale-locale', 'blocks' => [['type' => 'text', 'fr' => 'Portée des variables']]],
        ['id' => 'hoisting-detail', 'blocks' => [['type' => 'text', 'fr' => 'Hoisting en détail']]],
        ['id' => 'execution-context', 'blocks' => [['type' => 'text', 'fr' => 'Contexte d\'exécution']]],
        ['id' => 'test-portée', 'blocks' => [['type' => 'text', 'fr' => 'Vérifier vos connaissances']]],
    ],
    'mistakes' => [
        [
            'wrong' => 'S\'attendre à pouvoir utiliser let avant sa déclaration',
            'fix' => 'Assurez-vous que la déclaration apparaît avant toute utilisation dans le code lu top-down.',
            'fr' => 'La zone morte s\'applique à let et const, pas à var.',
            'darija' => 'TDZ s\'applique let w const, pas var.',
        ],
        [
            'wrong' => 'Utiliser var dans les boucles for sans comprendre le hoisting',
            'fix' => 'Préférez let pour les variables de boucle afin d\'éviter les problèmes de portée.',
            'fr' => 'var déclarée dans une boucle for est accessible après la boucle (problème well-known).',
            'darija' => 'var boucle for accessible après boucle (problème well-known).',
        ],
    ],
    'summary' => [
        'fr' => 'JavaScript distingue trois portées : globale, locale (function) et de bloc (let/const). Le hoisting remonte les déclarations : var et function entières, let/const seulement la déclaration (zone morte TDZ). Le contexte d\'exécution gère la portée, les arguments et this via la pile d\'appel.',
        'darija' => 'JavaScript trois portées : globale, locale function, bloc let/const. Hoisting : var w function entières, let/const seulement déclaration (TDZ). Contexte execution gère portée arguments this via pile appel.',
    ],
];