<?php

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Models\Messages\MessagesTrait as Messages;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait HasNotificationMessage.
 */
trait HasNotificationMessage
{
    /**
     * Notification Message.
     *
     * @var Message
     */
    protected $notificationMessage = null;

    /**
     * Instances and returns the Notification Message Record.
     *
     * @return Message
     */
    public function getNotificationMessage()
    {
        if (null == $this->notificationMessage) {
            $this->initNotificationMessage();
        }

        return $this->notificationMessage;
    }

    /**
     * @param Message $notificationMessage
     */
    public function setNotificationMessage($notificationMessage)
    {
        $this->notificationMessage = $notificationMessage;
    }

    /**
     * @return bool
     */
    public function hasNotificationMessage()
    {
        return is_object($this->getNotificationMessage());
    }

    /**
     * Instances the Notigication Record.
     *
     * @return void
     */
    protected function initNotificationMessage()
    {
        $this->setNotificationMessage($this->generateNotificationMessage());
    }

    /**
     * Return the Message from the database with the text to include
     * in the notification.
     *
     * @return Message
     */
    protected function generateNotificationMessage()
    {
        /** @var Messages $messages */
        $messages = NotifierBuilderModels::messages();

        return $messages::getGlobal(
            $this->getEvent()->getTopic(),
            $this->getRecipientName(),
            'email'
        );
    }
}
