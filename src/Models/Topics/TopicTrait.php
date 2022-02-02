<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Models\Topics\TopicsTrait as Topics;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\RecordManager;

/**
 * Class TopicTrait.
 *
 * @property int $id
 * @property string $target
 * @property string $trigger
 *
 * @method Recipient[] getRecipients()
 * @method             save()
 */
trait TopicTrait
{
    protected $targetManager = null;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->target . '::' . $this->trigger;
    }

    /**
     * @param $model
     * @param $trigger
     *
     * @return Event
     */
    public function fireEvent($model)
    {
        /** @var Event $event */
        $event = NotifierBuilderModels::events()->getNew();
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
        if (null === $this->targetManager) {
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
        $topicsManager = NotifierBuilderModels::topics();

        return $topicsManager::getTargetManager($this->getTarget());
    }
}
