<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 3 : Ce que JavaScript peut faire (et ne peut pas faire)
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'js-ch3',
    'title'    => 'Ce que JavaScript peut faire (et ne peut pas faire)',
    'subtitle' => 'Les limites et les capacités du langage côté navigateur.',
    'level'    => 'Débutant',
    'minutes'  => 45,
    'prerequisites' => ['Savoir créer des variables et utiliser console.log'],

    'objectives' => [
        'Lister ce que JavaScript peut modifier dans une page web.',
        'Expliquer ce que JavaScript ne peut pas faire (pas d\'accès au système de fichiers, pas de réseau direct).',
        'Distinguer les capacités client-side des limitations de sécurité.',
        'Comprendre le modèle de permissions du navigateur.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'capacites-client',
            'title' => 'Les capacités côté client',
            'icon'  => '🌐',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>JavaScript s\'exécute dans le navigateur du visiteur. Il a un accès restreint au modèle de la page (DOM), peut réagir aux événements (clics, soumissions de formulaires, mouvements de souris), créer et modifier du contenu dynamiquement, stocker des informations légères (localStorage, sessionStorage), et communiquer avec un serveur via Fetch ou XMLHttpRequest. Tout cela s\'effectue dans un environnement « sandbox » sécurisé qui empêche l\'accès au système de fichiers de l\'ordinateur ou à des réseaux externes non autorisés.</p><p>C\'est ce qui permet de créer des interpages interactives, des formulaires validés avant l\'envoi, des animations, et des applications web riches (SPA) qui fonctionnent entièrement dans le navigateur.</p>',
                 'darija' => '<p>JavaScript kaykhdem f navigation visitor. Howa kayl9der ybedel f DOM page, kaytf3al m3a events (clic, soumission formulaire, souris), kay3ed ywjy w modif contenu dyalo, kaystokor informations lighyats (localStorage, sessionStorage), w kayetawri l serveur b Fetch wla XMLHttpRequest. Kol had f environnement « sandbox » sécurisé li ma kayl9der y3mloch y9der fichier système ordinateur wla reseau externe b3d authorization. Hadi kay9der y3der les pages interactives, formulaires validés b3d envoi, animations, w applications web riches (SPA) kayfhem f navigation kelchi.</p>'],

                ['type' => 'definition', 'title' => 'DOM (Document Object Model)',
                 'fr'   => '<p>Le <strong>DOM</strong> est la représentation arbre de la page HTML. Chaque élément, attribut et texte devient un <em>noeud</em> que JavaScript peut parcourir, modifier ou supprimer. Quand JavaScript change un noeud DOM, le navigateur met à jour l\'affichage instantanément.</p>',
                 'darija' => '<p><b>DOM</b> howa representation arbre dyale page HTML. Kol élément, attribut w texte kay9der kaybda noeud li kayder kaydir w modif ou kay7et JavaScript. Ila JavaScript change un noeud DOM, navigation kaymajdid affichage instantanément.</p>'],

                ['type' => 'example', 'title' => 'Changer le texte d\'un paragraphe',
                 'lang'  => 'javascript',
                 'code'  => '<!DOCTYPE html>\n<html lang="fr">\n<head><meta charset="UTF-8"><title>Exemple</title></head>\n<body>\n  <p id="msg">Salam</p>\n  <script>\n    document.getElementById("msg").innerText = "Bonjour WebAcademy";\n  </script>\n</body>\n</html>',
                 'explainFr' => 'Sélectionner le paragraphe par son ID etModifier son texte modifie immédiatement ce qui s\'affiche dans la fenêtre du navigateur.',
                 'explainDarija' => 'Sélection par ID w modif texte kay9der kayt3ed m3a affichage dyalo b7i9 direct.'],

                ['type' => 'example', 'title' => 'Écouter un clic de souris',
                 'lang'  => 'javascript',
                 'code'  => '<!DOCTYPE html>\n<html lang="fr">\n<head><meta charset="UTF-8"><title>Exemple</title></head>\n<body>\n  <button id="btn">Clique-moi</button>\n  <script>\n    document.getElementById("btn").addEventListener("click", function() {\n      alert("Bouton cliqué !");\n    });\n  </script>\n</body>\n</html>',
                 'explainFr' => 'L\'événement click est capturé sur le bouton ; à chaque clic, une alerte s\'affiche.',
                 'explainDarija' => 'Event click kay3tar f button; b kol click, alert kaytkhed.'],

            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'limitations-safety',
            'title' => 'Les limitations de sécurité',
            'icon'  => '🔒',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Bien que puissant, JavaScript côté navigateur comporte des limitations strictes par politique de même origine (Same-Origin Policy). Il ne peut pas : lire ou écrire des fichiers sur l\'ordinateur du visiteur, ouvrir des connexions réseau vers n\'importe quel domaine sans restriction, accéder aux autres onglets ou à l\'historique de navigation, ou exécuer du code arbitraire venant d\'autres sources sans vérification. Ces restrictions visent à protéger la vie privée et la sécurité de l\'utilisateur. Pour contourner certaines limites, on utilise des techniques comme CORS pour les requêtes cross-origin, ou des APIs spécialisées (comme les notifications avec permission de l\'utilisateur).</p>',
                 'darija' => '<p>Bien que puissant, JavaScript f navigation kay9der limitations strictes b politique Same-Origin Policy. Il ma kay9der ma y9der y7et w yktb fichiers f PC visitor, ma kay9der y9der ytew connections reseau m3a domain m3a restrictions, ma kay9der y9der y9der les onglets ou historique navigation, w ma kay9der y9der y7et code arbitraire m3a sources m3a verification. Had restrictions kay9der y9der y7ed y7faz privacy w sécurité visitor. Bach t7et certaines limites, kay7et CORS pour requêtes cross-origin, w APIs spécialisées (comme notifications b permission visitor).'],

                ['type' => 'definition', 'title' => 'Same-Origin Policy',
                 'fr'   => '<p>La <strong>Same-Origin Policy</strong> est une règle de sécurité qui limite les interactions entre différentes origines (combinaison protocole, domaine et port). Deux URLs ont la même origine si elles ont le même protocole (http/https), le même domaine, et le même port. Cette politique empêche un script d\'accéder aux données d\'une page provenant d\'une origine différente sans autorisation explicite.</p>',
                 'darija' => '<p><b>Same-Origin Policy</b> howa rula sécurité li m3idd interactions bine b différentes origines (protocole, domaine, port). Deux URLs howa same origin kayhom protocole (http/https), domaine w port m3ah. Hada policy ma kay9der y9der y7et données page m3a origine différente b authorization explicite.</p>'],

                ['type' => 'example', 'title' => 'Requête cross-origin avec CORS',
                 'lang'  => 'javascript',
                 'code'  => '<!DOCTYPE html>\n<html lang="fr">\n<head><meta charset="UTF-8"><title>Exemple</title></head>\n<body>\n  <script>\n    // Requête vers une API externe\n    fetch("https://api.example.com/data")\n      .then(response => response.json())\n      .then(data => console.log(data))\n      .catch(error => console.error("Erreur :", error));\n  </script>\n</body>\n</html>',
                 'explainFr' => 'L\'attribut <code>Access-Control-Allow-Origin</code> sur le serveur autorise la lecture de la réponse depuis le domaine du script.',
                 'explainDarija' => 'Attribut <code>Access-Control-Allow-Origin</code> f server y9der yqder lis response m3a domaine script.'],

            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'test-connaissances',
            'title' => 'Vérifier vos connaissances',
            'icon'  => '❓',
            'blocks' => [

                ['type' => 'true_false',
                 'question' => 'JavaScript peut lire des fichiers directement sur l\'ordinateur du visiteur.',
                 'answer' => 1,
                 'concept' => 'Limitations de sécurité',
                 'explainFr' => 'Faux : JavaScript côté navigateur n\'a pas accès au système de fichiers pour des raisons de sécurité.',
                 'explainDarija' => 'Ghalat : JavaScript f navigation ma y9der y7et fichier PC visitor b7al sécurité.'],

                ['type' => 'mcq',
                 'question' => 'Laquelle de ces actions JavaScript peut-elle effectuer côté navigateur ?',
                 'options' => [
                     'Modifier le HTML de la page',
                     'Réagir aux clics souris',
                     'Stocker des données dans localStorage',
                     'Toutes les réponses ci-dessus',
                 ],
                 'answer' => 3,
                 'concept' => 'Capacités JavaScript',
                 'explainFr' => 'Toutes ces actions sont possibles : modifier le HTML, réagir aux événements, et stocker des données légères.',
                 'explainDarija' => 'Kol actions howa kay9der : modif HTML, tf3al events, w stockage données légères f localStorage.'],

                ['type' => 'true_false',
                 'question' => 'JavaScript peut envoyer des requêtes réseau vers n\'importe quel domaine sans restriction.',
                 'answer' => 1,
                 'concept' => 'Same-Origin Policy',
                 'explainFr' => 'Faux : la Same-Origin Policy restreint les requêtes vers des domaines différents.',
                 'explainDarija' => 'Ghalat : Same-Origin Policy m3idd restrictions lrequêtes m3a domain différents.'],

            ],
        ],

    ],

    'mistakes' => [
        [
            'wrong'  => 'S\'attendre à accéder aux fichiers du visiteur',
            'fix'    => 'Utiliser localStorage ou envoyer une requête au serveur',
            'fr'     => 'JavaScript ne peut pas lire de fichiers sur l\'ordinateur du visiteur sans interaction explicite.',
            'darija' => 'JavaScript ma y9der y7et fichier PC visitor b7al interaction explicite.',
        ],
        [
            'wrong'  => 'Ignorer la Same-Origin Policy',
            'fix'    => 'Vérifier les en-têtes CORS ou utiliser un proxy serveur',
            'fr'     => 'Les requêtes cross-origin nécessitent l\'autorisation du serveur distant.',
            'darija' => 'Requêtes cross-origin kay9der y9der authorization server distant.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>JavaScript</strong> peut modifier le DOM, réagir aux événements, stocker des données légères et communiquer avec un serveur via Fetch. Mais il <strong>ne peut pas</strong> accéder au système de fichiers, contourner la Same-Origin Policy sans CORS, ou échanger directement avec d\'autres onglets. Ces limitations existent pour protéger la vie privée de l\'utilisateur.',
        'darija' => '<strong>JavaScript</strong> kay3ed ybedel DOM, tf3al events, w kaystokor données lighyats b localStorage w kayetawri l serveur b Fetch. Walakin <strong>ma y9der</strong> y9der y7et fichiers, y9der y7et Same-Origin Policy b3d CORS, w ma kay9der y9der y7et directly m3a other tabs. Had limitations kay9der y7ed y7faz privacy visitor.',
    ],
];