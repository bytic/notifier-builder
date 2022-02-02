<?php

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Models\Recipients\Recipient;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait;
use Nip\Utility\Oop;

/**
 * Trait HasEventTrait.
 */
trait HasRecipientTrait
{
    /**
     * @var Recipient
     */
    protected $recipient = null;

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return bool
     */
    public function hasRecipient()
    {
        return is_object($this->recipient)
            && in_array(RecipientTrait::class, Oop::uses($this->event));
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipientName()
    {
        return $this->getRecipient()->getRecipient();
    }

    public function generateEventNotifiablesForRecipient($event, $recipient)
    {
        $notifiables = [];
        foreach ($this->getRecipient()->getNotifiables() as $notifiable) {
            $notifiables[] = $notifiable;
        }

        return $notifiables;

        return $this->getRecipient()->generateNotifiablesForEvent($this->getEvent());
    }
}
