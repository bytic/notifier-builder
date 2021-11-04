<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Recipients
 * @package ByTIC\NotifierBuilder\Models\Recipients
 */
class Recipients extends RecordManager
{
    use SingletonTrait;
    use RecipientsTrait;

    public const TABLE = 'notification-recipients';

    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Models\\';
    }
}
