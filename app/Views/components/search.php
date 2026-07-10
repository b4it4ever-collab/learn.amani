<?php
$placeholder = $placeholder ?? 'Search courses, lessons, instructors';
?>
<div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border-0">
    <span class="input-group-text bg-white border-0 ps-4">
        <i class="bi bi-search text-muted"></i>
    </span>
    <input type="text" class="form-control border-0 py-3" placeholder="<?= htmlspecialchars($placeholder) ?>">
    <button class="btn btn-primary px-4" type="button">Search</button>
</div>
