<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Messages\Actions\Find;

use ByTIC\NotifierBuilder\Messages\Factories\MessageFactory;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientsTrait as Recipients;
use ByTIC\NotifierBuilder\Topics\Models\Topic;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Closure;
use Nip\Records\AbstractModels\Record;
use Nip\Records\RecordManager;

/**
 *
 */
abstract class FindAbstract
{
    /**
     * @var Messages|mixed|RecordManager
     */
    protected $repositoryMessages;

    protected ?int $topicId = null;
    protected ?string $recipient = null;
    protected ?string $channel = null;

    protected ?Closure $validator = null;

    protected $default = null;

    /**
     * @param null $repositoryMessages
     * @param null $repositoryRecipients
     */
    protected function __construct($repositoryMessages = null)
    {
        $this->repositoryMessages = $repositoryMessages ?? NotifierBuilderModels::messages();
    }

    public static function for($topic, $recipient, $channel): static
    {
        $instance = new static();
        $instance->setTopicId(self::formatTopic($topic));
        $instance->recipient = $recipient;
        $instance->channel = $channel;
        return $instance;
    }

    /**
     * @param int|null $topicId
     */
    public function setTopicId(?int $topicId): void
    {
        $this->topicId = $topicId;
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

        return intval($topic->id);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function orCreate(array $data = []): self
    {
        $this->orReturn(function () use ($data) {
            $data = $this->createMessageData($data);
            return MessageFactory::create($data);
        });

        return $this;
    }

    /**
     * @param null|Closure $default
     * @return $this
     */
    public function orReturn($default = null): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function createMessageData(array $data = []): array
    {
        return array_merge($data, [
            'id_topic' => $this->topicId,
            'recipient' => $this->recipient,
            'channel' => $this->channel,
        ]);
    }

    /**
     * @return MessageTrait|Record|null
     */
    public function fetch()
    {
        $params = $this->findParams();
        $found = $this->repositoryMessages->findOneByParams($params);
        return $found ?: $this->getDefault();
    }

    /**
     * @return array
     */
    protected function findParams(): array
    {
        $params = [];
        /** @var Recipients $recipientsTable */
        $params['where'] = [];
        $params['where'][] = ['`id_topic` = ?', $this->topicId];
        $params['where'][] = ['`recipient` = ?', $this->recipient];
        $params['where'][] = ['`channel` = ?', $this->channel];
        return $params;
    }

    protected function findOneByParams(array $params)
    {
        $message = $this->repositoryMessages->findOneByParams($params);
        if (!$message) {
            return null;
        }
        if ($this->validator) {
            $validator = $this->validator;
            if (!$validator($message)) {
                return null;
            }
        }
        return $message;
    }

    protected function getDefault()
    {
        return $this->default instanceof Closure ? ($this->default)() : $this->default;
    }
}