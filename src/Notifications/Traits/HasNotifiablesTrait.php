<?php

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\Notifications\Notifiable;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Events\EventTrait;
use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Recipients\Models\RecipientTrait;

trait HasNotifiablesTrait
{
    /**
     * @param Recipient|RecipientTrait $recipient
     * @param Event|EventTrait $event
     *
     * @return Notifiable[]
     */
    public function notifiablesFor($recipient, $event): iterable
    {
        return $recipient->generateNotifiablesForEvent($event);
    }
}
