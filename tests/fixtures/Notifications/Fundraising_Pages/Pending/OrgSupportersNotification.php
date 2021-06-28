<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending;

/**
 * Class OrgSupportersNotification
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Notifications\Fundraising_Pages\Pending
 */
class OrgSupportersNotification extends \ByTIC\Notifications\Notification
{
    public $param;

    /**
     * @inheritdoc
     */
    public function __construct($param = null)
    {
        $this->param = $param;
    }
}
