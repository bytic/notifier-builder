<?php

namespace ByTIC\NotifierBuilder\Models\Topics;

use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Models\Events\EventTrait as Event;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Locator\ModelLocator;

/**
 * Class TopicsTrait.
 *
 * @method findOneByParams($params)
 */
trait TopicsTrait
{
    use HasDatabaseConnectionTrait;

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsCommon();
    }

    protected function initRelationsCommon()
    {
        $this->initRelationsEvents();
        $this->initRelationsRecipients();
    }

    protected function initRelationsEvents()
    {
        $this->hasMany('Events', ['class' => get_class(NotifierBuilderModels::events())]);
    }

    protected function initRelationsRecipients()
    {
        $this->hasMany('Recipients', ['class' => get_class(NotifierBuilderModels::recipients()), 'fk' => 'id_topic']);
    }

    /**
     * Fire a notification event.
     *
     * @param Record $model Model Record instance
     * @param string $trigger Trigger name
     *
     * @return bool|Event
     */
    public static function fireEvent($model, $trigger)
    {
        $target = self::modelToTargetName($model);
        $topic = self::findByTargetTrigger($target, $trigger);
        if ($topic) {
            return $topic->fireEvent($model);
        }

        return false;
    }

    /**
     * @param $target
     * @param $trigger
     *
     * @return false|Topic
     */
    public static function findByTargetTrigger($target, $trigger)
    {
        $self = self::instance();
        $params = [
            'where' => [
                ['`target` = ?', $target],
                ['`trigger` = ?', $trigger],
            ],
        ];

        return $self->findOneByParams($params);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public static function getTargetManager($name)
    {
        return ModelLocator::get($name);
    }

    /**
     * Returns the target name from model instance.
     *
     * @param Record $model Model Record instance
     *
     * @return string
     */
    public static function modelToTargetName($model)
    {
        return $model->getManager()->getController();
    }

    protected function generateTable(): string
    {
        return Topics::TABLE;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public static function getTargetManagerClass($name)
    {
        return ModelLocator::class($name);
    }
}
