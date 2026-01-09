<?php

namespace ByTIC\NotifierBuilder\Templates\Builder\Traits;

use ByTIC\Notifier\Notifications\Notification;
use ByTIC\NotifierBuilder\Templates\Templates\Template;
use Nip\Records\AbstractModels\Record;

/**
 * Trait HasNotificationMessageTrait.
 *
 * @method Notification getNotification
 */
trait HasNotificationMessageTrait
{
    /**
     * @var Record|Template|null
     */
    protected Record|Template|null $notificationTemplate = null;

    /**
     * Returns the email subject.
     *
     * @return string
     */
    public function generateEmailSubject()
    {
        return $this->getNotificationTemplate()->getSubject();
    }

    /**
     * Returns the email content.
     *
     * @return string|null
     */
    protected function generateEmailContent()
    {
        return $this->getNotificationTemplate()->getContent();
    }

    public function getNotificationTemplate(): Template|Record|null
    {
        return $this->notificationTemplate;
    }

    /**
     * @param Template $template
     */
    public function setNotificationTemplate($template): static
    {
        $this->notificationTemplate = $template;
        return $this;
    }
}
