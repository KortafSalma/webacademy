<?php

declare(strict_types=1);

/**
 * PARCOURS JAVASCRIPT — Chapitre 1 : exercices.
 * 3 niveaux débutant, 2 niveaux intermédiaire, 1 défi.
 * Les tests js_* sont exécutés réellement dans l'iframe sandbox.
 */

return [
    'id'    => 'js-ex1',
    'title' => 'Premiers pas en JavaScript',
    'brief' => 'Afficher, déclarer, calculer et réagir avec du vrai JavaScript.',

    'levels' => [

        // ---------------------------------------------------------- Niveau 1
        [
            'level'  => 1,
            'title'  => 'Débutant — premier message',
            'lang'   => 'javascript',
            'instructions' => '<p>Affichez exactement <code>Salam, JavaScript !</code> dans la console avec <code>console.log</code>.</p>',
            'instructionsDarija' => '<p>3red b dqiq <code>Salam, JavaScript !</code> f console b <code>console.log</code>.</p>',
            'starter' => '// Affiche le message dans la console
',
            'tests' => [
                ['type' => 'js_output_contains', 'value' => 'Salam, JavaScript !'],
            ],
            'hints' => [
                'L\'instruction est console.log(...).',
                'Le texte doit être entre guillemets.',
                'Termine l\'instruction par un point-virgule.',
            ],
            'solution' => 'console.log("Salam, JavaScript !");',
            'explainFr' => '<code>console.log</code> écrit la valeur dans la console du navigateur. Le texte entre guillemets est une chaîne de caractères.',
            'explainDarija' => '<code>console.log</code> kaykteb valeur f console dyal navigateur. Texte bin guillemets howa chaîne de caractères.',
        ],

        // ---------------------------------------------------------- Niveau 2
        [
            'level'  => 2,
            'title'  => 'Débutant — variables et phrase',
            'lang'   => 'javascript',
            'instructions' => '<p>Déclarez une constante <code>prenom</code> contenant <code>Amine</code> et une variable <code>age</code> valant <code>20</code>. Affichez ensuite une phrase qui contient le prénom et le mot <code>ans</code>, par exemple : <code>Amine a 20 ans.</code></p>',
            'instructionsDarija' => '<p>3len constante <code>prenom</code> fiha <code>Amine</code> w variable <code>age</code> b valeur <code>20</code>. Mn ba3d 3red phrase fiha prénom w kelma <code>ans</code>, mital : <code>Amine a 20 ans.</code></p>',
            'starter' => '// Déclare prenom et age
// Puis affiche la phrase

',
            'tests' => [
                ['type' => 'js_expr', 'value' => 'typeof prenom === "string" && prenom.length > 0'],
                ['type' => 'js_expr', 'value' => 'typeof age === "number" && age === 20'],
                ['type' => 'js_output_contains', 'value' => 'ans'],
            ],
            'hints' => [
                'Une constante se déclare avec const, une valeur modifiable avec let.',
                'On peut assembler une phrase avec + ou un template literal `${...}`.',
                'console.log(prenom + " a " + age + " ans.");',
            ],
            'solution' => 'const prenom = "Amine";
let age = 20;

console.log(prenom + " a " + age + " ans.");',
            'explainFr' => '<code>const</code> empêche la réassignation de <code>prenom</code>, <code>let</code> autorise la modification de <code>age</code>. L\'opérateur <code>+</code> concatène les chaînes et convertit le nombre en texte.',
            'explainDarija' => '<code>const</code> katmne3 réassignation dyal <code>prenom</code>, <code>let</code> katkhelli tbedel <code>age</code>. Opérateur <code>+</code> kaylsse9 chaînes w kay7ewel nombre l texte.',
        ],

        // ---------------------------------------------------------- Niveau 3
        [
            'level'  => 3,
            'title'  => 'Débutant — condition',
            'lang'   => 'javascript',
            'instructions' => '<p>La variable <code>nombre</code> vaut <code>-4</code>. Écrivez une condition qui place <code>Positif</code>, <code>Negatif</code> ou <code>Zero</code> dans une variable <code>resultat</code>, puis affichez <code>resultat</code>.</p>',
            'instructionsDarija' => '<p>Variable <code>nombre</code> fiha <code>-4</code>. Kteb condition li kat7et <code>Positif</code>, <code>Negatif</code> wla <code>Zero</code> f variable <code>resultat</code>, mn ba3d 3red <code>resultat</code>.</p>',
            'starter' => 'const nombre = -4;
let resultat = "";

// Teste le signe de nombre

console.log(resultat);',
            'tests' => [
                ['type' => 'js_expr', 'value' => 'typeof resultat === "string"'],
                ['type' => 'js_expr', 'value' => 'resultat.toLowerCase() === "negatif"'],
                ['type' => 'js_output_contains', 'value' => 'negatif'],
            ],
            'hints' => [
                'Utilise if, else if et else.',
                'Compare nombre à 0 avec >, < et ===.',
                'Assigne la bonne chaîne à resultat dans chaque branche.',
            ],
            'solution' => 'const nombre = -4;
let resultat = "";

if (nombre > 0) {
    resultat = "Positif";
} else if (nombre < 0) {
    resultat = "Negatif";
} else {
    resultat = "Zero";
}

console.log(resultat);',
            'explainFr' => 'Les conditions sont évaluées de haut en bas. Ici <code>nombre &lt; 0</code> est vraie, donc <code>resultat</code> reçoit « Negatif ».',
            'explainDarija' => 'Conditions kaytqraw mn lfouq lte7t. Hna <code>nombre &lt; 0</code> s7i7a, donc <code>resultat</code> katakhod « Negatif ».',
        ],

        // ---------------------------------------------------------- Niveau 4
        [
            'level'  => 4,
            'title'  => 'Intermédiaire — boucle et somme',
            'lang'   => 'javascript',
            'instructions' => '<p>Calculez la somme des entiers de <code>1</code> à <code>10</code> avec une boucle <code>for</code>, stockez-la dans <code>somme</code>, puis affichez <code>Somme : 55</code>.</p>',
            'instructionsDarija' => '<p>7seb somme dyal entiers mn <code>1</code> 7tta <code>10</code> b boucle <code>for</code>, khezenha f <code>somme</code>, mn ba3d 3red <code>Somme : 55</code>.</p>',
            'starter' => 'let somme = 0;

// Boucle de 1 à 10

console.log("Somme : " + somme);',
            'tests' => [
                ['type' => 'js_expr', 'value' => 'typeof somme === "number"'],
                ['type' => 'js_expr', 'value' => 'somme === 55'],
                ['type' => 'js_output_contains', 'value' => 'somme : 55'],
            ],
            'hints' => [
                'La boucle for s\'écrit for (let i = 1; i <= 10; i++).',
                'Ajoute i à somme à chaque tour : somme += i.',
                'La somme doit valoir 55 après la boucle.',
            ],
            'solution' => 'let somme = 0;

for (let i = 1; i <= 10; i++) {
    somme += i;
}

console.log("Somme : " + somme);',
            'explainFr' => '<code>somme += i</code> ajoute la valeur de <code>i</code> à la somme courante. La boucle s\'arrête quand <code>i</code> dépasse 10, et l\'accumulateur contient alors 55.',
            'explainDarija' => '<code>somme += i</code> katzid valeur dyal <code>i</code> l somme actuelle. Boucle kat7bes mnin <code>i</code> kayfout 10, w accumulateur kaykhezen 55.',
        ],

        // ---------------------------------------------------------- Niveau 5
        [
            'level'  => 5,
            'title'  => 'Intermédiaire — fonction',
            'lang'   => 'javascript',
            'instructions' => '<p>Écrivez une fonction <code>carre(x)</code> qui retourne le carré de <code>x</code>, puis affichez <code>carre(9)</code>.</p>',
            'instructionsDarija' => '<p>Kteb fonction <code>carre(x)</code> li katrje3 carré dyal <code>x</code>, mn ba3d 3red <code>carre(9)</code>.</p>',
            'starter' => '// Déclare la fonction carre

// Affiche carre(9)
',
            'tests' => [
                ['type' => 'js_expr', 'value' => 'typeof carre === "function"'],
                ['type' => 'js_expr', 'value' => 'carre(9) === 81'],
                ['type' => 'js_expr', 'value' => 'carre(-3) === 9'],
                ['type' => 'js_output_contains', 'value' => '81'],
            ],
            'hints' => [
                'Une fonction peut s\'écrire function carre(x) { ... }.',
                'Le mot-clé return renvoie le résultat.',
                'Le carré de x s\'écrit x * x.',
            ],
            'solution' => 'function carre(x) {
    return x * x;
}

console.log(carre(9));',
            'explainFr' => 'Une fonction regroupe un traitement réutilisable. <code>carre(9)</code> renvoie 81 ; sans <code>return</code>, la fonction renverrait <code>undefined</code> et le test échouerait.',
            'explainDarija' => 'Fonction katjme3 traitement li tqder t3awdo. <code>carre(9)</code> katrje3 81 ; bla <code>return</code>, fonction katrje3 <code>undefined</code> w test kaytfchel.',
        ],

        // ---------------------------------------------------------- Niveau 6
        [
            'level'  => 6,
            'title'  => 'Défi — moyenne avec reduce',
            'lang'   => 'javascript',
            'instructions' => '<p>Écrivez une fonction <code>moyenne(notes)</code> qui reçoit un tableau de nombres et retourne leur moyenne. Utilisez <code>reduce</code>. Calculez la moyenne de <code>[12, 15, 18]</code> et affichez <code>Moyenne : 15</code>.</p>',
            'instructionsDarija' => '<p>Kteb fonction <code>moyenne(notes)</code> li katakhod tableau dyal nombres w katrje3 moyenne dyalhom. Khdem b <code>reduce</code>. 7seb moyenne dyal <code>[12, 15, 18]</code> w 3red <code>Moyenne : 15</code>.</p>',
            'starter' => 'const notes = [12, 15, 18];

// Déclare moyenne(notes) avec reduce

// Affiche la moyenne
',
            'tests' => [
                ['type' => 'js_expr', 'value' => 'typeof moyenne === "function"'],
                ['type' => 'js_expr', 'value' => 'moyenne([10, 20]) === 15'],
                ['type' => 'js_expr', 'value' => 'moyenne([12, 15, 18]) === 15'],
                ['type' => 'js_output_contains', 'value' => 'moyenne : 15'],
            ],
            'hints' => [
                'reduce parcourt le tableau en accumulant une valeur.',
                'notes.reduce((total, note) => total + note, 0) calcule la somme.',
                'Divise la somme par notes.length pour obtenir la moyenne.',
            ],
            'solution' => 'const notes = [12, 15, 18];

function moyenne(notes) {
    const somme = notes.reduce((total, note) => total + note, 0);
    return somme / notes.length;
}

console.log("Moyenne : " + moyenne(notes));',
            'explainFr' => '<code>reduce</code> transforme un tableau en une seule valeur : ici la somme, en partant de 0. La division par <code>notes.length</code> donne la moyenne. La fonction reste correcte pour n\'importe quel tableau non vide.',
            'explainDarija' => '<code>reduce</code> kat7ewel tableau l valeur wa7da : hna somme, b bidaya 0. Division 3la <code>notes.length</code> kat3ti moyenne. Fonction katbqa s7i7a l ay tableau ma khawich.',
        ],
    ],
];
