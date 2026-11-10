<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex12.php
 */

return array (
  'id' => 'sql-ex12',
  'title' => 'Transactions',
  'brief' => 'Valider, annuler et sécuriser un ensemble d\'opérations.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — BEGIN et COMMIT',
      'lang' => 'sql',
      'instructions' => '<p>Crée une table <code>compte_tx</code>, ouvre une transaction avec <code>BEGIN</code>, insère une ligne <code>Depot</code>, valide avec <code>COMMIT</code>, puis affiche le nombre de lignes.</p>',
      'instructionsDarija' => '<p>5leq table <code>compte_tx</code>, 7el transaction b <code>BEGIN</code>, dkhel ligne <code>Depot</code>, validi b <code>COMMIT</code>, men ba3d 3red 3adad lignes.</p>',
      'starter' => '-- table, transaction, COMMIT
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
          'value' => '1',
        ),
      ),
      'hints' => 
      array (
        0 => 'BEGIN démarre une transaction.',
        1 => 'COMMIT valide toutes les opérations en attente.',
        2 => 'La table doit exister avant l\'insertion.',
      ),
      'solution' => 'DROP TABLE IF EXISTS compte_tx;

CREATE TABLE compte_tx (
    id INTEGER PRIMARY KEY,
    libelle TEXT NOT NULL
);

BEGIN;
INSERT INTO compte_tx (id, libelle) VALUES (1, \'Depot\');
COMMIT;

SELECT COUNT(*) AS total FROM compte_tx;',
      'explainFr' => 'Les instructions entre <code>BEGIN</code> et <code>COMMIT</code> forment une seule unité. Ici l\'insertion est validée, donc le <code>SELECT</code> voit une ligne.',
      'explainDarija' => 'Instructions bin <code>BEGIN</code> w <code>COMMIT</code> kaykkwno unité wa7da. Hna insertion tvalidat, donc <code>SELECT</code> kaychof ligne wa7da.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — ROLLBACK',
      'lang' => 'sql',
      'instructions' => '<p>Crée <code>journal_tx</code> et insère une ligne <code>Initial</code>. Ouvre une transaction, insère <code>Tentative</code>, puis annule avec <code>ROLLBACK</code>. Affiche le nombre de lignes et le dernier message.</p>',
      'instructionsDarija' => '<p>5leq <code>journal_tx</code> w dkhel ligne <code>Initial</code>. 7el transaction, dkhel <code>Tentative</code>, men ba3d annuli b <code>ROLLBACK</code>. 3red 3adad lignes w akhir message.</p>',
      'starter' => '-- transaction annulée
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
          'value' => '1',
        ),
        2 => 
        array (
          'type' => 'result_has',
          'value' => '1',
        ),
        3 => 
        array (
          'type' => 'result_has',
          'value' => 'Initial',
        ),
      ),
      'hints' => 
      array (
        0 => 'ROLLBACK annule les opérations depuis le dernier BEGIN.',
        1 => 'La ligne insérée avant la transaction est conservée.',
        2 => 'COUNT(*) et MAX(message) résument l\'état final.',
      ),
      'solution' => 'DROP TABLE IF EXISTS journal_tx;

CREATE TABLE journal_tx (
    id INTEGER PRIMARY KEY,
    message TEXT NOT NULL
);

INSERT INTO journal_tx (id, message) VALUES (1, \'Initial\');

BEGIN;
INSERT INTO journal_tx (id, message) VALUES (2, \'Tentative\');
ROLLBACK;

SELECT COUNT(*) AS total, MAX(message) AS dernier FROM journal_tx;',
      'explainFr' => 'Le <code>ROLLBACK</code> défait seulement l\'insertion faite dans la transaction. La ligne <code>Initial</code>, écrite avant, reste en place : le total vaut 1.',
      'explainDarija' => '<code>ROLLBACK</code> kayrje3 ghir insertion li tdar f transaction. Ligne <code>Initial</code>, li tketbat qbel, katbqa : total = 1.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — SAVEPOINT',
      'lang' => 'sql',
      'instructions' => '<p>Crée <code>stock_tx</code>, ouvre une transaction, insère <code>Livre A</code> et <code>Livre B</code>, crée un <code>SAVEPOINT</code>, insère <code>Livre C</code>, puis revient au point avec <code>ROLLBACK TO</code>. Valide avec <code>COMMIT</code> et affiche le nombre de lignes restantes.</p>',
      'instructionsDarija' => '<p>5leq <code>stock_tx</code>, 7el transaction, dkhel <code>Livre A</code> w <code>Livre B</code>, 5leq <code>SAVEPOINT</code>, dkhel <code>Livre C</code>, men ba3d rje3 l point b <code>ROLLBACK TO</code>. Validi b <code>COMMIT</code> w 3red 3adad lignes li bqaw.</p>',
      'starter' => '-- transaction avec savepoint
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
          'value' => '2',
        ),
      ),
      'hints' => 
      array (
        0 => 'SAVEPOINT marque un point intermédiaire.',
        1 => 'ROLLBACK TO annule seulement ce qui suit le point.',
        2 => 'COMMIT valide le reste de la transaction.',
      ),
      'solution' => 'DROP TABLE IF EXISTS stock_tx;

CREATE TABLE stock_tx (
    id INTEGER PRIMARY KEY,
    produit TEXT NOT NULL
);

BEGIN;
INSERT INTO stock_tx (id, produit) VALUES (1, \'Livre A\');
INSERT INTO stock_tx (id, produit) VALUES (2, \'Livre B\');
SAVEPOINT avant_erreur;
INSERT INTO stock_tx (id, produit) VALUES (3, \'Livre C\');
ROLLBACK TO avant_erreur;
COMMIT;

SELECT COUNT(*) AS total FROM stock_tx;',
      'explainFr' => 'Le <code>SAVEPOINT</code> permet d\'annuler une partie de la transaction sans perdre les opérations précédentes. Après le <code>COMMIT</code>, seuls les livres A et B restent.',
      'explainDarija' => '<code>SAVEPOINT</code> kaykhalli tnqes 7aja men transaction bla ma tkhser opérations li qbel. Mora <code>COMMIT</code>, ghir livres A w B li kaybqaw.',
    ),
  ),
  'dataset' => 'school',
  'dialect' => 'sqlite',
);
