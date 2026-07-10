<?php
$title = $title ?? 'Course Title';
$description = $description ?? 'A strong course experience for modern professionals.';
$meta = $meta ?? '4.8 • 2h 15m';
$price = $price ?? '$49';
$badge = $badge ?? 'Popular';
$thumbnail = $thumbnail ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80';
?>
<div class="card glass-card h-100 border-0 shadow-sm overflow-hidden">
    <img src="<?= htmlspecialchars($thumbnail) ?>" class="card-img-top" alt="<?= htmlspecialchars($title) ?>" style="height: 180px; object-fit: cover;">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge rounded-pill bg-primary-subtle text-primary"><?= htmlspecialchars($badge) ?></span>
            <span class="text-muted small fw-semibold"><?= htmlspecialchars($meta) ?></span>
        </div>
        <h5 class="card-title fw-semibold mb-2"><?= htmlspecialchars($title) ?></h5>
        <p class="card-text text-muted mb-3"><?= htmlspecialchars($description) ?></p>
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-semibold text-dark"><?= htmlspecialchars($price) ?></span>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">View Course</a>
        </div>
    </div>
</div>
