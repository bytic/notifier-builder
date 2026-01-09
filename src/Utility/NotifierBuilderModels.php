<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\Models\Messages\Messages;
use ByTIC\NotifierBuilder\Models\Recipients\Recipients;
use ByTIC\NotifierBuilder\NotifierBuilderProvider;
use ByTIC\NotifierBuilder\Topics\Models\Topics;
use ByTIC\PackageBase\Utility\ModelFinder;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels.
 */
class NotifierBuilderModels extends ModelFinder
{
    public const EVENTS = 'events';
    public const MESSAGES = 'messages';

    public const RECIPIENTS = 'recipients';
    public const TOPICS = 'topics';


    /**
     * @return RecordManager|Events
     */
    public static function events()
    {
        return static::getModels(self::EVENTS, Events::class);
    }

    /**
     */
    public static function eventsTable()
    {
        return static::getTable(self::EVENTS, Events::TABLE);
    }

    /**
     * @return RecordManager|Messages
     */
    public static function messages()
    {
        return static::getModels(self::MESSAGES, Messages::class);
    }

    public static function messagesTable()
    {
        return static::getTable(self::MESSAGES, Messages::TABLE);
    }

    /**
     * @return RecordManager|Recipients
     */
    public static function recipients()
    {
        return static::getModels(self::RECIPIENTS, Recipients::class);
    }

    public static function recipientsTable()
    {
        return static::getTable(self::RECIPIENTS, Recipients::TABLE);
    }

    /**
     * @return RecordManager|Topics
     */
    public static function topics()
    {
        return static::getModels(self::TOPICS, Topics::class);
    }

    public static function topicsTable()
    {
        return static::getTable(self::TOPICS, Topics::TABLE);
    }

    protected static function packageName(): string
    {
        return NotifierBuilderProvider::NAME;
    }
}
