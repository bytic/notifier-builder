<?php

namespace ByTIC\NotifierBuilder\Models\Events;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Events
 * @package ByTIC\NotifierBuilder\Models\Events
 */
class Events extends RecordManager
{
    use SingletonTrait;
    use EventsTrait;

    public const TABLE = 'notification-events';

    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Models\\';
    }
}
