<?php

namespace App\Middleware;

use App\Core\Session;
use App\Core\Response;

class AuthMiddleware
{
    /**
     * Handle the incoming request.
     * 
     * If the user is not authenticated, save the intended URL 
     * and redirect them to the login page.
     *
     * @param mixed $request
     * @return bool
     */
    public function handle($request)
    {
        // Check if the user_id exists in the session
        if (!Session::has('user_id')) {
            // Save the current URL so we can redirect the user back after login
            $currentUri = $_SERVER['REQUEST_URI'] ?? '/';
            Session::set('intended_url', $currentUri);
            
            // Redirect to the login page
            Response::redirect('/login');
            exit;
        }

        // If authenticated, allow the request to proceed
        return true;
    }
}
