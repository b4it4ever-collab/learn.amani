<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        $config = require_once __DIR__ . '/../../config/app.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_name($config['session_name'] ?? 'learn_amani_session');
            session_start();
        }
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function flash(string $key, mixed $value): void
    {
        $_SESSION['__flash'][$key] = $value;
    }

    public function getFlash(string $key, mixed $default = null): mixed
    {
        $value = $_SESSION['__flash'][$key] ?? $default;
        unset($_SESSION['__flash'][$key]);

        return $value;
    }

    public function destroy(): void
    {
        session_unset();
        session_destroy();
    }
}
