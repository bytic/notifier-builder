<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Jobs\Models;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableManagerTrait;
use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait;
use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Trait JobsTrait.
 */
trait JobsTrait
{
    use RecordsTrait;
    use TimestampableManagerTrait;
    use HasDatabaseConnectionTrait;

    /**
     * @return string
     */
    public function getStatusItemsDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'SendStatus';
    }

    /**
     * @return string
     */
    public function getStatusItemsRootNamespace()
    {
        return __NAMESPACE__ . '\Statuses\\';
    }

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
     * {@inheritDoc}
     */
    protected function injectParams(&$params = [])
    {
        $params['order'][] = ['id', 'ASC'];

        parent::injectParams($params);
    }

    protected function generateTable(): string
    {
        return Jobs::TABLE;
    }
}
