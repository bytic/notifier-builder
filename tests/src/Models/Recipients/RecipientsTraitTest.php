<?php

namespace ByTIC\NotifierBuilder\Tests\Models\Recipients;

use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\Models\Recipients\Types\Collection;
use ByTIC\NotifierBuilder\Models\Recipients\Types\Single;
use ByTIC\NotifierBuilder\Tests\AbstractTest;

/**
 * Class RecipientsTraitTest.
 */
class RecipientsTraitTest extends AbstractTest
{
    public function testGetTypes()
    {
        $repository = $this->newRepository();
        $types = $repository->getTypes();

        self::assertCount(2, $types);
        self::assertInstanceOf(Collection::class, $types['collection']);
        self::assertInstanceOf(Single::class, $types['single']);
    }

    /**
     * @return array
     */
    public function generateNotificationNameData()
    {
        $base = '\ByTIC\NotifierBuilder\Tests\Fixtures\Models\\';

        return [
            [
                $base . 'OrgSupporters\Notifications\Fundraising_Pages\PendingNotification',
                'org_supporters',
                'fundraising-page',
                'pending',
            ],
            [
                $base . 'OrgSupporters\Notifications\FundraisingPages\PendingNotification',
                'org_supporters',
                'fundraising_page',
                'pending',
            ],
        ];
    }

    protected function newRepository(): Recipients
    {
        $repository = new Recipients();

        return $repository;
    }
}
