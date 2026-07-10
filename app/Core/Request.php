<?php

namespace App\Core;

class Request
{
    public array $get = [];
    public array $post = [];
    public array $server = [];
    public array $files = [];
    public array $headers = [];
    public string $method;
    public string $path;
    public string $queryString = '';

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->files = $_FILES;
        $this->headers = $this->resolveHeaders();
        $this->method = strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
        $this->path = $this->resolvePath();
        $this->queryString = $this->server['QUERY_STRING'] ?? '';
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    public function isMethod(string $method): bool
    {
        return $this->method === strtoupper($method);
    }

    public function expectsJson(): bool
    {
        return str_contains($this->header('Accept') ?? '', 'application/json');
    }

    public function header(string $name): ?string
    {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        return $this->server[$key] ?? $this->headers[$name] ?? null;
    }

    private function resolveHeaders(): array
    {
        $headers = [];
        foreach ($this->server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = strtolower(str_replace('_', '-', substr($key, 5)));
                $headers[$name] = $value;
            }
        }

        return $headers;
    }

    private function resolvePath(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        $uri = parse_url($uri, PHP_URL_PATH) ?? '/';
        $uri = rawurldecode($uri);
        $uri = '/' . trim($uri, '/');

        return $uri === '/' ? '/' : $uri;
    }
}
