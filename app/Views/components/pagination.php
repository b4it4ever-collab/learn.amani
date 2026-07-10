<?php
$active = $active ?? 1;
$total = $total ?? 5;
?>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link rounded-start-pill" href="#">Previous</a></li>
        <?php for ($i = 1; $i <= $total; $i++): ?>
            <li class="page-item <?= $i === $active ? 'active' : '' ?>">
                <a class="page-link" href="#"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item"><a class="page-link rounded-end-pill" href="#">Next</a></li>
    </ul>
</nav>
