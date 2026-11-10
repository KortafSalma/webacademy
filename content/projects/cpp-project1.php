<?php

declare(strict_types=1);

/**
 * PROJET C++ 1 — Premier programme et compilation
 * Parcours C++ : chapitre 1
 */

return [
    'id'        => 'cpp-proj1',
    'title'     => 'Premier programme C++ et compilation locale',
    'level'     => 'Niveau : chapitre 1 du parcours C++',
    'lang'      => 'cpp',
    'course'    => 'cpp',
    'objective' => '<p>Écrire un programme C++ complet, le compiler avec <code>g++</code> et exécuter le résultat. Découvrir le cycle entrée → traitement → sortie.</p>',
    'steps' => [
        [
            'title'   => 'Écrire le code',
            'explain' => '<p>Utilisez l\'exemple du chapitre 1 comme point de départ. Le programme doit contenir <code>#include <iostream></code>, la fonction <code>int main()</code> et une instruction <code>std::cout</code>.</p>',
            'darija'  => '<p>Kteb code b model chapitre 1 kay start. Programme fih <code>#include <iostream></code>, fonction <code>int main()</code> w instruction <code>std::cout</code>.</p>',
            'lang'    => 'cpp',
            'file'    => 'main.cpp',
            'code'    => '#include <iostream>\n\nint main() {\n    std::cout << \"Salam, C++ !\" << std::endl;\n    return 0;\n}',
            'check'   => 'Vérifié statiquement : présence de #include <iostream>, int main, std::cout, Salam, return 0.',
        ],
        [
            'title'   => 'Compiler avec g++',
            'explain' => '<p>Ouvrez un terminal (Linux/macOS : <code>g++ -std=c++17 main.cpp -o main</code> ; Windows PowerShell : <code>g++ -std=c++17 main.cpp -o main.exe</code>). Ensuite exécutez : <code>./main</code> ou <code>.\\\\main.exe</code>.</p>',
            'darija'  => '<p>Tlha terminal (Linux/macOS : <code>g++ -std=c++17 main.cpp -o main</code> ; Windows PowerShell : <code>g++ -std=c++17 main.cpp -o main.exe</code>). Mn ba3d : <code>./main</code> wla <code>.\\\\main.exe</code>.</p>',
            'lang'    => 'text',
            'file'    => 'Compilez avec g++',
            'code'    => 'g++ -std=c++17 main.cpp -o main\n./main        # Linux / macOS\n.\\\\main.exe   # Windows',
            'check'   => 'Aucune erreur de compilation affichée.',
        ],
        [
            'title'   => 'Vérifier le résultat',
            'explain' => '<p>Le programme doit afficher <code>Salam, C++ !</code> suivi d\'un retour à la ligne. Si le résultat est différent, vérifiez la présence de <code>std::endl</code> et l\'orthographe du texte.</p>',
            'darija'  => '<p>Programme kat3red <code>Salam, C++ !</code> b fin de ligne. Ila resultat ma t7awach, checki <code>std::endl</code> w orthographe du texte.</p>',
            'lang'    => 'text',
            'file'    => 'Exécution',
            'code'    => 'Salam, C++ !',
            'check'   => 'La sortie contient « Salam, C++ ! ».',
        ],
    ],
];