<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c03.json
 */

return array (
  'id' => 'sql-ch3',
  'title' => 'DDL',
  'subtitle' => 'Créer et modifier la structure de la base',
  'objectives' => 
  array (
    0 => 'Créer une table avec CREATE TABLE.',
    1 => 'Modifier une table avec ALTER TABLE.',
    2 => 'Supprimer une table avec DROP TABLE et vider avec TRUNCATE.',
    3 => 'Adopter des conventions de nommage claires.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'create-table',
      'title' => 'CREATE TABLE',
      'icon' => '🏗️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le <strong>DDL</strong> (Data Definition Language) décrit la structure : <code>CREATE</code>, <code>ALTER</code>, <code>DROP</code>, <code>TRUNCATE</code>. <code>CREATE TABLE</code> définit les colonnes, leurs types et leurs contraintes.</p>',
          'darija' => '<p><strong>DDL</strong> (Data Definition Language) kaywcaf structure : <code>CREATE</code>, <code>ALTER</code>, <code>DROP</code>, <code>TRUNCATE</code>. <code>CREATE TABLE</code> kay3erref colonnes, types dyalhom w contraintes.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'CREATE TABLE etudiant (
    id INT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    filiere VARCHAR(20) DEFAULT \'GI\',
    email VARCHAR(80) UNIQUE
);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Créer et remplir une table',
          'lang' => 'sql',
          'code' => 'CREATE TABLE livre (
    id INT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    auteur VARCHAR(60),
    annee INT
);

INSERT INTO livre (id, titre, auteur, annee) VALUES
    (1, \'Le Petit Prince\', \'Saint-Exupéry\', 1943),
    (2, \'PHP moderne\', \'Amal B.\', 2026);

SELECT titre, annee FROM livre;',
          'output' => 'titre            | annee
Le Petit Prince  | 1943
PHP moderne      | 2026',
          'explainFr' => 'La table est créée avec quatre colonnes typées. <code>NOT NULL</code> impose une valeur pour le titre ; <code>PRIMARY KEY</code> identifie chaque ligne.',
          'explainDarija' => 'Table tsaybat b rba3 colonnes typées. <code>NOT NULL</code> kayfarred valeur l titre ; <code>PRIMARY KEY</code> kay3arref kol ligne.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'alter-table',
      'title' => 'ALTER TABLE',
      'icon' => '🔧',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>ALTER TABLE</code> modifie une table existante : ajouter une colonne, changer un type, ajouter une contrainte, renommer. Les données existantes sont conservées quand c\'est possible.</p>',
          'darija' => '<p><code>ALTER TABLE</code> katbeddel table li kayna : tzid colonne, tbeddel type, tzid contrainte, tbeddel smiya. Données li kaynin kaybqaw melli ykon mumkin.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Opérations courantes',
          'code' => 'ALTER TABLE livre ADD COLUMN isbn VARCHAR(20);
ALTER TABLE livre MODIFY COLUMN auteur VARCHAR(100);
ALTER TABLE livre ADD CONSTRAINT uq_isbn UNIQUE (isbn);
ALTER TABLE livre RENAME TO ouvrage;',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Ajouter une colonne puis la remplir',
          'lang' => 'sql',
          'code' => 'CREATE TABLE contact (
    id INT PRIMARY KEY,
    nom VARCHAR(50)
);

INSERT INTO contact VALUES (1, \'Amal\');

ALTER TABLE contact ADD COLUMN email VARCHAR(80);

UPDATE contact SET email = \'amal@site.ma\' WHERE id = 1;

SELECT nom, email FROM contact;',
          'output' => 'nom  | email
Amal | amal@site.ma',
          'explainFr' => 'La nouvelle colonne est créée vide (NULL) pour les lignes existantes. On la remplit ensuite avec <code>UPDATE</code>.',
          'explainDarija' => 'Colonne jdida kat5leq khawya (NULL) l lignes li kaynin. Men ba3d kan3emmeroha b <code>UPDATE</code>.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'ALTER sur une grosse table',
          'fr' => 'Certaines modifications (changer un type, ajouter une contrainte) reconstruisent la table et peuvent bloquer un service en production. Testez toujours sur une copie.',
          'darija' => 'Chi modifications (tbeddel type, tzid contrainte) kay3awdo ybniw table w y9dro yblokiw service f production. Dima testi 3la copie.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'drop-truncate',
      'title' => 'DROP et TRUNCATE',
      'icon' => '🗑️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>TRUNCATE TABLE</strong> vide toutes les lignes mais garde la structure. <strong>DROP TABLE</strong> supprime la table entière (structure et données). Ces opérations sont <strong>irréversibles</strong> sans sauvegarde.</p>',
          'darija' => '<p><strong>TRUNCATE TABLE</strong> katferregh kol lignes walakin kat7fed structure. <strong>DROP TABLE</strong> katmse7 table kamla (structure w données). Had opérations <strong>ma kayrj3ouch</strong> bla sauvegarde.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Commande',
            1 => 'Données',
            2 => 'Structure',
            3 => 'Réversible ?',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'DELETE FROM t',
              1 => 'lignes choisies',
              2 => 'conservée',
              3 => 'oui (dans une transaction)',
            ),
            1 => 
            array (
              0 => 'TRUNCATE TABLE t',
              1 => 'toutes les lignes',
              2 => 'conservée',
              3 => 'non',
            ),
            2 => 
            array (
              0 => 'DROP TABLE t',
              1 => 'toutes les lignes',
              2 => 'supprimée',
              3 => 'non',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Vider puis supprimer',
          'lang' => 'sql',
          'code' => 'CREATE TABLE test_drop (id INT);
INSERT INTO test_drop VALUES (1), (2), (3);

TRUNCATE TABLE test_drop;
SELECT COUNT(*) FROM test_drop;

DROP TABLE test_drop;',
          'output' => 'COUNT(*)
0',
          'explainFr' => 'Après <code>TRUNCATE</code>, la table existe encore mais est vide. <code>DROP</code> la ferait disparaître complètement.',
          'explainDarija' => 'Men ba3d <code>TRUNCATE</code>, table mazal kayna walakin khawya. <code>DROP</code> katghayebha kamla.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'DROP IF EXISTS',
          'fr' => 'En script de création, <code>DROP TABLE IF EXISTS t;</code> évite l\'erreur si la table n\'existe pas. Pratique pour rejouer un script de test.',
          'darija' => 'F script dyal création, <code>DROP TABLE IF EXISTS t;</code> kaymna3 erreur ila table ma kaynach. Mzyan bach t3awed script dyal test.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Supprimer une table sans sauvegarde',
      'fix' => 'Exporter la table (dump) avant DROP, ou tester sur une base de développement.',
      'fr' => '<code>DROP TABLE</code> est définitif : aucune commande ne restaure les données.',
      'darija' => '<code>DROP TABLE</code> niha2i : 7ta commande ma katrje3 données.',
    ),
    1 => 
    array (
      'wrong' => 'ALTER TABLE ... ADD email VARCHAR(80) sans valeur par défaut sur une table NOT NULL',
      'fix' => 'Ajouter la colonne avec DEFAULT, ou la rendre NULL, puis remplir.',
      'fr' => 'Sur une table contenant déjà des lignes, une nouvelle colonne NOT NULL sans défaut peut être refusée.',
      'darija' => '3la table fiha lignes, colonne NOT NULL jdida bla défaut t9der ttreffus.',
    ),
    2 => 
    array (
      'wrong' => 'Utiliser des noms avec espaces ou accents',
      'fix' => 'etudiant, date_inscription, code_pays',
      'fr' => 'Des noms simples en minuscules avec underscores évitent les guillemets obligatoires et les erreurs de portabilité.',
      'darija' => 'Smiyat sahlin b minuscules w underscores kaymna3o guillemets darourin w erreurs dyal portabilité.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Le <strong>DDL</strong> crée et modifie la structure : <code>CREATE TABLE</code> définit colonnes, types et contraintes, <code>ALTER TABLE</code> ajoute ou modifie des éléments, <code>TRUNCATE</code> vide sans supprimer, <code>DROP</code> supprime définitivement. Travaillez toujours avec une sauvegarde.',
    'darija' => '<strong>DDL</strong> kaybni w kaybeddel structure : <code>CREATE TABLE</code> kay3erref colonnes, types w contraintes, <code>ALTER TABLE</code> kayzid wla ybeddel, <code>TRUNCATE</code> kayferregh bla ma ymse7, <code>DROP</code> kaymse7 niha2iyan. Dima khdem b sauvegarde.',
  ),
);
