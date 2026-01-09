<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Events\Actions\Create;

use ByTIC\NotifierBuilder\Events\Actions\AbstractAction;
use ByTIC\NotifierBuilder\Events\Models\Event;
use ByTIC\NotifierBuilder\Topics\Actions\FindTopicByTargetTrigger;

/**
 *
 */
class FireEventByTargetTrigger extends AbstractAction
{
    protected $target;
    protected $trigger;

    /**
     * @return Event|false
     */
    public function fire()
    {
        $topic = FindTopicByTargetTrigger::for($this->target, $this->trigger);
        if (!$topic) {
            return false;
        }
        return CreateEventByTargetTopic::for($this->target, $topic)->create();
    }

    public static function for($target, $trigger): static
    {
        $return = new static();
        $return->target = $target;
        $return->trigger = $trigger;
        return $return;
    }
}

