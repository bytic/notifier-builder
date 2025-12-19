<?php

namespace ByTIC\NotifierBuilder\Jobs\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Jobs.
 */
class Jobs extends RecordManager
{
    use JobsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-jobs';
}
