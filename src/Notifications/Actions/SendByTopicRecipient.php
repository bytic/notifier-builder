<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Actions;

use ByTIC\Notifications\ChannelManager;
use ByTIC\Notifications\Notification;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Events\EventTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Recipients\Actions\GenerateNotifiables;
use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Topics\Actions\FindOrCreateByTargetTrigger;
use ByTIC\NotifierBuilder\Topics\Models\Topic;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class SendByTopicRecipient
{
    protected Record $subject;

    protected ?Recipient $recipient;
    protected ?string $recipientName = null;

    protected ?Topic $topic;
    protected ?Event $event = null;

    protected $target;
    protected $trigger;

    /**
     * @param $target
     * @return $this
     */
    public function withTarget($target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @param $trigger
     * @return $this
     */
    public function withTrigger($trigger): self
    {
        $this->trigger = $trigger;
        return $this;
    }

    /**
     * @param $topic
     * @return $this
     */
    public function withTopic($topic): self
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @param Event $event
     * @return $this
     */
    public function withEvent($event): self
    {
        $this->event = $event;
        $this->withTopic($event->getTopic());
        return $this;
    }

    public function withRecipient($recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function withRecipientName($name): self
    {
        $this->recipientName = $name;
        return $this;
    }

    public function send()
    {
        $recipient = $this->getRecipient();

        ChannelManager::instance()->send(
            GenerateNotifiables::for($recipient, $this->event)
                ->handle(),
            $this->generateNotification()
        );
    }

    /**
     * @return Notification|\ByTIC\NotifierBuilder\Notifications\Notification
     */
    protected function generateNotification()
    {
        $recipient = $this->getRecipient();
        $topic = $this->getTopic();
        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setTopic($topic);
        $notification->setSubjectRecord($this->subject);

        if (method_exists($notification, 'setEvent') && is_object($this->event)) {
            $notification->setEvent($this->event);
        }
        return $notification;
    }

    protected function getTopic(): Topic|Record|null
    {
        if (!isset($this->topic)) {
            $this->topic = FindOrCreateByTargetTrigger::for($this->target, $this->trigger);
        }
        return $this->topic;
    }

    /**
     * @param Event|EventTrait $event
     * @return static
     * @throws NotificationModelNotFoundException
     */
    public static function fromEvent(Event $event): self
    {
        $self = static::for($event->getModel());
        $self->withEvent($event);
        return $self;
    }

    /**
     * @param $subject
     * @return static
     */
    public static function for($subject): self
    {
        $self = new self();
        $self->subject = $subject;
        return $self;
    }

    protected function getRecipient(): ?Recipient
    {
        if (!isset($this->recipient)) {
            $topic = $this->getTopic();
            $this->recipient = $topic->getRecipients()->filter(function (Recipient $recipient) {
                return $recipient->getRecipient() == $this->recipientName;
            })->current();
        }
        return $this->recipient;
    }
}
