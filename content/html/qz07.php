<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz07.php
 */

return array (
  'title' => 'Quiz — Formulaires',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment lier un label à son champ ?',
      'options' => 
      array (
        0 => 'for du label = id du champ',
        1 => 'name du label = name du champ',
        2 => 'class identique',
      ),
      'answer' => 0,
      'concept' => 'Label',
      'explainFr' => 'L\'attribut <code>for</code> référence l\'<code>id</code> du champ, ce qui rend le label cliquable.',
      'explainDarija' => 'Attribut <code>for</code> kay3ayet l <code>id</code> dyal champ, hakka label kaywli cliquable.',
    ),
    1 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel type de champ masque la saisie ?',
      'options' => 
      array (
        0 => 'password',
        1 => 'text',
        2 => 'email',
      ),
      'answer' => 0,
      'concept' => 'password',
      'explainFr' => '<code>type="password"</code> masque les caractères à l\'écran.',
      'explainDarija' => '<code>type="password"</code> kaykhbi caractères f écran.',
    ),
    2 => 
    array (
      'type' => 'tf',
      'question' => 'L\'attribut required empêche l\'envoi d\'un champ vide.',
      'answer' => 0,
      'concept' => 'required',
      'explainFr' => 'Vrai côté navigateur, mais la validation serveur reste obligatoire.',
      'explainDarija' => 'S7i7 f navigateur, walakin validation f serveur katbqa darouriya.',
    ),
    3 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle balise crée une liste déroulante ?',
      'options' => 
      array (
        0 => '<select>',
        1 => '<input type="list">',
        2 => '<datalist>',
      ),
      'answer' => 0,
      'concept' => 'select',
      'explainFr' => '<code>select</code> contient des <code>option</code> ; <code>datalist</code> propose des suggestions.',
      'explainDarija' => '<code>select</code> fih <code>option</code> ; <code>datalist</code> kay3ti suggestions.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Quel attribut envoie la valeur du champ au serveur ?',
      'options' => 
      array (
        0 => 'name',
        1 => 'id',
        2 => 'placeholder',
      ),
      'answer' => 0,
      'concept' => 'name',
      'explainFr' => 'Sans <code>name</code>, la valeur n\'est pas incluse dans les données soumises.',
      'explainDarija' => 'Bla <code>name</code>, valeur ma katdkhelch f données li kaysifthom.',
    ),
  ),
);
