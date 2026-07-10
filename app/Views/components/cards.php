<?php
$title = $title ?? 'Card Title';
$text = $text ?? 'A polished, reusable card for summary content and supporting actions.';
$icon = $icon ?? 'bi bi-box';
$footer = $footer ?? '';
?>
<div class="card glass-card h-100 border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="icon-badge mb-3">
            <i class="<?= htmlspecialchars($icon) ?>"></i>
        </div>
        <h5 class="card-title fw-semibold mb-2"><?= htmlspecialchars($title) ?></h5>
        <p class="card-text text-muted mb-0"><?= htmlspecialchars($text) ?></p>
    </div>
    <?php if ($footer !== ''): ?>
        <div class="card-footer bg-transparent border-0 px-4 pb-4"><?= $footer ?></div>
    <?php endif; ?>
</div>
