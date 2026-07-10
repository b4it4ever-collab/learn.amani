<?php

namespace App\Core;

class ViewRenderer
{
    private Request $request;
    private Response $response;
    private Session $session;

    public function __construct(Request $request, Response $response, Session $session)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
    }

    public function render(string $view, array $data = []): void
    {
        $viewPath = $this->resolveViewPath($view);
        if (!is_file($viewPath)) {
            throw new \RuntimeException('View not found: ' . $view);
        }

        extract($data, EXTR_SKIP);
        $config = require_once __DIR__ . '/../../config/app.php';
        $csrfToken = $this->session->get('_csrf_token') ?? bin2hex(random_bytes(32));
        $this->session->set('_csrf_token', $csrfToken);

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        echo $content;
    }

    private function resolveViewPath(string $view): string
    {
        $basePath = dirname(__DIR__, 1) . '/Views/';
        return $basePath . str_replace('.', '/', $view) . '.php';
    }
}
