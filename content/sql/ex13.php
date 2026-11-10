<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex13.php
 */

return array (
  'id' => 'sql-ex13',
  'title' => 'Views et indexes',
  'brief' => 'Créer des vues réutilisables et accélérer les recherches avec des index.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — CREATE VIEW',
      'lang' => 'sql',
      'instructions' => '<p>Crée une vue <code>vue_etudiants_gi</code> qui sélectionne <code>id</code>, <code>nom</code> et <code>prenom</code> des étudiants de la filière <code>GI</code>. Interroge ensuite la vue.</p>',
      'instructionsDarija' => '<p>5leq vue <code>vue_etudiants_gi</code> li katkhtar <code>id</code>, <code>nom</code> w <code>prenom</code> dyal étudiants f filière <code>GI</code>. Men ba3d ste9se vue.</p>',
      'starter' => '-- CREATE VIEW puis SELECT
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
          'value' => '3',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Kortaf',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => 'Sekkat',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une vue se crée avec CREATE VIEW nom AS requête.',
        1 => 'La vue se comporte comme une table en lecture.',
        2 => 'Le WHERE filtre les étudiants de GI.',
      ),
      'solution' => 'DROP VIEW IF EXISTS vue_etudiants_gi;

CREATE VIEW vue_etudiants_gi AS
SELECT id, nom, prenom
FROM etudiant
WHERE filiere = \'GI\';

SELECT nom, prenom
FROM vue_etudiants_gi
ORDER BY nom;',
      'explainFr' => 'La vue ne stocke pas de données : elle enregistre la requête et l\'exécute à chaque lecture. Les trois étudiants de GI apparaissent sans que l\'on réécrive le filtre.',
      'explainDarija' => 'Vue ma katkhzench données : katsejjel requête w kattnffedha f kol qraya. Tlata étudiants dyal GI kaybanou bla ma n3awdo nkteb filtre.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — CREATE INDEX',
      'lang' => 'sql',
      'instructions' => '<p>Crée un index <code>idx_etudiant_filiere</code> sur la colonne <code>filiere</code> de la table <code>etudiant</code>, puis vérifie sa présence dans <code>sqlite_master</code>.</p>',
      'instructionsDarija' => '<p>5leq index <code>idx_etudiant_filiere</code> 3la colonne <code>filiere</code> dyal table <code>etudiant</code>, men ba3d t7eqqeq wujud dyalo f <code>sqlite_master</code>.</p>',
      'starter' => '-- CREATE INDEX puis vérification
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
          'value' => 'idx_etudiant_filiere',
        ),
      ),
      'hints' => 
      array (
        0 => 'CREATE INDEX nom ON table (colonne) crée l\'index.',
        1 => 'DROP INDEX IF EXISTS rend le script rejouable.',
        2 => 'sqlite_master liste les objets de la base.',
      ),
      'solution' => 'DROP INDEX IF EXISTS idx_etudiant_filiere;

CREATE INDEX idx_etudiant_filiere ON etudiant (filiere);

SELECT name
FROM sqlite_master
WHERE type = \'index\' AND name = \'idx_etudiant_filiere\';',
      'explainFr' => 'L\'index est une structure annexe qui accélère les recherches et les tris sur <code>filiere</code>. Il ne change pas le résultat des requêtes, seulement leur coût.',
      'explainDarija' => 'Index structure annexe li kat3ejjel recherches w tris 3la <code>filiere</code>. Ma kaybeddelch résultat dyal requêtes, ghir coût dyalhom.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — vue agrégée',
      'lang' => 'sql',
      'instructions' => '<p>Crée une vue <code>vue_moyennes</code> qui affiche pour chaque étudiant son <code>nom</code> et sa moyenne arrondie à deux décimales. Interroge la vue pour les moyennes supérieures ou égales à <code>14</code>, triées de la meilleure à la moins bonne.</p>',
      'instructionsDarija' => '<p>5leq vue <code>vue_moyennes</code> li kat3red l kol étudiant <code>nom</code> dyalo w moyenne mroundiya l jouj décimales. Ste9se vue l moyennes kbarin wla sawiyin <code>14</code>, mrtbin men l-7sen l l-9el.</p>',
      'starter' => '-- vue avec AVG, puis filtre
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
          'value' => '3',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => 'Sekkat',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => '15.17',
        ),
      ),
      'hints' => 
      array (
        0 => 'La vue peut contenir un GROUP BY et des agrégats.',
        1 => 'ROUND(AVG(...), 2) arrondit la moyenne.',
        2 => 'On filtre la vue avec WHERE comme une table.',
      ),
      'solution' => 'DROP VIEW IF EXISTS vue_moyennes;

CREATE VIEW vue_moyennes AS
SELECT e.id, e.nom, ROUND(AVG(n.valeur), 2) AS moyenne
FROM etudiant e
JOIN note n ON n.etudiant_id = e.id
GROUP BY e.id, e.nom;

SELECT nom, moyenne
FROM vue_moyennes
WHERE moyenne >= 14
ORDER BY moyenne DESC;',
      'explainFr' => 'La vue centralise le calcul de moyenne. Trois étudiants dépassent 14 : Sekkat (18.5), Kortaf (15.17) et Marzak (14.75).',
      'explainDarija' => 'Vue katjem3 calcul dyal moyenne. Tlata étudiants kayfouto 14 : Sekkat (18.5), Kortaf (15.17) w Marzak (14.75).',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
