<?php
// routes/web.php

// Existing routes...
$router->get('/', 'HomeController@index');
// Add these to routes/web.php
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
// New Enrollment Route
// The 'middleware' => 'AuthMiddleware' will trigger the check before the controller runs
$router->post('/enroll/{id}', 'EnrollController@enroll', ['middleware' => 'AuthMiddleware']);
