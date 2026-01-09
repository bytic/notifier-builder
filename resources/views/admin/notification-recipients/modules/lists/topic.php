<?php

declare(strict_types=1);

/** @var Recipient[] $recipients */

use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$recipients = $this->recipients;
$recipientsRepository = NotifierBuilderModels::recipients();
?>

<?php
if (count($recipients) < 1): ?>
    <?= $this->Messages()->info($recipientsRepository->getMessage('dnx')); ?>
    <?php
    return; ?>
<?php
endif; ?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th><?= $recipientsRepository->getLabel('title.singular'); ?></th>
        <th><?= $recipientsRepository->getLabel('type'); ?></th>
        <th><?= translator()->trans('active'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($recipients as $recipient): ?>
        <tr>
            <td>
                <?= $recipient->getRecipient(); ?>
            </td>
            <td>
                <?= $recipient->getType()->getLabelHTML(); ?>
            </td>
            <td>
                <?php
                if ($recipient->isActive()): ?>
                    <span class="badge badge-success">
                        <?= translator()->trans('yes'); ?>
                    </span>
                <?php
                else: ?>
                    <span class="badge badge-danger">
                        <?= translator()->trans('no'); ?>
                    </span>
                <?php
                endif; ?>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>
