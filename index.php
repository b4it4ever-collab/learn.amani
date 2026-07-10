<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/config/app.php';
$databaseConfig = require_once __DIR__ . '/config/database.php';

$request = new App\Core\Request();
$response = new App\Core\Response();
$session = new App\Core\Session();
$database = new App\Core\Database($databaseConfig);
$router = new App\Core\Router($request, $response, $session, $database);

require __DIR__ . '/routes/web.php';

$router->dispatch();
