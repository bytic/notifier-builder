<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\Notifications\Notifiable;

/**
 * Trait IsRecipientTrait
 * @package ByTIC\NotifierBuilder\Models\Recipients
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
