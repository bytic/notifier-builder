<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Templates\Models\TemplatesTrait;
use ByTIC\NotifierBuilder\Templates\Models\TemplateTrait as Message;

/**
 * Class Messages.
 * @method Message findOneByParams($params)
 * @deprecated use TemplatesTrait instead
 */
trait MessagesTrait
{
    use TemplatesTrait;

}
