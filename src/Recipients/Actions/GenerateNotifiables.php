<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Recipients\Actions;

use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Models\Recipients\IsRecipientTrait;
use ByTIC\NotifierBuilder\Models\Recipients\Recipient;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class GenerateNotifiables
{
    /**
     * @var Event|Record
     */
    protected $event;

    /**
     * @var Recipient|Record
     */
    protected $recipient;

    public static function for($recipient, $event): self
    {
        $self = new self();
        $self->event = $event;
        $self->recipient = $recipient;
        return $self;
    }

    public function handle()
    {
        $notifiableModels =
            GenerateRecipients::forEvent($this->recipient, $this->event)
                ->generate();

        if ($notifiableModels) {
            /* @var IsRecipientTrait $notifiableModels */
            return $notifiableModels->generateNotifiables();
        }

        throw new NotificationRecipientModelNotFoundException(
            'No model found in recipient '
            . $this->recipient->getName()
            . ' from notification event [' . $this->event->id . ']'
        );
    }
}