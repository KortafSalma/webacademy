<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz10.php
 */

return array (
  'title' => 'Quiz — La propriété position',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle position sort l\'élément du flux et le place par rapport à un parent positionné ?',
      'options' => 
      array (
        0 => 'absolute',
        1 => 'relative',
        2 => 'static',
      ),
      'answer' => 0,
      'concept' => 'position: absolute',
      'explainFr' => '<code>absolute</code> sort du flux et se repère sur le premier ancêtre positionné.',
      'explainDarija' => '<code>absolute</code> kaykhrej men flux w kayt7et 3la awwel ancêtre positionné.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'position: fixed reste collé à la fenêtre pendant le défilement.',
      'answer' => 0,
      'concept' => 'position: fixed',
      'explainFr' => 'Vrai : <code>fixed</code> se positionne par rapport à la fenêtre, pas au document.',
      'explainDarija' => 'S7i7 : <code>fixed</code> kayt7et 3la 7sab fenêtre, machi document.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle position décale l\'élément sans le retirer du flux ?',
      'options' => 
      array (
        0 => 'relative',
        1 => 'absolute',
        2 => 'fixed',
      ),
      'answer' => 0,
      'concept' => 'position: relative',
      'explainFr' => '<code>relative</code> conserve la place d\'origine et décale visuellement l\'élément.',
      'explainDarija' => '<code>relative</code> kay7fed blasa d\'origine w kay7wel élément visuellement.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La propriété qui contrôle l\'ordre des calques est ________.',
      'answer' => 'z-index',
      'concept' => 'z-index',
      'explainFr' => '<code>z-index</code> fonctionne sur les éléments positionnés et décide qui passe devant.',
      'explainDarija' => '<code>z-index</code> kaykhdem 3la éléments positionnés w kay9arrer chkoun kaydowez qddam.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel parent sert de repère à un enfant positionné en absolute ?',
      'options' => 
      array (
        0 => 'Un parent avec position relative (ou non static)',
        1 => 'Un parent en position static',
        2 => 'Un parent sans aucune propriété',
      ),
      'answer' => 0,
      'concept' => 'Bloc conteneur',
      'explainFr' => 'L\'enfant <code>absolute</code> se réfère au premier ancêtre dont la position n\'est pas <code>static</code>.',
      'explainDarija' => 'Enfant <code>absolute</code> kayt7et 3la awwel ancêtre li position dyalo machi <code>static</code>.',
    ),
    5 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle position se comporte comme relative jusqu\'à un seuil de défilement, puis comme fixed ?',
      'options' => 
      array (
        0 => 'sticky',
        1 => 'static',
        2 => 'absolute',
      ),
      'answer' => 0,
      'concept' => 'position: sticky',
      'explainFr' => '<code>sticky</code> reste dans le flux et se fige au seuil indiqué par <code>top</code>, <code>bottom</code>, etc.',
      'explainDarija' => '<code>sticky</code> kaybqa f flux w kaytsgeb 3nd seuil li kay3tih <code>top</code>, <code>bottom</code>, etc.',
    ),
  ),
);
