<?php

namespace ByTIC\NotifierBuilder\Models\Events;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Event
 * @package ByTIC\NotifierBuilder\Models\Events
 */
class Event extends Record
{
    use EventTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
