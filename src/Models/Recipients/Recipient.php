<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;
use Nip_Registry;

/**
 * Class Recipient
 * @package ByTIC\NotifierBuilder\Models\Recipients
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
