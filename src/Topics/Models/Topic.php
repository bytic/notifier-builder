<?php

namespace ByTIC\NotifierBuilder\Topics\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Topic.
 */
class Topic extends Record
{
    use TopicTrait;
    use CommonRecordTrait;
}
