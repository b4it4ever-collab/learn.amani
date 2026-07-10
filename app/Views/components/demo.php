<?php
$components = [
    ['name' => 'Navbar', 'file' => 'navbar.php'],
    ['name' => 'Footer', 'file' => 'footer.php'],
    ['name' => 'Buttons', 'file' => 'buttons.php'],
    ['name' => 'Cards', 'file' => 'cards.php'],
    ['name' => 'Forms', 'file' => 'forms.php'],
    ['name' => 'Alerts', 'file' => 'alerts.php'],
    ['name' => 'Badges', 'file' => 'badges.php'],
    ['name' => 'Progress Bars', 'file' => 'progress.php'],
    ['name' => 'Course Cards', 'file' => 'course-card.php'],
    ['name' => 'Instructor Cards', 'file' => 'instructor-card.php'],
    ['name' => 'Lesson Cards', 'file' => 'lesson-card.php'],
    ['name' => 'Statistics Cards', 'file' => 'stat-card.php'],
    ['name' => 'Pagination', 'file' => 'pagination.php'],
    ['name' => 'Breadcrumb', 'file' => 'breadcrumb.php'],
    ['name' => 'Search', 'file' => 'search.php'],
];
?>
<div class="py-4">
    <h2 class="fw-bold mb-4">Reusable UI Components</h2>
    <p class="text-muted mb-4">A modular design system ready for future pages and landing experiences.</p>
    <div class="row g-3">
        <?php foreach ($components as $component): ?>
            <div class="col-md-6 col-xl-4">
                <div class="card glass-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-1"><?= htmlspecialchars($component['name']) ?></h6>
                        <p class="text-muted small mb-0">Component template: <?= htmlspecialchars($component['file']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
