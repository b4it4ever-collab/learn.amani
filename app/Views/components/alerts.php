<?php
$type = $type ?? 'info';
$title = $title ?? 'Heads up';
$message = $message ?? 'This is a reusable alert component.';
$icon = $icon ?? 'bi bi-info-circle';
?>
<div class="alert alert-<?= htmlspecialchars($type) ?> d-flex align-items-start gap-2 rounded-4" role="alert">
    <i class="<?= htmlspecialchars($icon) ?> mt-1"></i>
    <div>
        <div class="fw-semibold"><?= htmlspecialchars($title) ?></div>
        <div><?= htmlspecialchars($message) ?></div>
    </div>
</div>
