<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Models\Topics;

use ByTIC\NotifierBuilder\Models\Topics\TopicTrait;
use Nip\Records\Record as NipRecord;

/**
 * Class Topic
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Models\Topics
 */
class Topic extends NipRecord
{
    use TopicTrait;
}
