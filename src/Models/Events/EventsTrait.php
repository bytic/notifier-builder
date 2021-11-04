<?php

namespace ByTIC\NotifierBuilder\Models\Events;

/**
 * Trait EventsTrait
 * @package ByTIC\NotifierBuilder\Models\Events
 */
trait EventsTrait
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait;

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
