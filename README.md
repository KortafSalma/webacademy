# WebAcademy

Plateforme de cours locale : HTML, CSS, PHP, SQL, intégration, C++, JavaScript et Oracle.

## Lancer sous Windows

Double-cliquer sur `LANCER_WEBACADEMY.bat`, ou lancer :

```powershell
php -S 127.0.0.1:8088 -t public public/router.php
```

Ouvrir http://127.0.0.1:8088/. PHP 8.1+ avec PDO SQLite, mbstring et proc_open est nécessaire. Le backend et le frontend sont servis par PHP. `npm ci` réinstalle les dépendances Node des outils si nécessaire.

## Cours et documents

Les sources des cours, exercices et quiz se trouvent dans `content/`. Les documents Markdown et les archives de déploiement sont inclus dans le dépôt. Aucun fichier PDF n’était présent dans le dossier local au moment du premier envoi.

Huit chapitres supplémentaires sont disponibles dans le programme, avec explications français/darija, exemples, deux exercices corrigés et cinq questions de quiz par chapitre :

| Parcours | Chapitres ajoutés |
| --- | --- |
| JavaScript | 31 : expressions régulières ; 32 : tests de fonctions et cas limites |
| C++ | 31 : algorithmes STL ; 32 : complexité temporelle et mémoire |
| PHP | 16 : namespaces et alias ; 17 : interfaces et traits |
| SQL | 15 : CTE avec WITH ; 16 : classement et cumul avec les fenêtres |

Le programme compte maintenant 154 chapitres. Les nouveaux chapitres C++ et JavaScript figurent également dans le groupe « Approfondissement et pratique » de leurs pages de cours. Les nouveaux exercices SQL utilisent leurs propres données avec des CTE.

## Données sauvegardées

`data/exports/app.sqlite` contient une sauvegarde cohérente des notes, réglages, historique et progression. `data/exports/sql_sandbox.sqlite` contient la base des exercices SQL. Les fichiers `.sql` équivalents et `inventory.json` sont également inclus. Les fichiers SQLite actifs et leurs journaux restent locaux ; les sauvegardes représentent les données au moment de l’envoi.

Pour restaurer les données, arrêter le serveur PHP et tout processus utilisant les bases, puis copier :

```powershell
Copy-Item data/exports/app.sqlite data/app.sqlite
Copy-Item data/exports/sql_sandbox.sqlite data/sql_sandbox.sqlite
```

Restaurer dans une installation neuve ou sauvegarder les bases existantes avant remplacement. Ne pas remplacer une base pendant qu’elle est ouverte.

## Vérification

```powershell
php tools/test-audit-fixes.php
php tools/validate-content.php
php tools/test-php-exercises.php
php tools/test-sql-exercises.php
node tools/audit-runner.cjs
```

Pour exécuter aussi les exemples des huit nouveaux chapitres, installer Python, Node, PHP et g++ dans le PATH, puis lancer `python tools/test-course-additions.py`. Le contrôle C++ compile en C++17 dans un répertoire temporaire ; les exemples SQL utilisent SQLite en mémoire.

Le serveur doit utiliser `public/` comme racine web. MySQL nécessite un service séparé ; l’exécution Oracle côté serveur n’est pas implémentée.
