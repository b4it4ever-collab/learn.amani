<?php
$label = $label ?? 'Action';
$variant = $variant ?? 'primary';
$size = $size ?? 'md';
$href = $href ?? '#';
$outline = $outline ?? false;
$icon = $icon ?? '';
$pill = $pill ?? false;
$classes = 'btn btn-' . ($outline ? 'outline-' : '') . $variant . ' btn-' . $size;
if ($pill) {
    $classes .= ' rounded-pill';
}
?>
<a href="<?= htmlspecialchars($href) ?>" class="<?= htmlspecialchars($classes) ?>">
    <?php if ($icon !== ''): ?>
        <i class="<?= htmlspecialchars($icon) ?> me-2"></i>
    <?php endif; ?>
    <?= htmlspecialchars($label) ?>
</a>
