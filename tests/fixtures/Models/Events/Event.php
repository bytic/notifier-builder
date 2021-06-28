<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Events;

use Nip\Records\Record;
use ByTIC\NotifierBuilder\Models\Events\EventTrait;

/**
 * Class Events
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Events
 */
class Event extends Record
{
    use EventTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
