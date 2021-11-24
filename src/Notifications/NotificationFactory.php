<?php

namespace ByTIC\NotifierBuilder\Notifications;

use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait;

/**
 * Class NotificationFactory
 * @package ByTIC\NotifierBuilder\Notifications
 */
class NotificationFactory extends \ByTIC\Notifier\Notifications\NotificationFactory
{
    /**
     * @param RecipientTrait $recipient
     * @param array $params
     * @return \ByTIC\Notifications\Notification|Notification
     */
    public static function createFromRecipient($recipient, $params = [])
    {
        $notification = static::create(
            $recipient->getTopic()->getTarget(),
            $recipient->getTopic()->getTrigger(),
            $recipient->getRecipient(),
            $params
        );
        if (method_exists($notification, 'setRecipient')) {
            $notification->setRecipient($recipient);
        }
        return $notification;
    }

}
