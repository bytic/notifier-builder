<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Messages;

use Nip\Records\RecordManager;
use ByTIC\NotifierBuilder\Models\Messages\MessagesTrait;

/**
 * Class Recipient
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Messages
 */
class Messages extends RecordManager
{
    use MessagesTrait;

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return '\ByTIC\NotifierBuilder\Tests\Fixtures\Models\\';
    }
}
