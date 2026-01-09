<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Bundle\Admin\Forms\Messages;

trait MessagesFormTrait
{
    public function init()
    {
        parent::init();

        $this->initCommon();
    }

    protected function initCommon()
    {
        $this->addInput('subject', translator()->trans('subject'), true);
        $this->addTexteditor('content', translator()->trans('content'), true);

        $this->addButton('save', translator()->trans('submit'));
    }
}
