<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Builder\Traits;

use Bytic\MailTemplates\Resources\Templates\Ink\InkTemplate;
use Bytic\MailTemplates\Templates\AbstractTemplate;

/**
 *
 */
trait HasEmailTemplate
{
    protected ?AbstractTemplate $emailTemplate = null;

    /**
     * @return null|string
     */
    public function generateEmailBody()
    {
        return $this->getEmailTemplate()
            ->with('content', $this->generateEmailContent())
            ->render();
    }

    /**
     * @return AbstractTemplate
     */
    public function getEmailTemplate(): AbstractTemplate
    {
        if ($this->emailTemplate === null) {
            $this->emailTemplate = $this->generateEmailTemplate();
        }
        return $this->emailTemplate;
    }

    protected function generateEmailTemplate(): AbstractTemplate
    {
        return new InkTemplate();
    }
}