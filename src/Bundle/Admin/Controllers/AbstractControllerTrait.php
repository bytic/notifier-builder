<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Bundle\Admin\Controllers;

use ByTIC\NotifierBuilder\Bundle\Library\View\ViewUtility;
use Nip\Controllers\Response\ResponsePayload;
use Nip\View\View;

/**
 * @method ResponsePayload payload()
 */
trait AbstractControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;

    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        ViewUtility::registerViewPathsAdmin($view);
    }
}