<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Message.
 */
class Message extends Record
{
    use MessageTrait;
    use CommonRecordTrait;
}
