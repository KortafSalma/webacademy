<?php

declare(strict_types=1);

/**
 * Quiz du chapitre html-ch8.
 * Schéma des questions :
 *  - type 'mcq','multi','tf','fill','predict','find-error','complete','sql'
 *  - 'question' : énoncé
 *  - 'concept' : libellé court du point du cours
 *  - 'explainFr', 'explainDarija' : obligatoires
 */

return [
    'title' => 'Quiz — HTML sémantique',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'La balise <code><header></code> ne doit être utilisée que pour l\'en-tête de page principale.',
            'answer'  => 0,
            'concept' => 'Balise header',
            'explainFr' => 'Faux : La balise <code><header></code> peut s\'utiliser pour n\'importe quelle section ou article de la page, pas seulement pour l\'en-tête de page principale. Elle marque un en-tête de section.',
            'explainDarija' => 'Ghalta : <code><header></code> kay9der kay9der section w ma bach page principale kayes. Kay mark header section. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Quelle balise utilisez-vous pour marquer le contenu principal d\'une page (un seul par page) ?',
            'options' => ['<div>', '<section>', '<main>', '<article>'],
            'answer'  => 2,
            'concept' => 'Balise main',
            'explainFr' => 'La balise <code><main></code> marque le contenu principal de la page. Il ne doit y en avoir qu\'un seul par page, et il ne doit pas être enchevêtré dans d\'autres éléments <code><main></code>.',
            'explainDarija' => 'Balise <code><main></code> mark contenu principal page. Un seul par page, ma kaybikhtarch f autres main. ',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Laquelle de ces balises est sémantique ?',
            'options' => ['<span>', '<b>', '<div>', '<article>'],
            'answer'  => 3,
            'concept' => 'Balise article',
            'explainFr' => 'La balise <code><article></code> est sémantique : elle représente un contenu indépendant qui peut être distribué séparément (article de blog, actualité, etc.).',
            'explainDarija' => 'Balise <code><article></code> sémantique : contenu indépendant kay y3dder ykhod ykhod bach (article blog, actualité). ',
        ],
        [
            'type'    => 'fill',
            'question'=> 'Le protocole qui sécurise les communications sur le Web s\'écrit <code>H______S</code> :',
            'expected'=> 'https',
            'accept'  => ['https', 'HTTPS', 'le https', 'protocole https'],
            'concept' => 'HTTP / HTTPS',
            'explainFr' => 'HTTPS = HTTP + chiffrement (Safety) : le trafic entre navigateur et serveur est crypté, ce qui protège les données sensibles.',
            'explainDarija' => 'HTTPS howa HTTP mchiffri : data mn binat navigateur w serveur mahfouda encrypted, kay9der data sensitive khdess. ',
        ],
        [
            'type'    => 'multi',
            'question'=> 'Choisissez les balises sémantiques HTML5 parmi les suivantes :',
            'options' => ['<div>', '<header>', '<a>', '<section>', '<span>', '<nav>'],
            'answer'  => [1, 3, 5],
            'concept' => 'Balises sémantiques identifiables',
            'explainFr' => 'Les balises <code><header></code>, <code><section></code> et <code><nav></code> sont des balises sémantiques HTML5 qui décrivent le sens de leur contenu. <code><div></code> et <code><span></code> sont neutres et n\'appportent aucune signification.',
            'explainDarija' => '<code><header></code>, <code><section></code> w <code><nav></code> kay9der balises sémantiques HTML5 kay describe sens contenu. <code><div></code> w <code><span></code> neutres w appellent aucune signification. ',
        ],
    ],
];