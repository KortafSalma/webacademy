# WebAcademy

Plateforme de cours locale : HTML, CSS, PHP, SQL, int?gration, C++, JavaScript et Oracle.

## Lancer sous Windows

Double-cliquer sur `LANCER_WEBACADEMY.bat`, ou lancer :

```powershell
php -S 127.0.0.1:8088 -t public public/router.php
```

Ouvrir http://127.0.0.1:8088/. PHP 8.1+ avec PDO SQLite, mbstring et proc_open est n?cessaire. Le backend et le frontend sont servis par PHP. `npm ci` r?installe les d?pendances Node des outils si n?cessaire.

## Cours et documents

Les sources des cours, exercices et quiz se trouvent dans `content/`. Les documents Markdown et les archives de d?ploiement sont inclus dans le d?p?t. Aucun fichier PDF n??tait pr?sent dans le dossier local au moment de cet envoi.

## Donn?es sauvegard?es

`data/exports/app.sqlite` contient une sauvegarde coh?rente des notes, r?glages, historique et progression. `data/exports/sql_sandbox.sqlite` contient la base des exercices SQL. Les fichiers `.sql` ?quivalents et `inventory.json` sont ?galement inclus. Les fichiers SQLite actifs et leurs journaux restent locaux ; les sauvegardes repr?sentent les donn?es au moment de l?envoi.

Pour restaurer les donn?es, arr?ter le serveur PHP et tout processus utilisant les bases, puis copier :

```powershell
Copy-Item data/exports/app.sqlite data/app.sqlite
Copy-Item data/exports/sql_sandbox.sqlite data/sql_sandbox.sqlite
```

Restaurer dans une installation neuve ou sauvegarder les bases existantes avant remplacement. Ne pas remplacer une base pendant qu?elle est ouverte.

## V?rification

```powershell
php tools/test-audit-fixes.php
php tools/validate-content.php
php tools/test-php-exercises.php
php tools/test-sql-exercises.php
node tools/audit-runner.cjs
```

Le serveur doit utiliser `public/` comme racine web. MySQL n?cessite un service s?par? ; l?ex?cution Oracle c?t? serveur n?est pas impl?ment?e.
