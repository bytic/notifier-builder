<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use ByTIC\NotifierBuilder\Models\Topics\Topic;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait;
use Nip\Utility\Oop;

/**
 * Trait HasEventTrait.
 */
trait HasTopicTrait
{
    /**
     * @var ?Topic
     */
    protected $topic = null;

    /**
     * @return ?Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param ?Topic $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return bool
     */
    public function hasTopic()
    {
        return is_object($this->topic)
            && in_array(TopicTrait::class, Oop::uses($this->topic));
    }
}
