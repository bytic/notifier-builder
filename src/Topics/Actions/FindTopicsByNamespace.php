<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\NotifierBuilder\Topics\Dto\TopicTarget;

/**
 *
 */
class FindTopicsByNamespace extends AbstractAction
{
    use HasSubject;
    use FindRecords;

    protected function findParams(): array
    {
        $params = [];
        $namespace = $this->getSubject();
        if (!empty($namespace)) {
            $params['where'][] = ['target LIKE ?', '' . $namespace . TopicTarget::NAMESPACE_SEPARATOR . '%'];
        }
        return $params;
    }

}