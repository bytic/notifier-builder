<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use Nip\Records\Locator\ModelLocator;

/**
 * Class Topic
 *
 * @package ByTIC\NotifierBuilder\Models\Topics
 *
 * @property int $id_topic
 * @property string $recipient
 * @property string $channel
 * @property string $subject
 * @property string $content
 */
trait MessageTrait
{

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return Recipient|false|\Nip\Records\AbstractModels\Record
     */
    public function getNotificationRecipient()
    {
        $params = [];
        $params['where'][] = ['`id_topic` = ?', $this->id_topic];
        $params['where'][] = ['`recipient` = ?', $this->recipient];
        $recipientsTable = ModelLocator::get('Notifications\Recipients');
        return $recipientsTable->findOneByParams($params);
    }
}
