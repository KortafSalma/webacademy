<?php

declare(strict_types=1);

/**
 * MODULE PHP — Chapitre 3 : Opérateurs
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
    'id'       => 'php-ch3',
    'title'    => 'Opérateurs',
    'subtitle' => 'Effectuer des calculs et des comparaisons',

    'objectives' => [
        'Utiliser les opérateurs arithmétiques (+, -, *, /, %).',
        'Utiliser les opérateurs de comparaison (==, !==, >, <, >=, <=).',
        'Utiliser les opérateurs logiques (&&, ||, !).',
        'Comprendre la priorité des opérateurs.',
        'Utiliser les opérateurs d\'incrémentation et de décrémentation (++, --).',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : Les opérateurs arithmétiques
        [
            'id'    => 'operateurs-arithmetiques',
            'title' => 'Les opérateurs arithmétiques',
            'icon'  => '➕',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs arithmétiques en PHP sont utilisés pour effectuer des calculs mathématiques. Les principaux opérateurs sont :<br><br><strong>+ (addition)</strong> : additionne deux valeurs.<br><strong>- (soustraction)</strong> : soustrait la deuxième valeur de la première.<br><strong>* (multiplication)</strong> : multiplie deux valeurs.<br><strong>/ (division)</strong> : divise la première valeur par la seconde.<br><strong>% (modulo)</strong> : retourne le reste de la division entière.</p>',
                 'darija' => '<p>Les opérateurs arithmétiques f PHP kay9der effectuer calculs mathématiques. Plus importants :<br><br><strong>+ (addition)</strong> : additionne deux valeurs.<br><strong>- (soustraction)</strong> : soustrait la deuxième valeur de la première.<br><strong>* (multiplication)</strong> : multiplie deux valeurs.<br><strong>/ (division)</strong> : divise la première valeur par la seconde.<br><strong>% (modulo)</strong> : retourne le reste de la division entière.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code' => '$resultat = 5 + 3; // 8\n$difference = 10 - 4; // 6\n$produit = 6 * 7; // 42\n$quotient = 15 / 3; // 5\n$reste = 17 % 4; // 1',

                 'title' => 'Syntaxe des opérateurs arithmétiques'],

                ['type' => 'example',
                 'title' => 'Exemple de calculs arithmétiques',
                 'lang'  => 'php',
                 'code' => '<?php\n$prix_unitaire = 10;\n$quantite = 5;\n$total = $prix_unitaire * $quantite;\necho "Total : " . $total . " DH";\n?>',

                 'preview' => true,
                 'explainFr' => 'Le script affiche "Total : 50 DH".',
                 'explainDarija' => 'Lscript kay9der afficher "Total : 50 DH".'],

            ],
        ],

        // ------------------------------------------------ Section 2 : Les opérateurs de comparaison
        [
            'id'    => 'operateurs-comparaison',
            'title' => 'Les opérateurs de comparaison',
            'icon'  => '🔍',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs de comparaison permettent de comparer deux valeurs et de retourner un résultat booléen (vrai ou faux). Les principaux opérateurs sont :<br><br><strong>== (égal)</strong> : retourne vrai si les deux valeurs sont identiques (attention au type).<br><strong>=== (identique)</strong> : retourne vrai si les deux valeurs sont identiques de même type.<br><strong>!= (différent)</strong> ou <strong><> (différent)</strong> : retourne vrai si les valeurs sont différentes.<br><strong>> (supérieur)</strong>, <strong>< (inférieur)</strong>, <strong>>= (supérieur ou égal)</strong>, <strong><= (inférieur ou égal)</strong>.</p>',
                 'darija' => '<p>Les opérateurs de comparaison permettent comparer deux valeurs bach retourner résultat booléen (vrai w faux). Plus importants :<br><br><strong>== (égal)</strong> : retourne vrai si les deux valeurs identiques (attention au type).<br><strong>=== (identique)</strong> : retourne vrai si les deux valeurs identiques de même type.<br><strong>!= (différent)</strong> w <strong><> (différent)</strong> : retourne vrai si les valeurs différentes.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code' => '$est_égal = ($a == $b);\n$est_identique = ($a === $b);\n$est_différent = ($a != $b);',

                 'title' => 'Syntaxe des opérateurs de comparaison'],

                ['type' => 'example',
                 'title' => 'Exemple de comparaison de valeurs',
                 'lang'  => 'php',
                 'code' => '<?php\n$age = 18;$est_majeur = ($age >= 18);\necho "Est majeur : " . ($est_majeur ? "oui" : "non");\n?>',

                 'preview' => true,
                 'explainFr' => 'Le script affiche "Est majeur : oui".',
                 'explainDarija' => 'Lscript kay9der afficher "Est majeur : oui".'],

            ],
        ],

        // ------------------------------------------------ Section 3 : Les opérateurs logiques et d'incrémentation
        [
            'id'    => 'operateurs-logiques-incrementation',
            'title' => 'Opérateurs logiques et d\'incrementation',
            'icon'  => '⏬',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Les opérateurs logiques sont utilisés pour combiner des conditions booléennes. Les principaux opérateurs sont :<br><br><strong>&& (ET)</strong> : retourne vrai si les deux opérandes sont vrais.<br><strong>|| (OU)</strong> : retourne vrai si au moins un opérande est vrai.<br><strong>! (NON)</strong> : inverse la valeur booléenne.<br><br>Les opérateurs d\'incrementation et de décrémentation sont :<br><strong>++ (incrementation)</strong> : ajoute 1 à la valeur.<br><strong>-- (décrémentation)</strong> : soustrait 1 de la valeur.</p>',
                 'darija' => '<p>Les opérateurs logiques kay9der combiner conditions booléennes. Plus importants :<br><br><strong>&& (ET)</strong> : retourne vrai si les deux opérandes sont vrais.<br><strong>|| (OU)</strong> : retourne vrai si au moins un opérande est vrai.<br><strong>! (NON)</strong> : inverse la valeur booléenne.<br><br>Les opérateurs d\'incrementation et de décrémentation :<br><strong>++ (incrementation)</strong> : ajoute 1 à la valeur.<br><strong>-- (décrémentation)</strong> : soustrait 1 de la valeur.</p>'],

                ['type' => 'syntax',
                 'lang'  => 'php',
                 'code' => '$resultat = true && false; // false\n$autre = false || true; // true\n$negation = !true; // false\n$compteur++;// ajoute 1 à $compteur\n$compteur--;// soustrait 1 de $compteur',

                 'title' => 'Syntaxe des opérateurs logiques et d\'incrementation'],

                ['type' => 'example',
                 'title' => 'Exemple d\'utilisation d\'opérateurs logiques et d\'incrementation',
                 'lang'  => 'php',
                 'code' => '<?php\n$actif = true;\n$nombre = 5;\n$nombre++;// $nombre vaut maintenant 6\necho "Le nombre est maintenant : " . $nombre;\n$actif = !$actif;// Inverse la valeur, $actif vaut maintenant false\necho "L\'actif est : " . ($actif ? "vrai" : "faux");\n?>',

                 'preview' => true,
                 'explainFr' => 'Le script affiche "Le nombre est maintenant : 6" puis "L\'actif est : faux".',
                 'explainDarija' => 'Lscript kay9der afficher "Le nombre est maintenant : 6" w "L\'actif est : faux".'],

            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Confondre == (égal) et === (identique)',
            'fix'    => 'Utilisez === pour des comparaisons strictes qui vérifient aussi le type des données.',
            'fr'     => 'L\'opérateur == effectue une comparaison de valeurs en convertissant les types si nécessaire. L\'opérateur === effectue une comparaison stricte qui vérifie aussi le type. Utilisez === pour éviter les bugs liés au type de données.',
            'darija' => '== kay9der comparaison de valeurs bach conversion de type. === kay9der comparaison stricte bach vérifier type. Utilisez === bach éviter bugs bach type de données.',
        ],
        [
            'wrong'  => 'Utiliser des opérateurs d\'incrémentation sans comprendre l\'ordre d\'évaluation',
            'fix'    => 'Soyez conscient de l\'ordre d\'évaluation lorsqu\'vous utilisez ++ ou -- dans des expressions complexes.',
            'fr'     => 'L\'utilisation de ++ ou -- au sein d\'expressions complexes peut entraîner des résultats inattendus en raison de l\'ordre d\'évaluation par le moteur PHP. Préférez utiliser ces opérateurs de manière isolée lorsque la clarté est importante.',
            'darija' => 'Utilisation ++ w -- f expressions complexes kay9der résultats inattendus bach ordre d\'évaluation. Préférez utiliser ces opérateurs de manière isolée l9der clarté important.',
        ],
    ],

    'summary' => [
        'fr' => '<strong>PHP</strong> : les opérateurs arithmétiques effectuent des calculs, les opérateurs de comparaison retournent des booléens, les opérateurs logiques combinent des conditions. Utilisez === pour des comparaisons strictes et faites attention à l\'ordre d\'évaluation avec ++ et --.',
        'darija' => 'PHP : les opérateurs arithmétiques effectuent calculs, opérateurs de comparaison retournent booléens, opérateurs logiques combinent conditions. Utilisez === bach comparaisons strictes w attention ordre d\'évaluation w ++ w --.',
    ],
];