<?php

namespace ByTIC\NotifierBuilder\Controllers;

use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait MessagesControllerTrait
 * @package ByTIC\NotifierBuilder\Controllers
 *
 * @method MessageTrait getModelFromRequest
 */
trait MessagesControllerTrait
{

    public function view()
    {
        parent::view();

        $item = $this->getModelFromRequest();
        $this->payload()->set('recipients', $item->getRecipients());
    }

    /**
     * @inheritDoc
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::topics());
    }

}
