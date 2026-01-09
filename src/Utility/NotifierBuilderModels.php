<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\NotifierBuilder\Jobs\Models\Jobs;
use ByTIC\NotifierBuilder\Models\Events\Events;
use ByTIC\NotifierBuilder\NotifierBuilderProvider;
use ByTIC\NotifierBuilder\Recipients\Models\Recipients;
use ByTIC\NotifierBuilder\Templates\Templates\Templates;
use ByTIC\NotifierBuilder\Topics\Models\Topics;
use ByTIC\PackageBase\Utility\ModelFinder;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels.
 */
class NotifierBuilderModels extends ModelFinder
{
    public const TOPICS = 'topics';
    public const RECIPIENTS = 'recipients';
    public const TEMPLATES = 'templates';

    /**
     * @deprecated use TEMPLATES instead
     */
    public const MESSAGES = self::TEMPLATES;

    public const EVENTS = 'events';
    public const JOBS = 'jobs';

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
     * @return RecordManager|Templates
     * @deprecated use templates() instead
     */
    public static function messages()
    {
        return static::getModels(self::MESSAGES, Templates::class);
    }

    /**
     * @return mixed|string
     * @deprecated use templatesTable() instead
     */
    public static function messagesTable()
    {
        return static::getTable(self::MESSAGES, Templates::TABLE);
    }

    /**
     * @return RecordManager|Templates
     */
    public static function templates()
    {
        return static::getModels(self::TEMPLATES, Templates::class);
    }

    public static function templatesTable()
    {
        return static::getTable(self::TEMPLATES, Templates::TABLE);
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

    /**
     * @return RecordManager|Topics
     */
    public static function jobs()
    {
        return static::getModels(self::JOBS, Jobs::class);
    }

    public static function jobsTable()
    {
        return static::getTable(self::JOBS, Jobs::TABLE);
    }

    protected static function packageName(): string
    {
        return NotifierBuilderProvider::NAME;
    }
}
