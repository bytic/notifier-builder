<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Messages;

use Nip\Records\Record;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;

/**
 * Class Message
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Messages
 */
class Message extends Record
{
    use MessageTrait;
}
