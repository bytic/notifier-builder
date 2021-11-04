<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Topics
 * @package ByTIC\NotifierBuilder\Models\Topics
 */
class Topics extends RecordManager
{
    use SingletonTrait;
    use TopicsTrait;

    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Models\\';
    }
}
