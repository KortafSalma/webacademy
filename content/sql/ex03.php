<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex03.php
 */

return array (
  'id' => 'sql-ex3',
  'title' => 'DDL',
  'brief' => 'Créer, modifier et renommer des objets de base.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — CREATE TABLE',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>cours</code> avec <code>id INTEGER PRIMARY KEY</code>, <code>titre TEXT NOT NULL</code> et <code>duree INTEGER</code>, puis vérifie son nom dans <code>sqlite_master</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>cours</code> b <code>id INTEGER PRIMARY KEY</code>, <code>titre TEXT NOT NULL</code> w <code>duree INTEGER</code>, men ba3d t7eqqeq smiya f <code>sqlite_master</code>.</p>',
      'starter' => 'DROP TABLE IF EXISTS cours;

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
          'value' => 'cours',
        ),
      ),
      'hints' => 
      array (
        0 => 'CREATE TABLE définit les colonnes et leurs types.',
        1 => 'NOT NULL interdit une valeur vide.',
        2 => 'Termine la requête par un point-virgule.',
      ),
      'solution' => 'DROP TABLE IF EXISTS cours;

CREATE TABLE cours (
    id INTEGER PRIMARY KEY,
    titre TEXT NOT NULL,
    duree INTEGER
);

SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'cours\';',
      'explainFr' => '<code>CREATE TABLE</code> est une commande DDL : elle modifie la structure de la base, pas les données. La table apparaît ensuite dans <code>sqlite_master</code>.',
      'explainDarija' => '<code>CREATE TABLE</code> commande DDL : katbeddel structure dyal base, machi données. Table men ba3d katban f <code>sqlite_master</code>.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — ALTER TABLE',
      'lang' => 'sql',
      'instructions' => '<p>Crée la table <code>cours</code> si besoin, puis ajoute une colonne <code>coefficient REAL DEFAULT 1.0</code> avec <code>ALTER TABLE</code>. Vérifie la structure avec <code>pragma_table_info</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>cours</code> ila khas, men ba3d zid colonne <code>coefficient REAL DEFAULT 1.0</code> b <code>ALTER TABLE</code>. T7eqqeq structure b <code>pragma_table_info</code>.</p>',
      'starter' => 'DROP TABLE IF EXISTS cours;
CREATE TABLE cours (id INTEGER PRIMARY KEY, titre TEXT NOT NULL);

-- ALTER TABLE
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
          'value' => 'coefficient',
        ),
      ),
      'hints' => 
      array (
        0 => 'ALTER TABLE ... ADD COLUMN ajoute une colonne.',
        1 => 'La nouvelle colonne peut avoir une valeur par défaut.',
        2 => 'pragma_table_info(\'cours\') décrit les colonnes.',
      ),
      'solution' => 'DROP TABLE IF EXISTS cours;
CREATE TABLE cours (id INTEGER PRIMARY KEY, titre TEXT NOT NULL);

ALTER TABLE cours ADD COLUMN coefficient REAL DEFAULT 1.0;

SELECT name FROM pragma_table_info(\'cours\');',
      'explainFr' => '<code>ALTER TABLE ... ADD COLUMN</code> enrichit une table existante sans recréer les données. La valeur par défaut s\'applique aux lignes déjà présentes.',
      'explainDarija' => '<code>ALTER TABLE ... ADD COLUMN</code> katzid table li kayna bla ma t3awed t5leq données. Valeur par défaut kattbeq 3la lignes li kaynin.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — renommer une table',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>salle</code> avec <code>id INTEGER PRIMARY KEY</code> et <code>capacite INTEGER</code>, puis renomme-la en <code>salle_cours</code> avec <code>ALTER TABLE ... RENAME TO</code> et vérifie le nouveau nom.</p>',
      'instructionsDarija' => '<p>5leq table <code>salle</code> b <code>id INTEGER PRIMARY KEY</code> w <code>capacite INTEGER</code>, men ba3d beddel smiya l <code>salle_cours</code> b <code>ALTER TABLE ... RENAME TO</code> w t7eqqeq smiya jdida.</p>',
      'starter' => 'DROP TABLE IF EXISTS salle;
DROP TABLE IF EXISTS salle_cours;

-- CREATE puis RENAME
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
          'value' => 'salle_cours',
        ),
      ),
      'hints' => 
      array (
        0 => 'RENAME TO change le nom de la table.',
        1 => 'Supprime d\'abord l\'ancienne table cible pour éviter un conflit.',
        2 => 'Vérifie le nouveau nom dans sqlite_master.',
      ),
      'solution' => 'DROP TABLE IF EXISTS salle;
DROP TABLE IF EXISTS salle_cours;

CREATE TABLE salle (
    id INTEGER PRIMARY KEY,
    capacite INTEGER
);

ALTER TABLE salle RENAME TO salle_cours;

SELECT name FROM sqlite_master WHERE type = \'table\' AND name = \'salle_cours\';',
      'explainFr' => 'Le renommage conserve les données et les contraintes. C\'est utile pour corriger un nom sans migration lourde.',
      'explainDarija' => 'Renommage kay7fed données w contraintes. Mzyan bach tsele7 smiya bla migration tqila.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
