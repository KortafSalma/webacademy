<?php

declare(strict_types=1);

/**
 * Contenu généré depuis integration-c07.json
 */

return array (
  'id' => 'integration-ch7',
  'title' => 'Architecture de projet',
  'subtitle' => 'Structurer une application PHP qui grandit',
  'objectives' => 
  array (
    0 => 'Organiser les dossiers d\'un projet PHP.',
    1 => 'Séparer configuration, accès aux données, logique et vues.',
    2 => 'Mettre en place un point d\'entrée unique (front controller).',
    3 => 'Éviter les inclusions en cascade et les fichiers fourre-tout.',
    4 => 'Préparer le déploiement et la maintenance.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'arborescence',
      'title' => 'Une arborescence claire',
      'icon' => '🗂️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Un projet qui grandit ne peut pas rester une collection de fichiers à la racine. On sépare ce qui est <strong>public</strong> (accessible par le navigateur) de ce qui est <strong>interne</strong> (configuration, classes, vues). Seul le dossier <code>public/</code> est exposé par le serveur web.</p>',
          'darija' => '<p>Projet li kaykber ma y9derch ybqa collection dyal fichiers f racine. Kanfre9o li <strong>public</strong> (navigateur y9der ywsel) men li <strong>interne</strong> (configuration, classes, vues). Ghir dossier <code>public/</code> kayt3red l serveur web.</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'text',
          'title' => 'Arborescence recommandée',
          'code' => 'mon-projet/
├── public/              ← seule racine web
│   ├── index.php        ← point d\'entrée unique
│   └── assets/
│       ├── css/
│       └── js/
├── src/
│   ├── Controller/
│   ├── Repository/      ← requêtes SQL
│   └── Support/
├── views/
│   ├── layout.php
│   └── etudiants/
├── config/
│   └── database.php
├── storage/
│   └── logs/
├── .env                 ← jamais versionné
└── composer.json',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Dossier',
            1 => 'Contenu',
            2 => 'Accès navigateur',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'public/',
              1 => 'index.php, CSS, JS, images',
              2 => 'oui',
            ),
            1 => 
            array (
              0 => 'src/',
              1 => 'classes PHP, logique métier',
              2 => 'non',
            ),
            2 => 
            array (
              0 => 'views/',
              1 => 'templates HTML/PHP',
              2 => 'non',
            ),
            3 => 
            array (
              0 => 'config/',
              1 => 'connexion, paramètres',
              2 => 'non',
            ),
            4 => 
            array (
              0 => 'storage/',
              1 => 'logs, cache, uploads',
              2 => 'non',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Un fichier de config dans public/ est public',
          'fr' => 'Si <code>config/database.php</code> se trouve sous la racine web, un visiteur peut le lire en tapant son URL — et récupérer vos identifiants. La séparation public/interne est une mesure de sécurité, pas un détail esthétique.',
          'darija' => 'Ila <code>config/database.php</code> kayn ta7t racine web, visiteur y9der yqrao b URL — w yakhod identifiants dyalek. Tqsim public/interne howa mesure sécurité, machi détail esthétique.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'front-controller',
      'title' => 'Le point d\'entrée unique',
      'icon' => '🚪',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Plutôt que d\'avoir un fichier PHP par page, on dirige toutes les requêtes vers <code>public/index.php</code> : c\'est le <strong>front controller</strong>. Il charge la configuration, prépare la connexion, puis délègue à un <strong>contrôleur</strong> selon l\'URL demandée.</p>',
          'darija' => '<p>Blast fichier PHP l kol page, kandiro kol requêtes l <code>public/index.php</code> : hada howa <strong>front controller</strong>. Kaychargi configuration, kaywjjed connexion, men ba3d kaydelegui l <strong>contrôleur</strong> 3la 7sab URL li tlebt.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'index.php minimal',
          'lang' => 'php',
          'code' => '<?php
declare(strict_types=1);

require __DIR__ . \'/../config/database.php\';

$route = $_GET[\'route\'] ?? \'accueil\';

$routes = [
    \'accueil\'   => __DIR__ . \'/../src/Controller/AccueilController.php\',
    \'etudiants\' => __DIR__ . \'/../src/Controller/EtudiantController.php\',
];

if (!isset($routes[$route])) {
    http_response_code(404);
    exit(\'Page introuvable\');
}

require $routes[$route];
',
          'explainFr' => 'La liste blanche <code>$routes</code> empêche un visiteur de charger un fichier arbitraire. Toute URL inconnue renvoie un vrai 404.',
          'explainDarija' => 'Liste blanche <code>$routes</code> katmna3 visiteur ychargi fichier 3achwa2i. Ay URL ma m3erfach katrje3 404 7aqiqi.',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Un contrôleur qui ne mélange pas tout',
          'lang' => 'php',
          'code' => '<?php
// src/Controller/EtudiantController.php

$etudiants = $repository->tousLesEtudiants();

require __DIR__ . \'/../../views/etudiants/liste.php\';
',
          'explainFr' => 'Le contrôleur orchestre : il demande les données au repository, puis inclut la vue. Il ne contient ni HTML ni SQL — chacun son rôle.',
          'explainDarija' => 'Contrôleur kaynadem : kaytleb données men repository, men ba3d kaydkhel vue. Ma fihch HTML wla SQL — kol wa7ed 3ndo rôle dyalo.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Réécriture d\'URL',
          'fr' => 'Un fichier <code>.htaccess</code> ou une règle Nginx redirige toutes les URL vers <code>index.php</code>. On obtient des adresses propres : <code>/etudiants/12</code> au lieu de <code>detail.php?id=12</code>.',
          'darija' => 'Fichier <code>.htaccess</code> wla règle Nginx kayredirecti kol URL l <code>index.php</code>. Kankhdmo adresses nqiyin : <code>/etudiants/12</code> blast <code>detail.php?id=12</code>.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'maintenance',
      'title' => 'Organisation du code et déploiement',
      'icon' => '🚀',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Quelques règles simples font la différence entre un projet maintenable et un labyrinthe : une classe par fichier, un autoload, des noms explicites, et aucune duplication de la connexion PDO.</p>',
          'darija' => '<p>Chi qawa3id sahlin kayfre9o bin projet sahel t7sin w labyrinthe : classe wa7da l kol fichier, autoload, smiyat wad7in, w 7ta tkrar dyal connexion PDO.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Une connexion centralisée',
          'lang' => 'php',
          'code' => '<?php
// config/database.php
$dsn = \'mysql:host=127.0.0.1;dbname=ecole;charset=utf8mb4\';
$pdo = new PDO($dsn, getenv(\'DB_USER\'), getenv(\'DB_PASS\'), [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);
',
          'explainFr' => 'Un seul endroit définit la connexion. <code>getenv()</code> garde les identifiants hors du code. Les attributs PDO sont cohérents pour toute l\'application.',
          'explainDarija' => 'Blasa wa7da kat3erref connexion. <code>getenv()</code> kay7fed identifiants bera code. Attributs PDO kaybqaw cohérents l application kamla.',
        ),
        2 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Pratique',
            1 => 'Bénéfice',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'Une classe par fichier',
              1 => 'autoload simple et lecture rapide',
            ),
            1 => 
            array (
              0 => 'Noms explicites',
              1 => 'comprendre sans ouvrir le fichier',
            ),
            2 => 
            array (
              0 => 'Repository séparé',
              1 => 'SQL centralisé et testable',
            ),
            3 => 
            array (
              0 => 'Vues sans logique',
              1 => 'HTML lisible, code protégé',
            ),
            4 => 
            array (
              0 => 'Logs dans storage/',
              1 => 'diagnostic sans exposer au public',
            ),
            5 => 
            array (
              0 => 'Migrations versionnées',
              1 => 'structure reproductible',
            ),
          ),
        ),
        3 => 
        array (
          'type' => 'warning',
          'title' => 'Pas de require en cascade',
          'fr' => 'Une chaîne de <code>require</code> entre fichiers crée des dépendances invisibles : on ne sait plus ce qui est chargé. Un autoload Composer et des dépendances explicites en haut de chaque fichier règlent le problème.',
          'darija' => 'Chaîne dyal <code>require</code> bin fichiers kat5leq dépendances mkhebyin : ma t3refch ach tchargi. Autoload Composer w dépendances wad7in f lwel dyal kol fichier kay7ello mochkil.',
        ),
        4 => 
        array (
          'type' => 'tip',
          'title' => 'Déploiement reproductible',
          'fr' => 'Versionnez le code, pas les secrets. Décrivez les dépendances avec Composer, les tables avec des migrations, et testez sur une base vide avant la mise en production.',
          'darija' => 'Versionni code, machi secrets. Wsef dépendances b Composer, tables b migrations, w testi 3la base khawya qbel mise en production.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => 'Mettre config.php, les classes et index.php dans le même dossier public',
      'fix' => 'public/ pour le web, src/ et config/ au-dessus de la racine web.',
      'fr' => 'Tout fichier sous la racine web peut être téléchargé ou exécuté directement.',
      'darija' => 'Kol fichier ta7t racine web y9der ytchargi wla ytnffed nichan.',
    ),
    1 => 
    array (
      'wrong' => 'Un fichier par page avec 200 lignes de SQL et de HTML mélangés',
      'fix' => 'Contrôleur + repository + vue séparés.',
      'fr' => 'Le mélange rend les tests, la réutilisation et la correction impossibles dès que le projet grossit.',
      'darija' => 'Khelt kay3mel tests, réutilisation w correction mstahilin melli projet kaykber.',
    ),
    2 => 
    array (
      'wrong' => 'include $_GET[\'page\'] . \'.php\'',
      'fix' => 'Table de routes en liste blanche.',
      'fr' => 'Un paramètre d\'URL ne doit jamais désigner directement un fichier à inclure (LFI/RFI).',
      'darija' => 'Paramètre d\'URL 3omro ma y3ayyen fichier bach ydkhel nichan (LFI/RFI).',
    ),
    3 => 
    array (
      'wrong' => 'Commit de .env avec les mots de passe',
      'fix' => 'Ajouter .env au .gitignore et fournir un .env.example.',
      'fr' => 'Un secret poussé sur Git est compromis, même s\'il est supprimé ensuite : l\'historique le conserve.',
      'darija' => 'Secret li tpusha f Git mkhark, 7ta ila tmse7 men ba3d : historique kay7feddo.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'Une bonne <strong>architecture</strong> sépare le public (seul <code>public/</code> est exposé) de l\'interne (<code>src/</code>, <code>views/</code>, <code>config/</code>, <code>storage/</code>). Le <strong>front controller</strong> <code>index.php</code> centralise le chargement et route vers un contrôleur. Repository pour le SQL, vues pour le HTML, configuration centralisée, secrets hors du code : le projet reste lisible quand il grandit.',
    'darija' => '<strong>Architecture</strong> mzyana katfre9 public (ghir <code>public/</code> kayt3red) men interne (<code>src/</code>, <code>views/</code>, <code>config/</code>, <code>storage/</code>). <strong>Front controller</strong> <code>index.php</code> kayjem3 chargement w kayrouteri l contrôleur. Repository l SQL, vues l HTML, configuration centralisée, secrets bera code : projet kaybqa mqrou melli kaykber.',
  ),
);
