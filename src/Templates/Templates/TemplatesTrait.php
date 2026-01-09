<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Templates;

use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Templates\Templates\TemplateTrait as Message;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;

/**
 * Class Messages.
 *
 * @method Message findOneByParams($params)
 */
trait TemplatesTrait
{
    use HasDatabaseConnectionTrait;

    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsNotifierBuilder();
    }

    protected function initRelationsNotifierBuilder()
    {
        $this->initRelationsTopic();
        $this->initRelationsMessageParent();
    }

    protected function initRelationsTopic()
    {
        $this->belongsTo('Topic', [
            'fk' => 'id_topic',
            'class' => get_class(NotifierBuilderModels::topics())
        ]);
    }

    protected function initRelationsMessageParent()
    {
        $this->morphTo(Templates::RELATION_PARENT, ['morphPrefix' => 'parent']);
    }

    protected function generateTable(): string
    {
        return Templates::TABLE;
    }
}
