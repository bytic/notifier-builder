<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Models;

use ByTIC\NotifierBuilder\Events\Actions\Create\CreateEventByTargetTopic;
use ByTIC\NotifierBuilder\Events\Models\EventTrait as Event;
use ByTIC\NotifierBuilder\Recipients\Models\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Topics\Actions\FindTopicsTargetManager;
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
        return CreateEventByTargetTopic::for($model, $this)->create();
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
