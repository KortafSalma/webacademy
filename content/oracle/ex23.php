<?php
declare(strict_types=1);

/**
 * Exercices du chapitre oracle-ch23 — Curseurs : implicites et explicites.
 * 5 niveaux progressifs en mode statique.
 */

return [
    'id'    => 'oracle-ex23',
    'title' => 'Exercices — Curseurs : implicites et explicites',
    'brief' => 'Parcourir les lignes dune requete SELECT une par une en PL/SQL.',
    'static' => true,

    'levels' => [

        [
            'level' => 1,
            'title' => '%ROWCOUNT et %FOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Apres une instruction UPDATE, combien de lignes ont ete affectes ?</p>',
            'instructionsDarija' => '<p>Apres instruction UPDATE kay verifier combien lignes affectes ?</p>',
            'starter' => 'IF SQL%ROWCOUNT = 1 THEN ... END IF',
            'hints' => [
                'SQL%ROWCOUNT retourne le nombre de lignes affectees par la derniere instruction.',
                '= 1 signifie quune seule ligne a ete mise a jour.',
            ],
            'solution' => 'IF SQL%ROWCOUNT = 1 THEN ... END IF',
            'explainFr' => 'SQL%ROWCOUNT indique le nombre de lignes affectees par la derniere instruction DML.',
            'explainDarija' => 'SQL%ROWCOUNT nombre lignes affectees derniere instruction DML.',
        ],

        [
            'level' => 2,
            'title' => '%NOTFOUND',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment savoir si une instruction SELECT INTO n a retourne aucune ligne ?</p>',
            'instructionsDarija' => '<p>Kay instruction SELECT INTO retourne aucune ligne ?</p>',
            'starter' => 'IF SQL%NOTFOUND THEN ... END IF',
            'hints' => [
                'SQL%NOTFOUND est VRAI si la derniere instruction na affecte aucune ligne.',
                'Utilisez-le pour tester le resultat de SELECT INTO.',
            ],
            'solution' => 'IF SQL%NOTFOUND THEN ... END IF',
            'explainFr' => 'SQL%NOTFOUND est VRAI si la derniere instruction (SELECT INTO par exemple) na affecte aucune ligne.',
            'explainDarija' => 'SQL%NOTFOUND VRAI derniere instruction affecte aucune ligne.',
        ],

        [
            'level' => 3,
            'title' => 'Curseur implicite UPDATE',
            'lang'  => 'oracle',
            'instructions' => '<p>Apres un UPDATE clients SET email WHERE id 5 kay verifier SQL%ROWCOUNT ?</p>',
            'instructionsDarija' => '<p>Apres UPDATE clients SET email WHERE id 5 kay verifier SQL%ROWCOUNT ?</p>',
            'starter' => 'SQL%ROWCOUNT indique le nombre de lignes mises a jour',
            'hints' => [
                'SQL%ROWCOUNT compte les lignes affectees par l UPDATE.',
                'Si = 1, une seule ligne a ete modifiee.',
            ],
            'solution' => 'SQL%ROWCOUNT indique le nombre de lignes mises a jour',
            'explainFr' => 'Le compteur indique combien de lignes ont ete modifiees par la mise a jour.',
            'explainDarija' => 'Compteur indicate lignes modifiees mise a jour.',
        ],

        [
            'level' => 4,
            'title' => 'Curseur implicite INSERT',
            'lang'  => 'oracle',
            'instructions' => '<p>Apres un INSERT dans la table employes, que vaut SQL%ROWCOUNT si l insertion a reussi ?</p>',
            'instructionsDarija' => '<p>Apres INSERT table employes kay vaut SQL%ROWCOUNT ?</p>',
            'starter' => 'SQL%ROWCOUNT = 1 (une ligne inseree)',
            'hints' => [
                'Pour INSERT, SQL%ROWCOUNT vaut 1 si l insertion a reussi.',
                'Si 0, l insertion a echoue (souvent cause d une contrainte).',
            ],
            'solution' => 'SQL%ROWCOUNT = 1 (une ligne inseree)',
            'explainFr' => 'Pour une insertion reussie, le compteur vaut 1.',
            'explainDarija' => 'INSERT reussie ROWCOUNT = 1.',
        ],

        [
            'level' => 5,
            'title' => '%ISOPEN',
            'lang'  => 'oracle',
            'instructions' => '<p>Comment verifier qu un curseur implicite est ouvert ?</p>',
            'instructionsDarija' => '<p>Kay verifier curseur implicite ouvert ?</p>',
            'starter' => 'SQL%ISOPEN',
            'hints' => [
                'SQL%ISOPEN est VRAI si le curseur implicite est ouverte.',
                'Bien que gnralement TRUE aprs une instruction DML, il peut etre utilise pour verification.',
            ],
            'solution' => 'SQL%ISOPEN',
            'explainFr' => 'SQL%ISOPEN retourne VRAI si le curseur implicite est ouverte.',
            'explainDarija' => 'SQL%ISOPEN VRAI curseur implicite ouverte.',
        ],

    ],

    'dataset' => 'oracle',
    'dialect' => 'static',
];