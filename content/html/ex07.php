<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex07.php
 */

return array (
  'id' => 'html-ex7',
  'title' => 'Formulaires',
  'brief' => 'Créer des formulaires accessibles et validés.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — champ et bouton',
      'lang' => 'html',
      'instructions' => '<p>Crée un formulaire <code>form</code> avec un <code>label</code> lié à un <code>input type="text"</code> par <code>for</code>/<code>id</code>, et un bouton <code>submit</code>.</p>',
      'instructionsDarija' => '<p>5leq formulaire <code>form</code> b <code>label</code> mrbout b <code>input type="text"</code> b <code>for</code>/<code>id</code>, w bouton <code>submit</code>.</p>',
      'starter' => '<form>
  <!-- label et input -->
  <!-- bouton -->
</form>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<form',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<label',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'type="submit"',
        ),
      ),
      'hints' => 
      array (
        0 => 'Le for du label doit correspondre à l\'id de l\'input.',
        1 => 'Un bouton dans un form soumet par défaut.',
      ),
      'solution' => '<form method="post">
  <label for="nom">Nom</label>
  <input type="text" id="nom" name="nom" required>
  <button type="submit">Envoyer</button>
</form>',
      'explainFr' => 'Le label cliquable améliore l\'accessibilité ; required empêche l\'envoi vide côté navigateur.',
      'explainDarija' => 'Label li y9der ytcliqua kay7sen accessibilité ; required kaymna3 envoi khawi f navigateur.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — types de champs',
      'lang' => 'html',
      'instructions' => '<p>Ajoute un champ <code>email</code>, un champ <code>password</code>, une liste <code>select</code> avec deux <code>option</code> et une <code>textarea</code>.</p>',
      'instructionsDarija' => '<p>Zid champ <code>email</code>, champ <code>password</code>, liste <code>select</code> b jouj <code>option</code> w <code>textarea</code>.</p>',
      'starter' => '<form>
  <!-- email, password -->
  <!-- select -->
  <!-- textarea -->
</form>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => 'type="email"',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => 'type="password"',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => '<select',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => '<textarea',
        ),
      ),
      'hints' => 
      array (
        0 => 'Chaque champ doit avoir un name pour être envoyé.',
        1 => 'textarea n\'utilise pas l\'attribut value.',
      ),
      'solution' => '<form method="post">
  <label for="email">Email</label>
  <input type="email" id="email" name="email" required>
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="mdp" required>
  <label for="filiere">Filière</label>
  <select id="filiere" name="filiere">
    <option value="gi">GI</option>
    <option value="gc">GC</option>
  </select>
  <label for="message">Message</label>
  <textarea id="message" name="message"></textarea>
</form>',
      'explainFr' => 'Les types email et password déclenchent des comportements natifs (validation, masquage). select et textarea complètent le formulaire.',
      'explainDarija' => 'Types email w password kaytf3lo comportements natifs (validation, masquage). select w textarea kaykmmlo formulaire.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — formulaire accessible complet',
      'lang' => 'html',
      'instructions' => '<p>Complète le formulaire avec un <code>fieldset</code>, une <code>legend</code>, un <code>input type="checkbox"</code> avec son label, et un <code>input type="number" min="16" max="99"</code>.</p>',
      'instructionsDarija' => '<p>Kmml formulaire b <code>fieldset</code>, <code>legend</code>, <code>input type="checkbox"</code> m3a label dyalo, w <code>input type="number" min="16" max="99"</code>.</p>',
      'starter' => '<form>
  <!-- groupe -->
</form>',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'html_contains',
          'value' => '<fieldset',
        ),
        1 => 
        array (
          'type' => 'html_contains',
          'value' => '<legend',
        ),
        2 => 
        array (
          'type' => 'html_contains',
          'value' => 'type="checkbox"',
        ),
        3 => 
        array (
          'type' => 'html_contains',
          'value' => 'min="16"',
        ),
      ),
      'hints' => 
      array (
        0 => 'fieldset regroupe des champs liés.',
        1 => 'La legend décrit le groupe.',
      ),
      'solution' => '<form method="post">
  <fieldset>
    <legend>Informations personnelles</legend>
    <label for="age">Âge</label>
    <input type="number" id="age" name="age" min="16" max="99">
    <label>
      <input type="checkbox" name="conditions" required>
      J\'accepte les conditions
    </label>
  </fieldset>
  <button type="submit">Valider</button>
</form>',
      'explainFr' => 'fieldset/legend structurant le formulaire pour les lecteurs d\'écran ; min/max bornent la saisie numérique.',
      'explainDarija' => 'fieldset/legend kaynademo formulaire l lecteurs d\'écran ; min/max kay7eddo saisie numérique.',
    ),
  ),
);
