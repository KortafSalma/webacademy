<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c12.json
 */

return array (
  'id' => 'sql-ch12',
  'title' => 'Transactions',
  'subtitle' => 'Tout réussit ou tout est annulé',
  'objectives' => 
  array (
    0 => 'Comprendre le principe d\'une transaction.',
    1 => 'Utiliser BEGIN, COMMIT et ROLLBACK.',
    2 => 'Reconnaître les propriétés ACID.',
    3 => 'Créer des points de sauvegarde avec SAVEPOINT.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'principe-transaction',
      'title' => 'Le principe',
      'icon' => '🎬',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>transaction</strong> regroupe plusieurs opérations en une seule unité logique : soit <strong>toutes</strong> réussissent, soit <strong>aucune</strong> n\'est appliquée. Exemple : un virement débite un compte et crédite un autre ; les deux opérations doivent réussir ensemble.</p>',
          'darija' => '<p><strong>Transaction</strong> katjem3 bzaf opérations f unité logique wa7da : ya <strong>kolchi</strong> kaynjah, ya <strong>walou</strong> ma kaytbeq. Exemple : virement kaynqes men compte w kayzid f akhor ; jouj opérations khas ynjho m3a b3dhom.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'BEGIN;
-- opérations
COMMIT;      -- valide définitivement

-- ou
BEGIN;
-- opérations
ROLLBACK;    -- annule tout',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Virement bancaire',
          'lang' => 'sql',
          'code' => 'CREATE TABLE compte (id INT PRIMARY KEY, titulaire VARCHAR(40), solde DECIMAL(8,2));
INSERT INTO compte VALUES (1, \'Amal\', 1000.00), (2, \'Omar\', 500.00);

BEGIN;
UPDATE compte SET solde = solde - 200 WHERE id = 1;
UPDATE compte SET solde = solde + 200 WHERE id = 2;
COMMIT;

SELECT * FROM compte;',
          'output' => 'id | titulaire | solde
1  | Amal      | 800.00
2  | Omar      | 700.00',
          'explainFr' => 'Les deux UPDATE forment une seule transaction. Si le second échouait, un ROLLBACK annulerait aussi le premier : l\'argent ne peut pas disparaître.',
          'explainDarija' => 'Jouj UPDATE kaykono transaction wa7da. Ila tani fchel, ROLLBACK katlghi 7ta lwel : flous ma y9droch ydi3o.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Transactions et moteurs',
          'fr' => 'MySQL : utilisez le moteur <strong>InnoDB</strong> (MyISAM ignore les transactions). SQLite : les transactions sont supportées, mais démarrez-les explicitement.',
          'darija' => 'MySQL : khdem b moteur <strong>InnoDB</strong> (MyISAM kayjhel transactions). SQLite : transactions kaynin, walakin bda bihom b wad7.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'acid',
      'title' => 'Les propriétés ACID',
      'icon' => '🧪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Propriété',
            1 => 'Signification',
            2 => 'Exemple',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Atomicité',
              1 => 'tout ou rien',
              2 => 'le virement ne peut pas débiter seul',
            ),
            1 => 
            array (
              0 => 'Cohérence',
              1 => 'règles respectées avant et après',
              2 => 'somme des soldes inchangée',
            ),
            2 => 
            array (
              0 => 'Isolation',
              1 => 'les transactions concurrentes ne se perturbent pas',
              2 => 'deux virements simultanés restent corrects',
            ),
            3 => 
            array (
              0 => 'Durabilité',
              1 => 'validé = conservé, même après coupure',
              2 => 'après COMMIT, la donnée survit au crash',
            ),
          ),
          'fr' => 'ACID est le contrat de fiabilité d\'une base relationnelle.',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'ROLLBACK annule tout',
          'lang' => 'sql',
          'code' => 'CREATE TABLE stock (id INT PRIMARY KEY, quantite INT);
INSERT INTO stock VALUES (1, 10);

BEGIN;
UPDATE stock SET quantite = quantite - 3 WHERE id = 1;
ROLLBACK;

SELECT quantite FROM stock;',
          'output' => 'quantite
10',
          'explainFr' => 'La quantité a été temporairement modifiée à 7, puis le ROLLBACK a restauré la valeur initiale 10. Aucune trace de l\'opération n\'est conservée.',
          'explainDarija' => 'Quantité tbeddlat temporairement l 7, men ba3d ROLLBACK rje3ha l 10. 7ta trace dyal opération ma bqat.',
        ),
        2 => 
        array (
          'type' => 'tip',
          'title' => 'Garder les transactions courtes',
          'fr' => 'Une transaction ouverte trop longtemps bloque les autres opérations. Faites les calculs en PHP avant, puis ouvrez la transaction juste pour les écritures.',
          'darija' => 'Transaction m7lola twil katbloki opérations okhrin. Dir calculs f PHP qbel, men ba3d 7el transaction ghir l écritures.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'savepoint',
      'title' => 'SAVEPOINT et erreurs',
      'icon' => '📍',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><code>SAVEPOINT nom</code> crée un point intermédiaire dans une transaction. <code>ROLLBACK TO nom</code> annule seulement les opérations après ce point, sans perdre le début du travail.</p>',
          'darija' => '<p><code>SAVEPOINT nom</code> kay5leq point intermédiaire f transaction. <code>ROLLBACK TO nom</code> kaylghi ghir opérations li mora had point, bla ma ykhesr lbda dyal lkhdma.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Annuler une partie seulement',
          'lang' => 'sql',
          'code' => 'CREATE TABLE journal (id INT PRIMARY KEY, message VARCHAR(80));

BEGIN;
INSERT INTO journal VALUES (1, \'Début\');
SAVEPOINT apres_debut;
INSERT INTO journal VALUES (2, \'Erreur\');
ROLLBACK TO apres_debut;
INSERT INTO journal VALUES (3, \'Suite\');
COMMIT;

SELECT * FROM journal;',
          'output' => 'id | message
1  | Début
3  | Suite',
          'explainFr' => 'L\'insertion 2 est annulée par le rollback partiel ; les insertions 1 et 3 sont validées par le COMMIT final.',
          'explainDarija' => 'Insertion 2 tlghat b rollback partiel ; insertions 1 w 3 tvaliden b COMMIT final.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => 'En PHP avec PDO',
          'fr' => '<code>$pdo-&gt;beginTransaction()</code>, <code>$pdo-&gt;commit()</code>, <code>$pdo-&gt;rollBack()</code>. Placez le commit dans un <code>try</code> et le rollback dans le <code>catch</code> pour garantir l\'annulation en cas d\'exception.',
          'darija' => '<code>$pdo-&gt;beginTransaction()</code>, <code>$pdo-&gt;commit()</code>, <code>$pdo-&gt;rollBack()</code>. 7et commit f <code>try</code> w rollback f <code>catch</code> bach tdmen annulation ila kan exception.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'BEGIN; UPDATE ...; (sans COMMIT)',
      'fix' => 'Toujours terminer par COMMIT ou ROLLBACK.',
      'fr' => 'Une transaction laissée ouverte bloque les autres et peut être perdue à la fermeture de la connexion.',
      'darija' => 'Transaction m7lola katbloki lokhrin w t9der tdi3 melli connexion katsedd.',
    ),
    1 => 
    array (
      'wrong' => 'Utiliser MyISAM pour des opérations financières',
      'fix' => 'Utiliser InnoDB, qui supporte les transactions.',
      'fr' => 'MyISAM ne gère ni transactions ni clés étrangères : aucune garantie de rollback.',
      'darija' => 'MyISAM ma kayt7ekkemch f transactions wla clés étrangères : 7ta daman dyal rollback.',
    ),
    2 => 
    array (
      'wrong' => 'Faire un COMMIT puis continuer à utiliser le rollback',
      'fix' => 'Un COMMIT clôt la transaction : un rollback ultérieur n\'a plus d\'effet.',
      'darija' => 'COMMIT katsedd transaction : rollback men ba3d ma 3ndoch ta2thir.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une <strong>transaction</strong> rend plusieurs opérations atomiques : <code>BEGIN</code> démarre, <code>COMMIT</code> valide, <code>ROLLBACK</code> annule. Les propriétés <strong>ACID</strong> (atomicité, cohérence, isolation, durabilité) garantissent la fiabilité. <code>SAVEPOINT</code> permet d\'annuler une partie seulement. En PHP, PDO propose <code>beginTransaction</code>, <code>commit</code> et <code>rollBack</code>.',
    'darija' => '<strong>Transaction</strong> kat3mel bzaf opérations atomiques : <code>BEGIN</code> kaybda, <code>COMMIT</code> kayvalidi, <code>ROLLBACK</code> kaylghi. Propriétés <strong>ACID</strong> (atomicité, cohérence, isolation, durabilité) kaydmeno fiabilité. <code>SAVEPOINT</code> kaykhalli tlghi part wa7da. F PHP, PDO kay3ti <code>beginTransaction</code>, <code>commit</code> w <code>rollBack</code>.',
  ),
);
