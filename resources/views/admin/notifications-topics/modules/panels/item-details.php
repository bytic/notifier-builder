<?php

declare(strict_types=1);

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;

$card = Card::make()
    ->withTitle($this->get('modelManager')->getLabel('title.singular'))
    ->withIcon(Icons::list_ul())
//    ->themeSuccess()
    ->wrapBody(false)
    ->withContent($this->load('/' . $this->controller . '/modules/item/details', [], true));
?>
<?= $card->render(); ?>