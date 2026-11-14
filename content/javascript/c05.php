<?php
declare(strict_types=1);
/**
 * PARCOURS JAVASCRIPT — Chapitre 5 : console.log, commentaires et structure du code
 * Modèle de qualité pour les 30 chapitres du parcours.
 */
return [
    'id'       => 'js-ch5',
    'title'    => 'console.log, commentaires et structure du code',
    'lessons' => [
        ['id' => 'console-log-basique', 'blocks' => [['type' => 'text', 'fr' => 'console.log basique']]]],
    'mistakes' => [
        ['wrong' => 'Utiliser trop de commentaires en excès', 'fix' => 'Commenter uniquement les intentions complexes ou non évidentes', 'fr' => 'Le code devrait être auto-explicite ; les commentaires servent à clarifier le pourquoi, pas le quoi.', 'darija' => 'Code kay9der kay9der s\'explique tout seul ; commentaires kay9der kay9der yclarifier pourquoi, machi quoi.'],
        ['wrong' => 'Oublier de fermer les commentaires sur plusieurs lignes', 'fix' => 'Vérifier que chaque /* a son pair de */', 'fr' => 'Un commentaire non fermé peut "commenter" tout le code qui suit.', 'darija' => 'Commentaire kay9der ma kay7et pair kay9der */ kay9der kay7et commenter code b9der.'],
    ],
    'summary' => [
        'fr' => '<strong>console.log()</strong> affiche n\'importe quelle valeur dans la console. Les commentaires (// pour une ligne, /* */ pour plusieurs lignes) ne sont pas exécutés. Structurez votre code : constantes et variables en haut, fonctions après, exécution en bas. Cela rend le code plus lisible et plus facile à maintenir.',
        'darija' => '<strong>console.log()</strong> kayktb kay value f console. Commentaries // b l9der w /* */ b9der l9der kay9der kay7et kay7et b9der execution. Structurez code : variables w constantes en haut, functions après, execution en bas. Had code kay9der kay9der lisible w maintenable.',
    ],
];