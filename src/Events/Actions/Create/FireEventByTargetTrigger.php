<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Events\Actions\Create;

use ByTIC\NotifierBuilder\Events\Actions\AbstractAction;
use ByTIC\NotifierBuilder\Events\Models\Event;
use ByTIC\NotifierBuilder\Topics\Actions\CreateTopicTarget;
use ByTIC\NotifierBuilder\Topics\Actions\FindTopicByTargetTrigger;

/**
 *
 */
class FireEventByTargetTrigger extends AbstractAction
{
    protected $record;
    protected CreateTopicTarget $targetAction;
    protected $trigger;

    public static function for($record, $trigger): static
    {
        $return = new static();
        $return->record = $record;
        $return->targetAction = CreateTopicTarget::from($record);
        $return->trigger = $trigger;
        return $return;
    }

    public function withNamespace(string $namespace): static
    {
        $this->targetAction->withNamespace($namespace);
        return $this;
    }

    /**
     * @return Event|false
     */
    public function fire()
    {
        $topic = FindTopicByTargetTrigger
            ::for(
                $this->targetAction->get(),
                $this->trigger
            )->fetch();
        if (!$topic) {
            return false;
        }
        return CreateEventByTargetTopic::for($this->record, $topic)->create();
    }

}

