<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c02.json
 */

return array (
  'id' => 'sql-ch2',
  'title' => 'Types de données SQL',
  'subtitle' => 'Choisir le bon type pour chaque colonne',
  'objectives' => 
  array (
    0 => 'Distinguer les grandes familles de types : nombres, texte, dates, booléens.',
    1 => 'Choisir entre INT, DECIMAL et FLOAT selon les besoins.',
    2 => 'Comprendre VARCHAR, CHAR et TEXT.',
    3 => 'Utiliser DATE, DATETIME et TIMESTAMP à bon escient.',
    4 => 'Comprendre la valeur NULL et ses pièges.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'types-numeriques',
      'title' => 'Types numériques',
      'icon' => '🔢',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le type d\'une colonne détermine les valeurs acceptées et l\'espace stocké. Pour les nombres : <strong>INT</strong> pour les entiers, <strong>DECIMAL(p,s)</strong> pour les montants exacts, <strong>FLOAT/DOUBLE</strong> pour les mesures approximatives.</p>',
          'darija' => '<p>Type dyal colonne kay7added valeurs li kayqbel w l\'espace li kaykhzen. L nombres : <strong>INT</strong> l entiers, <strong>DECIMAL(p,s)</strong> l montants dqiqin, <strong>FLOAT/DOUBLE</strong> l mesures approximatives.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Type',
            1 => 'Usage',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'INT / INTEGER',
              1 => 'identifiants, quantités',
              2 => 'id INT',
            ),
            1 => 
            array (
              0 => 'DECIMAL(6,2)',
              1 => 'prix, notes (exact)',
              2 => 'prix DECIMAL(6,2) → 1234.56',
            ),
            2 => 
            array (
              0 => 'FLOAT / DOUBLE',
              1 => 'mesures physiques (approx.)',
              2 => 'temperature DOUBLE',
            ),
            3 => 
            array (
              0 => 'TINYINT',
              1 => 'petit entier (0-255)',
              2 => 'age TINYINT',
            ),
          ),
          'fr' => 'Pour de l\'argent, utilisez toujours <code>DECIMAL</code> : <code>FLOAT</code> accumule des erreurs d\'arrondi.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Une table de produits',
          'lang' => 'sql',
          'code' => 'CREATE TABLE produit (
    id INT PRIMARY KEY,
    nom VARCHAR(80),
    prix DECIMAL(6,2),
    stock INT DEFAULT 0
);

INSERT INTO produit (id, nom, prix, stock)
VALUES (1, \'Clavier\', 249.90, 12);

SELECT nom, prix FROM produit;',
          'output' => 'nom     | prix
Clavier | 249.90',
          'explainFr' => '<code>DECIMAL(6,2)</code> accepte 6 chiffres au total dont 2 après la virgule : 249.90 est valide, 12345.678 ne le serait pas.',
          'explainDarija' => '<code>DECIMAL(6,2)</code> kayqbel 6 chiffres f total, 2 mor virgule : 249.90 valide, 12345.678 machi valide.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'FLOAT pour l\'argent ? Non',
          'fr' => '<code>0.1 + 0.2</code> en FLOAT ne donne pas exactement <code>0.3</code>. Sur des milliers d\'opérations, les centimes dérivent. <code>DECIMAL</code> est exact.',
          'darija' => '<code>0.1 + 0.2</code> b FLOAT ma kay3tich <code>0.3</code> b dqiq. 3la bzaf opérations, centimes kayghalto. <code>DECIMAL</code> dqiq.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'types-texte',
      'title' => 'Types texte',
      'icon' => '🔤',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>CHAR(n)</strong> stocke une longueur fixe (complétée par des espaces), <strong>VARCHAR(n)</strong> une longueur variable limitée à n, et <strong>TEXT</strong> un texte long sans limite pratique précise.</p>',
          'darija' => '<p><strong>CHAR(n)</strong> katkhzen toul tabit (kayt3emmer b espaces), <strong>VARCHAR(n)</strong> toul mbeddel m7doud b n, w <strong>TEXT</strong> texte twil bla 7add 3amali dqiq.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Type',
            1 => 'Longueur',
            2 => 'Quand l\'utiliser',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'CHAR(2)',
              1 => 'fixe',
              2 => 'code pays (MA, FR), sexe',
            ),
            1 => 
            array (
              0 => 'VARCHAR(80)',
              1 => 'variable ≤ 80',
              2 => 'nom, email, titre',
            ),
            2 => 
            array (
              0 => 'VARCHAR(255)',
              1 => 'variable ≤ 255',
              2 => 'adresse, URL',
            ),
            3 => 
            array (
              0 => 'TEXT',
              1 => 'longue',
              2 => 'description, article, commentaire',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Créer puis insérer du texte',
          'lang' => 'sql',
          'code' => 'CREATE TABLE client (
    id INT PRIMARY KEY,
    code_pays CHAR(2),
    nom VARCHAR(50),
    bio TEXT
);

INSERT INTO client VALUES
    (1, \'MA\', \'Amal\', \'Étudiante en informatique.\'),
    (2, \'FR\', \'Yassine\', NULL);

SELECT nom, code_pays FROM client;',
          'output' => 'nom     | code_pays
Amal    | MA
Yassine | FR',
          'explainFr' => '<code>CHAR(2)</code> convient au code pays car la longueur est toujours 2. <code>VARCHAR(50)</code> s\'adapte à la longueur du nom.',
          'explainDarija' => '<code>CHAR(2)</code> mzyan l code pays 7it toul dima 2. <code>VARCHAR(50)</code> kayt3adel m3a toul dyal nom.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'VARCHAR ou TEXT ?',
          'fr' => 'Si vous connaissez une limite raisonnable, prenez <code>VARCHAR(n)</code> : les index et les contraintes sont plus efficaces. Réservez <code>TEXT</code> aux contenus vraiment longs.',
          'darija' => 'Ila 3refi 7add ma3qol, khoud <code>VARCHAR(n)</code> : index w contraintes kaywliw ktar fa3aliya. Khelli <code>TEXT</code> l contenu twil bzzaf.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'dates-null',
      'title' => 'Dates, booléens et NULL',
      'icon' => '📅',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Pour le temps : <strong>DATE</strong> (jour), <strong>TIME</strong> (heure), <strong>DATETIME</strong> (date + heure), <strong>TIMESTAMP</strong> (souvent lié au fuseau et mis à jour automatiquement). Un <strong>booléen</strong> se stocke en <code>BOOLEAN</code> (MySQL) ou <code>INTEGER 0/1</code> (SQLite).</p>',
          'darija' => '<p>L wa9t : <strong>DATE</strong> (nhar), <strong>TIME</strong> (sa3a), <strong>DATETIME</strong> (date + sa3a), <strong>TIMESTAMP</strong> (mrbout b fuseau w kaytbddel automatiquement). <strong>Booléen</strong> kaytkhzen f <code>BOOLEAN</code> (MySQL) wla <code>INTEGER 0/1</code> (SQLite).</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Dates d\'inscription',
          'lang' => 'sql',
          'code' => 'CREATE TABLE inscription (
    id INT PRIMARY KEY,
    etudiant VARCHAR(50),
    date_inscription DATE,
    actif BOOLEAN DEFAULT 1
);

INSERT INTO inscription VALUES
    (1, \'Amal\', \'2026-09-15\', 1),
    (2, \'Omar\', \'2026-10-02\', 0);

SELECT etudiant, date_inscription FROM inscription
WHERE date_inscription >= \'2026-10-01\';',
          'output' => 'etudiant | date_inscription
Omar     | 2026-10-02',
          'explainFr' => 'Les dates s\'écrivent au format ISO <code>AAAA-MM-JJ</code> et se comparent comme du texte dans ce format : la comparaison fonctionne correctement.',
          'explainDarija' => 'Dates kaytktbo b format ISO <code>AAAA-MM-JJ</code> w kaytqarno b7al texte f had format : comparaison katkhdem mzyan.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'NULL n\'est pas 0 ni une chaîne vide',
          'fr' => '<code>NULL</code> signifie « valeur inconnue ». On le teste avec <code>IS NULL</code> / <code>IS NOT NULL</code>, jamais avec <code>= NULL</code> (qui ne renvoie jamais vrai).',
          'darija' => '<code>NULL</code> kat3ni « valeur ma m3erfach ». Kantestiwha b <code>IS NULL</code> / <code>IS NOT NULL</code>, 3omrek b <code>= NULL</code> (li 3omrha ma katrje3 vrai).',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Trouver les valeurs inconnues',
          'lang' => 'sql',
          'code' => 'SELECT nom FROM client WHERE bio IS NULL;',
          'output' => 'nom
Yassine',
          'explainFr' => '<code>IS NULL</code> est le seul test fiable. <code>WHERE bio = NULL</code> ne renvoie aucune ligne, même si des NULL existent.',
          'explainDarija' => '<code>IS NULL</code> howa test lwa7id mwatheq. <code>WHERE bio = NULL</code> ma kayrje3 7ta ligne, 7ta ila NULL kayn.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'prix FLOAT',
      'fix' => 'prix DECIMAL(8,2)',
      'fr' => 'FLOAT introduit des erreurs d\'arrondi sur les montants. DECIMAL est exact.',
      'darija' => 'FLOAT kayjib erreurs d\'arrondi f montants. DECIMAL dqiq.',
    ),
    1 => 
    array (
      'wrong' => 'WHERE email = NULL',
      'fix' => 'WHERE email IS NULL',
      'fr' => 'Toute comparaison avec NULL renvoie NULL (donc faux). Utilisez IS NULL.',
      'darija' => 'Ay comparaison m3a NULL katrje3 NULL (donc faux). Khdem b IS NULL.',
    ),
    2 => 
    array (
      'wrong' => 'VARCHAR(20) pour stocker un article complet',
      'fix' => 'TEXT pour un contenu long.',
      'fr' => 'VARCHAR(20) tronque ou refuse le texte trop long. Choisissez la taille selon l\'usage réel.',
      'darija' => 'VARCHAR(20) katqess wla katrefus texte twil. Khtar toul 3la 7sab usage 7aqiqi.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Chaque colonne a un <strong>type</strong> : <code>INT</code> pour les entiers, <code>DECIMAL</code> pour l\'argent, <code>VARCHAR(n)</code> pour le texte court, <code>TEXT</code> pour le long, <code>DATE/DATETIME</code> pour le temps. <code>NULL</code> représente l\'inconnu et se teste avec <code>IS NULL</code>. Le bon type protège les données et améliore les performances.',
    'darija' => 'Kol colonne 3ndha <strong>type</strong> : <code>INT</code> l entiers, <code>DECIMAL</code> l flous, <code>VARCHAR(n)</code> l texte qsir, <code>TEXT</code> l twil, <code>DATE/DATETIME</code> l wa9t. <code>NULL</code> kat3ni ma3loma ma m3erfach w kattester b <code>IS NULL</code>. Type mzyan kay7mi données w kay7sen performance.',
  ),
);
