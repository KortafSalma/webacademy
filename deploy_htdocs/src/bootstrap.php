<?php
/**
 * WebAcademy — Plateforme pédagogique interactive
 * Bootstrap : configuration, autoload et initialisation noyau.
 *
 * Ce fichier est le SEUL point d'entrée des constantes de configuration.
 */

declare(strict_types=1);

error_reporting(E_ALL);

// En HTTP, les erreurs ne doivent jamais être affichées au visiteur.
// Elles restent dans le journal du serveur (WAMP / PHP built-in server).
if (PHP_SAPI !== 'cli') {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
}

// ------------------------------------------------------------------
// 1. Chemins applicatifs
// ------------------------------------------------------------------
define('APP_ROOT', dirname(__DIR__));
define('APP_PUBLIC', APP_ROOT . '/public');
define('APP_SRC', APP_ROOT . '/src');
define('APP_CONTENT', APP_ROOT . '/content');
define('APP_DATA', APP_ROOT . '/data');
define('APP_ASSETS', APP_PUBLIC . '/assets');
define('APP_VERSION', '2.0.1');
// Limites communes aux points d'entrée HTTP et aux exécuteurs.
define('APP_MAX_REQUEST_BYTES', 1048576); // 1 Mio pour le corps JSON
define('APP_MAX_CODE_BYTES', 32768);      // 32 Kio de code étudiant
define('APP_MAX_SQL_BYTES', 65536);       // 64 Kio de SQL
// Chemin temporaire en forme longue (sans ~ Windows) :
// évite les erreurs de parse ini de `open_basedir` dans la sandbox PHP.
$tmpBase = str_replace('/', '\\', sys_get_temp_dir());
$realTmp = @realpath($tmpBase);
if ($realTmp !== false) {
    $tmpBase = $realTmp;
}
define('APP_TMP', $tmpBase . DIRECTORY_SEPARATOR . 'webacademy_run');

require_once APP_SRC . '/Core/Autoloader.php';
App\Core\Autoloader::register();

// ------------------------------------------------------------------
// 2. Sandbox d'exécution PHP : dossier temporaire dédié
// ------------------------------------------------------------------
if (!is_dir(APP_TMP)) {
    @mkdir(APP_TMP, 0700, true);
}

// ------------------------------------------------------------------
// 3. Configuration MySQL (utilisé UNIQUEMENT si WAMP/XAMPP tourne)
//    Lecture facultative d'un fichier de config local.
// ------------------------------------------------------------------
$mysqlConfig = [
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'user'     => 'root',
    'pass'     => '',
    'database' => 'webacademy_sandbox',
];
$cfgFile = APP_ROOT . '/config_local.php';
if (is_file($cfgFile)) {
    /** @var array|null $localCfg */
    $localCfg = require $cfgFile;
    if (is_array($localCfg)) {
        $mysqlConfig = array_merge($mysqlConfig, $localCfg);
    }
}
define('DB_MYSQL_CONFIG', $mysqlConfig);

require_once APP_SRC . '/Core/functions.php';
