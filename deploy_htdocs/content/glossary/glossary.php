<?php

declare(strict_types=1);

/**
 * Glossaire FR + Darija des termes du cours.
 * Format par terme : term, module (html|css|php|sql|integration), fr, darija, exemple (+lang).
 */

return [
    'terms' => [

        ['term' => 'Balise (tag)', 'module' => 'html',
         'fr'    => 'Élément HTML délimité par < et > qui décrit une partie du document (paragraphe, lien, image…).',
         'darija'=> 'Balise hiwa l\'unité dyal HTML, katkteb bin "<" ">" — katwari 3lach 3ndi had partie dyal la page (paragraphe, lien…).',
         'exemple' => '<p>Salam</p>', 'lang' => 'html'],

        ['term' => 'Attribut', 'module' => 'html',
         'fr'    => 'Information complémentaire placée dans la balise ouvrante : src pour une image, href pour un lien…',
         'darija'=> 'Attribut howa info zida katkteb f la balise ouvrante, bhal la source dyal image.',
         'exemple' => '<img src="photo.jpg" alt="Ma photo">', 'lang' => 'html'],

        ['term' => 'DOCTYPE', 'module' => 'html',
         'fr'    => 'Première ligne d\'une page : elle déclare la version d\'HTML utilisée (HTML5).',
         'darija'=> 'Hna nktbou ""DOCTYPE : hiya la 1ère ligne li katgol navigateur hna nhdro 3la HTML5.', 'lang' => 'html'],

        ['term' => 'Sélecteur CSS', 'module' => 'css',
         'fr'    => 'Motif qui cible des éléments HTML pour les styler (tag, #id, .classe).',
         'darija'=> 'Sélecteur howa li kaykhtar les éléments HTML li bghiti tstylihom : tag, .class, #id.', 'exemple' => 'p { color: red; }', 'lang' => 'css'],

        ['term' => 'Box model', 'module' => 'css',
         'fr'    => 'Chaque élément est une boîte : contenu + padding + border + margin.',
         'darija'=> 'Kol élément howa boîte 3anda 4 couches : contenu, padding, border, margin.', 'exemple' => '.box { padding: 10px; border: 2px solid #000; margin: 20px; }', 'lang' => 'css'],

        ['term' => 'Variable PHP', 'module' => 'php',
         'fr'    => 'Conteneur nommé commençant par $ qui stocke une valeur modifiable.',
         'darija'=> 'Variable howa boîte katkhezzen wa7d la valeur, tkteb () 3ndha $ — bhal $age = 20;', 'exemple' => '$age = 20; echo $age;', 'lang' => 'php'],

        ['term' => 'Tableau (array) PHP', 'module' => 'php',
         'fr'    => 'Structure qui regroupe plusieurs valeurs sous une même variable.',
         'darija'=> 'Array kayjma3 plusieurs valeurs f varible wa7da, wakha $notes kayn kol notes.', 'exemple' => '$notes = [15, 12, 18];', 'lang' => 'php'],

        ['term' => 'PDO', 'module' => 'integration',
         'fr'    => 'Extension PHP orientée objet qui fournit une interface unique vers plusieurs SGBD (MySQL, SQLite…).',
         'darija'=> 'PDO katkhelli PHP ytwassel m3a database b interface wa7da, w kat7mi 3lak mn SQL injection b requêtes préparées.',
         'exemple' => '$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecole", "root", "");', 'lang' => 'php'],

        ['term' => 'Clé primaire (PRIMARY KEY)', 'module' => 'sql',
         'fr'    => 'Colonne (ou groupe de colonnes) identifiant de façon unique chaque ligne d\'une table.',
         'darija'=> 'PRIMARY KEY hiya colonne dont la valeur UNIQUE : kate3ti identité lekola ligne, bhal id dyal etudiant.',
         'exemple' => 'CREATE TABLE etudiant (id INT PRIMARY KEY, nom VARCHAR(40));', 'lang' => 'sql'],

        ['term' => 'Clé étrangère (FOREIGN KEY)', 'module' => 'sql',
         'fr'    => 'Colonne qui référence la clé primaire d\'une autre table, créant une relation.',
         'darija'=> 'FOREIGN KEY kolouna kol column li katkopie PRIMARY KEY dyal table XY, 7sséla relation bin 2 tables.',
         'exemple' => 'FOREIGN KEY (etudiant_id) REFERENCES etudiant(id)', 'lang' => 'sql'],

        ['term' => 'Requête préparée', 'module' => 'integration',
         'fr'    => 'SQL compilé par le serveur avant insertion des valeurs : protège contre les injections SQL.',
         'darija'=> 'Requête préparée : SQL kay9adbhad au SKU mn ba3d la valeur, kat7ári men SQL injection.',
         'exemple' => '$st = $pdo->prepare("SELECT * FROM etudiant WHERE nom = ?"); $st->execute([$nom]);', 'lang' => 'php'],

        ['term' => 'Injection SQL', 'module' => 'sql',
         'fr'    => 'Attaque qui insère du SQL malveillant via une entrée utilisateur non validée ou non préparée.',
         'darija'=> 'Injection SQL : hacker kaykhdem SQL khbay tb f input, kulchi m3set database.',
         'exemple' => '$nom = "a\' OR 1=1 -- " ', 'lang' => 'php'],
    ],
];
