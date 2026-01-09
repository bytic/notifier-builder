<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Tests\Messages\Builder;

use ByTIC\NotifierBuilder\Templates\Templates\Template;
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
        $message = new Template();
        $message->content = 'TEMPLATE_CONTENT_TEST';

        $builder = new EmailBuilder();
        $builder->setNotificationTemplate($message);

        $html = $builder->generateEmailBody();
        self::assertStringContainsString('TEMPLATE_CONTENT_TEST', $html);
    }
}
