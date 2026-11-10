<?php

declare(strict_types=1);

/**
 * Vérifie les solutions des exercices SQL contre une base SQLite temporaire.
 *
 * Usage : php tools/test-sql-exercises.php content/sql/ex02.php ...
 */

require __DIR__ . '/../src/Execution/SqlSplitter.php';

use App\Execution\SqlSplitter;

$files = array_slice($argv, 1);
if ($files === []) {
    $files = glob(__DIR__ . '/../content/sql/ex*.php') ?: [];
}

$dataset = require __DIR__ . '/../content/sql/datasets/school.php';

function norm(string $v): string
{
    $v = mb_strtolower($v, 'UTF-8');
    $v = strtr($v, ['à' => 'a', 'â' => 'a', 'ä' => 'a', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'î' => 'i', 'ï' => 'i', 'ô' => 'o', 'ö' => 'o', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ç' => 'c']);
    return trim(preg_replace('/\s+/', ' ', $v) ?? $v);
}

function freshDb(array $dataset): PDO
{
    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($dataset['drop'] as $sql) {
        $pdo->exec($sql);
    }
    foreach ($dataset['ddl_sqlite'] as $sql) {
        $pdo->exec($sql);
    }
    foreach ($dataset['data'] as $sql) {
        $pdo->exec($sql);
    }
    return $pdo;
}

$failures = 0;
$checks = 0;

foreach ($files as $file) {
    $exercise = require $file;
    echo "== " . basename($file) . " — " . ($exercise['title'] ?? '') . "\n";

    foreach ($exercise['levels'] as $level) {
        $pdo = freshDb($dataset);
        $rows = [];
        $rowCount = 0;
        $ok = true;
        $error = '';

        try {
            foreach (SqlSplitter::split($level['solution']) as $stmt) {
                $q = $pdo->query($stmt);
                if ($q === false) {
                    continue;
                }
                if ($q->columnCount() > 0) {
                    $rows = $q->fetchAll(PDO::FETCH_ASSOC);
                    $rowCount = count($rows);
                }
            }
        } catch (Throwable $e) {
            $ok = false;
            $error = $e->getMessage();
        }

        $labels = [];
        foreach ($level['tests'] as $test) {
            $checks++;
            $type = $test['type'];
            $value = $test['value'];
            $pass = false;

            if (!$ok) {
                $pass = false;
            } elseif ($type === 'sql_ok') {
                $pass = true;
            } elseif ($type === 'row_count') {
                $pass = $rowCount === (int) $value;
            } elseif ($type === 'result_has' || $type === 'result_lacks') {
                $wanted = is_array($value) ? $value : [$value];
                $rowStrings = array_map(
                    static fn (array $r): string => implode(' | ', array_map(static fn ($v): string => norm((string) $v), $r)),
                    $rows
                );
                $found = false;
                foreach ($rowStrings as $row) {
                    $all = true;
                    foreach ($wanted as $w) {
                        if (strpos($row, norm((string) $w)) === false) {
                            $all = false;
                            break;
                        }
                    }
                    if ($all) {
                        $found = true;
                        break;
                    }
                }
                $pass = $type === 'result_has' ? $found : !$found;
            }

            if (!$pass) {
                $label = $type . ' ' . (is_array($value) ? implode(',', $value) : $value);
                $labels[] = $label;
                $failures++;
            }
        }

        $status = $labels === [] ? 'OK' : 'ECHEC (' . implode(' ; ', $labels) . ')';
        echo "  Niveau {$level['level']} : {$status}";
        if ($error !== '') {
            echo " — erreur SQL : {$error}";
        }
        if ($labels !== []) {
            echo " | lignes=" . json_encode($rows, JSON_UNESCAPED_UNICODE);
        }
        echo "\n";
    }
}

echo "\n{$checks} tests, {$failures} échec(s).\n";
exit($failures === 0 ? 0 : 1);
