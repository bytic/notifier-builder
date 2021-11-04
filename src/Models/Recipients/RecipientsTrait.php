<?php

namespace ByTIC\NotifierBuilder\Models\Recipients;

use ByTIC\NotifierBuilder\Models\Messages\Messages;
use Nip\Records\AbstractModels\Record;

/**
 * Trait RecipientsTrait
 * @package ByTIC\NotifierBuilder\Models\Recipients
 */
trait RecipientsTrait
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait;

    /**
     * Returns the target name from model instance
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
     * @return mixed
     */
    public static function getRecipientManager($name)
    {
        $class = self::getRecipientManagerClass($name);
        return call_user_func([$class, 'instance']);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public static function getRecipientManagerClass($name)
    {
        return inflector()->pluralize(inflector()->classify($name));
    }

    /**
     * @param string $name
     * @return string
     */
    public static function generateRecipientGetterMethod($name)
    {
        return 'get' . inflector()->singularize(inflector()->classify($name));
    }

    /**
     * @return string
     */
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
