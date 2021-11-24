<?php

namespace ByTIC\NotifierBuilder\Notifications;

use ByTIC\Notifier\Messages\Builder\EmailBuilder;
use ByTIC\NotifierBuilder\Notifications\Traits\HasEventTrait;
use ByTIC\NotifierBuilder\Notifications\Traits\HasNotificationMessage;
use ByTIC\NotifierBuilder\Notifications\Traits\HasRecipientTrait;

/**
 * Class Notification
 * @package ByTIC\NotifierBuilder\Notifications
 */
class Notification extends \ByTIC\Notifier\Notifications\Notification
{
    use HasEventTrait;
    use HasRecipientTrait;
    use HasNotificationMessage;

    /**
     * @inheritdoc
     */
    public function generateMessageBuilder($type = 'mail')
    {
        /** @var EmailBuilder $builder */
        $builder = parent::generateMessageBuilder($type);

        if ($this->hasEvent()) {
            $builder->setItem($this->getEvent()->getModel());
        }

        if ($this->hasNotificationMessage()) {
            $builder->setNotificationMessage($this->getNotificationMessage());
        }

        return $builder;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @return string
     */
    public function generateMailBuilderClass()
    {
        return EmailBuilder::class;
    }
}
