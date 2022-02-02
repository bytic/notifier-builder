<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait;
use ByTIC\Notifications\Notifiable;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Messages\MessagesTrait;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;
use ByTIC\NotifierBuilder\Models\Recipients\Types\AbstractType;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\Record;
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
        return (string) $this->getPropertyRaw('recipient');
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
        $notifiableModels = $this->getRecipientModelFromEvent($event);
        if ($notifiableModels) {
            /* @var IsRecipientTrait $notifiableModels */
            return $notifiableModels->generateNotifiables();
        }

        throw new NotificationRecipientModelNotFoundException(
            'No model found in recipient' . $this->getRecipient() . ' from notification event [' . $event->id . ']'
        );
    }

    /**
     * @param Event $event
     *
     * @return RecipientTrait
     *
     * @throws NotificationModelNotFoundException
     */
    public function getRecipientModelFromEvent($event)
    {
        $method = $this->generateRecipientGetterMethod();
        $model = $event->getModel();
        if ($model instanceof Record) {
            return $model->$method();
        }

        return null;
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
        /** @var MessagesTrait $messagesTable */
        $messagesTable = NotifierBuilderModels::messages();

        return $messagesTable::getGlobal(
            $this->id_topic,
            $this->getRecipient(),
            $channel
        );
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
