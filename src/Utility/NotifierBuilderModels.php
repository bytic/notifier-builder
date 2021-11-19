<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\Models\Topics\Topics;
use ByTIC\NotifierBuilder\NotifierBuilderProvider;
use ByTIC\PackageBase\Utility\ModelFinder;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels
 * @package ByTIC\NotifierBuilder\Utility
 */
class NotifierBuilderModels extends ModelFinder
{
    protected static $models = [];

    /**
     * @return RecordManager|Events
     */
    public static function events()
    {
        return static::getModels('events', Events::class);
    }

    /**
     * @return RecordManager|Messages
     */
    public static function messages()
    {
        return static::getModels('messages', Messages::class);
    }

    /**
     * @return RecordManager|Recipients
     */
    public static function recipients()
    {
        return static::getModels('recipients', Recipients::class);
    }

    /**
     * @return RecordManager|Topics
     */
    public static function topics()
    {
        return static::getModels('topics', Topics::class);
    }

    protected static function packageName(): string
    {
        return NotifierBuilderProvider::NAME;
    }
}
