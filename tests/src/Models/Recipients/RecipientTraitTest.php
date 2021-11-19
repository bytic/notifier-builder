<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Recipients;

use ByTIC\NotifierBuilder\Models\Messages\Message;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipient;
use ByTIC\NotifierBuilder\Tests\AbstractTest;
use Mockery as m;
use Nip\Records\Locator\ModelLocator;

/**
 * Class RecipientTraitTest
 * @package ByTIC\NotifierBuilder\Tests\Models\Recipients
 */
class RecipientTraitTest extends AbstractTest
{
    public function testIsActive()
    {
        $recipient = new Recipient();
        self::assertFalse($recipient->isActive());
    }

    public function test_getNotificationMessage()
    {
        $recipient = new Recipient();
        $messages = m::mock(Messages::class)->makePartial();
        $messages->shouldReceive('getGlobal')->andReturn(new Message());
        ModelLocator::set(Messages::class, $messages);

        self::assertInstanceOf(Message::class, $recipient->getNotificationMessage('mychannel'));
    }

//    public function testSend()
//    {
//        $recipient = new Recipient();
//
//        $type = m::mock(Single::class)
//            ->shouldReceive('sendEvent')->andReturn(1);
//
//        $recipients = m::mock(Recipients::class)
//            ->shouldReceive('getType')->andReturn($type);
//        $recipient->setManager($recipients);
//
//        $event = new Event();
//
//        $result = $recipient->sendEvent($event);
//        self::assertTrue($result);
//    }

//    public function testGenerateNotificationName()
//    {
//        $recipient = new Recipient();
//        $recipient->getRelation('Topic')->setResults()
//
//        $notificationName = $recipient->generateNotificationName();
//        self::assertSame('', $notificationName);
//    }
}
