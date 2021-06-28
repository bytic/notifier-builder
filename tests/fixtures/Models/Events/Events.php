<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Events;

use ByTIC\NotifierBuilder\Models\Events\EventsTrait;

/**
 * Class Events
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Events
 */
class Events extends \Nip\Records\RecordManager
{
    use EventsTrait;
}
