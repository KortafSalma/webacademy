<?php

declare(strict_types=1);

/**
 * Compatibilité WAMP / Apache : le vrai point d'entrée est public/index.php.
 * En production, configurez le DocumentRoot sur le dossier public/.
 */

require __DIR__ . '/public/index.php';
