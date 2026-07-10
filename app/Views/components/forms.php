<?php
$label = $label ?? 'Field';
$name = $name ?? 'field';
$type = $type ?? 'text';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
$helpText = $helpText ?? '';
$required = $required ?? false;
?>
<div class="mb-3">
    <label for="<?= htmlspecialchars($name) ?>" class="form-label fw-semibold">
        <?= htmlspecialchars($label) ?><?= $required ? '<span class="text-danger ms-1">*</span>' : '' ?>
    </label>
    <input type="<?= htmlspecialchars($type) ?>" name="<?= htmlspecialchars($name) ?>" id="<?= htmlspecialchars($name) ?>" class="form-control form-control-lg" value="<?= htmlspecialchars((string) $value) ?>" placeholder="<?= htmlspecialchars($placeholder) ?>" <?= $required ? 'required' : '' ?>>
    <?php if ($helpText !== ''): ?>
        <div class="form-text"><?= htmlspecialchars($helpText) ?></div>
    <?php endif; ?>
</div>
