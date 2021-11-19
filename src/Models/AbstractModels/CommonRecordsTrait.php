<?php

namespace ByTIC\NotifierBuilder\Models\AbstractModels;

use Nip\I18n\Translatable\HasTranslations;

/**
 * Trait CommonRecordsTrait
 * @package ByTIC\NotifierBuilder\Models\AbstractModels
 */
trait CommonRecordsTrait
{
    use HasTranslations;

    /**
     * @return string
     */
    public function getTranslateRoot()
    {
        return $this->getController();
    }

    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Models\\';
    }
}
