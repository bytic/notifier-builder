<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Actions;

use ByTIC\Notifications\ChannelManager;
use ByTIC\NotifierBuilder\Models\Recipients\Recipient;
use ByTIC\NotifierBuilder\Models\Topics\Topic;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Recipients\Actions\GenerateRecipients;
use ByTIC\NotifierBuilder\Topics\Actions\FindOrCreateByTargetTrigger;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class SendByTopicRecipient
{
    protected Record $subject;
    protected ?Recipient $recipient;
    protected ?Topic $topic;
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

    public function withTrigger($trigger): self
    {
        $this->trigger = $trigger;
        return $this;
    }

    public function withRecipientName($name): self
    {
        $this->recipientName = $name;
        return $this;
    }

    public function send()
    {
        $topic = $this->getTopic();
        $recipient = $this->getRecipient();
        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setTopic($topic);
        $notification->setSubjectRecord($this->subject);

        ChannelManager::instance()->send(
            GenerateRecipients::forSubject($recipient, $this->subject)->generate(),
            $notification
        );
        die('++');
    }

    protected function getTopic(): Topic|Record|null
    {
        if (!isset($this->topic)) {
            $this->topic = FindOrCreateByTargetTrigger::for($this->target, $this->trigger);
        }
        return $this->topic;
    }

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
                return $recipient->getRecipient() == 'org_supporters';
            })->current();
        }
        return $this->recipient;
    }
}
