<?php

declare(strict_types=1);

/**
 * PROJET JavaScript 1 — Premier script interactif
 * Parcours JavaScript : chapitre 1
 */

return [
    'id'        => 'js-proj1',
    'title'     => 'Premier script JavaScript interactif',
    'level'     => 'Niveau : chapitre 1 du parcours JavaScript',
    'lang'      => 'javascript',
    'course'    => 'javascript',
    'objective' => '<p>Écrire un script JavaScript qui réagit à un clic, modifie le texte d\'un élément et affiche un message dans la console. Découvrir le DOM et les événements.</p>',
    'steps' => [
        [
            'title'   => 'Créer la structure HTML',
            'explain' => '<p>Utilisez le modèle du chapitre 1. La page doit contenir un bouton <code><button></code> avec l\'attribut <code>id="action"</code> et un paragraphe <code><p id="message"</code>.</p>',
            'darija'  => '<p>T7et structure HTML b model chapitre 1. Page fih bouton <code><button id="action"</code> w paragraphe <code><p id="message"</code>.</p>',
            'lang'    => 'html',
            'file'    => 'index.html',
            'code'    => '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <meta name="viewport" content="width=device-width, initial-scale=1">\n  <title>Mon TP JavaScript</title>\n  <link rel="stylesheet" href="style.css">\n</head>\n<body>\n\n  <h1 id="titre">Bonjour JavaScript</h1>\n  <p id="message">Cliquez sur le bouton pour changer ce texte.</p>\n  <button id="action">Changer le texte</button>\n\n</body>\n</html>',
            'check'   => 'Vérifié : présence des éléments #action et #message, lien vers style.css et script.js.',
        ],
        [
            'title'   => 'Ajouter le script JavaScript',
            'explain' => '<p>Ajoutez un fichier <code>script.js</code> qui sélectionne le bouton et le paragraphe, puis ajoute écouteur d\'événement au clic. Au clic, changez le texte du paragraphe et affichez un message dans la console.</p>',
            'darija'  => '<p>Tl fichier <code>script.js</code> kayjib sélection bouton w paragraphe, w kaysejjel écouteur clic. Mn clic, kaybedel texte paragraphe w kay3red message f console.</p>',
            'lang'    => 'javascript',
            'file'    => 'script.js',
            'code'    => 'const message = document.getElementById("message");\nconst bouton = document.getElementById("action");\n\nbouton.addEventListener("click", () => {\n  message.textContent = "Le bouton a été cliqué !";\n  console.log("Clic détecté à", new Date().toLocaleTimeString("fr-FR"));\n});',
            'check'   => 'Vérifié : écouteur d\'événement présent, modification de textContent et console.log exécutés.',
        ],
        [
            'title'   => 'Vérifier le comportement',
            'explain' => '<p>Ouvrez la page dans un navigateur, cliquez sur le bouton. Le texte du paragraphe doit changer en « Le bouton a été cliqué ! » et la console doit afficher le message avec l\'horodatage.</p>',
            'darija'  => '<p>T7et page fnavigateur, click b bouton. Texte paragraphe katbedel b "Le bouton a été cliqué !" w console kay3red message b l\'horodatage.</p>',
            'lang'    => 'text',
            'file'    => 'Test',
            'code'    => 'Interaction réussie : texte changé + message console.',
            'check'   => 'Le visiteur clique, le texte change, la console affiche le message.',
        ],
    ],
];