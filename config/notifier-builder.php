<?php

use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\Models\Topics\Topics;

return [
    'models' => [
        'events' => Events::class,
        'messages' => Messages::class,
        'recipients' => Recipients::class,
        'topics' => Topics::class,
    ],
    'tables' => [
        'events' => Events::TABLE,
        'messages' => Messages::TABLE,
        'recipients' => Recipients::TABLE,
        'topics' => Topics::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
