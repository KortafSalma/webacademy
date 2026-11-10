<?php

/**
 * PROJET 1 — Gestion des étudiants (HTML + PHP + MySQL).
 * Chaque projet : id, title, level, objective (html), steps[] :
 *   step = { title, explain, darija, lang, file, code, check, files? }
 * Le code des étapes doit être COPIABLE et complet (pas de "…").
 */

return [
    'id'        => 'p1',
    'title'     => 'Gestion des étudiants (CRUD complet)',
    'level'     => 'Niveau : fin de Module PHP — avant PHP+SQL avancé',
    'lang'      => 'php',
    'objective' => '<p>Construire une petite application <strong>HTML + PHP + MySQL</strong> permettant d\'enregistrer, lister, modifier, rechercher et supprimer des étudiants. C\'est le socle des connects projets suivants.</p>',

    'steps' => [

        [
            'title'   => 'Base de données',
            'explain' => '<p>Créez la base et la table dans phpMyAdmin (WAMP) ou avec le client MySQL :</p>',
            'darija'  => 'Awalan katkhdem la database : khassek ttakhad base "ecole" w table "etudiant" b les colonnes dyalha. Kolchi li ghadi nzido wla nsupprimento men had table men ba3d.',
            'lang'    => 'sql',
            'code'    => 'CREATE DATABASE IF NOT EXISTS ecole
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ecole;

CREATE TABLE etudiant (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nom      VARCHAR(40) NOT NULL,
    prenom   VARCHAR(40) NOT NULL,
    filiere  VARCHAR(30) NOT NULL,
    email    VARCHAR(60) UNIQUE NOT NULL,
    note_moyenne DECIMAL(4,2) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

INSERT INTO etudiant (nom, prenom, filiere, email, note_moyenne) VALUES
    ("Kortaf",  "Salma", "GI",  "salma.example.ma@ex.ma", 15.50),
    ("Marzak",  "Hiba",  "GI",  "hiba.example.ma@ex.ma",  14.75),
    ("Boukhriss","Omar", "GC",  "omar.example.ma@ex.ma",  12.00);',
            'check'   => '<code>SELECT * FROM etudiant;</code> doit renvoyer 3 lignes.',
        ],

        [
            'title'   => 'Configuration (config.php)',
            'explain' => '<p>Un seul fichier centralise la connexion. Toute l\'application l\'inclut — on ne répète jamais les identifiants.</p>',
            'darija'  => 'Config.php katkhezzen kollah les données dyal connection (host, base, user, pass). Laplication kamla katbni connection men $pdo hna, w had les identifiants ma kat3awadhouts f ay fichier akhor.',
            'lang'    => 'php',
            'code'    => '<?php
// config.php — configuration centrale du projet
declare(strict_types=1);

$DB_HOST = "127.0.0.1";
$DB_NAME = "ecole";
$DB_USER = "root";
$DB_PASS = "";   // mot de passe vide par défaut avec WAMP

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    // Message honnête + arrêt propre : ne jamais cacher une erreur de connexion
    http_response_code(500);
    echo "Connexion impossible : " . htmlspecialchars($e->getMessage());
    exit;
}
',
            'check'   => 'Ouvrez http://localhost/monprojet/config.php : la page doit être blanche (aucune erreur) si WAMP tourne.',
        ],
    ],
];
