<?php

namespace ByTIC\NotifierBuilder\Models\Events;

use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait EventsTrait
 * @package ByTIC\NotifierBuilder\Models\Events
 */
trait EventsTrait
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait;
    use HasDatabaseConnectionTrait;

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsCommon();
    }

    protected function initRelationsCommon()
    {
        $this->initRelationsTopic();
    }

    protected function initRelationsTopic()
    {
        $this->belongsTo('Topic', ['class' => get_class(NotifierBuilderModels::topics()), 'fk' => 'id_topic']);
    }

    /**
     * @inheritDoc
     */
    protected function injectParams(&$params = [])
    {
        $params['order'][] = ['id', 'ASC'];

        parent::injectParams($params);
    }

    /**
     * @return string
     */
    protected function generateTable(): string
    {
        return Events::TABLE;
    }

    /**
     * @return string
     */
    public function getStatusItemsDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Statuses';
    }

    /**
     * @return string
     */
    public function getStatusItemsRootNamespace()
    {
        return __NAMESPACE__ . '\Statuses\\';
    }
}
