<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Messages
 * @package ByTIC\NotifierBuilder\Models\Messages
 */
class Messages extends RecordManager
{
    use MessagesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-messages';


}
