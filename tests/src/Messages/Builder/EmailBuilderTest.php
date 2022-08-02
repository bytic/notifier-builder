<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Tests\Messages\Builder;

use ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending\EmailBuilder;
use ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending\OrgSupportersNotification;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class EmailBuilderTest extends TestCase
{
    public function test_generateContent()
    {
        $notification = new OrgSupportersNotification();
        $builder = new EmailBuilder();
        $html = $builder->generateEmailBody();
        self::assertSame('<p>Hello</p>', $html);
    }
}
