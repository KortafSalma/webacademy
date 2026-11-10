<?php

declare(strict_types=1);

/**
 * MODULE INTEGRATION (PHP + SQL) — Chapitre 2 :
 * PDO : connexion (DSN), options, gestion des erreurs, Oracle, config.php.
 * Les exemples s'exécutent sous WAMP (MySQL) ; la sandbox CLI ne se connecte pas.
 */

return [
    'id'       => 'integration-ch2',
    'title'    => 'PDO : connexion, options et bonnes pratiques',
    'subtitle' => 'mysqli ou PDO ? DSN, gestion des erreurs, Oracle et connexion réutilisable',

    'objectives' => [
        'Choisir entre mysqli et PDO selon le projet.',
        'Construire un DSN MySQL correct (hôte, base, charset).',
        'Activer ERRMODE_EXCEPTION pour voir les erreurs SQL.',
        'Comprendre la connexion Oracle (OCI8 / PDO_OCI) et ses limites.',
        'Factoriser la connexion dans un seul config.php inclus avec require.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'pdo-vs-mysqli',
            'title' => 'PDO ou mysqli : lequel choisir ?',
            'icon'  => '⚖️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>PHP propose deux extensions modernes pour parler à une base : <strong>mysqli</strong> (MySQL uniquement) et <strong>PDO</strong> (PHP Data Objects, une interface commune à une dizaine de SGBD). Les deux savent préparer des requêtes, ce qui protège des injections SQL. La différence se joue sur la portabilité et le confort.</p>',
                 'darija' => '<p>PHP 3andha jouj extensions modernes : <strong>mysqli</strong> (ghir MySQL) w <strong>PDO</strong> (interface wa7da l 3achrat dyal SGBD). Bjouj kay-prepariw les requêtes, donc bjouj kay-hmiw mn injection SQL. Le far9 : portabilité w confort dyal l\'écriture.</p>'],

                ['type' => 'table',
                 'headers' => ['Critère', 'mysqli', 'PDO'],
                 'rows' => [
                    ['SGBD supportés', 'MySQL / MariaDB uniquement', 'MySQL, PostgreSQL, SQLite, SQL Server, Oracle…'],
                    ['Paramètres nommés', 'Non (:nom impossible)', 'Oui — :nom, plus lisible qu\'un ?'],
                    ['Récupération', 'fetch_assoc(), fetch_all()', 'fetch(), fetchAll(), modes de sortie'],
                    ['Erreurs', 'À configurer aussi', 'Exceptions avec ERRMODE_EXCEPTION'],
                    ['Recommandé pour', 'Un projet 100 % MySQL existant', 'Tout nouveau projet, et l\'apprentissage'],
                 ],
                 'fr' => 'Pour ce cours, on utilise PDO : une seule API à apprendre, valable sur MySQL comme sur SQLite — c\'est d\'ailleurs PDO que le labo SQL de la plateforme utilise en interne.'],

                ['type' => 'note', 'title' => 'Ce que mysqli fait et que PDO ne fait pas',
                 'fr'   => 'mysqli expose quelques fonctions très spécifiques à MySQL (multi-requêtes, informations de profiling). En pratique, PDO couvre 99 % des besoins d\'une application web et évite d\'être prisonnier d\'un seul SGBD.',
                 'darija' => 'mysqli 3andha chi fonctions khassa b MySQL (multi-requêtes, profiling). F l\'3amal, PDO katkfi 99 % dyal les besoins w kat-khellik ma m7bousch f SGBD wa7ed.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'dsn-mysql',
            'title' => 'Le DSN : l\'adresse de la connexion',
            'icon'  => '🔌',
            'blocks' => [

                ['type' => 'definition', 'title' => 'DSN — Data Source Name',
                 'fr'   => 'Chaîne qui décrit <em>où</em> se trouve la base et <em>comment</em> s\'y connecter : pilote, hôte, port, nom de base, charset. C\'est le premier argument de <code>new PDO()</code>.',
                 'darija' => 'DSN hiya chaîne kat-gol l PDO fin kayna la base w kifach ytwassel biha : pilote, host, port, smiyet la base, charset. Hiya l\'argument lowel dyal <code>new PDO()</code>.'],

                ['type' => 'syntax', 'lang' => 'text', 'title' => 'Anatomie d\'un DSN MySQL',
                 'code' => 'mysql:host=127.0.0.1;port=3306;dbname=ecole;charset=utf8mb4
       │      │            │          │          │
       │      │            │          │          └─ encodage complet (emojis inclus)
       │      │            │          └──────────── nom de la base
       │      │            └─────────────────────── port (3306 par défaut, souvent omis)
       │      └──────────────────────────────────── hôte (localhost ou 127.0.0.1)
       └─────────────────────────────────────────── pilote PDO'],

                ['type' => 'syntax', 'lang' => 'php', 'title' => 'Connexion PDO à MySQL (WAMP)',
                 'code' => <<<'PHP'
<?php
$dsn = 'mysql:host=127.0.0.1;dbname=ecole;charset=utf8mb4';
$pdo = new PDO($dsn, 'root', '');

echo 'Connecté à la base ecole.';
PHP,
                 'explainFr' => 'Sous WAMP, l\'utilisateur par défaut est <code>root</code> avec un mot de passe vide. Le charset <code>utf8mb4</code> évite les « ? » à la place des accents et des emojis.',
                 'explainDarija' => 'F WAMP, l\'utilisateur par défaut huwa root w password khawi. Charset utf8mb4 kay-hyed les "?" li kaybano f blasset les accents w emojis.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'options-erreurs',
            'title' => 'Options et gestion des erreurs',
            'icon'  => '🚨',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Par défaut, PDO est <strong>silencieux</strong> : une requête fausse ne lève rien, <code>query()</code> renvoie simplement <code>false</code>. C\'est la première cause de « ma page est vide et je ne comprends pas ». Le troisième argument de <code>new PDO()</code> sert à changer ce comportement une fois pour toutes.</p>',
                 'darija' => '<p>Par défaut, PDO <strong>skout</strong> : requête ghalta ma kat-rje3ch erreur, <code>query()</code> kat-rje3 ghir <code>false</code>. Hadi hiya sabab lowla dyal « la page khawya w ma fhemtch 3lach ». Le troisième argument dyal <code>new PDO()</code> kay-beddel had le comportement mara wa7da l kolchi.</p>'],

                ['type' => 'example',
                 'title' => 'Connexion complète et robuste (référence à réutiliser)',
                 'lang'  => 'php',
                 'code'  => <<<'PHP'
<?php
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // erreurs = exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES   => false,                    // vraies requêtes préparées
];

try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=ecole;charset=utf8mb4',
        'root',
        '',
        $options
    );
} catch (PDOException $e) {
    error_log('Connexion MySQL impossible : ' . $e->getMessage());
    http_response_code(500);
    exit('Service temporairement indisponible.');
}
PHP,
                 'explainFr' => 'Les trois options sont le socle de tout projet sérieux : les erreurs deviennent des exceptions attrapables, les lignes arrivent en tableaux associatifs, et les requêtes préparées sont réellement exécutées côté serveur. Le <code>catch</code> journalise le détail mais n\'affiche jamais le message technique au visiteur.',
                 'explainDarija' => 'Had les trois options homa l\'asas dyal ay projet jdid : les erreurs kaywliw exceptions, les lignes kayjiw b tableaux associatifs, w les requêtes préparées kat-khdem b s7i7 f serveur. Le catch kaykteb le détail f logs, walakin ma kay-affichich message technique l l\'utilisateur.'],

                ['type' => 'warning',
                 'title' => 'Ne jamais afficher une erreur brute à l\'utilisateur',
                 'fr'   => 'Un message PDOException révèle l\'hôte, le nom de la base, la requête, parfois des identifiants. On l\'écrit dans <code>error_log()</code> et on affiche un message générique. C\'est la même règle que pour les erreurs PHP en production.',
                 'darija' => 'Message PDOException kay-kchef l\'host, smiyet la base, la requête, w chi marrat les identifiants. Katektebha f <code>error_log()</code> w kat-affichi message 3adi l l\'utilisateur. Nefs la règle dyal les erreurs PHP f production.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'oracle',
            'title' => 'Et Oracle ? OCI8 et PDO_OCI',
            'icon'  => '🏛️',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Oracle est un SGBD professionnel utilisé par les grandes entreprises (banques, administrations). PHP le contacte par <strong>OCI8</strong> (extension spécifique Oracle) ou par le pilote <strong>PDO_OCI</strong>. La connexion ne cible pas une base par son seul nom comme MySQL : on vise un <strong>service</strong> réseau identifié par <code>hostname</code>, <code>port</code> (souvent 1521) et <code>service_name</code>. Mots-clés : <code>tnsnames.ora</code> (fichier de configuration réseau d\'Oracle), <code>oci_connect()</code>, ou un DSN du type <code>oci:dbname=//hostname:port/service_name</code>.</p>',
                 'darija' => 'Oracle SGBD dyal grandes entreprises (banques, administrations). PHP kaytwassel m3ah b driver OCI8 (extension dyal Oracle) wla PDO_OCI. La connexion ma katb9ach dbname, katwlli b l\'adresse dyal service : hostname + port (souvent 1521) + service_name. Fichier tnsnames.ora huwa li fih les infos dyal connexion. Had chapitre concept : f le labo dyalna ma 3andnash serveur Oracle bach njerbro, w hadchi normal.'],

                ['type' => 'note', 'title' => 'MySQL vs Oracle : ce qui change vraiment',
                 'fr'   => 'Le SQL s\'écrit presque pareil partout (SELECT, WHERE, GROUP BY…). Ce qui change : le pilote, le DSN et quelques fonctions (dates, pagination). Donc ce que vous maîtrisez avec PDO/MySQL vous servira sous Oracle.',
                 'darija' => 'Le SQL kaykteb presque kif kif f kol SGBD (SELECT, WHERE, GROUP BY). Li kaytbeddel : driver, DSN, w chi fonctions (dates, LIMIT). Donc li t3ellm PDO+MySQL, f Oracle kaytl9a rasek f blasti mrahebin.'],
            ],
        ],

        // ------------------------------------------------ Section 5
        [
            'id'    => 'config-include',
            'title' => 'Réutiliser la connexion via include',
            'icon'  => '♻️',
            'blocks' => [
                ['type' => 'text',
                 'fr'   => '<p>Ouvrir une connexion coûte du temps : on ne doit pas le refaire dans chaque page. La bonne pratique : un <strong>seul fichier <code>config.php</code></strong> qui crée <code>$pdo</code>, et chaque page l\'inclut avec <code>require</code>. Identifiants écrits <em>une seule fois</em> dans tout le projet.</p>',
                 'darija' => 'Le connexion ghalia : mat3awdha4 f kol page. 3mel config.php fih new PDO, w kol page dir require "config.php". Ila beddelte mot de passe, katbeddelo f blast wa7da.'],

                ['type' => 'example',
                 'title' => 'config.php inclus dans une page',
                 'lang'  => 'php',
                 'code'  => '<?php
// ---- config.php (un seul exemplaire dans le projet) ----
try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;dbname=ecole;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit("Base indisponible.");
}

// ---- liste.php (utilise la MÊME connexion) ----
require "config.php";
$etudiants = $pdo->query("SELECT nom, prenom FROM etudiant")->fetchAll();',
                 'explainFr' => 'require exécute tout config.php : $pdo est créé avant le reste de liste.php. La page utilise $pdo comme si elle l\'avait elle-même créé. Une connexion, un seul endroit à modifier.',
                 'explainDarija' => 'require kaydfi config.php kaml : $pdo kaytkhdem 9bel le code dyal liste.php, w la page katst3mel $pdo 3adi. Le connexion wa7da, w had l\'info ma kat3awah f ay fichier akhor.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Oublier ERRMODE_EXCEPTION : erreurs SQL invisibles',
            'fix'    => 'PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION dans les options',
            'fr'     => 'Sans cette option, une requête fausse ne lève rien et le bug passe inaperçu. Avec elle, chaque erreur SQL devient une exception claire.',
            'darija' => 'Ila nssit had l\'option, requête ghalta katdooz bla ma tfhem 3liha. M3a ERRMODE_EXCEPTION, l\'erreur kadloor bhal exception w ndir had le catch.',
        ],
        [
            'wrong'  => 'charset=utf8 (alias incomplet) wla omettre le charset',
            'fix'    => 'charset=utf8mb4 dans le DSN',
            'fr'     => 'utf8 de MySQL (3 octets max) ne couvre pas tout Unicode : emojis et certains caractères affichent des « ? ». utf8mb4 est le vrai UTF-8 complet.',
            'darija' => 'utf8 dyal MySQL (3 octets max) ma katfrchi4 kol Unicode : les emojis kaybano "?" f la page. Dima utf8mb4.',
        ],
        [
            'wrong'  => 'Copier new PDO + identifiants dans chaque page',
            'fix'    => 'Une connexion dans config.php + require',
            'fr'     => 'Quand le mot de passe change, vous devriez éditer 1 fichier, pas 20. Et chaque new PDO coûte une vraie connexion réseau.',
            'darija' => 'Ila katkteb le code dyal connexion f kol page, mnin tbeddel passe ma 3andk 20 fichier tbddlo. Dima config.php w require.',
        ],
        [
            'wrong'  => 'echo $e->getMessage() visible par tout le monde',
            'fix'    => 'Message générique utilisateur + détail dans error_log',
            'fr'     => 'Le message d\'exception peut contenir chemins, nom de la base, requête SQL : une aide précieuse pour un attaquant.',
            'darija' => 'Le message dyal Exception fih infos sensibles : hostname, smiyet la base, requête SQL. Dima le détail kaymchi le fichier dyal logs, w l\'utilisateur kaychof message simple.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>PDO</b> = une seule API pour MySQL, SQLite, PostgreSQL, Oracle… La connexion tient en trois éléments : le <b>DSN</b> (<code>mysql:host=…;dbname=…;charset=utf8mb4</code>), les identifiants, et les <b>options</b> — dont <code>ERRMODE_EXCEPTION</code>. Les erreurs techniques partent dans <code>error_log()</code>, jamais à l\'écran. La connexion est créée une seule fois dans <code>config.php</code> puis incluse avec <code>require</code>. Sous Oracle, même logique avec un DSN <code>oci:dbname=//host:port/service</code>.',
        'darija' => '<b>PDO</b> = API wa7da l MySQL, SQLite, PostgreSQL, Oracle… La connexion fiha 3lach : <b>DSN</b>, identifiants, w <b>options</b> (mohimmen : <code>ERRMODE_EXCEPTION</code>). Les erreurs kaymchiw f <code>error_log()</code>, machi f l\'écran. La connexion kat-dar f <code>config.php</code> w kat-incluse b <code>require</code>. Oracle : nefs l\'mantik b DSN <code>oci:dbname=//host:port/service</code>.',
    ],
];
