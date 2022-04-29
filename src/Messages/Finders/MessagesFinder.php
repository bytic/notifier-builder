<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Messages\Finders;

use ByTIC\NotifierBuilder\Messages\Factories\MessageFactory;
use ByTIC\NotifierBuilder\Models\Messages\Message;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientsTrait as Recipients;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;
use Nip\Records\RecordManager;

/**
 *
 */
class MessagesFinder
{
    /**
     * @var Messages|mixed|RecordManager
     */
    protected $repositoryMessages;

    /**
     * @var \ByTIC\NotifierBuilder\Models\Recipients\Recipients|mixed|RecordManager
     */
    protected $repositoryRecipients;

    /**
     * @param null $repositoryMessages
     * @param null $repositoryRecipients
     */
    public function __construct($repositoryMessages = null, $repositoryRecipients = null)
    {
        $this->repositoryMessages = $repositoryMessages ?? NotifierBuilderModels::messages();
        $this->repositoryRecipients = $repositoryRecipients ?? NotifierBuilderModels::recipients();
    }

    /**
     * @param $topic
     * @param $recipient
     * @param $channel
     * @return mixed
     */
    public function findGlobal($topic, $recipient, $channel)
    {
        $params = $this->findParamsForGlobal($topic, $recipient, $channel);
        return $this->repositoryMessages->findOneByParams($params);
    }

    /**
     * @param $topic
     * @param $recipient
     * @param $channel
     * @return array
     */
    protected function findParamsForGlobal($topic, $recipient, $channel): array
    {
        $params = [];
        /** @var Recipients $recipientsTable */
        $params['where'] = [];
        $params['where'][] = ['`id_topic` = ?', self::formatTopic($topic)];
        $params['where'][] = [
            '`recipient` = ?',
            is_string($recipient) ? $recipient : $recipientsTable::modelToRecipientName($recipient),
        ];
        $params['where'][] = ['`channel` = ?', $channel];
        return $params;
    }

    /**
     * @param int|string|Topic $topic
     *
     * @return int
     */
    protected static function formatTopic($topic): int
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
     * @param $params
     * @return mixed
     */
    protected function findOneByParams($params)
    {
        return $this->repositoryMessages->findOneBy($params);
    }

    /**
     * @param $topic
     * @param $recipient
     * @param $channel
     * @param $parentType
     * @param $parentId
     * @return Message|Record
     */
    public function findOrCreateParent($topic, $recipient, $channel, $parentType, $parentId)
    {
        $message = $this->findByParents($topic, $recipient, $channel, [$parentId => $parentType]);
        if ($message) {
            return $message;
        }
        return MessageFactory::create([
            'id_topic' => self::formatTopic($topic),
            'recipient' => $recipient,
            'channel' => $channel,
            'parent_type' => $parentType,
            'parent_id' => $parentId,
        ]);
    }

    /**
     * @param $topic
     * @param $recipient
     * @param $channel
     * @param $parents
     * @return mixed
     */
    public function findByParents($topic, $recipient, $channel, $parents = [])
    {
        $params = $this->findParamsForGlobal($topic, $recipient, $channel);
        foreach ($parents as $parentId => $parentType) {
            $paramsParent = $params;
            $paramsParent['where'][] = ['`parent_type` = ?', $parentType];
            $paramsParent['where'][] = ['`parent_id` = ?', $parentId];
            $message = $this->findOneByParams($paramsParent);
            if ($message) {
                return $message;
            }
        }
        return $this->findOneByParams($params);
    }
}
