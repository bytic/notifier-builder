<?php

namespace ByTIC\NotifierBuilder\Models\Recipients\Types;

use \ByTIC\Models\SmartProperties\Properties\Types\Generic;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\ChannelManager;
use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use Nip\Records\AbstractModels\Record;

/**
 * Class AbstractType
 * @package ByTIC\NotifierBuilder\Models\Recipients\Types
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
