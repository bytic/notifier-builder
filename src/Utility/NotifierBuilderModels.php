<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\Models\Topics\Topics;
use ByTIC\Payments\Models\PurchaseSessions\PurchaseSessionsTrait;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels
 * @package ByTIC\NotifierBuilder\Utility
 */
class NotifierBuilderModels
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

    /**
     * @param string $type
     * @param string $default
     * @return mixed|\Nip\Records\AbstractModels\RecordManager
     */
    protected static function getModels($type, $default)
    {
        if (!isset(static::$models[$type])) {
            $modelManager = static::getConfigVar($type, $default);
            return static::$models[$type] = ModelLocator::get($modelManager);
        }

        return static::$models[$type];
    }
}
