<?php
declare(strict_types=1);
/**
 * PARCOURS JAVASCRIPT — Chapitre 6 : Variables : var, let et const
 * Modèle de qualité pour les 30 chapitres du parcours.
 */
return [
    'id' => 'js-ch6',
    'title' => 'Variables : var, let et const',
    'lessons' => [
        ['id' => 'var-let-const', 'blocks' => [['type' => 'text', 'fr' => 'Variables C++']]]],
    'mistakes' => [
        ['wrong' => 'Utiliser var partout par habitude', 'fix' => 'Privilégier let pour les variables modifiables et const pour les valeurs fixes', 'fr' => 'let et const évitent les effets de bord non désirés liés au hoisting.', 'darija' => 'let w const ma y9derhomch effects de bord b hoisting.'],
        ['wrong' => 'Redéclarer une variable let dans le même scope', 'fix' => 'Utiliser des blocs {} pour isoler les variables', 'fr' => 'Redeclarer let dans le même scope provoque une erreur de syntaxe.', 'darija' => 'Redeclar let f same bloc error syntax.'],
    ],
    'summary' => [
        'fr' => '<strong>var</strong> est function-scoped et hoisté ; <strong>let</strong> et <strong>const</strong> sont block-scoped. Utilisez <code>const</code> par défaut pour les valeurs qui ne changent pas, <code>let</code> pour celles qui changent, et <code>var</code> uniquement si vous avez besoin du hoisting ou de la portée function. Toujours initialiser <code>const</code> au moment de la déclaration.',
        'darija' => '<strong>var</strong> howa function-scoped w hoisted ; <strong>let</strong> w <strong>const</strong> howa block-scoped. Isti7mal <code>const</code> b9der valeur kaytjib, <code>let</code> b9der kaytjib, w <code>var</code> b9der kay9der hoisting w function scope. Initialiser toujour <code>const</code> b moment declaration.',
    ],
];