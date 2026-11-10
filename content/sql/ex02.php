<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex02.php
 */

return array (
  'id' => 'sql-ex2',
  'title' => 'Types de données SQL',
  'brief' => 'Choisir le bon type pour chaque colonne.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — texte et nombre',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>produit</code> avec : <code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code> et <code>prix REAL</code>. Supprime d\'abord la table si elle existe, puis vérifie avec <code>SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'produit\';</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>produit</code> b : <code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code> w <code>prix REAL</code>. 7yed table lwel ila kant kayna, men ba3d t7eqqeq b <code>SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'produit\';</code>.</p>',
      'starter' => '-- DROP puis CREATE TABLE
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
          'value' => 'produit',
        ),
      ),
      'hints' => 
      array (
        0 => 'DROP TABLE IF EXISTS évite l\'erreur si la table existe déjà.',
        1 => 'INTEGER stocke un entier, TEXT du texte, REAL un décimal.',
        2 => 'PRIMARY KEY identifie chaque ligne.',
      ),
      'solution' => 'DROP TABLE IF EXISTS produit;

CREATE TABLE produit (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    prix REAL
);

SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'produit\';',
      'explainFr' => '<code>INTEGER</code>, <code>TEXT</code> et <code>REAL</code> couvrent les besoins de base : identifiant, nom et prix. <code>PRIMARY KEY</code> rend l\'identifiant unique.',
      'explainDarija' => '<code>INTEGER</code>, <code>TEXT</code> w <code>REAL</code> kayghatto besoins asasiyin : identifiant, nom w prix. <code>PRIMARY KEY</code> kay3mel identifiant unique.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — dates et montants',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>employe</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code>, <code>salaire DECIMAL(10,2)</code> et <code>date_embauche DATE</code>, puis vérifie son nom dans <code>sqlite_master</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>employe</code> b <code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code>, <code>salaire DECIMAL(10,2)</code> w <code>date_embauche DATE</code>, men ba3d t7eqqeq smiya f <code>sqlite_master</code>.</p>',
      'starter' => 'DROP TABLE IF EXISTS employe;

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
          'value' => 'employe',
        ),
      ),
      'hints' => 
      array (
        0 => 'DECIMAL(10,2) prévoit 10 chiffres dont 2 décimales.',
        1 => 'DATE stocke une date au format AAAA-MM-JJ.',
        2 => 'SQLite accepte ces types et les rapproche de ses types natifs.',
      ),
      'solution' => 'DROP TABLE IF EXISTS employe;

CREATE TABLE employe (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    salaire DECIMAL(10, 2),
    date_embauche DATE
);

SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'employe\';',
      'explainFr' => '<code>DECIMAL(10,2)</code> documente la précision attendue pour un montant. <code>DATE</code> indique une date ; en SQLite elle est stockée comme texte, mais la contrainte de format reste à la charge de l\'application.',
      'explainDarija' => '<code>DECIMAL(10,2)</code> katwsef précision dyal montant. <code>DATE</code> kat3ni date ; f SQLite kattkhzen b7al texte, walakin format kaybqa 3la application.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — valeurs par défaut',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>mesure</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>valeur REAL NOT NULL</code>, <code>unite TEXT DEFAULT \'kg\'</code> et <code>actif INTEGER DEFAULT 1</code>. Termine par <code>SELECT name, dflt_value FROM pragma_table_info(\'mesure\');</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>mesure</code> b <code>id INTEGER PRIMARY KEY</code>, <code>valeur REAL NOT NULL</code>, <code>unite TEXT DEFAULT \'kg\'</code> w <code>actif INTEGER DEFAULT 1</code>. Sali b <code>SELECT name, dflt_value FROM pragma_table_info(\'mesure\');</code>.</p>',
      'starter' => 'DROP TABLE IF EXISTS mesure;

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
          'value' => 'unite',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'valeur',
        ),
      ),
      'hints' => 
      array (
        0 => 'DEFAULT fournit une valeur quand la colonne n\'est pas renseignée.',
        1 => 'Le texte par défaut s\'écrit entre guillemets simples.',
        2 => '1 et 0 représentent souvent vrai et faux en SQL.',
      ),
      'solution' => 'DROP TABLE IF EXISTS mesure;

CREATE TABLE mesure (
    id INTEGER PRIMARY KEY,
    valeur REAL NOT NULL,
    unite TEXT DEFAULT \'kg\',
    actif INTEGER DEFAULT 1
);

SELECT name, dflt_value FROM pragma_table_info(\'mesure\');',
      'explainFr' => 'Les valeurs par défaut simplifient les insertions : si l\'unité ou l\'état n\'est pas fourni, la base applique <code>\'kg\'</code> et <code>1</code>.',
      'explainDarija' => 'Valeurs par défaut katsahhel insertions : ila unité wla état ma t3tach, base kattbeq <code>\'kg\'</code> w <code>1</code>.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
