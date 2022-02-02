<?php

namespace ByTIC\NotifierBuilder\Controllers\Admin;

use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait MessagesControllerTrait.
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
        $this->payload()->set('nMergeFields', $notification->generateMessageBuilder()->getMergeFields());
    }

    /**
     * {@inheritDoc}
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::messages());
    }
}
