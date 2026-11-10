<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex11.php
 */

return array (
  'id' => 'sql-ex11',
  'title' => 'Relations entre tables',
  'brief' => 'Relier les tables avec des clés étrangères et des tables de jonction.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — clé étrangère',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>auteur</code> (<code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code>) et une table <code>livre</code> (<code>id INTEGER PRIMARY KEY</code>, <code>titre TEXT NOT NULL</code>, <code>auteur_id INTEGER NOT NULL</code> avec <code>FOREIGN KEY</code> vers <code>auteur(id)</code>). Insère un auteur et un livre, puis affiche le titre et le nom de l\'auteur avec un <code>JOIN</code>.</p>',
      'instructionsDarija' => '<p>5leq table <code>auteur</code> (<code>id INTEGER PRIMARY KEY</code>, <code>nom TEXT NOT NULL</code>) w table <code>livre</code> (<code>id INTEGER PRIMARY KEY</code>, <code>titre TEXT NOT NULL</code>, <code>auteur_id INTEGER NOT NULL</code> m3a <code>FOREIGN KEY</code> l <code>auteur(id)</code>). Dkhel auteur w livre, men ba3d 3red titre w smiya dyal auteur b <code>JOIN</code>.</p>',
      'starter' => '-- DROP, CREATE, INSERT puis JOIN
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
          'value' => 'Le Petit Prince',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Saint-Exupery',
        ),
      ),
      'hints' => 
      array (
        0 => 'La clé étrangère référence la clé primaire de l\'autre table.',
        1 => 'Insère d\'abord l\'auteur pour satisfaire la contrainte.',
        2 => 'Le JOIN relie livre.auteur_id à auteur.id.',
      ),
      'solution' => 'DROP TABLE IF EXISTS livre;
DROP TABLE IF EXISTS auteur;

CREATE TABLE auteur (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE livre (
    id INTEGER PRIMARY KEY,
    titre TEXT NOT NULL,
    auteur_id INTEGER NOT NULL,
    FOREIGN KEY (auteur_id) REFERENCES auteur(id)
);

INSERT INTO auteur (id, nom) VALUES (1, \'Saint-Exupery\');
INSERT INTO livre (id, titre, auteur_id) VALUES (1, \'Le Petit Prince\', 1);

SELECT l.titre, a.nom AS auteur
FROM livre l
JOIN auteur a ON a.id = l.auteur_id;',
      'explainFr' => 'La table <code>livre</code> ne répète pas le nom de l\'auteur : elle stocke seulement <code>auteur_id</code>. Le <code>JOIN</code> reconstruit l\'information complète à la lecture.',
      'explainDarija' => 'Table <code>livre</code> ma kat3awedch smiya dyal auteur : katkhzen ghir <code>auteur_id</code>. <code>JOIN</code> kay3awed ybni information kamla f qraya.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — table de jonction',
      'lang' => 'sql',
      'instructions' => '<p>Crée <code>membre</code>, <code>projet</code> et la table de jonction <code>inscription</code> avec une clé primaire composite <code>(membre_id, projet_id)</code> et deux clés étrangères. Insère deux membres, deux projets et trois inscriptions, puis compte les membres par projet.</p>',
      'instructionsDarija' => '<p>5leq <code>membre</code>, <code>projet</code> w table de jonction <code>inscription</code> b clé primaire composite <code>(membre_id, projet_id)</code> w jouj clés étrangères. Dkhel jouj membres, jouj projets w tlata inscriptions, men ba3d 7seb membres b kol projet.</p>',
      'starter' => '-- tables et jonction
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
          'type' => 'row_count',
          'value' => '2',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Site web',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '2',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une relation many-to-many passe par une table de jonction.',
        1 => 'La clé composite empêche d\'inscrire deux fois le même membre au même projet.',
        2 => 'GROUP BY projet et COUNT(*) donnent le nombre de membres.',
      ),
      'solution' => 'DROP TABLE IF EXISTS inscription;
DROP TABLE IF EXISTS projet;
DROP TABLE IF EXISTS membre;

CREATE TABLE membre (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE projet (
    id INTEGER PRIMARY KEY,
    titre TEXT NOT NULL
);

CREATE TABLE inscription (
    membre_id INTEGER NOT NULL,
    projet_id INTEGER NOT NULL,
    PRIMARY KEY (membre_id, projet_id),
    FOREIGN KEY (membre_id) REFERENCES membre(id),
    FOREIGN KEY (projet_id) REFERENCES projet(id)
);

INSERT INTO membre (id, nom) VALUES (1, \'Amal\'), (2, \'Yassine\');
INSERT INTO projet (id, titre) VALUES (1, \'Site web\'), (2, \'API\');
INSERT INTO inscription (membre_id, projet_id) VALUES (1, 1), (1, 2), (2, 1);

SELECT p.titre, COUNT(*) AS membres
FROM inscription i
JOIN projet p ON p.id = i.projet_id
GROUP BY p.id, p.titre
ORDER BY p.id;',
      'explainFr' => 'La table <code>inscription</code> porte la relation : chaque ligne relie un membre et un projet. La clé composite garantit l\'unicité de la paire, et le <code>GROUP BY</code> produit le nombre de membres par projet.',
      'explainDarija' => 'Table <code>inscription</code> kat7mel relation : kol ligne katrbet membre w projet. Clé composite kaddmen unicité dyal paire, w <code>GROUP BY</code> kay3ti 3adad membres b kol projet.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — ON DELETE CASCADE',
      'lang' => 'sql',
      'instructions' => '<p>Crée <code>client3</code> et <code>commande3</code> avec une clé étrangère <code>client_id</code> vers <code>client3(id)</code> et l\'option <code>ON DELETE CASCADE</code>. Affiche la définition SQL de <code>commande3</code> pour vérifier que la contrainte est bien enregistrée.</p>',
      'instructionsDarija' => '<p>5leq <code>client3</code> w <code>commande3</code> b clé étrangère <code>client_id</code> l <code>client3(id)</code> w option <code>ON DELETE CASCADE</code>. 3red définition SQL dyal <code>commande3</code> bach t7eqqeq contrainte msjjla.</p>',
      'starter' => '-- DROP, CREATE puis SELECT sql
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
          'value' => 'ON DELETE CASCADE',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'FOREIGN KEY',
        ),
      ),
      'hints' => 
      array (
        0 => 'ON DELETE CASCADE supprime les commandes quand leur client est supprimé.',
        1 => 'La clause se place après REFERENCES.',
        2 => 'sqlite_master.sql contient la définition complète.',
      ),
      'solution' => 'DROP TABLE IF EXISTS commande3;
DROP TABLE IF EXISTS client3;

CREATE TABLE client3 (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE commande3 (
    id INTEGER PRIMARY KEY,
    client_id INTEGER NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client3(id) ON DELETE CASCADE
);

SELECT sql
FROM sqlite_master
WHERE type = \'table\' AND name = \'commande3\';',
      'explainFr' => 'Avec <code>ON DELETE CASCADE</code>, la base supprime automatiquement les lignes enfants quand la ligne parente disparaît. Cela évite des commandes orphelines, à condition d\'activer les clés étrangères.',
      'explainDarija' => 'B <code>ON DELETE CASCADE</code>, base kat7yed lignes enfants automatiquement melli ligne parente tmse7. Hadi katmna3 commandes orphelines, b chart tfe3el clés étrangères.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
