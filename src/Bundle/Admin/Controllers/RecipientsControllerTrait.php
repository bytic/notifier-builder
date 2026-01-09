<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Bundle\Admin\Controllers;

trait RecipientsControllerTrait
{

    public function view()
    {
        $item = $this->getModelFromRequest();

        $this->payload()->with(
            [
                'item' => $item,
            ]
        );
    }

}