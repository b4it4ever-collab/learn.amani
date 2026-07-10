<!-- app/Views/components/course-card.php -->
<div class="course-card">
    <h3><?php echo htmlspecialchars($course['title']); ?></h3>
    <p><?php echo htmlspecialchars($course['description']); ?></p>
    
    <!-- Enrollment Form -->
    <form action="/enroll/<?php echo $course['id']; ?>" method="POST">
        <!-- Assuming you have a CSRF token implementation -->
        <input type="hidden" name="csrf_token" value="<?php echo \App\Core\Csrf::getToken(); ?>">
        
        <button type="submit" class="btn-enroll">Enroll Now</button>
    </form>
</div>
