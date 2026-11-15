<?php
declare(strict_types=1);

return [
    'id' => 'js-ch32',
    'title' => 'Tester des fonctions et leurs cas limites',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Préparer, agir et vérifier.',
        'Comprendre : Tester le tableau vide.',
        'Comprendre : Exceptions et décimaux.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Préparer, agir et vérifier',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Un test prépare une entrée connue, appelle une fonction puis compare le résultat à une valeur attendue indépendante. Une fonction pure facilite les tests : pas de réseau, d’horloge ou de stockage à préparer. Un test utile échoue si le comportement demandé devient incorrect.</p>',
                    'darija' => '<p>Test kaywejjed entrée ma3roufa, kay3ayet fonction w kay9aren résultat m3a attendu. Fonction pure bla réseau wla stockage sahla f test. Test khaso yti7 ila comportement wlla ghalet.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Préparer, agir et vérifier',
                    'lang' => 'javascript',
                    'code' => 'function double(n) { return n * 2; }
const resultat = double(3);
if (resultat !== 6) throw new Error("Résultat incorrect");
console.log("Test réussi");',
                    'output' => 'Test réussi',
                    'explainFr' => 'Un test prépare une entrée connue, appelle une fonction puis compare le résultat à une valeur attendue indépendante. Une fonction pure facilite les tests : pas de réseau, d’horloge ou de stockage à préparer. Un test utile échoue si le comportement demandé devient incorrect.',
                    'explainDarija' => 'Test kaywejjed entrée ma3roufa, kay3ayet fonction w kay9aren résultat m3a attendu. Fonction pure bla réseau wla stockage sahla f test. Test khaso yti7 ila comportement wlla ghalet.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Tester le tableau vide',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Le tableau vide est un cas limite. L’accumulateur initial 0 donne un résultat défini à reduce même sans élément ; sans valeur initiale, reduce sur un tableau vide lève une erreur. Essayez aussi un seul élément et plusieurs éléments : un exemple réussi ne prouve pas tous les cas.</p>',
                    'darija' => '<p>Tableau khawi cas limite mohim. Valeur initiale 0 katkhlli reduce ykhdem 7ta bla éléments. Bla valeur initiale kaydir erreur. Jرب élément wa7ed w plusieurs éléments.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Tester le tableau vide',
                    'lang' => 'javascript',
                    'code' => 'function total(prix) {
  return prix.reduce((somme, valeur) => somme + valeur, 0);
}
console.log(total([10, 15]));
console.log(total([]));',
                    'output' => '25
0',
                    'explainFr' => 'Le tableau vide est un cas limite. L’accumulateur initial 0 donne un résultat défini à reduce même sans élément ; sans valeur initiale, reduce sur un tableau vide lève une erreur. Essayez aussi un seul élément et plusieurs éléments : un exemple réussi ne prouve pas tous les cas.',
                    'explainDarija' => 'Tableau khawi cas limite mohim. Valeur initiale 0 katkhlli reduce ykhdem 7ta bla éléments. Bla valeur initiale kaydir erreur. Jرب élément wa7ed w plusieurs éléments.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Exceptions et décimaux',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Une entrée interdite doit produire une erreur prévue. Vérifiez le type d’exception, pas seulement qu’une erreur quelconque arrive. Comparez les décimaux calculés avec une tolérance adaptée, par exemple <code>Math.abs(obtenu - attendu) &lt; 1e-9</code>, plutôt qu’une égalité exacte systématique.</p>',
                    'darija' => '<p>Entrée mam9boulach khas erreur ma3roufa. T2ekked men type dyal erreur. F décimaux, qaren b tolérance sghira b Math.abs bach ma tghletch b précision.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Exceptions et décimaux',
                    'lang' => 'javascript',
                    'code' => 'function remise(prix, taux) {
  if (!Number.isFinite(prix) || prix < 0 ||
      !Number.isFinite(taux) || taux < 0 || taux > 1) {
    throw new RangeError("Valeur invalide");
  }
  return prix * (1 - taux);
}
console.log(remise(100, 0.2));',
                    'output' => '80',
                    'explainFr' => 'Une entrée interdite doit produire une erreur prévue. Vérifiez le type d’exception, pas seulement qu’une erreur quelconque arrive. Comparez les décimaux calculés avec une tolérance adaptée, par exemple <code>Math.abs(obtenu - attendu) &lt; 1e-9</code>, plutôt qu’une égalité exacte systématique.',
                    'explainDarija' => 'Entrée mam9boulach khas erreur ma3roufa. T2ekked men type dyal erreur. F décimaux, qaren b tolérance sghira b Math.abs bach ma tghletch b précision.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Tester uniquement les entrées habituelles',
            'fix' => 'Ajouter le cas vide, les bornes et une entrée invalide.',
            'fr' => 'Ajouter le cas vide, les bornes et une entrée invalide.',
            'darija' => 'Zid cas khawi, limites w entrée ghalta.'
        ]
    ],
    'summary' => [
        'fr' => 'Un test prépare une entrée connue, appelle une fonction puis compare le résultat à une valeur attendue indépendante. Une fonction pure facilite les tests : pas de réseau, d’horloge ou de stockage à préparer. Un test utile échoue si le comportement demandé devient incorrect. Le tableau vide est un cas limite. L’accumulateur initial 0 donne un résultat défini à reduce même sans élément ; sans valeur initiale, reduce sur un tableau vide lève une erreur. Essayez aussi un seul élément et plusieurs éléments : un exemple réussi ne prouve pas tous les cas. Une entrée interdite doit produire une erreur prévue. Vérifiez le type d’exception, pas seulement qu’une erreur quelconque arrive. Comparez les décimaux calculés avec une tolérance adaptée, par exemple <code>Math.abs(obtenu - attendu) &lt; 1e-9</code>, plutôt qu’une égalité exacte systématique.',
        'darija' => 'Test kaywejjed entrée ma3roufa, kay3ayet fonction w kay9aren résultat m3a attendu. Fonction pure bla réseau wla stockage sahla f test. Test khaso yti7 ila comportement wlla ghalet. Tableau khawi cas limite mohim. Valeur initiale 0 katkhlli reduce ykhdem 7ta bla éléments. Bla valeur initiale kaydir erreur. Jرب élément wa7ed w plusieurs éléments. Entrée mam9boulach khas erreur ma3roufa. T2ekked men type dyal erreur. F décimaux, qaren b tolérance sghira b Math.abs bach ma tghletch b précision.'
    ]
];
