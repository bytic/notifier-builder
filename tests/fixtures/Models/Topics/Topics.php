<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Topics;

use ByTIC\NotifierBuilder\Models\Topics\TopicsTrait;
use Nip\Records\RecordManager;

/**
 * Class Topics
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Topics
 */
class Topics extends RecordManager
{
    use TopicsTrait;
}
