<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Models\Topics\TopicsTrait as Topics;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\RecordManager;

/**
 * Class TopicTrait
 * @package ByTIC\NotifierBuilder\Models\Topics
 *
 * @property int $id
 * @property string $target
 * @property string $trigger
 *
 * @method Recipient[] getRecipients()
 * @method save()
 */
trait TopicTrait
{
    protected $targetManager = null;

    /**
     * @param $model
     * @param $trigger
     *
     * @return Event
     */
    public function fireEvent($model)
    {
        /** @var Event $event */
        $event = ModelLocator::get('Notifications\Events')->getNew();
        $event->status = 'pending';
        $event->populateFromTopic($this);
        $event->populateFromModel($model);
        $event->save();
        return $event;
    }

    /**
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return RecordManager
     */
    public function getTargetManager()
    {
        if ($this->targetManager === null) {
            $this->targetManager = $this->generateTargetManager();
        }
        return $this->targetManager;
    }

    /**
     * @return RecordManager
     */
    public function generateTargetManager()
    {
        /** @var Topics $topicsManager */
        $topicsManager = ModelLocator::get('Notifications\Topics');
        return $topicsManager::getTargetManager($this->getTarget());
    }
}
