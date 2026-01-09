<?php

declare(strict_types=1);

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

$templatesRecipients = NotifierBuilderModels::templates();

$card = Card::make()
    ->withTitle($templatesRecipients->getLabel('title'))
    ->withIcon(Icons::list_ul())
//    ->themeSuccess()
    ->wrapBody(false)
    ->withContent($this->load('/notifications-templates/modules/lists/recipient', [], true));
?>
<?= $card->render(); ?>