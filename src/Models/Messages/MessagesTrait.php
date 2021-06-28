<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientsTrait as Recipients;
use Nip\Records\Locator\ModelLocator;

/**
 * Class Messages
 *
 * @package ByTIC\NotifierBuilder\Models\Messages
 * @method Message findOneByParams($params)
 */
trait MessagesTrait
{
    use \Nip\Utility\Traits\SingletonTrait;

    /**
     * @param string|Topic $topic
     * @param string|Recipient $recipient
     * @param string $channel
     * @return Message
     */
    public static function getGlobal($topic, $recipient, $channel)
    {
        /** @var Recipients $recipientsTable */
        $recipientsTable = ModelLocator::get('Notifications\Recipients');
        $params['where'] = [];
        $params['where'][] = ['`id_topic` = ?', self::formatTopic($topic)];
        $params['where'][] = [
            '`recipient` = ?',
            is_string($recipient) ? $recipient : $recipientsTable::modelToRecipientName($recipient)
        ];
        $params['where'][] = ['`channel` = ?', $channel];

        return self::instance()->findOneByParams($params);
    }

    /**
     * @param int|string|Topic $topic
     * @return int
     */
    public static function formatTopic($topic)
    {
        if (is_int($topic)) {
            return $topic;
        }
        if (is_string($topic)) {
            return intval($topic);
        }
        return $topic->id;
    }

    /**
     * @return string
     */
    protected function generateTable()
    {
        return 'notification-messages';
    }
}
