<?php

namespace App\Core;

class Response
{
    public function redirect(string $url, int $status = 302): void
    {
        header('Location: ' . $url, true, $status);
        exit;
    }

    public function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function status(int $code): void
    {
        http_response_code($code);
    }
}
