<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Tests\Messages\Builder;

use ByTIC\NotifierBuilder\Models\Messages\Message;
use ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending\EmailBuilder;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class EmailBuilderTest extends TestCase
{
    public function test_generateContent()
    {
//        $notification = new OrgSupportersNotification();
        $message = new Message();
        $message->content = '<p>Hello</p>';

        $builder = new EmailBuilder();
        $builder->setNotificationMessage($message);

        $html = $builder->generateEmailBody();
        self::assertStringContainsString('<p>Hello</p>', $html);
    }
}
