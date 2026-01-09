<?php

namespace ByTIC\NotifierBuilder\Recipients\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Recipient.
 */
class Recipient extends Record
{
    use RecipientTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
