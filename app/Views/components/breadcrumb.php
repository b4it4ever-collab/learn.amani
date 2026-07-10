<?php
$items = $items ?? [['label' => 'Home', 'href' => '/'], ['label' => 'Library', 'href' => '#']];
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($items as $index => $item): ?>
            <?php $isLast = $index === count($items) - 1; ?>
            <li class="breadcrumb-item <?= $isLast ? 'active' : '' ?>" <?= $isLast ? 'aria-current="page"' : '' ?>>
                <?php if (!$isLast): ?>
                    <a href="<?= htmlspecialchars($item['href']) ?>" class="text-decoration-none"><?= htmlspecialchars($item['label']) ?></a>
                <?php else: ?>
                    <?= htmlspecialchars($item['label']) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
