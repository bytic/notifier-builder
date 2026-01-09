<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Templates\Templates\TemplateTrait;
use Nip\Records\AbstractModels\Record;

/**
 * Class MessageTrait.
 * @method Record getParentRecord()
 * @deprecated use TemplateTrait
 */
trait MessageTrait
{
    use TemplateTrait;
}
