<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Session;
use App\Core\Response;

class AuthController extends BaseController {
    
    // Shows the login page
    public function showLogin() {
        return $this->view('auth/login');
    }

    // Handles the login form submission
    public function login() {
        // Here you would add your database validation logic
        // If credentials are valid:
        // Session::set('user_id', $user['id']);
        
        // Handle the redirection back to the "intended_url"
        $redirectUrl = Session::get('intended_url') ?? '/dashboard';
        Session::remove('intended_url');
        
        Response::redirect($redirectUrl);
    }
}
