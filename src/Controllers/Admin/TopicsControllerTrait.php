<?php

namespace ByTIC\NotifierBuilder\Controllers\Admin;

use ByTIC\NotifierBuilder\Models\Topics\Topic;
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
        parent::view();

        $item = $this->getModelFromRequest();
        $this->payload()->set('recipients', $item->getRecipients());
    }

    /**
     * {@inheritDoc}
     */
    protected function generateModelName(): string
    {
        return get_class(NotifierBuilderModels::topics());
    }
}
