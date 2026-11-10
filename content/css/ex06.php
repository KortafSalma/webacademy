<?php

declare(strict_types=1);

/**
 * Exercices du chapitre css-ch6.
 * Schéma OBLIGATOIRE pour tous les fichiers exNN.php :
 * [
 *   'id' => 'module-exN', 'title' => ..., 'brief' => 'une ligne',
 *   'levels' => [
 *     ['level'=>1, 'title'=>'...', 'lang'=>'html|css|php|sql',
 *      'instructions' => css FR, 'instructionsDarija' => css Darija,
 *      'starter' => code de départ,
 *      'tests' => [ ['type'=>'html_contains','value'=>'margin'], … ],
 *      'hints' => ['indice 1','indice 2'],
 *      'solution' => code corrigé,
 *      'explainFr' => ..., 'explainDarija' => ...],
 *     … niveaux 2 et 3
 *   ]
 * ]
 */

return [
    'id'    => 'css-ex6',
    'title' => 'Margin et padding',
    'brief' => 'Appliquez les marges et padding aux éléments',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — marge extérieure basique',
            'lang'  => 'css',
            'instructions' => 'Complétez le code CSS ci-dessous pour ajouter une marge de 20 pixels en haut et en bas de l\'élément <code>div</code>, et aucune marge à gauche et à droite.',
            'instructionsDarija' => 'Complete CSS add margin 20px top/bottom w aucun left/right.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Mise en page</title>\n  <style>\n    /* TODO : ajouter margin ici */\n    div {\n      /* margin top/bottom */\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu du div</div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'margin-top: 20px'],
                ['type' => 'html_contains', 'value' => 'margin-bottom: 20px'],
                ['type' => 'html_contains', 'value' => 'margin-right: 0'],
                ['type' => 'html_contains', 'value' => 'margin-left: 0'],
            ],
            'hints' => [
                'Utilisez la propriété raccourcie margin avec quatre valeurs.',
                'margin: 20px 0 defini 20px top/bottom w 0 left/right.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Mise en page</title>\n  <style>\n    div {\n      margin: 20px 0;\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu du div</div>\n</body>\n</html>',
            'explainFr' => 'Vous avez correctement appliqué une marge extérieure de 20px en haut et en bas, avec aucune marge à gauche et à droite. L\'élément aura un espace de 20px au-dessus et en dessous.',
            'explainDarija' => 'Margin 20px top/bottom w 0 left/right correctement appliqué. Élément aura espace 20px dessus dessous. ',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — padding et largeur',
            'lang'  => 'css',
            'instructions' => 'À partir du starter ci-dessous, ajoutez du padding de 15 pixels à l\'intérieur de l\'élément <code>div</code>, et définissez une largeur maximale de 600 pixels avec centrage automatique.',
            'instructionsDarija' => 'Add padding 15px inside div, définir largeur maximale 600px w centrage automatique.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Conteneur</title>\n  <style>\n    /* TODO : ajouter padding w max-width ici */\n    div {\n      /* padding w max-width */\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu du div</div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'padding: 15px'],
                ['type' => 'html_contains', 'value' => 'max-width: 600px'],
                ['type' => 'html_contains', 'value' => 'margin: 0 auto'],
            ],
            'hints' => [
                'padding: 15px définit le padding pour les quatre côtés.',
                'margin: 0 auto centre horizontalement.',
                'N\'oubliez pas d\'ajouter box-sizing: border-box si nécessaire.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Conteneur</title>\n  <style>\n    div {\n      padding: 15px;\n      max-width: 600px;\n      margin: 0 auto;\n      box-sizing: border-box;\n    }\n  </style>\n</head>\n<body>\n  <div>Contenu du div</div>\n</body>\n</html>',
            'explainFr' => 'L\'élément dispose maintenant d\'un intérieur de 15px sur tous côtés, d\'une largeur maximale de 600px et d\'un centrage automatique grâce à margin: 0 auto. La propriété box-sizing assure que la largeur totale inclut le padding.',
            'explainDarija' => 'Élément intérieur 15px côtés w max-width 600px w centrage automatique margin 0 auto. box-sizing kayensure largeur totale inclut padding. ',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — mise en page de carte asymétrique',
            'lang'  => 'css',
            'instructions' => 'Créez une mise en page de carte avec un espace asymétrique : la carte doit avoir une marge de 20px à gauche seulement, une marge de 10px en haut et en bas, et un padding intérieur de 25px. Ajoutez aussi box-sizing: border-box pour inclure padding et border dans la largeur.',
            'instructionsDarija' => 'Create page carte asymétrique : margin 20px left seulement, 10px top/bottom, padding 25px intérieur. Ajoutez box-sizing border-box.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Carte</title>\n  <style>\n    /* TODO : mise en page asymétrique */\n    .card {\n    }\n  </style>\n</head>\n<body>\n  <div class="card">Contenu de la carte</div>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'margin-top: 10px'],
                ['type' => 'html_contains', 'value' => 'margin-bottom: 10px'],
                ['type' => 'html_contains', 'value' => 'margin-left: 20px'],
                ['type' => 'html_contains', 'value' => 'margin-right: 0'],
                ['type' => 'html_contains', 'value' => 'padding: 25px'],
                ['type' => 'html_contains', 'value' => 'box-sizing: border-box'],
            ],
            'hints' => [
                'Utilisez les propriétés individuelles margin-top, margin-bottom, margin-left, margin-right.',
                'margin: 10px 0 10px 20px defini top 10 right 0 bottom 10 left 20.',
                'N\'oubliez box-sizing: border-box.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Carte</title>\n  <style>\n    .card {\n      margin: 10px 0 10px 20px;\n      padding: 25px;\n      box-sizing: border-box;\n      border: 1px solid #e0e0e0;\n      max-width: 300px;\n    }\n  </style>\n</head>\n<body>\n  <div class="card">Contenu de la carte</div>\n</body>\n</html>',
            'explainFr' => 'La carte affiche un espace asymétrique avec 10px en haut et en bas, 20px uniquement à gauche et aucune marge à droite. Le padding intérieur est de 25px et le modèle de boîte inclut le padding dans la largeur maximale de 300px.',
            'explainDarija' => 'Carte espace asymétrique 10px top/bottom, 20px left w 0 right. Padding 25px intérieur w box-sizing border-box largeur 300px incluant padding. ',
        ],
    ],
];