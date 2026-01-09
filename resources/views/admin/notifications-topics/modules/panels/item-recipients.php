<?php
declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$notificationRecipients = NotifierBuilderModels::recipients();

?>
<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title">
            <?= $notificationRecipients->getLabel('title'); ?>
        </h4>
    </div>

    <?= $this->load('/notification-recipients/modules/lists/topic'); ?>
</div>