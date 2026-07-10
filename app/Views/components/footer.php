<?php
$brand = $brand ?? 'Learn.Amani';
$copyright = $copyright ?? '© ' . date('Y') . ' Learn.Amani. All rights reserved.';
$columns = $columns ?? [
    ['title' => 'Platform', 'links' => [['label' => 'Courses', 'href' => '#courses'], ['label' => 'Programs', 'href' => '#programs']]],
    ['title' => 'Company', 'links' => [['label' => 'About', 'href' => '#about'], ['label' => 'Careers', 'href' => '#careers']]],
    ['title' => 'Support', 'links' => [['label' => 'Help Center', 'href' => '#help'], ['label' => 'Contact Us', 'href' => '#contact']]],
];
?>
<footer class="footer-shell glass-card rounded-4 p-4 p-lg-5 mt-5">
    <div class="row g-4 align-items-start">
        <div class="col-lg-4">
            <h5 class="fw-semibold mb-3"><?= htmlspecialchars($brand) ?></h5>
            <p class="text-muted mb-0">High-impact learning experiences designed for modern teams and ambitious professionals.</p>
        </div>
        <?php foreach ($columns as $column): ?>
            <div class="col-sm-6 col-lg-2">
                <h6 class="fw-semibold mb-3"><?= htmlspecialchars($column['title']) ?></h6>
                <ul class="list-unstyled small mb-0">
                    <?php foreach ($column['links'] as $link): ?>
                        <li class="mb-2">
                            <a class="text-decoration-none text-muted" href="<?= htmlspecialchars($link['href']) ?>"><?= htmlspecialchars($link['label']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="border-top mt-4 pt-3 small text-muted d-flex justify-content-between flex-wrap gap-2">
        <span><?= htmlspecialchars($copyright) ?></span>
        <span>Built with Bootstrap 5.3 and modern SaaS principles.</span>
    </div>
</footer>
