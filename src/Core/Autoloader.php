<?php

declare(strict_types=1);

namespace App\Core;

final class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): void {
            if (!str_starts_with($class, 'App\\')) {
                return;
            }
            $relative = str_replace('\\', '/', substr($class, 4)); // App\Foo\Bar -> Foo/Bar
            $file = APP_SRC . '/' . $relative . '.php';
            if (is_file($file)) {
                require $file;
            }
        });
    }
}
