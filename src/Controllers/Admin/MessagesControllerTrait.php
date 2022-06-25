<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Controllers\Admin;

use ByTIC\NotifierBuilder\Models\Messages\Message;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;

/**
 * Trait MessagesControllerTrait.
 *
 * @method MessageTrait getModelFromRequest
 */
trait MessagesControllerTrait
{
    public function view()
    {
        parent::view();

        $item = $this->getModelFromRequest();
        $recipient = $item->getNotificationRecipient();

        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setNotificationMessage($item);
        $this->payload()->set('nMergeFields', $notification->generateMessageBuilder()->getMergeFields());
    }

    /**
     * {@inheritDoc}
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::messages());
    }

    /**
     * @param Message $item
     * @return bool
     */
    protected function checkItemAccess($item)
    {
        if (false === ($item instanceof Message)) {
            return false;
        }
        if ($item->hasParentRecord()) {
            $parent = $item->getParentRecord();
            if (false === $this->checkItemParentAccess($parent)) {
                return false;
            }
        }
        return parent::checkItemAccess($item);
    }

    protected function checkItemParentAccess($parent): bool
    {
        return $parent instanceof Record;
    }
}