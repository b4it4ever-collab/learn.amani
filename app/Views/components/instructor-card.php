<?php
$name = $name ?? 'Instructor Name';
$role = $role ?? 'Lead Instructor';
$bio = $bio ?? 'Expert mentor with a track record of helping learners achieve outcomes.';
$avatar = $avatar ?? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80';
?>
<div class="card glass-card border-0 shadow-sm h-100 text-center p-4">
    <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($name) ?>" class="rounded-circle mx-auto mb-3" style="width: 88px; height: 88px; object-fit: cover;">
    <h5 class="fw-semibold mb-1"><?= htmlspecialchars($name) ?></h5>
    <p class="text-primary small fw-semibold mb-3"><?= htmlspecialchars($role) ?></p>
    <p class="text-muted small mb-0"><?= htmlspecialchars($bio) ?></p>
</div>
