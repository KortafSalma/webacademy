<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c07.json
 */

return array (
  'id' => 'sql-ch7',
  'title' => 'Tri et groupement',
  'subtitle' => 'Ordonner les résultats et regrouper les lignes',
  'objectives' => 
  array (
    0 => 'Trier avec ORDER BY en ordre croissant ou décroissant.',
    1 => 'Trier sur plusieurs colonnes.',
    2 => 'Regrouper avec GROUP BY et calculer par catégorie.',
    3 => 'Filtrer les groupes avec HAVING et paginer avec LIMIT.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'order-by',
      'title' => 'ORDER BY',
      'icon' => '⬆️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Sans <code>ORDER BY</code>, l\'ordre des lignes n\'est <strong>pas garanti</strong>. <code>ORDER BY colonne ASC</code> trie du plus petit au plus grand, <code>DESC</code> l\'inverse. On peut trier sur plusieurs colonnes.</p>',
          'darija' => '<p>Bla <code>ORDER BY</code>, tartib dyal lignes <strong>ma madmonch</strong>. <code>ORDER BY colonne ASC</code> kayrteb men sghir l kbir, <code>DESC</code> l\'3aks. T9der trteb 3la bzaf colonnes.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Notes de la meilleure à la plus faible',
          'lang' => 'sql',
          'code' => 'SELECT etudiant_id, valeur
FROM note
ORDER BY valeur DESC;',
          'output' => 'etudiant_id | valeur
4           | 18.5
2           | 17.0
1           | 16.0
1           | 15.0
3           | 13.0
1           | 14.5
2           | 12.5
3           | 9.0
5           | 11.8
5           | 11.0',
          'explainFr' => 'Le tri décroissant place la meilleure note en premier. Pour un classement lisible, ajoutez une colonne de départage : <code>ORDER BY valeur DESC, etudiant_id ASC</code>.',
          'explainDarija' => 'Tri décroissant kay7et 7sen note f lwel. L classement wad7, zid colonne dyal départage : <code>ORDER BY valeur DESC, etudiant_id ASC</code>.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Tri sur deux colonnes',
          'lang' => 'sql',
          'code' => 'SELECT nom, filiere
FROM etudiant
ORDER BY filiere ASC, nom ASC;',
          'output' => 'nom    | filiere
Tazi   | 3IA
Boukhriss | GC
Kortaf | GI
Marzak | GI
Sekkat | GI',
          'explainFr' => 'Les étudiants sont d\'abord groupés par filière, puis triés par nom à l\'intérieur de chaque filière.',
          'explainDarija' => 'Étudiants kayrtebto lwel b filière, men ba3d b nom dakhel kol filière.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'NULL en premier ou en dernier ?',
          'fr' => 'Selon le moteur, les NULL apparaissent au début ou à la fin du tri. Pour forcer un ordre, utilisez <code>ORDER BY (colonne IS NULL), colonne</code> ou <code>COALESCE()</code>.',
          'darija' => '3la 7sab moteur, NULL kaybano f lbda wla l\'akhir. Bach tferd tartib, khdem b <code>ORDER BY (colonne IS NULL), colonne</code> wla <code>COALESCE()</code>.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'group-by',
      'title' => 'GROUP BY',
      'icon' => '📊',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>GROUP BY</code> regroupe les lignes qui partagent une même valeur, puis applique une fonction d\'agrégation à chaque groupe. Chaque groupe produit <strong>une seule ligne</strong> dans le résultat.</p>',
          'darija' => '<p><code>GROUP BY</code> kayjem3 lignes li 3ndhom nefs valeur, men ba3d kaytbeq fonction d\'agrégation 3la kol groupe. Kol groupe kay3ti <strong>ligne wa7da</strong> f résultat.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Nombre de notes par étudiant',
          'lang' => 'sql',
          'code' => 'SELECT etudiant_id, COUNT(*) AS nombre_notes, AVG(valeur) AS moyenne
FROM note
GROUP BY etudiant_id
ORDER BY moyenne DESC;',
          'output' => 'etudiant_id | nombre_notes | moyenne
4           | 1            | 18.5
2           | 2            | 14.75
1           | 3            | 15.17
5           | 2            | 11.4
3           | 2            | 11.0',
          'explainFr' => 'Les 10 notes sont réparties en 5 groupes (un par étudiant). <code>COUNT(*)</code> et <code>AVG()</code> sont calculés à l\'intérieur de chaque groupe.',
          'explainDarija' => '10 notes tqesmo 3la 5 groupes (kol etudiant). <code>COUNT(*)</code> w <code>AVG()</code> kayt7esbo dakhel kol groupe.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Moyenne par matière',
          'lang' => 'sql',
          'code' => 'SELECT m.nom AS matiere, AVG(n.valeur) AS moyenne
FROM note n
JOIN matiere m ON m.id = n.matiere_id
GROUP BY m.nom
ORDER BY moyenne DESC;',
          'output' => 'matiere         | moyenne
PHP             | 15.67
Base de donnees | 13.4
Anglais         | 13.0
Math            | 12.88',
          'explainFr' => 'Le regroupement porte sur le nom de la matière. La jointure permet d\'afficher un libellé lisible au lieu de l\'identifiant.',
          'explainDarija' => 'Regroupement 3la smiya dyal matière. Jointure katkhalli t3red libellé mqrou instead of identifiant.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Colonnes non agrégées',
          'fr' => 'Toute colonne du <code>SELECT</code> qui n\'est pas dans une fonction d\'agrégation doit figurer dans le <code>GROUP BY</code>. Sinon le résultat est indéterminé (ou refusé en mode strict).',
          'darija' => 'Kol colonne f <code>SELECT</code> li machi f fonction d\'agrégation khas tkon f <code>GROUP BY</code>. Sinon résultat ma m7eddch (wla kaytrefus f mode strict).',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'having-limit',
      'title' => 'HAVING et LIMIT',
      'icon' => '🎯',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>WHERE</code> filtre les lignes <strong>avant</strong> le regroupement ; <code>HAVING</code> filtre les groupes <strong>après</strong>. <code>LIMIT n</code> ne garde que n lignes, <code>OFFSET m</code> saute les m premières : c\'est la base de la pagination.</p>',
          'darija' => '<p><code>WHERE</code> kayfiltri lignes <strong>qbel</strong> regroupement ; <code>HAVING</code> kayfiltri groupes <strong>men ba3d</strong>. <code>LIMIT n</code> kay7fed ghir n lignes, <code>OFFSET m</code> kayqbez m lwel : hadi asas pagination.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Clause',
            1 => 'S\'applique à',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'WHERE',
              1 => 'lignes',
              2 => 'valeur >= 10',
            ),
            1 => 
            array (
              0 => 'GROUP BY',
              1 => 'création des groupes',
              2 => 'GROUP BY etudiant_id',
            ),
            2 => 
            array (
              0 => 'HAVING',
              1 => 'groupes',
              2 => 'HAVING AVG(valeur) >= 14',
            ),
            3 => 
            array (
              0 => 'ORDER BY',
              1 => 'ordre final',
              2 => 'ORDER BY moyenne DESC',
            ),
            4 => 
            array (
              0 => 'LIMIT',
              1 => 'nombre de lignes final',
              2 => 'LIMIT 3',
            ),
          ),
          'fr' => 'Ordre logique d\'exécution : FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY → LIMIT.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Étudiants ayant au moins deux notes',
          'lang' => 'sql',
          'code' => 'SELECT etudiant_id, COUNT(*) AS nombre
FROM note
GROUP BY etudiant_id
HAVING COUNT(*) >= 2
ORDER BY nombre DESC;',
          'output' => 'etudiant_id | nombre
1           | 3
2           | 2
3           | 2
5           | 2',
          'explainFr' => '<code>WHERE COUNT(*) &gt;= 2</code> serait invalide : le WHERE ne connaît pas encore les groupes. C\'est le rôle de <code>HAVING</code>.',
          'explainDarija' => '<code>WHERE COUNT(*) &gt;= 2</code> ghalta : WHERE mazal ma kay3refch groupes. Hada role dyal <code>HAVING</code>.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Top 3 des notes',
          'lang' => 'sql',
          'code' => 'SELECT etudiant_id, valeur
FROM note
ORDER BY valeur DESC
LIMIT 3;',
          'output' => 'etudiant_id | valeur
4           | 18.5
2           | 17.0
1           | 16.0',
          'explainFr' => '<code>LIMIT 3</code> s\'applique après le tri : on obtient bien les trois meilleures notes. <code>LIMIT 3 OFFSET 3</code> donnerait le trio suivant.',
          'explainDarija' => '<code>LIMIT 3</code> kaytbeq men ba3d tri : kankhdmo 3 meilleures notes. <code>LIMIT 3 OFFSET 3</code> kat3ti trio li mora.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'HAVING sans GROUP BY pour filtrer une ligne',
      'fix' => 'Utiliser WHERE pour filtrer les lignes.',
      'fr' => 'HAVING est prévu pour les groupes. Pour une simple condition de ligne, WHERE est plus clair et plus rapide.',
      'darija' => 'HAVING makhssos l groupes. L condition 3adiya 3la ligne, WHERE awda7 w asra3.',
    ),
    1 => 
    array (
      'wrong' => 'SELECT nom, COUNT(*) FROM note',
      'fix' => 'SELECT etudiant_id, COUNT(*) FROM note GROUP BY etudiant_id',
      'fr' => 'Mélanger une colonne non groupée et une agrégation sans GROUP BY produit un résultat incohérent.',
      'darija' => 'Tkhlit colonne bla groupement m3a agrégation bla GROUP BY kay3ti résultat ma m7eddch.',
    ),
    2 => 
    array (
      'wrong' => 'WHERE COUNT(*) > 2',
      'fix' => 'HAVING COUNT(*) > 2',
      'fr' => 'Les agrégations ne sont pas disponibles dans WHERE : elles se filtrent dans HAVING.',
      'darija' => 'Agrégations ma kayninach f WHERE : kaytfiltraw f HAVING.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>ORDER BY</strong> trie (ASC/DESC, plusieurs colonnes), <strong>GROUP BY</strong> regroupe pour calculer des agrégats par catégorie, <strong>HAVING</strong> filtre les groupes après calcul et <strong>LIMIT/OFFSET</strong> pagine les résultats. L\'ordre logique est FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY → LIMIT.',
    'darija' => '<strong>ORDER BY</strong> kayrteb (ASC/DESC, bzaf colonnes), <strong>GROUP BY</strong> kayjem3 bach y7seb agrégats par catégorie, <strong>HAVING</strong> kayfiltri groupes men ba3d calcul w <strong>LIMIT/OFFSET</strong> kaypagini résultats. Tartib logique : FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY → LIMIT.',
  ),
);
