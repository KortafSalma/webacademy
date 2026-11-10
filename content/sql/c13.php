<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c13.json
 */

return array (
  'id' => 'sql-ch13',
  'title' => 'Vues et index',
  'subtitle' => 'Simplifier les requêtes et accélérer la lecture',
  'objectives' => 
  array (
    0 => 'Créer une vue avec CREATE VIEW et l\'utiliser comme une table.',
    1 => 'Comprendre l\'intérêt et les limites d\'une vue.',
    2 => 'Créer un index simple ou composite.',
    3 => 'Savoir quand un index accélère (ou ralentit) les requêtes.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'vues',
      'title' => 'Les vues',
      'icon' => '👓',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>vue</strong> (view) est une requête enregistrée sous un nom. Elle se comporte comme une table virtuelle : on peut la lire avec <code>SELECT</code>, sans stocker les données une seconde fois.</p>',
          'darija' => '<p><strong>Vue</strong> (view) hiya requête msejjla b smiya. Katkhdem b7al table virtuelle : t9der tqraha b <code>SELECT</code>, bla ma tkhzen données marra tanya.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Créer et utiliser une vue',
          'code' => 'CREATE VIEW etudiants_gi AS
SELECT id, nom, prenom, email
FROM etudiant
WHERE filiere = \'GI\';

SELECT * FROM etudiants_gi;',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Une vue qui résume les moyennes',
          'lang' => 'sql',
          'code' => 'CREATE VIEW moyenne_etudiant AS
SELECT e.id, e.nom, AVG(n.valeur) AS moyenne
FROM etudiant e
JOIN note n ON n.etudiant_id = e.id
GROUP BY e.id, e.nom;

SELECT nom, ROUND(moyenne, 2) AS moyenne
FROM moyenne_etudiant
ORDER BY moyenne DESC;',
          'output' => 'nom       | moyenne
Sekkat    | 18.5
Kortaf    | 15.17
Marzak    | 14.75
Tazi      | 11.4
Boukhris  | 11.0',
          'explainFr' => 'La vue cache la jointure et le GROUP BY. Les applications écrivent simplement <code>SELECT * FROM moyenne_etudiant</code>.',
          'explainDarija' => 'Vue katkhbi jointure w GROUP BY. Applications kayktbo ghir <code>SELECT * FROM moyenne_etudiant</code>.',
        ),
        3 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Avantage',
            1 => 'Explication',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Simplification',
              1 => 'une requête complexe devient un nom court',
            ),
            1 => 
            array (
              0 => 'Sécurité',
              1 => 'on expose seulement certaines colonnes',
            ),
            2 => 
            array (
              0 => 'Cohérence',
              1 => 'la même logique est réutilisée partout',
            ),
            3 => 
            array (
              0 => 'Maintenance',
              1 => 'on corrige la vue, pas chaque requête',
            ),
          ),
        ),
        4 => 
        array (
          'type' => 'warning',
          'title' => 'Une vue n\'est pas une copie',
          'fr' => 'Par défaut, une vue est recalculée à chaque requête : si la table change, la vue reflète immédiatement les nouvelles données. Une <em>vue matérialisée</em> (Oracle, PostgreSQL) stocke le résultat et doit être rafraîchie.',
          'darija' => 'B défaut, vue katt7seb f kol requête : ila table tbeddlat, vue kat3kes données jdad nichan. <em>Vue matérialisée</em> (Oracle, PostgreSQL) katkhzen résultat w khas trefreshiha.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'index-simple',
      'title' => 'Les index',
      'icon' => '📇',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un <strong>index</strong> est une structure annexe qui permet de trouver rapidement des lignes sans parcourir toute la table. C\'est comme l\'index alphabétique d\'un livre : on saute directement à la bonne page.</p>',
          'darija' => '<p><strong>Index</strong> hiya structure zayda katkhalli tlqa lignes b sor3a bla ma tdowez table kamla. B7al index alphabétique dyal ktab : katqbez nichan l page mzyana.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Créer un index',
          'code' => 'CREATE INDEX idx_etudiant_filiere ON etudiant (filiere);
CREATE UNIQUE INDEX idx_etudiant_email ON etudiant (email);

DROP INDEX idx_etudiant_filiere;',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Index sur une colonne filtrée',
          'lang' => 'sql',
          'code' => 'CREATE INDEX idx_note_valeur ON note (valeur);

SELECT etudiant_id, valeur
FROM note
WHERE valeur >= 16;',
          'output' => 'etudiant_id | valeur
1           | 16.0
4           | 18.5',
          'explainFr' => 'Avec l\'index, la base peut aller directement aux valeurs ≥ 16 au lieu de lire les 10 lignes une par une. Sur 10 lignes l\'écart est invisible ; sur un million, il est décisif.',
          'explainDarija' => 'B index, base t9der tmchi nichan l valeurs ≥ 16 blast ma tqra 10 lignes wa7d b wa7d. 3la 10 lignes far9 ma kaybanch ; 3la million, far9 kbir.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Les clés sont déjà indexées',
          'fr' => '<code>PRIMARY KEY</code> et <code>UNIQUE</code> créent automatiquement un index. Inutile d\'en ajouter un manuellement sur <code>id</code>.',
          'darija' => '<code>PRIMARY KEY</code> w <code>UNIQUE</code> kay5alqo index automatiquement. Ma khassekch tzid wa7ed b yeddek 3la <code>id</code>.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'index-composite-explain',
      'title' => 'Index composite et EXPLAIN',
      'icon' => '🧭',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un <strong>index composite</strong> porte sur plusieurs colonnes. L\'ordre compte : un index <code>(filiere, nom)</code> sert à filtrer par filière, puis par nom, mais pas à filtrer par nom seul. <code>EXPLAIN</code> montre le plan d\'exécution choisi par la base.</p>',
          'darija' => '<p><strong>Index composite</strong> kaykoun 3la bzaf colonnes. Tartib mohim : index <code>(filiere, nom)</code> kaykhdem l filtrage b filière, men ba3d b nom, walakin machi l filtrage b nom bo7do. <code>EXPLAIN</code> kaybayen plan d\'exécution li khtarou base.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Index composite',
          'lang' => 'sql',
          'code' => 'CREATE INDEX idx_etudiant_filiere_nom ON etudiant (filiere, nom);

-- utilise l\'index : filiere en premier
SELECT nom FROM etudiant WHERE filiere = \'GI\' ORDER BY nom;

-- n\'utilise pas l\'index pour filtrer : nom seul
SELECT nom FROM etudiant WHERE nom = \'Kortaf\';',
          'explainFr' => 'La première requête profite de l\'index car elle commence par la première colonne de l\'index. La seconde ne peut pas s\'appuyer dessus pour le filtre.',
          'explainDarija' => 'Requête lawla katstafed men index 7it katbda b colonne lawla dyal index. Tanya ma tqderch t3tamed 3lih f filtre.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Lire un plan d\'exécution',
          'lang' => 'sql',
          'code' => 'EXPLAIN SELECT nom
FROM etudiant
WHERE filiere = \'GI\';',
          'output' => 'SEARCH etudiant USING INDEX idx_etudiant_filiere_nom (filiere=?)',
          'explainFr' => 'La mention <code>USING INDEX</code> confirme que l\'index est utilisé. Si vous lisez <code>SCAN etudiant</code>, la base parcourt toute la table.',
          'explainDarija' => '<code>USING INDEX</code> kat2ekked index kaytsta3mel. Ila qriti <code>SCAN etudiant</code>, base katdowez table kamla.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Trop d\'index nuit',
          'fr' => 'Chaque index accélère les lectures mais ralentit les <code>INSERT</code>, <code>UPDATE</code> et <code>DELETE</code>, car il faut le mettre à jour. Indexez les colonnes réellement filtrées ou jointes, pas toutes.',
          'darija' => 'Kol index kayserre3 qraya walakin kaybette2 <code>INSERT</code>, <code>UPDATE</code> w <code>DELETE</code>, 7it khas ytbeddel. Indexi colonnes li kaytfiltraw wla kaytrbeto bzzaf, machi kolchi.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'SELECT * FROM (SELECT ... ) sans créer de vue, recopié dans 10 fichiers',
      'fix' => 'CREATE VIEW nom_vue AS SELECT ... puis SELECT * FROM nom_vue',
      'fr' => 'Dupliquer une requête complexe la rend impossible à maintenir. Une vue centralise la logique.',
      'darija' => 'Tkrar requête m3eqda kay3mel maintenance mstahila. Vue katjem3 logique f blasa wa7da.',
    ),
    1 => 
    array (
      'wrong' => 'CREATE INDEX sur chaque colonne',
      'fix' => 'Indexer seulement les colonnes des WHERE, JOIN et ORDER BY fréquents.',
      'fr' => 'Trop d\'index ralentissent les écritures et consomment de l\'espace disque.',
      'darija' => 'Bzaf index kaybette2o écritures w kayakhdo espace disque.',
    ),
    2 => 
    array (
      'wrong' => 'WHERE UPPER(nom) = \'AMAL\' avec un index sur nom',
      'fix' => 'Éviter les fonctions sur la colonne indexée, ou créer un index fonctionnel.',
      'fr' => 'Appliquer une fonction à la colonne empêche la base d\'utiliser l\'index simple.',
      'darija' => 'Ttbeq fonction 3la colonne kaymna3 base testa3mel index 3adi.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une <strong>vue</strong> enregistre une requête sous un nom et simplifie la lecture comme la sécurité. Un <strong>index</strong> accélère les recherches sur les colonnes filtrées ou jointes, surtout en composite <code>(col1, col2)</code> où l\'ordre compte. <code>EXPLAIN</code> vérifie le plan d\'exécution. Trop d\'index pénalisent les écritures.',
    'darija' => '<strong>Vue</strong> katsejjel requête b smiya w katsahhel qraya w sécurité. <strong>Index</strong> kayserre3 recherche 3la colonnes li kaytfiltraw wla kaytrbeto, khasatan composite <code>(col1, col2)</code> fin tartib mohim. <code>EXPLAIN</code> kayt7eqqeq plan d\'exécution. Bzaf index kaydarr bijeht écritures.',
  ),
);
