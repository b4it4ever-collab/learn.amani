<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;
    private Session $session;
    private Database $database;

    public function __construct(Request $request, Response $response, Session $session, Database $database)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
        $this->database = $database;
    }

    public function get(string $path, callable|array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function addRoute(string $method, string $path, callable|array $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->normalizePath($path),
            'handler' => $handler,
            'middleware' => [],
        ];
    }

    public function middleware(array $middleware): self
    {
        $lastIndex = array_key_last($this->routes);
        if ($lastIndex !== null) {
            $this->routes[$lastIndex]['middleware'] = $middleware;
        }

        return $this;
    }

    public function dispatch(): void
    {
        $path = $this->request->path;
        $method = $this->request->method;

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if ($route['path'] === $path) {
                foreach ($route['middleware'] as $middlewareClass) {
                    $middleware = new $middlewareClass($this->request, $this->response, $this->session);
                    if (!$middleware->handle()) {
                        return;
                    }
                }

                $handler = $route['handler'];
                if (is_array($handler)) {
                    [$controller, $action] = $handler;
                    $instance = new $controller($this->request, $this->response, $this->session, $this->database);
                    $instance->$action();
                    return;
                }

                $handler($this->request, $this->response, $this->session, $this->database);
                return;
            }
        }

        $this->response->status(404);
        echo '404 Not Found';
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : $path;
    }
}
