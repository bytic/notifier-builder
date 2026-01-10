<?php
declare(strict_types=1);

/** @var Template $item */

use ByTIC\NotifierBuilder\Templates\Models\Template;

$topic = $item->getTopic();
?>
<tr>
    <td>
        <?= $topic->getTarget(); ?>
        /
        <?= $topic->getTrigger(); ?>
    </td>
    <td>
        <a href="<?= $item->getURL(); ?>" title="" class="notifications-topic">
            <?= $item->getSubject(); ?>
        </a>
    </td>
</tr>