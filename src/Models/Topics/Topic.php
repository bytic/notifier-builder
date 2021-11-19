<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Topic
 * @package ByTIC\NotifierBuilder\Models\Topics
 */
class Topic extends Record
{
    use TopicTrait;
    use CommonRecordTrait;
}
