<?php

declare(strict_types=1);

namespace App\Core;

use App\Execution\PhpExecutor;
use App\Execution\SqlExecutor;

/**
 * Répartiteur d'API : vérifie la méthode, valide les entrées puis délègue.
 * Renvoie TOUJOURS un tableau ; la clé optionnelle `status` porte le code HTTP.
 */
final class Api
{
    private const LESSON_KEY = '/^[a-z]{2,20}-ch\d{1,3}$/';
    private const DATASET    = '/^[a-z0-9_-]{1,40}$/i';

    /** Méthodes autorisées par endpoint (défense en profondeur). */
    private const METHODS = [
        'bootstrap'      => ['GET'],
        'lesson'         => ['GET'],
        'projects'       => ['GET'],
        'project'        => ['GET'],
        'glossary'       => ['GET'],
        'search'         => ['GET'],
        'settings-load'  => ['GET'],
        'settings-save'  => ['POST'],
        'progress'       => ['GET'],
        'progress-set'   => ['POST'],
        'progress-reset' => ['POST'],
        'note-save'      => ['POST'],
        'note-delete'    => ['POST'],
        'notes'          => ['GET'],
        'bookmark'       => ['POST'],
        'quiz-save'      => ['POST'],
        'exercise-done'  => ['POST'],
        'php-run'        => ['POST'],
        'sql-run'        => ['POST'],
        'sql-reset'      => ['POST'],
        'sql-info'       => ['GET'],
        'html-run'       => ['GET', 'POST'],
    ];

    public static function handle(string $endpoint, string $method, array $in): array
    {
        if (!isset(self::METHODS[$endpoint])) {
            return self::fail('Endpoint inconnu.', 404);
        }
        if (!in_array($method, self::METHODS[$endpoint], true)) {
            return self::fail('Méthode non autorisée pour cet endpoint.', 405);
        }

        return match ($endpoint) {
            'bootstrap' => self::bootstrap(),
            'lesson'    => self::lesson($in),
            'projects'  => ['ok' => true, 'projects' => Content::projects()],
            'project'   => self::project($in),
            'glossary'  => ['ok' => true, 'glossary' => Content::glossary()],
            'search'    => self::search($in),

            'settings-load'  => ['ok' => true] + self::settingsData(),
            'settings-save'  => self::settingsSave($in),
            'progress'       => self::progressOverview(),
            'progress-set'   => self::progressSet($in),
            'progress-reset' => self::progressReset(),

            'note-save'   => self::noteSave($in),
            'note-delete' => self::noteDelete($in),
            'notes'       => ['ok' => true, 'notes' => Repos::notes()],
            'bookmark'    => self::bookmarkToggle($in),

            'quiz-save'     => self::quizSave($in),
            'exercise-done' => self::exerciseDone($in),

            'php-run'  => self::phpRun($in),
            'sql-run'  => self::sqlRun($in),
            'sql-reset'=> self::sqlReset($in),
            'sql-info' => self::sqlInfo(),

            'html-run' => ['ok' => true, 'sandboxer' => 'iframe'],
        };
    }

    // ============================================================ contenu

    private static function bootstrap(): array
    {
        return [
            'ok'           => true,
            'manifest'     => Content::manifest(),
            'availability' => Content::availability(),
            'progress'     => self::progressData(),
            'settings'     => self::settingsData(),
            'mysql'        => SqlExecutor::mysqlInfo(),
            'datasets'     => SqlExecutor::datasets(),
            'version'      => APP_VERSION,
        ];
    }

    private static function lesson(array $in): array
    {
        $module = self::str($in, 'module');
        $ch     = self::int($in, 'ch', 0);
        if (!Content::validModule($module) || $ch < 1 || $ch > 200) {
            return self::fail('Module ou chapitre invalide.', 422);
        }

        $lesson = Content::lesson($module, $ch);
        if (!$lesson) {
            return self::fail('Leçon introuvable ou pas encore rédigée.', 404);
        }

        $key = (string) $lesson['key'];
        Repos::view($key);
        return [
            'ok'        => true,
            'lesson'    => $lesson,
            'progress'  => Repos::progress($key),
            'bookmarks' => Repos::bookmarks(),
            'lastQuiz'  => Repos::quizLast($key),
        ];
    }

    private static function project(array $in): array
    {
        $id = self::str($in, 'id');
        if (!preg_match('/^[a-z0-9_-]{1,40}$/i', $id)) {
            return self::fail('Identifiant de projet invalide.', 422);
        }
        foreach (Content::projects() as $p) {
            if (($p['id'] ?? null) === $id) {
                return ['ok' => true, 'project' => $p];
            }
        }
        return self::fail('Projet introuvable.', 404);
    }

    private static function search(array $in): array
    {
        $q = trim(self::str($in, 'q'));
        if (mb_strlen($q) < 2) {
            return ['ok' => true, 'results' => []];
        }
        if (mb_strlen($q) > 120) {
            return self::fail('Recherche trop longue (120 caractères maximum).', 422);
        }
        return ['ok' => true, 'results' => Content::search($q)];
    }

    // ============================================================ progression / réglages

    private static function progressOverview(): array
    {
        return ['ok' => true] + self::progressData();
    }

    private static function progressData(): array
    {
        $map = [];
        foreach (Repos::progressAll() as $row) {
            $map[(string) $row['lesson_key']] = [
                'status'    => (string) $row['status'],
                'quizScore' => (int) $row['score'],
            ];
        }
        return [
            'map'       => $map,
            'bookmarks' => Repos::bookmarks(),
            'recent'    => Repos::recent(),
            'exercises' => Repos::exerciseStats(),
        ];
    }

    private static function progressSet(array $in): array
    {
        $key    = self::str($in, 'key');
        $status = self::str($in, 'status');
        if (!preg_match(self::LESSON_KEY, $key) || !in_array($status, ['in_progress', 'done'], true)) {
            return self::fail('Paramètres de progression invalides.', 422);
        }
        Repos::setProgress($key, $status);
        return ['ok' => true] + self::progressData();
    }

    private static function progressReset(): array
    {
        Repos::resetProgress();
        return ['ok' => true, 'message' => 'Progression réinitialisée.'] + self::progressData();
    }

    private static function settingsData(): array
    {
        return [
            'theme'      => Repos::setting('theme', 'dark'),
            'langMode'   => Repos::setting('langMode', 'bilingual'),
            'lastLesson' => Repos::setting('lastLesson', null),
            'examMode'   => (bool) Repos::setting('examMode', false),
        ];
    }

    private static function settingsSave(array $in): array
    {
        if (array_key_exists('theme', $in)) {
            $theme = $in['theme'];
            if (!in_array($theme, ['light', 'dark'], true)) {
                return self::fail('Thème invalide.', 422);
            }
            Repos::setSetting('theme', $theme);
        }

        if (array_key_exists('langMode', $in)) {
            $mode = $in['langMode'];
            if (!in_array($mode, ['fr', 'darija', 'bilingual'], true)) {
                return self::fail('Mode de langue invalide.', 422);
            }
            Repos::setSetting('langMode', $mode);
        }

        if (array_key_exists('lastLesson', $in)) {
            $last = $in['lastLesson'];
            if ($last === null || $last === '') {
                Repos::setSetting('lastLesson', null);
            } elseif (is_string($last) && preg_match(self::LESSON_KEY, $last)) {
                Repos::setSetting('lastLesson', $last);
            } else {
                return self::fail('Leçon mémorisée invalide.', 422);
            }
        }

        if (array_key_exists('examMode', $in)) {
            if (!is_bool($in['examMode'])) {
                return self::fail('Mode révision invalide.', 422);
            }
            Repos::setSetting('examMode', $in['examMode']);
        }

        return ['ok' => true] + self::settingsData();
    }

    // ============================================================ notes / favoris

    private static function noteSave(array $in): array
    {
        $id    = max(0, self::int($in, 'id', 0));
        $title = trim(self::str($in, 'title'));
        $body  = self::str($in, 'body');
        $key   = isset($in['lessonKey']) ? trim((string) $in['lessonKey']) : '';

        if (mb_strlen($title) > 160) {
            return self::fail('Titre trop long (160 caractères maximum).', 422);
        }
        if (mb_strlen($body) > 100000) {
            return self::fail('Note trop longue (100 000 caractères maximum).', 413);
        }
        if ($key !== '' && !preg_match(self::LESSON_KEY, $key)) {
            return self::fail('Leçon liée invalide.', 422);
        }
        if ($title === '' && trim($body) === '') {
            return self::fail('Titre ou contenu requis.', 422);
        }

        $id = Repos::saveNote($id, $title !== '' ? $title : 'Note', $body, $key !== '' ? $key : null);
        return ['ok' => true, 'id' => $id, 'notes' => Repos::notes()];
    }

    private static function noteDelete(array $in): array
    {
        $id = self::int($in, 'id', 0);
        if ($id < 1) {
            return self::fail('Identifiant de note invalide.', 422);
        }
        Repos::deleteNote($id);
        return ['ok' => true, 'notes' => Repos::notes()];
    }

    private static function bookmarkToggle(array $in): array
    {
        $key = self::str($in, 'key');
        if (!preg_match(self::LESSON_KEY, $key)) {
            return self::fail('Clé de leçon invalide.', 422);
        }
        $added = Repos::toggleBookmark($key);
        return ['ok' => true, 'added' => $added, 'bookmarks' => Repos::bookmarks()];
    }

    // ============================================================ quiz / exercices

    private static function quizSave(array $in): array
    {
        $key     = self::str($in, 'key');
        $score   = self::int($in, 'score', -1);
        $total   = self::int($in, 'total', 0);
        $answers = $in['answers'] ?? [];

        if (!preg_match(self::LESSON_KEY, $key) || $total < 1 || $total > 100 || $score < 0 || $score > $total) {
            return self::fail('Résultat de quiz invalide.', 422);
        }
        if (!is_array($answers) || count($answers) > 100) {
            return self::fail('Réponses de quiz invalides.', 422);
        }
        $encoded = json_encode($answers, JSON_UNESCAPED_UNICODE);
        if ($encoded === false || strlen($encoded) > 32768) {
            return self::fail('Réponses de quiz trop volumineuses.', 413);
        }

        Repos::saveQuiz($key, $score, $total, $answers);
        return ['ok' => true] + self::progressData();
    }

    private static function exerciseDone(array $in): array
    {
        $key    = self::str($in, 'key');
        $level  = self::int($in, 'level', 0);
        $passed = $in['passed'] ?? null;

        if (!preg_match(self::LESSON_KEY, $key) || $level < 1 || $level > 6 || !is_bool($passed)) {
            return self::fail('Exercice invalide.', 422);
        }
        Repos::saveExercise($key, $level, $passed);
        return ['ok' => true] + self::progressData();
    }

    // ============================================================ exécution

    private static function phpRun(array $in): array
    {
        $code = self::str($in, 'code');
        if (trim($code) === '') {
            return self::fail('Aucun code à exécuter.', 422);
        }
        if (strlen($code) > APP_MAX_CODE_BYTES) {
            return self::fail('Code trop volumineux (' . (APP_MAX_CODE_BYTES / 1024) . ' Kio maximum).', 413);
        }
        $result = PhpExecutor::run($code);
        $result['ok'] = (bool) ($result['ok'] ?? false);
        return $result;
    }

    private static function sqlRun(array $in): array
    {
        $dialect = strtolower(self::str($in, 'dialect'));
        $sql     = self::str($in, 'sql');
        $dataset = $in['dataset'] ?? null;

        if (!in_array($dialect, ['sqlite', 'mysql', 'oracle'], true)) {
            return self::fail('Dialecte SQL inconnu.', 422);
        }
        if (trim($sql) === '') {
            return self::fail('Aucune requête SQL fournie.', 422);
        }
        if (strlen($sql) > APP_MAX_SQL_BYTES) {
            return self::fail('Script SQL trop volumineux (' . (APP_MAX_SQL_BYTES / 1024) . ' Kio maximum).', 413);
        }
        if ($dataset !== null && $dataset !== '' && (!is_string($dataset) || !preg_match(self::DATASET, $dataset))) {
            return self::fail('Jeu de données invalide.', 422);
        }

        return SqlExecutor::run($dialect, $sql, is_string($dataset) && $dataset !== '' ? $dataset : null);
    }

    private static function sqlReset(array $in): array
    {
        $dialect = strtolower(self::str($in, 'dialect'));
        $dataset = self::str($in, 'dataset');

        if (!in_array($dialect, ['sqlite', 'mysql', 'oracle'], true)) {
            return self::fail('Dialecte SQL inconnu.', 422);
        }
        if (!preg_match(self::DATASET, $dataset)) {
            return self::fail('Jeu de données invalide.', 422);
        }
        return SqlExecutor::reset($dialect, $dataset);
    }

    private static function sqlInfo(): array
    {
        return [
            'ok'       => true,
            'mysql'    => SqlExecutor::mysqlInfo(),
            'datasets' => SqlExecutor::datasets(),
        ];
    }

    // ============================================================ validation

    private static function str(array $in, string $key, string $default = ''): string
    {
        $value = $in[$key] ?? $default;
        return is_scalar($value) ? (string) $value : $default;
    }

    private static function int(array $in, string $key, int $default = 0): int
    {
        $value = $in[$key] ?? $default;
        return is_numeric($value) ? (int) $value : $default;
    }

    private static function fail(string $message, int $status): array
    {
        return ['ok' => false, 'error' => $message, 'status' => $status];
    }
}
