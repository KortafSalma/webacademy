<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex14.php
 */

return array (
  'id' => 'sql-ex14',
  'title' => 'Conception de bases',
  'brief' => 'Structurer des tables reliées et éviter la redondance.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — client et commande',
      'lang' => 'sql',
      'instructions' => '<p>Crée <code>client14</code> et <code>commande14</code> reliées par une clé étrangère. Insère deux clients et trois commandes, puis affiche chaque client avec son nombre de commandes.</p>',
      'instructionsDarija' => '<p>5leq <code>client14</code> w <code>commande14</code> mrboutin b clé étrangère. Dkhel jouj clients w tlata commandes, men ba3d 3red kol client m3a 3adad commandes dyalo.</p>',
      'starter' => '-- schéma client / commande
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
          'value' => 'Amal',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '2',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une commande appartient à un seul client.',
        1 => 'La clé étrangère évite une commande sans client.',
        2 => 'GROUP BY client et COUNT(*) comptent les commandes.',
      ),
      'solution' => 'DROP TABLE IF EXISTS commande14;
DROP TABLE IF EXISTS client14;

CREATE TABLE client14 (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE commande14 (
    id INTEGER PRIMARY KEY,
    client_id INTEGER NOT NULL,
    montant REAL NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client14(id)
);

INSERT INTO client14 (id, nom) VALUES (1, \'Amal\'), (2, \'Yassine\');
INSERT INTO commande14 (id, client_id, montant) VALUES (1, 1, 100), (2, 1, 50), (3, 2, 30);

SELECT c.nom, COUNT(*) AS commandes
FROM client14 c
JOIN commande14 cmd ON cmd.client_id = c.id
GROUP BY c.id, c.nom
ORDER BY c.nom;',
      'explainFr' => 'Le nom du client est stocké une seule fois dans <code>client14</code>. Les commandes pointent vers lui par <code>client_id</code>, ce qui évite de répéter le nom et garde les données cohérentes.',
      'explainDarija' => 'Smiya dyal client katkhzen marra wa7da f <code>client14</code>. Commandes kay3ayto 3liha b <code>client_id</code>, w hakka smiya ma kat3awedch w données kaybqaw mtenasqin.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — lignes de commande',
      'lang' => 'sql',
      'instructions' => '<p>Ajoute une table <code>ligne14</code> avec <code>commande_id</code>, <code>produit</code>, <code>quantite</code>, <code>prix_unitaire</code> et une clé primaire composite <code>(commande_id, produit)</code>. Insère deux lignes et calcule le total de la commande avec <code>SUM(quantite * prix_unitaire)</code>.</p>',
      'instructionsDarija' => '<p>Zid table <code>ligne14</code> b <code>commande_id</code>, <code>produit</code>, <code>quantite</code>, <code>prix_unitaire</code> w clé primaire composite <code>(commande_id, produit)</code>. Dkhel jouj lignes w 7seb total dyal commande b <code>SUM(quantite * prix_unitaire)</code>.</p>',
      'starter' => '-- lignes et total
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
          'value' => '120',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une commande contient plusieurs lignes.',
        1 => 'La clé composite empêche deux lignes identiques pour le même produit.',
        2 => 'SUM(quantite * prix_unitaire) calcule le total.',
      ),
      'solution' => 'DROP TABLE IF EXISTS ligne14;
DROP TABLE IF EXISTS commande14;
DROP TABLE IF EXISTS client14;

CREATE TABLE client14 (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE commande14 (
    id INTEGER PRIMARY KEY,
    client_id INTEGER NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client14(id)
);

CREATE TABLE ligne14 (
    commande_id INTEGER NOT NULL,
    produit TEXT NOT NULL,
    quantite INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire REAL NOT NULL,
    PRIMARY KEY (commande_id, produit),
    FOREIGN KEY (commande_id) REFERENCES commande14(id)
);

INSERT INTO client14 (id, nom) VALUES (1, \'Amal\');
INSERT INTO commande14 (id, client_id) VALUES (1, 1);
INSERT INTO ligne14 (commande_id, produit, quantite, prix_unitaire)
VALUES (1, \'Clavier\', 2, 50), (1, \'Souris\', 1, 20);

SELECT SUM(quantite * prix_unitaire) AS total
FROM ligne14
WHERE commande_id = 1;',
      'explainFr' => 'La table <code>ligne14</code> détaille le contenu de chaque commande. Le total se recalcule à partir des quantités et des prix, sans stocker de montant redondant.',
      'explainDarija' => 'Table <code>ligne14</code> katfessel contenu dyal kol commande. Total kayt7seb men quantités w prix, bla ma nkhzeno montant redondant.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — contraintes de conception',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>produit14</code> avec <code>reference TEXT NOT NULL UNIQUE</code> et <code>prix REAL NOT NULL CHECK (prix &gt; 0)</code>. Insère deux produits, puis affiche le nombre de produits et la définition SQL de la table.</p>',
      'instructionsDarija' => '<p>5leq table <code>produit14</code> b <code>reference TEXT NOT NULL UNIQUE</code> w <code>prix REAL NOT NULL CHECK (prix &gt; 0)</code>. Dkhel jouj produits, men ba3d 3red 3adad produits w définition SQL dyal table.</p>',
      'starter' => '-- contraintes et vérification
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
          'value' => '2',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'CHECK',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => 'UNIQUE',
        ),
      ),
      'hints' => 
      array (
        0 => 'UNIQUE empêche deux produits d\'avoir la même référence.',
        1 => 'CHECK refuse un prix nul ou négatif.',
        2 => 'sqlite_master.sql conserve les contraintes déclarées.',
      ),
      'solution' => 'DROP TABLE IF EXISTS produit14;

CREATE TABLE produit14 (
    id INTEGER PRIMARY KEY,
    reference TEXT NOT NULL UNIQUE,
    prix REAL NOT NULL CHECK (prix > 0)
);

INSERT INTO produit14 (id, reference, prix) VALUES
    (1, \'REF-001\', 25.5),
    (2, \'REF-002\', 40);

SELECT (SELECT COUNT(*) FROM produit14) AS total, sql
FROM sqlite_master
WHERE type = \'table\' AND name = \'produit14\';',
      'explainFr' => 'Les contraintes documentent les règles métier directement dans le schéma : une référence unique et un prix strictement positif. La base refuse toute ligne qui les viole.',
      'explainDarija' => 'Contraintes kaywsef qawa3id métier nichan f schéma : référence unique w prix kbir men 0. Base katrefus ay ligne li tkhellhom.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
