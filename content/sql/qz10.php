<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz10.php
 */

return array (
  'title' => 'Quiz — Sous-requêtes',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Où peut-on placer une sous-requête scalaire ?',
      'options' => 
      array (
        0 => 'Dans un WHERE, en comparaison',
        1 => 'Uniquement dans ORDER BY',
        2 => 'Uniquement dans CREATE TABLE',
      ),
      'answer' => 0,
      'concept' => 'Sous-requête scalaire',
      'explainFr' => 'Une sous-requête qui renvoie une valeur peut être comparée dans un <code>WHERE</code>.',
      'explainDarija' => 'Sous-requête li katrje3 valeur t9der tqaren f <code>WHERE</code>.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'Une sous-requête peut renvoyer plusieurs lignes avec IN.',
      'answer' => 0,
      'concept' => 'IN',
      'explainFr' => 'Vrai : <code>WHERE id IN (SELECT ...)</code> accepte plusieurs valeurs.',
      'explainDarija' => 'S7i7 : <code>WHERE id IN (SELECT ...)</code> kayqbel bzaf valeurs.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quand utilise-t-on EXISTS ?',
      'options' => 
      array (
        0 => 'Pour tester si une sous-requête renvoie au moins une ligne',
        1 => 'Pour trier les résultats',
        2 => 'Pour créer un index',
      ),
      'answer' => 0,
      'concept' => 'EXISTS',
      'explainFr' => '<code>EXISTS</code> est vrai dès qu\'une ligne correspond.',
      'explainDarija' => '<code>EXISTS</code> kaywli vrai melli ligne wa7da kattmatch.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'Une sous-requête qui référence la requête externe est dite ________.',
      'answer' => 'corrélée',
      'concept' => 'Sous-requête corrélée',
      'explainFr' => 'Elle dépend de chaque ligne de la requête principale.',
      'explainDarija' => 'Katt3amed 3la kol ligne dyal requête principale.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment trouver la ligne de valeur maximale sans écrire la valeur en dur ?',
      'options' => 
      array (
        0 => 'WHERE valeur = (SELECT MAX(valeur) ...)',
        1 => 'ORDER BY valeur LIMIT 1 uniquement',
        2 => 'WHERE valeur > 0',
      ),
      'answer' => 0,
      'concept' => 'MAX en sous-requête',
      'explainFr' => 'La sous-requête calcule le maximum ; le filtre garde la ligne correspondante.',
      'explainDarija' => 'Sous-requête kat7seb maximum ; filtre kay7fed ligne li tmatch.',
    ),
  ),
);
