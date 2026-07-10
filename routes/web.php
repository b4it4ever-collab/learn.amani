<?php

// routes/web.php

// 1. Home Route
$router->get('/', 'HomeController@index');

// 2. Authentication Routes
// These handle showing the login form and processing the login submission
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');

// 3. Enrollment Route
// This route is protected by the AuthMiddleware, 
// ensuring only logged-in users can enroll in courses.
$router->post('/enroll/{id}', 'EnrollController@enroll', ['middleware' => 'App\Middleware\AuthMiddleware']);

// Add any other routes below...
