<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex04.php
 */

return array (
  'id' => 'sql-ex4',
  'title' => 'Contraintes',
  'brief' => 'Garantir l\'intégrité avec PRIMARY KEY, UNIQUE, CHECK et FOREIGN KEY.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — UNIQUE et NOT NULL',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>membre</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>email TEXT NOT NULL UNIQUE</code> et <code>nom TEXT NOT NULL</code>. Affiche ensuite la définition avec <code>SELECT sql FROM sqlite_master WHERE type = \'table\' AND name = \'membre\';</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>membre</code> b <code>id INTEGER PRIMARY KEY</code>, <code>email TEXT NOT NULL UNIQUE</code> w <code>nom TEXT NOT NULL</code>. 3red men ba3d définition b <code>SELECT sql FROM sqlite_master WHERE type = \'table\' AND name = \'membre\';</code>.</p>',
      'starter' => 'DROP TABLE IF EXISTS membre;

-- CREATE TABLE
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => 'UNIQUE',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'NOT NULL',
        ),
      ),
      'hints' => 
      array (
        0 => 'UNIQUE interdit deux valeurs identiques.',
        1 => 'NOT NULL impose une valeur.',
        2 => 'Les contraintes se déclarent après le type.',
      ),
      'solution' => 'DROP TABLE IF EXISTS membre;

CREATE TABLE membre (
    id INTEGER PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    nom TEXT NOT NULL
);

SELECT sql FROM sqlite_master WHERE type = \'table\' AND name = \'membre\';',
      'explainFr' => 'La contrainte <code>UNIQUE</code> empêche deux membres d\'avoir le même email, et <code>NOT NULL</code> garantit que l\'email et le nom sont toujours renseignés.',
      'explainDarija' => 'Contrainte <code>UNIQUE</code> kamna3 jouj membres ykouno 3ndhom nefs email, w <code>NOT NULL</code> katdmen email w nom dima m3emrin.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — CHECK et FOREIGN KEY',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>commande</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>client_id INTEGER NOT NULL</code>, <code>montant REAL CHECK (montant &gt;= 0)</code> et une clé étrangère <code>FOREIGN KEY (client_id) REFERENCES membre(id)</code>. Affiche la définition SQL de la table.</p>',
      'instructionsDarija' => '<p>5leq table <code>commande</code> b <code>id INTEGER PRIMARY KEY</code>, <code>client_id INTEGER NOT NULL</code>, <code>montant REAL CHECK (montant &gt;= 0)</code> w clé étrangère <code>FOREIGN KEY (client_id) REFERENCES membre(id)</code>. 3red définition SQL dyal table.</p>',
      'starter' => 'DROP TABLE IF EXISTS commande;

-- CREATE TABLE
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => 'CHECK',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'FOREIGN KEY',
        ),
      ),
      'hints' => 
      array (
        0 => 'CHECK exprime une règle sur une ou plusieurs colonnes.',
        1 => 'FOREIGN KEY relie une colonne à la clé primaire d\'une autre table.',
        2 => 'La table référencée doit exister.',
      ),
      'solution' => 'DROP TABLE IF EXISTS commande;

CREATE TABLE commande (
    id INTEGER PRIMARY KEY,
    client_id INTEGER NOT NULL,
    montant REAL CHECK (montant >= 0),
    FOREIGN KEY (client_id) REFERENCES membre(id)
);

SELECT sql FROM sqlite_master WHERE type = \'table\' AND name = \'commande\';',
      'explainFr' => '<code>CHECK</code> refuse un montant négatif, et <code>FOREIGN KEY</code> empêche de rattacher une commande à un membre inexistant (si les clés étrangères sont activées).',
      'explainDarija' => '<code>CHECK</code> kayrefus montant salib, w <code>FOREIGN KEY</code> kaymna3 commande ttrbet b membre ma kanch (ila clés étrangères mfe3lin).',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — clé composite',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>note2</code> avec <code>etudiant_id INTEGER NOT NULL</code>, <code>matiere_id INTEGER NOT NULL</code>, <code>valeur REAL CHECK (valeur BETWEEN 0 AND 20)</code> et une clé primaire composite <code>PRIMARY KEY (etudiant_id, matiere_id)</code>. Affiche la définition SQL de la table.</p>',
      'instructionsDarija' => '<p>5leq table <code>note2</code> b <code>etudiant_id INTEGER NOT NULL</code>, <code>matiere_id INTEGER NOT NULL</code>, <code>valeur REAL CHECK (valeur BETWEEN 0 AND 20)</code> w clé primaire composite <code>PRIMARY KEY (etudiant_id, matiere_id)</code>. 3red définition SQL dyal table.</p>',
      'starter' => 'DROP TABLE IF EXISTS note2;

-- CREATE TABLE
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'sql_ok',
          'value' => '',
        ),
        1 => 
        array (
          'type' => 'result_has',
          'value' => 'PRIMARY KEY',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'CHECK',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une clé composite combine plusieurs colonnes.',
        1 => 'Le couple (etudiant_id, matiere_id) devient unique.',
        2 => 'CHECK limite la valeur entre 0 et 20.',
      ),
      'solution' => 'DROP TABLE IF EXISTS note2;

CREATE TABLE note2 (
    etudiant_id INTEGER NOT NULL,
    matiere_id INTEGER NOT NULL,
    valeur REAL CHECK (valeur BETWEEN 0 AND 20),
    PRIMARY KEY (etudiant_id, matiere_id)
);

SELECT sql FROM sqlite_master WHERE type = \'table\' AND name = \'note2\';',
      'explainFr' => 'La clé composite empêche un étudiant d\'avoir deux notes pour la même matière. <code>CHECK</code> garantit en plus que chaque note reste entre 0 et 20.',
      'explainDarija' => 'Clé composite kamna3 étudiant ykoun 3ndo jouj notes f nefs matière. <code>CHECK</code> kaddmen 7ta kol note tbqa bin 0 w 20.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
