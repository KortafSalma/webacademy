<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Référentiels de persistance : progression, notes, quiz, favoris, réglages.
 * Un seul « étudiant » : la plateforme est personnelle.
 */
final class Repos
{
    private static ?PDO $pdo = null;

    private static function db(): PDO
    {
        return self::$pdo ??= Database::pdo();
    }

    // ---------------------------------------------------------------- settings

    public static function setting(string $key, mixed $default = null): mixed
    {
        $st = self::db()->prepare('SELECT value FROM settings WHERE key = :k');
        $st->execute([':k' => $key]);
        $row = $st->fetchColumn();
        if ($row === false) {
            return $default;
        }
        $decoded = json_decode((string) $row, true);
        return $decoded === null ? $row : $decoded;
    }

    public static function setSetting(string $key, mixed $value): void
    {
        $st = self::db()->prepare(
            'INSERT INTO settings (key, value) VALUES (:k, :v)
             ON CONFLICT(key) DO UPDATE SET value = excluded.value'
        );
        $encoded = json_encode($value, JSON_UNESCAPED_UNICODE);
        $st->execute([':k' => $key, ':v' => $encoded === false ? 'null' : $encoded]);
    }

    // ---------------------------------------------------------------- progress

    public static function progressAll(): array
    {
        return self::db()->query('SELECT lesson_key, status, score FROM progress')->fetchAll();
    }

    public static function progress(string $key): ?array
    {
        $st = self::db()->prepare('SELECT lesson_key, status, score FROM progress WHERE lesson_key = :k');
        $st->execute([':k' => $key]);
        $row = $st->fetch();
        return $row ?: null;
    }

    public static function setProgress(string $key, string $status): void
    {
        $st = self::db()->prepare(
            'INSERT INTO progress (lesson_key, status, updated_at)
             VALUES (:k, :s, datetime("now"))
             ON CONFLICT(lesson_key) DO UPDATE SET status = excluded.status, updated_at = excluded.updated_at'
        );
        $st->execute([':k' => $key, ':s' => $status]);
    }

    public static function resetProgress(): void
    {
        $db = self::db();
        $db->beginTransaction();
        try {
            foreach (['progress', 'quiz_results', 'exercise_results'] as $table) {
                $db->exec('DELETE FROM ' . $table);
            }
            $db->commit();
        } catch (\Throwable $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            throw $e;
        }
    }

    // ---------------------------------------------------------------- quiz

    public static function saveQuiz(string $key, int $score, int $total, array $answers): void
    {
        $db = self::db();
        $st = $db->prepare(
            'INSERT INTO quiz_results (lesson_key, score, total, answers) VALUES (:k, :s, :t, :a)'
        );
        $st->execute([
            ':k' => $key,
            ':s' => $score,
            ':t' => $total,
            ':a' => json_encode($answers, JSON_UNESCAPED_UNICODE) ?: '[]',
        ]);

        if ($total > 0) {
            $st2 = $db->prepare(
                'INSERT INTO progress (lesson_key, status, score, updated_at)
                 VALUES (:k, "in_progress", :sc, datetime("now"))
                 ON CONFLICT(lesson_key) DO UPDATE SET score = MAX(progress.score, excluded.score), updated_at = excluded.updated_at'
            );
            $st2->execute([':k' => $key, ':sc' => (int) round(100 * $score / $total)]);
        }
    }

    public static function quizLast(string $key): ?array
    {
        $st = self::db()->prepare(
            'SELECT score, total, created_at FROM quiz_results WHERE lesson_key = :k ORDER BY id DESC LIMIT 1'
        );
        $st->execute([':k' => $key]);
        $row = $st->fetch();
        return $row ?: null;
    }

    // ---------------------------------------------------------------- exercises

    public static function saveExercise(string $key, int $level, bool $passed): void
    {
        $st = self::db()->prepare(
            'INSERT INTO exercise_results (lesson_key, level, passed, tries) VALUES (:k, :l, :p, 1)'
        );
        $st->execute([':k' => $key, ':l' => $level, ':p' => (int) $passed]);
    }

    public static function exerciseStats(): array
    {
        $rows = self::db()->query('SELECT lesson_key, level, passed FROM exercise_results')->fetchAll();
        $out = [];
        foreach ($rows as $r) {
            $k = $r['lesson_key'] . '#L' . $r['level'];
            if (!isset($out[$k])) {
                $out[$k] = ['key' => $r['lesson_key'], 'level' => (int) $r['level'], 'passed' => false];
            }
            if ((int) $r['passed'] === 1) {
                $out[$k]['passed'] = true;
            }
        }
        return array_values($out);
    }

    // ---------------------------------------------------------------- notes

    public static function notes(): array
    {
        return self::db()->query('SELECT * FROM notes ORDER BY updated_at DESC, id DESC')->fetchAll();
    }

    public static function saveNote(int $id, string $title, string $body, ?string $lessonKey): int
    {
        if ($id > 0) {
            $st = self::db()->prepare(
                'UPDATE notes SET title = :t, body = :b, lesson_key = :k, updated_at = datetime("now") WHERE id = :id'
            );
            $st->execute([':t' => $title, ':b' => $body, ':k' => $lessonKey, ':id' => $id]);
            return $id;
        }
        $st = self::db()->prepare(
            'INSERT INTO notes (lesson_key, title, body) VALUES (:k, :t, :b)'
        );
        $st->execute([':k' => $lessonKey, ':t' => $title, ':b' => $body]);
        return (int) self::db()->lastInsertId();
    }

    public static function deleteNote(int $id): void
    {
        $st = self::db()->prepare('DELETE FROM notes WHERE id = :id');
        $st->execute([':id' => $id]);
    }

    // ---------------------------------------------------------------- bookmarks

    public static function bookmarks(): array
    {
        return self::db()->query('SELECT lesson_key FROM bookmarks ORDER BY created_at DESC')->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }

    public static function toggleBookmark(string $key): bool
    {
        if (in_array($key, self::bookmarks(), true)) {
            $st = self::db()->prepare('DELETE FROM bookmarks WHERE lesson_key = :k');
            $st->execute([':k' => $key]);
            return false;
        }
        $st = self::db()->prepare('INSERT INTO bookmarks (lesson_key) VALUES (:k)');
        $st->execute([':k' => $key]);
        return true;
    }

    // ---------------------------------------------------------------- history

    public static function view(string $key): void
    {
        $st = self::db()->prepare('INSERT INTO history (lesson_key) VALUES (:k)');
        $st->execute([':k' => $key]);
    }

    public static function recent(int $limit = 6): array
    {
        $limit = max(1, min(20, $limit));
        $st = self::db()->prepare(
            'SELECT lesson_key, MAX(viewed_at) AS at FROM history
             GROUP BY lesson_key ORDER BY at DESC LIMIT :l'
        );
        $st->bindValue(':l', $limit, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }
}
