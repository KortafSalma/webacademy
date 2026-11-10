<?php

declare(strict_types=1);

/**
 * Contenu généré depuis sql-c09.json
 */

return array (
  'id' => 'sql-ch9',
  'title' => 'Joins',
  'subtitle' => 'Croiser plusieurs tables pour reconstruire l\'information',
  'objectives' => 
  array (
    0 => 'Comprendre pourquoi on joint des tables.',
    1 => 'Écrire un INNER JOIN avec alias.',
    2 => 'Utiliser LEFT JOIN pour conserver les lignes sans correspondance.',
    3 => 'Faire une auto-jointure et joindre plus de deux tables.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'inner-join',
      'title' => 'INNER JOIN',
      'icon' => '🔗',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les données sont réparties dans plusieurs tables reliées par des clés. Un <strong>JOIN</strong> combine les lignes de deux tables selon une condition de correspondance. <strong>INNER JOIN</strong> ne garde que les lignes qui ont une correspondance <em>des deux côtés</em>.</p>',
          'darija' => '<p>Données mqesmin 3la bzaf tables mrboutin b clés. <strong>JOIN</strong> kayjem3 lignes dyal jouj tables 3la 7sab condition. <strong>INNER JOIN</strong> kay7fed ghir lignes li 3ndhom correspondance <em>f jouj</em>.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'sql',
          'title' => 'Syntaxe',
          'code' => 'SELECT e.nom, n.valeur
FROM note n
INNER JOIN etudiant e ON e.id = n.etudiant_id;',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Notes avec le nom de l\'étudiant',
          'lang' => 'sql',
          'code' => 'SELECT e.nom, m.nom AS matiere, n.valeur
FROM note n
JOIN etudiant e ON e.id = n.etudiant_id
JOIN matiere m ON m.id = n.matiere_id
ORDER BY e.nom, m.nom;',
          'output' => 'nom     | matiere         | valeur
Kortaf  | Base de donnees | 15.0
Kortaf  | Math            | 14.5
Kortaf  | PHP             | 16.0
Marzak  | Math            | 17.0
Marzak  | PHP             | 12.5
Boukhriss | Anglais       | 13.0
Boukhriss | Math          | 9.0
Sekkat  | PHP             | 18.5
Tazi    | Base de donnees | 11.8
Tazi    | Math            | 11.0',
          'explainFr' => 'Chaque note est reliée à son étudiant et à sa matière. Les alias <code>e</code>, <code>m</code>, <code>n</code> évitent d\'écrire les noms complets et lèvent l\'ambiguïté entre colonnes homonymes.',
          'explainDarija' => 'Kol note mrbouta m3a etudiant w matiere dyalha. Alias <code>e</code>, <code>m</code>, <code>n</code> kaymna3o ktaba smiyat twila w kayfre9o bin colonnes li 3ndhom nefs smiya.',
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Oublier la condition ON',
          'fr' => 'Sans <code>ON</code>, un JOIN produit un <strong>produit cartésien</strong> : chaque ligne de A est combinée à chaque ligne de B. Sur de grosses tables, cela génère des millions de lignes inutiles.',
          'darija' => 'Bla <code>ON</code>, JOIN kay3ti <strong>produit cartésien</strong> : kol ligne men A katrbet m3a kol ligne men B. 3la tables kbar, kaygeneri millions de lignes bla fayda.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'left-join',
      'title' => 'LEFT JOIN et RIGHT JOIN',
      'icon' => '⬅️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p><strong>LEFT JOIN</strong> garde toutes les lignes de la table de gauche, même sans correspondance à droite (les colonnes de droite valent alors NULL). <strong>RIGHT JOIN</strong> fait l\'inverse.</p>',
          'darija' => '<p><strong>LEFT JOIN</strong> kay7fed kol lignes dyal table li 3la liser, 7ta ila ma kaynch correspondance 3la limen (colonnes dyal limen kaywliw NULL). <strong>RIGHT JOIN</strong> kaydir l\'3aks.</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Jointure',
            1 => 'Garde les lignes de gauche sans match ?',
            2 => 'Garde les lignes de droite sans match ?',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'INNER JOIN',
              1 => 'non',
              2 => 'non',
            ),
            1 => 
            array (
              0 => 'LEFT JOIN',
              1 => 'oui',
              2 => 'non',
            ),
            2 => 
            array (
              0 => 'RIGHT JOIN',
              1 => 'non',
              2 => 'oui',
            ),
            3 => 
            array (
              0 => 'FULL OUTER JOIN',
              1 => 'oui',
              2 => 'oui (pas supporté partout)',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Tous les étudiants, même sans note',
          'lang' => 'sql',
          'code' => 'SELECT e.nom, n.valeur
FROM etudiant e
LEFT JOIN note n ON n.etudiant_id = e.id
ORDER BY e.nom;',
          'output' => 'nom       | valeur
Boukhriss | 9.0
Boukhriss | 13.0
Kortaf    | 14.5
Kortaf    | 16.0
Kortaf    | 15.0
Marzak    | 17.0
Marzak    | 12.5
Sekkat    | 18.5
Tazi      | 11.0
Tazi      | 11.8',
          'explainFr' => 'Avec ce jeu de données, chaque étudiant a au moins une note. Si un étudiant n\'en avait aucune, il apparaîtrait avec <code>valeur = NULL</code> : l\'INNER JOIN l\'aurait supprimé.',
          'explainDarija' => 'B had dataset, kol etudiant 3ndo 3la l9al note wa7da. Ila etudiant ma 3ndoch notes, ghadi yban b <code>valeur = NULL</code> : INNER JOIN kan ghadi ymse7o.',
        ),
        3 => 
        array (
          'type' => 'example',
          'title' => 'Trouver les étudiants sans note',
          'lang' => 'sql',
          'code' => 'SELECT e.nom
FROM etudiant e
LEFT JOIN note n ON n.etudiant_id = e.id
WHERE n.id IS NULL;',
          'output' => '(0 ligne)',
          'explainFr' => 'Le motif <code>LEFT JOIN ... WHERE colonne IS NULL</code> est la façon standard de trouver les enregistrements orphelins. Ici, aucun étudiant n\'est dans ce cas.',
          'explainDarija' => 'Motif <code>LEFT JOIN ... WHERE colonne IS NULL</code> howa tariqa 3adiya bach tlqa enregistrements orphelins. Hna, 7ta etudiant ma kayn f had 7ala.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'auto-jointure',
      'title' => 'Auto-jointure',
      'icon' => '🪞',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>auto-jointure</strong> joint une table à elle-même. On utilise deux alias différents pour distinguer les deux rôles. Exemple classique : un employé et son manager, tous deux dans la table <code>employe</code>.</p>',
          'darija' => '<p><strong>Auto-jointure</strong> katrbet table m3a rasha. Kankhdmo b jouj alias mokhtalfin bach nfre9o jouj rôles. Exemple mchhour : employé w manager dyalo, jouj f table <code>employe</code>.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Employé et manager',
          'lang' => 'sql',
          'code' => 'CREATE TABLE employe (
    id INT PRIMARY KEY,
    nom VARCHAR(40),
    manager_id INT
);

INSERT INTO employe VALUES
    (1, \'Salma\', NULL),
    (2, \'Omar\', 1),
    (3, \'Hiba\', 1),
    (4, \'Anas\', 2);

SELECT e.nom AS employe, m.nom AS manager
FROM employe e
LEFT JOIN employe m ON m.id = e.manager_id
ORDER BY e.nom;',
          'output' => 'employe | manager
Anas    | Omar
Hiba    | Salma
Omar    | Salma
Salma   | NULL',
          'explainFr' => 'La même table apparaît deux fois avec les alias <code>e</code> (employé) et <code>m</code> (manager). Le LEFT JOIN conserve Salma, qui n\'a pas de manager.',
          'explainDarija' => 'Nefs table katban jouj merrat b alias <code>e</code> (employé) w <code>m</code> (manager). LEFT JOIN kay7fed Salma, li ma 3ndhach manager.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'FROM note, etudiant WHERE note.etudiant_id = etudiant.id',
      'fix' => 'FROM note n JOIN etudiant e ON e.id = n.etudiant_id',
      'fr' => 'L\'ancienne syntaxe implicite fonctionne mais mélange jointure et filtrage. JOIN ... ON est plus lisible et évite les produits cartésiens accidentels.',
      'darija' => 'Syntaxe qdima katkhdem walakin katkhelt jointure m3a filtrage. JOIN ... ON awda7 w kaymna3 produits cartésiens b ghafla.',
    ),
    1 => 
    array (
      'wrong' => 'JOIN sans ON',
      'fix' => 'Toujours préciser ON e.id = n.etudiant_id',
      'fr' => 'Sans condition, chaque ligne est combinée à toutes les autres : le résultat explose.',
      'darija' => 'Bla condition, kol ligne katrbet m3a kolchi : résultat kaykber bla 7add.',
    ),
    2 => 
    array (
      'wrong' => 'LEFT JOIN puis WHERE n.valeur > 10',
      'fix' => 'Mettre la condition dans le ON, ou accepter la perte des lignes sans match.',
      'fr' => 'Un WHERE sur la table de droite transforme souvent le LEFT JOIN en INNER JOIN, car NULL ne satisfait pas la condition.',
      'darija' => 'WHERE 3la table dyal limen ghaliban kaybeddel LEFT JOIN l INNER JOIN, 7it NULL ma kay7eqqeqch condition.',
    ),
  ),
  'summary' => 
  array (
    'fr' => '<strong>INNER JOIN</strong> ne garde que les correspondances des deux côtés, <strong>LEFT JOIN</strong> conserve toutes les lignes de gauche (NULL à droite si absent), <strong>RIGHT JOIN</strong> l\'inverse. L\'<strong>auto-jointure</strong> relie une table à elle-même avec deux alias. Toujours préciser la condition <code>ON</code>.',
    'darija' => '<strong>INNER JOIN</strong> kay7fed ghir correspondances f jouj jihat, <strong>LEFT JOIN</strong> kay7fed kol lignes dyal liser (NULL f limen ila ma kanch), <strong>RIGHT JOIN</strong> l\'3aks. <strong>Auto-jointure</strong> katrbet table m3a rasha b jouj alias. Dima 7edd condition <code>ON</code>.',
  ),
);
