<?php
// routes/web.php

// Existing routes...
$router->get('/', 'HomeController@index');

// New Enrollment Route
// The 'middleware' => 'AuthMiddleware' will trigger the check before the controller runs
$router->post('/enroll/{id}', 'EnrollController@enroll', ['middleware' => 'AuthMiddleware']);
