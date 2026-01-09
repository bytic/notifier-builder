<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Topics\Models\Topic;

/** @var Topic $item */
$targetManager = $item->getTargetManager();
/* @var Topic $item */
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="" class="notifications-topic">
            <?= $targetManager ? $targetManager->getLabel('title') : $item->getTarget(); ?>
        </a>
    </td>
    <td>
        <?= $item->getTrigger(); ?>
    </td>
</tr>