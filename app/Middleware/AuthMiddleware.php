<?php
namespace App\Middleware;

use App\Core\Session;
use App\Core\Response;

class AuthMiddleware {
    /**
     * Handle the incoming request.
     * Redirects to login if user is not authenticated.
     */
    public function handle($request) {
        if (!Session::has('user_id')) {
            // Save the requested URL to redirect back after successful login
            $currentUri = $_SERVER['REQUEST_URI'] ?? '/';
            Session::set('intended_url', $currentUri);
            
            // Redirect to login page
            Response::redirect('/login');
            exit;
        }
        return true;
    }
}
