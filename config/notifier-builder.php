<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Jobs\Models\Jobs;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Recipients\Models\Recipients;
use ByTIC\NotifierBuilder\Templates\Templates\Templates;
use ByTIC\NotifierBuilder\Topics\Models\Topics;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

return [
    'models' => [
        NotifierBuilderModels::EVENTS => Events::class,
        NotifierBuilderModels::TEMPLATES => Templates::class,
        NotifierBuilderModels::RECIPIENTS => Recipients::class,
        NotifierBuilderModels::TOPICS => Topics::class,
        NotifierBuilderModels::JOBS => Jobs::class,
    ],
    'tables' => [
        NotifierBuilderModels::EVENTS => Events::TABLE,
        NotifierBuilderModels::TEMPLATES => Templates::TABLE,
        NotifierBuilderModels::RECIPIENTS => Recipients::TABLE,
        NotifierBuilderModels::TOPICS => Topics::TABLE,
        NotifierBuilderModels::JOBS => Jobs::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
