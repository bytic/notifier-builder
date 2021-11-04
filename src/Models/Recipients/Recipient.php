<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use Nip\Records\Record;
use Nip_Registry;

/**
 * Class Recipient
 * @package ByTIC\NotifierBuilder\Models\Recipients
 */
class Recipient extends Record
{
    use RecipientTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
