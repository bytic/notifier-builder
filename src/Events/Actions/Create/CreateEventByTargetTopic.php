<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Events\Actions\Create;

use ByTIC\NotifierBuilder\Events\Actions\AbstractAction;
use ByTIC\NotifierBuilder\Events\Models\Event;

class CreateEventByTargetTopic extends AbstractAction
{

    protected $topic;
    protected $target;

    public static function for($target, $topic)
    {
        $return = new static();
        $return->target = $target;
        $return->topic = $topic;
        return $return;
    }

    public function create()
    {
        /** @var Event $event */
        $event = $this->getRepository()->getNew();
        $event->status = 'pending';
        $event->populateFromTopic($this->topic);
        $event->populateFromModel($this->target);
        $event->save();
        return $event;
    }
}

