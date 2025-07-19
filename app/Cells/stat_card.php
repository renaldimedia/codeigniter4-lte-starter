<div class="small-box text-bg-<?= $color ?? 'primary' ?>">
    <div class="inner">
        <h3><?= $number ?><?php if ($is_percentage) { ?><sup class="fs-5">%</sup><?php } ?></h3>
        <p><?= $title ?></p>
    </div>
    <?php if ($icon_svg) { ?>
        <?= $icon_svg ?>
    <?php } ?>
    <a
        href="<?= $url ?? '#' ?>"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        More info <i class="bi bi-link-45deg"></i>
    </a>
</div>