<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch23 — Curseurs : implicites et explicites.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex23',
    'title' => 'Exercices — Curseurs : implicites et explicites',
    'brief' => 'Parcourir les lignes d\'une requête SELECT une à une en PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => '%ROWCOUNT et %FOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Après une instruction UPDATE, combien de lignes ont été affectées ?</p>',
            'instructionsDarija' => '<p>Après instruction UPDATE kay vérifier combien lignes affectées ?</p>',
            'starter' => 'IF SQL%ROWCOUNT = 1 THEN ... END IF',
            'hints' => [
                'SQL%ROWCOUNT retourne le nombre de lignes affectées par la dernière instruction.',
                '= 1 signifie qu\'une seule ligne a été mise à jour.',
            ],
            'solution' => 'IF SQL%ROWCOUNT = 1 THEN ... END IF',
            'explainFr' => 'SQL%ROWCOUNT indique le nombre de lignes affectées par la dernière instruction DML.',
            'explainDarija' => 'SQL%ROWCOUNT nombre lignes affectées dernière instruction DML.',
        ],

        [
            'level' => 2,
            'title' => '%NOTFOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment savoir si une instruction SELECT INTO n\'a retourné aucune ligne ?</p>',
            'instructionsDarija' => '<p>Kay instruction SELECT INTO retourné aucune ligne ?</p>',
            'starter' => 'IF SQL%NOTFOUND THEN ... END IF',
            'hints' => [
                'SQL%NOTFOUND est VRAI si la dernière instruction n\'a affecté aucune ligne.',
                'Utilisez-le pour tester le résultat de SELECT INTO.',
            ],
            'solution' => 'IF SQL%NOTFOUND THEN ... END IF',
            'explainFr' => 'SQL%NOTFOUND est VRAI si la dernière instruction (SELECT INTO par exemple) n\'a affecté aucune ligne.',
            'explainDarija' => 'SQL%NOTFOUND VRAI dernière instruction affecté aucune ligne.',
        ],

        [
            'level' => 3,
            'title' => 'Curseur implicite UPDATE',
            'lang'  => 'oracle',
            'instructions' => '<p>Après un UPDATE clients SET email = \\'test\\' WHERE id = 5, que vérifie-t-on avec SQL%ROWCOUNT ?</p>',
            'instructionsDarija' => '<p>Après UPDATE clients SET email WHERE id 5 kay vérifier SQL%ROWCOUNT ?</p>',
            'starter' => 'SQL%ROWCOUNT indique le nombre de lignes mises à jour',
            'hints' => [
                'SQL%ROWCOUNT compte les lignes affectées par l\'UPDATE.',
                'Si = 1, une seule ligne a été modifiée.',
            ],
            'solution' => 'SQL%ROWCOUNT indique le nombre de lignes mises à jour',
            'explainFr' => 'Le compteur indique combien de lignes ont été modifiées par la mise à jour.',
            'explainDarija' => 'Compteur indique lignes modifiées mise à jour.',
        ],

        [
            'level' => 4,
            'title' => 'Curseur implicite INSERT',
            'lang'  => 'oracle',
            'instructions' => '<p>Après un INSERT dans la table \\"employés\\", que vaut SQL%ROWCOUNT si l\\'insertion a réussi ?</p>',
            'instructionsDarija' => '<p>Après INSERT table \\"employés\\" kay vaut SQL%ROWCOUNT ?</p>',
            'starter' => 'SQL%ROWCOUNT = 1 (une ligne insérée)',
            'hints' => [
                'Pour INSERT, SQL%ROWCOUNT vaut 1 si l\'insertion a réussi.',
                'Si 0, l\'insertion a échoué (souvent à cause d\'une contrainte).',
            ],
            'solution' => 'SQL%ROWCOUNT = 1 (une ligne insérée)',
            'explainFr' => 'Pour une insertion réussie, le compteur vaut 1.',
            'explainDarija' => 'INSERT réussi ROWCOUNT = 1.',
        ],

        [
            'level' => 5,
            'title' => '%ISOPEN',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment vérifier qu\'un curseur implicite est ouvert ?</p>',
            'instructionsDarija' => '<p>Kay vérifier curseur implicite ouvert ?</p>',
            'starter' => 'SQL%ISOPEN',
            'hints' => [
                'SQL%ISOPEN est VRAI si le curseur implicite est ouvert.',
                'Bien que généralement TRUE après une instruction DML, il peut être utilisé pour vérification.',
            ],
            'solution' => 'SQL%ISOPEN',
            'explainFr' => 'SQL%ISOPEN retourne VRAI si le curseur implicite est ouvert.',
            'explainDarija' => 'SQL%ISOPEN VRAI curseur implicite ouvert.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];