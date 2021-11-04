<?php

namespace ByTIC\NotifierBuilder\Models\Messages;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Messages
 * @package ByTIC\NotifierBuilder\Models\Messages
 */
class Messages extends RecordManager
{
    use SingletonTrait;
    use MessagesTrait;

    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Models\\';
    }
}
