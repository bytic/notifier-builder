<?php

namespace ByTIC\NotifierBuilder\Models\Events;

use ByTIC\Notifications\ChannelManager;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;

/**
 * Class EventDispatcher.
 */
class EventDispatcher
{
    /**
     * @var EventTrait
     */
    protected $event;

    protected $recipients = null;

    /**
     * EventDispatcher constructor.
     *
     * @param EventTrait $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * @param $event
     *
     * @return EventDispatcher
     */
    public static function create($event)
    {
        $dispatcher = new static($event);

        return $dispatcher;
    }

    /**
     * @throws NotificationModelNotFoundException
     * @throws NotificationRecipientModelNotFoundException
     */
    public function dispatch()
    {
        $recipients = $this->getRecipients();
        foreach ($recipients as $recipient) {
            $this->dispatchForRecipient($recipient);
        }
    }

    /**
     * @param RecipientTrait $recipient
     *
     * @throws NotificationModelNotFoundException
     * @throws NotificationRecipientModelNotFoundException
     */
    public function dispatchForRecipient($recipient)
    {
        if ($recipient->isActive()) {
            $notification = NotificationFactory::createFromRecipient($recipient);

            if (method_exists($notification, 'setEvent')) {
                $notification->setEvent($this->getEvent());
            }

            $this->sendNotification($notification->notifiablesFor($recipient, $this->getEvent()), $notification);
        }
    }

    /**
     * @param $notifiables
     * @param $notification
     */
    protected function sendNotification($notifiables, $notification)
    {
        ChannelManager::instance()->send($notifiables, $notification);
    }

    /**
     * @return EventTrait
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return RecipientTrait[]
     */
    public function getRecipients()
    {
        if (null === $this->recipients) {
            $this->initRecipients();
        }

        return $this->recipients;
    }

    protected function initRecipients()
    {
        $this->setRecipients($this->getEvent()->getRecipients());
    }

    /**
     * @param mixed $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }
}
