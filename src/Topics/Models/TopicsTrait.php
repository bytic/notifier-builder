<?php
declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Models;

use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
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
