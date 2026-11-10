<?php

declare(strict_types=1);

/**
 * MODULE PHP — Chapitre 1 : Introduction à PHP
 * Format identique à content/html/c01.php.
 */

return [
    'id'       => 'php-ch1',
    'title'    => 'Introduction à PHP',
    'subtitle' => 'C\'est quoi PHP, où il s\'exécute, et comment écrire ton premier script ?',

    'objectives' => [
        'Comprendre ce qu\'est PHP et pourquoi c\'est un langage serveur.',
        'Comprendre le mécanisme : navigateur, serveur, résultat HTML.',
        'Installer un environnement local : XAMPP, WAMP ou Laragon.',
        'Écrire ton premier script : echo "Salam !" avec la syntaxe de base.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'quest-ce-que-php',
            'title' => 'C\'est quoi PHP ?',
            'icon'  => '🐘',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><strong>PHP</strong> (Hypertext Preprocessor) est un langage de <strong>programmation</strong> créé en 1995. À la différence de HTML et CSS qui sont simplement <em>affichés</em> par le navigateur, PHP contient une vraie logique : conditions, boucles, fonctions, calculs.</p><p><strong>PHP est un langage côté serveur</strong> : ton code n\'est jamais exécuté dans le navigateur. C\'est le <strong>serveur</strong> qui lit le fichier <code>.php</code>, exécute le code, puis renvoie le résultat — généralement du HTML. Le visiteur ne voit jamais ton code PHP.</p><p>PHP alimente des millions de sites : Facebook à ses débuts, Wikipédia, WordPress (plus de 40 % du web) et la plupart des sites e-commerce.</p>',
                 'darija' => '<p>PHP howa langage de programmation : fih if, boucles, fonctions w calculs — machi b7al HTML li ghir katrahow la page. PHP kaykhdem ghir f <b>serveur</b> : le serveur kayqra fichier .php, kaynfedh le code, w kayseft lik le résultat (généralement HTML). Hadchi 3lach ila dert inspecteur 3la page, ma-tchofch 3omrek le code PHP. Wikipédia, WordPress w bzaf dyal les sites kaykhdmo b PHP.</p>'],

                ['type' => 'definition', 'title' => 'Langage serveur (server-side)',
                 'fr'   => '<p>Le navigateur commande un plat (requête HTTP) ; le serveur le <strong>prépare</strong> en exécutant le code PHP ; puis il envoie le plat déjà prêt (le HTML).<br><strong>Conséquence :</strong> le navigateur n\'interprète jamais PHP — il reçoit le HTML fini.</p>',
                 'darija' => '<p>Le navigateur kaytalb, le serveur kaynfedh le code PHP w kaywajed la page, w kayseft le HTML wajed. Navigateur ma-kayfhem-ch PHP : kayporta ghir le HTML li wajed.</p>'],

                ['type' => 'table',
                 'headers' => ['Technologie', 'Où ça s\'exécute', 'Son rôle'],
                 'rows' => [
                     ['HTML', 'Navigateur', 'Structure et contenu'],
                     ['CSS', 'Navigateur', 'Apparence'],
                     ['JavaScript', 'Navigateur', 'Interactions visibles'],
                     ['PHP', 'Serveur', 'Logique, calculs, traitements'],
                     ['SQL', 'Serveur (MySQL)', 'Lire / écrire les données'],
                    ],
                 'fr' => 'Le front-end s\'exécute dans le navigateur ; le back-end (PHP, SQL) s\'exécute sur le serveur, avant que la page arrive au visiteur.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'installation',
            'title' => 'Installer un serveur local',
            'icon'  => '🛠️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>PHP ne tourne pas tout seul : il faut un <strong>serveur</strong>. Pour travailler en local, on installe un pack qui regroupe Apache (serveur), MySQL (base de données) et PHP :</p><ul><li><strong>XAMPP</strong> : le plus connu, multi-plateforme (Windows, Linux, Mac), panneau de contrôle simple — idéal pour débuter.</li><li><strong>WAMP</strong> : l\'équivalent pour Windows, très répandu dans les universités marocaines.</li><li><strong>Laragon</strong> : moderne et très rapide, le favori des développeurs PHP.</li></ul><p><strong>Recommandation :</strong> XAMPP ou Laragon.</p>',
                 'darija' => '<p>PHP ma-ykhdemch wa7do : khassek serveur. Installe wa7d pack kayjm3 kolchi : <b>XAMPP</b> (mchhour, kaykhdem 3la Windows, Linux w Mac, sahel l débutants), <b>WAMP</b> (ghir l Windows, mchhour f le fac), wla <b>Laragon</b> (jdid w rapide bzaf). Conseil dyali : bda b XAMPP wla Laragon.</p>'],

                ['type' => 'warning',
                 'title' => 'Un .php ne s\'ouvre pas comme un .html !',
                 'fr'   => 'Double-cliquer sur un <code>.html</code> fonctionne, mais jamais sur un <code>.php</code> : sans serveur, le navigateur affiche le code brut ou télécharge le fichier. On passe toujours par <strong>localhost</strong>.',
                 'darija' => 'Double-click kaykhdem m3a .html, walakin machi m3a .php ! Khassek le code yenfedh f serveur : dkhel dima via <code>http://localhost/monsite/</code>.'],

                ['type' => 'syntax',
                 'lang' => 'text',
                 'title' => 'Où placer ses fichiers ?',
                 'code' => "XAMPP   -> C:\\xampp\\htdocs\\monsite\\   (dossier : htdocs)\nWAMP    -> C:\\wamp64\\www\\monsite\\      (dossier : www)\nLaragon -> C:\\laragon\\www\\monsite\\     (dossier : www)\n\nPuis dans le navigateur :\nhttp://localhost/monsite/"],

                ['type' => 'definition', 'title' => 'localhost',
                 'fr'   => '<p><strong>localhost</strong> (<code>http://localhost</code> ou <code>127.0.0.1</code>) signifie « cet ordinateur » : le navigateur demande la page à <em>ta propre machine</em>, qui joue le rôle de serveur grâce à Apache. Gratuit, privé, sans hébergement.</p>',
                 'darija' => '<p>localhost kat3ni "f had PC dyalek" : le navigateur ma-kaymchich 3la Internet, kaytalb men PC dyalek li wal serveur b Apache. Blach w privé.</p>'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'premier-script',
            'title' => 'Ton premier script PHP',
            'icon'  => '🎉',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un fichier PHP porte l\'extension <strong>.php</strong> (ex : <code>index.php</code>). Le code PHP est encadré par les balises <code>&lt;?php</code> … <code>?&gt;</code> : tout ce qui est entre les deux est <strong>exécuté</strong> par le serveur ; ce qui est dehors est envoyé tel quel, comme du simple HTML. L\'instruction pour afficher : <code>echo</code>.</p>',
                 'darija' => '<p>Fichier dyal PHP 3andou extension <b>.php</b>. Le code PHP dima bin jouj balises : <code>&lt;?php</code> bach ybda, <code>?&gt;</code> bach ysali. Li f wost kaynfedh f serveur ; li bara kayseft b7al HTML 3adi. W bach tafichi chi haja katkhdem b <code>echo</code>.</p>'],

                ['type' => 'example',
                 'title' => 'Salam PHP ! — ton premier echo',
                 'lang'  => 'php',
                 'code'  => '<?php
echo "Salam !";
?>',
                 'output' => 'Salam !',
                 'explainFr' => '<code>&lt;?php</code> ouvre le mode PHP, <code>echo</code> envoie « Salam ! » dans la sortie, <code>?&gt;</code> referme le bloc. Le navigateur n\'affiche que le texte.',
                 'explainDarija' => '<code>&lt;?php</code> kaybda le code, <code>echo</code> katbr "Salam !", w <code>?&gt;</code> kaysali. L\'utilisateur ytbra ghir le texte : le code PHP makhbi.'],

                ['type' => 'example',
                 'title' => 'PHP mélangé au HTML',
                 'lang'  => 'php',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Test PHP</title></head>
<body>
  <h1>Bienvenue</h1>
  <?php
    echo "<p>Cette phrase a été générée par PHP !</p>";
    echo "<p>Il est " . date("H:i") . "</p>";
  ?>
</body>
</html>',
                 'output' => '<h1>Bienvenue</h1> <p>Cette phrase a été générée par PHP !</p> <p>Il est 14:32</p>',
                 'explainFr' => 'Le HTML est envoyé tel quel ; chaque bloc <code>&lt;?php ?&gt;</code> est remplacé par le résultat de son <code>echo</code>. L\'heure est calculée au moment de la requête : c\'est ça un site dynamique.',
                 'explainDarija' => 'Le HTML kayseft kif howa, w kol bloc PHP kaytbladel b le résultat dyal echo dyalo. L\'heure katkhrej b l\'wa9t dyal daba : hadi hiya les pages dynamiques.'],

                ['type' => 'tip',
                 'title' => 'Ne pas fermer avec ?&gt;',
                 'fr'   => 'Dans un fichier qui contient <strong>uniquement PHP</strong>, la convention est de ne pas écrire le <code>?&gt;</code> final : ça évite d\'envoyer par erreur des espaces parasites.',
                 'darija' => 'Ila fichier fih ghir PHP, mafihach HTML aba3d, les pros ma-katbtiwhch <code>?&gt;</code> f l\'akhir. Hadi sunna bach matkhrejch errores zayda.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'syntaxe-base',
            'title' => 'Syntaxe de base',
            'icon'  => '📌',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les 4 règles que tu utiliseras dans chaque fichier :</p><ul><li><strong>Point-virgule :</strong> chaque instruction se termine par <code>;</code> — l\'oublier provoque un « Parse error » ;</li><li><strong>echo</strong> : affiche du texte, des nombres, du HTML…</li><li><strong>Commentaires :</strong> ignorés par le serveur, ils documentent ton code ;</li><li><strong>Casse :</strong> les <em>variables</em> sont sensibles à la casse : <code>$age</code> ≠ <code>$Age</code>.</li></ul>',
                 'darija' => '<p>Kol instruction khtama b <code>;</code> — ila nsahita : Parse error ! <code>echo</code> katkteb chi haja. Les commentaires le serveur ma-kaynafidhhomch : homa ghir l\'explication dyalek. W khoud belek : <code>$age</code> ma-hiya-ch <code>$Age</code> — les variables sensitive l majuscules.</p>'],

                ['type' => 'syntax',
                 'lang' => 'php',
                 'title' => 'Les trois styles de commentaires',
                 'code' => '<?php
// Commentaire sur UNE ligne (slash slash)

# Commentaire sur une ligne (dièse, même résultat)

/*
   Commentaire sur PLUSIEURS lignes.
   Pratique pour expliquer un bloc entier.
*/

echo "Le serveur ignore les commentaires";',
                 ],

                ['type' => 'example',
                 'title' => 'Toute la syntaxe de base en un seul script',
                 'lang'  => 'php',
                 'code'  => '<?php
// Premier script complet !
/* Ce script affiche une salutation
   et un petit calcul */
echo "Salam WebAcademy !";   // texte
echo "<br>";                 // HTML valide dans echo
echo 2026;                   // nombre
echo "<br>";
echo 10 + 5;                 // PHP calcule : 15
# fin du script
?>',
                 'output' => 'Salam WebAcademy !<br>2026<br>15',
                 'explainFr' => 'Chaque instruction finit par <code>;</code>. On peut afficher du texte, des nombres et des <em>calculs</em> : le serveur a calculé 10 + 5 et envoyé « 15 ».',
                 'explainDarija' => 'Kol instruction tamma b ;. Tqder tafichi texte, nombres, w 7tta les calculs : le serveur hesb 10 + 5 w seft 15.'],

                ['type' => 'table',
                 'headers' => ['Ce que tu écris (demo.php)', 'Ce que le navigateur reçoit'],
                 'rows' => [
                     ['&lt;h1&gt;Salam&lt;/h1&gt;', '&lt;h1&gt;Salam&lt;/h1&gt;'],
                     ['&lt;?php echo "&lt;p&gt;Etudiant&lt;/p&gt;"; ?&gt;', '&lt;p&gt;Etudiant&lt;/p&gt;'],
                     ['&lt;?php echo 7 * 8; ?&gt;', '56'],
                     ['&lt;?php // note interne ?&gt;', '(rien du tout)'],
                    ],
                 'fr' => 'Le navigateur ne reçoit <strong>jamais</strong> les balises &lt;?php, ni les variables, ni les commentaires : il reçoit seulement le <strong>résultat</strong>. PHP est « invisible » côté client. Cela conclut ce chapitre !'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Ouvrir index.php en double-cliquant dessus',
            'fix'    => 'Placer le fichier dans htdocs/www puis ouvrir http://localhost/...',
            'fr'     => 'Un fichier PHP a besoin d\'un <strong>serveur</strong> pour être exécuté. Sans serveur, le navigateur télécharge le fichier ou affiche du code brut.',
            'darija' => 'fichier .php ma-kaykhdemch b double-click b7al HTML : khassek serveur. Dir fichier f htdocs (XAMPP) w f navigateur : http://localhost/monsite/',
        ],
        [
            'wrong'  => 'echo "Salam !"   (sans point-virgule)',
            'fix'    => 'echo "Salam !";',
            'fr'     => 'Chaque instruction DOIT se terminer par un point-virgule. Sans lui : <em>Parse error: syntax error</em>.',
            'darija' => 'Point-virgule ; dima f l\\\'akhir dyal kol instruction ! Ila nsah : Parse error, page ma-kaybanch.',
        ],
        [
            'wrong'  => 'Écrire echo en dehors des balises ?&gt;',
            'fix'    => 'Encadrer chaque bloc de code par &lt;?php … ?&gt;',
            'fr'     => 'Le code doit être entre <code>&lt;?php</code> et <code>?&gt;</code>. Un echo écrit dehors est envoyé comme du simple texte.',
            'darija' => 'Le code PHP dima bin balises : &lt;?php … ?&gt;. Ila ktebt echo bara, kaytbra b7al texte normal — la page soolf.',
        ],
        [
            'wrong'  => 'Confondre $age et $Age',
            'fix'    => 'Toujours exactement le même nom et la même casse',
            'fr'     => 'Les noms de variables sont <strong>sensibles à la casse</strong> : <code>$age</code> et <code>$Age</code> sont deux variables différentes.',
            'darija' => '$age ma-hiya-ch $Age : PHP sensitive l majuscules w miniscules. Dima nefs smiya b nefs lekhot.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>PHP</b> est un langage de programmation exécuté <b>côté serveur</b> : le serveur lit le fichier .php, exécute le code et renvoie du HTML — le visiteur ne voit jamais le PHP. Pour développer en local on installe <b>XAMPP, WAMP ou Laragon</b> et on accède via <b>localhost</b>. Un script PHP vit entre <b>&lt;?php … ?&gt;</b>, chaque instruction finit par <b>;</b>, <b>echo</b> affiche un contenu, et les commentaires s\'écrivent <b>//</b>, <b>#</b> ou <b>/* … */</b>.',
        'darija' => 'PHP kaykhdem f serveur : l\'utilisateur ma-ychofch le code. Bach tkhdem f PC dyalek installe XAMPP wla Laragon w khtar la page via localhost. Le code PHP ybda b &lt;?php w ysali b ?&gt;, kol instruction tam b ;, w echo kat3ni "afichi hadi". Kolchi khdemti bih f had l\'introductionьян w safi !',
    ],
];
