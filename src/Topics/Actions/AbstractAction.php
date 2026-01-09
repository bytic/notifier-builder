<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 *
 */
abstract class AbstractAction extends Action
{
    use HasRepository;

    protected function generateRepository(): RecordManager
    {
        return NotifierBuilderModels::topics();
    }
}

