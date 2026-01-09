<?php

namespace ByTIC\NotifierBuilder\Bundle\Admin\Controllers;

use ByTIC\NotifierBuilder\Topics\Models\Topic;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait MessagesControllerTrait.
 *
 * @method Topic getModelFromRequest
 */
trait TopicsControllerTrait
{
    public function view()
    {
        $item = $this->getModelFromRequest();
        $this->payload()->with(
            [
                'item' => $item,
                'recipients' => $item->getRecipients()
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::topics());
    }
}
