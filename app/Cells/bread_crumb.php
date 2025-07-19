<ol class="breadcrumb <?= $classes ?? 'float-sm-end' ?>">
    <?php foreach ($crumb as $c): ?>
        <li class="breadcrumb-item <?= $c['active'] ? 'active' : '' ?>" <?php if ($c['active']) { ?>aria-current="page" <?php } ?>>
            <?php if ($c['active']) { ?>
                <span title="Current page"><?= $c['label'] ?></span>
            <?php } else { ?>
                <a href="<?= $c['url'] ?>"><?= $c['label'] ?></a>
            <?php } ?>
        </li>
    <?php endforeach; ?>
</ol>