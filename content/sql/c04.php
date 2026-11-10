<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c04.json
 */

return array (
  'id' => 'sql-ch4',
  'title' => 'Contraintes',
  'subtitle' => 'Garantir la qualité des données au niveau de la base',
  'objectives' => 
  array (
    0 => 'Utiliser NOT NULL, UNIQUE, PRIMARY KEY et DEFAULT.',
    1 => 'Relier deux tables avec FOREIGN KEY.',
    2 => 'Limiter les valeurs avec CHECK.',
    3 => 'Comprendre la suppression en cascade.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'contraintes-colonne',
      'title' => 'Contraintes de colonne',
      'icon' => '🚧',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>contrainte</strong> est une règle imposée par la base. Elle refuse les données invalides même si l\'application contient un bug. C\'est la dernière ligne de défense.</p>',
          'darija' => '<p><strong>Contrainte</strong> hiya qa3ida katferdha base. Katrefus données ghalta 7ta ila application fiha bug. Hiya akhir ligne dyal défense.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Contrainte',
            1 => 'Rôle',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'NOT NULL',
              1 => 'valeur obligatoire',
              2 => 'nom VARCHAR(50) NOT NULL',
            ),
            1 => 
            array (
              0 => 'UNIQUE',
              1 => 'valeurs différentes',
              2 => 'email VARCHAR(80) UNIQUE',
            ),
            2 => 
            array (
              0 => 'PRIMARY KEY',
              1 => 'identifiant unique et non NULL',
              2 => 'id INT PRIMARY KEY',
            ),
            3 => 
            array (
              0 => 'DEFAULT',
              1 => 'valeur si absente',
              2 => 'actif BOOLEAN DEFAULT 1',
            ),
            4 => 
            array (
              0 => 'CHECK',
              1 => 'condition sur la valeur',
              2 => 'note BETWEEN 0 AND 20',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Table avec plusieurs contraintes',
          'lang' => 'sql',
          'code' => 'CREATE TABLE etudiant (
    id INT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(80) UNIQUE,
    filiere VARCHAR(20) DEFAULT \'GI\',
    age INT CHECK (age >= 17)
);

INSERT INTO etudiant (id, nom, email, age)
VALUES (1, \'Amal\', \'amal@site.ma\', 20);

SELECT * FROM etudiant;',
          'output' => 'id | nom  | email         | filiere | age
1  | Amal | amal@site.ma | GI      | 20',
          'explainFr' => 'La filière prend sa valeur par défaut « GI ». Une deuxième insertion avec le même email ou un âge de 15 serait refusée par la base.',
          'explainDarija' => 'Filière katakhod valeur par défaut « GI ». Insertion tanya b nefs email wla age 15 katrefusha base.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Les contraintes ne remplacent pas la validation',
          'fr' => 'La base refuse les données invalides, mais elle ne produit pas de message clair pour l\'utilisateur. Validez aussi côté PHP pour afficher un message compréhensible.',
          'darija' => 'Base katrefus données ghalta, walakin ma kat3tich message wad7 l utilisateur. Validi 7ta f PHP bach t3red message mfhoum.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'cle-etrangere',
      'title' => 'Clé étrangère',
      'icon' => '🔗',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>clé étrangère</strong> (FOREIGN KEY) relie une colonne à la clé primaire d\'une autre table. Elle garantit qu\'on ne peut pas créer une note pour un étudiant inexistant : c\'est l\'<strong>intégrité référentielle</strong>.</p>',
          'darija' => '<p><strong>Clé étrangère</strong> (FOREIGN KEY) katrbet colonne m3a clé primaire dyal table okhra. Katdmen ma tqderch t5leq note l etudiant ma kaynch : hadi <strong>intégrité référentielle</strong>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'CREATE TABLE note (
    id INT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    valeur DECIMAL(4,2),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id)
        ON DELETE CASCADE
);',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Étudiant et notes',
          'lang' => 'sql',
          'code' => 'CREATE TABLE promo (id INT PRIMARY KEY, nom VARCHAR(50));
CREATE TABLE inscrit (
    id INT PRIMARY KEY,
    promo_id INT,
    nom VARCHAR(50),
    FOREIGN KEY (promo_id) REFERENCES promo(id)
);

INSERT INTO promo VALUES (1, \'GI 2026\');
INSERT INTO inscrit VALUES (1, 1, \'Amal\');

SELECT i.nom, p.nom AS promo
FROM inscrit i
JOIN promo p ON p.id = i.promo_id;',
          'output' => 'nom  | promo
Amal | GI 2026',
          'explainFr' => 'La colonne <code>promo_id</code> ne peut contenir qu\'un identifiant présent dans <code>promo</code>. Insérer <code>promo_id = 99</code> échouerait.',
          'explainDarija' => 'Colonne <code>promo_id</code> katqbel ghir identifiant kayn f <code>promo</code>. Insertion b <code>promo_id = 99</code> katfchel.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'ON DELETE CASCADE',
          'fr' => '<code>ON DELETE CASCADE</code> supprime automatiquement les enfants quand le parent disparaît. Pratique, mais dangereux : vérifiez que c\'est bien le comportement voulu.',
          'darija' => '<code>ON DELETE CASCADE</code> katmse7 les enfants automatiquement melli parent kaymchi. Mzyana walakin khatira : t2ekked hada howa comportement li bghiti.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'check-cascade',
      'title' => 'CHECK et suppression',
      'icon' => '🧪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>CHECK</code> impose une condition sur une ou plusieurs colonnes. Attention : SQLite et MySQL 8 l\'appliquent, mais certaines versions anciennes de MySQL ignorent silencieusement les CHECK.</p>',
          'darija' => '<p><code>CHECK</code> kayfarred condition 3la colonne wa7da wla ktar. 3ndak : SQLite w MySQL 8 kaytbeqo had contrainte, walakin chi versions qdima dyal MySQL kayjahloha bla ma y3lo.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Note entre 0 et 20',
          'lang' => 'sql',
          'code' => 'CREATE TABLE evaluation (
    id INT PRIMARY KEY,
    note DECIMAL(4,2) CHECK (note >= 0 AND note <= 20),
    statut VARCHAR(10) CHECK (statut IN (\'admis\', \'recalé\'))
);

INSERT INTO evaluation VALUES (1, 14.5, \'admis\');
SELECT * FROM evaluation;',
          'output' => 'id | note | statut
1  | 14.5 | admis',
          'explainFr' => 'La base refuserait <code>note = 25</code> ou <code>statut = \'en attente\'</code>. Les règles métier sont ainsi protégées au niveau du stockage.',
          'explainDarija' => 'Base katrefus <code>note = 25</code> wla <code>statut = \'en attente\'</code>. Règles métier kaywliw mahmiyin f niveau stockage.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'Suppression d\'un parent référencé',
          'fr' => 'Par défaut, supprimer un parent encore référencé est refusé (RESTRICT). C\'est souvent le comportement souhaité : on évite les enregistrements orphelins.',
          'darija' => 'B défaut, msse7 parent mazal mrbout kaytrefus (RESTRICT). Ghaliban hada comportement li bghina : kanmna3o enregistrements orphelins.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'email VARCHAR(80) sans UNIQUE',
      'fix' => 'email VARCHAR(80) UNIQUE',
      'fr' => 'Sans UNIQUE, deux comptes peuvent partager le même email et rendre l\'authentification ambiguë.',
      'darija' => 'Bla UNIQUE, jouj comptes y9dro ycharko nefs email w y3mlo confusion f authentification.',
    ),
    1 => 
    array (
      'wrong' => 'note DECIMAL(4,2) sans CHECK',
      'fix' => 'note DECIMAL(4,2) CHECK (note BETWEEN 0 AND 20)',
      'fr' => 'Sans CHECK, une note de 150 est acceptée. La contrainte protège même contre un bug PHP.',
      'darija' => 'Bla CHECK, note 150 katqbel. Contrainte kat7mi 7ta men bug f PHP.',
    ),
    2 => 
    array (
      'wrong' => 'FOREIGN KEY vers une colonne non unique',
      'fix' => 'Référencer la PRIMARY KEY ou une colonne UNIQUE de la table parente.',
      'fr' => 'Une clé étrangère doit pointer vers une colonne unique, sinon la relation est ambiguë et la base refuse.',
      'darija' => 'Clé étrangère khas tpointi l colonne unique, sinon relation ghadi tkon ambiguë w base katrefus.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Les <strong>contraintes</strong> garantissent la qualité des données : <code>NOT NULL</code> impose une valeur, <code>UNIQUE</code> interdit les doublons, <code>PRIMARY KEY</code> identifie une ligne, <code>DEFAULT</code> fournit une valeur absente, <code>CHECK</code> limite les valeurs et <code>FOREIGN KEY</code> relie deux tables. Elles complètent la validation applicative.',
    'darija' => '<strong>Contraintes</strong> kaydmeno qualité dyal données : <code>NOT NULL</code> kayferd valeur, <code>UNIQUE</code> kaymna3 doublons, <code>PRIMARY KEY</code> kay3arref ligne, <code>DEFAULT</code> kay3ti valeur ila ma kanetch, <code>CHECK</code> kay7ded valeurs w <code>FOREIGN KEY</code> kayrbet jouj tables. Kaykmmlo validation dyal application.',
  ),
);
