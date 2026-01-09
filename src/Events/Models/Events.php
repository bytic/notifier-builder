<?php

namespace ByTIC\NotifierBuilder\Events\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Events.
 */
class Events extends RecordManager
{
    use EventsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-events';
}
