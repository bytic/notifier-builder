<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\Notifications\Notifiable;

/**
 * Trait IsRecipientTrait.
 */
trait IsRecipientTrait
{
    /**
     * @return Notifiable[]
     */
    public function generateNotifiables()
    {
        return [$this];
    }
}
