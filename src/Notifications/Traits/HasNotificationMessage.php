<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Messages\Actions\Find\FindAbstract;
use ByTIC\NotifierBuilder\Messages\Actions\Find\FindOrCreateMessagesByParents;
use ByTIC\NotifierBuilder\Models\Messages\MessagesTrait as Messages;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;

/**
 * Trait HasNotificationMessage.
 */
trait HasNotificationMessage
{
    /**
     * Notification Message.
     *
     * @var Message[]
     */
    protected $notificationMessage = [
        'email' => null
    ];

    /**
     * Instances and returns the Notification Message Record.
     *
     * @return Message
     */
    public function getNotificationMessage($channel = null)
    {
        $channel = $channel ?: 'email';
        if (!isset($this->notificationMessage[$channel])) {
            $this->initNotificationMessage($channel);
        }

        return $this->notificationMessage[$channel];
    }

    /**
     * @param Message $notificationMessage
     */
    public function setNotificationMessage($notificationMessage, $channel = null)
    {
        $channel = $channel ?: 'email';
        $this->notificationMessage[$channel] = $notificationMessage;
    }

    /**
     * @return bool
     */
    public function hasNotificationMessage($channel)
    {
        $channel = $channel ?: 'email';
        return is_object($this->getNotificationMessage($channel));
    }

    /**
     * Instances the Notigication Record.
     *
     * @return void
     */
    protected function initNotificationMessage($channel)
    {
        $this->setNotificationMessage($this->generateNotificationMessage($channel));
    }

    /**
     * Return the Message from the database with the text to include
     * in the notification.
     *
     * @return Message
     */
    protected function generateNotificationMessage(?string $channel)
    {
        /** @var Messages $messages */
        $finder = $this->generateNotificationMessageFinder($channel);

        return $finder->fetch();
    }

    /**
     * @param string|null $channel
     * @return FindAbstract
     */
    protected function generateNotificationMessageFinder(?string $channel): FindAbstract
    {
        return FindOrCreateMessagesByParents::for(
            $this->getEvent()->getTopic(),
            $this->getRecipientName(),
            $channel
        );
    }
}
