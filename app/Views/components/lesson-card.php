<?php
$title = $title ?? 'Lesson Title';
$duration = $duration ?? '12 min';
$preview = $preview ?? 'Watch preview';
?>
<div class="card glass-card border-0 shadow-sm h-100">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <span class="badge rounded-pill bg-secondary-subtle text-secondary">Lesson</span>
            <span class="small text-muted"><?= htmlspecialchars($duration) ?></span>
        </div>
        <h6 class="fw-semibold mb-2"><?= htmlspecialchars($title) ?></h6>
        <p class="text-muted small mb-0"><?= htmlspecialchars($preview) ?></p>
    </div>
</div>
