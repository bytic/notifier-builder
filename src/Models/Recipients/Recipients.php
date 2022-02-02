<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Recipients.
 */
class Recipients extends RecordManager
{
    use RecipientsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-recipients';
}
