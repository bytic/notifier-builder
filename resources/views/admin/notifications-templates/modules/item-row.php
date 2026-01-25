<?php
declare(strict_types=1);

/** @var Template $item */

use ByTIC\NotifierBuilder\Templates\Models\Template;

$topic = $item->getTopic();
?>
<tr>
    <td>
        <a href="<?= $item->getURL(); ?>" title="" class="notifications-topic">
            <?= $topic->getTarget(); ?>
            /
            <?= $topic->getTrigger(); ?>
        </a>
    </td>
    <td>
        <?= $item->channel; ?>
    </td>
    <td>
        <?= $item->getSubject(); ?>
    </td>
</tr>