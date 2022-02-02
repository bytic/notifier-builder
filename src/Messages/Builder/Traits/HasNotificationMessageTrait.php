<?php

namespace ByTIC\NotifierBuilder\Messages\Builder\Traits;

use ByTIC\Notifier\Notifications\Notification;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;

/**
 * Trait HasNotificationMessageTrait.
 *
 * @method Notification getNotification
 */
trait HasNotificationMessageTrait
{
    protected $notificationMessage = null;

    /**
     * Returns the email subject.
     *
     * @return string
     */
    public function generateEmailSubject()
    {
        return $this->getNotificationMessage()->getSubject();
    }

    /**
     * Returns the email content.
     *
     * @return string|null
     */
    protected function generateEmailContent()
    {
        return $this->getNotificationMessage()->getContent();
    }

    /**
     * @return Message
     */
    public function getNotificationMessage()
    {
        return $this->notificationMessage;
    }

    /**
     * @param Message $message
     */
    public function setNotificationMessage($message)
    {
        $this->notificationMessage = $message;
    }
}
