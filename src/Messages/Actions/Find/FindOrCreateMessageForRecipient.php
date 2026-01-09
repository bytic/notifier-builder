<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Messages\Actions\Find;

use ByTIC\NotifierBuilder\Recipients\Models\Recipient;

/**
 *
 */
class FindOrCreateMessageForRecipient extends FindOrCreateMessages
{
    /**
     * @param Recipient $recipient
     * @param $channel
     * @return self
     */
    public static function forRecipient($recipient, $channel = null)
    {
        $action = static::for(
            $recipient->id_topic,
            $recipient->getRecipient(),
            $channel
        );
        return $action;
    }

}
