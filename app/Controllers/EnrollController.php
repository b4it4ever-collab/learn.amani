<?php
namespace App\Controllers;

use App\Core\BaseController;

class EnrollController extends BaseController {
    
    public function enroll($id) {
        // 1. Get the current user from Session
        $userId = \App\Core\Session::get('user_id');
        
        // 2. Logic to save enrollment to database
        // Example: $enrollment = new \App\Models\Enrollment();
        // $enrollment->save(['user_id' => $userId, 'course_id' => $id]);
        
        // 3. Success Redirect
        \App\Core\Response::redirect('/dashboard/my-courses');
    }
}
