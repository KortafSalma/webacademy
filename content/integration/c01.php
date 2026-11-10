<?php

declare(strict_types=1);

/**
 * MODULE INTEGRATION (PHP + SQL) — Chapitre 1 :
 * Communication PHP ↔ base de données.
 * Le pipeline complet : utilisateur → HTTP → PHP → SQL → résultat → HTML.
 * Les exemples PDO de ce module affichent du code destiné à WAMP (MySQL) :
 * dans la sandbox d'exercices (CLI isolé) PDO n'est pas connecté à une base.
 */

return [
    'id'       => 'integration-ch1',
    'title'    => 'Communication PHP ↔ base de données',
    'subtitle' => 'Le pipeline complet : requête utilisateur → PHP → SQL → résultat → HTML',

    'objectives' => [
        'Visualiser le chemin complet d\'une requête, de l\'utilisateur jusqu\'à l\'affichage.',
        'Identifier le rôle de chaque brique : navigateur, Apache, PHP, PDO, MySQL.',
        'Comprendre pourquoi une page dynamique est assemblée à chaque visite.',
        'Écrire un premier script qui lit la base et génère du HTML.',
        'Savoir localiser une panne dans le pipeline.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'pipeline',
            'title' => 'Le pipeline complet',
            'icon'  => '🔄',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Quand un visiteur ouvre <code>liste_etudiants.php</code>, voici le chemin exact de la requête :</p><ol><li>le <strong>navigateur</strong> envoie une requête HTTP au serveur ;</li><li><strong>Apache</strong> (fourni par WAMP) reçoit l\'URL et le transmet à l\'interpréteur <strong>PHP</strong> ;</li><li>PHP exécute le script : il se connecte à la base via <strong>PDO</strong> et envoie une requête <strong>SQL</strong> au SGBD (MySQL) ;</li><li>MySQL exécute la requête et renvoie <em>des lignes</em> (des tableaux PHP) ;</li><li>PHP mélange ces données avec du HTML et fabrique la page finale ;</li><li>PHP renvoie le <strong>HTML complet</strong> au navigateur, qui l\'affiche.</li></ol>',
                 'darija' => '<p>Mnin l\'utilisateur kayftach la page, had le chemin khdem : navigateur kayseft requête HTTP → Apache kay9belha → kay3tiha l PHP → kayseft requête SQL l MySQL → MySQL kayrji3 les lignes → PHP kaykhlat les lignes m3a HTML → kayseft la page kamla l navigateur. Kol ziyara had le cycle kay3awed rasso : la page katbni waghtayn, machi page wjda sauvegardée.</p>'],

                ['type' => 'syntax', 'lang' => 'text', 'title' => 'Schéma ASCII du pipeline',
                 'code' => 'NAVIGATEUR              SERVEUR (WAMP)                        SGBD
-----------             ------------------------------        ------------
 "A3tini                 [Apache] reçoit /liste.php
  /liste.php"  ────────►        │
                                ▼
                         [PHP] exécute le script
                                │  prepare("SELECT ...")
                                ▼
 les lignes ◄───────────────────┼──────────────────────────► [MySQL]
 (tableaux PHP)                 │                            exécute le SQL
                                ▼
 [PHP] boucle foreach :
   $row["nom"] → <tr><td>…</td></tr>
                                │
   HTML complet  ◄──────────────┘
   le navigateur affiche la page'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'briques',
            'title' => 'Le rôle de chaque brique',
            'icon'  => '🧱',
            'blocks' => [
                ['type' => 'table',
                 'headers' => ['Brique', 'Ce qu\'elle fait', 'Ne la confonds pas avec'],
                 'rows' => [
                    ['Navigateur', 'Affiche le HTML reçu, exécute CSS / JS', 'Le serveur : il ne touche jamais à MySQL'],
                    ['Apache', 'Routeur HTTP : un URL → un fichier .php', 'PHP : Apache n\'écrit pas la logique'],
                    ['PHP', 'Logique : lit les données, calcule, génère le HTML', 'Le navigateur : PHP tourne uniquement côté serveur'],
                    ['PDO', 'La CONNEXION entre PHP et le SGBD', 'MySQL lui-même : PDO transporte les requêtes, il ne les exécute pas'],
                    ['MySQL (SGBD)', 'Stocke les tables, exécute le SQL, renvoie les lignes', 'La base du projet : un SGBD peut héberger plusieurs bases'],
                 ],
                 'fr' => 'Retenez-le : chaque brique a UNE responsabilité unique. Quand l\'application tombe en panne, interrogez les briques une à une.'],

                ['type' => 'definition', 'title' => 'Page dynamique',
                 'fr'   => 'Page dont le HTML est construit à chaque requête à partir de données (souvent issues de la base). Deux visites peuvent donc produire des pages différentes.',
                 'darija' => 'Page dynamique : la page katbni waghtayn. 9bel ma tzid étudiant f la base kolchi différent. Page statique hiya fixe, kol visiteur kaychof nefs contenu.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'premier-script',
            'title' => 'Premier script qui lit la base',
            'icon'  => '🚀',
            'blocks' => [
                ['type' => 'example',
                 'title' => 'Liste des étudiants (PDO + MySQL, à exécuter sous WAMP)',
                 'lang'  => 'php',
                 'code'  => '<?php
// liste_etudiants.php — ouvrir via http://localhost/
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

    $rows = $pdo->query("SELECT nom, prenom, filiere FROM etudiant ORDER BY nom")
               ->fetchAll();

    echo "<table>";
    foreach ($rows as $row) {
        echo "<tr><td>" . htmlspecialchars($row["filiere"]) . " - "
                        . htmlspecialchars($row["nom"]) . "</td></tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
}',
                 'explainFr' => 'PHP ouvre la connexion (PDO), envoie le SQL, reçoit un tableau de tableaux associatifs ($row["colonne"]), puis une boucle <b>foreach</b> transforme chaque ligne en <code>&lt;tr&gt;</code>. Le même fichier affiche 3 ou 300 étudiants selon la base — c\'est ça le dynamisme. Ce code s\'exécute sous WAMP : dans la sandbox CLI il sert de démonstration.',
                 'explainDarija' => 'Had script kay3mel 3 mo7a9 : PDO kayfat le connexion, kayseft SQL kay9bel les lignes, w b boucle foreach kaybni les lignes dyal HTML. Ila f la base kayn 3 étudiants kaybni 3 lignes, ila 300 — nefs script. Hadi hiya la puissance dyal PHP+SQL.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'pannes',
            'title' => 'Diagnostiquer une panne du pipeline',
            'icon'  => '🔧',
            'blocks' => [
                ['type' => 'table',
                 'headers' => ['Symptôme', 'Cause probable', 'Où chercher'],
                 'rows' => [
                    ['Page 404', 'Mauvais URL ou fichier absent du bon dossier', 'Nom du fichier + dossier htdocs'],
                    ['Page blanche', 'PHP a crashé (erreur non affichée)', 'Journal d\'erreurs Apache/PHP'],
                    ['"Connection refused" / PDOException', 'MySQL n\'est pas démarré ou identifiants faux', 'Icône WAMP + config.php'],
                    ['Tableau vide sans erreur', 'La requête ne renvoie rien', 'Tester le SQL dans phpMyAdmin'],
                 ],
                 'fr' => 'Règle d\'or : remontez le pipeline dans l\'ordre. D\'abord « le navigateur reçoit-il une réponse ? », puis « PHP s\'exécute-t-il ? », enfin « le SQL renvoie-t-il des lignes ? ».'],

                ['type' => 'tip', 'title' => 'Un seul endroit pour tester le SQL',
                 'fr'   => 'Avant de mettre une requête dans PHP, testez-la dans phpMyAdmin. Si elle ne marche pas là, elle ne marchera pas dans le code.',
                 'darija' => '9bel matkteb requête f PHP, jerrebha f phpMyAdmin. Ila ma khdamach ghadi ma tkhdemch f PHP : hafni wa7d mokalef dyal SQL mahdhr 3liha.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Écrire le SQL au milieu de la boucle HTML',
            'fix'    => 'SQL d\'abord (en haut du fichier), HTML ensuite',
            'fr'     => 'On récupère TOUTES les données d\'abord, ensuite on génère le HTML. Mélanger les deux rend le code impossible à maintenir.',
            'darija' => 'Ma takhlat4 le SQL m3a HTML f nefs boucle : joubl SQL fo9, mn ba3d HTML. Kol chose fiha blastha.',
        ],
        [
            'wrong'  => '$row["Nom"]',
            'fix'    => '$row["nom"]',
            'fr'     => 'Les clés FETCH_ASSOC respectent la casse du nom de colonne SQL : "Nom" ≠ "nom".',
            'darija' => 'Ila katkteb colonne b majuscule (bhal "Nom") w f la table smiytha "nom", FETCH_ASSOC ma katjbat4 la valeur. Kolchi kif ma mktoba f la table.',
        ],
        [
            'wrong'  => 'Penser que PHP dessine les pages',
            'fix'    => 'PHP CRÉE le texte HTML ; le navigateur seul « dessine »',
            'fr'     => 'PHP fabrique du TEXTE (HTML). C\'est le navigateur qui interprète ce texte et le rend visuel.',
            'darija' => 'PHP kaykteb ghir texte HTML. Le dessin li kaychofo 3inik kaydar 3lih navigateur m3a CSS, machi PHP.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Le pipeline</b> : navigateur → Apache → PHP → (PDO) → MySQL → lignes → HTML généré → navigateur. Chaque brique a un rôle unique et une panne se situe toujours à un maillon précis. Une page dynamique est <b>assemblée à la demande</b> à partir des données de la base.',
        'darija' => 'Had le chemin : navigateur → Apache → PHP → PDO → MySQL → les lignes → HTML → navigateur. Kol brique 3anda wajda : hadi hmme le secret dyal debug. Page dynamique katbni kol ziyara 3li 7asab les données li kaynin f la base.',
    ],
];
