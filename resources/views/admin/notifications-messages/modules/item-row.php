<?php
declare(strict_types=1);

use ByTIC\NotifierBuilder\Models\Topics\Topic;

/* @var Topic $item */
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="" class="notifications-topic">
            <?= $item->getTargetManager()->getLabel('title'); ?>
        </a>
    </td>
    <td>
        <?= $item->getTrigger(); ?>
    </td>
</tr>