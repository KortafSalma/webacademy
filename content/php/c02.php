<?php

declare(strict_types=1);

/**
 * MODULE PHP — Chapitre 2 : Variables et constantes
 * Exemplaire de référence pour TOUS les fichiers de chapitre :
 *   - id : "module-chN"
 *   - lessons[] : sections avec blocks[]
 *   - mistakes[] : erreurs fréquentes
 *   - summary : résumé FR + Darija
 * Types de blocs :
 *   text {fr,darija} | definition {title,fr,darija} | syntax {lang,code,title}
 *   example {title,lang,code,output,explainFr,explainDarija,preview?}
 *   note|tip|warning {title,fr,darija} | table {headers,rows} | keywords {items:[{kw,fr,darija}]}
 */

return [
    'id'       => 'php-ch2',
    'title'    => 'Variables et constantes',
    'subtitle' => 'Stocker et manipuler des données',

    'objectives' => [
        'Déclarer des variables en PHP.',
        'Utiliser différents types de variables (entier, chaîne, tableau).',
        'Comprendre la portée des variables (locale vs globale).',
        'Utiliser des constantes pour des valeurs qui ne changent pas.',
        'Utiliser les superglobales $_GET et $_POST.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les variables
        [
            'id'    => 'les-variables',
            'title' => 'Introduction aux variables',
            'icon'  => '💾',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>En PHP, une <strong>variable</strong> est un conteneur qui stocke une valeur. Elle commence toujours par le symbole <code>$</code>. Les variables sont sensibles à la casse.</p>',
                 'darija' => '<p>f PHP, <strong>variable</strong> howa kay9der kaystocker valeur. Hia kaybtda b symbole <code>$</code>. Hadi sensitive l9der (case-sensitive).</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code'  => '$maVariable = "Valeur"; $nombre = 42; $estActif = true;',
                 'title' => 'Syntaxe de base'],

                ['type' => 'example',
                 'title' => 'Exemple de déclaration de variables',
                 'lang'  => 'php',
                 'code' => '<?php\n$prenom = "Yasmine";\n$age = 25;\$estEtudiant = true;\necho "Bonjour " . $prenom . " ! Vous avez " . $age . " ans.";\n?>',

                 'preview' => true,
                 'explainFr' => 'Le script affiche : "Bonjour Yasmine ! Vous avez 25 ans."',
                 'explainDarija' => 'Lscript kay9der "Bonjour Yasmine ! Vous avez 25 ans.".'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Les constantes
        [
            'id'    => 'les-constantes',
            'title' => 'Les constantes',
            'icon'  => '🔑',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Une <strong>constante</strong> est semblable à une variable, mais une fois définie, sa valeur ne peut pas être modifiée. Elle est définie avec la fonction <code>define()</code> ou le mot-clé <code>const</code>.</p>',
                 'darija' => '<p>Hadi variable kay9der valeur mchi kaytjib. Definie bach fonction <code>define()</code> w mot-clé <code>const</code>.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code' => 'define("CONSTANTE", "valeur"); const MA_CONSTANTE = "valeur";',
                 'title' => 'Syntaxe des constantes'],

                ['type' => 'example',
                 'title' => 'Exemple d\'utilisation de constantes',
                 'lang'  => 'php',
                 'code' => '<?php\ndefine("SITE_NAME", "WebAcademy");\nconst AUTHOR = "Mohamed";\necho "Bienvenue sur " . SITE_NAME;\necho "Auteur : " . AUTHOR;\n?>',

                 'preview' => true,
                 'explainFr' => 'Affiche : "Bienvenue sur WebAcademy" puis "Auteur : Mohamed".',
                 'explainDarija' => 'Affiche : "Bienvenue sur WebAcademy" w "Auteur : Mohamed".'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Les superglobales
        [
            'id'    => 'les-superglobales',
            'title' => 'Les superglobales $_GET et $_POST',
            'icon'  => '🌐',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Les <strong>superglobales</strong> sont des variables prédéfinies qui sont toujours disponibles dans tout le script PHP. <code>$_GET</code> collecte les données d\'un formulaire avec méthode GET, et <code>$_POST</code> avec méthode POST.</p>',
                 'darija' => '<p>Superglobales howa variables prédédefinie kay9der kay9der f script PHP. $_GET kay9der données f formulaire GET, w $_POST f méthode POST.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code' => '// Exemple de récupération d\'un paramètre GET\n$nom = $_GET["nom"] ?? "Invité";\n// Exemple de récupération d\'un formulaire POST\n$email = $_POST["email"] ?? "";',

                 'title' => 'Syntaxe des superglobales'],

                ['type' => 'example',
                 'title' => 'Exemple de formulaire de contact',
                 'lang'  => 'php',
                 'code' => '<?php\nif ($_SERVER["REQUEST_METHOD"] === "POST") {\n    $email = $_POST["email"] ?? "";\n    echo "Email reçu : " . $email;\n}\n?>\n\n<form method="POST" action="">\n    <input type="email" name="email" required>\n    <button type="submit">Envoyer</button>\n</form>',


                 'preview' => true,
                 'explainFr' => 'Le script affiche l\'email envoyé via le formulaire.',
                 'explainDarija' => 'Lscript kay9der email kay9der bach formulaire.'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser des noms de variables commençant par un chiffre (ex: $1message)',
            'fix'    => 'Toujours commencer les variables par une lettre ou un underscore : $message ou $message1.',
            'fr'     => 'Les variables PHP ne peuvent pas commencer par un chiffre. Cela provoquera une erreur de syntaxe.',
            'darija' => 'Variables PHP kay9der kaybtda b lettre w underscore : $message w $message1. Number l9der error syntax. ',
        ],
        [
            'wrong'  => 'Oublier d\'échapper les caractères spéciaux dans les chaînes de caractères',
            'fix'    => 'Utiliser la fonction htmlspecialchars() pour afficher du texte en sécurité.',
            'fr'     => 'Les caractères spéciaux comme <, >, & doivent être convertis en entités HTML pour éviter les failles XSS et l\'affichage incorrect.',
            'darija' => 'Caractères spéciaux (<, >, &) kay9der converti b entités HTML bach éviter XSS w affichage incorrect. ',
        ],
    ],

    'summary' => [
        'fr' => '<strong>PHP</strong> : les variables commencent par $, sont sensibles à la casse. Les constantes ne changent pas de valeur. Les superglobales $_GET et $_POSTcollectent les formulaires. Interdiction de commencer un nom de variable par un chiffre. Toujours échapper les caractères spéciaux.',
        'darija' => 'PHP : variables kaybtda b $, sensitive l9der. Constants mchi kaytjib. Superglobales $_GET w $_POST kay9der formulaires. Interdiction nom variable par chiffre. Toujours échapper caractères spéciaux.',
    ],
];