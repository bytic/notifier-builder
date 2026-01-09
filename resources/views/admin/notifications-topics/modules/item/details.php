<?php
declare(strict_types=1);

use ByTIC\NotifierBuilder\Models\Topics\Topic;

/* @var Topic $item */
$item ??= $this->item;
?>
<table class="details table table-striped">
    <tbody>
    <tr>
        <td class="name"><?= translator()->trans('target'); ?>:</td>
        <td class="value">
            <a href="<?= $item->getURL(); ?>">
                <?= $item->getTarget(); ?>
            </a>
        </td>
    </tr>
    <tr>
        <td class="name"><?= translator()->trans('trigger'); ?>:</td>
        <td class="value">
            <?= $item->getTrigger(); ?>
        </td>
    </tr>
    </tbody>
</table>