<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Topics;

use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Tests\AbstractTest;
use ByTIC\NotifierBuilder\Topics\Models\Topic;
use Mockery;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\Record;

/**
 * Class TopicTraitTest.
 */
class TopicTraitTest extends AbstractTest
{
    public function testFireEvent()
    {
        $eventMock = Mockery::mock(Event::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $eventsMock = Mockery::mock(Events::class)->shouldAllowMockingProtectedMethods()->makePartial();

        $eventMock->shouldReceive('getManager')->andReturn($eventsMock);
        $eventMock->shouldReceive('save')->once();
        $eventsMock->shouldReceive('getNew')->andReturn($eventMock);

        ModelLocator::set(Events::class, $eventsMock);

        $model = new Record();

        $topic = new Topic();
        $event = $topic->fireEvent($model);

        self::assertSame('pending', $event->getAttribute('status'));
    }
}
