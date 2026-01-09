<?php

declare(strict_types=1);

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$notificationRecipients = NotifierBuilderModels::recipients();

$card = Card::make()
        ->withTitle($notificationRecipients->getLabel('title'))
        ->withIcon(Icons::list_ul())
//    ->themeSuccess()
        ->wrapBody(false)
        ->withContent($this->load('/notification-recipients/modules/lists/topic', [], true));
?>
<?= $card->render(); ?>