<?php

namespace ByTIC\NotifierBuilder\Messages\Builder;

use ByTIC\Notifications\Messages\Builder\EmailBuilder as GenericBuilder;
use ByTIC\Notifier\Messages\Builder\Traits\HasNotificationMessageTrait;
use ByTIC\Notifier\Notifications\Notification;

/**
 * Class AbstractBuilder
 *
 * @package ByTIC\NotifierBuilder\Messages\Builder
 *
 * @method Notification getNotification
 */
abstract class EmailBuilder extends GenericBuilder
{
    use HasNotificationMessageTrait;
}
