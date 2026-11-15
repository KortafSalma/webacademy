<?php
declare(strict_types=1);

return [
    'id' => 'js-ex31',
    'title' => 'Expressions régulières : rechercher et valider',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Écrivez estSlug(texte) : accepter cours-js, refuser Cours JS, -cours et cours-.',
            'lang' => 'javascript',
            'instructions' => '<p>Écrivez estSlug(texte) : accepter cours-js, refuser Cours JS, -cours et cours-.</p>',
            'instructionsDarija' => '<p>Kteb estSlug: qbel cours-js w rfed espaces, majuscules w tiret f les extrémités.</p>',
            'starter' => '// Votre solution
',
            'tests' => [
                [
                    'type' => 'js_expr',
                    'value' => 'estSlug("cours-js") && !estSlug("Cours JS") && !estSlug("-cours") && !estSlug("cours-")'
                ]
            ],
            'hints' => [
                'Un slug peut contenir lettres minuscules, chiffres et tirets entre groupes. <code>(?:...)</code> regroupe sans capture et <code>*</code> autorise zéro ou plusieurs groupes. Les ancres empêchent les espaces et tirets en début ou fin. Un format valide ne prouve ni l’existence d’un identifiant ni son autorisation.'
            ],
            'solution' => 'function estSlug(texte) {
  return /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(texte);
}
console.log(estSlug("cours-js"));
console.log(estSlug("Cours JS"));',
            'explainFr' => 'Résultat attendu : true puis false. Un slug peut contenir lettres minuscules, chiffres et tirets entre groupes. <code>(?:...)</code> regroupe sans capture et <code>*</code> autorise zéro ou plusieurs groupes. Les ancres empêchent les espaces et tirets en début ou fin. Un format valide ne prouve ni l’existence d’un identifiant ni son autorisation.',
            'explainDarija' => 'Kteb estSlug: qbel cours-js w rfed espaces, majuscules w tiret f les extrémités.'
        ],
        [
            'level' => 2,
            'title' => 'Extrayez les nombres de PHP 18, SQL 16 dans notes et affichez le tableau JSON.',
            'lang' => 'javascript',
            'instructions' => '<p>Extrayez les nombres de PHP 18, SQL 16 dans notes et affichez le tableau JSON.</p>',
            'instructionsDarija' => '<p>Khrej nombres men texte f notes w 3red JSON.</p>',
            'starter' => '// Votre solution
',
            'tests' => [
                [
                    'type' => 'js_expr',
                    'value' => 'JSON.stringify(notes) === "[18,16]"'
                ]
            ],
            'hints' => [
                'Le drapeau <code>g</code> cherche toutes les correspondances. <code>match</code> renvoie null si rien ne correspond : <code>?? []</code> fournit alors un tableau vide. Attention : réutiliser un même RegExp global avec test modifie son lastIndex ; ses appels successifs ne sont pas indépendants.'
            ],
            'solution' => 'const texte = "PHP 18, SQL 16";
const notes = (texte.match(/\\d+/g) ?? []).map(Number);
console.log(JSON.stringify(notes));',
            'explainFr' => 'Résultat attendu : [18,16]. Le drapeau <code>g</code> cherche toutes les correspondances. <code>match</code> renvoie null si rien ne correspond : <code>?? []</code> fournit alors un tableau vide. Attention : réutiliser un même RegExp global avec test modifie son lastIndex ; ses appels successifs ne sont pas indépendants.',
            'explainDarija' => 'Khrej nombres men texte f notes w 3red JSON.'
        ]
    ]
];
