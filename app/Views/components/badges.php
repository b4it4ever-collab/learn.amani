<?php
$label = $label ?? 'Badge';
$variant = $variant ?? 'primary';
$pill = $pill ?? true;
?>
<span class="badge bg-<?= htmlspecialchars($variant) ?><?= $pill ? ' rounded-pill' : '' ?> px-3 py-2">
    <?= htmlspecialchars($label) ?>
</span>
