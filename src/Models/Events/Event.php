<?php

namespace ByTIC\NotifierBuilder\Models\Events;

use Nip\Records\Record;

/**
 * Class Event
 * @package ByTIC\NotifierBuilder\Models\Events
 */
class Event extends Record
{
    use EventTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
