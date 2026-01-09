<?php

namespace ByTIC\NotifierBuilder\Recipients\Models;

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
