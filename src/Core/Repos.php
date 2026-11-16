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
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $row;
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

    public static function saveNote(int $id, string $title, string $body, ?string $lessonKey): ?int
    {
        if ($id > 0) {
            $st = self::db()->prepare(
                'UPDATE notes SET title = :t, body = :b, lesson_key = :k, updated_at = datetime("now") WHERE id = :id'
            );
            $st->execute([':t' => $title, ':b' => $body, ':k' => $lessonKey, ':id' => $id]);
            return $st->rowCount() > 0 ? $id : null;
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

    // ---------------------------------------------------------------- users & auth

    public static function createUser(string $username, string $password, ?string $email = null, string $avatar = 'neo-coder', bool $isGuest = false): array
    {
        $db = self::db();
        $hash = $password !== '' ? password_hash($password, PASSWORD_DEFAULT) : '';
        $st = $db->prepare(
            'INSERT INTO users (username, email, password_hash, role, avatar, is_guest, created_at, last_login)
             VALUES (:u, :e, :h, :r, :a, :g, datetime(\'now\'), datetime(\'now\'))'
        );
        $st->execute([
            ':u' => $username,
            ':e' => $email ?: null,
            ':h' => $hash,
            ':r' => $isGuest ? 'guest' : 'student',
            ':a' => $avatar ?: 'neo-coder',
            ':g' => $isGuest ? 1 : 0,
        ]);
        $id = (int) $db->lastInsertId();
        return [
            'id'       => $id,
            'username' => $username,
            'email'    => $email,
            'role'     => $isGuest ? 'guest' : 'student',
            'avatar'   => $avatar ?: 'neo-coder',
            'is_guest' => $isGuest,
        ];
    }

    public static function verifyUser(string $identifier, string $password): ?array
    {
        $st = self::db()->prepare('SELECT * FROM users WHERE (LOWER(username) = LOWER(:id) OR LOWER(email) = LOWER(:id)) AND is_guest = 0 LIMIT 1');
        $st->execute([':id' => $identifier]);
        $user = $st->fetch();
        if (!$user) {
            return null;
        }
        if (!password_verify($password, (string) ($user['password_hash'] ?? ''))) {
            return null;
        }
        $up = self::db()->prepare('UPDATE users SET last_login = datetime(\'now\') WHERE id = :id');
        $up->execute([':id' => (int) $user['id']]);

        return [
            'id'       => (int) $user['id'],
            'username' => (string) $user['username'],
            'email'    => $user['email'] ? (string) $user['email'] : null,
            'role'     => (string) $user['role'],
            'avatar'   => (string) ($user['avatar'] ?: 'neo-coder'),
            'is_guest' => (bool) $user['is_guest'],
        ];
    }

    public static function createSession(int $userId): string
    {
        $token = bin2hex(random_bytes(32));
        $st = self::db()->prepare(
            'INSERT INTO user_sessions (token, user_id, created_at, expires_at)
             VALUES (:t, :u, datetime(\'now\'), datetime(\'now\', \'+365 days\'))'
        );
        $st->execute([':t' => $token, ':u' => $userId]);
        return $token;
    }

    public static function getUserByToken(string $token): ?array
    {
        if (trim($token) === '') {
            return null;
        }
        $st = self::db()->prepare(
            'SELECT u.id, u.username, u.email, u.role, u.avatar, u.is_guest
             FROM user_sessions s
             JOIN users u ON u.id = s.user_id
             WHERE s.token = :t AND s.expires_at > datetime(\'now\')
             LIMIT 1'
        );
        $st->execute([':t' => $token]);
        $user = $st->fetch();
        if (!$user) {
            return null;
        }
        return [
            'id'       => (int) $user['id'],
            'username' => (string) $user['username'],
            'email'    => $user['email'] ? (string) $user['email'] : null,
            'role'     => (string) $user['role'],
            'avatar'   => (string) ($user['avatar'] ?: 'neo-coder'),
            'is_guest' => (bool) $user['is_guest'],
        ];
    }

    public static function deleteSession(string $token): void
    {
        $st = self::db()->prepare('DELETE FROM user_sessions WHERE token = :t');
        $st->execute([':t' => $token]);
    }

    public static function createGuest(): array
    {
        $guestNum = random_int(1000, 9999);
        $username = 'Invite_' . $guestNum;
        $avatars = ['neo-coder', 'pixel-bot', 'cyber-cat', 'retro-hacker'];
        $avatar = $avatars[array_rand($avatars)];
        $user = self::createUser($username, '', null, $avatar, true);
        $token = self::createSession($user['id']);
        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public static function updateUserAvatar(int $userId, string $avatar): bool
    {
        $st = self::db()->prepare('UPDATE users SET avatar = :a WHERE id = :id');
        return $st->execute([':a' => $avatar, ':id' => $userId]);
    }
}
