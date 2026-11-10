<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c14.json
 */

return array (
  'id' => 'sql-ch14',
  'title' => 'Conception de bases',
  'subtitle' => 'Penser la structure avant d\'écrire la première table',
  'objectives' => 
  array (
    0 => 'Traduire un besoin en entités et associations.',
    1 => 'Lire et écrire des cardinalités (1-1, 1-N, N-N).',
    2 => 'Appliquer les trois premières formes normales.',
    3 => 'Passer d\'un modèle conceptuel à un schéma relationnel.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'entites-associations',
      'title' => 'Entités et associations',
      'icon' => '🧠',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Avant de créer des tables, on décrit le besoin avec un <strong>modèle conceptuel</strong> : les <strong>entités</strong> (étudiant, matière, professeur) et les <strong>associations</strong> entre elles (un étudiant passe une matière). Chaque entité possède des <strong>attributs</strong> et un <strong>identifiant</strong> unique.</p>',
          'darija' => '<p>Qbel ma t5leq tables, kanwsef l7aja b <strong>modèle conceptuel</strong> : <strong>entités</strong> (etudiant, matière, professeur) w <strong>associations</strong> binathom (etudiant kaydowez matière). Kol entité 3ndha <strong>attributs</strong> w <strong>identifiant</strong> unique.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Entité',
            1 => 'Attributs',
            2 => 'Identifiant',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Etudiant',
              1 => 'nom, prenom, email, filiere',
              2 => 'id',
            ),
            1 => 
            array (
              0 => 'Matiere',
              1 => 'nom, coefficient',
              2 => 'id',
            ),
            2 => 
            array (
              0 => 'Professeur',
              1 => 'nom, specialite',
              2 => 'id',
            ),
            3 => 
            array (
              0 => 'Note',
              1 => 'valeur, date',
              2 => 'id (ou couple etudiant + matiere)',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>cardinalité</strong> indique combien d\'occurrences peuvent participer à une association : <code>1-1</code>, <code>1-N</code> ou <code>N-N</code>. C\'est elle qui décide où placer la clé étrangère.</p>',
          'darija' => '<p><strong>Cardinalité</strong> katbayen sh7al occurrence t9der tcharrek f association : <code>1-1</code>, <code>1-N</code> wla <code>N-N</code>. Hiya li kat9arrer fin kat7et clé étrangère.</p>',
        ),
        3 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Cardinalité',
            1 => 'Exemple',
            2 => 'Traduction en tables',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '1-1',
              1 => 'utilisateur — profil',
              2 => 'clé étrangère UNIQUE d\'un côté',
            ),
            1 => 
            array (
              0 => '1-N',
              1 => 'étudiant — notes',
              2 => 'clé étrangère du côté N',
            ),
            2 => 
            array (
              0 => 'N-N',
              1 => 'étudiants — matières',
              2 => 'table de liaison avec 2 clés étrangères',
            ),
          ),
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'normalisation',
      'title' => 'Normalisation',
      'icon' => '🧼',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La <strong>normalisation</strong> élimine les répétitions et les incohérences. On retient trois formes principales, chacune corrigeant un défaut de la précédente.</p>',
          'darija' => '<p><strong>Normalisation</strong> kat7yed tkrar w incohérences. Kankhdmo b tlata formes principales, kol wa7da katsele7 3ib dyal li qbelha.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Forme',
            1 => 'Règle',
            2 => 'Défaut corrigé',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '1NF',
              1 => 'valeurs atomiques, pas de liste dans une cellule',
              2 => 'tel1,tel2 dans une colonne',
            ),
            1 => 
            array (
              0 => '2NF',
              1 => 'pas de dépendance partielle à une partie de la clé',
              2 => 'attribut qui dépend seulement de matiere_id',
            ),
            2 => 
            array (
              0 => '3NF',
              1 => 'pas de dépendance transitive entre attributs non clés',
              2 => 'code_postal qui détermine la ville',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Avant / après la 1NF',
          'lang' => 'sql',
          'code' => '-- ❌ 1NF violée : plusieurs valeurs dans une cellule
CREATE TABLE etudiant_avant (
    id INT PRIMARY KEY,
    nom VARCHAR(50),
    telephones VARCHAR(80)  -- \'0600..., 0700...\'
);

-- ✅ 1NF : une ligne par téléphone
CREATE TABLE etudiant (id INT PRIMARY KEY, nom VARCHAR(50));
CREATE TABLE telephone (
    id INT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    numero VARCHAR(20) NOT NULL,
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id)
);',
          'explainFr' => 'Avec une liste dans une colonne, impossible de rechercher un numéro précis, de le valider ou de le supprimer individuellement. La table <code>telephone</code> rend chaque valeur atomique et indexable.',
          'explainDarija' => 'B lista f colonne, ma tqderch t9elleb 3la ra9m mo3ayyan, tvalidih wla tmse7o bo7do. Table <code>telephone</code> kat3mel kol valeur atomique w indexable.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => '3NF : séparer ce qui dépend d\'autre chose',
          'lang' => 'sql',
          'code' => '-- ❌ ville dépend du code postal, pas de l\'étudiant
CREATE TABLE etudiant_avant (
    id INT PRIMARY KEY,
    nom VARCHAR(50),
    code_postal CHAR(5),
    ville VARCHAR(50)
);

-- ✅ on isole la correspondance postal → ville
CREATE TABLE ville (code_postal CHAR(5) PRIMARY KEY, nom VARCHAR(50));
CREATE TABLE etudiant (
    id INT PRIMARY KEY,
    nom VARCHAR(50),
    code_postal CHAR(5),
    FOREIGN KEY (code_postal) REFERENCES ville(code_postal)
);',
          'explainFr' => 'Sans séparation, changer le nom d\'une ville obligerait à modifier des centaines de lignes, avec un risque d\'oubli et donc d\'incohérence.',
          'explainDarija' => 'Bla tqsim, ila bghiti tbeddel smiya dyal ville khas tbeddel mi2at lignes, b risque d nsayan w incohérence.',
        ),
        4 => 
        array (
          'type' => 'warning',
          'title' => 'Normaliser, mais pas à l\'extrême',
          'fr' => 'La normalisation protège l\'intégrité, mais des jointures excessives peuvent coûter cher en lecture. Pour des rapports, on accepte parfois une <strong>dénormalisation</strong> contrôlée (colonne calculée, table de synthèse).',
          'darija' => 'Normalisation kat7mi intégrité, walakin jointures bzzaf y9dro ykelfo f qraya. L rapports, merrat kanqbelo <strong>dénormalisation</strong> m7ekma (colonne calculée, table de synthèse).',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'modele-relationnel',
      'title' => 'Passer au schéma relationnel',
      'icon' => '🗺️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le passage au relationnel suit des règles simples : chaque entité devient une table, chaque association <code>N-N</code> devient une table de liaison, et chaque association <code>1-N</code> ajoute une clé étrangère du côté N.</p>',
          'darija' => '<p>Passage l relationnel kaytbe3 qawa3id sahlin : kol entité katwli table, kol association <code>N-N</code> katwli table de liaison, w kol association <code>1-N</code> kat3awed clé étrangère f jiht N.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Schéma complet',
          'code' => 'CREATE TABLE professeur (
    id INT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    specialite VARCHAR(50)
);

CREATE TABLE etudiant (
    id INT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    filiere VARCHAR(20) NOT NULL DEFAULT \'GI\',
    email VARCHAR(80) UNIQUE
);

CREATE TABLE matiere (
    id INT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    coefficient DECIMAL(3,1) DEFAULT 1.0,
    professeur_id INT,
    FOREIGN KEY (professeur_id) REFERENCES professeur(id)
);

CREATE TABLE note (
    id INT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    matiere_id INT NOT NULL,
    valeur DECIMAL(4,2) CHECK (valeur BETWEEN 0 AND 20),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
    FOREIGN KEY (matiere_id) REFERENCES matiere(id),
    UNIQUE (etudiant_id, matiere_id)
);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Vérifier le modèle avec une requête',
          'lang' => 'sql',
          'code' => 'SELECT e.nom AS etudiant, m.nom AS matiere, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
JOIN matiere m ON m.id = n.matiere_id
ORDER BY e.nom, m.nom;',
          'output' => 'etudiant | matiere | valeur
Kortaf   | Math    | 14.5
Kortaf   | PHP     | 16.0
Marzak   | Math    | 17.0',
          'explainFr' => 'Si cette requête s\'écrit naturellement, le modèle est probablement correct. Un modèle qui oblige à des contorsions révèle souvent une association mal placée.',
          'explainDarija' => 'Ila had requête katkteb b tbi3a, modèle ghaliban s7i7. Modèle li kayferdek tdir contorsions kaybayen ghaliban association f blasa ghalta.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Nommer tôt, nommer clair',
          'fr' => 'Choisissez des noms au singulier, en minuscules, sans accents : <code>etudiant</code>, <code>matiere</code>, <code>date_inscription</code>. Un nom clair vaut mieux qu\'un commentaire.',
          'darija' => 'Khtar smiyat f singulier, b minuscules, bla accents : <code>etudiant</code>, <code>matiere</code>, <code>date_inscription</code>. Smiya wad7a 7sen men commentaire.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Créer les tables directement sans modèle',
      'fix' => 'Dessiner entités, associations et cardinalités sur papier avant CREATE TABLE.',
      'fr' => 'Sans modèle, on découvre les oublis en production : colonne manquante, relation impossible, doublons.',
      'darija' => 'Bla modèle, kaytktechfo nsayan f production : colonne naqsa, relation mstahila, doublons.',
    ),
    1 => 
    array (
      'wrong' => 'Stocker une liste dans une colonne (1NF violée)',
      'fix' => 'Créer une table fille avec une ligne par valeur.',
      'fr' => 'Les valeurs atomiques permettent les index, les contraintes et les recherches précises.',
      'darija' => 'Valeurs atomiques kaykhalliw index, contraintes w recherche b dqiq.',
    ),
    2 => 
    array (
      'wrong' => 'Dupliquer le nom de la ville dans chaque ligne étudiant (3NF violée)',
      'fix' => 'Table ville + clé étrangère code_postal.',
      'fr' => 'Une donnée doit être stockée à un seul endroit : sinon les mises à jour créent des incohérences.',
      'darija' => 'Donnée khas tkhzen f blasa wa7da : sinon mises à jour kay5alqo incohérences.',
    ),
    3 => 
    array (
      'wrong' => 'Association N-N sans table de liaison',
      'fix' => 'Table de liaison avec deux clés étrangères et une clé composite.',
      'fr' => 'Sans table de liaison, on est obligé de dupliquer les lignes ou d\'utiliser des listes dans une colonne.',
      'darija' => 'Bla table de liaison, khas tkarrer lignes wla tkhdem b listes f colonne.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'La conception part du <strong>modèle conceptuel</strong> : entités, attributs, associations et cardinalités. La <strong>normalisation</strong> (1NF, 2NF, 3NF) élimine listes, dépendances partielles et transitives. Le passage au relationnel transforme chaque entité en table, chaque <code>N-N</code> en table de liaison et chaque <code>1-N</code> en clé étrangère côté N. Un bon schéma rend les requêtes naturelles.',
    'darija' => 'Conception katbda men <strong>modèle conceptuel</strong> : entités, attributs, associations w cardinalités. <strong>Normalisation</strong> (1NF, 2NF, 3NF) kat7yed listes, dépendances partielles w transitives. Passage l relationnel kaybeddel kol entité l table, kol <code>N-N</code> l table de liaison w kol <code>1-N</code> l clé étrangère f jiht N. Schéma mzyan kay3mel requêtes tbi3iyin.',
  ),
);
