<?php
$brand = $brand ?? 'Learn.Amani';
$links = $links ?? [
    ['label' => 'Home', 'href' => '#home'],
    ['label' => 'Courses', 'href' => '#courses'],
    ['label' => 'Categories', 'href' => '#categories'],
    ['label' => 'Community', 'href' => '#community'],
    ['label' => 'About', 'href' => '#about'],
    ['label' => 'Contact', 'href' => '#contact'],
];
$loginLabel = $loginLabel ?? 'Login';
$registerLabel = $registerLabel ?? 'Register';
?>
<nav class="navbar navbar-expand-lg sticky-top px-3 py-2 my-3" aria-label="Primary navigation">
    <div class="container">
        <a class="navbar-brand fw-semibold text-dark" href="/">
            <i class="bi bi-mortarboard-fill me-2"></i><?= htmlspecialchars($brand) ?>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php foreach ($links as $link): ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="<?= htmlspecialchars($link['href']) ?>"><?= htmlspecialchars($link['label']) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <button class="btn btn-link text-dark p-2" type="button" data-theme-toggle aria-label="Toggle dark mode">
                    <i class="bi bi-moon-stars"></i>
                </button>
                <a href="#search" class="btn btn-link text-dark p-2" aria-label="Search">
                    <i class="bi bi-search"></i>
                </a>
                <a href="#loginModal" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#loginModal"><?= htmlspecialchars($loginLabel) ?></a>
                <a href="#loginModal" class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#loginModal"><?= htmlspecialchars($registerLabel) ?></a>
            </div>
        </div>
    </div>
</nav>
