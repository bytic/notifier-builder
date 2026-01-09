<?php
declare(strict_types=1);

use ByTIC\NotifierBuilder\Recipients\Actions\GenerateRecipientStatusLabel;
use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/* @var Recipient $item */
$item ??= $this->item;
$topic = $item->getTopic();
?>
<table class="details table table-striped">
    <tbody>
    <tr>
        <td class="name">
            <?= NotifierBuilderModels::topics()->getLabel('title.singular') ?>:
        </td>
        <td class="value">
            <a href="<?= $topic->getURL(); ?>">
                <?= $topic->getName(); ?>
            </a>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= NotifierBuilderModels::recipients()->getLabel('title.singular') ?>:
        </td>
        <td class="value">
            <?= $item->getRecipient(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('type') ?>:
        </td>
        <td class="value">
            <?= $item->getType()->getLabelHTML(); ?>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?= translator()->trans('active') ?>:
        </td>
        <td class="value">
            <?= GenerateRecipientStatusLabel::for($item)->html(); ?>
        </td>
    </tr>
    </tbody>
</table>