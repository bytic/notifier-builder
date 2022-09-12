<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Notifications\Traits;

use Nip\Records\AbstractModels\Record;

/**
 * Trait HasEventTrait.
 */
trait HasSubjectRecordTrait
{
    /**
     * @var ?Record
     */
    protected $subjectRecord = null;

    /**
     * @return bool
     */
    public function hasSubjectRecord()
    {
        return is_object($this->getSubjectRecord());
    }

    /**
     * @return ?Record
     */
    public function getSubjectRecord()
    {
        return $this->subjectRecord;
    }

    /**
     * @param ?Record $record
     */
    public function setSubjectRecord($record)
    {
        $this->subjectRecord = $record;
    }
}
