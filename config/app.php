<?php

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return match (strtolower($value)) {
            'true', '(true)' => true,
            'false', '(false)' => false,
            'null', '(null)' => null,
            default => $value,
        };
    }
}

return [
    'app_name' => env('APP_NAME', 'Learn.Amani'),
    'env' => env('APP_ENV', 'local'),
    'debug' => env('APP_DEBUG', true),
    'url' => env('APP_URL', 'http://localhost'),
    'views_path' => __DIR__ . '/../app/Views',
    'storage_path' => __DIR__ . '/../storage',
    'asset_path' => '/assets',
    'session_name' => env('SESSION_NAME', 'learn_amani_session'),
    'csrf_token_name' => env('CSRF_TOKEN_NAME', '_token'),
];
