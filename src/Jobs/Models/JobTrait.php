<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Jobs\Models;

use ByTIC\Common\Records\Emails\Builder\BuilderAwareTrait;
use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordTrait;
use ByTIC\NotifierBuilder\Jobs\Dispatcher\JobDispatcher;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;

/**
 * Trait JobsTrait.
 *
 * @method Topic getTopic()
 *
 * @property int $id_topic
 * @property int $id_item
 */
trait JobTrait
{
    use RecordTrait;
    use TimestampableTrait;

    /**
     * @var string
     */
    protected static $createTimestamps = ['created'];

    /**
     * @var string
     */
    protected static $updateTimestamps = ['modified'];

}
