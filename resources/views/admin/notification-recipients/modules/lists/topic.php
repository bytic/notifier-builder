<?php

declare(strict_types=1);

/** @var Recipient[] $recipients */

use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$recipients = $this->recipients;

$templatesRepository = NotifierBuilderModels::templates();
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
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($recipients as $recipient): ?>
        <?php
        $url = $recipient->getURL();
        ?>
        <tr>
            <td>
                <a href="">
                    <?= $recipient->getRecipient(); ?>
                </a>
            </td>
            <td>
                <?= $recipient->getType()->getLabelHTML(); ?>
            </td>
            <td>
                <?php
                if ($recipient->isActive()): ?>
                    <span class="badge text-bg--success">
                        <?= translator()->trans('yes'); ?>
                    </span>
                <?php
                else: ?>
                    <span class="badge text-bg--danger">
                        <?= translator()->trans('no'); ?>
                    </span>
                <?php
                endif; ?>
            </td>
            <td>
                <a href="<?= $url; ?>" class="btn btn-sm btn-outline-primary">
                    <?= $templatesRepository->getLabel('title') ?>
                </a>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>
