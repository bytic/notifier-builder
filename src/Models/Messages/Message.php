<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Message
 * @package ByTIC\NotifierBuilder\Models\Events
 */
class Message extends Record
{
    use MessageTrait;
    use CommonRecordTrait;
}
