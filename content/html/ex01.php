<?php

declare(strict_types=1);

/**
 * Exercices du chapitre html-ch1.
 * Schéma OBLIGATOIRE pour tous les fichiers exNN.php :
 * [
 *   'id' => 'module-exN', 'title' => ..., 'brief' => 'une ligne',
 *   'dataset' => ??? ((sql uniquement)),
 *   'dialect' => ??? (sql uniquement : 'sqlite' | 'mysql'),
 *   'levels' => [
 *     ['level'=>1, 'title'=>'...', 'lang'=>'html|css|php|sql',
 *      'instructions' => html FR, 'instructionsDarija' => html Darija,
 *      'starter' => code de départ,
 *      'tests' => [ ['type'=>'html_contains','value'=>'<h1>'], … ],
 *      'hints' => ['indice 1','indice 2'],
 *      'solution' => code corrigé,
 *      'explainFr' => ..., 'explainDarija' => ...],
 *     … niveaux 2 et 3
 *   ]
 * ]
 * Types de tests disponibles : html_contains, html_regex, html_not_regex,
 * output_contains, output_not_contains, output_equals, output_regex,
 * sql_ok, result_has, result_lacks, row_count {op,val}.
 */

return [
    'id'    => 'html-ex1',
    'title' => 'Ta première page',
    'brief' => 'Crée une page valide, titre principal et paragraphe.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — complète la page',
            'lang'  => 'html',
            'instructions' => 'Complete les balises manquantes : la page doit avoir un <code>h1</code> contenant ton prénom et un paragraphe <code>p</code> avec une phrase.',
            'instructionsDarija' => 'Kmml les balises naqsin : khassek <code>h1</code> fih smitek, w paragraphe <code>p</code> fih wa7d jomla.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 1</title>
</head>
<body>
  <!-- TODO : ajouter h1 puis p -->
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<h1>'],
                ['type' => 'html_contains', 'value' => '<p>'],
            ],
            'hints' => [
                'Une balise s\'écrit <h1>…</h1> : une ouverture puis une fermeture.',
                'Écris <h1>Amal</h1> puis <p>Salut les étudiants !</p> entre <body> et </body>.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 1</title>
</head>
<body>
  <h1>Amal</h1>
  <p>Salut les étudiants ! Bienvenue sur ma page.</p>
</body>
</html>',
            'explainFr' => 'Le h1 est le titre principal (un seul par page), le p place un paragraphe de texte.',
            'explainDarija' => 'h1 howa titre kbir (wa7d pol page), p howa paragraphe dyal texte.',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — structure correcte',
            'lang'  => 'html',
            'instructions' => 'La page ci-dessous est cassée. Corrige : meta charset, balise jamais refermée, et majuscule interdite:<code>&lt;H3&gt;</code>. Remplace-le par <code>h2</code>. La page doit être valide : <code>&lt;/h1&gt;</code> présent, un seul <code>&lt;h2&gt;</code>.',
            'instructionsDarija' => 'Had page fiha des fautes : meta charset ma fiha l\'attribut, wa7d balise ma mssdatch, H3 majuscule ghalta. Beddel H3 b <code>h2</code> w s7i7 kolchi.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta content="UTF-8">
  <title>TP 2</title>
</head>
<body>
  <h1>CV</h1>
  <H3>Etudiant</H3>
  <p>Presentation
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'charset="utf-8"'],
                ['type' => 'html_contains', 'value' => '</h1>'],
                ['type' => 'html_contains', 'value' => '</p>'],
                ['type' => 'html_not_regex', 'value' => '<h3'],
            ],
            'hints' => [
                '<meta charset="UTF-8"> : l\'attribut charset est nécessaire.',
                'Les balises ouvertes doivent être fermées : <p>…</p>',
                'Les balises sont en minuscules en HTML conventionnel.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 2</title>
</head>
<body>
  <h1>CV</h1>
  <h2>Étudiant</h2>
  <p>Présentation</p>
</body>
</html>',
            'explainFr' => 'Un document valide : charset correct, toutes balises fermées, pas de balise inexistante <H3> (c\'était sûrement un h2 voulu).',
            'explainDarija' => 'Page valide : charset mzyan, kol balise msdouda w mesdída (h1 w p), w H3 makaynach — kan khass tkoun h2 bel lowercase.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — page mini-CV complète',
            'lang'  => 'html',
            'instructions' => 'Crée une page « mini-CV » : doctype + html lang fr + head (charset, title) + body avec h1, deux h2 (Compétences et Contact), une liste ul avec trois li dans Compétences, et un paragraphe de contact avec votre e-mail imaginaire (<code>example@site.ma</code>).',
            'instructionsDarija' => 'Dreb page "mini-CV" kamla : doctype, head fiha charset w title, w f body : h1 (smitek), jouj h2 (Compétences w Contact), liste fiha 3 compétences <code>ul > li</code>, w paragraphe fiha email dyalek.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mini-CV</title>
</head>
<body>
  <!-- TODO : h1, deux h2, ul > li×3, p contact -->
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => '<!doctype'],
                ['type' => 'html_contains', 'value' => 'lang="fr"'],
                ['type' => 'html_contains', 'value' => '<h2>compétences' ],
                ['type' => 'html_contains', 'value' => '<h2>contact'],
                ['type' => 'html_contains', 'value' => '<ul>'],
                ['type' => 'html_contains', 'value' => '<li>'],
                ['type' => 'html_regex', 'value' => '<li>[\s\S]*?<li>[\s\S]*?<li>'],
                ['type' => 'html_contains', 'value' => 'example@site.ma'],
            ],
            'hints' => [
                'Structure : <h2>Compétences</h2> puis <ul><li>…</li>×3</ul>.',
                'N\'oublie pas l\'email dans <p>…</p> sous <h2>Contact</h2>.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mini-CV</title>
</head>
<body>
  <h1>Salma K.</h1>

  <h2>Compétences</h2>
  <ul>
    <li>HTML / CSS</li>
    <li>PHP — niveau débutant</li>
    <li>MySQL — requêtes SELECT</li>
  </ul>

  <h2>Contact</h2>
  <p>Écris-moi : example@site.ma</p>
</body>
</html>',
            'explainFr' => 'Assemblage propre de la structure vue au cours : titres hiérarchiques (h1 puis h2), liste non ordonnée, e-mail en paragraphe.',
            'explainDarija' => 'Rkommi structure msfya : titres mrtatbin (h1 men ba3d h2), list fiha 3 items, w l\'email le katkteb tdakhal f <p>…</p>.',
        ],
    ],
];
