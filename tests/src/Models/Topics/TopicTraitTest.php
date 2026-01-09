<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Topics;

use ByTIC\NotifierBuilder\Events\Models\Event;
use ByTIC\NotifierBuilder\Events\Models\Events;
use ByTIC\NotifierBuilder\Tests\AbstractTest;
use ByTIC\NotifierBuilder\Topics\Models\Topic;
use Mockery;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\Record;
use Nip\Records\RecordManager;

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
        $repository = new RecordManager();
        $repository->setMorphName('test-model');
        $model->setManager($repository);

        $topic = new Topic();
        $event = $topic->fireEvent($model);

        self::assertSame('pending', $event->getAttribute('status'));
    }
}
