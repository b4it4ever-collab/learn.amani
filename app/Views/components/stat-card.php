<?php
$title = $title ?? 'Total Learners';
$value = $value ?? '24K';
$subtitle = $subtitle ?? '+12.4% this month';
$icon = $icon ?? 'bi bi-graph-up';
?>
<div class="card glass-card border-0 shadow-sm h-100">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="icon-badge">
                <i class="<?= htmlspecialchars($icon) ?>"></i>
            </div>
            <span class="text-success small fw-semibold"><?= htmlspecialchars($subtitle) ?></span>
        </div>
        <h3 class="fw-bold mb-1"><?= htmlspecialchars($value) ?></h3>
        <p class="text-muted mb-0"><?= htmlspecialchars($title) ?></p>
    </div>
</div>
