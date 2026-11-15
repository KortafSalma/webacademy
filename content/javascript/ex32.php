<?php
declare(strict_types=1);

return [
    'id' => 'js-ex32',
    'title' => 'Tester des fonctions et leurs cas limites',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Écrivez total(prix) : total([10,15]) = 25, total([]) = 0 et total([7]) = 7.',
            'lang' => 'javascript',
            'instructions' => '<p>Écrivez total(prix) : total([10,15]) = 25, total([]) = 0 et total([7]) = 7.</p>',
            'instructionsDarija' => '<p>Kteb total w jرب tableau normal, khawi w élément wa7ed.</p>',
            'starter' => '// Votre solution
',
            'tests' => [
                [
                    'type' => 'js_expr',
                    'value' => 'total([10,15]) === 25 && total([]) === 0 && total([7]) === 7'
                ]
            ],
            'hints' => [
                'Le tableau vide est un cas limite. L’accumulateur initial 0 donne un résultat défini à reduce même sans élément ; sans valeur initiale, reduce sur un tableau vide lève une erreur. Essayez aussi un seul élément et plusieurs éléments : un exemple réussi ne prouve pas tous les cas.'
            ],
            'solution' => 'function total(prix) {
  return prix.reduce((somme, valeur) => somme + valeur, 0);
}
console.log(total([10, 15]));
console.log(total([]));',
            'explainFr' => 'Résultat attendu : 25 puis 0. Le tableau vide est un cas limite. L’accumulateur initial 0 donne un résultat défini à reduce même sans élément ; sans valeur initiale, reduce sur un tableau vide lève une erreur. Essayez aussi un seul élément et plusieurs éléments : un exemple réussi ne prouve pas tous les cas.',
            'explainDarija' => 'Kteb total w jرب tableau normal, khawi w élément wa7ed.'
        ],
        [
            'level' => 2,
            'title' => 'Écrivez remise(prix,taux) : refuser les valeurs non finies, prix négatifs et taux hors de [0,1] avec RangeError.',
            'lang' => 'javascript',
            'instructions' => '<p>Écrivez remise(prix,taux) : refuser les valeurs non finies, prix négatifs et taux hors de [0,1] avec RangeError.</p>',
            'instructionsDarija' => '<p>Kteb remise w rfed valeurs invalides b RangeError.</p>',
            'starter' => '// Votre solution
',
            'tests' => [
                [
                    'type' => 'js_expr',
                    'value' => 'Math.abs(remise(100,0.2) - 80) < 1e-9'
                ],
                [
                    'type' => 'js_expr',
                    'value' => '(() => { try { remise(100, 2); return false; } catch(e) { return e instanceof RangeError; } })()'
                ]
            ],
            'hints' => [
                'Une entrée interdite doit produire une erreur prévue. Vérifiez le type d’exception, pas seulement qu’une erreur quelconque arrive. Comparez les décimaux calculés avec une tolérance adaptée, par exemple <code>Math.abs(obtenu - attendu) &lt; 1e-9</code>, plutôt qu’une égalité exacte systématique.'
            ],
            'solution' => 'function remise(prix, taux) {
  if (!Number.isFinite(prix) || prix < 0 ||
      !Number.isFinite(taux) || taux < 0 || taux > 1) {
    throw new RangeError("Valeur invalide");
  }
  return prix * (1 - taux);
}
console.log(remise(100, 0.2));',
            'explainFr' => 'Résultat attendu : 80. Une entrée interdite doit produire une erreur prévue. Vérifiez le type d’exception, pas seulement qu’une erreur quelconque arrive. Comparez les décimaux calculés avec une tolérance adaptée, par exemple <code>Math.abs(obtenu - attendu) &lt; 1e-9</code>, plutôt qu’une égalité exacte systématique.',
            'explainDarija' => 'Kteb remise w rfed valeurs invalides b RangeError.'
        ]
    ]
];
