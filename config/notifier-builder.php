<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\Models\Topics\Topics;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

return [
    'models' => [
        NotifierBuilderModels::EVENTS => Events::class,
        NotifierBuilderModels::MESSAGES => Messages::class,
        NotifierBuilderModels::RECIPIENTS => Recipients::class,
        NotifierBuilderModels::TOPICS => Topics::class,
    ],
    'tables' => [
        NotifierBuilderModels::EVENTS => Events::TABLE,
        NotifierBuilderModels::MESSAGES => Messages::TABLE,
        NotifierBuilderModels::RECIPIENTS => Recipients::TABLE,
        NotifierBuilderModels::TOPICS => Topics::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
