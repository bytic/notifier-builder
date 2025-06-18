<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait;
use ByTIC\Notifications\Notifiable;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Messages\Actions\Find\FindOrCreateMessageForRecipient;
use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;
use ByTIC\NotifierBuilder\Models\Recipients\Types\AbstractType;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;
use ByTIC\NotifierBuilder\Recipients\Actions\GenerateNotifiables;
use ByTIC\NotifierBuilder\Recipients\Actions\GenerateRecipients;
use Nip\Records\RecordManager as Records;

/**
 * Class RecipientTrait.
 *
 * @property int $id_topic
 * @property string $recipient
 * @property string $type
 * @property string $active
 *
 * @method AbstractType getType
 * @method Topic getTopic
 * @method RecipientsTrait getManager()
 */
trait RecipientTrait
{
    use RecordTrait;

    protected $recipientManager = null;

    public function getRecipient(): string
    {
        return (string)$this->getPropertyRaw('recipient');
    }

    public function isActive(): bool
    {
        return 'yes' == $this->active;
    }

    /**
     * @param $event
     *
     * @return Notifiable[]
     *
     * @throws NotificationRecipientModelNotFoundException
     * @throws NotificationModelNotFoundException
     */
    public function generateNotifiablesForEvent($event)
    {
        return GenerateNotifiables::for($this, $event)
            ->handle();
    }

    /**
     * @param Event $event
     * @return RecipientTrait|null
     * @throws NotificationModelNotFoundException
     */
    public function getRecipientModelFromEvent($event)
    {
        return GenerateRecipients::forEvent($this, $event)
            ->generate();
    }

    /**
     * Return the Message from the database with the text to include
     * in the notification.
     *
     * @param string $channel
     *
     * @return Message
     */
    public function getNotificationMessage($channel = 'email')
    {
        $action = FindOrCreateMessageForRecipient::forRecipient($this, $channel);
        return $action->fetch();
    }

    /**
     * @return Records
     */
    public function getRecipientManager()
    {
        if (null === $this->recipientManager) {
            $this->recipientManager = $this->generateRecipientManager();
        }

        return $this->recipientManager;
    }

    public function generateRecipientManager(): Records
    {
        return $this->getManager()::getRecipientManager($this->getRecipient());
    }

    public function generateRecipientGetterMethod(): string
    {
        return $this->getManager()::generateRecipientGetterMethod($this->getRecipient());
    }
}
