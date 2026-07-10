<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AuthMiddleware
{
    public function __construct(
        private readonly Request $request,
        private readonly Response $response,
        private readonly Session $session
    ) {
    }

    public function handle(): bool
    {
        if ($this->session->get('user_id') === null) {
            $this->response->redirect('/login');
            return false;
        }

        return true;
    }
}
