<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Factories;

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class MessageFactory
{
    /**
     * @param $data
     * @return Record
     */
    public static function create($data = []): Record
    {
        $model = NotifierBuilderModels::messages()->getNewRecord();
        $model->fill($data);
        $model->save();

        return $model;
    }
}