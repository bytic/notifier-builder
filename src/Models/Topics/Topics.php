<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Topics
 * @package ByTIC\NotifierBuilder\Models\Topics
 */
class Topics extends RecordManager
{
    use TopicsTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notification-topics';

}
