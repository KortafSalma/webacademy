<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c11.json
 */

return array (
  'id' => 'sql-ch11',
  'title' => 'Relations entre tables',
  'subtitle' => 'Modéliser les liens entre les données',
  'objectives' => 
  array (
    0 => 'Reconnaître une relation un-à-plusieurs.',
    1 => 'Créer une relation plusieurs-à-plusieurs avec une table de liaison.',
    2 => 'Comprendre la relation un-à-un.',
    3 => 'Choisir le bon comportement en cas de suppression.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'un-plusieurs',
      'title' => 'Relation un-à-plusieurs',
      'icon' => '1️⃣',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La relation la plus courante : <strong>un</strong> étudiant possède <strong>plusieurs</strong> notes. La clé étrangère se place toujours du côté <strong>« plusieurs »</strong> : chaque note contient <code>etudiant_id</code>.</p>',
          'darija' => '<p>Relation li kat3awed bzaf : <strong>wa7ed</strong> etudiant 3ndo <strong>bzaf</strong> notes. Clé étrangère kat7et dima f jiht <strong>« bzaf »</strong> : kol note fiha <code>etudiant_id</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Le côté « plusieurs » porte la clé',
          'code' => 'CREATE TABLE etudiant (
    id INT PRIMARY KEY,
    nom VARCHAR(50)
);

CREATE TABLE note (
    id INT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    valeur DECIMAL(4,2),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id)
);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Un étudiant, plusieurs notes',
          'lang' => 'sql',
          'code' => 'INSERT INTO etudiant VALUES (1, \'Amal\'), (2, \'Omar\');
INSERT INTO note VALUES
    (1, 1, 14.5),
    (2, 1, 16.0),
    (3, 2, 9.0);

SELECT e.nom, n.valeur
FROM etudiant e
JOIN note n ON n.etudiant_id = e.id
ORDER BY e.nom, n.valeur;',
          'output' => 'nom  | valeur
Amal | 14.5
Amal | 16.0
Omar | 9.0',
          'explainFr' => 'Amal apparaît deux fois car elle a deux notes : c\'est le comportement normal d\'une jointure un-à-plusieurs.',
          'explainDarija' => 'Amal katban jouj merrat 7it 3ndha jouj notes : hada comportement 3adi dyal jointure un-à-plusieurs.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Jamais de liste dans une colonne',
          'fr' => 'Ne stockez pas <code>notes = \'14.5,16,9\'</code> dans une colonne. Vous ne pourriez plus filtrer, calculer une moyenne ni garantir l\'intégrité. Une table de notes est la bonne réponse.',
          'darija' => 'Ma tkhzench <code>notes = \'14.5,16,9\'</code> f colonne. Ma tqderch tfiltri, t7seb moyenne wla tdmen intégrité. Table dyal notes hiya l\'jawab.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'plusieurs-a-plusieurs',
      'title' => 'Relation plusieurs-à-plusieurs',
      'icon' => '🔀',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un étudiant passe <strong>plusieurs</strong> matières, et une matière est suivie par <strong>plusieurs</strong> étudiants. On crée une <strong>table de liaison</strong> (ici <code>note</code>) qui contient les deux clés étrangères, et éventuellement des données propres au lien (la note, la date).</p>',
          'darija' => '<p>Etudiant kaydowez <strong>bzaf</strong> matières, w matière kaytab3ha <strong>bzaf</strong> étudiants. Kankhalqo <strong>table de liaison</strong> (hna <code>note</code>) fiha jouj clés étrangères, w eventuellement données khassa b lien (note, date).</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Étudiants, matières et notes',
          'lang' => 'sql',
          'code' => 'CREATE TABLE matiere (id INT PRIMARY KEY, nom VARCHAR(40));
CREATE TABLE note (
    etudiant_id INT,
    matiere_id INT,
    valeur DECIMAL(4,2),
    PRIMARY KEY (etudiant_id, matiere_id),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
    FOREIGN KEY (matiere_id) REFERENCES matiere(id)
);

INSERT INTO matiere VALUES (1, \'Math\'), (2, \'PHP\');
INSERT INTO note VALUES (1, 1, 14.5), (1, 2, 16.0), (2, 1, 9.0);

SELECT e.nom, m.nom, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
JOIN matiere m ON m.id = n.matiere_id;',
          'output' => 'nom  | nom  | valeur
Amal | Math | 14.5
Amal | PHP  | 16.0
Omar | Math | 9.0',
          'explainFr' => 'La clé primaire composite <code>(etudiant_id, matiere_id)</code> empêche un étudiant d\'avoir deux notes pour la même matière. C\'est une règle métier gratuite.',
          'explainDarija' => 'Clé primaire composite <code>(etudiant_id, matiere_id)</code> katmna3 etudiant ykon 3ndo jouj notes f nefs matière. Hadi règle métier bla ma tktebha f code.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Relation',
            1 => 'Exemple',
            2 => 'Implémentation',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '1-1',
              1 => 'utilisateur ↔ profil',
              2 => 'clé étrangère UNIQUE',
            ),
            1 => 
            array (
              0 => '1-N',
              1 => 'étudiant → notes',
              2 => 'clé étrangère côté N',
            ),
            2 => 
            array (
              0 => 'N-N',
              1 => 'étudiants ↔ matières',
              2 => 'table de liaison avec 2 FK',
            ),
          ),
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'un-a-un-cascade',
      'title' => 'Un-à-un et suppressions',
      'icon' => '🔂',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une relation <strong>un-à-un</strong> relie une ligne à exactement une autre : un utilisateur possède un profil. On la réalise avec une clé étrangère <strong>UNIQUE</strong>, ce qui empêche deux profils pour le même utilisateur.</p>',
          'darija' => '<p>Relation <strong>un-à-un</strong> katrbet ligne b ligne okhra b dqiq : utilisateur 3ndo profil wa7ed. Kantsayboha b clé étrangère <strong>UNIQUE</strong>, li katmna3 jouj profils l nefs utilisateur.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Utilisateur et profil',
          'lang' => 'sql',
          'code' => 'CREATE TABLE utilisateur (id INT PRIMARY KEY, email VARCHAR(80) UNIQUE);
CREATE TABLE profil (
    id INT PRIMARY KEY,
    utilisateur_id INT UNIQUE,
    bio TEXT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE
);

INSERT INTO utilisateur VALUES (1, \'amal@site.ma\');
INSERT INTO profil VALUES (1, 1, \'Étudiante en GI\');

SELECT u.email, p.bio
FROM utilisateur u
JOIN profil p ON p.utilisateur_id = u.id;',
          'output' => 'email         | bio
amal@site.ma  | Étudiante en GI',
          'explainFr' => '<code>utilisateur_id INT UNIQUE</code> garantit la relation un-à-un. <code>ON DELETE CASCADE</code> supprime le profil quand l\'utilisateur est supprimé.',
          'explainDarija' => '<code>utilisateur_id INT UNIQUE</code> katdmen relation un-à-un. <code>ON DELETE CASCADE</code> katmse7 profil melli utilisateur kaytmse7.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'ON DELETE',
            1 => 'Comportement',
            2 => 'Quand l\'utiliser',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'RESTRICT',
              1 => 'refuse la suppression du parent',
              2 => 'par défaut, prudent',
            ),
            1 => 
            array (
              0 => 'CASCADE',
              1 => 'supprime les enfants',
              2 => 'données dépendantes (profil, lignes de commande)',
            ),
            2 => 
            array (
              0 => 'SET NULL',
              1 => 'met la clé enfant à NULL',
              2 => 'lien optionnel (professeur d\'une note)',
            ),
            3 => 
            array (
              0 => 'NO ACTION',
              1 => 'comme RESTRICT dans la plupart des moteurs',
              2 => 'explicite',
            ),
          ),
          'fr' => 'Choisissez le comportement selon le sens métier : supprimer un étudiant doit-il supprimer ses notes ? Pas toujours : archivez plutôt.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Stocker plusieurs identifiants dans une seule colonne : \'1,2,3\'',
      'fix' => 'Créer une table de liaison avec une ligne par association.',
      'fr' => 'Une colonne ne contient qu\'une valeur atomique. Les listes séparées par des virgules rendent les jointures et les contraintes impossibles.',
      'darija' => 'Colonne kat7et valeur wa7da atomique. Listes b virgules kaymna3o jointures w contraintes.',
    ),
    1 => 
    array (
      'wrong' => 'Clé étrangère sans index',
      'fix' => 'Créer un index sur la colonne de clé étrangère.',
      'fr' => 'Les jointures filtrent sur la clé étrangère : sans index, chaque jointure scanne toute la table enfant.',
      'darija' => 'Jointures kayfiltriw 3la clé étrangère : bla index, kol jointure katscan table enfant kamla.',
    ),
    2 => 
    array (
      'wrong' => 'ON DELETE CASCADE partout par facilité',
      'fix' => 'Choisir RESTRICT par défaut, CASCADE seulement pour les dépendances réelles.',
      'fr' => 'Une cascade mal placée peut effacer des données historiques précieuses en une seule suppression.',
      'darija' => 'Cascade f blasa ghalta t9der tmse7 données historiques mhimmin b suppression wa7da.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Les relations structurent la base : <strong>un-à-plusieurs</strong> place la clé étrangère du côté « plusieurs », <strong>plusieurs-à-plusieurs</strong> passe par une table de liaison avec deux clés étrangères et souvent une clé composite, <strong>un-à-un</strong> utilise une clé étrangère <code>UNIQUE</code>. Le choix <code>ON DELETE</code> (RESTRICT, CASCADE, SET NULL) est une décision métier.',
    'darija' => 'Relations kaybniw base : <strong>un-à-plusieurs</strong> kat7et clé étrangère f jiht « bzaf », <strong>plusieurs-à-plusieurs</strong> katdowez b table de liaison fiha jouj clés étrangères w ghaliban clé composite, <strong>un-à-un</strong> katkhdem b clé étrangère <code>UNIQUE</code>. Ikhtiyar <code>ON DELETE</code> (RESTRICT, CASCADE, SET NULL) 9arar métier.',
  ),
);
