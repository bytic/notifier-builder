<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Recipients;

use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait;
use Nip\Records\Record;

/**
 * Class Recipient
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Recipients
 */
class Recipient extends Record
{
    use RecipientTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
