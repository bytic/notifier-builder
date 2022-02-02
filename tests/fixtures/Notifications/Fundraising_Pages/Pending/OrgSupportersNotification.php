<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending;

use ByTIC\Notifications\Notification;

/**
 * Class OrgSupportersNotification.
 */
class OrgSupportersNotification extends Notification
{
    public $param;

    /**
     * {@inheritdoc}
     */
    public function __construct($param = null)
    {
        $this->param = $param;
    }
}
