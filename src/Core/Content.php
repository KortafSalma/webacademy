<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Chargeur de contenu pédagogique.
 * Sources : content/curriculum.php (manifeste) + content/<module>/{c|ex|q}{NN}.php
 */
final class Content
{
    private const MODULES = ['html', 'css', 'php', 'sql', 'integration', 'cpp', 'javascript', 'oracle'];
    private const MAX_CHAPTER = 200;

    private static ?array $manifest = null;

    /** @var array<string, array|null> */
    private static array $fileCache = [];

    // ---------------------------------------------------------------- manifeste

    public static function manifest(): array
    {
        if (self::$manifest === null) {
            $file = APP_CONTENT . '/curriculum.php';
            $data = self::loadFile($file);
            $modules = is_array($data['modules'] ?? null) ? $data['modules'] : [];
            self::$manifest = ['modules' => array_values(array_filter($modules, static function ($m): bool {
                return is_array($m)
                    && isset($m['id'], $m['name'], $m['chapters'])
                    && is_string($m['id'])
                    && in_array($m['id'], self::MODULES, true)
                    && is_array($m['chapters']);
            }))];
        }
        return self::$manifest;
    }

    public static function validModule(string $module): bool
    {
        return in_array($module, self::MODULES, true);
    }

    public static function moduleMeta(string $module): ?array
    {
        foreach (self::manifest()['modules'] as $m) {
            if (($m['id'] ?? null) === $module) {
                return $m;
            }
        }
        return null;
    }

    /** Nombre de chapitres prévus pour un module d'après le manifeste. */
    public static function chapterCount(string $module): int
    {
        $meta = self::moduleMeta($module);
        return $meta ? count($meta['chapters']) : 0;
    }

    // ------------------------------------------------------------------ leçons

    /**
     * require() protégé et mémorisé : un fichier en cours de rédaction ne casse
     * pas l'application, et un même chapitre n'est pas réexécuté dix fois
     * pendant une recherche.
     */
    private static function loadFile(string $file): ?array
    {
        if (array_key_exists($file, self::$fileCache)) {
            return self::$fileCache[$file];
        }
        if (!is_file($file)) {
            return self::$fileCache[$file] = null;
        }
        try {
            if (str_starts_with(str_replace('\\', '/', $file), str_replace('\\', '/', APP_CONTENT) . '/oracle/')) {
                require_once APP_CONTENT . '/oracle/_helpers.php';
            }
            $data = require $file;
        } catch (\Throwable $e) {
            error_log(sprintf(
                '[WebAcademy] Contenu invalide %s : %s (ligne %d)',
                $file,
                $e->getMessage(),
                $e->getLine()
            ));
            return self::$fileCache[$file] = null;
        }
        return self::$fileCache[$file] = (is_array($data) ? $data : null);
    }

    /** Leçon complète : chapitre + exercices + quiz fusionnés. */
    public static function lesson(string $module, int $ch): ?array
    {
        if (!self::validModule($module) || $ch < 1 || $ch > self::MAX_CHAPTER) {
            return null;
        }
        $dir = content_module_dir($module);
        $chFile = $dir . '/c' . sprintf('%1$02d', $ch) . '.php';
        $chapter = self::loadFile($chFile);
        if ($chapter === null || !isset($chapter['id'], $chapter['title'])) {
            return null;
        }

        $exercise = self::loadFile($dir . '/ex' . sprintf('%1$02d', $ch) . '.php');
        $quiz     = self::loadFile($dir . '/qz' . sprintf('%1$02d', $ch) . '.php');

        return [
            'module'    => $module,
            'ch'        => $ch,
            'key'       => lesson_key($module, $ch),
            'chapter'   => $chapter,
            'exercise'  => $exercise,
            'quiz'      => $quiz,
        ];
    }

    /** Liste des leçons réellement chargeables (contenu rédigé et valide). */
    public static function availability(): array
    {
        $out = [];
        foreach (self::manifest()['modules'] as $m) {
            $have = [];
            foreach ($m['chapters'] as $c) {
                $n = (int) ($c['n'] ?? 0);
                if ($n < 1 || $n > self::MAX_CHAPTER) {
                    continue;
                }
                $file = content_module_dir($m['id']) . '/c' . sprintf('%1$02d', $n) . '.php';
                $have[$n] = self::loadFile($file) !== null;
            }
            $out[$m['id']] = $have;
        }
        return $out;
    }

    // ------------------------------------------------------------------ glossaire

    public static function glossary(): array
    {
        $data = self::loadFile(APP_CONTENT . '/glossary/glossary.php');
        $terms = $data['terms'] ?? [];
        if (!is_array($terms)) {
            return ['terms' => []];
        }
        return ['terms' => array_values(array_filter($terms, static fn ($t): bool => is_array($t) && isset($t['term'])))];
    }

    // ------------------------------------------------------------------ projets

    public static function projects(): array
    {
        $dir = APP_CONTENT . '/projects';
        if (!is_dir($dir)) {
            return [];
        }
        $projects = [];
        foreach (array_merge(glob($dir . '/*.php') ?: [], glob(APP_CONTENT . '/javascript/*project*.php') ?: [], glob(APP_CONTENT . '/oracle/projects/*.php') ?: []) as $file) {
            $data = self::loadFile($file);
            if ($data !== null && isset($data['id'], $data['title'])) {
                $projects[] = $data;
            }
        }
        usort($projects, static function (array $a, array $b): int {
            return strnatcasecmp((string) $a['id'], (string) $b['id']);
        });
        return $projects;
    }

    // ------------------------------------------------------------------ recherche

    /** Recherche plein texte légère dans titres + blocs textuels des chapitres rédigés. */
    public static function search(string $query): array
    {
        $query = trim($query);
        $length = mb_strlen($query);
        if ($length < 2 || $length > 120) {
            return [];
        }
        $needle = mb_strtolower($query);
        $results = [];

        foreach (self::manifest()['modules'] as $m) {
            foreach ($m['chapters'] as $c) {
                $n = (int) ($c['n'] ?? 0);
                $lesson = self::lesson($m['id'], $n);
                if ($lesson === null) {
                    continue;
                }
                $score = 0;
                $snippet = '';

                foreach (['title', 'title_darija'] as $field) {
                    if (isset($c[$field]) && str_contains(mb_strtolower((string) $c[$field]), $needle)) {
                        $score += 10;
                        $snippet = $snippet ?: (string) $c[$field];
                    }
                }

                foreach ($lesson['chapter']['lessons'] ?? [] as $section) {
                    foreach (($section['blocks'] ?? []) as $block) {
                        if (!is_array($block)) {
                            continue;
                        }
                        $hay = match ($block['type'] ?? '') {
                            'text', 'definition', 'note', 'tip', 'warning'
                                => (string) ($block['fr'] ?? '') . ' ' . (string) ($block['darija'] ?? ''),
                            'syntax', 'example'
                                => (string) ($block['title'] ?? '') . ' ' . (string) ($block['code'] ?? ''),
                            default => '',
                        };
                        if ($hay !== '' && str_contains(mb_strtolower($hay), $needle)) {
                            $score += 3;
                            if ($snippet === '') {
                                $plain = trim(preg_replace('/\s+/u', ' ', strip_tags($hay)) ?? '');
                                $pos = mb_stripos($plain, $query);
                                $start = $pos === false ? 0 : max(0, $pos - 50);
                                $snippet = mb_substr($plain, $start, 150);
                            }
                        }
                    }
                }

                if ($score > 0) {
                    $results[] = [
                        'module'  => $m['id'],
                        'ch'      => $n,
                        'title'   => (string) $c['title'],
                        'snippet' => $snippet,
                        'score'   => $score,
                    ];
                }
            }
        }

        usort($results, static fn (array $a, array $b): int => $b['score'] <=> $a['score']);
        return array_slice($results, 0, 20);
    }
}
