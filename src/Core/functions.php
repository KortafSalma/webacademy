<?php

declare(strict_types=1);

/**
 * Fonctions utilitaires globales (helpers simples, sans état).
 */

/** Échappe une valeur pour affichage HTML (protection XSS universelle). */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Réponse JSON d'API normalisée. */
function api_out(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store, max-age=0');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

/**
 * Lecture du corps JSON d'une requête POST.
 * Refuse les corps trop volumineux et le JSON malformé au lieu de les
 * transformer silencieusement en tableau vide.
 */
function api_input(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false) {
        throw new InvalidArgumentException('Corps de requête illisible.');
    }
    if (strlen($raw) > APP_MAX_REQUEST_BYTES) {
        throw new InvalidArgumentException('Corps de requête trop volumineux.');
    }
    if (trim($raw) === '') {
        return [];
    }
    $data = json_decode($raw, true);
    if (!is_array($data) || ($data !== [] && array_is_list($data))) {
        throw new InvalidArgumentException('Corps JSON invalide.');
    }
    return $data;
}

/** Clé normalisée d'une leçon : module-chN. */
function lesson_key(string $module, int $ch): string
{
    return $module . '-ch' . $ch;
}

/** Chemin du dossier content pour un module (module validé). */
function content_module_dir(string $module): string
{
    return APP_CONTENT . '/' . $module;
}

/** Teste si une requête GET/POST contient une valeur clé. */
function req_param(array $src, string $key, mixed $default = null): mixed
{
    return array_key_exists($key, $src) && $src[$key] !== '' ? $src[$key] : $default;
}
