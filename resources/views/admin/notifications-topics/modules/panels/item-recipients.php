<?php

declare(strict_types=1);

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$notificationRecipients = NotifierBuilderModels::recipients();

$card = Card::make()
        ->withTitle($notificationRecipients->getLabel('title'))
        ->withIcon(Icons::list_ul())
        ->addHeaderTool(
                ButtonAction::make()
                        ->setUrl($this->item->getEditURL())
                        ->addHtmlClass('btn-xs')
                        ->setLabel(translator()->trans('edit'))
        )
//    ->themeSuccess()
        ->wrapBody(false)
        ->withContent($this->load('/notification-recipients/modules/lists/topic', [], true));
?>
<?= $card->render(); ?>