<div class="card card-inverse">
    <div class="card-header">

        <h4 class="card-title">
            <?= translator()->trans('details'); ?>
        </h4>
        <div class="card-header-btn">
            <a href="<?= $this->item->getEditURL(); ?>" class="btn btn-xs btn-info">
                <?= translator()->trans('edit'); ?>
            </a>
        </div>
    </div>
    <?= $this->load('../item/details'); ?>
</div>