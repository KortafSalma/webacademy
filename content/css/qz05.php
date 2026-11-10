<?php

declare(strict_types=1);

/**
 * Quiz du chapitre css-ch5.
 * Schéma des questions :
 *  - type 'mcq','multi','tf','fill','predict','find-error','complete','sql'
 *  - 'question' : énoncé
 *  - 'concept' : libellé court du point du cours
 *  - 'explainFr', 'explainDarija' : obligatoires
 */

return [
    'title' => 'Quiz — Typographie',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'La propriété font-size peut être exprimée en pixels, en em ou en rem, mais pas en pourcentage.',
            'answer'  => 0,
            'concept' => 'Unités de taille de police',
            'explainFr' => 'Faux : La propriété font-size peut être exprimée en pixels (px), en em, en rem, mais aussi en pourcentages (%). Toutes ces unités sont valides.',
            'explainDarija' => 'Ghalta : font-size kay9der px, em, rem w % . Kol units valide. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces valeurs de font-weight est le plus épaisse ?',
            'options' => ['400', '700', '100', '200'],
            'answer'  => 1,
            'concept' => 'font-weight',
            'explainFr' => 'La valeur 700 correspond au gras (bold), tandis que 100 est la finesse (ultra-light) et 400 est le poids normal.',
            'explainDarija' => 'Valeur 700 howa bold, 100 finesse w 400 poids normal. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'La propriété text-align accepte les valeurs suivantes (sauf une) :',
            'options' => ['left', 'center', 'justify', 'repeat'],
            'answer'  => 3,
            'concept' => 'text-align',
            'explainFr' => 'La valeur <code>repeat</code> n\'est pas une valeur valide pour text-align. Les valeurs valides sont left, center, right et justify.',
            'explainDarija' => '<code>repeat</code> ma kayach value valide text-align. Valides : left center right justify. ',
        ],
        [
            'type'    => 'fill',
            'question'=> 'La propriété qui définit la couleur du texte s\'écrit <code>color</code> suivie d\'une valeur en <code>#</code> suivie de six caractères hexadécimaux : ______',
            'expected'=> '#2c3e50',
            'concept' => 'Couleur de texte',
            'explainFr' => 'La propriété color accepte les noms de couleurs, les valeurs HEX (#RRGGBB), les valeurs RGB ou RGBA. Le #2c3e50 correspond à une couleur bleue grisâtre.',
            'explainDarija' => 'Propriété color accepte noms couleurs w valeurs HEX #RRGGBB. #2c3e50 color bleu grisâtre. ',
        ],
        [
            'type'    => 'multi',
            'question'=> 'Choisissez les propriétés CSS de typographie parmi les suivantes :',
            'options' => ['font-size', 'margin', 'border', 'line-height', 'padding'],
            'answer'  => [0, 3],
            'concept' => 'Propriétés typographie',
            'explainFr' => 'Les propriétés <code>font-size</code> et <code>line-height</code> sont des propriétés de typographie. <code>margin</code>, <code>border</code> et <code>padding</code> sont des propriétés de modèle de boîte.',
            'explainDarija' => '<code>font-size</code> w <code>line-height</code> propriétés typographie. <code>margin</code> w <code>border</code> w <code>padding</code> modèle de boîte. ',
        ],
    ],
];