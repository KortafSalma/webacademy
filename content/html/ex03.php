<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex03.php
 */

return array (
  'id' => 'html-ex3',
  'title' => 'Balises de texte et mise en valeur',
  'brief' => 'Structurer et mettre en valeur le contenu textuel.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — gras et italique',
      'lang' => 'html',
      'instructions' => '<p>Écris un paragraphe contenant un mot en <strong>gras</strong> avec <code>strong</code> et un mot en <em>italique</em> avec <code>em</code>.</p>',
      'instructionsDarija' => '<p>Kteb paragraphe fih kelma b <strong>gras</strong> b <code>strong</code> w kelma b <em>italique</em> b <code>em</code>.</p>',
      'starter' => '<p>Le HTML est un langage de <!-- gras --> et de <!-- italique -->.</p>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<strong>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<em>',
        ),
      ),
      'hints' => 
      array (
        0 => 'strong indique une importance forte.',
        1 => 'em indique une emphase, pas seulement un style.',
      ),
      'solution' => '<p>Le HTML est un langage de <strong>balisage</strong> et non de <em>programmation</em>.</p>',
      'explainFr' => 'strong et em portent un sens : importance et emphase. Le navigateur les affiche en gras et italique par défaut.',
      'explainDarija' => 'strong w em 3ndhom ma3na : importance w emphase. Navigateur kay3redhom gras w italique b défaut.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — code, citation, abréviation',
      'lang' => 'html',
      'instructions' => '<p>Ajoute : un extrait de code avec <code>code</code>, une citation avec <code>blockquote</code>, et une abréviation avec <code>abbr title="..."</code>.</p>',
      'instructionsDarija' => '<p>Zid : extrait de code b <code>code</code>, citation b <code>blockquote</code>, w abréviation b <code>abbr title="..."</code>.</p>',
      'starter' => '<p>Utilisez <!-- code --> pour le code.</p>
<!-- citation -->
<p><!-- abréviation --></p>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<code>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<blockquote>',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<abbr',
        ),
      ),
      'hints' => 
      array (
        0 => 'abbr prend un attribut title avec la signification.',
        1 => 'blockquote est une citation de bloc.',
      ),
      'solution' => '<p>Utilisez <code>echo</code> pour afficher du texte.</p>
<blockquote>Le code est lu bien plus souvent qu\'il n\'est écrit.</blockquote>
<p><abbr title="HyperText Markup Language">HTML</abbr> structure la page.</p>',
      'explainFr' => 'Chaque balise apporte une sémantique : code pour un extrait technique, blockquote pour une citation, abbr pour une abréviation explicable.',
      'explainDarija' => 'Kol balise kat3ti sémantique : code l extrait technique, blockquote l citation, abbr l abréviation mfessra.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — article complet',
      'lang' => 'html',
      'instructions' => '<p>Écris un court article avec un <code>h2</code>, deux paragraphes, un mot en <code>mark</code>, une <code>hr</code> et une <code>small</code> en fin d\'article.</p>',
      'instructionsDarija' => '<p>Kteb article qsir b <code>h2</code>, jouj paragraphes, kelma b <code>mark</code>, <code>hr</code> w <code>small</code> f l\'akhir.</p>',
      'starter' => '<article>
  <h2>Titre</h2>
  <!-- paragraphes -->
</article>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<article>',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<mark>',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<hr>',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '<small>',
        ),
      ),
      'hints' => 
      array (
        0 => 'mark surligne une information pertinente.',
        1 => 'small convient aux mentions légales.',
      ),
      'solution' => '<article>
  <h2>Apprendre le HTML</h2>
  <p>Le HTML décrit la <mark>structure</mark> d\'une page.</p>
  <p>Il ne gère ni les couleurs ni les animations.</p>
  <hr>
  <small>Article publié en 2026.</small>
</article>',
      'explainFr' => 'L\'article regroupe un contenu autonome ; mark attire l\'attention, hr sépare et small réduit l\'importance visuelle.',
      'explainDarija' => 'Article kayjem3 contenu mstqel ; mark kayjbed attention, hr kayfre9 w small kaynqes importance visuelle.',
    ),
  ),
);
