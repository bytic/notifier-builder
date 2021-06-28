<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Recipients;

use ByTIC\NotifierBuilder\Models\Recipients\RecipientsTrait;
use Nip\Records\RecordManager;

/**
 * Class Recipient
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Recipients
 */
class Recipients extends RecordManager
{
    use RecipientsTrait;

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return '\ByTIC\NotifierBuilder\Tests\Fixtures\Models\\';
    }
}
