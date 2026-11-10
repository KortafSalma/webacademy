<?php

declare(strict_types=1);

/**
 * Quiz du chapitre html-ch1.
 * Schéma des questions :
 *  - type 'mcq' | 'predict' | 'find-error' | 'complete' | 'multi' | 'tf' | 'fill' | 'sql'
 *  - 'question' : énoncé (HTML)
 *  - 'codeText' + 'lang' : extrait de code affiché (optionnel)
 *  - 'options' : ['...', ...] (sauf tf/fill/sql)
 *  - 'answer' : index (int) | liste d'index (multi) | chaîne attendue (fill)
 *  - 'accept' (fill) : variantes acceptées
 *  - 'concept' : libellé du concept (pour "à réviser")
 *  - 'explainFr', 'explainDarija' : obligatoires
 *  - type 'sql' : 'dialect', 'test' => ['type'=>'result_has'|'row_count'|'sql_ok', 'value'=>…]
 */

return [
    'title' => 'Quiz — Introduction au développement web',
    'questions' => [

        [
            'type'    => 'tf',
            'question'=> 'HTML est un langage de programmation, tout comme PHP.',
            'answer'  => 1,
            'concept' => 'Rôle de HTML',
            'explainFr' => 'Faux : HTML est un langage de <strong>balisage</strong> qui décrit la structure. Il n\'a ni condition, ni boucle, ni calcul.',
            'explainDarija' => 'Ghalta : HTML langage de balisage katwari structure la page, mais i5conditions jan. if / boucles ma fiha — hadi dyal les langages de programmation bhal PHP.',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Quelle technologie s\'exécute côté SERVEUR ?',
            'options' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
            'answer'  => 3,
            'concept' => 'Front-end / Back-end',
            'explainFr' => 'PHP tourne uniquement sur le serveur ; HTML, CSS et JS sont exécutés (interprétés) par le navigateur du visiteur.',
            'explainDarija' => 'PHP kaykhdem ghir f serveur. HTML, CSS, JS kaykhdmo f navigateur dyal l\'utilisateur.',
        ],
        [
            'type'    => 'mcq',
            'question'=> 'Que se passe-t-il concrètement quand vous ouvrez un site web ?',
            'options' => [
                'Le navigateur exécute la base de données du site',
                'Le navigateur envoie une requête HTTP, le serveur répond en envoyant les fichiers (HTML, CSS…), le navigateur les affiche',
                'Le serveur dessine la page et l\'envoie comme image',
                'Votre ordinateur installe le site sur le disque',
            ],
            'answer'  => 1,
            'concept' => 'Client / Serveur',
            'explainFr' => 'Modèle client-serveur : requête HTTP du client (navigateur) → réponse du serveur (fichiers) → rendu par le navigateur.',
            'explainDarija' => 'Nkta model client-server : navigateur kaytalb (requête HTTP), serveur kayseft les fichiers, navigateur kayrender.',
        ],
        [
            'type'    => 'mcq',
            'question'=> '<code>article.php?id=3</code> affiche un article différent selon le paramètre. Ce site est…',
            'options' => ['Statique', 'Dynamique', 'Cassé', 'Un site téléchargeable'],
            'answer'  => 1,
            'concept' => 'Site dynamique',
            'explainFr' => 'Le contenu change selon les données (ici l\'id) : le serveur assemble la page à la demande → site dynamique.',
            'explainDarija' => 'Kol id kayjib wa7d article mokhtalif = content kaytt-beddel selon données : hada site dynamique.',
        ],
        [
            'type'    => 'multi',
            'question'=> 'Choisissez les technologies du FRONT-END (sélection multiple) :',
            'options' => ['HTML', 'PHP', 'CSS', 'SQL', 'JavaScript'],
            'answer'  => [0, 2, 4],
            'concept' => 'Front-end / Back-end',
            'explainFr' => 'Front-end = HTML + CSS + JS (navigateur). PHP + SQL = back-end (serveur).',
            'explainDarija' => 'Front-end : HTML, CSS, JS f navigateur. Back-end : PHP + SQL f serveur.',
        ],
        [
            'type'    => 'fill',
            'question'=> 'Le protocole sécurisé utilisé par la plupart des sites est <code>H______S</code> (écrire le nom du protocole complet) :',
            'expected'=> 'https',
            'accept'  => ['https', 'HTTPS', 'le https', 'protocole https'],
            'concept' => 'HTTP / HTTPS',
            'explainFr' => 'HTTPS = HTTP + chiffrement (Safety) : le trafic entre navigateur et serveur est crypté.',
            'explainDarija' => 'HTTPS howa HTTP mchiffri : kol data mn binat navigateur w serveur mahfouda encrypted.',
        ],
    ],
];
