<?php

declare(strict_types=1);

/**
 * Exercices du chapitre html-ch4 — Liens et images.
 * Schéma OBLIGATOIRE : 3 niveaux (Débutant, Intermédiaire, Avancé).
 */

return [
    'id'    => 'html-ex4',
    'title' => 'Liens et images',
    'brief' => 'Crée une page avec un lien externe et une image avec texte alternatif.',

    'levels' => [

        [
            'level' => 1,
            'title' => 'Débutant — ajoute un lien et une image',
            'lang'  => 'html',
            'instructions' => 'Complète le code ci-dessous : ajoute un lien vers https://www.example.com avec le texte "Visiter Example", et insère une image chat.jpg avec comme texte alternatif "Photo d\'un chat".',
            'instructionsDarija' => 'Kmll code ci9der : ajout lien vers https://www.example.com b text "Visiter Example", w insertion image chat.jpg b text alternatif "Photo d\'un chat".',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 4</title>
</head>
<body>
  <h1>TP 4 – Liens et images</h1>
  <!-- TODO : ajouter lien et image -->
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'href="https://www.example.com"'],
                ['type' => 'html_contains', 'value' => 'alt="Photo d\'un chat"'],
                ['type' => 'html_contains', 'value' => '<h1>TP 4</h1>'],
            ],
            'hints' => [
                'Utilise la balise <a> avec attribut href.',
                'Utilise la balise <img> avec attribut alt.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 4</title>
</head>
<body>
  <h1>TP 4 – Liens et images</h1>
  <p>Visitez <a href="https://www.example.com">Example.com</a>.</p>
  <img src="chat.jpg" alt="Photo d\'un chat">
</body>
</html>',
            'explainFr' => 'Le h1 titre la page, le lien permet de visiter Example.com et l\'image s\'affiche avec le texte alternatif.',
            'explainDarija' => 'h1 kay9der page, liaison kay9der visiter Example.com w image kay9der b text alternatif "Photo d\'un chat".',
        ],

        [
            'level' => 2,
            'title' => 'Intermédiaire — lien vers une page interne et image responsive',
            'lang'  => 'html',
            'instructions' => 'La page ci-dessous contient des erreurs. Corrige : l\'attribut alt est manquant, le lien pointe vers une page inexistante "page.html", et l\'image doit avoir un style max-width: 100% pour être responsive. Remplace le lien par "accueil.html" et ajoute l\'attribut alt.',
            'instructionsDarija' => 'Had page fiha des fautes : alt mssdatch, lien pointer page mchya "page.html", w image kay9der style max-width: 100% bach responsive. Beddel lien b "accueil.html" w add attribut alt.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 4</title>
  <style>
    img { max-width: 100%; height: auto; }
  </style>
</head>
<body>
  <h1>TP 4 – Liens et images</h1>
  <p>Retour <a href="page.html">à l\'accueil</a>.</p>
  <img src="chat.jpg">
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'href="accueil.html"'],
                ['type' => 'html_contains', 'value' => 'alt='],
                ['type' => 'html_contains', 'value' => 'max-width'],
            ],
            'hints' => [
                'L\'attribut alt doit décrire le contenu de l\'image.',
                'Utilise un lien relatif vers accueil.html.',
                'Le style CSS max-width rend l\'image responsive.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TP 4</title>
  <style>
    img { max-width: 100%; height: auto; }
  </style>
</head>
<body>
  <h1>TP 4 – Liens et images</h1>
  <p>Retour <a href="accueil.html">à l\'accueil</a>.</p>
  <img src="chat.jpg" alt="Photo d\'un chat">
</body>
</html>',
            'explainFr' => 'Le lien pointe maintenant vers accueil.html, l\'image a un texte alternatif et est responsive.',
            'explainDarija' => 'Lia pointer bach accueil.html, image kay9der attribut alt w kay9der responsive.',
        ],

        [
            'level' => 3,
            'title' => 'Avancé — page de galerie d\'images avec liens',
            'lang'  => 'html',
            'instructions' => 'Crée une page « galerie d\'images » : doctype + html lang fr + head (charset, title, style CSS pour la galerie) + body avec h1 "Ma galerie", une galerie de 3 images avec liens vers leurs pages respectives, et un paragraphe de crédit. Chaque image doit avoir un texte alternatif décrivant ce qui y est représenté, et être enveloppée dans un lien <a>.',
            'instructionsDarija' => 'Dreb page "gallery d\'images" : doctype, head fiha charset, title, style CSS w gallery + body h1 "Ma galerie", galerie 3 images b lien f9der l9 page respective, w paragraphe credit. Kol image kay9der attribut alt yiw9der li 9der tkoun w kaykhradj f lien <a>.',
            'starter' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma galerie</title>
  <style>
    .gallery { display: flex; gap: 16px; }
    .gallery img { max-width: 300px; }
  </style>
</head>
<body>
  <h1>Ma galerie</h1>
  <!-- TODO : galerie d\'images -->
</body>
</html>',
            'tests' => [
                ['type' => 'html_contains', 'value' => 'Ma galerie'],
                ['type' => 'html_contains', 'value' => 'href="'],
                ['type' => 'html_contains', 'value' => 'alt='],
                ['type' => 'html_contains', 'value' => '<h1>'],
            ],
            'hints' => [
                'Enveloppe chaque image dans un lien <a>.',
                'Utilise une galerie CSS avec display: flex et gap.',
                'Chaque image doit avoir un alt descriptif.',
            ],
            'solution' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma galerie</title>
  <style>
    .gallery { display: flex; gap: 16px; }
    .gallery img { max-width: 300px; }
  </style>
</head>
<body>
  <h1>Ma galerie</h1>
  <div class="gallery">
    <a href="chat1.html"><img src="chat1.jpg" alt="Premier chat gris"></a>
    <a href="chat2.html"><img src="chat2.jpg" alt="Deuxième chat blanc"></a>
    <a href="chat3.html"><img src="chat3.jpg" alt="Troisème chat noir"></a>
  </div>
  <p>Crédit photos : Unsplash</p>
</body>
</html>',
            'explainFr' => 'Une galerie de 3 images cliquables, chacune avec un texte alternatif descriptif et un style responsive.',
            'explainDarija' => 'Gallery 3 images kaykhradj b lien, bach attribut alt descriptif w style responsive.',
        ],
    ],
];