<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c06.json
 */

return array (
  'id' => 'sql-ch6',
  'title' => 'Filtrage (WHERE)',
  'subtitle' => 'Extraire uniquement les lignes qui vous intéressent',
  'objectives' => 
  array (
    0 => 'Filtrer avec les opérateurs de comparaison.',
    1 => 'Combiner des conditions avec AND, OR et NOT.',
    2 => 'Rechercher un motif avec LIKE.',
    3 => 'Utiliser IN, BETWEEN et IS NULL.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'comparaisons',
      'title' => 'Comparaisons de base',
      'icon' => '⚖️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>La clause <strong>WHERE</strong> filtre les lignes : seules celles dont la condition est vraie sont renvoyées. Les opérateurs classiques sont <code>=</code>, <code>!=</code>, <code>&lt;</code>, <code>&lt;=</code>, <code>&gt;</code>, <code>&gt;=</code>.</p>',
          'darija' => '<p>Clause <strong>WHERE</strong> katfiltri lignes : ghir li condition dyalhom vraie kayrj3o. Opérateurs 3adiyin : <code>=</code>, <code>!=</code>, <code>&lt;</code>, <code>&lt;=</code>, <code>&gt;</code>, <code>&gt;=</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Notes supérieures à 14',
          'lang' => 'sql',
          'code' => 'SELECT etudiant, valeur
FROM note
WHERE valeur > 14;',
          'output' => 'etudiant | valeur
Kortaf   | 14.5
Boukhriss| 18.5
Kortaf   | 16.0',
          'explainFr' => 'Seules les notes strictement supérieures à 14 sont conservées. Pour inclure 14, il faudrait écrire <code>&gt;= 14</code>.',
          'explainDarija' => 'Ghir notes li kbar men 14 b sor3a kaybqaw. Bach tdkhel 14, khas tkteb <code>&gt;= 14</code>.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Opérateur',
            1 => 'Signification',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '=',
              1 => 'égal',
              2 => 'filiere = \'GI\'',
            ),
            1 => 
            array (
              0 => '!=',
              1 => 'différent',
              2 => 'filiere != \'GC\'',
            ),
            2 => 
            array (
              0 => '>',
              1 => 'strictement supérieur',
              2 => 'valeur > 14',
            ),
            3 => 
            array (
              0 => '>=',
              1 => 'supérieur ou égal',
              2 => 'valeur >= 14',
            ),
            4 => 
            array (
              0 => '<',
              1 => 'strictement inférieur',
              2 => 'valeur < 10',
            ),
            5 => 
            array (
              0 => '<=',
              1 => 'inférieur ou égal',
              2 => 'valeur <= 10',
            ),
          ),
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'and-or-not',
      'title' => 'AND, OR et NOT',
      'icon' => '🔗',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>AND</code> exige que les deux conditions soient vraies, <code>OR</code> en exige une seule, <code>NOT</code> inverse une condition. Attention à la priorité : <code>AND</code> passe avant <code>OR</code>, utilisez des parenthèses pour clarifier.</p>',
          'darija' => '<p><code>AND</code> kayferd jouj conditions vraies, <code>OR</code> kayferd wa7da, <code>NOT</code> kayqleb condition. 3ndak priorité : <code>AND</code> kayji qbel <code>OR</code>, khdem b parenthèses bach twadde7.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Étudiants GI avec une bonne note',
          'lang' => 'sql',
          'code' => 'SELECT e.nom, e.filiere, n.valeur
FROM etudiant e
JOIN note n ON n.etudiant_id = e.id
WHERE e.filiere = \'GI\' AND n.valeur >= 15;',
          'output' => 'nom   | filiere | valeur
Kortaf| GI      | 16.0
Kortaf| GI      | 15.5
Sekkat| GI      | 18.5',
          'explainFr' => 'Les deux conditions doivent être vraies : l\'étudiant est en GI <em>et</em> sa note atteint 15.',
          'explainDarija' => 'Jouj conditions khas ykono vraies : etudiant f GI <em>w</em> note dyalo wselt 15.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'OR et parenthèses',
          'lang' => 'sql',
          'code' => 'SELECT nom, filiere
FROM etudiant
WHERE filiere = \'GI\' OR filiere = \'3IA\';',
          'output' => 'nom    | filiere
Kortaf | GI
Marzak | GI
Sekkat | GI
Tazi   | 3IA',
          'explainFr' => '<code>OR</code> garde les étudiants de l\'une ou l\'autre filière. Sans parenthèses, mélanger AND et OR peut produire un résultat inattendu.',
          'explainDarija' => '<code>OR</code> kay7fed étudiants dyal wa7d men filières. Bla parenthèses, tkhlit AND w OR y9der y3ti résultat ma tsenach.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Piège classique',
          'fr' => '<code>WHERE filiere = \'GI\' OR filiere = \'GC\' AND valeur > 10</code> ne fait pas ce qu\'on croit : le AND s\'applique d\'abord. Écrivez <code>WHERE (filiere = \'GI\' OR filiere = \'GC\') AND valeur > 10</code>.',
          'darija' => '<code>WHERE filiere = \'GI\' OR filiere = \'GC\' AND valeur > 10</code> ma kaydirch li kaytweqqe3 : AND kaytbeq lwel. Kteb <code>WHERE (filiere = \'GI\' OR filiere = \'GC\') AND valeur > 10</code>.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'like-in-between',
      'title' => 'LIKE, IN et BETWEEN',
      'icon' => '🔍',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>LIKE</strong> cherche un motif : <code>%</code> remplace n\'importe quelle suite de caractères, <code>_</code> un seul caractère. <strong>IN</strong> teste l\'appartenance à une liste. <strong>BETWEEN</strong> teste un intervalle inclusif.</p>',
          'darija' => '<p><strong>LIKE</strong> kayqelleb 3la motif : <code>%</code> kay3awed ay suite dyal caractères, <code>_</code> caractère wa7ed. <strong>IN</strong> kaytesti wach valeur f lista. <strong>BETWEEN</strong> kaytesti intervalle li kaydkhel jouj tarafin.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Motif',
            1 => 'Correspond à',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => '\'A%\'',
              1 => 'commence par A',
              2 => 'nom LIKE \'A%\'',
            ),
            1 => 
            array (
              0 => '\'%a\'',
              1 => 'termine par a',
              2 => 'nom LIKE \'%a\'',
            ),
            2 => 
            array (
              0 => '\'%mal%\'',
              1 => 'contient mal',
              2 => 'nom LIKE \'%mal%\'',
            ),
            3 => 
            array (
              0 => '\'_mal\'',
              1 => 'un caractère puis mal',
              2 => 'nom LIKE \'_mal\'',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Rechercher un nom',
          'lang' => 'sql',
          'code' => 'SELECT nom FROM etudiant
WHERE nom LIKE \'%ar%\';',
          'output' => 'nom
Marzak',
          'explainFr' => '<code>%ar%</code> trouve « Marzak » car la suite « ar » apparaît au milieu. La casse dépend du moteur et de la collation.',
          'explainDarija' => '<code>%ar%</code> katlqa « Marzak » 7it « ar » kayna f wost. Casse kat3tamed 3la moteur w collation.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'IN et BETWEEN',
          'lang' => 'sql',
          'code' => 'SELECT nom, filiere
FROM etudiant
WHERE filiere IN (\'GI\', \'3IA\');

SELECT etudiant, valeur
FROM note
WHERE valeur BETWEEN 12 AND 16;',
          'output' => 'nom    | filiere
Kortaf | GI
Marzak | GI
Sekkat | GI
Tazi   | 3IA',
          'explainFr' => '<code>IN</code> remplace une longue suite de OR. <code>BETWEEN 12 AND 16</code> inclut 12 et 16.',
          'explainDarija' => '<code>IN</code> kat3awed blast suite twila dyal OR. <code>BETWEEN 12 AND 16</code> kaydkhel 12 w 16.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'is-null',
      'title' => 'IS NULL',
      'icon' => '🕳️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>NULL</code> signifie « inconnu ». Aucune comparaison avec <code>=</code>, <code>!=</code> ou même <code>&lt;&gt;</code> ne peut le détecter. Il faut utiliser <code>IS NULL</code> ou <code>IS NOT NULL</code>.</p>',
          'darija' => '<p><code>NULL</code> kat3ni « ma m3erfach ». 7ta comparaison b <code>=</code>, <code>!=</code> wla <code>&lt;&gt;</code> ma t9der tlkaha. Khas tkhdem b <code>IS NULL</code> wla <code>IS NOT NULL</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Notes sans professeur',
          'lang' => 'sql',
          'code' => 'SELECT etudiant_id, matiere_id, valeur
FROM note
WHERE professeur_id IS NULL;',
          'output' => 'etudiant_id | matiere_id | valeur
3           | 4          | 13.0',
          'explainFr' => 'Dans le dataset school, une note a été saisie sans professeur : <code>professeur_id</code> vaut NULL. <code>WHERE professeur_id = NULL</code> n\'aurait rien renvoyé.',
          'explainDarija' => 'F dataset school, wa7d note dkhlat bla prof : <code>professeur_id</code> NULL. <code>WHERE professeur_id = NULL</code> ma kanet ghadi trje3 walou.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'NULL et les calculs',
          'fr' => 'Toute opération avec NULL renvoie NULL : <code>NULL + 5</code> vaut NULL. Utilisez <code>COALESCE(colonne, 0)</code> pour remplacer NULL par une valeur par défaut.',
          'darija' => 'Ay opération m3a NULL katrje3 NULL : <code>NULL + 5</code> kat3ti NULL. Khdem b <code>COALESCE(colonne, 0)</code> bach tbeddel NULL b valeur par défaut.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'WHERE email = NULL',
      'fix' => 'WHERE email IS NULL',
      'fr' => 'Comparer à NULL avec = ne renvoie jamais vrai. IS NULL est le seul test correct.',
      'darija' => 'Qaren m3a NULL b = 3omro ma kayrje3 vrai. IS NULL howa test s7i7.',
    ),
    1 => 
    array (
      'wrong' => 'WHERE nom LIKE \'A\'',
      'fix' => 'WHERE nom LIKE \'A%\'',
      'fr' => 'Sans %, LIKE cherche exactement la chaîne « A ». Le % représente la suite de caractères.',
      'darija' => 'Bla %, LIKE katqelleb 3la « A » b dqiq. % kaymettel baqi dyal caractères.',
    ),
    2 => 
    array (
      'wrong' => 'WHERE filiere = \'GI\' OR \'GC\'',
      'fix' => 'WHERE filiere IN (\'GI\', \'GC\')',
      'fr' => 'Une colonne doit être répétée dans chaque comparaison, sinon la condition est toujours vraie.',
      'darija' => 'Colonne khas tt3awed f kol comparaison, sinon condition dima vraie.',
    ),
    3 => 
    array (
      'wrong' => 'BETWEEN 16 AND 12',
      'fix' => 'BETWEEN 12 AND 16',
      'fr' => 'BETWEEN attend la borne basse puis la borne haute : l\'ordre inverse ne renvoie rien.',
      'darija' => 'BETWEEN kayakhod borne sghira men ba3d kbira : l\'3aks ma kayrje3 walou.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>WHERE</strong> filtre les lignes selon une condition. On combine avec <code>AND</code>, <code>OR</code>, <code>NOT</code> (en pensant aux parenthèses), on cherche un motif avec <code>LIKE</code>, une liste avec <code>IN</code>, un intervalle avec <code>BETWEEN</code>, et l\'absence de valeur avec <code>IS NULL</code>. Toute comparaison avec NULL via <code>=</code> est fausse.',
    'darija' => '<strong>WHERE</strong> kayfiltri lignes 3la 7sab condition. Kanjem3o b <code>AND</code>, <code>OR</code>, <code>NOT</code> (b parenthèses), kanqellbo 3la motif b <code>LIKE</code>, lista b <code>IN</code>, intervalle b <code>BETWEEN</code>, w absence b <code>IS NULL</code>. Ay comparaison m3a NULL b <code>=</code> katkon ghalta.',
  ),
);
