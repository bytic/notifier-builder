<?php

namespace ByTIC\NotifierBuilder\Topics\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Topics.
 */
class Topics extends RecordManager
{
    use TopicsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-topics';
}
