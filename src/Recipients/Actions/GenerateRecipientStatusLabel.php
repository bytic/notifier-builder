<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Recipients\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;

/**
 *
 */
class GenerateRecipientStatusLabel extends Action
{
    use HasSubject;

    public function html(): string
    {
        if ($this->getSubject()->isActive()) {
            return $this->generateActiveHtml();
        } else {
            return $this->generateInactiveHtml();
        }
    }

    protected function generateActiveHtml(): string
    {
        return $this->generateBaseHtml(translator()->trans('yes'), 'success');
    }

    protected function generateBaseHtml($label, $class): string
    {
        return '<span class="badge text-bg-' . $class . '">' . $label . '</span>';
    }

    protected function generateInactiveHtml(): string
    {
        return $this->generateBaseHtml(translator()->trans('no'), 'danger');
    }
}