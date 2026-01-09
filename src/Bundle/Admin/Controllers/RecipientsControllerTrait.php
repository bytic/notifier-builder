<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Bundle\Admin\Controllers;

use ByTIC\NotifierBuilder\Recipients\Models\Recipient;
use ByTIC\NotifierBuilder\Templates\Actions\Find\FindOrCreateTemplatesByParents;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * @method Recipient getModelFromRequest()
 */
trait RecipientsControllerTrait
{
    use AbstractControllerTrait;

    public function view()
    {
        $item = $this->getModelFromRequest();
        $topic = $item->getTopic();
        $channels = $item->getChannelsArray();

        $parentGlobal = $this->getNotifierBuilderTenant();
        $parentType = $this->getRequest()->query->get('parent_type', $parentGlobal?->getManager()->getMorphName());
        $parentId = $this->getRequest()->query->get('parent_id', $parentGlobal?->id);

        $templates = NotifierBuilderModels::templates()->newCollection();
        foreach ($channels as $channel) {
            $templateAction = FindOrCreateTemplatesByParents::for($topic, $item->getRecipient(), $channel);
            if ($parentId && $parentType) {
                $templateAction->withParents([$parentId => $parentType]);
            }
            $templateAction->orCreate();
            $templates->push($templateAction->fetch());
        }

        $this->payload()->with(
            [
                'item' => $item,
                'templates' => $templates,
                'channels' => $channels,
                'topic' => $topic,
            ]
        );
    }
}
