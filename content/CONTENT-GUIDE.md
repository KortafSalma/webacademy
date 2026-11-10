# GUIDE DE RÉDACTION DU CONTENU — WebAcademy

## Où écrire
- Chapitre N du module M : `content/M/cNN.php` (NN en deux chiffres : c02, c03…)
- Exercices : `content/M/exNN.php`
- Quiz : `content/M/qzNN.php`
- Datasets SQL : `content/sql/datasets/*.php`
- Glossaire : `content/glossary/glossary.php` (append)
- Projets : `content/projects/projectN.php`

## Schéma chapitre (cNN.php) — COPIER LE FORMAT DE content/html/c01.php
```php
return [
    'id' => 'module-chN', 'title' => '…', 'subtitle' => '…',
    'objectives' => [ '…', … ],
    'lessons' => [
        [ 'id'=>'section-id', 'title'=>'…', 'icon'=>'*', 'blocks' => [ BLOC, … ] ],
    ],
    'mistakes' => [ ['wrong' => '…', 'fix' => '…', 'fr' => '…', 'darija' => '…'] ],
    'summary' => [ 'fr' => '<b>…</b>', 'darija' => '…' ],
];
```
BLOCS DISPONIBLES :
- `['type'=>'text',       'fr'=>'<p>…</p>', 'darija'=>'<p>…</p>']`
- `['type'=>'definition', 'title'=>'…', 'fr'=>'…', 'darija'=>'…']`
- `['type'=>'syntax',     'lang'=>'php|html|css|sql', 'code'=>"…", 'title'=>'…']`
- `['type'=>'example',    'title'=>'…', 'lang'=>'…', 'code'=>"…", 'output'=>"...",
     'explainFr'=>'…', 'explainDarija'=>'…', 'preview'=>true (html/css uniquement)]`
- `['type'=>'note|tip|warning', 'title'=>'…', 'fr'=>'…', 'darija'=>'…']`
- `['type'=>'table', 'headers'=>['a','b'], 'rows'=>[['1','2'],…], 'fr'=>'…']`
- `['type'=>'keywords', 'items'=>[ ['kw'=>'strlen()', 'fr'=>'…', 'darija'=>'…'] ], …]`

## RÈGLES DE QUALITÉ (NON NÉGOCIABLE)
1. **Tout contenu réel** — jamais de placeholder « … », « TODO » ou « à compléter ».
2. **FR correct et professionnel** ; darija naturelle en ARABIZI (latin) : mots
   simples du quotidien :  « katkhzzen », « had variable katkhezzen la valeur »,
   « boucle kat3awed kaykhdem code », « had fonction katrji3 résultat b return ».
   Ni traduction littérale ni charabia : chaque phrase darija doit être lisible
   par un étudiant marocain. On garde les mots techniques en français/anglais.
3. Chaque notion : syntaxe + example complet exécutable + explication FR + darija.
4. `mistakes[]` : 2 à 4 erreurs fréquentes avec la correction.
5. `summary` : 2-4 phrases par langue.
6. Chaque fichier doit passer `php -l fichier.php` sans erreur.
7. Pas de backticks non échappés dans les chaînes PHP single-quoted.
   Pour la darija utilise `'…php…'` avec apostrophes échappées `\'` ou heredoc.
8. Échapper correctement : dans `fr`/`darija` (HTML), `<code>x</code>` pour du code inline.

## Schéma exercices (exNN.php) — COPIER content/html/ex01.php
- `levels` : TOUJOURS 3 niveaux (1 Débutant, 2 Intermédiaire, 3 Avancé).
- Chaque niveau : `lang`, `instructions` (FR, html), `instructionsDarija` (html),
  `starter` (code de départ réel), `tests`, `hints` (2-3), `solution` (code complet),
  `explainFr`, `explainDarija`.
- TESTS disponibles (vérification automatique RÉELLE) :
  - html/css : `html_contains` (texte à trouver, insensible à la casse),
    `html_regex`, `html_not_regex`
  - php : `output_contains`, `output_equals`, `output_not_contains`, `output_regex`
    → la sortie réelle du code exécuté par le runtime PHP est comparée.
  - sql : `sql_ok`, `result_has` (value = tableau de valeurs attendues dans UNE
    ligne), `result_lacks`, `row_count` {op:'=='>='<=','value':N}
- PHP : le code étudiant tourne en CLI isolé. Les exercices doivent utiliser
  echo/print pour produire la sortie vérifiée. PAS de $_GET/$_POST web.
- SQL : préciser `dataset` (ex : 'school') : la requête est exécutée vraiment.

## Schéma quiz (qzNN.php) — COPIER content/html/qz01.php
- 5 à 8 questions. Types : 'mcq','multi','tf','fill','predict','find-error',
  'complete','sql'.
- CHAQUE question : `answer`, `concept` (libellé court du point du cours),
  `explainFr` ET `explainDarija` (obligatoires !).
- 'predict' : question « qu'affiche ce code ? » avec codeText + options.
- 'sql' : `dialect:'sqlite'|'mysql'`, `test` => ['type'=>'result_has','value'=>['…']]
  → réellement exécutée contre le dataset.

## Datasets SQL (content/sql/datasets/*.php)
- Champs : id, label, tables, drop, ddl_sqlite, ddl_mysql, data.
- ddl_sqlite : `INTEGER PRIMARY KEY AUTOINCREMENT`, TEXT/REAL.
- ddl_mysql : `INT AUTO_INCREMENT PRIMARY KEY`, VARCHAR/DECIMAL, ENGINE=InnoDB inutile.
- data : INSERT compatibles deux moteurs (pas de fonctions SQL exotiques).
- Insérer 6-15 lignes par table de façon cohérente (clés étrangères valides).

## Style général
- Regarder c01/ex01/qz01 HTML comme MODÈLE de longueur et de densité.
- Chapitres longs : 3-6 sections, ~10-18 blocs au total.
- Interdits dans la darija : phrases absurdes, mots inexistants, traductions mot à
  mot. Test simple : lisez à voix haute — doit sonner comme un prof marocain.
- Interdits en FR : anglicismes inutiles, polices fantaisistes.
