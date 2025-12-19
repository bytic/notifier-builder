<?php

namespace ByTIC\NotifierBuilder\Jobs\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Job.
 */
class Job extends Record
{
    use JobTrait;
    use CommonRecordTrait;

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
