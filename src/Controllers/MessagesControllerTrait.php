<?php

namespace ByTIC\NotifierBuilder\Controllers;

use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;

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
        $recipient = $item->getNotificationRecipient();

        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setNotificationMessage($item);
        $this->getView()->set('nMergeFields', $notification->generateMessageBuilder()->getMergeFields());
    }
}
