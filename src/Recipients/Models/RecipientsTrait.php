<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Recipients\Models;

use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait;
use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Locator\ModelLocator;

/**
 * Trait RecipientsTrait.
 */
trait RecipientsTrait
{
    use RecordsTrait;
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
     * Returns the target name from model instance.
     *
     * @param Record $model Model Record instance
     *
     * @return string
     */
    public static function modelToRecipientName($model)
    {
        return $model->getManager()->getController();
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public static function getRecipientManager($name)
    {
        return ModelLocator::get($name);
    }

    /**
     * @param string $name
     */
    public static function getRecipientManagerClass($name): string
    {
        return ModelLocator::class($name);
    }

    protected function generateTable(): string
    {
        return Recipients::TABLE;
    }

    /**
     * @return string
     */
    public function getTypesDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Types';
    }

    /**
     * @return string
     */
    public function getTypeNamespace()
    {
        return __NAMESPACE__ . '\Types\\';
    }
}
