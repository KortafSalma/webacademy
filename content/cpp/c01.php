<?php

declare(strict_types=1);

/**
 * PARCOURS C++ — Chapitre 1 : Qu'est-ce que programmer ?
 * Modèle de qualité pour les 30 chapitres du parcours.
 */

return [
    'id'       => 'cpp-ch1',
    'title'    => 'Qu\'est-ce que programmer ?',
    'subtitle' => 'Comprendre ce que fait réellement un programme avant d\'écrire la première ligne de C++.',
    'level'    => 'Débutant',
    'minutes'  => 35,
    'prerequisites' => ['Aucun — ce chapitre est le point de départ du parcours'],

    'objectives' => [
        'Expliquer avec ses propres mots ce qu\'est un programme.',
        'Distinguer un problème, un algorithme et un programme.',
        'Comprendre le rôle du processeur, de la mémoire et du compilateur.',
        'Reconnaître la structure minimale d\'un programme C++.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'resoudre-un-probleme',
            'title' => 'Programmer, c\'est résoudre un problème',
            'icon'  => '🧭',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><strong>Programmer</strong>, ce n\'est pas « taper du code ». C\'est d\'abord <strong>comprendre un problème</strong>, le découper en étapes simples, puis traduire ces étapes dans un langage que la machine comprend. Le code n\'est que la dernière étape.</p><p>Exemple concret : préparer un thé. Personne n\'écrit « faire du thé » à un robot. On lui donne une suite d\'actions précises : remplir la bouilloire, chauffer l\'eau, mettre le thé dans la tasse, verser l\'eau, attendre trois minutes. Cette suite d\'actions, c\'est déjà un <strong>algorithme</strong>.</p>',
                 'darija' => '<p>Programmer machi ghir « kteb code ». Programmer kat3ni tfehm l problème, tqasmo l étapes sghar, w mn ba3d tkteb had étapes b lougha li l\'ordinateur kayfhem. Code howa ghir l\'étape l\'akhira.</p><p>Chouf mital dyal atay : ma-tgoulch l robot « dir atay ». Kat3tih étapes : 3mer bouilloire, skhen l\'ma, dir atay f kass, keb l\'ma, tsennar 3 minutes. Had étapes hiya <b>algorithme</b>.</p>'],

                ['type' => 'definition', 'title' => 'Algorithme',
                 'fr'   => '<p>Un <strong>algorithme</strong> est une suite finie d\'instructions claires, ordonnées et non ambiguës qui permet de résoudre un problème. Il doit produire un résultat en un nombre fini d\'étapes.</p>',
                 'darija' => '<p><b>Algorithme</b> howa suite d\'instructions wad7in, mrattbin, w ma-fihomch ambiguïté, li kat7el problème f nombre mahdoud d\'étapes. Ya3ni : khtwa b khtwa, bla khlat.</p>'],

                ['type' => 'syntax',
                 'lang' => 'text',
                 'title' => 'Algorithme du thé (en français structuré)',
                 'code' => "DÉBUT
  Remplir la bouilloire avec de l'eau
  Allumer la bouilloire
  TANT QUE l'eau ne bout pas
      Attendre
  FIN TANT QUE
  Mettre le thé dans la tasse
  Verser l'eau chaude
  Attendre 3 minutes
  Servir
FIN"],

                ['type' => 'tip',
                 'title' => 'Penser avant de coder',
                 'fr'   => 'Un programmeur expérimenté passe souvent plus de temps à réfléchir et à dessiner les étapes qu\'à taper du code. Si l\'algorithme est clair, le code C++ se écrit presque tout seul.',
                 'darija' => 'Programmeur m7taref kaydwz wa9t ktar f tafkir w rasm l\'étapes 3la ma kaykteb code. Ila algorithme kan wad7, code C++ kayji sahel bzaf.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'entree-traitement-sortie',
            'title' => 'Entrée, traitement, sortie',
            'icon'  => '🧩',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Presque tous les programmes suivent le même schéma : ils reçoivent des <strong>entrées</strong>, effectuent un <strong>traitement</strong>, puis produisent une <strong>sortie</strong>. Une calculatrice reçoit deux nombres et un opérateur, calcule, puis affiche le résultat. Un site web reçoit une requête, interroge la base de données, puis renvoie une page HTML.</p>',
                 'darija' => '<p>Qrib kol programme kaykhdem b nefs tariqa : kayakhod <b>entrées</b>, kaydir <b>traitement</b>, w kay3ti <b>sortie</b>. Calculatrice katakhod jouj nombres w opérateur, kat7seb, w kat3red résultat. Site web kayakhod requête, kayqelleb f base de données, w kaysift page HTML.</p>'],

                ['type' => 'table',
                 'headers' => ['Étape', 'Calculatrice', 'Programme C++'],
                 'rows' => [
                     ['Entrée', 'Les deux nombres tapés', 'Valeurs lues avec std::cin'],
                     ['Traitement', 'Addition, multiplication…', 'Instructions et calculs'],
                     ['Sortie', 'Le résultat à l\'écran', 'Affichage avec std::cout'],
                 ],
                 'fr' => 'Le modèle entrée → traitement → sortie permet de découper n\'importe quel programme en trois questions : que reçoit-il ? que fait-il ? que montre-t-il ?'],

                ['type' => 'warning',
                 'title' => 'L\'ordinateur ne devine rien',
                 'fr'   => 'Une machine exécute <strong>exactement</strong> ce qu\'on lui demande, même si c\'est absurde. Si vous oubliez une étape, elle ne la inventera pas. Si vous inversez deux étapes, le résultat sera faux. La précision est la qualité numéro un du programmeur.',
                 'darija' => 'L\'ordinateur kaynfed <b>bi dqiq</b> dakchi li kteb 3lih, 7tta ila kan ma3qolch. Ila nsiti étape, ma ghadi ykhtar3hach. Ila bdelti tartib, résultat ghadi ykoun ghalat. Dqiq hiya l qualité raqm wa7ed dyal programmeur.'],

                ['type' => 'example',
                 'title' => 'Un premier aperçu de C++',
                 'lang'  => 'cpp',
                 'code'  => '#include <iostream>

int main() {
    int a = 7;
    int b = 5;
    int somme = a + b;

    std::cout << "La somme vaut " << somme << std::endl;
    return 0;
}',
                 'output' => 'La somme vaut 12',
                 'explainFr' => 'Les lignes 4 et 5 sont les <strong>entrées</strong> (deux valeurs fixes ici), la ligne 6 est le <strong>traitement</strong>, la ligne 8 la <strong>sortie</strong>. <code>return 0;</code> signale que le programme s\'est terminé correctement.',
                 'explainDarija' => 'Lignes 4 w 5 homa <b>entrées</b> (hna valeurs thabta), ligne 6 hiya <b>traitement</b>, w ligne 8 hiya <b>sortie</b>. <code>return 0;</code> kat3ni programme sali b kheer.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'langage-machine',
            'title' => 'Langage machine et langage de haut niveau',
            'icon'  => '⚙️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Le processeur ne comprend que des <strong>instructions binaires</strong> : des suites de 0 et de 1. Écrire directement ces instructions est presque impossible à grande échelle. On utilise donc un <strong>langage de haut niveau</strong> comme C++, lisible par l\'humain, puis un <strong>compilateur</strong> traduit ce code en langage machine.</p><p>C++ est un langage <strong>compilé</strong> : avant d\'exécuter le programme, il faut le traduire en un fichier exécutable. C\'est différent de JavaScript, qui est généralement interprété par le navigateur au moment de l\'exécution.</p>',
                 'darija' => '<p>Processeur kayfhem ghir <b>instructions binaires</b> : 0 w 1. Bach tkteb had instructions b yeddek rah presque mostahil f les grands programmes. 3lach kanekhdmo b <b>langage de haut niveau</b> b7al C++, li kayqrah l\'insan, w mn ba3d <b>compilateur</b> kayterjem code l langage machine.</p><p>C++ langage <b>compilé</b> : qbel ma tkhdem programme, khassek tterjmo l fichier exécutable. Hadchi mkhtalef 3la JavaScript li l navigateur kayqrah w kaynfdo f wa9t l\'exécution.</p>'],

                ['type' => 'table',
                 'headers' => ['Niveau', 'Exemple', 'Qui le comprend ?'],
                 'rows' => [
                     ['Langage machine', '10110000 01100001', 'Le processeur uniquement'],
                     ['Assembleur', 'mov al, 61h', 'Programmeur très spécialisé'],
                     ['C++', 'std::cout << "Salam";', 'Un être humain formé'],
                     ['JavaScript', 'console.log("Salam");', 'Un être humain formé'],
                 ],
                 'fr' => 'Plus le langage est haut niveau, plus il est proche de la pensée humaine et plus le compilateur travaille pour vous.',
                ],

                 ['type' => 'definition', 'title' => 'Compilation',
                 'fr'   => '<p><strong>Compiler</strong>, c\'est traduire un fichier source (<code>.cpp</code>) en un programme exécutable pour une machine donnée. Le compilateur vérifie aussi la syntaxe : une virgule oubliée bloque la compilation avant même l\'exécution.</p>',
                 'darija' => '<p><b>Compiler</b> kat3ni tterjem fichier source (<code>.cpp</code>) l programme exécutable. Compilateur kayverifi 7tta syntaxe : ila nsiti virgule, compilation kat7bes qbel ma ykhdem programme.</p>'],

                ['type' => 'example',
                 'title' => 'Le plus petit programme C++ utile',
                 'lang'  => 'cpp',
                 'code'  => '#include <iostream>

int main() {
    std::cout << "Salam, C++ !" << std::endl;
    return 0;
}',
                 'output' => 'Salam, C++ !',
                 'explainFr' => '<code>#include &lt;iostream&gt;</code> importe les outils d\'entrée/sortie. <code>int main()</code> est le point de départ obligatoire du programme. <code>std::cout</code> affiche du texte. <code>return 0;</code> termine <code>main</code> avec le code de succès 0.',
                 'explainDarija' => '<code>#include &lt;iostream&gt;</code> kayjib les outils d\'entrée/sortie. <code>int main()</code> howa l point d\'entrée obligatoire. <code>std::cout</code> kay3red texte. <code>return 0;</code> kaysali <code>main</code> b code de succès 0.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'parcours',
            'title' => 'Ce que vous allez apprendre',
            'icon'  => '🗺️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Ce parcours compte <strong>30 chapitres</strong> regroupés en six modules progressifs. Vous commencerez par installer les outils et écrire un « Hello World », puis vous découvrirez les variables, les conditions, les boucles, les fonctions, les tableaux, les pointeurs et enfin la programmation orientée objet et la bibliothèque standard.</p><p>Chaque chapitre contient des explications en français et en darija, des exemples complets, six exercices corrigés et un quiz de dix questions. Les exercices C++ sont vérifiés <strong>statiquement</strong> : pour tester le comportement réel, vous compilerez sur votre machine avec <code>g++</code>.</p>',
                 'darija' => '<p>Had parcours fih <b>30 chapitre</b> mqassmin 3la 6 modules. Ghadi tbda b installation w « Hello World », mn ba3d variables, conditions, boucles, fonctions, tableaux, pointeurs, w f l\'akhir POO w STL.</p><p>Kol chapitre fih explications b français w darija, exemples kamlin, 6 exercices m3a correction, w quiz dyal 10 questions. Exercices C++ kaytverifaw <b>statiquement</b> : bach ttesti comportement réel, compile b <code>g++</code> f PC dyalek.</p>'],

                ['type' => 'keywords',
                 'title' => 'Les mots à retenir dès maintenant',
                 'items' => [
                     ['kw' => 'Programme', 'fr' => 'Suite d\'instructions exécutées par une machine.', 'darija' => 'Suite d\'instructions li machine katnfedhom.'],
                     ['kw' => 'Algorithme', 'fr' => 'Méthode ordonnée de résolution d\'un problème.', 'darija' => 'Tariqa mrattba bach t7el problème.'],
                     ['kw' => 'Compilateur', 'fr' => 'Programme qui traduit le code source en exécutable.', 'darija' => 'Programme li kayterjem code source l exécutable.'],
                     ['kw' => 'main()', 'fr' => 'Fonction de départ de tout programme C++.', 'darija' => 'Fonction li mnha kaybda kol programme C++.'],
                 ],
                 'fr' => 'Ces quatre mots reviendront dans presque chaque chapitre. Il n\'est pas nécessaire de les mémoriser par cœur : ils deviendront naturels avec la pratique.'],

                ['type' => 'note',
                 'title' => 'Une progression honnête',
                 'fr'   => 'Aucun chapitre ne suppose de connaissances cachées. Si un concept dépend d\'un chapitre précédent, il est indiqué dans les prérequis. Prenez le temps de faire les exercices : lire sans pratiquer donne l\'illusion de comprendre.',
                 'darija' => 'Walou chapitre ma kayftared 3lik ma3rifa mkhfiya. Ila concept kay3tamed 3la chapitre qbel, ghadi tlkrah f prérequis. Khod wa9t f exercices : ghir lecture bla pratique kat3tik l\'illusion belli fhemti.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Commencer à taper du code sans avoir compris le problème',
            'fix'    => 'Écrire d\'abord les étapes en français, puis les traduire en C++',
            'fr'     => 'Sans algorithme clair, on écrit du code au hasard et on corrige des erreurs en cascade. Cinq minutes de réflexion économisent une heure de débogage.',
            'darija' => 'Bla algorithme wad7, katkteb code b chouiya w katseleh erreurs wa7d mn ba3d l\'akhor. 5 minutes dyal tafkir kayweqfou sa3a dyal débogage.',
        ],
        [
            'wrong'  => 'Croire que l\'ordinateur comprend le français',
            'fix'    => 'Utiliser uniquement la syntaxe exacte du langage',
            'fr'     => 'Une machine ne devine ni les intentions ni les mots approximatifs. En C++, chaque point-virgule, chaque accolade et chaque type compte.',
            'darija' => 'Machine ma katkhtar3ch l\'intention wla les mots approximatifs. F C++, kol point-virgule, kol accolade w kol type kay7seb.',
        ],
        [
            'wrong'  => 'Confondre compiler et exécuter',
            'fix'    => 'Compiler avec g++, puis lancer le fichier exécutable produit',
            'fr'     => 'La compilation traduit le code ; elle ne l\'exécute pas. Il faut ensuite lancer le binaire (<code>./main</code> ou <code>main.exe</code>).',
            'darija' => 'Compilation kat3ni tarjama dyal code, machi exécution. Mn ba3d khassek tlanci binaire (<code>./main</code> wla <code>main.exe</code>).',
        ],
    ],

    'summary' => [
        'fr'     => 'Programmer consiste à <b>comprendre un problème</b>, le décomposer en un <b>algorithme</b>, puis traduire cet algorithme dans un langage. Tout programme suit le schéma <b>entrée → traitement → sortie</b>. C++ est un langage <b>compilé</b> : le compilateur traduit le fichier <code>.cpp</code> en exécutable, et <code>main()</code> est le point de départ. Les 30 chapitres du parcours vous mèneront des bases jusqu\'à la POO et à la STL.',
        'darija' => 'Programmer kat3ni tfehm l problème, tqasmo l <b>algorithme</b>, w tterjmo l lougha. Kol programme kaykhdem b <b>entrée → traitement → sortie</b>. C++ langage <b>compilé</b> : compilateur kayterjem <code>.cpp</code> l exécutable, w <code>main()</code> howa l point d\'entrée. 30 chapitre ghadi ywslouk mn les bases 7tta l POO w STL.',
    ],
];
