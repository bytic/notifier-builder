<?php
declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$notificationMessages = NotifierBuilderModels::templates();

?>
<div class="row">
    <div class="col-sm-8">
        <?= $this->form->render(); ?>
    </div>
    <div class="col-sm-4">
        <h3><?= $notificationMessages->getLabel('mergeFields'); ?></h3>
        <?= $this->load('item/mergeFields'); ?>
    </div>
</div>