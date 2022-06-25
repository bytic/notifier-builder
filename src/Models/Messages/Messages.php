<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Messages.
 */
class Messages extends RecordManager
{
    use MessagesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-messages';

    public const RELATION_PARENT = 'ParentRecord';
}
