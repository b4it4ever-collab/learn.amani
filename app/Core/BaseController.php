<?php

namespace App\Core;

abstract class BaseController
{
    protected Request $request;
    protected Response $response;
    protected Session $session;
    protected Database $database;

    public function __construct(Request $request, Response $response, Session $session, Database $database)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
        $this->database = $database;
    }

    protected function view(string $view, array $data = []): void
    {
        $viewRenderer = new ViewRenderer($this->request, $this->response, $this->session);
        $viewRenderer->render($view, $data);
    }

    protected function redirect(string $url, int $status = 302): void
    {
        $this->response->redirect($url, $status);
    }
}
