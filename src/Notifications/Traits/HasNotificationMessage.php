<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Templates\Actions\Find\FindAbstract;
use ByTIC\NotifierBuilder\Templates\Actions\Find\FindOrCreateMessagesByParents;
use ByTIC\NotifierBuilder\Templates\Templates\TemplatesTrait as Messages;
use ByTIC\NotifierBuilder\Templates\Templates\TemplateTrait as Message;
use Exception;

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
    public function hasNotificationMessage($channel = null)
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
     * @throws Exception
     */
    protected function generateNotificationMessageFinder(?string $channel): FindAbstract
    {
        $topic = $this->getTopic();
        $topic = $topic ?: ($this->hasEvent() ? $this->getEvent()->getTopic() : null);
        if (!is_object($topic)) {
            throw new Exception('Topic is not set');
        }
        return FindOrCreateMessagesByParents::for(
            $topic,
            $this->getRecipientName(),
            $channel
        );
    }
}
