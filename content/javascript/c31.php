<?php
declare(strict_types=1);

return [
    'id' => 'js-ch31',
    'title' => 'Expressions régulières : rechercher et valider',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Lire un motif.',
        'Comprendre : Valider un slug.',
        'Comprendre : Extraire plusieurs nombres.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Lire un motif',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Une expression régulière décrit un motif. <code>^</code> vise le début, <code>$</code> la fin, <code>[a-z]</code> une lettre minuscule et <code>+</code> au moins une répétition. Sans ancres, test peut accepter seulement une partie de la chaîne. Un motif simple est préférable à une expression difficile à maintenir.</p>',
                    'darija' => '<p>Regex katwsef motif. ^ lbidaya, $ nihaya, [a-z] lettre sghira w + wa7ed wla kter. Bla ancres, test y9der yl9a ghir partie men texte. Khlli motif sahl bach t9der tsayno.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Lire un motif',
                    'lang' => 'javascript',
                    'code' => 'console.log(/^[a-z]+$/.test("salma"));
console.log(/^[a-z]+$/.test("salma7"));',
                    'output' => 'true
false',
                    'explainFr' => 'Une expression régulière décrit un motif. <code>^</code> vise le début, <code>$</code> la fin, <code>[a-z]</code> une lettre minuscule et <code>+</code> au moins une répétition. Sans ancres, test peut accepter seulement une partie de la chaîne. Un motif simple est préférable à une expression difficile à maintenir.',
                    'explainDarija' => 'Regex katwsef motif. ^ lbidaya, $ nihaya, [a-z] lettre sghira w + wa7ed wla kter. Bla ancres, test y9der yl9a ghir partie men texte. Khlli motif sahl bach t9der tsayno.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Valider un slug',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Un slug peut contenir lettres minuscules, chiffres et tirets entre groupes. <code>(?:...)</code> regroupe sans capture et <code>*</code> autorise zéro ou plusieurs groupes. Les ancres empêchent les espaces et tirets en début ou fin. Un format valide ne prouve ni l’existence d’un identifiant ni son autorisation.</p>',
                    'darija' => '<p>Slug fih lettres sghar, chiffres w tiret bin groupes. (?:...) groupe bla capture w * zéro wla kter. Ancres kayrefdo espaces w tiret f les extrémités. Format s7i7 ma kay3nich identifiant kayn wla autorisé.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Valider un slug',
                    'lang' => 'javascript',
                    'code' => 'function estSlug(texte) {
  return /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(texte);
}
console.log(estSlug("cours-js"));
console.log(estSlug("Cours JS"));',
                    'output' => 'true
false',
                    'explainFr' => 'Un slug peut contenir lettres minuscules, chiffres et tirets entre groupes. <code>(?:...)</code> regroupe sans capture et <code>*</code> autorise zéro ou plusieurs groupes. Les ancres empêchent les espaces et tirets en début ou fin. Un format valide ne prouve ni l’existence d’un identifiant ni son autorisation.',
                    'explainDarija' => 'Slug fih lettres sghar, chiffres w tiret bin groupes. (?:...) groupe bla capture w * zéro wla kter. Ancres kayrefdo espaces w tiret f les extrémités. Format s7i7 ma kay3nich identifiant kayn wla autorisé.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Extraire plusieurs nombres',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Le drapeau <code>g</code> cherche toutes les correspondances. <code>match</code> renvoie null si rien ne correspond : <code>?? []</code> fournit alors un tableau vide. Attention : réutiliser un même RegExp global avec test modifie son lastIndex ; ses appels successifs ne sont pas indépendants.</p>',
                    'darija' => '<p>g kay9elleb 3la ga3 correspondances. Ila ma l9a walo, match katrje3 null; ?? [] kat3ti tableau khawi. RegExp global m3a test kaybeddel lastIndex donc appels maشي indépendants.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Extraire plusieurs nombres',
                    'lang' => 'javascript',
                    'code' => 'const texte = "PHP 18, SQL 16";
const notes = (texte.match(/\\d+/g) ?? []).map(Number);
console.log(JSON.stringify(notes));',
                    'output' => '[18,16]',
                    'explainFr' => 'Le drapeau <code>g</code> cherche toutes les correspondances. <code>match</code> renvoie null si rien ne correspond : <code>?? []</code> fournit alors un tableau vide. Attention : réutiliser un même RegExp global avec test modifie son lastIndex ; ses appels successifs ne sont pas indépendants.',
                    'explainDarija' => 'g kay9elleb 3la ga3 correspondances. Ila ma l9a walo, match katrje3 null; ?? [] kat3ti tableau khawi. RegExp global m3a test kaybeddel lastIndex donc appels maشي indépendants.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Valider seulement une sous-chaîne',
            'fix' => 'Ajouter ^ et $ si le format doit couvrir toute la valeur.',
            'fr' => 'Ajouter ^ et $ si le format doit couvrir toute la valeur.',
            'darija' => 'Bla ancres, partie sghira t9der tkoun s7i7a w texte kamel la.'
        ]
    ],
    'summary' => [
        'fr' => 'Une expression régulière décrit un motif. <code>^</code> vise le début, <code>$</code> la fin, <code>[a-z]</code> une lettre minuscule et <code>+</code> au moins une répétition. Sans ancres, test peut accepter seulement une partie de la chaîne. Un motif simple est préférable à une expression difficile à maintenir. Un slug peut contenir lettres minuscules, chiffres et tirets entre groupes. <code>(?:...)</code> regroupe sans capture et <code>*</code> autorise zéro ou plusieurs groupes. Les ancres empêchent les espaces et tirets en début ou fin. Un format valide ne prouve ni l’existence d’un identifiant ni son autorisation. Le drapeau <code>g</code> cherche toutes les correspondances. <code>match</code> renvoie null si rien ne correspond : <code>?? []</code> fournit alors un tableau vide. Attention : réutiliser un même RegExp global avec test modifie son lastIndex ; ses appels successifs ne sont pas indépendants.',
        'darija' => 'Regex katwsef motif. ^ lbidaya, $ nihaya, [a-z] lettre sghira w + wa7ed wla kter. Bla ancres, test y9der yl9a ghir partie men texte. Khlli motif sahl bach t9der tsayno. Slug fih lettres sghar, chiffres w tiret bin groupes. (?:...) groupe bla capture w * zéro wla kter. Ancres kayrefdo espaces w tiret f les extrémités. Format s7i7 ma kay3nich identifiant kayn wla autorisé. g kay9elleb 3la ga3 correspondances. Ila ma l9a walo, match katrje3 null; ?? [] kat3ti tableau khawi. RegExp global m3a test kaybeddel lastIndex donc appels maشي indépendants.'
    ]
];
