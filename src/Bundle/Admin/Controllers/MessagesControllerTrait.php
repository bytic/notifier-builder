<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Bundle\Admin\Controllers;

use ByTIC\NotifierBuilder\Notifications\NotificationFactory;
use ByTIC\NotifierBuilder\Templates\Templates\Template;
use ByTIC\NotifierBuilder\Templates\Templates\TemplateTrait;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;

/**
 * Trait MessagesControllerTrait.
 *
 * @method TemplateTrait getModelFromRequest
 */
trait MessagesControllerTrait
{
    public function view()
    {
        $item = $this->getModelFromRequest();
        $recipient = $item->getNotificationRecipient();

        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setNotificationMessage($item);
        $this->payload()->with(
            [
                'item' => $item,
                'nMergeFields' => $notification->generateMessageBuilder()->getMergeFields()
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::messages());
    }

    /**
     * @param Template $item
     * @return bool
     */
    protected function checkItemAccess($item)
    {
        if (false === ($item instanceof Template)) {
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