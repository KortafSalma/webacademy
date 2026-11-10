<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c05.json
 */

return array (
  'id' => 'sql-ch5',
  'title' => 'DML',
  'subtitle' => 'Insérer, modifier et supprimer des données',
  'objectives' => 
  array (
    0 => 'Insérer une ou plusieurs lignes avec INSERT.',
    1 => 'Modifier des lignes existantes avec UPDATE.',
    2 => 'Supprimer des lignes avec DELETE.',
    3 => 'Toujours cibler les lignes avec une clause WHERE.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'insert',
      'title' => 'INSERT : ajouter des données',
      'icon' => '➕',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le <strong>DML</strong> (Data Manipulation Language) manipule les données : <code>INSERT</code>, <code>UPDATE</code>, <code>DELETE</code>. <code>INSERT</code> ajoute une ou plusieurs lignes dans une table.</p>',
          'darija' => '<p><strong>DML</strong> (Data Manipulation Language) kaymanipuli données : <code>INSERT</code>, <code>UPDATE</code>, <code>DELETE</code>. <code>INSERT</code> kayzid ligne wa7da wla ktar f table.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'INSERT INTO etudiant (nom, prenom, filiere)
VALUES (\'Kortaf\', \'Salma\', \'GI\');

INSERT INTO etudiant (nom, prenom, filiere) VALUES
    (\'Marzak\', \'Hiba\', \'GI\'),
    (\'Tazi\', \'Anas\', \'3IA\');',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Ajouter trois matières',
          'lang' => 'sql',
          'code' => 'CREATE TABLE matiere (
    id INT PRIMARY KEY,
    nom VARCHAR(40),
    coefficient DECIMAL(3,1)
);

INSERT INTO matiere (id, nom, coefficient) VALUES
    (1, \'Math\', 4.0),
    (2, \'PHP\', 3.0),
    (3, \'Base de donnees\', 3.0);

SELECT * FROM matiere;',
          'output' => 'id | nom             | coefficient
1  | Math            | 4.0
2  | PHP             | 3.0
3  | Base de donnees | 3.0',
          'explainFr' => 'On liste explicitement les colonnes : c\'est plus robuste que de dépendre de l\'ordre physique de la table, surtout si une colonne est ajoutée plus tard.',
          'explainDarija' => 'Kantkteb colonnes b wad7 : 7sen men ma t3tamed 3la tartib dyal table, surtout ila tzid colonne men ba3d.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Colonnes facultatives',
          'fr' => 'Les colonnes absentes de l\'<code>INSERT</code> prennent leur valeur <code>DEFAULT</code>, ou <code>NULL</code> si aucune valeur par défaut n\'est définie.',
          'darija' => 'Colonnes li ma kaynin f <code>INSERT</code> kayakhdo valeur <code>DEFAULT</code>, wla <code>NULL</code> ila ma kanch défaut.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'update',
      'title' => 'UPDATE : modifier',
      'icon' => '✏️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>UPDATE</code> modifie les lignes qui respectent la clause <code>WHERE</code>. <strong>Sans WHERE, toutes les lignes sont modifiées</strong> : c\'est l\'erreur la plus coûteuse du SQL.</p>',
          'darija' => '<p><code>UPDATE</code> kaybeddel lignes li kay7eqqo <code>WHERE</code>. <strong>Bla WHERE, kol lignes kaytbeddlo</strong> : hadi erreur li katkellef ktar f SQL.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'UPDATE note
SET valeur = 16.5
WHERE id = 3;

UPDATE etudiant
SET filiere = \'GI\', email = \'nouveau@site.ma\'
WHERE id = 2;',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Corriger une note',
          'lang' => 'sql',
          'code' => 'CREATE TABLE note (id INT PRIMARY KEY, etudiant VARCHAR(40), valeur DECIMAL(4,2));
INSERT INTO note VALUES (1, \'Amal\', 14.0), (2, \'Omar\', 9.0), (3, \'Amal\', 16.0);

UPDATE note
SET valeur = 15.0
WHERE id = 1;

SELECT * FROM note;',
          'output' => 'id | etudiant | valeur
1  | Amal     | 15.0
2  | Omar     | 9.0
3  | Amal     | 16.0',
          'explainFr' => 'Seule la ligne dont l\'id vaut 1 est modifiée. Les autres notes restent intactes.',
          'explainDarija' => 'Ghir ligne li id dyalha 1 tbeddelat. Notes okhrin bqaw kif ma kanou.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'UPDATE sans WHERE = catastrophe',
          'fr' => '<code>UPDATE note SET valeur = 0;</code> met toutes les notes à zéro. Réflexe : écrire le <code>WHERE</code> d\'abord, puis <code>SET</code>. En production, testez avec un <code>SELECT</code> équivalent avant.',
          'darija' => '<code>UPDATE note SET valeur = 0;</code> kat7et kol notes zéro. Réflexe : kteb <code>WHERE</code> lwel, men ba3d <code>SET</code>. F production, testi b <code>SELECT</code> kif kif qbel.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'delete',
      'title' => 'DELETE : supprimer',
      'icon' => '🗑️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>DELETE FROM table WHERE condition</code> supprime les lignes ciblées. <strong>Sans WHERE, la table est vidée</strong>. Pour tout vider, <code>TRUNCATE</code> est plus rapide et remet les compteurs à zéro.</p>',
          'darija' => '<p><code>DELETE FROM table WHERE condition</code> katmse7 lignes li mstahdafin. <strong>Bla WHERE, table katfregh</strong>. Bach tferregh kolchi, <code>TRUNCATE</code> asra3 w kay3awed compteurs l zéro.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Supprimer une note faible',
          'lang' => 'sql',
          'code' => 'CREATE TABLE note (id INT PRIMARY KEY, etudiant VARCHAR(40), valeur DECIMAL(4,2));
INSERT INTO note VALUES (1, \'Amal\', 14.0), (2, \'Omar\', 8.0), (3, \'Hiba\', 17.0);

DELETE FROM note
WHERE valeur < 10;

SELECT * FROM note;',
          'output' => 'id | etudiant | valeur
1  | Amal     | 14.0
3  | Hiba     | 17.0',
          'explainFr' => 'La ligne d\'Omar (8.0) est supprimée ; les deux autres restent. La condition peut porter sur n\'importe quelle colonne.',
          'explainDarija' => 'Ligne dyal Omar (8.0) tmse7at ; jouj okhrin bqaw. Condition t9der tkon 3la ay colonne.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'SELECT avant DELETE',
          'fr' => 'Avant un <code>DELETE</code> ou un <code>UPDATE</code> sensible, exécutez le même <code>WHERE</code> dans un <code>SELECT</code> pour vérifier exactement les lignes concernées.',
          'darija' => 'Qbel <code>DELETE</code> wla <code>UPDATE</code> 7assas, nffed nefs <code>WHERE</code> f <code>SELECT</code> bach tchof b dqiq lignes li ghadi ytbeddlo.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'UPDATE note SET valeur = 0;',
      'fix' => 'UPDATE note SET valeur = 0 WHERE id = 3;',
      'fr' => 'Sans WHERE, toutes les notes passent à 0. C\'est une perte de données immédiate.',
      'darija' => 'Bla WHERE, kol notes kaywliw 0. Hadi perte de données f l7in.',
    ),
    1 => 
    array (
      'wrong' => 'DELETE FROM etudiant;',
      'fix' => 'DELETE FROM etudiant WHERE id = 5;',
      'fr' => 'Sans WHERE, toute la table est vidée. Vérifiez toujours avec un SELECT avant.',
      'darija' => 'Bla WHERE, table kamla katfregh. Dima t7eqqeq b SELECT qbel.',
    ),
    2 => 
    array (
      'wrong' => 'INSERT INTO etudiant VALUES (\'Amal\');',
      'fix' => 'INSERT INTO etudiant (nom) VALUES (\'Amal\');',
      'fr' => 'Sans liste de colonnes, il faut fournir une valeur pour chaque colonne dans l\'ordre exact de la table.',
      'darija' => 'Bla lista dyal colonnes, khas t3ti valeur l kol colonne b tartib dyal table.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>INSERT</strong> ajoute des lignes, <strong>UPDATE</strong> modifie les lignes ciblées et <strong>DELETE</strong> les supprime. La clause <code>WHERE</code> est indispensable pour <code>UPDATE</code> et <code>DELETE</code> : sans elle, toute la table est concernée. Testez toujours la condition avec un <code>SELECT</code> avant d\'écrire.',
    'darija' => '<strong>INSERT</strong> kayzid lignes, <strong>UPDATE</strong> kaybeddel lignes li mstahdafin w <strong>DELETE</strong> kaymse7hom. <code>WHERE</code> darouri f <code>UPDATE</code> w <code>DELETE</code> : bla biha, table kamla katttbeddel. Dima testi condition b <code>SELECT</code> qbel ma tkteb.',
  ),
);
