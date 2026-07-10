<?php

use App\Core\Router;

$router->get('/', function ($request, $response, $session, $database) {
    $response->json([
        'message' => 'Learn.Amani foundation is ready.',
        'version' => '1.0.0',
    ]);
});
