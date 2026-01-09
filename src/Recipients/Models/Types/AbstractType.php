<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Recipients\Models\Types;

use ByTIC\Models\SmartProperties\Properties\Types\Generic;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Recipients\Models\RecipientTrait as Recipient;

/**
 * Class AbstractType.
 *
 * @method Recipient getItem
 */
abstract class AbstractType extends Generic
{
    /**
     * @param Event $event
     * @return int
     * @throws NotificationRecipientModelNotFoundException
     * @throws NotificationModelNotFoundException
     */
    public function sendEvent($event)
    {
        $notification = $this->getItem()->generateNotification($event);
        $recipientModel = $this->getItem()->getRecipientModelFromEvent($notification);
        if ($recipientModel) {
            $notifiables = $this->generateNotifiables($recipientModel);

            return $this->sendNotification($notifiables, $notification);
        }
    }
}
