<?php
$value = $value ?? 75;
$label = $label ?? 'Progress';
$variant = $variant ?? 'primary';
?>
<div class="mb-3">
    <div class="d-flex justify-content-between small text-muted mb-2">
        <span><?= htmlspecialchars($label) ?></span>
        <span><?= (int) $value ?>%</span>
    </div>
    <div class="progress" role="progressbar" aria-valuenow="<?= (int) $value ?>" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-<?= htmlspecialchars($variant) ?>" style="width: <?= (int) $value ?>%"></div>
    </div>
</div>
