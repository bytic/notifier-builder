<?php

namespace ByTIC\NotifierBuilder\Messages\Builder;

use ByTIC\Notifications\Messages\Builder\EmailBuilder as GenericBuilder;
use ByTIC\Notifier\Notifications\Notification;
use ByTIC\NotifierBuilder\Messages\Builder\Traits\HasNotificationMessageTrait;

/**
 * Class AbstractBuilder.
 *
 * @method Notification getNotification
 */
abstract class EmailBuilder extends GenericBuilder
{
    use HasNotificationMessageTrait;
}
