<?php

namespace ByTIC\NotifierBuilder\Tests\Notifications;

use ByTIC\Notifications\Notification;
use ByTIC\Notifier\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Tests\AbstractTest;
use ByTIC\NotifierBuilder\Tests\Fixtures\Library\Application;

/**
 * Class NotificationFactoryTest.
 */
class NotificationFactoryTest extends AbstractTest
{
    public function testCreateWithOneParam()
    {
        app()->set('app', new Application());

        $notification = NotificationFactory::create('fundraising-page', 'pending', 'org_supporters', ['789']);

        self::assertInstanceOf(Notification::class, $notification);
        self::assertSame($notification->param, '789');
    }

    /**
     * @param $class
     * @param $recipient
     * @param $target
     * @param $trigger
     * @dataProvider generateNotificationNameData
     */
    public function testGenerateNotificationName($class, $target, $trigger, $recipient)
    {
        app()->set('app', new Application());
        self::assertSame($class, NotificationFactory::generateNotificationName($target, $trigger, $recipient));
    }

    /**
     * @return array
     */
    public function generateNotificationNameData()
    {
        return [
            [
                'ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending\OrgSupportersNotification',
                'fundraising-page',
                'pending',
                'org_supporters',
            ],
        ];
    }
}
