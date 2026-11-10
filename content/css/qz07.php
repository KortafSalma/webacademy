<?php

declare(strict_types=1);

/**
 * Quiz du chapitre css-ch7.
 * Schéma des questions :
 *  - type 'mcq','multi','tf','fill','predict','find-error','complete','sql'
 *  - 'question' : énoncé
 *  - 'concept' : libellé court du point du cours
 *  - 'explainFr', 'explainDarija' : obligatoires
 */

return [
    'title' => 'Quiz — Bordures et dimensions',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'La propriété border-radius peut prendre une valeur en pourcentage pour créer des coins arrondis complets (forme de pilule).',
            'answer'  => 1,
            'concept' => 'border-radius pourcentage',
            'explainFr' => 'Vrai : Lorsqu\'on utilise border-radius: 50%, les coins deviennent des quarts de cercle qui peuvent former une forme de pilule si la hauteur et la largeur sont égales.',
            'explainDarija' => 'Vrai : border-radius: 50% kay9der coins quotients kay form pilule si hauteur largeur égaux. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces propriétés accepte une valeur en pourcentage pour les marges ?',
            'options' => ['margin', 'width', 'height', 'padding'],
            'answer'  => 0,
            'concept' => 'margin pourcentage',
            'explainFr' => 'Les valeurs en pourcentage pour margin se basent toujours sur la largeur du parent, même pour margin-top et margin-bottom. C\'est une particularité souvent source de confusion.',
            'explainDarija' => 'Valeurs pourcentage margin toujours basée largeur parent, même margin-top w margin-bottom. particularité source confusion. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des affirmations suivantes sur box-sizing est fausse ?',
            'options' => ['border-box inclut padding et border dans la largeur', 'content-box est la valeur par défaut', 'border-box enlève le padding et border de la largeur', 'box-sizing: border-box facilite le responsive design'],
            'answer'  => 2,
            'concept' => 'box-sizing',
            'explainFr' => 'Faux : Avec border-box, le padding ET la border sont INCLUS dans la largeur définie. Ce n\'est pas qu\'ils soient enlevés, c\'est l\'opposé : ils font partie de la largeur.',
            'explainDarija' => 'Faux : Avec border-box, padding w border INCLUS dans largeur définie. Ce ne sont pas enlevés, kay part la largeur. ',
        ],
        [
            'type'    => 'fill',
            'question'=> 'La valeur par défaut de box-sizing est ______',
            'expected'=> 'content-box',
            'concept' => 'box-sizing default',
            'explainFr' => 'La valeur par défaut de box-sizing est content-box, ce qui signifie que la largeur définie ne concerne que le contenu, et que le padding et la border s\'ajoutent dessus.',
            'explainDarija' => 'Valeur par défaut content-box, largeur définie concerne contenu seul, padding w border s\'ajoutent dessus. ',
        ],
        [
            'type'    => 'multi',
            'question'=> 'Choisissez les propriétés qui peuvent avoir des valeurs en pourcentage pour la hauteur :',
            'options' => ['height', 'min-height', 'max-width', 'line-height'],
            'answer'  => [0, 1],
            'concept' => 'hauteur pourcentage',
            'explainFr' => 'height et min-height acceptent des valeurs en pourcentage (basées sur la hauteur du conteneur parent). En revanche, max-width utilise un pourcentage de la largeur du parent, et line-height utilise un multiplicateur ou une unité sans unité.',
            'explainDarija' => 'height w min-height acceptent pourcentage (basée hauteur parent). max-width utilise largeur parent, line-height utilise multiplicateur w unité sans unité. ',
        ],
    ],
];