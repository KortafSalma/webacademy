<?php

declare(strict_types=1);

namespace App\Execution;

/**
 * Exécuteur PHP RÉEL et isolé (sandbox).
 *
 * Chaque exécution dispose de son propre dossier temporaire, utilisé comme
 * unique open_basedir. Le code est exécuté par le CLI PHP (`php -n`) avec :
 *   - disable_functions  : shell, processus, réseau, introspection d'env ;
 *   - open_basedir       : accès fichiers limité au dossier de l'exécution ;
 *   - max_execution_time : limite CPU ;
 *   - proc_terminate()   : arrêt forcé après N secondes (boucle infinie).
 *
 * Aucun eval() : le code est un vrai fichier PHP temporaire.
 */
final class PhpExecutor
{
    public const TIMEOUT_SECONDS = 6;
    public const MAX_OUTPUT_BYTES = 65536;

    /** Fonctions interdites dans la sandbox pédagogique. */
    public const FORBIDDEN_FUNCTIONS = [
        'exec', 'shell_exec', 'system', 'passthru', 'proc_open', 'popen',
        'proc_terminate', 'proc_close', 'proc_get_status', 'pcntl_exec',
        'pcntl_fork', 'pcntl_signal', 'posix_kill', 'posix_mkfifo',
        'putenv', 'getenv', 'ini_set', 'ini_alter', 'dl', 'eval', 'assert',
        'curl_exec', 'curl_multi_exec', 'curl_init', 'mail',
        'socket_accept', 'socket_connect', 'socket_create', 'fsockopen',
        'pfsockopen', 'stream_socket_server', 'stream_socket_client',
        'load_extension', 'unlink', 'rename', 'rmdir', 'chmod', 'chown',
        'link', 'symlink', 'highlight_file', 'show_source', 'phpinfo',
    ];

    public static function run(string $code): array
    {
        $code = str_replace(["\r\n", "\r"], "\n", trim($code));
        if ($code === '') {
            return self::denied('Aucun code à exécuter.');
        }
        if (strlen($code) > APP_MAX_CODE_BYTES) {
            return self::denied('Code trop volumineux (' . (APP_MAX_CODE_BYTES / 1024) . ' Kio maximum).');
        }

        // Les étudiants collent souvent "<?php" : la sandbox l'enveloppe déjà.
        if (preg_match('/^(?:<\?php|<\?=)/i', $code)) {
            $code = preg_replace('/^(?:<\?php|<\?=)\s*/i', '', $code) ?? $code;
        }

        // Backquotes = exécution shell → interdit.
        if (str_contains($code, chr(96))) {
            return self::denied('Les guillemets inversés sont interdits (exécution shell).');
        }

        foreach (self::FORBIDDEN_FUNCTIONS as $fn) {
            $pattern = '/\b' . preg_quote($fn, '/') . '\s*\(/i';
            if (preg_match($pattern, $code)) {
                return self::denied("La fonction \"{$fn}()\" est interdite dans la sandbox pédagogique (sécurité).");
            }
        }

        if (preg_match('/\b(?:include|require)(?:_once)?\s*\(?\s*[\'"](?:https?|ftp|php|data|phar):/i', $code)) {
            return self::denied('Les inclusions distantes ou de flux sont interdites.');
        }

        $runDir = self::makeRunDir();
        if ($runDir === null) {
            return self::denied("Impossible de préparer la sandbox d'exécution.");
        }

        $file = $runDir . DIRECTORY_SEPARATOR . 'student.php';
        $script = "<?php\nerror_reporting(E_ALL);\n" . $code . "\n";
        if (file_put_contents($file, $script, LOCK_EX) === false) {
            self::removeDir($runDir);
            return self::denied("Impossible d'écrire le code dans la sandbox.");
        }

        $options = [
            PHP_BINARY,
            '-n',
            '-d', 'display_errors=1',
            '-d', 'display_startup_errors=0',
            '-d', 'log_errors=0',
            '-d', 'error_reporting=E_ALL',
            '-d', 'html_errors=0',
            '-d', 'expose_php=0',
            '-d', 'disable_functions=' . implode(',', self::FORBIDDEN_FUNCTIONS),
            '-d', 'open_basedir=' . $runDir,
            '-d', 'sys_temp_dir=' . $runDir,
            '-d', 'upload_tmp_dir=' . $runDir,
            '-d', 'session.save_path=' . $runDir,
            '-d', 'session.auto_start=0',
            '-d', 'auto_prepend_file=',
            '-d', 'auto_append_file=',
            '-d', 'max_execution_time=' . (self::TIMEOUT_SECONDS - 1),
            '-d', 'memory_limit=64M',
            '-d', 'allow_url_fopen=0',
            '-d', 'allow_url_include=0',
            '-d', 'output_buffering=0',
            '-d', 'opcache.enable_cli=0',
            $file,
        ];

        $env = PHP_OS_FAMILY === 'Windows'
            ? [
                'SystemRoot' => (string) (getenv('SystemRoot') ?: 'C:\\Windows'),
                'TEMP'       => $runDir,
                'TMP'        => $runDir,
            ]
            : [
                'PATH'   => (string) (getenv('PATH') ?: '/usr/bin:/bin'),
                'TMPDIR' => $runDir,
                'HOME'   => $runDir,
            ];

        $pipes = [];
        $process = @proc_open(
            $options,
            [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
            $runDir,
            $env,
            ['bypass_shell' => true]
        );

        if (!is_resource($process)) {
            self::removeDir($runDir);
            return self::denied('Runtime PHP introuvable sur ce serveur.');
        }

        try {
            foreach ($pipes as $pipe) {
                stream_set_blocking($pipe, false);
            }

            $deadline = microtime(true) + self::TIMEOUT_SECONDS;
            $stdout = '';
            $stderr = '';
            $timedOut = false;
            $truncated = false;

            while (true) {
                $read = [$pipes[1], $pipes[2]];
                $write = [];
                $except = [];
                $ready = @stream_select($read, $write, $except, 0, 100000);
                if ($ready === false) {
                    break;
                }
                foreach ($read as $stream) {
                    $chunk = fread($stream, 8192);
                    if ($chunk !== false && $chunk !== '') {
                        if ($stream === $pipes[1]) {
                            $stdout .= $chunk;
                        } else {
                            $stderr .= $chunk;
                        }
                    }
                }

                if (strlen($stdout) + strlen($stderr) > self::MAX_OUTPUT_BYTES) {
                    $truncated = true;
                    proc_terminate($process, 9);
                    break;
                }
                if (microtime(true) >= $deadline) {
                    $timedOut = true;
                    proc_terminate($process, 9);
                    break;
                }

                $status = proc_get_status($process);
                if ($status !== false && !$status['running']) {
                    $stdout .= (string) stream_get_contents($pipes[1]);
                    $stderr .= (string) stream_get_contents($pipes[2]);
                    break;
                }
                usleep(10000);
            }

            // Laisse au processus le temps de mourir, puis draine les tubes.
            $waitUntil = microtime(true) + 1.0;
            while (microtime(true) < $waitUntil) {
                $status = proc_get_status($process);
                if ($status === false || !$status['running']) {
                    break;
                }
                usleep(10000);
            }
            $stdout .= (string) @stream_get_contents($pipes[1]);
            $stderr .= (string) @stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);
        } finally {
            self::removeDir($runDir);
        }

        if ($timedOut) {
            return [
                'ok'        => false,
                'error'     => "Temps d'exécution dépassé (" . self::TIMEOUT_SECONDS . ' s). Boucle infinie ?',
                'output'    => self::truncateOutput($stdout),
                'stderr'    => '',
                'timed_out' => true,
            ];
        }

        $output = self::truncateOutput($stdout);
        if ($truncated) {
            $output .= "\n... (sortie tronquée)";
        }
        $stderrText = trim(self::truncateOutput($stderr));
        $failed = str_contains($output, 'Fatal error:') || str_contains($output, 'Parse error:');

        return [
            'ok'      => $stderrText === '' && !$failed,
            'output'  => $output,
            'stderr'  => $stderrText,
            'runtime' => 'PHP ' . PHP_VERSION . ' (sandbox)',
        ];
    }

    private static function makeRunDir(): ?string
    {
        if (!is_dir(APP_TMP) && !@mkdir(APP_TMP, 0700, true) && !is_dir(APP_TMP)) {
            return null;
        }
        $dir = APP_TMP . DIRECTORY_SEPARATOR . 'run_' . bin2hex(random_bytes(8));
        if (!@mkdir($dir, 0700, true)) {
            return null;
        }
        return $dir;
    }

    private static function removeDir(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        $items = @scandir($dir) ?: [];
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path) && !is_link($path)) {
                self::removeDir($path);
            } else {
                @unlink($path);
            }
        }
        @rmdir($dir);
    }

    private static function truncateOutput(string $value): string
    {
        if (strlen($value) <= self::MAX_OUTPUT_BYTES) {
            return rtrim($value);
        }
        return rtrim(substr($value, 0, self::MAX_OUTPUT_BYTES));
    }

    /** Réponse d'erreur d'exécution. */
    private static function denied(string $reason): array
    {
        return ['ok' => false, 'error' => $reason, 'output' => '', 'stderr' => ''];
    }
}
