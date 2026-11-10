<?php

declare(strict_types=1);

namespace App\Execution;

/**
 * Exécuteur SQL — trois dialectes avec un comportement HONNÊTE :
 *  - "oracle" : AUCUNE exécution ; le client Oracle (Instant Client) n'est pas
 *               installé. On répond pédagogiquement au lieu de simuler.
 *  - "sqlite" : VRAIE exécution sur une sandbox SQLite persistante
 *               (data/sql_sandbox.sqlite), réinitialisable à volonté.
 *  - "mysql"  : VRAIE exécution sur MySQL si le serveur local tourne
 *               (WAMP / XAMPP), sinon message clair.
 * Jeux de données : content/sql/datasets/<id>.php
 */
final class SqlExecutor
{
    private const MAX_STATEMENTS = 40;
    private const MAX_ROWS = 200;
    private const DATASET_NAME = '/^[a-z0-9_-]{1,40}$/i';

    /** Motifs interdits en sandbox SQLite. */
    private const SQLITE_DENY = [
        '/\battach\s+(?:database\s+)?/i' => 'ATTACH DATABASE est désactivé (sécurité).',
        '/\bdetach\b/i'                   => 'DETACH est désactivé (sécurité).',
        '/\bload_extension\b/i'           => 'load_extension() est désactivé (sécurité).',
        '/\bvirtual\s+table\b/i'          => 'Les virtual tables ne sont pas supportées en sandbox.',
        '/\bpragma\s+(?:writable_schema|temp_store_directory|data_store_directory)\b/i'
            => 'Ce PRAGMA est désactivé (sécurité).',
        '/\bvacuum\s+into\b/i'            => 'VACUUM INTO est désactivé (écriture de fichier).',
        '/\brandomblob\s*\(\s*\d{7,}/i'   => 'Les très gros blobs aléatoires sont désactivés (limite de ressources).',
        '/\bzeroblob\s*\(\s*\d{7,}/i'     => 'Les très gros blobs sont désactivés (limite de ressources).',
    ];

    /** Motifs interdits en sandbox MySQL. */
    private const MYSQL_DENY = [
        '/\b(grant|revoke|create\s+user|drop\s+user|alter\s+user)\b/i'
            => 'Gestion des comptes utilisateur désactivée en sandbox pédagogique.',
        '/\b(?:create|drop|alter)\s+database\b/i'
            => 'La gestion des bases de données est désactivée en sandbox.',
        '/\buse\s+/i'
            => 'USE est désactivé : la sandbox reste dans sa base dédiée.',
        '/\b(?:set\s+global|set\s+@@global|set\s+password)\b/i'
            => 'La modification de la configuration globale est désactivée.',
        '/\b(?:shutdown|kill|install|uninstall|flush|reset\s+master|change\s+master)\b/i'
            => 'Cette commande administrative est désactivée en sandbox.',
        '/\bload\s+data\b/i'              => 'LOAD DATA est désactivé (accès fichiers interdit).',
        '/\binto\s+(?:out|dump)file\b/i'  => 'INTO OUTFILE / DUMPFILE est désactivé (écriture de fichiers interdite).',
        '/\bload_file\s*\(/i'            => 'LOAD_FILE() est désactivé (lecture de fichiers interdite).',
        '/\b(?:benchmark|sleep|get_lock|release_lock)\s*\(/i'
            => 'Cette fonction est désactivée (limite de ressources).',
    ];

    private static ?\PDO $sqlite = null;
    private static ?\PDO $mysql = null;
    private static ?array $mysqlReach = null;

    public static function sandboxPath(): string
    {
        if (!is_dir(APP_DATA)) {
            @mkdir(APP_DATA, 0750, true);
        }
        return APP_DATA . '/sql_sandbox.sqlite';
    }

    // ============================================================ API publique

    public static function run(string $dialect, string $sql, ?string $dataset = null): array
    {
        $dialect = strtolower($dialect);
        if (strlen($sql) > APP_MAX_SQL_BYTES) {
            return ['ok' => false, 'error' => 'Script SQL trop volumineux.', 'rows' => []];
        }
        if ($dataset !== null && $dataset !== '' && !self::datasetExists($dataset)) {
            return ['ok' => false, 'error' => 'Jeu de données inconnu.', 'rows' => []];
        }

        return match ($dialect) {
            'sqlite' => self::runSqlite($sql, $dataset ?: null),
            'mysql'  => self::runMysql($sql, $dataset ?: null),
            'oracle' => self::oracleUnavailable(),
            default  => ['ok' => false, 'error' => 'Dialecte inconnu.', 'rows' => []],
        };
    }

    public static function reset(string $dialect, string $dataset): array
    {
        $dialect = strtolower($dialect);
        if ($dialect === 'oracle') {
            return self::oracleUnavailable();
        }
        if (!in_array($dialect, ['sqlite', 'mysql'], true)) {
            return ['ok' => false, 'error' => 'Dialecte inconnu.'];
        }
        if (!self::datasetExists($dataset)) {
            return ['ok' => false, 'error' => 'Jeu de données inconnu.'];
        }

        try {
            if ($dialect === 'mysql') {
                $pdo = self::mysqlPdo(true);
                if ($pdo === null) {
                    return ['ok' => false, 'error' => 'MySQL n\'est pas joignable. Démarrez WAMP, puis réessayez.'];
                }
                self::dropAllMysqlTables($pdo);
                self::loadDataset('mysql', $dataset, false);
            } else {
                self::loadDataset('sqlite', $dataset, true);
            }
        } catch (\Throwable $e) {
            return ['ok' => false, 'error' => self::safeError($e, $dialect)];
        }

        return [
            'ok'      => true,
            'reset'   => true,
            'dataset' => $dataset,
            'message' => "Données « {$dataset} » réinitialisées (moteur : {$dialect}).",
        ];
    }

    public static function tables(string $dialect, ?string $dataset): array
    {
        if (strtolower($dialect) === 'mysql') {
            $pdo = self::mysqlPdo(false);
            if ($pdo === null) {
                return [];
            }
            $rows = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);
            return array_values(array_filter($rows ?: [], static fn ($t) => $t !== '_meta_sandbox'));
        }

        $pdo = self::sqlitePdo();
        $rows = $pdo->query(
            "SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name"
        )->fetchAll(\PDO::FETCH_COLUMN);
        return $rows ?: [];
    }

    public static function datasetExists(string $name): bool
    {
        if (!preg_match(self::DATASET_NAME, $name)) {
            return false;
        }
        $base = realpath(APP_CONTENT . '/sql/datasets');
        $file = realpath(APP_CONTENT . '/sql/datasets/' . $name . '.php');
        return $base !== false
            && $file !== false
            && str_starts_with($file, $base . DIRECTORY_SEPARATOR)
            && is_file($file);
    }

    /** Liste des jeux de données disponibles. */
    public static function datasets(): array
    {
        $dir = APP_CONTENT . '/sql/datasets';
        $out = [];
        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $spec = self::datasetSpec(basename($file, '.php'));
            if ($spec === null) {
                continue;
            }
            $out[$spec['id']] = [
                'id'     => $spec['id'],
                'label'  => (string) ($spec['label'] ?? $spec['id']),
                'tables' => is_array($spec['tables'] ?? null) ? $spec['tables'] : [],
            ];
        }
        ksort($out);
        return $out;
    }

    public static function mysqlInfo(): array
    {
        $reachable = self::mysqlReachable();
        return ['reachable' => $reachable['ok'], 'detail' => $reachable['detail']];
    }

    // ============================================================ SQLite

    private static function runSqlite(string $sql, ?string $dataset): array
    {
        foreach (self::SQLITE_DENY as $pattern => $reason) {
            if (preg_match($pattern, $sql)) {
                return ['ok' => false, 'engine' => 'sqlite', 'error' => $reason, 'rows' => []];
            }
        }

        try {
            $pdo = self::sqlitePdo();
            if ($dataset !== null && self::hasNoBusinessTables($pdo)) {
                self::loadDataset('sqlite', $dataset, false);
            }

            $statements = SqlSplitter::split($sql);
            if ($statements === []) {
                return ['ok' => false, 'engine' => 'sqlite', 'error' => 'Aucune requête SQL fournie.', 'rows' => []];
            }
            if (count($statements) > self::MAX_STATEMENTS) {
                return [
                    'ok' => false,
                    'engine' => 'sqlite',
                    'error' => 'Trop de requêtes dans un même script (' . self::MAX_STATEMENTS . ' maximum).',
                    'rows' => [],
                ];
            }

            $results = [];
            foreach ($statements as $index => $stmt) {
                try {
                    $results[] = self::pdoExecute($pdo, $stmt, 'SQLite');
                } catch (\Throwable $e) {
                    return [
                        'ok'       => false,
                        'engine'   => 'sqlite',
                        'error'    => 'Requête ' . ($index + 1) . ' — ' . self::safeError($e, 'sqlite'),
                        'rows'     => [],
                        'statements' => $results,
                    ];
                }
            }
            return self::flatten($results, 'SQLite');
        } catch (\Throwable $e) {
            return ['ok' => false, 'engine' => 'sqlite', 'error' => self::safeError($e, 'sqlite'), 'rows' => []];
        }
    }

    private static function sqlitePdo(bool $fresh = false): \PDO
    {
        if ($fresh) {
            self::$sqlite = null;
        }
        if (self::$sqlite === null) {
            $pdo = new \PDO('sqlite:' . self::sandboxPath(), null, null, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
            $pdo->exec('PRAGMA foreign_keys = ON');
            $pdo->exec('PRAGMA busy_timeout = 4000');
            $pdo->exec('PRAGMA temp_store = MEMORY');
            self::$sqlite = $pdo;
        }
        return self::$sqlite;
    }

    private static function hasNoBusinessTables(\PDO $pdo): bool
    {
        $count = $pdo->query(
            "SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'"
        )->fetchColumn();
        return (int) $count === 0;
    }

    // ============================================================ MySQL

    private static function runMysql(string $sql, ?string $dataset): array
    {
        // Sonde fraîche : l'utilisateur vient peut-être de démarrer WAMP.
        if (!self::mysqlReachable(true)['ok']) {
            return [
                'ok'     => false,
                'engine' => 'mysql',
                'rows'   => [],
                'error'  => 'MySQL n\'est pas joignable sur ' . DB_MYSQL_CONFIG['host'] . ':' . DB_MYSQL_CONFIG['port']
                    . ' — démarrez WAMP (icône verte), puis réessayez. En attendant, utilisez le moteur « SQLite ». '
                    . 'Réalité affichée : aucune requête simulée.',
            ];
        }

        foreach (self::MYSQL_DENY as $pattern => $reason) {
            if (preg_match($pattern, $sql)) {
                return ['ok' => false, 'engine' => 'mysql', 'error' => $reason, 'rows' => []];
            }
        }

        try {
            $pdo = self::mysqlPdo(true);
            if ($pdo === null) {
                return ['ok' => false, 'engine' => 'mysql', 'error' => 'Connexion MySQL impossible (identifiants ?).', 'rows' => []];
            }
            try {
                $pdo->exec('SET SESSION MAX_EXECUTION_TIME=5000');
            } catch (\Throwable) {
                // Version MySQL antérieure : la limite reste assurée par PHP.
            }

            if ($dataset !== null && self::mysqlHasNoBusinessTables($pdo)) {
                self::loadDataset('mysql', $dataset, false);
            }

            $statements = SqlSplitter::split($sql);
            if ($statements === []) {
                return ['ok' => false, 'engine' => 'mysql', 'error' => 'Aucune requête SQL fournie.', 'rows' => []];
            }
            if (count($statements) > self::MAX_STATEMENTS) {
                return [
                    'ok' => false,
                    'engine' => 'mysql',
                    'error' => 'Trop de requêtes dans un même script (' . self::MAX_STATEMENTS . ' maximum).',
                    'rows' => [],
                ];
            }

            $results = [];
            foreach ($statements as $index => $stmt) {
                try {
                    $results[] = self::pdoExecute($pdo, $stmt, 'MySQL');
                } catch (\Throwable $e) {
                    return [
                        'ok'       => false,
                        'engine'   => 'mysql',
                        'error'    => 'Requête ' . ($index + 1) . ' — ' . self::safeError($e, 'mysql'),
                        'rows'     => [],
                        'statements' => $results,
                    ];
                }
            }
            return self::flatten($results, 'MySQL');
        } catch (\Throwable $e) {
            return ['ok' => false, 'engine' => 'mysql', 'error' => self::safeError($e, 'mysql'), 'rows' => []];
        }
    }

    private static function mysqlReachable(bool $fresh = false): array
    {
        if (!$fresh && self::$mysqlReach !== null) {
            return self::$mysqlReach;
        }

        $cfg = DB_MYSQL_CONFIG;
        $host = (string) $cfg['host'];
        $port = (int) $cfg['port'];
        $cacheFile = APP_TMP . DIRECTORY_SEPARATOR . 'mysql-status.json';

        // Le résultat est mis en cache 30 s : le bootstrap ne doit pas payer
        // une sonde réseau à chaque affichage de page.
        if (!$fresh && is_file($cacheFile)) {
            $raw = @file_get_contents($cacheFile);
            $cache = is_string($raw) ? json_decode($raw, true) : null;
            if (
                is_array($cache)
                && (int) ($cache['at'] ?? 0) > time() - 30
                && ($cache['host'] ?? null) === $host
                && (int) ($cache['port'] ?? 0) === $port
                && isset($cache['ok'])
            ) {
                return self::$mysqlReach = [
                    'ok'     => (bool) $cache['ok'],
                    'detail' => (string) ($cache['detail'] ?? ''),
                ];
            }
        }

        // Un port filtré par le pare-feu peut bloquer 1,5 s : on borne
        // l'attente à 200 ms pour ne pas retarder le chargement de l'app.
        $sock = @fsockopen($host, $port, $errno, $errstr, 0.2);
        if ($sock === false) {
            self::$mysqlReach = ['ok' => false, 'detail' => "aucun serveur sur {$host}:{$port}"];
        } else {
            fclose($sock);
            self::$mysqlReach = ['ok' => true, 'detail' => "serveur détecté sur {$host}:{$port}"];
        }

        @file_put_contents($cacheFile, json_encode([
            'at'     => time(),
            'host'   => $host,
            'port'   => $port,
            'ok'     => self::$mysqlReach['ok'],
            'detail' => self::$mysqlReach['detail'],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX);

        return self::$mysqlReach;
    }

    /** PDO MySQL sur la base sandbox ; crée la base si demandé. */
    private static function mysqlPdo(bool $ensureSchema): ?\PDO
    {
        if (self::$mysql !== null) {
            return self::$mysql;
        }
        $cfg = DB_MYSQL_CONFIG;
        $host = (string) $cfg['host'];
        $port = (int) $cfg['port'];
        $base = (string) $cfg['database'];
        if (!preg_match('/^[a-zA-Z0-9_]{1,64}$/', $base)) {
            return null;
        }

        try {
            if ($ensureSchema) {
                $root = new \PDO(
                    "mysql:host={$host};port={$port};charset=utf8mb4",
                    (string) $cfg['user'],
                    (string) $cfg['pass'],
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_TIMEOUT => 3]
                );
                $root->exec("CREATE DATABASE IF NOT EXISTS `{$base}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $root->exec("USE `{$base}`");
                $root->exec('CREATE TABLE IF NOT EXISTS `_meta_sandbox` (k VARCHAR(32) PRIMARY KEY, v VARCHAR(255))');
                $root = null;
            }

            self::$mysql = new \PDO(
                "mysql:host={$host};port={$port};dbname={$base};charset=utf8mb4",
                (string) $cfg['user'],
                (string) $cfg['pass'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_TIMEOUT => 3]
            );
            return self::$mysql;
        } catch (\Throwable) {
            return null;
        }
    }

    private static function mysqlHasNoBusinessTables(\PDO $pdo): bool
    {
        $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN) ?: [];
        $tables = array_values(array_diff($tables, ['_meta_sandbox']));
        return $tables === [];
    }

    private static function dropAllMysqlTables(\PDO $pdo): void
    {
        $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN) ?: [];
        if ($tables === []) {
            return;
        }
        $pdo->exec('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            $safe = str_replace('`', '``', (string) $table);
            $pdo->exec("DROP TABLE IF EXISTS `{$safe}`");
        }
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1');
    }

    // ============================================================ Oracle

    private static function oracleUnavailable(): array
    {
        return [
            'ok'       => false,
            'engine'   => 'oracle',
            'executed' => false,
            'rows'     => [],
            'error'    => null,
            'message'  => 'Exécution Oracle NON DISPONIBLE sur cette machine : le client Oracle '
                . '(Instant Client / extension OCI8 ou PDO_OCI) n\'est pas installé. '
                . 'Vos requêtes Oracle ne sont PAS exécutées, aucune simulation n\'est faite. '
                . 'Pour l\'apprentissage : étudiez la syntaxe Oracle dans la leçon, vérifiez le résultat '
                . 'mental, puis exécutez l\'équivalent sur le moteur « SQLite » (syntaxe standard) '
                . 'ou « MySQL » si WAMP est démarré.',
            'install_hint' => 'Installer : téléchargez « Oracle Instant Client » depuis oracle.com, '
                . 'activez extension=oci8 dans php.ini (WAMP), configurez tnsnames.ora, puis redémarrez WAMP.',
        ];
    }

    // ============================================================ Datasets

    private static function datasetSpec(string $dataset): ?array
    {
        if (!self::datasetExists($dataset)) {
            return null;
        }
        try {
            $spec = require APP_CONTENT . '/sql/datasets/' . $dataset . '.php';
        } catch (\Throwable $e) {
            error_log('[WebAcademy] Dataset invalide ' . $dataset . ' : ' . $e->getMessage());
            return null;
        }
        if (!is_array($spec) || ($spec['id'] ?? null) !== $dataset) {
            return null;
        }
        return $spec;
    }

    private static function loadDataset(string $dialect, string $dataset, bool $reset): void
    {
        $spec = self::datasetSpec($dataset);
        if ($spec === null) {
            throw new \RuntimeException('Jeu de données introuvable.');
        }

        $ddl = $dialect === 'mysql'
            ? ($spec['ddl_mysql'] ?? $spec['ddl'] ?? [])
            : ($spec['ddl_sqlite'] ?? $spec['ddl'] ?? []);
        $data = $spec['data'] ?? [];
        $ddl = is_array($ddl) ? array_values(array_filter($ddl, 'is_string')) : [];
        $data = is_array($data) ? array_values(array_filter($data, 'is_string')) : [];

        if ($dialect === 'mysql') {
            $pdo = self::mysqlPdo(true);
            if ($pdo === null) {
                throw new \RuntimeException('Connexion MySQL impossible.');
            }
            if ($reset) {
                self::dropAllMysqlTables($pdo);
            }
            foreach ($ddl as $stmt) {
                try {
                    $pdo->exec($stmt);
                } catch (\Throwable $e) {
                    error_log('[WebAcademy] Dataset MySQL DDL : ' . $e->getMessage());
                }
            }
            foreach ($data as $stmt) {
                try {
                    $pdo->exec($stmt);
                } catch (\Throwable $e) {
                    error_log('[WebAcademy] Dataset MySQL data : ' . $e->getMessage());
                }
            }
            return;
        }

        // SQLite : une réinitialisation repart d'un fichier vide.
        // La connexion doit être fermée AVANT de supprimer le fichier, sinon
        // Windows garde le handle et les écritures suivantes partent dans un
        // fichier supprimé (ou échouent silencieusement).
        if ($reset) {
            self::$sqlite = null;
            $path = self::sandboxPath();
            foreach ([$path, $path . '-wal', $path . '-shm', $path . '-journal'] as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }
        $pdo = self::sqlitePdo();
        foreach ($ddl as $stmt) {
            $pdo->exec($stmt);
        }
        foreach ($data as $stmt) {
            $pdo->exec($stmt);
        }
    }

    // ============================================================ Core

    /**
     * Exécute UNE requête via PDO et normalise le résultat
     * en {columns, rows, rowCount, statementType}.
     */
    private static function pdoExecute(\PDO $pdo, string $stmt, string $engine): array
    {
        $upper = strtoupper(ltrim($stmt));
        $type = match (true) {
            str_starts_with($upper, 'SELECT') || str_starts_with($upper, 'WITH')       => 'read',
            str_starts_with($upper, 'INSERT') || str_starts_with($upper, 'UPDATE')
                || str_starts_with($upper, 'DELETE') || str_starts_with($upper, 'MERGE') => 'write',
            str_starts_with($upper, 'CREATE') || str_starts_with($upper, 'ALTER')
                || str_starts_with($upper, 'DROP') || str_starts_with($upper, 'TRUNCATE') => 'ddl',
            str_starts_with($upper, 'COMMIT') || str_starts_with($upper, 'ROLLBACK')
                || str_starts_with($upper, 'SAVEPOINT') || str_starts_with($upper, 'BEGIN') => 'txn',
            default => 'other',
        };

        $q = $pdo->query($stmt);
        $columns = [];
        $rows = [];
        $truncated = false;

        if ($q->columnCount() > 0) {
            $first = $q->fetch(\PDO::FETCH_ASSOC);
            if ($first !== false) {
                $columns = array_keys($first);
                $rows[] = self::stringify($first);
                while (count($rows) < self::MAX_ROWS) {
                    $row = $q->fetch(\PDO::FETCH_ASSOC);
                    if ($row === false) {
                        break;
                    }
                    $rows[] = self::stringify($row);
                }
                if (count($rows) === self::MAX_ROWS && $q->fetch(\PDO::FETCH_ASSOC) !== false) {
                    $truncated = true;
                }
            }
            $type = $type === 'read' ? 'read' : $type;
            $rowCount = count($rows);
        } else {
            $rowCount = $q->rowCount();
        }

        return [
            'type'      => $type,
            'engine'    => $engine,
            'sql'       => $stmt,
            'columns'   => $columns,
            'rows'      => $rows,
            'rowCount'  => $rowCount,
            'truncated' => $truncated,
            'message'   => self::statementMessage($type, $rowCount, $engine, $truncated),
        ];
    }

    private static function stringify(array $row): array
    {
        $out = [];
        foreach ($row as $k => $v) {
            $out[$k] = $v === null ? 'NULL' : (string) $v;
        }
        return $out;
    }

    private static function statementMessage(string $type, int $rowCount, string $engine, bool $truncated = false): string
    {
        $suffix = $truncated ? ' (affichage limité aux ' . self::MAX_ROWS . ' premières lignes)' : '';
        return match ($type) {
            'read'  => "{$engine} : requête de lecture exécutée — {$rowCount} ligne(s) retournée(s){$suffix}.",
            'write' => "{$engine} : opération d'écriture réussie — {$rowCount} ligne(s) affectée(s).",
            'ddl'   => "{$engine} : structure modifiée (DDL) avec succès.",
            'txn'   => "{$engine} : transaction exécutée. (En SQLite/MySQL, chaque requête tourne en autocommit.)",
            default => "{$engine} : requête exécutée.",
        };
    }

    /** Fusionne les résultats de plusieurs requêtes en une seule réponse API. */
    private static function flatten(array $results, string $engine): array
    {
        $last = $results ? $results[count($results) - 1] : null;
        return [
            'ok'         => true,
            'engine'     => strtolower($engine),
            'rows'       => $last['rows'] ?? [],
            'columns'    => $last['columns'] ?? [],
            'rowCount'   => $last['rowCount'] ?? 0,
            'truncated'  => (bool) ($last['truncated'] ?? false),
            'message'    => $last['message'] ?? '',
            'statements' => $results,
        ];
    }

    /** Les erreurs PDO ne doivent jamais révéler les chemins privés du serveur. */
    private static function safeError(\Throwable $e, string $engine): string
    {
        $message = $e->getMessage();
        $replace = [
            (string) realpath(APP_DATA) => '[données privées]',
            (string) realpath(APP_ROOT) => '[application]',
            APP_DATA => '[données privées]',
            APP_ROOT => '[application]',
        ];
        foreach ($replace as $from => $to) {
            if ($from !== '' && $from !== false) {
                $message = str_replace($from, $to, $message);
            }
        }
        return ($engine === 'mysql' ? 'Erreur MySQL : ' : 'Erreur SQLite : ') . $message;
    }
}
