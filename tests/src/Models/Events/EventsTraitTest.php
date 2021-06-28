<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Events;

use ByTIC\NotifierBuilder\Models\Events\Statuses\Pending;
use ByTIC\NotifierBuilder\Models\Events\Statuses\Sent;
use ByTIC\NotifierBuilder\Models\Events\Statuses\Skipped;
use ByTIC\NotifierBuilder\Tests\AbstractTest;
use ByTIC\NotifierBuilder\Tests\Fixtures\Models\Events\Events;

/**
 * Class EventsTraitTest
 * @package ByTIC\NotifierBuilder\Tests\Models\Events
 */
class EventsTraitTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $statuses = Events::instance()->getStatuses();

        self::assertCount(3, $statuses);
        self::assertInstanceOf(Pending::class, $statuses['pending']);
        self::assertInstanceOf(Sent::class, $statuses['sent']);
        self::assertInstanceOf(Skipped::class, $statuses['skipped']);
    }
}