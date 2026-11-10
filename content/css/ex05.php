<?php

declare(strict_types=1);

/**
 * Exercices du chapitre css-ch5.
 * Schéma OBLIGATOIRE pour tous les fichiers exNN.php :
 * [
 *   'id' => 'module-exN', 'title' => ..., 'brief' => 'une ligne',
 *   'levels' => [
 *     ['level'=>1, 'title'=>'...', 'lang'=>'html|css|php|sql',
 *      'instructions' => css FR, 'instructionsDarija' => css Darija,
 *      'starter' => code de départ,
 *      'tests' => [ ['type'=>'html_contains','value'=>'color'], … ],
 *      'hints' => ['indice 1','indice 2'],
 *      'solution' => code corrigé,
 *      'explainFr' => ..., 'explainDarija' => ...],
 *     … niveaux 2 et 3
 *   ]
 * ]
 */

return [
    'id'    => 'css-ex5',
    'title' => 'Typographie',
    'brief' => 'Mettez en forme du texte avec les propriétés CSS',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — couleur et police de base',
            'lang'  => 'css',
            'instructions' => 'Complétez le code CSS ci-dessous pour mettre en forme le texte de l\'article : définissez la famille de polices (utilisez "Georgia" en première choix, avec un fallback serif), la taille de police (16px), la couleur (une couleur bleue foncée), et le style de police (italique).',
            'instructionsDarija' => 'Complete code CSS bach format texte article : define police family (Georgia premier choix w fallback serif), taille 16px, couleur bleue foncée, w style italic.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Article de blog</title>\n  <style>\n    /* TODO : ajouter vos propriétés CSS ici */\n    article {\n      /* police, taille, couleur, style */\n    }\n  </style>\n</head>\n<body>\n  <article>\n    <h1>Bienvenue sur WebAcademy</h1>\n    <p>Ceci est un article de démonstration.</p>\n  </article>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'font-family: "Georgia"'],
                ['type' => 'html_contains', 'value' => 'color:'],
                ['type' => 'html_contains', 'value' => 'font-style:'],
            ],
            'hints' => [
                'Utilisez font-family: "Georgia", serif;',
                'La couleur bleue foncée peut être #2c3e50 ou blue.',
                'font-style: italic;',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Article de blog</title>\n  <style>\n    article {\n      font-family: "Georgia", serif;\n      font-size: 16px;\n      color: #2c3e50;\n      font-style: italic;\n    }\n  </style>\n</head>\n<body>\n  <article>\n    <h1>Bienvenue sur WebAcademy</h1>\n    <p>Ceci est un article de démonstration.</p>\n  </article>\n</body>\n</html>',
            'explainFr' => 'Vous avez correctement appliqué les propriétés de typographie de base : police Georgia en 16px, couleur foncée et style italique. Cela donne un aspect sérieux et lisible à votre texte.',
            'explainDarija' => 'Vous kay apply properties typographie de base : police Georgia 16px couleur foncée w style italic. Aspect sérieux lisible texte. ',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — contrôle de la ligne et de l\'alignement',
            'lang'  => 'css',
            'instructions' => 'À partir du starter ci-dessous, modifiez le CSS pour : définir une taille de police de 1.2rem, un interligne (line-height) de 1.8, aligner le texte au centre, et mettre en italic le texte à l\'intérieur de la balise <code>em</code>.',
            'instructionsDarija' => 'Bach starter modify CSS : define taille 1.2rem, line-height 1.8, aligner texte centre, italic texte f em balise.',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Mise en forme</title>\n  <style>\n    /* TODO : vos propriétés ici */\n    p {\n      /* taille, line-height, align, italic em */\n    }\n  </style>\n</head>\n<body>\n  <p>Voici un paragraphe avec <em>texte en italique</em> dedans.</p>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'line-height:'],
                ['type' => 'html_contains', 'value' => 'text-align: center'],
                ['type' => 'html_contains', 'value' => 'font-style: italic'],
                ['type' => 'html_contains', 'value' => 'font-size: 1.2rem'],
            ],
            'hints' => [
                '1.2rem est une taille relative racine.',
                'text-align: center centre le texte du parent.',
                'font-style: italic s\'applique au élément ciblé.',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Mise en forme</title>\n  <style>\n    p {\n      font-size: 1.2rem;\n      line-height: 1.8;\n      text-align: center;\n    }\n    p em {\n      font-style: italic;\n    }\n  </style>\n</head>\n<body>\n  <p>Voici un paragraphe avec <em>texte en italique</em> dedans.</p>\n</body>\n</html>',
            'explainFr' => 'Le paragraphe affiche maintenant une taille de 1.2rem, un interligne de 1.8 pour une meilleure lisibilité, un alignement centré, et le texte à l\'intérieur de la balise em est en italique.',
            'explainDarija' => 'Paragraphe affichage 1.2rem w line-height 1.8 lisibilité meilleurs, alignement centre, w texte em italic. ',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — typographie complète d\'article',
            'lang'  => 'css',
            'instructions' => 'Créez une mise en forme complète pour un article de blog. Le titre h1 doit avoir une police de 2rem, un poids de 700 (bold), une couleur #2c3e50 et être en uppercase. Le contenu p doit avoir une taille de 1rem, une couleur #555, un line-height de 1.6 et justifié. Les citations <code>q</code> doivent avoir des guillemères ouvrantes et fermantes avec des guillemets français («  »).',
            'instructionsDarija' => 'Create mise en forme complete article blog. h1 police 2rem poids 700 bold couleur #2c3e50 uppercase. contenu p taille 1rem couleur #555 line-height 1.6 justifié. citations q guillemets français «  ».',
            'starter' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Article complet</title>\n  <style>\n    /* TODO : mise en forme complète */\n    h1 {\n    }\n    p {\n    }\n    q {\n    }\n  </style>\n</head>\n<body>\n  <h1>Titre de l\'article</h1>\n  <p>Texte de l\'article...</p>\n  <p>Autre paragraphe...</p>\n  <q>Citation avec guillemets français.</q>\n</body>\n</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'font-size: 2rem'],
                ['type' => 'html_contains', 'value' => 'font-weight: 700'],
                ['type' => 'html_contains', 'value' => 'color: #2c3e50'],
                ['type' => 'html_contains', 'value' => 'text-transform: uppercase'],
                ['type' => 'html_contains', 'value' => 'font-size: 1rem'],
                ['type' => 'html_contains', 'value' => 'color: #555'],
                ['type' => 'html_contains', 'value' => 'line-height: 1.6'],
                ['type' => 'html_contains', 'value' => 'text-align: justify'],
                ['type' => 'html_contains', 'value' => 'q {'],
                ['type' => 'html_contains', 'value' => '}'],
            ],
            'hints' => [
                'font-weight: 700 pour le gras.',
                'text-transform: uppercase pour les majuscules.',
                'text-align: justify justifie le texte.',
                'Les guillemets français s\'écrivent « et ».',
            ],
            'solution' => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <title>Article complet</title>\n  <style>\n    h1 {\n      font-size: 2rem;\n      font-weight: 700;\n      color: #2c3e50;\n      text-transform: uppercase;\n    }\n    p {\n      font-size: 1rem;\n      color: #555;\n      line-height: 1.6;\n      text-align: justify;\n    }\n    q {\n  quotes: \"\\00ab\" \"\\00bb\";\n}\n    q:before { content: open-quote; }\n    q:after { content: close-quote; }\n  </style>\n</head>\n<body>\n  <h1>Titre de l\'article</h1>\n  <p>Texte de l\'article...</p>\n  <p>Autre paragraphe...</p>\n  <q>Citation avec guillemets français.</q>\n</body>\n</html>',
            'explainFr' => 'L\'article dispose d\'une typographie complète et professionnelle : le titre est en gras et en uppercase, le texte est justifié avec un bon interligne, et les citations affichent correctement les guillemets français « ainsi ».',
            'explainDarija' => 'Article typographie complete professionnelle : titre gras uppercase, texte justifié w line-height 1.6, citations affichent guillemets français « ». ',
        ],
    ],
];