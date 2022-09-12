<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications;

use ByTIC\NotifierBuilder\Messages\Builder\EmailBuilder;

/**
 * Class Notification.
 */
class Notification extends \ByTIC\Notifier\Notifications\Notification
{
    use Traits\HasEventTrait;
    use Traits\HasTopicTrait;
    use Traits\HasRecipientTrait;
    use Traits\HasSubjectRecordTrait;
    use Traits\HasNotificationMessage;
    use Traits\HasNotifiablesTrait;

    /**
     * {@inheritdoc}
     */
    public function generateMessageBuilder($type = 'mail')
    {
        /** @var EmailBuilder $builder */
        $builder = parent::generateMessageBuilder($type);

        if ($this->hasEvent()) {
            $builder->setItem($this->getEvent()->getModel());
        }

        if ($this->hasSubjectRecord()) {
            $builder->setItem($this->getSubjectRecord());
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
