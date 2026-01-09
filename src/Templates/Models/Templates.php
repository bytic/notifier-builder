<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Templates.
 */
class Templates extends RecordManager
{
    use TemplatesTrait;
    use CommonRecordsTrait;

    public const TABLE = 'notifications-templates';

    public const RELATION_PARENT = 'ParentRecord';
}
