<?php

declare(strict_types=1);

/**
 * MODULE CSS — Chapitre 3 : Sélecteurs
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
    'id'       => 'css-ch3',
    'title'    => 'Sélecteurs',
    'subtitle' => 'Sélectionner et cibler les éléments HTML',

    'objectives' => [
        'Comprendre la notion de sélecteur en CSS.',
        'Utiliser les sélecteurs de type, de classe et d\'ID.',
        'Appliquer des sélecteurs de groupe et de contexte.',
        'Utiliser les pseudo-classes :hover et :first-child.',
        'Comprendre la spécificité des sélecteurs.',
    ],

    'lessons' => [
        // ------------------------------------------------ Section 1 : Les types de sélecteurs
        [
            'id'    => 'types-selecteurs',
            'title' => 'Les différents types de sélecteurs',
            'icon'  => '🎯',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>En CSS, un <strong>sélecteur</strong> permet de cibler un ou plusieurs éléments HTML afin de leur appliquer des styles. Il existe plusieurs types de sélecteurs de base.</p>',
                 'darija' => '<p>f CSS, <strong>sélecteur</strong> kay9der cibler elmént HTML w appliquer les styles. kay9der plusieurs types de sélecteurs de base.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code'  => 'element { property: value; }',
                 'title' => 'Syntaxe de base'],

                ['type' => 'example',
                 'title' => 'Exemple de mise en forme avec différents sélecteurs',
                 'lang'  => 'css',
                 'code' => 'body { background-color: #f0f0f0; }\nh1 { color: #333; font-size: 2em; }\n#header { background: #333; color: #fff; padding: 1rem; }\np { margin-bottom: 1rem; line-height: 1.6; }',
                 'preview' => true,
                 'explainFr' => 'Ces styles s\'appliqueront automatiquement aux éléments correspondants dans la page HTML.',
                 'explainDarija' => 'Hada styles kay9der s9der bach tkoun elements correspondants f page HTML.'],

                // Pseudo-class :hover
                ['type' => 'example',
                 'title' => 'Effet hover sur les liens',
                 'lang'  => 'css',
                 'code' => 'a { color: #333; text-decoration: none; }\na:hover { color: #e91e63; text-decoration: underline; }',

                 'title' => 'Effet hover sur les liens'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Sélecteurs avancés
        [
            'id'    => 'selecteurs-avances',
            'title' => 'Sélecteurs avancés et contexte',
            'icon'  => '🔍',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Au-delà des sélecteurs de base, CSS offre des sélecteurs plus puissants pour cibler des éléments en fonction de leur position, de leur état ou de leur relation avec d\'autres éléments.</p>',
                 'darija' => '<p>CSS kay9der sélecteurs plus puissants bach cibler elmént en fonction de position, état w relation w d\'autres elmént.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'css',
                 'code' => 'lien a { color: blue; }\nh1, h2, h3 { color: #333; }\nli:first-child { font-weight: bold; }',

                 'title' => 'Sélecteurs avancés'],

                ['type' => 'example',
                 'title' => 'Mise en forme d\'une liste avec différents sélecteurs',
                 'lang'  => 'css',
                 'code' => 'ul { list-style: none; padding: 0; }\n\nli { margin-bottom: 8px; }\n\nli:first-child { margin-top: 0; }\n\nli:hover { background: #e3f2fd; }',

                 'preview' => true,
                 'explainFr' => 'La liste bénéficie d\'un espacement uniforme, le premier item n\'a pas de marge haute, et les items survolés deviennent légèrement bleus.',
                 'explainDarija' => 'List kay9der marge uniforme, premier item ma kayn marge haute, w items survolés kay9der kay9der couleur bleue légère.'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser des sélecteurs trop spécifiques (ex: div.container .btn) sans nécessité',
            'fix'    => 'Privilégier les sélecteurs simples et réutilisables ; utiliser des classes lorsqu\'on partage un style.',
            'fr'     => 'Une spécificité excessive rend le CSS difficile à maintenir et peut entraîner des conflits de styles inattendus. Il vaut mieux structurer son HTML pour utiliser des classes générales.',
            'darija' => 'Spécificité ghalita kay9der CSS kay9der difficile kay9der maintained w conflits m7awwal.',
        ],
        [
            'wrong'  => 'Oublier les préfixes fournisseur pour les propriétés récentes',
            'fix'    => 'Vérifier la compatibilité navigateur ou utiliser des outils comme Autoprefixer.',
            'fr'     => 'Certaines propriétés CSS nécessitent des préfixes fournisseur (-webkit-, -moz-, etc.) pour fonctionner sur les anciens navigateurs. Pensez à les tester ou à utiliser Autoprefixer dans votre workflow.',
            'darija' => 'Propriétés CSS récentes kay9der préfixes fournisseur (-webkit-, -moz-, etc.) bach fonctionnENT sur navigateurs anciens. Test compatibility w use Autoprefixer f workflow.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>CSS</strong> : les sélecteurs ciblent les éléments HTML par type, classe, ID ou contexte. Les pseudo-classes comme :hover ajoutent de l\'interaction. Évitez les sélecteurs trop spécifiques et pensez à la compatibilité navigateur.',
        'darija' => 'CSS : sélecteurs kay9der elmént by type, classe, ID w context. Pseudo-classes kay9der interaction. Évitez spécificité excessive w test compatibilité navigateur.',
    ],
];