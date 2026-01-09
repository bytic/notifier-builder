<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Models;

use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Recipients\Models\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Topics\Actions\FindTopicsTargetManager;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\RecordManager;

/**
 * Class TopicTrait.
 *
 * @property int $id
 *
 * @method Recipient[] getRecipients()
 * @method             save()
 */
trait TopicTrait
{
    protected ?string $target = null;
    protected ?string $trigger = null;

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
     * @return string|null
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * @return RecordManager
     */
    public function getTargetManager()
    {
        return FindTopicsTargetManager::for($this)->handle();
    }
}
