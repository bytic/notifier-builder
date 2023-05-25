<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Recipients\Actions;

use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Recipients\Recipient;
use Nip\Records\Record;

/**
 *
 */
class GenerateRecipients
{
    protected $subject;
    protected Recipient $recipient;

    /**
     * @param $recipient
     * @param Event $event
     * @return static
     * @throws NotificationModelNotFoundException
     */
    public static function forEvent($recipient, Event $event): self
    {
        return static::forSubject($recipient, $event->getModel());
    }

    /**
     * @param Recipient $recipient
     * @param $subject
     * @return static
     */
    public static function forSubject(Recipient $recipient, $subject): self
    {
        $self = new self();
        $self->subject = $subject;
        $self->recipient = $recipient;
        return $self;
    }

    /**
     * @return null
     */
    public function generate()
    {
        $method = $this->generateRecipientGetterMethod($this->recipient->getRecipient());
        if ($this->subject instanceof Record) {
            return $this->subject->$method();
        }
        return null;
    }

    /**
     * @param string $name
     */
    public static function generateRecipientGetterMethod($name): string
    {
        return 'get' . inflector()->singularize(inflector()->classify($name));
    }
}