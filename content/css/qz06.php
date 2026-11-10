<?php

declare(strict_types=1);

/**
 * Quiz du chapitre css-ch6.
 * Schéma des questions :
 *  - type 'mcq','multi','tf','fill','predict','find-error','complete','sql'
 *  - 'question' : énoncé
 *  - 'concept' : libellé court du point du cours
 *  - 'explainFr', 'explainDarija' : obligatoires
 */

return [
    'title' => 'Quiz — Margin et padding',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'La propriété margin peut avoir une valeur auto pour centrer horizontalement un élément block.',
            'answer'  => 1,
            'concept' => 'margin auto',
            'explainFr' => 'Vrai : La valeur <code>margin: auto</code> centre horizontalement les éléments de type block en définissant les marges gauche et droite automatiquement.',
            'explainDarija' => 'Vrai : <code>margin: auto</code> centre horizontalement éléments block kay définir marges gauche w droite automatiquement. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces déclarations CSS est équivalente à margin: 10px 20px ?',
            'options' => ['margin: 10px 20px 10px 20px', 'margin: 10px 20px 10px', 'margin: 20px 10px', 'margin: 10px'],
            'answer'  => 0,
            'concept' => 'propriété raccourcie',
            'explainFr' => 'Avec deux valeurs, la première s\'applique au top et bottom, et la seconde au right et left. Donc margin: 10px 20px est équivalent à margin: 10px 20px 10px 20px.',
            'explainDarija' => 'Deux valeurs : première top/bottom, seconde right/left. Donc margin: 10px 20px équivalent margin: 10px 20px 10px 20px. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle des affirmations suivantes sur le padding est fausse ?',
            'options' => ['padding agrandit la zone de l\'élément', 'padding affecte la largeur totale si box-sizing n\'est pas border-box', 'padding crée de l\'espace entre le contenu et la bordure', 'padding peut avoir des valeurs différentes pour chaque côté'],
            'answer'  => 1,
            'concept' => 'padding et largeur',
            'explainFr' => 'Faux : Si box-sizing est défini sur border-box, le padding n\'affecte pas la largeur totale ; il l\'inclut au contraire. Si box-sizing est content-box (par défaut), le padding s\'ajoute à la largeur.',
            'explainDarija' => 'Faux : Si box-sizing border-box, padding kay9der affect width totale kay l\'inclure. Si content-box défaut, padding s\'ajoute à largeur. ',
        ],
        [
            'type'    => 'fill',
            'question'=> 'La propriété raccourcie qui définit les quatre valeurs de margin s\'écrit margin: ______ où les quatre valeurs suivent l\'ordre top right bottom left.',
            'expected'=> '10px 20px 30px 40px',
            'concept' => 'margin raccourci',
            'explainFr' => 'L\'ordre des quatre valeurs dans la propriété margin raccourcie suit le sens inverse des aiguilles d\'horaire : top, right, bottom, left.',
            'explainDarija' => 'L\'ordre quatre valeurs margin : top, right, bottom, left sens inverse aiguilles montre. ',
        ],
        [
            'type'    => 'multi',
            'question'=> 'Choisissez les valeurs valides pour margin-bottom :',
            'options' => ['10px', 'auto', '10%', 'inherit', 'hidden'],
            'answer'  => [0, 1, 2, 3],
            'concept' => 'valeurs margin',
            'explainFr' => 'Les valeurs 10px (longueur), auto (centrement) et 10% (pourcentage de la largeur du parent) sont valides pour margin-bottom. Hidden n\'est pas une valeur valide pour margin.',
            'explainDarija' => 'Valeurs valides : 10px longueur, auto centrement, 10% largeur parent. Hidden pas valide margin. ',
        ],
    ],
];