<?php

declare(strict_types=1);

/**
 * Contenu généré depuis qz03.php
 */

return array (
  'title' => 'Quiz — DDL',
  'questions' => 
  array (
    0 => 
    array (
      'type' => 'mcq',
      'question' => 'Que signifie DDL ?',
      'options' => 
      array (
        0 => 'Data Definition Language',
        1 => 'Data Delete Language',
        2 => 'Digital Data Link',
      ),
      'answer' => 0,
      'concept' => 'DDL',
      'explainFr' => 'Le DDL regroupe les commandes qui définissent la structure : CREATE, ALTER, DROP.',
      'explainDarija' => 'DDL kayjem3 commandes li kay3erfo structure : CREATE, ALTER, DROP.',
    ),
    1 => 
    array (
      'type' => 'tf',
      'question' => 'CREATE TABLE modifie la structure de la base.',
      'answer' => 0,
      'concept' => 'CREATE TABLE',
      'explainFr' => 'Vrai : créer une table est une opération DDL.',
      'explainDarija' => 'S7i7 : création table hiya opération DDL.',
    ),
    2 => 
    array (
      'type' => 'mcq',
      'question' => 'Quelle commande ajoute une colonne à une table existante ?',
      'options' => 
      array (
        0 => 'ALTER TABLE ... ADD COLUMN',
        1 => 'UPDATE TABLE ... ADD',
        2 => 'INSERT COLUMN',
      ),
      'answer' => 0,
      'concept' => 'ALTER TABLE',
      'explainFr' => '<code>ALTER TABLE</code> modifie la structure sans recréer la table.',
      'explainDarija' => '<code>ALTER TABLE</code> katbeddel structure bla ma t3awed t5leq table.',
    ),
    3 => 
    array (
      'type' => 'fill',
      'question' => 'La commande qui supprime définitivement une table est ________ TABLE.',
      'answer' => 'DROP',
      'concept' => 'DROP TABLE',
      'explainFr' => '<code>DROP TABLE</code> supprime la table et ses données.',
      'explainDarija' => '<code>DROP TABLE</code> kat7yed table w données dyalha.',
    ),
    4 => 
    array (
      'type' => 'mcq',
      'question' => 'Comment renommer une table en SQLite ?',
      'options' => 
      array (
        0 => 'ALTER TABLE ancien RENAME TO nouveau',
        1 => 'RENAME TABLE ancien',
        2 => 'UPDATE TABLE ancien NAME',
      ),
      'answer' => 0,
      'concept' => 'Renommage',
      'explainFr' => '<code>ALTER TABLE ... RENAME TO ...</code> change le nom sans perdre les données.',
      'explainDarija' => '<code>ALTER TABLE ... RENAME TO ...</code> kaybeddel smiya bla ma ykhser données.',
    ),
  ),
);
