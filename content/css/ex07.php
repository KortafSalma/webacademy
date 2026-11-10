<?php

declare(strict_types=1);

/**
 * Exercices du chapitre css-ch7.
 * Schéma OBLIGATOIRE pour tous les fichiers exNN.php :
 * [
 *   'id' => 'module-exN', 'title' => ..., 'brief' => 'une ligne',
 *   'levels' => [
 *     ['level'=>1, 'title'=>'...', 'lang'=>'html|css|php|sql',
 *      'instructions' => css FR, 'instructionsDarija' => css Darija,
 *      'starter' => code de départ,
 *      'tests' => [ ['type'=>'html_contains','value'=>'border'], … ],
 *      'hints' => ['indice 1','indice 2'],
 *      'solution' => code corrigé,
 *      'explainFr' => ..., 'explainDarija' => ...],
 *     … niveaux 2 et 3
 *   ]
 * ]
 */

return [
    'id'    => 'css-ex7',
    'title' => 'Bordures et dimensions',
    'brief' => 'Définissez les bordures et dimensions des éléments',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — bordure simple',
            'lang'  => 'css',
            'instructions' => 'Complétez le code CSS ci-dessous pour ajouter une bordure simple de 2 pixels en couleur noire solide à l\'élément <code>div</code>.',
            'instructionsDarija' => 'Add simple border 2px black solid div.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Bordure</title>\n  <style>\n    /* TODO : ajouter border ici */\n    div {\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu</div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'border:'],
                ['type' => 'html_contains', 'value' => 'border-style: solid'],
                ['type' => 'html_contains', 'value' => 'border-width: 2px'],
                ['type' => 'html_contains', 'value' => 'border-color: black'],
            ],
            'hints' => [
                'La propriété border raccourcie s\'écrit : border: largeur style couleur;',
                'Exemple : border: 2px solid black;',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Bordure</title>\n  <style>\n    div {\n      border: 2px solid black;\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu</div>\n</body>\n</html>',
            'explainFr' => 'Vous avez correctement ajouté une bordure de 2 pixels en style solide noir à l\'élément div. La bordure entoure maintenant le contenu de l\'élément.',
            'explainDarija' => 'Add border 2px solid black correctement. Bordure entoure contenu élément. ',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — coins arrondis et dimensions',
            'lang'  => 'css',
            'instructions' => 'À partir du starter ci-dessous, ajoutez des propriétés CSS pour : arrondir les coins du div avec un rayon de 8 pixels, définir une largeur maximale de 500 pixels et une hauteur minimale de 100 pixels.',
            'instructionsDarija' => 'Add border-radius 8px, max-width 500px, min-height 100px.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Dimensions</title>\n  <style>\n    /* TODO : ajouter propriétés ici */\n    div {\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu</div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'border-radius:'],
                ['type' => 'html_contains', 'value' => 'max-width: 500px'],
                ['type' => 'html_contains', 'value' => 'min-height: 100px'],
            ],
            'hints' => [
                'border-radius: 8px arrondit tous les coins à 8 pixels.',
                'max-width: 500px limite la largeur maximale.',
                'min-height: 100px assure une hauteur minimale.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Dimensions</title>\n  <style>\n    div {\n      border-radius: 8px;\n      max-width: 500px;\n      min-height: 100px;\n      border: 1px solid #e0e0e0;\n      padding: 10px;\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu</div>\n</body>\n</html>',
            'explainFr' => 'Le div affiche désormais des coins arrondis de 8 pixels, une largeur maximale de 500 pixels et une hauteur minimale de 100 pixels. Le contenu sera correctement espacé à l\'intérieur.',
            'explainDarija' => 'Div coins arrondis 8px, max-width 500px, min-height 100px contenu Espacé intérieurement. ',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — boîte complète avec toutes propriétés',
            'lang'  => 'css',
            'instructions' => 'Créez une boîte complète avec : une bordure de 2 pixels en style dashed en couleur #333, des coins arrondis de 10 pixels, un padding de 15 pixels, une largeur de 400 pixels, une hauteur de 200 pixels, et l\'utilisation de box-sizing: border-box pour inclure padding et border dans la largeur.',
            'instructionsDarija' => 'Create boîte complete : border 2px dashed #333, border-radius 10px, padding 15px, width 400px, height 200px, box-sizing border-box.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Boîte complète</title>\n  <style>\n    /* TODO : création de la boîte */\n    .box {\n    }\n  </style>\n</head>\n<body>\n  <div class="box"></div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'border:'],
                ['type' => 'html_contains', 'value' => 'border-style: dashed'],
                ['type' => 'html_contains', 'value' => 'border-color: #333'],
                ['type' => 'html_contains', 'value' => 'border-radius:'],
                ['type' => 'html_contains', 'value' => 'padding: 15px'],
                ['type' => 'html_contains', 'value' => 'width: 400px'],
                ['type' => 'html_contains', 'value' => 'height: 200px'],
                ['type' => 'html_contains', 'value' => 'box-sizing: border-box'],
            ],
            'hints' => [
                'Toutes les propriétés peuvent être combinées dans le même sélecteur .box.',
                'N\'oubliez pas l\'ordre : border avant border-radius.',
                'box-sizing: border-box doit être la dernière déclaration ou au moins présente.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Boîte complète</title>\n  <style>\n    .box {\n      border: 2px dashed #333;\n      border-radius: 10px;\n      padding: 15px;\n      width: 400px;\n      height: 200px;\n      box-sizing: border-box;\n      background-color: #f5f5f5;\n    }\n  </style>\n</head>\n<body>\n  <div class="box"></div>\n</body>\n</html>',
            'explainFr' => 'La boîte affiche une bordure pointillée de 2 pixels en couleur #333, des coins légèrement arrondis, un espace intérieur de 15px, et des dimensions fixes de 400×200 pixels. Le box-sizing assure que le padding et la border sont inclus dans ces dimensions.',
            'explainDarija' => 'Boîte border dashed 2px #333, border-radius 10px, padding 15px, width 400px height 200px w box-sizing border-box padding w border inclus dans dimensions. ',
        ],
    ],
];