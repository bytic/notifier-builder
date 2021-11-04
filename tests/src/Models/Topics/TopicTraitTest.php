<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Topics;

use ByTIC\NotifierBuilder\Tests\AbstractTest;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Topics\Topic;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\Record;

/**
 * Class TopicTraitTest
 * @package ByTIC\NotifierBuilder\Tests\Models\Topics
 */
class TopicTraitTest extends AbstractTest
{
    public function test_fireEvent()
    {
        $eventMock = \Mockery::mock(Event::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $eventsMock = \Mockery::mock(Events::class)->shouldAllowMockingProtectedMethods()->makePartial();

        $eventMock->shouldReceive('getManager')->andReturn($eventsMock);
        $eventMock->shouldReceive('save')->once();
        $eventsMock->shouldReceive('getNew')->andReturn($eventMock);

        ModelLocator::set('Notifications\Events', $eventsMock);

        $model = new Record();

        $topic = new Topic();
        $event = $topic->fireEvent($model);

        self::assertSame('pending', $event->getAttribute('status'));
    }
}