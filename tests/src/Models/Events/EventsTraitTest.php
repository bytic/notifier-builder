<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Events;

use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Events\Statuses\Pending;
use ByTIC\NotifierBuilder\Models\Events\Statuses\Sent;
use ByTIC\NotifierBuilder\Models\Events\Statuses\Skipped;
use ByTIC\NotifierBuilder\Tests\AbstractTest;

/**
 * Class EventsTraitTest
 * @package ByTIC\NotifierBuilder\Tests\Models\Events
 */
class EventsTraitTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $repository = $this->newRepository();
        $statuses = $repository->getStatuses();

        self::assertCount(3, $statuses);
        self::assertInstanceOf(Pending::class, $statuses['pending']);
        self::assertInstanceOf(Sent::class, $statuses['sent']);
        self::assertInstanceOf(Skipped::class, $statuses['skipped']);
    }

    public function test_getTable()
    {
        $repository = $this->newRepository();
        self::assertSame('notifications-events', $repository->getTable());
    }

    protected function newRepository()
    {
        $repository = new Events();
        return $repository;
    }
}
