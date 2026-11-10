<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Connexion SQLite persistante pour la progression, notes, quiz, réglages.
 * Le fichier data/app.sqlite est créé automatiquement, hors racine publique.
 */
final class Database
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $public = realpath(APP_PUBLIC);
        $data = realpath(APP_DATA);
        if ($public !== false && $data !== false && str_starts_with($data, $public . DIRECTORY_SEPARATOR)) {
            throw new \RuntimeException('Le dossier de données ne doit pas être dans la racine publique.');
        }

        if (!is_dir(APP_DATA) && !@mkdir(APP_DATA, 0750, true) && !is_dir(APP_DATA)) {
            throw new \RuntimeException('Impossible de créer le dossier de données.');
        }

        $file = APP_DATA . '/app.sqlite';
        $pdo = new PDO('sqlite:' . $file, null, null, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_STRINGIFY_FETCHES  => false,
        ]);

        $pdo->exec('PRAGMA journal_mode = WAL');
        $pdo->exec('PRAGMA synchronous = NORMAL');
        $pdo->exec('PRAGMA busy_timeout = 5000');
        $pdo->exec('PRAGMA foreign_keys = ON');
        $pdo->exec('PRAGMA temp_store = MEMORY');

        if (is_file($file)) {
            @chmod($file, 0640);
        }

        self::$pdo = $pdo;
        self::migrate($pdo);
        return self::$pdo;
    }

    private static function migrate(PDO $pdo): void
    {
        $pdo->exec(<<<'SQL'
CREATE TABLE IF NOT EXISTS settings (
    key   TEXT PRIMARY KEY,
    value TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS progress (
    lesson_key TEXT PRIMARY KEY,
    status     TEXT NOT NULL DEFAULT 'in_progress',
    score      INTEGER NOT NULL DEFAULT 0,
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS quiz_results (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    score      INTEGER NOT NULL,
    total      INTEGER NOT NULL,
    answers    TEXT NOT NULL DEFAULT '[]',
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS exercise_results (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    level      INTEGER NOT NULL,
    passed     INTEGER NOT NULL DEFAULT 0,
    tries      INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS notes (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT,
    title      TEXT NOT NULL,
    body       TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS bookmarks (
    lesson_key TEXT PRIMARY KEY,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS history (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    viewed_at  TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS lab_snippets (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    module     TEXT NOT NULL,
    name       TEXT NOT NULL,
    code       TEXT NOT NULL,
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE INDEX IF NOT EXISTS idx_history_lesson ON history (lesson_key, viewed_at);
CREATE INDEX IF NOT EXISTS idx_quiz_lesson ON quiz_results (lesson_key, id);
CREATE INDEX IF NOT EXISTS idx_exercise_lesson ON exercise_results (lesson_key, level);
SQL);
    }
}
