<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\CommonRecordTrait;
use Nip\Records\Record;

/**
 * Class Template.
 */
class Template extends Record
{
    use TemplateTrait;
    use CommonRecordTrait;
}
