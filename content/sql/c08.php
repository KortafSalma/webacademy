<?php

declare(strict_types=1);

/**
 * MODULE SQL — Chapitre 8 : Fonctions d'agrégation
 * Logique identique en MySQL, Oracle et SQLite ; les requêtes exécutées
 * dans le labo tournent sur SQLite (dataset school).
 */

return [
    'id'       => 'sql-ch8',
    'title'    => 'Fonctions d\'agrégation (COUNT, SUM, AVG, MAX, MIN)',
    'subtitle' => 'Passer de « lire des lignes » à « calculer des statistiques » sur la base school.',

    'objectives' => [
        'Compter des lignes de trois façons : COUNT(*), COUNT(colonne), COUNT(DISTINCT).',
        'Calculer un total et une moyenne avec SUM et AVG.',
        'Trouver la plus grande et la plus petite valeur avec MAX et MIN.',
        'Regrouper les calculs par catégorie avec GROUP BY et les filtrer avec HAVING.',
        'Savoir ce qui change (et ne change pas) entre MySQL, Oracle et SQLite.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1 : COUNT
        [
            'id'    => 'count-variantes',
            'title' => 'COUNT : les trois variantes',
            'icon'  => '🔢',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Une <strong>fonction d\'agrégation</strong> prend plusieurs lignes et renvoie <strong>une seule valeur</strong>. La première du programme : <code>COUNT</code>, qui compte. Elle a trois formes qui ne donnent <strong>pas le même résultat</strong> :</p><ul><li><code>COUNT(*)</code> : compte <strong>toutes les lignes</strong>, même celles qui contiennent des NULL ;</li><li><code>COUNT(colonne)</code> : compte <strong>uniquement les lignes où la colonne n\'est pas NULL</strong> ;</li><li><code>COUNT(DISTINCT colonne)</code> : compte les <strong>valeurs différentes</strong> (les doublons ne comptent qu\'une fois).</li></ul>',
                 'darija' => '<p>Fonction d\'agrégation kat-akhod bzzaf dyal lignes w kat-rejje3 ghir wa7d raqm. <code>COUNT(*)</code> kat7ssab kolchi les lignes, <code>COUNT(colonne)</code> kat-tafrth lignes li fiha NULL, w <code>COUNT(DISTINCT)</code> kat7ssab ghir les valeurs mokhtalfin — kolchi li kayt3awed kaynqd=count ghir mera we7da.</p>'],

                ['type' => 'example',
                 'title' => 'Combien de notes au total ?',
                 'lang'  => 'sql',
                 'code'  => '-- La table note contient 10 lignes (id 1 a 10)\nSELECT COUNT(*) FROM note;',
                 'output' => 'COUNT(*)\n10',
                 'explainFr' => 'Dans le dataset school, la table <code>note</code> contient exactement 10 lignes. <code>COUNT(*)</code> compte chaque ligne, y compris la ligne 7 dont <code>professeur_id</code> vaut NULL.',
                 'explainDarija' => 'Table <code>note</code> fiha 10 lignes. <code>COUNT(*)</code> kat7ssab kolchi, hta ligne 7 li fiha prof NULL. Hadi hiya la agregation : 10 lignes dakho, khrouj raqm we7da.'],

                ['type' => 'example',
                 'title' => 'COUNT(colonne) ignore les NULL',
                 'lang'  => 'sql',
                 'code'  => 'SELECT COUNT(professeur_id) FROM note;',
                 'output' => 'COUNT(professeur_id)\n9',
                 'explainFr' => 'Sur les 10 notes, une seule (la ligne 7 : Anglais de Omar) a été saisie sans professeur, son <code>professeur_id</code> est NULL. <code>COUNT(professeur_id)</code> la rejette : 9 et non 10.',
                 'explainDarija' => 'Kayn 10 notes, walakin note 7 (Anglais dyal Omar) mkayla bla prof : <code>professeur_id</code> dyalha NULL. <code>COUNT(professeur_id)</code> kat-skomn had ligne, por cette raison kat-rejje3 9 machi 10.'],

                ['type' => 'example',
                 'title' => 'Combien d\'étudiants distincts ont au moins une note ?',
                 'lang'  => 'sql',
                 'code'  => 'SELECT COUNT(DISTINCT etudiant_id) FROM note;',
                 'output' => 'COUNT(DISTINCT etudiant_id)\n5',
                 'explainFr' => 'La colonne <code>etudiant_id</code> contient 10 valeurs, mais avec répétitions : seuls les étudiants 1, 2, 3, 4 et 5 sont concernés. DISTINCT supprime les doublons → 5.',
                 'explainDarija' => 'Colonne <code>etudiant_id</code> fiha 10 valeurs walakin kayn répétitions : les étudiants 1, 2, 3, 4, 5 homa boa légar. DISTINCT kaybloki les doublons, donc le résultat 5.'],

                ['type' => 'table',
                 'headers' => ['Requête', 'Résultat sur school', 'Pourquoi'],
                 'rows' => [
                     ['COUNT(*) FROM note', '10', 'Toutes les lignes, NULL inclus'],
                     ['COUNT(professeur_id) FROM note', '9', 'La ligne 7 (NULL) est écartée'],
                     ['COUNT(DISTINCT etudiant_id) FROM note', '5', '5 étudiants ont des notes, sans doublon'],
                     ['COUNT(DISTINCT matiere_id) FROM note', '4', 'Les 4 matières ont reçu une note'],
                 ],
                 'fr' => 'Même table, trois questions distinctes : « combien de lignes », « combien de lignes non vides », « combien de valeurs différentes ».'],
            ],
        ],

        // ------------------------------------------------ Section 2 : SUM / AVG
        [
            'id'    => 'sum-avg',
            'title' => 'SUM et AVG : total et moyenne',
            'icon'  => '➕',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><code>SUM(colonne)</code> additionne les valeurs numériques d\'une colonne. <code>AVG(colonne)</code> calcule la <strong>moyenne</strong> (darija : « l\'mouyenna ») : la somme divisée par le nombre de valeurs <em>non NULL</em>. AVG ignore les NULL du numérateur <strong>et</strong> du dénominateur.</p>',
                 'darija' => '<p><code>SUM</code> katjmc ga3 les valeurs. <code>AVG</code> kat7ssab la moyenne (l\'mouyenna) : la somme machsloulom 3adad dyal les valeurs li mghshouch. Makayn 7固定资产投资 NULL : kay-ykhlasser la somme w kadaych dénominateur mosselկa.</p>'],

                ['type' => 'example',
                 'title' => 'Somme de toutes les notes de l\'école',
                 'lang'  => 'sql',
                 'code'  => 'SELECT SUM(valeur) FROM note;',
                 'output' => 'SUM(valeur)\n138.3',
                 'explainFr' => 'Addition des 10 notes : 14.5 + 16 + 15 + 17 + 12.5 + 9 + 13 + 18.5 + 11 + 11.8 = 138.3.',
                 'explainDarija' => 'Jmaa dyal les 10 notes : 14.5 + 16 + 15 + 17 + 12.5 + 9 + 13 + 18.5 + 11 + 11.8, kti3tiek 138.3. 7ssabhom f wir w tchouf — hadi SUM.'],

                ['type' => 'example',
                 'title' => 'Moyenne générale de l\'école',
                 'lang'  => 'sql',
                 'code'  => 'SELECT AVG(valeur) FROM note;\n\n-- Version arrondie, plus lisible :\nSELECT ROUND(AVG(valeur), 2) FROM note;',
                 'output' => 'AVG(valeur)\n13.83\n\nROUND(AVG(valeur), 2)\n13.83',
                 'explainFr' => 'Moyenne = 138.3 / 10 notes = 13.83. La note sans professeur (ligne 7) compte, car on agrège <code>valeur</code>, pas <code>professeur_id</code>. <code>ROUND(x, 2)</code> arrondit à 2 décimales — pratique quand la moyenne donne 15.5833333…',
                 'explainDarija' => 'La moyenne = 138.3 ÷ 10 = 13.83. Note 7 li bla prof katdkhol f calcul 7it kanhsbo <code>valeur</code> machi <code>professeur_id</code>. Ila la moyenne kat-khroj b chiffres twil bhal 15.5833333…, dir ROUND(x, 2) bach tqte3ha 2 chiffres ba3d la fasila.'],

                ['type' => 'warning',
                 'title' => 'AVG ignore les lignes manquantes',
                 'fr'   => 'Une ligne absente de la table (un étudiant sans note dans une matière) n\'apparaît jamais comme NULL : elle n\'existe pas. AVG ne le « voit » pas. Réfléchissez toujours à ce que la moyenne mesure et combien de lignes la composent.',
                 'darija' => 'Ligne ma kaynach f table (etudiant bla note f mosdarwin) ma katbanesh bhal NULL : hiya ma insertatch dima. AVG ma kichoufhach. Fazet : fkr kifach la moyenne kat7ssab w ch7al mn ligne dakhlat fiha.'],
            ],
        ],

        // ------------------------------------------------ Section 3 : MAX / MIN
        [
            'id'    => 'max-min',
            'title' => 'MAX et MIN : le plus haut, le plus bas',
            'icon'  => '⬆️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p><code>MAX(colonne)</code> renvoie la plus grande valeur, <code>MIN(colonne)</code> la plus petite. Elles marchent aussi sur du texte (ordre alphabétique) et sur des dates : « le premier nom par ordre alphabétique » = <code>MIN(nom)</code>, « la date la plus récente » = <code>MAX(date_note)</code>.</p>',
                 'darija' => '<p><code>MAX</code> kat-rejje3 akber valeur, <code>MIN</code> ou9la 9ma — katakhdmo 7ta 3la texte (ordre alphabétique) w 3la dates. Bhal « chkoun huwa le premier f le w alphabet » = <code>MIN(nom)</code>, « 9mola date » = <code>MAX(date_note)</code>.</p>'],

                ['type' => 'example',
                 'title' => 'Meilleure note et plus basse note',
                 'lang'  => 'sql',
                 'code'  => 'SELECT MAX(valeur) AS meilleure, MIN(valeur) AS plus_basse FROM note;',
                 'output' => 'meilleure | plus_basse\n18.5 | 9',
                 'explainFr' => 'MAX = 18.5 (note de Leila Sekkat en PHP), MIN = 9 (Math de Omar Boukhriss). Les alias <code>AS meilleure</code> rendent la colonne du résultat lisible.',
                 'explainDarija' => 'MAX = 18.5 (la note dyal Leila Sekkat f PHP), MIN = 9 (Math dyal Omar Boukhriss). B <code>AS</code> 3tina lsamiya l colonne f le résultat : <code>meilleure</code> w <code>plus_basse</code>.'],

                ['type' => 'example',
                 'title' => 'MAX / MIN sur du texte et des dates',
                 'lang'  => 'sql',
                 'code'  => 'SELECT (SELECT MIN(nom) FROM etudiant) AS premier_nom,\n       (SELECT MAX(date_note) FROM note) AS derniere_date;',
                 'output' => 'premier_nom | derniere_date\nBoukhriss | 2026-01-15',
                 'explainFr' => 'MIN sur du texte renvoie « Boukhriss » (premier par ordre alphabétique) ; MAX sur des dates renvoie la plus récente : 2026-01-15. Ici on agrège deux tables en une seule requête grâce aux sous-requêtes scalaires (détailles au chapitre 10).',
                 'explainDarija' => 'MIN 3la le texte kat-rejje3 « Boukhriss » (le premier f l\'alphabet) ; MAX 3la les dates kat-rejje3 la plus récente : 2026-01-15. Dimand : kan-aggregaw deux tables f requete we7da b sous-requete — 7ta ntését f chapitre 10.'],
            ],
        ],

        // ------------------------------------------------ Section 4 : GROUP BY / HAVING
        [
            'id'    => 'group-by-having',
            'title' => 'GROUP BY et HAVING : statistiques par groupe',
            'icon'  => '📊',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Une agrégation « globale » (une seule réponse pour toute la table) est rarement suffisante. On veut presque toujours calculer <strong>par groupe</strong> : moyenne par matière, nombre de notes par étudiant… C\'est le rôle de <code>GROUP BY colonne</code> : les lignes sont découpées en groupes, et la fonction d\'agrégation produit <strong>une valeur par groupe</strong>.</p><p>Pour filtrer <strong>après l\'agrégation</strong>, on utilise <code>HAVING</code> : <code>WHERE</code> filtre les lignes <em>avant</em> le calcul et ne comprend pas les fonctions d\'agrégation.</p>',
                 'darija' => '<p>Aggregate wa7da l\'l-formation ma katfidxi — bnadourwa dima « la moyenne dyal kol matiere ». <code>GROUP BY</code> kayqsem les lignes 3la groupes, w la fonction kat3ti valeur par group. Mn ba3d, bach tfltri les groupes (dontc : ghir les matières li l\'mouyenna 3andhom 12+) katktb <code>HAVING</code> — 7it <code>WHERE</code> kayfltri lignes lattehla w ma ykfahmch COUNT/SUM/AVG.</p>'],

                ['type' => 'definition', 'title' => 'Ordre d\'exécution logique',
                 'fr'   => '<p>Une requête SELECT s\'exécute dans cet ordre : <code>FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY</code>. WHERE passe avant l\'agrégation (il ne connaît pas les agrégats), HAVING passe après le GROUP BY (il peut les utiliser).</p>',
                 'darija' => '<p>L\'ordre d\'execution : <code>FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY</code>. Mananat : WHERE kayfltri lignes oqbal ma yet7ssbo les agregat — manwalefch m3ahom. HAVING kaykhdem mn ba3d GROUP BY — commonly uniquement liinhom mouyenna mtawjda.</p>'],

                ['type' => 'example',
                 'title' => 'Moyenne par matière, filtrée avec HAVING',
                 'lang'  => 'sql',
                 'code'  => 'SELECT matiere_id, ROUND(AVG(valeur), 2) AS moyenne, COUNT(*) AS nb_notes\nFROM note\nGROUP BY matiere_id\nHAVING AVG(valeur) >= 13\nORDER BY moyenne DESC;',
                 'output' => 'matiere_id | moyenne | nb_notes\n2 | 15.67 | 3\n3 | 13.4 | 2\n4 | 13 | 1',
                 'explainFr' => 'GROUP BY découpe les 10 notes en 4 groupes (matières 1 à 4). Moyennes exactes : Math (id 1) = 12.875 ; PHP (id 2) = 15.67 ; Base de donnees (id 3) = 13.4 ; Anglais (id 4) = 13. HAVING écarte Math (12.875 &lt; 13) : restent les matières 2, 3 et 4. Impossible avec WHERE : on filtre sur AVG(valeur), un agrégat.',
                 'explainDarija' => 'GROUP BY katqsem les 10 notes 3la 4 groupes (matiere 1, 2, 3, 4). Mouyennat : Math = 12.875, PHP = 15.67, Base de donnees = 13.4, Anglais = 13. <code>HAVING</code> kayfrex Math hadi (12.875 7sen men 13) — katbqa matiere 2, 3, 4. Ma yemkench b WHERE : katfltri 3la <code>AVG(valeur)</code>, agregat.'],

                ['type' => 'table',
                 'headers' => ['Où filtrer ?', 'Mot-clé', 'Exemple sur school'],
                 'rows' => [
                     ['AVANT l\'agrégation (les lignes)', 'WHERE', 'WHERE valeur &gt;= 15 → on ne compte que les bonnes notes'],
                     ['APRÈS l\'agrégation (les groupes)', 'HAVING', 'HAVING AVG(valeur) &gt;= 12 → on ne garde que les groupes corrects'],
                 ],
                 'fr' => 'Règle d\'or : WHERE agit sur le contenu des lignes, HAVING sur le résultat du GROUP BY.'],
            ],
        ],

        // ------------------------------------------------ Section 5 : MySQL et Oracle
        [
            'id'    => 'mysql-oracle-aggregats',
            'title' => 'Même logique en MySQL et Oracle',
            'icon'  => '🏢',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Bonne nouvelle : <code>COUNT, SUM, AVG, MAX, MIN, GROUP BY, HAVING</code> gardent la <strong>même syntaxe</strong> dans MySQL, Oracle et SQLite : c\'est du SQL standard. Les différences restent minimes et concernent la définition des tables (types, auto-increment) pas les agrégats.</p>',
                 'darija' => '<p>Zwin : <code>COUNT, SUM, AVG, MAX, MIN, GROUP BY, HAVING</code> b nefs l\'syntaxe f MySQL, Oracle w SQLite — hadi hiya le standard SQL. Les différences rahi ghir f création dyal les tables (types, auto-increment), machi f les agregat.</p>'],

                ['type' => 'syntax',
                 'title' => 'Oracle — syntaxe expliquée, non exécutée dans le labo',
                 'lang'  => 'sql',
                 'code'  => '-- Table Oracle equivalente a la table note de school :\nCREATE TABLE note (\n  id   NUMBER GENERATED BY DEFAULT AS IDENTITY,  -- auto-increment Oracle 12c+\n  valeur NUMBER(4,2) NOT NULL CHECK (valeur BETWEEN 0 AND 20),\n  etudiant_id NUMBER NOT NULL\n);\n\n-- Les agregats, a l\'identique (SQL standard) :\nSELECT COUNT(*), SUM(valeur), ROUND(AVG(valeur), 2), MAX(valeur), MIN(valeur)\nFROM note;\n\n-- NVL remplace un NULL par une valeur (equivalent COALESCE) :\nSELECT AVG(NVL(valeur, 0)) FROM note;  -- les notes absentes comptent comme 0'],

                ['type' => 'table',
                 'headers' => ['Fonctionnalité', 'MySQL', 'Oracle', 'SQLite (labo)'],
                 'rows' => [
                     ['COUNT / SUM / AVG / MAX / MIN / GROUP BY / HAVING', 'Oui (identique)', 'Oui (identique)', 'Oui (identique, exécutable)'],
                     ['Auto-increment', 'INT AUTO_INCREMENT PRIMARY KEY', 'GENERATED ... AS IDENTITY (ou SEQUENCE)', 'INTEGER PRIMARY KEY AUTOINCREMENT'],
                     ['Type d\'une note', 'DECIMAL(4,2)', 'NUMBER(4,2)', 'REAL'],
                     ['Remplacer une NULL au calcul', 'IFNULL(valeur, 0)', 'NVL(valeur, 0)', 'COALESCE / IFNULL'],
                 ],
                 'fr' => 'Les agrégats sont du SQL standard : ce que vous apprenez ici tourne à l\'identique sur les trois moteurs.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'SELECT valeur, AVG(valeur) FROM note;',
            'fix'    => 'SELECT matiere_id, AVG(valeur) FROM note GROUP BY matiere_id;',
            'fr'     => 'Une colonne non agrégée doit figurer dans le GROUP BY. Sinon le SGBD ne sait pas quelle ligne afficher : erreur (Oracle, MySQL strict) ou résultat imprévisible.',
            'darija' => 'Ila katkteb colonne relachi bla agrégat, khassha tkon f GROUP BY. Sinon SQL ma y3refch qu\'une ligne yfftichi — error f Oracle w MySQL, wla result ghrib f SQLite.',
        ],
        [
            'wrong'  => 'WHERE AVG(valeur) > 12',
            'fix'    => 'HAVING AVG(valeur) > 12',
            'fr'     => 'WHERE s\'exécute avant l\'agrégation : la moyenne n\'existe pas encore à ce stade → erreur. On filtre les groupes avec HAVING, toujours après GROUP BY.',
            'darija' => 'WHERE kaykhdem oqbal LA GROUP BY, donc AVG ma mawjoudach ba3d — error. Kayfltri les groupes b HAVING, hta kat-dkhla mn ba3d GROUP BY.',
        ],
        [
            'wrong'  => 'COUNT(colonne) et COUNT(*) renvoient le même chiffre',
            'fix'    => 'COUNT(*) compte tout, COUNT(colonne) saute les NULL',
            'fr'     => 'Sur school : COUNT(*) FROM note = 10 mais COUNT(professeur_id) = 9, à cause de la note saisie sans professeur. Choisis selon la question.',
            'darija' => 'Machi nefs l\'chiffre served : f school, COUNT(*) = 10 walakin COUNT(professeur_id) = 9 (la note m7ssouba bla prof). Khtar selon la question li kat-swel.',
        ],
        [
            'wrong'  => 'Oublier ORDER BY quand le classement compte',
            'fix'    => 'Ajouter ORDER BY moyenne DESC à une requête GROUP BY',
            'fr'     => 'GROUP BY n\'ordonne pas ses groupes de façon fiable : une requête « la moyenne par matière » sans ORDER BY peut renvoyer les lignes dans un ordre différent d\'un moteur à l\'autre.',
            'darija' => 'GROUP BY ma kat-ordonner les groupes machi 3adla : kat-bda trajet. Ila l\'tri mohimm (l\'ordre) f le résultat, zid ORDER BY unique mountaheres id (f dbeli9).',
        ],
    ],

    'summary' => [
        'fr'     => '<b>COUNT(*)</b> compte toutes les lignes, <b>COUNT(colonne)</b> saute les NULL, <b>COUNT(DISTINCT)</b> élimine les doublons. <b>SUM</b> additionne, <b>AVG</b> calcule la moyenne, <b>MAX/MIN</b> sortent les extrêmes (chiffres, textes, dates). <b>GROUP BY</b> découpe les lignes en groupes pour obtenir une statistique par groupe, et <b>HAVING</b> filtre ces groupes. Syntaxe identique en MySQL, Oracle et SQLite (exécutée dans le labo).',
        'darija' => '<b>COUNT(*)</b> kat7ssab kolchi, <b>COUNT(col)</b> katskip NULL, <b>COUNT(DISTINCT)</b> katfq9 les doublons. <b>SUM</b> katjmaa, <b>AVG</b> kat7ssab l\'mouyenna, <b>MAX w MIN</b> kayjibo akber w asgber. <b>GROUP BY</b> kayqsem les lignes le groupes bach takhoud statistique par group, w <b>HAVING</b> kayfltri les groupes. Nefs l\'syntaxe f MySQL, Oracle w SQLite dyal l\'labo.',
    ],
];
