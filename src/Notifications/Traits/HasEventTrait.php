<?php

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use Nip\Utility\Oop;

/**
 * Trait HasEventTrait
 * @package ByTIC\NotifierBuilder\Notifications\Traits
 */
trait HasEventTrait
{

    /**
     * @var Event
     */
    protected $event = null;

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return bool
     */
    public function hasEvent()
    {
        return is_object($this->event)
            && in_array(\ByTIC\NotifierBuilder\Models\Events\EventTrait::class, Oop::uses($this->event));
    }

    /**
     * //     * @return EmailBuilder
     * //     * @throws NotificationModelNotFoundException
     * //     */
//    public function generateEmailMessage()
//    {
//        $class = $this->generateEmailMessageClass();
//        /** @var EmailBuilder $message */
//        $message = new $class();
//        $this->populateEmailMessage($message);
//        return $message;
//    }
//
//    /**
//     * @return string
//     */
//    abstract public function getRecipientName();
}
